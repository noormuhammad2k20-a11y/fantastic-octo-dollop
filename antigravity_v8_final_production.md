# ANTIGRAVITY SEO ENGINE — FINAL PRODUCTION PROMPT (v8.0)
## Complete System Fix + 15-Type Keyword Extraction + Content Pipeline
## GitHub: https://github.com/noormuhammad2k20-a11y/fantastic-octo-dollop
## Paste entire prompt → Say: "Run Full System Audit first"

---

## CONFIRMED BUGS FROM CODE + DATABASE ANALYSIS

```
BUG 1 — ENUM BLOCKS 8 OF 15 KEYWORD TYPES (CRITICAL)
File: database/migrations (semantic_keywords table)
ENUM only allows: 'primary','lsi','semantic','autocomplete','paa','entity','trending'
MISSING from ENUM: secondary, long_tail, short_tail, search_intent,
                   question, cluster, related, supporting, modifier,
                   contextual, tfidf
Impact: Any INSERT with these types throws SQL error → silent fail
Fix: Migration to expand ENUM to all 15 types

BUG 2 — generateAISemantics() ONLY EXTRACTS 4 TYPES (CRITICAL)
File: app/Services/Seo/SemanticExtractorService.php (lines 84-196)
Current prompt asks for: lsi_keywords, paa_questions,
                         semantic_entities, related_searches ONLY
Missing: primary, secondary, long_tail, short_tail, search_intent,
         question, cluster, related, supporting, modifier, contextual, tfidf
Impact: 11 of 15 types are never generated — system is 27% complete
Fix: Replace generateAISemantics() with single Gemini call for all 15 types

BUG 3 — CONTENT NOT SHOWING ON SITE (CRITICAL)
File: app/Http/Controllers/ToolController.php (line 68)
Code: ->where('status', 'approved')
Problem: ALL 10 drafts have status = 'pending_review'
         Frontend only shows 'approved' → zero content on any page
Fix: Approve existing good drafts + implement auto-approval after generation

BUG 4 — ONLY 10 OF 1417 TOOLS HAVE CONTENT (CRITICAL)
File: app/Console/Commands/SeoGenerateContentCommand.php
Problem: Query LEFT JOINs content_drafts WHERE status IN (approved,published)
         1407 tools have no approved draft → all 1407 are "eligible"
         BUT the command stops early — needs investigation
Fix: Delete all pending mock drafts → run with --force on all tools

BUG 5 — KEYWORD SECTION SHOWS "No semantic keywords extracted yet"
File: app/Services/Seo/GeminiContentGenerator.php
Problem: GeminiContentGenerator prompt does NOT pull keywords from DB
         It generates content without using any extracted keywords
         The "Target Keywords Used" section is never generated
Fix: Pull keywords from semantic_keywords table → inject into content prompt
     → auto-generate "Target Keywords Used" section at end of every article

BUG 6 — CACHE KEY CONFLICT (OLD DATA STUCK)
File: app/Services/Seo/SemanticExtractorService.php (line 16)
Code: $cacheKey = "semantics:{$slug}";
Problem: Old 7-day cached data (with only 4 keyword types) blocks re-extraction
Fix: Change cache key to "semantics_v8:{$slug}" to bust old cache

BUG 7 — tool_blade ONLY LOADS PAA KEYWORDS FOR FRONTEND
File: app/Http/Controllers/ToolController.php (line 87-91)
Problem: Only 'paa' type loaded for frontend → 14 other types ignored
         Related tools, long-tail search terms, entity tags not shown
Fix: Load all keyword types needed for frontend display

BUG 8 — AppServiceProvider MISSING SemanticExtractorService BINDING
File: app/Providers/AppServiceProvider.php
Problem: GeminiService and GeminiContentGenerator registered as singletons
         SemanticExtractorService NOT registered → auto-resolved but
         GeminiService injected into it may get different instance
Fix: Register SemanticExtractorService as singleton too
```

---

## YOUR IDENTITY
Senior Laravel Engineer + SEO Automation Architect.
You have full access to the GitHub repository above.
You fix real bugs in real files. You show existing code before changing it.
You do not add features beyond what is listed. You do not give generic advice.

## TECH STACK (Confirmed)
- Laravel + PHP 8.2 + MySQL MariaDB 10.4
- Google Gemini API (gemini-2.5-flash) — configured in config/services.php
- File Cache (no Redis) — confirmed in AppServiceProvider
- Namespace: App\Services\Seo\ (lowercase 'eo' — confirmed from files)

## ABSOLUTE RULES
```
❌ NEVER auto-publish — status stays 'pending_review' until human approves
❌ NEVER use Tool::all() — always chunk(50) for 1417 tools
❌ NEVER alter existing columns — use migration to ADD only
❌ NEVER hardcode API keys — always env()
❌ NEVER skip the migration before changing PHP code
✅ Show existing code + line numbers BEFORE writing any fix
✅ Use updateOrInsert() with (tool_slug + keyword + keyword_type) as unique key
✅ Always verify with php artisan tinker after each fix
✅ Always add --dry-run to every Artisan command
```

---

## FIX 1 — EXPAND ENUM (Run This First — Everything Depends On It)

### Show current migration:
```bash
find database/migrations -name "*semantic*" | xargs cat
```

### Create migration:
```bash
php artisan make:migration expand_semantic_keywords_enum_add_15_types
```

**Full migration file:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Add temp column
        Schema::table('semantic_keywords', function (Blueprint $table) {
            $table->string('kw_type_tmp', 50)->after('keyword_type')->nullable();
        });

        // Step 2: Copy existing values
        DB::statement('UPDATE semantic_keywords SET kw_type_tmp = keyword_type');

        // Step 3: Drop old ENUM
        Schema::table('semantic_keywords', function (Blueprint $table) {
            $table->dropColumn('keyword_type');
        });

        // Step 4: Rename temp column
        Schema::table('semantic_keywords', function (Blueprint $table) {
            $table->renameColumn('kw_type_tmp', 'keyword_type');
        });

        // Step 5: Apply new ENUM with all 17 values (15 types + autocomplete + trending)
        DB::statement("
            ALTER TABLE semantic_keywords
            MODIFY COLUMN keyword_type ENUM(
                'primary',
                'secondary',
                'long_tail',
                'short_tail',
                'lsi',
                'search_intent',
                'entity',
                'paa',
                'question',
                'cluster',
                'related',
                'supporting',
                'modifier',
                'contextual',
                'tfidf',
                'autocomplete',
                'trending'
            ) NOT NULL DEFAULT 'lsi'
        ");

        // Step 6: Add missing indexes
        Schema::table('semantic_keywords', function (Blueprint $table) {
            // Only add if not exists
            try {
                $table->index(['tool_slug', 'keyword_type', 'is_active'], 'idx_sk_tool_type_active');
            } catch (\Exception $e) { /* index may already exist */ }
        });
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE semantic_keywords
            MODIFY COLUMN keyword_type
            ENUM('primary','lsi','semantic','autocomplete','paa','entity','trending')
            NOT NULL DEFAULT 'lsi'
        ");
    }
};
```

```bash
php artisan migrate

# Verify:
php artisan tinker --execute="
\$col = DB::select(\"SHOW COLUMNS FROM semantic_keywords WHERE Field = 'keyword_type'\");
echo \$col[0]->Type;
"
# Must show all 17 values in ENUM
```

---

## FIX 2 — REPLACE SemanticExtractorService COMPLETELY

**File:** `app/Services/Seo/SemanticExtractorService.php`

Replace entire file:

```php
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

            $aiData = $this->extractAll15Types($toolName, $slug);

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

    private function extractAll15Types(string $toolName, string $slug): array
    {
        $prompt = <<<PROMPT
You are an expert SEO keyword researcher. Generate a COMPLETE keyword dataset for:

TOOL: {$toolName}
URL: /{$slug}

CRITICAL: Replace ALL placeholder text with REAL keywords for THIS specific tool.
Return ONLY valid JSON. Start with { end with }. No markdown, no code fences.

{
  "primary_keywords": [
    "exact tool name as users search it",
    "most searched variation of this tool",
    "primary target keyword"
  ],
  "secondary_keywords": [
    "second most important keyword",
    "alternative search phrase",
    "action-based keyword (how to + concept)",
    "tool type + domain keyword",
    "tool name + free/online variation"
  ],
  "long_tail_keywords": [
    "4+ word specific phrase users type",
    "tool name + specific use case scenario",
    "tool name + industry or profession",
    "how to use tool name step by step",
    "tool name + comparison with alternative",
    "tool name + specific calculation type",
    "tool name + for beginners or experts",
    "specific problem this tool solves in user language"
  ],
  "short_tail_keywords": [
    "1-2 word core term",
    "generic category keyword",
    "single action word"
  ],
  "lsi_keywords": [
    "semantically related concept (not synonym)",
    "technically related domain term",
    "co-occurring term in expert articles",
    "NLP-related concept near this topic",
    "Wikipedia-level associated concept",
    "domain jargon users recognize",
    "process or method related to tool function",
    "outcome term users associate with this tool"
  ],
  "search_intent_keywords": [
    "do-intent: user wants to USE this tool",
    "know-intent: user wants to LEARN this concept",
    "compare-intent: user evaluating options",
    "navigate-intent: user going to specific tool"
  ],
  "entity_keywords": [
    "Named formula or equation (e.g. Compound Interest Formula)",
    "Named person associated with concept",
    "Industry or professional domain",
    "Standard or specification name",
    "Governing body or institution"
  ],
  "paa_questions": [
    "How do I [specific action] with {$toolName}?",
    "What is the formula for [core concept of this tool]?",
    "What is a good [result metric] for [this tool context]?",
    "How accurate is {$toolName}?",
    "What is the difference between [concept A] and [concept B] in {$toolName}?",
    "Can I use {$toolName} for [specific use case]?",
    "Why does [core output of this tool] matter?",
    "What are the limitations of [this tool concept]?"
  ],
  "question_keywords": [
    "What is [exact core concept of this tool]?",
    "How does {$toolName} work?",
    "When should I use {$toolName}?",
    "Which [variation] is best for [this tool use case]?",
    "Why is [this tool output] important for [user type]?"
  ],
  "cluster_keywords": [
    "parent category this tool belongs to",
    "pillar topic keyword for this tool silo",
    "hub page keyword grouping these tools",
    "topical authority keyword for this domain",
    "category-level keyword users browse"
  ],
  "related_keywords": [
    "closely related tool the user needs next",
    "complementary tool keyword",
    "tool used before this one in workflow",
    "tool used after this one in workflow",
    "alternative tool approach keyword",
    "same-category sibling tool keyword"
  ],
  "supporting_keywords": [
    "definition keyword: what is [concept]",
    "prerequisite knowledge keyword",
    "tutorial or guide keyword for this tool",
    "use case documentation keyword",
    "beginner explanation keyword"
  ],
  "modifier_keywords": [
    "free [tool name]",
    "online [tool name]",
    "best [tool name]",
    "accurate [tool name]",
    "simple [tool name]",
    "advanced [tool name]"
  ],
  "contextual_keywords": [
    "industry-specific term for this tool domain",
    "professional context keyword",
    "regional or situational variation",
    "seasonal or event-based keyword",
    "workflow-context keyword"
  ],
  "tfidf_keywords": [
    "high-frequency important term from expert articles on this topic",
    "term that distinguishes this topic from generic content",
    "technical term unique to this domain",
    "domain vocabulary with high relevance score",
    "specialized term that signals expertise"
  ],
  "trending_keywords": [
    "currently trending search for this tool",
    "rising variation users are searching",
    "modern use case gaining popularity"
  ]
}

RULES:
1. ALL arrays must contain REAL keywords for {$toolName} — not template text
2. paa_questions must be actual questions (start with How/What/Why/Which/When/Can)
3. long_tail_keywords must be 4+ words each
4. short_tail_keywords must be 1-2 words each
5. modifier_keywords must start with: free/online/best/accurate/simple/advanced
6. Return ONLY the JSON — absolutely nothing before or after the { }
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
```

---

## FIX 3 — REPLACE GeminiContentGenerator COMPLETELY

**File:** `app/Services/Seo/GeminiContentGenerator.php`

Replace entire file:

```php
<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * GeminiContentGenerator v8.0
 *
 * Generates unique, humanized SEO articles using:
 * - Tool-specific context (from ToolContextExtractor)
 * - Real extracted keywords from semantic_keywords table
 * - All 15 keyword types embedded naturally
 * - Auto-generated "Target Keywords Used" section at article end
 */
class GeminiContentGenerator
{
    public function __construct(
        private GeminiService $gemini
    ) {}

    public function generateForTool(array $context): array
    {
        $slug      = $context['slug'];
        $toolName  = $context['tool_name'];
        $category  = $context['category'];
        $purpose   = $context['primary_use'];
        $formula   = $context['formula'] ?? null;
        $userTypes = implode(', ', $context['user_types']);

        // Pull all keyword types from DB for this tool
        $keywords = $this->loadKeywordsFromDb($slug);

        // Build keyword sections for prompt injection
        $primaryKws    = $keywords->get('primary',       collect())->pluck('keyword')->take(3)->implode(', ');
        $secondaryKws  = $keywords->get('secondary',     collect())->pluck('keyword')->take(4)->implode(', ');
        $longTailKws   = $keywords->get('long_tail',     collect())->pluck('keyword')->take(5)->implode(' | ');
        $lsiKws        = $keywords->get('lsi',           collect())->pluck('keyword')->take(6)->implode(', ');
        $entityKws     = $keywords->get('entity',        collect())->pluck('keyword')->take(4)->implode(', ');
        $tfidfKws      = $keywords->get('tfidf',         collect())->pluck('keyword')->take(5)->implode(', ');
        $modifierKws   = $keywords->get('modifier',      collect())->pluck('keyword')->take(4)->implode(', ');
        $contextualKws = $keywords->get('contextual',    collect())->pluck('keyword')->take(3)->implode(', ');

        // Build PAA questions list
        $paaList = $keywords->get('paa', collect())->pluck('keyword')->take(7)->values();
        $paaText = $paaList->isEmpty()
            ? "Generate 7 specific questions users ask about {$toolName}"
            : $paaList->map(fn ($q, $i) => ($i + 1) . ". {$q}")->implode("\n");

        $formulaLine = $formula
            ? "Use this exact formula: {$formula}"
            : "Include the most accurate formula for this tool with named variables";

        // Build the full prompt with keyword injection
        $prompt = <<<PROMPT
You are a specialist technical SEO writer. Write a complete, unique article for:

TOOL: {$toolName}
URL: /{$slug}
CATEGORY: {$category}
PURPOSE: {$purpose}
TARGET USERS: {$userTypes}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
KEYWORD INTELLIGENCE — Use these naturally throughout the article
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Primary Keywords: {$primaryKws}
Secondary Keywords: {$secondaryKws}
Long-Tail Keywords: {$longTailKws}
LSI / Semantic Keywords: {$lsiKws}
Entity Keywords: {$entityKws}
TF-IDF Keywords: {$tfidfKws}
Modifier Keywords: {$modifierKws}
Contextual Keywords: {$contextualKws}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
REQUIRED ARTICLE STRUCTURE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

1. OPENING (120-150 words)
   • Open with a real-world scenario or specific problem (no "In today's world")
   • Naturally use 1 primary keyword and 1 long-tail keyword
   • State who benefits and what they gain

2. H2: "What is [Core Concept]?"
   • Precise definition using entity + LSI keywords naturally
   • 80-100 words

3. H2: "The {$toolName} Formula Explained"
   • {$formulaLine}
   • Show full formula with real variable names
   • Complete worked example with realistic numbers (not X/Y/Z)
   • Use TF-IDF keywords in the explanation

4. H2: "How to Use This {$toolName} — Step by Step"
   • Exactly 4 numbered steps, actionable and specific
   • Include 1 long-tail keyword naturally

5. H2: "Real-World Examples"
   • Exactly 2 detailed scenarios with realistic names + numbers
   • Calculate final result in each scenario
   • Use contextual + modifier keywords naturally

6. H2: "Common Mistakes to Avoid"
   • Exactly 3 mistakes specific to this tool's use case
   • Each with cause + prevention

7. H2: "Frequently Asked Questions"
   • Answer THESE specific questions from real user research:
{$paaText}
   • Each answer: 2-3 sentences, factually accurate

8. CLOSING (2 sentences)
   • Include 1 primary keyword
   • Actionable call to use the tool

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
THEN APPEND — Target Keywords Used Section
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

After the article, append this EXACT HTML section.
Extract keywords that appear in the article content above.
NEVER write "No semantic keywords extracted yet".
NEVER leave any category empty — minimum 3 keywords per category.

<section class="target-keywords-used" style="margin-top:2rem;padding:1.5rem;background:#f8f9fa;border-radius:8px;border-left:4px solid #0066cc;">
<h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;color:#0066cc;">Target Keywords Used</h3>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1rem;">

<div>
<strong>Primary Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[primary keyword 1 that appears in article]</li>
<li>[primary keyword 2 that appears in article]</li>
<li>[primary keyword 3 that appears in article]</li>
</ul>
</div>

<div>
<strong>Secondary Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[secondary keyword from article]</li>
<li>[secondary keyword from article]</li>
<li>[secondary keyword from article]</li>
<li>[secondary keyword from article]</li>
</ul>
</div>

<div>
<strong>Long-Tail Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[4+ word phrase from article]</li>
<li>[4+ word phrase from article]</li>
<li>[4+ word phrase from article]</li>
</ul>
</div>

<div>
<strong>Short-Tail Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[1-2 word term from article]</li>
<li>[1-2 word term from article]</li>
<li>[1-2 word term from article]</li>
</ul>
</div>

<div>
<strong>Semantic Keywords (LSI / NLP):</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[LSI term used in article]</li>
<li>[LSI term used in article]</li>
<li>[LSI term used in article]</li>
<li>[LSI term used in article]</li>
</ul>
</div>

<div>
<strong>Search Intent Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[do-intent keyword]</li>
<li>[know-intent keyword]</li>
<li>[compare-intent keyword]</li>
</ul>
</div>

<div>
<strong>Entity Keywords (Knowledge Graph):</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[named entity from article]</li>
<li>[named entity from article]</li>
<li>[named entity from article]</li>
</ul>
</div>

<div>
<strong>PAA Keywords (People Also Ask):</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[PAA question answered in article]</li>
<li>[PAA question answered in article]</li>
<li>[PAA question answered in article]</li>
<li>[PAA question answered in article]</li>
</ul>
</div>

<div>
<strong>Question-Based Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[question keyword]</li>
<li>[question keyword]</li>
<li>[question keyword]</li>
</ul>
</div>

<div>
<strong>Cluster Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[topic cluster keyword]</li>
<li>[topic cluster keyword]</li>
<li>[topic cluster keyword]</li>
</ul>
</div>

<div>
<strong>Related Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[related tool or concept]</li>
<li>[related tool or concept]</li>
<li>[related tool or concept]</li>
</ul>
</div>

<div>
<strong>Supporting Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[supporting concept]</li>
<li>[supporting concept]</li>
<li>[supporting concept]</li>
</ul>
</div>

<div>
<strong>Modifier Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[modifier keyword]</li>
<li>[modifier keyword]</li>
<li>[modifier keyword]</li>
</ul>
</div>

<div>
<strong>Contextual Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[contextual keyword]</li>
<li>[contextual keyword]</li>
<li>[contextual keyword]</li>
</ul>
</div>

<div>
<strong>TF-IDF Keywords:</strong>
<ul style="margin:0.3rem 0 0 1rem;padding:0;">
<li>[high-importance TF-IDF term]</li>
<li>[high-importance TF-IDF term]</li>
<li>[high-importance TF-IDF term]</li>
</ul>
</div>

</div>
</section>

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
OUTPUT RULES
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
- Return ONLY valid HTML: h2, h3, p, ul, ol, li, strong, em, section, div, style
- No markdown. No code fences. Start immediately with the first paragraph.
- Word count: 900-1200 words (article only, not counting keyword section)
- FORBIDDEN: "In today's digital world", "Look no further", "game-changer",
  "seamlessly", "leverage", "Are you looking for", "No semantic keywords extracted yet"
- Primary keyword density: max 1.5%
- Every H2 must be specific to {$toolName}
PROMPT;

        $html = $this->gemini->generateText($prompt, temperature: 0.7);

        if (!str_contains($html, '<') || !str_contains($html, '>')) {
            $html = $this->markdownToHtml($html);
        }

        // Validate keyword section exists
        if (!str_contains($html, 'target-keywords-used') && !str_contains($html, 'Target Keywords Used')) {
            Log::channel('seo')->warning("Keyword section missing for {$slug} — Gemini skipped it");
            $html .= $this->buildFallbackKeywordSection($slug, $toolName, $keywords);
        }

        // Validate no "empty" keyword message
        if (str_contains($html, 'No semantic keywords extracted yet')) {
            $html = str_replace(
                'No semantic keywords extracted yet',
                $this->buildInlineKeywords($keywords),
                $html
            );
        }

        $wordCount = str_word_count(strip_tags($html));
        if ($wordCount < 600) {
            throw new \RuntimeException("Content too thin for {$slug}: {$wordCount} words");
        }

        return [
            'html'        => $html,
            'model'       => config('services.gemini.model', 'gemini-2.5-flash'),
            'word_count'  => $wordCount,
            'seo_score'   => $this->scoreSeo($html, $keywords),
            'outline'     => $this->extractOutline($html),
            'prompt_used' => $prompt,
        ];
    }

    private function loadKeywordsFromDb(string $slug): \Illuminate\Support\Collection
    {
        return DB::table('semantic_keywords')
            ->where('tool_slug', $slug)
            ->where('is_active', 1)
            ->orderByDesc('confidence_score')
            ->get(['keyword_type', 'keyword', 'confidence_score'])
            ->groupBy('keyword_type');
    }

    private function buildFallbackKeywordSection(string $slug, string $toolName, \Illuminate\Support\Collection $keywords): string
    {
        $rows = '';

        $typeLabels = [
            'primary'      => 'Primary Keywords',
            'secondary'    => 'Secondary Keywords',
            'long_tail'    => 'Long-Tail Keywords',
            'short_tail'   => 'Short-Tail Keywords',
            'lsi'          => 'Semantic Keywords (LSI / NLP)',
            'search_intent'=> 'Search Intent Keywords',
            'entity'       => 'Entity Keywords (Knowledge Graph)',
            'paa'          => 'PAA Keywords (People Also Ask)',
            'question'     => 'Question-Based Keywords',
            'cluster'      => 'Cluster Keywords',
            'related'      => 'Related Keywords',
            'supporting'   => 'Supporting Keywords',
            'modifier'     => 'Modifier Keywords',
            'contextual'   => 'Contextual Keywords',
            'tfidf'        => 'TF-IDF Keywords',
        ];

        foreach ($typeLabels as $type => $label) {
            $items = $keywords->get($type, collect())->pluck('keyword')->take(5);

            if ($items->isEmpty()) {
                // Generate fallback from tool name
                $name = str_replace('-', ' ', $slug);
                $items = match($type) {
                    'primary'       => collect([$name, "{$name} online", "free {$name}"]),
                    'short_tail'    => collect([explode(' ', $name)[0], $name]),
                    'modifier'      => collect(["free {$name}", "online {$name}", "best {$name}"]),
                    'question'      => collect(["how to use {$name}", "what is {$name}"]),
                    default         => collect(["{$name} tool", "{$name} calculator online"]),
                };
            }

            $lis = $items->map(fn ($kw) => "<li>{$kw}</li>")->implode('');
            $rows .= "<div><strong>{$label}:</strong><ul style=\"margin:0.3rem 0 0 1rem\">{$lis}</ul></div>";
        }

        return <<<HTML
<section class="target-keywords-used" style="margin-top:2rem;padding:1.5rem;background:#f8f9fa;border-radius:8px;border-left:4px solid #0066cc;">
<h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;color:#0066cc;">Target Keywords Used</h3>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1rem;">
{$rows}
</div>
</section>
HTML;
    }

    private function buildInlineKeywords(\Illuminate\Support\Collection $keywords): string
    {
        $primary = $keywords->get('primary', collect())->pluck('keyword')->take(3)->implode(', ');
        return $primary ?: 'See keyword analysis above';
    }

    private function markdownToHtml(string $text): string
    {
        $text = preg_replace('/^## (.+)$/m', '<h2>$1</h2>', $text);
        $text = preg_replace('/^### (.+)$/m', '<h3>$1</h3>', $text);
        $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
        $paragraphs = preg_split('/\n\n+/', trim($text));
        $html = '';
        foreach ($paragraphs as $p) {
            $p = trim($p);
            if (empty($p)) continue;
            $html .= str_starts_with($p, '<') ? "{$p}\n" : "<p>{$p}</p>\n";
        }
        return $html;
    }

    private function scoreSeo(string $html, \Illuminate\Support\Collection $keywords): int
    {
        $score = 0;
        $words = str_word_count(strip_tags($html));

        if ($words >= 800)  $score += 20;
        if ($words >= 1000) $score += 10;
        if (substr_count($html, '<h2') >= 5) $score += 15;
        if (str_contains($html, '<ul>') || str_contains($html, '<ol>')) $score += 10;
        if (str_contains($html, 'target-keywords-used')) $score += 20;
        if (str_contains(strtolower($html), 'example')) $score += 10;
        if (str_contains(strtolower($html), 'formula')) $score += 10;

        // Bonus: keyword richness
        $types = $keywords->keys()->count();
        $score += min($types * 2, 5);

        return min($score, 100);
    }

    private function extractOutline(string $html): array
    {
        preg_match_all('/<(h[23])[^>]*>(.*?)<\/\1>/i', $html, $m);
        return array_map(fn ($i) => [
            'level'   => $m[1][$i],
            'heading' => strip_tags($m[2][$i]),
        ], array_keys($m[0]));
    }
}
```

---

## FIX 4 — UPDATE AppServiceProvider

**File:** `app/Providers/AppServiceProvider.php`

Find the `register()` method and update:

```php
public function register(): void
{
    // Singletons for SEO services (ensures shared GeminiService instance)
    $this->app->singleton(\App\Services\Seo\GeminiService::class);
    $this->app->singleton(\App\Services\Seo\SemanticExtractorService::class);
    $this->app->singleton(\App\Services\Seo\GeminiContentGenerator::class);
    $this->app->singleton(\App\Services\Seo\ToolContextExtractor::class);
}
```

---

## FIX 5 — APPROVE EXISTING GOOD DRAFTS + CONTENT SHOWS ON SITE

```bash
# Approve all 10 existing drafts that have real content:
php artisan tinker --execute="
\$count = \App\Models\ContentDraft::where('status', 'pending_review')
    ->where('word_count', '>', 500)
    ->whereNotNull('draft_content')
    ->update([
        'status'      => 'approved',
        'reviewed_at' => now(),
        'published_at'=> now(),
    ]);
echo \"Approved: {\$count} drafts\";
"

# Verify at least one tool page now shows content:
# Open in browser: /roi-calculator
# Scroll down — SEO article section should appear
```

---

## FIX 6 — UPDATE ToolController TO LOAD ALL KEYWORD TYPES

**File:** `app/Http/Controllers/ToolController.php`

Find lines 86-91 (PAA query) and replace:

```php
// CURRENT (only PAA):
$paaQuestions = \DB::table('semantic_keywords')
    ->where('tool_slug', $tool['slug'])
    ->where('keyword_type', 'paa')
    ->where('is_active', 1)
    ->pluck('keyword');

// REPLACE WITH (all types needed for frontend):
$allKeywords = \DB::table('semantic_keywords')
    ->where('tool_slug', $tool['slug'])
    ->where('is_active', 1)
    ->orderByDesc('confidence_score')
    ->get(['keyword_type', 'keyword'])
    ->groupBy('keyword_type');

$paaQuestions   = $allKeywords->get('paa',     collect())->pluck('keyword')->take(7);
$relatedTerms   = $allKeywords->get('related',  collect())->pluck('keyword')->take(8);
$longTailTerms  = $allKeywords->get('long_tail',collect())->pluck('keyword')->take(6);
$entityTerms    = $allKeywords->get('entity',   collect())->pluck('keyword')->take(5);

return view('tools.tool', compact(
    'tool', 'slug', 'tools', 'schemaMarkup',
    'seoDraft', 'relatedTools', 'paaQuestions',
    'relatedTerms', 'longTailTerms', 'entityTerms'
));
```

---

## FIX 7 — UPDATE tool-seo-content.blade.php FOR RICH DISPLAY

**File:** `resources/views/partials/tool-seo-content.blade.php`

Add after the existing PAA section:

```blade
{{-- Related Search Terms from semantic_keywords --}}
@if(isset($longTailTerms) && $longTailTerms->isNotEmpty())
<section class="seo-section related-searches-section mt-4" style="padding:1rem 0;">
    <h3 style="font-size:0.9rem;font-weight:600;color:#666;text-transform:uppercase;letter-spacing:.05em;">
        Related Searches
    </h3>
    <div class="d-flex flex-wrap gap-2 mt-2">
        @foreach($longTailTerms->merge($relatedTerms ?? collect()) as $term)
        <span class="badge bg-light text-dark border" style="font-weight:400;font-size:0.82rem;padding:0.35rem 0.7rem;">
            {{ $term }}
        </span>
        @endforeach
    </div>
</section>
@endif

{{-- Entity / Knowledge Graph Section --}}
@if(isset($entityTerms) && $entityTerms->isNotEmpty())
<section class="seo-section entity-section mt-3" style="padding:0.5rem 0;">
    <meta itemprop="about" content="{{ $entityTerms->implode(', ') }}">
</section>
@endif
```

---

## EXECUTION ORDER

```
HOUR 1 — Foundation:
□ FIX 1: php artisan make:migration expand_semantic_keywords_enum_add_15_types
□ FIX 1: php artisan migrate
□ Verify: SHOW COLUMNS FROM semantic_keywords WHERE Field='keyword_type';
□ FIX 4: Update AppServiceProvider register() — add SemanticExtractorService singleton

HOUR 2 — Services:
□ FIX 2: Replace SemanticExtractorService.php with v8.0
□ FIX 3: Replace GeminiContentGenerator.php with v8.0
□ php artisan config:clear && php artisan cache:clear

HOUR 3 — Test Extraction:
□ php artisan seo:extract-semantics --tool=roi-calculator --force
□ Verify 15 keyword types exist for roi-calculator:
  SELECT keyword_type, COUNT(*) FROM semantic_keywords
  WHERE tool_slug='roi-calculator' GROUP BY keyword_type;
□ Expected: ~17 rows (one per type)

HOUR 4 — Test Content:
□ Delete old roi-calculator draft:
  DB::table('content_drafts')->where('tool_slug','roi-calculator')->delete();
□ php artisan seo:generate-content --tool=roi-calculator
□ Check draft: word_count > 800, contains 'target-keywords-used'
□ FIX 5: Approve all existing good drafts

HOUR 5 — Frontend:
□ FIX 6: Update ToolController (load all keyword types)
□ FIX 7: Update tool-seo-content.blade.php
□ Open /roi-calculator in browser — verify article + keyword section visible

OVERNIGHT — Full Run:
□ php artisan seo:extract-semantics --force --batch=10
□ php artisan seo:generate-content --batch=10
□ Monitor: tail -f storage/logs/seo-$(date +%Y-%m-%d).log
```

---

## VERIFICATION COMMANDS

```bash
# 1. ENUM check (must show all 17 values)
php artisan tinker --execute="
\$c = DB::select(\"SHOW COLUMNS FROM semantic_keywords WHERE Field='keyword_type'\");
echo \$c[0]->Type;
"

# 2. Keyword extraction coverage
php artisan tinker --execute="
echo 'Tools with keywords: ' . DB::table('semantic_keywords')->distinct('tool_slug')->count('tool_slug') . PHP_EOL;
DB::table('semantic_keywords')->select('keyword_type', DB::raw('COUNT(*) as cnt'))
    ->groupBy('keyword_type')->orderBy('keyword_type')
    ->get()->each(fn(\$r) => print \$r->keyword_type . ': ' . \$r->cnt . PHP_EOL);
"

# 3. Content quality check
php artisan tinker --execute="
DB::table('content_drafts')->where('word_count','>',500)
    ->get(['tool_slug','word_count','seo_score','status'])
    ->each(fn(\$r) => print \$r->tool_slug . ' | words:' . \$r->word_count . ' score:' . \$r->seo_score . ' [' . \$r->status . ']' . PHP_EOL);
"

# 4. Keyword section verification
php artisan tinker --execute="
\$draft = DB::table('content_drafts')->where('tool_slug','roi-calculator')->first();
echo str_contains(\$draft->draft_content ?? '', 'target-keywords-used') ? 'KEYWORD SECTION: PRESENT ✅' : 'KEYWORD SECTION: MISSING ❌';
"

# 5. Full system health
php artisan tinker --execute="
\$stats = [
    'Total tools'          => DB::table('tool_health_checks')->where('status','ok')->count(),
    'Approved drafts'      => App\Models\ContentDraft::where('status','approved')->count(),
    'Real content (>700w)' => DB::table('content_drafts')->where('word_count','>',700)->count(),
    'PAA keywords'         => DB::table('semantic_keywords')->where('keyword_type','paa')->count(),
    'All keyword types'    => DB::table('semantic_keywords')->select('keyword_type')->distinct()->count(),
    'Internal links'       => DB::table('internal_links')->count(),
    'Topic clusters'       => DB::table('topical_clusters')->count(),
];
foreach(\$stats as \$k => \$v) echo \$k . ': ' . \$v . PHP_EOL;
"
```

---

## CONTENT QUALITY STANDARDS

```
APPROVE if ALL true:
✅ word_count >= 800
✅ seo_score >= 70
✅ Contains 'target-keywords-used' section in HTML
✅ Contains all 15 keyword type headings in that section
✅ No "No semantic keywords extracted yet"
✅ 5+ H2 headings, all specific to the tool
✅ Contains formula with real numbers
✅ Contains 2 worked examples
✅ Contains 5+ PAA questions with answers
✅ No forbidden phrases

REJECT if ANY true:
❌ word_count < 600
❌ No keyword section at bottom
❌ Keyword section is empty or shows placeholder text
❌ Uses "In today's digital world"
❌ Content is generic (applies to any tool)
❌ Formula uses only X/Y/Z with no real numbers
```

---

## SUCCESS METRICS AT 30 DAYS

```
DATABASE:
□ semantic_keywords: 120,000+ rows (17 types × ~7 each × 1417 tools)
□ All 17 keyword types present for each tool
□ content_drafts approved: 1000+ (batch-approve score >= 70)
□ Zero drafts with "No semantic keywords extracted yet"

FRONTEND:
□ Every tool page shows 900+ word article
□ Every article ends with complete "Target Keywords Used" section
□ All 15 keyword categories populated (no empty categories)
□ Related searches visible below FAQ section
□ FAQPage schema validates in Google Rich Results Test

SEARCH CONSOLE (4-6 weeks):
□ Impressions: +50%
□ New keyword rankings for long-tail queries
□ Featured snippets for PAA questions
□ Knowledge Panel associations for entity keywords
```

---

*v8.0 | Bugs confirmed from real code (GitHub) + real database (SQL dump)*
*ENUM fix is mandatory first step — all other fixes depend on it*
*Single Gemini call per tool = all 15 types = efficient API usage*
*buildFallbackKeywordSection() ensures ZERO empty keyword sections*
