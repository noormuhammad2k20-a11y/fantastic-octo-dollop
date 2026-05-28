<div class="interactive-tool-grid antiderivative-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Enter Function f(x)</label>
                <input type="text" id="input-func" class="form-control-custom" placeholder="e.g. 3x^2 + 2x + 5">
                <small class="text-secondary">Note: Use ^ for powers (e.g., x^2). Supports polynomials.</small>
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> <strong>Rule:</strong> ∫ x^n dx = (x^(n+1))/(n+1) + C
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Indefinite Integral F(x)</span>
            <div class="result-main-value" id="result-int" style="font-size: 1.5rem;">--</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Constant</span>
                    <span class="stat-value">+ C</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Status</span>
                    <span class="stat-value" id="stat-status">Ready</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Step
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputFunc = document.getElementById('input-func');
    const resultInt = document.getElementById('result-int');

    function calculateIntegral() {
        let val = inputFunc.value.toLowerCase().replace(/\s+/g, '');
        if (!val) {
            resultInt.innerText = "--";
            return;
        }

        // Extremely simplified polynomial integration logic for demo/basic use
        // Handles patterns like: 3x^2 + 5x + 2
        try {
            const terms = val.split(/(?=[+-])/);
            let result = "";

            terms.forEach((term, i) => {
                let sign = term.startsWith('-') ? "-" : (i > 0 ? " + " : "");
                let cleanTerm = term.replace(/[+-]/, '');

                if (cleanTerm.includes('x^')) {
                    let parts = cleanTerm.split('x^');
                    let coeff = parseFloat(parts[0]) || (parts[0] === '' ? 1 : 0);
                    let power = parseFloat(parts[1]) || 0;
                    let newPower = power + 1;
                    let newCoeff = coeff / newPower;
                    result += sign + (newCoeff === 1 ? "" : newCoeff.toFixed(2)) + "x^" + newPower;
                } else if (cleanTerm.includes('x')) {
                    let coeff = parseFloat(cleanTerm.split('x')[0]) || (cleanTerm.startsWith('x') ? 1 : 0);
                    let newCoeff = coeff / 2;
                    result += sign + (newCoeff === 1 ? "" : newCoeff.toFixed(2)) + "x^2";
                } else {
                    let coeff = parseFloat(cleanTerm) || 0;
                    result += sign + coeff + "x";
                }
            });

            resultInt.innerText = result + " + C";
            document.getElementById('stat-status').innerText = "Solved";
        } catch (e) {
            resultInt.innerText = "Complexity limit reached";
            document.getElementById('stat-status').innerText = "Error";
        }
    }

    inputFunc.addEventListener('input', calculateIntegral);

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Antiderivative Calculation:\nf(x) = ${inputFunc.value}\nF(x) = ${resultInt.innerText}\nCalculated via ToolsHub Math.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });
});
</script>

