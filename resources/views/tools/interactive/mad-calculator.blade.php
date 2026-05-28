<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Dataset Input (Comma or Space Separated)</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="5" placeholder="e.g. 10, 15, 12, 100, 11, 14">10, 15, 12, 100, 11, 14</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#6366f1;box-shadow:0 4px 12px rgba(99,102,241,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Robust Spread
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04); display: none;">
            <div class="output-hero mb-5">
                <span class="output-hero-label">Median Absolute Deviation (MAD)</span>
                <div class="output-hero-value" id="res-mad">0.00</div>
                <span class="output-hero-unit" id="res-comparison">Standard Deviation would be much higher</span>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Median (x̃)</span>
                        <span class="value" id="res-median">0.00</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Mean (x̄)</span>
                        <span class="value" id="res-mean">0.00</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Sample Size (n)</span>
                        <span class="value" id="res-n">0</span>
                    </div>
                </div>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-indigo"></i>Step-by-Step Robust Analysis</h6>
                
                <div class="step-card mb-4">
                    <div class="step-header">1. Sort Data & Find Median</div>
                    <div class="step-body">
                        <div class="p-3 bg-light rounded-3 font-monospace mb-2" id="step-sort">Sorted: 10, 11, 12, 14, 15, 100</div>
                        <p class="mb-0">Median (x̃) = <strong id="step-median-val">13</strong></p>
                    </div>
                </div>

                <div class="step-card mb-4">
                    <div class="step-header">2. Calculate Absolute Deviations</div>
                    <div class="step-body">
                        <div class="small text-muted mb-2">Formula: |xᵢ - x̃|</div>
                        <div class="p-3 bg-light rounded-3 font-monospace" id="step-devs">3, 2, 1, 1, 2, 87</div>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-header">3. Find Median of Deviations (MAD)</div>
                    <div class="step-body">
                        <div class="p-3 bg-light rounded-3 font-monospace mb-2" id="step-devs-sort">Sorted Devs: 1, 1, 2, 2, 3, 87</div>
                        <p class="mb-0">MAD = Median of sorted deviations = <strong id="step-mad-val">2</strong></p>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Analysis
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
        const input = $('data-input').value;
        const data = input.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number);

        if (data.length < 2) {
            alert('Please enter at least 2 numbers.');
            return;
        }

        const sortedData = [...data].sort((a, b) => a - b);
        const median = math.median(sortedData);
        const mean = math.mean(data);
        const std = math.std(data);

        // Absolute Deviations
        const devs = data.map(x => Math.abs(x - median));
        const sortedDevs = [...devs].sort((a, b) => a - b);
        const mad = math.median(sortedDevs);

        $('res-mad').textContent = mad.toFixed(2);
        $('res-median').textContent = median.toFixed(2);
        $('res-mean').textContent = mean.toFixed(2);
        $('res-n').textContent = data.length;
        
        const ratio = std / mad;
        $('res-comparison').textContent = ratio > 2 ? `Outliers detected (Std Dev is ${ratio.toFixed(1)}x MAD)` : "Low outlier impact";

        // Step 1
        $('step-sort').textContent = `Sorted Data: ${sortedData.join(', ')}`;
        $('step-median-val').textContent = median;

        // Step 2
        $('step-devs').textContent = `Deviations: ${devs.map(d => d.toFixed(1)).join(', ')}`;

        // Step 3
        $('step-devs-sort').textContent = `Sorted Deviations: ${sortedDevs.join(', ')}`;
        $('step-mad-val').textContent = mad;

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
.output-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
.step-card { background: #f8fafc; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden; }
.step-header { background: #fff; padding: 1rem 1.5rem; font-weight: 700; border-bottom: 1px solid #f1f5f9; }
.step-body { padding: 1.5rem; }
</style>

