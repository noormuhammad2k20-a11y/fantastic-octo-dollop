<div class="interactive-tool-grid borrowing-capacity-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Annual Gross Income ($)</label>
                    <input type="number" id="inc" class="form-control-custom" value="90000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Current Monthly Debt ($)</label>
                    <input type="number" id="debt" class="form-control-custom" value="500" min="0">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3 border-bottom pb-2 mb-3">
                <h5 class="text-secondary mb-0">Underwriting Limits</h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary me-1" id="qa-conv" style="min-width: 280px; max-width: 100%;">Conventional (36%)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-fha" style="min-width: 280px; max-width: 100%;">FHA (43%)</button>
                </div>
            </div>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom text-danger">Max Allowed Debt-to-Income (DTI %)</label>
                <input type="range" id="dti-rng" class="form-range" min="20" max="55" value="36" step="1">
                <div class="text-center fw-bold text-danger" id="dti-disp">36%</div>
            </div>

            <div class="row pt-2 border-top">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Target Interest Rate (%)</label>
                    <input type="number" id="rate" class="form-control-custom" value="6.5" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Term (Months)</label>
                    <input type="number" id="term" class="form-control-custom" value="360" step="12">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f59e0b;">
            <span class="result-label">Maximum Borrowing Power</span>
            <h1 class="result-main-value" id="max-loan" style="color: #d97706;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Gross Monthly Income</td><td class="text-end fw-semibold text-secondary" id="mo-inc">$0</td></tr>
                    <tr><td>Max Allowed Monthly Payment</td><td class="text-end fw-bold text-success" id="max-pay">$0</td></tr>
                </table>
            </div>
            <div class="alert mt-3 border-0 p-2 rounded bg-light text-muted text-center" style="font-size:0.85rem;">
                Taxes, insurance, and HOA fees will reduce the actual loan amount you qualify for.
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
        const debt = parseFloat(document.getElementById('debt').value) || 0;
        const dti = parseInt(document.getElementById('dti-rng').value) || 36;
        document.getElementById('dti-disp').innerText = dti + '%';
        
        const rate = (parseFloat(document.getElementById('rate').value) || 0) / 100 / 12;
        const term = parseInt(document.getElementById('term').value) || 1;
        
        const moInc = inc / 12;
        const maxDebtTotal = moInc * (dti / 100);
        const maxPay = Math.max(0, maxDebtTotal - debt);
        
        const maxLoan = pv(rate, term, maxPay);
        
        try {
            document.getElementById('max-loan').innerText = format(maxLoan);
            document.getElementById('mo-inc').innerText = format(moInc);
            document.getElementById('max-pay').innerText = format(maxPay);
        } catch(e) {}
    }
    
    ['inc','debt','dti-rng','rate','term'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    document.getElementById('qa-conv').addEventListener('click', () => { document.getElementById('dti-rng').value = 36; calc(); });
    document.getElementById('qa-fha').addEventListener('click', () => { document.getElementById('dti-rng').value = 43; calc(); });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\borrowing-capacity-calculator.blade.php ENDPATH**/ ?>