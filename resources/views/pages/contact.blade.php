@extends('layouts.app')

@section('title', 'Contact Us — ToolsHub Support and Feedback')
@section('meta_description', 'Have questions, suggestions, or feedback? Get in touch with the ToolsHub team. We are always looking for ways to improve our 1500+ free online tools.')

@section('content')
<div class="vip-page-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-10 col-md-12">
                
                {{-- ════════════ VIP HERO HEADER ════════════ --}}
                <div class="text-center mb-5 animate-up">
                    <span class="badge badge-vip mb-3">Support Portal</span>
                    <h1 class="display-6 fw-black text-dark mb-3">
                        Have Questions? Get in touch.
                    </h1>
                    <p class="lead text-secondary mx-auto" style="max-width: 600px; font-weight: 500; font-size: 1.05rem; line-height: 1.6;">
                        Our engineering team typically reviews all requests within 24 hours. For technical bug reports, please specify the tool name and steps to reproduce.
                    </p>
                </div>

                {{-- ════════════ QUICK CONTACT METHODS ════════════ --}}
                <div class="row g-4 mb-4 animate-up-delay-1">
                    <div class="col-md-4">
                        <div class="contact-node p-4 text-center bg-white border rounded-4 shadow-sm h-100">
                            <div class="node-icon bg-light text-primary mx-auto mb-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Email Support</h6>
                            <p class="text-secondary small mb-3">Direct corridor to our engineers.</p>
                            <a href="mailto:support@toolshub.com" class="node-link fw-bold text-primary text-decoration-none small">
                                support@toolshub.com <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-node p-4 text-center bg-white border rounded-4 shadow-sm h-100">
                            <div class="node-icon bg-light text-primary mx-auto mb-3">
                                <i class="fab fa-x-twitter"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Official Handle</h6>
                            <p class="text-secondary small mb-3">Stay updated with system notes.</p>
                            <a href="#" class="node-link fw-bold text-primary text-decoration-none small">
                                @ToolsHubHQ <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-node p-4 text-center bg-white border rounded-4 shadow-sm h-100">
                            <div class="node-icon bg-light text-primary mx-auto mb-3">
                                <i class="fas fa-bug"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Bug Tracker</h6>
                            <p class="text-secondary small mb-3">Open issue tickets via GitHub.</p>
                            <a href="#" class="node-link fw-bold text-primary text-decoration-none small">
                                Open GitHub Issue <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- ════════════ VIP CONTACT FORM ════════════ --}}
                <div class="vip-card shadow-sm p-4 p-md-5 bg-white rounded-4 border animate-up-delay-2">
                    
                    <div id="formSuccessAlert" class="alert alert-success-vip border-0 p-4 rounded-4 mb-4 d-none">
                        <div class="d-flex align-items-center">
                            <div class="alert-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                                <i class="fas fa-check fs-6"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-success-dark">Message Sent Successfully</h6>
                                <p class="mb-0 text-success-secondary small">Thank you. We have logged your submission and will get back to you shortly.</p>
                            </div>
                        </div>
                    </div>

                    <form id="contactForm">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="vip-form-label">Your Name</label>
                                <input type="text" id="formName" class="form-control vip-form-control" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="vip-form-label">Email Address</label>
                                <input type="email" id="formEmail" class="form-control vip-form-control" placeholder="john@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="vip-form-label">Subject Topic</label>
                                <select id="formSubject" class="form-select vip-form-select">
                                    <option selected>General Support & Feedback</option>
                                    <option>Technical Defect / Bug Report</option>
                                    <option>New Tool Recommendation</option>
                                    <option>Partnerships & Advertising</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="vip-form-label">Detailed Message</label>
                                <textarea id="formMessage" class="form-control vip-form-control" rows="5" placeholder="How can we assist you today?" required></textarea>
                            </div>
                            <div class="col-12 text-center mt-5">
                                <button type="submit" id="submitBtn" class="btn btn-vip-action px-5 py-3 fw-bold rounded-pill">
                                    Send Message <i class="fas fa-paper-plane ms-2 small"></i>
                                </button>
                            </div>
                        </div>
                    </form>
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

    /* VIP main card & Nodes */
    .vip-card, .contact-node {
        border-color: #e2e8f0 !important;
        border-radius: 20px !important;
    }

    /* Contact Nodes */
    .node-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        border: 1px solid #e2e8f0;
    }
    .node-link {
        transition: color 0.2s ease;
    }
    .node-link i {
        transition: transform 0.2s ease;
    }
    .contact-node:hover .node-link i {
        transform: translateX(3px);
    }

    /* Form Styling */
    .vip-form-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: block;
    }
    .vip-form-control, .vip-form-select {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        color: #0f172a;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }
    .vip-form-control:focus, .vip-form-select:focus {
        background-color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.06);
        outline: none;
    }

    /* VIP Buttons */
    .btn-vip-action {
        background: #0f172a;
        color: #ffffff;
        border: 1px solid #0f172a;
        transition: all 0.25s cubic-bezier(0.165, 0.84, 0.44, 1);
        font-size: 0.95rem;
    }
    .btn-vip-action:hover {
        background: #1e293b;
        color: #ffffff;
        border-color: #1e293b;
        transform: translateY(-1px);
    }

    /* Success feedback banner */
    .alert-success-vip {
        background: #f0fdf4;
        border: 1px solid rgba(34, 197, 94, 0.15) !important;
    }
    .text-success-dark {
        color: #166534;
    }
    .text-success-secondary {
        color: #15803d;
    }

    /* Animations */
    .animate-up {
        animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .animate-up-delay-1 {
        opacity: 0;
        animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.1s forwards;
    }
    .animate-up-delay-2 {
        opacity: 0;
        animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const successAlert = document.getElementById('formSuccessAlert');

    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        contactForm.style.opacity = '0.3';
        contactForm.style.pointerEvents = 'none';

        setTimeout(() => {
            contactForm.classList.add('d-none');
            successAlert.classList.remove('d-none');
            successAlert.classList.add('animate-up');
        }, 500);
    });
});
</script>
@endsection
