@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-white"><i class="fas fa-pen-nib me-2"></i>SEO Content Drafts</h1>
            <p class="text-white-50 mb-0">Human-review pipeline for AI-generated long-form content</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.monitor.dashboard') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert border-0 mb-4" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
    @endif

    {{-- Status Tabs --}}
    <div class="mb-3 d-flex gap-2 flex-wrap align-items-center">
        <a href="?status=pending_review" class="btn btn-{{ $status === 'pending_review' ? 'primary' : 'outline-primary' }}">
            <i class="fas fa-clock me-1"></i> Pending Review ({{ $counts['pending_review'] }})
        </a>
        <a href="?status=approved" class="btn btn-{{ $status === 'approved' ? 'success' : 'outline-success' }}">
            <i class="fas fa-check me-1"></i> Approved ({{ $counts['approved'] }})
        </a>
        <a href="?status=rejected" class="btn btn-{{ $status === 'rejected' ? 'danger' : 'outline-danger' }}">
            <i class="fas fa-times me-1"></i> Rejected ({{ $counts['rejected'] }})
        </a>
    </div>

    {{-- Bulk Approve Form --}}
    @if($status === 'pending_review' && $counts['pending_review'] > 0)
    <form method="POST" action="{{ route('admin.content-drafts.bulk-approve') }}" class="mb-4 d-inline">
        @csrf
        <input type="hidden" name="min_score" value="70">
        <input type="hidden" name="min_words" value="700">
        <button type="submit" class="btn btn-success"
            onclick="return confirm('Bulk approve all drafts with score >= 70 and words >= 700?')">
            ⚡ Bulk Approve High-Quality Drafts
        </button>
    </form>
    @endif

    <div class="card border-0" style="background: #0f172a;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle">
                    <thead>
                        <tr class="small text-white-50">
                            <th>Tool Slug</th>
                            <th>Words</th>
                            <th>SEO Score</th>
                            <th>Model</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($drafts as $draft)
                        <tr>
                            <td>
                                <a href="/{{ $draft->tool_slug }}" target="_blank" class="text-primary text-decoration-none">
                                    <strong>{{ $draft->tool_slug }}</strong>
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-{{ $draft->word_count >= 700 ? 'success' : 'warning' }}">
                                    {{ $draft->word_count }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $draft->seo_score >= 70 ? 'success' : 'secondary' }}">
                                    {{ $draft->seo_score }}/100
                                </span>
                            </td>
                            <td class="small text-white-50">{{ $draft->ai_model_used }}</td>
                            <td>
                                @if($draft->status === 'pending_review')
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-2">Needs Review</span>
                                @elseif($draft->status === 'approved')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success px-2">Approved</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-2">Rejected</span>
                                @endif
                            </td>
                            <td class="small text-white-50">{{ $draft->updated_at->diffForHumans() }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.content-drafts.edit', $draft) }}"
                                   class="btn btn-sm btn-primary py-0 px-2"><i class="fas fa-edit me-1"></i>Review</a>

                                {{-- Quick approve without editing --}}
                                <form method="POST"
                                      action="{{ route('admin.content-drafts.update', $draft) }}"
                                      class="d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-success py-0 px-2">✓</button>
                                </form>

                                <form method="POST"
                                      action="{{ route('admin.content-drafts.update', $draft) }}"
                                      class="d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger py-0 px-2">✗</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-white-50">
                                <i class="fas fa-inbox mb-3 fs-2 opacity-50"></i>
                                <p class="mb-0">No {{ $status === 'pending_review' ? 'pending' : $status }} drafts found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-3 py-3 border-top" style="border-color: rgba(255,255,255,0.05) !important;">
                {{ $drafts->appends(['status' => $status])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
