@extends('layouts.app')

@section('title', 'ToolsHub — ' . $totalToolsCount . '+ Free Online File Converters, Calculators & Tools')
@section('meta_description', 'Access ' . $totalToolsCount . '+ free online tools. From advanced financial calculators and clinical medical tools to high-speed video converters. Fast, secure, and no signup required.')

@section('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebSite",
            "name": "{{ config('seo.site_name', 'ToolsHub') }}",
            "url": "{{ url('/') }}",
            "description": "Access {{ $totalToolsCount }}+ free online tools including calculators, converters, and compressors. No signup required.",
            "publisher": {
                "@type": "Organization",
                "name": "{{ config('seo.organization.name', 'ToolsHub') }}",
                "url": "{{ url('/') }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset(config('seo.organization.logo', 'images/logo.png')) }}"
                }
            },
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ url('/') }}?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        },
        {
            "@type": "CollectionPage",
            "name": "{{ $totalToolsCount }}+ Free Online Tools",
            "url": "{{ url('/') }}",
            "description": "Professional-grade calculators, converters, and compressors designed for speed, precision, and reliable performance.",
            "numberOfItems": {{ $totalToolsCount }}
        }
    ]
}
</script>
@endsection

@section('content')

    {{-- ════════════ HERO SECTION ════════════ --}}
    <section class="hero-section">
        <div class="container">
            <h1>
                {{ $totalToolsCount }}+ Professional Tools,<br class="d-none d-md-inline">
                All in One Platform.
            </h1>
            <p class="lead">
                Professional-grade calculators, converters, and compressors designed for speed, precision, and reliable performance.
            </p>

            <div class="hero-search">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="tool-search" placeholder="Search {{ $totalToolsCount }}+ tools... (e.g. mortgage, gfr, roi)"
                    autocomplete="off">
            </div>

            {{-- ════════════ CATEGORY NAVIGATION HUB ════════════ --}}
            <div class="category-hub-grid mt-5" id="category-hub">
                @foreach($categories as $catId => $category)
                    @php
                        $count = $categoryCounts[$catId] ?? 0;
                    @endphp
                    @if($count > 0)
                        <a href="{{ route('category.show', ['slug' => $catId]) }}" class="cat-hub-card">
                            <div class="cat-hub-icon {{ $category['color'] ?? 'convert' }}">
                                <i class="{{ $category['icon'] }}"></i>
                            </div>
                            <span class="cat-hub-name">{{ $category['name'] }}</span>
                            <span class="cat-hub-count">{{ $count }} Tools</span>
                        </a>
                    @endif
                @endforeach
            </div>

            <div id="no-results" class="text-center mt-5 mb-5 d-none w-100">
                <div class="py-5 px-4 bg-white rounded-4 shadow-sm border border-light" style="max-width: 600px; margin: 0 auto;">
                    <div class="d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px; background-color: #eff6ff; border-radius: 50%;">
                        <i class="fas fa-search" style="font-size: 2rem; color: #3b82f6;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">No tools found</h4>
                    <p class="text-muted mb-4 px-md-5" style="font-size: 1.05rem;">We couldn't find any tools matching your search. Try adjusting your keywords or explore our categories below.</p>
                    <button class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-medium" onclick="document.getElementById('tool-search').value = ''; document.getElementById('tool-search').dispatchEvent(new Event('input'));">
                        <i class="fas fa-redo-alt me-2"></i> Clear Search
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════ MOST POPULAR TOOLS ════════════ --}}
    @if(count($popularTools) > 0)
    <section class="category-section" id="popular-tools">
        <div class="container">
            <div class="category-header">
                <div class="cat-icon utils">
                    <i class="fas fa-fire text-danger"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2">
                        <h2 class="m-0">Most Popular Tools</h2>
                        <span class="badge bg-danger border rounded-pill">Top {{ count($popularTools) }}</span>
                    </div>
                    <p class="m-0 text-muted">A handpicked selection of our most frequently used utilities.</p>
                </div>
            </div>

            <div class="row g-2 g-md-3">
                @foreach($popularTools as $slug => $tool)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ url('/' . $slug) }}" class="tool-card">
                            <div class="tool-icon">
                                <i class="{{ $tool['icon'] ?? 'fas fa-tools' }}"></i>
                            </div>
                            <div class="tool-body">
                                <h3 class="tool-name">{{ $tool['h1'] ?? $tool['name'] ?? 'Tool' }}</h3>
                                <p class="tool-desc">{{ $tool['description'] ?? '' }}</p>
                            </div>
                            <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════ SEARCH RESULTS SECTION (Live Filtering Target) ════════════ --}}
    <section id="search-results-section" class="category-section d-none">
        <div class="container">
            <div class="category-header">
                <div class="cat-icon utils">
                    <i class="fas fa-search"></i>
                </div>
                <div>
                    <h2>Search Results</h2>
                    <p id="search-stats"></p>
                </div>
            </div>
            <div class="row g-3" id="search-results-grid">
                {{-- Dynamic results injected here by JavaScript --}}
            </div>
        </div>
    </section>

    {{-- ════════════ TRUST SECTION ════════════ --}}
    <section class="seo-section">
        <div class="container">
            <h2>Why Choose ToolsHub?</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-lock"></i></div>
                    <div>
                        <h5>100% Secure</h5>
                        <p>Files are processed on the server and automatically deleted after download. Your privacy matters.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-bolt"></i></div>
                    <div>
                        <h5>Lightning Fast</h5>
                        <p>Powered by high-performance servers. Most files are processed in under 10 seconds.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-globe"></i></div>
                    <div>
                        <h5>{{ $totalToolsCount }}+ Pro Tools</h5>
                        <p>From advanced financial calculators to high-speed file converters, we have it all.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-infinity"></i></div>
                    <div>
                        <h5>100% Free</h5>
                        <p>No hidden costs, no subscriptions, no signup. All tools are completely free to use.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-magic"></i></div>
                    <div>
                        <h5>High Quality</h5>
                        <p>Advanced algorithms ensure the best output quality for every conversion and compression.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-headset"></i></div>
                    <div>
                        <h5>24/7 Available</h5>
                        <p>Our tools are always available. Process files anytime, day or night.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('tool-search');
            const categoryHub = document.getElementById('category-hub');
            const popularSection = document.getElementById('popular-tools');
            const searchResultsSection = document.getElementById('search-results-section');
            const searchResultsGrid = document.getElementById('search-results-grid');
            const searchStats = document.getElementById('search-stats');
            const noResults = document.getElementById('no-results');

            // Inject the lightweight JS tools array from PHP (Does not add heavy DOM overhead)
            const allTools = @json($searchTools);

            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase().trim();

                if (query.length < 2) {
                    categoryHub.classList.remove('d-none');
                    if (popularSection) popularSection.classList.remove('d-none');
                    searchResultsSection.classList.add('d-none');
                    noResults.classList.add('d-none');
                    return;
                }

                // Filter the light JS array
                const matches = allTools.filter(tool => {
                    const searchStr = (tool.name + ' ' + (tool.description || '')).toLowerCase();
                    return searchStr.includes(query);
                });

                categoryHub.classList.add('d-none');
                if (popularSection) popularSection.classList.add('d-none');
                searchResultsSection.classList.remove('d-none');
                
                if (matches.length > 0) {
                    noResults.classList.add('d-none');
                    // Build cards on the fly
                    searchResultsGrid.innerHTML = matches.map(tool => `
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="${window.location.pathname.replace(/\/+$/, '')}/${tool.slug}" class="tool-card">
                                <div class="tool-icon">
                                    <i class="${tool.icon || 'fas fa-tools'}"></i>
                                </div>
                                <div class="tool-body">
                                    <h3 class="tool-name">${tool.name}</h3>
                                    <p class="tool-desc">${tool.description || ''}</p>
                                </div>
                                <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                            </a>
                        </div>
                    `).join('');
                    searchStats.textContent = `Found ${matches.length} tool${matches.length === 1 ? '' : 's'} matching "${query}"`;
                } else {
                    searchResultsSection.classList.add('d-none');
                    noResults.classList.remove('d-none');
                }
            });

            // Clear search if escape is pressed
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && document.activeElement === searchInput) {
                    searchInput.value = '';
                    searchInput.dispatchEvent(new Event('input'));
                    searchInput.blur();
                }
            });
        });
    </script>
    @endpush
@endsection