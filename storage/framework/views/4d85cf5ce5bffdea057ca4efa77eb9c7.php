<div class="interactive-tool-grid attorney-fee-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Billing Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-primary" id="qa-c33" style="min-width: 280px; max-width: 100%;">Contingency (33%)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-c40" style="min-width: 280px; max-width: 100%;">Litigation C. (40%)</button>
                    <button class="btn btn-sm btn-outline-success" id="qa-hr250" style="min-width: 280px; max-width: 100%;">Base Hourly ($250)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-hr500" style="min-width: 280px; max-width: 100%;">Premium Hourly ($500)</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-flat" style="min-width: 280px; max-width: 100%;">Flat Fee Hybrid</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-nocost" style="min-width: 280px; max-width: 100%;">Zero Assorted Costs</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Total Expected Award/Payout ($)</label>
                    <input type="number" id="award" class="form-control-custom" value="100000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Misc Filing/Court Costs ($)</label>
                    <input type="number" id="costs" class="form-control-custom" value="1500" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary pt-2 border-bottom mb-3">Fee Model Structures</h5>
            
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom text-primary">Contingency (%)</label>
                    <input type="number" id="cont" class="form-control-custom" value="33.33" step="0.01">
                </div>
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom text-success">Hourly Rate ($)</label>
                    <input type="number" id="hr-rate" class="form-control-custom" value="300" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">Billed Hours</label>
                    <input type="number" id="hrs" class="form-control-custom" value="50" min="0">
                </div>
                <div class="col-12 form-group-custom mt-2">
                    <label class="form-label-custom text-secondary">Flat Fee Add-on / Retainer Sink ($)</label>
                    <input type="number" id="flat" class="form-control-custom" value="0" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <span class="result-label">Client Yield (Contingency Model)</span>
            <h1 class="result-main-value" id="net-cont" style="color: #0369a1;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Contingency Atty Cut</td><td class="text-end fw-semibold text-danger" id="cut-cont">-$0</td></tr>
                    <tr><td class="pt-2 border-top">Hourly Model Atty Cut</td><td class="text-end pt-2 border-top fw-semibold text-warning" id="cut-hr">-$0</td></tr>
                    <tr><td>Client Yield (Hourly Model)</td><td class="text-end fw-bold fs-6 text-success" id="net-hr">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const award = parseFloat(document.getElementById('award').value) || 0;
        const costs = parseFloat(document.getElementById('costs').value) || 0;
        const flat = parseFloat(document.getElementById('flat').value) || 0;
        
        const cPct = (parseFloat(document.getElementById('cont').value) || 0) / 100;
        const cCut = (award * cPct) + flat;
        const netCont = award - cCut - costs;
        
        const hRate = parseFloat(document.getElementById('hr-rate').value) || 0;
        const hrs = parseFloat(document.getElementById('hrs').value) || 0;
        const hCut = (hRate * hrs) + flat;
        const netHr = award - hCut - costs;
        
        try {
            document.getElementById('net-cont').innerText = netCont >= 0 ? format(netCont) : 'Negative';
            document.getElementById('cut-cont').innerText = '-' + format(cCut);
            
            document.getElementById('net-hr').innerText = netHr >= 0 ? format(netHr) : 'Negative';
            document.getElementById('cut-hr').innerText = '-' + format(hCut);
        } catch(e) {}
    }
    
    ['award','costs','cont','hr-rate','hrs','flat'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-c33').addEventListener('click', () => { document.getElementById('cont').value = 33.33; calc(); });
    document.getElementById('qa-c40').addEventListener('click', () => { document.getElementById('cont').value = 40.0; calc(); });
    document.getElementById('qa-hr250').addEventListener('click', () => { document.getElementById('hr-rate').value = 250; calc(); });
    document.getElementById('qa-hr500').addEventListener('click', () => { document.getElementById('hr-rate').value = 500; calc(); });
    document.getElementById('qa-flat').addEventListener('click', () => {
        document.getElementById('cont').value = 0; document.getElementById('hr-rate').value = 0; document.getElementById('flat').value = 15000; calc();
    });
    document.getElementById('qa-nocost').addEventListener('click', () => { document.getElementById('costs').value = 0; calc(); });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\attorney-fee-calculator.blade.php ENDPATH**/ ?>