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
        $this->model     = config('services.gemini.model', 'gemini-2.5-flash');
        $this->maxTokens = config('services.gemini.max_tokens', 4000);
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
                $text = '';
                $parts = $data['candidates'][0]['content']['parts'] ?? [];
                foreach ($parts as $part) {
                    $text .= $part['text'] ?? '';
                }

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
