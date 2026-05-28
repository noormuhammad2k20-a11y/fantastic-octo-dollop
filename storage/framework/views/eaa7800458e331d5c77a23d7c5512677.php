<div class="row g-4 exponents-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Base (x)</label>
                        <input type="number" id="exp-base" class="form-control form-control-lg rounded-3" value="2" step="any">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Exponent (n)</label>
                        <input type="number" id="exp-n" class="form-control form-control-lg rounded-3" value="10" step="any">
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Calculate
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:230;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Result ($x^n$)</span>
                <div class="output-hero-value" id="out-result">0</div>
                <span class="output-hero-unit" id="out-formula">2 to the power of 10</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Breakdown</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const x = parseFloat($('exp-base').value);
        const n = parseFloat($('exp-n').value);

        if (isNaN(x) || isNaN(n)) return;

        const result = Math.pow(x, n);
        
        $('out-result').textContent = (result > 1e15 || result < 1e-7 && result !== 0) 
            ? result.toExponential(6) 
            : result.toLocaleString(undefined, {maximumFractionDigits: 10});
            
        $('out-formula').textContent = `${x} raised to the power of ${n}`;

        let stepsHtml = `<p>The expression is calculated as:</p>`;
        stepsHtml += `<p class="text-center my-3 fs-4">$${x}^{${n}} = ${result}$</p>`;
        stepsHtml += `<div class="p-3 bg-light rounded-3 mb-3">`;
        
        if (n === 0) {
            stepsHtml += `<p><b>Rule:</b> Any non-zero number raised to the power of 0 is 1.</p>`;
        } else if (n === 1) {
            stepsHtml += `<p><b>Rule:</b> Any number raised to the power of 1 is the number itself.</p>`;
        } else if (n < 0) {
            stepsHtml += `<p><b>Rule (Negative Exponent):</b> $x^{-n} = \\frac{1}{x^n}$</p>`;
            stepsHtml += `<p>$${x}^{${n}} = \\frac{1}{${x}^{${Math.abs(n)}}} = \\frac{1}{${Math.pow(x, Math.abs(n))}}$</p>`;
        } else if (!Number.isInteger(n)) {
            stepsHtml += `<p><b>Rule (Fractional Exponent):</b> This involves calculating the root or using logarithms.</p>`;
            stepsHtml += `<p>$${x}^{${n}} = e^{${n} \\ln(${x})}$</p>`;
        } else if (n > 1 && n <= 10) {
            let mult = Array(n).fill(x).join(' \\times ');
            stepsHtml += `<p><b>Multiplication:</b> $${mult} = ${result}$</p>`;
        }
        stepsHtml += `</div>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('exp-base').value = '2';
        $('exp-n').value = '10';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-result').textContent).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.exponents-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.exponents-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.exponents-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.exponents-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.exponents-calc-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.exponents-calc-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }
.btn-secondary-action:hover { background: #e2e8f0; color: #1e293b; }

@media (max-width: 768px) {
    .quick-actions-grid { grid-template-columns: 1fr 1fr; }
    .btn-primary-action { grid-column: span 2; }
}

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(99,102,241,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; word-break: break-all; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\exponents-calculator.blade.php ENDPATH**/ ?>