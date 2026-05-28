@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid blog-earnings-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Creator Profiles</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-new" style="min-width: 280px; max-width: 100%;">New Blogger</button>
                    <button class="qa-btn-component qa-success" id="qa-aff" style="min-width: 280px; max-width: 100%;">Affiliate Heavy</button>
                    <button class="qa-btn-component qa-warning" id="qa-ad" style="min-width: 280px; max-width: 100%;">Display Ads Focused</button>
                    <button class="qa-btn-component qa-danger" id="qa-spon" style="min-width: 280px; max-width: 100%;">Sponsored Post Star</button>
                    <button class="qa-btn-component qa-info" id="qa-pro" style="min-width: 280px; max-width: 100%;">Full-Time Publisher</button>
                    <button class="qa-btn-component qa-dark" id="qa-corp" style="min-width: 280px; max-width: 100%;">Corporate Media</button>
                </div>
            </div>

            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Traffic Drivers</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">New Posts per Month</label>
                    <input type="number" id="posts" class="form-control-custom text-primary" value="8" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom">Avg Views per Post (Mo)</label>
                    <input type="number" id="views" class="form-control-custom text-primary" value="1500" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-3 pb-2 border-bottom mb-2 w-100">Monetization Streams</h5>
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">Display Ad RPM ($)</label>
                    <input type="number" id="rpm" class="form-control-custom" value="12" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">Affiliate Rev/Visitor ($)</label>
                    <input type="number" id="aff" class="form-control-custom" value="0.05" step="0.01">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-success fw-bold">Sponsors/Mo ($)</label>
                    <input type="number" id="spon" class="form-control-custom" value="500" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #14b8a6;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Gross Monthly Publishing Revenue</span>
                <span id="blog-badge" class="status-badge badge-optimal">Profitable</span>
            </div>
            <h1 class="result-main-value fs-1" id="total" style="color: #0f766e;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Display Ad Earnings</td><td class="text-end fw-semibold text-secondary" id="s-ads">$0</td></tr>
                    <tr><td>Affiliate Link Earnings</td><td class="text-end fw-semibold text-secondary" id="s-aff">$0</td></tr>
                    <tr><td class="pt-2 border-top">Total Monthly Visitors</td><td class="text-end pt-2 border-top fw-bold text-dark" id="s-vis">0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Revenue Decomposition</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-ads" class="enhanced-progress-segment" style="background:#0ea5e9; width:33.3%;"></div>
                <div id="bar-aff" class="enhanced-progress-segment" style="background:#10b981; width:33.3%;"></div>
                <div id="bar-spon" class="enhanced-progress-segment" style="background:#f59e0b; width:33.3%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#0ea5e9;font-weight:bold;">Ads</span>
                <span style="color:#10b981;font-weight:bold;">Affiliate</span>
                <span style="color:#f59e0b;font-weight:bold;">Sponsors</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const posts = parseFloat(document.getElementById('posts').value) || 0;
        const views = parseFloat(document.getElementById('views').value) || 0;
        const rpm = parseFloat(document.getElementById('rpm').value) || 0;
        const affVal = parseFloat(document.getElementById('aff').value) || 0;
        const spon = parseFloat(document.getElementById('spon').value) || 0;

        const totalVis = posts * views;
        
        const adRev = (totalVis / 1000) * rpm;
        const affRev = totalVis * affVal;
        
        const total = adRev + affRev + spon;

        let badge = document.getElementById('blog-badge');
        if(total < 100) { badge.innerText = "HOBBY BLOG"; badge.className = "status-badge badge-critical"; }
        else if (total < 1000) { badge.innerText = "SIDE INCOME"; badge.className = "status-badge badge-warning"; }
        else if (total < 5000) { badge.innerText = "GROWING ASSET"; badge.className = "status-badge badge-info"; }
        else { badge.innerText = "PUBLISHING BUSINESS"; badge.className = "status-badge badge-optimal"; }

        try {
            document.getElementById('total').innerText = format(total);
            document.getElementById('s-ads').innerText = format(adRev);
            document.getElementById('s-aff').innerText = format(affRev);
            document.getElementById('s-vis').innerText = totalVis.toLocaleString('en-US');

            if(total > 0) {
                document.getElementById('bar-ads').style.width = ((adRev / total) * 100) + '%';
                document.getElementById('bar-aff').style.width = ((affRev / total) * 100) + '%';
                document.getElementById('bar-spon').style.width = ((spon / total) * 100) + '%';
            } else {
                document.getElementById('bar-ads').style.width = '33.3%';
                document.getElementById('bar-aff').style.width = '33.3%';
                document.getElementById('bar-spon').style.width = '33.3%';
            }
        } catch(e) {}
    }
    
    ['posts','views','rpm','aff','spon'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-new').addEventListener('click', () => { document.getElementById('posts').value=4; document.getElementById('views').value=250; document.getElementById('rpm').value=0; document.getElementById('aff').value=0.01; document.getElementById('spon').value=0; calc(); });
    document.getElementById('qa-aff').addEventListener('click', () => { document.getElementById('posts').value=10; document.getElementById('views').value=800; document.getElementById('rpm').value=5; document.getElementById('aff').value=0.25; document.getElementById('spon').value=0; calc(); });
    document.getElementById('qa-ad').addEventListener('click', () => { document.getElementById('posts').value=15; document.getElementById('views').value=5000; document.getElementById('rpm').value=22; document.getElementById('aff').value=0.02; document.getElementById('spon').value=0; calc(); });
    document.getElementById('qa-spon').addEventListener('click', () => { document.getElementById('posts').value=4; document.getElementById('views').value=10000; document.getElementById('rpm').value=10; document.getElementById('aff').value=0.05; document.getElementById('spon').value=3000; calc(); });
    document.getElementById('qa-pro').addEventListener('click', () => { document.getElementById('posts').value=20; document.getElementById('views').value=7500; document.getElementById('rpm').value=28; document.getElementById('aff').value=0.10; document.getElementById('spon').value=1500; calc(); });
    document.getElementById('qa-corp').addEventListener('click', () => { document.getElementById('posts').value=100; document.getElementById('views').value=50000; document.getElementById('rpm').value=15; document.getElementById('aff').value=0.05; document.getElementById('spon').value=10000; calc(); });

    calc();
});
</script>

