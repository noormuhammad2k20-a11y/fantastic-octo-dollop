<?php
$count = \App\Models\ContentDraft::where('status', 'pending_review')
    ->where('word_count', '>', 500)
    ->update([
        'status' => 'approved',
        'reviewed_at' => now(),
        'published_at' => now(),
    ]);
echo "Approved: {$count} drafts\n";
