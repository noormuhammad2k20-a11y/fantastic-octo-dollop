<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$result = DB::table('semantic_keywords')
    ->where('tool_slug','percentage-calculator')
    ->select('keyword_type','source',DB::raw('COUNT(*) as c'))
    ->groupBy('keyword_type','source')
    ->orderBy('keyword_type')
    ->get();

foreach ($result as $r) {
    echo $r->keyword_type . ': ' . $r->c . ' [' . $r->source . ']' . PHP_EOL;
}
echo 'TOTAL: ' . DB::table('semantic_keywords')->where('tool_slug','percentage-calculator')->count() . PHP_EOL;
