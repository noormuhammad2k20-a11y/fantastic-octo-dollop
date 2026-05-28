@extends('layouts.app')

@section('title', $tool['title'])
@section('meta_description', $tool['description'] ?? $tool['subtitle'] ?? '')

@section('schema')
    <script type="application/ld+json">
        {!! $schemaMarkup !!}
    </script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            {{-- ════════════ MAIN COLUMN ════════════ --}}
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
                    $breadcrumbItems[] = ['name' => $tool['h1'] ?? ($tool['title'] ?? 'Tool')];
                @endphp
                <div class="mt-4">
                    @include('partials.breadcrumbs', ['items' => $breadcrumbItems])
                </div>

                {{-- Tool Header (Title + Description at TOP) --}}
                <div class="tool-page-header text-center py-4" style="margin-bottom: 1.5rem;">
                    <h1 class="fw-black letter-spacing-tight mb-2">
                        {{ $tool['h1'] ?? ($tool['title'] ?? ($tool['name'] ?? 'Tool')) }}
                    </h1>
                    <p class="subtitle text-secondary fs-5 opacity-75 mx-auto" style="max-width: 700px;">
                        {{ $tool['description'] ?? $tool['subtitle'] ?? '' }}
                    </p>
                </div>
                {{-- AdSense Slot (Configurable) --}}
                <x-ad-slot type="top_banner" />

                {{-- Tool UI Section --}}
                <div class="tool-content" id="upload-content">

                    @if(in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro']))
                        <div class="interactive-tool-container">
                            @include('tools.pro-calculator', ['tool' => $tool])
                        </div>
                    @elseif(($tool['type'] ?? '') === 'interactive' || ($tool['processor'] ?? '') === 'interactive')
                        <div class="interactive-tool-container">
                            @if(View::exists('tools.interactive.' . ($tool['slug'] ?? $slug)))
                                @include('tools.interactive.' . ($tool['slug'] ?? $slug))
                            @else
                                @include('tools.interactive.generic-text-tool')
                            @endif
                        </div>
                    @else
                        {{-- Standard Upload Interface --}}
                        @include('tools.partials.upload_zone', ['tool' => $tool, 'slug' => $slug])
                    @endif

                    @if(($tool['type'] ?? '') !== 'interactive' && ($tool['processor'] ?? '') !== 'interactive' && ($tool['processor'] ?? '') !== 'pro_calculator')
                        {{-- Progress & Result Sections --}}
                        @include('tools.partials.progress_result', ['tool' => $tool])
                    @endif
                </div>

                {{-- Extension CTA (Engagement-Triggered) --}}

                {{-- YMYL Disclaimers (Medical/Finance) --}}
                @include('partials.disclaimers', ['category' => $tool['category'] ?? ''])

                {{-- ════════════ SEO: HOW TO USE ════════════ --}}
                <section class="seo-section">
                    <h2>How to Use This Tool in 3 Steps</h2>
                    <div class="steps-grid">
                        @if(!empty($tool['custom_steps']))
                            @foreach($tool['custom_steps'] as $index => $step)
                                <div class="step-card">
                                    <div class="step-number">{{ $index + 1 }}</div>
                                    <h4>{{ $step['title'] }}</h4>
                                    <p>{{ $step['description'] }}</p>
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

                {{-- Custom SEO Content Override --}}
                @yield('seo_content')

                {{-- Default PROFESSIONAL SEO CONTENT --}}
                @if(!View::hasSection('seo_content'))
                    @include('tools.partials.seo_content')
                @endif


                {{-- Custom FAQ Override --}}
                @yield('faq_content')

                {{-- ════════════ SEO: FAQ ════════════ --}}
                @if(!View::hasSection('faq_content'))
                <section class="seo-section" style="padding-top: 0;">
                    <h2>Frequently Asked Questions</h2>
                    <div class="faq-section">
                        <div class="accordion" id="faqAccordion">
                            @if(!empty($tool['custom_faq']))
                                @foreach($tool['custom_faq'] as $index => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#customFaq{{ $index }}">
                                                {{ $faq['q'] }}
                                            </button>
                                        </h2>
                                        <div id="customFaq{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                {!! $faq['a'] !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq1">
                                            Is this tool really free?
                                        </button>
                                    </h2>
                                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Yes! All tools on ToolsHub are 100% free to use. There are no hidden costs, no
                                            subscriptions, and no signup required. You can process unlimited files.
                                        </div>
                                    </div>
                                </div>
                                @if(($tool['type'] ?? '') !== 'interactive')
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq2">
                                            Are my files secure?
                                        </button>
                                    </h2>
                                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Absolutely. Your files are processed on our secure servers and automatically deleted
                                            after you download the result. We never store, share, or access your file contents.
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($tool['max_size_mb']))
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq3">
                                            What is the maximum file size?
                                        </button>
                                    </h2>
                                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            The maximum file size for this tool is {{ $tool['max_size_mb'] }}MB. If you need to
                                            process larger files, please contact our support team.
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq4">
                                            Do I need to create an account?
                                        </button>
                                    </h2>
                                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            No. ToolsHub does not require any registration or login. 
                                            {{ ($tool['type'] ?? '') === 'interactive' ? 'Simply use the tool' : 'Simply upload your file, process it,' }} 
                                            and get your result. It's that simple.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq5">
                                            Which browsers are supported?
                                        </button>
                                    </h2>
                                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            ToolsHub works on all modern browsers including Google Chrome, Firefox, Safari,
                                            Microsoft Edge, and Opera. It also works perfectly on mobile browsers.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
                @endif

                {{-- Custom Related Tools Override --}}
                @yield('related_tools')
                
                {{-- ════════════ RELATED TOOLS SECTION ════════════ --}}
                @if(!View::hasSection('related_tools'))
                <section class="seo-section related-tools-section" style="padding-top: 0;">
                    <div class="category-header">
                    
                        <div>
                            <h2>Related Tools</h2>
                        </div>
                    </div>

                    <div class="row g-3">
                        @php
                        // Inject slug into the array to preserve it after shuffle() which loses keys
                        $toolsWithSlugs = collect($tools)->map(function($item, $key) {
                            $item['slug'] = $key;
                            return $item;
                        });
                        // Step 1: Same-category tools
                        $related = $toolsWithSlugs->where('category', $tool['category'] ?? 'General')->except($slug)->shuffle()->take(12);

                        // Step 2: Keyword fallback if same-category < 12
                        if ($related->count() < 12) {
                            $keywords = array_filter(explode('-', $slug), fn($w) => !in_array($w, ['to','from','and','of','a','the','in','for']));
                            $keywordMatch = $toolsWithSlugs
                                ->whereNotIn('slug', $related->pluck('slug')->push($slug)->toArray())
                                ->filter(function ($t) use ($keywords) {
                                    foreach ($keywords as $kw) {
                                        if (strlen($kw) >= 3 && str_contains($t['slug'], $kw)) return true;
                                    }
                                    return false;
                                })
                                ->shuffle()
                                ->take(12 - $related->count());
                            $related = $related->merge($keywordMatch);
                        }
                    @endphp
                        @foreach($related as $relTool)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <a href="{{ url('/' . $relTool['slug']) }}" class="tool-card h-100">
                                    <div class="tool-icon">
                                        <i class="{{ $relTool['icon'] ?? 'fas fa-tools' }}"></i>
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
                @endif

                {{-- ════════════ CROSS-CATEGORY LINKS ════════════ --}}
                @include('partials.cross-links')

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @if( ($tool['type'] ?? '') !== 'interactive' && !in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro']) )
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new UploadEngine({
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
                processUrl: "{{ route('tool.process', $slug) }}",
                slug: '{{ $slug }}',
                processor: '{{ $tool['processor'] ?? 'utility' }}',
                acceptedTypes: {!! json_encode(array_filter(explode(',', $tool['accepted_types'] ?? ''))) !!},
                maxSizeMB: {{ $tool['max_size_mb'] ?? 10 }},
                supportsBatch: {{ ($tool['supports_batch'] ?? false) ? 'true' : 'false' }},
            });
        });
    </script>
    @endif
@endpush