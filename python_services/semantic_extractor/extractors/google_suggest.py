"""
Google Suggest Extractor — Extracts autocomplete suggestions from Google.

Uses the public Google Autocomplete API (XML endpoint) to retrieve
real user search queries related to a seed keyword. Applies recursive
expansion (alphabet technique) for comprehensive coverage.
"""

import asyncio
import xml.etree.ElementTree as ET
from urllib.parse import quote_plus

import httpx

from config import config
from utils.rate_limiter import rate_limiter
from utils.user_agent_rotator import ua_rotator
from utils.cache_manager import cache_manager


GOOGLE_SUGGEST_URL = 'http://suggestqueries.google.com/complete/search'


async def _fetch_suggestions(
    client: httpx.AsyncClient,
    query: str,
    language: str = 'en',
) -> list[str]:
    """
    Fetch autocomplete suggestions for a single query string.

    Returns a list of suggestion strings.
    """
    await rate_limiter.acquire(
        'google_suggest',
        rpm=config.GOOGLE_SUGGEST_RPM,
        delay=config.GOOGLE_SUGGEST_DELAY,
    )

    params = {
        'output': 'toolbar',
        'hl': language,
        'q': query,
    }

    try:
        response = await client.get(
            GOOGLE_SUGGEST_URL,
            params=params,
            headers=ua_rotator.get_headers(),
            timeout=10.0,
        )

        if response.status_code != 200:
            return []

        # Parse XML response
        root = ET.fromstring(response.text)
        suggestions = []
        for suggestion in root.iter('suggestion'):
            data = suggestion.get('data', '').strip()
            if data:
                suggestions.append(data)

        return suggestions

    except (httpx.HTTPError, ET.ParseError, Exception):
        return []


async def extract_google_suggestions(
    seed_keyword: str,
    language: str = 'en',
    expand_alphabet: bool = True,
    max_total: int | None = None,
) -> list[dict]:
    """
    Extract Google Autocomplete suggestions for a seed keyword.

    Uses the "alphabet expansion" technique: queries like
    "roi calculator a", "roi calculator b", etc. to get broader coverage.

    Args:
        seed_keyword: The base keyword to expand (e.g., "roi calculator")
        language: Language code for results
        expand_alphabet: Whether to run a-z expansion queries
        max_total: Maximum total suggestions to return

    Returns:
        List of dicts with 'keyword', 'source', 'keyword_type', 'search_intent'
    """
    max_total = max_total or config.MAX_SUGGESTIONS_PER_SEED

    # Check cache first
    cached = cache_manager.get('google_suggest', seed_keyword, language)
    if cached is not None:
        return cached[:max_total]

    all_suggestions: set[str] = set()

    async with httpx.AsyncClient(follow_redirects=True) as client:
        # Base query
        base_results = await _fetch_suggestions(client, seed_keyword, language)
        all_suggestions.update(base_results)

        # Alphabet expansion
        if expand_alphabet and len(all_suggestions) < max_total:
            alphabet = 'abcdefghijklmnopqrstuvwxyz'
            expansion_queries = [f"{seed_keyword} {letter}" for letter in alphabet]

            for query in expansion_queries:
                if len(all_suggestions) >= max_total:
                    break
                results = await _fetch_suggestions(client, query, language)
                all_suggestions.update(results)

        # Question-prefix expansion
        question_prefixes = ['how to', 'what is', 'best', 'free', 'online']
        for prefix in question_prefixes:
            if len(all_suggestions) >= max_total:
                break
            results = await _fetch_suggestions(client, f"{prefix} {seed_keyword}", language)
            all_suggestions.update(results)

    # Filter out the seed keyword itself and clean up
    cleaned = _clean_and_classify(seed_keyword, all_suggestions, language)

    # Cache the results
    cache_manager.set('google_suggest', seed_keyword, cleaned, language)

    return cleaned[:max_total]


def _clean_and_classify(
    seed: str,
    suggestions: set[str],
    language: str,
) -> list[dict]:
    """
    Clean suggestions and classify their search intent.
    """
    results = []
    seed_lower = seed.lower()

    for suggestion in sorted(suggestions):
        s_lower = suggestion.lower().strip()

        # Skip exact match of seed
        if s_lower == seed_lower:
            continue

        # Skip very short suggestions (< 3 chars)
        if len(s_lower) < 3:
            continue

        # Classify intent
        intent = _classify_intent(s_lower)

        results.append({
            'keyword': suggestion.strip(),
            'keyword_type': 'autocomplete',
            'search_intent': intent,
            'source': 'google_suggest',
            'confidence_score': _calculate_confidence(s_lower, seed_lower),
            'language': language,
        })

    # Sort by confidence (highest first)
    results.sort(key=lambda x: x['confidence_score'], reverse=True)
    return results


def _classify_intent(keyword: str) -> str:
    """
    Classify the search intent of a keyword.

    Categories: informational, transactional, navigational, commercial
    """
    informational_signals = [
        'how to', 'what is', 'why', 'when', 'where', 'who',
        'tutorial', 'guide', 'learn', 'example', 'meaning',
        'definition', 'explain', 'difference between', 'vs',
    ]
    transactional_signals = [
        'free', 'online', 'download', 'tool', 'calculator',
        'converter', 'generator', 'create', 'make', 'build',
    ]
    commercial_signals = [
        'best', 'top', 'review', 'alternative', 'comparison',
        'pricing', 'cost', 'cheap', 'premium', 'professional',
    ]

    for signal in informational_signals:
        if signal in keyword:
            return 'informational'

    for signal in commercial_signals:
        if signal in keyword:
            return 'commercial'

    for signal in transactional_signals:
        if signal in keyword:
            return 'transactional'

    return 'informational'  # Default


def _calculate_confidence(suggestion: str, seed: str) -> float:
    """
    Calculate a confidence score (0.0 to 1.0) for how relevant
    a suggestion is to the seed keyword.
    """
    # Start with a base score
    score = 0.5

    # Bonus if suggestion contains the full seed
    if seed in suggestion:
        score += 0.3

    # Bonus for reasonable length (not too short, not too long)
    word_count = len(suggestion.split())
    if 3 <= word_count <= 7:
        score += 0.1

    # Penalty for very long suggestions (likely navigation)
    if word_count > 10:
        score -= 0.2

    # Bonus for question format (high engagement)
    if suggestion.startswith(('how', 'what', 'why', 'when', 'can')):
        score += 0.1

    return round(min(1.0, max(0.0, score)), 2)
