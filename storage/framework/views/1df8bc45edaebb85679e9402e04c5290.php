<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid vat-gst-pro">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Global Tax Rates</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-uk" style="min-width: 280px; max-width: 100%;">UK VAT (20%)</button>
                    <button class="qa-btn-component qa-success" id="qa-aus" style="min-width: 280px; max-width: 100%;">Aus/NZ GST (10%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-eu" style="min-width: 280px; max-width: 100%;">EU Standard (21%)</button>
                    <button class="qa-btn-component qa-danger" id="qa-ind" style="min-width: 280px; max-width: 100%;">India GST (18%)</button>
                    <button class="qa-btn-component qa-info" id="qa-sg" style="min-width: 280px; max-width: 100%;">Singapore GST (9%)</button>
                    <button class="qa-btn-component qa-dark" id="qa-zero" style="min-width: 280px; max-width: 100%;">Zero Rated (0%)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Base Amount ($ / £ / €)</label>
                    <input type="number" id="amt" class="form-control-custom fw-bold fs-5 text-primary" value="1000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom border-bottom pb-1 text-danger">Tax Rate (%)</label>
                    <input type="number" id="rate" class="form-control-custom fw-bold fs-5 text-danger" value="20" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Calculation Mode</h5>
            <div class="row">
                <div class="col-md-12 form-group-custom mb-2">
                    <div class="btn-group w-100 shadow-sm" role="group">
                        <input type="radio" class="btn-check" name="vatmode" id="addmode" value="add" checked>
                        <label class="btn btn-outline-success fw-bold py-2" for="addmode">Add VAT (Exclusive Base)</label>

                        <input type="radio" class="btn-check" name="vatmode" id="remmode" value="rem">
                        <label class="btn btn-outline-warning fw-bold py-2" for="remmode">Extract VAT (Inclusive Base)</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label" id="res-lbl">Final Gross Amount</span>
                <span id="vat-badge" class="status-badge badge-optimal">Standard Rate</span>
            </div>
            <h1 class="result-main-value fs-1" id="res-val" style="color: #047857;">1,200.00</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Net Amount (Pre-Tax)</td><td class="text-end fw-semibold text-secondary" id="s-net">1,000.00</td></tr>
                    <tr><td>Tax Amount (VAT/GST)</td><td class="text-end fw-bold text-danger fs-6" id="s-tax">200.00</td></tr>
                    <tr><td class="pt-2 border-top">Gross Amount (Post-Tax)</td><td class="text-end pt-2 border-top fw-bold text-success fs-5" id="s-gross">1,200.00</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Price Composition</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-net" class="enhanced-progress-segment" style="background:#10b981; width:83.3%;"></div>
                <div id="bar-tax" class="enhanced-progress-segment" style="background:#ef4444; width:16.7%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Net Base</span>
                <span style="color:#ef4444;font-weight:bold;">Tax Remittance</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2}); }
    
    function calc() {
        const amt = parseFloat(document.getElementById('amt').value)||0;
        const rate = parseFloat(document.getElementById('rate').value)||0;
        const mode = document.querySelector('input[name="vatmode"]:checked').value;

        let net = 0;
        let tax = 0;
        let gross = 0;

        if (mode === 'add') {
            net = amt;
            tax = amt * (rate / 100);
            gross = net + tax;
            document.getElementById('res-lbl').innerText = "Final Gross Amount";
            document.getElementById('res-val').innerText = format(gross);
        } else {
            gross = amt;
            net = gross / (1 + (rate / 100));
            tax = gross - net;
            document.getElementById('res-lbl').innerText = "Extracted Net Amount";
            document.getElementById('res-val').innerText = format(net);
        }

        let badge = document.getElementById('vat-badge');
        let badgeColor = '#047857';

        if (rate === 0) { badge.innerText = "ZERO RATED"; badge.className = "status-badge badge-primary"; }
        else if (rate < 10) { badge.innerText = "LOW RATE"; badge.className = "status-badge badge-info"; }
        else if (rate > 22) { badge.innerText = "HIGH TAX REGIME"; badge.className = "status-badge badge-danger"; badgeColor='#ef4444'; }
        else { badge.innerText = "STANDARD RATE"; badge.className = "status-badge badge-optimal"; }

        try {
            document.getElementById('res-val').style.color = badgeColor;
            
            document.getElementById('s-net').innerText = format(net);
            document.getElementById('s-tax').innerText = format(tax);
            document.getElementById('s-gross').innerText = format(gross);

            if(gross > 0) {
                let pNet = (net / gross) * 100;
                let pTax = (tax / gross) * 100;

                document.getElementById('bar-net').style.width = pNet + '%';
                document.getElementById('bar-tax').style.width = pTax + '%';
            } else {
                document.getElementById('bar-net').style.width = '100%';
                document.getElementById('bar-tax').style.width = '0%';
            }
        } catch(e) {}
    }
    
    ['amt','rate'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    document.querySelectorAll('input[name="vatmode"]').forEach(el => el.addEventListener('change', calc));

    document.getElementById('qa-uk').addEventListener('click', () => { document.getElementById('rate').value=20; calc(); });
    document.getElementById('qa-aus').addEventListener('click', () => { document.getElementById('rate').value=10; calc(); });
    document.getElementById('qa-eu').addEventListener('click', () => { document.getElementById('rate').value=21; calc(); });
    document.getElementById('qa-ind').addEventListener('click', () => { document.getElementById('rate').value=18; calc(); });
    document.getElementById('qa-sg').addEventListener('click', () => { document.getElementById('rate').value=9; calc(); });
    document.getElementById('qa-zero').addEventListener('click', () => { document.getElementById('rate').value=0; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\vat-gst-pro.blade.php ENDPATH**/ ?>