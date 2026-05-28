@extends('layouts.app')

@section('title', 'Page Not Found — ToolsHub')
@section('meta_description', 'The page you are looking for could not be found. Browse our 1400+ free online tools or search for what you need.')

@section('content')
<section class="error-section py-5 d-flex align-items-center" style="min-height: 75vh; background-color: #ffffff; font-family: 'Inter', sans-serif;">
    <div class="container">
        <div class="row justify-content-center text-center">
            
            <div class="col-lg-8 col-md-10">
                {{-- 404 Visual --}}
                <h1 class="fw-bold mb-2" style="font-size: 8rem; line-height: 1; color: #212529; letter-spacing: -3px;">
                    404
                </h1>
                
                {{-- Divider --}}
                <div class="mx-auto mb-4" style="width: 60px; height: 4px; background-color: #0d6efd;"></div>

                {{-- Content --}}
                <h2 class="fw-bold mb-3" style="color: #212529; font-size: 2rem;">
                    Oops! Page Not Found
                </h2>
                
                <p class="text-secondary mb-5 mx-auto" style="font-size: 1.1rem; line-height: 1.6; max-width: 500px;">
                    The page you're looking for doesn't exist or has been moved. 
                    Try searching for the tool you need, or browse our categories.
                </p>

                {{-- Search Box --}}
                <div class="mb-5 mx-auto" style="max-width: 500px;">
                    <form action="/" method="GET" class="d-flex" onsubmit="event.preventDefault(); window.location='/?q='+encodeURIComponent(document.getElementById('error-search').value);">
                        <div class="input-group input-group-lg shadow-sm">
                            <input type="text" id="error-search" class="form-control border-secondary" placeholder="Search for a tool..." autocomplete="off" style="font-size: 1rem; border-right: none;">
                            <button class="btn border-secondary bg-white text-dark border-left-0" type="submit" style="border-left: none;">
                                <i class="fas fa-search text-muted"></i>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Helpful Links --}}
                <div class="mb-5">
                    <p class="text-uppercase fw-bold text-muted mb-3" style="font-size: 0.85rem; letter-spacing: 1px;">Browse Categories</p>
                    <ul class="list-inline mb-0" style="font-size: 0.95rem;">
                        <li class="list-inline-item mx-2 mb-2"><a href="{{ url('/') }}" class="text-decoration-none" style="color: #0d6efd; font-weight: 500;">Home</a></li>
                        <li class="list-inline-item mx-2 mb-2"><a href="{{ url('/finance') }}" class="text-decoration-none" style="color: #0d6efd; font-weight: 500;">Finance</a></li>
                        <li class="list-inline-item mx-2 mb-2"><a href="{{ url('/health') }}" class="text-decoration-none" style="color: #0d6efd; font-weight: 500;">Health</a></li>
                        <li class="list-inline-item mx-2 mb-2"><a href="{{ url('/text') }}" class="text-decoration-none" style="color: #0d6efd; font-weight: 500;">Text</a></li>
                        <li class="list-inline-item mx-2 mb-2"><a href="{{ url('/calculators') }}" class="text-decoration-none" style="color: #0d6efd; font-weight: 500;">Math</a></li>
                    </ul>
                </div>

                <div class="pt-4 border-top d-inline-block" style="min-width: 300px;">
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        If you believe this is an error, please <a href="{{ route('contact') }}" class="text-decoration-none fw-semibold" style="color: #212529; border-bottom: 1px solid #212529;">contact support</a>.
                    </p>
                </div>
                
            </div>

        </div>
    </div>
</section>

<style>
    /* Strictly light theme, no animations */
    .error-section {
        background-color: #ffffff !important;
    }
    
    .form-control:focus {
        border-color: #6c757d;
        box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.15);
    }
    
    .list-inline-item a:hover {
        color: #0a58ca !important;
        text-decoration: underline !important;
    }
</style>
@endsection
