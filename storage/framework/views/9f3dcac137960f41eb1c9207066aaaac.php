<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid growth-metrics-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Growth Horizons</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard Scale (5%)</button>
                    <button class="qa-btn-component qa-success" id="qa-hype" style="min-width: 280px; max-width: 100%;">Hyper-Growth (20%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-stag" style="min-width: 280px; max-width: 100%;">Stagnating (1%)</button>
                    <button class="qa-btn-component qa-danger" id="qa-dec" style="min-width: 280px; max-width: 100%;">Decline (-3%)</button>
                    <button class="qa-btn-component qa-dark" id="qa-y5" style="min-width: 280px; max-width: 100%;">5-Year Horizon</button>
                    <button class="qa-btn-component qa-info" id="qa-y10" style="min-width: 280px; max-width: 100%;">10-Year Trajectory</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Current Metric Base (Users, $, etc.)</label>
                    <input type="number" id="base" class="form-control-custom fw-bold fs-5 text-primary" value="10000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Period Over Period Growth (%)</label>
                    <input type="number" id="rate" class="form-control-custom" value="5" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Number of Successive Periods</label>
                    <input type="number" id="periods" class="form-control-custom" value="12" min="1" max="120">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #a855f7;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">End Base After <span id="p-disp">12</span> Periods</span>
                <span id="grow-badge" class="status-badge badge-optimal">Compounding</span>
            </div>
            <h1 class="result-main-value fs-2" id="res" style="color: #7e22ce;">0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Absolute Growth Delta</td><td class="text-end fw-semibold text-secondary" id="delta">0</td></tr>
                    <tr><td>Total Multiplier Factor</td><td class="text-end fw-bold text-success fs-6" id="mult">1.0x</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Growth Proportion</p>
            <div class="enhanced-progress-bar" style="height:10px;">
                <div id="bar-base" class="enhanced-progress-segment" style="background:#cbd5e1; width:50%;"></div>
                <div id="bar-new" class="enhanced-progress-segment" style="background:#a855f7; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#64748b;font-weight:bold;">Original Base</span>
                <span style="color:#a855f7;font-weight:bold;">New Gains</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const base = parseFloat(document.getElementById('base').value) || 0;
        const rate = (parseFloat(document.getElementById('rate').value) || 0) / 100;
        const periods = parseInt(document.getElementById('periods').value) || 1;
        
        document.getElementById('p-disp').innerText = periods;

        let endBase = base * Math.pow(1 + rate, periods);
        const delta = endBase - base;
        const mult = base > 0 ? (endBase / base) : 0;

        let badge = document.getElementById('grow-badge');
        if(rate < 0) { badge.innerText = "BLEEDING ASSETS"; badge.className = "status-badge badge-critical"; }
        else if (rate < 0.02) { badge.innerText = "STAGNANT"; badge.className = "status-badge badge-warning"; }
        else if (rate > 0.15) { badge.innerText = "HYPER-GROWTH"; badge.className = "status-badge badge-optimal"; }
        else { badge.innerText = "STEADY CLIMB"; badge.className = "status-badge badge-info"; }

        try {
            document.getElementById('res').innerText = endBase.toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2});
            document.getElementById('delta').innerText = (delta>=0?'+':'') + delta.toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2});
            document.getElementById('mult').innerText = mult.toFixed(2) + 'x';

            if(rate >= 0) {
                const pcBase = (base / endBase) * 100;
                const pcNew = 100 - pcBase;
                document.getElementById('bar-base').style.width = pcBase + '%';
                document.getElementById('bar-new').style.width = pcNew + '%';
                document.getElementById('bar-new').style.background = '#a855f7';
            } else {
                document.getElementById('bar-base').style.width = '100%';
                document.getElementById('bar-new').style.width = '0%';
            }
        } catch(e) {}
    }
    
    ['base','rate','periods'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('rate').value=5; calc(); });
    document.getElementById('qa-hype').addEventListener('click', () => { document.getElementById('rate').value=20; calc(); });
    document.getElementById('qa-stag').addEventListener('click', () => { document.getElementById('rate').value=1; calc(); });
    document.getElementById('qa-dec').addEventListener('click', () => { document.getElementById('rate').value=-3; calc(); });
    document.getElementById('qa-y5').addEventListener('click', () => { document.getElementById('periods').value=60; calc(); });
    document.getElementById('qa-y10').addEventListener('click', () => { document.getElementById('periods').value=120; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\growth-metrics-calculator.blade.php ENDPATH**/ ?>