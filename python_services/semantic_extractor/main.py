from fastapi import FastAPI, HTTPException, Query
import asyncio
from pydantic import BaseModel, Field

from config import config
from extractors.google_suggest import extract_google_suggestions
from extractors.entity_extractor import extract_entities
from extractors.pytrends_extractor import extract_trending_queries
from extractors.paa_extractor import extract_paa_questions
from processors.deduplicator import deduplicate_keywords
from processors.intent_classifier import batch_classify
from processors.cluster_builder import build_clusters
from processors.openai_cluster import build_clusters_with_llm
from utils.cache_manager import cache_manager

app = FastAPI(
    title="ToolsHub Semantic Extractor",
    description="Microservice for extracting semantic SEO keywords and entities.",
    version="1.0.0",
)


class ExtractionRequest(BaseModel):
    tool_slug: str = Field(..., description="The unique slug of the tool")
    tool_name: str = Field(..., description="The display name of the tool")
    tool_h1: str = Field("", description="The H1 heading text")
    tool_description: str = Field("", description="The meta description")
    tool_category: str = Field("", description="The category slug")
    language: str = Field("en", description="ISO language code")
    max_results: int = Field(50, description="Maximum number of keywords to return")


class ExtractionResponse(BaseModel):
    tool_slug: str
    language: str
    total_keywords: int
    keywords: list[dict]
    entities: list[dict]
    clusters: dict
    status: str = "success"


@app.get("/health")
async def health_check():
    """Health check endpoint for monitoring."""
    cache_stats = cache_manager.get_stats()
    return {
        "status": "healthy",
        "cache": cache_stats,
        "config": {
            "debug": config.DEBUG,
            "rpm_limit": config.GOOGLE_SUGGEST_RPM,
        }
    }


@app.post("/extract", response_model=ExtractionResponse)
async def extract_semantics(req: ExtractionRequest):
    """
    Extract semantic keywords and entities for a given tool.
    
    This endpoint combines results from multiple extractors
    and processes them into a clean, deduplicated, and clustered format.
    """
    try:
        # 1. Extract Entities (Fast, local NLP)
        entities = extract_entities(
            tool_name=req.tool_name,
            tool_description=req.tool_description,
            tool_category=req.tool_category,
            tool_h1=req.tool_h1,
        )

        # Determine the best seed keyword for external extractors
        seed = req.tool_name.lower().replace("calculator", "").replace("converter", "").strip()
        if not seed:
            seed = req.tool_slug.replace("-", " ")

        # 2. Extract from external sources concurrently
        suggestions_task = extract_google_suggestions(
            seed_keyword=seed,
            language=req.language,
            max_total=req.max_results,
        )
        
        paa_task = extract_paa_questions(
            seed_keyword=seed,
            language=req.language,
            max_questions=10,
        )
        
        trends_task = extract_trending_queries(
            seed_keyword=seed,
            language=req.language,
        )
        
        suggestions, paa, trends = await asyncio.gather(
            suggestions_task, paa_task, trends_task
        )
        
        # Combine all extracted keywords
        all_keywords = suggestions + paa + trends

        # 3. Process the combined results
        # Classify intent for all keywords
        classified_keywords = batch_classify(all_keywords)
        
        # Deduplicate, keeping the highest confidence versions
        final_keywords = deduplicate_keywords(classified_keywords, similarity_threshold=0.85)
        
        # Group into semantic clusters
        if config.OPENAI_API_KEY:
            clusters = await build_clusters_with_llm(req.tool_name, final_keywords)
            # Fallback to basic clustering if LLM fails
            if not clusters:
                clusters = build_clusters(final_keywords)
        else:
            clusters = build_clusters(final_keywords)

        return ExtractionResponse(
            tool_slug=req.tool_slug,
            language=req.language,
            total_keywords=len(final_keywords),
            keywords=final_keywords,
            entities=entities,
            clusters=clusters,
        )

    except Exception as e:
        if config.DEBUG:
            raise HTTPException(status_code=500, detail=str(e))
        raise HTTPException(status_code=500, detail="Internal server error during extraction")


@app.delete("/cache")
async def clear_cache(source: str | None = Query(None)):
    """Clear the extraction cache."""
    count = cache_manager.clear(source)
    return {"status": "success", "cleared_files": count}

if __name__ == "__main__":
    import uvicorn
    uvicorn.run("main:app", host=config.HOST, port=config.PORT, reload=config.DEBUG)
