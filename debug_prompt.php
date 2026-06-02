<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Services\Seo\ToolContextExtractor;
use App\Services\Seo\GeminiContentGenerator;
use App\Services\Seo\GeminiService;

try {
    $contextExtractor = app(ToolContextExtractor::class);
    $gemini = app(GeminiService::class);
    $generator = app(GeminiContentGenerator::class);
    
    $context = $contextExtractor->extract('roi-calculator');
    
    // Use reflection to get the prompt
    $reflection = new \ReflectionClass(GeminiContentGenerator::class);
    $method = $reflection->getMethod('buildContentPrompt');
    $method->setAccessible(true);
    $prompt = $method->invoke($generator, $context);
    
    echo "Prompt length: " . strlen($prompt) . "\n";
    $gemini->setMaxTokens(6000);
    $response = $gemini->generateText($prompt);
    echo "=== RAW RESPONSE ===\n";
    echo $response;
    echo "\n=== END ===\n";
    
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
