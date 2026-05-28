<div class="interactive-tool-grid rounding-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Enter Number</label>
                <input type="number" id="input-number" class="form-control-custom" value="123.4567" step="any">
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Rounding Precision (Decimals)</label>
                    <input type="number" id="precision" class="form-control-custom" value="2" min="0" max="10">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Rounding Method</label>
                    <select id="method" class="form-control-custom">
                        <option value="round">Standard Round</option>
                        <option value="ceil">Ceiling (Always Up)</option>
                        <option value="floor">Floor (Always Down)</option>
                    </select>
                </div>
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> <strong>Standard:</strong> .5 and above rounds up, below rounds down.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2 text-center py-5">
            <span class="result-label">Rounded Result</span>
            <div class="result-main-value" id="result-number">123.46</div>
            
            <div class="mt-4 p-3 border rounded bg-white">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Original</span>
                    <span class="fw-bold" id="stat-original">123.4567</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Method</span>
                    <span class="fw-bold text-accent" id="stat-method">Standard</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const numInput = document.getElementById('input-number');
    const precInput = document.getElementById('precision');
    const methodInput = document.getElementById('method');
    const resultNum = document.getElementById('result-number');
    const statOriginal = document.getElementById('stat-original');
    const statMethod = document.getElementById('stat-method');

    function calculate() {
        const num = parseFloat(numInput.value) || 0;
        const prec = parseInt(precInput.value) || 0;
        const method = methodInput.value;
        const factor = Math.pow(10, prec);

        let rounded;
        if (method === 'round') {
            rounded = Math.round(num * factor) / factor;
            statMethod.innerText = "Standard";
        } else if (method === 'ceil') {
            rounded = Math.ceil(num * factor) / factor;
            statMethod.innerText = "Ceiling";
        } else {
            rounded = Math.floor(num * factor) / factor;
            statMethod.innerText = "Floor";
        }

        resultNum.innerText = rounded.toFixed(prec);
        statOriginal.innerText = num;
    }

    [numInput, precInput, methodInput].forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Rounding Report:\nOriginal: ${numInput.value}\nMethod: ${statMethod.innerText}\nPrecision: ${precInput.value} decimals\nRounded Result: ${resultNum.innerText}\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const original = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = original; }, 2000);
        });
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\rounding-calculator.blade.php ENDPATH**/ ?>