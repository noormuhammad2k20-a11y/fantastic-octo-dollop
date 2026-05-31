<?php

namespace App\Services\Seo;

use Illuminate\Support\Collection;

class InternalLinkingService
{
    /**
     * Find related tools based on slug patterns with improved category detection.
     * 
     * FIXED: Previously matched raw slug tokens including stop words like "per", "to", "from"
     * which caused cross-category matches (e.g., "at-bats-per-home-run-calculator" → "price-per-unit-calculator").
     * Now filters out stop words and applies cross-category penalties.
     */
    public function findRelatedTools(string $slug, Collection $allTools): Collection
    {
        $parts    = explode('-', $slug);
        $category = $this->detectCategoryFromSlug($parts);

        // Extract meaningful concept words (exclude common connectors and tool types)
        $stopWords = ['calculator', 'converter', 'generator', 'checker', 'tester',
                      'formatter', 'encoder', 'decoder', 'pro', 'advanced', 'online',
                      'free', 'tool', 'per', 'and', 'to', 'from', 'of', 'the', 'a',
                      'home', 'run', 'one', 'max', 'age', 'game', 'trade'];

        $conceptWords = array_filter($parts, fn($p) => !in_array($p, $stopWords) && strlen($p) > 2);

        return $allTools
            ->filter(fn($t) => $t->tool_slug !== $slug)
            ->map(function($t) use ($parts, $category, $conceptWords, $stopWords) {
                $tParts    = explode('-', $t->tool_slug);
                $tCategory = $this->detectCategoryFromSlug($tParts);
                $tConcepts = array_filter($tParts, fn($p) => !in_array($p, $stopWords) && strlen($p) > 2);

                $score = 0;

                // Same category = relevance (but only if category is specific, not 'general')
                if ($category !== 'general' && $category === $tCategory) {
                    $score += 40;
                }

                // Shared CONCEPT words (not stop words)
                $sharedConcepts = count(array_intersect(
                    array_values($conceptWords),
                    array_values($tConcepts)
                ));
                $score += ($sharedConcepts * 20);

                // Both same tool type
                $types = ['calculator', 'converter', 'generator', 'checker'];
                $sourceType = null;
                $targetType = null;
                foreach ($types as $type) {
                    if (in_array($type, $parts)) $sourceType = $type;
                    if (in_array($type, $tParts)) $targetType = $type;
                }
                if ($sourceType && $sourceType === $targetType) $score += 10;

                // PENALTY: cross-category links (sports tool → finance tool = bad)
                if ($category !== 'general' && $tCategory !== 'general' && $category !== $tCategory) {
                    $score -= 30; // Heavy penalty for cross-category
                }

                $t->score = $score;
                return $t;
            })
            ->filter(fn($t) => $t->score >= 35) // RAISED threshold from 25 to 35
            ->sortByDesc('score');
    }

    /**
     * Detect category from slug tokens.
     * 
     * FIXED: Added sports, chemistry, converter, generator, and text categories.
     * Previously only had finance, health, developer, math, physics — causing sports
     * tools to fall into 'general' and get cross-linked to unrelated tools.
     */
    private function detectCategoryFromSlug(array $parts): string
    {
        $sports    = ['baseball', 'basketball', 'football', 'soccer', 'cricket', 'golf',
                      'tennis', 'swimming', 'cycling', 'marathon', 'triathlon', 'bowling',
                      'era', 'fip', 'ops', 'war', 'whip', 'bats', 'rebound',
                      'usage', 'pace', 'splits', 'season', 'mtg', 'pokemon',
                      'palworld', 'fantasy', 'drafts', 'bench', 'rep',
                      'strength', 'vo2', 'batting', 'bowling', 'marathon'];
        $finance   = ['roi', 'mortgage', 'loan', 'interest', 'investment', 'tax', 'salary',
                      'profit', 'margin', 'cagr', 'vat', 'budget', 'finance', 'revenue',
                      'amortization', 'savings', 'credit', 'debt', 'equity', 'dividend',
                      'stock', 'bond', 'crypto', 'roas', 'cpc', 'cpm', 'ebitda', 'wacc',
                      'capm', 'roe', 'roa', 'broke', 'capital', 'cash', 'income'];
        $health    = ['bmi', 'calorie', 'bmr', 'weight', 'blood', 'body', 'protein',
                      'water', 'pregnancy', 'diabetes', 'fitness', 'health', 'heart',
                      'sleep', 'macro', 'tdee', 'keto', 'bac', 'anc', 'bsa', 'gfr',
                      'fena', 'age', 'lean', 'fat', 'waist', 'hip', 'height'];
        $developer = ['json', 'base64', 'jwt', 'hash', 'md5', 'sha', 'regex', 'url',
                      'html', 'css', 'cron', 'curl', 'htaccess', 'encode', 'decode',
                      'sql', 'yaml', 'xml', 'markdown', 'uuid', 'ip', 'subnet', 'ascii',
                      'unicode', 'password', 'token', 'sitemap', 'robots', 'schema'];
        $math      = ['percentage', 'fraction', 'derivative', 'integral', 'probability',
                      'matrix', 'prime', 'factorial', 'algebra', 'geometry', 'calculus',
                      'statistics', 'mean', 'median', 'mode', 'variance', 'deviation',
                      'regression', 'logarithm', 'log', 'exponent', 'quadratic', 'slope'];
        $physics   = ['velocity', 'force', 'energy', 'momentum', 'ohm', 'torque',
                      'pressure', 'density', 'wavelength', 'acceleration', 'power',
                      'gravity', 'friction', 'voltage', 'current', 'resistance', 'capacitance'];
        $chemistry = ['molar', 'molarity', 'ph', 'chemical', 'equation', 'boiling',
                      'titration', 'stoichiometry', 'empirical', 'reaction', 'solution'];
        $converter = ['acres', 'hectares', 'feet', 'inches', 'meters', 'miles', 'km',
                      'kg', 'pounds', 'grams', 'ounces', 'liters', 'gallons', 'celsius',
                      'fahrenheit', 'bytes', 'mb', 'gb', 'tb'];

        foreach ($parts as $part) {
            if (in_array($part, $sports))    return 'sports';
            if (in_array($part, $finance))   return 'finance';
            if (in_array($part, $health))    return 'health';
            if (in_array($part, $developer)) return 'developer';
            if (in_array($part, $math))      return 'math';
            if (in_array($part, $physics))   return 'physics';
            if (in_array($part, $chemistry)) return 'chemistry';
            if (in_array($part, $converter)) return 'converter';
        }
        return 'general';
    }

    /**
     * Generate descriptive anchor texts based on target slug pattern.
     */
    public function generateAnchors(string $source, string $target): array
    {
        $targetParts  = explode('-', $target);
        $targetName   = ucwords(str_replace('-', ' ', $target)); // e.g. "Era Calculator"

        // Detect acronyms that should stay uppercase
        $acronyms = ['era', 'fip', 'ops', 'war', 'whip', 'roi', 'bmi', 'cagr', 'vat',
                     'apr', 'apy', 'rpm', 'url', 'html', 'css', 'json', 'jwt', 'md5',
                     'sha', 'sql', 'xml', 'api', 'isbn', 'isin', 'gpa', 'gre', 'sat'];

        $isCalculator = in_array('calculator', $targetParts);
        $isConverter  = in_array('converter',  $targetParts);
        $isGenerator  = in_array('generator',  $targetParts);

        $stopWords = ['calculator','converter','generator','checker','tester',
                      'formatter','encoder','decoder','pro','advanced','online',
                      'free','tool','per','and','to','from','of','the','a'];

        $conceptParts = array_filter($targetParts, fn($p) => !in_array($p, $stopWords));

        // Convert concept words — uppercase acronyms, ucfirst others
        $conceptWords = array_map(function($word) use ($acronyms) {
            return in_array($word, $acronyms) ? strtoupper($word) : ucfirst($word);
        }, array_values($conceptParts));

        $concept = implode(' ', $conceptWords);

        // Build anchors
        $anchors = match (true) {
            $isCalculator => [
                "calculate {$concept}",
                "{$concept} Calculator",
                "use the {$targetName}",
            ],
            $isConverter  => [
                "convert {$concept}",
                "{$concept} Converter",
                "{$targetName} Tool",
            ],
            $isGenerator  => [
                "generate {$concept}",
                "{$concept} Generator",
                "create {$concept} online",
            ],
            default       => [
                $targetName,
                "use {$targetName}",
                "{$concept} Tool",
            ],
        };

        return array_map('trim', $anchors);
    }
}
