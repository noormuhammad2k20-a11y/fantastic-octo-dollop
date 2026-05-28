<div class="interactive-tool-grid modulo-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Dividend (X)</label>
                <input type="number" id="mod-x" class="form-control-custom mod-in" value="10">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Divisor (Y)</label>
                <input type="number" id="mod-y" class="form-control-custom mod-in" value="3">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Essential for coding, cryptography, and timing logic.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Remainder (X % Y)</span>
            <div class="result-main-value" id="result-mod">1</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Quotient</span>
                    <span class="stat-value" id="stat-quo">3</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Operation</span>
                    <span class="stat-value text-accent">Modulus</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const x = parseFloat(document.getElementById('mod-x').value) || 0;
        const y = parseFloat(document.getElementById('mod-y').value) || 1;

        const rem = x % y;
        const quo = Math.floor(x / y);

        document.getElementById('result-mod').innerText = rem;
        document.getElementById('stat-quo').innerText = quo;
    }

    document.querySelectorAll('.mod-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Modulo Calculation:\n${document.getElementById('mod-x').value} Mod ${document.getElementById('mod-y').value} = ${document.getElementById('result-mod').innerText}\nCalculated via ToolsHub Math.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\modulo-calculator.blade.php ENDPATH**/ ?>