<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid credit-behavior-analyzer">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Borrower Patterns</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-optimal" style="min-width: 280px; max-width: 100%; background:#10b981;color:#fff;border:none;" id="qa-prime">Prime Borrower (PIF)</button>
                    <button class="qa-btn-component qa-primary" id="qa-avg" style="min-width: 280px; max-width: 100%;">Average User ($5k Bal)</button>
                    <button class="qa-btn-component qa-warning" id="qa-max" style="min-width: 280px; max-width: 100%;">Maxed Out Limits</button>
                    <button class="qa-btn-component qa-danger" id="qa-miss" style="min-width: 280px; max-width: 100%;">Recent Missed Payment</button>
                    <button class="qa-btn-component qa-info" id="qa-new" style="min-width: 280px; max-width: 100%;">Thin File (New)</button>
                    <button class="qa-btn-component qa-dark" id="qa-min" style="min-width: 280px; max-width: 100%;">Minimum Payments</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Total Combined Credit Limits ($)</label>
                    <input type="number" id="lim" class="form-control-custom fw-bold" value="15000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-danger">Total Target Balance ($)</label>
                    <input type="number" id="bal" class="form-control-custom fw-bold" value="3000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Payment History & Age</h5>
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">% of Statement Paid Mo.</label>
                    <input type="number" id="paid" class="form-control-custom text-success" value="100" min="0" max="100">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom">Missed Payments (Last 12mo)</label>
                    <input type="number" id="miss" class="form-control-custom text-danger" value="0" min="0" max="12">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom">Average Age of Accs (Yrs)</label>
                    <input type="number" id="age" class="form-control-custom" value="5" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #8b5cf6;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Behavior Impact Trajectory</span>
                <span id="cred-badge" class="status-badge badge-optimal">Positive</span>
            </div>
            <h1 class="result-main-value fs-2" id="traj" style="color: #6d28d9;">Upward Trend</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Credit Utilization Rate</td><td class="text-end fw-semibold text-secondary" id="s-util">0%</td></tr>
                    <tr><td>Penalty Trigger Risks</td><td class="text-end fw-bold text-danger fs-6" id="s-risk">None</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Utilization Pressure</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-util" class="enhanced-progress-segment" style="background:#10b981; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#64748b;font-weight:bold;">0%</span>
                <span style="color:#ef4444;font-weight:bold;">100% Maxed</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const lim = parseFloat(document.getElementById('lim').value) || 1;
        const bal = parseFloat(document.getElementById('bal').value) || 0;
        const paid = parseFloat(document.getElementById('paid').value) || 0;
        const miss = parseInt(document.getElementById('miss').value) || 0;
        const age = parseFloat(document.getElementById('age').value) || 0;

        const util = (bal / lim) * 100;
        
        let risk = "None";
        let traj = "Upward Trend";
        
        let badge = document.getElementById('cred-badge');
        let color = '#6d28d9';
        let barColor = '#10b981';

        // Hierarchy of credit destruction
        if (miss > 0) {
            traj = "SEVERE DROP (-50 to -100 pts)";
            risk = "Derogatory Marks Reported";
            badge.innerText = "CRITICAL DAMAGE"; badge.className = "status-badge badge-critical"; color='#ef4444';
        } else if (util > 80) {
            traj = "RAPID DECLINE";
            risk = "Maxed Out / Risk Surcharge";
            badge.innerText = "HIGH UTILIZATION"; badge.className = "status-badge badge-danger"; color='#ea580c'; barColor='#ef4444';
        } else if (util > 30 || paid < 50) {
            traj = "Downward / Stagnant";
            risk = "Carrying Balance Cost";
            badge.innerText = "BLEEDING POINTS"; badge.className = "status-badge badge-warning"; color='#f59e0b'; barColor='#f59e0b';
        } else if (age < 2) {
            traj = "Slow Upward Climb";
            risk = "Thin File Penalty";
            badge.innerText = "BUILDING CREDIT"; badge.className = "status-badge badge-info"; color='#0ea5e9';
        } else {
            traj = "Prime Upward Trajectory";
            badge.innerText = "EXCELLENT BEHAVIOR"; badge.className = "status-badge badge-optimal";
        }

        try {
            document.getElementById('traj').innerText = traj;
            document.getElementById('traj').style.color = color;
            
            document.getElementById('s-util').innerText = util.toFixed(1) + '%';
            document.getElementById('s-risk').innerText = risk;

            let wUtil = Math.min(100, util);
            document.getElementById('bar-util').style.width = wUtil + '%';
            document.getElementById('bar-util').style.background = wUtil > 30 ? (wUtil > 80 ? '#ef4444' : '#f59e0b') : '#10b981';
        } catch(e) {}
    }
    
    ['lim','bal','paid','miss','age'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-prime').addEventListener('click', () => { document.getElementById('lim').value=35000; document.getElementById('bal').value=1500; document.getElementById('paid').value=100; document.getElementById('miss').value=0; document.getElementById('age').value=8; calc(); });
    document.getElementById('qa-avg').addEventListener('click', () => { document.getElementById('lim').value=15000; document.getElementById('bal').value=5000; document.getElementById('paid').value=20; document.getElementById('miss').value=0; document.getElementById('age').value=4; calc(); });
    document.getElementById('qa-max').addEventListener('click', () => { document.getElementById('lim').value=8000; document.getElementById('bal').value=7800; document.getElementById('paid').value=5; document.getElementById('miss').value=0; document.getElementById('age').value=5; calc(); });
    document.getElementById('qa-miss').addEventListener('click', () => { document.getElementById('lim').value=20000; document.getElementById('bal').value=3000; document.getElementById('paid').value=50; document.getElementById('miss').value=1; document.getElementById('age').value=6; calc(); });
    document.getElementById('qa-new').addEventListener('click', () => { document.getElementById('lim').value=1500; document.getElementById('bal').value=100; document.getElementById('paid').value=100; document.getElementById('miss').value=0; document.getElementById('age').value=0.5; calc(); });
    document.getElementById('qa-min').addEventListener('click', () => { document.getElementById('lim').value=12000; document.getElementById('bal').value=5000; document.getElementById('paid').value=3; document.getElementById('miss').value=0; document.getElementById('age').value=3; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-behavior-analyzer.blade.php ENDPATH**/ ?>