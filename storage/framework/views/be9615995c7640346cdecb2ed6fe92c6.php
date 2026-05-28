<div class="row g-4 roi-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Total Subscribers</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-users text-muted"></i></span>
                            <input type="number" id="yt-subs" class="form-control form-control-lg" value="50000" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Total Channel Views</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-eye text-muted"></i></span>
                            <input type="number" id="yt-views" class="form-control form-control-lg" value="15000000" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Total Videos Uploaded</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-video text-muted"></i></span>
                            <input type="number" id="yt-videos" class="form-control form-control-lg" value="120" min="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ff0000;--tool-bg:rgba(255,0,0,.04);">
            <div class="output-hero">
                <span class="output-hero-label">AVERAGE VIEWS PER VIDEO</span>
                <div class="output-hero-value" id="yt-avg-views">125,000</div>
                <span class="output-hero-unit" id="yt-status" style="color:#22c55e">HEALTHY CHANNEL</span>
            </div>
            
            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Views per Subscriber</span>
                        <span class="fs-4 fw-bold" id="yt-vps">300.0</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Estimated Watch Hours (if 4min avg)</span>
                        <span class="fs-4 fw-bold" id="yt-watch">1,000,000</span>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="yt-insights"></div>
            
            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="yt-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy Result
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="yt-reset" style="min-width: 280px; max-width: 100%;">
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
        const subs = parseFloat($('yt-subs').value) || 0;
        const views = parseFloat($('yt-views').value) || 0;
        const videos = parseFloat($('yt-videos').value) || 1;
        
        if (videos === 0) {
            $('yt-avg-views').textContent = '0';
            $('yt-vps').textContent = '0.0';
            $('yt-watch').textContent = '0';
            $('yt-insights').innerHTML = '';
            return;
        }

        const avgViews = views / videos;
        const vps = subs > 0 ? (views / subs) : 0;
        const watchHours = (views * 4) / 60; // Assumes 4 minutes average view duration

        $('yt-avg-views').textContent = fmt(avgViews);
        $('yt-vps').textContent = vps.toFixed(1);
        $('yt-watch').textContent = fmt(watchHours) + ' hrs';

        let status = 'GROWING CHANNEL';
        let color = '#3b82f6';
        let tip = 'Your channel is making progress. Consistency is key.';

        if (avgViews > 100000) {
            status = 'AUTHORITY CHANNEL 🚀';
            color = '#8b5cf6';
            tip = 'Excellent performance! With an average of over 100K views per video, you have strong algorithmic authority.';
        } else if (avgViews > 10000) {
            status = 'ESTABLISHED CHANNEL';
            color = '#22c55e';
            tip = 'Solid viewership. Focus on increasing click-through rates (CTR) on your thumbnails to push these numbers higher.';
        } else if (avgViews < 1000) {
            status = 'STARTER CHANNEL';
            color = '#f59e0b';
            tip = 'You are in the growth phase. Optimize your titles and focus on search-driven content to build a base.';
        }

        $('tt-status' ? 'yt-status' : 'yt-status').textContent = status; // Fallback to id
        $('yt-status').textContent = status;
        $('yt-status').style.color = color;

        let ins = [];
        ins.push(tip);
        if (vps > 100) {
            ins.push('High Views-per-Subscriber ratio means your videos reach well beyond your subscriber base! The algorithm is pushing your content.');
        } else if (vps < 10 && subs > 1000) {
            ins.push('Low Views-per-Subscriber ratio. Your subscribers might not be receiving notifications, or your content topic has shifted.');
        }

        if (subs >= 1000 && watchHours >= 4000) {
            ins.push('✅ Eligible for YouTube Partner Program (YPP) based on these standard metrics (assuming 365-day timeframe).');
        } else {
            ins.push('Not yet eligible for YPP standard monetization (Requires 1,000 Subs and 4,000 Watch Hours).');
        }

        $('yt-insights').innerHTML = '<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Performance Insights</h6>' + 
                                     '<ul class="list-unstyled mb-0">' + 
                                     ins.map(i => `<li class="mb-2 pb-1" style="font-size:0.9rem"><i class="fas fa-info-circle text-primary me-2"></i>${i}</li>`).join('') + 
                                     '</ul>';
    }

    ['yt-subs', 'yt-views', 'yt-videos'].forEach(id => $(id).addEventListener('input', calculate));

    $('yt-copy').addEventListener('click', function() {
        const t = `YouTube Channel Stats\nSubscribers: ${$('yt-subs').value}\nTotal Views: ${$('yt-views').value}\nVideos: ${$('yt-videos').value}\nAvg Views per Video: ${$('yt-avg-views').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('yt-reset').addEventListener('click', () => {
        $('yt-subs').value = 50000;
        $('yt-views').value = 15000000;
        $('yt-videos').value = 120;
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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\youtube-channel-stats.blade.php ENDPATH**/ ?>