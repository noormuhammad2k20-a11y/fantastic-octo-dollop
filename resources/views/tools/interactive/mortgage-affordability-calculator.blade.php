<div class="interactive-tool-grid mortgage-affordability-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Annual Gross Income ($)</label>
                    <input type="number" id="inc" class="form-control-custom" value="120000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Available Down Payment ($)</label>
                    <input type="number" id="dp" class="form-control-custom" value="50000" min="0">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3 border-top pt-3">
                <h5 class="text-secondary mb-0">Monthly Liabilities & Escrow</h5>
                <div>
                    <button class="btn btn-sm btn-outline-danger" id="qa-max" style="min-width: 280px; max-width: 100%;">Max Approval</button>
                    <button class="btn btn-sm btn-outline-success ms-1" id="qa-con" style="min-width: 280px; max-width: 100%;">Conservative</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Existing Monthly Debt ($)</label>
                    <input type="number" id="debt" class="form-control-custom" value="600" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Est. Property Tax (Yearly %)</label>
                    <input type="number" id="tax" class="form-control-custom" value="1.2" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Est. Home Insurance (Yearly $)</label>
                    <input type="number" id="ins" class="form-control-custom" value="1200" min="0" step="100">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">HOA Fees (Monthly $)</label>
                    <input type="number" id="hoa" class="form-control-custom" value="0" min="0">
                </div>
            </div>

            <div class="row pt-2 border-top mt-2">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Interest Rate (%)</label>
                    <input type="number" id="rate" class="form-control-custom" value="6.5" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">DTI Limit (%)</label>
                    <input type="number" id="dti" class="form-control-custom" value="36" max="50">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #2563eb;">
            <span class="result-label">Maximum Home Price</span>
            <h1 class="result-main-value" id="max-price" style="color: #1e40af;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Max Monthly Housing Cost (PITI)</td><td class="text-end fw-semibold text-danger" id="max-piti">$0</td></tr>
                    <tr><td>Required Loan Amount</td><td class="text-end fw-bold text-dark" id="req-loan">$0</td></tr>
                </table>
            </div>
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light text-muted" style="font-size:0.85rem;">
                Based on <span id="r-dti">36</span>% Debt-to-Income ratio.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        // Brute force the max price to account for dynamic property taxes
        const inc = parseFloat(document.getElementById('inc').value) || 0;
        const dp = parseFloat(document.getElementById('dp').value) || 0;
        const debt = parseFloat(document.getElementById('debt').value) || 0;
        const taxRate = (parseFloat(document.getElementById('tax').value) || 0) / 100 / 12; // monthly pct
        const ins = (parseFloat(document.getElementById('ins').value) || 0) / 12;
        const hoa = parseFloat(document.getElementById('hoa').value) || 0;
        const rate = (parseFloat(document.getElementById('rate').value) || 0) / 100 / 12;
        const dti = parseFloat(document.getElementById('dti').value) || 36;
        document.getElementById('r-dti').innerText = dti;
        
        const moInc = inc / 12;
        const maxTotalPmt = moInc * (dti / 100);
        const maxPiti = Math.max(0, maxTotalPmt - debt);
        
        // PITI = P&I + Tax + Ins + HOA
        // PI = maxPiti - Ins - HOA - Tax
        // Since Tax = Price * taxRate, and Price = Loan + DP, it's recursive.
        // Let's use a bisection search approach for exactly matching the price
        
        let low = dp;
        let high = 5000000;
        let bestPrice = dp;
        
        for(let i=0; i<40; i++) {
            let mid = (low + high) / 2;
            let loan = mid - dp;
            let pmi = 0;
            if(loan > 0 && dp / mid < 0.2) pmi = (loan * 0.005) / 12; // 0.5% yearly pmi est
            
            let pi = 0;
            if(rate > 0) pi = loan * (rate / (1 - Math.pow(1 + rate, -360)));
            else pi = loan / 360;
            
            let t = mid * taxRate;
            let calcPiti = pi + t + ins + hoa + pmi;
            
            if (calcPiti > maxPiti) { high = mid; }
            else { low = mid; bestPrice = mid; }
        }
        
        const loanObj = Math.max(0, bestPrice - dp);
        
        try {
            document.getElementById('max-price').innerText = format(bestPrice);
            document.getElementById('max-piti').innerText = format(maxPiti);
            document.getElementById('req-loan').innerText = format(loanObj);
        } catch(e) {}
    }
    
    ['inc','dp','debt','tax','ins','hoa','rate','dti'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    document.getElementById('qa-max').addEventListener('click', () => { document.getElementById('dti').value = 45; calc(); });
    document.getElementById('qa-con').addEventListener('click', () => { document.getElementById('dti').value = 28; calc(); });
    
    calc();
});
</script>

