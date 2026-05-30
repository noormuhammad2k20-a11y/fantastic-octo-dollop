"""
Google Trends Extractor (Lite) — Extracts related queries and rising trends.

Uses the unofficial Google Trends API endpoints to find related
topics and queries for a seed keyword. Useful for discovering
seasonal or trending semantic variations.
"""

import json
import httpx
from urllib.parse import quote_plus

from config import config
from utils.rate_limiter import rate_limiter
from utils.user_agent_rotator import ua_rotator
from utils.cache_manager import cache_manager

TRENDS_EXPLORE_URL = 'https://trends.google.com/trends/api/explore'
TRENDS_RELATED_URL = 'https://trends.google.com/trends/api/widgetdata/relatedsearches'


async def extract_trending_queries(
    seed_keyword: str,
    language: str = 'en',
    geo: str = 'US',
) -> list[dict]:
    """
    Extract trending and related queries from Google Trends.
    
    Args:
        seed_keyword: The base keyword
        language: Language code
        geo: Geographic location (default US)
        
    Returns:
        List of dicts with keyword and trend data.
    """
    # Check cache
    cached = cache_manager.get('pytrends', f"{seed_keyword}:{geo}", language)
    if cached is not None:
        return cached

    await rate_limiter.acquire('pytrends', rpm=15, delay=4.0)

    results = []
    
    try:
        async with httpx.AsyncClient(follow_redirects=True) as client:
            # 1. Get the explore token
            explore_params = {
                'hl': language,
                'tz': '-240',
                'req': json.dumps({"comparisonItem":[{"keyword":seed_keyword,"geo":geo,"time":"today 12-m"}],"category":0,"property":""})
            }
            
            resp1 = await client.get(
                TRENDS_EXPLORE_URL, 
                params=explore_params,
                headers=ua_rotator.get_headers()
            )
            
            if resp1.status_code != 200:
                return []
                
            # Response starts with ")]}',\n" - strip it
            text1 = resp1.text[5:]
            data1 = json.loads(text1)
            
            # Find the related queries widget
            widget_token = None
            for widget in data1.get('widgets', []):
                if widget.get('id') == 'RELATED_QUERIES':
                    widget_token = widget.get('token')
                    break
                    
            if not widget_token:
                return []
                
            # 2. Get the related queries data
            await rate_limiter.acquire('pytrends', rpm=15, delay=2.0)
            
            related_params = {
                'hl': language,
                'tz': '-240',
                'req': json.dumps({"restriction":{"geo":{"geoId":geo},"time":"today 12-m","originalTimeRangeForExploreUrl":"today 12-m","complexKeywordsRestriction":{"keyword":[{"type":"BROAD","value":seed_keyword}]}},"keywordType":"QUERY","metric":["TOP","RISING"],"trendinessSettings":{"compareTime":"2004-01-01 2024-01-01"},"requestOptions":{"property":"","backend":"IZG","category":0}}),
                'token': widget_token
            }
            
            resp2 = await client.get(
                TRENDS_RELATED_URL,
                params=related_params,
                headers=ua_rotator.get_headers()
            )
            
            if resp2.status_code == 200:
                text2 = resp2.text[5:]
                data2 = json.loads(text2)
                
                # Parse top queries
                top_list = data2.get('default', {}).get('rankedList', [])
                if len(top_list) > 0:
                    for item in top_list[0].get('rankedKeyword', []):
                        kw = item.get('query')
                        if kw and kw.lower() != seed_keyword.lower():
                            results.append({
                                'keyword': kw,
                                'keyword_type': 'trending',
                                'search_intent': 'informational', # Fallback
                                'source': 'pytrends_top',
                                'confidence_score': 0.8,
                                'language': language,
                                'meta': {'value': item.get('value')}
                            })
                            
                # Parse rising queries
                if len(top_list) > 1:
                    for item in top_list[1].get('rankedKeyword', []):
                        kw = item.get('query')
                        if kw and kw.lower() != seed_keyword.lower():
                            results.append({
                                'keyword': kw,
                                'keyword_type': 'trending',
                                'search_intent': 'informational',
                                'source': 'pytrends_rising',
                                'confidence_score': 0.9, # Higher confidence for rising trends
                                'language': language,
                                'meta': {'value': item.get('value')} # e.g. "Breakout" or "+120%"
                            })
                            
    except Exception as e:
        # Pytrends can be flaky, fail gracefully
        pass
        
    # Cache and return
    cache_manager.set('pytrends', f"{seed_keyword}:{geo}", results, language)
    return results
