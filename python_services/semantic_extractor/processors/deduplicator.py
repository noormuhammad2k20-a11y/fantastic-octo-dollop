"""
Deduplicator — Cleans and deduplicates keyword lists.

Normalizes keywords and removes duplicates while keeping the version
with the highest confidence score or from the most reliable source.
"""

import re
import difflib

def deduplicate_keywords(keywords: list[dict], similarity_threshold: float = 0.85) -> list[dict]:
    """
    Deduplicate a list of keyword dictionaries.
    
    Args:
        keywords: List of keyword dicts
        similarity_threshold: Fuzzy match threshold (0.0 to 1.0)
        
    Returns:
        Cleaned, deduplicated list.
    """
    if not keywords:
        return []
        
    # Sort by confidence score (highest first) so we keep the best versions
    sorted_kws = sorted(
        keywords, 
        key=lambda k: k.get('confidence_score', 0.5), 
        reverse=True
    )
    
    unique_results = []
    seen_normalized = set()
    
    for kw_dict in sorted_kws:
        raw_kw = kw_dict.get('keyword', '')
        if not raw_kw:
            continue
            
        # Normalize: lower, remove punctuation, single spaces
        norm_kw = re.sub(r'[^\w\s]', '', raw_kw.lower())
        norm_kw = re.sub(r'\s+', ' ', norm_kw).strip()
        
        if not norm_kw:
            continue
            
        # Exact match check
        if norm_kw in seen_normalized:
            continue
            
        # Fuzzy match check against already accepted unique keywords
        is_duplicate = False
        for accepted in unique_results:
            accepted_norm = re.sub(r'[^\w\s]', '', accepted['keyword'].lower())
            accepted_norm = re.sub(r'\s+', ' ', accepted_norm).strip()
            
            # Use SequenceMatcher for fuzzy comparison
            ratio = difflib.SequenceMatcher(None, norm_kw, accepted_norm).ratio()
            
            if ratio >= similarity_threshold:
                # E.g. "roi calculator" and "roi calculators"
                is_duplicate = True
                break
                
        if not is_duplicate:
            seen_normalized.add(norm_kw)
            unique_results.append(kw_dict)
            
    return unique_results
