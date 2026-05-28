<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid average-collection-period-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Operational Baselines</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-net30" style="min-width: 280px; max-width: 100%;">Net-30 Standard</button>
                    <button class="qa-btn-component qa-success" id="qa-fast" style="min-width: 280px; max-width: 100%;">Fast Collection</button>
                    <button class="qa-btn-component qa-danger" id="qa-slow">Slow / Delayed (90<span style="font-size:10px;">d</span>)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1 text-primary">Annual Net Credit Sales ($)</label>
                    <input type="number" id="sc" class="form-control-custom fw-bold fs-5 text-primary" value="1200000" min="1">
                    <small class="text-muted">Do not include cash sales.</small>
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Accounts Receivable (A/R)</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-info">
                    <label class="form-label-custom">Beginning A/R ($)</label>
                    <input type="number" id="ar-b" class="form-control-custom" value="95000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-info">
                    <label class="form-label-custom">Ending A/R ($)</label>
                    <input type="number" id="ar-e" class="form-control-custom" value="105000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Collection Period</span>
                <span id="acp-badge" class="status-badge badge-optimal">Standard Net-30</span>
            </div>
            <h1 class="result-main-value fs-1" id="acp-val" style="color: #047857;">30 Days</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Average Accounts Receivable</td><td class="text-end fw-semibold text-secondary" id="s-ar">$0</td></tr>
                    <tr><td>A/R Turnover Ratio</td><td class="text-end fw-bold text-info fs-6" id="s-to">0x</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Liquidity Delay</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-acp" class="enhanced-progress-segment" style="background:#10b981; width:33%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">0 Days</span>
                <span style="color:#ef4444;font-weight:bold;">90+ Days</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const sc = parseFloat(document.getElementById('sc').value)||1;
        const arb = parseFloat(document.getElementById('ar-b').value)||0;
        const are = parseFloat(document.getElementById('ar-e').value)||0;

        const avgAr = (arb + are) / 2;
        
        let to = 0;
        if(avgAr > 0) to = sc / avgAr;

        let acp = 0;
        if(to > 0) acp = 365 / to;

        let badge = document.getElementById('acp-badge');
        let badgeColor = '#047857';
        let barColor = '#10b981';

        if (acp > 90) { badge.innerText = "SEVERE DELAY (>90d)"; badge.className = "status-badge badge-critical"; badgeColor='#be123c'; barColor='#ef4444'; }
        else if (acp > 60) { badge.innerText = "SLOW COLLECTION (>60d)"; badge.className = "status-badge badge-danger"; badgeColor='#ea580c'; barColor='#ea580c'; }
        else if (acp > 45) { badge.innerText = "ELEVATED (Net-45)"; badge.className = "status-badge badge-warning"; badgeColor='#f59e0b'; barColor='#f59e0b'; }
        else if (acp > 25) { badge.innerText = "STANDARD (Net-30)"; badge.className = "status-badge badge-info"; badgeColor='#0ea5e9'; barColor='#0ea5e9'; }
        else { badge.innerText = "FAST COLLECTION (<25d)"; badge.className = "status-badge badge-optimal"; barColor='#10b981'; badgeColor='#047857'; }

        try {
            document.getElementById('acp-val').innerText = Math.round(acp) + " Days";
            document.getElementById('acp-val').style.color = badgeColor;
            
            document.getElementById('s-ar').innerText = format(avgAr);
            document.getElementById('s-to').innerText = to.toFixed(1) + "x";

            let maxAcp = 90.0;
            let pAcp = Math.min(100, Math.max(0, (acp / maxAcp) * 100));

            document.getElementById('bar-acp').style.width = pAcp + '%';
            document.getElementById('bar-acp').style.background = barColor;
        } catch(e) {}
    }
    
    ['sc','ar-b','ar-e'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-net30').addEventListener('click', () => { document.getElementById('sc').value=1200000; document.getElementById('ar-b').value=95000; document.getElementById('ar-e').value=105000; calc(); });
    document.getElementById('qa-fast').addEventListener('click', () => { document.getElementById('sc').value=2000000; document.getElementById('ar-b').value=80000; document.getElementById('ar-e').value=70000; calc(); });
    document.getElementById('qa-slow').addEventListener('click', () => { document.getElementById('sc').value=500000; document.getElementById('ar-b').value=120000; document.getElementById('ar-e').value=130000; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\average-collection-period-calculator.blade.php ENDPATH**/ ?>