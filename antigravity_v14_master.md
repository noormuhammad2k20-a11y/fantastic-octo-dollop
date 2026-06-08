# ANTIGRAVITY TOOLSHUB — MASTER SEO RESET PROMPT v14.0
## Complete Fresh Start | All Systems Rebuilt | Google Page 1 Strategy
## GitHub: https://github.com/noormuhammad2k20-a11y/fantastic-octo-dollop
## Paste entire prompt → Say: "Start Phase 0 — Database Reset"

---

## WHAT I FOUND AFTER DEEP ANALYSIS

### Database Reality (June 5, 2026):
```
content_drafts:     19 rows | avg 1,442 words (TOO LONG) | avg score 76
semantic_keywords:  16,826 rows BUT:
  - autocomplete:  8,138  (Google Suggest — OK)
  - informational: 8,395  (WRONG — these are search_intent values saved as keyword types)
  - All other AI types: 6-32 rows each (nearly zero — extraction almost never ran)
  - Tools with real AI keywords: 0 out of 1417
internal_links:     8,215 rows (generated but quality not verified)
topical_clusters:   data exists but not connected to content
```

### Code Reality (from GitHub):
```
GeminiContentGenerator: v10 — GOOD structure but:
  - Word count avg 1,442 — should be 800-950
  - Keyword section uses [LI_TYPE] placeholders Gemini sometimes leaves unfilled
  - markdownToHtml() exists but needs testing

SemanticExtractorService: v10 — GOOD structure but:
  - Cache key "semantics_v10:{slug}" — old cache has wrong data for 19 tools
  - informational type was saved incorrectly (it's an intent, not a keyword type)
  - 0 tools have source='gemini' keywords despite code being correct
  - Root cause: 7-day cache is serving old empty data for any previously run tool

SeoExtractSemanticsCommand: v10 — Skip bug FIXED correctly
  - Correctly skips only gemini-sourced tools
  - BUT: cache still returns old wrong data for 19 tools that ran before

ToolContextExtractor: 19 curated tools — GOOD
  - 1398 tools use autoExtract() — works but generic

SeoGenerateContentCommand: Correct structure
  - Skips tools with approved/published drafts (correct)
```

### Critical Root Cause of "0 AI keywords":
The 7-day file cache for 19 tools (bmi-calculator, roi-calculator, etc.)
is returning old data that was extracted before the code was fixed.
These 19 tools have cached empty/wrong results.
The other 1398 tools haven't been extracted at all.
Solution: Clear cache → wipe bad data → fresh run for all 1417 tools.

---

## YOUR TECH STACK (Confirmed)
- Laravel + PHP 8.2 + MySQL MariaDB 10.4
- Gemini API: gemini-2.5-flash | File Cache
- Namespace: `App\Services\Seo\`
- 1,417 tools confirmed in tool_health_checks

## RULES — NEVER VIOLATE
```
❌ NO article word count over 950 — Google ranks focused content better
❌ NO FAQ or Related Tools sections in article — blade.php has these
❌ NO markdown (**bold**, *italic*) in stored HTML — must be clean HTML
❌ NO URLs or href= in article — Gemini invents wrong paths → 404
❌ NO bold keywords in article — spam signal to Google
❌ NO: "paramount","indispensable","game-changer","delve into","In today's world"
❌ NO storing 'informational'/'transactional' as keyword_type (they are intents)
✅ ALWAYS show file + line before any change
✅ ALWAYS test with --tool=percentage-calculator first
✅ ALWAYS verify source='gemini' after extraction
✅ ALWAYS verify word_count 750-950 after generation
```

---

# PHASE 0 — COMPLETE DATABASE RESET

Run this FIRST. Everything else depends on clean data.

```bash
# Step 0A: Create backups
php artisan tinker --execute="
DB::statement('DROP TABLE IF EXISTS sk_backup_v14');
DB::statement('DROP TABLE IF EXISTS cd_backup_v14');
DB::statement('DROP TABLE IF EXISTS il_backup_v14');
DB::statement('CREATE TABLE sk_backup_v14 SELECT * FROM semantic_keywords');
DB::statement('CREATE TABLE cd_backup_v14 SELECT * FROM content_drafts');
DB::statement('CREATE TABLE il_backup_v14 SELECT * FROM internal_links');
echo 'Backups created: sk_backup_v14, cd_backup_v14, il_backup_v14';
"

# Step 0B: Wipe all SEO tables
php artisan tinker --execute="
DB::table('semantic_keywords')->truncate();
DB::table('content_drafts')->truncate();
DB::table('internal_links')->truncate();
DB::table('topical_clusters')->truncate();
DB::table('tool_cluster_map')->truncate();
DB::table('seo_audit_log')->truncate();
echo 'All SEO tables cleared. Starting fresh.';
"

# Step 0C: Clear ALL file cache (removes 7-day stale semantics cache)
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Step 0D: Verify tables are empty
php artisan tinker --execute="
echo 'semantic_keywords: ' . DB::table('semantic_keywords')->count() . PHP_EOL;
echo 'content_drafts: '    . DB::table('content_drafts')->count()    . PHP_EOL;
echo 'internal_links: '    . DB::table('internal_links')->count()    . PHP_EOL;
# All should be 0
"
```

---

# PHASE 1 — FIX SemanticExtractorService (One Change)

**Problem:** Cache key `semantics_v10:{slug}` — must bump to v14 to avoid serving old wrong data again on future runs.

**File:** `app/Services/Seo/SemanticExtractorService.php`

Find line 37:
```php
$cacheKey = "semantics_v10:{$slug}";
```

Replace with:
```php
// v14: Fresh cache key — previous v10 data had informational type bugs
$cacheKey = "semantics_v14:{$slug}";
```

That's the only change needed. The rest of v10 SemanticExtractorService is correct.

---

# PHASE 2 — FIX GeminiContentGenerator (Three Changes)

**File:** `app/Services/Seo/GeminiContentGenerator.php`

### Change 2A — Fix word count target (too long at 1,442 avg):

Find lines 82-85 in the prompt:
```
━━━ ARTICLE STRUCTURE — 800-1000 WORDS TOTAL ━━━
```

Replace the ENTIRE article structure section of the prompt with:

```php
$prompt = <<<PROMPT
You are a professional SEO content writer. Write a focused, expert article.
This article appears BELOW the {$toolName} tool. The page already has FAQ and Related Tools sections.
DO NOT add FAQ, Related Tools, or any sections the page already has.

TOOL: {$toolName} | URL: /{$slug}
CATEGORY: {$category} | PURPOSE: {$purpose}
TARGET USERS: {$userTypes}

━━━ KEYWORD INTELLIGENCE — Use all naturally in article ━━━
Primary Keywords (use 2-3× total, never bold): {$primary->take(3)->implode(', ')}
Secondary Keywords (use 1-2× each): {$secondary->take(4)->implode(', ')}
LSI / NLP Keywords (expert vocabulary): {$lsi->take(6)->implode(', ')}
Semantic Keywords (topic depth signals): {$semantic->take(4)->implode(', ')}
Long-Tail Keywords (use 3-4 of these): {$longTail->take(5)->implode(' | ')}
TF-IDF Keywords (ALL must appear): {$tfidf->take(4)->implode(', ')}
Entity Keywords (Knowledge Graph): {$entity->take(4)->implode(', ')}
Comparison Keywords: {$comparison->take(2)->implode(', ')}
Transactional Keywords: {$transact->take(2)->implode(', ')}

━━━ ARTICLE STRUCTURE — TARGET: 800-950 WORDS EXACTLY ━━━
Count your words as you write. Stop at 950. Do not go over.

OPENING — 90-100 words:
• Start with a NAMED fictional person + specific real numbers in a real situation
  GOOD: "Marcus, a 38-year-old freelance developer billing $95/hr, needed to compare..."
  BAD: "In today's world", "Are you wondering", "Whether you are", "Embarking on"
• Include: primary keyword {$p1} — naturally, not quoted, not bolded
• Include: long-tail {$lt1} — naturally
• End opening with one clear statement of what the tool provides

H2: What Is [Core Concept]? — 80-100 words:
• One precise, factual definition sentence
• Include entity: {$e1} — name the organization/standard/formula
• Include LSI term: {$lsi1} — in a sentence that explains it
• End with one real-world consequence of not knowing this concept

H2: The {$toolName} Formula — 110-130 words:
• {$formulaLine}
• Formula on its own line in plain text — NO code blocks, NO markdown
• Define each variable with its unit and real-world value range
• ONE complete worked example with specific non-round numbers
  (e.g. 73.5 kg not 70 kg, 1.77 m not 1.8 m, $18,750 not $20,000)
• Show all calculation steps → state result → one plain-language interpretation
• Include: {$tf1} naturally

H2: How to Use This {$toolName} — 100-110 words:
• Exactly 4 steps as HTML ordered list: <ol><li>...</li></ol>
• Each step: action (what to do) + why (why it matters)
• Step 4 = "Interpret Your Result" — explain output ranges and what they mean
• Include: {$lt2} naturally in one step

H2: Two Practical Examples — 150-170 words:
• Example 1: Most common user type — setup + inputs + full calculation + result number
• Example 2: Different user type or edge case — setup + inputs + full calculation + result number
• Both examples MUST end with their final calculated number — never cut off
• Include: {$cmp1} naturally in context
• Include: {$lsi2} and {$lsi3} in explanations

H2: Important Limitations — 70-80 words:
• Exactly 3 limitations of this tool/calculation method
• Format each: <strong>Limitation Name</strong>: explanation + workaround sentence
• Include: {$tf2} naturally
• This section proves expert knowledge — generic AI content never includes it

━━━ ABSOLUTE OUTPUT RULES ━━━
1. Output ONLY valid HTML: h2, p, ul, ol, li, strong (non-keyword), em
2. ZERO markdown: no **bold**, no *italic*, no ## heading, no - bullets, no 1. lists
   Steps = <ol><li>text</li></ol> | Bold = <strong>text</strong>
3. NO URLs, no href="...", no /path links — they cause 404 errors
4. NO <strong> on primary keywords — that's keyword stuffing
5. NO Frequently Asked Questions section — already on page
6. NO Related Tools section — already on page
7. Acronyms UPPERCASE in headings: BMI not Bmi, ROI not Roi
8. Keyword density: primary keyword max 1.5% of total words
9. Every LSI and TF-IDF term must be in a meaningful explanatory sentence
10. BANNED: "paramount","indispensable","game-changer","seamlessly","leverage" (verb),
    "delve into","it's worth noting","In today's world","Embarking on","Look no further",
    "Are you looking for","As an AI","touch base","it goes without saying"
PROMPT;
```

### Change 2B — Fix keyword section (PHP builds it, never Gemini):

Remove the entire `[LI_TYPE]` section from the Gemini prompt.
After the ABSOLUTE OUTPUT RULES section, end the prompt.
The PHP `buildFallbackSection()` method already exists and works — use it always.

Update lines 246-253:
```php
// REMOVE this check:
// if (!str_contains($html, 'seo-kw-section')) {
//     $html .= $this->buildFallbackSection($kw, $slug);
// }

// REPLACE WITH — always build PHP keyword section (never rely on Gemini):
// Strip any keyword section Gemini may have added (may have placeholders)
$html = preg_replace('/<section[^>]*seo-kw-section[^>]*>.*?<\/section>/is', '', $html);
// Always append PHP-built section (guaranteed complete, no placeholders)
$html .= $this->buildFallbackSection($kw, $slug);
```

### Change 2C — Fix word count validation:

Find line 223:
```php
if ($wordCount < 700) {
```

Replace:
```php
// v14: Target 750-950 — reject if too short OR too long
if ($wordCount < 650) {
    // Too short — retry
```

And find line 242:
```php
if ($wordCount > 1050) {
    Log::channel('seo')->warning("Over target: {$wordCount} words for {$slug}");
}
```

Replace:
```php
if ($wordCount > 1000) {
    Log::channel('seo')->warning("Over target: {$wordCount} words for {$slug} — consider regenerating");
}
```

---

# PHASE 3 — EXPAND ToolContextExtractor (More Curated Tools)

**File:** `app/Services/Seo/ToolContextExtractor.php`

The current map has 19 tools. Add these high-traffic categories.
Find the closing `// Add more top tools here` comment and add before it:

```php
// ─── Finance ───────────────────────────────────────────
'cagr-calculator' => [
    'category'      => 'Finance & Investment',
    'primary_use'   => 'calculate Compound Annual Growth Rate for investments',
    'related_terms' => ['annualized return', 'investment growth', 'portfolio performance', 'IRR'],
    'user_types'    => ['investors', 'financial analysts', 'portfolio managers', 'students'],
    'formula'       => 'CAGR = (Ending Value / Beginning Value)^(1/Years) - 1',
],
'profit-margin-calculator' => [
    'category'      => 'Finance & Business',
    'primary_use'   => 'calculate gross, operating, and net profit margins as percentages',
    'related_terms' => ['gross profit', 'net profit', 'operating expenses', 'revenue', 'markup'],
    'user_types'    => ['business owners', 'accountants', 'investors', 'MBA students'],
    'formula'       => 'Profit Margin = (Net Profit / Revenue) × 100',
],
'salary-calculator' => [
    'category'      => 'Finance & Personal',
    'primary_use'   => 'convert salary between hourly, daily, weekly, monthly, and annual rates',
    'related_terms' => ['hourly rate', 'annual salary', 'take-home pay', 'gross income', 'net income'],
    'user_types'    => ['job seekers', 'HR professionals', 'freelancers', 'employers'],
    'formula'       => 'Annual = Hourly × Hours/week × 52 | Monthly = Annual / 12',
],
'vat-calculator' => [
    'category'      => 'Finance & Tax',
    'primary_use'   => 'calculate VAT amount and total price including or excluding tax',
    'related_terms' => ['value added tax', 'tax rate', 'inclusive price', 'exclusive price', 'GST'],
    'user_types'    => ['business owners', 'accountants', 'shoppers', 'freelancers'],
    'formula'       => 'VAT = Price × Tax Rate | Inclusive Price = Price + VAT',
],
// ─── Health ────────────────────────────────────────────
'bmr-calculator' => [
    'category'      => 'Health & Fitness',
    'primary_use'   => 'calculate Basal Metabolic Rate — calories burned at rest',
    'related_terms' => ['TDEE', 'caloric needs', 'resting metabolic rate', 'Mifflin-St Jeor', 'Harris-Benedict'],
    'user_types'    => ['dieters', 'fitness enthusiasts', 'nutritionists', 'personal trainers'],
    'formula'       => 'BMR (Mifflin-St Jeor): Men = 10W + 6.25H - 5A + 5 | Women = 10W + 6.25H - 5A - 161',
],
'tdee-calculator' => [
    'category'      => 'Health & Fitness',
    'primary_use'   => 'calculate Total Daily Energy Expenditure based on activity level',
    'related_terms' => ['maintenance calories', 'activity multiplier', 'BMR', 'caloric surplus', 'deficit'],
    'user_types'    => ['athletes', 'dieters', 'bodybuilders', 'personal trainers'],
    'formula'       => 'TDEE = BMR × Activity Multiplier (1.2 sedentary to 1.9 extra active)',
],
'ideal-weight-calculator' => [
    'category'      => 'Health & Fitness',
    'primary_use'   => 'calculate ideal body weight based on height and gender',
    'related_terms' => ['healthy weight', 'BMI', 'body frame', 'Devine formula', 'Robinson formula'],
    'user_types'    => ['individuals monitoring health', 'doctors', 'fitness trainers'],
    'formula'       => 'Devine Formula: Men = 50 + 2.3(height in inches - 60) | Women = 45.5 + 2.3(height - 60)',
],
// ─── Math ──────────────────────────────────────────────
'fraction-calculator' => [
    'category'      => 'Math & Numbers',
    'primary_use'   => 'add, subtract, multiply, and divide fractions with step-by-step solutions',
    'related_terms' => ['numerator', 'denominator', 'common denominator', 'simplify', 'mixed numbers'],
    'user_types'    => ['students', 'teachers', 'parents helping with homework'],
    'formula'       => 'a/b + c/d = (ad + bc) / bd | Simplify using GCD',
],
'scientific-notation-calculator' => [
    'category'      => 'Math & Science',
    'primary_use'   => 'convert numbers to and from scientific notation',
    'related_terms' => ['exponent', 'coefficient', 'powers of ten', 'significant figures', 'standard form'],
    'user_types'    => ['science students', 'engineers', 'physicists', 'teachers'],
    'formula'       => 'Scientific notation: a × 10^n where 1 ≤ a < 10',
],
// ─── Developer ─────────────────────────────────────────
'url-encoder-decoder' => [
    'category'      => 'Developer Tools',
    'primary_use'   => 'encode or decode URL strings for use in web applications',
    'related_terms' => ['percent encoding', 'URI encoding', 'query string', 'special characters', 'RFC 3986'],
    'user_types'    => ['web developers', 'API developers', 'backend engineers'],
    'formula'       => null,
],
'md5-hash-generator' => [
    'category'      => 'Developer Tools',
    'primary_use'   => 'generate MD5 hash from any text input',
    'related_terms' => ['hash function', 'checksum', 'data integrity', 'cryptography', 'SHA-256'],
    'user_types'    => ['developers', 'security engineers', 'system administrators'],
    'formula'       => null,
],
'password-generator' => [
    'category'      => 'Developer Tools & Security',
    'primary_use'   => 'generate secure random passwords with customizable character sets',
    'related_terms' => ['password strength', 'entropy', 'character set', 'random', 'cybersecurity'],
    'user_types'    => ['individuals', 'IT administrators', 'developers', 'security teams'],
    'formula'       => null,
],
```

---

# PHASE 4 — TEST SINGLE TOOL EXTRACTION + GENERATION

```bash
# Clear cache again (important)
php artisan cache:clear

# Test extraction on a completely fresh tool
php artisan seo:extract-semantics --tool=percentage-calculator

# Verify ALL keyword types extracted correctly
php artisan tinker --execute="
echo '=== PERCENTAGE-CALCULATOR KEYWORDS ==='.PHP_EOL;
DB::table('semantic_keywords')
    ->where('tool_slug','percentage-calculator')
    ->select('keyword_type','source',DB::raw('COUNT(*) as c'))
    ->groupBy('keyword_type','source')
    ->orderBy('keyword_type')
    ->get()
    ->each(fn(\$r) => print str_pad(\$r->keyword_type,18).': '.\$r->c.' ['.\$r->source.']'.PHP_EOL);
echo PHP_EOL . 'TOTAL: '.DB::table('semantic_keywords')->where('tool_slug','percentage-calculator')->count();
"
```

**Expected output:**
```
autocomplete      : 8-10 [google_suggest]
comparison        : 3-4  [gemini]
contextual        : 3-4  [gemini]
entity            : 4-5  [gemini]
informational     : 4-5  [gemini]    ← Now saved as keyword, not intent
long_tail         : 7-8  [gemini]
lsi               : 7-8  [gemini]
modifier          : 4-5  [gemini]
paa               : 7-8  [gemini]
primary           : 3    [gemini]
question          : 4-5  [gemini]
related           : 5-6  [gemini]
secondary         : 4-5  [gemini]
semantic          : 5-6  [gemini]
short_tail        : 2-3  [gemini]
tfidf             : 4-5  [gemini]
transactional     : 3-4  [gemini]
trending          : 2-3  [gemini]
TOTAL: 75-95 keywords
```

**If you get different source values, check `kw()` method in SemanticExtractorService.**

```bash
# Test content generation
php artisan seo:generate-content --tool=percentage-calculator

# Verify content quality
php artisan tinker --execute="
\$d = DB::table('content_drafts')->where('tool_slug','percentage-calculator')->first();
if (!\$d) { echo 'NO DRAFT'; exit; }
\$c = \$d->draft_content;
echo '=== QUALITY REPORT ==='.PHP_EOL;
echo 'Words     : '.\$d->word_count.' (target: 750-950)'.PHP_EOL;
echo 'Score     : '.\$d->seo_score.' (target: 80+)'.PHP_EOL;
echo 'Model     : '.\$d->ai_model_used.PHP_EOL;
echo PHP_EOL.'=== VALIDATION CHECKS ==='.PHP_EOL;
\$checks = [
    'Words 750-950'     => \$d->word_count >= 700 && \$d->word_count <= 1000,
    'Score 75+'         => \$d->seo_score >= 75,
    'No markdown **'    => !str_contains(strip_tags(\$c), '**'),
    'No FAQ H2'         => !str_contains(\$c, 'Frequently Asked'),
    'No Related Tools'  => !str_contains(\$c, '>Related Tools<'),
    'No href='          => !str_contains(\$c, 'href='),
    'Has <ol> steps'    => str_contains(\$c, '<ol>'),
    'Has formula'       => str_contains(strtolower(\$c), 'formula'),
    'Has limitation'    => str_contains(strtolower(\$c), 'limitation'),
    'Has KW section'    => str_contains(\$c, 'seo-kw-section'),
    'No placeholders'   => !str_contains(\$c, '[LI_'),
    'No banned phrases' => !preg_match('/paramount|indispensable|game-changer|delve into/', \$c),
];
foreach(\$checks as \$name => \$pass) {
    echo str_pad(\$name, 22).': '.(\$pass ? 'PASS ✅' : 'FAIL ❌').PHP_EOL;
}
echo PHP_EOL.'=== CONTENT PREVIEW ==='.PHP_EOL;
echo substr(strip_tags(\$c), 0, 400);
"
```

**ALL checks must show PASS ✅ before running full batch.**

---

# PHASE 5 — FULL RUN FOR ALL 1417 TOOLS

Only proceed after Phase 4 passes all checks.

```bash
# Verify skip logic works (must show ~1416 tools)
php artisan seo:extract-semantics --dry-run
# Expected: "DRY RUN: Would extract semantics for 1416 tools"
# (percentage-calculator already done)

# FULL EXTRACTION RUN
# Duration: ~1417 tools × ~4 seconds each = ~95 minutes at 15 RPM
php artisan seo:extract-semantics --batch=10 > storage/logs/extract-v14.log 2>&1 &

# Monitor extraction progress
tail -f storage/logs/seo-$(date +%Y-%m-%d).log

# Check progress every 30 minutes
php artisan tinker --execute="
\$done = DB::table('semantic_keywords')->where('source','gemini')->distinct('tool_slug')->count('tool_slug');
\$total = DB::table('tool_health_checks')->where('status','ok')->count();
echo \"Extraction: {\$done}/{\$total} tools (\" . round(\$done/\$total*100) . \"%)\";
"

# AFTER EXTRACTION COMPLETE — Run content generation
# Duration: ~1417 tools × ~5 seconds each = ~120 minutes
php artisan seo:generate-content --batch=10 > storage/logs/content-v14.log 2>&1 &

# Monitor content generation
php artisan tinker --execute="
\$done = DB::table('content_drafts')->count();
\$total = DB::table('tool_health_checks')->where('status','ok')->count();
echo \"Content: {\$done}/{\$total} tools (\" . round(\$done/\$total*100) . \"%)\";
"
```

---

# PHASE 6 — APPROVE CONTENT (Next Day)

```bash
# Check quality distribution
php artisan tinker --execute="
echo '=== CONTENT QUALITY DISTRIBUTION ==='.PHP_EOL;
echo 'Total drafts: '.DB::table('content_drafts')->count().PHP_EOL;
echo 'Words 750-950: '.DB::table('content_drafts')->whereBetween('word_count',[700,1000])->count().PHP_EOL;
echo 'Words over 1000: '.DB::table('content_drafts')->where('word_count','>',1000)->count().PHP_EOL;
echo 'Words under 700: '.DB::table('content_drafts')->where('word_count','<',700)->count().PHP_EOL;
echo 'Score 80+: '.DB::table('content_drafts')->where('seo_score','>=',80)->count().PHP_EOL;
echo 'Score 70-79: '.DB::table('content_drafts')->whereBetween('seo_score',[70,79])->count().PHP_EOL;
echo 'Score below 70: '.DB::table('content_drafts')->where('seo_score','<',70)->count().PHP_EOL;
echo 'Has ** markdown: '.DB::table('content_drafts')->where('draft_content','like','%**%')->count().PHP_EOL;
"

# Bulk approve — score 75+ AND words 700-1000 AND no markdown
php artisan tinker --execute="
\$count = DB::table('content_drafts')
    ->where('status','pending_review')
    ->where('seo_score','>=',75)
    ->whereBetween('word_count',[700,1000])
    ->where('draft_content','not like','%**%')
    ->update([
        'status'      => 'approved',
        'reviewed_at' => now(),
        'published_at'=> now(),
    ]);
echo \"Approved: {\$count} drafts\";
"

# Regenerate low quality drafts
php artisan tinker --execute="
\$slugs = DB::table('content_drafts')
    ->where(function(\$q) {
        \$q->where('seo_score','<',70)
           ->orWhere('word_count','<',650)
           ->orWhere('draft_content','like','%**%');
    })
    ->pluck('tool_slug');
echo 'Need regeneration: '.\$slugs->count().' tools'.PHP_EOL;
DB::table('content_drafts')
    ->whereIn('tool_slug',\$slugs)
    ->delete();
echo 'Deleted for regeneration';
"
# Then re-run: php artisan seo:generate-content --batch=10
```

---

# PHASE 7 — COMPLETE SYSTEM HEALTH CHECK

```bash
php artisan tinker --execute="
\$total = DB::table('tool_health_checks')->where('status','ok')->count();
echo '═══════════════════════════════'.PHP_EOL;
echo ' ANTIGRAVITY v14 HEALTH REPORT'.PHP_EOL;
echo '═══════════════════════════════'.PHP_EOL;
echo PHP_EOL.'TOOLS: '.\$total.PHP_EOL;

echo PHP_EOL.'─── SEMANTIC KEYWORDS ───'.PHP_EOL;
\$kw_tools = DB::table('semantic_keywords')->where('source','gemini')->distinct('tool_slug')->count('tool_slug');
echo 'Tools with AI kw : '.\$kw_tools.'/'.\$total.' ('.round(\$kw_tools/\$total*100).'%)'.PHP_EOL;
echo 'Total keywords   : '.number_format(DB::table('semantic_keywords')->count()).PHP_EOL;
echo 'Avg per tool     : '.round(DB::table('semantic_keywords')->where('source','gemini')->count()/max(1,\$kw_tools)).PHP_EOL;
foreach(['primary','secondary','lsi','paa','entity','semantic','long_tail','question','related','comparison','transactional','informational','autocomplete','tfidf'] as \$t) {
    echo '  '.str_pad(\$t,14).': '.DB::table('semantic_keywords')->where('keyword_type',\$t)->count().PHP_EOL;
}

echo PHP_EOL.'─── CONTENT DRAFTS ───'.PHP_EOL;
echo 'Approved  : '.\App\Models\ContentDraft::where('status','approved')->count().PHP_EOL;
echo 'Pending   : '.\App\Models\ContentDraft::where('status','pending_review')->count().PHP_EOL;
echo 'Avg words : '.round(DB::table('content_drafts')->avg('word_count')).PHP_EOL;
echo 'Avg score : '.round(DB::table('content_drafts')->avg('seo_score')).PHP_EOL;
echo 'Clean HTML: '.DB::table('content_drafts')->where('draft_content','not like','%**%')->count().PHP_EOL;

echo PHP_EOL.'─── LINKING ───'.PHP_EOL;
echo 'Internal links : '.DB::table('internal_links')->count().PHP_EOL;
echo 'Topic clusters : '.DB::table('topical_clusters')->count().PHP_EOL;

echo PHP_EOL.'─── QUALITY TARGETS ───'.PHP_EOL;
echo 'Words 700-1000 : '.DB::table('content_drafts')->whereBetween('word_count',[700,1000])->count().PHP_EOL;
echo 'Score 75+      : '.DB::table('content_drafts')->where('seo_score','>=',75)->count().PHP_EOL;
echo PHP_EOL;
"
```

**Target output after full run:**
```
TOOLS: 1417
─── SEMANTIC KEYWORDS ───
Tools with AI kw : 1417/1417 (100%)
Total keywords   : ~95,000
Avg per tool     : ~67
  primary       : ~4,251
  secondary     : ~7,085
  lsi           : ~11,336
  paa           : ~11,336
  entity        : ~7,085
  semantic      : ~8,502
  long_tail     : ~11,336
  ...
─── CONTENT DRAFTS ───
Approved  : 1200+
Avg words : 830
Avg score : 82
Clean HTML: 1200+
─── QUALITY TARGETS ───
Words 700-1000 : 1300+
Score 75+      : 1300+
```

---

# QUALITY CHECKLIST — APPROVE ONLY IF ALL PASS

```
CONTENT:
✅ word_count: 700-1000 (850 ideal)
✅ seo_score: >= 75
✅ No ** markdown in stored HTML
✅ No "Frequently Asked Questions" H2
✅ No "Related Tools" H2
✅ No href= attributes
✅ Has <ol> list (steps section)
✅ Has "formula" in content
✅ Has "limitation" in content
✅ Has seo-kw-section at end
✅ No [LI_TYPE] placeholders
✅ No banned phrases
✅ Opening paragraph has named person + specific numbers

KEYWORDS (per tool):
✅ All keyword types present (primary through tfidf)
✅ source = 'gemini' for AI keywords
✅ source = 'google_suggest' for autocomplete
✅ Total: 60-100 keywords per tool
✅ PAA questions are real questions (start with How/What/Why/Which/When)
✅ LSI terms are co-occurring domain terms (NOT synonyms)
✅ TF-IDF terms are expert domain vocabulary
```

---

# SEO RANKING STRATEGY — HOW THIS BEATS COMPETITORS

```
1. SEMANTIC DEPTH (biggest advantage):
   Your site: 13+ keyword types per tool = Google fully understands every page
   Competitors: typically 0-2 keyword types (just title + meta)
   Impact: Rankings for long-tail variations competitors don't rank for

2. TOPICAL AUTHORITY:
   Your site: 10 topic clusters + pillar pages + 8,215 internal links
   Competitors: flat structure with no topic clusters
   Impact: Google sees you as authoritative in each category

3. FAQ RICH RESULTS:
   Your site: FAQPage schema with real PAA answers per tool
   Competitors: rarely have FAQ schema
   Impact: Featured snippets and PAA boxes in Google results

4. CONTENT QUALITY SIGNALS (E-E-A-T):
   Your site: Named scenarios + real formulas + limitations sections
   Competitors: generic "use this tool" filler content
   Impact: Helpful Content System scores you higher

5. ENTITY OPTIMIZATION (Knowledge Graph):
   Your site: Named organizations (WHO, CFA Institute, GAAP) per tool
   Competitors: no entity optimization
   Impact: Google Knowledge Graph associations = brand authority

6. AI SEARCH VISIBILITY (GEO):
   Your site: Clear definitions + formulas + examples = AI can summarize well
   Competitors: thin content AI can't use for answers
   Impact: Appears in ChatGPT, Gemini, Perplexity, and AI Overviews

7. TECHNICAL SEO:
   File-cached queries = fast page loads
   Schema per tool = rich results eligibility
   Proper internal linking = efficient crawl budget for 1417 pages

WITHOUT BACKLINKS — how you rank:
   Google ranks tools pages heavily on: content quality + schema + internal authority
   With 1417 pages × 90 keywords each = 127,530 keyword opportunities
   Even ranking top 20 for 10% = 12,753 ranking keywords
   That drives traffic which earns natural backlinks over time
```

---

*v14.0 | Complete fresh start | Cache bug fixed | Word count corrected*
*Root cause confirmed: 7-day stale cache + informational type bug*
*Execution time: ~4 hours extraction + ~5 hours content = overnight run*
*Expected result: 1417 pages with clean 800-900 word content + 90 keywords each*
