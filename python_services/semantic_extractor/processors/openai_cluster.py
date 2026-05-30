"""
OpenAI Cluster Builder — Groups keywords into highly accurate semantic clusters using LLMs.

This module leverages the OpenAI API to categorize and cluster extracted keywords 
by human-like search intent and topic, providing vastly superior grouping compared 
to basic n-gram matching.
"""

import json
from openai import AsyncOpenAI
import logging

from config import config

# Optional dependency injection for the OpenAI client
_client = None

def get_openai_client():
    global _client
    if not _client and config.OPENAI_API_KEY:
        _client = AsyncOpenAI(api_key=config.OPENAI_API_KEY)
    return _client

async def build_clusters_with_llm(
    tool_name: str,
    keywords: list[dict], 
    model: str = "gpt-4o-mini"
) -> dict:
    """
    Use OpenAI to cluster a list of keywords semantically.
    Falls back to a basic empty dict if the API key is missing or an error occurs.
    
    Args:
        tool_name: The name of the tool (for context)
        keywords: List of keyword dicts
        model: OpenAI model to use (default: gpt-4o-mini for cost efficiency)
        
    Returns:
        Dict mapping cluster name -> list of keywords
    """
    client = get_openai_client()
    if not client:
        logging.warning("OpenAI API key not configured. Cannot perform LLM clustering.")
        return {}

    if not keywords:
        return {}

    # We only need to send the raw keywords to the LLM to save tokens
    keyword_list = [kw.get("keyword") for kw in keywords if kw.get("keyword")]
    
    if len(keyword_list) == 0:
        return {}

    prompt = f"""
You are an expert SEO analyst. Categorize the following search queries related to the tool "{tool_name}" into 3-6 distinct, highly relevant topical clusters. 

Return ONLY a valid JSON object where the keys are the cluster names (e.g., "General Questions", "Calculations & Formulas", "Comparisons") and the values are arrays of the exact keywords belonging to that cluster. 

Every keyword provided must be assigned to exactly one cluster. Do not omit any keywords.

Keywords to cluster:
{json.dumps(keyword_list, indent=2)}
"""

    try:
        response = await client.chat.completions.create(
            model=model,
            messages=[
                {"role": "system", "content": "You are a helpful SEO assistant that outputs strictly valid JSON without markdown blocks or code formatting."},
                {"role": "user", "content": prompt}
            ],
            response_format={ "type": "json_object" },
            temperature=0.1,
            max_tokens=2000
        )
        
        content = response.choices[0].message.content
        cluster_mapping = json.loads(content)
        
        # Reconstruct the dict of keyword objects based on the LLM's string mapping
        # Create a lookup for original keyword dicts
        kw_lookup = {kw.get('keyword', '').lower(): kw for kw in keywords}
        
        final_clusters = {}
        for cluster_name, kw_strings in cluster_mapping.items():
            final_clusters[cluster_name] = []
            for kw_str in kw_strings:
                original_dict = kw_lookup.get(str(kw_str).lower())
                if original_dict:
                    final_clusters[cluster_name].append(original_dict)
                    
        return final_clusters

    except Exception as e:
        logging.error(f"OpenAI clustering failed: {str(e)}")
        return {}
