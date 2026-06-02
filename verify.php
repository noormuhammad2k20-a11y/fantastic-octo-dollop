<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$d = DB::table('content_drafts')->where('tool_slug','roi-calculator')->first();
if (!$d) {
    echo "No draft found for roi-calculator\n";
    exit;
}
echo 'Words: ' . $d->word_count . PHP_EOL;
echo 'Score: ' . $d->seo_score . PHP_EOL;
echo 'Has keyword section: ' . (str_contains($d->draft_content, 'target-keywords-section') ? 'YES ✅' : 'NO ❌') . PHP_EOL;
echo 'Has benchmarks: ' . (str_contains($d->draft_content, 'Benchmark') || str_contains($d->draft_content, 'benchmark') ? 'YES ✅' : 'NO ❌') . PHP_EOL;
echo 'Has limitations: ' . (str_contains($d->draft_content, 'Limitation') || str_contains($d->draft_content, 'limitation') ? 'YES ✅' : 'NO ❌') . PHP_EOL;
echo 'Forbidden phrases: ' . (str_contains($d->draft_content, 'paramount') ? 'FOUND ❌' : 'CLEAN ✅') . PHP_EOL;
echo PHP_EOL . 'Content preview (first 500 chars):' . PHP_EOL;
echo substr(strip_tags($d->draft_content), 0, 500);
