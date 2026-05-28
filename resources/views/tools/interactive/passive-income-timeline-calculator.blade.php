<div class="interactive-tool-grid passive-income-timeline-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Current Invested Capital ($)</label>
                    <input type="number" id="cap" class="form-control-custom" value="100000" min="0" step="1000">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Monthly Addition ($)</label>
                    <input type="number" id="add" class="form-control-custom" value="500" min="0">
                </div>
            </div>
            <div class="form-group-custom mb-3 border-top pt-3">
                <label class="form-label-custom text-primary">Years to Grow</label>
                <input type="range" id="yrs-rng" class="form-range" min="1" max="40" value="15" step="1">
                <div class="text-center fw-bold text-primary" id="yrs-val">15 Years</div>
            </div>
            <div class="row pt-2">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Portfolio Yield (%)</label>
                    <input type="number" id="yield" class="form-control-custom" value="4" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Asset Growth (%)</label>
                    <input type="number" id="growth" class="form-control-custom" value="6" step="0.1">
                </div>
            </div>
            <div class="alert bg-light mt-2 p-3 border-0 rounded text-muted" style="font-size:0.85rem;">
                * Yield generates passive income. Growth compound increases your base capital.
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f59e0b;">
            <span class="result-label">Monthly Passive Cash Flow</span>
            <h1 class="result-main-value" id="cash-flow" style="color: #d97706;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Future Portfolio Base</td><td class="text-end fw-semibold text-secondary" id="fv">$0</td></tr>
                    <tr><td>Annual Passive Income</td><td class="text-end fw-semibold text-success" id="ann-flow">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const cap = parseFloat(document.getElementById('cap').value) || 0;
        const add = parseFloat(document.getElementById('add').value) || 0;
        const yrs = parseInt(document.getElementById('yrs-rng').value) || 0;
        const yld = (parseFloat(document.getElementById('yield').value) || 0) / 100;
        const grw = (parseFloat(document.getElementById('growth').value) || 0) / 100;
        
        document.getElementById('yrs-val').innerText = yrs + ' Years';
        
        // Assume total return = growth + yield (reinvested during growth phase)
        const tr = grw + yld;
        const r = tr / 12;
        const m = yrs * 12;
        
        let fv = 0;
        if(r > 0) {
            fv = cap * Math.pow(1+r, m) + add * ((Math.pow(1+r, m) - 1) / r);
        } else {
            fv = cap + (add * m);
        }
        
        const annFlow = fv * yld;
        const moFlow = annFlow / 12;
        
        try {
            document.getElementById('cash-flow').innerText = format(moFlow);
            document.getElementById('ann-flow').innerText = format(annFlow);
            document.getElementById('fv').innerText = format(fv);
        } catch(e) {}
    }
    ['cap','add','yrs-rng','yield','growth'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    calc();
});
</script>
