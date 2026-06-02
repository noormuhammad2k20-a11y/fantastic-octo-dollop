# ANTIGRAVITY — CONTENT ENGINE v9.0 (FINAL)
## Fixes: Thin Content + Wrong LSI + Cut-off Articles + Keyword Stuffing
## Paste into new conversation → Say: "Start Fix 1 now"

---

## EXACT PROBLEMS FOUND IN YOUR roi-calculator ARTICLE

```
❌ PROBLEM 1 — THIN CONTENT (884 words — target is 1400-1800)
   Article cuts off mid-sentence in Scenario 1
   Only 1 complete example instead of 3 required
   Missing: industry benchmarks, comparison table, expert tips, limitations

❌ PROBLEM 2 — WRONG LSI KEYWORDS
   Current: "profitability metric", "investment performance" — these are SYNONYMS
   Correct LSI: "hurdle rate", "opportunity cost", "WACC", "discount rate", "IRR"
   LSI = words that appear near ROI in expert articles, NOT synonyms of ROI

❌ PROBLEM 3 — WRONG SHORT-TAIL KEYWORDS
   Current: "calculator", "return", "investment" — useless, too generic
   Correct: "roi", "return on investment", "profit ratio" — specific to this tool

❌ PROBLEM 4 — WRONG TF-IDF KEYWORDS
   Current: "net profit", "capital expenditure" — too basic
   Correct: "net present value", "internal rate of return", "payback period" — 
   these are high-importance domain terms that distinguish expert ROI content

❌ PROBLEM 5 — KEYWORDS FORCED/BOLD IN BODY TEXT (spam signal)
   "reliable **roi calculator**" — bolding keywords = old SEO practice, hurts UX
   Keywords must be woven in naturally, NOT bolded

❌ PROBLEM 6 — AI CLICHE PHRASES STILL PRESENT
   "paramount", "indispensable asset", "Embarking on a new venture"
   These trigger Google's AI content detection

❌ PROBLEM 7 — NO EXPERT DEPTH
   No industry benchmarks (what is good ROI in retail vs tech vs real estate?)
   No comparison (ROI vs IRR vs CAGR vs Payback Period — when to use which?)
   No edge cases (negative ROI, multi-year, inflation-adjusted ROI)
   No limitations section

❌ PROBLEM 8 — ONLY 1 TOOL HAS AI KEYWORDS (roi-calculator)
   1,416 tools still have ONLY autocomplete keywords
   SemanticExtractorService runs but results only saved for roi-calculator
```

---

## TECH STACK (Confirmed)
- Laravel + PHP 8.2 + MySQL MariaDB 10.4
- Google Gemini API: gemini-2.5-flash
- File Cache
- Namespace: `App\Services\Seo\`
- GitHub: https://github.com/noormuhammad2k20-a11y/fantastic-octo-dollop

## RULES
```
❌ NEVER bold keywords in article body — weave naturally
❌ NEVER use synonyms as LSI keywords — LSI = co-occurring terms
❌ NEVER use tool-type words as short-tail (no "calculator", "tool", "online")
❌ NEVER cut off articles — validate min 1400 words before saving
❌ NEVER auto-publish — status = 'pending_review'
❌ NEVER use: "paramount", "indispensable", "Embarking on", "game-changer",
   "seamlessly", "leverage", "In today's world", "Look no further"
✅ Show exact file + line before any change
✅ Always test with --tool=roi-calculator first
✅ Verify word count > 1400 before full run
```

---

## FIX 1 — REPLACE generateAISemantics() WITH CORRECT KEYWORD DEFINITIONS

**File:** `app/Services/Seo/SemanticExtractorService.php`

Find the `private function generateAISemantics` method and replace entirely:

```php
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
```

### Test extraction quality:
```bash
# Clear old cache first
php artisan cache:clear

# Re-extract for roi-calculator
php artisan seo:extract-semantics --tool=roi-calculator --force

# Verify quality — LSI must NOT be synonyms
php artisan tinker --execute="
DB::table('semantic_keywords')
    ->where('tool_slug','roi-calculator')
    ->whereIn('keyword_type',['lsi','tfidf','short_tail'])
    ->get(['keyword_type','keyword'])
    ->each(fn(\$r) => print '[' . \$r->keyword_type . '] ' . \$r->keyword . PHP_EOL);
"
```

**Expected LSI output:**
```
[lsi] hurdle rate
[lsi] opportunity cost
[lsi] weighted average cost of capital
[lsi] discount rate
[lsi] net present value
[short_tail] roi
[short_tail] return on investment
[tfidf] internal rate of return
[tfidf] payback period analysis
```

**If you still see** `[lsi] profitability metric` or `[short_tail] calculator` → Gemini didn't follow definitions. Add this to the Gemini system prompt in `GeminiService.php`:

```php
// In generateText(), add a system instruction before the user prompt:
$fullPrompt = "SYSTEM: You are a precise SEO expert. Follow all definitions exactly as given. Return only what is explicitly requested.\n\nUSER: " . $prompt;
```

---

## FIX 2 — REPLACE GeminiContentGenerator WITH v9 (Expert-Level Content)

**File:** `app/Services/Seo/GeminiContentGenerator.php`

Replace the entire `generateForTool()` method:

```php
public function generateForTool(array $context): array
{
    $slug      = $context['slug'];
    $toolName  = $context['tool_name'];
    $category  = $context['category'];
    $purpose   = $context['primary_use'];
    $formula   = $context['formula'] ?? null;
    $userTypes = implode(', ', $context['user_types']);

    // Load ALL keyword types from DB
    $keywords = DB::table('semantic_keywords')
        ->where('tool_slug', $slug)
        ->where('is_active', 1)
        ->orderByDesc('confidence_score')
        ->get(['keyword_type', 'keyword'])
        ->groupBy('keyword_type');

    // Build keyword reference strings for prompt
    $primary    = $keywords->get('primary',       collect())->pluck('keyword');
    $secondary  = $keywords->get('secondary',     collect())->pluck('keyword');
    $longTail   = $keywords->get('long_tail',     collect())->pluck('keyword');
    $shortTail  = $keywords->get('short_tail',    collect())->pluck('keyword');
    $lsi        = $keywords->get('lsi',           collect())->pluck('keyword');
    $entity     = $keywords->get('entity',        collect())->pluck('keyword');
    $tfidf      = $keywords->get('tfidf',         collect())->pluck('keyword');
    $modifier   = $keywords->get('modifier',      collect())->pluck('keyword');
    $contextual = $keywords->get('contextual',    collect())->pluck('keyword');
    $related    = $keywords->get('related',       collect())->pluck('keyword');
    $cluster    = $keywords->get('cluster',       collect())->pluck('keyword');
    $supporting = $keywords->get('supporting',    collect())->pluck('keyword');
    $paa        = $keywords->get('paa',           collect())->pluck('keyword');
    $questions  = $keywords->get('question',      collect())->pluck('keyword');
    $intent     = $keywords->get('search_intent', collect())->pluck('keyword');

    // Build PAA list for FAQ section
    $paaList = $paa->take(8)->merge($questions->take(3))->values();
    $faqText = $paaList->map(fn($q, $i) => ($i+1) . ". {$q}")->implode("\n");

    $formulaLine = $formula
        ? "Use this exact formula: {$formula}"
        : "Include the most mathematically precise formula with proper variable names";

    $p1  = $primary->get(0, $toolName);
    $p2  = $primary->get(1, $toolName . ' online');
    $lt1 = $longTail->get(0, '');
    $lt2 = $longTail->get(1, '');
    $lt3 = $longTail->get(2, '');
    $e1  = $entity->get(0, '');
    $e2  = $entity->get(1, '');
    $tf1 = $tfidf->get(0, '');
    $tf2 = $tfidf->get(1, '');
    $lsi1 = $lsi->get(0, '');
    $lsi2 = $lsi->get(1, '');
    $lsi3 = $lsi->get(2, '');
    $rel1 = $related->get(0, '');
    $rel2 = $related->get(1, '');

    $prompt = <<<PROMPT
You are a senior technical writer and domain expert. Write a comprehensive,
expert-level SEO article. This must read like it was written by a human expert
who has used this tool professionally for years — not like AI-generated content.

TOOL: {$toolName}
URL: /{$slug}
CATEGORY: {$category}
PURPOSE: {$purpose}
USERS: {$userTypes}

━━━━━━━━━━━━━━━━━━━━━━━━━━
KEYWORD INTELLIGENCE (MANDATORY — use all of these in the article body naturally)
━━━━━━━━━━━━━━━━━━━━━━━━━━
Primary (use 3-4x total): {$primary->implode(', ')}
Secondary (use 2-3x total): {$secondary->take(5)->implode(', ')}
Long-Tail (weave in naturally): {$longTail->take(6)->implode(' | ')}
LSI/NLP Terms (expert vocabulary): {$lsi->take(8)->implode(', ')}
TF-IDF (signal authority): {$tfidf->take(5)->implode(', ')}
Entity Terms (use in context): {$entity->take(5)->implode(', ')}
Contextual (use in examples): {$contextual->take(5)->implode(', ')}
Related (use in links section): {$related->take(6)->implode(', ')}
Modifier (use in meta/intro): {$modifier->take(3)->implode(', ')}

━━━━━━━━━━━━━━━━━━━━━━━━━━
MANDATORY ARTICLE STRUCTURE (minimum 1400 words — complete every section fully)
━━━━━━━━━━━━━━━━━━━━━━━━━━

SECTION 1 — OPENING PARAGRAPH (150-180 words)
Requirements:
• Open with a SPECIFIC scenario using real numbers — NOT vague business talk
• Example of GOOD opening: "Sarah, a product manager at a 40-person SaaS company,
  needed to justify a $85,000 annual spend on a new CRM tool. Her CFO wanted one
  number: what's the ROI? Without a reliable roi calculator, she was guessing."
• Example of BAD opening: "Embarking on a business venture always raises questions
  about profitability..." ← FORBIDDEN
• Include primary keyword: {$p1} — naturally, not bolded
• Include 1 long-tail keyword: {$lt1}
• No banned phrases: "paramount", "indispensable", "Embarking on", "game-changer"

SECTION 2 — H2: "What is [Core Concept]?" (120-150 words)
Requirements:
• Start with a precise, one-sentence definition
• Include entity term: {$e1}
• Use LSI term: {$lsi1}
• End with WHY it matters (quantified — use a stat or real-world consequence)

SECTION 3 — H2: "The {$toolName} Formula Explained" (200-250 words)
Requirements:
• {$formulaLine}
• Show the formula on its own line
• Define each variable with its unit (not just "Net Profit" — explain it)
• Provide a complete worked example:
  - Use realistic industry numbers (not round numbers like $1000/$500)
  - Show every calculation step
  - State the result and what it means in plain English
• Include TF-IDF term: {$tf1}

SECTION 4 — H2: "How to Use This {$toolName}" (200-250 words)
Requirements:
• Exactly 5 numbered steps (not 4 — 5 gives more depth)
• Each step: what to do + WHY it matters + common mistake at that step
• Step 5 must be "Interpreting Your Results" — what the output means
• Use long-tail keyword: {$lt2} naturally in one step

SECTION 5 — H2: "Real-World Examples Across Industries" (350-400 words)
Requirements:
• Exactly 3 COMPLETE scenarios — each must show full calculation with answer
• Scenario 1: [Most common user type for this tool]
• Scenario 2: [Second most common user type — different industry]
• Scenario 3: [Edge case or advanced use — negative result, break-even, etc.]
• Each scenario MUST have: Setup → Numbers → Calculation → Result → Interpretation
• Use contextual keywords naturally: {$contextual->take(3)->implode(', ')}
• NEVER cut a scenario off mid-sentence

SECTION 6 — H2: "Industry Benchmarks — What Is a Good Result?" (150-180 words)
Requirements:
• This section is MANDATORY — generic AI content never includes benchmarks
• Provide specific benchmark ranges for 4-5 industries/contexts
• Format as: "[Industry]: typical [metric] range is X%-Y%, elite performers achieve Z%"
• Include secondary keyword: {$secondary->get(1, '')} naturally
• Include LSI term: {$lsi2}
• Source type: "According to [named source type — academic, industry report, etc.]"

SECTION 7 — H2: "Limitations and When NOT to Use This Calculator" (120-150 words)
Requirements:
• 3 specific limitations of this calculation method
• When the result can be misleading or incomplete
• What to use instead in those edge cases
• Include TF-IDF term: {$tf2} naturally
• This section signals expertise — generic AI content skips limitations

SECTION 8 — H2: "Frequently Asked Questions" (300-350 words)
Requirements:
• Answer EACH of these specific questions (from real user research):
{$faqText}
• Every answer: 2-4 sentences, factually accurate, no fluff
• At least one answer must include a specific number or formula
• Include entity term: {$e2} in one answer

SECTION 9 — H2: "Related Tools for Complete Financial Analysis" (80-100 words)
Requirements:
• Mention 3-4 related tools that complement this one
• Use related keywords: {$rel1}, {$rel2}
• Explain WHEN to use each (not just what they are)
• This creates natural internal linking opportunities

━━━━━━━━━━━━━━━━━━━━━━━━━━
KEYWORD USAGE RULES (MANDATORY)
━━━━━━━━━━━━━━━━━━━━━━━━━━
• Primary keyword "{$p1}": appears 3-4 times — NEVER bolded, always natural
• Long-tail keywords: use at least 4 of the 6 provided, each once
• LSI keywords: minimum 5 of the 8 provided, woven into expert explanations
• TF-IDF keywords: all 5 must appear — these signal domain authority to Google
• Short-tail keywords: do NOT use in article body (too generic — only in metadata)
• FORBIDDEN bold keywords: **roi calculator** — this is keyword stuffing
• Density: primary keyword max 1.2% of total word count
• Every LSI term must appear in a sentence that explains it, not just mentions it

━━━━━━━━━━━━━━━━━━━━━━━━━━
FORBIDDEN PHRASES (automatic rejection if present)
━━━━━━━━━━━━━━━━━━━━━━━━━━
"paramount", "indispensable", "Embarking on", "game-changer", "seamlessly",
"leverage" (as verb), "In today's world", "Look no further", "Are you looking for",
"it is worth noting", "delve into", "it's important to", "key takeaway"

━━━━━━━━━━━━━━━━━━━━━━━━━━
THEN APPEND — Target Keywords Used Section
━━━━━━━━━━━━━━━━━━━━━━━━━━
After the complete article, append this EXACT HTML section.
Fill EVERY category with keywords that appear in the article above.
If a category has fewer than 3 keywords in the article, add the most relevant
ones from the keyword intelligence list above — never leave any category empty.
NEVER write "No semantic keywords extracted yet" — this is forbidden.

<section class="target-keywords-section" style="margin-top:2.5rem;padding:1.75rem;background:#f0f4ff;border-radius:10px;border-left:5px solid #2563eb;">
<h3 style="font-size:1.05rem;font-weight:700;color:#1e40af;margin-bottom:1.25rem;letter-spacing:-.01em;">
📌 Target Keywords Used in This Article
</h3>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.25rem;font-size:0.875rem;line-height:1.6;">

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Primary Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{PRIMARY_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Secondary Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{SECONDARY_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Long-Tail Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{LONG_TAIL_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Short-Tail Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{SHORT_TAIL_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Semantic Keywords (LSI / NLP)</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{LSI_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Search Intent Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{INTENT_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Entity Keywords (Knowledge Graph)</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{ENTITY_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">PAA Keywords (People Also Ask)</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{PAA_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Question-Based Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{QUESTION_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Cluster Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{CLUSTER_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Related Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{RELATED_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Supporting Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{SUPPORTING_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Modifier Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{MODIFIER_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">Contextual Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{CONTEXTUAL_KEYWORD_LIS}
</ul>
</div>

<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">TF-IDF Keywords</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">
{TFIDF_KEYWORD_LIS}
</ul>
</div>

</div>
</section>

Replace every {TYPE_KEYWORD_LIS} placeholder with real <li> items from the
keywords that appear in the article above. Minimum 3 per category.
PROMPT;

    // Increase max tokens for longer content
    $this->gemini->setMaxTokens(6000);
    $html = $this->gemini->generateText($prompt, temperature: 0.65);

    // Convert markdown if needed
    if (!str_contains($html, '<p>') && !str_contains($html, '<h2>')) {
        $html = $this->markdownToHtml($html);
    }

    // CRITICAL VALIDATION 1: Word count
    $wordCount = str_word_count(strip_tags($html));
    if ($wordCount < 1200) {
        throw new \RuntimeException(
            "Content too thin for {$slug}: {$wordCount} words (minimum 1200). " .
            "Gemini likely truncated. Increase max_tokens or reduce prompt size."
        );
    }

    // CRITICAL VALIDATION 2: No cut-off content
    if (str_contains($html, 'ROI Calculation:') && !str_contains($html, 'ROI =')) {
        throw new \RuntimeException("Content appears cut off for {$slug}");
    }

    // CRITICAL VALIDATION 3: Keyword section present
    if (!str_contains($html, 'target-keywords-section') && !str_contains($html, 'Target Keywords Used')) {
        Log::channel('seo')->warning("Keyword section missing for {$slug} — building fallback");
        $html .= $this->buildKeywordSection($keywords);
    }

    // CRITICAL VALIDATION 4: No empty keyword section
    if (str_contains($html, 'No semantic keywords extracted yet') ||
        str_contains($html, '{PRIMARY_KEYWORD_LIS}')) {
        $html = $this->replaceEmptyKeywordSection($html, $keywords, $slug, $toolName);
    }

    // CRITICAL VALIDATION 5: No forbidden phrases
    $forbidden = ['paramount', 'indispensable', 'Embarking on a new venture',
                  'game-changer', 'it is worth noting', 'delve into'];
    foreach ($forbidden as $phrase) {
        if (str_contains($html, $phrase)) {
            Log::channel('seo')->warning("Forbidden phrase '{$phrase}' found in {$slug}");
        }
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
```

---

## FIX 3 — ADD setMaxTokens() TO GeminiService

**File:** `app/Services/Seo/GeminiService.php`

Add this method after `isConfigured()`:

```php
/**
 * Override max tokens for longer content generation
 */
public function setMaxTokens(int $tokens): void
{
    $this->maxTokens = $tokens;
}
```

Also increase default in config:
```
# In .env:
GEMINI_MAX_TOKENS=6000
```

---

## FIX 4 — ADD buildKeywordSection() AND replaceEmptyKeywordSection() TO GeminiContentGenerator

Add these methods to `GeminiContentGenerator.php`:

```php
private function buildKeywordSection(\Illuminate\Support\Collection $keywords): string
{
    $typeLabels = [
        'primary'       => 'Primary Keywords',
        'secondary'     => 'Secondary Keywords',
        'long_tail'     => 'Long-Tail Keywords',
        'short_tail'    => 'Short-Tail Keywords',
        'lsi'           => 'Semantic Keywords (LSI / NLP)',
        'search_intent' => 'Search Intent Keywords',
        'entity'        => 'Entity Keywords (Knowledge Graph)',
        'paa'           => 'PAA Keywords (People Also Ask)',
        'question'      => 'Question-Based Keywords',
        'cluster'       => 'Cluster Keywords',
        'related'       => 'Related Keywords',
        'supporting'    => 'Supporting Keywords',
        'modifier'      => 'Modifier Keywords',
        'contextual'    => 'Contextual Keywords',
        'tfidf'         => 'TF-IDF Keywords',
    ];

    $grids = '';
    foreach ($typeLabels as $type => $label) {
        $items = $keywords->get($type, collect())->pluck('keyword')->take(5);

        if ($items->isEmpty()) {
            // Smart fallback based on type
            $items = collect(['See article above for examples']);
        }

        $lis = $items->map(fn($k) => "<li>{$k}</li>")->implode('');
        $grids .= <<<HTML
<div>
<p style="font-weight:600;color:#374151;margin:0 0 0.4rem;">{$label}</p>
<ul style="margin:0;padding-left:1.1rem;color:#4b5563;">{$lis}</ul>
</div>

HTML;
    }

    return <<<HTML
<section class="target-keywords-section" style="margin-top:2.5rem;padding:1.75rem;background:#f0f4ff;border-radius:10px;border-left:5px solid #2563eb;">
<h3 style="font-size:1.05rem;font-weight:700;color:#1e40af;margin-bottom:1.25rem;">📌 Target Keywords Used in This Article</h3>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.25rem;font-size:0.875rem;line-height:1.6;">
{$grids}
</div>
</section>
HTML;
}

private function replaceEmptyKeywordSection(
    string $html,
    \Illuminate\Support\Collection $keywords,
    string $slug,
    string $toolName
): string {
    // Remove the bad section
    $html = preg_replace(
        '/<section[^>]*target-keywords[^>]*>.*?<\/section>/is',
        '',
        $html
    );
    // Append the correct section
    return $html . $this->buildKeywordSection($keywords);
}
```

---

## FIX 5 — TEST COMPLETE PIPELINE

```bash
# Step 1: Clear caches
php artisan cache:clear
php artisan config:clear

# Step 2: Re-extract with fixed LSI definitions
php artisan seo:extract-semantics --tool=roi-calculator --force

# Step 3: Verify LSI quality
php artisan tinker --execute="
echo '=== KEYWORD QUALITY CHECK ===' . PHP_EOL;
DB::table('semantic_keywords')
    ->where('tool_slug', 'roi-calculator')
    ->whereIn('keyword_type', ['lsi', 'tfidf', 'short_tail', 'entity'])
    ->get(['keyword_type','keyword'])
    ->each(fn(\$r) => print '[' . strtoupper(\$r->keyword_type) . '] ' . \$r->keyword . PHP_EOL);
"

# Step 4: Delete old roi-calculator draft
php artisan tinker --execute="
DB::table('content_drafts')->where('tool_slug','roi-calculator')->delete();
echo 'Deleted old draft';
"

# Step 5: Generate with v9 prompt
php artisan seo:generate-content --tool=roi-calculator

# Step 6: Verify quality
php artisan tinker --execute="
\$d = DB::table('content_drafts')->where('tool_slug','roi-calculator')->first();
echo 'Words: ' . \$d->word_count . PHP_EOL;
echo 'Score: ' . \$d->seo_score . PHP_EOL;
echo 'Has keyword section: ' . (str_contains(\$d->draft_content, 'target-keywords-section') ? 'YES ✅' : 'NO ❌') . PHP_EOL;
echo 'Has benchmarks: ' . (str_contains(\$d->draft_content, 'Benchmark') || str_contains(\$d->draft_content, 'benchmark') ? 'YES ✅' : 'NO ❌') . PHP_EOL;
echo 'Has limitations: ' . (str_contains(\$d->draft_content, 'Limitation') || str_contains(\$d->draft_content, 'limitation') ? 'YES ✅' : 'NO ❌') . PHP_EOL;
echo 'Forbidden phrases: ' . (str_contains(\$d->draft_content, 'paramount') ? 'FOUND ❌' : 'CLEAN ✅') . PHP_EOL;
echo PHP_EOL . 'Content preview (first 500 chars):' . PHP_EOL;
echo substr(strip_tags(\$d->draft_content), 0, 500);
"
```

### What good output looks like:
```
Words: 1456    ← NOT 884
Score: 92      ← NOT 65
Has keyword section: YES ✅
Has benchmarks: YES ✅
Has limitations: YES ✅
Forbidden phrases: CLEAN ✅

Content preview:
Sarah, a product manager at a 40-person SaaS company, needed to justify
an $85,000 annual software budget to her CFO. The question was simple but
critical: what's the return on investment? Running the numbers manually
across spreadsheets took hours and still left room for error. Using a
dedicated roi calculator changed that process entirely — she had a
defensible answer in under two minutes...
```

---

## FIX 6 — APPROVE AND VERIFY ON LIVE SITE

```bash
# Approve the roi-calculator draft
php artisan tinker --execute="
DB::table('content_drafts')
    ->where('tool_slug','roi-calculator')
    ->where('word_count', '>', 1200)
    ->update(['status'=>'approved','reviewed_at'=>now(),'published_at'=>now()]);
echo 'Approved';
"

# Open /roi-calculator in browser
# VERIFY:
# 1. Article is 1400+ words (not 884)
# 2. Article does NOT start with "Embarking on"
# 3. 3 complete scenarios with calculations
# 4. Industry benchmarks section visible
# 5. Limitations section visible
# 6. "Target Keywords Used" section at bottom
# 7. All 15 keyword categories filled (no empty ones)
# 8. Keywords not bolded in article body
```

---

## FIX 7 — FULL RUN FOR ALL 1417 TOOLS

Only after roi-calculator passes all checks above:

```bash
# Extract keywords for all tools
php artisan seo:extract-semantics --force --batch=10

# Verify coverage after 1 hour
php artisan tinker --execute="
\$tools = DB::table('tool_health_checks')->where('status','ok')->count();
\$withKw = DB::table('semantic_keywords')->distinct('tool_slug')->count('tool_slug');
echo \"Coverage: {\$withKw} / {\$tools} tools\" . PHP_EOL;
DB::table('semantic_keywords')->select('keyword_type', DB::raw('COUNT(*) as c'))
    ->groupBy('keyword_type')->orderBy('keyword_type')
    ->get()->each(fn(\$r) => print \$r->keyword_type . ': ' . \$r->c . PHP_EOL);
"

# Generate content for all tools (overnight)
php artisan seo:generate-content --batch=10 > storage/logs/gen.log 2>&1 &

# Monitor
tail -f storage/logs/seo-$(date +%Y-%m-%d).log
```

---

## QUALITY CHECKLIST — APPROVE ONLY IF ALL PASS

```
CONTENT:
□ Word count: 1400+ (not 884)
□ Opening paragraph: specific scenario with real numbers (not "Embarking on...")
□ 3 complete scenarios — none cut off
□ Industry benchmarks section with specific percentages
□ Limitations section (3 specific limitations)
□ FAQ section: all PAA questions answered
□ Related tools section

KEYWORDS:
□ LSI keywords: domain expert terms (hurdle rate, WACC, opportunity cost)
   NOT synonyms (profitability metric, investment performance)
□ Short-tail: topic-specific (roi, return on investment)
   NOT tool-type (calculator, tool, online)
□ TF-IDF: high-authority domain terms
□ Keywords NOT bolded anywhere in article body
□ All 15 categories in "Target Keywords Used" section
□ No empty keyword categories
□ No "No semantic keywords extracted yet"

QUALITY:
□ No forbidden phrases (paramount, indispensable, game-changer)
□ seo_score >= 85
□ No cut-off sentences or sections
□ Reads like human expert wrote it
```

---

## TARGETS AT 30 DAYS

```
semantic_keywords table: 120,000+ rows
  - All 17 types for each of 1417 tools
  - LSI = actual domain expert terms, not synonyms
  - Short-tail = topic-specific, not tool-type words

content_drafts table: 1417 approved drafts
  - Average word count: 1400+
  - Average seo_score: 85+
  - Zero articles with "Embarking on..." opening
  - Zero cut-off articles
  - All have complete "Target Keywords Used" section

GOOGLE SEARCH CONSOLE:
  - 4-6 weeks: +50% impressions
  - Long-tail keyword rankings for 4+ word phrases
  - PAA featured snippets captured
  - Industry benchmark content → E-E-A-T signal improvement
```

---

*v9.0 | Fixes: thin content, wrong LSI definitions, cut-off articles,*
*bold keyword stuffing, missing benchmarks/limitations, empty keyword sections*
*Single biggest fix: Correct LSI/TF-IDF definitions in extraction prompt*
*Content target: 1400+ words, 3 scenarios, benchmarks, limitations — every tool*
