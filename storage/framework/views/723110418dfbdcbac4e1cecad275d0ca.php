<div class="interactive-tool-grid emergency-fund-survival-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Total Liquid Savings ($)</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-dollar-sign text-muted"></i></span>
                    <input type="number" id="sav" class="form-control-custom border-start-0 ps-0" value="15000" min="0">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-4 border-bottom pb-2 mb-3">
                <h5 class="text-secondary mb-0">Monthly Expenses Breakdown</h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary me-1" id="qa-avg" style="min-width: 280px; max-width: 100%;"><i class="fas fa-magic"></i> US Avg</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-bare" style="min-width: 280px; max-width: 100%;"><i class="fas fa-cut"></i> Barebones</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Housing (Rent/Mortgage)</label>
                    <input type="number" id="e-house" class="form-control-custom exp-val" value="1500" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Utilities & Internet</label>
                    <input type="number" id="e-util" class="form-control-custom exp-val" value="250" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Groceries & Food</label>
                    <input type="number" id="e-food" class="form-control-custom exp-val" value="600" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Transportation (Gas/Insurance)</label>
                    <input type="number" id="e-trans" class="form-control-custom exp-val" value="400" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Healthcare & Meds</label>
                    <input type="number" id="e-health" class="form-control-custom exp-val" value="300" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Minimum Debt Payments</label>
                    <input type="number" id="e-debt" class="form-control-custom exp-val" value="350" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Discretionary & Misc</label>
                    <input type="number" id="e-misc" class="form-control-custom exp-val" value="500" min="0">
                </div>
            </div>
            
            <div class="alert bg-light mt-2 p-2 border-0 rounded text-muted text-center" style="font-size:0.85rem;">
                Total Monthly Burn: <strong id="burn-disp">$3,900</strong>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">Financial Runway</span>
            <h1 class="result-main-value" id="runway" style="color: #047857;">0.0 Months</h1>
            
            <div class="progress-custom mt-4 mb-2" style="height: 12px; border-radius: 6px;">
                <div id="run-bar" class="progress-bar-custom" style="background:#10b981; width:50%;"></div>
            </div>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Target Goal (6 Months)</td><td class="text-end fw-semibold text-secondary" id="tar-6">$0</td></tr>
                    <tr><td>Shortfall / Surplus</td><td class="text-end fw-bold" id="diff">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        let burn = 0;
        document.querySelectorAll('.exp-val').forEach(el => burn += (parseFloat(el.value)||0));
        const sav = parseFloat(document.getElementById('sav').value) || 0;
        
        document.getElementById('burn-disp').innerText = format(burn);
        
        const rw = burn > 0 ? sav / burn : Infinity;
        const target = burn * 6;
        const diff = sav - target;
        
        let pct = (sav / target) * 100;
        pct = Math.min(100, Math.max(0, pct));
        
        let col = "#10b981";
        if (rw < 3) col = "#ef4444";
        else if (rw < 6) col = "#f59e0b";
        
        try {
            document.getElementById('runway').innerText = rw === Infinity ? 'Unlimited' : rw.toFixed(1) + ' Months';
            document.getElementById('runway').style.color = col;
            document.getElementById('run-bar').style.width = pct + '%';
            document.getElementById('run-bar').style.background = col;
            
            document.getElementById('tar-6').innerText = format(target);
            document.getElementById('diff').innerText = (diff >= 0 ? '+' : '-') + format(Math.abs(diff));
            document.getElementById('diff').style.color = diff >= 0 ? '#10b981' : '#ef4444';
        } catch(e) {}
    }
    
    document.getElementById('sav').addEventListener('input', calc);
    document.querySelectorAll('.exp-val').forEach(inp => inp.addEventListener('input', calc));
    
    document.getElementById('qa-avg').addEventListener('click', () => {
        document.getElementById('e-house').value = 1800;
        document.getElementById('e-util').value = 400;
        document.getElementById('e-food').value = 800;
        document.getElementById('e-trans').value = 600;
        document.getElementById('e-health').value = 450;
        document.getElementById('e-debt').value = 350;
        document.getElementById('e-misc').value = 500;
        calc();
    });
    
    document.getElementById('qa-bare').addEventListener('click', () => {
        // Keeps rent/debt, slashes discretionary
        document.getElementById('e-util').value = Math.max(150, document.getElementById('e-util').value);
        document.getElementById('e-food').value = 300; // beans and rice
        document.getElementById('e-trans').value = 100; // minimum gas
        document.getElementById('e-misc').value = 0; // zero fun
        calc();
    });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\emergency-fund-survival-calculator.blade.php ENDPATH**/ ?>