<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tools = config('tools.tools');
$categories = config('tools.categories');

$report = [
    'total_tools' => count($tools),
    'categorized' => [],
    'orphaned' => [],
    'invalid_category' => []
];

foreach ($tools as $slug => $tool) {
    $cat = $tool['category'] ?? null;
    if (!$cat) {
        $report['orphaned'][] = $slug;
    } elseif (!isset($categories[$cat])) {
        $report['invalid_category'][] = $slug . " ($cat)";
    } else {
        $report['categorized'][$cat][] = $slug;
    }
}

file_put_contents(__DIR__ . '/scan_report.json', json_encode($report, JSON_PRETTY_PRINT));
echo "Scan complete. Report saved to scripts/scan_report.json\n";
