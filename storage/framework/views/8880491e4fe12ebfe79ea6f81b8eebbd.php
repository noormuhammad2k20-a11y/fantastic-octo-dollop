<div class="row g-4 deg2rad-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4 align-items-center">
                    <div class="col-md-12">
                        <label class="form-label-custom">Degrees (°)</label>
                        <input type="number" id="deg-in" class="form-control form-control-lg fw-bold text-center" value="180">
                    </div>
                    <div class="col-md-12 text-center py-2">
                        <div class="badge bg-light text-muted p-2 rounded-circle"><i class="fas fa-exchange-alt fa-lg"></i></div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Radians (rad)</label>
                        <input type="number" id="rad-in" class="form-control form-control-lg fw-bold text-center" value="3.14159">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:170;--tool-color:#0d9488;--tool-bg:rgba(20,184,166,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Exact π Fraction</span>
                <div class="output-hero-value" id="out-pi">π rad</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-table me-2 text-primary"></i>Common Conversions</h6>
                <div class="table-responsive bg-white rounded-3 border">
                    <table class="table table-sm table-hover mb-0 text-center">
                        <thead class="bg-light">
                            <tr><th>Degrees</th><th>Radians</th><th>Exact</th></tr>
                        </thead>
                        <tbody>
                            <tr onclick="setDeg(30)"><td>30°</td><td>0.5236</td><td>π/6</td></tr>
                            <tr onclick="setDeg(45)"><td>45°</td><td>0.7854</td><td>π/4</td></tr>
                            <tr onclick="setDeg(90)"><td>90°</td><td>1.5708</td><td>π/2</td></tr>
                            <tr onclick="setDeg(180)"><td>180°</td><td>3.1416</td><td>π</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function setDeg(d) {
    document.getElementById('deg-in').value = d;
    document.getElementById('deg-in').dispatchEvent(new Event('input'));
}

document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function gcd(a, b) { return b ? gcd(b, a % b) : a; }

    function updateFromDeg() {
        const deg = parseFloat($('deg-in').value);
        if (isNaN(deg)) return;
        const rad = deg * (Math.PI / 180);
        $('rad-in').value = rad.toFixed(5);
        
        const common = gcd(Math.abs(deg), 180);
        const num = deg / common;
        const den = 180 / common;
        
        let piStr = '';
        if (num === 0) piStr = '0';
        else if (num === 1 && den === 1) piStr = 'π';
        else if (num === -1 && den === 1) piStr = '-π';
        else if (den === 1) piStr = `${num}π`;
        else piStr = `${num === 1 ? '' : (num === -1 ? '-' : num)}π / ${den}`;
        
        $('out-pi').innerHTML = piStr + ' rad';
    }

    function updateFromRad() {
        const rad = parseFloat($('rad-in').value);
        if (isNaN(rad)) return;
        const deg = rad * (180 / Math.PI);
        $('deg-in').value = deg.toFixed(2);
    }

    $('deg-in').addEventListener('input', updateFromDeg);
    $('rad-in').addEventListener('input', updateFromRad);
    
    updateFromDeg();
});
</script>

<style>
.deg2rad-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,.04); }
.deg2rad-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
.deg2rad-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.deg2rad-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.deg2rad-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.deg2rad-calc-rebuilt .form-label-custom { font-size: .8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.features-grid { grid-template-columns: 1fr !important; }
.features-grid > div { margin-bottom: 1rem; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\degree-to-radian-converter.blade.php ENDPATH**/ ?>