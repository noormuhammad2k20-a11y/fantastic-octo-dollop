# ANTIGRAVITY — GEMINI API INTEGRATION PROMPT
## OpenAI ki jagah Google Gemini API use karne ke liye
## Version: 5.0 | Paste in new conversation → say "Start Step 1"

---

## CURRENT STATE (Verified — May 30, 2026)

```
✅ DONE:
- Mock content deleted (1,394 drafts removed)
- Internal links rebuilt with correct categories (2,678 links)
- Topical clusters created (10 clusters, 1,031 tool assignments)
- Frontend connected (ToolController + Blade partial)
- SemanticExtractorService — silent failure fixed

❌ ONLY REMAINING:
- OPENAI_API_KEY was missing → replaced with GEMINI_API_KEY
- Need to update ALL OpenAI calls to use Gemini API instead
- semantic_keywords: only autocomplete data (PAA/LSI/Entity = 0)
- content_drafts: 0 real content (all mock deleted)
```

---

## YOUR IDENTITY

Senior Laravel Engineer working on my tools website.
Stack: Laravel + PHP 8.2 + MySQL (MariaDB 10.4) + Laravel File Cache + Queues
GitHub: https://github.com/noormuhammad2k20-a11y/fantastic-octo-dollop

You fix real code. No generic advice. Show broken code BEFORE fixing.

---

## ABSOLUTE RULES

```
❌ NEVER auto-publish — status must stay 'pending_review'
❌ NEVER use Tool::all() — always chunk(50)
❌ NEVER hardcode API keys — always use env()
❌ NEVER alter existing columns
❌ NEVER generate without verifying GEMINI_API_KEY first

✅ ALWAYS show broken file before fixing
✅ ALWAYS use updateOrCreate() with tool_slug as unique key
✅ ALWAYS chunk() with gc_collect_cycles() between batches
✅ ALWAYS log to Log::channel('seo')
✅ ALWAYS add --dry-run to every Artisan command
```

---

## STEP 1 — ADD GEMINI API KEY TO .env

Open your `.env` file and add:
```env
GEMINI_API_KEY=your-new-key-here
GEMINI_MODEL=gemini-1.5-flash
GEMINI_MAX_TOKENS=2000
```

**IMPORTANT: Never paste your actual API key into any chat or conversation.**
Keep it ONLY in your `.env` file on your server.

Then clear config cache:
```bash
php artisan config:clear
php artisan cache:clear
```

Verify key is loaded:
```bash
php artisan tinker --execute="echo env('GEMINI_API_KEY') ? 'KEY EXISTS: ' . substr(env('GEMINI_API_KEY'), 0, 8) . '...' : 'KEY MISSING';"
```
Expected: `KEY EXISTS: AQ.Ab8RN...` (first 8 chars only shown)

---

## STEP 2 — ADD GEMINI TO config/services.php

Open `config/services.php` and add or update the gemini section:

```php
// In config/services.php — add this block:
'gemini' => [
    'api_key'    => env('GEMINI_API_KEY'),
    'model'      => env('GEMINI_MODEL', 'gemini-1.5-flash'),
    'max_tokens' => (int) env('GEMINI_MAX_TOKENS', 2000),
    'rpm_limit'  => (int) env('GEMINI_RPM_LIMIT', 15),
    'endpoint'   => 'https://generativelanguage.googleapis.com/v1beta/models',
],
```

---

## STEP 3 — CREATE GeminiService (Core API Wrapper)

**File:** `app/Services/SEO/GeminiService.php`

```php
<?php

namespace App\Services\SEO;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private string $apiKey;
    private string $model;
    private int    $maxTokens;
    private int    $rpmLimit;

    public function __construct()
    {
        $this->apiKey    = config('services.gemini.api_key', '');
        $this->model     = config('services.gemini.model', 'gemini-1.5-flash');
        $this->maxTokens = config('services.gemini.max_tokens', 2000);
        $this->rpmLimit  = config('services.gemini.rpm_limit', 15);
    }

    /**
     * Check if API key is configured
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Send a prompt to Gemini and get text response
     *
     * @throws \RuntimeException if key missing or API fails
     */
    public function generateText(string $prompt, float $temperature = 0.7): string
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException(
                'GEMINI_API_KEY not set in .env. Add it then run: php artisan config:clear'
            );
        }

        $url = config('services.gemini.endpoint')
             . "/{$this->model}:generateContent"
             . "?key={$this->apiKey}";

        $maxRetries = 3;

        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $response = Http::timeout(60)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($url, [
                        'contents' => [
                            [
                                'parts' => [
                                    ['text' => $prompt]
                                ]
                            ]
                        ],
                        'generationConfig' => [
                            'temperature'     => $temperature,
                            'maxOutputTokens' => $this->maxTokens,
                        ],
                        'safetySettings' => [
                            [
                                'category'  => 'HARM_CATEGORY_HARASSMENT',
                                'threshold' => 'BLOCK_NONE',
                            ],
                            [
                                'category'  => 'HARM_CATEGORY_HATE_SPEECH',
                                'threshold' => 'BLOCK_NONE',
                            ],
                        ],
                    ]);

                if ($response->status() === 429) {
                    // Rate limited — wait and retry
                    $waitSeconds = 60 / $this->rpmLimit * $attempt;
                    Log::channel('seo')->warning(
                        "Gemini rate limited (attempt {$attempt}/{$maxRetries}). "
                        . "Waiting {$waitSeconds}s..."
                    );
                    sleep((int) $waitSeconds);
                    continue;
                }

                if (!$response->successful()) {
                    throw new \RuntimeException(
                        "Gemini API error {$response->status()}: "
                        . $response->body()
                    );
                }

                $data = $response->json();

                // Extract text from Gemini response structure
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

                if (empty($text)) {
                    throw new \RuntimeException(
                        'Gemini returned empty response. Raw: ' . json_encode($data)
                    );
                }

                return trim($text);

            } catch (\RuntimeException $e) {
                if ($attempt === $maxRetries) {
                    throw $e;
                }
                Log::channel('seo')->warning(
                    "Gemini attempt {$attempt} failed: {$e->getMessage()}"
                );
                sleep(5 * $attempt);
            }
        }

        throw new \RuntimeException("Gemini failed after {$maxRetries} retries");
    }

    /**
     * Generate JSON response from Gemini (parses and validates JSON)
     *
     * @throws \RuntimeException if response is not valid JSON
     */
    public function generateJson(string $prompt): array
    {
        $text = $this->generateText($prompt, temperature: 0.3);

        // Remove markdown code fences if present
        $text = preg_replace('/```json\s*/i', '', $text);
        $text = preg_replace('/```\s*/', '', $text);
        $text = trim($text);

        // Find JSON object or array
        if (!str_starts_with($text, '{') && !str_starts_with($text, '[')) {
            // Try to extract JSON from response
            preg_match('/(\{.*\}|\[.*\])/s', $text, $matches);
            $text = $matches[1] ?? $text;
        }

        $data = json_decode($text, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException(
                'Gemini returned invalid JSON: ' . json_last_error_msg()
                . ' | Response: ' . substr($text, 0, 200)
            );
        }

        return $data;
    }

    /**
     * Delay between requests to respect rate limits
     */
    public function respectRateLimit(): void
    {
        // Gemini free tier: 15 RPM = 4 seconds between requests
        $delayMs = (int) (60 / $this->rpmLimit * 1000) + 500; // +500ms buffer
        usleep($delayMs * 1000);
    }
}
```

---

## STEP 4 — UPDATE OpenAIContentGenerator → GeminiContentGenerator

First, show me the existing file:
```bash
cat app/Services/SEO/OpenAIContentGenerator.php
```

Then create the Gemini version:

**File:** `app/Services/SEO/GeminiContentGenerator.php`

```php
<?php

namespace App\Services\SEO;

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
        if ($wordCount < 600) {
            throw new \RuntimeException(
                "Content too thin for {$toolSlug}: {$wordCount} words (minimum 600)"
            );
        }

        return [
            'html'        => $html,
            'model'       => config('services.gemini.model', 'gemini-1.5-flash'),
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
```

---

## STEP 5 — UPDATE SemanticExtractorService → Use Gemini

First show me the current file:
```bash
cat app/Services/SEO/SemanticExtractorService.php
```

Update the `generateAISemantics()` method to use Gemini:

**In SemanticExtractorService.php — replace the OpenAI part:**

```php
// Add to class constructor:
public function __construct(
    private GeminiService $gemini
) {}

// Replace generateAISemantics() method:
private function generateAISemantics(string $toolName, string $slug): array
{
    if (!$this->gemini->isConfigured()) {
        throw new \RuntimeException('GEMINI_API_KEY not configured');
    }

    $prompt = <<<PROMPT
For the tool "{$toolName}" (URL slug: {$slug}), generate semantic SEO keyword data.

Return ONLY a valid JSON object. No explanation, no markdown, no code fences.
Start your response with { and end with }

Required JSON structure:
{
  "lsi_keywords": [
    "semantically related term 1",
    "semantically related term 2",
    "semantically related term 3",
    "semantically related term 4",
    "semantically related term 5"
  ],
  "paa_questions": [
    "How do I use {$toolName}?",
    "What is the formula for [specific concept in this tool]?",
    "What is a good [metric] when using {$toolName}?",
    "When should I use {$toolName}?",
    "What are the limitations of {$toolName}?"
  ],
  "semantic_entities": [
    "Primary concept name",
    "Related technical term",
    "Industry or domain name"
  ],
  "search_intent": "informational",
  "related_searches": [
    "related search 1",
    "related search 2",
    "related search 3"
  ]
}

Rules:
- All questions must be SPECIFIC to "{$toolName}" — not generic
- LSI keywords must be semantically related, not just synonyms
- search_intent must be one of: informational, transactional, navigational, commercial
- Return ONLY the JSON object — nothing before or after it
PROMPT;

    try {
        $data = $this->gemini->generateJson($prompt);
        $this->gemini->respectRateLimit();

        if (empty($data)) {
            throw new \RuntimeException('Gemini returned empty JSON for ' . $slug);
        }

        $keywords = [];

        foreach ($data['lsi_keywords'] ?? [] as $term) {
            if (!empty(trim($term))) {
                $keywords[] = [
                    'keyword'    => trim($term),
                    'type'       => 'lsi',
                    'source'     => 'gemini',
                    'intent'     => 'informational',
                    'confidence' => 0.85,
                ];
            }
        }

        foreach ($data['paa_questions'] ?? [] as $q) {
            if (!empty(trim($q))) {
                $keywords[] = [
                    'keyword'    => trim($q),
                    'type'       => 'paa',
                    'source'     => 'gemini',
                    'intent'     => 'informational',
                    'confidence' => 0.88,
                ];
            }
        }

        foreach ($data['semantic_entities'] ?? [] as $e) {
            if (!empty(trim($e))) {
                $keywords[] = [
                    'keyword'    => trim($e),
                    'type'       => 'entity',
                    'source'     => 'gemini',
                    'intent'     => $data['search_intent'] ?? 'informational',
                    'confidence' => 0.90,
                ];
            }
        }

        foreach ($data['related_searches'] ?? [] as $r) {
            if (!empty(trim($r))) {
                $keywords[] = [
                    'keyword'    => trim($r),
                    'type'       => 'semantic',
                    'source'     => 'gemini',
                    'intent'     => 'informational',
                    'confidence' => 0.80,
                ];
            }
        }

        if (count($keywords) === 0) {
            throw new \RuntimeException('Gemini returned 0 valid keywords for ' . $slug);
        }

        return $keywords;

    } catch (\Exception $e) {
        Log::channel('seo')->error("Gemini semantics failed for {$slug}: {$e->getMessage()}");
        throw $e; // Re-throw — do not silently fail
    }
}
```

---

## STEP 6 — UPDATE SeoGenerateContent Command → Use Gemini

First show me the current command:
```bash
cat app/Console/Commands/SeoGenerateContent.php
```

Find these lines and update them:
```php
// FIND this (OpenAI dependency injection):
public function handle(
    ToolContextExtractor $contextExtractor,
    OpenAIContentGenerator $generator  // ← change this
): int {

// REPLACE WITH:
public function handle(
    ToolContextExtractor $contextExtractor,
    GeminiContentGenerator $generator  // ← Gemini
): int {
```

Also update the API key check at the top of handle():
```php
// FIND:
if (empty(config('services.openai.api_key'))) {
    $this->error('❌ OPENAI_API_KEY not set in .env — aborting');
    return Command::FAILURE;
}

// REPLACE WITH:
if (empty(config('services.gemini.api_key'))) {
    $this->error('❌ GEMINI_API_KEY not set in .env — aborting');
    $this->error('   Add GEMINI_API_KEY=your-key to .env then run: php artisan config:clear');
    return Command::FAILURE;
}
```

---

## STEP 7 — UPDATE SeoExtractSemantics Command → Use Gemini

Find the API key check in the command:
```bash
grep -n "openai\|OPENAI" app/Console/Commands/SeoExtractSemanticsCommand.php
```

Update it:
```php
// FIND:
if (empty(config('services.openai.api_key'))) {
    $this->error('❌ OPENAI_API_KEY not set');
    return Command::FAILURE;
}

// REPLACE WITH:
if (empty(config('services.gemini.api_key'))) {
    $this->error('❌ GEMINI_API_KEY not set in .env — aborting');
    return Command::FAILURE;
}
```

---

## STEP 8 — REGISTER GeminiService in AppServiceProvider

```bash
cat app/Providers/AppServiceProvider.php
```

Add to the `register()` method:
```php
// In register() method — add:
$this->app->singleton(\App\Services\SEO\GeminiService::class);
$this->app->singleton(\App\Services\SEO\GeminiContentGenerator::class);
```

---

## STEP 9 — TEST WITH 3 TOOLS

After all code changes are done:

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Test semantic extraction on 1 tool
php artisan seo:extract-semantics --tool=roi-calculator --force

# Check if PAA data was saved
php artisan tinker --execute="
DB::table('semantic_keywords')
  ->where('tool_slug', 'roi-calculator')
  ->select('keyword_type', 'keyword', 'source')
  ->get()
  ->each(fn(\$r) => print '[' . \$r->keyword_type . '] ' . substr(\$r->keyword, 0, 60) . PHP_EOL);
"
```

Expected output should include:
```
[autocomplete] roi calculator
[autocomplete] roi calculator online
[lsi] return on investment
[lsi] net profit
[paa] How do I use ROI Calculator?
[paa] What is the formula for return on investment?
[entity] Return on Investment
[semantic] roi formula calculator
```

If PAA/LSI/entity rows appear → Gemini is working.

Then test content generation:
```bash
php artisan seo:generate-content --tool=roi-calculator
```

Check result:
```bash
php artisan tinker --execute="
\$d = DB::table('content_drafts')->where('tool_slug', 'roi-calculator')->first();
echo 'Words: ' . \$d->word_count . PHP_EOL;
echo 'Score: ' . \$d->seo_score . PHP_EOL;
echo 'Model: ' . \$d->ai_model_used . PHP_EOL;
echo 'Hash: ' . \$d->generation_prompt_hash . PHP_EOL;
echo 'Preview: ' . substr(strip_tags(\$d->draft_content), 0, 200) . PHP_EOL;
"
```

Expected:
```
Words: 950          ← NOT 118
Score: 85
Model: gemini-1.5-flash
Hash: [unique hash — different for each tool]
Preview: [real article content about ROI calculation]
```

---

## STEP 10 — RUN FULL GENERATION (After Test Passes)

```bash
# Step A: Re-extract semantics for all tools (fill PAA/LSI/entity data)
php artisan seo:extract-semantics --force --batch=10

# Step B: Generate content for all tools (run overnight)
nohup php artisan seo:generate-content --batch=10 > storage/logs/content-generation.log 2>&1 &

# Monitor content generation:
tail -f storage/logs/content-generation.log

# Monitor database progress:
# Run this query every 30 minutes:
# SELECT
#   COUNT(*) as total,
#   SUM(CASE WHEN word_count > 200 THEN 1 ELSE 0 END) as real_content,
#   AVG(word_count) as avg_words,
#   AVG(seo_score) as avg_score
# FROM content_drafts;
```

---

## GEMINI FREE TIER LIMITS — IMPORTANT

```
gemini-1.5-flash (recommended):
- 15 requests per minute (RPM)
- 1 million tokens per minute
- 1,500 requests per day

For 1,417 tools:
- Semantic extraction: ~1,417 API calls ÷ 15 RPM = ~95 minutes
- Content generation: ~1,417 API calls ÷ 15 RPM = ~95 minutes
- Total estimated time: ~3.5 hours (one overnight run)

If you need faster: upgrade to gemini-1.5-pro (paid) or use gemini-2.0-flash
```

**Update `.env` accordingly:**
```env
GEMINI_MODEL=gemini-1.5-flash
GEMINI_RPM_LIMIT=15
```

For paid tier (faster):
```env
GEMINI_MODEL=gemini-2.0-flash
GEMINI_RPM_LIMIT=60
```

---

## VERIFICATION CHECKLIST

```bash
# 1. Config loaded
php artisan tinker --execute="echo config('services.gemini.model');"
# Expected: gemini-1.5-flash

# 2. GeminiService works
php artisan tinker --execute="
app(\App\Services\SEO\GeminiService::class)->generateText('Say hello in 5 words');
" 2>&1 | head -5

# 3. After single tool test:
php artisan tinker --execute="
echo DB::table('semantic_keywords')->where('tool_slug','roi-calculator')->where('keyword_type','paa')->count() . ' PAA questions';
"
# Expected: 5 PAA questions

# 4. After content test:
php artisan tinker --execute="
echo DB::table('content_drafts')->where('tool_slug','roi-calculator')->value('word_count') . ' words';
"
# Expected: 850+ words (NOT 118)

# 5. Confirm unique hashes (no duplicates):
php artisan tinker --execute="
\$total = DB::table('content_drafts')->where('word_count','>',200)->count();
\$unique = DB::table('content_drafts')->where('word_count','>',200)->distinct('generation_prompt_hash')->count('generation_prompt_hash');
echo \"Total: {\$total} | Unique hashes: {\$unique}\";
"
# Expected: Total == Unique (every tool has different content)
```

---

## SUCCESS METRICS AT END OF WEEK

```
DATABASE TARGETS:
□ semantic_keywords paa type: 6,000+ rows
□ semantic_keywords lsi type: 6,000+ rows
□ content_drafts real content: 1,400+ rows (word_count > 700)
□ No two content drafts with same hash
□ Average word count: 900+
□ Average seo_score: 75+

FRONTEND:
□ roi-calculator page shows 900+ word article
□ Related tools section shows 6 relevant tools
□ FAQ section shows 5 PAA questions with schema
□ All FAQPage schema validates in Google Rich Results Test

SEARCH CONSOLE (4-6 weeks later):
□ Impressions +30%
□ New keywords indexed for PAA questions
□ Featured snippets captured for FAQ content
```

---

*Version 5.0 | Google Gemini API integration*
*Replaces all OpenAI calls with Gemini API*
*Model: gemini-1.5-flash (free tier) | RPM: 15 | Daily: 1,500 requests*
*SECURITY: Never share API keys in chat — keep only in .env file*
