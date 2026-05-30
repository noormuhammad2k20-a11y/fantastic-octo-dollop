<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class SemanticExtractorService
{
    private string $openAiKey;
    private string $model;

    public function __construct()
    {
        $this->openAiKey = config('services.openai.api_key', '');
        $this->model = config('services.openai.model', 'gpt-4o-mini');
    }

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

            // 2. AI-Generated Semantics (OpenAI — most reliable)
            if (!empty($this->openAiKey)) {
                $aiKeywords = $this->generateAISemantics($toolName, $slug);
                foreach ($aiKeywords as $kw) {
                    $keywords->push($kw);
                }
                sleep(3); // Rate limit
            } else {
                Log::channel('seo')->warning("Skipping OpenAI semantics for {$slug} because OPENAI_API_KEY is not set.");
            }

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
For the tool "{$toolName}" (URL: /{$slug}), generate semantic SEO data.

Return ONLY valid JSON in this exact format:
{
  "lsi_keywords": ["term1", "term2", "term3", "term4", "term5"],
  "paa_questions": [
    "How do I calculate [specific thing]?",
    "What is the formula for [specific thing]?",
    "What is a good [metric] for [specific thing]?",
    "How accurate is [tool name]?",
    "Can I use [tool name] for [specific use case]?"
  ],
  "semantic_entities": ["Entity1", "Entity2", "Entity3"],
  "search_intent": "informational",
  "related_searches": ["term1", "term2", "term3"]
}

Rules:
- All questions must be SPECIFIC to this tool
- LSI keywords must be semantically related, not just synonyms
- Return ONLY the JSON, no other text
PROMPT;

        try {
            $response = Http::withToken($this->openAiKey)
                ->timeout(60)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => $this->model,
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.3,
                ]);

            if (!$response->successful()) {
                Log::channel('seo')->error("AI semantics failed for {$slug}: HTTP {$response->status()} - {$response->body()}");
                return [];
            }

            $json = trim($response->json('choices.0.message.content'));
            $json = preg_replace('/```json|```/', '', $json);
            $data = json_decode($json, true);

            if (!$data) {
                Log::channel('seo')->error("AI semantics failed for {$slug}: Could not parse JSON response.");
                return [];
            }

            $keywords = [];

            foreach ($data['lsi_keywords'] ?? [] as $term) {
                $keywords[] = ['keyword' => $term, 'type' => 'lsi', 'source' => 'openai',
                               'intent' => 'informational', 'confidence' => 0.85];
            }
            foreach ($data['paa_questions'] ?? [] as $q) {
                $keywords[] = ['keyword' => $q, 'type' => 'paa', 'source' => 'openai',
                               'intent' => 'informational', 'confidence' => 0.88];
            }
            foreach ($data['semantic_entities'] ?? [] as $e) {
                $keywords[] = ['keyword' => $e, 'type' => 'entity', 'source' => 'openai',
                               'intent' => $data['search_intent'] ?? 'informational', 'confidence' => 0.90];
            }
            foreach ($data['related_searches'] ?? [] as $r) {
                $keywords[] = ['keyword' => $r, 'type' => 'semantic', 'source' => 'openai',
                               'intent' => 'informational', 'confidence' => 0.80];
            }

            return $keywords;

        } catch (\Exception $e) {
            Log::channel('seo')->error("AI semantics failed for {$slug}: {$e->getMessage()}");
            return [];
        }
    }
}
