<div class="row g-4 rational-expression-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3 justify-content-center">
                    <div class="col-md-8 text-center">
                        <input type="text" id="numerator" class="form-control form-control-lg text-center rounded-3 mb-2" value="x^2 - 1" placeholder="Numerator">
                        <div class="border-top border-2 border-dark mx-auto" style="width: 100px;"></div>
                        <input type="text" id="denominator" class="form-control form-control-lg text-center rounded-3 mt-2" value="x - 1" placeholder="Denominator">
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate">
                        <i class="fas fa-calculator me-2"></i>Simplify Expression
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:230;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Simplified Form</span>
                <div class="output-hero-value fs-2" id="out-result">x + 1</div>
                <span class="output-hero-unit" id="out-domain">Domain: x ≠ 1</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Steps</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const knownExpressions = {
        'x^2-1|x-1': { result: 'x + 1', domain: 'x ≠ 1', steps: `<ol><li>Factor the numerator: x² - 1 = (x - 1)(x + 1)</li><li>Identify the common factor: (x - 1)</li><li>Cancel the common factor, noting x ≠ 1.</li><li>Result: x + 1</li></ol>` },
        'x^2+2x+1|x+1': { result: 'x + 1', domain: 'x ≠ -1', steps: `<ol><li>Factor the numerator: x² + 2x + 1 = (x + 1)²</li><li>Divide by denominator (x + 1).</li><li>Result: x + 1</li></ol>` },
        'x^2-4|x-2': { result: 'x + 2', domain: 'x ≠ 2', steps: `<ol><li>Factor the numerator: x² - 4 = (x - 2)(x + 2)</li><li>Cancel the common factor (x - 2).</li><li>Result: x + 2</li></ol>` },
        'x^2-4|x+2': { result: 'x - 2', domain: 'x ≠ -2', steps: `<ol><li>Factor the numerator: x² - 4 = (x - 2)(x + 2)</li><li>Cancel the common factor (x + 2).</li><li>Result: x - 2</li></ol>` },
        'x^2-9|x-3': { result: 'x + 3', domain: 'x ≠ 3', steps: `<ol><li>Factor the numerator: x² - 9 = (x - 3)(x + 3)</li><li>Cancel the common factor (x - 3).</li><li>Result: x + 3</li></ol>` },
        'x^2-9|x+3': { result: 'x - 3', domain: 'x ≠ -3', steps: `<ol><li>Factor the numerator: x² - 9 = (x - 3)(x + 3)</li><li>Cancel the common factor (x + 3).</li><li>Result: x - 3</li></ol>` },
        'x^2+5x+6|x+2': { result: 'x + 3', domain: 'x ≠ -2', steps: `<ol><li>Factor the numerator: x² + 5x + 6 = (x + 2)(x + 3)</li><li>Cancel the common factor (x + 2).</li><li>Result: x + 3</li></ol>` },
        'x^2+5x+6|x+3': { result: 'x + 2', domain: 'x ≠ -3', steps: `<ol><li>Factor the numerator: x² + 5x + 6 = (x + 2)(x + 3)</li><li>Cancel the common factor (x + 3).</li><li>Result: x + 2</li></ol>` },
        'x^2-x-6|x-3': { result: 'x + 2', domain: 'x ≠ 3', steps: `<ol><li>Factor the numerator: x² - x - 6 = (x - 3)(x + 2)</li><li>Cancel the common factor (x - 3).</li><li>Result: x + 2</li></ol>` },
        'x^2-x-6|x+2': { result: 'x - 3', domain: 'x ≠ -2', steps: `<ol><li>Factor the numerator: x² - x - 6 = (x - 3)(x + 2)</li><li>Cancel the common factor (x + 2).</li><li>Result: x - 3</li></ol>` },
        '2x^2+4x|2x': { result: 'x + 2', domain: 'x ≠ 0', steps: `<ol><li>Factor the numerator: 2x² + 4x = 2x(x + 2)</li><li>Cancel the common factor 2x.</li><li>Result: x + 2</li></ol>` },
        'x^2-16|x-4': { result: 'x + 4', domain: 'x ≠ 4', steps: `<ol><li>Factor the numerator: x² - 16 = (x - 4)(x + 4)</li><li>Cancel the common factor (x - 4).</li><li>Result: x + 4</li></ol>` },
        'x^2-25|x-5': { result: 'x + 5', domain: 'x ≠ 5', steps: `<ol><li>Factor the numerator: x² - 25 = (x - 5)(x + 5)</li><li>Cancel the common factor (x - 5).</li><li>Result: x + 5</li></ol>` },
        'x^3-x|x': { result: 'x² - 1', domain: 'x ≠ 0', steps: `<ol><li>Factor the numerator: x³ - x = x(x² - 1)</li><li>Cancel the common factor x.</li><li>Result: x² - 1 = (x - 1)(x + 1)</li></ol>` },
    };

    function calculate() {
        const num = $('numerator').value.trim().replace(/\s+/g, '');
        const den = $('denominator').value.trim().replace(/\s+/g, '');
        
        if (!num || !den) return;

        const key = num + '|' + den;
        const match = knownExpressions[key];

        let result, domain, steps;

        if (match) {
            result = match.result;
            domain = match.domain;
            steps = match.steps;
        } else {
            result = `(${num}) / (${den})`;
            domain = 'Check denominator for zeros';
            steps = `<ol><li>Expression: (${num}) / (${den})</li><li>Try common factoring patterns like difference of squares (a²-b²), perfect square trinomials, or grouping.</li><li>Supported expressions include: x²-1, x²-4, x²-9, x²-16, x²-25, x²+2x+1, x²+5x+6, x²-x-6, 2x²+4x, x³-x</li></ol>`;
        }

        $('out-result').textContent = result;
        $('out-domain').textContent = `Domain: ${domain}`;
        $('math-steps').innerHTML = steps;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('output-section')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', function() {
        $('numerator').value = 'x^2 - 1';
        $('denominator').value = 'x - 1';
        $('output-section').style.display = 'none';
    });
});
</script>

<style>
.rational-expression-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(99,102,241,0.2); }
</style>

