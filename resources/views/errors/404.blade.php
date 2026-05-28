@extends('layouts.app')

@section('title', 'Page Not Found — ToolsHub')
@section('meta_description', 'The page you are looking for could not be found. Browse our 1400+ free online tools or search for what you need.')

@section('content')
<section class="hero-section" style="padding: 80px 0 60px;">
    <div class="container text-center">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50vh;">
            
            {{-- Animated 404 Icon --}}
            <div class="mb-4" style="font-size: 5rem; opacity: 0.15;">
                <i class="fas fa-ghost"></i>
            </div>
            
            <h1 class="fw-black mb-3" style="font-size: clamp(3rem, 10vw, 6rem); letter-spacing: -3px;">
                4<span class="text-gradient">0</span>4
            </h1>
            
            <h2 class="fw-bold mb-3" style="font-size: clamp(1.2rem, 3vw, 1.5rem);">
                Oops! Page Not Found
            </h2>
            
            <p class="lead text-secondary mx-auto mb-4" style="max-width: 500px;">
                The page you're looking for doesn't exist or has been moved. 
                Try searching for the tool you need, or browse our categories.
            </p>

            {{-- Search Bar --}}
            <div class="hero-search mb-5" style="max-width: 500px; width: 100%;">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="error-search" placeholder="Search for a tool..." autocomplete="off" 
                    onkeypress="if(event.key==='Enter'){window.location='/?q='+encodeURIComponent(this.value)}">
            </div>

            {{-- Quick Links --}}
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                <a href="{{ url('/') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-home me-2"></i>Go Home
                </a>
                <a href="{{ url('/finance') }}" class="btn btn-outline-secondary rounded-pill px-3">
                    <i class="fas fa-calculator me-2"></i>Finance Tools
                </a>
                <a href="{{ url('/health') }}" class="btn btn-outline-secondary rounded-pill px-3">
                    <i class="fas fa-heart-pulse me-2"></i>Health Tools
                </a>
                <a href="{{ url('/text') }}" class="btn btn-outline-secondary rounded-pill px-3">
                    <i class="fas fa-font me-2"></i>Text Tools
                </a>
                <a href="{{ url('/calculators') }}" class="btn btn-outline-secondary rounded-pill px-3">
                    <i class="fas fa-square-root-alt me-2"></i>Math Tools
                </a>
            </div>

            <p class="text-muted small">
                If you believe this is an error, please <a href="{{ route('contact') }}" class="text-decoration-underline">contact us</a>.
            </p>
        </div>
    </div>
</section>

<style>
    .text-gradient {
        background: linear-gradient(135deg, var(--accent, #e94560) 0%, #ff8c00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection
