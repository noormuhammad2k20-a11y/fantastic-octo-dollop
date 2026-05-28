<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid kpi-performance-tracker">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Performance Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-success" id="qa-crush" style="min-width: 280px; max-width: 100%;">Crushing Target</button>
                    <button class="qa-btn-component qa-warning" id="qa-slight" style="min-width: 280px; max-width: 100%;">Slight Miss</button>
                    <button class="qa-btn-component qa-danger" id="qa-miss" style="min-width: 280px; max-width: 100%;">Missing KPIs</button>
                    <button class="qa-btn-component qa-info" id="qa-rev" style="min-width: 280px; max-width: 100%;">Revenue Lead</button>
                    <button class="qa-btn-component qa-primary" id="qa-cac" style="min-width: 280px; max-width: 100%;">High CAC Crisis</button>
                    <button class="qa-btn-component qa-dark" id="qa-par" style="min-width: 280px; max-width: 100%;">Parity (100%)</button>
                </div>
            </div>

            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Revenue Metrics ($)</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Target Revenue</label>
                    <input type="number" id="t-rev" class="form-control-custom" value="100000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-success fw-bold">Actual Revenue</label>
                    <input type="number" id="a-rev" class="form-control-custom" value="105000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-3 pb-2 border-bottom mb-2 w-100">Acquisition Metrics (CAC $)</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Target CAC Limit</label>
                    <input type="number" id="t-cac" class="form-control-custom" value="50" min="0">
                </div>
                <!-- Lower is better for CAC -->
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger fw-bold">Actual CAC</label>
                    <input type="number" id="a-cac" class="form-control-custom" value="48" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-3 pb-2 border-bottom mb-2 w-100">Volume Metrics (Units/Deals)</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Target Deals</label>
                    <input type="number" id="t-unit" class="form-control-custom" value="2000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-primary fw-bold">Actual Deals</label>
                    <input type="number" id="a-unit" class="form-control-custom" value="2187" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Aggregate KPI Score</span>
                <span id="kpi-badge" class="status-badge badge-optimal">On Track</span>
            </div>
            <h1 class="result-main-value fs-1" id="score" style="color: #047857;">0%</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Revenue Achievement</td><td class="text-end fw-semibold text-secondary" id="s-rev">0%</td></tr>
                    <tr><td>CAC Efficiency (Inverse)</td><td class="text-end fw-semibold text-secondary" id="s-cac">0%</td></tr>
                    <tr><td class="pt-2 border-top">Volume Achievement</td><td class="text-end pt-2 border-top fw-bold text-dark fs-6" id="s-unit">0%</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Weighted Health Bar</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-score" class="enhanced-progress-segment" style="background:#10b981; width:0%;"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const trev = parseFloat(document.getElementById('t-rev').value) || 1;
        const arev = parseFloat(document.getElementById('a-rev').value) || 0;
        const tcac = parseFloat(document.getElementById('t-cac').value) || 1;
        const acac = parseFloat(document.getElementById('a-cac').value) || 1;
        const tunit = parseFloat(document.getElementById('t-unit').value) || 1;
        const aunit = parseFloat(document.getElementById('a-unit').value) || 0;

        const revAchieve = (arev / trev) * 100;
        // Inverse for CAC. If tcac is 50, and acac is 40, achievement is 50/40 = 125%
        const cacAchieve = (tcac / acac) * 100;
        const unitAchieve = (aunit / tunit) * 100;

        const aggregate = (revAchieve + cacAchieve + unitAchieve) / 3;

        let badge = document.getElementById('kpi-badge');
        let color = '#047857';
        let barColor = '#10b981';
        if(aggregate < 80) { 
            badge.innerText = "CRITICAL MISS"; badge.className = "status-badge badge-critical"; color='#b91c1c'; barColor='#ef4444';
        } else if (aggregate < 100) { 
            badge.innerText = "FALLING BEHIND"; badge.className = "status-badge badge-warning"; color='#d97706'; barColor='#f59e0b';
        } else if (aggregate > 115) {
            badge.innerText = "OVERPERFORMING"; badge.className = "status-badge badge-info"; color='#1d4ed8'; barColor='#3b82f6';
        } else { 
            badge.innerText = "ON TRACK"; badge.className = "status-badge badge-optimal";
        }

        try {
            document.getElementById('score').innerText = aggregate.toFixed(1) + '%';
            document.getElementById('score').style.color = color;
            
            document.getElementById('s-rev').innerText = revAchieve.toFixed(1) + '%';
            document.getElementById('s-cac').innerText = cacAchieve.toFixed(1) + '%';
            document.getElementById('s-unit').innerText = unitAchieve.toFixed(1) + '%';

            document.getElementById('bar-score').style.width = Math.min(100, aggregate) + '%';
            document.getElementById('bar-score').style.background = barColor;
        } catch(e) {}
    }
    
    ['t-rev','a-rev','t-cac','a-cac','t-unit','a-unit'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-crush').addEventListener('click', () => { document.getElementById('a-rev').value = 150000; document.getElementById('a-cac').value = 35; document.getElementById('a-unit').value = 2800; calc(); });
    document.getElementById('qa-slight').addEventListener('click', () => { document.getElementById('a-rev').value = 95000; document.getElementById('a-cac').value = 52; document.getElementById('a-unit').value = 1900; calc(); });
    document.getElementById('qa-miss').addEventListener('click', () => { document.getElementById('a-rev').value = 60000; document.getElementById('a-cac').value = 85; document.getElementById('a-unit').value = 1200; calc(); });
    document.getElementById('qa-rev').addEventListener('click', () => { document.getElementById('a-rev').value = 200000; document.getElementById('a-cac').value = 60; document.getElementById('a-unit').value = 1800; calc(); });
    document.getElementById('qa-cac').addEventListener('click', () => { document.getElementById('t-cac').value = 50; document.getElementById('a-cac').value = 150; calc(); });
    document.getElementById('qa-par').addEventListener('click', () => { document.getElementById('a-rev').value = document.getElementById('t-rev').value; document.getElementById('a-cac').value = document.getElementById('t-cac').value; document.getElementById('a-unit').value = document.getElementById('t-unit').value; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\kpi-performance-tracker.blade.php ENDPATH**/ ?>