<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid website-analytics-tool">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Traffic Modifiers</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard Site</button>
                    <button class="qa-btn-component qa-danger" id="qa-bot" style="min-width: 280px; max-width: 100%;">Bot Traffic (High Bnc)</button>
                    <button class="qa-btn-component qa-success" id="qa-opt" style="min-width: 280px; max-width: 100%;">Highly Optimized</button>
                    <button class="qa-btn-component qa-warning" id="qa-blog" style="min-width: 280px; max-width: 100%;">Blog (Long Session)</button>
                    <button class="qa-btn-component qa-info" id="qa-viral" style="min-width: 280px; max-width: 100%;">Viral Spike</button>
                    <button class="qa-btn-component qa-dark" id="qa-lose" style="min-width: 280px; max-width: 100%;">Broken Funnel</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Monthly Unique Visitors</label>
                    <input type="number" id="vis" class="form-control-custom" value="25000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-danger fw-bold">Bounce Rate (%)</label>
                    <input type="number" id="bounce" class="form-control-custom" value="65" min="0" max="100">
                </div>
                
                <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Engagement Variables</h5>
                
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Goal Conversion Rate (%)</label>
                    <input type="number" id="goal" class="form-control-custom text-success fw-bold" value="3.5" step="0.1" max="100">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Value of a Goal ($)</label>
                    <input type="number" id="val" class="form-control-custom" value="15.00" step="0.5">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Est. Monthly Revenue</span>
                <span id="site-badge" class="status-badge badge-optimal">Healthy</span>
            </div>
            <h1 class="result-main-value fs-2" id="rev" style="color: #0369a1;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Engaged Users (Non-Bounce)</td><td class="text-end fw-semibold text-secondary" id="engage">0</td></tr>
                    <tr><td>Total Monthly Conversions</td><td class="text-end fw-bold text-success fs-6" id="conv">0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">User Engagement Drop-off Ratio</p>
            <div class="enhanced-progress-bar" style="height:14px;">
                <div id="bar-bounce" class="enhanced-progress-segment" style="background:#ef4444; width:65%; font-size:10px;">Bounced</div>
                <div id="bar-engage" class="enhanced-progress-segment" style="background:#10b981; width:35%; font-size:10px;">Retained</div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const vis = parseFloat(document.getElementById('vis').value) || 0;
        const bPct = (parseFloat(document.getElementById('bounce').value) || 0) / 100;
        const cPct = (parseFloat(document.getElementById('goal').value) || 0) / 100;
        const val = parseFloat(document.getElementById('val').value) || 0;

        // Bounced vs Engaged
        const bounced = Math.floor(vis * bPct);
        const engaged = vis - bounced;
        
        // Conversions typically calculated off total visitors, but we can display the engaged proxy
        const conv = vis * cPct;
        const rev = conv * val;

        let badge = document.getElementById('site-badge');
        if(bPct > 0.85) { badge.innerText = "DEAD TRAFFIC"; badge.className = "status-badge badge-critical"; }
        else if (cPct < 0.005) { badge.innerText = "NO CONVERSION"; badge.className = "status-badge badge-warning"; }
        else if (bPct < 0.40 && cPct >= 0.05) { badge.innerText = "HIGH QUALITY"; badge.className = "status-badge badge-optimal"; }
        else { badge.innerText = "AVERAGE DATA"; badge.className = "status-badge badge-info"; }

        try {
            document.getElementById('rev').innerText = format(rev);
            document.getElementById('engage').innerText = engaged.toLocaleString('en-US');
            document.getElementById('conv').innerText = Math.floor(conv).toLocaleString('en-US');

            const bb = Math.min(100, bPct * 100);
            const ee = 100 - bb;
            document.getElementById('bar-bounce').style.width = bb + '%';
            document.getElementById('bar-engage').style.width = ee + '%';
        } catch(e) {}
    }
    
    ['vis','bounce','goal','val'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('vis').value=25000; document.getElementById('bounce').value=65; document.getElementById('goal').value=3.5; document.getElementById('val').value=15; calc(); });
    document.getElementById('qa-bot').addEventListener('click', () => { document.getElementById('vis').value=100000; document.getElementById('bounce').value=95; document.getElementById('goal').value=0.1; calc(); });
    document.getElementById('qa-opt').addEventListener('click', () => { document.getElementById('vis').value=15000; document.getElementById('bounce').value=35; document.getElementById('goal').value=12.5; document.getElementById('val').value=50; calc(); });
    document.getElementById('qa-blog').addEventListener('click', () => { document.getElementById('vis').value=50000; document.getElementById('bounce').value=80; document.getElementById('goal').value=1.5; document.getElementById('val').value=2; calc(); });
    document.getElementById('qa-viral').addEventListener('click', () => { document.getElementById('vis').value=1000000; document.getElementById('bounce').value=88; document.getElementById('goal').value=0.5; document.getElementById('val').value=10; calc(); });
    document.getElementById('qa-lose').addEventListener('click', () => { document.getElementById('vis').value=5000; document.getElementById('bounce').value=98; document.getElementById('goal').value=0; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\website-analytics-tool.blade.php ENDPATH**/ ?>