<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Services\Seo\ToolContextExtractor;
use App\Services\Seo\GeminiContentGenerator;

try {
    $contextExtractor = app(ToolContextExtractor::class);
    $generator = app(GeminiContentGenerator::class);
    $context = $contextExtractor->extract('roi-calculator');
    echo "Context extracted. Generating...\n";
    $content = $generator->generateForTool($context);
    echo "Word count: " . $content['word_count'] . "\n";
    echo "Dump: " . substr(strip_tags($content['html']), 0, 500) . "\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
