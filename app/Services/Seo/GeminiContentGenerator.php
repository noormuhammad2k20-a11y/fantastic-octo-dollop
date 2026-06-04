<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * GeminiContentGenerator v10.0
 *
 * Generates unique, humanized SEO articles using:
 * - Tool-specific context (from ToolContextExtractor)
 * - Real extracted keywords from semantic_keywords table
 * - All 13+ keyword types embedded naturally
 * - Auto-generated "Target Keywords Used" section at article end
 *
 * v10 changes:
 * - Target word count: 800-900 (was 1400+)
 * - Uses all 13 user-requested keyword types
 * - Keyword section uses 'seo-kw-section' class with smart fallbacks
 * - Improved scoreSeo() for 85+ target scores
 * - Validation rejects < 700 words, warns > 1050 words
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

        // v12: FAQ and Related Tools are handled by blade.php — NOT in article

        $formulaLine = $formula
            ? "FORMULA: {$formula}"
            : "Include the standard formula for this tool with correct variable names";

        $p1  = $primary->get(0, $toolName);
        $lt1 = $longTail->get(0, '');
        $lt2 = $longTail->get(1, '');
        $cmp1 = $comparison->get(0, '');
        $e1  = $entity->get(0, '');
        $lsi1 = $lsi->get(0, '');
        $lsi2 = $lsi->get(1, '');
        $lsi3 = $lsi->get(2, '');
        $tf1 = $tfidf->get(0, '');
        $tf2 = $tfidf->get(1, '');

        $prompt = <<<PROMPT
You are a professional technical writer. Write a focused SEO article.
This article will be placed BELOW the {$toolName} tool on a web page.
The page already has: FAQ section, Related Tools section.
DO NOT duplicate these.

TOOL: {$toolName} | SLUG: /{$slug}
CATEGORY: {$category} | PURPOSE: {$purpose}
TARGET USERS: {$userTypes}

━━━ KEYWORDS — USE ALL NATURALLY IN ARTICLE BODY ━━━
Primary (2-3x, never bold): {$primary->take(3)->implode(', ')}
Secondary (1-2x each): {$secondary->take(4)->implode(', ')}
LSI/NLP (expert vocabulary — weave in): {$lsi->take(6)->implode(', ')}
Semantic (topic depth): {$semantic->take(4)->implode(', ')}
Long-Tail (use 3-4 of these): {$longTail->take(5)->implode(' | ')}
TF-IDF (ALL must appear): {$tfidf->take(4)->implode(', ')}
Entity Knowledge Graph: {$entity->take(4)->implode(', ')}
Comparison: {$comparison->take(2)->implode(', ')}
Transactional: {$transact->take(2)->implode(', ')}

━━━ ARTICLE STRUCTURE — 800-1000 WORDS TOTAL ━━━

OPENING PARAGRAPH — 90-110 words:
• Open with a named fictional person in a specific real situation with real numbers
• GOOD: "James, a 34-year-old construction manager, needed to verify his weight
  category before starting a new fitness program. At 92 kg and 1.78 m tall..."
• BAD: "In today's health-conscious world", "Are you wondering", "Embarking on"
• Include: {$p1} naturally — no bold, no quotes around it
• Include: {$lt1} naturally
• Must state the specific benefit the tool gives

H2: What Is [Core Concept]? — 80-100 words:
• One precise definitional sentence
• Include entity: {$e1} (name the organization/standard/formula)
• Include LSI: {$lsi1} in a meaningful sentence
• End with one real consequence of not knowing this

H2: The {$toolName} Formula — 120-140 words:
• {$formulaLine}
• Formula on its own line in plain text (no markdown, no code blocks)
• Define each variable: name + unit + typical real-world range
• ONE complete worked example:
  Use specific numbers like 73.5 kg, 1.77 m — NOT round numbers like 70 kg, 1.8 m
  Show every calculation step
  State the result AND what it means in ONE plain sentence
• Include: {$tf1}

H2: How to Use This {$toolName} — 100-120 words:
• Exactly 4 numbered steps
• Each step: action sentence + why it matters sentence
• Step 4 must be "Interpret your result" explaining what the output means
• Include: {$lt2} naturally in one step

H2: Two Real Examples — 150-180 words:
• Example 1: Most common user type — complete calculation with answer
• Example 2: Different user type or edge case — complete calculation with answer
• Each: Setup (2 sentences) → inputs → calculation → result sentence with final number
• Include: {$cmp1} naturally
• Include LSI: {$lsi2} and {$lsi3}
• BOTH examples must end with their final calculated number — never cut off

H2: Key Limitations — 70-90 words:
• Exactly 3 specific limitations of this calculation method
• Format: [Limitation name]: one explanation sentence + one workaround sentence
• Include: {$tf2}
• This section is what separates expert content from generic AI content

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

        $this->gemini->setMaxTokens(8192);
        $html = $this->gemini->generateText($prompt, temperature: 0.65);

        // Convert if markdown
        if (!str_contains($html, '<p>') && !str_contains($html, '<h2>')) {
            $html = $this->markdownToHtml($html);
        }

        // v12: Fix acronym capitalization + remove any URLs Gemini invented
        $html = $this->fixAcronyms($html);
        $html = $this->removeUrls($html);
        $html = $this->cleanMarkdownRemnants($html);

        $wordCount = str_word_count(strip_tags(
            preg_replace('/<section class="seo-kw-section".*?<\/section>/is', '', $html)
        ));

        // Retry once if Gemini truncated the output
        if ($wordCount < 700) {
            Log::channel('seo')->warning("First attempt too short ({$wordCount} words) for {$slug} — retrying with higher tokens");
            sleep(5);
            $this->gemini->setMaxTokens(10000);
            $retryPrompt = "IMPORTANT: Your previous response was only {$wordCount} words. You MUST write 800-900 words. Write the COMPLETE article with ALL sections.\n\n" . $prompt;
            $html = $this->gemini->generateText($retryPrompt, temperature: 0.65);

            if (!str_contains($html, '<p>') && !str_contains($html, '<h2>')) {
                $html = $this->markdownToHtml($html);
            }

            $wordCount = str_word_count(strip_tags(
                preg_replace('/<section class="seo-kw-section".*?<\/section>/is', '', $html)
            ));

            if ($wordCount < 500) {
                throw new \RuntimeException("Too short after retry: {$wordCount} words for {$slug}");
            }
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

        // CRITICAL: No forbidden phrases
        $forbidden = ['paramount', 'indispensable', 'Embarking on', 'game-changer',
                      'seamlessly', 'In today\'s world', 'Look no further',
                      'it\'s worth noting', 'delve into'];
        foreach ($forbidden as $phrase) {
            if (str_contains($html, $phrase)) {
                Log::channel('seo')->warning("Forbidden phrase '{$phrase}' found in {$slug}");
            }
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
        // Already has HTML tags — just clean up markdown remnants
        if (str_contains($text, '<p>') || str_contains($text, '<h2>')) {
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

        // 5. Wrap consecutive <li> in <ul>
        $text = preg_replace('/((<li>.*?<\/li>\n?)+)/s', "<ul>\n$0</ul>\n", $text);

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

    private function scoreSeo(string $html, \Illuminate\Support\Collection $kw): int
    {
        $score = 0;
        $text  = strip_tags(preg_replace('/<section[^>]*seo-kw-section.*?<\/section>/is', '', $html));
        $words = str_word_count($text);

        // Word count score (30 pts max)
        if ($words >= 750 && $words <= 950) $score += 30;  // Perfect range
        elseif ($words >= 700)              $score += 15;

        // Structure (30 pts max)
        if (substr_count($html, '<h2') >= 5) $score += 20;
        if (str_contains($html, '<ul>') || str_contains($html, '<ol>')) $score += 10;

        // Keyword section (20 pts)
        if (str_contains($html, 'seo-kw-section')) $score += 20;

        // Keyword richness (10 pts max)
        $typesPresent = $kw->keys()->count();
        $score += min($typesPresent * 1, 10);

        // Content signals (10 pts max)
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

    /**
     * v12: Fix common acronym capitalization issues in generated HTML.
     * ucwords() breaks "BMI" → "Bmi", "ROI" → "Roi", "ERA" → "Era"
     */
    private function fixAcronyms(string $html): string
    {
        $fixes = [
            // Health
            'Bmi'    => 'BMI',  'bmi '   => 'BMI ',
            // Finance
            'Roi'    => 'ROI',  'Cagr'   => 'CAGR', 'Apy'    => 'APY',
            'Apr'    => 'APR',  'Irr'    => 'IRR',  'Npv'    => 'NPV',
            'Vat'    => 'VAT',  'Ebitda' => 'EBITDA',
            // Sports
            'Era'    => 'ERA',  'Ops'    => 'OPS',  'Whip'   => 'WHIP',
            'Fip'    => 'FIP',  'War'    => 'WAR',
            // Developer
            'Md5'    => 'MD5',  'Sha'    => 'SHA',  'Jwt'    => 'JWT',
            'Json'   => 'JSON', 'Html'   => 'HTML', 'Css'    => 'CSS',
            'Xml'    => 'XML',  'Url'    => 'URL',  'Api'    => 'API',
            'Uuid'   => 'UUID', 'Sql'    => 'SQL',  'Ascii'  => 'ASCII',
            // Math/Science
            'Gpa'    => 'GPA',  'Gre'    => 'GRE',  'Sat'    => 'SAT',
            'Ph'     => 'pH',   'Tdee'   => 'TDEE', 'Bmr'    => 'BMR',
        ];

        // Apply fixes only inside H1/H2/H3 tags to avoid breaking content
        return preg_replace_callback(
            '/<(h[1-3])[^>]*>(.*?)<\/(h[1-3])>/i',
            function($match) use ($fixes) {
                $heading = $match[2];
                foreach ($fixes as $wrong => $correct) {
                    $heading = str_replace($wrong, $correct, $heading);
                }
                return "<{$match[1]}>{$heading}</{$match[3]}>";
            },
            $html
        );
    }

    /**
     * v12: Remove any URLs/href attributes that Gemini invents (they cause 404 errors)
     */
    private function removeUrls(string $html): string
    {
        // Convert <a href="...">text</a> to just text
        return preg_replace('/<a\s+[^>]*href=["\'][^"]*["\'][^>]*>(.*?)<\/a>/i', '$1', $html);
    }
}
