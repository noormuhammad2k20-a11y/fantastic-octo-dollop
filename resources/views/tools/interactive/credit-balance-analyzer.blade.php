@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid credit-balance-analyzer">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Payment Habits</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-danger" id="qa-min" style="min-width: 280px; max-width: 100%;">Minimum Payments Only</button>
                    <button class="qa-btn-component qa-primary" id="qa-db" style="min-width: 280px; max-width: 100%;">Double Minimum</button>
                    <button class="qa-btn-component qa-success" id="qa-agg" style="min-width: 280px; max-width: 100%;">Aggressive Target</button>
                    <button class="qa-btn-component qa-warning" id="qa-trap" style="min-width: 280px; max-width: 100%;">High APR Trap (29%)</button>
                    <button class="qa-btn-component qa-info" id="qa-low" style="min-width: 280px; max-width: 100%;">Promo Rate (5%)</button>
                    <button class="qa-btn-component qa-dark" id="qa-huge" style="min-width: 280px; max-width: 100%;">Massive Debt ($30k)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-danger">Current Debt Balance ($)</label>
                    <input type="number" id="bal" class="form-control-custom fw-bold fs-5" value="5000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-warning">Annual Percentage Rate (APR %)</label>
                    <input type="number" id="apr" class="form-control-custom fw-bold" value="19.99" step="0.1">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Commitment</h5>
            <div class="row">
                <div class="col-md-12 form-group-custom mb-2">
                    <label class="form-label-custom text-success">Planned Monthly Payment ($)</label>
                    <input type="range" id="pay-slider" class="form-range" min="50" max="2500" value="250" step="10">
                    <div class="text-center text-muted fw-bold">$<span id="pay-disp">250</span> / month</div>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #a855f7;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Months Until Debt Free</span>
                <span id="bal-badge" class="status-badge badge-warning">Carrying Debt</span>
            </div>
            <h1 class="result-main-value fs-1" id="mo" style="color: #7e22ce;">0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Expected Interest Paid</td><td class="text-end fw-bold text-danger fs-6" id="s-int">$0</td></tr>
                    <tr><td>Total Amount Repaid (Principal+Int)</td><td class="text-end fw-semibold text-secondary" id="s-tot">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">True Cost Ratio</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-prin" class="enhanced-progress-segment" style="background:#64748b; width:80%;"></div>
                <div id="bar-int" class="enhanced-progress-segment" style="background:#ef4444; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#64748b;font-weight:bold;">Original Principal</span>
                <span style="color:#ef4444;font-weight:bold;">Interest Siphon</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }
    function calc() {
        const bal = parseFloat(document.getElementById('bal').value) || 0;
        const apr = (parseFloat(document.getElementById('apr').value) || 0) / 100;
        let pay = parseFloat(document.getElementById('pay-slider').value) || 0;

        document.getElementById('pay-disp').innerText = pay;

        const moRate = apr / 12;
        
        let months = 0;
        let totalInt = 0;
        let isTrapped = false;

        if (bal > 0) {
            const minAllowed = bal * moRate;
            if (pay <= minAllowed) {
                isTrapped = true;
            } else {
                months = -Math.log(1 - (moRate * bal) / pay) / Math.log(1 + moRate);
                totalInt = (months * pay) - bal;
            }
        }

        let badge = document.getElementById('bal-badge');
        let color = '#7e22ce';

        if(isTrapped) {
            badge.innerText = "FOREVER TRAPPED"; badge.className = "status-badge badge-critical"; color='#ef4444';
        } else if (months > 60) {
            badge.innerText = "DECADE OF DEBT"; badge.className = "status-badge badge-danger";
        } else if (months > 24) {
            badge.innerText = "SLOW BURN"; badge.className = "status-badge badge-warning";
        } else if (months > 0) {
            badge.innerText = "AGGRESSIVE PATH"; badge.className = "status-badge badge-info";
        } else {
            badge.innerText = "DEBT FREE"; badge.className = "status-badge badge-optimal";
        }

        try {
            if(isTrapped) {
                document.getElementById('mo').innerText = "Never";
                document.getElementById('mo').style.color = '#ef4444';
                document.getElementById('s-int').innerText = "Infinite";
                document.getElementById('s-tot').innerText = "Infinite";
                document.getElementById('bar-prin').style.width = '10%';
                document.getElementById('bar-int').style.width = '90%';
            } else {
                document.getElementById('mo').innerText = Math.ceil(months) + " Months";
                document.getElementById('mo').style.color = color;
                document.getElementById('s-int').innerText = format(totalInt);
                document.getElementById('s-tot').innerText = format(bal + totalInt);

                if(bal > 0) {
                    const prinPct = (bal / (bal + totalInt)) * 100;
                    const intPct = 100 - prinPct;
                    document.getElementById('bar-prin').style.width = prinPct + '%';
                    document.getElementById('bar-int').style.width = intPct + '%';
                } else {
                    document.getElementById('bar-prin').style.width = '100%';
                    document.getElementById('bar-int').style.width = '0%';
                }
            }
        } catch(e) {}
    }
    
    ['bal','apr','pay-slider'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    // Dynamic slider range based on balance
    document.getElementById('bal').addEventListener('change', function() {
        let b = parseFloat(this.value) || 0;
        let s = document.getElementById('pay-slider');
        s.max = Math.max(2500, Math.ceil(b/2));
        calc();
    });

    document.getElementById('qa-min').addEventListener('click', () => { document.getElementById('bal').value=5000; document.getElementById('apr').value=21; let minP = (5000*(21/100)/12) + 10; document.getElementById('pay-slider').value=minP; calc(); });
    document.getElementById('qa-db').addEventListener('click', () => { document.getElementById('bal').value=5000; document.getElementById('apr').value=19.99; let minP = (5000*(19.99/100)/12) + 10; document.getElementById('pay-slider').value=minP*2; calc(); });
    document.getElementById('qa-agg').addEventListener('click', () => { document.getElementById('bal').value=5000; document.getElementById('apr').value=19.99; document.getElementById('pay-slider').value=1000; calc(); });
    document.getElementById('qa-trap').addEventListener('click', () => { document.getElementById('bal').value=8000; document.getElementById('apr').value=29.99; document.getElementById('pay-slider').value=250; calc(); });
    document.getElementById('qa-low').addEventListener('click', () => { document.getElementById('bal').value=15000; document.getElementById('apr').value=5.0; document.getElementById('pay-slider').value=500; calc(); });
    document.getElementById('qa-huge').addEventListener('click', () => { document.getElementById('bal').value=30000; document.getElementById('apr').value=18; document.getElementById('pay-slider').max=15000; document.getElementById('pay-slider').value=800; calc(); });

    calc();
});
</script>

