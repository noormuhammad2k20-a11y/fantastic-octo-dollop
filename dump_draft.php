<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$d = DB::table('content_drafts')->where('tool_slug','percentage-calculator')->first();
file_put_contents('percent_draft.html', $d->draft_content);
