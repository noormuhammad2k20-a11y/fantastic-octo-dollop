<div class="row g-4 radical-solver-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3 align-items-center justify-content-center">
                    <div class="col-auto fs-3">√</div>
                    <div class="col-auto border-top border-dark pt-2 px-3">
                        <div class="d-flex gap-2 align-items-center">
                            <input type="number" id="coeff-a" class="form-control text-center" value="1" style="width:70px">
                            <span>x +</span>
                            <input type="number" id="coeff-b" class="form-control text-center" value="4" style="width:70px">
                        </div>
                    </div>
                    <div class="col-auto fs-3">=</div>
                    <div class="col-auto">
                        <input type="number" id="const-c" class="form-control text-center fs-4" value="3" style="width:80px">
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Solve Equation
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Solution</span>
                <div class="output-hero-value fs-1" id="out-result">x = 5</div>
                <span class="output-hero-unit" id="out-summary">Verified solution</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Solution Steps</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const a = parseFloat($('coeff-a').value);
        const b = parseFloat($('coeff-b').value);
        const c = parseFloat($('const-c').value);

        if (isNaN(a) || isNaN(b) || isNaN(c)) return;

        if (c < 0) {
            $('out-result').textContent = "No Solution";
            $('out-summary').textContent = "Square root cannot be negative.";
            $('math-steps').innerHTML = "<p>The equation $\\sqrt{ax+b} = " + c + "$ has no real solutions because the principal square root is non-negative.</p>";
        } else if (a === 0) {
            if (Math.sqrt(b) === c) {
                $('out-result').textContent = "Infinite Solutions (or Constant Identity)";
            } else {
                $('out-result').textContent = "No Solution";
            }
        } else {
            // ax + b = c^2
            const x = (c * c - b) / a;
            $('out-result').textContent = `x = ${x.toFixed(4).replace(/\.?0+$/, "")}`;
            $('out-summary').textContent = "Equation squared and solved.";
            
            let steps = `<ol>`;
            steps += `<li>Square both sides: $(\\sqrt{${a}x + ${b}})^2 = ${c}^2$</li>`;
            steps += `<li>Simplify: $${a}x + ${b} = ${c*c}$</li>`;
            steps += `<li>Subtract ${b}: $${a}x = ${c*c - b}$</li>`;
            steps += `<li>Divide by ${a}: $x = \\frac{${c*c - b}}{${a}} = ${x}$</li>`;
            steps += `</ol>`;
            $('math-steps').innerHTML = steps;
        }

        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('output-section')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
});
</script>

<style>
.radical-solver-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(239,68,68,0.2); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\radical-equation-solver.blade.php ENDPATH**/ ?>