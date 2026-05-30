"""
Intent Classifier — Re-evaluates and standardizes search intent.

Provides a unified intent classification system for keywords from all sources
(informational, transactional, commercial, navigational).
"""

def classify_intent(keyword: str, fallback_intent: str = 'informational') -> str:
    """
    Classify search intent based on strong n-gram signals.
    """
    kw_lower = keyword.lower()
    
    signals = {
        'informational': [
            'how', 'what', 'why', 'when', 'where', 'who', 'is', 'are', 'can', 'do',
            'guide', 'tutorial', 'example', 'meaning', 'definition', 'explain',
            'difference', 'vs', 'versus', 'learn', 'understand'
        ],
        'transactional': [
            'free', 'online', 'download', 'tool', 'calculator', 'converter',
            'generator', 'create', 'make', 'build', 'software', 'app',
            'format', 'parse', 'extract', 'compress'
        ],
        'commercial': [
            'best', 'top', 'review', 'alternative', 'comparison', 'pricing',
            'cost', 'cheap', 'premium', 'professional', 'buy', 'service',
            'agency', 'consultant'
        ],
        'navigational': [
            'login', 'signin', 'account', 'support', 'contact', 'help',
            'toolshub', 'onlinefreeconverter'
        ]
    }
    
    # Check for exact matches or prefix/suffix matches of signals
    words = set(kw_lower.split())
    
    # 1. Navigational is usually unambiguous
    for signal in signals['navigational']:
        if signal in words or signal in kw_lower:
            return 'navigational'
            
    # 2. Informational (Question words are very strong signals)
    for signal in signals['informational']:
        if kw_lower.startswith(f"{signal} ") or f" {signal} " in kw_lower:
            return 'informational'
            
    # 3. Commercial (Buying intent)
    for signal in signals['commercial']:
        if signal in words:
            return 'commercial'
            
    # 4. Transactional (Action intent)
    for signal in signals['transactional']:
        if signal in words:
            return 'transactional'
            
    return fallback_intent

def batch_classify(keywords: list[dict]) -> list[dict]:
    """Apply intent classification to a batch of keywords in place."""
    for kw_dict in keywords:
        raw = kw_dict.get('keyword', '')
        current = kw_dict.get('search_intent')
        kw_dict['search_intent'] = classify_intent(raw, current or 'informational')
    return keywords
