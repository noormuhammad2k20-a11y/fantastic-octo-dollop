<div class="interactive-tool-grid drywall-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Total Wall/Ceiling Area (sq ft)</label>
                <input type="number" id="drywall-area" class="form-control-custom dw-input" placeholder="e.g. 500">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Sheet Size</label>
                <select id="sheet-size" class="form-control-custom dw-input">
                    <option value="32">4' x 8' (32 sq ft)</option>
                    <option value="48">4' x 12' (48 sq ft)</option>
                </select>
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Includes 10% waste factor in the estimate.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Drywall Sheets Needed</span>
            <div class="result-main-value" id="result-sheets">0</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Joint Compound</span>
                    <span class="stat-value" id="stat-mud">0 lbs</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Screws</span>
                    <span class="stat-value" id="stat-screws">0 cnt</span>
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
        const area = parseFloat(document.getElementById('drywall-area').value) || 0;
        const size = parseFloat(document.getElementById('sheet-size').value) || 32;

        if (area > 0) {
            const waste = 1.1;
            const sheets = Math.ceil((area / size) * waste);
            const mud = Math.ceil(area * 0.05); // Rough estim: 0.05 lbs per sqft
            const screws = sheets * 32; // ~32 screws per 4x8 sheet

            document.getElementById('result-sheets').innerText = sheets;
            document.getElementById('stat-mud').innerText = mud + " lbs";
            document.getElementById('stat-screws').innerText = screws;
        } else {
            document.getElementById('result-sheets').innerText = "0";
        }
    }

    document.querySelectorAll('.dw-input').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Drywall Material Estimate:\nArea: ${document.getElementById('drywall-area').value} sq ft\nSheets: ${document.getElementById('result-sheets').innerText}\nJoint Compound: ${document.getElementById('stat-mud').innerText}\nScrews: ${document.getElementById('stat-screws').innerText}\nCalculated via ToolsHub Construction.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\drywall-calculator.blade.php ENDPATH**/ ?>