<div class="interactive-tool-grid legal-case-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Gross Settlement / Award Amount ($)</label>
                <input type="number" id="gross" class="form-control-custom" value="100000" min="0">
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3 border-top pt-3">
                <h5 class="text-secondary mb-0">Attorney Fees & Costs</h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Pre-Trial (33.3%)</button>
                    <button class="btn btn-sm btn-outline-danger ms-1" id="qa-trial" style="min-width: 280px; max-width: 100%;">Litigation (40%)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Contingency Fee (%)</label>
                    <input type="number" id="fee-pct" class="form-control-custom" value="33.33" step="0.01">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Filing/Court Costs ($)</label>
                    <input type="number" id="e-court" class="form-control-custom c-val" value="500" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Expert Witness & Deposition ($)</label>
                    <input type="number" id="e-exp" class="form-control-custom c-val" value="2500" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Medical Providers/Liens ($)</label>
                    <input type="number" id="e-lien" class="form-control-custom" value="15000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #a855f7;">
            <span class="result-label">Client Net Take-Home</span>
            <h1 class="result-main-value" id="net" style="color: #7e22ce;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Gross Award</td><td class="text-end fw-semibold text-dark" id="disp-gross">$0</td></tr>
                    <tr><td>Attorney Contour Fee</td><td class="text-end fw-bold text-danger" id="disp-fee">-$0</td></tr>
                    <tr><td>Case Expenses Reimbursed</td><td class="text-end fw-bold text-danger" id="disp-exp">-$0</td></tr>
                    <tr><td>Medical Liens Paid</td><td class="text-end fw-bold text-danger" id="disp-lien">-$0</td></tr>
                </table>
            </div>
            
            <div class="progress-custom mt-4 d-flex" style="height:12px; border-radius:6px; overflow:hidden;">
                <div id="bar-client" style="background:#7e22ce; width:50%;"></div>
                <div id="bar-atty" style="background:#ef4444; width:33%;"></div>
                <div id="bar-other" style="background:#f59e0b; width:17%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.75rem;">
                <span style="color:#7e22ce;font-weight:bold;">Client</span>
                <span style="color:#ef4444;font-weight:bold;">Atty</span>
                <span style="color:#f59e0b;font-weight:bold;">Costs/Liens</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const gross = parseFloat(document.getElementById('gross').value) || 0;
        const feePct = (parseFloat(document.getElementById('fee-pct').value) || 0) / 100;
        const lien = parseFloat(document.getElementById('e-lien').value) || 0;
        
        let costs = 0;
        document.querySelectorAll('.c-val').forEach(el => costs += (parseFloat(el.value)||0));
        
        const feeValue = gross * feePct;
        const net = gross - feeValue - costs - lien;
        
        let pcClient = gross>0 ? (net/gross)*100 : 0;
        let pcAtty = gross>0 ? (feeValue/gross)*100 : 0;
        let pcOther = gross>0 ? ((costs+lien)/gross)*100 : 0;
        
        try {
            document.getElementById('net').innerText = format(net);
            if(net < 0) { document.getElementById('net').innerText = "$0 (Negative Net)"; document.getElementById('net').style.color = "#ef4444"; }
            else { document.getElementById('net').style.color = "#7e22ce"; }
            
            document.getElementById('disp-gross').innerText = format(gross);
            document.getElementById('disp-fee').innerText = '-' + format(feeValue);
            document.getElementById('disp-exp').innerText = '-' + format(costs);
            document.getElementById('disp-lien').innerText = '-' + format(lien);
            
            document.getElementById('bar-client').style.width = Math.max(0, pcClient) + '%';
            document.getElementById('bar-atty').style.width = Math.max(0, pcAtty) + '%';
            document.getElementById('bar-other').style.width = Math.max(0, pcOther) + '%';
        } catch(e) {}
    }
    
    ['gross','fee-pct','e-lien'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    document.querySelectorAll('.c-val').forEach(inp => inp.addEventListener('input', calc));
    
    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('fee-pct').value = 33.33; calc(); });
    document.getElementById('qa-trial').addEventListener('click', () => { document.getElementById('fee-pct').value = 40.0; calc(); });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\legal-case-calculator.blade.php ENDPATH**/ ?>