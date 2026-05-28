<div class="row g-4 roi-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Video Views</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-eye text-muted"></i></span>
                            <input type="number" id="tt-views" class="form-control form-control-lg" value="10000" min="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Likes</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-heart text-muted"></i></span>
                            <input type="number" id="tt-likes" class="form-control form-control-lg" value="1200" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Comments</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-comment text-muted"></i></span>
                            <input type="number" id="tt-comments" class="form-control form-control-lg" value="80" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Shares</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-share text-muted"></i></span>
                            <input type="number" id="tt-shares" class="form-control form-control-lg" value="45" min="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#000000;--tool-bg:rgba(0,0,0,.04);">
            <div class="output-hero">
                <span class="output-hero-label">ENGAGEMENT RATE (BY VIEWS)</span>
                <div class="output-hero-value" id="tt-rate">13.25%</div>
                <span class="output-hero-unit" id="tt-status" style="color:#22c55e">EXCELLENT ENGAGEMENT</span>
            </div>
            
            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Total Interactions</span>
                        <span class="fs-4 fw-bold" id="tt-interactions">1,325</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Like Rate</span>
                        <span class="fs-4 fw-bold" id="tt-like-rate">12.0%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Share Rate</span>
                        <span class="fs-4 fw-bold" id="tt-share-rate">0.45%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="tt-insights"></div>
            
            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tt-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy Result
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tt-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-rotate-left me-2"></i>Reset Fields
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function fmt(v){ return Math.round(v).toLocaleString(); }
    
    function calculate() {
        const views = parseFloat($('tt-views').value) || 0;
        const likes = parseFloat($('tt-likes').value) || 0;
        const comments = parseFloat($('tt-comments').value) || 0;
        const shares = parseFloat($('tt-shares').value) || 0;
        
        if (views === 0) {
            $('tt-rate').textContent = '0.00%';
            $('tt-interactions').textContent = '0';
            $('tt-like-rate').textContent = '0.00%';
            $('tt-share-rate').textContent = '0.00%';
            $('tt-status').textContent = 'AWAITING DATA';
            $('tt-status').style.color = '#64748b';
            $('tt-insights').innerHTML = '';
            return;
        }

        const interactions = likes + comments + shares;
        const er = (interactions / views) * 100;
        const likeRate = (likes / views) * 100;
        const shareRate = (shares / views) * 100;

        $('tt-rate').textContent = er.toFixed(2) + '%';
        $('tt-interactions').textContent = fmt(interactions);
        $('tt-like-rate').textContent = likeRate.toFixed(2) + '%';
        $('tt-share-rate').textContent = shareRate.toFixed(2) + '%';

        let status = 'AVERAGE ENGAGEMENT';
        let color = '#f59e0b';
        let tip = 'Your engagement is average. Try hooking viewers in the first 3 seconds to increase watch time and shares.';

        if (er >= 15) {
            status = 'VIRAL POTENTIAL 🚀';
            color = '#8b5cf6';
            tip = 'Exceptional engagement! Your content resonates strongly. Keep analyzing what worked in this video and replicate it.';
        } else if (er >= 8) {
            status = 'EXCELLENT ENGAGEMENT';
            color = '#22c55e';
            tip = 'Great performance. To push higher, encourage viewers to "Save" or "Share" the video in your call to action.';
        } else if (er < 4) {
            status = 'LOW ENGAGEMENT';
            color = '#ef4444';
            tip = 'Low engagement detected. Experiment with trending audio, tighter editing, and stronger hooks.';
        }

        $('tt-status').textContent = status;
        $('tt-status').style.color = color;

        let ins = [];
        ins.push(tip);
        if (shares > comments) {
            ins.push('High share count indicates highly relatable or valuable content. The TikTok algorithm loves this.');
        } else {
            ins.push('To boost shares, create content that is educational, highly relatable, or controversial enough to spark debates.');
        }

        $('tt-insights').innerHTML = '<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Performance Insights</h6>' + 
                                     '<ul class="list-unstyled mb-0">' + 
                                     ins.map(i => `<li class="mb-2 pb-1" style="font-size:0.9rem"><i class="fas fa-info-circle text-primary me-2"></i>${i}</li>`).join('') + 
                                     '</ul>';
    }

    ['tt-views', 'tt-likes', 'tt-comments', 'tt-shares'].forEach(id => $(id).addEventListener('input', calculate));

    $('tt-copy').addEventListener('click', function() {
        const t = `TikTok Engagement Summary\nViews: ${$('tt-views').value}\nLikes: ${$('tt-likes').value}\nComments: ${$('tt-comments').value}\nShares: ${$('tt-shares').value}\nEngagement Rate: ${$('tt-rate').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('tt-reset').addEventListener('click', () => {
        $('tt-views').value = 10000;
        $('tt-likes').value = 1200;
        $('tt-comments').value = 80;
        $('tt-shares').value = 45;
        calculate();
    });

    calculate();
});
</script>

<style>
.roi-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,.04); }
.roi-rebuilt .calculator-header { display:flex; align-items:center; gap:1.25rem; margin-bottom:2rem; }
.roi-rebuilt .calculator-header h4 { margin:0; font-weight:800; color:#1e293b; font-size:1.4rem; }
.roi-rebuilt .calculator-header p { margin:0; font-size:0.95rem; color:#64748b; }
.roi-rebuilt .tool-icon-circle { width:60px; height:60px; border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.6rem; flex-shrink:0; }
.roi-rebuilt .form-label-custom { font-size:.8rem; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:.8px; margin-bottom:.5rem; display:block; }
.roi-rebuilt .output-card-themed { background:var(--tool-bg); border:1px solid rgba(0,0,0,.05); border-radius:20px; padding:2rem; }
.roi-rebuilt .output-hero { background:#fff; border-radius:16px; padding:2rem; text-align:center; box-shadow:0 4px 12px rgba(0,0,0,.02); border:1px solid rgba(0,0,0,.04); }
.roi-rebuilt .output-hero-label { font-size:.85rem; font-weight:700; color:#64748b; letter-spacing:1px; display:block; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-value { font-size:2.5rem; font-weight:800; color:var(--tool-color); line-height:1.2; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-unit { font-size:1rem; font-weight:700; }
.roi-rebuilt .overflow-x-auto { overflow-x: auto; }
.roi-rebuilt .break-words { word-break: break-word; }
@media(max-width:768px){ 
    .roi-rebuilt .calculator-card, .roi-rebuilt .output-card-themed { padding:1.5rem; }
    .roi-rebuilt .output-hero-value { font-size:2rem; }
    .roi-rebuilt .calculator-header h4 { font-size:1.2rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\tiktok-engagement-calculator.blade.php ENDPATH**/ ?>