<div class="interactive-tool-grid asphalt-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom">Length (ft)</label>
                    <input type="number" id="length" class="form-control-custom" placeholder="e.g. 50" step="0.1" min="0">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label-custom">Width (ft)</label>
                    <input type="number" id="width" class="form-control-custom" placeholder="e.g. 20" step="0.1" min="0">
                </div>
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Thickness (inches)</label>
                <input type="number" id="thickness" class="form-control-custom" placeholder="e.g. 2" step="0.1" min="0">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> <strong>Estimates:</strong> Based on standard asphalt density (approx. 145 lbs/ft³).
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Asphalt Needed (Tons)</span>
            <div class="result-main-value" id="result-tons">0.00</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Cubic Yards</span>
                    <span class="stat-value" id="stat-yards">0.00</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Area (sq ft)</span>
                    <span class="stat-value" id="stat-area">0.00</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Estimate
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const lengthInput = document.getElementById('length');
    const widthInput = document.getElementById('width');
    const thicknessInput = document.getElementById('thickness');
    const resultTons = document.getElementById('result-tons');
    const statYards = document.getElementById('stat-yards');
    const statArea = document.getElementById('stat-area');

    function calculateAsphalt() {
        const l = parseFloat(lengthInput.value) || 0;
        const w = parseFloat(widthInput.value) || 0;
        const t = parseFloat(thicknessInput.value) || 0;

        const area = l * w;
        const cubicFeet = area * (t / 12);
        const cubicYards = cubicFeet / 27;
        
        // Density of asphalt is approx 145 lbs per cubic foot
        // Ton = 2000 lbs
        const tons = (cubicFeet * 145) / 2000;

        resultTons.innerText = tons.toFixed(2);
        statYards.innerText = cubicYards.toFixed(2);
        statArea.innerText = area.toFixed(2);
    }

    [lengthInput, widthInput, thicknessInput].forEach(el => {
        el.addEventListener('input', calculateAsphalt);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Asphalt Paving Estimate:\nArea: ${statArea.innerText} sq ft\nVolume: ${statYards.innerText} cubic yards\nWeight: ${resultTons.innerText} Tons\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\asphalt-calculator.blade.php ENDPATH**/ ?>