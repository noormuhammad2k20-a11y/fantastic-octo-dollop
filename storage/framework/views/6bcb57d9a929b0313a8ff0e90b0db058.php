<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid income-growth-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Career Trajectories</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard Cost of Living (3%)</button>
                    <button class="qa-btn-component qa-success" id="qa-promo" style="min-width: 280px; max-width: 100%;">Promo Track (8%)</button>
                    <button class="qa-btn-component qa-info" id="qa-job" style="min-width: 280px; max-width: 100%;">Job Hopper (12%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-stag" style="min-width: 280px; max-width: 100%;">Stagnated (0.5%)</button>
                    <button class="qa-btn-component qa-danger" id="qa-inf" style="min-width: 280px; max-width: 100%;">Losing to Inflation (2%)</button>
                    <button class="qa-btn-component qa-dark" id="qa-tech" style="min-width: 280px; max-width: 100%;">Tech Scaling (15%)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Current Annual Income ($)</label>
                    <input type="number" id="inc" class="form-control-custom fw-bold text-success" value="65000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom">Annual Growth/Raise Rate (%)</label>
                    <input type="number" id="rate" class="form-control-custom text-primary fw-bold" value="3.0" step="0.5">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Projection Timeline</h5>
            <div class="row">
                <div class="col-md-12 form-group-custom mb-2">
                    <label class="form-label-custom">Years to Forecast</label>
                    <input type="range" id="yrs-slider" class="form-range" min="1" max="40" value="10">
                    <div class="text-center text-muted fw-bold"><span id="yrs-disp">10</span> Years</div>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #14b8a6;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Future Annual Income (Year <span id="r-yr">10</span>)</span>
                <span id="inc-badge" class="status-badge badge-info">Healthy</span>
            </div>
            <h1 class="result-main-value fs-1" id="f-inc" style="color: #0f766e;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Gross Earnings Over Period</td><td class="text-end fw-semibold text-secondary" id="s-tot">$0</td></tr>
                    <tr><td>Absolute Income Increase</td><td class="text-end fw-bold text-success fs-6" id="s-delta">+$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Income Composition at End Date</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-base" class="enhanced-progress-segment" style="background:#94a3b8; width:50%;"></div>
                <div id="bar-grow" class="enhanced-progress-segment" style="background:#14b8a6; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#64748b;font-weight:bold;">Original Base</span>
                <span style="color:#14b8a6;font-weight:bold;">Compounded Raises</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const inc = parseFloat(document.getElementById('inc').value) || 0;
        const rate = (parseFloat(document.getElementById('rate').value) || 0) / 100;
        const yrs = parseInt(document.getElementById('yrs-slider').value) || 1;

        document.getElementById('yrs-disp').innerText = yrs;
        document.getElementById('r-yr').innerText = yrs;

        let futureInc = inc * Math.pow(1 + rate, yrs);
        let delta = futureInc - inc;

        // Sum of geometric series for total earnings
        let totalSum = 0;
        if(rate === 0) {
            totalSum = inc * yrs;
        } else {
            // End of year payment convention
            totalSum = inc * ( (Math.pow(1 + rate, yrs) - 1) / rate );
        }

        let badge = document.getElementById('inc-badge');
        if (rate < 0.02) { badge.innerText = "BEHIND INFLATION"; badge.className = "status-badge badge-danger"; }
        else if (rate < 0.05) { badge.innerText = "STANDARD COLA"; badge.className = "status-badge badge-warning"; }
        else if (rate < 0.10) { badge.innerText = "STRONG TRAJECTORY"; badge.className = "status-badge badge-info"; }
        else { badge.innerText = "ACCELERATED WEALTH"; badge.className = "status-badge badge-optimal"; }

        try {
            document.getElementById('f-inc').innerText = format(futureInc);
            document.getElementById('s-tot').innerText = format(totalSum);
            document.getElementById('s-delta').innerText = '+' + format(delta);

            if(futureInc > 0) {
                const pcBase = (inc / futureInc) * 100;
                const pcGrow = 100 - pcBase;
                document.getElementById('bar-base').style.width = pcBase + '%';
                document.getElementById('bar-grow').style.width = pcGrow + '%';
            }
        } catch(e) {}
    }
    
    ['inc','rate','yrs-slider'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('rate').value=3.0; calc(); });
    document.getElementById('qa-promo').addEventListener('click', () => { document.getElementById('rate').value=8.0; calc(); });
    document.getElementById('qa-job').addEventListener('click', () => { document.getElementById('rate').value=12.0; calc(); });
    document.getElementById('qa-stag').addEventListener('click', () => { document.getElementById('rate').value=0.5; calc(); });
    document.getElementById('qa-inf').addEventListener('click', () => { document.getElementById('rate').value=2.0; calc(); });
    document.getElementById('qa-tech').addEventListener('click', () => { document.getElementById('rate').value=15.0; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\income-growth-calculator.blade.php ENDPATH**/ ?>