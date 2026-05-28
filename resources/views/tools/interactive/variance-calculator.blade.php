<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Input Data Set</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="5" placeholder="Enter numbers...&#10;e.g., 10, 12, 23, 23, 16, 23, 21, 16">10, 12, 23, 23, 16, 23, 21, 16</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Data Type</label>
                        <select id="data-type" class="form-select form-select-lg">
                            <option value="sample">Sample (n-1)</option>
                            <option value="population">Population (N)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Decimal Precision</label>
                        <select id="data-precision" class="form-select form-select-lg">
                            <option value="2">2 Decimal Places</option>
                            <option value="4">4 Decimal Places</option>
                            <option value="max">Maximum</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-primary-stats flex-grow-1 py-3 fw-bold" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#dc2626;box-shadow:0 4px 12px rgba(220,38,38,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Variance
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(220,38,38,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Statistical Variance (s² or σ²)</span>
                <div class="output-hero-value" id="res-variance">0</div>
                <span class="output-hero-unit" id="res-type-label">Sample Variance</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Standard Deviation</span>
                        <span class="value" id="res-std">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Mean (x̄)</span>
                        <span class="value" id="res-mean">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Sum of Squares</span>
                        <span class="value" id="res-ss">0</span>
                    </div>
                </div>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-danger"></i>Mathematical Breakdown</h6>
                <div class="step-card mb-3">
                    <div class="step-header">Step 1: Calculate the Mean</div>
                    <div class="step-body">
                        <p id="step-mean-text">Mean (x̄) = Sum / Count = 0</p>
                    </div>
                </div>
                <div class="step-card mb-3">
                    <div class="step-header">Step 2: Calculate Squares of Deviations</div>
                    <div class="step-body">
                        <p>For each number, we subtract the mean and square the result (x - x̄)²:</p>
                        <div id="step-deviations" class="p-3 bg-white rounded border font-monospace small overflow-auto" style="max-height: 150px;"></div>
                    </div>
                </div>
                <div class="step-card mb-3">
                    <div class="step-header" id="step-final-header">Step 3: Average the Squared Deviations</div>
                    <div class="step-body">
                        <div class="formula-block text-center py-3">
                            <span class="fs-5" id="step-formula-text">s² = Σ(x - x̄)² / (n - 1)</span><br>
                            <span class="fs-4 mt-2 d-inline-block" id="step-final-calc">0 / 0 = 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Full Report
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const input = $('data-input');
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    function calculate() {
        const data = input.value.split(/[\s,;\n]+/).filter(x => x.trim() !== '' && !isNaN(x)).map(Number);
        if (data.length < 2) {
            alert('Variance requires at least 2 data points.');
            return;
        }

        const isSample = $('data-type').value === 'sample';
        const precision = $('data-precision').value;
        const fmt = (v) => precision === 'max' ? v : Number(v.toFixed(parseInt(precision)));

        const n = data.length;
        const mean = math.mean(data);
        const deviations = data.map(x => Math.pow(x - mean, 2));
        const sumOfSquares = math.sum(deviations);
        
        const variance = isSample ? sumOfSquares / (n - 1) : sumOfSquares / n;
        const std = Math.sqrt(variance);

        $('res-variance').textContent = fmt(variance).toLocaleString();
        $('res-std').textContent = fmt(std).toLocaleString();
        $('res-mean').textContent = fmt(mean).toLocaleString();
        $('res-ss').textContent = fmt(sumOfSquares).toLocaleString();
        $('res-type-label').textContent = isSample ? "Sample Variance" : "Population Variance";

        // Step by Step
        $('step-mean-text').innerHTML = `Mean (x̄) = ${math.sum(data)} / ${n} = <strong>${fmt(mean)}</strong>`;
        $('step-deviations').innerHTML = data.map((x, i) => `(${x} - ${fmt(mean)})² = ${fmt(deviations[i])}`).join('<br>');
        
        if (isSample) {
            $('step-formula-text').textContent = "s² = Σ(x - x̄)² / (n - 1)";
            $('step-final-calc').textContent = `s² = ${fmt(sumOfSquares)} / (${n} - 1) = ${fmt(variance)}`;
        } else {
            $('step-formula-text').textContent = "σ² = Σ(x - x̄)² / n";
            $('step-final-calc').textContent = `σ² = ${fmt(sumOfSquares)} / ${n} = ${fmt(variance)}`;
        }

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-copy').addEventListener('click', function() {
        const text = `Variance Report:\nVariance: ${$('res-variance').textContent}\nMean: ${$('res-mean').textContent}\nType: ${$('res-type-label').textContent}\nToolsHub Statistics`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
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
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
.stat-pill .label { font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; }
.stat-pill .value { font-size: 1.4rem; font-weight: 800; color: #0f172a; }
.step-card { background: #f8fafc; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden; }
.step-header { background: #fff; padding: 1rem 1.5rem; font-weight: 700; border-bottom: 1px solid #f1f5f9; }
.step-body { padding: 1.5rem; }
.formula-block { background: #0f172a; color: #e2e8f0; padding: 1.5rem; border-radius: 12px; font-family: monospace; }
</style>

