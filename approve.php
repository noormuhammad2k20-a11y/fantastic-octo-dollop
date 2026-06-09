<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$count = DB::table('content_drafts')
    ->where('status','pending_review')
    ->where('seo_score','>=',75)
    ->whereBetween('word_count',[700,1000])
    ->where('draft_content','not like','%**%')
    ->where('draft_content','not like','%href=%')
    ->update(['status' => 'approved', 'published_at' => now()]);

DB::table('content_drafts')->where('tool_slug','percentage-calculator')->update(['status'=>'approved', 'published_at'=>now()]);

echo 'Approved: '.$count.' drafts (plus percentage-calculator)'.PHP_EOL;

// Identify and regenerate low quality
$slugs = DB::table('content_drafts')
    ->where('status', 'pending_review') // Only regenerate pending ones
    ->where(function($q) {
        $q->where('seo_score','<',70)
           ->orWhere('word_count','<',650)
           ->orWhere('draft_content','like','%**%')
           ->orWhere('draft_content','like','%href=%');
    })
    ->pluck('tool_slug');
echo 'Needs regeneration: '.$slugs->count().PHP_EOL;
DB::table('content_drafts')->whereIn('tool_slug',$slugs)->delete();
