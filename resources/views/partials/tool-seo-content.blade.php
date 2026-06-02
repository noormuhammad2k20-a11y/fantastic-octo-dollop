@if($seoDraft && $seoDraft->draft_content)
<section class="tool-seo-content" aria-label="About this tool">
    {!! $seoDraft->draft_content !!}
</section>
@endif

@if($relatedTools->isNotEmpty())
<section class="seo-section related-tools-section mt-5" style="padding-top: 0;" aria-label="Related tools">
    <div class="category-header">
        <div>
            <h2>Related Tools You Might Need</h2>
        </div>
    </div>
    <div class="row g-3">
        @foreach($relatedTools as $rt)
            @php
                // Find the tool definition from config/tools.php to get icon/description
                // We assume $tools array is available in the view (passed from controller)
                $relToolConfig = $tools[$rt->tool_slug] ?? null;
            @endphp
            @if($relToolConfig)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <a href="{{ url('/' . $rt->tool_slug) }}" class="tool-card h-100" title="{{ $rt->anchor_text_primary }}">
                    <div class="tool-icon">
                        <i class="{{ $relToolConfig['icon'] ?? 'fas fa-tools' }}"></i>
                    </div>
                    <div class="tool-body">
                        <h3 class="tool-name">{{ $rt->anchor_text_primary }}</h3>
                        <p class="tool-desc">{{ mb_strimwidth($relToolConfig['description'] ?? $relToolConfig['subtitle'] ?? '', 0, 80, '...') }}</p>
                    </div>
                    <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            @endif
        @endforeach
    </div>
</section>
@endif

@if($paaQuestions->isNotEmpty())
<section class="seo-section faq-section mt-5" style="padding-top: 0;" aria-label="Frequently asked questions"
         itemscope itemtype="https://schema.org/FAQPage">
    <h2>Frequently Asked Questions</h2>
    <div class="accordion" id="paaAccordion">
        @foreach($paaQuestions as $index => $question)
        <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h3 class="accordion-header" itemprop="name" id="paaHeading{{ $index }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#paaCollapse{{ $index }}" aria-expanded="false" aria-controls="paaCollapse{{ $index }}">
                    {{ $question }}
                </button>
            </h3>
            <div id="paaCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="paaHeading{{ $index }}" data-bs-parent="#paaAccordion" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div class="accordion-body" itemprop="text">
                    See our detailed guide above for the complete answer regarding this topic.
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- Related Search Terms from semantic_keywords --}}
@if(isset($longTailTerms) && $longTailTerms->isNotEmpty())
<section class="seo-section related-searches-section mt-4" style="padding:1rem 0;">
    <h3 style="font-size:0.9rem;font-weight:600;color:#666;text-transform:uppercase;letter-spacing:.05em;">
        Related Searches
    </h3>
    <div class="d-flex flex-wrap gap-2 mt-2">
        @foreach($longTailTerms->merge($relatedTerms ?? collect()) as $term)
        <span class="badge bg-light text-dark border" style="font-weight:400;font-size:0.82rem;padding:0.35rem 0.7rem;">
            {{ $term }}
        </span>
        @endforeach
    </div>
</section>
@endif

{{-- Entity / Knowledge Graph Section --}}
@if(isset($entityTerms) && $entityTerms->isNotEmpty())
<section class="seo-section entity-section mt-3" style="padding:0.5rem 0;">
    <meta itemprop="about" content="{{ $entityTerms->implode(', ') }}">
</section>
@endif
