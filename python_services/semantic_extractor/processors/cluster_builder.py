"""
Cluster Builder — Groups keywords into semantic clusters.

Basic implementation that groups keywords by shared bigrams/trigrams
to form semantic sub-clusters around a main seed topic.
"""

from collections import defaultdict
import re

def build_clusters(keywords: list[dict], min_cluster_size: int = 3) -> dict:
    """
    Group keywords into semantic clusters based on shared terms.
    
    Args:
        keywords: List of keyword dicts
        min_cluster_size: Minimum number of keywords to form a distinct cluster
        
    Returns:
        Dict mapping cluster name -> list of keywords
    """
    if not keywords:
        return {}
        
    # Dictionary mapping term -> list of keywords containing that term
    term_index = defaultdict(list)
    
    # Common stop words to ignore for clustering
    stop_words = {'how', 'to', 'what', 'is', 'the', 'a', 'an', 'in', 'for', 'of', 'and', 'or', 'with', 'by'}
    
    for kw_dict in keywords:
        raw_kw = kw_dict.get('keyword', '').lower()
        words = re.findall(r'\b[a-z]{3,}\b', raw_kw)  # Only words 3+ chars
        
        # Filter stop words
        significant_words = [w for w in words if w not in stop_words]
        
        # Group by single significant words
        for word in significant_words:
            term_index[word].append(kw_dict)
            
        # Group by bigrams
        for i in range(len(significant_words) - 1):
            bigram = f"{significant_words[i]} {significant_words[i+1]}"
            term_index[bigram].append(kw_dict)
            
    # Filter and sort clusters
    clusters = {}
    assigned_keywords = set()
    
    # Sort terms by number of keywords they group (largest clusters first)
    # But prioritize bigrams over unigrams for more specific cluster names
    sorted_terms = sorted(
        term_index.items(),
        key=lambda x: (len(x[1]), len(x[0].split())),
        reverse=True
    )
    
    for term, group in sorted_terms:
        if len(group) < min_cluster_size:
            continue
            
        # Only keep keywords that haven't been assigned to a larger/better cluster yet
        unassigned = [kw for kw in group if kw['keyword'] not in assigned_keywords]
        
        if len(unassigned) >= min_cluster_size:
            cluster_name = term.title()
            clusters[cluster_name] = unassigned
            for kw in unassigned:
                assigned_keywords.add(kw['keyword'])
                
    # Group remaining keywords into an "Other" or "Misc" cluster
    misc = [kw for kw in keywords if kw['keyword'] not in assigned_keywords]
    if misc:
        clusters["General Topics"] = misc
        
    return clusters
