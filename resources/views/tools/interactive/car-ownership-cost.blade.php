<div class="interactive-tool-grid car-ownership-cost">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Profile Overrides</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-danger" id="qa-comm" style="min-width: 280px; max-width: 100%;">Commuter (High Gas)</button>
                    <button class="btn btn-sm btn-outline-success" id="qa-ev" style="min-width: 280px; max-width: 100%;">EV (Zero Gas)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-teen" style="min-width: 280px; max-width: 100%;">Teen Driver (High Ins)</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-beater" style="min-width: 280px; max-width: 100%;">Used Beater (High Maint)</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-notax" style="min-width: 280px; max-width: 100%;">No Tax/Reg</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-paid" style="min-width: 280px; max-width: 100%;">Paid Off (No Loan)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Monthly Auto Loan/Lease ($)</label>
                    <input type="number" id="e-loan" class="form-control-custom e-val" value="550" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Monthly Fuel/Charge Est. ($)</label>
                    <input type="number" id="e-gas" class="form-control-custom e-val" value="150" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Monthly Insurance Prem. ($)</label>
                    <input type="number" id="e-ins" class="form-control-custom e-val" value="180" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Monthly Maintenance Reserve ($)</label>
                    <input type="number" id="e-maint" class="form-control-custom e-val" value="75" min="0">
                </div>
                <div class="col-12 form-group-custom mb-2 border-top pt-2">
                    <label class="form-label-custom text-danger">Annual Tax & Registration ($)</label>
                    <input type="number" id="e-tax" class="form-control-custom e-val-yr" value="400" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">True Monthly Cost</span>
            <h1 class="result-main-value" id="true-cost" style="color: #047857;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Core Payment (P&I)</td><td class="text-end fw-semibold text-secondary" id="sum-loan">$0</td></tr>
                    <tr><td>Operating & Carrying Costs</td><td class="text-end fw-bold text-danger" id="sum-op">$0</td></tr>
                    <tr><td class="pt-2 border-top">True Annual Burn</td><td class="text-end pt-2 border-top fw-bold fs-5" id="ann-burn">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const loan = parseFloat(document.getElementById('e-loan').value) || 0;
        let opMonth = 0;
        opMonth += parseFloat(document.getElementById('e-gas').value) || 0;
        opMonth += parseFloat(document.getElementById('e-ins').value) || 0;
        opMonth += parseFloat(document.getElementById('e-maint').value) || 0;
        
        let taxYr = parseFloat(document.getElementById('e-tax').value) || 0;
        opMonth += (taxYr / 12);
        
        const trueMonth = loan + opMonth;
        const annBurn = trueMonth * 12;
        
        try {
            document.getElementById('true-cost').innerText = format(trueMonth);
            document.getElementById('sum-loan').innerText = format(loan);
            document.getElementById('sum-op').innerText = format(opMonth);
            document.getElementById('ann-burn').innerText = format(annBurn);
        } catch(e) {}
    }
    
    document.querySelectorAll('.e-val, .e-val-yr').forEach(inp => inp.addEventListener('input', calc));
    
    // QA
    document.getElementById('qa-comm').addEventListener('click', () => { document.getElementById('e-gas').value = 400; calc(); });
    document.getElementById('qa-ev').addEventListener('click', () => { document.getElementById('e-gas').value = 20; calc(); });
    document.getElementById('qa-teen').addEventListener('click', () => { document.getElementById('e-ins').value = 450; calc(); });
    document.getElementById('qa-beater').addEventListener('click', () => { document.getElementById('e-maint').value = 300; document.getElementById('e-loan').value = 0; calc(); });
    document.getElementById('qa-notax').addEventListener('click', () => { document.getElementById('e-tax').value = 0; calc(); });
    document.getElementById('qa-paid').addEventListener('click', () => { document.getElementById('e-loan').value = 0; calc(); });
    
    calc();
});
</script>

