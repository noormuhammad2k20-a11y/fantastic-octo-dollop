<div class="interactive-tool-grid insurance-coverage-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Dwelling Archetypes</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard Home</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-apt" style="min-width: 280px; max-width: 100%;">Apartment Renter</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-man" style="min-width: 280px; max-width: 100%;">Mansion / Luxury</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-coA" style="min-width: 280px; max-width: 100%;">Coastal/Hurricane</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-hili" style="min-width: 280px; max-width: 100%;">High Net-Worth Liab</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-min" style="min-width: 280px; max-width: 100%;">Minimum Policy</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Home Size (Square Feet)</label>
                    <input type="number" id="sqft" class="form-control-custom" value="2000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Local Rebuild Cost per SqFt ($)</label>
                    <input type="number" id="cost-sqft" class="form-control-custom" value="150" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-3 pb-2 border-bottom mb-2">Asset Add-ons</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Personal Property Est. ($)</label>
                    <input type="number" id="prop" class="form-control-custom" value="50000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Jewelry/Art Riders ($)</label>
                    <input type="number" id="ride" class="form-control-custom" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Emergency Living Fund ($)</label>
                    <input type="number" id="emerg" class="form-control-custom" value="20000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Liability Coverage ($)</label>
                    <select id="liab" class="form-spec-select w-100 p-2 border rounded">
                        <option value="100000">100k Standard</option>
                        <option value="300000" selected>300k Recommended</option>
                        <option value="500000">500k High Asset</option>
                        <option value="1000000">1M Umbrella</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #8b5cf6;">
            <span class="result-label">Recommended Total Coverage Limit</span>
            <h1 class="result-main-value" id="tot-lim" style="color: #6d28d9;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Dwelling Rebuild Coverage</td><td class="text-end fw-semibold text-primary" id="s-dwell">$0</td></tr>
                    <tr><td>Personal Goods Coverage</td><td class="text-end fw-semibold text-success" id="s-goods">$0</td></tr>
                    <tr><td class="pt-2 border-top">Required Liability Blanket</td><td class="text-end pt-2 border-top fw-bold text-danger" id="s-liab">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const sqft = parseFloat(document.getElementById('sqft').value) || 0;
        const cost = parseFloat(document.getElementById('cost-sqft').value) || 0;
        
        const prop = parseFloat(document.getElementById('prop').value) || 0;
        const ride = parseFloat(document.getElementById('ride').value) || 0;
        const emerg = parseFloat(document.getElementById('emerg').value) || 0;
        const liab = parseFloat(document.getElementById('liab').value) || 0;
        
        const dwell = sqft * cost;
        const goods = prop + ride;
        
        // total recommended limit to ask agent for
        const total = dwell + goods + emerg + liab;
        
        try {
            document.getElementById('tot-lim').innerText = format(total);
            document.getElementById('s-dwell').innerText = format(dwell);
            document.getElementById('s-goods').innerText = format(goods);
            document.getElementById('s-liab').innerText = format(liab);
        } catch(e) {}
    }
    
    ['sqft','cost-sqft','prop','ride','emerg','liab'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-std').addEventListener('click', () => { 
        document.getElementById('sqft').value=2000; document.getElementById('cost-sqft').value=150; document.getElementById('prop').value=50000; document.getElementById('liab').value=300000; calc(); 
    });
    document.getElementById('qa-apt').addEventListener('click', () => { 
        document.getElementById('sqft').value=0; document.getElementById('cost-sqft').value=0; document.getElementById('prop').value=30000; document.getElementById('liab').value=100000; calc(); 
    });
    document.getElementById('qa-man').addEventListener('click', () => { 
        document.getElementById('sqft').value=6000; document.getElementById('cost-sqft').value=350; document.getElementById('prop').value=250000; document.getElementById('liab').value=1000000; calc(); 
    });
    document.getElementById('qa-coA').addEventListener('click', () => { 
        document.getElementById('cost-sqft').value=250; document.getElementById('emerg').value=50000; calc(); 
    });
    document.getElementById('qa-hili').addEventListener('click', () => { document.getElementById('liab').value=1000000; calc(); });
    document.getElementById('qa-min').addEventListener('click', () => { document.getElementById('prop').value=10000; document.getElementById('liab').value=100000; calc(); });
    
    calc();
});
</script>

