<?php

namespace App\Services\Seo;

use App\Models\ContentDraft;
use App\Models\SemanticKeyword;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContentGenerationService
{
    private string $openAiKey;
    private string $model;

    public function __construct()
    {
        // HOTFIX-1.0: Use config() instead of env() for proper caching
        $this->openAiKey = config('services.openai.api_key', '');
        $this->model = config('services.openai.model', 'gpt-4o');
    }

    /**
     * Generate an SEO content draft for a specific tool.
     */
    public function generateDraftForTool(string $toolSlug, array $toolConfig): ?ContentDraft
    {
        $keywords = SemanticKeyword::forTool($toolSlug)
            ->active()
            ->orderByDesc('confidence_score')
            ->limit(20)
            ->get();

        if (empty($this->openAiKey)) {
            // Mock Fallback for local testing without an API Key
            $mockHtml = $this->generateMockContent($toolSlug, $toolConfig, $keywords);
            return $this->saveDraft($toolSlug, $mockHtml);
        }


        if ($keywords->isEmpty()) {
            Log::warning("No semantic keywords found for {$toolSlug}. Skipping content generation.");
            return null;
        }

        $keywordList = $keywords->pluck('keyword')->implode(', ');
        $clusters = $keywords->pluck('keyword_type')->unique()->implode(', ');

        $prompt = $this->buildPrompt($toolSlug, $toolConfig, $keywordList, $clusters);

        try {
            // HOTFIX-1.0: Use rate-limited API call with retry logic
            $content = $this->callOpenAIWithRateLimit($prompt);

            // Clean up any markdown blocks if the LLM adds them
            $content = preg_replace('/```html\n?/', '', $content);
            $content = preg_replace('/```/', '', $content);

            return $this->saveDraft($toolSlug, $content);

        } catch (\Exception $e) {
            Log::error("Content Generation Error for {$toolSlug}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * HOTFIX-1.0: Call OpenAI API with rate-limit protection and retry logic.
     */
    private function callOpenAIWithRateLimit(string $prompt): ?string
    {
        $maxRetries = (int) config('seo.openai.max_retries', 3);
        $delayMs = (int) config('seo.openai.delay_between_requests_ms', 3000);
        $retryDelaySec = (int) config('seo.openai.retry_delay_seconds', 60);
        $attempt = 0;

        while ($attempt < $maxRetries) {
            try {
                // HOTFIX-1.0: Delay between requests to avoid rate limiting
                usleep($delayMs * 1000);

                $response = Http::withToken($this->openAiKey)
                    ->timeout(180)
                    ->post('https://api.openai.com/v1/chat/completions', [
                        'model' => $this->model,
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are an expert technical SEO content writer. Generate comprehensive, highly-structured, and helpful HTML content.'],
                            ['role' => 'user', 'content' => $prompt]
                        ],
                        'temperature' => 0.4,
                    ]);

                if ($response->successful()) {
                    return $response->json('choices.0.message.content');
                }

                // HOTFIX-1.0: Handle 429 rate limit specifically
                if ($response->status() === 429) {
                    $attempt++;
                    Log::warning("OpenAI rate limited (429). Waiting {$retryDelaySec}s. Attempt {$attempt}/{$maxRetries}");
                    sleep($retryDelaySec);
                    continue;
                }

                Log::error("OpenAI API failed: HTTP {$response->status()} - " . $response->body());
                return null;

            } catch (\Exception $e) {
                if (str_contains($e->getMessage(), '429')) {
                    $attempt++;
                    Log::warning("OpenAI rate limited (exception). Waiting {$retryDelaySec}s. Attempt {$attempt}/{$maxRetries}");
                    sleep($retryDelaySec);
                } else {
                    throw $e; // Non-rate-limit errors bubble up
                }
            }
        }

        throw new \RuntimeException("OpenAI rate limit exceeded after {$maxRetries} retries");
    }

    /**
     * Build the LLM prompt.
     */
    private function buildPrompt(string $toolSlug, array $config, string $keywords, string $clusters): string
    {
        $toolName = $config['name'] ?? $toolSlug;
        $description = $config['description'] ?? '';

        return <<<EOT
Write a comprehensive, SEO-optimized "How-to" and "Guide" section for the tool "{$toolName}".
Tool Description: {$description}

You MUST naturally incorporate the following semantic keywords and concepts:
{$keywords}

Related topics to cover: {$clusters}

Format Requirements:
1. Return ONLY pure HTML. Do not use <html>, <head>, or <body> tags. Just the content to be injected into a container.
2. Use professional HTML5 semantic tags (<section>, <h2>, <h3>, <ul>, <strong>).
3. Do NOT use <h1> (the page already has one). Start with <h2>.
4. Include a detailed "How it Works" section.
5. Include a "Use Cases" or "Examples" section.
6. Make it helpful, engaging, and authoritative. Avoid generic fluff.
EOT;
    }

    /**
     * Generate mock HTML content when no API key is available.
     */
    private function generateMockContent(string $toolSlug, array $config, $keywords): string
    {
        $toolName = $config['name'] ?? $toolSlug;
        $keywordList = $keywords->isEmpty() ? 'No semantic keywords found' : $keywords->pluck('keyword')->implode(', ');
        
        return <<<HTML
<h2>Ultimate Guide: How to Use {$toolName}</h2>
<p>This is a <strong>mock-generated SEO draft</strong> because the <code>OPENAI_API_KEY</code> was not found in your <code>.env</code> file. However, this perfectly demonstrates how the content injection works.</p>

<h3>How it Works</h3>
<p>Our tool processes your data locally, ensuring complete privacy. When we run our NLP algorithms, we identified the following semantic keywords that should naturally appear here:</p>
<ul>
    <li>{$keywordList}</li>
</ul>

<h3>Use Cases & Examples</h3>
<p>Whether you're an expert or a beginner, {$toolName} makes your workflow incredibly efficient.</p>
<ul>
    <li><strong>Scenario 1:</strong> Automating repetitive manual calculations.</li>
    <li><strong>Scenario 2:</strong> Quickly formatting and validating data on the fly.</li>
</ul>

<p><em>To see real LLM-generated content here, simply add your OPENAI_API_KEY to the .env file and run the generation command again.</em></p>
HTML;
    }

    /**
     * HOTFIX-1.0: Save the generated content using correct column names.
     * Uses updateOrCreate to prevent duplicate drafts per tool_slug.
     */
    private function saveDraft(string $toolSlug, string $content): ContentDraft
    {
        return ContentDraft::updateOrCreate(
            ['tool_slug' => $toolSlug], // HOTFIX-1.0: Unique key prevents duplicates
            [
                'draft_type'             => 'full_article',
                'status'                 => 'pending_review',
                'draft_content'          => $content,
                'ai_model_used'          => $this->model,
                'generation_prompt_hash' => md5('Standard SEO Guide Prompt v1'),
                'word_count'             => str_word_count(strip_tags($content)),
            ]
        );
    }
}
