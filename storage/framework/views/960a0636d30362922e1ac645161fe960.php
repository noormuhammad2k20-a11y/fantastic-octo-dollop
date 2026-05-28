<div class="row g-4 error-func-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Value (x)</label>
                        <input type="number" id="erf-x" class="form-control form-control-lg rounded-3" value="0.5" step="0.0001" placeholder="e.g., 0.5 or -1.2">
                        <div class="form-text mt-2">The error function is defined for all real numbers x.</div>
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
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="output-hero">
                        <span class="output-hero-label">Error Function</span>
                        <div class="output-hero-value fs-2" id="out-erf">0.000000</div>
                        <span class="output-hero-unit">erf(x)</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="output-hero" style="--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04);border-color:rgba(99,102,241,0.2)">
                        <span class="output-hero-label">Complementary Erf</span>
                        <div class="output-hero-value fs-2" id="out-erfc">1.000000</div>
                        <span class="output-hero-unit">erfc(x) = 1 - erf(x)</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Breakdown</h6>
                <div class="math-steps small text-secondary" id="math-steps">
                    <!-- Steps -->
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Results
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    // Abramowitz and Stegun approximation for erf(x)
    function erf(x) {
        const sign = (x >= 0) ? 1 : -1;
        x = Math.abs(x);
        const a1 = 0.254829592;
        const a2 = -0.284496736;
        const a3 = 1.421413741;
        const a4 = -1.453152027;
        const a5 = 1.061405429;
        const p = 0.3275911;
        const t = 1.0 / (1.0 + p * x);
        const y = 1.0 - (((((a5 * t + a4) * t) + a3) * t + a2) * t + a1) * t * Math.exp(-x * x);
        return sign * y;
    }

    function calculate() {
        const x = parseFloat($('erf-x').value);
        if (isNaN(x)) return;

        const valErf = erf(x);
        const valErfc = 1 - valErf;

        $('out-erf').textContent = valErf.toFixed(8);
        $('out-erfc').textContent = valErfc.toFixed(8);

        let stepsHtml = `<p>The Error Function $\text{erf}(x)$ is defined as the integral of the Gaussian distribution:</p>`;
        stepsHtml += `<p class="text-center my-3">$\text{erf}(x) = \frac{2}{\sqrt{\pi}} \int_0^x e^{-t^2} dt$</p>`;
        stepsHtml += `<ul class="ps-3 mt-2">`;
        stepsHtml += `<li class="mb-2"><b>Input:</b> $x = ${x}$</li>`;
        stepsHtml += `<li class="mb-2"><b>Result:</b> $\text{erf}(${x}) \approx ${valErf.toFixed(8)}$</li>`;
        stepsHtml += `<li class="mb-2"><b>Complement:</b> $\text{erfc}(${x}) = 1 - \text{erf}(${x}) \approx ${valErfc.toFixed(8)}$</li>`;
        if (x === 0) stepsHtml += `<li>Note: $\text{erf}(0) = 0$ exactly.</li>`;
        else if (x > 3) stepsHtml += `<li>Note: For large $x$, $\text{erf}(x)$ approaches 1 rapidly.</li>`;
        else if (x < -3) stepsHtml += `<li>Note: For large negative $x$, $\text{erf}(x)$ approaches -1 rapidly.</li>`;
        stepsHtml += `</ul>`;
        
        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('erf-x').value = '0.5';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Error Function Calculation (x=${$('erf-x').value})\nerf(x): ${$('out-erf').textContent}\nerfc(x): ${$('out-erfc').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Results Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.error-func-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.error-func-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.error-func-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.error-func-calc-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.error-func-calc-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.error-func-calc-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

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
.output-hero { text-align: center; padding: 1.5rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(236,72,153,0.2); }
.output-hero-label { display: block; font-size: 0.8rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; }
.output-hero-unit { font-size: 0.9rem; color: #64748b; font-weight: 500; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\error-function-calculator.blade.php ENDPATH**/ ?>