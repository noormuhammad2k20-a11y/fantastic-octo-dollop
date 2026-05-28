<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Function f(x)</label>
                        <input type="text" id="input-func" class="form-control form-control-lg font-monospace" value="x^2" placeholder="e.g. x^2, sin(x), exp(x)">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">At Point x₀</label>
                        <input type="number" id="input-x0" class="form-control" value="1" step="0.1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Derivative Step Size (h)</label>
                        <input type="number" id="input-h" class="form-control" value="0.0001" step="0.0001">
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#ef4444;box-shadow:0 4px 12px rgba(239,68,68,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Curvature
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-circle" style="min-width: 280px; max-width: 100%;">Circle (r=1)</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-reset" style="min-width: 280px; max-width: 100%;">Reset All</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Curvature (κ)</span>
                <div class="output-hero-value" id="res-kappa">0.1789</div>
                <span class="output-hero-unit">1 / Length Unit</span>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Radius of Curvature (ρ)</span>
                        <span class="value" id="res-rho">5.5902</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Osculating Center</span>
                        <span class="value" id="res-center">(-4, 3.5)</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-danger"></i>Step-by-Step Derivatives</h6>
                <div class="table-responsive rounded-3 border bg-white">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr><th>Order</th><th>Description</th><th class="text-end">Value</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>f(x₀)</td><td>Value at point</td><td class="text-end fw-bold" id="res-f0">0</td></tr>
                            <tr><td>f'(x₀)</td><td>First Derivative (Slope)</td><td class="text-end fw-bold" id="res-f1">0</td></tr>
                            <tr><td>f''(x₀)</td><td>Second Derivative</td><td class="text-end fw-bold" id="res-f2">0</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Geometric Data
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
        const funcStr = $('input-func').value;
        const x0 = parseFloat($('input-x0').value);
        const h = parseFloat($('input-h').value);

        if (isNaN(x0) || isNaN(h)) return;

        const code = math.compile(funcStr);
        const f = x => code.evaluate({ x: x });

        // Central difference for derivatives
        const f0 = f(x0);
        const f1 = (f(x0 + h) - f(x0 - h)) / (2 * h);
        const f2 = (f(x0 + h) - 2 * f(x0) + f(x0 - h)) / (h * h);

        const kappa = Math.abs(f2) / Math.pow(1 + f1 * f1, 1.5);
        const rho = 1 / kappa;

        // Osculating Center
        const cx = x0 - (f1 * (1 + f1 * f1)) / f2;
        const cy = f0 + (1 + f1 * f1) / f2;

        $('res-kappa').textContent = kappa.toFixed(6);
        $('res-rho').textContent = isFinite(rho) ? rho.toFixed(6) : "∞";
        $('res-center').textContent = `(${cx.toFixed(3)}, ${cy.toFixed(3)})`;
        $('res-f0').textContent = f0.toFixed(6);
        $('res-f1').textContent = f1.toFixed(6);
        $('res-f2').textContent = f2.toFixed(6);

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-circle').addEventListener('click', () => { $('input-func').value = "sqrt(1 - x^2)"; $('input-x0').value = 0; calculate(); });
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\curvature-calculator.blade.php ENDPATH**/ ?>