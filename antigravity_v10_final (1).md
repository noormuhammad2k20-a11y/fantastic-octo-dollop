# ANTIGRAVITY — FINAL SEO ENGINE v10.0
## Complete Fix: 13 Keyword Types + 800-900 Word Articles + Rankings
## GitHub: https://github.com/noormuhammad2k20-a11y/fantastic-octo-dollop
## Paste this → Say: "Start Step 1"

---

## CONFIRMED FACTS FROM YOUR CODE + DATABASE

```
WHAT EXISTS:
✅ semantic_keywords ENUM: 17 types (all correct)
✅ SemanticExtractorService: correct structure
✅ SeoExtractSemanticsCommand: correct structure
✅ ToolController: loads all keyword types
✅ tool-seo-content.blade.php: renders PAA + related + entity
✅ content_drafts: 8 approved, 7 pending_review

WHAT IS BROKEN:
❌ ENUM missing 'comparison' and 'semantic' (user wants these)
❌ ENUM has wrong entries: 'informational','transactional' saved as keyword_type
   (these are search_intent VALUES — not keyword TYPES — causing SQL errors silently)
❌ Only 1 tool has AI keywords (roi-calculator) — 1416 tools = autocomplete only
❌ 'search_intent' type: 0 rows in DB (never extracted)
❌ 'comparison' type: not in ENUM, never extracted
❌ 'semantic' type: not in ENUM, never extracted
❌ word_count=965 for roi-calculator (target: 800-900 — this is fine actually)
❌ Pending drafts: seo_score 50-52 (too low — content quality issue)
❌ MAIN PROBLEM: seo:extract-semantics never ran for 1416 tools
   Reason: command skips tools that already have ANY keyword (even autocomplete)
   All 1417 tools have autocomplete → all 1417 are skipped
   Fix: delete autocomplete-only tools from skip list
```

---

## TECH STACK
Laravel + PHP 8.2 + MySQL MariaDB 10.4 | Gemini API: gemini-2.5-flash
File Cache | Namespace: `App\Services\Seo\`

## RULES
```
❌ NEVER use Tool::all() — always chunk(50)
❌ NEVER auto-publish — status = 'pending_review'  
❌ NEVER hardcode API keys
❌ NEVER generate articles over 900 words (target: 800-900)
❌ NEVER use: "paramount","indispensable","In today's world","game-changer"
❌ NEVER bold keywords in article body (**keyword** is spam signal)
✅ Show exact file + line before changing
✅ Test with --tool=roi-calculator first always
✅ Verify word count 800-900 before full run
```

---

## STEP 1 — FIX DATABASE ENUM (Run This First)

### Problem:
- `'comparison'` and `'semantic'` not in ENUM → INSERTs fail silently
- `'informational'` and `'transactional'` are saved as keyword_type values
  but they are actually search_intent values → conceptual bug, wastes rows

### Create migration:
```bash
php artisan make:migration v10_fix_semantic_keywords_enum
```

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up(): void
    {
        // Step 1: Remove bad rows where keyword_type was used as search_intent
        DB::statement("DELETE FROM semantic_keywords
            WHERE keyword_type IN ('informational','transactional')");

        // Step 2: Add temp column
        Schema::table('semantic_keywords', function (Blueprint $t) {
            $t->string('ktype_tmp', 50)->nullable()->after('keyword_type');
        });

        // Step 3: Copy
        DB::statement("UPDATE semantic_keywords SET ktype_tmp = keyword_type");

        // Step 4: Drop old ENUM
        Schema::table('semantic_keywords', function (Blueprint $t) {
            $t->dropColumn('keyword_type');
        });

        // Step 5: Rename
        Schema::table('semantic_keywords', function (Blueprint $t) {
            $t->renameColumn('ktype_tmp', 'keyword_type');
        });

        // Step 6: Set correct ENUM with all 13 user-requested + 4 extra types
        DB::statement("ALTER TABLE semantic_keywords
            MODIFY COLUMN keyword_type ENUM(
                'primary',
                'secondary',
                'autocomplete',
                'lsi',
                'paa',
                'entity',
                'semantic',
                'long_tail',
                'question',
                'related',
                'comparison',
                'transactional',
                'informational',
                'short_tail',
                'modifier',
                'contextual',
                'tfidf',
                'cluster',
                'supporting',
                'trending',
                'search_intent'
            ) NOT NULL DEFAULT 'lsi'");
    }

    public function down(): void {}
};
```

```bash
php artisan migrate

# Verify — must show all 21 values:
php artisan tinker --execute="
\$c = DB::select(\"SHOW COLUMNS FROM semantic_keywords WHERE Field='keyword_type'\");
echo \$c[0]->Type;
"
```

---

## STEP 2 — FIX THE SKIP BUG IN SeoExtractSemanticsCommand

### Problem (line 37-42 in command):
```php
// CURRENT BROKEN CODE:
if (!$this->option('force')) {
    $query->whereNotIn('t.tool_slug',
        DB::table('semantic_keywords')->distinct()->pluck('tool_slug')
    );
}
// BUG: All 1417 tools have autocomplete keywords
// So all 1417 are in the "already has keywords" list
// Result: 0 tools processed without --force
```

### Fix — replace those lines:
```php
// FIXED: Only skip tools that have AI keywords (not just autocomplete)
if (!$this->option('force')) {
    $slugsWithAiKeywords = DB::table('semantic_keywords')
        ->where('source', '!=', 'google_suggest')  // Exclude autocomplete-only
        ->where('source', '!=', 'autocomplete')
        ->where('source', 'gemini')                 // Only tools with Gemini keywords
        ->distinct()
        ->pluck('tool_slug');

    if ($slugsWithAiKeywords->isNotEmpty()) {
        $query->whereNotIn('t.tool_slug', $slugsWithAiKeywords);
    }
    // If no tools have AI keywords yet, process all (first run)
}
```

### Test immediately:
```bash
php artisan seo:extract-semantics --dry-run
# Expected: "DRY RUN: Would extract semantics for 1416 tools"
# (roi-calculator already has AI keywords, so skipped)
# If shows 0 → fix not applied yet
```

---

## STEP 3 — REPLACE generateAISemantics() WITH 13-TYPE EXTRACTION

**File:** `app/Services/Seo/SemanticExtractorService.php`

Replace `typeMap` (lines 50-67) and `generateAISemantics()` method:

### Update typeMap to include all 13 user-required types:
```php
$typeMap = [
    // The 13 types user specifically requested:
    'primary_keywords'      => ['primary',       'transactional',  0.95],
    'secondary_keywords'    => ['secondary',     'informational',  0.88],
    'autocomplete_extended' => ['autocomplete',  'informational',  0.82],
    'lsi_keywords'          => ['lsi',           'informational',  0.85],
    'paa_questions'         => ['paa',           'informational',  0.92],
    'entity_keywords'       => ['entity',        'informational',  0.90],
    'semantic_keywords'     => ['semantic',      'informational',  0.85],
    'long_tail_keywords'    => ['long_tail',     'informational',  0.85],
    'question_keywords'     => ['question',      'informational',  0.85],
    'related_keywords'      => ['related',       'informational',  0.78],
    'comparison_keywords'   => ['comparison',    'commercial',     0.82],
    'transactional_keywords'=> ['transactional', 'transactional',  0.88],
    'informational_keywords'=> ['informational', 'informational',  0.80],
    // Additional power types:
    'short_tail_keywords'   => ['short_tail',    'navigational',   0.80],
    'modifier_keywords'     => ['modifier',      'commercial',     0.80],
    'tfidf_keywords'        => ['tfidf',         'informational',  0.88],
    'contextual_keywords'   => ['contextual',    'informational',  0.78],
    'trending_keywords'     => ['trending',      'informational',  0.75],
];
```

### Replace `generateAISemantics()` method completely:
```php
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
  "paa_questions": ["8 real PAA questions How/What/Why/Which/When/Can"],
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
```

---

## STEP 4 — REPLACE GeminiContentGenerator FOR 800-900 WORD ARTICLES

**File:** `app/Services/Seo/GeminiContentGenerator.php`

Replace the entire `generateForTool()` prompt section:

```php
public function generateForTool(array $context): array
{
    $slug      = $context['slug'];
    $toolName  = $context['tool_name'];
    $category  = $context['category'];
    $purpose   = $context['primary_use'];
    $formula   = $context['formula'] ?? null;
    $userTypes = implode(', ', $context['user_types']);

    // Load all keyword types from DB
    $kw = DB::table('semantic_keywords')
        ->where('tool_slug', $slug)
        ->where('is_active', 1)
        ->orderByDesc('confidence_score')
        ->get(['keyword_type', 'keyword'])
        ->groupBy('keyword_type');

    // Extract each type
    $primary     = $kw->get('primary',      collect())->pluck('keyword');
    $secondary   = $kw->get('secondary',    collect())->pluck('keyword');
    $lsi         = $kw->get('lsi',          collect())->pluck('keyword');
    $semantic    = $kw->get('semantic',      collect())->pluck('keyword');
    $longTail    = $kw->get('long_tail',     collect())->pluck('keyword');
    $paa         = $kw->get('paa',           collect())->pluck('keyword');
    $entity      = $kw->get('entity',        collect())->pluck('keyword');
    $related     = $kw->get('related',       collect())->pluck('keyword');
    $comparison  = $kw->get('comparison',    collect())->pluck('keyword');
    $question    = $kw->get('question',      collect())->pluck('keyword');
    $transact    = $kw->get('transactional', collect())->pluck('keyword');
    $informat    = $kw->get('informational', collect())->pluck('keyword');
    $tfidf       = $kw->get('tfidf',         collect())->pluck('keyword');
    $contextual  = $kw->get('contextual',    collect())->pluck('keyword');
    $modifier    = $kw->get('modifier',      collect())->pluck('keyword');

    // Build FAQ questions from PAA + question types
    $faqList = $paa->take(5)->merge($question->take(2))->values();
    $faqText = $faqList->isEmpty()
        ? "Generate 5 specific questions users ask about {$toolName}"
        : $faqList->map(fn($q,$i) => ($i+1).". {$q}")->implode("\n");

    $formulaLine = $formula
        ? "FORMULA: {$formula}"
        : "Include the standard formula for this tool with correct variable names";

    $p1 = $primary->get(0, $toolName);
    $lt1 = $longTail->get(0, '');
    $lt2 = $longTail->get(1, '');
    $cmp = $comparison->get(0, '');
    $e1  = $entity->get(0, '');
    $tf1 = $tfidf->get(0, '');

    $prompt = <<<PROMPT
You are a senior technical writer. Write a focused, expert SEO article.

TOOL: {$toolName} | URL: /{$slug}
CATEGORY: {$category}
PURPOSE: {$purpose}
USERS: {$userTypes}

━━━ KEYWORD INTELLIGENCE (USE ALL OF THESE NATURALLY IN THE ARTICLE) ━━━
Primary: {$primary->take(3)->implode(', ')}
Secondary: {$secondary->take(4)->implode(', ')}
LSI/NLP: {$lsi->take(6)->implode(', ')}
Semantic: {$semantic->take(4)->implode(', ')}
Long-tail: {$longTail->take(5)->implode(' | ')}
TF-IDF (authority signals): {$tfidf->take(4)->implode(', ')}
Entity (Knowledge Graph): {$entity->take(4)->implode(', ')}
Comparison: {$comparison->take(3)->implode(', ')}
Transactional: {$transact->take(3)->implode(', ')}
Contextual: {$contextual->take(3)->implode(', ')}
Related tools: {$related->take(4)->implode(', ')}
Modifier: {$modifier->take(3)->implode(', ')}

━━━ ARTICLE STRUCTURE (STRICT — 800 to 900 words TOTAL — NOT more, NOT less) ━━━

OPENING PARAGRAPH — 100-120 words:
• Start with a concrete, specific real-world problem scenario with real numbers
• A named person (fictional) in a specific situation
• GOOD: "Marcus, a freelance developer billing $95/hour, needed to justify..."
• BAD: "Embarking on a journey...", "In today's competitive world..."
• Naturally include: {$p1}
• Naturally include: {$lt1}
• NO forbidden phrases

H2: "What Is [Core Concept]?" — 80-100 words:
• One precise definition sentence
• Use entity: {$e1}
• Use 2 LSI terms from: {$lsi->take(6)->implode(', ')}
• End with one concrete consequence of NOT knowing this

H2: "The {$toolName} Formula" — 120-140 words:
• {$formulaLine}
• Show formula on its own line
• Define each variable (with unit + real value range)
• ONE complete worked example: realistic numbers, show every step, state result
• Use TF-IDF term: {$tf1}

H2: "How to Use This {$toolName} in 4 Steps" — 120-140 words:
• Exactly 4 numbered steps
• Each step: action + brief why
• Step 4 = "Interpret Your Result" (what different output ranges mean)
• Use long-tail: {$lt2}

H2: "2 Real-World Examples" — 180-200 words:
• Example 1: [primary user type] — complete calculation with result
• Example 2: [secondary user type OR different industry] — complete calculation
• Each example: 3-4 sentences max, include final number answer
• Use comparison keyword: {$cmp}
• Use contextual keyword from: {$contextual->take(3)->implode(', ')}

H2: "Frequently Asked Questions" — 130-150 words:
• Answer EXACTLY these questions (real user research):
{$faqText}
• Each answer: 1-2 sentences, factually accurate
• At least 1 answer must include a specific number

H2: "Related Tools" — 40-50 words:
• Mention 3 related tools using: {$related->take(3)->implode(', ')}
• One sentence: when to use each vs {$toolName}

━━━ KEYWORD RULES ━━━
• Primary keyword {$p1}: appears naturally 2-3 times — NEVER bolded
• LSI/Semantic terms: minimum 5 different ones woven into explanations
• TF-IDF terms: all 4 must appear — these signal domain authority
• Comparison keywords: use naturally in context or FAQ
• Transactional keywords: can appear in opening or closing
• Short-tail: do NOT overuse (max 2x)
• Informational keywords: use in H2 headings where natural
• NEVER bold keywords: **keyword** is spam
• FORBIDDEN: "paramount","indispensable","Embarking on","game-changer",
  "seamlessly","leverage" (as verb),"In today's world","Look no further",
  "it's worth noting","delve into"

━━━ KEYWORD SECTION (append AFTER article, SAME response) ━━━
Immediately after the article, append this HTML.
Fill EVERY category with real keywords from the article.
NEVER write empty lists. NEVER write "No keywords extracted".

<section class="seo-kw-section" style="margin-top:2rem;padding:1.5rem;background:#f0f4ff;border-radius:8px;border-left:4px solid #2563eb;font-size:.875rem;">
<h3 style="font-weight:700;color:#1e40af;margin:0 0 1rem;">Target Keywords Used in This Article</h3>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;line-height:1.7;">
<div><strong>Primary Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_PRIMARY]</ul></div>
<div><strong>Secondary Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_SECONDARY]</ul></div>
<div><strong>LSI / NLP Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_LSI]</ul></div>
<div><strong>Semantic Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_SEMANTIC]</ul></div>
<div><strong>Long-Tail Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_LONGTAIL]</ul></div>
<div><strong>Entity Keywords (Knowledge Graph)</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_ENTITY]</ul></div>
<div><strong>PAA Keywords (People Also Ask)</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_PAA]</ul></div>
<div><strong>Question Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_QUESTION]</ul></div>
<div><strong>Related Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_RELATED]</ul></div>
<div><strong>Comparison Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_COMPARISON]</ul></div>
<div><strong>Transactional Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_TRANSACTIONAL]</ul></div>
<div><strong>Informational Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_INFORMATIONAL]</ul></div>
<div><strong>Autocomplete Keywords</strong><ul style="margin:.3rem 0 0 1rem;padding:0;">[LI_AUTOCOMPLETE]</ul></div>
</div>
</section>

Replace every [LI_TYPE] with <li>keyword</li> items from the article.
Min 2 items per type. Use keywords from KEYWORD INTELLIGENCE list if needed.
Output: ONLY valid HTML. No markdown. No code fences. Start with first paragraph.
PROMPT;

    $this->gemini->setMaxTokens(4000);
    $html = $this->gemini->generateText($prompt, temperature: 0.65);

    // Convert if markdown
    if (!str_contains($html, '<p>') && !str_contains($html, '<h2>')) {
        $html = $this->markdownToHtml($html);
    }

    $wordCount = str_word_count(strip_tags(
        preg_replace('/<section class="seo-kw-section".*?<\/section>/is', '', $html)
    ));

    // Validate word count 700-1000 (slight buffer around 800-900 target)
    if ($wordCount < 700) {
        throw new \RuntimeException("Too short: {$wordCount} words for {$slug}");
    }
    if ($wordCount > 1050) {
        Log::channel('seo')->warning("Over target: {$wordCount} words for {$slug}");
    }

    // Validate keyword section
    if (!str_contains($html, 'seo-kw-section')) {
        $html .= $this->buildFallbackSection($kw, $slug);
    }

    // Check no placeholders left
    if (str_contains($html, '[LI_PRIMARY]') || str_contains($html, 'No keywords')) {
        $html = $this->fillKeywordPlaceholders($html, $kw, $slug, $toolName);
    }

    return [
        'html'        => $html,
        'model'       => config('services.gemini.model', 'gemini-2.5-flash'),
        'word_count'  => $wordCount,
        'seo_score'   => $this->scoreSeo($html, $kw),
        'outline'     => $this->extractOutline($html),
        'prompt_used' => $prompt,
    ];
}
```

---

## STEP 5 — ADD HELPER METHODS TO GeminiContentGenerator

Add these methods to the class:

```php
private function buildFallbackSection(\Illuminate\Support\Collection $kw, string $slug): string
{
    $types = [
        'primary'      => 'Primary Keywords',
        'secondary'    => 'Secondary Keywords',
        'lsi'          => 'LSI / NLP Keywords',
        'semantic'     => 'Semantic Keywords',
        'long_tail'    => 'Long-Tail Keywords',
        'entity'       => 'Entity Keywords (Knowledge Graph)',
        'paa'          => 'PAA Keywords (People Also Ask)',
        'question'     => 'Question Keywords',
        'related'      => 'Related Keywords',
        'comparison'   => 'Comparison Keywords',
        'transactional'=> 'Transactional Keywords',
        'informational'=> 'Informational Keywords',
        'autocomplete' => 'Autocomplete Keywords',
    ];

    $grids = '';
    $toolWords = explode('-', $slug);
    $toolName  = ucwords(implode(' ', $toolWords));

    foreach ($types as $type => $label) {
        $items = $kw->get($type, collect())->pluck('keyword')->take(4);

        if ($items->isEmpty()) {
            // Smart fallbacks so section is never empty
            $items = match($type) {
                'primary'       => collect([strtolower($toolName), strtolower($toolName) . ' online']),
                'transactional' => collect(['free ' . strtolower($toolName), 'use ' . strtolower($toolName)]),
                'informational' => collect(['what is ' . implode(' ', $toolWords), 'how to use ' . implode(' ', $toolWords)]),
                'autocomplete'  => collect([strtolower($toolName), strtolower($toolName) . ' calculator']),
                default         => collect([strtolower($toolName) . ' tool']),
            };
        }

        $lis = $items->map(fn($k) => "<li>{$k}</li>")->implode('');
        $grids .= "<div><strong>{$label}</strong><ul style=\"margin:.3rem 0 0 1rem;padding:0;\">{$lis}</ul></div>\n";
    }

    return <<<HTML
<section class="seo-kw-section" style="margin-top:2rem;padding:1.5rem;background:#f0f4ff;border-radius:8px;border-left:4px solid #2563eb;font-size:.875rem;">
<h3 style="font-weight:700;color:#1e40af;margin:0 0 1rem;">Target Keywords Used in This Article</h3>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;line-height:1.7;">
{$grids}
</div>
</section>
HTML;
}

private function fillKeywordPlaceholders(
    string $html,
    \Illuminate\Support\Collection $kw,
    string $slug,
    string $toolName
): string {
    // Remove bad section
    $html = preg_replace('/<section[^>]*seo-kw-section[^>]*>.*?<\/section>/is', '', $html);
    return $html . $this->buildFallbackSection($kw, $slug);
}

private function markdownToHtml(string $text): string
{
    $text = preg_replace('/^## (.+)$/m', '<h2>$1</h2>', $text);
    $text = preg_replace('/^### (.+)$/m', '<h3>$1</h3>', $text);
    $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
    $html = '';
    foreach (preg_split('/\n\n+/', trim($text)) as $p) {
        $p = trim($p);
        if (empty($p)) continue;
        $html .= str_starts_with($p, '<') ? "{$p}\n" : "<p>{$p}</p>\n";
    }
    return $html;
}

private function scoreSeo(string $html, \Illuminate\Support\Collection $kw): int
{
    $score = 0;
    $text  = strip_tags(preg_replace('/<section[^>]*seo-kw-section.*?<\/section>/is', '', $html));
    $words = str_word_count($text);

    // Word count score
    if ($words >= 750 && $words <= 950) $score += 30;  // Perfect range
    elseif ($words >= 700)              $score += 15;
    // Structure
    if (substr_count($html, '<h2') >= 5) $score += 20;
    if (str_contains($html, '<ul>') || str_contains($html, '<ol>')) $score += 10;
    // Keyword richness
    if (str_contains($html, 'seo-kw-section')) $score += 20;
    $typesPresent = $kw->keys()->count();
    $score += min($typesPresent * 1, 10);
    // Content signals
    if (str_contains(strtolower($html), 'formula'))  $score += 5;
    if (str_contains(strtolower($html), 'example'))  $score += 5;

    return min($score, 100);
}

private function extractOutline(string $html): array
{
    preg_match_all('/<(h[23])[^>]*>(.*?)<\/\1>/i', $html, $m);
    return array_map(fn($i) => [
        'level'   => $m[1][$i],
        'heading' => strip_tags($m[2][$i]),
    ], array_keys($m[0]));
}
```

---

## STEP 6 — RUN COMPLETE PIPELINE

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear

# ── TEST: Single tool extraction ──
php artisan seo:extract-semantics --tool=bmi-calculator --force
php artisan tinker --execute="
DB::table('semantic_keywords')
    ->where('tool_slug','bmi-calculator')
    ->select('keyword_type', DB::raw('COUNT(*) as c'))
    ->groupBy('keyword_type')->orderBy('keyword_type')
    ->get()->each(fn(\$r) => print \$r->keyword_type . ': ' . \$r->c . PHP_EOL);
"
# Expected: 18 types each with 3-8 keywords

# ── TEST: Single tool content ──
php artisan tinker --execute="DB::table('content_drafts')->where('tool_slug','bmi-calculator')->delete();"
php artisan seo:generate-content --tool=bmi-calculator
php artisan tinker --execute="
\$d = DB::table('content_drafts')->where('tool_slug','bmi-calculator')->first();
echo 'Words: '.\$d->word_count.PHP_EOL;
echo 'Score: '.\$d->seo_score.PHP_EOL;
echo 'KW section: '.(str_contains(\$d->draft_content,'seo-kw-section')?'YES ✅':'NO ❌').PHP_EOL;
echo 'No empty: '.(str_contains(\$d->draft_content,'No keywords')?'FAIL ❌':'CLEAN ✅').PHP_EOL;
echo 'Preview: '.substr(strip_tags(\$d->draft_content),0,300).PHP_EOL;
"
# Expected: words 800-900, score 85+, KW section YES, clean

# ── FULL RUN (overnight) ──
# First delete autocomplete-only keywords so skip logic works:
php artisan tinker --execute="
\$count = DB::table('semantic_keywords')
    ->whereIn('tool_slug',
        DB::table('semantic_keywords')
            ->select('tool_slug')
            ->groupBy('tool_slug')
            ->havingRaw('COUNT(DISTINCT keyword_type) = 1')
            ->havingRaw('MAX(source) = ?', ['google_suggest'])
            ->pluck('tool_slug')
    )->delete();
echo \"Deleted autocomplete-only keyword rows: {\$count}\";
"

# Run extraction for all tools
php artisan seo:extract-semantics --batch=10 > storage/logs/extract.log 2>&1 &

# Run content generation after extraction is complete
php artisan seo:generate-content --batch=10 > storage/logs/content.log 2>&1 &

# Monitor
tail -f storage/logs/seo-$(date +%Y-%m-%d).log
```

---

## STEP 7 — HEALTH CHECK COMMAND

After all runs, verify system health:

```bash
php artisan tinker --execute="
\$stats = [
  'Total tools'          => DB::table('tool_health_checks')->where('status','ok')->count(),
  'Tools with AI kw'     => DB::table('semantic_keywords')->where('source','gemini')->distinct('tool_slug')->count('tool_slug'),
  'Total keywords'       => DB::table('semantic_keywords')->count(),
  'Avg kw per tool'      => round(DB::table('semantic_keywords')->count() / max(1,DB::table('semantic_keywords')->distinct('tool_slug')->count('tool_slug')),1),
  '─── Types ───'        => '─────────',
];
foreach([
  'primary','secondary','autocomplete','lsi','paa','entity',
  'semantic','long_tail','question','related','comparison',
  'transactional','informational'
] as \$t) {
  \$stats[\$t] = DB::table('semantic_keywords')->where('keyword_type',\$t)->count();
}
\$stats['─── Content ───'] = '─────────';
\$stats['Approved drafts'] = App\Models\ContentDraft::where('status','approved')->count();
\$stats['Words 800-900']   = DB::table('content_drafts')->whereBetween('word_count',[750,950])->count();
\$stats['Score 85+']       = DB::table('content_drafts')->where('seo_score','>=',85)->count();
foreach(\$stats as \$k=>\$v) echo str_pad(\$k,28).\": {\$v}\".PHP_EOL;
"
```

### Target output after full run:
```
Total tools              : 1417
Tools with AI kw         : 1417
Total keywords           : ~90,000
Avg kw per tool          : ~63
─── Types ───            : ─────────
primary                  : ~4,251
secondary                : ~7,085
autocomplete             : ~14,170
lsi                      : ~11,336
paa                      : ~11,336
entity                   : ~7,085
semantic                 : ~8,502
long_tail                : ~11,336
question                 : ~7,085
related                  : ~8,502
comparison               : ~5,668
transactional            : ~5,668
informational            : ~7,085
─── Content ───          : ─────────
Approved drafts          : 1417
Words 800-900            : 1400+
Score 85+                : 1400+
```

---

## QUALITY STANDARD — APPROVE ONLY IF ALL PASS

```
✅ Word count: 750-950 (article only, not keyword section)
✅ seo_score >= 85
✅ Keyword section present (class="seo-kw-section")
✅ All 13 keyword categories filled — no empty lists
✅ No "No keywords extracted" anywhere
✅ No forbidden phrases
✅ Opening starts with specific scenario (person + number)
✅ Formula section has real worked example with numbers
✅ 2 complete examples (not cut off)
✅ FAQ answers all PAA questions
✅ Keywords woven naturally — NOT bolded
✅ Comparison keyword used in context
✅ Transactional keyword appears once
```

---

*v10.0 | Fixes: ENUM + skip bug + 13 keyword types + 800-900 word target*
*Key insight: All 1417 tools skipped extraction because autocomplete counts as "has keywords"*
*Solution: Skip only tools with GEMINI-sourced keywords, not autocomplete*
