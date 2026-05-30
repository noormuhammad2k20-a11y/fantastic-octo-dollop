<?php

namespace App\Services\SEO;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIContentGenerator
{
    private string $openAiKey;
    private string $model;

    public function __construct()
    {
        $this->openAiKey = config('services.openai.api_key', '');
        $this->model = config('services.openai.model', 'gpt-4o');
    }

    public function generateForTool(array $context): array
    {
        if (empty($this->openAiKey)) {
            throw new \RuntimeException("OPENAI_API_KEY is missing. Cannot generate content.");
        }

        $toolName      = $context['tool_name'];       // "ROI Calculator"
        $toolSlug      = $context['slug'];            // "roi-calculator"
        $category      = $context['category'];        // "Finance"
        $primaryUse    = $context['primary_use'];     // "calculate return on investment"
        $relatedTerms  = implode(', ', $context['related_terms']); // "profit, investment, returns"
        $userTypes     = implode(', ', $context['user_types']);    // "investors, business owners"
        $formula       = $context['formula'] ?? null;

        $formulaSection = $formula
            ? "Include this specific formula in the explanation: {$formula}"
            : "Include the most accurate formula for this calculation";

        $prompt = <<<PROMPT
You are a specialist technical writer. Write a high-quality SEO article for this specific tool:

TOOL: {$toolName}
URL SLUG: {$toolSlug}
CATEGORY: {$category}
PRIMARY PURPOSE: {$primaryUse}
RELATED CONCEPTS: {$relatedTerms}
WHO USES THIS: {$userTypes}

CONTENT REQUIREMENTS:
1. H1: Create a specific, keyword-rich title for "{$toolName}" — not generic
2. Opening paragraph (150 words): Explain the SPECIFIC problem this tool solves
   — Use a concrete real-world scenario, NOT "In today's world" or "Are you looking for"
3. H2: "What is [specific concept]?" — define the core concept with precision
4. H2: "The [Tool Name] Formula Explained"
   — {$formulaSection}
   — Show the formula, then explain each variable with a REAL numeric example
   — Example must use plausible real numbers (not X, Y, Z variables)
5. H2: "How to Use This {$toolName} — Step by Step"
   — 4-5 specific numbered steps
   — Include what happens if input values change
6. H2: "Real-World Examples"
   — 2 concrete scenarios with actual numbers calculated
   — Scenarios must be relevant to {$userTypes}
7. H2: "Common Mistakes and How to Avoid Them"
   — 3 mistakes specific to this type of calculation
8. FAQ Section (H2: "Frequently Asked Questions"):
   — Generate 5 SPECIFIC questions someone would ask about {$toolName}
   — Answers must be 2-3 sentences each, factually accurate
9. Closing: 2-sentence practical summary

STRICT RULES:
- Word count: 900-1200 words
- NEVER use: "In today's digital world", "Look no further", "Are you looking for"
- NEVER repeat the tool name more than once every 100 words
- Every H2 must be specific to THIS tool, not generic
- All numbers in examples must be realistic and mathematically correct
- Write for humans first, search engines second
- Flesch Reading Ease score should be 55-70 (readable but not childish)

Return ONLY valid HTML using: h2, h3, p, ul, li, strong, em
No markdown. No code blocks. No preamble. Just the HTML content.
PROMPT;

        $maxRetries = (int) config('seo.openai.max_retries', 3);
        $delayMs = (int) config('seo.openai.delay_between_requests_ms', 3000);
        $retryDelaySec = (int) config('seo.openai.retry_delay_seconds', 60);

        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                usleep($delayMs * 1000);

                $response = Http::withToken($this->openAiKey)
                    ->timeout(180)
                    ->post('https://api.openai.com/v1/chat/completions', [
                        'model' => $this->model,
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => 'You are a technical SEO content writer. Return only valid HTML. No markdown, no code blocks.'
                            ],
                            [
                                'role' => 'user',
                                'content' => $prompt
                            ]
                        ],
                        'temperature' => 0.7,
                    ]);

                if ($response->status() === 429) {
                    Log::channel('seo')->warning("Rate limited (429) — waiting {$retryDelaySec}s (attempt {$attempt})");
                    sleep($retryDelaySec);
                    continue;
                }

                if (!$response->successful()) {
                    throw new \RuntimeException("OpenAI API error: " . $response->body());
                }

                $html = trim($response->json('choices.0.message.content'));

                // Validate it's actually HTML
                if (!str_contains($html, '<h2>') && !str_contains($html, '<p>')) {
                    throw new \RuntimeException("Response is not valid HTML");
                }

                $wordCount = str_word_count(strip_tags($html));

                // Quality gate: reject thin content
                if ($wordCount < 600) {
                    throw new \RuntimeException("Content too thin: {$wordCount} words");
                }

                return [
                    'html'        => $html,
                    'model'       => $this->model,
                    'word_count'  => $wordCount,
                    'seo_score'   => $this->calculateSeoScore($html, $prompt),
                    'outline'     => $this->extractOutline($html),
                    'prompt_used' => $prompt,
                ];

            } catch (\Exception $e) {
                if ($attempt < $maxRetries && str_contains($e->getMessage(), '429')) {
                    Log::channel('seo')->warning("Rate limited (Exception) — waiting {$retryDelaySec}s (attempt {$attempt})");
                    sleep($retryDelaySec);
                    continue;
                }
                throw $e;
            }
        }

        throw new \RuntimeException("OpenAI failed after {$maxRetries} retries");
    }

    private function calculateSeoScore(string $html, string $prompt): int
    {
        $score = 0;
        $text  = strip_tags($html);
        $words = str_word_count($text);

        if ($words >= 800) $score += 25;
        if ($words >= 1000) $score += 10;
        if (substr_count($html, '<h2') >= 4) $score += 20;
        if (substr_count($html, '<h3') >= 2) $score += 10;
        if (str_contains($html, '<ul>')) $score += 10;
        if (str_contains(strtolower($html), 'example')) $score += 15;
        if (str_contains(strtolower($html), 'formula')) $score += 10;

        return min($score, 100);
    }

    private function extractOutline(string $html): array
    {
        $outline = [];
        preg_match_all('/<(h[23])[^>]*>(.*?)<\/\1>/i', $html, $matches);
        foreach ($matches[2] as $i => $heading) {
            $outline[] = [
                'level'   => $matches[1][$i],
                'heading' => strip_tags($heading)
            ];
        }
        return $outline;
    }
}
