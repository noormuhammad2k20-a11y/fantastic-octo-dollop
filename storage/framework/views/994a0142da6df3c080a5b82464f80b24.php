<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid tax-liability-pro">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Tax Environments</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-us" style="min-width: 280px; max-width: 100%;">Standard US C-Corp (21%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-uk" style="min-width: 280px; max-width: 100%;">UK Corp Tax (25%)</button>
                    <button class="qa-btn-component qa-success" id="qa-ire" style="min-width: 280px; max-width: 100%;">Ireland Tax Haven (12.5%)</button>
                    <button class="qa-btn-component qa-danger" id="qa-high" style="min-width: 280px; max-width: 100%;">High Tax State (28%)</button>
                    <button class="qa-btn-component qa-info" id="qa-ded" style="min-width: 280px; max-width: 100%;">Heavy Deductions</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Gross Annual Revenue ($)</label>
                    <input type="number" id="rev" class="form-control-custom fw-bold fs-5 text-primary" value="1500000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom border-bottom pb-1 text-danger">Cost of Goods Sold (COGS) ($)</label>
                    <input type="number" id="cogs" class="form-control-custom fw-bold fs-5 text-danger" value="600000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Deductions & Rates</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Total Operating Expenses (OpEx) ($)</label>
                    <input type="number" id="opex" class="form-control-custom" value="450000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-warning">
                    <label class="form-label-custom text-warning fw-bold">Statutory Tax Rate (%)</label>
                    <input type="number" id="rate" class="form-control-custom fw-bold" value="21.0" step="0.1">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 form-group-custom mb-2 border-start border-3 border-success">
                    <label class="form-label-custom text-success fw-bold">Special Tax Credits ($) <small class="text-muted">(R&D, Green Energy, etc. directly subtracted from tax bill)</small></label>
                    <input type="number" id="cred" class="form-control-custom fw-bold text-success" value="15000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #059669;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Net Tax Liability Output</span>
                <span id="tax-badge" class="status-badge badge-optimal">Standard Yield</span>
            </div>
            <h1 class="result-main-value fs-1" id="tax-out" style="color: #047857;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Taxable Income (EBT)</td><td class="text-end fw-semibold text-secondary" id="s-ebt">$0</td></tr>
                    <tr><td>Net Profit After Tax</td><td class="text-end fw-semibold text-primary" id="s-npat">$0</td></tr>
                    <tr><td class="pt-2 border-top">Effective Tax Rate</td><td class="text-end pt-2 border-top fw-bold text-danger fs-6" id="s-eff">0%</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Gross Revenue Distribution</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-exp" class="enhanced-progress-segment" style="background:#f59e0b; width:50%;"></div>
                <div id="bar-tax" class="enhanced-progress-segment" style="background:#ef4444; width:20%;"></div>
                <div id="bar-prof" class="enhanced-progress-segment" style="background:#10b981; width:30%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#f59e0b;font-weight:bold;">Total Expenses</span>
                <span style="color:#ef4444;font-weight:bold;">Corporate Tax</span>
                <span style="color:#10b981;font-weight:bold;">Net Profit</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const rev = parseFloat(document.getElementById('rev').value)||0;
        const cogs = parseFloat(document.getElementById('cogs').value)||0;
        const opex = parseFloat(document.getElementById('opex').value)||0;
        const rate = (parseFloat(document.getElementById('rate').value)||0)/100;
        const cred = parseFloat(document.getElementById('cred').value)||0;

        let gp = rev - cogs;
        let ebt = gp - opex;
        
        let grossTax = 0;
        if (ebt > 0) {
            grossTax = ebt * rate;
        }

        let netTax = grossTax - cred;
        if(netTax < 0) netTax = 0; // Assuming non-refundable credit for simplicity

        let npat = ebt - netTax;

        let effRate = 0;
        if (ebt > 0) {
            effRate = (netTax / ebt) * 100;
        }

        let badge = document.getElementById('tax-badge');
        let color = '#047857';

        if (ebt <= 0) { badge.innerText = "NO TAX (NET LOSS)"; badge.className = "status-badge badge-info"; color='#64748b'; }
        else if (effRate < 10) { badge.innerText = "HIGHLY OPTIMIZED (<10%)"; badge.className = "status-badge badge-optimal"; color='#10b981'; }
        else if (effRate > 25) { badge.innerText = "HEAVY BURDEN (>25%)"; badge.className = "status-badge badge-danger"; color='#ef4444'; }
        else { badge.innerText = "STANDARD BURDEN"; badge.className = "status-badge badge-primary"; color='#2563eb'; }

        try {
            document.getElementById('tax-out').innerText = format(netTax);
            document.getElementById('tax-out').style.color = color;
            
            document.getElementById('s-ebt').innerText = (ebt<0?'-':'') + format(Math.abs(ebt));
            document.getElementById('s-npat').innerText = (npat<0?'-':'') + format(Math.abs(npat));
            document.getElementById('s-eff').innerText = Math.max(0, effRate).toFixed(1) + '%';

            if(rev > 0) {
                let expTot = cogs + opex;
                // Cap visual expenses at rev if company is losing money to show full bar red basically
                let pExp = (expTot / rev) * 100;
                let pTax = (netTax / rev) * 100;
                let pProf = (Math.max(0, npat) / rev) * 100;

                if(pExp > 100) { pExp = 100; pTax = 0; pProf = 0; }

                document.getElementById('bar-exp').style.width = pExp + '%';
                document.getElementById('bar-tax').style.width = pTax + '%';
                document.getElementById('bar-prof').style.width = pProf + '%';
            }
        } catch(e) {}
    }
    
    ['rev','cogs','opex','rate','cred'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-us').addEventListener('click', () => { document.getElementById('rev').value=1500000; document.getElementById('cogs').value=600000; document.getElementById('opex').value=450000; document.getElementById('rate').value=21; document.getElementById('cred').value=0; calc(); });
    document.getElementById('qa-uk').addEventListener('click', () => { document.getElementById('rev').value=2000000; document.getElementById('cogs').value=800000; document.getElementById('opex').value=500000; document.getElementById('rate').value=25; document.getElementById('cred').value=0; calc(); });
    document.getElementById('qa-ire').addEventListener('click', () => { document.getElementById('rev').value=5000000; document.getElementById('cogs').value=1000000; document.getElementById('opex').value=1500000; document.getElementById('rate').value=12.5; document.getElementById('cred').value=0; calc(); });
    document.getElementById('qa-high').addEventListener('click', () => { document.getElementById('rev').value=1000000; document.getElementById('cogs').value=400000; document.getElementById('opex').value=200000; document.getElementById('rate').value=28; document.getElementById('cred').value=0; calc(); });
    document.getElementById('qa-ded').addEventListener('click', () => { document.getElementById('rev').value=1500000; document.getElementById('cogs').value=600000; document.getElementById('opex').value=750000; document.getElementById('rate').value=21; document.getElementById('cred').value=25000; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\tax-liability-pro.blade.php ENDPATH**/ ?>