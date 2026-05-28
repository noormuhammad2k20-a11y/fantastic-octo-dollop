<div class="interactive-tool-grid derivative-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label-custom">Function f(x)</label>
                    <input type="text" class="form-control-custom font-monospace" id="der-expr" value="3x^3 + 2x^2 + 5" placeholder="e.g. sin(x) * x^2">
                </div>
                
                <div class="col-12">
                    <label class="form-label-custom">Order of Derivative</label>
                    <select class="form-control-custom" id="der-order">
                        <option value="1" selected>First Derivative (d/dx)</option>
                        <option value="2">Second Derivative (d²/dx²)</option>
                        <option value="3">Third Derivative (d³/dx³)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">f' (x)</span>
            <div class="result-main-value font-monospace fs-3 mt-3" id="der-result" style="word-break: break-all;">9x^2 + 4x</div>
            
            <div class="pt-3 border-top mt-4">
                <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-der" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i> Copy Result
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const exprInput = document.getElementById('der-expr');
    const orderSelect = document.getElementById('der-order');
    const resultDisplay = document.getElementById('der-result');
    const labelDisplay = document.querySelector('.result-label');

    function calculate() {
        const expr = exprInput.value.trim();
        const order = parseInt(orderSelect.value);
        if(!expr) return;

        try {
            let result = expr;
            for(let i=0; i<order; i++) {
                result = math.derivative(result, 'x').toString();
            }
            resultDisplay.innerText = result;
            
            const labels = ["f' (x)", "f'' (x)", "f''' (x)"];
            labelDisplay.innerText = labels[order-1] || `d^${order}/dx^${order}`;
        } catch (e) {
            resultDisplay.innerText = "Invalid Expression";
        }
    }

    [exprInput, orderSelect].forEach(el => el.addEventListener('input', calculate));

    document.getElementById('copy-der').addEventListener('click', function() {
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

