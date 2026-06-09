<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$total = DB::table('tool_health_checks')->where('status','ok')->count();
echo '=== TOOLSHUB SEO HEALTH REPORT ==='.PHP_EOL;
echo 'TOOLS: '.$total.PHP_EOL;
echo 'Approved content: '.DB::table('content_drafts')->where('status','approved')->count().PHP_EOL;
echo 'Avg words: '.round(DB::table('content_drafts')->where('status','approved')->avg('word_count')).PHP_EOL;
echo 'Avg score: '.round(DB::table('content_drafts')->where('status','approved')->avg('seo_score')).PHP_EOL;
echo 'Schema FAQ: '.DB::table('content_drafts')->where('draft_type','schema_faq')->where('status','approved')->count().PHP_EOL;
echo 'Internal links: '.DB::table('internal_links')->count().PHP_EOL;
echo 'Topical clusters: '.DB::table('topical_clusters')->count().PHP_EOL;
echo 'Keyword coverage: '.DB::table('semantic_keywords')->where('source','gemini')->distinct('tool_slug')->count('tool_slug').'/'.$total.PHP_EOL;
