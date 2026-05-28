<div class="interactive-tool-grid car-insurance-estimator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Actuary Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-good" style="min-width: 280px; max-width: 100%;">Good Driver (-15%)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-fault" style="min-width: 280px; max-width: 100%;">At-Fault (+40%)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-teen" style="min-width: 280px; max-width: 100%;">Teenager (+80%)</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-full" style="min-width: 280px; max-width: 100%;">Full Coverage</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-liab" style="min-width: 280px; max-width: 100%;">Liability Only</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-spt" style="min-width: 280px; max-width: 100%;">Sports Car Math</button>
                </div>
            </div>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Market Baseline Premium ($/Month)</label>
                <input type="number" id="base" class="form-control-custom" value="120" min="0">
            </div>
            
            <h5 class="text-secondary pt-2 border-bottom mb-3">Risk Multipliers</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Age Risk Modifier (%)</label>
                    <input type="number" id="r-age" class="form-control-custom text-danger fw-bold" value="0" step="5">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Driving Record Surcharge (%)</label>
                    <input type="number" id="r-rec" class="form-control-custom text-danger fw-bold" value="0" step="5">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Coverage Type Adjustment (%)</label>
                    <input type="number" id="r-cov" class="form-control-custom text-primary fw-bold" value="0" step="5">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Vehicle Type Modifier (%)</label>
                    <input type="number" id="r-veh" class="form-control-custom text-primary fw-bold" value="0" step="5">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #ef4444;">
            <span class="result-label">Estimated Monthly Premium</span>
            <h1 class="result-main-value" id="prem" style="color: #b91c1c;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Base Yearly Run Rate</td><td class="text-end fw-semibold text-secondary" id="yr-base">$0</td></tr>
                    <tr><td>Risk-Adjusted Annual Run Rate</td><td class="text-end fw-bold text-danger fs-5" id="yr-adj">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const base = parseFloat(document.getElementById('base').value) || 0;
        
        const rAge = (parseFloat(document.getElementById('r-age').value) || 0) / 100;
        const rRec = (parseFloat(document.getElementById('r-rec').value) || 0) / 100;
        const rCov = (parseFloat(document.getElementById('r-cov').value) || 0) / 100;
        const rVeh = (parseFloat(document.getElementById('r-veh').value) || 0) / 100;
        
        // Additive multipliers
        const totalMult = 1 + rAge + rRec + rCov + rVeh;
        const prem = base * Math.max(0.1, totalMult); // floor at 10% base
        
        try {
            document.getElementById('prem').innerText = format(prem);
            document.getElementById('yr-base').innerText = format(base * 12);
            document.getElementById('yr-adj').innerText = format(prem * 12);
        } catch(e) {}
    }
    
    ['base','r-age','r-rec','r-cov','r-veh'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-good').addEventListener('click', () => { document.getElementById('r-rec').value = -15; calc(); });
    document.getElementById('qa-fault').addEventListener('click', () => { document.getElementById('r-rec').value = 40; calc(); });
    document.getElementById('qa-teen').addEventListener('click', () => { document.getElementById('r-age').value = 80; calc(); });
    document.getElementById('qa-full').addEventListener('click', () => { document.getElementById('r-cov').value = 35; calc(); });
    document.getElementById('qa-liab').addEventListener('click', () => { document.getElementById('r-cov').value = -20; calc(); });
    document.getElementById('qa-spt').addEventListener('click', () => { document.getElementById('r-veh').value = 50; calc(); });
    
    calc();
});
</script>

