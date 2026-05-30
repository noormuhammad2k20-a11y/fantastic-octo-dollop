<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Semantic Keyword — Extracted keywords/phrases for a tool.
 *
 * Sources include Google Autocomplete, PAA, pytrends, entities, etc.
 * Classified by keyword type and search intent.
 */
class SemanticKeyword extends Model
{
    protected $fillable = [
        'tool_slug',
        'keyword',
        'keyword_type',
        'search_intent',
        'source',
        'confidence_score',
        'is_active',
        'language',
        'locale_data',
        'extracted_at',
    ];

    protected $casts = [
        'confidence_score' => 'decimal:2',
        'is_active'        => 'boolean',
        'locale_data'      => 'array',
        'extracted_at'     => 'datetime',
    ];

    // ─── Scopes ──────────────────────────────────────────────────

    /**
     * Filter by tool slug.
     */
    public function scopeForTool($query, string $slug)
    {
        return $query->where('tool_slug', $slug);
    }

    /**
     * Only active keywords.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Filter by keyword type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('keyword_type', $type);
    }

    /**
     * Filter by search intent.
     */
    public function scopeWithIntent($query, string $intent)
    {
        return $query->where('search_intent', $intent);
    }

    /**
     * Filter by source (e.g., 'google_suggest', 'paa', 'pytrends').
     */
    public function scopeFromSource($query, string $source)
    {
        return $query->where('source', $source);
    }

    /**
     * Filter by language.
     */
    public function scopeForLanguage($query, string $language = 'en')
    {
        return $query->where('language', $language);
    }

    /**
     * High-confidence keywords.
     */
    public function scopeHighConfidence($query, float $threshold = 0.7)
    {
        return $query->where('confidence_score', '>=', $threshold);
    }
}
