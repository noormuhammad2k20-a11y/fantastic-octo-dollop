<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid income-stability-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Career Profiles</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-sal" style="min-width: 280px; max-width: 100%;">Standard Salary</button>
                    <button class="qa-btn-component qa-danger" id="qa-free" style="min-width: 280px; max-width: 100%;">100% Freelance</button>
                    <button class="qa-btn-component qa-success" id="qa-com" style="min-width: 280px; max-width: 100%;">Sales (Base + Comm)</button>
                    <button class="qa-btn-component qa-warning" id="qa-gig" style="min-width: 280px; max-width: 100%;">Gig Worker</button>
                    <button class="qa-btn-component qa-info" id="qa-fat" style="min-width: 280px; max-width: 100%;">High Buffer Executive</button>
                    <button class="qa-btn-component qa-dark" id="qa-poor" style="min-width: 280px; max-width: 100%;">Paycheck to Paycheck</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-success">Monthly Fixed Income (Salary)</label>
                    <input type="number" id="fixed" class="form-control-custom fw-bold" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-primary">Monthly Variable (Bonus/Side)</label>
                    <input type="number" id="var" class="form-control-custom fw-bold" value="1000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Liabilities & Cushions</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Bare Minimum Monthly Expenses</label>
                    <input type="number" id="exp" class="form-control-custom" value="4500" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom">Current Liquid Emergency Fund</label>
                    <input type="number" id="ef" class="form-control-custom" value="15000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #475569;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Financial Stability Index</span>
                <span id="stab-badge" class="status-badge badge-optimal">Secure</span>
            </div>
            <h1 class="result-main-value fs-1" id="index" style="color: #1e293b;">0/100</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Fixed Income Ratio (Coverage)</td><td class="text-end fw-semibold text-secondary" id="s-cov">0%</td></tr>
                    <tr><td>Months of Runway (If 0 Income)</td><td class="text-end fw-bold text-success fs-6" id="s-run">0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Income Reliability Blend</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-fixed" class="enhanced-progress-segment" style="background:#10b981; width:83%;"></div>
                <div id="bar-var" class="enhanced-progress-segment" style="background:#3b82f6; width:17%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Guaranteed</span>
                <span style="color:#3b82f6;font-weight:bold;">Variable</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const fix = parseFloat(document.getElementById('fixed').value) || 0;
        const varI = parseFloat(document.getElementById('var').value) || 0;
        const exp = parseFloat(document.getElementById('exp').value) || 1;
        const ef = parseFloat(document.getElementById('ef').value) || 0;

        const totalInc = fix + varI;
        const cov = (fix / exp) * 100;
        const runway = ef / exp;

        // Custom index calculating stability 0-100
        // Score based on: fixed covering expenses (max 50 points), runway size (max 50 points for 6+ months)
        let scoreFix = (fix / exp) * 50; if(scoreFix > 50) scoreFix = 50;
        let scoreRun = (runway / 6) * 50; if(scoreRun > 50) scoreRun = 50;
        
        const index = Math.floor(scoreFix + scoreRun);

        let badge = document.getElementById('stab-badge');
        let color = '#1e293b';
        if(index < 30) { badge.innerText = "DANGER ZONE"; badge.className = "status-badge badge-critical"; color='#ef4444'; }
        else if (index < 60) { badge.innerText = "FRAGILE"; badge.className = "status-badge badge-warning"; color='#f59e0b'; }
        else if (index < 85) { badge.innerText = "STABLE"; badge.className = "status-badge badge-info"; color='#0ea5e9'; }
        else { badge.innerText = "IRONCLAD"; badge.className = "status-badge badge-optimal"; color='#10b981'; }

        try {
            document.getElementById('index').innerText = index + '/100';
            document.getElementById('index').style.color = color;
            
            document.getElementById('s-cov').innerText = (cov).toFixed(1) + '%';
            document.getElementById('s-run').innerText = runway.toFixed(1) + ' Months';

            if(totalInc > 0) {
                const fPct = (fix / totalInc) * 100;
                const vPct = 100 - fPct;
                document.getElementById('bar-fixed').style.width = fPct + '%';
                document.getElementById('bar-var').style.width = vPct + '%';
            } else {
                document.getElementById('bar-fixed').style.width = '0%';
                document.getElementById('bar-var').style.width = '0%';
            }
        } catch(e) {}
    }
    
    ['fixed','var','exp','ef'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-sal').addEventListener('click', () => { document.getElementById('fixed').value=6000; document.getElementById('var').value=0; document.getElementById('exp').value=5000; document.getElementById('ef').value=15000; calc(); });
    document.getElementById('qa-free').addEventListener('click', () => { document.getElementById('fixed').value=0; document.getElementById('var').value=8000; document.getElementById('exp').value=4500; document.getElementById('ef').value=10000; calc(); });
    document.getElementById('qa-com').addEventListener('click', () => { document.getElementById('fixed').value=3000; document.getElementById('var').value=6000; document.getElementById('exp').value=4000; document.getElementById('ef').value=20000; calc(); });
    document.getElementById('qa-gig').addEventListener('click', () => { document.getElementById('fixed').value=0; document.getElementById('var').value=3500; document.getElementById('exp').value=3000; document.getElementById('ef').value=1500; calc(); });
    document.getElementById('qa-fat').addEventListener('click', () => { document.getElementById('fixed').value=15000; document.getElementById('var').value=5000; document.getElementById('exp').value=10000; document.getElementById('ef').value=120000; calc(); });
    document.getElementById('qa-poor').addEventListener('click', () => { document.getElementById('fixed').value=4000; document.getElementById('var').value=200; document.getElementById('exp').value=3900; document.getElementById('ef').value=500; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\income-stability-calculator.blade.php ENDPATH**/ ?>