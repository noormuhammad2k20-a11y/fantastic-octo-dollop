<?php

namespace App\Services;

use Illuminate\Support\Collection;

class CrossLinkerService
{
    /**
     * Cross-category link mapping.
     * Key: current tool's category
     * Values: categories to pull "You might also need" tools from
     */
    private array $crossMap = [
        'finance'          => ['investment', 'business', 'real-estate', 'finance-tax'],
        'finance-tax'      => ['finance', 'investment', 'business', 'legal'],
        'investment'       => ['finance', 'finance-tax', 'business', 'real-estate'],
        'health'           => ['medical', 'kitchen', 'lifestyle', 'sports'],
        'medical'          => ['health', 'science', 'lifestyle'],
        'math'             => ['statistics', 'algebra', 'geometry', 'calculators'],
        'mathematics'      => ['math', 'algebra', 'statistics', 'geometry'],
        'calculators'      => ['unit-converter', 'math', 'science', 'converters'],
        'algebra'          => ['math', 'geometry', 'statistics', 'fractions'],
        'geometry'         => ['math', 'algebra', 'construction', 'engineering'],
        'statistics'       => ['math', 'probability', 'business', 'stats'],
        'stats'            => ['statistics', 'probability', 'math'],
        'probability'      => ['statistics', 'math', 'gaming'],
        'fractions'        => ['math', 'algebra', 'calculators'],
        'linear-algebra'   => ['math', 'algebra', 'statistics'],
        'business'         => ['finance', 'marketing', 'productivity', 'investment'],
        'science'          => ['physics', 'engineering', 'math', 'electronics'],
        'physics'          => ['science', 'engineering', 'math', 'electronics'],
        'engineering'      => ['construction', 'science', 'physics', 'electronics'],
        'construction'     => ['engineering', 'real-estate', 'hobbies'],
        'webmaster'        => ['web-seo-tools', 'tech', 'generators', 'security'],
        'web-seo-tools'    => ['webmaster', 'marketing', 'tech', 'generators'],
        'text'             => ['generators', 'ai-content', 'name-generator'],
        'generators'       => ['text', 'ai-content', 'name-generator', 'security'],
        'ai-content'       => ['text', 'generators', 'name-generator', 'marketing'],
        'name-generator'   => ['generators', 'text', 'ai-content'],
        'astrology'        => ['lifestyle', 'generators', 'randomness'],
        'lifestyle'        => ['health', 'kitchen', 'hobbies', 'pets'],
        'kitchen'          => ['health', 'lifestyle', 'unit-converter'],
        'hobbies'          => ['lifestyle', 'gaming', 'pets', 'kitchen'],
        'pets'             => ['hobbies', 'lifestyle', 'health'],
        'gaming'           => ['randomness', 'hobbies', 'probability'],
        'randomness'       => ['gaming', 'generators', 'probability', 'security'],
        'security'         => ['webmaster', 'tech', 'generators'],
        'unit-converter'   => ['converters', 'calculators', 'science'],
        'converters'       => ['unit-converter', 'calculators', 'file-converters'],
        'file-converters'  => ['converters', 'utility', 'tech'],
        'real-estate'      => ['finance', 'investment', 'construction'],
        'marketing'        => ['business', 'web-seo-tools', 'ai-content', 'social'],
        'social'           => ['marketing', 'ai-content', 'generators'],
        'productivity'     => ['business', 'tech', 'utility'],
        'tech'             => ['webmaster', 'security', 'electronics'],
        'electronics'      => ['engineering', 'science', 'physics', 'tech'],
        'automotive'       => ['engineering', 'finance', 'unit-converter'],
        'sports'           => ['health', 'gaming', 'lifestyle'],
        'legal'            => ['finance', 'business', 'finance-tax'],
        'crypto'           => ['finance', 'investment', 'tech'],
        'utility'          => ['generators', 'converters', 'text'],
        'date-time'        => ['calculators', 'utility', 'productivity'],
        'volume'           => ['unit-converter', 'converters', 'kitchen'],
    ];

    /**
     * Get cross-category tools for a given tool (max $limit).
     */
    public function getCrossLinks(array $tool, int $limit = 3): Collection
    {
        $category = $tool['category'] ?? '';
        $relatedCategories = $this->crossMap[$category] ?? [];

        if (empty($relatedCategories)) {
            return collect();
        }

        $allTools = collect(config('tools.tools', []))
                      ->merge(config('pro_calculators', []));

        return $allTools
            ->filter(function ($t) use ($relatedCategories) {
                return in_array($t['category'] ?? '', $relatedCategories);
            })
            ->where('slug', '!=', $tool['slug'] ?? '')
            ->shuffle()
            ->take($limit);
    }
}
