"""
Entity Extractor — Extracts named entities and semantic tokens from tool metadata.

Uses simple NLP heuristics (no external models required) to identify
key entities, topics, and semantic relationships from tool names,
descriptions, and content.
"""

import re
from collections import Counter


# Domain-specific entity categories for ToolsHub
ENTITY_CATEGORIES = {
    'format': [
        'pdf', 'csv', 'json', 'xml', 'html', 'yaml', 'toml', 'svg', 'png',
        'jpg', 'jpeg', 'gif', 'webp', 'avif', 'bmp', 'tiff', 'ico', 'mp4',
        'mp3', 'wav', 'avi', 'mkv', 'mov', 'flac', 'ogg', 'heic', 'heif',
        'docx', 'xlsx', 'pptx', 'txt', 'rtf', 'markdown', 'md',
    ],
    'action': [
        'convert', 'compress', 'resize', 'crop', 'merge', 'split', 'extract',
        'generate', 'calculate', 'analyze', 'validate', 'format', 'encode',
        'decode', 'encrypt', 'decrypt', 'hash', 'minify', 'beautify',
        'optimize', 'transform', 'parse', 'compare', 'download',
    ],
    'domain': [
        'finance', 'health', 'math', 'science', 'engineering', 'business',
        'real estate', 'medical', 'legal', 'sports', 'cooking', 'fitness',
        'investment', 'tax', 'mortgage', 'loan', 'crypto', 'insurance',
        'automotive', 'construction', 'electronics', 'chemistry', 'physics',
    ],
    'tool_type': [
        'calculator', 'converter', 'generator', 'checker', 'validator',
        'analyzer', 'formatter', 'encoder', 'decoder', 'compressor',
        'optimizer', 'solver', 'estimator', 'planner', 'tracker',
    ],
    'platform': [
        'online', 'free', 'mobile', 'desktop', 'browser', 'web',
        'mac', 'windows', 'ios', 'android', 'linux',
    ],
}


def extract_entities(
    tool_name: str,
    tool_description: str = '',
    tool_category: str = '',
    tool_h1: str = '',
) -> list[dict]:
    """
    Extract semantic entities from tool metadata.

    Args:
        tool_name: The tool's display name
        tool_description: Meta description or subtitle
        tool_category: Category slug
        tool_h1: H1 heading text

    Returns:
        List of entity dicts with 'keyword', 'keyword_type', 'source', etc.
    """
    # Combine all text sources
    combined = f"{tool_name} {tool_h1} {tool_description} {tool_category}"
    combined_lower = combined.lower()

    entities = []
    seen_keywords = set()

    # 1. Extract category-based entities
    for category, terms in ENTITY_CATEGORIES.items():
        for term in terms:
            if term in combined_lower and term not in seen_keywords:
                entities.append({
                    'keyword': term,
                    'keyword_type': 'entity',
                    'search_intent': _intent_from_category(category),
                    'source': 'entity_extractor',
                    'confidence_score': 0.85,
                    'language': 'en',
                    'meta': {'entity_category': category},
                })
                seen_keywords.add(term)

    # 2. Extract compound phrases (bigrams/trigrams)
    words = re.findall(r'\b[a-z]+\b', combined_lower)
    bigrams = [f"{words[i]} {words[i+1]}" for i in range(len(words) - 1)]
    trigrams = [f"{words[i]} {words[i+1]} {words[i+2]}" for i in range(len(words) - 2)]

    # Count frequency for significance
    phrase_counts = Counter(bigrams + trigrams)
    for phrase, count in phrase_counts.most_common(10):
        if len(phrase) > 5 and phrase not in seen_keywords:
            entities.append({
                'keyword': phrase,
                'keyword_type': 'semantic',
                'search_intent': _classify_phrase_intent(phrase),
                'source': 'entity_extractor',
                'confidence_score': min(0.9, 0.5 + (count * 0.1)),
                'language': 'en',
            })
            seen_keywords.add(phrase)

    # 3. Extract the primary keyword (the tool's core function)
    primary = _extract_primary_keyword(tool_name, tool_h1)
    if primary and primary not in seen_keywords:
        entities.insert(0, {
            'keyword': primary,
            'keyword_type': 'primary',
            'search_intent': 'transactional',
            'source': 'entity_extractor',
            'confidence_score': 0.95,
            'language': 'en',
        })

    return entities


def _extract_primary_keyword(name: str, h1: str) -> str | None:
    """
    Extract the primary keyword from the tool name or H1.
    Usually the tool name without generic suffixes.
    """
    text = (h1 or name).strip()

    # Remove common suffixes
    suffixes = [
        ' — Free Online Tool',
        ' Calculator',
        ' Converter',
        ' Generator',
        ' Tool',
        ' Online',
        ' Free',
    ]
    for suffix in suffixes:
        if text.lower().endswith(suffix.lower()):
            text = text[:-len(suffix)].strip()

    return text.lower() if text else None


def _intent_from_category(category: str) -> str:
    """Map entity category to likely search intent."""
    return {
        'format': 'transactional',
        'action': 'transactional',
        'domain': 'informational',
        'tool_type': 'transactional',
        'platform': 'commercial',
    }.get(category, 'informational')


def _classify_phrase_intent(phrase: str) -> str:
    """Simple intent classification for extracted phrases."""
    informational = ['how to', 'what is', 'guide', 'tutorial', 'example']
    transactional = ['free', 'online', 'tool', 'calculate', 'convert']

    for signal in informational:
        if signal in phrase:
            return 'informational'
    for signal in transactional:
        if signal in phrase:
            return 'transactional'

    return 'informational'
