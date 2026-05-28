<div class="interactive-tool-grid financial-freedom-strategy-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Current Age</label>
                    <input type="number" id="age" class="form-control-custom" value="30" min="18">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Target Retirement Age</label>
                    <input type="number" id="ret-age" class="form-control-custom" value="65" min="18">
                </div>
            </div>
            <div class="form-group-custom mb-3 border-top pt-3">
                <label class="form-label-custom">Target Freedom Number (Net Worth Goal)</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-dollar-sign text-muted"></i></span>
                    <input type="number" id="goal" class="form-control-custom border-start-0 ps-0" value="2000000" min="0" step="10000">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Current Principle</label>
                    <input type="number" id="prin" class="form-control-custom" value="25000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Expected ARR (%)</label>
                    <input type="number" id="arr" class="form-control-custom" value="7" step="0.5">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">Required Monthly Investment</span>
            <h1 class="result-main-value" id="req-inv" style="color: #047857;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Years to Accumulate</td><td class="text-end fw-semibold text-secondary" id="yrs-rem">0</td></tr>
                    <tr><td class="pt-2 border-top">Total Principal Invested</td><td class="text-end pt-2 border-top fw-bold text-dark" id="tot-p">$0</td></tr>
                    <tr><td>Total Interest Earned</td><td class="text-end fw-bold text-success" id="tot-i">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const age = parseInt(document.getElementById('age').value) || 0;
        const ret_age = parseInt(document.getElementById('ret-age').value) || 0;
        const goal = parseFloat(document.getElementById('goal').value) || 0;
        const prin = parseFloat(document.getElementById('prin').value) || 0;
        const arr = (parseFloat(document.getElementById('arr').value) || 0) / 100 / 12;
        
        let remYrs = Math.max(0, ret_age - age);
        const m = remYrs * 12;
        
        let pmt = 0;
        if(m > 0) {
            let fv_prin = 0;
            if(arr>0) fv_prin = prin * Math.pow(1+arr, m);
            else fv_prin = prin;
            
            const gap = goal - fv_prin;
            if(gap > 0) {
                if(arr>0) pmt = gap / (((Math.pow(1+arr, m) - 1)/arr));
                else pmt = gap / m;
            }
        }
        
        const totInvest = prin + (pmt * m);
        const totInt = Math.max(0, goal - totInvest);
        
        try {
            document.getElementById('yrs-rem').innerText = remYrs;
            document.getElementById('req-inv').innerText = remYrs > 0 ? format(pmt) : 'Target Reached';
            document.getElementById('tot-p').innerText = format(totInvest);
            document.getElementById('tot-i').innerText = '+' + format(totInt);
        } catch(e) {}
    }
    ['age','ret-age','goal','prin','arr'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    calc();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\financial-freedom-strategy-calculator.blade.php ENDPATH**/ ?>