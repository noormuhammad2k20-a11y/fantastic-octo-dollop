<div class="row g-4 gamma-func-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Input Value (z)</label>
                        <input type="number" id="gamma-z" class="form-control form-control-lg rounded-3" value="5.5" step="any">
                        <div class="form-text mt-2">The Gamma function is defined by $\Gamma(z) = \int_0^\infty t^{z-1} e^{-t} dt$. For integers $n > 0$, $\Gamma(n) = (n-1)!$.</div>
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
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Gamma Value Γ(z)</span>
                <div class="output-hero-value" id="out-gamma">0</div>
                <span class="output-hero-unit" id="out-formula">Gamma of 5.5</span>
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

    // Lanczos approximation for Gamma function
    function gamma(z) {
        const g = 7;
        const p = [
            0.99999999999980993, 676.5203681218851, -1259.1392167224028,
            771.32342877765313, -176.61502916214059, 12.507343278686905,
            -0.13857109526572012, 9.9843695780195716e-6, 1.5056327351493116e-7
        ];

        if (z < 0.5) {
            return Math.PI / (Math.sin(Math.PI * z) * gamma(1 - z));
        }

        z -= 1;
        let x = p[0];
        for (let i = 1; i < g + 2; i++) {
            x += p[i] / (z + i);
        }
        let t = z + g + 0.5;
        return Math.sqrt(2 * Math.PI) * Math.pow(t, (z + 0.5)) * Math.exp(-t) * x;
    }

    function calculate() {
        const z = parseFloat($('gamma-z').value);
        if (isNaN(z)) return;

        if (z <= 0 && Number.isInteger(z)) {
            $('out-gamma').textContent = 'Undefined';
            $('out-formula').textContent = 'Gamma is not defined for non-positive integers.';
            $('math-steps').innerHTML = '<p>The Gamma function has poles at non-positive integers ($0, -1, -2, \dots$).</p>';
            $('output-section').style.display = 'block';
            return;
        }

        const res = gamma(z);
        
        $('out-gamma').textContent = (Math.abs(res) > 1e15 || Math.abs(res) < 1e-7 && res !== 0) 
            ? res.toExponential(8) 
            : res.toLocaleString(undefined, {maximumFractionDigits: 8});
            
        $('out-formula').textContent = `Result for Γ(${z})`;

        let stepsHtml = `<p>The Gamma function $\\Gamma(z)$ is calculated using the Lanczos approximation:</p>`;
        stepsHtml += `<p class="text-center my-3 fs-5">$\\Gamma(${z}) \\approx ${res.toFixed(8)}$</p>`;
        stepsHtml += `<div class="p-3 bg-light rounded-3 mb-3">`;
        
        if (Number.isInteger(z) && z > 0) {
            stepsHtml += `<p><b>Integer Relation:</b> Since ${z} is an integer, $\\Gamma(${z}) = (${z}-1)! = ${z-1}!$</p>`;
        } else if (Math.abs(z - 0.5) % 1 === 0) {
            stepsHtml += `<p><b>Half-Integer Relation:</b> This value involves $\\sqrt{\\pi}$.</p>`;
        }
        
        stepsHtml += `<p><b>Properties:</b> $\\Gamma(z+1) = z\\Gamma(z)$</p>`;
        stepsHtml += `</div>`;

        $('math-steps').innerHTML = stepsHtml;
        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (window.MathJax) MathJax.typesetPromise([$('math-steps')]);
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('gamma-z').value = '5.5';
        $('output-section').style.display = 'none';
    });

    $('btn-copy-results').addEventListener('click', function() {
        navigator.clipboard.writeText($('out-gamma').textContent).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

});
</script>

<style>
.gamma-func-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.gamma-func-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem; }
.gamma-func-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
.gamma-func-rebuilt .calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.gamma-func-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.gamma-func-rebuilt .form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.6rem; display: block; }

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
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(139,92,246,0.2); }
.output-hero-label { display: block; font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 0.5rem; word-break: break-all; }
.output-hero-unit { font-size: 1rem; color: #64748b; font-weight: 500; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/gamma-function-calculator.blade.php ENDPATH**/ ?>