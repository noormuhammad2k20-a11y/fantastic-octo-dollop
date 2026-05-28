<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid expense-forecast-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Economic Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-fed" style="min-width: 280px; max-width: 100%;">Fed Target (2%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-hist" style="min-width: 280px; max-width: 100%;">Historical Avg (3.2%)</button>
                    <button class="qa-btn-component qa-danger" id="qa-high" style="min-width: 280px; max-width: 100%;">High Inflation (6%)</button>
                    <button class="qa-btn-component qa-critical" id="qa-crisis" style="min-width: 280px; max-width: 100%; background:#ef4444; color:#fff; border:none;">Stagflation Crisis (9%)</button>
                    <button class="qa-btn-component qa-info" id="qa-def" style="min-width: 280px; max-width: 100%;">Deflationary (-1%)</button>
                    <button class="qa-btn-component qa-dark" id="qa-15y" style="min-width: 280px; max-width: 100%;">15-Year Horizon</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-danger">Current Monthly Expenses ($)</label>
                    <input type="number" id="exp" class="form-control-custom fw-bold" value="4500" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-danger fw-bold">Avg Annual Inflation Rate (%)</label>
                    <input type="number" id="inf" class="form-control-custom" value="3.2" step="0.1">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Projection Timeline</h5>
            <div class="row">
                <div class="col-md-12 form-group-custom mb-2">
                    <label class="form-label-custom">Years in the Future</label>
                    <input type="range" id="yrs-slider" class="form-range" min="1" max="50" value="10">
                    <div class="text-center text-muted fw-bold"><span id="yrs-disp">10</span> Years</div>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f43f5e;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Future Cost of Living (Mo)</span>
                <span id="exp-badge" class="status-badge badge-warning">Rising Costs</span>
            </div>
            <h1 class="result-main-value fs-1" id="f-exp" style="color: #e11d48;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Annualized Future Budget</td><td class="text-end fw-semibold text-secondary" id="s-ann">$0</td></tr>
                    <tr><td>Purchasing Power Loss (Delta $)</td><td class="text-end fw-bold text-danger fs-6" id="s-delta">+$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Purchasing Power Extrapolation</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-base" class="enhanced-progress-segment" style="background:#e2e8f0; width:50%;"></div>
                <div id="bar-inf" class="enhanced-progress-segment" style="background:#f43f5e; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#64748b;font-weight:bold;">Current Target</span>
                <span style="color:#f43f5e;font-weight:bold;">Inflation Penalty</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const exp = parseFloat(document.getElementById('exp').value) || 0;
        const inf = (parseFloat(document.getElementById('inf').value) || 0) / 100;
        const yrs = parseInt(document.getElementById('yrs-slider').value) || 1;

        document.getElementById('yrs-disp').innerText = yrs;

        let fExp = exp * Math.pow(1 + inf, yrs);
        let delta = fExp - exp;
        let ann = fExp * 12;

        let badge = document.getElementById('exp-badge');
        if (inf >= 0.08) { badge.innerText = "HYPERINFLATION DANGER"; badge.className = "status-badge badge-critical"; }
        else if (inf >= 0.05) { badge.innerText = "SEVERE EROSION"; badge.className = "status-badge badge-danger"; }
        else if (inf >= 0.03) { badge.innerText = "STANDARD RISING COSTS"; badge.className = "status-badge badge-warning"; }
        else if (inf > 0) { badge.innerText = "MODERATE INFLATION"; badge.className = "status-badge badge-info"; }
        else { badge.innerText = "DEFLATION/STABLE"; badge.className = "status-badge badge-optimal"; }

        try {
            document.getElementById('f-exp').innerText = format(fExp);
            document.getElementById('s-ann').innerText = format(ann);
            document.getElementById('s-delta').innerText = '+' + format(Math.max(0, delta));

            if(inf > 0) {
                const pcBase = (exp / fExp) * 100;
                const pcInf = 100 - pcBase;
                document.getElementById('bar-base').style.width = pcBase + '%';
                document.getElementById('bar-inf').style.width = pcInf + '%';
                document.getElementById('bar-base').style.background = '#e2e8f0';
            } else {
                document.getElementById('bar-base').style.width = '100%';
                document.getElementById('bar-inf').style.width = '0%';
                document.getElementById('bar-base').style.background = '#10b981';
            }
        } catch(e) {}
    }
    
    ['exp','inf','yrs-slider'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-fed').addEventListener('click', () => { document.getElementById('inf').value=2.0; calc(); });
    document.getElementById('qa-hist').addEventListener('click', () => { document.getElementById('inf').value=3.2; calc(); });
    document.getElementById('qa-high').addEventListener('click', () => { document.getElementById('inf').value=6.0; calc(); });
    document.getElementById('qa-crisis').addEventListener('click', () => { document.getElementById('inf').value=9.0; calc(); });
    document.getElementById('qa-def').addEventListener('click', () => { document.getElementById('inf').value=-1.0; calc(); });
    document.getElementById('qa-15y').addEventListener('click', () => { document.getElementById('yrs-slider').value=15; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\expense-forecast-calculator.blade.php ENDPATH**/ ?>