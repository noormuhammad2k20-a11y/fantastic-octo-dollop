<div class="row g-4 inverse-function-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Select Function Type</label>
                        <select id="func-type" class="form-select form-control-lg rounded-3">
                            <option value="linear">Linear: f(x) = ax + b</option>
                            <option value="rational">Rational: f(x) = (ax + b) / (cx + d)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">a</label>
                        <input type="number" id="coeff-a" class="form-control" value="2" step="any">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">b</label>
                        <input type="number" id="coeff-b" class="form-control" value="3" step="any">
                    </div>
                    <div class="col-md-3 rational-only" style="display:none">
                        <label class="form-label-custom">c</label>
                        <input type="number" id="coeff-c" class="form-control" value="1" step="any">
                    </div>
                    <div class="col-md-3 rational-only" style="display:none">
                        <label class="form-label-custom">d</label>
                        <input type="number" id="coeff-d" class="form-control" value="-1" step="any">
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Find Inverse
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Inverse Function ($f^{-1}(x)$)</span>
                <div class="output-hero-value fs-2" id="out-result">f⁻¹(x) = ...</div>
                <span class="output-hero-unit" id="out-summary">Mapped domain to range</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Derivation Steps</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Inverse
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    $('func-type').addEventListener('change', (e) => {
        const isRational = e.target.value === 'rational';
        document.querySelectorAll('.rational-only').forEach(el => el.style.display = isRational ? 'block' : 'none');
    });

    function calculate() {
        const type = $('func-type').value;
        const a = parseFloat($('coeff-a').value) || 0;
        const b = parseFloat($('coeff-b').value) || 0;
        const c = parseFloat($('coeff-c').value) || 0;
        const d = parseFloat($('coeff-d').value) || 0;

        let result, steps = "";

        if (type === 'linear') {
            if (a === 0) {
                alert('Constant functions (a=0) are not invertible.');
                return;
            }
            // y = ax + b => x = (y - b) / a
            result = `f^{-1}(x) = \\frac{x - (${b})}{${a}}`;
            steps = `<ol><li>Set $y = ${a}x + ${b}$</li><li>Swap $x$ and $y$: $x = ${a}y + ${b}$</li><li>Solve for $y$: $y = \\frac{x - ${b}}{${a}}$</li></ol>`;
        } else {
            // y = (ax+b)/(cx+d) => y(cx+d) = ax+b => cyx + dy = ax + b => cyx - ax = b - dy => x(cy - a) = b - dy => x = (b - dy) / (cy - a)
            if (a*d - b*c === 0) {
                alert('The function is not invertible (determinant is zero).');
                return;
            }
            result = `f^{-1}(x) = \\frac{${-d}x + ${b}}{${c}x - ${a}}`;
            steps = `<ol><li>Set $y = \\frac{${a}x + ${b}}{${c}x + ${d}}$</li><li>Swap $x$ and $y$: $x = \\frac{${a}y + ${b}}{${c}y + ${d}}$</li><li>Cross-multiply: $x(${c}y + ${d}) = ${a}y + ${b}$</li><li>Rearrange: $${c}xy - ${a}y = ${b} - ${d}x$</li><li>Factor $y$: $y(${c}x - ${a}) = ${b} - ${d}x$</li><li>Final Inverse: $y = \\frac{-${d}x + ${b}}{${c}x - ${a}}$</li></ol>`;
        }

        $('out-result').textContent = `\\( ${result} \\)`;
        $('math-steps').innerHTML = steps;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('out-result'), $('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('coeff-a').value = '2';
        $('coeff-b').value = '3';
        $('output-section').style.display = 'none';
    });
});
</script>

<style>
.inverse-function-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.inverse-function-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.inverse-function-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.inverse-function-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.inverse-function-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(59,130,246,0.2); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\inverse-function.blade.php ENDPATH**/ ?>