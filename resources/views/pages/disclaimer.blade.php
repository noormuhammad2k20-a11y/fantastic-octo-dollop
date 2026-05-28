@extends('layouts.app')

@section('title', 'Disclaimer — ToolsHub Accuracy and Reliability')
@section('meta_description', 'Read our disclaimer regarding the accuracy, reliability, and use of the 1500+ free online tools provided by ToolsHub. We provide tools for informational purposes.')

@section('content')
<div class="vip-page-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-10 col-md-12">
                
                {{-- ════════════ VIP HERO HEADER ════════════ --}}
                <div class="text-center mb-5 animate-up">
                    <span class="badge badge-vip mb-3">Disclaimer Scope</span>
                    <h1 class="display-6 fw-black text-dark mb-3">Disclaimer</h1>
                    <p class="text-secondary small mb-0 fw-semibold">Last Updated: April 11, 2026</p>
                </div>

                {{-- ════════════ VIP MAIN CARD ════════════ --}}
                <div class="vip-card shadow-sm p-4 p-md-5 bg-white rounded-4 border animate-up-delay-1">
                    <p class="lead text-secondary mb-5" style="line-height: 1.6; font-size: 1.05rem;">
                        Please read this disclaimer document thoroughly before executing scripts or applying values calculated on ToolsHub.
                    </p>

                    <hr class="my-5 opacity-25">

                    {{-- SECTION: GENERAL --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">General Information Disclaimer</h4>
                        <p class="text-secondary">
                            The calculations, file modifications, and utility results provided by <strong>ToolsHub</strong> ("we," "us," or "our") on <strong>https://toolshub.com</strong> (the "Site") are intended strictly for general educational and informational purposes. All operations on the Site are provided in good faith. 
                        </p>
                        <p class="text-secondary mb-0">
                            However, we present no warranties or representation of any kind, express or implied, regarding the validity, adequacy, reliability, availability, or complete accuracy of any computational output generated on the Site.
                        </p>
                    </div>

                    {{-- SECTION: EXTERNAL LINKS --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">1. External Links Disclaimer</h4>
                        <p class="text-secondary">
                            The Site may contain (or you may be redirected to) links leading to third-party web structures or external contents. Such external URLs are not routinely checked, monitored, or audited for validity, security, or complete reliability by our team.
                        </p>
                        <p class="text-secondary mb-0">
                            We do not endorse or take responsibility for the security of any information compiled by third-party sites linked through ToolsHub.
                        </p>
                    </div>

                    {{-- SECTION: PROFESSIONAL DISCLAIMER --}}
                    <div class="mb-5">
                        <div class="alert alert-warning-vip border-0 p-4 rounded-4 mb-4">
                            <div class="d-flex align-items-start">
                                <div class="alert-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                                    <i class="fas fa-exclamation-triangle fs-6"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-warning-dark">2. Professional Disclaimer</h6>
                                    <p class="mb-0 text-warning-secondary small">
                                        The Site does not offer financial, tax, legal, or medical advice. The information is generated as estimated output metrics based on generic standard models. 
                                        Before making major choices based upon calculated parameters, we strongly advise consulting with qualified, certified professional advisors. Relying on site outputs is executed strictly at your own hazard.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION: TOOLS --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">3. Tools and Calculations</h4>
                        <p class="text-secondary">
                            Our web-based tools utilize standard mathematical formulas, algebraic equations, and processing libraries. While our engineering team works continuously to refine operations and test against standard criteria:
                        </p>
                        <ul class="custom-check-list text-secondary mt-3">
                            <li>We present no guarantees that every calculation output is completely flawless or bug-free.</li>
                            <li>ToolsHub holds no liability for financial damages, data corruptions, or project delays stemming from calculations run on our platform.</li>
                            <li>Users are encouraged to verify critical data with secondary professional tools before deployment.</li>
                        </ul>
                    </div>

                    {{-- SECTION: ADVERTISING --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">4. Advertising Disclaimer</h4>
                        <p class="text-secondary mb-0">
                            ToolsHub is sustained through digital advertising placements. We collaborate with Google AdSense and third-party advertising companies to serve custom non-obtrusive banners. These platforms may utilize cookie files and anonymous usage telemetry to display personalized marketing materials based on your browsing patterns.
                        </p>
                    </div>

                    {{-- SECTION: OMISSIONS --}}
                    <div class="mb-0">
                        <h4 class="fw-bold text-dark mb-3">5. Errors and Omissions</h4>
                        <p class="text-secondary">
                            While we compile materials and update script libraries continuously to match technical developments:
                        </p>
                        <p class="text-secondary mb-4">
                            ToolsHub is not responsible for inadvertent bugs, syntax limits, computational errors, or omissions inside files or numeric calculations processed on the Site.
                        </p>

                        <div class="card bg-light border-0 p-4 rounded-4 mt-4 border border-light">
                            <h6 class="fw-bold text-dark mb-2">Have a question regarding our Disclaimer?</h6>
                            <p class="small text-secondary mb-0">Reach out directly to our operations team by sending an email request to: <a href="mailto:support@toolshub.com" class="text-primary text-decoration-none fw-bold">support@toolshub.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .vip-page-wrapper {
        background-color: #f8fafc;
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }
    
    /* Badges & Titles */
    .badge-vip {
        background: #f1f5f9;
        color: #475569;
        padding: 0.6rem 1.2rem;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.75px;
        text-transform: uppercase;
        border-radius: 100px;
        border: 1px solid #e2e8f0;
    }
    .fw-black {
        font-weight: 900;
        letter-spacing: -1.25px;
    }

    /* VIP main card */
    .vip-card {
        border-color: #e2e8f0 !important;
        border-radius: 20px !important;
    }
    
    p {
        line-height: 1.75;
        font-size: 0.95rem;
    }

    /* Lists */
    .custom-check-list {
        list-style: none;
        padding-left: 0;
    }
    .custom-check-list li {
        margin-bottom: 0.75rem;
        padding-left: 1.75rem;
        position: relative;
        font-size: 0.95rem;
    }
    .custom-check-list li::before {
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        color: #2563eb;
        font-size: 0.85rem;
        top: 2px;
    }

    /* Warning Premium Banner */
    .alert-warning-vip {
        background: #fffbeb;
        border: 1px solid rgba(245, 158, 11, 0.15) !important;
    }
    .text-warning-dark {
        color: #78350f;
    }
    .text-warning-secondary {
        color: #92400e;
    }

    /* Animations */
    .animate-up {
        animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .animate-up-delay-1 {
        opacity: 0;
        animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.1s forwards;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
