<div class="interactive-tool-grid claim-value-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Adjuster Presets (Multipliers)</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-secondary" id="qa-soft" style="min-width: 280px; max-width: 100%;">Soft Tissue (1.5x)</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-frac" style="min-width: 280px; max-width: 100%;">Fractures (3.0x)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-cata" style="min-width: 280px; max-width: 100%;">Catastrophic (5.0x)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-0prop" style="min-width: 280px; max-width: 100%;">Zero Prop Dmg</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-maxmed" style="min-width: 280px; max-width: 100%;">Extreme Med Bills</button>
                    <button class="btn btn-sm btn-outline-success" id="qa-pure" style="min-width: 280px; max-width: 100%;">Pure Economic Only</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Total Medical Bills ($)</label>
                    <input type="number" id="med" class="form-control-custom special-val" value="12000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Future Expected Medical ($)</label>
                    <input type="number" id="fut-med" class="form-control-custom special-val" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Lost Income/Wages ($)</label>
                    <input type="number" id="wage" class="form-control-custom special-val" value="3000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Property Damage Estimate ($)</label>
                    <input type="number" id="prop" class="form-control-custom special-val" value="8500" min="0">
                </div>
            </div>
            
            <div class="form-group-custom mt-2 border-top pt-3">
                <label class="form-label-custom text-danger fw-bold">General Damages Multiplier (Pain/Suffering)</label>
                <input type="range" id="mult" class="form-range" min="1" max="10" value="2" step="0.5">
                <div class="text-center text-danger fw-bold" id="mult-disp">2.0x</div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f59e0b;">
            <span class="result-label">Target Settlement Range</span>
            <h1 class="result-main-value" id="tot-claim" style="color: #d97706;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Special (Economic) Damages</td><td class="text-end fw-semibold text-secondary" id="sum-special">$0</td></tr>
                    <tr><td>General (Pain) Damages</td><td class="text-end fw-bold text-success" id="sum-general">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        let special = 0;
        document.querySelectorAll('.special-val').forEach(el => special += (parseFloat(el.value)||0));
        
        let medValue = (parseFloat(document.getElementById('med').value) || 0) + (parseFloat(document.getElementById('fut-med').value) || 0);
        
        const mult = parseFloat(document.getElementById('mult').value) || 1;
        document.getElementById('mult-disp').innerText = mult.toFixed(1) + 'x';
        
        // Generally, Pain and Suffering multiplies MEDICAL costs, not property or wages
        const general = medValue * mult;
        
        const target = special + general;
        
        try {
            document.getElementById('tot-claim').innerText = format(target);
            document.getElementById('sum-special').innerText = format(special);
            document.getElementById('sum-general').innerText = format(general);
        } catch(e) {}
    }
    
    document.querySelectorAll('.special-val').forEach(inp => inp.addEventListener('input', calc));
    document.getElementById('mult').addEventListener('input', calc);
    
    // Quick Actions
    document.getElementById('qa-soft').addEventListener('click', () => { document.getElementById('mult').value = 1.5; calc(); });
    document.getElementById('qa-frac').addEventListener('click', () => { document.getElementById('mult').value = 3.0; calc(); });
    document.getElementById('qa-cata').addEventListener('click', () => { document.getElementById('mult').value = 5.0; calc(); });
    document.getElementById('qa-0prop').addEventListener('click', () => { document.getElementById('prop').value = 0; calc(); });
    document.getElementById('qa-maxmed').addEventListener('click', () => { 
        document.getElementById('med').value = 150000; 
        document.getElementById('fut-med').value = 50000;
        calc(); 
    });
    document.getElementById('qa-pure').addEventListener('click', () => { document.getElementById('mult').value = 0; calc(); });
    
    calc();
});
</script>

