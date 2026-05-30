@extends('layouts.app')

@section('content')
<div class="container py-5">

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

    <div class="card border-0" style="background: #0f172a;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle">
                    <thead>
                        <tr class="small text-white-50">
                            <th>Tool Slug</th>
                            <th>Status</th>
                            <th>Quality Score</th>
                            <th>Last Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($drafts as $draft)
                        <tr>
                            <td>
                                <strong class="text-white">{{ $draft->tool_slug }}</strong>
                            </td>
                            <td>
                                @if($draft->status === 'pending_review')
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-2">Needs Review</span>
                                @elseif($draft->status === 'published')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success px-2">Published</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-2">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress" style="width: 60px; height: 6px; background: rgba(255,255,255,0.1);">
                                        <div class="progress-bar {{ $draft->quality_score >= 8 ? 'bg-success' : 'bg-warning' }}" style="width: {{ $draft->quality_score * 10 }}%"></div>
                                    </div>
                                    <span class="ms-2 small text-white-50">{{ number_format($draft->quality_score, 1) }}</span>
                                </div>
                            </td>
                            <td class="small text-white-50">{{ $draft->updated_at->diffForHumans() }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.content-drafts.edit', $draft) }}" class="btn btn-sm btn-primary py-0 px-2">
                                    <i class="fas fa-edit me-1"></i> Review
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-white-50">
                                <i class="fas fa-inbox mb-3 fs-2 opacity-50"></i>
                                <p class="mb-0">No content drafts found.</p>
                                <p class="small">Run <code>php artisan seo:generate-content</code> to create some.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-3 py-3 border-top" style="border-color: rgba(255,255,255,0.05) !important;">
                {{ $drafts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
