@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid car-loan-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Purchase Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-used" style="min-width: 280px; max-width: 100%;">Used Sedan ($15k)</button>
                    <button class="qa-btn-component qa-success" id="qa-promo" style="min-width: 280px; max-width: 100%;">Promo Rate (0.9%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-long" style="min-width: 280px; max-width: 100%;">72-Mo Trap (SUV)</button>
                    <button class="qa-btn-component qa-danger" id="qa-bad" style="min-width: 280px; max-width: 100%;">Bad Credit (18%)</button>
                    <button class="qa-btn-component qa-info" id="qa-lux" style="min-width: 280px; max-width: 100%;">Luxury Lease Base ($60k)</button>
                    <button class="qa-btn-component qa-dark" id="qa-cash" style="min-width: 280px; max-width: 100%;">Large Trade-in</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Total Vehicle Price / OTD ($)</label>
                    <input type="number" id="price" class="form-control-custom fw-bold fs-5 text-primary" value="35000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-success">Down Payment + Trade-in ($)</label>
                    <input type="number" id="down" class="form-control-custom fw-bold" value="5000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Financing Terms</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-warning">Interest Rate (APR %)</label>
                    <input type="number" id="apr" class="form-control-custom" value="7.5" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-primary">Loan Term (Months)</label>
                    <select id="term" class="form-select border-0 shadow-none px-0 fw-bold" style="background:transparent; height:38px;">
                        <option value="36">36 Months (3 Yrs)</option>
                        <option value="48">48 Months (4 Yrs)</option>
                        <option value="60" selected>60 Months (5 Yrs)</option>
                        <option value="72">72 Months (6 Yrs - Danger)</option>
                        <option value="84">84 Months (7 Yrs - Trap)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f59e0b;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Monthly Car Payment</span>
                <span id="car-badge" class="status-badge badge-warning">Average</span>
            </div>
            <h1 class="result-main-value fs-1" id="pmt" style="color: #d97706;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Financed Amount</td><td class="text-end fw-semibold text-secondary" id="s-fin">$0</td></tr>
                    <tr><td>Total Interest Paid over Life</td><td class="text-end fw-bold text-danger fs-6" id="s-int">$0</td></tr>
                    <tr><td class="pt-2 border-top">True Out-of-Pocket Vehicle Cost</td><td class="text-end pt-2 border-top fw-bold text-dark fs-6" id="s-out">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Vehicle Cost Premium (Interest)</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-base" class="enhanced-progress-segment" style="background:#64748b; width:80%;"></div>
                <div id="bar-int" class="enhanced-progress-segment" style="background:#ef4444; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#64748b;font-weight:bold;">Original Car Price</span>
                <span style="color:#ef4444;font-weight:bold;">Interest Siphon</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }

    function calc() {
        let price = parseFloat(document.getElementById('price').value)||0; 
        let down = parseFloat(document.getElementById('down').value)||0; 
        let apr = (parseFloat(document.getElementById('apr').value)||0) / 100 / 12;
        let term = parseInt(document.getElementById('term').value)||60; 

        let financed = price - down;
        if(financed < 0) financed = 0;

        let pmt = 0;
        let totalRepaid = 0;
        let totalInt = 0;

        if (financed > 0) {
            if(apr === 0) {
                pmt = financed / term;
                totalInt = 0;
            } else {
                pmt = financed * (apr * Math.pow(1 + apr, term)) / (Math.pow(1 + apr, term) - 1);
                totalRepaid = pmt * term;
                totalInt = totalRepaid - financed;
            }
        }

        let trueCost = price + totalInt; // The physical price + the financing tax

        let badge = document.getElementById('car-badge');
        let color = '#d97706';

        if(apr*12 > 0.15) { badge.innerText = "PREDATORY RATE"; badge.className = "status-badge badge-critical"; color='#ef4444'; }
        else if (term > 60) { badge.innerText = "DEPRECIATION RISK"; badge.className = "status-badge badge-danger"; }
        else if (apr*12 < 0.02) { badge.innerText = "CHEAP MONEY"; badge.className = "status-badge badge-optimal"; color='#10b981'; } 
        else if (pmt > 700) { badge.innerText = "HIGH PAYMENT"; badge.className = "status-badge badge-warning"; }
        else { badge.innerText = "STANDARD LOAN"; badge.className = "status-badge badge-info"; color='#0ea5e9'; }

        try {
            document.getElementById('pmt').innerText = format(pmt);
            document.getElementById('pmt').style.color = color;
            
            document.getElementById('s-fin').innerText = format(financed);
            document.getElementById('s-int').innerText = '+' + format(totalInt);
            document.getElementById('s-out').innerText = format(trueCost);

            if(trueCost > 0) {
                let pBase = (price / trueCost) * 100;
                let pInt = 100 - pBase;
                document.getElementById('bar-base').style.width = pBase + '%';
                document.getElementById('bar-int').style.width = pInt + '%';
            }
        } catch(e) {}
    }
    
    ['price','down','apr','term'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-used').addEventListener('click', () => { document.getElementById('price').value=15000; document.getElementById('down').value=2000; document.getElementById('apr').value=9.5; document.getElementById('term').value=48; calc(); });
    document.getElementById('qa-promo').addEventListener('click', () => { document.getElementById('price').value=32000; document.getElementById('down').value=4000; document.getElementById('apr').value=0.9; document.getElementById('term').value=36; calc(); });
    document.getElementById('qa-long').addEventListener('click', () => { document.getElementById('price').value=45000; document.getElementById('down').value=5000; document.getElementById('apr').value=7.5; document.getElementById('term').value=72; calc(); });
    document.getElementById('qa-bad').addEventListener('click', () => { document.getElementById('price').value=18000; document.getElementById('down').value=1000; document.getElementById('apr').value=18.0; document.getElementById('term').value=60; calc(); });
    document.getElementById('qa-lux').addEventListener('click', () => { document.getElementById('price').value=65000; document.getElementById('down').value=10000; document.getElementById('apr').value=5.9; document.getElementById('term').value=60; calc(); });
    document.getElementById('qa-cash').addEventListener('click', () => { document.getElementById('price').value=35000; document.getElementById('down').value=20000; document.getElementById('apr').value=8.0; document.getElementById('term').value=48; calc(); });

    calc();
});
</script>

