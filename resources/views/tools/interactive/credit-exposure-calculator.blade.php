@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid credit-exposure-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Portfolio Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-optimal" style="min-width: 280px; max-width: 100%; background:#10b981;color:#fff;border:none;" id="qa-clean">Zero Balances (Safe)</button>
                    <button class="qa-btn-component qa-primary" id="qa-avg" style="min-width: 280px; max-width: 100%;">Normal Usage</button>
                    <button class="qa-btn-component qa-warning" id="qa-heavy" style="min-width: 280px; max-width: 100%;">Heavy Utilization (One Maxed)</button>
                    <button class="qa-btn-component qa-danger" id="qa-max" style="min-width: 280px; max-width: 100%;">All Cards Maxed Out</button>
                    <button class="qa-btn-component qa-info" id="qa-huge" style="min-width: 280px; max-width: 100%;">Massive Limits ($100k+)</button>
                    <button class="qa-btn-component qa-dark" id="qa-thin" style="min-width: 280px; max-width: 100%;">Thin File / Low Limits</button>
                </div>
            </div>

            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Primary Card</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Card 1 Limit ($)</label>
                    <input type="number" id="l1" class="form-control-custom" value="10000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-danger">Card 1 Balance ($)</label>
                    <input type="number" id="b1" class="form-control-custom" value="1500" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Secondary / Backup Cards</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Card 2 Limit ($)</label>
                    <input type="number" id="l2" class="form-control-custom" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-danger">Card 2 Balance ($)</label>
                    <input type="number" id="b2" class="form-control-custom" value="0" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Card 3 Limit ($)</label>
                    <input type="number" id="l3" class="form-control-custom" value="2500" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-danger">Card 3 Balance ($)</label>
                    <input type="number" id="b3" class="form-control-custom" value="2400" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f43f5e;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Total Credit Exposure Rate</span>
                <span id="exp-badge" class="status-badge badge-optimal">Very Safe</span>
            </div>
            <h1 class="result-main-value fs-1" id="rate" style="color: #be123c;">0%</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Available Credit Limits</td><td class="text-end fw-semibold text-secondary" id="s-lim">$0</td></tr>
                    <tr><td>Aggregate Utilization Balance</td><td class="text-end fw-bold text-danger fs-6" id="s-bal">$0</td></tr>
                    <tr><td class="pt-2 border-top">Individual Card Max Danger</td><td class="text-end pt-2 border-top fw-bold text-dark" id="s-warn">None</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Aggregate Portfolio Pressure</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-exp" class="enhanced-progress-segment" style="background:#10b981; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#64748b;font-weight:bold;">0%</span>
                <span style="color:#ef4444;font-weight:bold;">100% Maxed</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }
    function calc() {
        const l1 = parseFloat(document.getElementById('l1').value) || 0;
        const b1 = parseFloat(document.getElementById('b1').value) || 0;
        const l2 = parseFloat(document.getElementById('l2').value) || 0;
        const b2 = parseFloat(document.getElementById('b2').value) || 0;
        const l3 = parseFloat(document.getElementById('l3').value) || 0;
        const b3 = parseFloat(document.getElementById('b3').value) || 0;

        const totLim = l1 + l2 + l3;
        const totBal = b1 + b2 + b3;
        const rate = totLim > 0 ? (totBal / totLim) * 100 : 0;

        // Individual danger check
        let c1r = l1>0 ? b1/l1 : 0;
        let c2r = l2>0 ? b2/l2 : 0;
        let c3r = l3>0 ? b3/l3 : 0;
        
        let warn = "None";
        if(c1r > 0.9 || c2r > 0.9 || c3r > 0.9) {
            warn = "Card(s) Maxed (>90%)";
        } else if (c1r > 0.5 || c2r > 0.5 || c3r > 0.5) {
            warn = "High Individual Ratio";
        }

        let badge = document.getElementById('exp-badge');
        let color = '#be123c';
        let barColor = '#10b981';

        if(rate > 80) { badge.innerText = "SEVERE EXPOSURE"; badge.className = "status-badge badge-critical"; color='#ef4444'; barColor='#ef4444'; }
        else if (rate > 30) { badge.innerText = "ELEVATED RISK"; badge.className = "status-badge badge-warning"; color='#f59e0b'; barColor='#f59e0b'; }
        else if (rate > 10) { badge.innerText = "STANDARD USE"; badge.className = "status-badge badge-info"; color='#0ea5e9'; barColor='#3b82f6'; }
        else { badge.innerText = "EXCELLENT STANDING"; badge.className = "status-badge badge-optimal"; color='#047857'; barColor='#10b981'; }

        try {
            document.getElementById('rate').innerText = rate.toFixed(1) + '%';
            document.getElementById('rate').style.color = color;
            
            document.getElementById('s-lim').innerText = format(totLim);
            document.getElementById('s-bal').innerText = format(totBal);
            
            let warnObj = document.getElementById('s-warn');
            warnObj.innerText = warn;
            warnObj.style.color = warn === "Card(s) Maxed (>90%)" ? '#ef4444' : (warn === "None" ? '#10b981' : '#f59e0b');

            document.getElementById('bar-exp').style.width = Math.min(100, rate) + '%';
            document.getElementById('bar-exp').style.background = barColor;
        } catch(e) {}
    }
    
    ['l1','b1','l2','b2','l3','b3'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-clean').addEventListener('click', () => { document.getElementById('l1').value=15000; document.getElementById('b1').value=0; document.getElementById('l2').value=8000; document.getElementById('b2').value=0; document.getElementById('l3').value=5000; document.getElementById('b3').value=0; calc(); });
    document.getElementById('qa-avg').addEventListener('click', () => { document.getElementById('l1').value=10000; document.getElementById('b1').value=1500; document.getElementById('l2').value=5000; document.getElementById('b2').value=0; document.getElementById('l3').value=2500; document.getElementById('b3').value=150; calc(); });
    document.getElementById('qa-heavy').addEventListener('click', () => { document.getElementById('l1').value=12000; document.getElementById('b1').value=4500; document.getElementById('l2').value=3000; document.getElementById('b2').value=2900; document.getElementById('l3').value=1500; document.getElementById('b3').value=100; calc(); });
    document.getElementById('qa-max').addEventListener('click', () => { document.getElementById('l1').value=5000; document.getElementById('b1').value=4950; document.getElementById('l2').value=3000; document.getElementById('b2').value=2980; document.getElementById('l3').value=1500; document.getElementById('b3').value=1450; calc(); });
    document.getElementById('qa-huge').addEventListener('click', () => { document.getElementById('l1').value=80000; document.getElementById('b1').value=5000; document.getElementById('l2').value=35000; document.getElementById('b2').value=150; document.getElementById('l3').value=25000; document.getElementById('b3').value=0; calc(); });
    document.getElementById('qa-thin').addEventListener('click', () => { document.getElementById('l1').value=1000; document.getElementById('b1').value=850; document.getElementById('l2').value=0; document.getElementById('b2').value=0; document.getElementById('l3').value=0; document.getElementById('b3').value=0; calc(); });

    calc();
});
</script>

