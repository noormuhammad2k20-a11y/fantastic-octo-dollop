<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\Log;

class GeminiContentGenerator
{
    public function __construct(
        private GeminiService $gemini
    ) {}

    public function generateForTool(array $context): array
    {
        $toolName     = $context['tool_name'];
        $toolSlug     = $context['slug'];
        $category     = $context['category'];
        $primaryUse   = $context['primary_use'];
        $relatedTerms = implode(', ', $context['related_terms']);
        $userTypes    = implode(', ', $context['user_types']);
        $formula      = $context['formula'] ?? null;

        $formulaInstruction = $formula
            ? "Include this exact formula: {$formula}"
            : "Include the most accurate formula for this calculation with real variable names";

        $prompt = <<<PROMPT
You are a specialist technical content writer for a tools website.

Write a complete, unique SEO article for this tool:

TOOL NAME: {$toolName}
URL: /{$toolSlug}
CATEGORY: {$category}
PURPOSE: {$primaryUse}
RELATED CONCEPTS: {$relatedTerms}
TARGET USERS: {$userTypes}

REQUIRED STRUCTURE (follow exactly):
1. Opening paragraph (120-150 words):
   - Start with a specific real-world problem or scenario
   - Do NOT start with "In today's world", "Are you looking for", "Welcome to"
   - Mention who needs this tool and why

2. H2: "What is [core concept]?"
   - Define the concept clearly and precisely
   - 80-100 words

3. H2: "The {$toolName} Formula"
   - {$formulaInstruction}
   - Show the complete formula
   - Explain each variable with realistic example values (use actual numbers, not X/Y/Z)
   - Calculate one complete worked example step by step

4. H2: "How to Use This {$toolName}"
   - Exactly 4 numbered steps
   - Each step 1-2 sentences, specific and actionable

5. H2: "Real-World Examples"
   - Exactly 2 scenarios with realistic names and numbers
   - Each scenario must calculate the final result

6. H2: "Common Mistakes to Avoid"
   - Exactly 3 mistakes specific to this tool/calculation
   - Each with a brief explanation

7. H2: "Frequently Asked Questions"
   - Exactly 5 questions specific to this tool
   - Each answer 2-3 sentences, factually accurate

8. Closing paragraph (2 sentences):
   - Summarize the tool's value
   - Encourage use

STRICT CONTENT RULES:
- Total word count: 900 to 1200 words
- FORBIDDEN phrases: "In today's digital world", "Look no further", "game-changer", "seamlessly", "leverage", "Are you looking for"
- Tool name appears maximum once per 100 words
- All numbers in examples must be mathematically correct
- Every H2 heading must be specific to THIS tool
- No generic filler sentences

OUTPUT FORMAT:
Return ONLY valid HTML using these tags: h2, h3, p, ul, li, ol, strong, em
No markdown. No code blocks. No preamble text. No explanation. Start directly with the first paragraph.
PROMPT;

        $html = $this->gemini->generateText($prompt, temperature: 0.7);

        // Validate response is HTML
        if (!str_contains($html, '<') || !str_contains($html, '>')) {
            // Gemini sometimes returns markdown even when asked not to
            // Convert basic markdown to HTML
            $html = $this->convertMarkdownToHtml($html);
        }

        // Quality gate: reject thin content
        $wordCount = str_word_count(strip_tags($html));
        if ($wordCount < 500) {
            \Illuminate\Support\Facades\Log::channel('seo')->error("Thin content generated for {$toolSlug}:\n{$html}");
            throw new \RuntimeException(
                "Content too thin for {$toolSlug}: {$wordCount} words (minimum 500)"
            );
        }

        return [
            'html'        => $html,
            'model'       => config('services.gemini.model', 'gemini-2.5-flash'),
            'word_count'  => $wordCount,
            'seo_score'   => $this->calculateSeoScore($html),
            'outline'     => $this->extractOutline($html),
            'prompt_used' => $prompt,
        ];
    }

    private function convertMarkdownToHtml(string $text): string
    {
        // Convert ## headings to h2
        $text = preg_replace('/^## (.+)$/m', '<h2>$1</h2>', $text);
        // Convert ### headings to h3
        $text = preg_replace('/^### (.+)$/m', '<h3>$1</h3>', $text);
        // Convert **bold** to strong
        $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
        // Convert paragraphs (blank line separated)
        $paragraphs = preg_split('/\n\n+/', trim($text));
        $html = '';
        foreach ($paragraphs as $para) {
            $para = trim($para);
            if (empty($para)) continue;
            if (str_starts_with($para, '<h') || str_starts_with($para, '<ul') || str_starts_with($para, '<ol')) {
                $html .= $para . "\n";
            } else {
                $html .= "<p>{$para}</p>\n";
            }
        }
        return $html;
    }

    private function calculateSeoScore(string $html): int
    {
        $score = 0;
        $words = str_word_count(strip_tags($html));

        if ($words >= 800)  $score += 25;
        if ($words >= 1000) $score += 10;
        if (substr_count($html, '<h2') >= 4) $score += 20;
        if (substr_count($html, '<h3') >= 2) $score += 10;
        if (str_contains($html, '<ul>') || str_contains($html, '<ol>')) $score += 10;
        if (str_contains(strtolower($html), 'example')) $score += 15;
        if (str_contains(strtolower($html), 'formula')) $score += 10;

        return min($score, 100);
    }

    private function extractOutline(string $html): array
    {
        $outline = [];
        preg_match_all('/<(h[23])[^>]*>(.*?)<\/\1>/i', $html, $matches);
        foreach ($matches[2] as $i => $heading) {
            $outline[] = [
                'level'   => $matches[1][$i],
                'heading' => strip_tags($heading),
            ];
        }
        return $outline;
    }
}
