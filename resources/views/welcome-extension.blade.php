@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <div class="welcome-card p-5 border-0 shadow-lg rounded-20 bg-white">
                <div class="welcome-icon-wrapper mb-4">
                    <div class="pulse-ring"></div>
                    <i class="fas fa-bolt fa-3x text-accent"></i>
                </div>
                
                <h1 class="display-4 fw-800 mb-3">Welcome to the ToolsHub Ecosystem! ⚡</h1>
                <p class="lead text-muted mb-5">You've just unlocked 1500+ free professional tools directly in your browser. No more searching, no more bookmarks.</p>

                <div class="row g-4 text-start mb-5">
                    <div class="col-md-4">
                        <div class="step-box">
                            <div class="step-num">1</div>
                            <h6>Pin the Extension</h6>
                            <p class="small text-muted">Click the puzzle icon in your toolbar and pin ToolsHub for instant access.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step-box">
                            <div class="step-num">2</div>
                            <h6>Right-Click Magic</h6>
                            <p class="small text-muted">Select text on any website to count words or format JSON via the context menu.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step-box">
                            <div class="step-num">3</div>
                            <h6>Sync & Save</h6>
                            <p class="small text-muted">Your favorite tools are synced between the website and your extension.</p>
                        </div>
                    </div>
                </div>

                <div class="cta-box p-4 bg-light rounded-16 border">
                    <h5 class="fw-bold mb-3">Ready to start?</h5>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ url('/') }}" class="btn btn-primary px-4 py-3 fw-bold">
                            <i class="fas fa-home me-2"></i> Go to Homepage
                        </a>
                        <button class="btn btn-outline-dark px-4 py-3 fw-bold" onclick="window.close()">
                            <i class="fas fa-times me-2"></i> Close This Page
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-20 { border-radius: 24px; }
    .rounded-16 { border-radius: 16px; }
    .fw-800 { font-weight: 800; }
    .text-accent { color: #e94560; }
    
    .welcome-icon-wrapper {
        position: relative;
        width: 100px;
        height: 100px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #1a1a2e;
        border-radius: 50%;
        color: #e94560;
    }
    
    .pulse-ring {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 4px solid #e94560;
        animation: pulse-ring 2s infinite;
    }
    
    @keyframes pulse-ring {
        0% { transform: scale(0.8); opacity: 0.8; }
        100% { transform: scale(1.5); opacity: 0; }
    }
    
    .step-box {
        background: #f8f9fa;
        padding: 24px;
        border-radius: 16px;
        height: 100%;
        border: 1px solid #eee;
        transition: transform 0.3s ease;
    }
    .step-box:hover { transform: translateY(-5px); }
    .step-num {
        width: 32px;
        height: 32px;
        background: #1a1a2e;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        margin-bottom: 16px;
    }
    .step-box h6 { font-weight: 700; color: #1a1a2e; }
    
    .btn-primary {
        background: #e94560;
        border-color: #e94560;
    }
    .btn-primary:hover {
        background: #ff4d6d;
        border-color: #ff4d6d;
    }
</style>
@endsection
