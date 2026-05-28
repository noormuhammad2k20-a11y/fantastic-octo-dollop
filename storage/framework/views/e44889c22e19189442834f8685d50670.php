<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid refinance-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Refi Moves</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">1% Rate Drop (Standard)</button>
                    <button class="qa-btn-component qa-success" id="qa-good" style="min-width: 280px; max-width: 100%;">2% Rate Drop (Great)</button>
                    <button class="qa-btn-component qa-warning" id="qa-low" style="min-width: 280px; max-width: 100%;">0.5% Drop (Marginal)</button>
                    <button class="qa-btn-component qa-danger" id="qa-bad" style="min-width: 280px; max-width: 100%;">High Closing Costs</button>
                    <button class="qa-btn-component qa-info" id="qa-auto" style="min-width: 280px; max-width: 100%;">Auto Refi (No Fees)</button>
                </div>
            </div>

            <div class="row">
                <h5 class="col-12 text-secondary mb-2">Current Loan</h5>
                <div class="col-md-6 form-group-custom mb-3 border-start border-3 border-secondary">
                    <label class="form-label-custom">Current Principal Balance ($)</label>
                    <input type="number" id="bal" class="form-control-custom fw-bold fs-5 text-dark" value="250000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Current Interest Rate (APR %)</label>
                    <input type="number" id="c-apr" class="form-control-custom text-danger" value="7.5" step="0.1">
                </div>
                <!-- Need original P&I -->
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom">Current Monthly P&I Payment ($)</label>
                    <input type="number" id="pmt" class="form-control-custom" value="1750" min="1">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Proposed New Loan</h5>
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2 border-start border-3 border-info">
                    <label class="form-label-custom text-success fw-bold">New Rate (%)</label>
                    <input type="number" id="n-apr" class="form-control-custom fw-bold text-success" value="5.5" step="0.1">
                </div>
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">New Term (Yrs)</label>
                    <input type="number" id="term" class="form-control-custom" value="30" min="1">
                </div>
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Closing Costs ($)</label>
                    <input type="number" id="fees" class="form-control-custom" value="4500" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Break-Even Horizon</span>
                <span id="refi-badge" class="status-badge badge-optimal">Great Move</span>
            </div>
            <h1 class="result-main-value fs-1" id="be" style="color: #0284c7;">0 Months</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Monthly Payment Savings</td><td class="text-end fw-bold text-success fs-6" id="s-save">+$0/mo</td></tr>
                    <tr><td>New Expected Payment (P&I)</td><td class="text-end fw-semibold text-primary" id="s-npmt">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Monthly Cost Shift</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-new" class="enhanced-progress-segment" style="background:#0ea5e9; width:80%;"></div>
                <div id="bar-save" class="enhanced-progress-segment" style="background:#10b981; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#0ea5e9;font-weight:bold;">New P&I</span>
                <span style="color:#10b981;font-weight:bold;">Savings</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }
    
    function calc() {
        const bal = parseFloat(document.getElementById('bal').value)||0;
        const cApr = parseFloat(document.getElementById('c-apr').value)||0;
        const pmt = parseFloat(document.getElementById('pmt').value)||0;
        
        const nApr = (parseFloat(document.getElementById('n-apr').value)||0) / 100 / 12;
        const term = (parseFloat(document.getElementById('term').value)||0) * 12; // Months
        const fees = parseFloat(document.getElementById('fees').value)||0;

        let nPmt = 0;
        if(bal > 0 && term > 0) {
            if(nApr === 0) {
                nPmt = bal / term;
            } else {
                nPmt = bal * (nApr * Math.pow(1 + nApr, term)) / (Math.pow(1 + nApr, term) - 1);
            }
        }

        let moSave = pmt - nPmt;
        
        let breakEvenMo = 0;
        let isBad = false;
        if (moSave <= 0) {
            isBad = true;
        } else {
            breakEvenMo = fees / moSave;
        }

        let badge = document.getElementById('refi-badge');
        let color = '#0284c7';

        if(isBad) {
            badge.innerText = "PAYMENT INCREASES"; badge.className = "status-badge badge-critical"; color='#ef4444';
        } else if (breakEvenMo > 60) {
            badge.innerText = "LONG BREAK-EVEN (>5y)"; badge.className = "status-badge badge-danger";
        } else if (breakEvenMo > 36) {
            badge.innerText = "MODERATE HORIZON"; badge.className = "status-badge badge-warning";
        } else if (breakEvenMo > 0) {
            badge.innerText = "FAST PAYBACK"; badge.className = "status-badge badge-optimal";
        } else {
            badge.innerText = "INSTANT WIN (No Fees)"; badge.className = "status-badge badge-info";
        }

        try {
            if (isBad) {
                document.getElementById('be').innerText = "Never";
                document.getElementById('be').style.color = '#ef4444';
                document.getElementById('s-save').innerText = 'Loss ' + format(Math.abs(moSave)) + '/mo';
                document.getElementById('s-save').style.color = '#ef4444';
                document.getElementById('bar-new').style.width = '100%';
                document.getElementById('bar-save').style.width = '0%';
                document.getElementById('bar-new').style.background = '#ef4444';
            } else {
                let yrStr = (breakEvenMo/12) >= 1 ? (breakEvenMo/12).toFixed(1) + " Years" : Math.ceil(breakEvenMo) + " Months";
                if(fees === 0) yrStr = "Immediate";
                
                document.getElementById('be').innerText = yrStr;
                document.getElementById('be').style.color = color;
                document.getElementById('s-save').innerText = '+' + format(moSave) + '/mo';
                document.getElementById('s-save').style.color = '#10b981';

                if(pmt > 0) {
                    let pSave = (moSave / pmt) * 100;
                    let pNew = 100 - pSave;
                    document.getElementById('bar-new').style.width = pNew + '%';
                    document.getElementById('bar-save').style.width = pSave + '%';
                    document.getElementById('bar-new').style.background = '#0ea5e9';
                }
            }
            
            document.getElementById('s-npmt').innerText = format(nPmt);
            
        } catch(e) {}
    }
    
    ['bal','c-apr','pmt','n-apr','term','fees'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('bal').value=300000; document.getElementById('c-apr').value=7.5; document.getElementById('pmt').value=2097; document.getElementById('n-apr').value=6.5; document.getElementById('term').value=30; document.getElementById('fees').value=4500; calc(); });
    document.getElementById('qa-good').addEventListener('click', () => { document.getElementById('bal').value=300000; document.getElementById('c-apr').value=7.5; document.getElementById('pmt').value=2097; document.getElementById('n-apr').value=5.5; document.getElementById('term').value=30; document.getElementById('fees').value=5000; calc(); });
    document.getElementById('qa-low').addEventListener('click', () => { document.getElementById('bal').value=300000; document.getElementById('c-apr').value=6.5; document.getElementById('pmt').value=1896; document.getElementById('n-apr').value=6.0; document.getElementById('term').value=30; document.getElementById('fees').value=4000; calc(); });
    document.getElementById('qa-bad').addEventListener('click', () => { document.getElementById('bal').value=300000; document.getElementById('c-apr').value=7.5; document.getElementById('pmt').value=2097; document.getElementById('n-apr').value=6.5; document.getElementById('term').value=30; document.getElementById('fees').value=12000; calc(); });
    document.getElementById('qa-auto').addEventListener('click', () => { document.getElementById('bal').value=25000; document.getElementById('c-apr').value=12.5; document.getElementById('pmt').value=562; document.getElementById('n-apr').value=6.5; document.getElementById('term').value=5; document.getElementById('fees').value=0; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\refinance-calculator.blade.php ENDPATH**/ ?>