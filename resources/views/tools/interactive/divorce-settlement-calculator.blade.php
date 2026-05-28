<div class="interactive-tool-grid divorce-settlement-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <h5 class="text-secondary pb-2 border-bottom mb-3">Marital Assets</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Real Estate Equity ($)</label>
                    <input type="number" id="a-house" class="form-control-custom a-val" value="150000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Retirement/401k/IRA ($)</label>
                    <input type="number" id="a-ret" class="form-control-custom a-val" value="80000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Vehicles/Tangibles ($)</label>
                    <input type="number" id="a-car" class="form-control-custom a-val" value="30000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Cash & Bank Accounts ($)</label>
                    <input type="number" id="a-cash" class="form-control-custom a-val" value="15000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary pt-3 pb-2 border-bottom mb-3">Marital Liabilities</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Credit Card Debt ($)</label>
                    <input type="number" id="l-cc" class="form-control-custom l-val" value="12000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Personal Loans/Other ($)</label>
                    <input type="number" id="l-loan" class="form-control-custom l-val" value="8000" min="0">
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-3 mb-2">
                <h5 class="text-secondary mb-0">Distribution Target</h5>
                <div>
                    <button class="btn btn-sm btn-outline-success me-1" id="qa-50" style="min-width: 280px; max-width: 100%;">50/50 Split</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-60" style="min-width: 280px; max-width: 100%;">60/40 Split</button>
                </div>
            </div>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom text-primary">Party 1 Target Share (%)</label>
                <input type="range" id="split" class="form-range" min="1" max="99" value="50" step="1">
                <div class="d-flex justify-content-between" style="font-size:0.85rem; font-weight:bold;">
                    <span id="p1-disp" class="text-primary">Party 1: 50%</span>
                    <span id="p2-disp" class="text-danger">Party 2: 50%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <span class="result-label">Net Target For Party 1</span>
            <h1 class="result-main-value" id="net-p1" style="color: #0369a1;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Marital Assets</td><td class="text-end fw-semibold text-success" id="tot-a">$0</td></tr>
                    <tr><td>Total Marital Debt</td><td class="text-end fw-semibold text-danger" id="tot-l">-$0</td></tr>
                    <tr><td class="pt-2 border-top">Total Marital Net Worth</td><td class="text-end pt-2 border-top fw-bold fs-5" id="net-estate">$0</td></tr>
                </table>
            </div>
            
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light text-muted" style="font-size:0.85rem;">
                Party 2 Net Target: <strong id="net-p2" style="color:#ef4444;">$0</strong>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        let ast = 0; let lia = 0;
        document.querySelectorAll('.a-val').forEach(el => ast += (parseFloat(el.value)||0));
        document.querySelectorAll('.l-val').forEach(el => lia += (parseFloat(el.value)||0));
        
        const split = parseInt(document.getElementById('split').value) || 50;
        const p1Pct = split / 100;
        const p2Pct = 1 - p1Pct;
        
        document.getElementById('p1-disp').innerText = `Party 1: ${split}%`;
        document.getElementById('p2-disp').innerText = `Party 2: ${100-split}%`;
        
        const netEstate = ast - lia;
        
        const p1Val = netEstate * p1Pct;
        const p2Val = netEstate * p2Pct;
        
        try {
            document.getElementById('tot-a').innerText = format(ast);
            document.getElementById('tot-l').innerText = '-' + format(lia);
            document.getElementById('net-estate').innerText = (netEstate<0?'-':'') + format(Math.abs(netEstate));
            
            document.getElementById('net-p1').innerText = (p1Val<0?'-':'') + format(Math.abs(p1Val));
            document.getElementById('net-p1').style.color = p1Val < 0 ? "#ef4444" : "#0369a1";
            
            document.getElementById('net-p2').innerText = (p2Val<0?'-':'') + format(Math.abs(p2Val));
        } catch(e) {}
    }
    
    document.querySelectorAll('.a-val').forEach(inp => inp.addEventListener('input', calc));
    document.querySelectorAll('.l-val').forEach(inp => inp.addEventListener('input', calc));
    document.getElementById('split').addEventListener('input', calc);
    
    document.getElementById('qa-50').addEventListener('click', () => { document.getElementById('split').value = 50; calc(); });
    document.getElementById('qa-60').addEventListener('click', () => { document.getElementById('split').value = 60; calc(); });
    
    calc();
});
</script>

