@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid financial-health-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Archetypes</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-optimal" style="min-width: 280px; max-width: 100%; background:#10b981;color:#fff;border:none;" id="qa-fbi">FIRE (Financially Independent)</button>
                    <button class="qa-btn-component qa-primary" id="qa-high" style="min-width: 280px; max-width: 100%;">High Earner, Smart Saver</button>
                    <button class="qa-btn-component qa-warning" id="qa-henry" style="min-width: 280px; max-width: 100%;">HENRY (High Earner, Not Rich)</button>
                    <button class="qa-btn-component qa-danger" id="qa-debt" style="min-width: 280px; max-width: 100%;">Debt Heavy Consumer</button>
                    <button class="qa-btn-component qa-info" id="qa-avg" style="min-width: 280px; max-width: 100%;">Middle Class Average</button>
                    <button class="qa-btn-component qa-dark" id="qa-broke" style="min-width: 280px; max-width: 100%;">Negative Net Worth</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-success">Total Net Worth ($)</label>
                    <input type="number" id="nw" class="form-control-custom fw-bold" value="250000" min="-10000000">
                </div>
                <!-- Need Liquid for emergency test -->
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-primary">Liquid Assets ($)</label>
                    <input type="number" id="liq" class="form-control-custom fw-bold" value="25000">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Monthly Flows & Debt</h5>
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">Monthly Net Income ($)</label>
                    <input type="number" id="inc" class="form-control-custom" value="7000" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Total Bad Debt (Excl. Mort) ($)</label>
                    <input type="number" id="debt" class="form-control-custom" value="12000" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom">Avg Monthly Spend ($)</label>
                    <input type="number" id="spend" class="form-control-custom" value="4500" min="1">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Financial Wellness Index</span>
                <span id="health-badge" class="status-badge badge-optimal">Excellent</span>
            </div>
            <h1 class="result-main-value fs-1" id="score" style="color: #0284c7;">100 / 100</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Months of Runway</td><td class="text-end fw-semibold text-secondary" id="s-run">0</td></tr>
                    <tr><td>Savings Rate %</td><td class="text-end fw-bold text-success fs-6" id="s-sav">0%</td></tr>
                    <tr><td class="pt-2 border-top">Toxic Debt to Net Worth Ratio</td><td class="text-end pt-2 border-top fw-bold text-danger" id="s-dtw">0%</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Health Score Breakdown</p>
            <div class="enhanced-progress-bar" style="height:14px; background:#f1f5f9;">
                <div id="bar-score" class="enhanced-progress-segment" style="background:#0284c7; width:80%;"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const nw = parseFloat(document.getElementById('nw').value) || 0;
        const liq = parseFloat(document.getElementById('liq').value) || 0;
        const inc = parseFloat(document.getElementById('inc').value) || 1;
        const debt = parseFloat(document.getElementById('debt').value) || 0;
        const spend = parseFloat(document.getElementById('spend').value) || 1;

        const runway = liq / spend;
        const savRate = Math.max(0, ((inc - spend) / inc) * 100);
        const dtw = nw > 0 ? (debt / nw) * 100 : (debt > 0 ? 100 : 0);

        // Core score max 100
        // Runway (0 to 6 months) = 30 pts
        let ptRun = (runway / 6) * 30; if(ptRun > 30) ptRun = 30;
        // Savings rate (0 to 25%) = 30 pts
        let ptSav = (savRate / 25) * 30; if(ptSav > 30) ptSav = 30;
        // Lack of Toxic Debt = 30 pts (0 debt = 30, >10% of NW = 0)
        let ptDebt = 30 - ((dtw / 10) * 30); if(ptDebt > 30) ptDebt = 30; if(ptDebt < 0) ptDebt = 0;
        // Net worth buffer (positive) = 10 pts
        let ptNw = nw > 0 ? 10 : 0;

        let index = Math.floor(ptRun + ptSav + ptDebt + ptNw);
        if(index < 0) index = 0;

        let badge = document.getElementById('health-badge');
        let color = '#0284c7';
        if(index < 40) { badge.innerText = "FINANCIAL CRITICAL"; badge.className = "status-badge badge-critical"; color='#ef4444'; }
        else if (index < 60) { badge.innerText = "VULNERABLE"; badge.className = "status-badge badge-warning"; color='#f59e0b'; }
        else if (index < 85) { badge.innerText = "HEALTHY"; badge.className = "status-badge badge-info"; color='#0ea5e9'; }
        else { badge.innerText = "EXCELLENT SHAPE"; badge.className = "status-badge badge-optimal"; color='#10b981'; }

        try {
            document.getElementById('score').innerText = index + ' / 100';
            document.getElementById('score').style.color = color;
            
            document.getElementById('s-run').innerText = runway.toFixed(1) + ' mo';
            document.getElementById('s-sav').innerText = savRate.toFixed(1) + '%';
            document.getElementById('s-dtw').innerText = nw > 0 ? dtw.toFixed(1) + '%' : (nw<0?'Negative NW':'0%');

            document.getElementById('bar-score').style.width = index + '%';
            document.getElementById('bar-score').style.background = color;
        } catch(e) {}
    }
    
    ['nw','liq','inc','debt','spend'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-fbi').addEventListener('click', () => { document.getElementById('nw').value=2500000; document.getElementById('liq').value=150000; document.getElementById('inc').value=8000; document.getElementById('debt').value=0; document.getElementById('spend').value=4500; calc(); });
    document.getElementById('qa-high').addEventListener('click', () => { document.getElementById('nw').value=450000; document.getElementById('liq').value=60000; document.getElementById('inc').value=12000; document.getElementById('debt').value=8000; document.getElementById('spend').value=6000; calc(); });
    document.getElementById('qa-henry').addEventListener('click', () => { document.getElementById('nw').value=80000; document.getElementById('liq').value=15000; document.getElementById('inc').value=15000; document.getElementById('debt').value=120000; document.getElementById('spend').value=14500; calc(); });
    document.getElementById('qa-debt').addEventListener('click', () => { document.getElementById('nw').value=15000; document.getElementById('liq').value=2000; document.getElementById('inc').value=6000; document.getElementById('debt').value=45000; document.getElementById('spend').value=5900; calc(); });
    document.getElementById('qa-avg').addEventListener('click', () => { document.getElementById('nw').value=150000; document.getElementById('liq').value=8000; document.getElementById('inc').value=5500; document.getElementById('debt').value=12000; document.getElementById('spend').value=5000; calc(); });
    document.getElementById('qa-broke').addEventListener('click', () => { document.getElementById('nw').value=-35000; document.getElementById('liq').value=500; document.getElementById('inc').value=4000; document.getElementById('debt').value=38000; document.getElementById('spend').value=3900; calc(); });

    calc();
});
</script>

