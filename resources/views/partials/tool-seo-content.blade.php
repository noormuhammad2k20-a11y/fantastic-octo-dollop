@if($seoDraft && $seoDraft->draft_content)
<section class="tool-seo-content" aria-label="About this tool">
    {{-- E-E-A-T: Article meta (last updated, reviewer) --}}
    @if(isset($contentLastUpdated) && $contentLastUpdated)
    <div class="article-meta">
        <span class="meta-item">
            <i class="fas fa-calendar-check"></i>
            Last updated: {{ \Carbon\Carbon::parse($contentLastUpdated)->format('M d, Y') }}
        </span>
        <span class="meta-item">
            <i class="fas fa-user-check"></i>
            Reviewed for accuracy by the ToolsHub editorial team
        </span>
    </div>
    @endif

    {!! $seoDraft->draft_content !!}

    {{-- Internal Links: Related Calculators (Issue 12 fix) --}}
    {{-- Uses PHP-generated URLs from internal_links table, not AI-generated links --}}
    @if(isset($relatedTools) && $relatedTools->count() > 0)
    <div class="related-calculations">
        <h3>Related Calculators</h3>
        <ul>
            @foreach($relatedTools->take(4) as $link)
            <li>
                <a href="{{ route('tool.show', $link->tool_slug) }}"
                   title="{{ $link->anchor_text_primary }}">
                    {{ $link->anchor_text_primary }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</section>
@endif

{{-- v13: Related Tools section REMOVED — semantic-links.blade.php handles this (prevents duplicate) --}}

@php
    // v12: Load PAA questions with real answers from semantic_keywords table
    $paaData = \Illuminate\Support\Facades\DB::table('semantic_keywords')
        ->where('tool_slug', $slug)
        ->where('keyword_type', 'paa')
        ->where('is_active', 1)
        ->limit(7)
        ->get(['keyword', 'answer']);

    // Decide data source: use DB answers if available, otherwise fall back to $paaQuestions
    $hasPaaData = $paaData->isNotEmpty();
@endphp
@if($hasPaaData || $paaQuestions->isNotEmpty())
<section class="seo-section faq-section mt-5" style="padding-top: 0;" aria-label="Frequently asked questions"
         itemscope itemtype="https://schema.org/FAQPage">
    <h2>Frequently Asked Questions</h2>
    <div class="accordion" id="paaAccordion">
        @if($hasPaaData)
            {{-- v12: Rich FAQ with real answers from database --}}
            @foreach($paaData as $index => $paa)
            <div class="accordion-item"
                 itemscope itemprop="mainEntity"
                 itemtype="https://schema.org/Question">
                <h3 class="accordion-header" id="paaH{{ $index }}">
                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#paaC{{ $index }}"
                            itemprop="name">
                        {{ $paa->keyword }}
                    </button>
                </h3>
                <div id="paaC{{ $index }}"
                     class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                     data-bs-parent="#paaAccordion"
                     itemscope itemprop="acceptedAnswer"
                     itemtype="https://schema.org/Answer">
                    <div class="accordion-body" itemprop="text">
                        {{ $paa->answer ?? 'Based on our ' . ($tool['name'] ?? ucwords(str_replace('-', ' ', $slug))) . ' analysis, this depends on your specific inputs. Use the tool above for accurate, personalized results.' }}
                    </div>
                </div>
            </div>
            @endforeach
        @else
            {{-- Fallback: questions without stored answers --}}
            @foreach($paaQuestions as $index => $question)
            <div class="accordion-item"
                 itemscope itemprop="mainEntity"
                 itemtype="https://schema.org/Question">
                <h3 class="accordion-header" id="paaH{{ $index }}">
                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#paaC{{ $index }}"
                            itemprop="name">
                        {{ $question }}
                    </button>
                </h3>
                <div id="paaC{{ $index }}"
                     class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                     data-bs-parent="#paaAccordion"
                     itemscope itemprop="acceptedAnswer"
                     itemtype="https://schema.org/Answer">
                    <div class="accordion-body" itemprop="text">
                        Based on our {{ $tool['name'] ?? ucwords(str_replace('-', ' ', $slug)) }} analysis, this depends on your specific inputs. Use the tool above for accurate, personalized results.
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</section>
@endif

{{-- v13: Related Search Terms — only long-tail keywords, not tool names --}}
@php
    $searchChips = \Illuminate\Support\Facades\DB::table('semantic_keywords')
        ->where('tool_slug', $slug)
        ->whereIn('keyword_type', ['long_tail', 'informational', 'comparison'])
        ->where('is_active', 1)
        ->where('keyword', 'not like', '% calculator')  // exclude tool names
        ->where('keyword', 'not like', '% tool')
        ->where('keyword', 'not like', '% generator')
        ->orderByDesc('confidence_score')
        ->limit(10)
        ->pluck('keyword');
@endphp

@if($searchChips->isNotEmpty())
<section style="margin-top:1.5rem;padding:1rem 0;">
    <p style="font-size:0.8rem;font-weight:600;color:#6b7280;text-transform:uppercase;
              letter-spacing:.06em;margin:0 0 0.6rem;">Related Searches</p>
    <div style="display:flex;flex-wrap:wrap;gap:0.5rem;">
        @foreach($searchChips as $chip)
        <span style="display:inline-block;padding:0.3rem 0.75rem;background:#f3f4f6;
                     border:1px solid #e5e7eb;border-radius:20px;font-size:0.82rem;
                     color:#374151;cursor:default;">
            {{ $chip }}
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
