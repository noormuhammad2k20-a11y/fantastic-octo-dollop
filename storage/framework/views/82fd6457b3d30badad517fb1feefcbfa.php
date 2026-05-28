<div class="interactive-tool-grid paint-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Room Length (ft)</label>
                    <input type="number" class="form-control-custom" id="paint-length" value="12" min="1">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Room Width (ft)</label>
                    <input type="number" class="form-control-custom" id="paint-width" value="10" min="1">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Wall Height (ft)</label>
                    <input type="number" class="form-control-custom" id="paint-height" value="8" min="1">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Coats of Paint</label>
                    <select class="form-control-custom" id="paint-coats">
                        <option value="1">1 Coat</option>
                        <option value="2" selected>2 Coats (Recommended)</option>
                        <option value="3">3 Coats</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="p-3 border rounded bg-light">
                        <label class="form-label-custom mb-2">Deductions (Optional)</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="small text-muted">Doors Count</label>
                                <input type="number" class="form-control-custom" id="paint-doors" value="1" min="0">
                            </div>
                            <div class="col-6">
                                <label class="small text-muted">Windows Count</label>
                                <input type="number" class="form-control-custom" id="paint-windows" value="2" min="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Paint Required</span>
            <div class="result-main-value" id="paint-gallons">1.8</div>
            <span class="text-muted fw-bold">Gallons</span>
            
            <div class="result-sub-stats border-top pt-4">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Total Area</span>
                    <span class="stat-value" id="paint-area">352 sq ft</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">In Liters</span>
                    <span class="stat-value text-accent" id="paint-liters">6.8 L</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-paint" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['paint-length', 'paint-width', 'paint-height', 'paint-coats', 'paint-doors', 'paint-windows'];
    const els = {};
    inputs.forEach(id => els[id] = document.getElementById(id));

    function calculate() {
        const L = parseFloat(els['paint-length'].value) || 0;
        const W = parseFloat(els['paint-width'].value) || 0;
        const H = parseFloat(els['paint-height'].value) || 0;
        const coats = parseInt(els['paint-coats'].value);
        const doors = parseInt(els['paint-doors'].value) || 0;
        const windows = parseInt(els['paint-windows'].value) || 0;

        // Perimeter * Height = Wall Area
        let area = (2 * (L + W)) * H;
        
        // Subtract doors (approx 20 sqft each) and windows (approx 15 sqft each)
        area -= (doors * 20) + (windows * 15);
        area = Math.max(0, area);

        // Standard coverage: 1 gallon per 350-400 sqft. We use 350 for safety.
        const gallons = (area * coats) / 350;
        const liters = gallons * 3.785;

        document.getElementById('paint-gallons').innerText = gallons.toFixed(1);
        document.getElementById('paint-area').innerText = Math.round(area) + " sq ft";
        document.getElementById('paint-liters').innerText = liters.toFixed(1) + " L";
    }

    inputs.forEach(id => els[id].addEventListener('input', calculate));

    document.getElementById('copy-paint').addEventListener('click', function() {
        const text = `Paint Estimate:\nSurface Area: ${document.getElementById('paint-area').innerText}\nPaint Required: ${document.getElementById('paint-gallons').innerText} Gallons (${document.getElementById('paint-liters').innerText})\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = orig; }, 2000);
        });
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\paint-calculator.blade.php ENDPATH**/ ?>