<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentDraft;
use Illuminate\Http\Request;

class ContentDraftController extends Controller
{
    /**
     * Display a listing of the content drafts with status tabs.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending_review');

        $drafts = ContentDraft::where('status', $status)
            ->orderByDesc('seo_score')
            ->orderByDesc('word_count')
            ->paginate(30);

        $counts = [
            'pending_review' => ContentDraft::where('status', 'pending_review')->count(),
            'approved'       => ContentDraft::where('status', 'approved')->count(),
            'rejected'       => ContentDraft::where('status', 'rejected')->count(),
        ];

        return view('admin.content-drafts.index', compact('drafts', 'counts', 'status'));
    }

    /**
     * Show the form for editing/reviewing the specified draft.
     */
    public function edit(ContentDraft $contentDraft)
    {
        $draft = $contentDraft;
        $toolConfig = array_merge(config('tools.tools', []), config('pro_calculators', []))[$draft->tool_slug] ?? null;

        return view('admin.content-drafts.edit', compact('draft', 'toolConfig'));
    }

    /**
     * Update the specified draft in storage.
     */
    public function update(Request $request, ContentDraft $contentDraft)
    {
        $validated = $request->validate([
            'status'        => 'required|in:pending_review,approved,rejected',
            'draft_content' => 'nullable|string',
        ]);

        $contentDraft->update([
            'status'        => $validated['status'],
            'draft_content' => $validated['draft_content'] ?? $contentDraft->draft_content,
            'reviewed_by'   => auth()->id(),
            'reviewed_at'   => now(),
            'published_at'  => $validated['status'] === 'approved' ? now() : null,
        ]);

        return redirect()
            ->route('admin.content-drafts.index')
            ->with('success', "Draft {$validated['status']} for {$contentDraft->tool_slug}");
    }

    /**
     * Bulk approve all drafts with seo_score >= threshold
     * Use with caution — review first!
     */
    public function bulkApprove(Request $request)
    {
        $minScore = (int) $request->get('min_score', 70);
        $minWords = (int) $request->get('min_words', 700);

        $count = ContentDraft::where('status', 'pending_review')
            ->where('seo_score', '>=', $minScore)
            ->where('word_count', '>=', $minWords)
            ->whereNotNull('draft_content')
            ->update([
                'status'      => 'approved',
                'reviewed_at' => now(),
                'published_at'=> now(),
            ]);

        return redirect()
            ->route('admin.content-drafts.index', ['status' => 'approved'])
            ->with('success', "Bulk approved {$count} drafts (score >= {$minScore}, words >= {$minWords})");
    }
}
