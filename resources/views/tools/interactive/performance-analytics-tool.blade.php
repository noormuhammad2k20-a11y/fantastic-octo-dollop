@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid performance-analytics-tool">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Infrastructure Profiles</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-success" id="qa-cdn" style="min-width: 280px; max-width: 100%;">Cloudflare Edge / Vercel</button>
                    <button class="qa-btn-component qa-primary" id="qa-wp" style="min-width: 280px; max-width: 100%;">Bloated WordPress</button>
                    <button class="qa-btn-component qa-danger" id="qa-host" style="min-width: 280px; max-width: 100%;">Cheap Shared Hosting</button>
                    <button class="qa-btn-component qa-warning" id="qa-img" style="min-width: 280px; max-width: 100%;">Heavy Images/Video</button>
                    <button class="qa-btn-component qa-info" id="qa-spa" style="min-width: 280px; max-width: 100%;">Lean React SPA</button>
                    <button class="qa-btn-component qa-dark" id="qa-mob" style="min-width: 280px; max-width: 100%;">Poor Mobile 3G</button>
                </div>
            </div>

            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Speed Telemetry</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">First Contentful Paint (FCP) ms</label>
                    <input type="number" id="fcp" class="form-control-custom fw-bold" value="800" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-danger">Largest Contentful Paint (LCP) ms</label>
                    <input type="number" id="lcp" class="form-control-custom fw-bold" value="1200" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Interaction Metrics</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Time to Interactive (TTI) ms</label>
                    <input type="number" id="tti" class="form-control-custom" value="1500" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Cumulative Layout Shift (CLS)</label>
                    <input type="number" id="cls" class="form-control-custom" value="0.05" step="0.01">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f43f5e;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Lighthouse Speed Score</span>
                <span id="perf-badge" class="status-badge badge-optimal">A+ Grade</span>
            </div>
            <h1 class="result-main-value fs-1" id="score" style="color: #e11d48;">100</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Google SEO Ranking Impact</td><td class="text-end fw-bold fs-6" id="s-seo">Positive Boost</td></tr>
                    <tr><td>Est. Speed-Incurred Bounce Rate</td><td class="text-end fw-semibold text-danger" id="s-bounce">0%</td></tr>
                    <tr><td class="pt-2 border-top">LCP Status (Core Web Vital)</td><td class="text-end pt-2 border-top fw-bold" id="s-lcp">GOOD</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Loading Timeline (ms)</p>
            <div class="enhanced-progress-bar" style="height:12px; background:#e2e8f0; position:relative;">
                <div id="bar-fcp" style="position:absolute; left:0; top:0; height:100%; background:#94a3b8; width:20%;"></div>
                <div id="bar-lcp" style="position:absolute; left:0; top:0; height:100%; background:#f43f5e; width:60%; opacity:0.5;"></div>
                <div id="bar-tti" style="position:absolute; left:0; top:0; height:100%; background:#10b981; width:80%; opacity:0.3;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#64748b;">FCP</span>
                <span style="color:#f43f5e;">LCP</span>
                <span style="color:#10b981;">TTI Ready</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const fcp = parseFloat(document.getElementById('fcp').value) || 0;
        const lcp = parseFloat(document.getElementById('lcp').value) || 0;
        const tti = parseFloat(document.getElementById('tti').value) || 0;
        const cls = parseFloat(document.getElementById('cls').value) || 0;
        
        // Custom generic scoring logic approximation mimicking Lighthouse 100 scale.
        // LCP is heavily weighted (2.5s is threshold)
        let lcpScore = 100 - ((lcp - 1200) / 30);
        let clsScore = 100 - (cls * 300);
        let ttiScore = 100 - ((tti - 1500) / 40);

        if(lcpScore > 100) lcpScore = 100; if(lcpScore < 0) lcpScore = 0;
        if(clsScore > 100) clsScore = 100; if(clsScore < 0) clsScore = 0;
        if(ttiScore > 100) ttiScore = 100; if(ttiScore < 0) ttiScore = 0;

        const score = Math.floor((lcpScore * 0.5) + (clsScore * 0.25) + (ttiScore * 0.25));

        // Speed incurred bounce rate logic: every second of LCP above 2s adds ~10% bounce
        let bounceRisk = 0;
        if(lcp > 2000) bounceRisk = ((lcp - 2000) / 1000) * 10;
        if(bounceRisk > 90) bounceRisk = 90;

        let badge = document.getElementById('perf-badge');
        let color = '#10b981';
        let seo = "Positive Boost";
        let seoColor = '#10b981';
        let lcpStatus = "GOOD"; let lcpColor = '#10b981';

        if(score < 50) { badge.innerText = "FAILING"; badge.className = "status-badge badge-critical"; color='#ef4444'; seo="Penalty Probable"; seoColor='#ef4444'; }
        else if (score < 80) { badge.innerText = "NEEDS WORK"; badge.className = "status-badge badge-warning"; color='#f59e0b'; seo="Neutral"; seoColor='#f59e0b'; }
        else if (score < 95) { badge.innerText = "FAST"; badge.className = "status-badge badge-info"; color='#0ea5e9'; }
        else { badge.innerText = "BLAZING"; badge.className = "status-badge badge-optimal"; }

        if(lcp > 4000) { lcpStatus = "POOR (>4s)"; lcpColor = '#ef4444'; }
        else if(lcp > 2500) { lcpStatus = "NEEDS IMP. (>2.5s)"; lcpColor = '#f59e0b'; }

        try {
            document.getElementById('score').innerText = score;
            document.getElementById('score').style.color = color;
            
            const seoObj = document.getElementById('s-seo');
            seoObj.innerText = seo; seoObj.style.color = seoColor;

            document.getElementById('s-bounce').innerText = '+ ' + bounceRisk.toFixed(1) + '%';
            
            const lcpObj = document.getElementById('s-lcp');
            lcpObj.innerText = lcpStatus; lcpObj.style.color = lcpColor;

            const maxTime = Math.max(fcp, lcp, tti, 3000);
            const wFcp = (fcp/maxTime)*100;
            const wLcp = (lcp/maxTime)*100;
            const wTti = (tti/maxTime)*100;

            document.getElementById('bar-fcp').style.width = wFcp + '%';
            document.getElementById('bar-lcp').style.width = wLcp + '%';
            document.getElementById('bar-tti').style.width = wTti + '%';
        } catch(e) {}
    }
    
    ['fcp','lcp','tti','cls'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-cdn').addEventListener('click', () => { document.getElementById('fcp').value=600; document.getElementById('lcp').value=800; document.getElementById('tti').value=900; document.getElementById('cls').value=0.01; calc(); });
    document.getElementById('qa-wp').addEventListener('click', () => { document.getElementById('fcp').value=1500; document.getElementById('lcp').value=3200; document.getElementById('tti').value=4500; document.getElementById('cls').value=0.15; calc(); });
    document.getElementById('qa-host').addEventListener('click', () => { document.getElementById('fcp').value=3000; document.getElementById('lcp').value=6500; document.getElementById('tti').value=7500; document.getElementById('cls').value=0.05; calc(); });
    document.getElementById('qa-img').addEventListener('click', () => { document.getElementById('fcp').value=800; document.getElementById('lcp').value=4500; document.getElementById('tti').value=1500; document.getElementById('cls').value=0.35; calc(); });
    document.getElementById('qa-spa').addEventListener('click', () => { document.getElementById('fcp').value=500; document.getElementById('lcp').value=2800; document.getElementById('tti').value=3200; document.getElementById('cls').value=0.0; calc(); }); // Client side rendering hit
    document.getElementById('qa-mob').addEventListener('click', () => { document.getElementById('fcp').value=4500; document.getElementById('lcp').value=8000; document.getElementById('tti').value=12000; document.getElementById('cls').value=0.1; calc(); });

    calc();
});
</script>

