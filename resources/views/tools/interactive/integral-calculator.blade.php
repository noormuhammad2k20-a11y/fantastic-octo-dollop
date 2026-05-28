<div class="interactive-tool-grid integral-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label-custom">Function f(x)</label>
                    <input type="text" class="form-control-custom font-monospace" id="int-expr" value="3x^2 + 2x" placeholder="e.g. x^2 + cos(x)">
                    <p class="text-muted small mt-2"><i class="fas fa-info-circle me-1"></i> Use standard notation like x^2, sin(x), exp(x).</p>
                </div>
                
                <div class="col-12">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="is-definite">
                        <label class="form-check-label fw-bold" for="is-definite">Definite Integral</label>
                    </div>
                </div>

                <div id="definite-inputs" class="col-12 d-none">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label-custom">Lower Limit (a)</label>
                            <input type="number" class="form-control-custom" id="int-lower" value="0">
                        </div>
                        <div class="col-6">
                            <label class="form-label-custom">Upper Limit (b)</label>
                            <input type="number" class="form-control-custom" id="int-upper" value="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Result</span>
            <div class="result-main-value font-monospace fs-3 mt-3" id="int-result" style="word-break: break-all;">x^3 + x^2 + C</div>
            
            <div class="pt-3 border-top mt-4">
                <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-int" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i> Copy Result
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const exprInput = document.getElementById('int-expr');
    const isDefinite = document.getElementById('is-definite');
    const defInputs = document.getElementById('definite-inputs');
    const lowerInput = document.getElementById('int-lower');
    const upperInput = document.getElementById('int-upper');
    const resultDisplay = document.getElementById('int-result');

    function calculate() {
        const expr = exprInput.value.trim();
        if(!expr) return;

        try {
            if (!isDefinite.checked) {
                const integral = math.integral(expr, 'x');
                resultDisplay.innerText = integral.toString() + " + C";
            } else {
                const a = parseFloat(lowerInput.value);
                const b = parseFloat(upperInput.value);
                const f = math.compile(expr);
                
                // Simpson's rule for numerical integration
                const n = 100; // sub-intervals
                const h = (b - a) / n;
                let sum = f.evaluate({x: a}) + f.evaluate({x: b});
                for (let i = 1; i < n; i++) {
                    const x = a + i * h;
                    sum += f.evaluate({x: x}) * (i % 2 === 0 ? 2 : 4);
                }
                const result = (h / 3) * sum;
                resultDisplay.innerText = result.toFixed(5);
            }
        } catch (e) {
            resultDisplay.innerText = "Invalid Expression";
        }
    }

    [exprInput, lowerInput, upperInput].forEach(el => el.addEventListener('input', calculate));
    isDefinite.addEventListener('change', () => {
        defInputs.classList.toggle('d-none', !isDefinite.checked);
        calculate();
    });

    document.getElementById('copy-int').addEventListener('click', function() {
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

