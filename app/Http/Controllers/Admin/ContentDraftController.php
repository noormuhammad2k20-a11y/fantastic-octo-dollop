<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentDraft;
use Illuminate\Http\Request;

class ContentDraftController extends Controller
{
    /**
     * Display a listing of the content drafts.
     */
    public function index()
    {
        $drafts = ContentDraft::orderByRaw("FIELD(status, 'pending_review', 'published', 'rejected')")
            ->orderByDesc('updated_at')
            ->paginate(20);

        return view('admin.content-drafts.index', compact('drafts'));
    }

    /**
     * Show the form for editing/reviewing the specified draft.
     */
    public function edit(ContentDraft $draft)
    {
        $toolConfig = array_merge(config('tools.tools', []), config('pro_calculators', []))[$draft->tool_slug] ?? null;
        
        return view('admin.content-drafts.edit', compact('draft', 'toolConfig'));
    }

    /**
     * Update the specified draft in storage.
     */
    public function update(Request $request, ContentDraft $draft)
    {
        // HOTFIX-1.0: Use correct DB column name 'draft_content' not 'generated_content'
        $validated = $request->validate([
            'draft_content' => 'required|string',
            'status' => 'required|in:pending_review,approved,published,rejected',
        ]);

        $validated['published_at'] = $validated['status'] === 'published' ? now() : null;
        // HOTFIX-1.0: Track reviewer timestamp
        if (in_array($validated['status'], ['approved', 'published', 'rejected'])) {
            $validated['reviewed_at'] = now();
        }

        $draft->update($validated);

        return redirect()->route('admin.content-drafts.index')
            ->with('success', "Draft for {$draft->tool_slug} updated successfully.");
    }
}
