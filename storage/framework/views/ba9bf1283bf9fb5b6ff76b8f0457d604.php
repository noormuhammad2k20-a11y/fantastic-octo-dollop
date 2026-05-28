<div class="row g-4 odd-even-checker-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter Function f(x)</label>
                        <input type="text" id="func-input" class="form-control form-control-lg rounded-3" value="x^2 + 4" placeholder="e.g., x^3 - x">
                        <div class="form-text mt-2">Use 'x' as the variable. Supported: ^, *, /, +, -, sin, cos, tan.</div>
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Check Parity
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" id="output-card" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Result</span>
                <div class="output-hero-value" id="out-result">EVEN</div>
                <span class="output-hero-unit" id="out-summary">f(x) = f(-x)</span>
            </div>

            <div class="mt-4 p-4 rounded-3 border bg-white shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-brain me-2 text-warning"></i>Mathematical Verification</h6>
                <div class="math-steps small text-secondary" id="math-steps"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Analysis
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function evaluate(expr, x) {
        try {
            let sanitized = expr.toLowerCase().replace(/x/g, `(${x})`)
                .replace(/\^/g, '**')
                .replace(/sin/g, 'Math.sin')
                .replace(/cos/g, 'Math.cos')
                .replace(/tan/g, 'Math.tan');
            return eval(sanitized);
        } catch (e) {
            return NaN;
        }
    }

    function calculate() {
        const expr = $('func-input').value.trim();
        if (!expr) return;

        // Test points
        const testPoints = [1, 2.5, -3.2, 5, Math.PI];
        let isEven = true;
        let isOdd = true;

        for (let x of testPoints) {
            const fx = evaluate(expr, x);
            const f_neg_x = evaluate(expr, -x);
            
            if (isNaN(fx) || isNaN(f_neg_x)) {
                alert('Invalid expression syntax.');
                return;
            }

            if (Math.abs(fx - f_neg_x) > 1e-9) isEven = false;
            if (Math.abs(fx + f_neg_x) > 1e-9) isOdd = false;
        }

        const card = $('output-card');
        let result, summary, hue, color;

        if (isEven && isOdd) {
            // Usually only f(x) = 0
            result = "ZERO FUNCTION";
            summary = "The function is both even and odd.";
            hue = 140; color = "#059669";
        } else if (isEven) {
            result = "EVEN";
            summary = "$f(x) = f(-x)$. Symmetric about the y-axis.";
            hue = 260; color = "#7c3aed";
        } else if (isOdd) {
            result = "ODD";
            summary = "$f(-x) = -f(x)$. Symmetric about the origin.";
            hue = 210; color = "#2563eb";
        } else {
            result = "NEITHER";
            summary = "The function has no parity symmetry.";
            hue = 0; color = "#dc2626";
        }

        $('out-result').textContent = result;
        $('out-summary').innerHTML = summary;
        card.style.setProperty('--tool-hue', hue);
        card.style.setProperty('--tool-color', color);
        card.style.setProperty('--tool-bg', `hsla(${hue}, 80%, 50%, 0.04)`);

        let stepsHtml = `<p>We test the function parity by comparing $f(x)$ and $f(-x)$ for various points:</p>`;
        stepsHtml += `<ul class="ps-3">`;
        stepsHtml += `<li><b>Even Test:</b> Does $f(-x) = f(x)$?</li>`;
        stepsHtml += `<li><b>Odd Test:</b> Does $f(-x) = -f(x)$?</li>`;
        stepsHtml += `</ul>`;
        stepsHtml += `<p>For $x=1$:<br> $f(1) = ${evaluate(expr, 1).toFixed(4)}$<br> $f(-1) = ${evaluate(expr, -1).toFixed(4)}$</p>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps'), $('out-summary')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('func-input').value = 'x^2 + 4';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        navigator.clipboard.writeText(`The function ${$('func-input').value} is ${$('out-result').textContent}`);
    });
});
</script>

<style>
.odd-even-checker-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.odd-even-checker-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.odd-even-checker-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.odd-even-checker-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.odd-even-checker-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.btn-primary-action:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-secondary-action { background: #f1f5f9; color: #475569; border: none; border-radius: 14px; padding: 1rem; font-weight: 600; transition: all 0.2s; }

.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed var(--tool-color); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\function-odd-even-checker.blade.php ENDPATH**/ ?>