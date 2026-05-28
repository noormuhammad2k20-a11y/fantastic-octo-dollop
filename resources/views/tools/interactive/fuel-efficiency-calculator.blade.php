<div class="interactive-tool-grid fuel-efficiency-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Vehicle & Geography Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-danger" id="qa-trk" style="min-width: 280px; max-width: 100%;">Heavy Truck</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-sed" style="min-width: 280px; max-width: 100%;">Standard Sedan</button>
                    <button class="btn btn-sm btn-outline-success" id="qa-hyb" style="min-width: 280px; max-width: 100%;">Hybrid</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-rdtrip" style="min-width: 280px; max-width: 100%;">Road Trip</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-cal" style="min-width: 280px; max-width: 100%;">Cali Gas Prices</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-tx" style="min-width: 280px; max-width: 100%;">TX Gas Prices</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Average MPG (Miles per Gallon)</label>
                    <input type="number" id="mpg" class="form-control-custom text-primary fw-bold" value="25" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Distance Driven (Monthly Miles)</label>
                    <input type="number" id="dist" class="form-control-custom" value="1200" min="0">
                </div>
                <div class="col-12 form-group-custom mb-2 border-top pt-3">
                    <label class="form-label-custom text-danger">Local Price per Gallon ($/gal)</label>
                    <input type="number" id="gas" class="form-control-custom" value="3.50" step="0.1" min="0.1">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #3b82f6;">
            <span class="result-label">Monthly Fuel Cost</span>
            <h1 class="result-main-value" id="cost" style="color: #1d4ed8;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Gallons Consumed</td><td class="text-end fw-semibold text-secondary" id="gals">0.0</td></tr>
                    <tr><td>Annual Fuel Burn Projection</td><td class="text-end fw-bold text-danger" id="ann-burn">$0</td></tr>
                </table>
            </div>
            
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light text-muted" style="font-size:0.85rem;" id="eco-msg">
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2}); }
    function calc() {
        const mpg = parseFloat(document.getElementById('mpg').value) || 1;
        const dist = parseFloat(document.getElementById('dist').value) || 0;
        const gas = parseFloat(document.getElementById('gas').value) || 0;
        
        const gals = dist / mpg;
        const costMo = gals * gas;
        const annBurn = costMo * 12;
        
        try {
            document.getElementById('cost').innerText = format(costMo);
            document.getElementById('gals').innerText = gals.toFixed(1) + ' gal';
            document.getElementById('ann-burn').innerText = format(annBurn);
            
            const msg = document.getElementById('eco-msg');
            if(mpg >= 40) msg.innerText = "Excellent Fuel Economy! You are shielded from pump volatility.";
            else if(mpg <= 18) msg.innerText = "Poor Economy. Fuel spikes will severely impact your budget.";
            else msg.innerText = "Average Fuel Economy.";
        } catch(e) {}
    }
    
    ['mpg','dist','gas'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-trk').addEventListener('click', () => { document.getElementById('mpg').value = 15; calc(); });
    document.getElementById('qa-sed').addEventListener('click', () => { document.getElementById('mpg').value = 30; calc(); });
    document.getElementById('qa-hyb').addEventListener('click', () => { document.getElementById('mpg').value = 50; calc(); });
    document.getElementById('qa-rdtrip').addEventListener('click', () => { document.getElementById('dist').value = 3000; calc(); });
    document.getElementById('qa-cal').addEventListener('click', () => { document.getElementById('gas').value = 5.30; calc(); });
    document.getElementById('qa-tx').addEventListener('click', () => { document.getElementById('gas').value = 2.90; calc(); });
    
    calc();
});
</script>

