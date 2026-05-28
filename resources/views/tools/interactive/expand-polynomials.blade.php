<div class="row g-4 expand-polynomials-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Polynomial 1 Coefficients (High to Low)</label>
                    <input type="text" id="poly-1" class="form-control form-control-lg rounded-3" value="1, 2" placeholder="e.g., 1, 2 for x+2">
                    <div class="form-text mt-1">Example: <code>1, 0, -1</code> represents $x^2 - 1$.</div>
                </div>
                <div class="mb-4">
                    <label class="form-label-custom">Polynomial 2 Coefficients (High to Low)</label>
                    <input type="text" id="poly-2" class="form-control form-control-lg rounded-3" value="1, -3" placeholder="e.g., 1, -3 for x-3">
                    <div class="form-text mt-1">Example: <code>1, 1</code> represents $x + 1$.</div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Expand Expression
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
                <span class="output-hero-label">Expanded Standard Form</span>
                <div class="output-hero-value fs-3" id="out-standard-form">x² - x - 6</div>
                <span class="output-hero-unit" id="out-summary">Product of P₁(x) and P₂(x)</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Breakdown</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Expansion
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function formatPoly(coeffs) {
        let n = coeffs.length - 1;
        let terms = [];
        coeffs.forEach((c, i) => {
            if (c === 0) return;
            let p = n - i;
            let term = '';
            let absC = Math.abs(c);
            
            if (c > 0 && terms.length > 0) term += ' + ';
            if (c < 0) term += terms.length > 0 ? ' - ' : '-';
            
            if (absC !== 1 || p === 0) term += absC;
            if (p > 0) term += 'x';
            if (p > 1) term += `^{${p}}`;
            terms.push(term);
        });
        return terms.length === 0 ? '0' : terms.join('');
    }

    function calculate() {
        const c1 = $('poly-1').value.split(',').map(n => parseFloat(n.trim())).filter(n => !isNaN(n));
        const c2 = $('poly-2').value.split(',').map(n => parseFloat(n.trim())).filter(n => !isNaN(n));

        if (c1.length === 0 || c2.length === 0) return;

        // Multiply polynomials
        const resSize = c1.length + c2.length - 1;
        const res = new Array(resSize).fill(0);

        for (let i = 0; i < c1.length; i++) {
            for (let j = 0; j < c2.length; j++) {
                res[i + j] += c1[i] * c2[j];
            }
        }

        const standardForm = formatPoly(res);
        $('out-standard-form').innerHTML = `$${standardForm}$`;
        
        let stepsHtml = `<p><b>Input Polynomials:</b></p>`;
        stepsHtml += `<ul>`;
        stepsHtml += `<li>$P_1(x) = ${formatPoly(c1)}$</li>`;
        stepsHtml += `<li>$P_2(x) = ${formatPoly(c2)}$</li>`;
        stepsHtml += `</ul>`;
        stepsHtml += `<p><b>Distribution Process:</b></p>`;
        stepsHtml += `<p>Each term of $P_1$ is multiplied by every term of $P_2$.</p>`;
        stepsHtml += `<div class="p-3 bg-light rounded-3 mb-2 small">`;
        c1.forEach((val1, i) => {
            let p1 = c1.length - 1 - i;
            c2.forEach((val2, j) => {
                let p2 = c2.length - 1 - j;
                let prod = val1 * val2;
                if (prod !== 0) {
                    stepsHtml += `<div>(${val1}x${p1 > 0 ? '<sup>'+p1+'</sup>' : ''}) &times; (${val2}x${p2 > 0 ? '<sup>'+p2+'</sup>' : ''}) = ${prod}x${(p1+p2) > 0 ? '<sup>'+(p1+p2)+'</sup>' : ''}</div>`;
                }
            });
        });
        stepsHtml += `</div>`;
        stepsHtml += `<p class="mt-2 fw-bold text-primary">Result: $${standardForm}$</p>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('out-standard-form'), $('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('poly-1').value = '1, 2';
        $('poly-2').value = '1, -3';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-standard-form').textContent);
    });
});
</script>

<style>
.expand-polynomials-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.expand-polynomials-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.expand-polynomials-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.expand-polynomials-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.expand-polynomials-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.expand-polynomials-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

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
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(59,130,246,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-weight: 900; color: #0f172a; line-height: 1.2; margin-bottom: 0.5rem; }
</style>

