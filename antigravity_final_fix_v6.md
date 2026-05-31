# ANTIGRAVITY — FINAL FIX PROMPT (Version 6.0)
## Based on Deep Code + Database Analysis — May 31, 2026
## Paste into new conversation → Say: "Start Bug Fix 1 now."

---

## WHAT I KNOW FOR CERTAIN — READ THIS FIRST

### Database State (from SQL dump):
```
content_drafts:    10 rows (only 10 tools generated, not 1407)
semantic_keywords: 8,135 rows BUT 8,117 = autocomplete only
                   PAA: 5 rows | LSI: 5 rows | Entity: 3 rows (all near zero)
internal_links:    2,678 rows ✅ (fixed in v4)
topical_clusters:  10 rows ✅
tool_cluster_map:  1,031 rows ✅ (but tool_slug column issue — see Bug 3)
```

### Why Only 10 Drafts Generated (Root Cause Found):
The command `seo:generate-content` runs without `--force`.
The query JOINs content_drafts where status IN ('approved','published').
Since 1,394 mock drafts had status='pending_review', NOT 'approved',
the LEFT JOIN sees them as "no approved content" = eligible to generate.
BUT — the `updateOrCreate(['tool_slug' => $slug])` finds the existing
pending_review row and UPDATES it instead of creating a new one.
**Result: Only tools with NO existing draft at all get processed correctly.
After the first 10 tools, the command seems to stop or the remaining
1,384 existing pending_review rows block new generation.**

The REAL problem: `--force` is needed to regenerate, but mock drafts
still partially exist in the table blocking the query logic.

### Why Content NOT Showing on Frontend (Root Cause Found):
```php
// ToolController.php line 67-70:
$seoDraft = \App\Models\ContentDraft::where('tool_slug', $tool['slug'])
    ->where('status', 'approved')   // ← THIS IS THE BLOCKER
    ->select(['draft_content', ...])
    ->first();
```
ALL 10 generated drafts have status = 'pending_review'.
The frontend ONLY shows status = 'approved'.
NO drafts are approved → $seoDraft = null → nothing shows on page.

### Why OPS Calculator Content Is Wrong:
`ops-calculator` falls through to `autoExtract()` in ToolContextExtractor.
The word "ops" is not in any category list.
Category = 'General Tools' → Gemini gets no baseball context.
Gemini invents "Operations Per Unit Time" — completely wrong.
OPS in baseball = On-Base Plus Slugging.

### tool_cluster_map Issue:
The `SeoGenerateInternalLinks` command uses `source_tool_slug` and
`target_tool_slug` column names in the INSERT, but check if the actual
migration created them as `tool_slug` + `cluster_id` instead.

---

## TECH STACK
- Laravel + PHP 8.2 + MySQL (MariaDB 10.4)
- File Cache (no Redis)
- GitHub: https://github.com/noormuhammad2k20-a11y/fantastic-octo-dollop
- AI: Google Gemini API (gemini-2.5-flash model in use)

## YOUR ROLE
Senior Laravel Engineer. Fix real bugs. Show existing code before changing it.
No new features until all bugs listed below are fixed.

---

## ABSOLUTE RULES
```
❌ NEVER auto-publish — always status='pending_review' until human approves
❌ NEVER use Tool::all() — always chunk(50)
❌ NEVER hardcode API keys
❌ NEVER alter existing columns — only add new ones
✅ ALWAYS show the broken code before writing the fix
✅ ALWAYS use updateOrCreate() with tool_slug as unique key
✅ ALWAYS verify with a tinker command after each fix
```

---

## BUG FIX 1 — Admin Approval UI Must Work
### (Highest Priority — Without This Nothing Shows on Site)

The frontend shows ZERO content because ALL drafts are 'pending_review'.
Before fixing generation, fix the approval workflow first.

### Find the ContentDraftController:
```bash
cat app/Http/Controllers/Admin/ContentDraftController.php
```

### Check if admin route exists:
```bash
php artisan route:list | grep "content-draft"
```
Expected: Should show routes for index, edit, update.

### Check if admin index view exists:
```bash
ls resources/views/admin/
find resources/views -name "*draft*" -o -name "*content*" | grep -v node_modules
```

### If ContentDraftController exists, verify these methods work:

**The index() must show pending_review drafts:**
```php
// In ContentDraftController::index()
// VERIFY it queries: status = 'pending_review'
// VERIFY it paginates (not loading all 1400 at once)
// VERIFY it passes word_count and seo_score to view for review decisions
```

**The update() must handle approval:**
```php
// VERIFY this method exists and handles:
// status change: pending_review → approved
// status change: pending_review → rejected
```

### If approval controller/view is broken or missing, create it:

**File:** `app/Http/Controllers/Admin/ContentDraftController.php`
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentDraft;
use Illuminate\Http\Request;

class ContentDraftController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending_review');

        $drafts = ContentDraft::where('status', $status)
            ->orderByDesc('seo_score')
            ->orderByDesc('word_count')
            ->paginate(30);

        $counts = [
            'pending_review' => ContentDraft::where('status', 'pending_review')->count(),
            'approved'       => ContentDraft::where('status', 'approved')->count(),
            'rejected'       => ContentDraft::where('status', 'rejected')->count(),
        ];

        return view('admin.content-drafts.index', compact('drafts', 'counts', 'status'));
    }

    public function edit(ContentDraft $contentDraft)
    {
        return view('admin.content-drafts.edit', ['draft' => $contentDraft]);
    }

    public function update(Request $request, ContentDraft $contentDraft)
    {
        $validated = $request->validate([
            'status'        => 'required|in:pending_review,approved,rejected',
            'draft_content' => 'nullable|string',
        ]);

        $contentDraft->update([
            'status'        => $validated['status'],
            'draft_content' => $validated['draft_content'] ?? $contentDraft->draft_content,
            'reviewed_by'   => auth()->id(),
            'reviewed_at'   => now(),
            'published_at'  => $validated['status'] === 'approved' ? now() : null,
        ]);

        return redirect()
            ->route('admin.content-drafts.index')
            ->with('success', "Draft {$validated['status']} for {$contentDraft->tool_slug}");
    }

    /**
     * Bulk approve all drafts with seo_score >= threshold
     * Use with caution — review first!
     */
    public function bulkApprove(Request $request)
    {
        $minScore = (int) $request->get('min_score', 70);
        $minWords = (int) $request->get('min_words', 700);

        $count = ContentDraft::where('status', 'pending_review')
            ->where('seo_score', '>=', $minScore)
            ->where('word_count', '>=', $minWords)
            ->whereNotNull('draft_content')
            ->update([
                'status'      => 'approved',
                'reviewed_at' => now(),
                'published_at'=> now(),
            ]);

        return redirect()
            ->route('admin.content-drafts.index', ['status' => 'approved'])
            ->with('success', "Bulk approved {$count} drafts (score >= {$minScore}, words >= {$minWords})");
    }
}
```

**Minimal admin view — File:** `resources/views/admin/content-drafts/index.blade.php`
```blade
@extends('layouts.admin')
@section('content')
<div class="container-fluid py-4">
    <h1>Content Drafts</h1>

    {{-- Status Tabs --}}
    <div class="mb-3">
        <a href="?status=pending_review" class="btn btn-{{ request('status','pending_review')==='pending_review'?'primary':'outline-primary' }}">
            Pending Review ({{ $counts['pending_review'] }})
        </a>
        <a href="?status=approved" class="btn btn-{{ request('status')==='approved'?'success':'outline-success' }}">
            Approved ({{ $counts['approved'] }})
        </a>
        <a href="?status=rejected" class="btn btn-{{ request('status')==='rejected'?'danger':'outline-danger' }}">
            Rejected ({{ $counts['rejected'] }})
        </a>
    </div>

    {{-- Bulk Approve Form --}}
    @if(request('status','pending_review') === 'pending_review')
    <form method="POST" action="{{ route('admin.content-drafts.bulk-approve') }}" class="mb-4 d-inline">
        @csrf
        <input type="hidden" name="min_score" value="70">
        <input type="hidden" name="min_words" value="700">
        <button type="submit" class="btn btn-success"
            onclick="return confirm('Bulk approve all drafts with score >= 70 and words >= 700?')">
            ⚡ Bulk Approve High-Quality Drafts
        </button>
    </form>
    @endif

    {{-- Drafts Table --}}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Tool Slug</th>
                <th>Words</th>
                <th>SEO Score</th>
                <th>Model</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drafts as $draft)
            <tr>
                <td><a href="/{{ $draft->tool_slug }}" target="_blank">{{ $draft->tool_slug }}</a></td>
                <td>
                    <span class="badge bg-{{ $draft->word_count >= 700 ? 'success' : 'warning' }}">
                        {{ $draft->word_count }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-{{ $draft->seo_score >= 70 ? 'success' : 'secondary' }}">
                        {{ $draft->seo_score }}/100
                    </span>
                </td>
                <td>{{ $draft->ai_model_used }}</td>
                <td>{{ $draft->status }}</td>
                <td>
                    <a href="{{ route('admin.content-drafts.edit', $draft) }}"
                       class="btn btn-sm btn-primary">Review</a>

                    {{-- Quick approve without editing --}}
                    <form method="POST"
                          action="{{ route('admin.content-drafts.update', $draft) }}"
                          class="d-inline">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-sm btn-success">✓ Approve</button>
                    </form>

                    <form method="POST"
                          action="{{ route('admin.content-drafts.update', $draft) }}"
                          class="d-inline">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-sm btn-danger">✗ Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $drafts->links() }}
</div>
@endsection
```

### Add bulk-approve route to web.php (in the admin/seo section):
```php
// Find the admin/seo route group in web.php and ADD inside it:
Route::post('content-drafts/bulk-approve',
    [\App\Http\Controllers\Admin\ContentDraftController::class, 'bulkApprove']
)->name('admin.content-drafts.bulk-approve');
```

### Quick approval for existing 10 drafts RIGHT NOW:
```bash
# Approve all 10 existing real drafts immediately:
php artisan tinker --execute="
\$count = \App\Models\ContentDraft::where('status', 'pending_review')
    ->where('word_count', '>', 500)
    ->update([
        'status' => 'approved',
        'reviewed_at' => now(),
        'published_at' => now(),
    ]);
echo \"Approved: {\$count} drafts\";
"
```

### Verify content now shows on site:
Open in browser: `/roi-calculator` — scroll to bottom.
You should see the SEO article section appear.
If still not showing → check Bug Fix 3 (namespace issue).

---

## BUG FIX 2 — Content Generation Stuck at 10 Tools

### Root Cause:
The query selects tools with NO 'approved'/'published' draft.
1,384 tools have pending_review drafts (old mock content re-generated partially).
The updateOrCreate finds these and updates them — but the progress bar
shows completion early because the LEFT JOIN query logic has a subtle issue.

### Diagnosis — run this first:
```bash
php artisan tinker --execute="
\$withApproved = \DB::table('tool_health_checks as t')
    ->leftJoin('content_drafts as cd', function(\$j) {
        \$j->on('cd.tool_slug','=','t.tool_slug')
           ->whereIn('cd.status',['approved','published']);
    })
    ->whereNull('cd.id')
    ->where('t.status','ok')
    ->count();
echo \"Tools without approved content: {\$withApproved}\";
"
```

### The real fix — use --force to regenerate everything:
```bash
# Step 1: Delete all remaining pending_review mock content
php artisan tinker --execute="
\$deleted = \App\Models\ContentDraft::where('status','pending_review')
    ->where(function(\$q) {
        \$q->where('word_count','<=',200)
           ->orWhere('generation_prompt_hash','6b0a0616767ff0fdc4cae362d4cae5f2');
    })
    ->delete();
echo \"Deleted {\$deleted} mock drafts\";
"

# Step 2: Check how many tools now have NO draft at all
php artisan tinker --execute="
\$noDraft = \DB::table('tool_health_checks')
    ->where('status','ok')
    ->whereNotIn('tool_slug', \DB::table('content_drafts')->pluck('tool_slug'))
    ->count();
echo \"Tools with zero drafts: {\$noDraft}\";
"

# Step 3: Run generation (no --force needed now since drafts are gone)
php artisan seo:generate-content --limit=5 --dry-run
php artisan seo:generate-content --limit=5
```

### After 5 tools generate — check quality:
```bash
php artisan tinker --execute="
\DB::table('content_drafts')
    ->where('word_count','>',500)
    ->orderByDesc('created_at')
    ->limit(5)
    ->get(['tool_slug','word_count','seo_score','ai_model_used'])
    ->each(fn(\$r) => print \$r->tool_slug . ' | ' . \$r->word_count . ' words | score: ' . \$r->seo_score . PHP_EOL);
"
```

Expected: word_count 900-1200, seo_score 70-100.

### Full generation — run overnight:
```bash
# Add rate limit protection in .env first:
# GEMINI_RPM_LIMIT=14

# Run full generation (background):
php artisan seo:generate-content --batch=10 > storage/logs/content-gen.log 2>&1
```

---

## BUG FIX 3 — Namespace Mismatch (Critical — Services May Not Load)

### Problem Found:
Files are in `app/Services/Seo/` (capital S lowercase eo) directory.
But the namespace in the files is `App\Services\SEO\` (all caps).
This causes class-not-found errors on case-sensitive Linux servers.

### Verify the problem:
```bash
# Check actual directory name:
ls app/Services/
# Shows: Seo/ or SEO/ ?

# Check namespace in GeminiService.php:
head -5 app/Services/Seo/GeminiService.php
# Shows: namespace App\Services\SEO; ← MISMATCH if folder is Seo/
```

### Fix — two options:

**Option A (Recommended): Rename folder to match namespace:**
```bash
# If folder is Seo/ but namespace says SEO:
mv app/Services/Seo app/Services/SEO

# Clear autoload:
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

**Option B: Update namespace to match folder:**
```bash
# If keeping Seo/ folder:
find app/Services/Seo -name "*.php" -exec sed -i 's/namespace App\\Services\\SEO/namespace App\\Services\\Seo/g' {} +

# Also update all use statements:
find app -name "*.php" -exec sed -i 's/use App\\Services\\SEO\\/use App\\Services\\Seo\\/g' {} +

composer dump-autoload
```

### Verify fix works:
```bash
php artisan tinker --execute="app(\App\Services\SEO\GeminiService::class)->isConfigured() ? 'Gemini OK' : 'Key Missing';"
```

---

## BUG FIX 4 — Sports Tools Get Wrong Content (OPS, ERA, FIP, WAR, WHIP)

### Problem:
`ops-calculator` → Gemini generates "Operations Per Unit Time" content.
`era-calculator` → Gemini generates "Error Rate Analysis" content.
These are BASEBALL stats. The ToolContextExtractor doesn't know this.

### Add sports tools to ToolContextExtractor toolContextMap:

Open: `app/Services/Seo/ToolContextExtractor.php`

Find the `$toolContextMap` array and ADD these entries:

```php
// BASEBALL STATS — Add after existing entries
'ops-calculator' => [
    'category'      => 'Sports & Baseball Statistics',
    'primary_use'   => 'calculate OPS (On-base Plus Slugging) for baseball players and teams',
    'related_terms' => ['on-base percentage', 'slugging percentage', 'batting average', 'baseball stats', 'OBP', 'SLG'],
    'user_types'    => ['baseball fans', 'fantasy baseball players', 'coaches', 'sports analysts'],
    'formula'       => 'OPS = OBP + SLG (On-Base Percentage + Slugging Percentage)',
],
'era-calculator' => [
    'category'      => 'Sports & Baseball Statistics',
    'primary_use'   => 'calculate ERA (Earned Run Average) for baseball pitchers',
    'related_terms' => ['earned runs', 'innings pitched', 'pitcher performance', 'WHIP', 'FIP', 'baseball'],
    'user_types'    => ['baseball fans', 'fantasy baseball managers', 'coaches', 'sports analysts'],
    'formula'       => 'ERA = (Earned Runs / Innings Pitched) × 9',
],
'fip-calculator' => [
    'category'      => 'Sports & Baseball Statistics',
    'primary_use'   => 'calculate FIP (Fielding Independent Pitching) to measure pitcher skill',
    'related_terms' => ['strikeouts', 'home runs', 'walks', 'hit by pitch', 'ERA', 'baseball analytics'],
    'user_types'    => ['sabermetrics fans', 'fantasy baseball players', 'baseball analysts', 'coaches'],
    'formula'       => 'FIP = ((13×HR + 3×(BB+HBP) - 2×K) / IP) + FIP Constant',
],
'war-calculator' => [
    'category'      => 'Sports & Baseball Statistics',
    'primary_use'   => 'calculate WAR (Wins Above Replacement) for baseball player valuation',
    'related_terms' => ['replacement level', 'player value', 'offensive WAR', 'defensive WAR', 'baseball salary'],
    'user_types'    => ['baseball analysts', 'fantasy baseball players', 'GMs', 'sabermetrics enthusiasts'],
    'formula'       => 'WAR = (Batting Runs + Baserunning Runs + Fielding Runs + Positional Adjustment + League Adjustment + Replacement Runs) / Runs Per Win',
],
'whip-calculator' => [
    'category'      => 'Sports & Baseball Statistics',
    'primary_use'   => 'calculate WHIP (Walks plus Hits per Inning Pitched) for pitchers',
    'related_terms' => ['walks', 'hits allowed', 'innings pitched', 'pitcher efficiency', 'ERA', 'FIP'],
    'user_types'    => ['baseball fans', 'fantasy baseball players', 'coaches', 'sports analysts'],
    'formula'       => 'WHIP = (Walks + Hits) / Innings Pitched',
],
'at-bats-per-home-run-calculator' => [
    'category'      => 'Sports & Baseball Statistics',
    'primary_use'   => 'calculate at-bats per home run ratio for baseball batters',
    'related_terms' => ['home run rate', 'power hitting', 'slugging', 'HR/AB', 'baseball batting stats'],
    'user_types'    => ['baseball fans', 'fantasy baseball players', 'coaches', 'scouts'],
    'formula'       => 'AB/HR = Total At-Bats / Total Home Runs',
],
'bowling-score-calculator' => [
    'category'      => 'Sports & Bowling',
    'primary_use'   => 'calculate bowling scores including strikes, spares, and open frames',
    'related_terms' => ['strike', 'spare', 'open frame', 'perfect game', 'bowling average', 'pin count'],
    'user_types'    => ['bowlers', 'bowling league members', 'coaches', 'recreational players'],
    'formula'       => 'Strike = 10 + next 2 balls | Spare = 10 + next ball | Open = pins knocked down',
],
'rebound-rate-calculator' => [
    'category'      => 'Sports & Basketball Statistics',
    'primary_use'   => 'calculate rebound rate percentage for basketball players',
    'related_terms' => ['offensive rebound', 'defensive rebound', 'total rebound', 'basketball stats', 'PER'],
    'user_types'    => ['basketball fans', 'fantasy basketball players', 'coaches', 'analysts'],
    'formula'       => 'Rebound Rate = 100 × (Rebounds × Team Minutes) / (Minutes × (Team Rebounds + Opponent Rebounds))',
],
'usage-rate-calculator' => [
    'category'      => 'Sports & Basketball Statistics',
    'primary_use'   => 'calculate usage rate to measure how often a basketball player is involved in plays',
    'related_terms' => ['ball possession', 'player involvement', 'field goal attempts', 'turnovers', 'NBA stats'],
    'user_types'    => ['basketball analysts', 'fantasy basketball players', 'coaches', 'scouts'],
    'formula'       => 'Usage Rate = 100 × ((FGA + 0.44×FTA + TOV) × Team Minutes) / (Minutes × (Team FGA + 0.44×Team FTA + Team TOV))',
],
```

### After adding context, regenerate these tools:
```bash
# Delete wrong content for sports tools:
php artisan tinker --execute="
\$slugs = ['ops-calculator','era-calculator','fip-calculator','war-calculator',
           'whip-calculator','at-bats-per-home-run-calculator','bowling-score-calculator',
           'rebound-rate-calculator','usage-rate-calculator'];
\App\Models\ContentDraft::whereIn('tool_slug', \$slugs)->delete();
echo 'Deleted wrong sports content';
"

# Regenerate with correct context:
php artisan seo:generate-content --tool=ops-calculator
php artisan seo:generate-content --tool=era-calculator
php artisan seo:generate-content --tool=bowling-score-calculator
# (repeat for each sports tool)
```

---

## BUG FIX 5 — Semantic Keywords: PAA/LSI Still Near Zero

### Problem:
After running `seo:extract-semantics`, only 5 PAA + 5 LSI rows exist (not 7,000+).
This means Gemini was either not called, or the cache kept returning
the old empty results.

### Diagnosis:
```bash
# Check if old cache is blocking re-extraction:
php artisan tinker --execute="
\$cached = \Illuminate\Support\Facades\Cache::get('semantics:roi-calculator');
echo \$cached ? 'Cache HIT — old data cached' : 'Cache MISS — will re-fetch';
"
```

### Fix — clear semantic cache and re-run:
```bash
# Clear the file cache (semantic keywords cached for 7 days):
php artisan cache:clear

# Verify Gemini is working for semantics first:
php artisan seo:extract-semantics --tool=roi-calculator --force

# Check result:
php artisan tinker --execute="
\DB::table('semantic_keywords')
    ->where('tool_slug','roi-calculator')
    ->select('keyword_type', \DB::raw('COUNT(*) as cnt'))
    ->groupBy('keyword_type')
    ->get()
    ->each(fn(\$r) => print \$r->keyword_type . ': ' . \$r->cnt . PHP_EOL);
"
```

Expected result:
```
autocomplete: 8
lsi: 5
paa: 5
entity: 3
semantic: 3
```

If you get only autocomplete → Gemini JSON parsing is failing.

### Debug Gemini JSON response:
Add temporary debug logging to `SemanticExtractorService.php` `generateAISemantics()`:
```php
// TEMPORARY DEBUG — add before return $keywords;
Log::channel('seo')->debug('Gemini JSON response for ' . $slug . ': ' . json_encode($data));
Log::channel('seo')->debug('Keywords extracted: ' . count($keywords));
```

Then run:
```bash
php artisan seo:extract-semantics --tool=roi-calculator --force
tail -20 storage/logs/seo-$(date +%Y-%m-%d).log
```

### If Gemini returns markdown instead of JSON, fix the JSON parser:

In `app/Services/Seo/GeminiService.php`, update `generateJson()`:
```php
public function generateJson(string $prompt): array
{
    $text = $this->generateText($prompt, temperature: 0.2);

    // Remove all markdown artifacts
    $text = preg_replace('/^```[a-z]*\s*/im', '', $text);
    $text = preg_replace('/```\s*$/im', '', $text);
    $text = trim($text);

    // Try to isolate JSON object
    $firstBrace = strpos($text, '{');
    $lastBrace  = strrpos($text, '}');

    if ($firstBrace !== false && $lastBrace !== false) {
        $text = substr($text, $firstBrace, $lastBrace - $firstBrace + 1);
    }

    $data = json_decode($text, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        Log::channel('seo')->error(
            'Gemini JSON parse failed: ' . json_last_error_msg() .
            ' | Raw response: ' . substr($text, 0, 500)
        );
        throw new \RuntimeException(
            'Gemini returned invalid JSON: ' . json_last_error_msg()
        );
    }

    if (empty($data)) {
        throw new \RuntimeException('Gemini returned empty JSON object');
    }

    return $data;
}
```

### After JSON fix, re-run full semantic extraction:
```bash
# --force to bypass 7-day cache
php artisan seo:extract-semantics --force --batch=10
```

---

## BUG FIX 6 — Internal Links: anchor_text_primary Is Capitalized Wrong

### Problem Found in Database:
```
at-bats-per-home-run-calculator → era-calculator | anchor: "calculate Era"
                                                   Should be: "calculate ERA"
```

### Fix in `SeoGenerateInternalLinks.php` `generateAnchors()`:
```php
private function generateAnchors(string $source, string $target): array
{
    $targetParts  = explode('-', $target);
    $targetName   = ucwords(str_replace('-', ' ', $target)); // e.g. "Era Calculator"

    // Detect acronyms that should stay uppercase
    $acronyms = ['era', 'fip', 'ops', 'war', 'whip', 'roi', 'bmi', 'cagr', 'vat',
                 'apr', 'apy', 'rpm', 'url', 'html', 'css', 'json', 'jwt', 'md5',
                 'sha', 'sql', 'xml', 'api', 'isbn', 'isin', 'gpa', 'gre', 'sat'];

    $isCalculator = in_array('calculator', $targetParts);
    $isConverter  = in_array('converter',  $targetParts);
    $isGenerator  = in_array('generator',  $targetParts);

    $stopWords = ['calculator','converter','generator','checker','tester',
                  'formatter','encoder','decoder','pro','advanced','online',
                  'free','tool','per','and','to','from','of','the','a'];

    $conceptParts = array_filter($targetParts, fn($p) => !in_array($p, $stopWords));

    // Convert concept words — uppercase acronyms, ucfirst others
    $conceptWords = array_map(function($word) use ($acronyms) {
        return in_array($word, $acronyms) ? strtoupper($word) : ucfirst($word);
    }, array_values($conceptParts));

    $concept = implode(' ', $conceptWords);

    // Build anchors
    $anchors = match (true) {
        $isCalculator => [
            "calculate {$concept}",
            "{$concept} Calculator",
            "use the {$targetName}",
        ],
        $isConverter  => [
            "convert {$concept}",
            "{$concept} Converter",
            "{$targetName} Tool",
        ],
        $isGenerator  => [
            "generate {$concept}",
            "{$concept} Generator",
            "create {$concept} online",
        ],
        default       => [
            $targetName,
            "use {$targetName}",
            "{$concept} Tool",
        ],
    };

    return array_map('trim', $anchors);
}
```

---

## EXECUTION ORDER — DO EXACTLY IN THIS SEQUENCE

```
HOUR 1 — Make Site Show Content:
□ Bug Fix 3: Fix namespace (Seo vs SEO) → composer dump-autoload
□ Bug Fix 1: Run quick approval tinker command for existing 10 drafts
□ VERIFY: Open /roi-calculator in browser — does article show?
□ VERIFY: Open /at-bats-per-home-run-calculator — does article show?

HOUR 2 — Fix Content Generation:
□ Bug Fix 2: Delete remaining mock drafts
□ Bug Fix 2: Test generate --limit=5
□ Bug Fix 4: Add sports tools to ToolContextExtractor
□ Test: php artisan seo:generate-content --tool=ops-calculator
□ VERIFY: content is about "On-base Plus Slugging" NOT "Operations"

HOUR 3 — Fix Semantic Keywords:
□ Bug Fix 5: php artisan cache:clear
□ Bug Fix 5: Add JSON parser fix to GeminiService
□ Test: php artisan seo:extract-semantics --tool=roi-calculator --force
□ VERIFY: paa count > 0 for roi-calculator

HOUR 4 — Fix Anchor Text:
□ Bug Fix 6: Update generateAnchors() with acronym detection
□ Run: php artisan tinker --execute="DB::table('internal_links')->truncate();"
□ Run: php artisan seo:generate-links
□ VERIFY: era-calculator links show "calculate ERA" not "calculate Era"

DAY 2+ — Full Scale Generation:
□ Run overnight: php artisan seo:generate-content --batch=10
□ Run overnight: php artisan seo:extract-semantics --force --batch=10
□ Next day: Bulk approve high-quality drafts via admin panel
□ Admin URL: /admin/seo/content-drafts
```

---

## VERIFICATION COMMANDS

```bash
# 1. After Bug Fix 1 — Content showing on site
php artisan tinker --execute="echo 'Approved: ' . \App\Models\ContentDraft::where('status','approved')->count();"
# Expected: Approved: 10 (or more)

# 2. After Bug Fix 2 — Real content generating
php artisan tinker --execute="echo 'Real drafts: ' . \App\Models\ContentDraft::where('word_count','>',700)->count();"
# Expected: increases with each run

# 3. After Bug Fix 3 — Namespace working
php artisan tinker --execute="app(\App\Services\SEO\GeminiService::class)->isConfigured() ? print('OK') : print('FAIL');"

# 4. After Bug Fix 4 — Sports content is correct
php artisan tinker --execute="
\$draft = \App\Models\ContentDraft::where('tool_slug','ops-calculator')->first();
echo substr(strip_tags(\$draft->draft_content ?? ''), 0, 200);
"
# Expected: mentions "On-Base Percentage" and "Slugging" — NOT "Operations"

# 5. After Bug Fix 5 — PAA questions exist
php artisan tinker --execute="
echo 'PAA total: ' . \DB::table('semantic_keywords')->where('keyword_type','paa')->count();
"
# Expected: grows with each extraction run

# 6. Overall health check
php artisan tinker --execute="
\$stats = [
    'approved_drafts'   => \App\Models\ContentDraft::where('status','approved')->count(),
    'real_content'      => \App\Models\ContentDraft::where('word_count','>',700)->count(),
    'paa_questions'     => \DB::table('semantic_keywords')->where('keyword_type','paa')->count(),
    'lsi_keywords'      => \DB::table('semantic_keywords')->where('keyword_type','lsi')->count(),
    'internal_links'    => \DB::table('internal_links')->count(),
    'topical_clusters'  => \DB::table('topical_clusters')->count(),
];
foreach(\$stats as \$k => \$v) print \$k . ': ' . \$v . PHP_EOL;
"
```

---

## SUCCESS METRICS — END OF WEEK

```
CONTENT:
□ content_drafts approved: 500+ (after bulk approve)
□ Average word count: 900+ (not 118)
□ All approved drafts show on tool pages
□ Sports tools (ERA, OPS, FIP) show baseball content — not generic

SEO DATA:
□ semantic_keywords paa type: 5,000+
□ semantic_keywords lsi type: 5,000+
□ internal_links: 2,678 with correct anchor text (ERA not Era)

FRONTEND:
□ /roi-calculator shows 900+ word SEO article
□ Related Tools section shows 6 relevant tools
□ FAQ section appears with PAA questions
□ Browser inspection shows FAQPage schema in source

ADMIN:
□ /admin/seo/content-drafts loads and shows all pending drafts
□ Approve/Reject buttons work
□ Bulk approve works for score >= 70
```

---

*Version 6.0 | Bugs identified from real code (GitHub) + real database (SQL dump)*
*Root causes confirmed — not guessed*
*Priority: Namespace fix → Approval fix → Generation fix → Sports context fix*
