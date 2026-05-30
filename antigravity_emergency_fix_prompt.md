# ANTIGRAVITY — EMERGENCY BUG FIX PROMPT
## Version: HOTFIX-1.0 | Priority: CRITICAL | Do Not Skip Any Step

---

> **HOW TO USE THIS PROMPT:**
> Paste this as your FIRST message in a new conversation.
> Then send: "Begin Emergency Audit now. Show me the code for each broken file before fixing it."
> Do NOT let AI fix anything without showing you the current broken code first.

---

## ═══════════════════════════════════════════════════════
## IDENTITY
## ═══════════════════════════════════════════════════════

You are a Senior Laravel Debugger and Production Systems Engineer.
You are NOT here to add new features.
You are here to FIX exactly 25 confirmed production bugs — nothing more, nothing less.

**Active codebase:** `[YOUR_GITHUB_REPO_URL]`
**Live site:** `[YOUR_LIVE_SITE_URL]`

---

## ═══════════════════════════════════════════════════════
## GOLDEN RULES FOR THIS HOTFIX SESSION
## ═══════════════════════════════════════════════════════

```
❌ DO NOT add any new features during this session
❌ DO NOT refactor working code
❌ DO NOT change database column names that already exist
❌ DO NOT modify routes that are currently working
❌ DO NOT touch frontend Blade files unless a bug directly requires it
❌ DO NOT run migrations that drop or alter existing columns
❌ DO NOT use updateOrCreate without verifying the unique key first
❌ DO NOT hardcode any limit (5, 10, 100) without an env variable fallback

✅ ALWAYS show me the existing broken code BEFORE writing the fix
✅ ALWAYS show the exact file path for every fix
✅ ALWAYS write the migration file for any DB schema change
✅ ALWAYS test logic with a dry-run flag before real execution
✅ ALWAYS fix one bug group at a time, confirm before moving to next
✅ ALWAYS add a comment: // HOTFIX-1.0: [reason] on every changed line
```

---

## ═══════════════════════════════════════════════════════
## PHASE A — EMERGENCY DATABASE CLEANUP (DO THIS FIRST)
## ═══════════════════════════════════════════════════════

### BUG GROUP 1: Duplicate content_drafts Records (Issues #4, #5, #6, #7, #8, #9, #23, #24)

**Problem:**
The content_drafts table has multiple records for the same tool_slug:
- at-bats-per-home-run-calculator → 3 duplicate rows
- era-calculator → 3 duplicate rows
- fip-calculator → 3 duplicate rows
- ops-calculator → 3 duplicate rows
- total-bases-calculator → 3 duplicate rows

This is caused by:
1. No UNIQUE constraint on tool_slug column
2. The seeding/generation command uses INSERT instead of updateOrCreate
3. --force flag creates new records instead of updating existing ones

**Fix Steps — do in this exact order:**

STEP A1: Run this diagnostic query first and show me the output:
```sql
SELECT tool_slug, COUNT(*) as count, GROUP_CONCAT(id ORDER BY id) as ids
FROM content_drafts
GROUP BY tool_slug
HAVING COUNT(*) > 1
ORDER BY count DESC;
```

STEP A2: Before deleting anything, backup duplicates:
```sql
CREATE TABLE content_drafts_backup_hotfix AS SELECT * FROM content_drafts;
```

STEP A3: Delete duplicates — keep only the LATEST record per tool_slug:
```sql
DELETE FROM content_drafts
WHERE id NOT IN (
    SELECT max_id FROM (
        SELECT MAX(id) as max_id
        FROM content_drafts
        GROUP BY tool_slug
    ) as keep_ids
);
```

STEP A4: Verify cleanup:
```sql
SELECT tool_slug, COUNT(*) as count
FROM content_drafts
GROUP BY tool_slug
HAVING COUNT(*) > 1;
-- Should return 0 rows
```

STEP A5: Create migration to add UNIQUE constraint:
```php
// File: database/migrations/[timestamp]_add_unique_tool_slug_to_content_drafts_table.php

public function up(): void
{
    Schema::table('content_drafts', function (Blueprint $table) {
        // HOTFIX-1.0: Prevent duplicate drafts per tool
        $table->unique('tool_slug', 'unique_content_draft_tool_slug');
    });
}

public function down(): void
{
    Schema::table('content_drafts', function (Blueprint $table) {
        $table->dropUnique('unique_content_draft_tool_slug');
    });
}
```

STEP A6: Fix the Artisan command — find the generate-content command file and replace INSERT logic:
```php
// WRONG (current broken code):
ContentDraft::create([...]);

// CORRECT FIX:
ContentDraft::updateOrCreate(
    ['tool_slug' => $toolSlug], // HOTFIX-1.0: Unique key prevents duplicates
    [
        'draft_type'    => $draftType,
        'status'        => 'pending_review',
        'draft_content' => $generatedContent,
        'ai_model_used' => 'gpt-4o-mini',
        'word_count'    => str_word_count($generatedContent),
        'updated_at'    => now(),
    ]
);
```

STEP A7: Fix the --force flag behavior:
```php
// In the handle() method of the Artisan command:
if ($this->option('force')) {
    // HOTFIX-1.0: Force flag updates existing, does not create duplicates
    ContentDraft::where('tool_slug', $toolSlug)
        ->update(['status' => 'pending_review', 'updated_at' => now()]);
    $this->info("Force-updated: {$toolSlug}");
    continue;
}
```

---

## ═══════════════════════════════════════════════════════
## PHASE B — FIX THE HARDCODED 5-TOOL LIMIT (Issues #1, #2, #3, #25)
## ═══════════════════════════════════════════════════════

### BUG GROUP 2: Content Generation Processing Only 5 Tools

**Problem:**
`php artisan seo:generate-content` always shows: 5/5 [====] 100%
This means somewhere in the command there is a hardcoded limit of 5.

**Diagnostic — find the limit:**

STEP B1: Show me the full source of the Artisan command:
```
cat app/Console/Commands/SeoGenerateContent.php
```
(or whatever the command file is named — find it with: `grep -r "generate-content" app/Console/`)

STEP B2: Look for these patterns that cause the bug:
```php
// BUG PATTERN 1: Hardcoded take/limit
->take(5)
->limit(5)
->first(5)

// BUG PATTERN 2: Test mode condition
if (app()->environment('testing')) { ... }
if (config('app.debug') && $count > 5) { break; }

// BUG PATTERN 3: Wrong query scope
Tool::where('status', 'test')->...    // only test tools
Tool::whereIn('id', [1,2,3,4,5])->... // hardcoded IDs

// BUG PATTERN 4: Chunk stopping early
->chunk(5, function($tools) {
    // missing return false check or early return
})
```

STEP B3: Fix the query to process ALL eligible tools:
```php
// HOTFIX-1.0: Remove hardcoded limit, process all active tools
$batchSize = (int) config('seo.content_generation.batch_size', 50);
$limit = $this->option('limit') ? (int) $this->option('limit') : null;

$query = Tool::query()
    ->where('is_active', true)         // only active tools
    ->whereDoesntHave('contentDraft', function($q) {
        $q->where('status', 'approved'); // skip already approved
    })
    ->orderBy('priority_score', 'desc') // highest priority first
    ->orderBy('id', 'asc');

if ($limit) {
    $query->limit($limit); // HOTFIX-1.0: Optional limit via CLI flag only
}

$totalTools = $query->count();
$bar = $this->output->createProgressBar($totalTools);
$bar->start();

$query->chunk($batchSize, function($tools) use ($bar) {
    foreach ($tools as $tool) {
        $this->processOneTool($tool);
        $bar->advance();
    }
    // HOTFIX-1.0: Allow garbage collection between chunks
    gc_collect_cycles();
});

$bar->finish();
```

STEP B4: Add CLI options for safe partial runs:
```php
// In the command signature:
protected $signature = 'seo:generate-content
    {--limit= : Limit number of tools (optional, for testing)}
    {--tool= : Process single tool by slug}
    {--force : Overwrite existing pending drafts}
    {--dry-run : Show what would be processed without making changes}
    {--category= : Process only tools in this category slug}';
```

STEP B5: Add dry-run mode:
```php
if ($this->option('dry-run')) {
    // HOTFIX-1.0: Safe preview mode - shows what would run without doing it
    $this->info("DRY RUN MODE — No changes will be made");
    $this->info("Tools that would be processed: {$totalTools}");
    $query->chunk($batchSize, function($tools) {
        foreach ($tools as $tool) {
            $this->line("  Would process: [{$tool->id}] {$tool->slug}");
        }
    });
    return Command::SUCCESS;
}
```

STEP B6: Add memory management for 1400+ tools:
```php
// In .env, add:
SEO_CONTENT_BATCH_SIZE=50
SEO_CONTENT_MEMORY_LIMIT=512M
SEO_CONTENT_TIME_LIMIT=3600

// In command handle():
ini_set('memory_limit', config('seo.content_generation.memory_limit', '512M'));
set_time_limit((int) config('seo.content_generation.time_limit', 3600));
```

---

## ═══════════════════════════════════════════════════════
## PHASE C — FIX THE BROKEN ADMIN ROUTE (Issues #13, #14, #15)
## ═══════════════════════════════════════════════════════

### BUG GROUP 3: Route [admin.monitor.progress] Not Defined

**Problem:**
A Blade view is calling `route('admin.monitor.progress')` but this route does not exist in routes/web.php or routes/admin.php.

STEP C1: Find where the broken route call is:
```bash
grep -r "admin.monitor.progress" resources/views/
grep -r "admin.monitor.progress" app/
```

STEP C2: Find existing admin route file:
```bash
cat routes/web.php
cat routes/admin.php  # if exists
```

STEP C3: Option 1 — Add the missing route (if the feature is needed):
```php
// In routes/web.php or routes/admin.php — inside existing admin middleware group:
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // ... existing routes ...

    // HOTFIX-1.0: Add missing progress monitoring route
    Route::get('/monitor/progress', [SeoMonitorController::class, 'progress'])
         ->name('monitor.progress');
});
```

STEP C4: Create the missing controller method:
```php
// In app/Http/Controllers/Admin/SeoMonitorController.php
// HOTFIX-1.0: New method to support admin.monitor.progress route

public function progress()
{
    $stats = [
        'total_tools'           => Tool::count(),
        'drafts_pending'        => ContentDraft::where('status', 'pending_review')->count(),
        'drafts_approved'       => ContentDraft::where('status', 'approved')->count(),
        'drafts_total'          => ContentDraft::count(),
        'internal_links_total'  => InternalLink::count(),
        'semantic_keywords'     => SemanticKeyword::count(),
        'orphan_tools'          => Tool::whereDoesntHave('incomingLinks')->count(),
        'last_generation_run'   => Cache::get('seo:last_content_generation_run', 'Never'),
    ];

    return view('admin.seo.monitor-progress', compact('stats'));
}
```

STEP C5: Create the minimal Blade view:
```blade
{{-- resources/views/admin/seo/monitor-progress.blade.php --}}
{{-- HOTFIX-1.0: New view for admin.monitor.progress route --}}
@extends('layouts.admin')  {{-- Use existing admin layout --}}

@section('content')
<div class="container-fluid">
    <h1>SEO Automation Progress</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Tools</h5>
                    <h2>{{ number_format($stats['total_tools']) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Drafts Pending Review</h5>
                    <h2>{{ number_format($stats['drafts_pending']) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Drafts Approved</h5>
                    <h2>{{ number_format($stats['drafts_approved']) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Orphan Tools</h5>
                    <h2>{{ number_format($stats['orphan_tools']) }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

STEP C6: Option 2 — If the feature is not needed yet, safely comment out the Blade call:
```blade
{{-- HOTFIX-1.0: Route temporarily disabled until SeoMonitorController is built --}}
{{-- <a href="{{ route('admin.monitor.progress') }}">Monitor Progress</a> --}}
<a href="#" class="disabled text-muted">Monitor Progress (Coming Soon)</a>
```

**Use Option 1 if you want the monitoring page. Use Option 2 if you just want the error to stop.**

---

## ═══════════════════════════════════════════════════════
## PHASE D — VERIFY FRONTEND CONTENT DISPLAY (Issue #16)
## ═══════════════════════════════════════════════════════

### BUG GROUP 4: Generated Content Not Confirmed on Frontend

STEP D1: Find the tool show page Blade template:
```bash
grep -r "tool" resources/views/ --include="*.blade.php" -l
# Look for: show.blade.php, tool.blade.php, single.blade.php
```

STEP D2: Check if the tool detail page loads content_draft data:
```php
// In ToolController@show (or equivalent):
// VERIFY this exists:
$draft = ContentDraft::where('tool_slug', $tool->slug)
    ->where('status', 'approved')
    ->first();

return view('tools.show', compact('tool', 'draft'));
```

STEP D3: If content is NOT being shown, add it to the controller:
```php
// HOTFIX-1.0: Pass approved content draft to tool view
public function show($slug)
{
    $tool = Tool::where('slug', $slug)->where('is_active', true)->firstOrFail();

    $contentDraft = ContentDraft::where('tool_slug', $slug)
        ->where('status', 'approved')
        ->select(['draft_content', 'outline_json', 'updated_at'])
        ->first();

    return view('tools.show', [
        'tool'          => $tool,
        'contentDraft'  => $contentDraft,
        // ... other existing variables — do not remove them
    ]);
}
```

STEP D4: In the tool Blade view, add a safe content display zone:
```blade
{{-- HOTFIX-1.0: Display approved AI content if available --}}
@if($contentDraft && $contentDraft->draft_content)
    <div class="tool-seo-content mt-4">
        {!! nl2br(e($contentDraft->draft_content)) !!}
        {{-- Note: Use nl2br(e()) for safe HTML. If content contains intentional HTML, use {!! $contentDraft->draft_content !!} after sanitization --}}
    </div>
@endif
```

---

## ═══════════════════════════════════════════════════════
## PHASE E — PIPELINE CONNECTIVITY AUDIT (Issues #17–#21)
## ═══════════════════════════════════════════════════════

### BUG GROUP 5: Automation Tables Not Confirmed Connected

Run these diagnostic queries and show me the results before any fix:

```sql
-- E1: How many tools have semantic keywords extracted?
SELECT
    (SELECT COUNT(DISTINCT tool_id) FROM semantic_keywords) as tools_with_keywords,
    (SELECT COUNT(*) FROM tools WHERE is_active = 1) as total_active_tools,
    ROUND(
        (SELECT COUNT(DISTINCT tool_id) FROM semantic_keywords) /
        (SELECT COUNT(*) FROM tools WHERE is_active = 1) * 100, 2
    ) as coverage_percentage;

-- E2: How many tools have internal links?
SELECT
    (SELECT COUNT(DISTINCT source_tool_id) FROM internal_links) as tools_with_outgoing_links,
    (SELECT COUNT(DISTINCT target_tool_id) FROM internal_links) as tools_with_incoming_links,
    (SELECT COUNT(*) FROM tools WHERE is_active = 1) as total_active_tools;

-- E3: How many tools are orphaned (no internal links at all)?
SELECT COUNT(*) as orphan_count
FROM tools t
WHERE t.is_active = 1
AND NOT EXISTS (SELECT 1 FROM internal_links WHERE source_tool_id = t.id)
AND NOT EXISTS (SELECT 1 FROM internal_links WHERE target_tool_id = t.id);

-- E4: Content draft coverage:
SELECT
    status,
    COUNT(*) as count,
    ROUND(COUNT(*) / (SELECT COUNT(*) FROM tools WHERE is_active = 1) * 100, 2) as pct_of_total_tools
FROM content_drafts
GROUP BY status;

-- E5: Are cluster assignments populated?
SELECT
    (SELECT COUNT(*) FROM topical_clusters) as total_clusters,
    (SELECT COUNT(*) FROM tool_cluster_map) as cluster_assignments,
    (SELECT COUNT(DISTINCT tool_id) FROM tool_cluster_map) as tools_in_clusters;
```

**After seeing results, AI will implement targeted fixes based on which tables are empty or disconnected.**

---

## ═══════════════════════════════════════════════════════
## PHASE F — SCALE & PERFORMANCE FIXES (Issues #21, #22)
## ═══════════════════════════════════════════════════════

### BUG GROUP 6: System Not Safe for 1400+ Tools at Scale

STEP F1: Add chunking to ALL bulk processing commands:
```php
// HOTFIX-1.0: Never load all 1400 tools into memory at once
// WRONG:
$tools = Tool::all(); // CRASHES at 1400+ records

// CORRECT:
Tool::chunk(50, function ($tools) {
    foreach ($tools as $tool) {
        // process one at a time
    }
    gc_collect_cycles(); // Free memory between chunks
});
```

STEP F2: Add queue-based processing with rate limiting:
```php
// HOTFIX-1.0: Dispatch jobs to queue instead of processing synchronously
Tool::chunk(50, function ($tools) {
    foreach ($tools as $tool) {
        ProcessToolSemanticExtractionJob::dispatch($tool->id)
            ->onQueue('semantic_extraction')
            ->delay(now()->addSeconds(rand(1, 5))); // Stagger to avoid API rate limits
    }
});
```

STEP F3: Add progress tracking to long-running commands:
```php
// HOTFIX-1.0: Cache progress so admin panel can show real-time status
Cache::put('seo:generation_progress', [
    'started_at'    => now()->toIso8601String(),
    'total'         => $totalTools,
    'processed'     => 0,
    'failed'        => 0,
    'current_tool'  => null,
], now()->addHours(12));

// Update inside the loop:
Cache::increment('seo:generation_progress_count');
```

STEP F4: Add OpenAI rate limiting protection:
```php
// HOTFIX-1.0: Prevent OpenAI 429 (rate limit) errors during bulk runs
// Add to config/seo.php:
'openai' => [
    'requests_per_minute' => env('OPENAI_RPM_LIMIT', 20),
    'delay_between_requests_ms' => env('OPENAI_REQUEST_DELAY_MS', 3000),
    'max_retries' => 3,
    'retry_delay_seconds' => 60,
],

// In the generation service:
private function callOpenAIWithRateLimit(string $prompt): string
{
    $maxRetries = config('seo.openai.max_retries', 3);
    $attempt = 0;

    while ($attempt < $maxRetries) {
        try {
            usleep(config('seo.openai.delay_between_requests_ms', 3000) * 1000);
            return $this->openai->chat($prompt); // your existing call
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), '429')) {
                $attempt++;
                $this->warn("Rate limited. Waiting 60s. Attempt {$attempt}/{$maxRetries}");
                sleep(config('seo.openai.retry_delay_seconds', 60));
            } else {
                throw $e; // Non-rate-limit errors bubble up
            }
        }
    }
    throw new \RuntimeException("OpenAI rate limit exceeded after {$maxRetries} retries");
}
```

---

## ═══════════════════════════════════════════════════════
## PHASE G — OPENAI API KEY VERIFICATION (Issues #10, #11, #12)
## ═══════════════════════════════════════════════════════

### BUG GROUP 7: Ensure API Key is Permanently Fixed

STEP G1: Verify .env has the key:
```bash
grep "OPENAI_API_KEY" .env
# Should show: OPENAI_API_KEY=sk-...
# Should NOT show: OPENAI_API_KEY= (empty)
```

STEP G2: Add a startup check so this never silently fails again:
```php
// In App\Providers\AppServiceProvider.php — add to boot():

// HOTFIX-1.0: Fail loudly if OpenAI key is missing in production
if (app()->environment('production') && empty(config('services.openai.api_key'))) {
    throw new \RuntimeException(
        'OPENAI_API_KEY is not configured. SEO automation cannot run. Set it in .env'
    );
}
```

STEP G3: Add a health check command:
```php
// New command: php artisan seo:health-check
// HOTFIX-1.0: Run this before any generation to validate all dependencies

public function handle()
{
    $checks = [
        'OpenAI API Key'     => !empty(config('services.openai.api_key')),
        'Database Connected' => $this->checkDatabase(),
        'Redis Connected'    => $this->checkRedis(),
        'Queue Worker Running' => $this->checkQueueWorker(),
        'content_drafts table' => Schema::hasTable('content_drafts'),
        'semantic_keywords table' => Schema::hasTable('semantic_keywords'),
        'internal_links table' => Schema::hasTable('internal_links'),
        'topical_clusters table' => Schema::hasTable('topical_clusters'),
    ];

    foreach ($checks as $name => $passed) {
        if ($passed) {
            $this->info("✅ {$name}");
        } else {
            $this->error("❌ {$name} — FAILED");
        }
    }
}
```

---

## ═══════════════════════════════════════════════════════
## EXECUTION ORDER — STRICTLY FOLLOW THIS SEQUENCE
## ═══════════════════════════════════════════════════════

```
STEP 1:  Run: php artisan seo:health-check (after building it in Phase G)
         → Confirm all dependencies green before doing anything else

STEP 2:  Run Phase A (Database Cleanup)
         → Backup first → delete duplicates → add UNIQUE constraint → migrate
         → Confirm: SELECT COUNT(*) FROM content_drafts GROUP BY tool_slug HAVING COUNT(*) > 1
         → Should return 0 rows

STEP 3:  Run Phase B (Fix 5-tool limit)
         → Find the hardcoded limit → show me the broken code → apply fix
         → Test with: php artisan seo:generate-content --dry-run --limit=10
         → Confirm shows 10 different tools (not 5)

STEP 4:  Run Phase C (Fix broken admin route)
         → Add the route → create controller method → create/update Blade view
         → Confirm: php artisan route:list | grep monitor.progress
         → Should show the route

STEP 5:  Run Phase E (Pipeline diagnostics)
         → Run all 5 SQL queries → show me results
         → Based on results, implement targeted connectivity fixes

STEP 6:  Run Phase D (Frontend content display)
         → Only after Phase E confirms content exists in DB
         → Verify content shows on a real tool page

STEP 7:  Run Phase F (Scale fixes)
         → Add chunking, rate limiting, queue-based dispatch
         → Test with: php artisan seo:generate-content --limit=100
         → Monitor memory: watch -n 1 "php artisan seo:health-check"

STEP 8:  Run: php artisan seo:generate-content --dry-run
         → Confirm it shows 1400+ tools queued, not 5
         → Run actual generation in off-peak hours
```

---

## ═══════════════════════════════════════════════════════
## COMPLETE BUG TRACKING LOG
## ═══════════════════════════════════════════════════════

Use this checklist to confirm each bug is fixed:

```
PHASE A — Database:
[ ] #4  Duplicate content_drafts removed
[ ] #5  --force flag no longer creates duplicates
[ ] #6  at-bats, era, fip, ops, total-bases duplicates cleaned
[ ] #7  UNIQUE constraint added to tool_slug
[ ] #8  updateOrCreate used instead of create()
[ ] #9  Repeated execution no longer creates new records
[ ] #23 Duplicate drafts cleaned up (backup preserved)
[ ] #24 Database-level unique constraint migrated

PHASE B — Processing Scale:
[ ] #1  All 1400+ tools processed (not just 5)
[ ] #2  Progress bar shows real total count
[ ] #3  No hardcoded limit remains in command
[ ] #25 Command audited, limit root cause identified and fixed

PHASE C — Admin Route:
[ ] #13 Route admin.monitor.progress now exists
[ ] #14 Blade view no longer throws RouteNotFoundException
[ ] #15 Admin page loads without error

PHASE D — Frontend:
[ ] #16 Approved content displays on tool pages

PHASE E — Pipeline:
[ ] #17 Content confirmed displaying correctly
[ ] #18 Semantic extraction confirmed running on all tools
[ ] #19 Internal link generation confirmed on full inventory
[ ] #20 Content generation confirmed using semantic keywords
[ ] #21 Pipeline validated for large-scale processing

PHASE F — Performance:
[ ] #22 Batch processing safe for 1400+ tools
       Chunking: ✅ / Memory management: ✅ / Queue dispatch: ✅ / Rate limiting: ✅

PHASE G — API Key:
[ ] #10 OpenAI key absence no longer causes silent failures
[ ] #11 Logs no longer show "OPENAI_API_KEY is not set"
[ ] #12 Content generation confirmed working end-to-end
```

---

## ═══════════════════════════════════════════════════════
## POST-FIX VALIDATION COMMANDS
## ═══════════════════════════════════════════════════════

Run these after all fixes to confirm system health:

```bash
# 1. Health check
php artisan seo:health-check

# 2. Confirm no duplicates
php artisan tinker --execute="echo ContentDraft::selectRaw('tool_slug, COUNT(*) as c')->groupBy('tool_slug')->having('c', '>', 1)->count() . ' duplicates remaining';"

# 3. Dry run on full set
php artisan seo:generate-content --dry-run

# 4. Route list confirmation
php artisan route:list | grep "monitor"

# 5. Queue status
php artisan queue:monitor

# 6. Run 10 tools for real as final test
php artisan seo:generate-content --limit=10

# 7. Confirm 10 new/updated records (not 10 duplicates added)
php artisan tinker --execute="ContentDraft::latest()->take(10)->pluck('tool_slug');"
```

---

## ═══════════════════════════════════════════════════════
## AFTER ALL BUGS ARE FIXED — NEXT STEPS
## ═══════════════════════════════════════════════════════

Once all 25 bugs are confirmed fixed:

```
1. Run full generation: php artisan seo:generate-content
   (This should now process all 1400+ tools via queue — takes hours, that is normal)

2. Monitor queue: php artisan queue:work --queue=content_generation --tries=3

3. Check admin panel SEO Intelligence section to review pending drafts

4. Approve content one category at a time (Finance first, then Developer, etc.)

5. Only after content is human-reviewed and approved, it will display on frontend

6. Monitor Search Console for indexing improvements over next 4-6 weeks
```

---

*Hotfix Version: 1.0 | Target: AntiGravity Production System*
*Issues Covered: #1 through #25 | Fix Method: Surgical, non-breaking*
*DO NOT use this prompt to add new features. Fix first, enhance later.*
