@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid cash-burn-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Startup Types</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-seed" style="min-width: 280px; max-width: 100%;">Pre-Seed (Low Burn)</button>
                    <button class="qa-btn-component qa-danger" id="qa-series" style="min-width: 280px; max-width: 100%;">Series A (High Burn)</button>
                    <button class="qa-btn-component qa-warning" id="qa-red" style="min-width: 280px; max-width: 100%;">Red Alert (2 Months)</button>
                    <button class="qa-btn-component qa-success" id="qa-prof" style="min-width: 280px; max-width: 100%;">Default Alive</button>
                    <button class="qa-btn-component qa-info" id="qa-rev" style="min-width: 280px; max-width: 100%;">Revenue Generating</button>
                    <button class="qa-btn-component qa-dark" id="qa-zomb" style="min-width: 280px; max-width: 100%;">Zombie Mode</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Current Cash Balance ($)</label>
                    <input type="number" id="cash" class="form-control-custom text-primary fw-bold fs-5" value="500000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Monthly Run Rate</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Monthly Operating Expenses ($)</label>
                    <input type="number" id="opex" class="form-control-custom fw-bold" value="50000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-success">Monthly Revenue Generated ($)</label>
                    <input type="number" id="rev" class="form-control-custom fw-bold" value="5000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #ef4444;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Cash Runway</span>
                <span id="burn-badge" class="status-badge badge-warning">Checking</span>
            </div>
            <h1 class="result-main-value fs-1" id="time" style="color: #b91c1c;">0 mo</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Gross Burn Rate</td><td class="text-end fw-semibold text-danger" id="s-gross">$0</td></tr>
                    <tr><td>Net Burn Rate</td><td class="text-end fw-bold text-dark fs-6" id="s-net">$0</td></tr>
                    <tr><td class="pt-2 border-top">Zero Cash Date Estimate</td><td class="text-end pt-2 border-top fw-bold text-primary" id="s-date">--</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Runway Health Bar (Max 18 Mo)</p>
            <div class="enhanced-progress-bar" style="height:12px; background: #fee2e2;">
                <div id="bar-run" class="enhanced-progress-segment" style="background:#ef4444; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#ef4444;font-weight:bold;">Dead</span>
                <span style="color:#10b981;font-weight:bold;">18+ Months Safe</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const cash = parseFloat(document.getElementById('cash').value) || 0;
        const opex = parseFloat(document.getElementById('opex').value) || 0;
        const rev = parseFloat(document.getElementById('rev').value) || 0;

        const netBurn = opex - rev;
        
        let runway = 0;
        let timeStr = "";
        let isAlive = false;

        if (netBurn <= 0) {
            isAlive = true;
            timeStr = "Infinite";
        } else {
            runway = cash / netBurn;
            timeStr = runway.toFixed(1) + " Months";
        }

        let badge = document.getElementById('burn-badge');
        let color = '#b91c1c';
        let barColor = '#ef4444';
        
        if (isAlive) {
            badge.innerText = "DEFAULT ALIVE"; badge.className = "status-badge badge-optimal"; color='#10b981'; barColor='#10b981';
        } else if (runway < 3) {
            badge.innerText = "DEATH SPIRAL"; badge.className = "status-badge badge-critical"; color='#ef4444'; barColor='#ef4444';
        } else if (runway < 9) {
            badge.innerText = "TIGHT RUNWAY"; badge.className = "status-badge badge-warning"; color='#ea580c'; barColor='#f59e0b';
        } else if (runway >= 18) {
            badge.innerText = "SAFE SECURE"; badge.className = "status-badge badge-optimal"; color='#0d9488'; barColor='#14b8a6';
        } else {
            badge.innerText = "RAISE SOON"; badge.className = "status-badge badge-info"; color='#0284c7'; barColor='#38bdf8';
        }

        try {
            document.getElementById('time').innerText = timeStr;
            document.getElementById('time').style.color = color;
            
            document.getElementById('s-gross').innerText = format(opex);
            document.getElementById('s-net').innerText = format(netBurn);
            
            if(isAlive) {
                document.getElementById('s-date').innerText = "Never (Profitable)";
                document.getElementById('bar-run').style.width = '100%';
                document.getElementById('bar-run').style.background = '#10b981';
            } else {
                let d = new Date();
                d.setMonth(d.getMonth() + Math.floor(runway));
                document.getElementById('s-date').innerText = d.toLocaleDateString('en-US', {month: 'long', year: 'numeric'});
                
                let w = (runway / 18) * 100;
                if(w > 100) w = 100;
                document.getElementById('bar-run').style.width = w + '%';
                document.getElementById('bar-run').style.background = barColor;
            }
        } catch(e) {}
    }
    
    ['cash','opex','rev'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-seed').addEventListener('click', () => { document.getElementById('cash').value=250000; document.getElementById('opex').value=15000; document.getElementById('rev').value=0; calc(); });
    document.getElementById('qa-series').addEventListener('click', () => { document.getElementById('cash').value=5000000; document.getElementById('opex').value=350000; document.getElementById('rev').value=50000; calc(); });
    document.getElementById('qa-red').addEventListener('click', () => { document.getElementById('cash').value=80000; document.getElementById('opex').value=50000; document.getElementById('rev').value=10000; calc(); });
    document.getElementById('qa-prof').addEventListener('click', () => { document.getElementById('cash').value=150000; document.getElementById('opex').value=20000; document.getElementById('rev').value=22000; calc(); });
    document.getElementById('qa-rev').addEventListener('click', () => { document.getElementById('cash').value=800000; document.getElementById('opex').value=90000; document.getElementById('rev').value=45000; calc(); });
    document.getElementById('qa-zomb').addEventListener('click', () => { document.getElementById('cash').value=15000; document.getElementById('opex').value=2000; document.getElementById('rev').value=1500; calc(); });

    calc();
});
</script>

