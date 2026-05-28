<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Differential Equation dy/dx = f(x, y)</label>
                        <input type="text" id="input-f" class="form-control form-control-lg font-monospace" value="x + y" placeholder="e.g. x + y, x^2 - y, sin(x)*y">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Initial x₀</label>
                        <input type="number" id="input-x0" class="form-control" value="0">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Initial y₀</label>
                        <input type="number" id="input-y0" class="form-control" value="1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Target xₙ</label>
                        <input type="number" id="input-xn" class="form-control" value="1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Step Size (h)</label>
                        <input type="number" id="input-h" class="form-control" value="0.2" step="0.1">
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#059669;box-shadow:0 4px 12px rgba(5,150,105,0.2)">
                            <i class="fas fa-play me-2"></i>Run Iterative Solver
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-example" style="min-width: 280px; max-width: 100%;">Example (y' = x + y)</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(5,150,105,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Final Solution y(xₙ)</span>
                <div class="output-hero-value" id="res-val">3.4365</div>
                <span class="output-hero-unit" id="res-steps">Total 5 Steps</span>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-table me-2 text-success"></i>Iteration Table (k₁, k₂, k₃, k₄)</h6>
                <div class="table-responsive rounded-4 border bg-white shadow-sm" style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-hover mb-0 small">
                        <thead class="bg-light sticky-top">
                            <tr>
                                <th>Step</th>
                                <th>xᵢ</th>
                                <th>yᵢ</th>
                                <th>k₁</th>
                                <th>k₂</th>
                                <th>k₃</th>
                                <th>k₄</th>
                                <th class="text-end">yᵢ₊₁</th>
                            </tr>
                        </thead>
                        <tbody id="iteration-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Iteration Data
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
        const formula = $('input-f').value;
        let x = parseFloat($('input-x0').value);
        let y = parseFloat($('input-y0').value);
        const xn = parseFloat($('input-xn').value);
        const h = parseFloat($('input-h').value);

        if (isNaN(x) || isNaN(y) || isNaN(xn) || isNaN(h) || h <= 0) return;

        const code = math.compile(formula);
        const f = (vx, vy) => code.evaluate({ x: vx, y: vy });

        let tableHtml = '';
        let step = 0;
        const maxSteps = 1000;

        while (x < xn && step < maxSteps) {
            const k1 = h * f(x, y);
            const k2 = h * f(x + h/2, y + k1/2);
            const k3 = h * f(x + h/2, y + k2/2);
            const k4 = h * f(x + h, y + k3);
            
            const y_next = y + (k1 + 2*k2 + 2*k3 + k4) / 6;
            
            tableHtml += `
                <tr>
                    <td>${step + 1}</td>
                    <td class="font-monospace">${x.toFixed(4)}</td>
                    <td class="font-monospace">${y.toFixed(6)}</td>
                    <td>${k1.toFixed(6)}</td>
                    <td>${k2.toFixed(6)}</td>
                    <td>${k3.toFixed(6)}</td>
                    <td>${k4.toFixed(6)}</td>
                    <td class="text-end fw-bold">${y_next.toFixed(6)}</td>
                </tr>
            `;

            y = y_next;
            x += h;
            step++;
        }

        $('res-val').textContent = y.toFixed(8);
        $('res-steps').textContent = `Total ${step} Steps`;
        $('iteration-table').innerHTML = tableHtml;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => { location.reload(); });
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
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\runge-kutta-rk4-method.blade.php ENDPATH**/ ?>