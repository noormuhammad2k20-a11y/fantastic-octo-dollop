<?php
$stats = [
    'approved_drafts'   => \App\Models\ContentDraft::where('status','approved')->count(),
    'real_content'      => \App\Models\ContentDraft::where('word_count','>',700)->count(),
    'paa_questions'     => \DB::table('semantic_keywords')->where('keyword_type','paa')->count(),
    'lsi_keywords'      => \DB::table('semantic_keywords')->where('keyword_type','lsi')->count(),
    'internal_links'    => \DB::table('internal_links')->count(),
    'topical_clusters'  => \DB::table('topical_clusters')->count(),
];
foreach($stats as $k => $v) print $k . ': ' . $v . PHP_EOL;
