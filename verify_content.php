<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$d = DB::table('content_drafts')->where('tool_slug','percentage-calculator')->first();
echo 'Words: '.$d->word_count.' | Score: '.$d->seo_score.PHP_EOL;
echo 'No markdown: '.(!str_contains($d->draft_content,'**') ? 'PASS' : 'FAIL').PHP_EOL;
echo 'No FAQ H2:   '.(!str_contains($d->draft_content,'Frequently Asked') ? 'PASS' : 'FAIL').PHP_EOL;
echo 'No href:     '.(!str_contains($d->draft_content,'href=') ? 'PASS' : 'FAIL').PHP_EOL;
echo 'Has formula: '.(str_contains($d->draft_content,'formula') ? 'PASS' : 'FAIL').PHP_EOL;
echo 'Has limit:   '.(str_contains($d->draft_content,'limitation') ? 'PASS' : 'FAIL').PHP_EOL;
echo 'KW section:  '.(str_contains($d->draft_content,'seo-kw-section') ? 'PASS' : 'FAIL').PHP_EOL;
