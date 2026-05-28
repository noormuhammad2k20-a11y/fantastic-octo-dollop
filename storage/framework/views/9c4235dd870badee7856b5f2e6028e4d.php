<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid fixed-charge-coverage-ratio-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Corporate Profiles</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-safe" style="min-width: 280px; max-width: 100%;">Safe Corp (High Margin)</button>
                    <button class="qa-btn-component qa-success" id="qa-lease" style="min-width: 280px; max-width: 100%;">Asset Light (High Lease)</button>
                    <button class="qa-btn-component qa-warning" id="qa-warn" style="min-width: 280px; max-width: 100%;">Danger Zone (Ratio < 1.5)</button>
                    <button class="qa-btn-component qa-danger" id="qa-fail" style="min-width: 280px; max-width: 100%;">Default Risk (Ratio < 1.0)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Earnings Before Interest & Taxes (EBIT) ($)</label>
                    <input type="number" id="ebit" class="form-control-custom fw-bold fs-5 text-primary" value="500000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Fixed Commitments (Before Tax)</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom text-danger fw-bold">Interest Payments ($)</label>
                    <input type="number" id="int" class="form-control-custom fw-bold" value="80000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom text-danger fw-bold">Lease / Fixed Charges ($)</label>
                    <input type="number" id="lease" class="form-control-custom fw-bold" value="120000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">FCCR Ratio</span>
                <span id="fccr-badge" class="status-badge badge-optimal">Strong</span>
            </div>
            <h1 class="result-main-value fs-1" id="fccr-val" style="color: #047857;">3.1x</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>EBIT + Fixed Charges (Numerator)</td><td class="text-end fw-semibold text-secondary" id="s-num">$0</td></tr>
                    <tr><td>Total Fixed Charges (Denominator)</td><td class="text-end fw-bold text-danger fs-6" id="s-den">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Coverage Padding</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-fccr" class="enhanced-progress-segment" style="background:#10b981; width:70%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#ef4444;font-weight:bold;">1.0x (Break Even)</span>
                <span style="color:#10b981;font-weight:bold;">Safe Capacity</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const ebit = parseFloat(document.getElementById('ebit').value)||0;
        const intAmt = parseFloat(document.getElementById('int').value)||0;
        const lease = parseFloat(document.getElementById('lease').value)||0;

        const num = ebit + lease; // Formula: (EBIT + Lease/Fixed) / (Interest + Lease/Fixed)
        const den = intAmt + lease;

        let fccr = 0;
        if (den > 0) {
            fccr = num / den;
        }

        let badge = document.getElementById('fccr-badge');
        let badgeColor = '#047857';
        let barColor = '#10b981';

        if (den === 0) { badge.innerText = "NO DEBT"; badge.className = "status-badge badge-primary"; }
        else if (fccr < 1.0) { badge.innerText = "DEFAULT RISK (<1.0x)"; badge.className = "status-badge badge-critical"; badgeColor='#be123c'; barColor='#ef4444'; }
        else if (fccr < 1.5) { badge.innerText = "DANGER ZONE (<1.5x)"; badge.className = "status-badge badge-danger"; badgeColor='#ea580c'; barColor='#ea580c'; }
        else if (fccr < 2.0) { badge.innerText = "WEAK COVERAGE (<2x)"; badge.className = "status-badge badge-warning"; badgeColor='#f59e0b'; barColor='#f59e0b'; }
        else { badge.innerText = "STRONG COVERAGE"; badge.className = "status-badge badge-optimal"; }

        try {
            document.getElementById('fccr-val').innerText = (den === 0) ? "N/A" : fccr.toFixed(2) + "x";
            document.getElementById('fccr-val').style.color = badgeColor;
            
            document.getElementById('s-num').innerText = format(num);
            document.getElementById('s-den').innerText = format(den);

            // Cap bar at 3.0x max for visual
            let maxFccr = 3.0;
            let pFccr = Math.min(100, Math.max(0, (fccr / maxFccr) * 100));
            if(den === 0) pFccr = 100;

            document.getElementById('bar-fccr').style.width = pFccr + '%';
            document.getElementById('bar-fccr').style.background = barColor;
        } catch(e) {}
    }
    
    ['ebit','int','lease'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-safe').addEventListener('click', () => { document.getElementById('ebit').value=1500000; document.getElementById('int').value=100000; document.getElementById('lease').value=50000; calc(); });
    document.getElementById('qa-lease').addEventListener('click', () => { document.getElementById('ebit').value=800000; document.getElementById('int').value=20000; document.getElementById('lease').value=300000; calc(); });
    document.getElementById('qa-warn').addEventListener('click', () => { document.getElementById('ebit').value=300000; document.getElementById('int').value=250000; document.getElementById('lease').value=100000; calc(); });
    document.getElementById('qa-fail').addEventListener('click', () => { document.getElementById('ebit').value=100000; document.getElementById('int').value=150000; document.getElementById('lease').value=50000; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\fixed-charge-coverage-ratio-calculator.blade.php ENDPATH**/ ?>