<div class="interactive-tool-grid wealth-accumulation-vs-expenses-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Monthly Income ($)</label>
                    <input type="number" id="inc" class="form-control-custom" value="6000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Monthly Expenses ($)</label>
                    <input type="number" id="exp" class="form-control-custom" value="4500" min="0">
                </div>
            </div>
            <div class="form-group-custom mt-2 border-top pt-3">
                <label class="form-label-custom">Projection Period (Years)</label>
                <input type="number" id="yrs" class="form-control-custom" value="10" min="1" max="50">
            </div>
            <div class="form-group-custom mt-3">
                <label class="form-label-custom">Assumed Investment ROI (%)</label>
                <input type="number" id="roi" class="form-control-custom" value="7" step="0.5">
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #3b82f6;">
            <span class="result-label">Projected Wealth Accumulated</span>
            <h1 class="result-main-value" id="wealth" style="color: #1d4ed8;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Income Earned</td><td class="text-end fw-semibold text-secondary" id="tot-inc">$0</td></tr>
                    <tr><td>Total Capital Burned</td><td class="text-end fw-semibold text-danger" id="tot-exp">$0</td></tr>
                    <tr><td class="pt-2 border-top">Money Saved</td><td class="text-end pt-2 border-top fw-bold text-success" id="tot-sav">$0</td></tr>
                    <tr><td>Investment Growth</td><td class="text-end fw-bold text-primary" id="inv-gr">+$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const inc = parseFloat(document.getElementById('inc').value) || 0;
        const exp = parseFloat(document.getElementById('exp').value) || 0;
        const yrs = parseFloat(document.getElementById('yrs').value) || 0;
        const roi = (parseFloat(document.getElementById('roi').value) || 0) / 100 / 12;
        
        const m = yrs * 12;
        const sav = inc - exp;
        
        const totInc = inc * m;
        const totExp = exp * m;
        const totSav = sav * m;
        
        let fv = 0;
        if(sav > 0) {
            if(roi === 0) fv = sav * m;
            else fv = sav * ((Math.pow(1 + roi, m) - 1) / roi);
        }
        
        const growth = fv > totSav ? fv - totSav : 0;
        
        try {
            document.getElementById('tot-inc').innerText = format(totInc);
            document.getElementById('tot-exp').innerText = '-' + format(totExp);
            document.getElementById('tot-sav').innerText = sav > 0 ? format(totSav) : '$0';
            document.getElementById('inv-gr').innerText = '+' + format(growth);
            document.getElementById('wealth').innerText = format(fv);
        } catch(e) {}
    }
    ['inc','exp','yrs','roi'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    calc();
});
</script>
