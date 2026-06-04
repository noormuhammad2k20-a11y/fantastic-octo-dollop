<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Content Draft — AI-generated content awaiting human review.
 *
 * Supports full articles, FAQ sections, intro paragraphs, and schema FAQs.
 * Tracks the AI model used, word count, SEO score, and review status.
 */
class ContentDraft extends Model
{
    protected $fillable = [
        'tool_slug',
        'draft_type',
        'status',
        'outline_json',
        'draft_content',
        'ai_model_used',
        'generation_prompt_hash',
        'word_count',
        'seo_score',
        'reviewed_by',
        'reviewed_at',
        'published_at',
        'language',
        'locale_data',
    ];

    protected $casts = [
        'outline_json' => 'array',
        'locale_data'  => 'array',
        'word_count'   => 'integer',
        'seo_score'    => 'integer',
        'reviewed_at'  => 'datetime',
        'published_at' => 'datetime',
    ];

    // v13: Invalidate page cache when a draft is approved
    protected static function boot()
    {
        parent::boot();
        static::updated(function ($draft) {
            if ($draft->isDirty('status') && $draft->status === 'approved') {
                \Illuminate\Support\Facades\Cache::forget("tool_draft:{$draft->tool_slug}");
                \Illuminate\Support\Facades\Cache::forget("tool_kw:{$draft->tool_slug}");
            }
        });
    }

    // ─── Scopes ──────────────────────────────────────────────────

    /**
     * Filter by tool slug.
     */
    public function scopeForTool($query, string $slug)
    {
        return $query->where('tool_slug', $slug);
    }

    /**
     * Pending human review.
     */
    public function scopePendingReview($query)
    {
        return $query->where('status', 'pending_review');
    }

    /**
     * Approved and ready for publishing.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Already published.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Filter by draft type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('draft_type', $type);
    }

    /**
     * Filter by language.
     */
    public function scopeForLanguage($query, string $language = 'en')
    {
        return $query->where('language', $language);
    }

    // ─── Helpers ─────────────────────────────────────────────────

    /**
     * Check if this draft has been reviewed by a human.
     */
    public function getIsReviewedAttribute(): bool
    {
        return !is_null($this->reviewed_at);
    }

    /**
     * Get the quality tier based on SEO score.
     */
    public function getQualityTierAttribute(): string
    {
        if (is_null($this->seo_score)) return 'unscored';
        if ($this->seo_score >= 80) return 'excellent';
        if ($this->seo_score >= 60) return 'good';
        if ($this->seo_score >= 40) return 'needs_improvement';
        return 'poor';
    }
}
