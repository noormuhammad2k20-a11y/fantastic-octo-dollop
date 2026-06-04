# ANTIGRAVITY — FINAL v13.0 PRODUCTION PROMPT
## Based on: Screenshot + GitHub Code + Database Deep Analysis (June 4, 2026)
## Paste entire prompt → Say: "Start Issue 1 fix now"

---

## CONFIRMED ISSUES FROM SCREENSHOT + CODE ANALYSIS

```
SCREENSHOT CONFIRMED:

ISSUE 1 — DOUBLE RELATED TOOLS SECTIONS (Critical)
The page shows TWO "Related Tools" sections:
  Section A: "Related Tools You Might Need" — from tool-seo-content.blade.php (line 7-37)
             Shows: calculate Financial, calculate Dog Age, calculate Bmr, etc.
  Section B: "Related Tools" — from semantic-links.blade.php (line 9-49)
             Shows: Financial Health calculation tool, Dog Age Calculator, calculate Bmr, etc.
Both sections show the SAME tools with slightly different styling.
Root cause: tool.blade.php line 250 includes semantic-links partial
            WHILE tool-seo-content.blade.php ALSO shows relatedTools
Fix: Remove relatedTools display from tool-seo-content.blade.php OR disable semantic-links.blade.php include

ISSUE 2 — BOLD MARKDOWN IN ARTICLE BODY (Critical SEO damage)
Screenshot shows: "**Weight (kg):**" — asterisks visible on page
Gemini output contains **bold** markdown that is NOT converted to HTML
The article shows raw markdown: "* ••Enter Your Weight:••" and "••Interpret Your Result:••"
Root cause: GeminiContentGenerator.markdownToHtml() doesn't handle all markdown patterns
Fix: Better markdown stripping + stronger prompt instruction

ISSUE 3 — ARTICLE HAS MARKDOWN LIST ITEMS (NOT converted to HTML)
Screenshot: "1. ••Enter Your Weight:••" — numbered list NOT rendered as <ol><li>
Gemini writes numbered lists in markdown, not HTML <ol><li> format
Fix: Pre-process markdown lists to HTML before saving

ISSUE 4 — ARTICLE STRUCTURE HAS WRONG H2 CAPITALIZATION
Article shows "The BMI Calculator Formula" ✅ (fixAcronyms worked!)
But steps show "How to Use This BMI Calculator" — "BMI" correct ✅
So fixAcronyms IS working. But content quality still has markdown issues.

ISSUE 5 — RELATED SEARCHES SECTION
Blade shows "RELATED SEARCHES" section with keyword chips
This is good for SEO ✅ — but it shows tools like "basal metabolic rate (bmr) calculator"
as a "search" chip which looks like a tool recommendation, not a search term
Fix: Only show long_tail keywords in chips, not tool names from related keywords

ISSUE 6 — SKIP BUG STATUS (Critical — blocking 1415 tools)
DB shows: Tools with AI keywords = 0
But SeoExtractSemanticsCommand line 42-45 says "source = gemini"
The keywords ARE tagged correctly but "source" column check may not match
DB shows: all keywords have source type but "gemini" source = 0 tools
This means: SemanticExtractorService extracted but saved source='google_suggest'
or the CACHE is returning old data for bmi-calculator and not running Gemini
Fix: Clear cache + verify source='gemini' is being saved

ISSUE 7 — informational TYPE = 8,395 ROWS (WRONG)
These are NOT informational keywords — they are PAA question ANSWERS
saved incorrectly as keyword_type='informational'
Root cause: Old extraction run mapped search_intent values to keyword_type
Fix: These are being generated fresh — not a blocker for new run

ISSUE 8 — CONTENT QUALITY: BOLD MARKDOWN RENDERS AS TEXT
Article shows "••Enter Your Weight:••" — these are markdown bold markers
that the toHtml() conversion missed
Fix: Remove ALL ** patterns before saving to DB
```

---

## TECH STACK (Confirmed from GitHub)
- Laravel + PHP 8.2 + MySQL MariaDB 10.4
- Gemini API: gemini-2.5-flash | File Cache
- Namespace: `App\Services\Seo\`

## RULES — NEVER BREAK
```
❌ NO FAQ section in article (blade has FAQPage schema)
❌ NO "Related Tools" section in article (blade already shows)
❌ NO URLs or href= in article
❌ NO markdown (**bold**, *italic*, # heading) in output — HTML only
❌ NO numbered lists in markdown format — HTML <ol><li> only
❌ NO auto-publish — always pending_review
✅ Show file + line number before changing anything
✅ Test with --tool=percentage-calculator first (fresh tool, no existing draft)
✅ Verify in browser after each fix
```

---

## FIX 1 — REMOVE DUPLICATE RELATED TOOLS (Choose ONE source)

**Decision:** Keep `semantic-links.blade.php` (uses InternalLink model with proper routing).
Remove the relatedTools display from `tool-seo-content.blade.php`.

**File:** `resources/views/partials/tool-seo-content.blade.php`

Find and **DELETE** lines 7-38 (the entire relatedTools section):
```blade
{{-- DELETE THIS ENTIRE BLOCK (lines 7-38): --}}
@if($relatedTools->isNotEmpty())
<section class="seo-section related-tools-section mt-5" ...>
    ...
</section>
@endif
```

**Result:** Only `semantic-links.blade.php` shows Related Tools.
One clean section, no duplicates.

**Verify in browser:** Open /bmi-calculator — should see ONE "Related Tools" section only.

---

## FIX 2 — FIX MARKDOWN IN ARTICLE CONTENT (Bold + Lists)

**File:** `app/Services/Seo/GeminiContentGenerator.php`

Replace the `markdownToHtml()` method completely:

```php
private function markdownToHtml(string $text): string
{
    // Already has HTML tags — just clean up markdown remnants
    if (str_contains($text, '<p>') || str_contains($text, '<h2>')) {
        // Still clean up any markdown that slipped through
        return $this->cleanMarkdownRemnants($text);
    }

    // Full markdown → HTML conversion
    // 1. Headers
    $text = preg_replace('/^#### (.+)$/m', '<h4>$1</h4>', $text);
    $text = preg_replace('/^### (.+)$/m',  '<h3>$1</h3>', $text);
    $text = preg_replace('/^## (.+)$/m',   '<h2>$1</h2>', $text);
    $text = preg_replace('/^# (.+)$/m',    '<h2>$1</h2>', $text);

    // 2. Bold + Italic
    $text = preg_replace('/\*\*\*(.+?)\*\*\*/', '<strong><em>$1</em></strong>', $text);
    $text = preg_replace('/\*\*(.+?)\*\*/',     '<strong>$1</strong>', $text);
    $text = preg_replace('/\*(.+?)\*/',          '<em>$1</em>', $text);
    $text = preg_replace('/__(.+?)__/',          '<strong>$1</strong>', $text);
    $text = preg_replace('/_(.+?)_/',            '<em>$1</em>', $text);

    // 3. Numbered lists — convert BEFORE paragraph splitting
    $text = preg_replace_callback(
        '/^(\d+)\.\s+\*\*(.+?)\*\*\s*(.*)$/m',
        fn($m) => "<li><strong>{$m[2]}</strong> {$m[3]}</li>",
        $text
    );
    $text = preg_replace('/^(\d+)\.\s+(.+)$/m', '<li>$2</li>', $text);

    // 4. Bullet lists
    $text = preg_replace('/^\*\s+(.+)$/m', '<li>$1</li>', $text);
    $text = preg_replace('/^-\s+(.+)$/m',  '<li>$1</li>', $text);
    $text = preg_replace('/^•\s+(.+)$/m',  '<li>$1</li>', $text);

    // 5. Wrap consecutive <li> in <ol> or <ul>
    $text = preg_replace('/(<li>.*?<\/li>\n?)+/s', "<ul>\n$0</ul>\n", $text);

    // 6. Split into paragraphs and wrap
    $html  = '';
    $paras = preg_split('/\n{2,}/', trim($text));
    foreach ($paras as $p) {
        $p = trim($p);
        if (empty($p)) continue;
        if (preg_match('/^<(h[1-6]|ul|ol|section|div)/', $p)) {
            $html .= "$p\n";
        } else {
            // Single linebreaks within paragraph
            $p = preg_replace('/\n/', ' ', $p);
            $html .= "<p>$p</p>\n";
        }
    }

    return $html;
}

private function cleanMarkdownRemnants(string $html): string
{
    // Fix **bold** inside HTML
    $html = preg_replace('/\*\*\*(.+?)\*\*\*/', '<strong><em>$1</em></strong>', $html);
    $html = preg_replace('/\*\*(.+?)\*\*/',     '<strong>$1</strong>', $html);
    $html = preg_replace('/(?<!\*)\*(?!\*)(.+?)(?<!\*)\*(?!\*)/', '<em>$1</em>', $html);

    // Fix •• artifacts
    $html = str_replace(['••', '•• '], ['', ''], $html);

    // Fix numbered lists inside <p> tags
    $html = preg_replace_callback(
        '/<p>((?:\d+\.\s+.+\n?)+)<\/p>/',
        function($m) {
            $items = preg_replace('/^\d+\.\s+(.+)$/m', '<li>$1</li>', $m[1]);
            return "<ol>{$items}</ol>";
        },
        $html
    );

    // Fix bullet lists inside <p> tags
    $html = preg_replace_callback(
        '/<p>((?:[*•-]\s+.+\n?)+)<\/p>/',
        function($m) {
            $items = preg_replace('/^[*•-]\s+(.+)$/m', '<li>$1</li>', $m[1]);
            return "<ul>{$items}</ul>";
        },
        $html
    );

    return $html;
}
```

**Also add `cleanMarkdownRemnants()` call in `generateForTool()` after `fixAcronyms()`:**
```php
// After: $html = $this->removeUrls($html);
// Add:
$html = $this->cleanMarkdownRemnants($html);
```

---

## FIX 3 — STRENGTHEN GEMINI PROMPT (No Markdown, No Duplicates)

**File:** `app/Services/Seo/GeminiContentGenerator.php`

Replace the CRITICAL RULES section in `$prompt` (lines 149-159):

```php
// FIND this section in the prompt:
━━━ CRITICAL RULES ━━━
1. NO FAQ section — the page already has one
2. NO "Related Tools" section — the page already has one
...

// REPLACE WITH:
━━━ ABSOLUTE OUTPUT RULES — VIOLATING ANY RULE = REJECTION ━━━

FORMAT RULES (most important):
1. Output ONLY valid HTML: <h2>, <h3>, <p>, <ul>, <ol>, <li>, <strong>, <em>
2. ZERO markdown allowed: no **bold**, no *italic*, no # heading, no - bullets, no 1. lists
   Write lists as: <ol><li>Step text here</li></ol> — NOT as "1. Step text"
   Write bold as: <strong>term</strong> — NOT as **term**
3. NO URLs, no href="...", no /slug-links anywhere — they create broken links
4. NO bold keywords for SEO: don't use <strong> on primary keywords
   Use <strong> ONLY for non-keyword emphasis (formula variable names, important terms)

CONTENT RULES:
5. NO "Frequently Asked Questions" section — page already has this
6. NO "Related Tools" section — page already has this
7. Acronyms UPPERCASE in headings: BMI not Bmi, ROI not Roi, ERA not Era
8. Primary keyword density max 1.5% (appears 2-3 times max)
9. Every LSI/TF-IDF term in a meaningful explanatory sentence
10. FORBIDDEN phrases: "paramount","indispensable","game-changer","seamlessly",
    "leverage" (verb),"delve into","it's worth noting","In today's world",
    "Embarking on","Look no further","Are you looking for","As an AI language model"

STRUCTURE RULES:
11. Steps MUST use <ol><li> format — NOT markdown "1. step"
12. Formula MUST be in its own <p> tag
13. Every example MUST end with the calculated result number
14. Limitations section MUST have exactly 3 limitations
PROMPT;
```

---

## FIX 4 — FIX RELATED SEARCHES (Only Long-tail, Not Tool Names)

**File:** `resources/views/partials/tool-seo-content.blade.php`

Find the Related Searches section (lines 63-77) and update:

```blade
{{-- Related Search Terms — only long-tail keywords, not tool names --}}
@php
    $searchChips = \Illuminate\Support\Facades\DB::table('semantic_keywords')
        ->where('tool_slug', $slug)
        ->whereIn('keyword_type', ['long_tail', 'informational', 'comparison'])
        ->where('is_active', 1)
        ->where('keyword', 'not like', '% calculator')  {{-- exclude tool names --}}
        ->where('keyword', 'not like', '% tool')
        ->where('keyword', 'not like', '% generator')
        ->orderByDesc('confidence_score')
        ->limit(10)
        ->pluck('keyword');
@endphp

@if($searchChips->isNotEmpty())
<section style="margin-top:1.5rem;padding:1rem 0;">
    <p style="font-size:0.8rem;font-weight:600;color:#6b7280;text-transform:uppercase;
              letter-spacing:.06em;margin:0 0 0.6rem;">Related Searches</p>
    <div style="display:flex;flex-wrap:wrap;gap:0.5rem;">
        @foreach($searchChips as $chip)
        <span style="display:inline-block;padding:0.3rem 0.75rem;background:#f3f4f6;
                     border:1px solid #e5e7eb;border-radius:20px;font-size:0.82rem;
                     color:#374151;cursor:default;">
            {{ $chip }}
        </span>
        @endforeach
    </div>
</section>
@endif
```

---

## FIX 5 — VERIFY AND FIX SKIP BUG (source='gemini' check)

**The problem:** DB shows 0 tools with AI keywords despite extraction running.
This means SemanticExtractorService saved keywords but with wrong source value.

```bash
# Diagnose source values in DB
php artisan tinker --execute="
DB::table('semantic_keywords')
    ->select('source', DB::raw('COUNT(*) as cnt'))
    ->groupBy('source')
    ->get()
    ->each(fn(\$r) => print \$r->source . ': ' . \$r->cnt . PHP_EOL);
"
```

**If output shows source values other than 'gemini' (like null or 'openai'):**

**File:** `app/Services/Seo/SemanticExtractorService.php`

Find the `private function kw()` method and verify:
```php
private function kw(string $keyword, string $type, string $source,
                    string $intent = 'informational', float $confidence = 0.80): array
{
    return [
        'keyword'    => mb_strtolower(trim($keyword)),
        'type'       => $type,
        'source'     => $source,  // Must be 'gemini' for AI keywords
        'intent'     => $intent,
        'confidence' => $confidence,
    ];
}
```

**In `geminiExtract()`, verify the typeMap uses correct source:**
```php
// In the foreach loop in extractForTool():
foreach ($map as $key => [$type, $intent, $conf]) {
    foreach ($ai[$key] ?? [] as $item) {
        $word = is_string($item) ? trim($item) : trim($item['keyword'] ?? '');
        if (!empty($word)) {
            $keywords->push($this->kw($word, $type, 'gemini', $intent, $conf)); // 'gemini' here
        }
    }
}
```

**Fix SeoExtractSemanticsCommand to also accept null source as "needs extraction":**
```php
// In SeoExtractSemanticsCommand.php, update skip logic:
if (!$this->option('force')) {
    $doneWithAI = DB::table('semantic_keywords')
        ->where('source', 'gemini')
        ->where('keyword_type', '!=', 'autocomplete')
        ->distinct('tool_slug')
        ->pluck('tool_slug');

    if ($doneWithAI->isNotEmpty()) {
        $query->whereNotIn('t.tool_slug', $doneWithAI);
    }
}
```

**Test:**
```bash
# Clear cache first (7-day cache may be returning old data)
php artisan cache:clear

# Test on a fresh tool
php artisan seo:extract-semantics --tool=percentage-calculator

# Verify source
php artisan tinker --execute="
DB::table('semantic_keywords')
    ->where('tool_slug','percentage-calculator')
    ->select('keyword_type','source',DB::raw('COUNT(*) as c'))
    ->groupBy('keyword_type','source')
    ->get()
    ->each(fn(\$r) => print \$r->keyword_type.': '.\$r->c.' ('.\$r->source.')'.PHP_EOL);
"
# Must show: lsi, paa, entity etc with source='gemini'
```

---

## FIX 6 — IMPROVE SeoSchemaGenerator (Add PAA to Schema)

**File:** `app/Services/Seo/SeoSchemaGenerator.php`

The current schema generates FAQPage from `$tool['custom_faq']` only.
But PAA keywords from semantic_keywords are NOT included in JSON-LD schema.

Find the `generate()` method and update the FAQ section:

```php
// In generate() method, AFTER the $faq parameter check:
// Add PAA questions from DB if no custom_faq:
if (empty($faq)) {
    $paaFromDb = \Illuminate\Support\Facades\DB::table('semantic_keywords')
        ->where('tool_slug', $tool['slug'] ?? '')
        ->where('keyword_type', 'paa')
        ->where('is_active', 1)
        ->whereNotNull('answer')
        ->limit(7)
        ->get(['keyword', 'answer']);

    if ($paaFromDb->isNotEmpty()) {
        $faq = $paaFromDb->map(fn($r) => [
            'q' => $r->keyword,
            'a' => $r->answer,
        ])->toArray();
    }
}
```

This adds PAA questions WITH answers to the JSON-LD schema automatically.

---

## FIX 7 — FULL CONTENT REGENERATION PIPELINE

```bash
# Step 1: Apply all code fixes above first

# Step 2: Clear cache + config
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Step 3: Test extraction on fresh tool
php artisan seo:extract-semantics --tool=percentage-calculator
php artisan tinker --execute="
\$types = DB::table('semantic_keywords')
    ->where('tool_slug','percentage-calculator')
    ->select('keyword_type',DB::raw('COUNT(*) as c'),'source')
    ->groupBy('keyword_type','source')
    ->get();
foreach(\$types as \$t) echo \$t->keyword_type.': '.\$t->c.' ['.\$t->source.']'.PHP_EOL;
"
# Expected: primary, secondary, lsi, paa, entity... all with source='gemini'

# Step 4: Test content generation
php artisan seo:generate-content --tool=percentage-calculator
php artisan tinker --execute="
\$d = DB::table('content_drafts')->where('tool_slug','percentage-calculator')->first();
echo 'Words: '.\$d->word_count.PHP_EOL;
echo 'Score: '.\$d->seo_score.PHP_EOL;
echo 'No markdown: '.(!preg_match('/\*\*|\*\s/',strip_tags(\$d->draft_content))?'PASS ✅':'FAIL ❌ (has **)').PHP_EOL;
echo 'No FAQ H2: '.(!str_contains(\$d->draft_content,'Frequently Asked')?'PASS ✅':'FAIL ❌').PHP_EOL;
echo 'No Related Tools: '.(!str_contains(\$d->draft_content,'Related Tools')?'PASS ✅':'FAIL ❌').PHP_EOL;
echo 'No href: '.(!str_contains(\$d->draft_content,'href=')?'PASS ✅':'FAIL ❌').PHP_EOL;
echo 'Has ol/li steps: '.(str_contains(\$d->draft_content,'<ol>')?'PASS ✅':'WARN ⚠').PHP_EOL;
echo PHP_EOL.'Preview:'.PHP_EOL.substr(strip_tags(\$d->draft_content),0,300);
"

# Step 5: Approve and verify in browser
php artisan tinker --execute="
DB::table('content_drafts')
    ->where('tool_slug','percentage-calculator')
    ->where('word_count','>',600)
    ->update(['status'=>'approved','reviewed_at'=>now(),'published_at'=>now()]);
echo 'Approved';
"
# Open /percentage-calculator in browser
# Check: ONE Related Tools section, no double FAQ, no ** in text

# Step 6: Regenerate existing approved drafts (bmi, roi etc) with fixes
\$slugs = ['bmi-calculator','roi-calculator','era-calculator'];
foreach(\$slugs as \$s) {
    DB::table('content_drafts')->where('tool_slug',\$s)->delete();
}
php artisan seo:generate-content --tool=bmi-calculator
php artisan seo:generate-content --tool=roi-calculator

# Step 7: Verify no markdown in any existing drafts
php artisan tinker --execute="
\$bad = DB::table('content_drafts')
    ->where('draft_content','like','%**%')
    ->orWhere('draft_content','like','%••%')
    ->count();
echo \"Drafts with markdown: {\$bad}\";
"

# Step 8: Full extraction run (all 1415 remaining tools)
php artisan seo:extract-semantics --batch=10 > storage/logs/extract-v13.log 2>&1 &

# Step 9: Full content run (after extraction)
php artisan seo:generate-content --batch=10 > storage/logs/content-v13.log 2>&1 &

# Monitor
tail -f storage/logs/seo-$(date +%Y-%m-%d).log
```

---

## FIX 8 — PERFORMANCE OPTIMIZATIONS FOR RANKING

**File:** `app/Http/Controllers/ToolController.php`

Add database query caching to avoid repeated queries on every page load:

```php
// Replace the allKeywords query (lines 87-97) with cached version:
$allKeywords = \Illuminate\Support\Facades\Cache::store('file')
    ->remember("tool_kw:{$tool['slug']}", now()->addHours(24), function() use ($tool) {
        return \Illuminate\Support\Facades\DB::table('semantic_keywords')
            ->where('tool_slug', $tool['slug'])
            ->where('is_active', 1)
            ->orderByDesc('confidence_score')
            ->get(['keyword_type', 'keyword'])
            ->groupBy('keyword_type');
    });

// Cache seoDraft too
$seoDraft = \Illuminate\Support\Facades\Cache::store('file')
    ->remember("tool_draft:{$tool['slug']}", now()->addHours(6), function() use ($tool) {
        return \App\Models\ContentDraft::where('tool_slug', $tool['slug'])
            ->where('status', 'approved')
            ->select(['draft_content', 'outline_json', 'word_count'])
            ->first();
    });

// Cache relatedTools
$relatedTools = \Illuminate\Support\Facades\Cache::store('file')
    ->remember("tool_related:{$tool['slug']}", now()->addHours(24), function() use ($tool) {
        return \Illuminate\Support\Facades\DB::table('internal_links as il')
            ->join('tool_health_checks as t', 't.tool_slug', '=', 'il.target_tool_slug')
            ->where('il.source_tool_slug', $tool['slug'])
            ->where('il.is_active', 1)
            ->orderByDesc('il.relevance_score')
            ->limit(6)
            ->select(['t.tool_slug', 'il.anchor_text_primary', 'il.relevance_score'])
            ->get();
    });
```

**Add cache invalidation in ContentDraft model when status changes to approved:**
```php
// In app/Models/ContentDraft.php, add boot() method:
protected static function boot()
{
    parent::boot();
    static::updated(function ($draft) {
        if ($draft->isDirty('status') && $draft->status === 'approved') {
            \Illuminate\Support\Facades\Cache::forget("tool_draft:{$draft->tool_slug}");
            \Illuminate\Support\Facades\Cache::forget("tool_kw:{$draft->tool_slug}");
        }
    });
}
```

---

## COMPLETE ISSUES SUMMARY TABLE

```
ISSUE                          │ FILE TO CHANGE                      │ STATUS
───────────────────────────────┼─────────────────────────────────────┼──────────
Double Related Tools sections  │ tool-seo-content.blade.php L7-38    │ Fix 1
Markdown ** in article text    │ GeminiContentGenerator markdownToHtml│ Fix 2
Numbered lists as markdown     │ GeminiContentGenerator prompt rules  │ Fix 3
Wrong Related Searches chips   │ tool-seo-content.blade.php chips sec │ Fix 4
Skip bug (0 AI tools)          │ SeoExtractSemanticsCommand L42-45   │ Fix 5
PAA not in JSON-LD schema      │ SeoSchemaGenerator generate()        │ Fix 6
Page load DB queries uncached  │ ToolController.php L87-99           │ Fix 8
```

---

## QUALITY VALIDATION CHECKLIST

```bash
# Run this after every fix to confirm all passing:
php artisan tinker --execute="
\$slug = 'percentage-calculator';
\$d = DB::table('content_drafts')->where('tool_slug',\$slug)->first();
if(!d) { echo 'NO DRAFT'; exit; }
\$checks = [
  'word_count 750-1050'  => \$d->word_count >= 750 && \$d->word_count <= 1050,
  'seo_score >= 75'      => \$d->seo_score >= 75,
  'no markdown **'       => !preg_match('/\*\*/',strip_tags(\$d->draft_content)),
  'no FAQ H2'            => !str_contains(\$d->draft_content,'Frequently Asked'),
  'no Related Tools'     => !str_contains(\$d->draft_content,'Related Tools'),
  'no href='             => !str_contains(\$d->draft_content,'href='),
  'has <ol> lists'       => str_contains(\$d->draft_content,'<ol>'),
  'has formula'          => str_contains(strtolower(\$d->draft_content),'formula'),
  'has limitation'       => str_contains(strtolower(\$d->draft_content),'limitation'),
  'has kw section'       => str_contains(\$d->draft_content,'seo-kw-section'),
  'approved'             => \$d->status === 'approved',
];
foreach(\$checks as \$name=>\$pass) {
  echo str_pad(\$name,30).': '.(\$pass ? 'PASS ✅' : 'FAIL ❌').PHP_EOL;
}
"
```

---

## FULL SYSTEM HEALTH CHECK

```bash
php artisan tinker --execute="
\$total = DB::table('tool_health_checks')->where('status','ok')->count();
echo '=== ANTIGRAVITY v13 HEALTH ==='.PHP_EOL;
echo 'Total tools: '.\$total.PHP_EOL.PHP_EOL;

echo '── KEYWORDS ──'.PHP_EOL;
echo 'Tools with AI kw : '.DB::table('semantic_keywords')->where('source','gemini')->distinct('tool_slug')->count('tool_slug').' / '.\$total.PHP_EOL;
echo 'Total keywords   : '.DB::table('semantic_keywords')->count().PHP_EOL;
foreach(['primary','secondary','lsi','paa','entity','semantic','long_tail','question','related','comparison','transactional','informational','autocomplete'] as \$t) {
  echo '  '.str_pad(\$t,16).': '.DB::table('semantic_keywords')->where('keyword_type',\$t)->count().PHP_EOL;
}

echo PHP_EOL.'── CONTENT ──'.PHP_EOL;
echo 'Approved: '.\App\Models\ContentDraft::where('status','approved')->count().PHP_EOL;
echo 'Pending : '.\App\Models\ContentDraft::where('status','pending_review')->count().PHP_EOL;
echo 'Words 750-1050 : '.DB::table('content_drafts')->whereBetween('word_count',[750,1050])->count().PHP_EOL;
echo 'Score 75+      : '.DB::table('content_drafts')->where('seo_score','>=',75)->count().PHP_EOL;
echo 'Clean (no **)  : '.DB::table('content_drafts')->where('draft_content','not like','%**%')->count().PHP_EOL;
echo 'No FAQ dup     : '.DB::table('content_drafts')->where('draft_content','not like','%Frequently Asked%')->count().PHP_EOL;

echo PHP_EOL.'── LINKS ──'.PHP_EOL;
echo 'Internal links : '.DB::table('internal_links')->count().PHP_EOL;
echo 'Topic clusters : '.DB::table('topical_clusters')->count().PHP_EOL;
"
```

---

## SEO RANKING ROADMAP — HOW TO HIT PAGE 1

```
TECHNICAL (Week 1 — do these first):
✅ Fix double Related Tools → cleaner page = better UX signal
✅ Fix markdown rendering → properly formatted content = E-E-A-T signal
✅ Fix skip bug → all 1417 tools get AI keywords
✅ Cache tool page DB queries → faster page loads = Core Web Vitals
✅ PAA in JSON-LD schema → FAQPage rich results eligibility

CONTENT SCALE (Week 2-3):
□ Run full extraction: php artisan seo:extract-semantics --batch=10
□ Run full generation: php artisan seo:generate-content --batch=10
□ Approve drafts with score >= 75 in admin panel
□ Result: 1417 pages with 750-1000 word unique content each

GOOGLE INDEXING (Week 3):
□ Submit all tool URLs to Google Search Console
□ Request indexing for top 100 tools manually
□ Monitor Coverage report for crawl errors

RANKING SIGNALS YOU'RE BUILDING:
1. Semantic depth (13 keyword types per tool = Google understands full topic)
2. FAQPage schema with real answers → Featured snippets
3. Entity keywords → Knowledge Graph associations
4. Internal linking (3528 links) → PageRank distribution across 1417 tools
5. Topic clusters (10 clusters) → Topical authority
6. Related searches chips → Long-tail keyword signals
7. Unique content per tool → No duplicate content penalty

COMPETITOR BEATING STRATEGY (no backlinks needed):
- Tools websites rank on: content depth + schema + internal links + speed
- You have: 1417 tools × 13 keyword types × unique content = unbeatable semantic coverage
- Competitors likely have: thin content, no FAQ schema, poor internal linking
- Your advantage after this system: complete semantic SEO that takes competitors years to build
```

---

## EXECUTION ORDER (Do in this exact sequence)

```
TODAY (Fixes in browser immediately visible):
□ Fix 1: Delete relatedTools block from tool-seo-content.blade.php (lines 7-38)
□ Fix 4: Update Related Searches section
□ Open /bmi-calculator — ONE Related Tools section confirmed ✅

HOUR 2 (Code fixes):
□ Fix 2: Replace markdownToHtml() in GeminiContentGenerator
□ Fix 3: Update CRITICAL RULES in Gemini prompt
□ Fix 5: Verify source='gemini' in extraction + fix skip logic

HOUR 3 (Test + regenerate):
□ php artisan cache:clear && php artisan config:clear
□ php artisan seo:extract-semantics --tool=percentage-calculator
□ php artisan seo:generate-content --tool=percentage-calculator
□ Approve + check in browser: /percentage-calculator
□ All validation checks PASS ✅

OVERNIGHT (Full run):
□ php artisan seo:extract-semantics --batch=10
□ php artisan seo:generate-content --batch=10

NEXT DAY (Approve + Schema):
□ Fix 6: Add PAA to SeoSchemaGenerator
□ Fix 8: Add caching to ToolController
□ Bulk approve: score >= 75 AND word_count 750-1050
□ Submit sitemap to Google Search Console
```

---

*v13.0 | Screenshot + GitHub + Database analysis June 4, 2026*
*Priority fixes: markdown rendering, double related tools, skip bug*
*After these fixes: 1417 tools × perfect content = Page 1 Google rankings*
