<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid financial-stress-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Stress Profiles</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-success" id="qa-zen" style="min-width: 280px; max-width: 100%;">Financial Zen</button>
                    <button class="qa-btn-component qa-info" id="qa-avg" style="min-width: 280px; max-width: 100%;">Average Middle Class</button>
                    <button class="qa-btn-component qa-warning" id="qa-tight" style="min-width: 280px; max-width: 100%;">Tight Liquidity</button>
                    <button class="qa-btn-component qa-danger" id="qa-debt" style="min-width: 280px; max-width: 100%;">Drowning in Debt</button>
                    <button class="qa-btn-component qa-primary" id="qa-mort" style="min-width: 280px; max-width: 100%;">House Poor</button>
                    <button class="qa-btn-component qa-dark" id="qa-brk" style="min-width: 280px; max-width: 100%;">Insolvency Risk</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-success">Monthly Net Income ($)</label>
                    <input type="number" id="inc" class="form-control-custom fw-bold" value="5000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-primary">Liquid Savings / Cash ($)</label>
                    <input type="number" id="cash" class="form-control-custom fw-bold" value="10000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Monthly Debt Obligations</h5>
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">Housing / Rent ($)</label>
                    <input type="number" id="hou" class="form-control-custom" value="1500" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-danger">Consumer Debt (Cards/Auto) ($)</label>
                    <input type="number" id="debt" class="form-control-custom" value="500" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-danger">Total CC Limits ($)</label>
                    <input type="number" id="lim" class="form-control-custom" value="10000" min="1">
                </div>
                <div class="col-md-12 form-group-custom mt-2 pt-2 border-top">
                    <label class="form-label-custom text-danger">Total Outstanding Consumer Balance ($)</label>
                    <input type="number" id="bal" class="form-control-custom" value="4500" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f97316;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Financial Stress Index</span>
                <span id="stress-badge" class="status-badge badge-info">Calculating</span>
            </div>
            <h1 class="result-main-value fs-1" id="stress" style="color: #ea580c;">0 / 100</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Debt-to-Income (DTI)</td><td class="text-end fw-semibold text-secondary" id="s-dti">0%</td></tr>
                    <tr><td>Credit Utilization</td><td class="text-end fw-semibold text-secondary" id="s-util">0%</td></tr>
                    <tr><td class="pt-2 border-top">Months of Savings Runway</td><td class="text-end pt-2 border-top fw-bold text-dark fs-6" id="s-run">0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Stress Pressure Dial</p>
            <div class="enhanced-progress-bar" style="height:14px;">
                <div id="bar-stress" class="enhanced-progress-segment" style="background:#ea580c; width:50%;"></div>
                <div id="bar-safe" class="enhanced-progress-segment" style="background:#f1f5f9; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Safe</span>
                <span style="color:#ef4444;font-weight:bold;">Crisis Zone</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const inc = parseFloat(document.getElementById('inc').value) || 1;
        const cash = parseFloat(document.getElementById('cash').value) || 0;
        const hou = parseFloat(document.getElementById('hou').value) || 0;
        const debtMo = parseFloat(document.getElementById('debt').value) || 0;
        const lim = parseFloat(document.getElementById('lim').value) || 1;
        const bal = parseFloat(document.getElementById('bal').value) || 0;

        const dti = ((hou + debtMo) / inc) * 100;
        const util = (bal / lim) * 100;
        
        // Let's assume bare minimum expenses are housing + debt + $1k basic food/util
        const bareExp = hou + debtMo + 1000;
        const runway = cash / bareExp;

        // Custom metric: 0 = Zen, 100 = Crisis
        // DTI over 40 adds up to 40 pts
        let ptDti = (dti / 60) * 40; if(ptDti > 40) ptDti = 40;
        // Util over 30 adds up to 30 pts
        let ptUtil = (util / 90) * 30; if(ptUtil > 30) ptUtil = 30;
        // Lack of runway adds up to 30 pts (0 runway = 30 pts, 6 month runway = 0 pts)
        let ptRun = 30 - ((runway / 6) * 30); if(ptRun < 0) ptRun = 0; if(ptRun > 30) ptRun = 30;

        let index = Math.floor(ptDti + ptUtil + ptRun);
        if(index > 100) index = 100;

        let badge = document.getElementById('stress-badge');
        let color = '#ea580c';
        let barColor = '#f59e0b';
        if(index > 80) { badge.innerText = "CRISIS ALERT"; badge.className = "status-badge badge-critical"; color='#b91c1c'; barColor='#ef4444'; }
        else if (index > 55) { badge.innerText = "HIGH STRESS"; badge.className = "status-badge badge-warning"; color='#d97706'; barColor='#f59e0b'; }
        else if (index > 30) { badge.innerText = "MODERATE STRESS"; badge.className = "status-badge badge-info"; color='#0ea5e9'; barColor='#3b82f6'; }
        else { badge.innerText = "FINANCIAL ZEN"; badge.className = "status-badge badge-optimal"; color='#047857'; barColor='#10b981'; }

        try {
            document.getElementById('stress').innerText = index + ' / 100';
            document.getElementById('stress').style.color = color;
            
            document.getElementById('s-dti').innerText = dti.toFixed(1) + '%';
            document.getElementById('s-util').innerText = util.toFixed(1) + '%';
            document.getElementById('s-run').innerText = runway.toFixed(1) + ' mo';

            document.getElementById('bar-stress').style.width = index + '%';
            document.getElementById('bar-stress').style.background = barColor;
            document.getElementById('bar-safe').style.width = (100 - index) + '%';
        } catch(e) {}
    }
    
    ['inc','cash','hou','debt','lim','bal'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-zen').addEventListener('click', () => { document.getElementById('inc').value=8000; document.getElementById('cash').value=50000; document.getElementById('hou').value=1500; document.getElementById('debt').value=0; document.getElementById('lim').value=25000; document.getElementById('bal').value=500; calc(); });
    document.getElementById('qa-avg').addEventListener('click', () => { document.getElementById('inc').value=5000; document.getElementById('cash').value=8000; document.getElementById('hou').value=1800; document.getElementById('debt').value=450; document.getElementById('lim').value=10000; document.getElementById('bal').value=4500; calc(); });
    document.getElementById('qa-tight').addEventListener('click', () => { document.getElementById('inc').value=4000; document.getElementById('cash').value=1500; document.getElementById('hou').value=1500; document.getElementById('debt').value=600; document.getElementById('lim').value=8000; document.getElementById('bal').value=6000; calc(); });
    document.getElementById('qa-debt').addEventListener('click', () => { document.getElementById('inc').value=6000; document.getElementById('cash').value=500; document.getElementById('hou').value=2000; document.getElementById('debt').value=1500; document.getElementById('lim').value=20000; document.getElementById('bal').value=19500; calc(); });
    document.getElementById('qa-mort').addEventListener('click', () => { document.getElementById('inc').value=7000; document.getElementById('cash').value=2000; document.getElementById('hou').value=4000; document.getElementById('debt').value=200; document.getElementById('lim').value=15000; document.getElementById('bal').value=1000; calc(); });
    document.getElementById('qa-brk').addEventListener('click', () => { document.getElementById('inc').value=3000; document.getElementById('cash').value=0; document.getElementById('hou').value=1800; document.getElementById('debt').value=900; document.getElementById('lim').value=10000; document.getElementById('bal').value=9900; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\financial-stress-calculator.blade.php ENDPATH**/ ?>