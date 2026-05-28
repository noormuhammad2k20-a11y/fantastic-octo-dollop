<div class="interactive-tool-grid medical-expense-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Funding & Investing Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-fam" style="min-width: 280px; max-width: 100%;">Max Family HSA ($8,300)</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-sing" style="min-width: 280px; max-width: 100%;">Max Single HSA ($4,150)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-zero" style="min-width: 280px; max-width: 100%;">Zero Contributions</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-agg" style="min-width: 280px; max-width: 100%;">Aggressive Market (10%)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-con" style="min-width: 280px; max-width: 100%;">Bonds/Conservative (4%)</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-cash" style="min-width: 280px; max-width: 100%;">Spend All on Bills</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Annual HSA Contribution ($)</label>
                    <input type="number" id="cont" class="form-control-custom text-success fw-bold" value="4150" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Annual Medical Withdrawals ($)</label>
                    <input type="number" id="with" class="form-control-custom text-danger fw-bold" value="1000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-top pt-3">
                    <label class="form-label-custom">Expected Annual Yield (%)</label>
                    <input type="number" id="yld" class="form-control-custom" value="7" step="0.5">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-top pt-3">
                    <label class="form-label-custom">Years to Project</label>
                    <input type="number" id="yrs" class="form-control-custom" value="10" min="1" max="40">
                </div>
            </div>

            <div class="form-group-custom mb-3 border-top pt-3">
                <label class="form-label-custom text-primary fw-bold">Current Tax Bracket (%)</label>
                <input type="range" id="tax-bracket" class="form-range" min="10" max="37" value="24" step="2">
                <div class="text-center text-primary fw-bold" id="tax-disp">24%</div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">HSA Balance at Year <span id="r-yr">10</span></span>
            <h1 class="result-main-value" id="bal" style="color: #047857;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Out of pocket contributions</td><td class="text-end fw-semibold text-secondary" id="sum-in">$0</td></tr>
                    <tr><td>Total Medical Expenses Paid</td><td class="text-end fw-semibold text-secondary" id="sum-out">-$0</td></tr>
                    <tr><td class="pt-2 border-top">Total Investment Growth</td><td class="text-end pt-2 border-top fw-bold text-primary" id="sum-grow">+$0</td></tr>
                </table>
            </div>
            
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light fw-bold" style="color:#0ea5e9; font-size:0.85rem;">
                Estimated Lifetime Tax Savings: <span id="tax-save">$0</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const cont = parseFloat(document.getElementById('cont').value) || 0;
        const withD = parseFloat(document.getElementById('with').value) || 0;
        const yld = (parseFloat(document.getElementById('yld').value) || 0) / 100;
        const yrs = parseInt(document.getElementById('yrs').value) || 1;
        const tax = (parseFloat(document.getElementById('tax-bracket').value) || 0) / 100;
        
        document.getElementById('tax-disp').innerText = (tax*100) + '%';
        document.getElementById('r-yr').innerText = yrs;
        
        let bal = 0;
        let sumIn = 0;
        let sumGrow = 0;
        let sumOut = 0;
        
        for(let i=0; i<yrs; i++){
            sumIn += cont;
            // assume cont is mid-year or we just do simple EOY math
            bal += cont;
            
            let growth = bal * yld;
            sumGrow += growth;
            bal += growth;
            
            let w = Math.min(bal, withD);
            sumOut += w;
            bal -= w;
        }
        
        const taxSave = sumIn * tax;
        
        try {
            document.getElementById('bal').innerText = format(bal);
            document.getElementById('sum-in').innerText = format(sumIn);
            document.getElementById('sum-out').innerText = '-' + format(sumOut);
            document.getElementById('sum-grow').innerText = '+' + format(sumGrow);
            document.getElementById('tax-save').innerText = format(taxSave);
        } catch(e) {}
    }
    
    ['cont','with','yld','yrs','tax-bracket'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-fam').addEventListener('click', () => { document.getElementById('cont').value=8300; calc(); });
    document.getElementById('qa-sing').addEventListener('click', () => { document.getElementById('cont').value=4150; calc(); });
    document.getElementById('qa-zero').addEventListener('click', () => { document.getElementById('cont').value=0; calc(); });
    document.getElementById('qa-agg').addEventListener('click', () => { document.getElementById('yld').value=10; calc(); });
    document.getElementById('qa-con').addEventListener('click', () => { document.getElementById('yld').value=4; calc(); });
    document.getElementById('qa-cash').addEventListener('click', () => { document.getElementById('with').value = parseFloat(document.getElementById('cont').value)||4150; calc(); });
    
    calc();
});
</script>

