<?php

namespace App\Services\Seo;

/**
 * ToolContextExtractor — The key to unique content.
 *
 * Extracts tool-specific context from a slug so every OpenAI prompt
 * is different, preventing duplicate content across 1400+ tools.
 *
 * Top tools have manually curated context maps. All remaining tools
 * use autoExtract() which detects category, purpose, and user types
 * from the slug pattern.
 */
class ToolContextExtractor
{
    /**
     * Curated context for top tools — extend this for best content quality.
     * The more tools here, the better the generated content.
     */
    private array $toolContextMap = [
        'roi-calculator' => [
            'category'      => 'Finance & Investment',
            'primary_use'   => 'calculate return on investment as a percentage',
            'related_terms' => ['net profit', 'cost of investment', 'profit margin', 'CAGR'],
            'user_types'    => ['investors', 'business owners', 'startup founders', 'financial analysts'],
            'formula'       => 'ROI = ((Net Profit / Cost of Investment) × 100)%',
        ],
        'bmi-calculator' => [
            'category'      => 'Health & Fitness',
            'primary_use'   => 'calculate body mass index from height and weight',
            'related_terms' => ['body fat', 'healthy weight', 'obesity', 'underweight'],
            'user_types'    => ['individuals monitoring health', 'fitness trainers', 'medical students'],
            'formula'       => 'BMI = weight(kg) / height(m)²',
        ],
        'mortgage-calculator' => [
            'category'      => 'Finance & Real Estate',
            'primary_use'   => 'calculate monthly mortgage payments and total interest paid',
            'related_terms' => ['interest rate', 'loan term', 'down payment', 'amortization'],
            'user_types'    => ['homebuyers', 'real estate investors', 'financial advisors'],
            'formula'       => 'M = P[r(1+r)^n]/[(1+r)^n-1] where P=principal, r=monthly rate, n=payments',
        ],
        'percentage-calculator' => [
            'category'      => 'Math & Numbers',
            'primary_use'   => 'calculate percentage of a number, percentage change, and percentage difference',
            'related_terms' => ['percent', 'ratio', 'proportion', 'fraction', 'decimal'],
            'user_types'    => ['students', 'shoppers calculating discounts', 'business analysts'],
            'formula'       => 'Percentage = (Part / Whole) × 100',
        ],
        'compound-interest-calculator' => [
            'category'      => 'Finance & Investment',
            'primary_use'   => 'calculate compound interest growth over time',
            'related_terms' => ['principal', 'interest rate', 'compounding period', 'future value', 'APY'],
            'user_types'    => ['investors', 'savers', 'financial planners', 'students'],
            'formula'       => 'A = P(1 + r/n)^(nt) where P=principal, r=annual rate, n=compounds/year, t=years',
        ],
        'calorie-calculator' => [
            'category'      => 'Health & Fitness',
            'primary_use'   => 'estimate daily calorie needs based on age, weight, height, and activity level',
            'related_terms' => ['TDEE', 'BMR', 'macros', 'caloric deficit', 'weight loss'],
            'user_types'    => ['dieters', 'fitness enthusiasts', 'nutritionists', 'personal trainers'],
            'formula'       => 'BMR (Mifflin-St Jeor): 10×weight(kg) + 6.25×height(cm) - 5×age - 161 (women) or +5 (men)',
        ],
        'json-formatter' => [
            'category'      => 'Developer Tools',
            'primary_use'   => 'format, validate, and beautify JSON data',
            'related_terms' => ['JSON validator', 'pretty print', 'minify', 'parse', 'syntax check'],
            'user_types'    => ['web developers', 'API developers', 'data engineers', 'QA testers'],
            'formula'       => null,
        ],
        'base64-encoder-decoder' => [
            'category'      => 'Developer Tools',
            'primary_use'   => 'encode text to Base64 or decode Base64 strings back to text',
            'related_terms' => ['encoding', 'decoding', 'binary to text', 'data URI', 'MIME'],
            'user_types'    => ['web developers', 'software engineers', 'security researchers'],
            'formula'       => null,
        ],
        'tax-calculator' => [
            'category'      => 'Finance & Business',
            'primary_use'   => 'estimate income tax liability based on earnings and deductions',
            'related_terms' => ['tax bracket', 'deductions', 'taxable income', 'effective rate', 'marginal rate'],
            'user_types'    => ['taxpayers', 'accountants', 'freelancers', 'small business owners'],
            'formula'       => 'Tax = Σ(Income in bracket × Bracket rate) for each tax bracket',
        ],
        'loan-calculator' => [
            'category'      => 'Finance & Banking',
            'primary_use'   => 'calculate monthly loan payments, total interest, and amortization schedule',
            'related_terms' => ['principal', 'interest rate', 'loan term', 'EMI', 'amortization'],
            'user_types'    => ['borrowers', 'financial advisors', 'students', 'homeowners'],
            'formula'       => 'EMI = P × r × (1+r)^n / ((1+r)^n - 1)',
        ],
        'ops-calculator' => [
            'category'      => 'Sports & Baseball Statistics',
            'primary_use'   => 'calculate OPS (On-base Plus Slugging) for baseball players and teams',
            'related_terms' => ['on-base percentage', 'slugging percentage', 'batting average', 'baseball stats', 'OBP', 'SLG'],
            'user_types'    => ['baseball fans', 'fantasy baseball players', 'coaches', 'sports analysts'],
            'formula'       => 'OPS = OBP + SLG (On-Base Percentage + Slugging Percentage)',
        ],
        'era-calculator' => [
            'category'      => 'Sports & Baseball Statistics',
            'primary_use'   => 'calculate ERA (Earned Run Average) for baseball pitchers',
            'related_terms' => ['earned runs', 'innings pitched', 'pitcher performance', 'WHIP', 'FIP', 'baseball'],
            'user_types'    => ['baseball fans', 'fantasy baseball managers', 'coaches', 'sports analysts'],
            'formula'       => 'ERA = (Earned Runs / Innings Pitched) × 9',
        ],
        'fip-calculator' => [
            'category'      => 'Sports & Baseball Statistics',
            'primary_use'   => 'calculate FIP (Fielding Independent Pitching) to measure pitcher skill',
            'related_terms' => ['strikeouts', 'home runs', 'walks', 'hit by pitch', 'ERA', 'baseball analytics'],
            'user_types'    => ['sabermetrics fans', 'fantasy baseball players', 'baseball analysts', 'coaches'],
            'formula'       => 'FIP = ((13×HR + 3×(BB+HBP) - 2×K) / IP) + FIP Constant',
        ],
        'war-calculator' => [
            'category'      => 'Sports & Baseball Statistics',
            'primary_use'   => 'calculate WAR (Wins Above Replacement) for baseball player valuation',
            'related_terms' => ['replacement level', 'player value', 'offensive WAR', 'defensive WAR', 'baseball salary'],
            'user_types'    => ['baseball analysts', 'fantasy baseball players', 'GMs', 'sabermetrics enthusiasts'],
            'formula'       => 'WAR = (Batting Runs + Baserunning Runs + Fielding Runs + Positional Adjustment + League Adjustment + Replacement Runs) / Runs Per Win',
        ],
        'whip-calculator' => [
            'category'      => 'Sports & Baseball Statistics',
            'primary_use'   => 'calculate WHIP (Walks plus Hits per Inning Pitched) for pitchers',
            'related_terms' => ['walks', 'hits allowed', 'innings pitched', 'pitcher efficiency', 'ERA', 'FIP'],
            'user_types'    => ['baseball fans', 'fantasy baseball players', 'coaches', 'sports analysts'],
            'formula'       => 'WHIP = (Walks + Hits) / Innings Pitched',
        ],
        'at-bats-per-home-run-calculator' => [
            'category'      => 'Sports & Baseball Statistics',
            'primary_use'   => 'calculate at-bats per home run ratio for baseball batters',
            'related_terms' => ['home run rate', 'power hitting', 'slugging', 'HR/AB', 'baseball batting stats'],
            'user_types'    => ['baseball fans', 'fantasy baseball players', 'coaches', 'scouts'],
            'formula'       => 'AB/HR = Total At-Bats / Total Home Runs',
        ],
        'bowling-score-calculator' => [
            'category'      => 'Sports & Bowling',
            'primary_use'   => 'calculate bowling scores including strikes, spares, and open frames',
            'related_terms' => ['strike', 'spare', 'open frame', 'perfect game', 'bowling average', 'pin count'],
            'user_types'    => ['bowlers', 'bowling league members', 'coaches', 'recreational players'],
            'formula'       => 'Strike = 10 + next 2 balls | Spare = 10 + next ball | Open = pins knocked down',
        ],
        'rebound-rate-calculator' => [
            'category'      => 'Sports & Basketball Statistics',
            'primary_use'   => 'calculate rebound rate percentage for basketball players',
            'related_terms' => ['offensive rebound', 'defensive rebound', 'total rebound', 'basketball stats', 'PER'],
            'user_types'    => ['basketball fans', 'fantasy basketball players', 'coaches', 'analysts'],
            'formula'       => 'Rebound Rate = 100 × (Rebounds × Team Minutes) / (Minutes × (Team Rebounds + Opponent Rebounds))',
        ],
        'usage-rate-calculator' => [
            'category'      => 'Sports & Basketball Statistics',
            'primary_use'   => 'calculate usage rate to measure how often a basketball player is involved in plays',
            'related_terms' => ['ball possession', 'player involvement', 'field goal attempts', 'turnovers', 'NBA stats'],
            'user_types'    => ['basketball analysts', 'fantasy basketball players', 'coaches', 'scouts'],
            'formula'       => 'Usage Rate = 100 × ((FGA + 0.44×FTA + TOV) × Team Minutes) / (Minutes × (Team FGA + 0.44×Team FTA + Team TOV))',
        ],
        // Add more top tools here for best content quality
    ];

    /**
     * Extract tool-specific context for content generation.
     */
    public function extract(string $slug): array
    {
        // Use predefined context if available
        if (isset($this->toolContextMap[$slug])) {
            $base = $this->toolContextMap[$slug];
            $base['slug']      = $slug;
            $base['tool_name'] = $this->slugToName($slug);
            $base['prompt_used'] = '';
            return $base;
        }

        // Auto-generate context from slug for remaining tools
        return $this->autoExtract($slug);
    }

    /**
     * Auto-extract context from the slug pattern.
     * Works for tools not in the curated map.
     */
    private function autoExtract(string $slug): array
    {
        $name  = $this->slugToName($slug);
        $parts = explode('-', $slug);

        // Detect tool type from slug patterns
        $isCalculator = in_array('calculator', $parts) || in_array('calc', $parts);
        $isConverter  = in_array('converter', $parts) || in_array('to', $parts);
        $isGenerator  = in_array('generator', $parts);
        $isChecker    = in_array('checker', $parts) || in_array('tester', $parts);
        $isFormatter  = in_array('formatter', $parts);

        // Detect category from slug
        $category = $this->detectCategory($parts);

        // Remove type suffixes to get core concept
        $conceptParts = array_filter($parts, fn($p) =>
            !in_array($p, ['calculator', 'converter', 'generator', 'checker',
                           'tester', 'formatter', 'encoder', 'decoder', 'pro',
                           'advanced', 'online', 'free', 'tool'])
        );
        $coreConcept = implode(' ', $conceptParts);

        $primaryUse = match (true) {
            $isCalculator => "calculate {$coreConcept} accurately",
            $isConverter  => "convert {$coreConcept} between units or formats",
            $isGenerator  => "generate {$coreConcept} instantly",
            $isChecker    => "check and validate {$coreConcept}",
            $isFormatter  => "format and beautify {$coreConcept}",
            default       => "work with {$coreConcept} efficiently",
        };

        return [
            'slug'          => $slug,
            'tool_name'     => $name,
            'category'      => $category,
            'primary_use'   => $primaryUse,
            'related_terms' => $this->guessRelatedTerms($coreConcept, $category),
            'user_types'    => $this->guessUserTypes($category),
            'formula'       => null,
            'prompt_used'   => '',
        ];
    }

    /**
     * Convert a slug to a human-readable name.
     */
    private function slugToName(string $slug): string
    {
        return ucwords(str_replace('-', ' ', $slug));
    }

    /**
     * Detect category from slug tokens.
     */
    private function detectCategory(array $parts): string
    {
        $finance   = ['roi', 'mortgage', 'loan', 'interest', 'investment', 'tax', 'salary',
                      'profit', 'margin', 'cagr', 'vat', 'budget', 'finance', 'revenue',
                      'amortization', 'savings', 'credit', 'compound', 'dividend', 'ebitda',
                      'estate', 'inheritance', 'capital', 'passive', 'income'];
        $health    = ['bmi', 'calorie', 'bmr', 'weight', 'blood', 'body', 'protein',
                      'water', 'pregnancy', 'diabetes', 'fitness', 'health', 'dental',
                      'macro', 'heart', 'sleep'];
        $developer = ['json', 'base64', 'jwt', 'hash', 'md5', 'sha', 'regex', 'url',
                      'html', 'css', 'cron', 'curl', 'htaccess', 'encode', 'decode',
                      'xml', 'yaml', 'csv', 'sql', 'api', 'http', 'ip', 'dns'];
        $math      = ['percentage', 'fraction', 'derivative', 'integral', 'probability',
                      'matrix', 'prime', 'factorial', 'algebra', 'geometry', 'calculus',
                      'average', 'mean', 'median', 'standard', 'deviation'];
        $physics   = ['velocity', 'force', 'energy', 'momentum', 'ohm', 'torque',
                      'pressure', 'density', 'wavelength', 'acceleration', 'frequency',
                      'voltage', 'resistance', 'power', 'watt'];
        $chemistry = ['molar', 'molarity', 'ph', 'chemical', 'equation', 'boiling',
                      'molecular', 'atomic', 'concentration'];

        foreach ($parts as $part) {
            if (in_array($part, $finance))   return 'Finance & Business';
            if (in_array($part, $health))    return 'Health & Fitness';
            if (in_array($part, $developer)) return 'Developer Tools';
            if (in_array($part, $math))      return 'Math & Statistics';
            if (in_array($part, $physics))   return 'Physics & Engineering';
            if (in_array($part, $chemistry)) return 'Chemistry & Science';
        }
        return 'General Tools';
    }

    /**
     * Guess related terms by category.
     */
    private function guessRelatedTerms(string $concept, string $category): array
    {
        $categoryTerms = [
            'Finance & Business'    => ['calculation', 'formula', 'financial planning', 'analysis'],
            'Health & Fitness'      => ['health metrics', 'measurement', 'wellness', 'tracking'],
            'Developer Tools'       => ['encoding', 'data format', 'conversion', 'parsing'],
            'Math & Statistics'     => ['equation', 'formula', 'calculation', 'mathematical'],
            'Physics & Engineering' => ['measurement', 'unit conversion', 'scientific calculation'],
            'Chemistry & Science'   => ['molecular', 'compound', 'reaction', 'scientific'],
        ];
        return $categoryTerms[$category] ?? ['calculation', 'formula', 'tool', 'online'];
    }

    /**
     * Guess user types by category.
     */
    private function guessUserTypes(string $category): array
    {
        $usersByCategory = [
            'Finance & Business'    => ['business owners', 'financial analysts', 'students', 'investors'],
            'Health & Fitness'      => ['fitness enthusiasts', 'medical students', 'personal trainers'],
            'Developer Tools'       => ['web developers', 'software engineers', 'programmers'],
            'Math & Statistics'     => ['students', 'teachers', 'researchers', 'data analysts'],
            'Physics & Engineering' => ['engineers', 'physics students', 'researchers'],
            'Chemistry & Science'   => ['chemistry students', 'lab technicians', 'researchers'],
        ];
        return $usersByCategory[$category] ?? ['students', 'professionals', 'general users'];
    }
}
