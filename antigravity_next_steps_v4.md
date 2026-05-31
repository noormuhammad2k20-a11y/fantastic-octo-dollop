# ANTIGRAVITY — NEXT STEPS PROMPT (Version 4.0)
## Based on Real Database Analysis — May 30, 2026
## Paste this entire prompt into a new conversation. Then say: "Start Step 1."

---

## GROUND TRUTH — WHAT YOUR DATABASE ACTUALLY CONTAINS RIGHT NOW

Before any work, understand this reality verified from your SQL dump:

```
✅ WORKING:
- tool_health_checks: 1,417 tools (all status = ok)
- semantic_keywords: 8,120 rows — BUT 8,117 are ONLY autocomplete type
  - PAA questions: only 1 row total (should be 7,085+)
  - LSI keywords: only 1 row total (should be 7,085+)
  - Entity keywords: only 1 row total (should be 7,085+)
  - This means OpenAI calls SILENTLY FAILED for 1,231 tools
- internal_links: 5,843 rows — BUT quality is WRONG
  - Example: at-bats-per-home-run-calculator → price-per-unit-calculator
  - These are WRONG matches (sports tool linked to pricing tool)
  - Root cause: slug-pattern matching is too broad
- content_drafts_backup_hotfix: backup exists (safe to delete mock content now)

❌ BROKEN / EMPTY:
- content_drafts: 1,394 rows ALL have hash 6b0a0616767ff0fdc4cae362d4cae5f2
  - word_count = 118 for all → ALL are mock content → ZERO real content
  - You pressed "no" when asked to delete → mock content still exists
- topical_clusters: 0 rows
- tool_cluster_map: 0 rows
- gsc_performance: 0 rows

❌ OPENAI API KEY:
- seo:generate-content returned: "OPENAI_API_KEY not set in .env — aborting"
- seo:extract-semantics ran BUT OpenAI calls silently failed
  - Only Google Suggest worked (free) → only autocomplete data saved
  - All PAA/LSI/Entity extraction needs OpenAI → failed silently
```

---

## YOUR IDENTITY

You are a Senior Laravel Engineer working on my tools website.
Stack: Laravel + PHP 8.2 + MySQL (MariaDB 10.4) + Laravel File Cache + Queues
GitHub: https://github.com/noormuhammad2k20-a11y/fantastic-octo-dollop

You fix real bugs. You write real code. No generic advice.
Show me the existing broken code BEFORE writing any fix.

---

## ABSOLUTE RULES

```
❌ NEVER auto-publish — status must stay 'pending_review' until human approves
❌ NEVER use Tool::all() — always chunk(50) for 1,400+ tools
❌ NEVER hardcode any limit — use config() or env() values
❌ NEVER alter existing columns — only ADD new tables/columns
❌ NEVER generate content without verifying OPENAI_API_KEY first

✅ ALWAYS show broken code before fixing
✅ ALWAYS use updateOrCreate() with tool_slug as unique key
✅ ALWAYS chunk() with gc_collect_cycles() between batches
✅ ALWAYS log to Log::channel('seo')
✅ ALWAYS add --dry-run flag to every Artisan command
✅ ALWAYS verify OPENAI_API_KEY before ANY OpenAI call
```

---

## STEP 1 — FIX OPENAI API KEY (Do This RIGHT NOW, Everything Else Depends On It)

### Check if key exists in .env:
```bash
# Run this on your server:
php artisan tinker --execute="echo config('services.openai.api_key') ? 'KEY EXISTS: ' . substr(config('services.openai.api_key'), 0, 8) . '...' : 'KEY MISSING';"
```

### If key is missing, add it to .env:
```env
OPENAI_API_KEY=sk-your-actual-key-here
OPENAI_MODEL=gpt-4o-mini
OPENAI_MAX_TOKENS=2000
OPENAI_RPM_LIMIT=20
```

### After adding key, clear config cache:
```bash
php artisan config:clear
php artisan cache:clear
```

### Verify it works with ONE tool test:
```bash
php artisan seo:generate-content --tool=roi-calculator --dry-run
```
Expected output: "DRY RUN: Would process 1 tools → roi-calculator"
If this shows the tool, key is loaded. Proceed to Step 2.

---

## STEP 2 — DELETE MOCK CONTENT (You Pressed "no" Last Time — Do It Now)

The backup already exists in `content_drafts_backup_hotfix` table.
It is SAFE to delete mock content now.

### Run the clean command but press "yes" this time:
```bash
php artisan seo:clean-mock-content
```
When prompted: "Delete 1394 mock drafts?" → Type **yes** and press Enter.

### If the command does not exist or fails, use direct SQL:
```sql
-- Backup already exists, safe to delete:
DELETE FROM content_drafts
WHERE generation_prompt_hash = '6b0a0616767ff0fdc4cae362d4cae5f2'
   OR word_count = 118
   OR draft_content LIKE '%OPENAI_API_KEY was not found%';

-- Verify:
SELECT COUNT(*) as remaining FROM content_drafts;
-- Should return 0 or very few (any real approved content)
```

### Verify cleanup:
```sql
SELECT COUNT(*) as mock_remaining
FROM content_drafts
WHERE word_count = 118;
-- MUST return 0 before proceeding
```

---

## STEP 3 — FIX THE SILENT OPENAI FAILURE IN seo:extract-semantics

**The Problem:** When you ran `php artisan seo:extract-semantics`, it showed
"Success: 1231 | Failed: 186" — but the "success" was WRONG. It only saved
Google Autocomplete data. The OpenAI part (PAA, LSI, entities) silently failed
because OPENAI_API_KEY was missing. The code caught the exception and moved on
without marking it as failed.

**Evidence from database:**
- autocomplete rows: 8,117 ✅
- PAA questions: 1 ❌ (should be 6,000+)
- LSI keywords: 1 ❌ (should be 6,000+)
- entity keywords: 1 ❌ (should be 6,000+)

### Find the broken code — show me this file first:
```bash
cat app/Services/SEO/SemanticExtractorService.php
```

### The fix — update SemanticExtractorService.php:

**Problem in current code (find this pattern):**
```php
// BROKEN: OpenAI failure is silently caught, tool marked as "success"
try {
    $aiKeywords = $this->generateAISemantics($toolName, $slug);
    foreach ($aiKeywords as $kw) {
        $keywords->push($kw);
    }
} catch (\Exception $e) {
    Log::warning("AI semantics failed: " . $e->getMessage());
    // BUG: Code continues, tool is marked success with ZERO AI keywords
}
```

**Fix — make AI failure throw so it counts as failed:**
```php
// FIXED: If OpenAI fails, throw so the command counts it as failed
// This forces re-extraction next time --force is used

// First, check if key exists before even trying
if (empty(config('services.openai.api_key'))) {
    throw new \RuntimeException('OPENAI_API_KEY not configured');
}

try {
    $aiKeywords = $this->generateAISemantics($toolName, $slug);
    
    // Validate we actually got AI keywords (not just empty array)
    $aiCount = count(array_filter($aiKeywords, fn($k) => $k['source'] === 'openai'));
    if ($aiCount === 0) {
        throw new \RuntimeException('OpenAI returned 0 keywords — API call likely failed');
    }
    
    foreach ($aiKeywords as $kw) {
        $keywords->push($kw);
    }
    
} catch (\Exception $e) {
    Log::channel('seo')->error("AI semantics HARD FAIL for {$slug}: {$e->getMessage()}");
    throw $e; // Re-throw so command counts this as failed, not success
}
```

### After fixing, re-run semantic extraction for ALL tools (force mode):
```bash
# First dry-run to confirm count
php artisan seo:extract-semantics --dry-run --force
# Expected: "DRY RUN: Would extract semantics for 1417 tools"

# Then run for real (this will take hours — run in background)
php artisan seo:extract-semantics --force --batch=10 > storage/logs/semantics-run.log 2>&1 &
```

### Monitor progress:
```bash
tail -f storage/logs/semantics-run.log

# Also check database every 30 minutes:
# SELECT keyword_type, COUNT(*) FROM semantic_keywords GROUP BY keyword_type;
```

### Expected result after full run:
```
autocomplete: ~8,000+
lsi:          ~6,000+
paa:          ~6,000+
entity:       ~4,000+
semantic:     ~4,000+
```

---

## STEP 4 — FIX INTERNAL LINKS QUALITY PROBLEM

**The Problem:** Your internal_links table has 5,843 rows but the matching is WRONG.
Example: `at-bats-per-home-run-calculator` is linked to `price-per-unit-calculator`.
A baseball stats tool should link to other baseball/sports tools — NOT pricing tools.

**Root cause:** The current `detectCategoryFromSlug()` method is too basic.
The word "per" in "at-bats-per-home-run" is being matched incorrectly.

### Find the broken linking command:
```bash
cat app/Console/Commands/SeoGenerateInternalLinks.php
```

### The fix — improve category detection and add minimum shared-concept check:

**Update `findRelatedTools()` method — add this guard:**
```php
private function findRelatedTools(string $slug, $allTools): \Illuminate\Support\Collection
{
    $parts    = explode('-', $slug);
    $category = $this->detectCategoryFromSlug($parts);
    
    // NEW: Extract meaningful concept words (exclude common connectors)
    $stopWords = ['calculator', 'converter', 'generator', 'checker', 'tester',
                  'formatter', 'encoder', 'decoder', 'pro', 'advanced', 'online',
                  'free', 'tool', 'per', 'and', 'to', 'from', 'of', 'the', 'a'];
    
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
```

**Improve `detectCategoryFromSlug()` — add sports and more categories:**
```php
private function detectCategoryFromSlug(array $parts): string
{
    $sports    = ['baseball', 'basketball', 'football', 'soccer', 'cricket', 'golf',
                  'tennis', 'swimming', 'cycling', 'marathon', 'triathlon', 'bowling',
                  'era', 'fip', 'ops', 'war', 'whip', 'bats', 'home', 'run', 'rebound',
                  'usage', 'pace', 'splits', 'per', 'game', 'season', 'mtg', 'pokemon',
                  'palworld', 'fantasy', 'trade', 'drafts', 'bench', 'rep', 'max',
                  'strength', 'vo2', 'one'];
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
```

### After fixing, clear old bad links and regenerate:
```bash
# Clear wrong links
php artisan tinker --execute="DB::table('internal_links')->truncate(); echo 'Cleared.';"

# Regenerate with fixed logic
php artisan seo:generate-links --dry-run
php artisan seo:generate-links
```

### Verify quality after fix:
```sql
-- Check sports tools are now linking to other sports tools:
SELECT source_tool_slug, target_tool_slug, relevance_score
FROM internal_links
WHERE source_tool_slug = 'era-calculator'
LIMIT 10;
-- Should show: fip-calculator, war-calculator, whip-calculator, ops-calculator

-- Check finance tools linking to finance:
SELECT source_tool_slug, target_tool_slug, relevance_score
FROM internal_links
WHERE source_tool_slug = 'roi-calculator'
LIMIT 10;
-- Should show: cagr-calculator, mortgage-calculator, profit tools, etc.
```

---

## STEP 5 — GENERATE REAL CONTENT (After Key is Fixed)

**ONLY run this after Step 1 confirms OPENAI_API_KEY works.**

### Test with 3 tools first:
```bash
php artisan seo:generate-content --limit=3
```

### Check quality of generated content:
```bash
php artisan tinker --execute="
\$drafts = DB::table('content_drafts')
    ->where('word_count', '>', 200)
    ->orderByDesc('created_at')
    ->limit(3)
    ->get(['tool_slug', 'word_count', 'seo_score', 'status']);
foreach(\$drafts as \$d) {
    echo \$d->tool_slug . ' | words: ' . \$d->word_count . ' | score: ' . \$d->seo_score . PHP_EOL;
}
"
```

**Expected output:**
```
roi-calculator | words: 950 | score: 90
bmi-calculator | words: 1050 | score: 85
percentage-calculator | words: 880 | score: 80
```

**If word_count is still 118 → OpenAI is still not working. Fix Step 1 first.**

### After 3 tools look good, run for all tools overnight:
```bash
# Run in background — this will take 4-6 hours for 1,400 tools
nohup php artisan seo:generate-content --batch=10 > storage/logs/content-generation.log 2>&1 &

# Monitor:
tail -f storage/logs/content-generation.log
```

---

## STEP 6 — CONNECT CONTENT TO FRONTEND TOOL PAGES

After Step 5 generates content, connect it to your tool pages.

### Find your tool show controller:
```bash
grep -rn "function show" app/Http/Controllers/ --include="*.php"
grep -rn "tool_slug\|->slug" app/Http/Controllers/ --include="*.php" | head -20
```

### Show me the controller file content:
```bash
cat app/Http/Controllers/ToolController.php
# (or whatever file the grep above found)
```

### Add these 3 queries to the show() method (after fetching $tool):
```php
// 1. Load approved SEO content
$seoDraft = \DB::table('content_drafts')
    ->where('tool_slug', $tool->slug)
    ->where('status', 'approved')
    ->select(['draft_content', 'outline_json', 'word_count'])
    ->first();

// 2. Load top 6 related tools
$relatedTools = \DB::table('internal_links as il')
    ->where('il.source_tool_slug', $tool->slug)
    ->where('il.is_active', 1)
    ->where('il.relevance_score', '>=', 35)
    ->orderByDesc('il.relevance_score')
    ->limit(6)
    ->select(['il.target_tool_slug', 'il.anchor_text_primary', 'il.relevance_score'])
    ->get();

// 3. Load PAA questions
$paaQuestions = \DB::table('semantic_keywords')
    ->where('tool_slug', $tool->slug)
    ->where('keyword_type', 'paa')
    ->where('is_active', 1)
    ->limit(5)
    ->pluck('keyword');
```

### Find the tool show Blade template:
```bash
find resources/views -name "*.blade.php" | xargs grep -l "tool" | head -10
```

### Add this partial at bottom of tool content section:
```blade
{{-- After the tool calculator section, before footer --}}
@include('partials.tool-seo-content', [
    'seoDraft'    => $seoDraft ?? null,
    'relatedTools' => $relatedTools ?? collect(),
    'paaQuestions' => $paaQuestions ?? collect(),
])
```

### Create the partial file:
**File:** `resources/views/partials/tool-seo-content.blade.php`
```blade
@if(isset($seoDraft) && $seoDraft && $seoDraft->draft_content)
<section class="tool-seo-content mt-6">
    {!! $seoDraft->draft_content !!}
</section>
@endif

@if(isset($relatedTools) && $relatedTools->isNotEmpty())
<section class="related-tools mt-6">
    <h2>Related Tools</h2>
    <ul>
        @foreach($relatedTools as $rt)
        <li>
            <a href="{{ url('/' . $rt->target_tool_slug) }}">
                {{ $rt->anchor_text_primary }}
            </a>
        </li>
        @endforeach
    </ul>
</section>
@endif

@if(isset($paaQuestions) && $paaQuestions->isNotEmpty())
<section class="faq-section mt-6"
         itemscope itemtype="https://schema.org/FAQPage">
    <h2>Frequently Asked Questions</h2>
    @foreach($paaQuestions as $question)
    <div itemscope itemprop="mainEntity"
         itemtype="https://schema.org/Question">
        <h3 itemprop="name">{{ $question }}</h3>
        <div itemscope itemprop="acceptedAnswer"
             itemtype="https://schema.org/Answer">
            <div itemprop="text">
                See our detailed guide above for the complete answer.
            </div>
        </div>
    </div>
    @endforeach
</section>
@endif
```

---

## STEP 7 — BUILD TOPICAL CLUSTERS (After Steps 1-6 Complete)

Your `topical_clusters` and `tool_cluster_map` tables are empty.
Without clusters, your website has no topical authority structure.

### Create the cluster seeder command:
```bash
php artisan make:command SeoSeedClusters
```

**File:** `app/Console/Commands/SeoSeedClusters.php`
```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeoSeedClusters extends Command
{
    protected $signature = 'seo:seed-clusters {--dry-run}';
    protected $description = 'Create topical clusters and assign tools to them';

    // Core cluster definitions — expand this list
    private array $clusters = [
        [
            'name'     => 'Finance & Investment',
            'category' => 'finance',
            'keywords' => ['roi', 'cagr', 'mortgage', 'loan', 'interest', 'investment',
                          'profit', 'margin', 'dividend', 'stock', 'bond', 'savings',
                          'budget', 'credit', 'debt', 'equity', 'tax', 'salary', 'income'],
        ],
        [
            'name'     => 'Sports & Athletics',
            'category' => 'sports',
            'keywords' => ['era', 'fip', 'ops', 'war', 'whip', 'batting', 'bowling',
                          'basketball', 'football', 'soccer', 'running', 'marathon',
                          'swimming', 'cycling', 'triathlon', 'bench', 'strength', 'vo2'],
        ],
        [
            'name'     => 'Health & Fitness',
            'category' => 'health',
            'keywords' => ['bmi', 'calorie', 'bmr', 'weight', 'blood', 'body', 'protein',
                          'sleep', 'macro', 'tdee', 'keto', 'pregnancy', 'heart', 'bac',
                          'fat', 'lean', 'waist', 'health', 'fitness', 'diabetes'],
        ],
        [
            'name'     => 'Developer Tools',
            'category' => 'developer',
            'keywords' => ['json', 'base64', 'jwt', 'hash', 'regex', 'url', 'html', 'css',
                          'sql', 'yaml', 'xml', 'markdown', 'uuid', 'ip', 'unicode', 'ascii',
                          'encode', 'decode', 'password', 'token', 'sitemap', 'robots'],
        ],
        [
            'name'     => 'Math & Statistics',
            'category' => 'math',
            'keywords' => ['percentage', 'fraction', 'probability', 'matrix', 'prime',
                          'algebra', 'calculus', 'statistics', 'mean', 'median', 'mode',
                          'variance', 'deviation', 'regression', 'log', 'exponent'],
        ],
        [
            'name'     => 'Physics & Engineering',
            'category' => 'physics',
            'keywords' => ['velocity', 'force', 'energy', 'momentum', 'ohm', 'torque',
                          'pressure', 'wavelength', 'acceleration', 'voltage', 'current',
                          'resistance', 'capacitance', 'power', 'gravity'],
        ],
        [
            'name'     => 'Chemistry & Science',
            'category' => 'chemistry',
            'keywords' => ['molar', 'molarity', 'ph', 'chemical', 'titration', 'reaction',
                          'stoichiometry', 'empirical', 'solution', 'boiling'],
        ],
        [
            'name'     => 'Unit Converters',
            'category' => 'converter',
            'keywords' => ['acres', 'hectares', 'feet', 'inches', 'meters', 'miles', 'km',
                          'kg', 'pounds', 'grams', 'liters', 'gallons', 'bytes', 'mb', 'gb'],
        ],
        [
            'name'     => 'Generators & Random Tools',
            'category' => 'generator',
            'keywords' => ['generator', 'random', 'name', 'password', 'uuid', 'lorem',
                          'barcode', 'qr', 'maze', 'sudoku', 'prompt', 'idea', 'picker'],
        ],
        [
            'name'     => 'Text & Writing Tools',
            'category' => 'text',
            'keywords' => ['text', 'word', 'counter', 'case', 'formatter', 'converter',
                          'markdown', 'html', 'diff', 'compare', 'extractor', 'cleaner'],
        ],
    ];

    public function handle(): int
    {
        $isDryRun = $this->option('dry-run');

        $this->info("Seeding topical clusters...");

        // Get all tool slugs
        $allTools = DB::table('tool_health_checks')
            ->where('status', 'ok')
            ->pluck('tool_slug');

        $clustersCreated = 0;
        $assignmentsMade = 0;

        foreach ($this->clusters as $clusterData) {
            if (!$isDryRun) {
                $clusterId = DB::table('topical_clusters')->insertGetId([
                    'cluster_name' => $clusterData['name'],
                    'category'     => $clusterData['category'],
                    'description'  => "Tools related to {$clusterData['name']}",
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            } else {
                $clusterId = 0;
                $this->line("Would create cluster: {$clusterData['name']}");
            }

            $clustersCreated++;
            $toolsInCluster = 0;

            foreach ($allTools as $slug) {
                $parts = explode('-', $slug);
                $matched = false;

                foreach ($clusterData['keywords'] as $keyword) {
                    if (in_array($keyword, $parts) || str_contains($slug, $keyword)) {
                        $matched = true;
                        break;
                    }
                }

                if ($matched) {
                    if (!$isDryRun) {
                        DB::table('tool_cluster_map')->updateOrInsert(
                            ['tool_slug' => $slug, 'cluster_id' => $clusterId],
                            [
                                'is_primary'      => true,
                                'relevance_score' => 80.00,
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            ]
                        );
                    }
                    $toolsInCluster++;
                    $assignmentsMade++;
                }
            }

            $this->line("Cluster: {$clusterData['name']} → {$toolsInCluster} tools");
        }

        if ($isDryRun) {
            $this->info("DRY RUN: Would create {$clustersCreated} clusters, {$assignmentsMade} assignments");
        } else {
            $this->info("✅ Created {$clustersCreated} clusters, {$assignmentsMade} tool assignments");
        }

        return Command::SUCCESS;
    }
}
```

### Run it:
```bash
php artisan seo:seed-clusters --dry-run
php artisan seo:seed-clusters
```

### Verify:
```sql
SELECT cluster_name, COUNT(tcm.tool_slug) as tool_count
FROM topical_clusters tc
LEFT JOIN tool_cluster_map tcm ON tcm.cluster_id = tc.id
GROUP BY tc.id, tc.cluster_name
ORDER BY tool_count DESC;
```

---

## EXECUTION ORDER — FOLLOW EXACTLY

```
TODAY (urgent — fix blockers):
□ STEP 1: Fix OPENAI_API_KEY in .env + verify with test
□ STEP 2: Delete mock content (press "yes" this time)

TOMORROW:
□ STEP 3: Fix silent OpenAI failure in SemanticExtractorService
□ STEP 3: Re-run: php artisan seo:extract-semantics --force --batch=10
□ STEP 4: Fix internal link category logic
□ STEP 4: Clear bad links + regenerate: php artisan seo:generate-links

DAY 3:
□ STEP 5: Test content generation with 3 tools
□ STEP 5: Verify word count > 500 (not 118)
□ STEP 5: Run full generation overnight

DAY 4:
□ STEP 6: Connect content to frontend Blade templates
□ STEP 6: Test on 3 real tool pages
□ Approve 5-10 drafts in admin panel

DAY 5:
□ STEP 7: Seed topical clusters
□ Verify clusters make sense

WEEK 2:
□ Review and approve 50 drafts per day
□ Monitor Search Console for indexing
□ Build pillar pages for top 3 clusters
```

---

## VERIFICATION COMMANDS (Run After Each Step)

```bash
# After Step 1 — verify API key
php artisan tinker --execute="echo config('services.openai.api_key') ? 'OK' : 'MISSING';"

# After Step 2 — verify mock content deleted
php artisan tinker --execute="echo DB::table('content_drafts')->where('word_count', 118)->count() . ' mock drafts remaining';"

# After Step 3 — verify PAA/LSI data exists
php artisan tinker --execute="DB::table('semantic_keywords')->select('keyword_type', DB::raw('COUNT(*) as count'))->groupBy('keyword_type')->get()->each(fn(\$r) => print \$r->keyword_type . ': ' . \$r->count . PHP_EOL);"

# After Step 4 — verify sports tools link to sports tools
php artisan tinker --execute="DB::table('internal_links')->where('source_tool_slug', 'era-calculator')->pluck('target_tool_slug')->each(fn(\$s) => print \$s . PHP_EOL);"

# After Step 5 — verify real content generated
php artisan tinker --execute="echo 'Real content: ' . DB::table('content_drafts')->where('word_count', '>', 200)->count();"

# After Step 7 — verify clusters
php artisan tinker --execute="DB::table('topical_clusters')->pluck('cluster_name')->each(fn(\$n) => print \$n . PHP_EOL);"
```

---

## SUCCESS METRICS AT END OF WEEK 1

```
DATABASE:
□ content_drafts: 0 rows with word_count = 118
□ content_drafts: 1,000+ rows with word_count > 800
□ semantic_keywords: 25,000+ rows across all types
□ semantic_keywords paa type: 6,000+ rows
□ internal_links: 5,000+ rows with relevance_score >= 35
□ topical_clusters: 10 clusters created
□ tool_cluster_map: 1,000+ assignments

FRONTEND:
□ At least 1 tool page shows approved content
□ Related tools section appears on tool pages
□ FAQ section with schema markup appears on tool pages

OPENAI:
□ seo:generate-content --limit=10 produces unique, 800+ word content
□ No two drafts have the same content hash
□ No draft contains "OPENAI_API_KEY was not found"
```

---

*Version 4.0 | Database-verified from SQL dump dated May 30, 2026*
*Critical finding: OPENAI_API_KEY missing caused ALL AI extraction to silently fail*
*8,117 autocomplete-only keywords saved, 0 PAA/LSI/Entity from AI*
*Internal links exist but quality is wrong — sports tools linked to unrelated tools*
*Mock content: 1,394 rows still in DB — delete today*
