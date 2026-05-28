@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid interest-coverage-ratio-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Company Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-optimal" style="min-width: 280px; max-width: 100%; background:#10b981;color:#fff;border:none;" id="qa-blue">Blue Chip (>5x)</button>
                    <button class="qa-btn-component qa-primary" id="qa-avg" style="min-width: 280px; max-width: 100%;">Standard (3x)</button>
                    <button class="qa-btn-component qa-warning" id="qa-lev" style="min-width: 280px; max-width: 100%;">Heavily Levered (1.5x)</button>
                    <button class="qa-btn-component qa-danger" id="qa-fail" style="min-width: 280px; max-width: 100%;">Distressed (<1x)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Earnings Before Interest & Taxes (EBIT) ($)</label>
                    <input type="number" id="ebit" class="form-control-custom fw-bold fs-5 text-primary" value="300000" min="0">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom text-danger fw-bold">Total Interest Expense ($)</label>
                    <input type="number" id="int" class="form-control-custom fw-bold fs-5" value="100000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Interest Coverage Ratio</span>
                <span id="icr-badge" class="status-badge badge-optimal">Healthy</span>
            </div>
            <h1 class="result-main-value fs-1" id="icr-val" style="color: #0284c7;">3.0x</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>EBIT Output</td><td class="text-end fw-semibold text-secondary" id="s-ebit">$0</td></tr>
                    <tr><td>Interest Expense</td><td class="text-end fw-bold text-danger fs-6" id="s-int">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Interest Buffer Health</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-icr" class="enhanced-progress-segment" style="background:#0ea5e9; width:60%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#ef4444;font-weight:bold;">1.0x (Default Zone)</span>
                <span style="color:#0ea5e9;font-weight:bold;">5.0x+ (Fortress)</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const ebit = parseFloat(document.getElementById('ebit').value)||0;
        const intAmt = parseFloat(document.getElementById('int').value)||0;

        let icr = 0;
        if (intAmt > 0) {
            icr = ebit / intAmt;
        }

        let badge = document.getElementById('icr-badge');
        let badgeColor = '#0284c7';
        let barColor = '#0ea5e9';

        if (intAmt === 0) { badge.innerText = "DEBT FREE"; badge.className = "status-badge badge-primary"; }
        else if (icr < 1.0) { badge.innerText = "INSOLVENT / RISKY (<1.0x)"; badge.className = "status-badge badge-critical"; badgeColor='#be123c'; barColor='#ef4444'; }
        else if (icr < 1.5) { badge.innerText = "WARNING (<1.5x)"; badge.className = "status-badge badge-danger"; badgeColor='#ea580c'; barColor='#ea580c'; }
        else if (icr < 2.5) { badge.innerText = "MARGINAL (<2.5x)"; badge.className = "status-badge badge-warning"; badgeColor='#f59e0b'; barColor='#f59e0b'; }
        else if (icr < 5.0) { badge.innerText = "GOOD (>2.5x)"; badge.className = "status-badge badge-info"; badgeColor='#0284c7'; barColor='#0ea5e9'; }
        else { badge.innerText = "EXCELLENT (>5.0x)"; badge.className = "status-badge badge-optimal"; barColor='#10b981'; badgeColor='#047857'; }

        try {
            document.getElementById('icr-val').innerText = (intAmt === 0) ? "N/A" : icr.toFixed(2) + "x";
            document.getElementById('icr-val').style.color = badgeColor;
            
            document.getElementById('s-ebit').innerText = format(ebit);
            document.getElementById('s-int').innerText = format(intAmt);

            let maxIcr = 5.0;
            let pIcr = Math.min(100, Math.max(0, (icr / maxIcr) * 100));
            if(intAmt === 0) pIcr = 100;

            document.getElementById('bar-icr').style.width = pIcr + '%';
            document.getElementById('bar-icr').style.background = barColor;
        } catch(e) {}
    }
    
    ['ebit','int'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-blue').addEventListener('click', () => { document.getElementById('ebit').value=1000000; document.getElementById('int').value=100000; calc(); });
    document.getElementById('qa-avg').addEventListener('click', () => { document.getElementById('ebit').value=300000; document.getElementById('int').value=100000; calc(); });
    document.getElementById('qa-lev').addEventListener('click', () => { document.getElementById('ebit').value=150000; document.getElementById('int').value=100000; calc(); });
    document.getElementById('qa-fail').addEventListener('click', () => { document.getElementById('ebit').value=80000; document.getElementById('int').value=100000; calc(); });

    calc();
});
</script>

