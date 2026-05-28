<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid lease-vs-buy-analyzer">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Vehicle Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard SUV ($35k)</button>
                    <button class="qa-btn-component qa-success" id="qa-lux" style="min-width: 280px; max-width: 100%;">Luxury Sedan ($55k)</button>
                    <button class="qa-btn-component qa-warning" id="qa-bad" style="min-width: 280px; max-width: 100%;">Bad Lease Deal</button>
                    <button class="qa-btn-component qa-info" id="qa-ev" style="min-width: 280px; max-width: 100%;">EV Credit Lease</button>
                    <button class="qa-btn-component qa-danger" id="qa-high" style="min-width: 280px; max-width: 100%;">High Interest Buy (9%)</button>
                    <button class="qa-btn-component qa-dark" id="qa-promo" style="min-width: 280px; max-width: 100%;">Promo Finance (0.9%)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom border-bottom pb-1">Negotiated Price ($)</label>
                    <input type="number" id="price" class="form-control-custom fw-bold fs-5 text-primary" value="35000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom border-bottom pb-1">Est. Resale Value in 3 Yrs ($)</label>
                    <input type="number" id="resale" class="form-control-custom fw-bold fs-5 text-success" value="21000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">If Buying (60 mo loan)</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Down Payment ($)</label>
                    <input type="number" id="b-down" class="form-control-custom" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-primary">
                    <label class="form-label-custom text-primary fw-bold">Loan Interest (APR %)</label>
                    <input type="number" id="b-apr" class="form-control-custom" value="5.5" step="0.1">
                </div>
            </div>

            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">If Leasing (36 mo term)</h5>
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom">Due at Signing ($)</label>
                    <input type="number" id="l-up" class="form-control-custom" value="3500" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom">Monthly Payment ($)</label>
                    <input type="number" id="l-mo" class="form-control-custom" value="450" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom">Disposition Fee ($)</label>
                    <input type="number" id="l-fee" class="form-control-custom" value="395" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Financial Winner (3 Yr Cost)</span>
                <span id="lb-badge" class="status-badge badge-optimal">Buy Wins</span>
            </div>
            <h1 class="result-main-value fs-2" id="winner" style="color: #047857;">Buying Saves $0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Cost to Lease (Sunk Cost)</td><td class="text-end fw-semibold text-danger" id="s-lease">$0</td></tr>
                    <tr><td>True Cost to Buy (Net Equity)</td><td class="text-end fw-semibold text-primary" id="s-buy">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Buy Cost Breakdown</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-dep" class="enhanced-progress-segment" style="background:#f59e0b; width:70%;"></div>
                <div id="bar-int" class="enhanced-progress-segment" style="background:#ef4444; width:30%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#f59e0b;font-weight:bold;">Depreciation Loss</span>
                <span style="color:#ef4444;font-weight:bold;">Interest Paid</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const price = parseFloat(document.getElementById('price').value)||0;
        const resale = parseFloat(document.getElementById('resale').value)||0;
        
        const bDown = parseFloat(document.getElementById('b-down').value)||0;
        const bApr = (parseFloat(document.getElementById('b-apr').value)||0)/100/12;
        
        const lUp = parseFloat(document.getElementById('l-up').value)||0;
        const lMo = parseFloat(document.getElementById('l-mo').value)||0;
        const lFee = parseFloat(document.getElementById('l-fee').value)||0;

        // Lease cost over 36 months
        const leaseCost = lUp + (lMo * 36) + lFee;

        // Buy cost over 36 months assuming 60 month loan
        let bFin = price - bDown;
        let bPmt = 0;
        if (bFin > 0 && bApr > 0) {
            bPmt = bFin * (bApr * Math.pow(1 + bApr, 60)) / (Math.pow(1 + bApr, 60) - 1);
        } else if (bFin > 0) {
            bPmt = bFin / 60;
        }
        
        let buyOutflows = bDown + (bPmt * 36);
        
        // Calculate remaining loan balance at month 36
        let bal36 = bFin;
        let intPaid36 = 0;
        for(let i=0; i<36; i++){
            let intC = bal36 * bApr;
            intPaid36 += intC;
            bal36 -= (bPmt - intC);
        }

        // Equity = Resale value - Remaining Balance
        let equity = resale - bal36;
        
        // True cost to buy = Outflows - Equity
        const buyCost = buyOutflows - equity;

        let diff = Math.abs(buyCost - leaseCost);
        let badge = document.getElementById('lb-badge');
        let color = '#047857';
        let winnerText = "";

        if (buyCost < leaseCost) {
            winnerText = "Buying Saves " + format(diff);
            badge.innerText = "BUYING IS BETTER"; badge.className = "status-badge badge-optimal"; color='#10b981';
        } else {
            winnerText = "Leasing Saves " + format(diff);
            badge.innerText = "LEASING IS BETTER"; badge.className = "status-badge badge-warning"; color='#f59e0b';
        }

        try {
            document.getElementById('winner').innerText = winnerText;
            document.getElementById('winner').style.color = color;
            
            document.getElementById('s-lease').innerText = format(leaseCost);
            document.getElementById('s-buy').innerText = format(buyCost);

            // Dep loss is price - resale. Int paid is intPaid36
            let depLoss = price - resale;
            if(depLoss < 0) depLoss = 0;
            let totLoss = depLoss + intPaid36;

            if(totLoss > 0) {
                let pDep = (depLoss / totLoss) * 100;
                let pInt = 100 - pDep;
                document.getElementById('bar-dep').style.width = pDep + '%';
                document.getElementById('bar-int').style.width = pInt + '%';
            }
        } catch(e) {}
    }
    
    ['price','resale','b-down','b-apr','l-up','l-mo','l-fee'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('price').value=35000; document.getElementById('resale').value=21000; document.getElementById('b-down').value=5000; document.getElementById('b-apr').value=5.5; document.getElementById('l-up').value=3500; document.getElementById('l-mo').value=450; calc(); });
    document.getElementById('qa-lux').addEventListener('click', () => { document.getElementById('price').value=55000; document.getElementById('resale').value=28000; document.getElementById('b-down').value=8000; document.getElementById('b-apr').value=6.0; document.getElementById('l-up').value=5000; document.getElementById('l-mo').value=750; calc(); });
    document.getElementById('qa-bad').addEventListener('click', () => { document.getElementById('price').value=30000; document.getElementById('resale').value=18000; document.getElementById('b-down').value=3000; document.getElementById('b-apr').value=6.5; document.getElementById('l-up').value=4500; document.getElementById('l-mo').value=550; calc(); });
    document.getElementById('qa-ev').addEventListener('click', () => { document.getElementById('price').value=45000; document.getElementById('resale').value=22000; document.getElementById('b-down').value=5000; document.getElementById('b-apr').value=5.9; document.getElementById('l-up').value=2000; document.getElementById('l-mo').value=399; calc(); });
    document.getElementById('qa-high').addEventListener('click', () => { document.getElementById('price').value=25000; document.getElementById('resale').value=15000; document.getElementById('b-down').value=2000; document.getElementById('b-apr').value=9.0; document.getElementById('l-up').value=3000; document.getElementById('l-mo').value=350; calc(); });
    document.getElementById('qa-promo').addEventListener('click', () => { document.getElementById('price').value=38000; document.getElementById('resale').value=23000; document.getElementById('b-down').value=4000; document.getElementById('b-apr').value=0.9; document.getElementById('l-up').value=3900; document.getElementById('l-mo').value=500; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\lease-vs-buy-analyzer.blade.php ENDPATH**/ ?>