<div class="row g-4 function-composition-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Function f(x)</label>
                        <input type="text" id="func-f" class="form-control form-control-lg rounded-3" value="2*x + 3" placeholder="e.g., 2*x + 3">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Function g(x)</label>
                        <input type="text" id="func-g" class="form-control form-control-lg rounded-3" value="x^2" placeholder="e.g., x^2">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Evaluation Point (optional x)</label>
                        <input type="number" id="eval-x" class="form-control form-control-lg rounded-3" value="2" step="any">
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Compose Functions
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:140;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="stat-card p-4 rounded-3 border bg-white h-100 text-center">
                        <div class="small text-muted mb-2 text-uppercase fw-bold ls-1">$(f \circ g)(x)$</div>
                        <div class="fs-4 fw-bold text-primary mb-2" id="out-fog-expr">f(g(x))</div>
                        <div class="output-hero-value fs-2 mb-1" id="out-fog-val">0</div>
                        <div class="small text-secondary">Evaluated at x = <span class="eval-x-label">2</span></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card p-4 rounded-3 border bg-white h-100 text-center">
                        <div class="small text-muted mb-2 text-uppercase fw-bold ls-1">$(g \circ f)(x)$</div>
                        <div class="fs-4 fw-bold text-danger mb-2" id="out-gof-expr">g(f(x))</div>
                        <div class="output-hero-value fs-2 mb-1" id="out-gof-val">0</div>
                        <div class="small text-secondary">Evaluated at x = <span class="eval-x-label">2</span></div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Step-by-Step Composition</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Composition Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function evaluateFunc(expr, x) {
        try {
            const sanitized = expr.replace(/x/g, `(${x})`).replace(/\^/g, '**');
            return eval(sanitized);
        } catch (e) {
            return NaN;
        }
    }

    function calculate() {
        const f = $('func-f').value.trim();
        const g = $('func-g').value.trim();
        const x = parseFloat($('eval-x').value);

        if (!f || !g || isNaN(x)) return;

        const gVal = evaluateFunc(g, x);
        const fogVal = evaluateFunc(f, gVal);

        const fVal = evaluateFunc(f, x);
        const gofVal = evaluateFunc(g, fVal);

        document.querySelectorAll('.eval-x-label').forEach(el => el.textContent = x);
        $('out-fog-expr').textContent = `f(g(x)) = f(${g})`;
        $('out-fog-val').textContent = isNaN(fogVal) ? 'Error' : fogVal.toLocaleString();

        $('out-gof-expr').textContent = `g(f(x)) = g(${f})`;
        $('out-gof-val').textContent = isNaN(gofVal) ? 'Error' : gofVal.toLocaleString();

        let stepsHtml = `<div class="mb-3">`;
        stepsHtml += `<p class="fw-bold text-primary mb-1">Calculating $(f \\circ g)(${x})$:</p>`;
        stepsHtml += `<ol class="ps-3">`;
        stepsHtml += `<li>First, find $g(${x})$: $g(${x}) = ${gVal}$</li>`;
        stepsHtml += `<li>Then, substitute into $f$: $f(${gVal}) = ${fogVal}$</li>`;
        stepsHtml += `</ol>`;
        stepsHtml += `</div>`;

        stepsHtml += `<div>`;
        stepsHtml += `<p class="fw-bold text-danger mb-1">Calculating $(g \\circ f)(${x})$:</p>`;
        stepsHtml += `<ol class="ps-3">`;
        stepsHtml += `<li>First, find $f(${x})$: $f(${x}) = ${fVal}$</li>`;
        stepsHtml += `<li>Then, substitute into $g$: $g(${fVal}) = ${gofVal}$</li>`;
        stepsHtml += `</ol>`;
        stepsHtml += `</div>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('func-f').value = '2*x + 3';
        $('func-g').value = 'x^2';
        $('eval-x').value = '2';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        const text = `Function Composition Report\nf(x) = ${$('func-f').value}\ng(x) = ${$('func-g').value}\n(f∘g)(${ $('eval-x').value}) = ${$('out-fog-val').textContent}\n(g∘f)(${ $('eval-x').value}) = ${$('out-gof-val').textContent}`;
        navigator.clipboard.writeText(text);
    });
});
</script>

<style>
.function-composition-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.function-composition-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.function-composition-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.function-composition-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.function-composition-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.function-composition-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

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
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/function-composition.blade.php ENDPATH**/ ?>