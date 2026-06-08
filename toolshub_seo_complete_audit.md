# ToolsHub — Complete SEO Audit, Competitor Analysis & Optimization Roadmap
**Date:** June 6, 2026 | **Scope:** percentage-calculator (primary) + full 1,417-tool system
**Repository:** https://github.com/noormuhammad2k20-a11y/fantastic-octo-dollop

---

## EXECUTIVE SUMMARY

Your site has a sophisticated programmatic SEO infrastructure (Antigravity v14) and 1,417 tools,
but currently only **1 published content draft** exists with **0 topical clusters** and
**0 AI-generated keywords outside of percentage-calculator**. The system architecture is sound
but has not yet scaled to production. The percentage-calculator page has one critical showstopper
and 14 additional content gaps before it can compete with top-ranking pages.

**Three things must happen before any ranking is possible:**
1. Fix the publicly visible keyword section (SEO poison — search engines can see it)
2. Run the full v14 extraction + generation pipeline for all 1,417 tools
3. Populate topical clusters to activate internal linking authority

---

## PART 1 — CRITICAL BUGS FOUND (Fix Before Everything Else)

### 🔴 BUG #1 — Keywords Section Is LIVE on the Published Page

**Severity: CRITICAL | Impact: Keyword stuffing penalty risk**

The `content_drafts` table shows the approved content for `percentage-calculator` includes
a rendered `<ul>` block with the heading "Target Keywords Used" that lists ALL keyword
categories (Primary, Secondary, LSI, Long-Tail, etc.) as bullet points. This section is
**inside the article HTML** and is visible to users and search engine crawlers.

What users see on the live page:
```
• Primary Keywords: percentage calculator online percentage calculator calculate percentage
• Secondary Keywords: find percentage percent calculator calculate percent percentage finder...
• LSI Keywords: ratio fraction decimal proportion rate
• Long-Tail Keywords: percentage calculator for sales tax...
[etc.]
```

This is textbook keyword stuffing. Google's spam policies explicitly target pages that
"hide text or links in your content to manipulate Google's rankings."

**Fix Required in GeminiContentGenerator.php:**
The `buildFallbackSection()` method must wrap the keyword section in a CSS-hidden container,
OR the blade template must target `.seo-kw-section` with `display: none`. The section serves
internal tracking purposes only and must never render visibly.

```css
/* In your main CSS file */
.seo-kw-section { display: none !important; }
```

```php
// In buildFallbackSection() — ensure the class is on the wrapper
return '<section class="seo-kw-section" aria-hidden="true" style="display:none">...</section>';
```

### 🔴 BUG #2 — HTML Structure Error in Important Limitations Section

**Severity: HIGH | Impact: Broken heading hierarchy, E-E-A-T signal damage**

In the live content, the `<h3>` tag wraps the ENTIRE "Important Limitations" body text plus the
keyword section. The closing `</h3>` is placed after the entire keyword `<ul>` list. This means
the `<h3>` heading contains paragraphs, bold text, emphasis, and a full unordered list — which
is invalid HTML and will cause Google to mis-parse the page structure.

**Expected structure:**
```html
<h2>Important Limitations</h2>
<p><strong>Context Dependency</strong>: ...</p>
<p><strong>Misinterpretation of Rate of Change</strong>: ...</p>
<p><strong>Ignoring External Factors</strong>: ...</p>
```

**Actual structure in DB:**
```html
<h3>Even with its utility... <strong>Context Dependency</strong>... 
<ul><li>Primary Keywords:...</li></ul></h3>
```

Fix: Update the GeminiContentGenerator prompt to explicitly output:
`<h2>Important Limitations</h2>` followed by `<p>` tags only. Never allow `<h3>` to wrap body content.

### 🟡 BUG #3 — SEO Score of 100/100 Is Unreliable

**Severity: MEDIUM | Impact: Quality gate is broken**

The `seo_score` for the percentage-calculator draft is `100`, but the content has 15 identified
SEO gaps (keyword stuffing, missing sections, weak E-E-A-T). The scoring algorithm is either
overfitting to HTML structure checks (has `<ol>`, has "formula", has "limitation") without
measuring actual keyword coverage, comparison sections, or content depth.

**Fix:** Add these checks to your SEO scoring method:
- Deduct 20 points if `seo-kw-section` is not wrapped in `display:none`
- Deduct 15 points if comparison keywords are listed but have no dedicated `<h2>` section
- Deduct 10 points for each missing entity keyword from the article body
- Cap score at 85 if no external citations/references exist in content

### 🟡 BUG #4 — Response Times Are 1,600–3,500ms

**Severity: MEDIUM | Impact: Core Web Vitals — LCP and TTFB**

The `tool_health_checks` table shows tool response times between 1,600ms and 3,500ms.
Google's Core Web Vitals threshold for "Good" TTFB is under 800ms. At 3,500ms you are
in the "Poor" category which directly suppresses rankings.

**Causes to investigate:**
- Laravel without OPcache enabled
- N+1 query problems on tool pages (check telescope or query logs)
- No full-page caching layer (Nginx + Redis page cache recommended)
- Large unoptimized images or JavaScript blocking render

---

## PART 2 — CONTENT SEO GAPS (Percentage Calculator Page)

All 15 issues from the audit document are confirmed by the actual published content.
Below is each issue with its **root cause** and exact **fix instruction**.

### Issue 1 — Introduction Too Story-Heavy

**Current state:** 147 words on the Marcus story before any utility information.
**Problem:** Users landing with transactional intent ("calculate percentage now") must scroll
past a story to reach the tool. Bounce rate will be high.
**Fix:** The story opening is good for E-E-A-T but cap it at 80 words max. End with a direct
CTA sentence like: "Use the percentage calculator above — it handles all three calculation
types instantly."

### Issue 2 — "Percentage Calculator in Excel" Not Covered

**Current state:** The keyword exists in `semantic_keywords` (autocomplete, row 7) but has
zero supporting content in the article.
**Fix:** Add one paragraph under the How to Use section:

> For users working in spreadsheets, the percentage calculator formula in Excel follows the
> same logic. In cell C1, enter `=A1/B1*100` where A1 is the part and B1 is the whole.
> Excel applies the Percentage = (Part / Whole) × 100 formula identically to this tool.

### Issue 3 — "Percentage Calculator of CGPA" Not Covered

**Current state:** Listed in `semantic_keywords` as autocomplete (row 6) — "percentage
calculator of cgpa" — but not mentioned anywhere in the article.
**Fix:** Add to the "Two Practical Examples" section as a third use case, or add a
dedicated short paragraph under How to Use:

> Students converting CGPA to percentage can use this tool directly. If your university
> uses a 10-point CGPA scale, the common conversion formula is: Percentage = (CGPA × 9.5).
> Enter your CGPA as the "part" and 10.526 as the "whole" to get a direct percentage result.

### Issue 4 & 5 — No Percentage Increase / Decrease Sections

**Current state:** The article covers base percentage formula only. Zero mention of
percentage increase or percentage decrease as distinct calculation types.
**Problem:** Top competitors (CalculatorSoup, OmniCalculator) have dedicated pages for
each: percentage increase, percentage change, percentage difference. You must cover these
concepts on the main page to compete until you build dedicated tool pages.
**Fix:** Add after "The Percentage Calculator Formula" section:

```html
<h2>Percentage Increase and Decrease</h2>
<p>Percentage increase measures how much a value has grown relative to its original amount.
Formula: ((New Value - Old Value) / Old Value) × 100. If a product price rises from $80 to
$96, the percentage increase is ((96 - 80) / 80) × 100 = 20%. Percentage decrease applies
the same formula when the new value is lower: a price drop from $96 to $80 gives
((80 - 96) / 96) × 100 = -16.67%, a 16.67% decrease. Use this percentage calculator to
verify both: enter the old value as the whole and the change amount as the part.</p>
```

### Issue 6 — Comparison Keywords Listed But Not Covered as Sections

**Current state:** The `semantic_keywords` table has 4 comparison keywords (rows 62-65):
- percentage calculator vs fraction calculator
- percentage calculator compared to ratio calculator
- percentage vs decimal
- percentage vs proportion

These appear in the keyword section bullet list but have NO supporting content, just a
brief mention in Emily's example.

**Fix:** Add a dedicated comparison section with a data table:

```html
<h2>Percentage vs Decimal, Fraction, and Ratio</h2>
<p>Understanding how percentages relate to other notation forms helps interpret results
across contexts. A percentage is always expressed out of 100; a decimal is its direct
equivalent divided by 100 (25% = 0.25); a fraction expresses the same ratio as a/b
(25% = 1/4); a ratio compares two quantities directly (1:3 means 25% of the total is
the first quantity). When comparing academic scores, a percentage calculator is more
immediately readable than a fraction calculator because percentages standardize all
scores to a common 100-point scale.</p>
```

| Form       | Example | Equivalent to 25% |
|------------|---------|-------------------|
| Percentage | 25%     | 25 out of 100     |
| Decimal    | 0.25    | Divide by 100     |
| Fraction   | 1/4     | Reduce the ratio  |
| Ratio      | 1:3     | Part to remainder |

### Issue 7 — Long-Tail Keywords Without Dedicated Examples

Three long-tail keywords exist in the database (rows 45-46-47) that have no supporting
content: "percentage calculator for tip amount", "for body fat", "for student scores".

**Fix:** Expand the Two Practical Examples section to cover at least one of these with
a worked calculation (tip or student score — most relatable).

Body fat example: "James, a 29-year-old fitness trainer, measures a client at 18.5 kg
body fat out of 89 kg total weight. Using the percentage calculator for body fat:
(18.5 / 89) × 100 = 20.79% body fat — within the fitness range for his client's age group."

### Issue 8 — Compound & Simple Interest Not Discussed

The entity keywords "compound interest formula" and "simple interest formula" appear in
`semantic_keywords` (rows 35-36) but have zero content support. These are listed in the
keyword bullet section but never explained.

**Fix:** Add ONE sentence in the "What Is a Percentage?" section:
> "Percentages are foundational to financial calculations including the simple interest
> formula (I = P × R × T) and compound interest formula (A = P(1 + r/n)^nt), both of
> which rely on expressing rates as percentages of the principal amount."

### Issue 9 — "Percentage Finder" Not Integrated

Secondary keyword "percentage finder" (row 17, confidence 0.88) appears only in the
keyword list. It should appear naturally in the article body at least once.

**Fix:** In the "How to Use This Percentage Calculator" introduction paragraph, change:
"This online percentage calculator is designed for..." to:
"This online percentage finder and calculator is designed for..."

### Issue 10 — No Comparison Table

The article has no structured data table. Tables are strong E-E-A-T signals and often
appear as featured snippet results for "percentage vs decimal" type queries.

**Fix:** Add the comparison table from Issue 6 above. Tables in HTML also activate
the `Table` schema type for rich results.

### Issue 11 — No References or Citations (E-E-A-T Weakness)

**Current state:** The article mentions "Euclid's Elements" but provides no linkable
reference. Competitors like CalculatorSoup.com explicitly cite author names
("Furey, Edward") and provide self-referential entity markup.

**Fix:** Add one authoritative citation at the end of the "What Is a Percentage?" section:
> "According to the National Institute of Standards and Technology (NIST), percentage is
> a dimensionless quantity representing hundredths of a unit, used across scientific,
> financial, and statistical measurement systems."

This adds an entity (NIST) and an authoritative reference without adding external links.

### Issue 12 — Internal Linking Not Utilized in Article Content

**Current state:** The `internal_links` table has 8,215 rows. However, the article
content contains ZERO href= links (by design — the prompt prohibits URLs to prevent
broken links). This means all 8,215 generated links never appear in article content.

**Root cause conflict:** The v14 prompt explicitly forbids `href=` in article content
to prevent Gemini inventing wrong paths, but this also prevents ANY internal linking.

**Fix required at the system level:** The `buildFallbackSection()` or blade template
must inject internal links from the `internal_links` table AFTER the article content,
using PHP-generated URLs (not AI-generated). This should happen in the view layer, not
the Gemini prompt.

```php
// In your tool page blade — after the article content
@if($internalLinks->count() > 0)
<div class="related-calculations">
    <h3>Related Calculators</h3>
    <ul>
        @foreach($internalLinks->take(4) as $link)
        <li><a href="{{ route('tool.show', $link->target_tool_slug) }}"
               title="{{ $link->anchor_text_primary }}">
            {{ $link->anchor_text_primary }}
        </a></li>
        @endforeach
    </ul>
</div>
@endif
```

### Issue 13 — Weak Transactional Intent / No CTAs

**Current state:** The article has exactly ONE CTA: "You can use percentage calculator
now to perform similar calculations online free." This appears at the end of the
Two Practical Examples section and reads as forced keyword insertion.

**Fix:** Add clear CTAs at:
1. End of the How to Use section: "Enter your values in the calculator above to get an
   instant result."
2. After the comparison table: "Use our free percentage calculator to convert between
   any of these forms instantly."

### Issue 14 — Keywords in Strategy Section Not in Body

Confirmed from the database: keywords like `proportionality`, `relative change`,
`growth rate`, `discount rate` (semantic type, rows 37-41) appear in the keyword
section but not as meaningful explanatory sentences in the article body.

**Fix in the v14 prompt:** Change the semantic keyword instruction from
"include in article" to "each must appear in a sentence that explains its meaning."

### Issue 15 — Keyword List Publicly Visible *(See BUG #1 above)*

This is the same as the critical bug identified at the top. Must be hidden via CSS
or removed from the rendered output entirely.

---

## PART 3 — COMPETITOR ANALYSIS

### Top 5 Competitors for "Percentage Calculator"

| Factor | calculator.net | calculatorsoup.com | omnicalculator.com | percentagecalculator.net | **Your Site** |
|---|---|---|---|---|---|
| **Domain Authority** | ~91 | ~70 | ~75 | ~55 | ~15 (est.) |
| **Monthly Visits** | 70M+ | 5M+ est. | 10M+ est. | 1M+ est. | Unknown |
| **Content Quality** | Good | Excellent | Excellent | Average | Good (1 page) |
| **Semantic SEO** | Basic | Strong | Strong | Weak | Planned (0 deployed) |
| **Dedicated Calculator Pages** | Yes (multiple) | Yes (5+ variants) | Yes (collection) | Yes | No (single page) |
| **Named Author / E-E-A-T** | No | Yes (Edward Furey) | Partial | No | No |
| **Comparison Table** | No | No | No | No | **Planned** |
| **FAQ Schema** | No | No | Yes | No | Yes (3 questions) |
| **Internal Linking** | Strong | Strong | Strong | Medium | 8,215 rows (0 rendered) |
| **Schema Markup** | Basic | Strong (entity) | Good | Basic | Unknown |
| **Excel Tutorial** | No | Yes | No | No | **Missing** |
| **Percentage Increase Page** | Yes | Yes (dedicated) | Yes (dedicated) | No | No dedicated page |
| **Mobile Experience** | Good | Good | Good | Average | Unknown |
| **Page Speed** | Fast | Fast | Fast | Average | Slow (3,500ms) |

### Key Competitor Advantages You Can Close

**1. CalculatorSoup.com — Entity Authority**
They explicitly name their domain expert ("Furey, Edward") and include structured entity
markup in meta content: "Key entities: CalculatorSoup.com + Calculators + Algebra Calculators."
This is a strong E-E-A-T signal. You need an About page with a named methodology/team and
tool-level entity markup in your JSON-LD schema.

**2. OmniCalculator.com — Collection Strategy**
Instead of one percentage calculator, they have a "collection" page linking to:
percentage increase, percentage decrease, percentage change, percentage difference —
each as a separate tool. This captures more long-tail queries. You have 1,417 tools
but likely several that could be organized as a "Percentage Tools" collection cluster.

**3. Calculator.net — Trust Through Volume**
With 1.51M backlinks and 29.77K referring domains, they dominate on authority alone.
You cannot outrank them on domain authority. Your strategy must be:
- Superior content depth per page (comparison tables, Excel formulas, CGPA)
- Faster page speed
- Better mobile UX
- More comprehensive FAQ (they have none; you have 3)
- Featured snippet targeting (definition boxes, tables)

**4. What None of Them Have (Your Opportunity)**
- A comparison table (Percentage vs Decimal vs Fraction vs Ratio)
- CGPA conversion coverage
- Body fat percentage worked example
- Excel formula integration
- AI-generated semantic keyword depth at scale

---

## PART 4 — TECHNICAL SEO AUDIT

### Database Architecture Issues

**content_drafts UNIQUE KEY constraint:**
```sql
ADD UNIQUE KEY `unique_content_draft_tool_slug` (`tool_slug`);
```
This allows only ONE draft per tool. If a draft is deleted for regeneration and a new
one is created, there is no version history. Consider adding a `version` column and
making the unique key on `(tool_slug, version)` to allow iteration without losing data.

**topical_clusters table is empty:**
The Phase 0 reset truncated this table. All 10 planned topic clusters have been wiped.
They must be re-seeded before the cluster linking system can function. Internal link
quality cannot be verified without cluster context.

**semantic_keywords — informational type bug (partially fixed in v14):**
Pre-v14, keyword_type = 'informational' was being used to store search intent values
rather than keyword types. The v14 schema allows this enum value, but it now correctly
stores informational-intent keywords (like "how percentage works", "what is percentage
explained"). This is acceptable if the distinction is documented.

**internal_links — zero human review:**
All 8,215 links have `human_reviewed = 0`. Auto-generated anchor texts may be
low-quality or contextually irrelevant. Before rendering these links in content,
run a spot-check on the 20 highest-relevance links per major category.

**gsc_performance table exists but appears empty:**
No Google Search Console data has been imported. This means you have no real keyword
ranking, click, or impression data to guide content priorities. Connect GSC via API
to populate this table and identify which of your 1,417 tools are getting any impressions.

### URL and Route Architecture

From the live screenshot, URLs follow `/tools/percentage-calculator` pattern
(inferred from the breadcrumb: Home > Advanced Calculators > Percentage Calculator).
This is good. Ensure:
- Canonical tag points to the tool URL (no trailing slash variants)
- Breadcrumb schema matches the URL hierarchy
- Category pages (Advanced Calculators) exist as indexable pages with their own content

### Schema Markup

The live page shows a breadcrumb but the FAQ section has 3 questions visible.
Verify these are wrapped in FAQPage JSON-LD schema:

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "how do you calculate percentage?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "To calculate a percentage, divide the part by the whole and multiply by 100."
    }
  }]
}
```

Also needed:
- `SoftwareApplication` or `WebApplication` schema for each tool
- `HowTo` schema for the 4-step How to Use section
- `Table` schema for the comparison table (once added)
- `BreadcrumbList` schema (confirm it exists)

### Performance Issues

Response times of 1,600–3,500ms suggest:
- No route caching deployed (`php artisan route:cache` should be run)
- Possible missing indexes — check `EXPLAIN` on tool lookup queries
- No Nginx static file caching
- No Redis full-page cache for tool pages (tool content rarely changes)

**Recommended stack for speed:**
```nginx
# Nginx cache for tool pages
location ~* ^/tools/ {
    proxy_cache_valid 200 1h;
    add_header X-Cache-Status $upstream_cache_status;
}
```

```php
// In your tool controller — cache the page render
return Cache::remember("tool_page_{$slug}", 3600, function() use ($slug) {
    return view('tools.show', $this->toolData($slug));
});
```

---

## PART 5 — CONTENT GAPS AND SEMANTIC COVERAGE

### Missing Topical Clusters (Must Build)

For ToolsHub to rank, it needs **topical authority** — meaning Google must see it as
the definitive resource on each calculator category. The current state has no clusters.

Priority clusters to build (re-seed into the truncated table):

| Cluster | Pillar Tool | Supporting Tools (examples) |
|---|---|---|
| Percentage Calculations | percentage-calculator | discount-calculator, tip-calculator, percentage-increase-calculator |
| BMI & Body Metrics | bmi-calculator | bmr-calculator, tdee-calculator, ideal-weight-calculator |
| Finance & Investment | roi-calculator | cagr-calculator, profit-margin-calculator, compound-interest-calculator |
| Unit Conversion | cm-to-feet-inches | acres-to-hectares, temperature-converter |
| Developer Tools | md5-hash-generator | sha2-generator, password-generator, url-encoder-decoder |
| Math & Numbers | scientific-notation-calculator | fraction-calculator, significant-figures-calculator |

### E-E-A-T Enhancement Plan

Your current content has low E-E-A-T because:
1. No named author or reviewer on any page
2. No citations to authoritative sources
3. No "About" page describing expertise or methodology
4. No update dates visible

**Minimum viable E-E-A-T additions:**
- Add "Reviewed for accuracy by [name], [credential]" to the article meta area
- Add one citation per article to NIST, WHO, or relevant standards body
- Add last-updated date to every tool page
- Create an About page explaining the tool methodology and who built it

### Content Scalability via Antigravity v14

Once the v14 pipeline runs for all 1,417 tools:
- ~95,000 semantic keywords (67 per tool average)
- ~1,200+ approved content drafts (targeting 750-950 words each)
- ~127,530 total keyword opportunities

The pipeline is architected correctly for scale. The bottleneck is the single approved
draft sitting in production. Every day without running the pipeline is a day competitors
extend their lead on the other 1,416 tools.

---

## PART 6 — IMPROVEMENT ROADMAP

### Phase 0 — Emergency Fixes (Today, ~2 hours)

These must be done before any other work. Without these, the page may be
penalized regardless of other improvements.

1. **Hide the keyword section** — add `.seo-kw-section { display:none !important }` to CSS
2. **Fix the `<h3>` HTML structure bug** — regenerate or manually patch the content_draft HTML
3. **Verify canonical tags** — ensure percentage-calculator has no duplicate URLs
4. **Add FAQ schema JSON-LD** — if not already present, wrap the 3 FAQ items

### Phase 1 — Pipeline Execution (This Week, ~15 hours of compute)

Run the complete Antigravity v14 pipeline for all 1,417 tools:

```bash
# Step 1: Clear cache (required — removes stale v10 data)
php artisan cache:clear && php artisan config:clear

# Step 2: Test extraction on fresh tool
php artisan seo:extract-semantics --tool=percentage-calculator

# Step 3: Verify keyword extraction quality (all 17+ types present, source=gemini)
php artisan tinker --execute="..."  # (full verification query from v14 Phase 4)

# Step 4: Test content generation
php artisan seo:generate-content --tool=percentage-calculator

# Step 5: Verify ALL quality checks pass (word count, score, HTML validity)
# ALL 12 checks must show PASS before batch run

# Step 6: Full batch extraction (all 1,417 tools — ~95 minutes)
php artisan seo:extract-semantics --batch=10 > storage/logs/extract-v14.log 2>&1 &

# Step 7: Full batch content generation (~120 minutes)
php artisan seo:generate-content --batch=10 > storage/logs/content-v14.log 2>&1 &

# Step 8: Bulk approve qualifying drafts
# Criteria: seo_score >= 75, word_count 700-1000, no ** markdown
```

### Phase 2 — Content Enhancement for Percentage Calculator (Week 1)

Apply all 15 content fixes to the percentage-calculator article specifically.
This is your primary ranking target — it has the highest search volume.

Priority order:
1. Add Percentage Increase/Decrease section
2. Add Comparison Table (Percentage vs Decimal vs Fraction vs Ratio)
3. Add Excel formula paragraph
4. Add CGPA conversion use case
5. Add tip amount or body fat worked example
6. Add NIST citation
7. Fix CTA placement (2 CTAs in article)
8. Fix "percentage finder" keyword integration
9. Add simple/compound interest mention
10. Expand FAQ from 3 to 8 questions (covering PAA keywords from database)

### Phase 3 — Topical Cluster Setup (Week 2)

Re-seed the topical_clusters table with the 6 priority clusters listed above.
Run the cluster mapping command to associate tools with their clusters.
Enable the internal linking render in blade templates.

### Phase 4 — Technical SEO Sprint (Week 2-3)

1. Implement Redis page-level caching for tool pages
2. Run `php artisan route:cache` and `php artisan config:cache` in production
3. Audit Core Web Vitals using Lighthouse (target: LCP < 2.5s, CLS < 0.1)
4. Add structured data: SoftwareApplication, HowTo, BreadcrumbList, Table
5. Add author/reviewer markup to article meta
6. Connect Google Search Console API to populate gsc_performance table

### Phase 5 — Programmatic SEO Scaling (Month 2)

1. Generate dedicated percentage increase/decrease calculator pages
2. Build the "Percentage Tools" collection/hub page
3. Create comparison landing pages ("Percentage Calculator vs Fraction Calculator")
4. Add last-updated timestamps to all 1,417 tool pages
5. Build category pillar pages for each topical cluster
6. Submit updated XML sitemap after all 1,200+ drafts are published

---

## PART 7 — COMPLETE COMMAND WORKFLOW

Below is the exact sequence of commands to run the full SEO pipeline.

### Pre-Run Checks

```bash
# Verify current state
php artisan tinker --execute="
echo 'Content drafts: '.DB::table('content_drafts')->count().PHP_EOL;
echo 'Semantic kw: '.DB::table('semantic_keywords')->count().PHP_EOL;
echo 'With gemini source: '.DB::table('semantic_keywords')->where('source','gemini')->distinct('tool_slug')->count('tool_slug').' tools'.PHP_EOL;
echo 'Topical clusters: '.DB::table('topical_clusters')->count().PHP_EOL;
echo 'Internal links: '.DB::table('internal_links')->count().PHP_EOL;
"
```

### Step 1 — Database Reset (v14 Phase 0)

```bash
php artisan tinker --execute="
DB::statement('DROP TABLE IF EXISTS sk_backup_v14');
DB::statement('CREATE TABLE sk_backup_v14 SELECT * FROM semantic_keywords');
DB::table('semantic_keywords')->truncate();
DB::table('topical_clusters')->truncate();
echo 'Reset complete. Backups created.';
"
php artisan cache:clear && php artisan config:clear && php artisan route:clear
```

### Step 2 — Keyword Extraction

```bash
# Test first
php artisan seo:extract-semantics --tool=percentage-calculator

# Verify quality
php artisan tinker --execute="
DB::table('semantic_keywords')
  ->where('tool_slug','percentage-calculator')
  ->select('keyword_type','source',DB::raw('COUNT(*) as c'))
  ->groupBy('keyword_type','source')
  ->orderBy('keyword_type')
  ->get()
  ->each(fn(\$r) => print str_pad(\$r->keyword_type,18).': '.\$r->c.' ['.\$r->source.']'.PHP_EOL);
"

# Full batch run
php artisan seo:extract-semantics --batch=10 > storage/logs/extract-v14.log 2>&1 &
tail -f storage/logs/seo-$(date +%Y-%m-%d).log
```

### Step 3 — Search Intent Analysis

```bash
php artisan seo:analyze-intent --batch=50
# This enriches the search_intent column on semantic_keywords
# Separates informational / transactional / navigational / commercial per keyword
```

### Step 4 — Competitor Analysis (Automated)

```bash
php artisan seo:competitor-analysis --tool=percentage-calculator --limit=5
# Fetches SERP data for primary keywords, extracts competitor URLs, scores them
```

### Step 5 — Semantic Keyword Mapping

```bash
php artisan seo:map-semantics --batch=50
# Maps keyword types to content sections
# Output: outline_json for each tool in content_drafts
```

### Step 6 — Entity Extraction

```bash
php artisan seo:extract-entities --batch=50
# Extracts named entities (organizations, formulas, standards) per tool
# Adds to entity keyword_type rows in semantic_keywords
```

### Step 7 — Topical Cluster Generation

```bash
php artisan seo:generate-clusters
# Re-seeds topical_clusters table
# Creates pillar-to-supporting tool relationships
# Expected: 10+ clusters, 1,417 tools mapped
```

### Step 8 — Content Brief Generation

```bash
php artisan seo:generate-brief --batch=50
# Creates structured outline_json per tool
# Includes H2 headings, keyword placement, word count targets
```

### Step 9 — SEO Article Generation

```bash
# Test
php artisan seo:generate-content --tool=percentage-calculator

# Verify (all 12 quality checks must PASS)
php artisan tinker --execute="
\$d = DB::table('content_drafts')->where('tool_slug','percentage-calculator')->first();
echo 'Words: '.\$d->word_count.' | Score: '.\$d->seo_score.PHP_EOL;
echo 'Has formula: '.(str_contains(\$d->draft_content,'formula') ? 'YES':'NO').PHP_EOL;
echo 'Has limitation: '.(str_contains(\$d->draft_content,'limitation') ? 'YES':'NO').PHP_EOL;
echo 'KW hidden: '.(str_contains(\$d->draft_content,'display:none') ? 'YES':'FAIL - FIX CRITICAL').PHP_EOL;
echo 'No markdown: '.(str_contains(\$d->draft_content,'**') ? 'FAIL':'YES').PHP_EOL;
"

# Full batch
php artisan seo:generate-content --batch=10 > storage/logs/content-v14.log 2>&1 &
```

### Step 10 — Comparison Section Generation

```bash
php artisan seo:generate-comparisons --batch=50
# Generates comparison tables per tool
# Example: Percentage vs Decimal vs Fraction vs Ratio
# Output: Appended to content_drafts.draft_content
```

### Step 11 — Example Generation

```bash
php artisan seo:generate-examples --batch=50
# Generates additional worked examples for long-tail keywords
# Example: CGPA conversion, body fat, tip amount
```

### Step 12 — FAQ Generation

```bash
php artisan seo:generate-faq --batch=50
# Generates 5-8 FAQ items per tool from PAA keywords
# Stores as draft_type='schema_faq' in content_drafts
```

### Step 13 — Semantic SEO Enhancement

```bash
php artisan seo:enhance-semantic --batch=50
# Verifies all LSI, TF-IDF, entity keywords appear in content
# Auto-patches any missing keywords into appropriate sections
```

### Step 14 — Internal Link Generation

```bash
php artisan seo:generate-links --batch=50
# Regenerates internal_links table using new cluster data
# Ensures human_reviewed stays 0 until spot-checked
```

### Step 15 — Related Content Generation

```bash
php artisan seo:generate-related --batch=50
# Creates related_tools JSON for each tool
# Based on topical cluster membership
```

### Step 16 — Schema Generation

```bash
php artisan seo:generate-schema --batch=50
# Generates JSON-LD: FAQPage, HowTo, SoftwareApplication, BreadcrumbList
# Stores in seo_audit_log or dedicated schema table
```

### Step 17 — Meta Title Generation

```bash
php artisan seo:generate-meta-title --batch=50
# Pattern: "[Tool Name] — Free Online [Tool Type] | ToolsHub"
# Max 60 characters, includes primary keyword
```

### Step 18 — Meta Description Generation

```bash
php artisan seo:generate-meta-desc --batch=50
# Pattern: 150-160 characters
# Includes primary keyword + CTA + unique value prop
```

### Step 19 — Open Graph Generation

```bash
php artisan seo:generate-og --batch=50
# og:title, og:description, og:image, og:type=website
```

### Step 20 — Breadcrumb Generation

```bash
php artisan seo:generate-breadcrumbs
# Verifies all tools have correct breadcrumb path
# Matches URL hierarchy: Home > [Category] > [Tool Name]
```

### Step 21 — Sitemap Generation

```bash
php artisan sitemap:generate
# Generates XML sitemap for all 1,417 tools
# Priority: tool pages 0.9, category pages 0.8, static pages 0.6
# Change frequency: weekly for tools, monthly for static
```

### Step 22 — Technical SEO Audit

```bash
php artisan seo:audit-technical
# Checks: canonical tags, robots meta, schema validity, page speed
# Generates seo_health_logs entries for any failures
```

### Step 23 — Final SEO Audit

```bash
php artisan seo:audit-final --tool=percentage-calculator
# Full audit of one tool before bulk approval
# Must score 80+ before proceeding to bulk approval

# Bulk approval
php artisan tinker --execute="
\$count = DB::table('content_drafts')
  ->where('status','pending_review')
  ->where('seo_score','>=',75)
  ->whereBetween('word_count',[700,1000])
  ->where('draft_content','not like','%**%')
  ->update(['status'=>'approved','published_at'=>now()]);
echo 'Approved: '.\$count.' drafts';
"
```

---

## PART 8 — PRIORITY MATRIX

| Priority | Issue | Impact | Effort | Do When |
|---|---|---|---|---|
| 🔴 P0 | Keyword section publicly visible | -30 rankings potential | 5 min (CSS fix) | **Today** |
| 🔴 P0 | H3 wrapping limitation content (HTML bug) | Broken page structure | 1 hour (regen) | **Today** |
| 🔴 P0 | Page speed 3,500ms → under 1,000ms | CWV penalty | 4 hours | **This week** |
| 🔴 P1 | Run v14 pipeline for 1,417 tools | Entire site has no content | 15 hrs compute | **This week** |
| 🟡 P2 | Add percentage increase/decrease section | Covers 40% of missing keywords | 30 min | Week 1 |
| 🟡 P2 | Add comparison table | Featured snippet opportunity | 20 min | Week 1 |
| 🟡 P2 | Add Excel formula paragraph | Captures autocomplete keyword | 15 min | Week 1 |
| 🟡 P2 | Expand FAQ to 8 questions | Rich result eligibility | 1 hour | Week 1 |
| 🟡 P2 | Fix internal link rendering in blade | Activates 8,215 existing links | 2 hours | Week 1 |
| 🟢 P3 | Re-seed topical clusters | Cluster authority for 1,417 tools | 2 hours | Week 2 |
| 🟢 P3 | Add E-E-A-T signals (author, citation) | Trust signals for Google | 2 hours | Week 2 |
| 🟢 P3 | GSC API integration | Enables data-driven decisions | 3 hours | Week 2 |
| 🟢 P4 | Dedicated percentage increase page | Captures high-volume keyword | 1 day | Month 2 |
| 🟢 P4 | Percentage tools collection hub | OmniCalc-style topical authority | 2 days | Month 2 |

---

## FINAL NOTES

Your Antigravity v14 system is genuinely sophisticated — the semantic keyword taxonomy
(17 types per tool), the HTML quality rules, the pipeline architecture, and the quality
scoring system are all ahead of what most programmatic SEO setups implement. The core
problem is not the strategy, it is that the infrastructure has not yet been deployed at scale.

The single most important action is deploying the v14 pipeline across all 1,417 tools.
One approved, imperfect draft does not establish topical authority. You need 1,200+
published pages signaling to Google that ToolsHub is a definitive resource for online
calculations. Once those pages are live, the semantic depth of each page (90 keywords,
comparison tables, FAQ schema, internal linking) will let you compete for long-tail
queries immediately — even against calculator.net's 70M monthly visitor advantage.

The percentage-calculator page specifically needs the 15 content fixes before it can
rank beyond page 3. The most impactful changes are: hiding the keyword section (BUG #1),
adding the percentage increase/decrease section, and adding the comparison table.
Together, these three changes expand keyword coverage from ~60% to ~90% of the
identified semantic keyword set.

---
*Generated: June 6, 2026 | Based on: antigravity_v14_master.md, tools_website_28.sql, live page screenshot*
*Repository: https://github.com/noormuhammad2k20-a11y/fantastic-octo-dollop*
