<div class="interactive-tool-grid property-value-estimator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Annual Gross Rental Income ($)</label>
                    <input type="number" id="inc" class="form-control-custom" value="120000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-danger">Annual Operating Exp ($)</label>
                    <input type="number" id="exp" class="form-control-custom" value="45000" min="0">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3 border-top pt-3">
                <h5 class="text-secondary mb-0">Market Variables</h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary" id="qa-up" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus"></i> Increase Rents 10%</button>
                    <button class="btn btn-sm btn-outline-danger ms-1" id="qa-cap" style="min-width: 280px; max-width: 100%;">Higher Risk (10% Cap)</button>
                </div>
            </div>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Market Capitalization Rate (Cap Rate %)</label>
                <div class="input-group">
                    <input type="number" id="cap" class="form-control-custom border-end-0" value="6.5" step="0.1" min="1" max="25">
                    <span class="input-group-text bg-white"><i class="fas fa-percent text-muted"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #2563eb;">
            <span class="result-label">Estimated Property Value</span>
            <h1 class="result-main-value" id="val" style="color: #1e40af;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Net Operating Income (NOI)</td><td class="text-end fw-bold text-success" id="noi">$0</td></tr>
                </table>
            </div>
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light text-muted" style="font-size:0.85rem;">
                Value is inversely related to cap rate. A lower cap rate implies lower risk and drives the property value higher.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const inc = parseFloat(document.getElementById('inc').value) || 0;
        const exp = parseFloat(document.getElementById('exp').value) || 0;
        const cap = parseFloat(document.getElementById('cap').value) || 1; // prevent div/0
        
        const noi = inc - exp;
        const value = noi > 0 ? noi / (cap / 100) : 0;
        
        try {
            document.getElementById('val').innerText = format(value);
            document.getElementById('noi').innerText = format(noi);
        } catch(e) {}
    }
    
    ['inc','exp','cap'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    document.getElementById('qa-up').addEventListener('click', () => { 
        document.getElementById('inc').value = Math.floor((parseFloat(document.getElementById('inc').value)||0) * 1.10); calc(); 
    });
    
    document.getElementById('qa-cap').addEventListener('click', () => { document.getElementById('cap').value = 10.0; calc(); });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\property-value-estimator.blade.php ENDPATH**/ ?>