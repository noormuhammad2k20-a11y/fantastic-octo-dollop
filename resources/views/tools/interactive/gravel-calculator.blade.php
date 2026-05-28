<div class="interactive-tool-grid gravel-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Total Area (sq ft)</label>
                <input type="number" id="gravel-area" class="form-control-custom gravel-in" value="500">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Depth (inches)</label>
                <input type="number" id="gravel-depth" class="form-control-custom gravel-in" value="3">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Typically, 1 cubic yard covers ~100 sq ft at 3" depth.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Cubic Yards Needed</span>
            <div class="result-main-value" id="result-cy">4.6</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Estimated Tons</span>
                    <span class="stat-value" id="stat-tons">6.5</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Truck Loads</span>
                    <span class="stat-value" id="stat-loads">1</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Material List
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const area = parseFloat(document.getElementById('gravel-area').value) || 0;
        const depth = parseFloat(document.getElementById('gravel-depth').value) || 0;

        if (area > 0 && depth > 0) {
            const cy = (area * (depth / 12)) / 27;
            const tons = cy * 1.4; // Avg weight factor for gravel

            document.getElementById('result-cy').innerText = cy.toFixed(1);
            document.getElementById('stat-tons').innerText = tons.toFixed(1);
            document.getElementById('stat-loads').innerText = Math.ceil(cy / 10);
        } else {
            document.getElementById('result-cy').innerText = "0.0";
        }
    }

    document.querySelectorAll('.gravel-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Gravel Estimate:\nArea: ${document.getElementById('gravel-area').value} sq ft\nVolume: ${document.getElementById('result-cy').innerText} cubic yards\nWeight: ${document.getElementById('stat-tons').innerText} tons\nCalculated via ToolsHub.`;
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

