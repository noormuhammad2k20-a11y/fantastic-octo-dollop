@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid property-roi-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Asset Classes</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-sfr" style="min-width: 280px; max-width: 100%;">C-Class SFR (10%)</button>
                    <button class="qa-btn-component qa-success" id="qa-amul" style="min-width: 280px; max-width: 100%;">A-Class Multi (5%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-str" style="min-width: 280px; max-width: 100%;">Airbnb / STR (High Rev)</button>
                    <button class="qa-btn-component qa-danger" id="qa-fail" style="min-width: 280px; max-width: 100%;">Negative Cashflow</button>
                    <button class="qa-btn-component qa-info" id="qa-com" style="min-width: 280px; max-width: 100%;">Commercial Retail</button>
                    <button class="qa-btn-component qa-dark" id="qa-cash" style="min-width: 280px; max-width: 100%;">All Cash Purchase</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Purchase Price ($)</label>
                    <input type="number" id="price" class="form-control-custom fw-bold fs-5 text-primary" value="250000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom">Down Payment ($) <small class="text-muted">(Cash invested)</small></label>
                    <input type="number" id="down" class="form-control-custom fw-bold text-success" value="50000" min="1">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Annual Operations</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-success">
                    <label class="form-label-custom text-success fw-bold">Gross Annual Rent ($)</label>
                    <input type="number" id="rent" class="form-control-custom" value="30000" min="0">
                </div>
                <!-- Standard rule: Operating expenses exclude mortgage debt service -->
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom">Annual Operating Expenses ($) <br><small class="text-muted">(PropTax, Ins, Maint, PM. No Mortgage)</small></label>
                    <input type="number" id="opex" class="form-control-custom" value="12000" min="0">
                </div>
                <div class="col-md-12 form-group-custom mb-2 mt-2 pt-2 border-top border-3 border-danger">
                    <label class="form-label-custom text-danger fw-bold">Annual Mortgage Debt Service (P&I) ($)</label>
                    <input type="number" id="ds" class="form-control-custom" value="14000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Capitalization Rate (Cap Rate)</span>
                <span id="roi-badge" class="status-badge badge-optimal">Strong Yield</span>
            </div>
            <h1 class="result-main-value fs-1" id="cap" style="color: #047857;">0%</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Net Operating Income (NOI)</td><td class="text-end fw-semibold text-secondary" id="s-noi">$0</td></tr>
                    <tr><td>Annual Cash Flow (After Debt)</td><td class="text-end fw-semibold text-dark" id="s-cf">$0</td></tr>
                    <tr><td class="pt-2 border-top">Cash on Cash Return</td><td class="text-end pt-2 border-top fw-bold text-success fs-5" id="s-coc">0%</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Gross Income Allocation</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-opex" class="enhanced-progress-segment" style="background:#f59e0b; width:40%;"></div>
                <div id="bar-ds" class="enhanced-progress-segment" style="background:#ef4444; width:40%;"></div>
                <div id="bar-cf" class="enhanced-progress-segment" style="background:#10b981; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#f59e0b;font-weight:bold;">Opex</span>
                <span style="color:#ef4444;font-weight:bold;">Debt</span>
                <span style="color:#10b981;font-weight:bold;">Cashflow</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const price = parseFloat(document.getElementById('price').value)||1;
        const down = parseFloat(document.getElementById('down').value)||1;
        const rent = parseFloat(document.getElementById('rent').value)||0;
        const opex = parseFloat(document.getElementById('opex').value)||0;
        const ds = parseFloat(document.getElementById('ds').value)||0;

        const noi = rent - opex;
        const cap = (noi / price) * 100;
        
        const cf = noi - ds;
        const coc = (cf / down) * 100;

        let badge = document.getElementById('roi-badge');
        let color = '#047857';

        if (cf < 0) { badge.innerText = "BLEEDING CASH"; badge.className = "status-badge badge-critical"; color='#ef4444'; }
        else if (cap < 4) { badge.innerText = "LOW YIELD (APPRECIATION PLAY?)"; badge.className = "status-badge badge-warning"; color='#f59e0b'; }
        else if (cap > 8) { badge.innerText = "HIGH YIELD (C-CLASS?)"; badge.className = "status-badge badge-info"; color='#0ea5e9'; }
        else { badge.innerText = "SOLID CORE ASSET"; badge.className = "status-badge badge-optimal"; color='#10b981'; }

        try {
            document.getElementById('cap').innerText = cap.toFixed(2) + '%';
            document.getElementById('cap').style.color = color;
            
            document.getElementById('s-noi').innerText = format(noi);
            
            let cfObj = document.getElementById('s-cf');
            cfObj.innerText = (cf<0?'-':'') + format(Math.abs(cf));
            cfObj.style.color = cf<0 ? '#ef4444' : '#1e293b';

            let cocObj = document.getElementById('s-coc');
            cocObj.innerText = coc.toFixed(2) + '%';
            cocObj.style.color = coc<0 ? '#ef4444' : '#10b981';

            if(rent > 0) {
                let pOpex = (opex / rent) * 100;
                let pDs = (ds / rent) * 100;
                let pCf = (Math.max(0, cf) / rent) * 100;

                // Adjust if negative CF
                if(pOpex + pDs > 100) {
                    let scale = 100 / (pOpex + pDs);
                    pOpex *= scale;
                    pDs *= scale;
                    pCf = 0;
                }

                document.getElementById('bar-opex').style.width = pOpex + '%';
                document.getElementById('bar-ds').style.width = pDs + '%';
                document.getElementById('bar-cf').style.width = pCf + '%';
            }
        } catch(e) {}
    }
    
    ['price','down','rent','opex','ds'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-sfr').addEventListener('click', () => { document.getElementById('price').value=150000; document.getElementById('down').value=30000; document.getElementById('rent').value=21000; document.getElementById('opex').value=6000; document.getElementById('ds').value=9500; calc(); });
    document.getElementById('qa-amul').addEventListener('click', () => { document.getElementById('price').value=1000000; document.getElementById('down').value=250000; document.getElementById('rent').value=80000; document.getElementById('opex').value=30000; document.getElementById('ds').value=45000; calc(); });
    document.getElementById('qa-str').addEventListener('click', () => { document.getElementById('price').value=450000; document.getElementById('down').value=90000; document.getElementById('rent').value=75000; document.getElementById('opex').value=35000; document.getElementById('ds').value=28000; calc(); });
    document.getElementById('qa-fail').addEventListener('click', () => { document.getElementById('price').value=600000; document.getElementById('down').value=120000; document.getElementById('rent').value=36000; document.getElementById('opex').value=15000; document.getElementById('ds').value=38000; calc(); });
    document.getElementById('qa-com').addEventListener('click', () => { document.getElementById('price').value=2000000; document.getElementById('down').value=600000; document.getElementById('rent').value=180000; document.getElementById('opex').value=40000; document.getElementById('ds').value=100000; calc(); });
    document.getElementById('qa-cash').addEventListener('click', () => { document.getElementById('price').value=350000; document.getElementById('down').value=350000; document.getElementById('rent').value=30000; document.getElementById('opex').value=10000; document.getElementById('ds').value=0; calc(); });

    calc();
});
</script>

