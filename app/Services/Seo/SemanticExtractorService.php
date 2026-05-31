<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class SemanticExtractorService
{
    public function __construct(
        private GeminiService $gemini
    ) {}

    public function extractForTool(string $slug): Collection
    {
        $cacheKey = "semantics:{$slug}";

        // Cache results for 7 days to avoid duplicate API calls
        return Cache::remember($cacheKey, now()->addDays(7), function() use ($slug) {
            $toolName = ucwords(str_replace('-', ' ', $slug));
            $keywords = collect();

            // 1. Google Autocomplete (no API key needed)
            $autocomplete = $this->fetchGoogleAutocomplete($slug);
            foreach ($autocomplete as $term) {
                $keywords->push([
                    'keyword'    => $term,
                    'type'       => 'autocomplete',
                    'source'     => 'google_suggest',
                    'intent'     => 'informational',
                    'confidence' => 0.90,
                ]);
            }
            sleep(2); // Rate limit

            // 2. AI-Generated Semantics (Gemini — most reliable)
            // FIXED: Fail hard if GEMINI_API_KEY is not configured
            if (!$this->gemini->isConfigured()) {
                throw new \RuntimeException('GEMINI_API_KEY not configured — cannot extract AI semantics');
            }

            $aiKeywords = $this->generateAISemantics($toolName, $slug);

            // Validate we actually got AI keywords (not just empty array)
            $aiCount = count(array_filter($aiKeywords, fn($k) => $k['source'] === 'gemini'));
            if ($aiCount === 0) {
                throw new \RuntimeException("Gemini returned 0 keywords for {$slug} — API call likely failed");
            }

            foreach ($aiKeywords as $kw) {
                $keywords->push($kw);
            }
            sleep(3); // Rate limit

            return $keywords;
        });
    }

    private function fetchGoogleAutocomplete(string $slug): array
    {
        $query = urlencode(str_replace('-', ' ', $slug));

        try {
            $response = Http::timeout(10)
                ->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; SEOBot/1.0)'])
                ->get("https://suggestqueries.google.com/complete/search", [
                    'client' => 'firefox',
                    'q'      => $query,
                    'hl'     => 'en',
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return array_slice($data[1] ?? [], 0, 8); // Max 8 suggestions
            }
        } catch (\Exception $e) {
            Log::channel('seo')->warning("Google suggest failed for {$slug}: {$e->getMessage()}");
        }
        return [];
    }

    private function generateAISemantics(string $toolName, string $slug): array
    {
        $prompt = <<<PROMPT
For the tool "{$toolName}" (URL slug: {$slug}), generate semantic SEO keyword data.

Return ONLY a valid JSON object. No explanation, no markdown, no code fences.
Start your response with { and end with }

Required JSON structure:
{
  "lsi_keywords": [
    "semantically related term 1",
    "semantically related term 2",
    "semantically related term 3",
    "semantically related term 4",
    "semantically related term 5"
  ],
  "paa_questions": [
    "How do I use {$toolName}?",
    "What is the formula for [specific concept in this tool]?",
    "What is a good [metric] when using {$toolName}?",
    "When should I use {$toolName}?",
    "What are the limitations of {$toolName}?"
  ],
  "semantic_entities": [
    "Primary concept name",
    "Related technical term",
    "Industry or domain name"
  ],
  "search_intent": "informational",
  "related_searches": [
    "related search 1",
    "related search 2",
    "related search 3"
  ]
}

Rules:
- All questions must be SPECIFIC to "{$toolName}" — not generic
- LSI keywords must be semantically related, not just synonyms
- search_intent must be one of: informational, transactional, navigational, commercial
- Return ONLY the JSON object — nothing before or after it
PROMPT;

        try {
            $data = $this->gemini->generateJson($prompt);
            $this->gemini->respectRateLimit();

            if (empty($data)) {
                throw new \RuntimeException('Gemini returned empty JSON for ' . $slug);
            }

            $keywords = [];

            foreach ($data['lsi_keywords'] ?? [] as $term) {
                if (!empty(trim($term))) {
                    $keywords[] = [
                        'keyword'    => trim($term),
                        'type'       => 'lsi',
                        'source'     => 'gemini',
                        'intent'     => 'informational',
                        'confidence' => 0.85,
                    ];
                }
            }

            foreach ($data['paa_questions'] ?? [] as $q) {
                if (!empty(trim($q))) {
                    $keywords[] = [
                        'keyword'    => trim($q),
                        'type'       => 'paa',
                        'source'     => 'gemini',
                        'intent'     => 'informational',
                        'confidence' => 0.88,
                    ];
                }
            }

            foreach ($data['semantic_entities'] ?? [] as $e) {
                if (!empty(trim($e))) {
                    $keywords[] = [
                        'keyword'    => trim($e),
                        'type'       => 'entity',
                        'source'     => 'gemini',
                        'intent'     => $data['search_intent'] ?? 'informational',
                        'confidence' => 0.90,
                    ];
                }
            }

            foreach ($data['related_searches'] ?? [] as $r) {
                if (!empty(trim($r))) {
                    $keywords[] = [
                        'keyword'    => trim($r),
                        'type'       => 'semantic',
                        'source'     => 'gemini',
                        'intent'     => 'informational',
                        'confidence' => 0.80,
                    ];
                }
            }

            if (count($keywords) === 0) {
                throw new \RuntimeException('Gemini returned 0 valid keywords for ' . $slug);
            }

            return $keywords;

        } catch (\Exception $e) {
            Log::channel('seo')->error("Gemini semantics failed for {$slug}: {$e->getMessage()}");
            throw $e; // Re-throw — do not silently fail
        }
    }
}
