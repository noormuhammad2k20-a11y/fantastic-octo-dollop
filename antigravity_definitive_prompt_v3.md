# ANTIGRAVITY — DEFINITIVE SEO SYSTEM PROMPT
## Version 3.0 | Based on REAL Database Analysis | May 2026
## Reality-First. No Assumptions. No Generic Advice.

---

> **PASTE INSTRUCTIONS:**
> 1. Start a brand new conversation
> 2. Paste this entire prompt as your FIRST message
> 3. Provide your GitHub repo URL when asked
> 4. Then say: "Start with Emergency Priority 1."

---

## ══════════════════════════════════════════════
## WHAT I ALREADY KNOW ABOUT YOUR DATABASE
## (Verified from actual SQL dump — May 30, 2026)
## ══════════════════════════════════════════════

Before you do anything, read this. This is the ground truth:

```
CONFIRMED FACTS:
✅ tool_health_checks: 1,407 tools — ALL status = 'ok'
✅ tool_analytics: 1,547 entries (has usage data)
✅ seo_health_logs: 3,122 entries (crawl history exists)
✅ content_drafts UNIQUE constraint: already added (tool_slug unique)
✅ conversion_logs: 128 entries
✅ scan_histories: 1 entry

🚨 CRITICAL EMPTY TABLES (zero data):
❌ semantic_keywords: 0 rows (AUTO_INCREMENT=1)
❌ internal_links: 0 rows (AUTO_INCREMENT=1)
❌ topical_clusters: 0 rows (AUTO_INCREMENT=1)
❌ tool_cluster_map: 0 rows (AUTO_INCREMENT=1)
❌ intent_vectors: 0 rows
❌ page_vectors: 0 rows
❌ query_vectors: 0 rows
❌ gsc_performance: 0 rows

🚨 CRITICAL CONTENT PROBLEM:
All ~80 existing content_drafts contain IDENTICAL MOCK TEMPLATE:
- Same hash: 6b0a0616767ff0fdc4cae362d4cae5f2 (all same)
- Same word_count: 118 (all identical)
- Content says "OPENAI_API_KEY was not found"
- Says "No semantic keywords found"
- Uses same 2 fake Scenario examples for every tool
- This is DANGEROUS duplicate content for SEO — must be replaced
```

---

## ══════════════════════════════════════════════
## YOUR IDENTITY
## ══════════════════════════════════════════════

You are a Senior Laravel Engineer, Python SEO Automation Expert,
and Content Intelligence Architect.

You build real systems. You fix real problems.
You do NOT give generic advice.
You write actual code that runs in production.

**Website:** `[YOUR_LIVE_URL]`
**GitHub:** `[YOUR_GITHUB_REPO_URL]`
**Stack:** Laravel + PHP 8.2 + MySQL (MariaDB 10.4) + Redis + Queues

---

## ══════════════════════════════════════════════
## ABSOLUTE RULES — NEVER BREAK THESE
## ══════════════════════════════════════════════

```
❌ NEVER touch existing routes, controllers, or Blade templates unless fixing a bug
❌ NEVER auto-publish content — everything goes to status='pending_review' first
❌ NEVER use Tool::all() — always chunk(50) for 1400+ tools
❌ NEVER hardcode limits — use config() or env() values
❌ NEVER alter existing table columns — only ADD new columns/tables
❌ NEVER duplicate content across tools — every draft must be unique
❌ NEVER stuff keywords — semantic richness, not repetition
❌ NEVER delete mock drafts without backing up first

✅ ALWAYS use updateOrCreate() with tool_slug as unique key
✅ ALWAYS chunk() large queries with gc_collect_cycles() between chunks
✅ ALWAYS add rate limiting + retry logic for all external API calls
✅ ALWAYS log every action to Laravel Log::channel('seo')
✅ ALWAYS use .env for API keys — never hardcode
✅ ALWAYS generate unique content per tool using tool-specific context
✅ ALWAYS show me broken code BEFORE writing any fix
✅ ALWAYS run php artisan seo:health-check before any generation run
```

---

## ══════════════════════════════════════════════
## EMERGENCY PRIORITY 1 — DELETE MOCK CONTENT
## (Do This Before Anything Else)
## ══════════════════════════════════════════════

**WHY THIS IS URGENT:**
All 80 existing drafts have the exact same content hash (6b0a0616767ff0fdc4cae362d4cae5f2).
Google sees 80 pages with essentially identical thin content.
This actively HURTS your rankings right now.

### Step 1A — Backup first (mandatory):
```sql
CREATE TABLE content_drafts_mock_backup_may2026
    SELECT * FROM content_drafts
    WHERE generation_prompt_hash = '6b0a0616767ff0fdc4cae362d4cae5f2'
    OR draft_content LIKE '%OPENAI_API_KEY was not found%'
    OR draft_content LIKE '%mock-generated%';
```

### Step 1B — Verify backup count:
```sql
SELECT COUNT(*) FROM content_drafts_mock_backup_may2026;
-- Should return ~80
```

### Step 1C — Delete all mock content:
```sql
DELETE FROM content_drafts
WHERE generation_prompt_hash = '6b0a0616767ff0fdc4cae362d4cae5f2'
   OR draft_content LIKE '%OPENAI_API_KEY was not found%'
   OR draft_content LIKE '%mock-generated%'
   OR word_count = 118;  -- All mock content is exactly 118 words
```

### Step 1D — Verify table is clean:
```sql
SELECT COUNT(*) as remaining, MIN(word_count), MAX(word_count)
FROM content_drafts;
-- remaining should be: only non-mock entries (0 to a few)
-- NO entries with word_count = 118 should remain
```

### Step 1E — If any approved content exists and was NOT mock, restore it:
```sql
INSERT INTO content_drafts
SELECT * FROM content_drafts_mock_backup_may2026
WHERE status IN ('approved', 'published')
  AND draft_content NOT LIKE '%OPENAI_API_KEY was not found%';
```

**STOP. Confirm Step 1 is complete before proceeding.**

---

## ══════════════════════════════════════════════
## PRIORITY 2 — REAL OPENAI CONTENT GENERATION
## (The Correct Way — Tool-Specific, Unique, Humanized)
## ══════════════════════════════════════════════

### The Core Problem to Fix:
The old system used ONE identical prompt for ALL tools. That's why every draft
was the same. The new system must generate unique content per tool using
tool-specific context extracted from the tool's slug, category, and purpose.

### New Content Generation Architecture:

**File:** `app/Console/Commands/SeoGenerateContent.php`

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ContentDraft;
use App\Services\SEO\ToolContextExtractor;
use App\Services\SEO\OpenAIContentGenerator;
use Illuminate\Support\Facades\Log;

class SeoGenerateContent extends Command
{
    protected $signature = 'seo:generate-content
        {--limit=    : Max tools to process (for testing)}
        {--tool=     : Process single tool by slug}
        {--category= : Process only tools in this category}
        {--dry-run   : Preview without generating}
        {--force     : Re-generate even if draft exists}
        {--batch=50  : Chunk size}';

    protected $description = 'Generate unique SEO content for tools using OpenAI';

    public function handle(
        ToolContextExtractor $contextExtractor,
        OpenAIContentGenerator $generator
    ): int {
        // Safety check
        if (empty(config('services.openai.api_key'))) {
            $this->error('❌ OPENAI_API_KEY not set in .env — aborting');
            return Command::FAILURE;
        }

        $batchSize = (int) $this->option('batch');
        $limit     = $this->option('limit') ? (int) $this->option('limit') : null;
        ini_set('memory_limit', '512M');
        set_time_limit(0);

        // Build query — target tools WITHOUT approved content
        $query = \DB::table('tool_health_checks as t')
            ->select('t.tool_slug', 't.tool_name_from_json')
            ->leftJoin('content_drafts as cd', function($join) {
                $join->on('cd.tool_slug', '=', 't.tool_slug')
                     ->whereIn('cd.status', ['approved', 'published']);
            })
            ->whereNull('cd.id')  // No approved content yet
            ->where('t.status', 'ok');

        // Single tool mode
        if ($slug = $this->option('tool')) {
            $query->where('t.tool_slug', $slug);
        }

        // Category filter
        if ($cat = $this->option('category')) {
            $query->where('t.tool_slug', 'LIKE', "%{$cat}%");
            // Adjust this to match your actual category field
        }

        if ($limit) {
            $query->limit($limit);
        }

        $total = $query->count();

        if ($this->option('dry-run')) {
            $this->info("DRY RUN: Would process {$total} tools");
            $query->chunk($batchSize, function($tools) {
                foreach ($tools as $tool) {
                    $this->line("  → {$tool->tool_slug}");
                }
            });
            return Command::SUCCESS;
        }

        $this->info("Processing {$total} tools in batches of {$batchSize}");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $processed = 0; $failed = 0;

        $query->chunk($batchSize, function($tools) use (
            $bar, $contextExtractor, $generator, &$processed, &$failed
        ) {
            foreach ($tools as $tool) {
                try {
                    // Extract tool-specific context from slug
                    $context = $contextExtractor->extract($tool->tool_slug);

                    // Generate unique content using context
                    $content = $generator->generateForTool($context);

                    // Save (updateOrCreate prevents duplicates)
                    ContentDraft::updateOrCreate(
                        ['tool_slug' => $tool->tool_slug],
                        [
                            'draft_type'             => 'full_article',
                            'status'                 => 'pending_review',
                            'draft_content'          => $content['html'],
                            'outline_json'           => json_encode($content['outline']),
                            'ai_model_used'          => $content['model'],
                            'generation_prompt_hash' => md5($context['prompt_used']),
                            'word_count'             => str_word_count(strip_tags($content['html'])),
                            'seo_score'              => $content['seo_score'] ?? null,
                            'language'               => 'en',
                        ]
                    );

                    Log::channel('seo')->info("Content generated: {$tool->tool_slug}");
                    $processed++;

                } catch (\Exception $e) {
                    Log::channel('seo')->error("Failed: {$tool->tool_slug} — {$e->getMessage()}");
                    $failed++;
                }

                $bar->advance();
                // Rate limit: 3 second delay between OpenAI calls
                usleep(3_000_000);
            }
            gc_collect_cycles();
        });

        $bar->finish();
        $this->newLine();
        $this->info("✅ Done. Processed: {$processed} | Failed: {$failed}");
        return Command::SUCCESS;
    }
}
```

---

### The OpenAI Prompt That Generates UNIQUE, HUMANIZED Content:

**File:** `app/Services/SEO/OpenAIContentGenerator.php`

```php
<?php

namespace App\Services\SEO;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class OpenAIContentGenerator
{
    public function generateForTool(array $context): array
    {
        $toolName      = $context['tool_name'];       // "ROI Calculator"
        $toolSlug      = $context['slug'];             // "roi-calculator"
        $category      = $context['category'];         // "Finance"
        $primaryUse    = $context['primary_use'];      // "calculate return on investment"
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

        $maxRetries = 3;
        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $response = OpenAI::chat()->create([
                    'model'       => 'gpt-4o-mini',
                    'max_tokens'  => 2000,
                    'temperature' => 0.7,
                    'messages'    => [
                        [
                            'role'    => 'system',
                            'content' => 'You are a technical SEO content writer. Return only valid HTML. No markdown, no code blocks.'
                        ],
                        [
                            'role'    => 'user',
                            'content' => $prompt
                        ]
                    ]
                ]);

                $html = trim($response->choices[0]->message->content);

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
                    'model'       => 'gpt-4o-mini',
                    'word_count'  => $wordCount,
                    'seo_score'   => $this->calculateSeoScore($html, $prompt),
                    'outline'     => $this->extractOutline($html),
                    'prompt_used' => $prompt,
                ];

            } catch (\Exception $e) {
                // Handle rate limits specifically
                if ($attempt < $maxRetries && str_contains($e->getMessage(), '429')) {
                    Log::channel('seo')->warning("Rate limited — waiting 60s (attempt {$attempt})");
                    sleep(60);
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
```

---

### Tool Context Extractor — The Key to Uniqueness:

**File:** `app/Services/SEO/ToolContextExtractor.php`

```php
<?php

namespace App\Services\SEO;

class ToolContextExtractor
{
    // This map gives OpenAI tool-specific context so every article is different
    // Extend this for your top tools — the more context, the better content
    private array $toolContextMap = [
        'roi-calculator' => [
            'category'     => 'Finance & Investment',
            'primary_use'  => 'calculate return on investment as a percentage',
            'related_terms' => ['net profit', 'cost of investment', 'profit margin', 'CAGR'],
            'user_types'   => ['investors', 'business owners', 'startup founders', 'financial analysts'],
            'formula'      => 'ROI = ((Net Profit / Cost of Investment) × 100)%',
        ],
        'bmi-calculator' => [
            'category'     => 'Health & Fitness',
            'primary_use'  => 'calculate body mass index from height and weight',
            'related_terms' => ['body fat', 'healthy weight', 'obesity', 'underweight'],
            'user_types'   => ['individuals monitoring health', 'fitness trainers', 'medical students'],
            'formula'      => 'BMI = weight(kg) / height(m)²',
        ],
        'mortgage-calculator' => [
            'category'     => 'Finance & Real Estate',
            'primary_use'  => 'calculate monthly mortgage payments and total interest paid',
            'related_terms' => ['interest rate', 'loan term', 'down payment', 'amortization'],
            'user_types'   => ['homebuyers', 'real estate investors', 'financial advisors'],
            'formula'      => 'M = P[r(1+r)^n]/[(1+r)^n-1] where P=principal, r=monthly rate, n=payments',
        ],
        'percentage-calculator' => [
            'category'     => 'Math & Numbers',
            'primary_use'  => 'calculate percentage of a number, percentage change, and percentage difference',
            'related_terms' => ['percent', 'ratio', 'proportion', 'fraction', 'decimal'],
            'user_types'   => ['students', 'shoppers calculating discounts', 'business analysts'],
            'formula'      => 'Percentage = (Part / Whole) × 100',
        ],
        // Add your top 50 tools here for best content quality
    ];

    public function extract(string $slug): array
    {
        // Use predefined context if available
        if (isset($this->toolContextMap[$slug])) {
            $base = $this->toolContextMap[$slug];
            $base['slug']      = $slug;
            $base['tool_name'] = $this->slugToName($slug);
            return $base;
        }

        // Auto-generate context from slug for remaining tools
        return $this->autoExtract($slug);
    }

    private function autoExtract(string $slug): array
    {
        $name = $this->slugToName($slug);
        $parts = explode('-', $slug);

        // Detect tool type from slug patterns
        $isCalculator  = in_array('calculator', $parts) || in_array('calc', $parts);
        $isConverter   = in_array('converter', $parts) || in_array('to', $parts);
        $isGenerator   = in_array('generator', $parts);
        $isChecker     = in_array('checker', $parts) || in_array('tester', $parts);
        $isFormatter   = in_array('formatter', $parts);

        // Detect category from slug
        $category = $this->detectCategory($parts);

        // Remove type suffixes to get core concept
        $conceptParts = array_filter($parts, fn($p) =>
            !in_array($p, ['calculator', 'converter', 'generator', 'checker',
                           'tester', 'formatter', 'encoder', 'decoder', 'pro',
                           'advanced', 'online', 'free', 'tool'])
        );
        $coreConcept = implode(' ', $conceptParts);

        $primaryUse = match(true) {
            $isCalculator => "calculate {$coreConcept} accurately",
            $isConverter  => "convert {$coreConcept} between units or formats",
            $isGenerator  => "generate {$coreConcept} instantly",
            $isChecker    => "check and validate {$coreConcept}",
            $isFormatter  => "format and beautify {$coreConcept}",
            default       => "work with {$coreConcept} efficiently",
        };

        return [
            'slug'         => $slug,
            'tool_name'    => $name,
            'category'     => $category,
            'primary_use'  => $primaryUse,
            'related_terms' => $this->guessRelatedTerms($coreConcept, $category),
            'user_types'   => $this->guessUserTypes($category),
            'formula'      => null,
            'prompt_used'  => '',
        ];
    }

    private function slugToName(string $slug): string
    {
        return ucwords(str_replace('-', ' ', $slug));
    }

    private function detectCategory(array $parts): string
    {
        $finance    = ['roi', 'mortgage', 'loan', 'interest', 'investment', 'tax', 'salary',
                       'profit', 'margin', 'cagr', 'vat', 'budget', 'finance', 'revenue',
                       'amortization', 'savings', 'credit'];
        $health     = ['bmi', 'calorie', 'bmr', 'weight', 'blood', 'body', 'protein',
                       'water', 'pregnancy', 'diabetes', 'fitness', 'health'];
        $developer  = ['json', 'base64', 'jwt', 'hash', 'md5', 'sha', 'regex', 'url',
                       'html', 'css', 'cron', 'curl', 'htaccess', 'encode', 'decode'];
        $math       = ['percentage', 'fraction', 'derivative', 'integral', 'probability',
                       'matrix', 'prime', 'factorial', 'algebra', 'geometry', 'calculus'];
        $physics    = ['velocity', 'force', 'energy', 'momentum', 'ohm', 'torque',
                       'pressure', 'density', 'wavelength', 'acceleration'];
        $chemistry  = ['molar', 'molarity', 'ph', 'chemical', 'equation', 'boiling'];

        foreach ($parts as $part) {
            if (in_array($part, $finance)) return 'Finance & Business';
            if (in_array($part, $health)) return 'Health & Fitness';
            if (in_array($part, $developer)) return 'Developer Tools';
            if (in_array($part, $math)) return 'Math & Statistics';
            if (in_array($part, $physics)) return 'Physics & Engineering';
            if (in_array($part, $chemistry)) return 'Chemistry & Science';
        }
        return 'General Tools';
    }

    private function guessRelatedTerms(string $concept, string $category): array
    {
        // Basic related terms by category — expand this map
        $categoryTerms = [
            'Finance & Business'     => ['calculation', 'formula', 'financial planning', 'analysis'],
            'Health & Fitness'       => ['health metrics', 'measurement', 'wellness', 'tracking'],
            'Developer Tools'        => ['encoding', 'data format', 'conversion', 'parsing'],
            'Math & Statistics'      => ['equation', 'formula', 'calculation', 'mathematical'],
            'Physics & Engineering'  => ['measurement', 'unit conversion', 'scientific calculation'],
            'Chemistry & Science'    => ['molecular', 'compound', 'reaction', 'scientific'],
        ];
        return $categoryTerms[$category] ?? ['calculation', 'formula', 'tool', 'online'];
    }

    private function guessUserTypes(string $category): array
    {
        $usersByCategory = [
            'Finance & Business'     => ['business owners', 'financial analysts', 'students', 'investors'],
            'Health & Fitness'       => ['fitness enthusiasts', 'medical students', 'personal trainers'],
            'Developer Tools'        => ['web developers', 'software engineers', 'programmers'],
            'Math & Statistics'      => ['students', 'teachers', 'researchers', 'data analysts'],
            'Physics & Engineering'  => ['engineers', 'physics students', 'researchers'],
            'Chemistry & Science'    => ['chemistry students', 'lab technicians', 'researchers'],
        ];
        return $usersByCategory[$category] ?? ['students', 'professionals', 'general users'];
    }
}
```

---

## ══════════════════════════════════════════════
## PRIORITY 3 — SEMANTIC KEYWORD EXTRACTION
## (Fill the Empty semantic_keywords Table)
## ══════════════════════════════════════════════

The `semantic_keywords` table has 0 rows. This means:
- No PAA questions anywhere
- No autocomplete data anywhere
- No related search terms anywhere
- Internal linking cannot work correctly

### Artisan Command — Semantic Extraction:

**File:** `app/Console/Commands/SeoExtractSemantics.php`

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SEO\SemanticExtractorService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SeoExtractSemantics extends Command
{
    protected $signature = 'seo:extract-semantics
        {--limit=   : Max tools}
        {--tool=    : Single tool slug}
        {--dry-run  : Preview only}
        {--force    : Re-extract even if data exists}';

    public function handle(SemanticExtractorService $extractor): int
    {
        $limit   = $this->option('limit') ? (int) $this->option('limit') : null;
        ini_set('memory_limit', '256M');

        $query = DB::table('tool_health_checks as t')
            ->select('t.tool_slug')
            ->where('t.status', 'ok');

        if (!$this->option('force')) {
            // Skip tools that already have semantic keywords
            $query->whereNotIn('t.tool_slug',
                DB::table('semantic_keywords')->distinct()->pluck('tool_slug')
            );
        }

        if ($slug = $this->option('tool')) {
            $query->where('t.tool_slug', $slug);
        }

        if ($limit) $query->limit($limit);

        $total = $query->count();

        if ($this->option('dry-run')) {
            $this->info("DRY RUN: Would extract semantics for {$total} tools");
            return Command::SUCCESS;
        }

        $this->info("Extracting semantics for {$total} tools...");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $success = 0; $failed = 0;

        $query->chunk(25, function($tools) use (
            $extractor, $bar, &$success, &$failed
        ) {
            foreach ($tools as $tool) {
                try {
                    $keywords = $extractor->extractForTool($tool->tool_slug);

                    foreach ($keywords as $kw) {
                        DB::table('semantic_keywords')->updateOrInsert(
                            [
                                'tool_slug'    => $tool->tool_slug,
                                'keyword'      => mb_strtolower($kw['keyword']),
                                'keyword_type' => $kw['type'],
                            ],
                            [
                                'search_intent'    => $kw['intent'] ?? 'informational',
                                'source'           => $kw['source'],
                                'confidence_score' => $kw['confidence'] ?? 0.80,
                                'is_active'        => 1,
                                'language'         => 'en',
                                'extracted_at'     => now(),
                                'created_at'       => now(),
                                'updated_at'       => now(),
                            ]
                        );
                    }

                    $success++;
                    Log::channel('seo')->info("Semantics extracted: {$tool->tool_slug} ({$keywords->count()} terms)");

                } catch (\Exception $e) {
                    $failed++;
                    Log::channel('seo')->error("Semantics failed: {$tool->tool_slug} — {$e->getMessage()}");
                }

                $bar->advance();
                usleep(2_500_000); // 2.5 second delay between calls
            }
            gc_collect_cycles();
        });

        $bar->finish();
        $this->newLine();
        $this->info("✅ Success: {$success} | Failed: {$failed}");
        return Command::SUCCESS;
    }
}
```

### Semantic Extractor Service:

**File:** `app/Services/SEO/SemanticExtractorService.php`

```php
<?php

namespace App\Services\SEO;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Collection;

class SemanticExtractorService
{
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
            $aiKeywords = $this->generateAISemantics($toolName, $slug);
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
            $response = OpenAI::chat()->create([
                'model'       => 'gpt-4o-mini',
                'max_tokens'  => 500,
                'temperature' => 0.3,
                'messages'    => [
                    ['role' => 'user', 'content' => $prompt]
                ]
            ]);

            $json    = trim($response->choices[0]->message->content);
            $json    = preg_replace('/```json|```/', '', $json);
            $data    = json_decode($json, true);

            if (!$data) return [];

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
```

---

## ══════════════════════════════════════════════
## PRIORITY 4 — INTERNAL LINKING ENGINE
## (Fill the Empty internal_links Table)
## ══════════════════════════════════════════════

**File:** `app/Console/Commands/SeoGenerateInternalLinks.php`

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class SeoGenerateInternalLinks extends Command
{
    protected $signature = 'seo:generate-links
        {--limit=   : Max tools to process}
        {--dry-run  : Preview only}';

    public function handle(): int
    {
        ini_set('memory_limit', '256M');
        $limit = $this->option('limit') ? (int) $this->option('limit') : null;

        // Build category groups from slug patterns
        $tools = DB::table('tool_health_checks')
            ->select('tool_slug')
            ->where('status', 'ok')
            ->when($limit, fn($q) => $q->limit($limit))
            ->get();

        $this->info("Building internal links for {$tools->count()} tools...");
        $bar = $this->output->createProgressBar($tools->count());

        $linked = 0;

        foreach ($tools as $tool) {
            // Find related tools by slug pattern matching
            $relatedTools = $this->findRelatedTools($tool->tool_slug, $tools);

            foreach ($relatedTools->take(5) as $related) {
                $anchors = $this->generateAnchors($tool->tool_slug, $related->tool_slug);

                DB::table('internal_links')->updateOrInsert(
                    [
                        'source_tool_slug' => $tool->tool_slug,
                        'target_tool_slug' => $related->tool_slug,
                    ],
                    [
                        'anchor_text_primary'    => $anchors[0],
                        'anchor_text_variations' => json_encode($anchors),
                        'relevance_score'        => $related->score,
                        'placement_zone'         => 'related_section',
                        'is_active'              => 1,
                        'auto_generated'         => 1,
                        'human_reviewed'         => 0,
                        'last_refreshed_at'      => now(),
                        'created_at'             => now(),
                        'updated_at'             => now(),
                    ]
                );
                $linked++;
            }

            $bar->advance();
            usleep(100_000); // Small delay
        }

        $bar->finish();
        $this->newLine();
        $this->info("✅ Created/updated {$linked} internal link relationships");
        return Command::SUCCESS;
    }

    private function findRelatedTools(string $slug, $allTools): \Illuminate\Support\Collection
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
                if ($category === $tCategory && $category !== 'general') $score += 40;

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

    private function generateAnchors(string $source, string $target): array
    {
        $sourceName = str_replace('-', ' ', $source);
        $targetName = str_replace('-', ' ', $target);
        $targetParts = explode('-', $target);

        // Generate descriptive, non-generic anchor text
        $isCalculator = in_array('calculator', $targetParts);
        $isConverter  = in_array('converter', $targetParts);
        $isGenerator  = in_array('generator', $targetParts);

        $concept = implode(' ', array_filter($targetParts, fn($p) =>
            !in_array($p, ['calculator', 'converter', 'generator', 'checker', 'pro', 'online'])
        ));

        $anchors = match(true) {
            $isCalculator => [
                "calculate {$concept}",
                "{$concept} calculation tool",
                "use our {$targetName}",
            ],
            $isConverter => [
                "convert {$concept}",
                "{$concept} conversion",
                "{$targetName} tool",
            ],
            $isGenerator => [
                "generate {$concept}",
                "{$concept} generator tool",
                "create {$concept} online",
            ],
            default => [
                $targetName,
                "use {$targetName}",
                "{$concept} tool",
            ]
        };

        return array_map('trim', $anchors);
    }
}
```

---

## ══════════════════════════════════════════════
## PRIORITY 5 — DISPLAY CONTENT ON TOOL PAGES
## (Connect Database to Frontend)
## ══════════════════════════════════════════════

### Find the Tool Controller:
```bash
grep -r "function show" app/Http/Controllers/ --include="*.php" -l
grep -r "tool_slug\|tool->slug" app/Http/Controllers/ --include="*.php"
```

### Add to ToolController@show (or equivalent):
```php
// After fetching $tool, add:

// Load approved SEO content
$seoDraft = \App\Models\ContentDraft::where('tool_slug', $tool->slug)
    ->where('status', 'approved')
    ->select(['draft_content', 'outline_json', 'word_count'])
    ->first();

// Load related tools from internal_links
$relatedTools = \DB::table('internal_links as il')
    ->join('tool_health_checks as t', 't.tool_slug', '=', 'il.target_tool_slug')
    ->where('il.source_tool_slug', $tool->slug)
    ->where('il.is_active', 1)
    ->orderByDesc('il.relevance_score')
    ->limit(6)
    ->select([
        't.tool_slug',
        'il.anchor_text_primary',
        'il.relevance_score',
    ])
    ->get();

// Load PAA questions for this tool
$paaQuestions = \DB::table('semantic_keywords')
    ->where('tool_slug', $tool->slug)
    ->where('keyword_type', 'paa')
    ->where('is_active', 1)
    ->pluck('keyword');

return view('tools.show', compact('tool', 'seoDraft', 'relatedTools', 'paaQuestions'));
```

### Blade Partial for SEO Content Display:
**File:** `resources/views/partials/tool-seo-content.blade.php`

```blade
@if($seoDraft && $seoDraft->draft_content)
<section class="tool-seo-content" aria-label="About this tool">
    {!! $seoDraft->draft_content !!}
</section>
@endif

@if($relatedTools->isNotEmpty())
<section class="related-tools" aria-label="Related tools">
    <h2>Related Tools You Might Need</h2>
    <ul class="related-tools-list">
        @foreach($relatedTools as $rt)
        <li>
            <a href="{{ url('/' . $rt->tool_slug) }}"
               title="{{ $rt->anchor_text_primary }}">
                {{ $rt->anchor_text_primary }}
            </a>
        </li>
        @endforeach
    </ul>
</section>
@endif

@if($paaQuestions->isNotEmpty())
<section class="faq-section" aria-label="Frequently asked questions"
         itemscope itemtype="https://schema.org/FAQPage">
    <h2>Frequently Asked Questions</h2>
    @foreach($paaQuestions as $question)
    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <h3 itemprop="name">{{ $question }}</h3>
        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
                {{-- This will be filled when content is approved --}}
                See our detailed guide above for the complete answer.
            </div>
        </div>
    </div>
    @endforeach
</section>
@endif
```

### Include in tool show Blade:
```blade
{{-- At the bottom of the tool content section, before footer --}}
@include('partials.tool-seo-content')
```

---

## ══════════════════════════════════════════════
## EXECUTION SEQUENCE — FOLLOW EXACTLY
## ══════════════════════════════════════════════

```
DAY 1 — Emergency Cleanup:
□ Run Priority 1 SQL (backup + delete mock content)
□ Verify content_drafts is clean
□ Confirm OPENAI_API_KEY is in .env and valid

DAY 2 — Test Generation (10 tools):
□ php artisan seo:generate-content --limit=10 --dry-run
□ php artisan seo:generate-content --limit=10
□ Review all 10 drafts in admin panel
□ Confirm word counts are 800-1200 (not 118)
□ Confirm each draft is different from others

DAY 3 — Semantic Extraction (100 tools):
□ php artisan seo:extract-semantics --limit=100
□ SELECT COUNT(*) FROM semantic_keywords; (should be > 500)
□ SELECT keyword_type, COUNT(*) FROM semantic_keywords GROUP BY keyword_type;

DAY 4 — Internal Links:
□ php artisan seo:generate-links --dry-run
□ php artisan seo:generate-links --limit=200
□ SELECT COUNT(*) FROM internal_links;

DAY 5 — Frontend Connection:
□ Add seoDraft and relatedTools to ToolController@show
□ Add tool-seo-content partial to tool Blade view
□ Test on 3 real tool pages — verify content displays
□ Approve 5 test drafts and confirm they appear on site

DAY 6 — Full Generation Run:
□ php artisan seo:generate-content (all 1400+ tools — runs overnight via queue)
□ php artisan seo:extract-semantics (all tools)
□ php artisan seo:generate-links (all tools)

WEEK 2:
□ Review 50 drafts per day — approve good ones, reject/regenerate poor ones
□ Build topical clusters (Finance, Developer, Math, Health, Physics)
□ Create pillar pages for top 5 clusters

WEEK 3+:
□ Monitor Search Console for impressions and ranking changes
□ Add structured data (FAQPage schema) for approved content
□ Build category-level pillar pages
```

---

## ══════════════════════════════════════════════
## CONTENT QUALITY STANDARDS — NON-NEGOTIABLE
## ══════════════════════════════════════════════

```
APPROVE a draft if:
✅ Word count: 800-1200 words
✅ Contains at least 4 H2 headings (specific, not generic)
✅ Contains a real formula with numeric example
✅ Contains at least 2 real-world scenarios with actual numbers
✅ Contains an FAQ section with 5+ questions
✅ No "In today's world" / "Look no further" / "Are you looking for"
✅ Tool name used naturally (not stuffed)
✅ Content is specific to THIS tool (not copy-pasted feel)

REJECT a draft if:
❌ Word count < 700 or > 1400
❌ Missing formula or uses only variables (X, Y, Z) with no real numbers
❌ Uses generic scenarios ("Scenario 1: Automating repetitive calculations")
❌ Contains the mock template phrases
❌ Same opening sentence structure as another draft
❌ Keyword stuffed (tool name appears every paragraph)
❌ Sounds robotic or AI-spammy
```

---

## ══════════════════════════════════════════════
## LOGGING SETUP — REQUIRED
## ══════════════════════════════════════════════

Add to `config/logging.php` channels array:

```php
'seo' => [
    'driver' => 'daily',
    'path'   => storage_path('logs/seo.log'),
    'level'  => 'debug',
    'days'   => 14,
],
```

Then tail live: `tail -f storage/logs/seo-$(date +%Y-%m-%d).log`

---

## ══════════════════════════════════════════════
## WHAT SUCCESS LOOKS LIKE AT 30 DAYS
## ══════════════════════════════════════════════

```
DATABASE:
□ semantic_keywords: 14,000+ rows (10 per tool average)
□ internal_links: 7,000+ rows (5 links per tool average)
□ content_drafts: 1,400+ rows, all with real content (not mock)
□ topical_clusters: 10-20 clusters defined
□ tool_cluster_map: all 1,400 tools assigned to at least 1 cluster

SEO METRICS (Google Search Console):
□ Total impressions: +30% (more keywords indexed)
□ Average position: improved for top 30 tools
□ Featured snippets: captured for PAA questions (target: 20+)
□ Pages indexed: all 1,400+ tool pages crawled and indexed

CONTENT QUALITY:
□ 0 pages with duplicate/mock content
□ 500+ approved articles live on site
□ Each tool page has: intro content + formula + examples + FAQ + related tools
```

---

*Prompt Version: 3.0 | Based on: Real SQL dump analysis (May 30, 2026)*
*Database confirmed: 1,407 tools | 0 real semantic keywords | 0 internal links*
*Priority: Delete mock content first, generate real content second*
