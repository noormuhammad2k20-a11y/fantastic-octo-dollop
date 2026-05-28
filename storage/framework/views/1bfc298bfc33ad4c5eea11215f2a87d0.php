<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid it-asset-depreciation-pro">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Hardware Types</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-pc" style="min-width: 280px; max-width: 100%;">Workstation (3 Yr)</button>
                    <button class="qa-btn-component qa-success" id="qa-srv" style="min-width: 280px; max-width: 100%;">Rack Server (5 Yr)</button>
                    <button class="qa-btn-component qa-warning" id="qa-net" style="min-width: 280px; max-width: 100%;">Network Switch (7 Yr)</button>
                    <button class="qa-btn-component qa-danger" id="qa-mob" style="min-width: 280px; max-width: 100%;">Mobiles/Tablets (2 Yr)</button>
                    <button class="qa-btn-component qa-dark" id="qa-soft" style="min-width: 280px; max-width: 100%;">Zero Salvage Software</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Capital Cost ($)</label>
                    <input type="number" id="cost" class="form-control-custom fw-bold fs-5 text-primary" value="5000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom border-bottom pb-1 text-success">Salvage Value at EOL ($)</label>
                    <input type="number" id="salv" class="form-control-custom fw-bold fs-5 text-success" value="500" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Schedule Parameters</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-info">
                    <label class="form-label-custom text-info fw-bold">Useful Life (Years)</label>
                    <input type="number" id="life" class="form-control-custom fw-bold" value="3" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom text-danger fw-bold">DDB Multiplier</label>
                    <input type="number" id="ddb" class="form-control-custom fw-bold" value="2.0" step="0.5">
                    <small class="text-muted">2.0 is Double Declining</small>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #a855f7;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Year 1 Depreciation (DDB)</span>
                <span id="dep-badge" class="status-badge badge-optimal">Standard IT Life</span>
            </div>
            <h1 class="result-main-value fs-2" id="y1-dep" style="color: #7e22ce;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Depreciable Base</td><td class="text-end fw-semibold text-secondary" id="s-base">$0</td></tr>
                    <tr><td>Straight Line Annual Rate</td><td class="text-end fw-semibold text-primary" id="s-slm">$0 / yr</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Asset Vaporization (End of Yr 1, DDB)</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-book" class="enhanced-progress-segment" style="background:#10b981; width:50%;"></div>
                <div id="bar-dep" class="enhanced-progress-segment" style="background:#ef4444; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Retained Book Value</span>
                <span style="color:#ef4444;font-weight:bold;">Depreciated</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const cost = parseFloat(document.getElementById('cost').value)||0;
        const salv = parseFloat(document.getElementById('salv').value)||0;
        const life = parseFloat(document.getElementById('life').value)||1;
        const ddbMark = parseFloat(document.getElementById('ddb').value)||2.0;

        const base = cost - salv;
        const slm = life > 0 ? base / life : 0;
        
        let slmRate = life > 0 ? (1 / life) : 0;
        let ddbRate = slmRate * ddbMark;
        
        let y1Dep = cost * ddbRate;
        if(y1Dep > base) y1Dep = base; // Cannot depreciate past salvage

        let badge = document.getElementById('dep-badge');

        if (life <= 2) { badge.innerText = "RAPID OBSOLESCENCE"; badge.className = "status-badge badge-critical"; }
        else if (life >= 5) { badge.innerText = "LONG TERM INFRA"; badge.className = "status-badge badge-info"; }
        else { badge.innerText = "STANDARD IT LIFE"; badge.className = "status-badge badge-optimal"; }

        try {
            document.getElementById('y1-dep').innerText = format(y1Dep);
            
            document.getElementById('s-base').innerText = format(base);
            document.getElementById('s-slm').innerText = format(slm) + ' / yr';

            if(cost > 0) {
                let pDep = (y1Dep / cost) * 100;
                let pBook = 100 - pDep;

                document.getElementById('bar-book').style.width = pBook + '%';
                document.getElementById('bar-dep').style.width = pDep + '%';
            }
        } catch(e) {}
    }
    
    ['cost','salv','life','ddb'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-pc').addEventListener('click', () => { document.getElementById('cost').value=1500; document.getElementById('salv').value=150; document.getElementById('life').value=3; calc(); });
    document.getElementById('qa-srv').addEventListener('click', () => { document.getElementById('cost').value=12000; document.getElementById('salv').value=1000; document.getElementById('life').value=5; calc(); });
    document.getElementById('qa-net').addEventListener('click', () => { document.getElementById('cost').value=8000; document.getElementById('salv').value=0; document.getElementById('life').value=7; calc(); });
    document.getElementById('qa-mob').addEventListener('click', () => { document.getElementById('cost').value=1000; document.getElementById('salv').value=50; document.getElementById('life').value=2; calc(); });
    document.getElementById('qa-soft').addEventListener('click', () => { document.getElementById('cost').value=50000; document.getElementById('salv').value=0; document.getElementById('life').value=3; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\it-asset-depreciation-pro.blade.php ENDPATH**/ ?>