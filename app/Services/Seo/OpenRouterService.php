<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * OpenRouterService — OpenAI-compatible API client for OpenRouter.
 *
 * Drop-in replacement for GeminiService. Uses the same public interface
 * so all existing generators (GeminiContentGenerator, etc.) can switch
 * by simply swapping the injected dependency.
 *
 * Endpoint: https://openrouter.ai/api/v1/chat/completions
 * Auth:     Bearer {OPENROUTER_API_KEY}
 * Format:   OpenAI chat completions (messages array → choices array)
 */
class OpenRouterService
{
    private string $apiKey;
    private string $model;
    private int    $maxTokens;
    private int    $rpmLimit;
    private string $endpoint;

    public function __construct()
    {
        $this->apiKey    = config('services.openrouter.api_key', '');
        $this->model     = config('services.openrouter.model', 'anthropic/claude-sonnet-4.6');
        $this->maxTokens = config('services.openrouter.max_tokens', 6000);
        $this->rpmLimit  = config('services.openrouter.rpm_limit', 15);
        $this->endpoint  = config('services.openrouter.endpoint', 'https://openrouter.ai/api/v1/chat/completions');
    }

    /**
     * Check if API key is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Override max tokens for longer content generation.
     */
    public function setMaxTokens(int $tokens): void
    {
        $this->maxTokens = $tokens;
    }

    /**
     * Send a prompt to OpenRouter and get text response.
     *
     * Uses OpenAI-compatible chat completions format.
     *
     * @throws \RuntimeException if key missing or API fails
     */
    public function generateText(string $prompt, float $temperature = 0.7): string
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException(
                'OPENROUTER_API_KEY not set in .env. Add it then run: php artisan config:clear'
            );
        }

        $maxRetries = 3;

        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $response = Http::timeout(120)
                    ->withHeaders([
                        'Content-Type'   => 'application/json',
                        'Authorization'  => 'Bearer ' . $this->apiKey,
                        'HTTP-Referer'   => config('app.url', 'http://localhost'),
                        'X-Title'        => config('app.name', 'ToolsHub'),
                    ])
                    ->post($this->endpoint, [
                        'model'    => $this->model,
                        'messages' => [
                            [
                                'role'    => 'system',
                                'content' => 'You are a precise SEO expert. Follow all definitions exactly as given. Return only what is explicitly requested.',
                            ],
                            [
                                'role'    => 'user',
                                'content' => $prompt,
                            ],
                        ],
                        'temperature'  => $temperature,
                        'max_tokens'   => $this->maxTokens,
                    ]);

                if ($response->status() === 429) {
                    $waitSeconds = 30;
                    Log::channel('seo')->warning(
                        "OpenRouter rate limited (attempt {$attempt}/{$maxRetries}). "
                        . "Waiting {$waitSeconds}s..."
                    );
                    sleep($waitSeconds);
                    continue;
                }

                if (!$response->successful()) {
                    throw new \RuntimeException(
                        "OpenRouter API error {$response->status()}: "
                        . $response->body()
                    );
                }

                $data = $response->json();

                // OpenAI-compatible response: choices[0].message.content
                $text = $data['choices'][0]['message']['content'] ?? '';

                if (empty($text)) {
                    throw new \RuntimeException(
                        'OpenRouter returned empty response. Raw: ' . json_encode($data)
                    );
                }

                return trim($text);

            } catch (\RuntimeException $e) {
                if ($attempt === $maxRetries) {
                    throw new \RuntimeException(
                        "OpenRouter failed after {$maxRetries} retries. Last error: " . $e->getMessage()
                    );
                }
                echo "OpenRouter attempt {$attempt} failed: " . $e->getMessage() . "\n";
                Log::channel('seo')->warning(
                    "OpenRouter attempt {$attempt} failed: {$e->getMessage()}"
                );
                sleep(5 * $attempt);
            }
        }

        throw new \RuntimeException("OpenRouter failed after {$maxRetries} retries");
    }

    /**
     * Send a prompt and parse the response as JSON.
     */
    public function generateJson(string $prompt): array
    {
        $text = $this->generateText($prompt, temperature: 0.2);

        // Remove all markdown artifacts
        $text = preg_replace('/^```[a-z]*\s*/im', '', $text);
        $text = preg_replace('/```\s*$/im', '', $text);
        $text = trim($text);

        // Try to isolate JSON object
        $firstBrace = strpos($text, '{');
        $lastBrace  = strrpos($text, '}');

        if ($firstBrace !== false && $lastBrace !== false) {
            $text = substr($text, $firstBrace, $lastBrace - $firstBrace + 1);
        }

        $data = json_decode($text, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::channel('seo')->error(
                'OpenRouter JSON parse failed: ' . json_last_error_msg() .
                ' | Raw response: ' . substr($text, 0, 500)
            );
            throw new \RuntimeException(
                'OpenRouter returned invalid JSON: ' . json_last_error_msg()
            );
        }

        if (empty($data)) {
            throw new \RuntimeException('OpenRouter returned empty JSON object');
        }

        return $data;
    }

    /**
     * Delay between requests to respect rate limits.
     */
    public function respectRateLimit(): void
    {
        $delayMs = (int) (60 / $this->rpmLimit * 1000) + 500; // +500ms buffer
        usleep($delayMs * 1000);
    }
}
