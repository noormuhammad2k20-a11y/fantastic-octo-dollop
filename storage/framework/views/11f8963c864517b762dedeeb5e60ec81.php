<div class="interactive-tool-grid bitumen-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Area to Cover (sq m)</label>
                <input type="number" id="area" class="form-control-custom" placeholder="e.g. 1000" min="0">
            </div>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Application Rate (kg/sq m)</label>
                <input type="number" id="rate" class="form-control-custom" value="1.2" step="0.1" min="0">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Bitumen Density (kg/m³)</label>
                <input type="number" id="density" class="form-control-custom" value="1030" min="0">
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Bitumen Needed (kg)</span>
            <div class="result-main-value" id="result-weight">0</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Liters</span>
                    <span class="stat-value" id="stat-liters">0</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Drums</span>
                    <span class="stat-value" id="stat-drums">0</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Data
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const area = parseFloat(document.getElementById('area').value) || 0;
        const rate = parseFloat(document.getElementById('rate').value) || 0;
        const dens = parseFloat(document.getElementById('density').value) || 1030;

        const weight = area * rate;
        const liters = weight / (dens / 1000);
        const drums = weight / 200; // 200kg per drum avg

        document.getElementById('result-weight').innerText = Math.round(weight).toLocaleString();
        document.getElementById('stat-liters').innerText = Math.round(liters).toLocaleString();
        document.getElementById('stat-drums').innerText = drums.toFixed(1);
    }

    ['area', 'rate', 'density'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Bitumen Estimation:\nWeight: ${document.getElementById('result-weight').innerText} kg\nVolume: ${document.getElementById('stat-liters').innerText} L\nDrums: ${document.getElementById('stat-drums').innerText}\nCalculated via ToolsHub Engineering.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bitumen-calculator.blade.php ENDPATH**/ ?>