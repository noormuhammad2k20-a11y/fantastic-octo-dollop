<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

/**
 * SemanticExtractorService v10.0
 *
 * Extracts all 18 SEO keyword types for every tool page:
 *  1. Primary        7. Semantic       13. Informational
 *  2. Secondary      8. Long-tail      14. Short-tail
 *  3. Autocomplete   9. Question       15. Modifier
 *  4. LSI/NLP       10. Related        16. Contextual
 *  5. PAA           11. Comparison     17. TF-IDF
 *  6. Entity        12. Transactional  18. Trending
 *  + Autocomplete (Google Suggest — free, no API key)
 *
 * v10 fixes:
 * - Added 'comparison', 'semantic', 'informational', 'transactional' types
 * - Removed 'search_intent' type (it was a search_intent VALUE, not a keyword type)
 * - Updated prompt with precise definitions for all 18 types
 * - Cache key bumped to v10 to bust stale data
 */
class SemanticExtractorService
{
    public function __construct(
        private GeminiService $gemini
    ) {}

    public function extractForTool(string $slug): Collection
    {
        // v14: Fresh cache key — previous v10 data had informational type bugs
        $cacheKey = "semantics_v14:{$slug}";

        return Cache::store('file')->remember($cacheKey, now()->addDays(7), function () use ($slug) {
            $toolName = ucwords(str_replace('-', ' ', $slug));
            $keywords = collect();

            // ── A. Google Autocomplete (free) ─────────────────────
            foreach ($this->fetchGoogleAutocomplete($slug) as $term) {
                $keywords->push($this->kw($term, 'autocomplete', 'google_suggest', 'informational', 0.90));
            }
            sleep(2);

            // ── B. Gemini: ALL 18 types in ONE call ───────────────
            if (!$this->gemini->isConfigured()) {
                throw new \RuntimeException('GEMINI_API_KEY not configured');
            }

            $aiData = $this->generateAISemantics($toolName, $slug);

            // v10 typeMap: 13 user-requested + 5 power types = 18 total
            $typeMap = [
                // The 13 types user specifically requested:
                'primary_keywords'       => ['primary',       'transactional',  0.95],
                'secondary_keywords'     => ['secondary',     'informational',  0.88],
                'autocomplete_extended'  => ['autocomplete',  'informational',  0.82],
                'lsi_keywords'           => ['lsi',           'informational',  0.85],
                // paa_questions handled separately below (v12: Q+A format)
                'entity_keywords'        => ['entity',        'informational',  0.90],
                'semantic_keywords'      => ['semantic',      'informational',  0.85],
                'long_tail_keywords'     => ['long_tail',     'informational',  0.85],
                'question_keywords'      => ['question',      'informational',  0.85],
                'related_keywords'       => ['related',       'informational',  0.78],
                'comparison_keywords'    => ['comparison',    'commercial',     0.82],
                'transactional_keywords' => ['transactional', 'transactional',  0.88],
                'informational_keywords' => ['informational', 'informational',  0.80],
                // Additional power types:
                'short_tail_keywords'    => ['short_tail',    'navigational',   0.80],
                'modifier_keywords'      => ['modifier',      'commercial',     0.80],
                'tfidf_keywords'         => ['tfidf',         'informational',  0.88],
                'contextual_keywords'    => ['contextual',    'informational',  0.78],
                'trending_keywords'      => ['trending',      'informational',  0.75],
            ];

            foreach ($typeMap as $jsonKey => [$type, $defaultIntent, $confidence]) {
                foreach ($aiData[$jsonKey] ?? [] as $item) {
                    $keyword = is_string($item) ? trim($item) : trim($item['keyword'] ?? '');
                    if (empty($keyword)) continue;

                    $kw = $this->kw($keyword, $type, 'gemini',
                        is_array($item) ? ($item['intent'] ?? $defaultIntent) : $defaultIntent,
                        is_array($item) ? (float)($item['confidence'] ?? $confidence) : $confidence
                    );
                    $keywords->push($kw);
                }
            }

            // v12: Process PAA questions separately (supports Q+A format)
            foreach ($aiData['paa_questions'] ?? [] as $item) {
                if (is_string($item)) {
                    // Old format: just a question string
                    $keywords->push($this->kw($item, 'paa', 'gemini', 'informational', 0.92));
                } elseif (is_array($item) && !empty($item['q'])) {
                    // New format: question + answer object
                    $kw = $this->kw($item['q'], 'paa', 'gemini', 'informational', 0.92);
                    $kw['answer'] = $item['a'] ?? null;
                    $keywords->push($kw);
                }
            }

            $aiCount = $keywords->filter(fn ($k) => $k['source'] === 'gemini')->count();
            if ($aiCount < 10) {
                throw new \RuntimeException(
                    "Only {$aiCount} AI keywords for {$slug} — minimum 10 required"
                );
            }

            Log::channel('seo')->info(
                "v10 extraction: {$slug} → {$keywords->count()} total " .
                "({$aiCount} AI + " . ($keywords->count() - $aiCount) . " autocomplete)"
            );

            return $keywords;
        });
    }

    private function generateAISemantics(string $toolName, string $slug): array
    {
        $prompt = <<<PROMPT
Expert SEO keyword researcher. Generate complete keyword data for:

TOOL: {$toolName}  |  SLUG: /{$slug}

Return ONLY valid JSON. Start { end }. No markdown. No extra text.

DEFINITIONS (follow precisely — wrong types = wasted API call):

primary: Exact search phrases users type to find THIS specific tool.
  ✅ "{$toolName}" variations, most-searched forms
  ❌ Generic words, too-broad terms

secondary: Alternative phrases for same search intent.
  ✅ Synonymous tool names, action-first phrases
  ❌ Synonyms of the concept itself

autocomplete_extended: Additional autocomplete suggestions beyond Google Suggest.
  ✅ "{$toolName} for [industry]", "{$toolName} [year]"
  ❌ Exact duplicates of primary keywords

lsi: Words that co-occur with this topic in TOP-RANKING expert articles.
  ✅ Domain concepts that appear NEAR this topic (NOT synonyms)
  ✅ ROI example: "hurdle rate","opportunity cost","WACC","discount rate"
  ❌ "profitability" for ROI (synonym, not LSI)

paa: Real "People Also Ask" questions from Google SERPs.
  ✅ Must start with How/What/Why/Which/When/Can/Is/Are
  ✅ Must be specific to {$toolName}
  ❌ Generic questions

entity: Named real-world entities for Google Knowledge Graph.
  ✅ Named formulas (e.g. "Dupont Analysis"), organizations ("CFA Institute"),
     standards ("GAAP"), academic sources, proper nouns
  ❌ Generic terms like "financial analysis"

semantic: Conceptually related terms that help search engines understand topic depth.
  ✅ Related methods, complementary concepts, domain vocabulary
  ❌ Synonyms of tool name

long_tail: 4+ word highly specific search phrases.
  ✅ "{$toolName} for [specific profession/scenario/industry]"
  ❌ Phrases under 4 words

question: Question-format search queries (broader than PAA).
  ✅ "What is [concept]?", "How does [tool] work?"
  ❌ Non-question formats

related: Specific OTHER tools users need alongside this one.
  ✅ Tool names, method names, calculator names
  ❌ Generic concept words

comparison: Phrases users search to compare this tool/concept with alternatives.
  ✅ "[tool concept] vs [alternative]", "[tool] compared to [other]"
  ❌ Non-comparison phrases

transactional: High-commercial-intent phrases ready to convert.
  ✅ "use {$toolName} now", "calculate [X] online", "free [tool] instantly"
  ❌ Informational phrases

informational: Educational/research-intent phrases.
  ✅ "how [concept] works", "what is [concept]", "[concept] explained"
  ❌ Tool-action phrases

short_tail: 1-2 word topic-specific terms (NOT tool type words).
  ✅ "roi", "body mass index", "compound interest"
  ❌ "calculator", "tool", "online", "free"

modifier: [quality/access word] + [tool name] combinations.
  ✅ "free {$toolName}", "accurate {$toolName}", "best {$toolName}"
  ❌ Tool name alone

tfidf: High-frequency important terms from expert articles on this topic.
  ✅ Technical domain terms that signal authority
  ❌ Common everyday words

contextual: Industry/situation-specific application phrases.
  ✅ "[tool] for [specific industry]", "[tool] during [situation]"
  ❌ Generic modifiers

{
  "primary_keywords": ["3 exact most-searched phrases for {$toolName}"],
  "secondary_keywords": ["5 alternative search phrases same intent"],
  "autocomplete_extended": ["5 extended autocomplete suggestions"],
  "lsi_keywords": ["8 co-occurring domain expert terms — NOT synonyms"],
  "paa_questions": [
    {"q": "How is [concept] calculated?", "a": "[2-3 sentence factual answer with a specific number or formula]"}
  ],
  "entity_keywords": ["5 named entities — proper nouns, organizations, formulas"],
  "semantic_keywords": ["6 conceptually related terms for topic depth"],
  "long_tail_keywords": ["8 specific 4+ word phrases"],
  "question_keywords": ["5 question-format search queries"],
  "related_keywords": ["6 specific related tools or methods"],
  "comparison_keywords": ["4 vs/compared-to phrases"],
  "transactional_keywords": ["4 high-commercial-intent action phrases"],
  "informational_keywords": ["5 educational/research-intent phrases"],
  "short_tail_keywords": ["3 topic-specific 1-2 word terms"],
  "modifier_keywords": ["5 modifier+toolname: free/online/best/accurate/advanced"],
  "tfidf_keywords": ["5 high-authority domain expert terms"],
  "contextual_keywords": ["4 industry/situation-specific application phrases"],
  "trending_keywords": ["3 currently rising 2024-2025 search terms"]
}

CRITICAL: Replace ALL placeholder text with REAL keywords for {$toolName}.
Return ONLY the JSON object.
PROMPT;

        return $this->gemini->generateJson($prompt);
    }

    private function fetchGoogleAutocomplete(string $slug): array
    {
        $query   = str_replace('-', ' ', $slug);
        $results = [];

        foreach ([$query, "how to use {$query}", "{$query} formula"] as $seed) {
            try {
                $resp = Http::timeout(8)
                    ->withHeaders(['User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'])
                    ->get('https://suggestqueries.google.com/complete/search', [
                        'client' => 'firefox',
                        'q'      => $seed,
                        'hl'     => 'en',
                    ]);

                if ($resp->successful()) {
                    $results = array_merge($results, $resp->json()[1] ?? []);
                }
                sleep(1);
            } catch (\Exception $e) {
                Log::channel('seo')->warning("Autocomplete failed '{$seed}': {$e->getMessage()}");
            }
        }

        return array_slice(array_unique($results), 0, 10);
    }

    private function kw(
        string $keyword,
        string $type,
        string $source,
        string $intent = 'informational',
        float  $confidence = 0.80
    ): array {
        return [
            'keyword'    => mb_strtolower(trim($keyword)),
            'type'       => $type,
            'source'     => $source,
            'intent'     => $intent,
            'confidence' => $confidence,
        ];
    }
}
