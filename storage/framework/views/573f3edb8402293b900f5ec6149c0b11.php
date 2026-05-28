<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid revenue-analytics-tool">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Business Modeler Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-saas" style="min-width: 280px; max-width: 100%;">SaaS Baseline</button>
                    <button class="qa-btn-component qa-success" id="qa-ecom" style="min-width: 280px; max-width: 100%;">Volume E-Com</button>
                    <button class="qa-btn-component qa-warning" id="qa-agen" style="min-width: 280px; max-width: 100%;">B2B Agency</button>
                    <button class="qa-btn-component qa-info" id="qa-hyb" style="min-width: 280px; max-width: 100%;">Hybrid Model</button>
                    <button class="qa-btn-component qa-danger" id="qa-churn" style="min-width: 280px; max-width: 100%;">High Churn Crisis</button>
                    <button class="qa-btn-component qa-dark" id="qa-boot" style="min-width: 280px; max-width: 100%;">Bootstrapped</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Total Active Customers</label>
                    <input type="number" id="cust" class="form-control-custom" value="500" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Average Revenue Per User (ARPU / Mo $)</label>
                    <input type="number" id="arpu" class="form-control-custom" value="50" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Vital Retention Metrics</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Monthly Churn Rate (%)</label>
                    <input type="number" id="churn" class="form-control-custom" value="5" step="0.5" max="100">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-success">Gross Margin (%)</label>
                    <input type="number" id="margin" class="form-control-custom" value="80" step="1" max="100">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #2563eb;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Monthly Recurring Revenue (MRR)</span>
                <span id="biz-health" class="status-badge badge-optimal">Optimal</span>
            </div>
            <h1 class="result-main-value fs-2" id="mrr" style="color: #1e40af;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Annual Run Rate (ARR)</td><td class="text-end fw-semibold text-secondary" id="arr">$0</td></tr>
                    <tr><td>Gross Profit (Monthly)</td><td class="text-end fw-bold text-success fs-6" id="gross-profit">$0</td></tr>
                    <tr><td class="pt-2 border-top">Customer Lifetime Value (LTV)</td><td class="text-end pt-2 border-top fw-bold text-primary fs-6" id="ltv">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Gross Margin Breakdown</p>
            <div class="enhanced-progress-bar">
                <div id="bar-profit" class="enhanced-progress-segment" style="background:#10b981; width:80%;"></div>
                <div id="bar-cogs" class="enhanced-progress-segment" style="background:#ef4444; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.75rem;">
                <span style="color:#10b981;font-weight:bold;">Profit</span>
                <span style="color:#ef4444;font-weight:bold;">COGS Drag</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const cust = parseFloat(document.getElementById('cust').value) || 0;
        const arpu = parseFloat(document.getElementById('arpu').value) || 0;
        const churn = (parseFloat(document.getElementById('churn').value) || 1) / 100;
        const margin = (parseFloat(document.getElementById('margin').value) || 0) / 100;

        const mrr = cust * arpu;
        const arr = mrr * 12;
        const gross = mrr * margin;
        
        let ltv = 0;
        if(churn > 0) {
            ltv = (arpu * margin) / churn;
        }

        let health = document.getElementById('biz-health');
        if(churn > 0.08) { health.innerText = "CRITICAL CHURN"; health.className = "status-badge badge-critical"; }
        else if (margin < 0.3) { health.innerText = "LOW MARGIN RISK"; health.className = "status-badge badge-warning"; }
        else { health.innerText = "STRONG MODEL"; health.className = "status-badge badge-optimal"; }

        try {
            document.getElementById('mrr').innerText = format(mrr);
            document.getElementById('arr').innerText = format(arr);
            document.getElementById('gross-profit').innerText = format(gross);
            document.getElementById('ltv').innerText = churn > 0 ? format(ltv) : 'Infinite';

            const pPct = margin * 100;
            const cPct = 100 - pPct;
            document.getElementById('bar-profit').style.width = pPct + '%';
            document.getElementById('bar-cogs').style.width = cPct + '%';
        } catch(e) {}
    }
    
    ['cust','arpu','churn','margin'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    // CSS Quick Actions Component Logic
    document.getElementById('qa-saas').addEventListener('click', () => { document.getElementById('cust').value=1000; document.getElementById('arpu').value=99; document.getElementById('churn').value=3; document.getElementById('margin').value=85; calc(); });
    document.getElementById('qa-ecom').addEventListener('click', () => { document.getElementById('cust').value=15000; document.getElementById('arpu').value=30; document.getElementById('churn').value=35; document.getElementById('margin').value=45; calc(); });
    document.getElementById('qa-agen').addEventListener('click', () => { document.getElementById('cust').value=20; document.getElementById('arpu').value=5000; document.getElementById('churn').value=5; document.getElementById('margin').value=60; calc(); });
    document.getElementById('qa-hyb').addEventListener('click', () => { document.getElementById('cust').value=250; document.getElementById('arpu').value=450; document.getElementById('churn').value=10; document.getElementById('margin').value=70; calc(); });
    document.getElementById('qa-churn').addEventListener('click', () => { document.getElementById('churn').value=15; calc(); });
    document.getElementById('qa-boot').addEventListener('click', () => { document.getElementById('cust').value=150; document.getElementById('arpu').value=25; document.getElementById('churn').value=2; document.getElementById('margin').value=95; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\revenue-analytics-tool.blade.php ENDPATH**/ ?>