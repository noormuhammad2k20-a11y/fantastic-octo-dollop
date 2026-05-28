{{-- Cross-Category "You Might Also Need" Widget --}}
@php
    $crossLinker = new \App\Services\CrossLinkerService();
    $crossLinks = cache()->remember(
        'cross_links_' . ($tool['slug'] ?? 'unknown'),
        86400,
        fn() => $crossLinker->getCrossLinks($tool, 3)
    );
@endphp

@if($crossLinks->isNotEmpty())
<aside class="cross-links-section" aria-label="You might also need">
    <div class="container">
        <h3 class="cross-links-title">
            <i class="fas fa-compass"></i>
            You Might Also Need
        </h3>
        <div class="cross-links-grid">
            @foreach($crossLinks as $clSlug => $cl)
                <a href="{{ url('/' . ($cl['slug'] ?? $clSlug)) }}" class="cross-link-card" title="{{ $cl['name'] ?? $cl['h1'] ?? 'Tool' }}">
                    <span class="cross-link-icon">
                        <i class="{{ $cl['icon'] ?? 'fas fa-calculator' }}"></i>
                    </span>
                    <span class="cross-link-info">
                        <span class="cross-link-name">{{ $cl['h1'] ?? $cl['name'] ?? 'Tool' }}</span>
                        <span class="cross-link-cat">
                            {{ config('tools.categories.' . ($cl['category'] ?? '') . '.name', 'Tools') }}
                        </span>
                    </span>
                    <span class="cross-link-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</aside>
@endif
