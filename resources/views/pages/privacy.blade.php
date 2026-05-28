@extends('layouts.app')

@section('title', 'Privacy Policy — ToolsHub')

@section('content')
<div class="vip-page-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-10 col-md-12">
                
                {{-- ════════════ VIP HERO HEADER ════════════ --}}
                <div class="text-center mb-5 animate-up">
                    <span class="badge badge-vip mb-3">Legal Agreement</span>
                    <h1 class="display-6 fw-black text-dark mb-3">Privacy Policy</h1>
                    <p class="text-secondary small mb-0 fw-semibold">Last Updated: March 15, 2026</p>
                </div>

                {{-- ════════════ VIP MAIN CARD ════════════ --}}
                <div class="vip-card shadow-sm p-4 p-md-5 bg-white rounded-4 border animate-up-delay-1">
                    <p class="lead text-secondary mb-5" style="line-height: 1.6; font-size: 1.05rem;">
                        At ToolsHub, we prioritize absolute transparency and data protection. This policy outlines how we process and safeguard your information to guarantee a secure experience across our entire catalog of utilities.
                    </p>

                    <hr class="my-5 opacity-25">

                    {{-- SECTION: CONTROLLER --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">Owner and Data Controller</h4>
                        <div class="card bg-light border-0 p-4 rounded-4 border border-light">
                            <p class="mb-1 text-dark fw-bold">ToolsHub Global Operations</p>
                            <p class="mb-1 text-secondary small">Headquarters: New Delhi, India</p>
                            <p class="mb-0 small"><strong>Contact Email:</strong> <a href="mailto:privacy@toolshub.online" class="text-primary text-decoration-none fw-bold">privacy@toolshub.online</a></p>
                        </div>
                    </div>

                    {{-- SECTION: DATA TYPES --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">Types of Data Collected</h4>
                        <p class="text-secondary">Among the types of Personal Data that this Application collects, by itself or through trusted third parties, there are: Cookies, Web Usage Statistics, and uniquely, the <strong>temporary files</strong> you upload.</p>
                        <ul class="custom-check-list text-secondary mt-3">
                            <li><strong>Uploaded Documents:</strong> Files processed through our converters, calculators, or image encoders.</li>
                            <li><strong>Usage Telemetry:</strong> Collected automatically through page interactions (IP address, browser type, timestamps).</li>
                            <li><strong>Inbound Communications:</strong> Name and email addresses shared when requesting technical support.</li>
                        </ul>
                    </div>

                    {{-- SECTION: PROCESSING MODE --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">Mode and Place of Processing</h4>
                        <h6 class="fw-bold mt-4 text-dark">Methods of Processing</h6>
                        <p class="text-secondary">The Owner takes strict physical, digital, and operational security measures to prevent unauthorized data leakages, access, or modifications. Uploads are processed in isolated, memory-resident containers. We do not inspect, parse, or use user uploads for AI training or profiling.</p>
                        
                        <h6 class="fw-bold mt-4 text-dark">Place</h6>
                        <p class="text-secondary mb-0">All processing is executed at cloud-based server structures (primarily AWS Northern Virginia and Frankfurt clusters) and at other regional servers where processing nodes are located.</p>
                    </div>

                    {{-- SECTION: RETENTION --}}
                    <div class="mb-5">
                        <div class="alert alert-warning-vip border-0 p-4 rounded-4 mb-4">
                            <div class="d-flex align-items-start">
                                <div class="alert-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                                    <i class="fas fa-history fs-6"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-warning-dark">Retention Policy: The 1-Hour Rule</h6>
                                    <p class="mb-0 text-warning-secondary small">Every file you upload and every output generated is permanently and securely scrubbed from our systems <strong>exactly 1 hour</strong> after processing. We do not preserve file backups, cache states, or logs containing private file data.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION: PURPOSES --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">The Purposes of Processing</h4>
                        <p class="text-secondary">User details and session cookies are processed to allow the Owner to run the service smoothly, as well as for the following requirements:</p>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <div class="p-3 border rounded-3 bg-white h-100">
                                    <h6 class="fw-bold text-dark mb-1">Service Operations</h6>
                                    <p class="small mb-0 text-muted">Running calculations, media transcoding, and file output downloads.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded-3 bg-white h-100">
                                    <h6 class="fw-bold text-dark mb-1">Bandwidth Optimization</h6>
                                    <p class="small mb-0 text-muted">Traffic monitoring, server routing, and system speed compliance.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION: SERVICES --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">Third-Party Services Detailed Info</h4>
                        <p class="text-secondary">We work with global providers to secure and sustain our free, non-subscription ecosystem:</p>
                        <div class="table-responsive mt-3">
                            <table class="table border-0 custom-table align-middle">
                                <thead class="table-header-vip">
                                    <tr>
                                        <th class="border-0">Service</th>
                                        <th class="border-0">Operational Purpose</th>
                                        <th class="border-0">Information Tracked</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Google AdSense</strong></td>
                                        <td>Advertising Delivery</td>
                                        <td>Device identifiers, cookies, usage telemetry</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Google Analytics 4</strong></td>
                                        <td>Operational Analytics</td>
                                        <td>Session lengths, navigation logs</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Cloudflare</strong></td>
                                        <td>Security & Edge Caching</td>
                                        <td>IP configuration, security queries</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- SECTION: RIGHTS --}}
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark mb-3">GDPR / LGPD Compliance</h4>
                        <p class="text-secondary">Under global data safety measures, our visitors can exercise specific options regarding information processing:</p>
                        <ul class="custom-check-list text-secondary">
                            <li><strong>Right to Deletion:</strong> You have a full right to be forgotten (fully handled by our 1-hour auto-scrub rule).</li>
                            <li><strong>Right of Access:</strong> You can request a complete log of any identifiable profiles we store (we store zero profiles).</li>
                            <li><strong>Consent Withdrawal:</strong> You are free to disable analytical cookies and ad trackers in your web browser parameters.</li>
                        </ul>
                    </div>

                    {{-- SECTION: ADDITIONAL --}}
                    <div class="mb-0">
                        <h4 class="fw-bold text-dark mb-3">Additional Information</h4>
                        <p class="text-secondary"><strong>Legal Defenses:</strong> Personal data may be compiled if demanded in an official court subpoena, or in connection with security investigations.</p>
                        <p class="text-secondary mb-0"><strong>Policy updates:</strong> We reserve the options to update this document. Check the revision date at the top of the page regularly.</p>
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

    /* Table styles */
    .custom-table {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #f1f5f9;
    }
    .table-header-vip {
        background-color: #f8fafc;
    }
    .table-header-vip th {
        font-weight: 700;
        color: #475569;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }
    .custom-table td {
        padding: 1rem;
        color: #475569;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9;
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
