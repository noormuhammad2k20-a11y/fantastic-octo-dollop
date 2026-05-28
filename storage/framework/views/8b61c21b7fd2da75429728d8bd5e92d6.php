<div class="interactive-tool-grid tax-efficiency-optimization-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <h5 class="text-secondary pb-2 border-bottom mb-3">Gross Income Profile</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">W2 Income ($)</label>
                    <input type="number" id="w2" class="form-control-custom" value="85000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">1099 Business Income ($)</label>
                    <input type="number" id="bus" class="form-control-custom" value="15000" min="0">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-2 border-bottom pb-2 mb-3">
                <h5 class="text-secondary mb-0">Pre-Tax Deductions</h5>
                <div>
                    <button class="btn btn-sm btn-outline-success me-1" id="qa-401k" style="min-width: 280px; max-width: 100%;"><i class="fas fa-level-up-alt"></i> Max 401k</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-hsa" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus"></i> Max HSA</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">401k/Traditional IRA ($)</label>
                    <input type="number" id="d-ret" class="form-control-custom d-val" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">HSA / FSA ($)</label>
                    <input type="number" id="d-hsa" class="form-control-custom d-val" value="0" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Business Expenses</label>
                    <input type="number" id="d-bus" class="form-control-custom d-val" value="3000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Standard Deduction vs Itemized</label>
                    <input type="number" id="d-std" class="form-control-custom d-val" value="14600" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #ef4444;">
            <span class="result-label">Adjusted Gross Income (AGI Estimate)</span>
            <h1 class="result-main-value" id="agi" style="color: #b91c1c;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Gross Income</td><td class="text-end fw-semibold text-secondary" id="t-gross">$0</td></tr>
                    <tr><td>Total Deductions</td><td class="text-end fw-bold text-success" id="t-ded">-$0</td></tr>
                    <tr><td class="pt-2 border-top">Effective Taxable Income</td><td class="text-end pt-2 border-top fw-bold fs-5 text-dark" id="t-taxable">$0</td></tr>
                </table>
            </div>
            
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light text-muted" style="font-size:0.85rem;">
                Lowering your AGI reduces your final tax burden. (Current US Federal brackets apply generally).
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const w2 = parseFloat(document.getElementById('w2').value) || 0;
        const bus = parseFloat(document.getElementById('bus').value) || 0;
        const gross = w2 + bus;
        
        let ded = 0;
        document.querySelectorAll('.d-val').forEach(el => ded += (parseFloat(el.value)||0));
        
        // AGI is Gross minus specific 'above the line' deductions, but for simplicity we show Effective Taxable.
        // Actually AGI = Gross - 401k - HSA - BusExp. Standard ded comes AFTER AGI.
        const ret = parseFloat(document.getElementById('d-ret').value) || 0;
        const hsa = parseFloat(document.getElementById('d-hsa').value) || 0;
        const busExp = parseFloat(document.getElementById('d-bus').value) || 0;
        const std = parseFloat(document.getElementById('d-std').value) || 0;
        
        const agi = gross - ret - hsa - busExp;
        const taxable = Math.max(0, agi - std);
        
        try {
            document.getElementById('agi').innerText = format(agi);
            document.getElementById('t-gross').innerText = format(gross);
            document.getElementById('t-ded').innerText = '-' + format(ded);
            document.getElementById('t-taxable').innerText = format(taxable);
        } catch(e) {}
    }
    
    ['w2','bus'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    document.querySelectorAll('.d-val').forEach(inp => inp.addEventListener('input', calc));
    
    document.getElementById('qa-401k').addEventListener('click', () => {
        document.getElementById('d-ret').value = 23000;
        calc();
    });
    
    document.getElementById('qa-hsa').addEventListener('click', () => {
        document.getElementById('d-hsa').value = 4150;
        calc();
    });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\tax-efficiency-optimization-calculator.blade.php ENDPATH**/ ?>