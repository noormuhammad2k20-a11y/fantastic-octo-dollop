@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid expense-ratio-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Business Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-saas" style="min-width: 280px; max-width: 100%;">SaaS (Low Opex)</button>
                    <button class="qa-btn-component qa-danger" id="qa-rest" style="min-width: 280px; max-width: 100%;">Restaurant (High Opex)</button>
                    <button class="qa-btn-component qa-success" id="qa-real" style="min-width: 280px; max-width: 100%;">Real Estate Rental</button>
                    <button class="qa-btn-component qa-warning" id="qa-agen" style="min-width: 280px; max-width: 100%;">Service Agency</button>
                    <button class="qa-btn-component qa-info" id="qa-ecom" style="min-width: 280px; max-width: 100%;">Retail / E-Com</button>
                    <button class="qa-btn-component qa-dark" id="qa-fail" style="min-width: 280px; max-width: 100%;">Bleeding Cash</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Gross Operating Income (Revenue)</label>
                    <input type="number" id="rev" class="form-control-custom fw-bold fs-5 text-success" value="100000" min="1">
                </div>
                
                <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Operating Expenses (OPEX)</h5>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Payroll / Labor Costs</label>
                    <input type="number" id="labor" class="form-control-custom" value="35000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Rent / Facilities</label>
                    <input type="number" id="rent" class="form-control-custom" value="12000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Marketing / Acquisition</label>
                    <input type="number" id="mkt" class="form-control-custom" value="8000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Other Admin / SaaS Costs</label>
                    <input type="number" id="admin" class="form-control-custom" value="5000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #ef4444;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Operating Expense Ratio</span>
                <span id="oer-badge" class="status-badge badge-warning">Average</span>
            </div>
            <h1 class="result-main-value fs-1" id="oer" style="color: #b91c1c;">0%</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total OPEX Total</td><td class="text-end fw-semibold text-danger" id="s-opex">$0</td></tr>
                    <tr><td>Net Operating Income (NOI)</td><td class="text-end fw-bold text-success fs-6" id="s-noi">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Revenue Allocation</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-opex" class="enhanced-progress-segment" style="background:#ef4444; width:60%;"></div>
                <div id="bar-noi" class="enhanced-progress-segment" style="background:#10b981; width:40%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#ef4444;font-weight:bold;">Consumed by OPEX</span>
                <span style="color:#10b981;font-weight:bold;">Profit / NOI</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }
    function calc() {
        const rev = parseFloat(document.getElementById('rev').value) || 1;
        const labor = parseFloat(document.getElementById('labor').value) || 0;
        const rent = parseFloat(document.getElementById('rent').value) || 0;
        const mkt = parseFloat(document.getElementById('mkt').value) || 0;
        const admin = parseFloat(document.getElementById('admin').value) || 0;

        const opex = labor + rent + mkt + admin;
        const noi = rev - opex;
        
        let ratio = (opex / rev) * 100;

        let badge = document.getElementById('oer-badge');
        if(ratio > 100) { badge.innerText = "UNSUSTAINABLE"; badge.className = "status-badge badge-critical"; }
        else if (ratio > 80) { badge.innerText = "HIGH LEVERAGE"; badge.className = "status-badge badge-warning"; }
        else if (ratio < 40) { badge.innerText = "HIGHLY EFFICIENT"; badge.className = "status-badge badge-optimal"; }
        else { badge.innerText = "AVERAGE"; badge.className = "status-badge badge-info"; }

        try {
            document.getElementById('oer').innerText = ratio.toFixed(1) + '%';
            document.getElementById('s-opex').innerText = format(opex);
            
            let noiObj = document.getElementById('s-noi');
            noiObj.innerText = (noi<0?'-':'') + format(Math.abs(noi));
            noiObj.style.color = noi<0 ? '#ef4444' : '#10b981';

            if(ratio > 100) ratio = 100;
            const noiPct = 100 - ratio;
            document.getElementById('bar-opex').style.width = ratio + '%';
            document.getElementById('bar-noi').style.width = noiPct + '%';
        } catch(e) {}
    }
    
    ['rev','labor','rent','mkt','admin'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-saas').addEventListener('click', () => { document.getElementById('rev').value=100000; document.getElementById('labor').value=20000; document.getElementById('rent').value=0; document.getElementById('mkt').value=15000; document.getElementById('admin').value=5000; calc(); });
    document.getElementById('qa-rest').addEventListener('click', () => { document.getElementById('rev').value=80000; document.getElementById('labor').value=30000; document.getElementById('rent').value=15000; document.getElementById('mkt').value=5000; document.getElementById('admin').value=20000; calc(); });
    document.getElementById('qa-real').addEventListener('click', () => { document.getElementById('rev').value=10000; document.getElementById('labor').value=500; document.getElementById('rent').value=1000; document.getElementById('mkt').value=200; document.getElementById('admin').value=2500; calc(); });
    document.getElementById('qa-agen').addEventListener('click', () => { document.getElementById('rev').value=50000; document.getElementById('labor').value=30000; document.getElementById('rent').value=2000; document.getElementById('mkt').value=2000; document.getElementById('admin').value=3000; calc(); });
    document.getElementById('qa-ecom').addEventListener('click', () => { document.getElementById('rev').value=150000; document.getElementById('labor').value=15000; document.getElementById('rent').value=5000; document.getElementById('mkt').value=45000; document.getElementById('admin').value=10000; calc(); });
    document.getElementById('qa-fail').addEventListener('click', () => { document.getElementById('rev').value=25000; document.getElementById('labor').value=20000; document.getElementById('rent').value=8000; document.getElementById('mkt').value=5000; document.getElementById('admin').value=3000; calc(); });

    calc();
});
</script>

