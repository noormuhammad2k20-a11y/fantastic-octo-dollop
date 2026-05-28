<div class="interactive-tool-grid vehicle-depreciation-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Vehicle Archtype Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-toy" style="min-width: 280px; max-width: 100%;">Toyota/Honda (-10%)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-lux" style="min-width: 280px; max-width: 100%;">Luxury Sedan (-20%)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-ev" style="min-width: 280px; max-width: 100%;">Rapid EV Loss (-25%)</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-y1" style="min-width: 280px; max-width: 100%;">Year 1 Cliff Peak</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-10y" style="min-width: 280px; max-width: 100%;">10-Year Horizon</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-used" style="min-width: 280px; max-width: 100%;">Used Base</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Initial Purchase Price ($)</label>
                    <input type="number" id="price" class="form-control-custom" value="35000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Years Owned Projection</label>
                    <input type="number" id="yrs" class="form-control-custom" value="5" min="1" max="30">
                </div>
            </div>
            
            <div class="form-group-custom mt-2 border-top pt-3 mb-2">
                <label class="form-label-custom text-danger fw-bold">First Year Depreciation Off Lot (%)</label>
                <input type="range" id="y1-rate" class="form-range" min="5" max="40" value="20" step="1">
                <div class="text-center text-danger fw-bold" id="y1-disp">20% Off Lot</div>
            </div>
            <div class="form-group-custom mb-3">
                <label class="form-label-custom text-warning fw-bold">Annual Ongoing Depreciation (%)</label>
                <input type="range" id="on-rate" class="form-range" min="1" max="30" value="15" step="1">
                <div class="text-center text-warning fw-bold" id="on-disp">15% Annually</div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f59e0b;">
            <span class="result-label">Residual Value at <span id="r-yr">5</span> Years</span>
            <h1 class="result-main-value" id="val" style="color: #d97706;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Value Lost to Depreciation</td><td class="text-end fw-semibold text-danger" id="lost">$0</td></tr>
                    <tr><td>Value Retained</td><td class="text-end fw-bold text-success" id="ret-pct">0%</td></tr>
                </table>
            </div>
            
            <div class="progress-custom mt-4 d-flex" style="height:12px; border-radius:6px; overflow:hidden;">
                <div id="bar-ret" style="background:#10b981; width:50%;"></div>
                <div id="bar-lost" style="background:#ef4444; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.75rem;">
                <span style="color:#10b981;font-weight:bold;">Retained</span>
                <span style="color:#ef4444;font-weight:bold;">Lost</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const price = parseFloat(document.getElementById('price').value) || 0;
        const yrs = parseInt(document.getElementById('yrs').value) || 1;
        
        const y1Drop = parseInt(document.getElementById('y1-rate').value) || 0;
        const onDrop = parseInt(document.getElementById('on-rate').value) || 0;
        
        document.getElementById('y1-disp').innerText = y1Drop + '% Off Lot';
        document.getElementById('on-disp').innerText = onDrop + '% Annually after Year 1';
        document.getElementById('r-yr').innerText = yrs;
        
        let cv = price;
        if(yrs >= 1) cv = cv * (1 - (y1Drop/100));
        if(yrs > 1) {
            for(let i=1; i<yrs; i++){
                cv = cv * (1 - (onDrop/100));
            }
        }
        
        const lost = price - cv;
        const retPct = price > 0 ? (cv/price)*100 : 0;
        const lostPct = 100 - retPct;
        
        try {
            document.getElementById('val').innerText = format(cv);
            document.getElementById('lost').innerText = '-' + format(lost);
            document.getElementById('ret-pct').innerText = retPct.toFixed(1) + '%';
            
            document.getElementById('bar-ret').style.width = retPct + '%';
            document.getElementById('bar-lost').style.width = lostPct + '%';
        } catch(e) {}
    }
    
    ['price','yrs','y1-rate','on-rate'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    document.getElementById('qa-toy').addEventListener('click', () => { document.getElementById('y1-rate').value = 15; document.getElementById('on-rate').value = 10; calc(); });
    document.getElementById('qa-lux').addEventListener('click', () => { document.getElementById('y1-rate').value = 25; document.getElementById('on-rate').value = 20; calc(); });
    document.getElementById('qa-ev').addEventListener('click', () => { document.getElementById('y1-rate').value = 35; document.getElementById('on-rate').value = 25; calc(); });
    document.getElementById('qa-y1').addEventListener('click', () => { document.getElementById('yrs').value = 1; calc(); });
    document.getElementById('qa-10y').addEventListener('click', () => { document.getElementById('yrs').value = 10; calc(); });
    document.getElementById('qa-used').addEventListener('click', () => { document.getElementById('y1-rate').value = 0; document.getElementById('on-rate').value = 12; calc(); });
    
    calc();
});
</script>

