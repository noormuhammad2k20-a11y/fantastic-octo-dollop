<?php

namespace App\Services\Seo;

use Illuminate\Support\Collection;

class InternalLinkingService
{
    /**
     * Find related tools based on slug patterns.
     */
    public function findRelatedTools(string $slug, Collection $allTools): Collection
    {
        $parts    = explode('-', $slug);
        $category = $this->detectCategoryFromSlug($parts);

        return $allTools
            ->filter(fn($t) => $t->tool_slug !== $slug)
            ->map(function($t) use ($slug, $parts, $category) {
                $tParts    = explode('-', $t->tool_slug);
                $tCategory = $this->detectCategoryFromSlug($tParts);
                $score     = 0;

                // Same category = high relevance
                if ($category === $tCategory && $category !== 'general') {
                    $score += 40;
                }

                // Shared slug tokens
                $shared = count(array_intersect($parts, $tParts));
                $score += ($shared * 15);

                // Both are same type (calculator, generator, etc.)
                $types = ['calculator', 'generator', 'converter', 'checker'];
                foreach ($types as $type) {
                    if (in_array($type, $parts) && in_array($type, $tParts)) {
                        $score += 10;
                        break;
                    }
                }

                $t->score = $score;
                return $t;
            })
            ->filter(fn($t) => $t->score >= 25) // Minimum relevance threshold
            ->sortByDesc('score');
    }

    /**
     * Detect category from slug tokens.
     */
    private function detectCategoryFromSlug(array $parts): string
    {
        $finance   = ['roi', 'mortgage', 'loan', 'interest', 'tax', 'salary', 'profit',
                      'margin', 'cagr', 'vat', 'budget', 'revenue', 'savings', 'credit'];
        $health    = ['bmi', 'calorie', 'bmr', 'weight', 'blood', 'body', 'protein', 'water'];
        $developer = ['json', 'base64', 'jwt', 'hash', 'md5', 'sha', 'regex', 'url', 'html', 'css'];
        $math      = ['percentage', 'fraction', 'derivative', 'probability', 'prime', 'algebra'];
        $physics   = ['velocity', 'force', 'energy', 'momentum', 'ohm', 'torque', 'pressure'];

        foreach ($parts as $p) {
            if (in_array($p, $finance)) return 'finance';
            if (in_array($p, $health)) return 'health';
            if (in_array($p, $developer)) return 'developer';
            if (in_array($p, $math)) return 'math';
            if (in_array($p, $physics)) return 'physics';
        }
        return 'general';
    }

    /**
     * Generate descriptive anchor texts based on target slug pattern.
     */
    public function generateAnchors(string $source, string $target): array
    {
        $targetName = ucwords(str_replace('-', ' ', $target));
        $targetParts = explode('-', $target);

        // Generate descriptive, non-generic anchor text
        $isCalculator = in_array('calculator', $targetParts);
        $isConverter  = in_array('converter', $targetParts);
        $isGenerator  = in_array('generator', $targetParts);

        $concept = implode(' ', array_filter($targetParts, fn($p) =>
            !in_array($p, ['calculator', 'converter', 'generator', 'checker', 'pro', 'online'])
        ));
        $conceptName = ucwords($concept);

        $anchors = match(true) {
            $isCalculator => [
                "calculate {$conceptName}",
                "{$conceptName} calculation tool",
                "use our {$targetName}",
            ],
            $isConverter => [
                "convert {$conceptName}",
                "{$conceptName} conversion",
                "{$targetName} tool",
            ],
            $isGenerator => [
                "generate {$conceptName}",
                "{$conceptName} generator tool",
                "create {$conceptName} online",
            ],
            default => [
                $targetName,
                "use {$targetName}",
                "{$conceptName} tool",
            ]
        };

        return array_map('trim', $anchors);
    }
}
