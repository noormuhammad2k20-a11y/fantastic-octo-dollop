<div class="interactive-tool-grid simplify-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label-custom">Expression / Fraction</label>
                    <input type="text" class="form-control-custom font-monospace" id="simp-expr" value="12/16" placeholder="e.g. 2x + 4x or 25/75">
                    <p class="text-muted small mt-2"><i class="fas fa-info-circle me-1"></i> Enter fractions like 2/4 or algebraic terms like (x+1)^2/ (x+1).</p>
                </div>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Simplified Form</span>
            <div class="result-main-value font-monospace fs-2 mt-3" id="simp-result">3/4</div>
            
            <div class="pt-4 mt-4 border-top">
                <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-simp" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i> Copy result
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const exprInput = document.getElementById('simp-expr');
    const resultDisplay = document.getElementById('simp-result');

    function calculate() {
        const expr = exprInput.value.trim();
        if(!expr) return;

        try {
            // Check if it's a simple fraction like 12/16
            if (/^\d+\/\d+$/.test(expr)) {
                const parts = expr.split('/');
                const a = parseInt(parts[0]);
                const b = parseInt(parts[1]);
                const common = (x, y) => y === 0 ? x : common(y, x % y);
                const divisor = common(a, b);
                if (b === divisor) resultDisplay.innerText = (a/divisor).toString();
                else resultDisplay.innerText = `${a/divisor}/${b/divisor}`;
            } else {
                const simplified = math.simplify(expr).toString();
                resultDisplay.innerText = simplified;
            }
        } catch (e) {
            resultDisplay.innerText = "Invalid Expression";
        }
    }

    exprInput.addEventListener('input', calculate);

    document.getElementById('copy-simp').addEventListener('click', function() {
        navigator.clipboard.writeText(resultDisplay.innerText).then(() => {
            const btn = this;
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = orig; }, 2000);
        });
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\simplify-calculator.blade.php ENDPATH**/ ?>