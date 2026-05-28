<div class="interactive-tool-grid debt-vs-investment-comparison-tool">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Extra Monthly Cash ($)</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-dollar-sign text-muted"></i></span>
                    <input type="number" id="cash" class="form-control-custom border-start-0 ps-0" value="500" min="0">
                </div>
            </div>
            <div class="row pt-2 border-top">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-danger">Target Debt Apr (%)</label>
                    <input type="number" id="d-apr" class="form-control-custom" value="22" step="0.5">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-success">Invest ROI (%)</label>
                    <input type="number" id="i-roi" class="form-control-custom" value="7" step="0.5">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Comparison Period (Years)</label>
                    <input type="number" id="yrs" class="form-control-custom" value="5" min="1">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #8b5cf6;">
            <span class="result-label">The Winning Strategy</span>
            <h1 class="result-main-value" id="winner" style="color: #6d28d9;">Pay Off Debt</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Debt Avoided</td><td class="text-end fw-semibold text-danger" id="d-val">$0</td></tr>
                    <tr><td>Investment Grown</td><td class="text-end fw-semibold text-success" id="i-val">$0</td></tr>
                    <tr><td class="pt-2 border-top">Net Difference</td><td class="text-end pt-2 border-top fw-bold fs-5 text-dark" id="diff">$0</td></tr>
                </table>
            </div>
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light" id="msg">
                Since debt APR is higher than ROI, paying debt guarantees a higher return.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const cash = parseFloat(document.getElementById('cash').value) || 0;
        const d_apr = (parseFloat(document.getElementById('d-apr').value) || 0) / 100 / 12;
        const i_roi = (parseFloat(document.getElementById('i-roi').value) || 0) / 100 / 12;
        const yrs = parseInt(document.getElementById('yrs').value) || 0;
        const m = yrs * 12;
        
        let fv_debt = 0;
        if(d_apr>0) fv_debt = cash * ((Math.pow(1 + d_apr, m) - 1) / d_apr);
        else fv_debt = cash * m;
        
        let fv_inv = 0;
        if(i_roi>0) fv_inv = cash * ((Math.pow(1 + i_roi, m) - 1) / i_roi);
        else fv_inv = cash * m;
        
        const diff = Math.abs(fv_debt - fv_inv);
        
        let winner = "Pay Off Debt";
        let msg = "Debt APR is higher. Guaranteed return by killing debt.";
        if (fv_inv > fv_debt) {
            winner = "Invest the Cash";
            msg = "Expected ROI beats the debt cost mathematically.";
        }
        
        try {
            document.getElementById('winner').innerText = winner;
            document.getElementById('d-val').innerText = format(fv_debt);
            document.getElementById('i-val').innerText = format(fv_inv);
            document.getElementById('diff').innerText = format(diff);
            document.getElementById('msg').innerText = msg;
        } catch(e) {}
    }
    ['cash','d-apr','i-roi','yrs'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    calc();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\debt-vs-investment-comparison-tool.blade.php ENDPATH**/ ?>