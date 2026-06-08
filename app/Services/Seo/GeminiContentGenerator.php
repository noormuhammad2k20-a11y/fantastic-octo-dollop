<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * GeminiContentGenerator v11.0 (now powered by OpenRouter / Claude)
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

OPENING — 70-80 words (keep it focused, not story-heavy):
• Start with a NAMED fictional person + specific real numbers in a real situation
  GOOD: "Marcus, a 38-year-old freelance developer billing 95 dollars per hour, needed to compare..."
  BAD: "In today's world", "Are you wondering", "Whether you are", "Embarking on"
• Include: primary keyword {$p1} — naturally, not quoted, not bolded
• Include: long-tail {$lt1} — naturally
• End with a direct CTA: "Use the {$toolName} above — it handles all calculation types instantly."

H2: What Is [Core Concept]? — 80-100 words:
• One precise, factual definition sentence
• Include entity: {$e1} — name the organization/standard/formula
• Include LSI term: {$lsi1} — in a sentence that explains it
• Add one authoritative reference (e.g. "According to the National Institute of Standards and Technology (NIST)...")
• If financial: mention that percentages are foundational to simple interest (I = P × R × T) and compound interest (A = P(1 + r/n)^nt) formulas
• End with one real-world consequence of not knowing this concept

H2: The {$toolName} Formula — 110-130 words:
• {$formulaLine}
• Formula on its own line in plain text — NO code blocks, NO markdown
• Define each variable with its unit and real-world value range
• ONE complete worked example with specific non-round numbers
  (e.g. 73.5 kg not 70 kg, 1.77 m not 1.8 m)
• Show all calculation steps → state result → one plain-language interpretation
• Include: {$tf1} naturally

H2: How to Use This {$toolName} — 100-110 words:
• Exactly 4 steps as HTML ordered list: <ol><li>...</li></ol>
• Each step: action (what to do) + why (why it matters)
• Step 4 = "Interpret Your Result" — explain output ranges and what they mean
• Include: {$lt2} naturally in one step
• Naturally integrate the term "finder" (e.g. "percentage finder") in context
• End with CTA: "Enter your values in the calculator above to get an instant result."

H2: Three Practical Examples — 180-200 words:
• Example 1: Most common user type — setup + inputs + full calculation + result number
• Example 2: Different user type or edge case — setup + inputs + full calculation + result number
• Example 3: Cover a long-tail keyword use case (e.g. tip calculation, student scores, CGPA conversion, body fat percentage)
  For CGPA: "Students converting CGPA to percentage can use: Percentage = CGPA × 9.5"
• All examples MUST end with their final calculated number — never cut off
• Include: {$cmp1} naturally in context
• Include: {$lsi2} and {$lsi3} in explanations

H2: Important Limitations — 70-80 words:
• Exactly 3 limitations of this tool/calculation method
• Format each as a paragraph: <p><strong>Limitation Name</strong>: explanation + workaround sentence</p>
• IMPORTANT: The <h2> tag must ONLY contain the heading text. Body content goes in <p> tags AFTER the heading.
• Include: {$tf2} naturally
• This section proves expert knowledge — generic AI content never includes it

━━━ ABSOLUTE OUTPUT RULES ━━━
1. Output ONLY valid HTML: h2, p, ul, ol, li, strong (non-keyword), em, table, thead, tbody, tr, th, td
2. ZERO markdown: no **bold**, no *italic*, no ## heading, no - bullets, no 1. lists
   Steps = <ol><li>text</li></ol> | Bold = <strong>text</strong>
3. NO URLs, no href="...", no /path links — they cause 404 errors
4. NO <strong> on primary keywords — that's keyword stuffing
5. NO Frequently Asked Questions section — already on page
6. NO Related Tools section — already on page
7. NO Target Keywords section — handled separately
8. Acronyms UPPERCASE in headings: BMI not Bmi, ROI not Roi
9. Keyword density: primary keyword max 1.5% of total words
10. Every LSI and TF-IDF term must be in a meaningful explanatory sentence — not just listed
11. HEADING RULE: <h2> and <h3> tags must ONLY contain short heading text. NEVER put paragraphs, lists, or block content inside heading tags.
12. BANNED: "paramount","indispensable","game-changer","seamlessly","leverage" (verb),
    "delve into","it's worth noting","In today's world","Embarking on","Look no further",
    "Are you looking for","As an AI","touch base","it goes without saying"
PROMPT;

        $this->gemini->setMaxTokens(config('services.gemini.max_tokens', 8192));
        $html = $this->gemini->generateText($prompt, temperature: 0.65);

        // Convert if markdown
        if (!str_contains($html, '<p>') && !str_contains($html, '<h2>')) {
            $html = $this->markdownToHtml($html);
        }

        // v12: Fix acronym capitalization + remove any URLs Gemini invented
        $html = $this->fixAcronyms($html);
        $html = $this->removeUrls($html);
        $html = $this->cleanMarkdownRemnants($html);

        // v14.1: Fix broken heading hierarchy (BUG #2 — h3 wrapping body content)
        $html = $this->fixBrokenHeadings($html);

        $wordCount = str_word_count(strip_tags($html));

        // v14: Target 750-950 — reject if too short OR too long
        if ($wordCount < 650) {
            Log::channel('seo')->warning("First attempt too short ({$wordCount} words) for {$slug} — retrying with higher tokens");
            sleep(5);
            $this->gemini->setMaxTokens(config('services.gemini.max_tokens', 8192));
            $retryPrompt = "IMPORTANT: Your previous response was only {$wordCount} words. You MUST write 800-950 words. Write the COMPLETE article with ALL sections.\n\n" . $prompt;
            $html = $this->gemini->generateText($retryPrompt, temperature: 0.65);

            if (!str_contains($html, '<p>') && !str_contains($html, '<h2>')) {
                $html = $this->markdownToHtml($html);
            }

            $wordCount = str_word_count(strip_tags($html));

            if ($wordCount < 500) {
                throw new \RuntimeException("Too short after retry: {$wordCount} words for {$slug}");
            }
        }
        if ($wordCount > 1000) {
            Log::channel('seo')->warning("Over target: {$wordCount} words for {$slug} — consider regenerating");
        }

        // v14: Strip any keyword section Gemini may have added (may have placeholders)
        $html = preg_replace('/<section[^>]*seo-kw-section[^>]*>.*?<\/section>/is', '', $html);
        $html = preg_replace('/<h[23]>.*?Target Keywords.*?<\/h[23]>.*?<\/ul>/is', '', $html);
        $html = preg_replace('/<h[23]>.*?Frequently Asked Questions.*?<\/h[23]>.*?(?:<h[23]>|$)/is', '', $html);
        $html = preg_replace('/<h[23]>.*?Related Tools.*?<\/h[23]>.*?(?:<h[23]>|$)/is', '', $html);

        // v14: Always append PHP-built keyword section (guaranteed complete, no placeholders)
        $html .= $this->buildFallbackSection($kw, $slug);

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

    /**
     * v14.1: Improved SEO scoring with proper deductions (BUG #3 fix).
     * Previous version gave 100/100 too easily. Now checks for actual content quality.
     */
    private function scoreSeo(string $html, \Illuminate\Support\Collection $kw): int
    {
        $score = 0;
        $text  = strip_tags(preg_replace('/<section[^>]*seo-kw-section.*?<\/section>/is', '', $html));
        $lower = strtolower($text);
        $words = str_word_count($text);

        // ── Word count (25 pts max) ──
        if ($words >= 750 && $words <= 950) $score += 25;
        elseif ($words >= 700 && $words < 750) $score += 15;
        elseif ($words >= 500) $score += 8;

        // ── Structure (20 pts max) ──
        $h2Count = substr_count($html, '<h2');
        if ($h2Count >= 5) $score += 15;
        elseif ($h2Count >= 3) $score += 8;
        if (str_contains($html, '<ol>')) $score += 3;  // ordered list (how-to steps)
        if (str_contains($html, '<ul>')) $score += 2;  // unordered list

        // ── Keyword section properly hidden (10 pts) ──
        if (str_contains($html, 'seo-kw-section')) {
            if (str_contains($html, 'display:none') || str_contains($html, 'display: none')) {
                $score += 10;
            } else {
                $score -= 20; // PENALTY: keyword section visible = keyword stuffing
            }
        }

        // ── Keyword richness — types present in DB (10 pts max) ──
        $typesPresent = $kw->keys()->count();
        $score += min($typesPresent, 10);

        // ── Content depth signals (15 pts max) ──
        if (str_contains($lower, 'formula'))    $score += 3;
        if (str_contains($lower, 'example'))    $score += 3;
        if (str_contains($lower, 'limitation')) $score += 3;
        if (str_contains($lower, 'increase') || str_contains($lower, 'decrease')) $score += 3;
        if (str_contains($html, '<table'))       $score += 3; // comparison table

        // ── Entity keywords in body (10 pts max, -5 per missing) ──
        $entityKws = $kw->get('entity', collect())->pluck('keyword')->take(4);
        $entityHits = 0;
        foreach ($entityKws as $ek) {
            if (str_contains($lower, strtolower($ek))) $entityHits++;
        }
        if ($entityKws->count() > 0) {
            $entityRatio = $entityHits / $entityKws->count();
            $score += (int) round($entityRatio * 10);
        }

        // ── Comparison keywords coverage (5 pts) ──
        $compKws = $kw->get('comparison', collect())->pluck('keyword')->take(3);
        if ($compKws->isNotEmpty()) {
            $compFound = false;
            foreach ($compKws as $ck) {
                if (str_contains($lower, strtolower($ck))) { $compFound = true; break; }
            }
            if ($compFound) $score += 5;
        }

        // ── Deductions ──
        // H3 wrapping body content (invalid HTML)
        if (preg_match('/<h3[^>]*>[^<]{200,}<\/h3>/is', $html)) {
            $score -= 15;
        }

        // No citations/references = cap at 85 (E-E-A-T weakness)
        $hasCitation = str_contains($lower, 'according to') ||
                       str_contains($lower, 'nist') ||
                       str_contains($lower, 'institute') ||
                       str_contains($lower, 'standard');
        if (!$hasCitation && $score > 85) {
            $score = 85;
        }

        // Contains markdown remnants
        if (str_contains($html, '**')) {
            $score -= 10;
        }

        return max(0, min($score, 100));
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

    /**
     * v14.1: Fix broken heading hierarchy (BUG #2 fix).
     * Detects <h3> tags that wrap large body content (paragraphs, lists, etc.)
     * and splits them into proper <h3> heading + <p> body structure.
     */
    private function fixBrokenHeadings(string $html): string
    {
        // Fix h3 tags containing more than 100 characters (likely wrapping body content)
        $html = preg_replace_callback(
            '/<h3([^>]*)>(.*?)<\/h3>/is',
            function ($match) {
                $attrs = $match[1];
                $content = $match[2];

                // If the h3 content is short (normal heading), leave it alone
                if (strlen(strip_tags($content)) < 100) {
                    return $match[0];
                }

                // If h3 contains block elements, it's wrapping body content
                if (preg_match('/<(p|ul|ol|div|section|table|strong.*strong)/i', $content)) {
                    // Extract the first sentence/phrase as the heading
                    $headingText = '';
                    $bodyContent = $content;

                    // Try to find a clean break point (first period, colon, or strong tag)
                    if (preg_match('/^([^<.]{10,80}[.:])\s*/s', $content, $m)) {
                        $headingText = trim(strip_tags($m[1]));
                        $bodyContent = trim(substr($content, strlen($m[0])));
                    } elseif (preg_match('/^(.*?<\/strong>)/is', $content, $m)) {
                        $headingText = trim(strip_tags($m[1]));
                        $bodyContent = trim(substr($content, strlen($m[0])));
                    } else {
                        // Fallback: use first 60 chars as heading
                        $plain = strip_tags($content);
                        $headingText = trim(substr($plain, 0, 60));
                        $bodyContent = $content;
                    }

                    // Wrap remaining body content in proper tags if not already wrapped
                    if (!preg_match('/^<(p|ul|ol|div|section)/i', trim($bodyContent))) {
                        $bodyContent = '<p>' . $bodyContent . '</p>';
                    }

                    return "<h3{$attrs}>" . e($headingText) . "</h3>\n" . $bodyContent;
                }

                return $match[0];
            },
            $html
        );

        // Also fix h2 tags wrapping body content (same issue)
        $html = preg_replace_callback(
            '/<h2([^>]*)>(.*?)<\/h2>/is',
            function ($match) {
                $content = $match[2];
                if (strlen(strip_tags($content)) < 120 && !preg_match('/<(p|ul|ol)/i', $content)) {
                    return $match[0];
                }
                if (preg_match('/<(p|ul|ol|div|section)/i', $content)) {
                    if (preg_match('/^([^<.]{10,80}[.:])\s*/s', $content, $m)) {
                        $heading = trim(strip_tags($m[1]));
                        $body = trim(substr($content, strlen($m[0])));
                        if (!preg_match('/^<(p|ul|ol)/i', trim($body))) {
                            $body = '<p>' . $body . '</p>';
                        }
                        return "<h2{$match[1]}>" . e($heading) . "</h2>\n" . $body;
                    }
                }
                return $match[0];
            },
            $html
        );

        return $html;
    }

    /**
     * v14: Build PHP-generated keyword section — guaranteed complete, no [LI_TYPE] placeholders.
     * Always used instead of relying on Gemini to generate the keyword section.
     */
    private function buildFallbackSection(\Illuminate\Support\Collection $kw, string $slug): string
    {
        $typeLabels = [
            'primary'       => 'Primary Keywords',
            'secondary'     => 'Secondary Keywords',
            'lsi'           => 'LSI Keywords',
            'long_tail'     => 'Long-Tail Keywords',
            'entity'        => 'Entity Keywords',
            'semantic'      => 'Semantic Keywords',
            'comparison'    => 'Comparison Keywords',
            'transactional' => 'Transactional Keywords',
            'tfidf'         => 'TF-IDF Keywords',
            'related'       => 'Related Keywords',
        ];

        $items = '';
        foreach ($typeLabels as $type => $label) {
            $keywords = $kw->get($type, collect())->pluck('keyword')->take(5);
            if ($keywords->isEmpty()) continue;

            $pills = $keywords->map(fn($k) => '<span class="seo-kw-pill">' . e($k) . '</span>')->implode(' ');
            $items .= '<li><strong>' . $label . ':</strong> ' . $pills . '</li>' . "\n";
        }

        if (empty($items)) return '';

        return "\n" . '<section class="seo-kw-section" style="display:none" aria-hidden="true">' . "\n"
             . '<h3>Target Keywords Used</h3>' . "\n"
             . '<ul>' . "\n" . $items . '</ul>' . "\n"
             . '</section>' . "\n";
    }
}
