<div class="interactive-tool-grid geometry-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Shape</label>
                <select id="shape-type" class="form-control-custom geom-in">
                    <option value="circle">Circle (Radius)</option>
                    <option value="sphere">Sphere (Radius)</option>
                    <option value="cube">Cube (Side)</option>
                </select>
            </div>

            <div class="form-group-custom mb-4">
                <label id="label-val" class="form-label-custom">Radius / Side Length</label>
                <input type="number" id="geom-val" class="form-control-custom geom-in" value="5">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Uses PI ≈ 3.14159 for circular calculations.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label" id="res-label">Calculating...</span>
            <div class="result-main-value" id="result-geom">0.00</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Metric 1</span>
                    <span class="stat-value" id="stat-1">--</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Metric 2</span>
                    <span class="stat-value" id="stat-2">--</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Analysis
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const type = document.getElementById('shape-type').value;
        const val = parseFloat(document.getElementById('geom-val').value) || 0;
        const pi = Math.PI;

        let main = 0, s1 = "", v1 = "", s2 = "", v2 = "", label = "";

        if (type === 'circle') {
            main = pi * val * val;
            label = "Area of Circle";
            s1 = "Circumference"; v1 = (2 * pi * val).toFixed(2);
            s2 = "Diameter"; v2 = (2 * val).toFixed(1);
        } else if (type === 'sphere') {
            main = (4/3) * pi * Math.pow(val, 3);
            label = "Volume of Sphere";
            s1 = "Surface Area"; v1 = (4 * pi * val * val).toFixed(2);
            s2 = "Diameter"; v2 = (2 * val).toFixed(1);
        } else {
            main = Math.pow(val, 3);
            label = "Volume of Cube";
            s1 = "Surface Area"; v1 = (6 * val * val).toFixed(1);
            s2 = "Diagonal"; v2 = (val * Math.sqrt(3)).toFixed(2);
        }

        document.getElementById('res-label').innerText = label;
        document.getElementById('result-geom').innerText = main.toLocaleString(undefined, {maximumFractionDigits: 2});
        document.getElementById('stat-1').previousElementSibling.innerText = s1;
        document.getElementById('stat-1').innerText = v1;
        document.getElementById('stat-2').previousElementSibling.innerText = s2;
        document.getElementById('stat-2').innerText = v2;
    }

    document.querySelectorAll('.geom-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Geometry Calculation:\n${document.getElementById('res-label').innerText}: ${document.getElementById('result-geom').innerText}\nCalculated via ToolsHub Math.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\geometry-calculator.blade.php ENDPATH**/ ?>