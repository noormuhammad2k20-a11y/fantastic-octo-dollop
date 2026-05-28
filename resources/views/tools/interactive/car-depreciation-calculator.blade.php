@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid car-depreciation-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Vehicle Classes</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard Honda/Toyota</button>
                    <button class="qa-btn-component qa-success" id="qa-truck" style="min-width: 280px; max-width: 100%;">Full-Size Truck (Holds Value)</button>
                    <button class="qa-btn-component qa-danger" id="qa-lux" style="min-width: 280px; max-width: 100%;">Luxury Sedan (High Drop)</button>
                    <button class="qa-btn-component qa-warning" id="qa-ev" style="min-width: 280px; max-width: 100%;">Standard EV (Steep Drop)</button>
                    <button class="qa-btn-component qa-info" id="qa-suv" style="min-width: 280px; max-width: 100%;">Midsize SUV</button>
                    <button class="qa-btn-component qa-dark" id="qa-classic" style="min-width: 280px; max-width: 100%;">Collectible (Flat)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Current Vehicle Value (MSRP/Paid) ($)</label>
                    <input type="number" id="price" class="form-control-custom fw-bold fs-5 text-primary" value="40000" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-danger">Year 1 Drop (%) <small class="text-muted">(Drives off lot)</small></label>
                    <input type="number" id="y1" class="form-control-custom fw-bold text-danger" value="20" step="1">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-warning">Annual Drop After Year 1 (%)</label>
                    <input type="number" id="y2" class="form-control-custom fw-bold text-warning" value="15" step="1">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Forecast Horizon</h5>
            <div class="row">
                <div class="col-md-12 form-group-custom mb-2">
                    <label class="form-label-custom">Years to Forecast</label>
                    <input type="range" id="yrs-slider" class="form-range" min="1" max="10" value="5">
                    <div class="text-center text-muted fw-bold"><span id="yrs-disp">5</span> Years Out</div>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #ef4444;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Residual Value (Year <span id="r-yr">5</span>)</span>
                <span id="dep-badge" class="status-badge badge-warning">Massive Loss</span>
            </div>
            <h1 class="result-main-value fs-1" id="res" style="color: #b91c1c;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Value Lost (Delta)</td><td class="text-end fw-semibold text-danger" id="s-loss">-$0</td></tr>
                    <tr><td>Value Retained (%)</td><td class="text-end fw-bold text-secondary fs-6" id="s-ret">0%</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Asset Vaporization</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-res" class="enhanced-progress-segment" style="background:#10b981; width:50%;"></div>
                <div id="bar-loss" class="enhanced-progress-segment" style="background:#ef4444; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Retained</span>
                <span style="color:#ef4444;font-weight:bold;">Evaporated Wealth</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const price = parseFloat(document.getElementById('price').value)||0;
        const y1 = (parseFloat(document.getElementById('y1').value)||0)/100;
        const y2 = (parseFloat(document.getElementById('y2').value)||0)/100;
        const yrs = parseInt(document.getElementById('yrs-slider').value)||1;

        document.getElementById('yrs-disp').innerText = yrs;
        document.getElementById('r-yr').innerText = yrs;

        let val = price;
        if(yrs >= 1) {
            val = val * (1 - y1);
        }
        if(yrs > 1) {
            val = val * Math.pow(1 - y2, yrs - 1);
        }

        const loss = price - val;
        const retPct = price > 0 ? (val / price) * 100 : 0;

        let badge = document.getElementById('dep-badge');
        let color = '#b91c1c';

        if (retPct < 30) { badge.innerText = "WEALTH DESTROYER"; badge.className = "status-badge badge-critical"; }
        else if (retPct < 50) { badge.innerText = "HEAVY DROP"; badge.className = "status-badge badge-warning"; }
        else if (retPct < 70) { badge.innerText = "MODERATE LOSS"; badge.className = "status-badge badge-info"; color='#0ea5e9'; }
        else { badge.innerText = "HOLDS VALUE WELL"; badge.className = "status-badge badge-optimal"; color='#047857'; }

        try {
            document.getElementById('res').innerText = format(val);
            document.getElementById('res').style.color = color;
            
            document.getElementById('s-loss').innerText = '-' + format(loss);
            document.getElementById('s-ret').innerText = retPct.toFixed(1) + '%';

            if(price > 0) {
                document.getElementById('bar-res').style.width = retPct + '%';
                document.getElementById('bar-loss').style.width = (100 - retPct) + '%';
            }
        } catch(e) {}
    }
    
    ['price','y1','y2','yrs-slider'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('y1').value=15; document.getElementById('y2').value=12; calc(); });
    document.getElementById('qa-truck').addEventListener('click', () => { document.getElementById('y1').value=12; document.getElementById('y2').value=8; calc(); });
    document.getElementById('qa-lux').addEventListener('click', () => { document.getElementById('y1').value=25; document.getElementById('y2').value=18; calc(); });
    document.getElementById('qa-ev').addEventListener('click', () => { document.getElementById('y1').value=22; document.getElementById('y2').value=16; calc(); });
    document.getElementById('qa-suv').addEventListener('click', () => { document.getElementById('y1').value=18; document.getElementById('y2').value=14; calc(); });
    document.getElementById('qa-classic').addEventListener('click', () => { document.getElementById('y1').value=0; document.getElementById('y2').value=0; calc(); });

    calc();
});
</script>

