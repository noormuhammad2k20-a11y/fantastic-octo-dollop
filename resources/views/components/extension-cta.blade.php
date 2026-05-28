@php
    $chromeUrl = config('ads.extension.chrome_web_store_url', '#');
    $threshold = config('ads.extension.cta_engagement_threshold', 3);
    $cooldown = config('ads.extension.cta_cooldown_days', 7);
    $extensionPublished = config('ads.extension.published', false);
@endphp

@if($extensionPublished)

<div id="extension-cta" class="extension-cta-toast" style="display: none;">
    <div class="cta-header">
        <div class="cta-icon-wrapper">
            <i class="fas fa-bolt"></i>
        </div>
        <div class="cta-title">⚡ Love ToolsHub?</div>
        <button type="button" class="btn-close btn-close-white ms-auto" id="close-extension-cta"></button>
    </div>
    <div class="cta-body">
        <p>Get instant access to <strong>1500+ tools</strong> right from your browser toolbar. No more searching.</p>
        <div class="cta-features">
            <span><i class="fas fa-check"></i> Popup tools</span>
            <span><i class="fas fa-check"></i> Right-click access</span>
            <span><i class="fas fa-check"></i> Favorites & history</span>
        </div>
        <div class="cta-actions">
            <a href="{{ $chromeUrl }}" target="_blank" class="btn btn-extension-primary" id="add-to-chrome-btn">
                Add to Chrome — Free <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<style>
    .extension-cta-toast {
        position: fixed;
        bottom: 24px;
        right: 24px;
        width: 340px;
        background: #1a1a2e;
        color: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        z-index: 9999;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1);
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    }
    .extension-cta-toast.show {
        transform: translateY(0);
        opacity: 1;
    }
    .cta-header {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        padding: 16px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .cta-icon-wrapper {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #e94560 0%, #ff6b6b 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }
    .cta-icon-wrapper i { font-size: 14px; }
    .cta-title { font-weight: 700; font-size: 1.1rem; }
    .cta-body { padding: 16px; }
    .cta-body p { margin-bottom: 12px; font-size: 0.95rem; line-height: 1.5; color: #a2a8d3; }
    .cta-features { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
    .cta-features span { font-size: 0.75rem; background: rgba(255,255,255,0.05); padding: 4px 8px; border-radius: 4px; color: #fff; display: flex; align-items: center; gap: 4px; }
    .cta-features i { color: #16c79a; font-size: 10px; }
    .btn-extension-primary {
        width: 100%;
        background: #e94560;
        border: none;
        color: white;
        font-weight: 700;
        padding: 10px;
        border-radius: 10px;
        transition: all 0.2s ease;
    }
    .btn-extension-primary:hover {
        background: #ff4d6d;
        color: white;
        transform: scale(1.02);
    }
    @media (max-width: 576px) {
        .extension-cta-toast {
            bottom: 0px;
            right: 0px;
            width: 100%;
            border-radius: 20px 20px 0 0;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scoreKey = 'th_engagement_score';
    const dismissKey = 'th_ext_cta_dismissed_at';
    const threshold = {{ $threshold }};
    const cooldownDays = {{ $cooldown }};
    
    // Check if dismissed recently
    const dismissedAt = localStorage.getItem(dismissKey);
    if (dismissedAt) {
        const lastDismiss = new Date(parseInt(dismissedAt));
        const diffDays = (new Date() - lastDismiss) / (1000 * 60 * 60 * 24);
        if (diffDays < cooldownDays) return;
    }

    // Engagement scoring logic (on current page)
    let score = parseInt(localStorage.getItem(scoreKey) || '0');
    
    // Actions that increase score:
    // 1. Visit tool page (+1) -- handled on load
    score += 1;
    localStorage.setItem(scoreKey, score);

    // 2. Track tool engagement (Post or scroll)
    const toast = document.getElementById('extension-cta');
    const closeBtn = document.getElementById('close-extension-cta');

    function showCTA() {
        if (score >= threshold) {
            toast.style.display = 'block';
            setTimeout(() => toast.classList.add('show'), 100);
        }
    }

    // Trigger on tool process (hooking into UploadEngine if exists)
    window.addEventListener('tool_processed', function() {
        score += 2;
        localStorage.setItem(scoreKey, score);
        showCTA();
    });

    closeBtn.addEventListener('click', function() {
        toast.classList.remove('show');
        localStorage.setItem(dismissKey, new Date().getTime());
        setTimeout(() => toast.style.display = 'none', 500);
    });

    // Also trigger if they spend time on page/scroll
    setTimeout(showCTA, 5000); // Trigger after 5s if score already threshold
});
</script>

@endif
