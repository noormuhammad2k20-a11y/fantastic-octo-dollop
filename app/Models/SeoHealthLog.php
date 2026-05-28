<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoHealthLog extends Model
{
    protected $fillable = [
        'tool_slug',
        'url',
        'seo_score',
        'index_status',
        'page_speed_score',
        'fcp',
        'lcp',
        'tbt',
        'issues',
        'meta_data',
        'checked_at',
    ];

    protected $casts = [
        'issues' => 'array',
        'meta_data' => 'array',
        'checked_at' => 'datetime',
    ];

    /**
     * Get human-readable recommendations based on issues.
     */
    public function getRecommendationsAttribute()
    {
        if (empty($this->issues)) {
            return ["Everything looks perfect!"];
        }

        $recommendations = [];
        foreach ($this->issues as $issue) {
            $recommendations[] = match ($issue) {
                'missing_title' => 'Add a <title> tag between 50-60 characters.',
                'title_too_short' => 'Title is too short. Aim for 50-60 chars.',
                'title_too_long' => 'Title is too long. Aim for 50-60 chars.',
                'missing_description' => 'Add a <meta name="description"> between 120-160 characters.',
                'description_too_short' => 'Description is too short. Aim for 120-160 chars.',
                'description_too_long' => 'Description is too long. Aim for 120-160 chars.',
                'missing_canonical' => 'Add a <link rel="canonical"> tag to prevent duplicate content.',
                'noindex_detected' => 'The page has a "noindex" tag. Remove it if you want the page to be indexed.',
                'missing_h1' => 'Missing H1 tag. Every page should have exactly one H1.',
                'multiple_h1' => 'Multiple H1 tags detected. Only one H1 is recommended per page.',
                'missing_alt_tags' => 'Some images are missing ALT attributes. Add them for better accessibility and SEO.',
                'missing_og_tags' => 'Missing Open Graph tags (og:title, og:description). These improve social sharing.',
                'missing_json_ld' => 'Missing Structured Data (JSON-LD). This helps search engines understand your tool.',
                'missing_viewport' => 'Missing viewport meta tag. This is required for mobile-friendliness.',
                'slow_page' => 'Page is slow (> 3s). Optimize JS/CSS or enable lazy loading.',
                'duplicate_title' => 'Duplicate title detected across tools. Each page should have a unique title.',
                'duplicate_description' => 'Duplicate description detected across tools. Each page should have a unique description.',
                default => "SEO Audit Recommendation: {$issue}"
            };
        }

        return $recommendations;
    }
}
