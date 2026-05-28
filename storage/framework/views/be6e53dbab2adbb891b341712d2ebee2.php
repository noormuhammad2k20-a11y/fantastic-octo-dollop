<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">X Values (Independent)</label>
                        <textarea id="input-x" class="form-control form-control-lg font-monospace" rows="5" placeholder="e.g. 1, 2, 3, 4, 5">1, 2, 3, 4, 5</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Y Values (Dependent)</label>
                        <textarea id="input-y" class="form-control form-control-lg font-monospace" rows="5" placeholder="e.g. 2, 4, 5, 4, 5">2, 4, 5, 4, 5</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#14b8a6;box-shadow:0 4px 12px rgba(20,184,166,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Regression
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:170;--tool-color:#14b8a6;--tool-bg:rgba(20,184,166,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Regression Equation</span>
                <div class="output-hero-value" id="res-eq" style="font-size: 2.5rem;">y = 0.6x + 2.2</div>
                <span class="output-hero-unit">Least Squares Method</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Correlation (r)</span>
                        <span class="value" id="res-r">0.00</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">R-Squared (r²)</span>
                        <span class="value" id="res-r2">0.00</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Sample Size (n)</span>
                        <span class="value" id="res-n">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-teal"></i>Detailed Statistics</h6>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr><td class="ps-4 fw-bold">Slope (m)</td><td id="res-slope">0</td></tr>
                            <tr><td class="ps-4 fw-bold">Y-Intercept (b)</td><td id="res-intercept">0</td></tr>
                            <tr><td class="ps-4 fw-bold">Sum of X (ΣX)</td><td id="res-sumx">0</td></tr>
                            <tr><td class="ps-4 fw-bold">Sum of Y (ΣY)</td><td id="res-sumy">0</td></tr>
                            <tr><td class="ps-4 fw-bold">Sum of XY (ΣXY)</td><td id="res-sumxy">0</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Equation
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
        const x = $('input-x').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number);
        const y = $('input-y').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number);

        if (x.length !== y.length || x.length < 2) {
            alert('X and Y datasets must have the same number of values (at least 2).');
            return;
        }

        const n = x.length;
        const sumX = math.sum(x);
        const sumY = math.sum(y);
        const sumXY = x.reduce((acc, val, i) => acc + (val * y[i]), 0);
        const sumX2 = x.reduce((acc, val) => acc + (val * val), 0);
        const sumY2 = y.reduce((acc, val) => acc + (val * val), 0);

        const slope = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
        const intercept = (sumY - slope * sumX) / n;

        // Correlation Coefficient (Pearson r)
        const r = (n * sumXY - sumX * sumY) / Math.sqrt((n * sumX2 - sumX * sumX) * (n * sumY2 - sumY * sumY));
        const r2 = r * r;

        $('res-eq').textContent = `y = ${slope.toFixed(4)}x ${intercept >= 0 ? '+' : ''} ${intercept.toFixed(4)}`;
        $('res-slope').textContent = slope.toFixed(6);
        $('res-intercept').textContent = intercept.toFixed(6);
        $('res-r').textContent = r.toFixed(4);
        $('res-r2').textContent = r2.toFixed(4);
        $('res-n').textContent = n;
        $('res-sumx').textContent = sumX.toLocaleString();
        $('res-sumy').textContent = sumY.toLocaleString();
        $('res-sumxy').textContent = sumXY.toLocaleString();

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
});
</script>

<style>
.stats-suite-rebuilt .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.stats-suite-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.stats-suite-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.stats-suite-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.stats-suite-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.stats-suite-rebuilt .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
.stat-pill .label { font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; }
.stat-pill .value { font-size: 1.4rem; font-weight: 800; color: #0f172a; }
.table td { padding: 1rem; border-color: #f1f5f9; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\linear-regression-calculator.blade.php ENDPATH**/ ?>