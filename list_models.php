<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;

$key = config('services.gemini.api_key');
$response = Http::get("https://generativelanguage.googleapis.com/v1beta/models?key={$key}");
echo $response->body();
