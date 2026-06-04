@php
    $semanticLinks = \App\Models\InternalLink::from($toolSlug)
        ->active()
        ->byRelevance()
        ->limit(6)
        ->get();
@endphp

@if($semanticLinks->isNotEmpty())
    <div class="related-tools-section mt-5 mb-4">
        <div class="category-header mb-3">
            <div class="cat-icon" style="background: rgba(79, 70, 229, 0.1); color: var(--accent);">
                <i class="fa-solid fa-link"></i>
            </div>
            <div>
                <h3 class="h5 mb-0 fw-bold" style="color: var(--text-primary);">Related Tools</h3>
                <p class="mb-0 text-muted" style="font-size: 0.85rem;">Frequently used with {{ $tool['name'] ?? 'this tool' }}</p>
            </div>
        </div>

        <div class="row g-3">
            @foreach($semanticLinks as $link)
                @php
                    $targetConfig = $link->target_tool_config;
                    if (!$targetConfig) continue;
                    
                    // Generate correct URL
                    $url = isset($targetConfig['is_pro_calculator']) && $targetConfig['is_pro_calculator']
                        ? route('pro.calculator.show', ['slug' => $link->target_tool_slug])
                        : route('tool.show', ['slug' => $link->target_tool_slug]);
                        
                    // Get random anchor text variation to keep profile natural
                    $anchorText = $link->random_anchor;
                @endphp
                <div class="col-md-6 col-lg-4">
                    <a href="{{ $url }}" class="tool-card text-decoration-none">
                        <div class="tool-icon">
                            @if(isset($targetConfig['icon']) && str_contains($targetConfig['icon'], '<i'))
                                {!! $targetConfig ['icon'] !!}
                            @else
                                <i class="{{ $targetConfig['icon'] ?? 'fa-solid fa-wrench' }}"></i>
                            @endif
                        </div>
                        <div class="tool-body">
                            <h4 class="tool-name">{{ $anchorText }}</h4>
                            <p class="tool-desc">{{ Str::limit($targetConfig['description'] ?? '', 60) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
