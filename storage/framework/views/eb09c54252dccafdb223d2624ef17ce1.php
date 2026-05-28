<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Coefficient Sequence aₙ (Function of n)</label>
                        <input type="text" id="input-an" class="form-control form-control-lg font-monospace" value="1/n" placeholder="e.g. 1/n, 1/factorial(n), 3^n / n^2">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Center of Convergence (c)</label>
                        <input type="number" id="input-c" class="form-control" value="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Convergence Test Limit (N)</label>
                        <input type="number" id="input-n" class="form-control" value="1000">
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#6366f1;box-shadow:0 4px 12px rgba(99,102,241,0.2)">
                            <i class="fas fa-search me-2"></i>Calculate Radius R
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-exp" style="min-width: 280px; max-width: 100%;">Exponential (1/n!)</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-geo" style="min-width: 280px; max-width: 100%;">Geometric (3^n)</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Radius of Convergence (R)</span>
                <div class="output-hero-value" id="res-r">1.0000</div>
                <span class="output-hero-unit" id="res-desc">Series converges for |x-c| < R</span>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Interval of Convergence</span>
                        <span class="value" id="res-interval">(-1, 1)</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Ratio Limit L = |aₙ₊₁/aₙ|</span>
                        <span class="value" id="res-limit">1.0000</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-indigo"></i>Numerical Analysis (at n=N)</h6>
                <div class="table-responsive rounded-3 border bg-white">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr><th>n</th><th>aₙ</th><th>Ratio |aₙ₊₁ / aₙ|</th></tr>
                        </thead>
                        <tbody id="analysis-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Series Data
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    function calculate() {
        const formula = $('input-an').value;
        const c = parseFloat($('input-c').value);
        const N = parseInt($('input-n').value);

        const code = math.compile(formula);
        const evalAn = n => code.evaluate({ n: n });

        let tableHtml = '';
        let lastRatio = 0;

        try {
            for (let i = N - 5; i <= N; i++) {
                const an = evalAn(i);
                const an_next = evalAn(i + 1);
                const ratio = Math.abs(an_next / an);
                lastRatio = ratio;
                tableHtml += `<tr><td>${i}</td><td>${an.toExponential(4)}</td><td>${ratio.toFixed(6)}</td></tr>`;
            }
        } catch (e) {
            alert("Error evaluating formula. Ensure it uses 'n' as variable.");
            return;
        }

        // R = 1 / L
        let R, intervalStr;
        if (lastRatio === 0) {
            R = Infinity;
            intervalStr = "(-∞, ∞)";
        } else if (!isFinite(lastRatio) || isNaN(lastRatio)) {
            R = 0;
            intervalStr = `x = ${c}`;
        } else {
            R = 1 / lastRatio;
            intervalStr = `(${ (c - R).toFixed(2) }, ${ (c + R).toFixed(2) })`;
        }

        $('res-r').textContent = isFinite(R) ? R.toFixed(6) : "∞";
        $('res-limit').textContent = lastRatio.toFixed(6);
        $('res-interval').textContent = intervalStr;
        $('analysis-table').innerHTML = tableHtml;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-exp').addEventListener('click', () => { $('input-an').value = "1/factorial(n)"; calculate(); });
    $('btn-geo').addEventListener('click', () => { $('input-an').value = "3^n"; calculate(); });
});
</script>

<style>
.math-suite-modernized .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.math-suite-modernized .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.math-suite-modernized .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.math-suite-modernized .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.math-suite-modernized .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.math-suite-modernized .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\radius-of-convergence.blade.php ENDPATH**/ ?>