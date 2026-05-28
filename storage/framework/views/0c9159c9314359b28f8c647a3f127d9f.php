<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid times-interest-earned-ratio-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Financial State</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard TIE (2.5x)</button>
                    <button class="qa-btn-component qa-success" id="qa-high" style="min-width: 280px; max-width: 100%;">High Margin TIE</button>
                    <button class="qa-btn-component qa-warning" id="qa-low" style="min-width: 280px; max-width: 100%;">Struggling TIE (1.2x)</button>
                    <button class="qa-btn-component qa-danger" id="qa-neg" style="min-width: 280px; max-width: 100%;">Net Loss</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Net Income (After Tax) ($)</label>
                    <input type="number" id="net" class="form-control-custom fw-bold fs-5 text-primary" value="150000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Add-Backs to Calculate EBIT</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom text-danger fw-bold">Interest Expense ($)</label>
                    <input type="number" id="int" class="form-control-custom fw-bold" value="100000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-warning">
                    <label class="form-label-custom text-warning fw-bold">Taxes Paid ($)</label>
                    <input type="number" id="tax" class="form-control-custom fw-bold" value="50000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f59e0b;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">TIE Ratio</span>
                <span id="tie-badge" class="status-badge badge-optimal">Standard</span>
            </div>
            <h1 class="result-main-value fs-1" id="tie-val" style="color: #d97706;">3.0x</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Reconstructed EBIT</td><td class="text-end fw-semibold text-secondary" id="s-ebit">$0</td></tr>
                    <tr><td>Total Interest Expense</td><td class="text-end fw-bold text-danger fs-6" id="s-int">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">TIE Safety Bound</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-tie" class="enhanced-progress-segment" style="background:#f59e0b; width:60%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#ef4444;font-weight:bold;">1.0x</span>
                <span style="color:#f59e0b;font-weight:bold;">5.0x+</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const net = parseFloat(document.getElementById('net').value)||0;
        const intAmt = parseFloat(document.getElementById('int').value)||0;
        const tax = parseFloat(document.getElementById('tax').value)||0;

        // EBIT = Net Income + Taxes + Interest
        const ebit = net + tax + intAmt;

        let tie = 0;
        if (intAmt > 0) {
            tie = ebit / intAmt;
        }

        let badge = document.getElementById('tie-badge');
        let badgeColor = '#d97706';
        let barColor = '#f59e0b';

        if (intAmt === 0) { badge.innerText = "DEBT FREE (No Exp)"; badge.className = "status-badge badge-primary"; }
        else if (tie < 1.0) { badge.innerText = "CANNOT PAY DEBT (<1.0x)"; badge.className = "status-badge badge-critical"; badgeColor='#be123c'; barColor='#ef4444'; }
        else if (tie < 1.5) { badge.innerText = "HIGH RISK (<1.5x)"; badge.className = "status-badge badge-danger"; badgeColor='#ea580c'; barColor='#ea580c'; }
        else if (tie < 2.5) { badge.innerText = "MONITOR CLOSELY"; badge.className = "status-badge badge-warning"; badgeColor='#f59e0b'; barColor='#f59e0b'; }
        else { badge.innerText = "ADEQUATE MARGIN"; badge.className = "status-badge badge-optimal"; barColor='#10b981'; badgeColor='#047857'; }

        try {
            document.getElementById('tie-val').innerText = (intAmt === 0) ? "N/A" : tie.toFixed(2) + "x";
            document.getElementById('tie-val').style.color = badgeColor;
            
            document.getElementById('s-ebit').innerText = format(ebit);
            document.getElementById('s-int').innerText = format(intAmt);

            let maxTie = 5.0;
            let pTie = Math.min(100, Math.max(0, (tie / maxTie) * 100));
            if(intAmt === 0) pTie = 100;

            document.getElementById('bar-tie').style.width = pTie + '%';
            document.getElementById('bar-tie').style.background = barColor;
        } catch(e) {}
    }
    
    ['net','int','tax'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('net').value=100000; document.getElementById('int').value=100000; document.getElementById('tax').value=50000; calc(); });
    document.getElementById('qa-high').addEventListener('click', () => { document.getElementById('net').value=800000; document.getElementById('int').value=100000; document.getElementById('tax').value=200000; calc(); });
    document.getElementById('qa-low').addEventListener('click', () => { document.getElementById('net').value=10000; document.getElementById('int').value=150000; document.getElementById('tax').value=20000; calc(); });
    document.getElementById('qa-neg').addEventListener('click', () => { document.getElementById('net').value=-50000; document.getElementById('int').value=100000; document.getElementById('tax').value=0; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\times-interest-earned-ratio-calculator.blade.php ENDPATH**/ ?>