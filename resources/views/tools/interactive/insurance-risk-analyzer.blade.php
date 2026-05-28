<div class="interactive-tool-grid insurance-risk-analyzer">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Profile Risk Benchmarks</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-perf" style="min-width: 280px; max-width: 100%;">Perfectly Hedged</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-under" style="min-width: 280px; max-width: 100%;">Under-Insured (Risk)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-over" style="min-width: 280px; max-width: 100%;">Over-Insured (Waste)</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-hnw" style="min-width: 280px; max-width: 100%;">High Net Worth (1M)</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-zerocf" style="min-width: 280px; max-width: 100%;">Zero Cash Cushion</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-bare" style="min-width: 280px; max-width: 100%;">Bare Minimum</button>
                </div>
            </div>

            <div class="row">
                <h5 class="text-secondary mt-2 pb-2 border-bottom mb-3 w-100">1. Liquid Emergency Risk</h5>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Total Liquid Cash/Savings ($)</label>
                    <input type="number" id="cash" class="form-control-custom" value="10000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Highest Single Deductible ($)</label>
                    <input type="number" id="max-ded" class="form-control-custom" value="5000" min="0">
                </div>
                
                <h5 class="text-secondary mt-3 pb-2 border-bottom mb-3 w-100">2. Liability Risk (Asset Protection)</h5>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Total Personal Net Worth ($)</label>
                    <input type="number" id="nw" class="form-control-custom" value="250000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Current Auto/Home Liab Limit ($)</label>
                    <input type="number" id="liab" class="form-control-custom" value="300000" min="0">
                </div>
                
                <h5 class="text-secondary mt-3 pb-2 border-bottom mb-3 w-100">3. Income Replacement Risk</h5>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Target Life Ins. Need ($)</label>
                    <input type="number" id="life-need" class="form-control-custom" value="500000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Actual Life Policy Coverage ($)</label>
                    <input type="number" id="life-act" class="form-control-custom" value="100000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f59e0b;">
            <span class="result-label">Overall Risk Status</span>
            <h1 class="result-main-value fs-2" id="stat" style="color: #d97706;">Loading...</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Deductible vs Liquid Cash Target</td><td class="text-end fw-bold fs-6" id="r-cash"></td></tr>
                    <tr><td>Liability vs Net Worth Target</td><td class="text-end fw-bold fs-6" id="r-liab"></td></tr>
                    <tr><td class="pt-2 border-top">Life Insurance Gap</td><td class="text-end pt-2 border-top fw-bold fs-6" id="r-life"></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const cash = parseFloat(document.getElementById('cash').value) || 0;
        const maxDed = parseFloat(document.getElementById('max-ded').value) || 0;
        
        const nw = parseFloat(document.getElementById('nw').value) || 0;
        const liab = parseFloat(document.getElementById('liab').value) || 0;
        
        const lifeNeed = parseFloat(document.getElementById('life-need').value) || 0;
        const lifeAct = parseFloat(document.getElementById('life-act').value) || 0;
        
        let warnings = 0;
        
        const rCashObj = document.getElementById('r-cash');
        if(cash < maxDed) { rCashObj.innerText = `Short ${format(maxDed - cash)}`; rCashObj.className = "text-end fw-bold fs-6 text-danger"; warnings++; }
        else { rCashObj.innerText = "Covered"; rCashObj.className = "text-end fw-bold fs-6 text-success"; }
        
        const rLiabObj = document.getElementById('r-liab');
        if(liab < nw) { rLiabObj.innerText = `At Risk: Net worth > Liab`; rLiabObj.className = "text-end fw-bold fs-6 text-danger"; warnings++; }
        else { rLiabObj.innerText = "Adequately Protected"; rLiabObj.className = "text-end fw-bold fs-6 text-success"; }
        
        const rLifeObj = document.getElementById('r-life');
        if(lifeAct < lifeNeed) { rLifeObj.innerText = `Gap: ${format(lifeNeed - lifeAct)}`; rLifeObj.className = "text-end fw-bold fs-6 pt-2 border-top text-danger"; warnings++; }
        else { rLifeObj.innerText = "Fully Funded"; rLifeObj.className = "text-end fw-bold fs-6 pt-2 border-top text-success"; }
        
        const stat = document.getElementById('stat');
        if(warnings === 0) { stat.innerText = "Safely Hedged"; stat.style.color = "#10b981"; }
        else if (warnings === 1) { stat.innerText = "Moderate Risk (1 Gap)"; stat.style.color = "#f59e0b"; }
        else { stat.innerText = `High Risk (${warnings} Gaps)`; stat.style.color = "#ef4444"; }
    }
    
    ['cash','max-ded','nw','liab','life-need','life-act'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // QA
    document.getElementById('qa-perf').addEventListener('click', () => { 
        document.getElementById('cash').value=10000; document.getElementById('max-ded').value=5000; document.getElementById('nw').value=200000; document.getElementById('liab').value=300000; document.getElementById('life-need').value=500000; document.getElementById('life-act').value=500000; calc(); 
    });
    document.getElementById('qa-under').addEventListener('click', () => { 
        document.getElementById('cash').value=1000; document.getElementById('max-ded').value=5000; document.getElementById('nw').value=500000; document.getElementById('liab').value=100000; document.getElementById('life-need').value=500000; document.getElementById('life-act').value=0; calc(); 
    });
    document.getElementById('qa-over').addEventListener('click', () => { 
        document.getElementById('cash').value=50000; document.getElementById('max-ded').value=1000; document.getElementById('nw').value=100000; document.getElementById('liab').value=1000000; document.getElementById('life-need').value=0; document.getElementById('life-act').value=1000000; calc(); 
    });
    document.getElementById('qa-hnw').addEventListener('click', () => { 
        document.getElementById('nw').value=1200000; document.getElementById('liab').value=500000; document.getElementById('life-need').value=2000000; document.getElementById('life-act').value=1000000; calc(); 
    });
    document.getElementById('qa-zerocf').addEventListener('click', () => { document.getElementById('cash').value=0; document.getElementById('max-ded').value=5000; calc(); });
    document.getElementById('qa-bare').addEventListener('click', () => { document.getElementById('liab').value=25000; document.getElementById('max-ded').value=0; document.getElementById('cash').value=500; calc(); });
    
    calc();
});
</script>

