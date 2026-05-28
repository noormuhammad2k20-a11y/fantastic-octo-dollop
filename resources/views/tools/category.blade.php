@extends('layouts.app')

@section('title', $category['name'] . ' — Free Online ' . $category['name'])
@section('meta_description', $category['description'] . '. Fast, secure, and 100% free online tools.')

@section('content')

    {{-- ════════════ CATEGORY HERO ════════════ --}}
    <section class="hero-section" style="padding: 60px 0;">
        <div class="container text-center">
            <div class="cat-icon {{ $category['color'] ?? 'convert' }} mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 20px; color: white;">
                <i class="{{ $category['icon'] }}"></i>
            </div>
            <h1>{{ $category['name'] }}</h1>
            <p class="lead">{{ $category['description'] }}</p>
        </div>
    </section>

    {{-- ════════════ TOOLS LISTING ════════════ --}}
    <section class="category-section" style="padding-top: 0;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="m-0 fw-bold">Available Tools</h3>
                <button id="open-all-tools" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm border-0 d-flex align-items-center" style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); transition: all 0.3s ease; height: 32px;">
                    <i class="fas fa-external-link-alt me-2" style="font-size: 0.8rem;"></i>
                    <span class="fw-medium">Open All</span>
                </button>
            </div>
            <div class="row g-4">
                @foreach($categoryTools as $toolSlug => $tool)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ url('/' . $toolSlug) }}" class="tool-card">
                            <div class="tool-icon">
                                <i class="{{ $tool['icon'] }}"></i>
                            </div>
                            <div class="tool-body">
                                <h3 class="tool-name">{{ $tool['h1'] }}</h3>
                                <p class="tool-desc">{{ $tool['description'] }}</p>
                            </div>
                            <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ════════════ TRUST SECTION (Simplified) ════════════ --}}
    <section class="seo-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>Professional Grade {{ $category['name'] }}</h2>
                    <p>Our tools are designed to provide high-quality results without the complexity of professional software. Whether you're converting, compressing, or editing, we’ve got you covered.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Always free, no signup required</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> High-speed cloud processing</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Secure & Private: Files deleted hourly</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="features-grid" style="grid-template-columns: 1fr;">
                        <div class="feature-item">
                            <div class="f-icon"><i class="fas fa-shield-alt"></i></div>
                            <div>
                                <h5>Privacy First</h5>
                                <p>We value your privacy. All uploaded files are processed securely and purged automatically from our servers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openAllBtn = document.getElementById('open-all-tools');
        if(openAllBtn) {
            openAllBtn.addEventListener('click', function() {
                const links = Array.from(document.querySelectorAll('.tool-card'));
                if (links.length === 0) return;
                
                if (confirm(`Open all ${links.length} ${links.length === 1 ? 'tool' : 'tools'} in separate tabs?\n\nNote: Your browser may block multiple popups.`)) {
                    links.forEach((link, index) => {
                        setTimeout(() => {
                            window.open(link.href, '_blank');
                        }, index * 200);
                    });
                }
            });
        }
    });
</script>
@endpush
