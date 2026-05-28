<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Input Value (x)</label>
                        <input type="number" id="input-x" class="form-control form-control-lg" value="1.0" step="0.1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Error Tolerance (ϵ)</label>
                        <select id="input-eps" class="form-select form-select-lg">
                            <option value="1e-7">10⁻⁷ (Standard)</option>
                            <option value="1e-10">10⁻¹⁰ (High Precision)</option>
                            <option value="1e-15">10⁻¹⁵ (Scientific)</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-6">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#2563eb;box-shadow:0 4px 12px rgba(37,99,235,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate erfc(x)
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn d-block mx-auto btn-outline-secondary py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-redo me-2"></i>Reset Fields
                        </button>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border px-3" id="btn-load-zero" style="min-width: 280px; max-width: 100%;">x = 0</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border px-3" id="btn-load-one" style="min-width: 280px; max-width: 100%;">x = 1</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border px-3" id="btn-load-two" style="min-width: 280px; max-width: 100%;">x = 2</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border px-3" id="btn-copy-input" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy Input</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(37,99,235,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Result: erfc(x)</span>
                <div class="output-hero-value" id="res-val">0.1572992</div>
                <span class="output-hero-unit">Probability Complement</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Error Function erf(x)</span>
                        <span class="value" id="res-erf">0.8427008</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Normal Distribution Q(x)</span>
                        <span class="value" id="res-q">0.1586553</span>
                    </div>
                </div>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-primary"></i>Mathematical Approximation</h6>
                <div class="formula-card mb-4 p-4 rounded-4 bg-dark text-light font-monospace">
                    erfc(x) = 1 - erf(x)<br>
                    erf(x) ≈ 1 - (a₁t + a₂t² + a₃t³ + a₄t⁴ + a₅t⁵)e^(-x²)<br>
                    where t = 1 / (1 + px)
                </div>
                <div class="table-responsive rounded-3 border bg-white">
                    <table class="table table-hover mb-0 small text-center">
                        <thead class="bg-light">
                            <tr><th>Parameter</th><th>Value (Approximation)</th></tr>
                        </thead>
                        <tbody id="params-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Full Result
                </button>
                <button class="btn btn-outline-dark px-4 py-3 rounded-3" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Print Report
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    function erf_approx(x) {
        const a1 =  0.254829592;
        const a2 = -0.284496736;
        const a3 =  1.421413741;
        const a4 = -1.453152027;
        const a5 =  1.061405429;
        const p  =  0.3275911;
        const sign = (x < 0) ? -1 : 1;
        x = Math.abs(x);
        const t = 1.0 / (1.0 + p * x);
        const y = 1.0 - (((((a5 * t + a4) * t) + a3) * t + a2) * t + a1) * t * Math.exp(-x * x);
        return sign * y;
    }

    function calculate() {
        const x = parseFloat($('input-x').value);
        if (isNaN(x)) {
            alert("Please enter a valid numeric value for x.");
            return;
        }

        const erfVal = erf_approx(x);
        const erfcVal = 1 - erfVal;
        
        // Q-function: Q(x) = 0.5 * erfc(x / sqrt(2))
        const qVal = 0.5 * (1 - erf_approx(x / Math.sqrt(2)));

        $('res-val').textContent = erfcVal.toFixed(12);
        $('res-erf').textContent = erfVal.toFixed(12);
        $('res-q').textContent = qVal.toFixed(12);

        $('params-table').innerHTML = `
            <tr><td>Input (x)</td><td class="font-monospace">${x}</td></tr>
            <tr><td>exp(-x²)</td><td class="font-monospace">${Math.exp(-x*x).toExponential(6)}</td></tr>
            <tr><td>t (1/(1+px))</td><td class="font-monospace">${(1/(1+0.3275911*Math.abs(x))).toFixed(8)}</td></tr>
            <tr><td>Approximation Error</td><td class="font-monospace">< 1.5 × 10⁻⁷</td></tr>
        `;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    
    $('btn-reset').addEventListener('click', () => { 
        $('input-x').value = 1; 
        resultsCard.style.display = 'none'; 
    });

    $('btn-load-zero').addEventListener('click', () => { $('input-x').value = 0; calculate(); });
    $('btn-load-one').addEventListener('click', () => { $('input-x').value = 1; calculate(); });
    $('btn-load-two').addEventListener('click', () => { $('input-x').value = 2; calculate(); });

    $('btn-copy-input').addEventListener('click', () => {
        navigator.clipboard.writeText($('input-x').value);
        const originalText = $('btn-copy-input').innerHTML;
        $('btn-copy-input').innerHTML = '<i class="fas fa-check me-1"></i>Copied';
        setTimeout(() => $('btn-copy-input').innerHTML = originalText, 1500);
    });

    $('btn-copy').addEventListener('click', () => {
        const text = `erfc(${ $('input-x').value }) = ${ $('res-val').textContent }\nerf(x) = ${ $('res-erf').textContent }\nQ(x) = ${ $('res-q').textContent }`;
        navigator.clipboard.writeText(text);
        const originalText = $('btn-copy').innerHTML;
        $('btn-copy').innerHTML = '<i class="fas fa-check me-2"></i>Copied Results';
        setTimeout(() => $('btn-copy').innerHTML = originalText, 1500);
    });
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
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; word-break: break-all; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
.formula-card { text-align: center; line-height: 1.8; }
</style>

