<div class="interactive-tool-grid diagonal-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Width (W)</label>
                <input type="number" id="diag-width" class="form-control-custom diag-in" placeholder="e.g. 5">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Length (L)</label>
                <input type="number" id="diag-length" class="form-control-custom diag-in" placeholder="e.g. 12">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> <strong>Formula:</strong> √(L² + W²)
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Diagonal Length</span>
            <div class="result-main-value" id="result-diagonal">0.00</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Area</span>
                    <span class="stat-value" id="stat-area">0</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Angle</span>
                    <span class="stat-value" id="stat-angle">0°</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Geometry Data
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const w = parseFloat(document.getElementById('diag-width').value) || 0;
        const l = parseFloat(document.getElementById('diag-length').value) || 0;

        if (w > 0 && l > 0) {
            const diag = Math.sqrt(w*w + l*l);
            const area = w * l;
            const angle = Math.atan(w/l) * (180/Math.PI);

            document.getElementById('result-diagonal').innerText = diag.toFixed(2);
            document.getElementById('stat-area').innerText = Math.round(area).toLocaleString();
            document.getElementById('stat-angle').innerText = Math.round(angle) + "°";
        } else {
            document.getElementById('result-diagonal').innerText = "0.00";
        }
    }

    document.querySelectorAll('.diag-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Rectangle Geometry:\nWidth: ${document.getElementById('diag-width').value}\nLength: ${document.getElementById('diag-length').value}\nDiagonal: ${document.getElementById('result-diagonal').innerText}\nCalculated via ToolsHub Math.`;
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

