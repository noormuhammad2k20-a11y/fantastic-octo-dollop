<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid rmd-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Standard Profiles (Uniform Lifetime)</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-73" style="min-width: 280px; max-width: 100%;">New RMD Age (73)</button>
                    <button class="qa-btn-component qa-success" id="qa-80" style="min-width: 280px; max-width: 100%;">Established (80)</button>
                    <button class="qa-btn-component qa-warning" id="qa-90" style="min-width: 280px; max-width: 100%;">Late Stage (90)</button>
                </div>
                <small class="d-block mt-1 text-muted">Assumes use of the Uniform Lifetime Table (the most common).</small>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1 text-primary">Prior Year-End Account Balance ($)</label>
                    <input type="number" id="bal" class="form-control-custom fw-bold fs-5 text-primary" value="500000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom border-bottom pb-1">Current Age (This Year)</label>
                    <input type="number" id="age" class="form-control-custom fw-bold fs-5" value="73" min="1" max="120">
                </div>
            </div>
            
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #a855f7;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Estimated Required Distribution</span>
                <span id="rmd-badge" class="status-badge badge-optimal">Standard Yield</span>
            </div>
            <h1 class="result-main-value fs-1" id="rmd-val" style="color: #7e22ce;">$18,867.92</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>IRS Distribution Period Factor</td><td class="text-end fw-semibold text-secondary" id="s-fac">26.5</td></tr>
                    <tr><td>Percentage of Total Balance</td><td class="text-end fw-bold text-info fs-6" id="s-pct">3.77%</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Account Impact</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-ret" class="enhanced-progress-segment" style="background:#10b981; width:96.23%;"></div>
                <div id="bar-rmd" class="enhanced-progress-segment" style="background:#f59e0b; width:3.77%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Taxes Deferred</span>
                <span style="color:#f59e0b;font-weight:bold;">Taxable Dist.</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2}); }
    
    // Condensed version of Uniform Lifetime Table (2022+ updates)
    // Map Age -> Distribution Period Factor
    const ult = {
        72: 27.4, 73: 26.5, 74: 25.5, 75: 24.6, 76: 23.7, 77: 22.9, 78: 22.0, 79: 21.1,
        80: 20.2, 81: 19.4, 82: 18.5, 83: 17.7, 84: 16.8, 85: 16.0, 86: 15.2, 87: 14.4,
        88: 13.7, 89: 12.9, 90: 12.2, 91: 11.5, 92: 10.8, 93: 10.1, 94: 9.5, 95: 8.9,
        96: 8.4, 97: 7.8, 98: 7.3, 99: 6.8, 100: 6.4, 101: 6.0, 102: 5.6, 103: 5.2,
        104: 4.9, 105: 4.6, 106: 4.3, 107: 4.1, 108: 3.9, 109: 3.7, 110: 3.5, 111: 3.4,
        112: 3.3, 113: 3.1, 114: 3.0, 115: 2.9, 116: 2.8, 117: 2.7, 118: 2.5, 119: 2.3, 120: 2.0
    };

    function calc() {
        const bal = parseFloat(document.getElementById('bal').value)||0;
        const age = parseInt(document.getElementById('age').value)||73;

        let badge = document.getElementById('rmd-badge');
        let badgeColor = '#7e22ce';

        if (age < 73) {
            badge.innerText = "NO RMD REQUIRED YET (<73)";
            badge.className = "status-badge badge-primary";
            document.getElementById('rmd-val').innerText = "$0.00";
            document.getElementById('s-fac').innerText = "N/A";
            document.getElementById('s-pct').innerText = "0.00%";
            document.getElementById('bar-ret').style.width = '100%';
            document.getElementById('bar-rmd').style.width = '0%';
            return;
        }

        let ageLookup = age > 120 ? 120 : age;
        let factor = ult[ageLookup] || 26.5; 

        let rmd = bal / factor;
        let pct = (rmd / bal) * 100;

        if (bal === 0) pct = 0;

        if (pct > 10) { badge.innerText = "HIGH PORTRAYAL (>10%)"; badge.className = "status-badge badge-critical"; }
        else if (pct > 6) { badge.innerText = "ELEVATED TAX IMPACT"; badge.className = "status-badge badge-warning"; }
        else { badge.innerText = "STANDARD DISTRIBUTION"; badge.className = "status-badge badge-optimal"; }

        try {
            document.getElementById('rmd-val').innerText = format(rmd);
            document.getElementById('s-fac').innerText = factor.toFixed(1);
            document.getElementById('s-pct').innerText = pct.toFixed(2) + "%";

            if(bal > 0) {
                let pRmd = (rmd / bal) * 100;
                let pRet = 100 - pRmd;

                document.getElementById('bar-ret').style.width = pRet + '%';
                document.getElementById('bar-rmd').style.width = pRmd + '%';
            }
        } catch(e) {}
    }
    
    ['bal','age'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-73').addEventListener('click', () => { document.getElementById('bal').value=500000; document.getElementById('age').value=73; calc(); });
    document.getElementById('qa-80').addEventListener('click', () => { document.getElementById('bal').value=750000; document.getElementById('age').value=80; calc(); });
    document.getElementById('qa-90').addEventListener('click', () => { document.getElementById('bal').value=300000; document.getElementById('age').value=90; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\rmd-calculator.blade.php ENDPATH**/ ?>