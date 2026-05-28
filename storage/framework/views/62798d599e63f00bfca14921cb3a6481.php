<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid mortgage-payoff-analyzer">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Payment Strategies</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-100" style="min-width: 280px; max-width: 100%;">Extra $100/mo</button>
                    <button class="qa-btn-component qa-success" id="qa-500" style="min-width: 280px; max-width: 100%;">Extra $500/mo (Aggressive)</button>
                    <button class="qa-btn-component qa-info" id="qa-bi" style="min-width: 280px; max-width: 100%;">Bi-Weekly Effect (≈ +8%)</button>
                    <button class="qa-btn-component qa-danger" id="qa-high" style="min-width: 280px; max-width: 100%;">High Rate Era (7%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-jumbo" style="min-width: 280px; max-width: 100%;">Jumbo Loan ($800k)</button>
                    <button class="qa-btn-component qa-dark" id="qa-zero" style="min-width: 280px; max-width: 100%;">Zero Extra (Base)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Current Mortgage Balance ($)</label>
                    <input type="number" id="bal" class="form-control-custom fw-bold fs-5 text-danger" value="350000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom">Interest Rate (APR %)</label>
                    <input type="number" id="apr" class="form-control-custom fw-bold" value="6.5" step="0.1">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Current Obligation vs Extra Ammo</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Standard Fixed Principal+Int ($/mo)</label>
                    <input type="number" id="pmt" class="form-control-custom text-primary" value="2300" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-success">
                    <label class="form-label-custom text-success fw-bold">Extra Principal Paid ($/mo)</label>
                    <input type="number" id="extra" class="form-control-custom fw-bold text-success" value="300" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Total Time Saved</span>
                <span id="mort-badge" class="status-badge badge-optimal">Huge Impact</span>
            </div>
            <h1 class="result-main-value fs-1" id="saved-time" style="color: #047857;">0 Years</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Interest Saved (Delta)</td><td class="text-end fw-bold text-success fs-6" id="s-int-saved">+$0</td></tr>
                    <tr><td>New Payoff Timeline</td><td class="text-end fw-semibold text-secondary" id="s-new-time">0 Years</td></tr>
                    <tr><td class="pt-2 border-top">Old Baseline Timeline</td><td class="text-end pt-2 border-top fw-semibold text-muted" id="s-old-time">0 Years</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">New Trajectory vs Baseline</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-new" class="enhanced-progress-segment" style="background:#10b981; width:70%;"></div>
                <div id="bar-saved" class="enhanced-progress-segment" style="background:#e2e8f0; width:30%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Years Paying</span>
                <span style="color:#64748b;font-weight:bold;">Years Shaved Off</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calcAmort(bal, rate, pmt) {
        if(bal <= 0 || pmt <= 0) return {mo:0, int:0};
        
        let m = 0; let i = 0; let b = bal;
        let sanity = 0;
        while(b > 0 && sanity < 1200) {
            sanity++;
            m++;
            let intChg = b * rate;
            i += intChg;
            let pOut = pmt - intChg;
            if(pOut <= 0) return {mo:1200, int:9999999, invalid: true}; // Doesn't cover interest
            b -= pOut;
        }
        return {mo: m, int: i, invalid: sanity>=1200};
    }

    function calc() {
        let bal = parseFloat(document.getElementById('bal').value)||0; 
        let apr = (parseFloat(document.getElementById('apr').value)||0) / 100 / 12;
        let pmt = parseFloat(document.getElementById('pmt').value)||0; 
        let extra = parseFloat(document.getElementById('extra').value)||0;

        let base = calcAmort(bal, apr, pmt);
        let accel = calcAmort(bal, apr, pmt + extra);

        let badge = document.getElementById('mort-badge');
        let color = '#047857';

        if(base.invalid) {
            badge.innerText = "BASE PMT TOO LOW"; badge.className = "status-badge badge-critical"; color='#ef4444';
            document.getElementById('saved-time').innerText = "ERROR";
            document.getElementById('saved-time').style.color = color;
            return;
        }

        let timeSavedMo = base.mo - accel.mo;
        let intSaved = base.int - accel.int;

        let yrsSaved = (timeSavedMo / 12).toFixed(1);

        if (extra === 0) { badge.innerText = "BASELINE"; badge.className = "status-badge badge-info"; color='#64748b'; }
        else if (timeSavedMo > 120) { badge.innerText = "DECADE SHAVED"; badge.className = "status-badge badge-optimal"; color='#10b981'; }
        else if (timeSavedMo > 60) { badge.innerText = "MASSIVE IMPACT"; badge.className = "status-badge badge-success"; color='#059669'; }
        else { badge.innerText = "SOLID PROGRESS"; badge.className = "status-badge badge-primary"; color='#2563eb'; }

        try {
            document.getElementById('saved-time').innerText = yrsSaved + " Yrs Saved";
            document.getElementById('saved-time').style.color = color;
            
            document.getElementById('s-int-saved').innerText = '+' + format(Math.max(0, intSaved));
            document.getElementById('s-new-time').innerText = (accel.mo/12).toFixed(1) + " Years (" + accel.mo +" mo)";
            document.getElementById('s-old-time').innerText = (base.mo/12).toFixed(1) + " Years";

            if(base.mo > 0) {
                let pNew = (accel.mo / base.mo) * 100;
                let pSav = 100 - pNew;
                document.getElementById('bar-new').style.width = pNew + '%';
                document.getElementById('bar-saved').style.width = pSav + '%';
            }
        } catch(e) {}
    }
    
    // Attempt auto-calc for PMT based on 30y term if balance/apr changes but pmt is unedited, but let user override.
    // For simplicity, just pure bindings
    ['bal','apr','pmt','extra'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-100').addEventListener('click', () => { document.getElementById('bal').value=300000;document.getElementById('apr').value=6.0;document.getElementById('pmt').value=1798; document.getElementById('extra').value=100; calc(); });
    document.getElementById('qa-500').addEventListener('click', () => { document.getElementById('bal').value=350000;document.getElementById('apr').value=6.5;document.getElementById('pmt').value=2212; document.getElementById('extra').value=500; calc(); });
    document.getElementById('qa-bi').addEventListener('click', () => { document.getElementById('bal').value=400000;document.getElementById('apr').value=5.5;  let p = 2271; document.getElementById('pmt').value=p; document.getElementById('extra').value=Math.round(p/12); calc(); });
    document.getElementById('qa-high').addEventListener('click', () => { document.getElementById('bal').value=450000;document.getElementById('apr').value=7.5;document.getElementById('pmt').value=3146; document.getElementById('extra').value=250; calc(); });
    document.getElementById('qa-jumbo').addEventListener('click', () => { document.getElementById('bal').value=800000;document.getElementById('apr').value=6.8;document.getElementById('pmt').value=5216; document.getElementById('extra').value=1000; calc(); });
    document.getElementById('qa-zero').addEventListener('click', () => { document.getElementById('extra').value=0; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mortgage-payoff-analyzer.blade.php ENDPATH**/ ?>