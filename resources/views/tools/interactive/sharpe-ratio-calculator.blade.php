@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid sharpe-ratio-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Investment Examples</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-sp500" style="min-width: 280px; max-width: 100%;">S&P 500 (~0.6)</button>
                    <button class="qa-btn-component qa-success" id="qa-hedge" style="min-width: 280px; max-width: 100%;">Elite Hedge Fund (>1.5)</button>
                    <button class="qa-btn-component qa-warning" id="qa-crypto" style="min-width: 280px; max-width: 100%;">Crypto (High Volatility)</button>
                    <button class="qa-btn-component qa-danger" id="qa-bad" style="min-width: 280px; max-width: 100%;">Poor Strategy (<0)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1 text-primary">Expected Portfolio Return (%)</label>
                    <input type="number" id="ret" class="form-control-custom fw-bold fs-5 text-primary" value="10.5" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom border-bottom pb-1 text-secondary">Risk-Free Rate (%)</label>
                    <input type="number" id="rfr" class="form-control-custom fw-bold fs-5" value="4.2" step="0.1">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Volatility Profile</h5>
            <div class="row">
                <div class="col-md-12 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom text-danger fw-bold">Portfolio Standard Deviation (Risk %)</label>
                    <input type="number" id="std" class="form-control-custom fw-bold" value="15.0" step="0.1" min="0.1">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #3b82f6;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Sharpe Ratio</span>
                <span id="sharpe-badge" class="status-badge badge-info">Acceptable</span>
            </div>
            <h1 class="result-main-value fs-1" id="sharpe-val" style="color: #2563eb;">0.42</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Excess Return (Alpha Premium)</td><td class="text-end fw-semibold text-success" id="s-ex">6.30%</td></tr>
                    <tr><td>Risk Penalty (Standard Div)</td><td class="text-end fw-bold text-danger fs-6" id="s-rs">15.00%</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Quality of Strategy Scale</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-sharpe" class="enhanced-progress-segment" style="background:#3b82f6; width:21%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#ef4444;font-weight:bold;">0.0 (Poor)</span>
                <span style="color:#10b981;font-weight:bold;">2.0+ (Excellent)</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    function calc() {
        const ret = parseFloat(document.getElementById('ret').value)||0;
        const rfr = parseFloat(document.getElementById('rfr').value)||0;
        const std = parseFloat(document.getElementById('std').value)||0.1;

        // Sharpe Ratio = (Rp - Rf) / Sigmap
        let excess = ret - rfr;
        let sharpe = 0;
        if (std > 0) {
            sharpe = excess / std;
        }

        let badge = document.getElementById('sharpe-badge');
        let badgeColor = '#2563eb';
        let barColor = '#3b82f6';

        if (sharpe < 0) { badge.innerText = "NEGATIVE (Destroying Value)"; badge.className = "status-badge badge-critical"; badgeColor='#be123c'; barColor='#ef4444'; }
        else if (sharpe < 1.0) { badge.innerText = "SUB-OPTIMAL (<1.0)"; badge.className = "status-badge badge-warning"; badgeColor='#ea580c'; barColor='#f59e0b'; }
        else if (sharpe < 1.99) { badge.innerText = "GOOD (1.0 - 1.99)"; badge.className = "status-badge badge-info"; badgeColor='#0284c7'; barColor='#0ea5e9'; }
        else if (sharpe < 2.99) { badge.innerText = "EXCELLENT (2.0 - 2.99)"; badge.className = "status-badge badge-optimal"; barColor='#10b981'; badgeColor='#047857'; }
        else { badge.innerText = "OUTSTANDING (3.0+)"; badge.className = "status-badge badge-primary"; barColor='#8b5cf6'; badgeColor='#6d28d9'; }

        try {
            document.getElementById('sharpe-val').innerText = sharpe.toFixed(2);
            document.getElementById('sharpe-val').style.color = badgeColor;
            
            document.getElementById('s-ex').innerText = excess.toFixed(2) + "%";
            document.getElementById('s-rs').innerText = std.toFixed(2) + "%";

            let maxSharpe = 3.0; // Scale 0 to 3 for visual mapping
            let visualS = sharpe;
            if (visualS < 0) visualS = 0;
            
            let pSharpe = Math.min(100, Math.max(0, (visualS / maxSharpe) * 100));

            document.getElementById('bar-sharpe').style.width = pSharpe + '%';
            document.getElementById('bar-sharpe').style.background = barColor;
        } catch(e) {}
    }
    
    ['ret','rfr','std'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-sp500').addEventListener('click', () => { document.getElementById('ret').value=10; document.getElementById('rfr').value=4.2; document.getElementById('std').value=15; calc(); });
    document.getElementById('qa-hedge').addEventListener('click', () => { document.getElementById('ret').value=12; document.getElementById('rfr').value=4.2; document.getElementById('std').value=5; calc(); });
    document.getElementById('qa-crypto').addEventListener('click', () => { document.getElementById('ret').value=40; document.getElementById('rfr').value=4.2; document.getElementById('std').value=80; calc(); });
    document.getElementById('qa-bad').addEventListener('click', () => { document.getElementById('ret').value=3; document.getElementById('rfr').value=4.2; document.getElementById('std').value=10; calc(); });

    calc();
});
</script>

