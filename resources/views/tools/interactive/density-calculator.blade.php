<div class="interactive-tool-grid density-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Mass (kg or g)</label>
                <input type="number" id="mass" class="form-control-custom density-in" placeholder="e.g. 50">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Volume (m³ or L)</label>
                <input type="number" id="volume" class="form-control-custom density-in" placeholder="e.g. 10">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Result units depend on your input units (e.g., kg/m³).
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Calculated Density (p)</span>
            <div class="result-main-value" id="result-density">0.00</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Status</span>
                    <span class="stat-value" id="stat-status">Ready</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Ratio</span>
                    <span class="stat-value" id="stat-ratio">m/V</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Equation
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const m = parseFloat(document.getElementById('mass').value) || 0;
        const v = parseFloat(document.getElementById('volume').value) || 0;

        if (m > 0 && v > 0) {
            const den = m / v;
            document.getElementById('result-density').innerText = den.toFixed(3);
            document.getElementById('stat-status').innerText = "Solved";
            document.getElementById('stat-ratio').innerText = m.toFixed(1) + "/" + v.toFixed(1);
        } else {
            document.getElementById('result-density').innerText = "0.00";
            document.getElementById('stat-status').innerText = "Input Needed";
        }
    }

    document.querySelectorAll('.density-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Density Calculation:\nMass: ${document.getElementById('mass').value}\nVolume: ${document.getElementById('volume').value}\nDensity: ${document.getElementById('result-density').innerText}\nCalculated via ToolsHub Science.`;
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

