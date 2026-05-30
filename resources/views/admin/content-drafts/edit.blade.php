@extends('layouts.app')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow {
        background: #1e293b;
        border-color: rgba(255,255,255,0.1);
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }
    .ql-toolbar.ql-snow .ql-stroke { stroke: #e2e8f0; }
    .ql-toolbar.ql-snow .ql-fill { fill: #e2e8f0; }
    .ql-toolbar.ql-snow .ql-picker { color: #e2e8f0; }
    .ql-container.ql-snow {
        background: #0f172a;
        border-color: rgba(255,255,255,0.1);
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
        min-height: 400px;
        color: #f8fafc;
        font-family: inherit;
        font-size: 1rem;
    }
    .ql-editor { padding: 1.5rem; }
    .ql-editor h2, .ql-editor h3 { color: #fff; margin-top: 1.5rem; margin-bottom: 1rem; }
    .ql-editor p { margin-bottom: 1rem; line-height: 1.6; }
</style>
@endpush

@section('content')
<div class="container py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-white">
                <i class="fas fa-edit me-2"></i>Review Draft: <span class="text-primary">{{ $toolConfig['name'] ?? $draft->tool_slug }}</span>
            </h1>
            <p class="text-white-50 mb-0">Edit and publish the AI-generated SEO content</p>
        </div>
        <div>
            <a href="{{ route('admin.content-drafts.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-times me-1"></i> Cancel
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Main Editor Column --}}
        <div class="col-lg-8">
            <div class="card border-0 mb-4" style="background: #0f172a;">
                <div class="card-body p-4">
                    <form action="{{ route('admin.content-drafts.update', $draft) }}" method="POST" id="draftForm">
                        @csrf
                        @method('PUT')
                        
                        {{-- HOTFIX-1.0: Use correct DB column name --}}
                        <input type="hidden" name="draft_content" id="hiddenContent">

                        <div class="mb-4">
                            <label class="form-label text-white-50 small text-uppercase fw-bold">HTML Content</label>
                            {{-- HOTFIX-1.0: Use correct DB column name --}}
                            <div id="editor-container">{!! $draft->draft_content !!}</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
                            <div>
                                <select name="status" class="form-select bg-dark text-white border-0" style="width: 150px;">
                                    <option value="pending_review" {{ $draft->status === 'pending_review' ? 'selected' : '' }}>Draft</option>
                                    <option value="approved" {{ $draft->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="published" {{ $draft->status === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="rejected" {{ $draft->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary px-4" id="saveBtn">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Context Column --}}
        <div class="col-lg-4">
            {{-- Target Keywords --}}
            <div class="card border-0 mb-4" style="background: #0f172a;">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h6 class="text-white mb-0"><i class="fas fa-bullseye me-2 text-warning"></i>Target Keywords Used</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        {{-- HOTFIX-1.0: Query actual semantic_keywords table instead of non-existent column --}}
                        @php
                            $semanticKws = \App\Models\SemanticKeyword::where('tool_slug', $draft->tool_slug)
                                ->where('is_active', true)
                                ->orderByDesc('confidence_score')
                                ->limit(15)
                                ->pluck('keyword');
                        @endphp
                        @forelse($semanticKws as $kw)
                            <span class="badge bg-secondary bg-opacity-25 text-white-50 border border-secondary border-opacity-25" style="font-weight: normal;">
                                {{ $kw }}
                            </span>
                        @empty
                            <span class="text-white-50 small">No semantic keywords extracted yet.</span>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Metadata Info --}}
            <div class="card border-0" style="background: #0f172a;">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h6 class="text-white mb-0"><i class="fas fa-info-circle me-2 text-info"></i>Draft Metadata</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small text-white-50 mb-0">
                        <li class="mb-2 d-flex justify-content-between border-bottom pb-2" style="border-color: rgba(255,255,255,0.05) !important;">
                            <span>Created</span>
                            <strong class="text-white">{{ $draft->created_at->format('M d, Y H:i') }}</strong>
                        </li>
                        <li class="mb-2 d-flex justify-content-between border-bottom pb-2" style="border-color: rgba(255,255,255,0.05) !important;">
                            <span>Last Edited</span>
                            <strong class="text-white">{{ $draft->updated_at->format('M d, Y H:i') }}</strong>
                        </li>
                        <li class="mb-0 d-flex justify-content-between border-bottom pb-2" style="border-color: rgba(255,255,255,0.05) !important;">
                            <span>Model</span>
                            <strong class="text-white">{{ $draft->ai_model_used ?? 'gpt-4o' }}</strong>
                        </li>
                        @if($draft->published_at)
                        <li class="mt-2 pt-2 d-flex justify-content-between text-success">
                            <span>Published On</span>
                            <strong>{{ $draft->published_at->format('M d, Y') }}</strong>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [2, 3, 4, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['clean']
                ]
            }
        });

        // Sync Quill HTML content to hidden input before submit
        var form = document.getElementById('draftForm');
        form.onsubmit = function() {
            var html = document.querySelector('#editor-container .ql-editor').innerHTML;
            document.getElementById('hiddenContent').value = html;
        };
    });
</script>
@endpush
