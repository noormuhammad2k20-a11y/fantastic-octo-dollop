<div class="interactive-tool-grid car-loan-affordability">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Finance Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-d10" style="min-width: 280px; max-width: 100%;">Conservative (10% DTI)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-d20" style="min-width: 280px; max-width: 100%;">Aggressive (20% DTI)</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-tr" style="min-width: 280px; max-width: 100%;">Luxury Trade-In</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-hi" style="min-width: 280px; max-width: 100%;">High Interest</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-60m" style="min-width: 280px; max-width: 100%;">60-Mo Term</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-0d" style="min-width: 280px; max-width: 100%;">Zero Down</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Monthly Gross Income ($)</label>
                    <input type="number" id="inc" class="form-control-custom" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Max Auto Budget % (of Income)</label>
                    <input type="number" id="pct" class="form-control-custom text-primary fw-bold" value="15" min="1" max="50">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Monthly Auto Insurance Est. ($)</label>
                    <input type="number" id="ins" class="form-control-custom" value="150" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Expected Loan Term (Months)</label>
                    <input type="number" id="term" class="form-control-custom" value="48" step="12">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Interest Rate (APR %)</label>
                    <input type="number" id="rate" class="form-control-custom" value="7.5" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-success">Down Payment ($)</label>
                    <input type="number" id="dp" class="form-control-custom" value="2000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-success">Trade-in Value ($)</label>
                    <input type="number" id="tr" class="form-control-custom" value="1500" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">Max Affordable Car Price</span>
            <h1 class="result-main-value" id="max-car" style="color: #047857;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Monthly Car Budget</td><td class="text-end fw-semibold text-secondary" id="tar-bud">$0</td></tr>
                    <tr><td>Max Monthly Payment (P&I)</td><td class="text-end fw-bold text-primary" id="max-pi">$0</td></tr>
                    <tr><td class="pt-2 border-top">Equities Applied (Down + Trade)</td><td class="text-end pt-2 border-top fw-bold text-success" id="tot-eq">+$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function pv(rate, nper, pmt) {
        if(rate===0) return pmt * nper;
        return pmt * ((1 - Math.pow(1 + rate, -nper)) / rate);
    }
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const inc = parseFloat(document.getElementById('inc').value) || 0;
        const pct = (parseFloat(document.getElementById('pct').value) || 15) / 100;
        const ins = parseFloat(document.getElementById('ins').value) || 0;
        
        const term = parseInt(document.getElementById('term').value) || 48;
        const rate = (parseFloat(document.getElementById('rate').value) || 0) / 100 / 12;
        
        const dp = parseFloat(document.getElementById('dp').value) || 0;
        const tr = parseFloat(document.getElementById('tr').value) || 0;
        
        const totalBudget = inc * pct;
        // The Monthly PI payment you can afford is Budget - Insurance
        const maxPi = Math.max(0, totalBudget - ins);
        
        // Find max loan amount
        const maxLoan = pv(rate, term, maxPi);
        
        // Price = Loan + Down + Trade-in (ignoring sales tax for basic affordability logic)
        const equities = dp + tr;
        const maxPrice = maxLoan + equities;
        
        try {
            document.getElementById('max-car').innerText = format(maxPrice);
            document.getElementById('tar-bud').innerText = format(totalBudget);
            document.getElementById('max-pi').innerText = format(maxPi);
            document.getElementById('tot-eq').innerText = '+' + format(equities);
        } catch(e) {}
    }
    
    ['inc','pct','ins','term','rate','dp','tr'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-d10').addEventListener('click', () => { document.getElementById('pct').value = 10; calc(); });
    document.getElementById('qa-d20').addEventListener('click', () => { document.getElementById('pct').value = 20; calc(); });
    document.getElementById('qa-tr').addEventListener('click', () => { document.getElementById('tr').value = 15000; calc(); });
    document.getElementById('qa-hi').addEventListener('click', () => { document.getElementById('rate').value = 14.5; calc(); });
    document.getElementById('qa-60m').addEventListener('click', () => { document.getElementById('term').value = 60; calc(); });
    document.getElementById('qa-0d').addEventListener('click', () => { document.getElementById('dp').value = 0; document.getElementById('tr').value = 0; calc(); });
    
    calc();
});
</script>

