@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid shipping-insurance-pro">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Shipping Lanes</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard LCL (0.5%)</button>
                    <button class="qa-btn-component qa-success" id="qa-fcl" style="min-width: 280px; max-width: 100%;">Secure FCL (0.2%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-air" style="min-width: 280px; max-width: 100%;">Air Express (0.35%)</button>
                    <button class="qa-btn-component qa-danger" id="qa-high" style="min-width: 280px; max-width: 100%;">High Risk Route (2.5%)</button>
                    <button class="qa-btn-component qa-info" id="qa-mark" style="min-width: 280px; max-width: 100%;">110% Coverage</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Commercial Invoice Value ($)</label>
                    <input type="number" id="val" class="form-control-custom fw-bold fs-5 text-primary" value="50000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom border-bottom pb-1">Total Freight Cost ($)</label>
                    <input type="number" id="frt" class="form-control-custom fw-bold fs-5 text-secondary" value="2500" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Coverage Parameters</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-info">
                    <label class="form-label-custom text-info fw-bold">Insurance Rate (%)</label>
                    <input type="number" id="rate" class="form-control-custom fw-bold" value="0.5" step="0.01">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start border-3 border-warning">
                    <label class="form-label-custom text-warning fw-bold">Coverage Markup (%) <small class="text-muted">(Standard is 110%)</small></label>
                    <input type="number" id="mark" class="form-control-custom fw-bold" value="110" min="100">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #3b82f6;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Insurance Premium Due</span>
                <span id="ins-badge" class="status-badge badge-optimal">Standard Risk</span>
            </div>
            <h1 class="result-main-value fs-1" id="prem" style="color: #2563eb;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total CIF Value</td><td class="text-end fw-semibold text-secondary" id="s-cif">$0</td></tr>
                    <tr><td>Total Sum Insured (With Markup)</td><td class="text-end fw-bold text-success fs-6" id="s-sum">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Risk Premium Ratio</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-base" class="enhanced-progress-segment" style="background:#10b981; width:98%;"></div>
                <div id="bar-prem" class="enhanced-progress-segment" style="background:#f59e0b; width:2%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Cargo Value</span>
                <span style="color:#f59e0b;font-weight:bold;">Premium Cost</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2}); }
    
    function calc() {
        const val = parseFloat(document.getElementById('val').value)||0;
        const frt = parseFloat(document.getElementById('frt').value)||0;
        const rate = (parseFloat(document.getElementById('rate').value)||0)/100;
        const mark = (parseFloat(document.getElementById('mark').value)||100)/100;

        // Formula: Sum Insured = (Invoice + Freight) / (1 - (Rate * Markup)) * Markup -- strict CIF
        // Or simple CIF: Sum Insured = (Invoice + Freight) * Markup, Premium = Sum Insured * Rate. Let's use simple for standard users.
        const cif = val + frt;
        const sumInsured = cif * mark;
        const premium = sumInsured * rate;

        let badge = document.getElementById('ins-badge');
        let badgeColor = '#2563eb';

        if (rate > 0.02) { badge.innerText = "HIGH RISK PREMIUM"; badge.className = "status-badge badge-critical"; badgeColor='#ef4444'; }
        else if (rate > 0.01) { badge.innerText = "ELEVATED RISK"; badge.className = "status-badge badge-warning"; badgeColor='#f59e0b'; }
        else { badge.innerText = "STANDARD RISK"; badge.className = "status-badge badge-optimal"; }

        try {
            document.getElementById('prem').innerText = format(premium);
            document.getElementById('prem').style.color = badgeColor;
            
            document.getElementById('s-cif').innerText = format(cif);
            document.getElementById('s-sum').innerText = format(sumInsured);

            if(sumInsured > 0) {
                let pPrem = (premium / sumInsured) * 100;
                let pBase = 100 - pPrem;

                document.getElementById('bar-base').style.width = pBase + '%';
                document.getElementById('bar-prem').style.width = pPrem + '%';
            }
        } catch(e) {}
    }
    
    ['val','frt','rate','mark'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('rate').value=0.5; calc(); });
    document.getElementById('qa-fcl').addEventListener('click', () => { document.getElementById('rate').value=0.2; calc(); });
    document.getElementById('qa-air').addEventListener('click', () => { document.getElementById('rate').value=0.35; calc(); });
    document.getElementById('qa-high').addEventListener('click', () => { document.getElementById('rate').value=2.5; calc(); });
    document.getElementById('qa-mark').addEventListener('click', () => { document.getElementById('mark').value=110; calc(); });

    calc();
});
</script>

