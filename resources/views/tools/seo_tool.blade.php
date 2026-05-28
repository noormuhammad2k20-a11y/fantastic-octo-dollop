@extends('layouts.app')

@section('title', $tool['title'])
@section('meta_description', $tool['description'] ?? $tool['subtitle'] ?? '')
@section('canonical', url($page['canonical'] ?? $slug))

@if(in_array($tool['category'] ?? '', ['video', 'audio', 'image']))
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/media-tools.css') }}">
    @endpush
@endif

@section('schema')
@if(!empty($schemaMarkup))
<script type="application/ld+json">
{!! $schemaMarkup !!}
</script>
@endif
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                {{-- Breadcrumbs --}}
                @php
                    $categoryData = config('tools.categories')[$tool['category'] ?? ''] ?? null;
                    $breadcrumbItems = [];
                    if ($categoryData) {
                        $breadcrumbItems[] = [
                            'name' => $categoryData['name'],
                            'url' => url('/' . ($tool['category'] ?? ''))
                        ];
                    }
                    $breadcrumbItems[] = ['name' => $tool['h1']];
                @endphp
                <div class="mt-4">
                    @include('partials.breadcrumbs', ['items' => $breadcrumbItems])
                </div>

                {{-- SEO Optimized Header (TOP) --}}
                <div class="tool-page-header text-center py-2" style="margin-bottom: 0.5rem;">
                    <h1 class="fw-black letter-spacing-tight mb-1" style="font-size: clamp(1.2rem, 5vw, 2rem);">
                        {{ $tool['h1'] ?? $tool['title'] ?? 'Tool' }}
                    </h1>
                    <p class="subtitle text-secondary fs-7 mx-auto px-3 mb-0" style="max-width: 600px; font-size: 0.85rem;">
                        {{ $tool['description'] ?? $tool['subtitle'] ?? '' }}
                    </p>
                </div>

                {{-- AdSense Slot (Configurable) --}}
                <x-ad-slot type="top_banner" />

                {{-- Embedded Tool Interface --}}
                <div class="tool-content" id="upload-content">

                    @if(in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro']))
                        <div class="interactive-tool-container">
                            @include('tools.pro-calculator', ['tool' => $tool])
                        </div>
                    @elseif(($tool['processor'] ?? '') === 'fraction')
                        <div class="interactive-tool-container">
                            @include('tools.fraction-tool', ['tool' => $tool])
                        </div>
                    @elseif(($tool['type'] ?? '') === 'interactive' || ($tool['processor'] ?? '') === 'interactive')
                        <div class="interactive-tool-container">
                            @if(View::exists('tools.interactive.' . ($tool['slug'] ?? $slug)))
                                @include('tools.interactive.' . ($tool['slug'] ?? $slug))
                            @else
                                @include('tools.interactive.generic-text-tool')
                            @endif
                        </div>
                    @elseif(in_array($tool['category'] ?? '', ['video', 'audio', 'image']))
                        @include('tools.partials.media_tool_rebuilt', ['tool' => $tool])
                    @else
                        {{-- Standard Upload Interface --}}
                        @include('tools.partials.upload_zone', ['tool' => $tool, 'slug' => $tool['slug']])
                        {{-- Progress & Result Sections --}}
                        @include('tools.partials.progress_result', ['tool' => $tool])
                    @endif
                </div>

                {{-- Extension CTA (Engagement-Triggered) --}}

                {{-- YMYL Disclaimers (Medical/Finance) --}}
                @include('partials.disclaimers', ['category' => $tool['category'] ?? ''])
                {{-- ════════════ SEO: HOW TO USE ════════════ --}}
                <section class="seo-section">
                    <h2>How to Use {{ $tool['h1'] }} in 3 Easy Steps</h2>
                    <div class="steps-grid">
                        @if(!empty($tool['custom_steps']))
                            @foreach($tool['custom_steps'] as $index => $step)
                                <div class="step-card">
                                    <div class="step-number">{{ $index + 1 }}</div>
                                    <h4>{{ $step['title'] }}</h4>
                                    <p>{{ $step['description'] }}</p>
                                </div>
                            @endforeach
                        @elseif(!empty($tool['instructions']) && is_array($tool['instructions']))
                            @foreach(array_slice($tool['instructions'], 0, 3) as $index => $step)
                                <div class="step-card">
                                    <div class="step-number">{{ $index + 1 }}</div>
                                    <h4>Step {{ $index + 1 }}</h4>
                                    <p>{{ $step }}</p>
                                </div>
                            @endforeach
                        @elseif(($tool['type'] ?? '') === 'interactive' || in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro']))
                            <div class="step-card">
                                <div class="step-number">1</div>
                                <h4>Enter Your Data</h4>
                                <p>Provide the input values, text, or configuration in the interactive workspace above.</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">2</div>
                                <h4>Real-Time Results</h4>
                                <p>The tool will process your input instantly. You can see the results update as you type.</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">3</div>
                                <h4>Analyze or Copy</h4>
                                <p>Once satisfied with the result, copy the data or analysis directly from the results panel.</p>
                            </div>
                        @else
                            <div class="step-card">
                                <div class="step-number">1</div>
                                <h4>Upload Your File</h4>
                                <p>Drag and drop your file into the upload zone above, or click to browse from your device.</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">2</div>
                                <h4>Configure Options</h4>
                                <p>Adjust the settings based on your needs: quality, format, or dimensions, then click "Process File".</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">3</div>
                                <h4>Download Result</h4>
                                <p>Once processing is complete, check the results and click the "Download" button to save your file.</p>
                            </div>
                        @endif
                    </div>
                </section>


                {{-- ════════════ SEO: FAQ ════════════ --}}
                <section class="seo-section" style="padding-top: 0;">
                    <h2>Frequently Asked Questions</h2>
                    <div class="faq-section">
                        <div class="accordion" id="faqAccordion">
                            @foreach($tool['faq'] as $index => $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}">
                                            {{ $item['q'] ?? $item['question'] ?? '' }}
                                        </button>
                                    </h2>
                                    <div id="faq{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            {{ $item['a'] ?? $item['answer'] ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>



                {{-- ════════════ RELATED TOOLS SECTION ════════════ --}}
                <section class="seo-section related-tools-section" style="padding-top: 0;">
                    <div class="category-header">
                        <h2>Related {{ $tool['category'] ?? 'Tools' }}</h2>
                    </div>

                    <div class="row g-2 g-md-3">
                        @foreach($relatedTools as $relSlug => $relTool)
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="{{ url('/' . $relSlug) }}" class="tool-card">
                                    <div class="tool-icon">
                                        <i class="{{ $relTool['icon'] }}"></i>
                                    </div>
                                    <div class="tool-body">
                                        <h3 class="tool-name">{{ $relTool['h1'] ?? $relTool['title'] ?? 'Tool' }}</h3>
                                        <p class="tool-desc">{{ $relTool['description'] ?? $relTool['subtitle'] ?? '' }}</p>
                                    </div>
                                    <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- ════════════ CROSS-CATEGORY LINKS ════════════ --}}
                @include('partials.cross-links')

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @if(($tool['type'] ?? '') !== 'interactive' && !in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro', 'media']) && !in_array($tool['category'] ?? '', ['video', 'audio', 'image']))
    <script src="{{ asset('js/upload-engine.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const engine = new UploadEngine({
                dropZone: '#upload-zone',
                fileInput: '#file-input',
                processBtn: '#btn-process',
                optionsPanel: '#tool-options',
                progressSection: '#progress-section',
                progressFill: '#progress-fill',
                progressPercent: '#progress-percent',
                statusText: '#status-text',
                resultSection: '#result-section',
                uploadContent: '#upload-content',
                processUrl: "{{ route('tool.process', $tool['slug']) }}",
                slug: '{{ $tool['slug'] }}',
                acceptedTypes: {!! isset($tool['accepted_types']) ? json_encode(array_filter(explode(',', $tool['accepted_types']))) : '[]' !!},
                maxSizeMB: {{ $tool['max_size_mb'] ?? 500 }},
                supportsBatch: {{ ($tool['supports_batch'] ?? false) ? 'true' : 'false' }},
            });

            {{-- Auto-apply target values from SEO config if present --}}
            @if(isset($page['default_options']))
                const targets = {!! json_encode($page['default_options']) !!};
                Object.keys(targets).forEach(key => {
                    const el = document.getElementById('opt-' + key);
                    if (el) {
                        if (el.type === 'range') {
                            el.value = targets[key];
                            const valEl = el.closest('.slider-group').querySelector('.slider-value');
                            if (valEl) valEl.textContent = targets[key] + '%';
                        } else if (el.type === 'checkbox') {
                            el.checked = targets[key];
                        } else {
                            el.value = targets[key];
                        }
                    }
                });
            @endif
        });
    </script>
    @endif
@endpush

<style>
    .professional-seo-content h2 { font-weight: 700; font-size: clamp(1.4rem, 5vw, 2rem); letter-spacing: -0.5px; }
    .professional-seo-content .seo-text-content { font-size: 1.05rem; text-align: justify; }
    @media (max-width: 576px) { .professional-seo-content .seo-text-content { text-align: left; font-size: 1rem; } }
    .text-gradient { background: linear-gradient(135deg, var(--accent) 0%, #ff8c00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

    /* ── Distributed Highlight Cards (Professional/Clean) ── */
    .seo-highlight-row { margin: 2rem 0; }
    .highlight-card-simple {
        background: var(--card-bg, #f8f9fa);
        border: 1px solid #e9ecef;
        border-left: 4px solid var(--card-border, #6c757d);
        border-radius: 8px;
        padding: 1.25rem 1.5rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .highlight-card-simple:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .hc-icon-static {
        width: 42px; height: 42px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
    }
    .hc-title-clean {
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 0.25rem;
        color: #1a1a2e;
    }
    .hc-text-clean {
        font-size: 0.95rem;
        line-height: 1.5;
        color: #4b5563;
        margin: 0;
    }
    @media (max-width: 767px) {
        .highlight-card-simple { padding: 1.25rem; }
        .hc-icon-static { width: 36px; height: 36px; font-size: 1rem; }
    }
</style>
