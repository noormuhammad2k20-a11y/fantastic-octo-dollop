<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Functions f₁(x), f₂(x), ... (Comma Separated)</label>
                        <textarea id="input-funcs" class="form-control form-control-lg font-monospace" rows="3" placeholder="e.g. x, x^2, exp(x)">x, x^2, x^3</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Evaluation Point (x₀)</label>
                        <input type="number" id="input-x0" class="form-control" value="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Numerical Precision (h)</label>
                        <input type="number" id="input-h" class="form-control" value="0.001" step="0.001">
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#d946ef;box-shadow:0 4px 12px rgba(217,70,239,0.2)">
                            <i class="fas fa-play me-2"></i>Compute Wronskian
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-load-linear" style="min-width: 280px; max-width: 100%;">Load Independent {x, x^2}</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:300;--tool-color:#d946ef;--tool-bg:rgba(217,70,239,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Wronskian Determinant W(x₀)</span>
                <div class="output-hero-value" id="res-val">2.0000</div>
                <span class="output-hero-unit" id="res-status">Linearly Independent</span>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-table me-2 text-pink"></i>Derivative Matrix (Wronskian Matrix)</h6>
                <div class="table-responsive rounded-4 border bg-white shadow-sm">
                    <table class="table table-bordered table-hover mb-0 text-center font-monospace">
                        <tbody id="matrix-body"></tbody>
                    </table>
                </div>
                <p class="small text-muted mt-2">Matrix shows values evaluated at x = <span id="res-x0">1</span></p>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Wronskian Data
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
        const funcsInput = $('input-funcs').value.split(',').map(s => s.trim()).filter(s => s !== '');
        const x0 = parseFloat($('input-x0').value);
        const h = parseFloat($('input-h').value);
        
        if (funcsInput.length === 0) return;
        const n = funcsInput.length;

        // Generate derivatives matrix numerically
        const matrix = [];
        for (let i = 0; i < n; i++) {
            matrix[i] = [];
            const funcStr = funcsInput[i];
            const code = math.compile(funcStr);
            
            // Numerical derivatives for simplicity across all function types
            // i-th derivative of j-th function
            for (let j = 0; j < n; j++) {
                // We need the j-th derivative of func[i]
                // Wait, j is row (derivative order), i is col (function)
            }
        }

        // Re-align: rows = derivative order (0 to n-1), cols = functions
        const finalMatrix = [];
        for (let row = 0; row < n; row++) {
            finalMatrix[row] = [];
            for (let col = 0; col < n; col++) {
                const funcStr = funcsInput[col];
                // Evaluate j-th derivative of func[i] at x0
                finalMatrix[row][col] = getNumericalDerivative(funcStr, x0, row, h);
            }
        }

        const determinant = math.det(finalMatrix);

        $('res-val').textContent = determinant.toFixed(6);
        $('res-status').textContent = Math.abs(determinant) > 1e-10 ? "Linearly Independent" : "Possibly Linearly Dependent";
        $('res-x0').textContent = x0;

        let matrixHtml = '';
        for (let r = 0; r < n; r++) {
            matrixHtml += '<tr>' + finalMatrix[r].map(v => `<td>${v.toFixed(4)}</td>`).join('') + '</tr>';
        }
        $('matrix-body').innerHTML = matrixHtml;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function getNumericalDerivative(funcStr, x, order, h) {
        const code = math.compile(funcStr);
        const f = vx => code.evaluate({ x: vx });

        if (order === 0) return f(x);
        if (order === 1) return (f(x + h) - f(x - h)) / (2 * h);
        if (order === 2) return (f(x + h) - 2 * f(x) + f(x - h)) / (h * h);
        
        // High-order numerical derivatives (finite difference coefficients)
        // For simplicity, we can use recursive central difference
        return (getNumericalDerivative(funcStr, x + h, order - 1, h) - getNumericalDerivative(funcStr, x - h, order - 1, h)) / (2 * h);
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-load-linear').addEventListener('click', () => { $('input-funcs').value = "x, x^2"; calculate(); });
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

