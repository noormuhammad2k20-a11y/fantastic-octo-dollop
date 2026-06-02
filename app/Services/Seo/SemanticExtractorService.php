<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

/**
 * SemanticExtractorService v8.0
 *
 * Extracts all 15 SEO keyword types for every tool page:
 *  1. Primary        6. Search Intent  11. Related
 *  2. Secondary      7. Entity         12. Supporting
 *  3. Long-tail      8. PAA            13. Modifier
 *  4. Short-tail     9. Question       14. Contextual
 *  5. LSI/NLP       10. Cluster        15. TF-IDF
 *  + Autocomplete (Google Suggest — free, no API key)
 *  + Trending (bonus from AI)
 */
class SemanticExtractorService
{
    public function __construct(
        private GeminiService $gemini
    ) {}

    public function extractForTool(string $slug): Collection
    {
        // v8 cache key — busts all previous cached data
        $cacheKey = "semantics_v8:{$slug}";

        return Cache::store('file')->remember($cacheKey, now()->addDays(7), function () use ($slug) {
            $toolName = ucwords(str_replace('-', ' ', $slug));
            $keywords = collect();

            // ── A. Google Autocomplete (free) ─────────────────────
            foreach ($this->fetchGoogleAutocomplete($slug) as $term) {
                $keywords->push($this->kw($term, 'autocomplete', 'google_suggest', 'informational', 0.90));
            }
            sleep(2);

            // ── B. Gemini: ALL 15 types in ONE call ───────────────
            if (!$this->gemini->isConfigured()) {
                throw new \RuntimeException('GEMINI_API_KEY not configured');
            }

            $aiData = $this->generateAISemantics($toolName, $slug);

            $typeMap = [
                'primary_keywords'       => ['primary',       'transactional',  0.95],
                'secondary_keywords'     => ['secondary',     'informational',  0.88],
                'long_tail_keywords'     => ['long_tail',     'informational',  0.85],
                'short_tail_keywords'    => ['short_tail',    'navigational',   0.80],
                'lsi_keywords'           => ['lsi',           'informational',  0.85],
                'search_intent_keywords' => ['search_intent', 'informational',  0.82],
                'entity_keywords'        => ['entity',        'informational',  0.90],
                'paa_questions'          => ['paa',           'informational',  0.92],
                'question_keywords'      => ['question',      'informational',  0.85],
                'cluster_keywords'       => ['cluster',       'informational',  0.80],
                'related_keywords'       => ['related',       'informational',  0.78],
                'supporting_keywords'    => ['supporting',    'informational',  0.75],
                'modifier_keywords'      => ['modifier',      'commercial',     0.80],
                'contextual_keywords'    => ['contextual',    'informational',  0.78],
                'tfidf_keywords'         => ['tfidf',         'informational',  0.88],
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

            $aiCount = $keywords->filter(fn ($k) => $k['source'] === 'gemini')->count();
            if ($aiCount < 10) {
                throw new \RuntimeException(
                    "Only {$aiCount} AI keywords for {$slug} — minimum 10 required"
                );
            }

            Log::channel('seo')->info(
                "v8 extraction: {$slug} → {$keywords->count()} total " .
                "({$aiCount} AI + " . ($keywords->count() - $aiCount) . " autocomplete)"
            );

            return $keywords;
        });
    }

    private function generateAISemantics(string $toolName, string $slug): array
    {
        $prompt = <<<PROMPT
You are an expert SEO keyword researcher with deep knowledge of semantic SEO.
Generate a precise keyword dataset for this tool.

TOOL: {$toolName}
URL SLUG: {$slug}

CRITICAL DEFINITIONS — Follow these exactly:

PRIMARY KEYWORDS = The exact phrases users type in Google to find THIS tool.
Example for BMI Calculator: "bmi calculator", "body mass index calculator"
NOT: generic words, brand names

SECONDARY KEYWORDS = Alternative search phrases for same intent.
Example: "calculate bmi online", "bmi chart by age"
NOT: synonyms of the tool name

LONG-TAIL KEYWORDS = 4+ word phrases with specific intent.
Example: "how to calculate bmi for women over 40"
NOT: 3-word phrases, generic phrases

SHORT-TAIL KEYWORDS = 1-2 words SPECIFIC to this tool's topic (not the tool type).
Example for BMI: "bmi", "body mass index" — NOT "calculator", "tool", "online"

LSI KEYWORDS = Terms that co-occur with this topic in expert articles.
These are NOT synonyms. They are conceptually related terms from the same domain.
Example for ROI: "hurdle rate", "opportunity cost", "discount rate", "WACC", "IRR"
Example for BMI: "waist-to-hip ratio", "body fat percentage", "metabolic rate"
NOT: "profitability" for ROI (that's a synonym, not LSI)

SEARCH INTENT KEYWORDS = Phrases revealing user motivation:
- do-intent: user wants to USE the tool ("calculate roi now", "use roi calculator")
- know-intent: user wants to LEARN ("what is roi", "roi explained")
- compare-intent: user evaluating ("roi vs irr", "roi vs payback period")
- navigate-intent: user going somewhere ("roi calculator toolshub", "roi calculator online free")

ENTITY KEYWORDS = Named real-world entities (Knowledge Graph) — proper nouns:
Named formulas, named concepts, organizations, standards, academic sources.
Example for ROI: "Dupont Analysis", "Corporate Finance Institute", "CFA Institute",
"GAAP", "IFRS", "Harvard Business Review"
NOT: generic terms like "financial analysis"

PAA KEYWORDS = Real "People Also Ask" questions users see in Google.
Must be actual questions (start with How/What/Why/Which/When/Can/Is/Are).
Must be specific to THIS tool — not generic questions.

QUESTION KEYWORDS = Other question formats users search.
Different from PAA — these are direct search queries as questions.

CLUSTER KEYWORDS = The topical silo/hub this tool belongs to.
These are category-level keywords for the pillar page.
Example for ROI: "financial calculators", "investment analysis tools", "business ROI tools"

RELATED KEYWORDS = Other specific tools/methods users need alongside this.
Example for ROI: "npv calculator", "irr calculator", "payback period calculator"
NOT: generic financial terms

SUPPORTING KEYWORDS = Educational/definitional content that supports this tool.
Example: "how to read roi results", "roi formula derivation", "roi interpretation guide"

MODIFIER KEYWORDS = Quality/access modifiers prepended to tool name.
ALWAYS follow this format: [modifier] + [tool name or core concept]
Example: "free roi calculator", "accurate roi calculator", "advanced roi calculator"

CONTEXTUAL KEYWORDS = Industry/situation-specific applications.
Example: "roi calculator for e-commerce", "marketing campaign roi", "real estate roi"
NOT: generic modifiers

TF-IDF KEYWORDS = High-importance terms that appear frequently in TOP-RANKING
articles about this topic but rarely elsewhere. These signal expertise to Google.
Example for ROI: "net present value", "internal rate of return", "hurdle rate",
"weighted average cost of capital", "opportunity cost of capital"
NOT: common words like "profit" or "cost"

TRENDING KEYWORDS = Currently rising search terms (2024-2025) for this topic.
Example: "ai-powered roi calculator", "esg roi metrics", "roi for remote work"

---
Return ONLY this JSON structure. No markdown. Start with { end with }

{
  "primary_keywords": ["3 exact search phrases users type to find this tool"],
  "secondary_keywords": ["5 alternative search phrases for same intent"],
  "long_tail_keywords": ["8 specific 4+ word phrases with clear user intent"],
  "short_tail_keywords": ["3 topic-specific 1-2 word terms — NOT tool type words"],
  "lsi_keywords": ["8 co-occurring domain terms — NOT synonyms of the tool name"],
  "search_intent_keywords": ["4 phrases: 1 do-intent, 1 know-intent, 1 compare-intent, 1 navigate-intent"],
  "entity_keywords": ["5 named real-world entities, formulas, organizations, standards"],
  "paa_questions": ["8 real PAA questions starting with How/What/Why/Which/When/Can"],
  "question_keywords": ["5 question-format search queries specific to this tool"],
  "cluster_keywords": ["5 topical cluster/pillar keywords for this tool's silo"],
  "related_keywords": ["6 specific related tools or methods users need alongside this"],
  "supporting_keywords": ["5 educational/definitional content keywords"],
  "modifier_keywords": ["6 modifier+toolname combinations: free/online/best/accurate/simple/advanced"],
  "contextual_keywords": ["5 industry/situation-specific application keywords"],
  "tfidf_keywords": ["5 high-importance expert domain terms that signal topical authority"],
  "trending_keywords": ["3 currently rising 2024-2025 search terms"]
}
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
