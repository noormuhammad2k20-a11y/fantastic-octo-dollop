"""
People Also Ask (PAA) Extractor — Extracts question-based keywords.

Uses a simulated/lite approach to parse SERP HTML for 'People Also Ask'
questions. This provides highly relevant informational keywords and FAQ targets.
"""

import re
from urllib.parse import quote_plus
import httpx

from config import config
from utils.rate_limiter import rate_limiter
from utils.user_agent_rotator import ua_rotator
from utils.cache_manager import cache_manager


async def extract_paa_questions(
    seed_keyword: str,
    language: str = 'en',
    max_questions: int | None = None,
) -> list[dict]:
    """
    Extract People Also Ask questions from Google Search.
    
    Args:
        seed_keyword: The base keyword to search
        language: Language code
        max_questions: Max questions to return
        
    Returns:
        List of question dictionaries.
    """
    max_questions = max_questions or config.MAX_PAA_QUESTIONS
    
    # Check cache
    cached = cache_manager.get('paa', seed_keyword, language)
    if cached is not None:
        return cached[:max_questions]

    await rate_limiter.acquire('paa', rpm=10, delay=config.PAA_DELAY)
    
    results = []
    
    try:
        async with httpx.AsyncClient(follow_redirects=True) as client:
            search_url = f"https://www.google.com/search?q={quote_plus(seed_keyword)}&hl={language}"
            
            response = await client.get(
                search_url,
                headers=ua_rotator.get_headers({'Accept': 'text/html'}),
                timeout=15.0
            )
            
            if response.status_code == 200:
                html = response.text
                
                # Very basic regex to find PAA questions in Google's minified HTML
                # In a production app, we would use a proper SERP API (like DataForSEO or ValueSERP)
                # This is a fallback heuristic approach for the microservice.
                
                # Look for typical question patterns in div text
                question_pattern = r'>([^<]+(?:how|what|why|when|where|is|can|do|does)[^<]+\?)<'
                matches = re.findall(question_pattern, html, re.IGNORECASE)
                
                seen = set()
                for match in matches:
                    q = match.strip()
                    # Filter out obvious UI elements or garbage
                    if len(q) > 10 and len(q) < 150 and q not in seen:
                        if not any(stop in q.lower() for stop in ['google', 'search', 'results']):
                            seen.add(q)
                            results.append({
                                'keyword': q,
                                'keyword_type': 'paa',
                                'search_intent': 'informational',
                                'source': 'paa_extractor',
                                'confidence_score': 0.85,
                                'language': language,
                            })
                            
                    if len(results) >= max_questions:
                        break
                        
    except Exception as e:
        pass
        
    cache_manager.set('paa', seed_keyword, results, language)
    return results[:max_questions]
