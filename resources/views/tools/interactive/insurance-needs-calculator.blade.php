<div class="interactive-tool-grid insurance-needs-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Demographic Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard DIME (10yr)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-agg" style="min-width: 280px; max-width: 100%;">Aggressive (20yr Income)</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-nokid" style="min-width: 280px; max-width: 100%;">No Kids/DINK</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-max" style="min-width: 280px; max-width: 100%;">Breadwinner Max</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-min" style="min-width: 280px; max-width: 100%;">Minimum Basic (5yr)</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-retire" style="min-width: 280px; max-width: 100%;">Retiree (Final Exp)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Outstanding Mortgage ($)</label>
                    <input type="number" id="mort" class="form-control-custom d-val" value="350000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Other Debts (CC/Auto) ($)</label>
                    <input type="number" id="debt" class="form-control-custom d-val" value="25000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Education/College Fund ($)</label>
                    <input type="number" id="edu" class="form-control-custom d-val" value="100000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Final Expenses/Funeral ($)</label>
                    <input type="number" id="fun" class="form-control-custom d-val" value="15000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-3 pb-2 border-bottom mb-2">Income Replacement</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-primary">Annual Salary to Replace ($)</label>
                    <input type="number" id="inc" class="form-control-custom" value="85000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-danger">Years to Replace Income</label>
                    <input type="number" id="yrs" class="form-control-custom" value="10" min="1" max="40">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #8b5cf6;">
            <span class="result-label">Recommended Death Benefit</span>
            <h1 class="result-main-value" id="tot-need" style="color: #6d28d9;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Debt Payoff Needs</td><td class="text-end fw-semibold text-danger" id="s-debt">$0</td></tr>
                    <tr><td>Total Income Replacement Needs</td><td class="text-end fw-semibold text-primary" id="s-inc">$0</td></tr>
                    <tr><td>Legacy/Education Needs</td><td class="text-end fw-semibold text-success" id="s-leg">$0</td></tr>
                </table>
            </div>
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light text-muted" style="font-size:0.85rem;">
                Based on the D.I.M.E method (Debt, Income, Mortgage, Education) minus current assets.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const mort = parseFloat(document.getElementById('mort').value) || 0;
        const debt = parseFloat(document.getElementById('debt').value) || 0;
        const fun = parseFloat(document.getElementById('fun').value) || 0;
        const edu = parseFloat(document.getElementById('edu').value) || 0;
        
        const inc = parseFloat(document.getElementById('inc').value) || 0;
        const yrs = parseFloat(document.getElementById('yrs').value) || 0;
        
        const debtTotal = mort + debt + fun;
        const incTotal = inc * yrs;
        const legTotal = edu;
        
        const grandTotal = debtTotal + incTotal + legTotal;
        
        try {
            document.getElementById('tot-need').innerText = format(grandTotal);
            document.getElementById('s-debt').innerText = format(debtTotal);
            document.getElementById('s-inc').innerText = format(incTotal);
            document.getElementById('s-leg').innerText = format(legTotal);
        } catch(e) {}
    }
    
    document.querySelectorAll('.d-val, #inc, #yrs').forEach(inp => inp.addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('yrs').value=10; document.getElementById('edu').value=100000; calc(); });
    document.getElementById('qa-agg').addEventListener('click', () => { document.getElementById('yrs').value=20; document.getElementById('edu').value=200000; calc(); });
    document.getElementById('qa-nokid').addEventListener('click', () => { document.getElementById('edu').value=0; calc(); });
    document.getElementById('qa-max').addEventListener('click', () => { document.getElementById('mort').value=600000; document.getElementById('inc').value=150000; document.getElementById('yrs').value=25; calc(); });
    document.getElementById('qa-min').addEventListener('click', () => { document.getElementById('mort').value=0; document.getElementById('edu').value=0; document.getElementById('yrs').value=5; calc(); });
    document.getElementById('qa-retire').addEventListener('click', () => { document.getElementById('mort').value=0; document.getElementById('debt').value=5000; document.getElementById('inc').value=0; document.getElementById('edu').value=0; calc(); });
    
    calc();
});
</script>

