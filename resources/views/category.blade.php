@extends('layouts.app')

@section('title', $categoryName . ' Tools — ' . count($categoryTools) . '+ Free Online ' . $categoryName . ' | ToolsHub')
@section('meta_description', 'Access ' . count($categoryTools) . '+ free ' . strtolower($categoryName) . ' tools online. Professional-grade calculators and converters. No signup, no install required. Fast and accurate results.')

@section('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@graph": [
        {
            "@type": "CollectionPage",
            "name": "{{ $categoryName }} Tools",
            "description": "{{ $category['description'] ?? 'Explore our complete collection of high-performance ' . strtolower($categoryName) . ' tools.' }}",
            "url": "{{ url()->current() }}",
            "numberOfItems": {{ count($categoryTools) }},
            "isPartOf": {
                "@type": "WebSite",
                "name": "{{ config('seo.site_name', 'ToolsHub') }}",
                "url": "{{ url('/') }}"
            }
        },
        {
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url('/') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "{{ $categoryName }} Tools",
                    "item": "{{ url()->current() }}"
                }
            ]
        }
    ]
}
</script>
@endsection

@section('content')

    {{-- ════════════ CATEGORY HERO ════════════ --}}
    <section class="hero-section bg-white" style="padding: 40px 0 25px; border-bottom: 1px solid rgba(0,0,0,0.04);">
        <div class="container text-center">
            <div class="d-flex justify-content-center align-items-center flex-column">

                {{-- Breadcrumbs --}}
                <div class="mb-3 w-100 d-flex justify-content-center" style="opacity: 0.8;">
                    @include('partials.breadcrumbs', ['items' => [['name' => $categoryName . ' Tools']]])
                </div>

                <h1 class="mb-3 fw-bold" style="letter-spacing: -0.5px; color: #111827;">{{ $categoryName }} Tools</h1>
                <p class="mb-4" style="max-width: 650px; margin: 0 auto; font-size: 1.1rem; color: #4b5563; line-height: 1.6;">
                    {{ $category['description'] ?? 'Explore our complete collection of high-performance tools in this category. Built for precision and speed.' }}
                </p>
                <div class="mb-1">
                    <span class="badge rounded-pill px-3 py-2 fw-medium" style="background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 0.95rem;">
                        <i class="fas fa-layer-group me-1 opacity-75"></i> {{ count($categoryTools) }} Tools Available
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════ CATEGORY WORKSPACE ════════════ --}}
    <section class="category-section" style="background-color: #f8fafc; padding-top: 35px; padding-bottom: 60px;">
        <div class="container">
            <div class="row">
                
                {{-- Tools Grid --}}
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <h3 class="m-0 fw-bold" id="grid-title">All Tools</h3>
                            <button id="open-all-tools" class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm border-0 d-flex align-items-center" style="transition: all 0.3s ease; height: 32px;">
                                <i class="fas fa-external-link-alt me-2" style="font-size: 0.8rem;"></i>
                                <span class="fw-medium">Open All</span>
                            </button>
                        </div>
                        
                        {{-- In-category Search --}}
                        <div class="input-group shadow-sm rounded-pill flex-grow-1 flex-sm-grow-0" style="max-width: 100%; width: auto; min-width: 250px; overflow: hidden;">
                            <span class="input-group-text bg-white border-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" class="form-control border-0 bg-white" id="category-search" placeholder="Search {{ strtolower($categoryName) }}...">
                        </div>
                    </div>

                    <div class="row g-3" id="category-tools-grid">
                        @if(empty($categoryTools))
                            <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
                                <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                                <h5>No tools found</h5>
                                <p class="text-muted">Check back later or adjust your search.</p>
                            </div>
                        @else
                            @foreach($categoryTools as $key => $tool)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-2 cat-tool-item" data-name="{{ strtolower($tool['h1'] ?? $tool['name'] ?? '') }} {{ strtolower($tool['description'] ?? '') }}">
                                    <a href="{{ url('/' . $key) }}" class="tool-card">
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
                            <div id="cat-no-results" class="col-12 text-center py-5 bg-white rounded-4 shadow-sm d-none">
                                <i class="fas fa-search-minus fa-3x text-muted mb-3"></i>
                                <h5>No tools match your search</h5>
                                <p class="text-muted">Try a different keyword.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════ CATEGORY SEO: HOW THESE TOOLS HELP ════════════ --}}
    <section class="seo-section">
        <div class="container">
            <h2>How {{ $categoryName }} Tools Help You</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-bolt"></i></div>
                    <div>
                        <h5>Instant Results</h5>
                        <p>All {{ count($categoryTools) }} {{ strtolower($categoryName) }} tools deliver real-time calculations and conversions. No waiting, no delays.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <h5>100% Free & Secure</h5>
                        <p>Every tool is completely free with no registration required. Your data is processed securely and never stored.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-mobile-alt"></i></div>
                    <div>
                        <h5>Works Everywhere</h5>
                        <p>Use these tools on any device — desktop, tablet, or mobile. Fully responsive and optimized for all screen sizes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════ RELATED CATEGORIES ════════════ --}}
    @if(isset($categories) && count($categories) > 1)
    <section class="py-4">
        <div class="container">
            <h2 class="mb-3" style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary);">Related Categories</h2>
            <div class="category-hub-grid" style="margin-top: 1rem !important;">
                @php
                    $catsWithSlugs = collect($categories)->map(function($cat, $key) {
                        $cat['slug'] = $key;
                        return $cat;
                    });
                    $siblingCats = $catsWithSlugs->except($slug)->shuffle()->take(4);
                @endphp
                @foreach($siblingCats as $c)
                <a href="{{ route('category.show', ['slug' => $c['slug']]) }}" class="cat-hub-card">
                    <div class="cat-hub-icon {{ $c['color'] ?? 'convert' }}">
                        <i class="{{ $c['icon'] ?? 'fas fa-folder' }}"></i>
                    </div>
                    <span class="cat-hub-name">{{ $c['name'] }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════ YMYL DISCLAIMERS ════════════ --}}
    @include('partials.disclaimers', ['category' => $slug])

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('category-search');
            const items = document.querySelectorAll('.cat-tool-item');
            const noResults = document.getElementById('cat-no-results');
            
            if(searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const query = e.target.value.toLowerCase().trim();
                    let matchCount = 0;

                    items.forEach(item => {
                        const searchKey = item.getAttribute('data-name') || '';
                        if (searchKey.includes(query)) {
                            item.classList.remove('d-none');
                            matchCount++;
                        } else {
                            item.classList.add('d-none');
                        }
                    });

                    if (matchCount === 0 && items.length > 0) {
                        noResults.classList.remove('d-none');
                    } else if (noResults) {
                        noResults.classList.add('d-none');
                    }
                });
            }

            // Simple Tab Interaction for Sidebar
            const tabs = document.querySelectorAll('#sub-category-tabs .nav-link');
            const gridTitle = document.getElementById('grid-title');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active from all
                    tabs.forEach(t => t.classList.remove('active'));
                    tabs.forEach(t => t.classList.add('text-muted'));
                    
                    // Add active to current
                    this.classList.add('active');
                    this.classList.remove('text-muted');
                    
                    const filter = this.getAttribute('data-filter');
                    
                    if (filter === 'all') {
                        gridTitle.innerText = 'All {{ $categoryName }}';
                        // In reality, this would filter by subcategory.
                        // For now we just reset search to show visually something happening.
                        if(searchInput) {
                            searchInput.value = '';
                            searchInput.dispatchEvent(new Event('input'));
                        }
                    } else {
                        gridTitle.innerText = this.innerText.trim() + ' {{ $categoryName }}';
                        // Placeholder behavior for future Sub-category logic...
                    }
                });
            });

            // Open All Tools Feature
            const openAllBtn = document.getElementById('open-all-tools');
            if(openAllBtn) {
                openAllBtn.addEventListener('click', function() {
                    const visibleTools = Array.from(document.querySelectorAll('.cat-tool-item:not(.d-none) a.tool-card'));
                    if (visibleTools.length === 0) return;
                    
                    if (confirm(`Open all ${visibleTools.length} ${visibleTools.length === 1 ? 'tool' : 'tools'} in separate tabs?\n\nNote: Your browser may block multiple popups. If it does, please select "Always allow popups" in the address bar.`)) {
                        visibleTools.forEach((link, index) => {
                            setTimeout(() => {
                                window.open(link.href, '_blank');
                            }, index * 200); // 200ms delay helps browsers manage the sudden load
                        });
                    }
                });
            }
        });
    </script>
    @endpush
@endsection
