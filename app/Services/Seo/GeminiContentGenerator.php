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
        if ($wordCount < 120) {
            throw new \RuntimeException(
                "Content too thin for {$slug}: {$wordCount} words. " .
                "Gemini likely truncated. Dump: " . substr($html, 0, 500)
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

    private function loadKeywordsFromDb(string $slug): \Illuminate\Support\Collection
    {
        return DB::table('semantic_keywords')
            ->where('tool_slug', $slug)
            ->where('is_active', 1)
            ->orderByDesc('confidence_score')
            ->get(['keyword_type', 'keyword', 'confidence_score'])
            ->groupBy('keyword_type');
    }

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
