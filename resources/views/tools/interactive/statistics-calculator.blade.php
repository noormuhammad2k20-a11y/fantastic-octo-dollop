<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Dataset Input</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="5" placeholder="Enter numbers...&#10;e.g. 15, 24, 18, 30, 42, 11, 28">15, 24, 18, 30, 42, 11, 28</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#2563eb;box-shadow:0 4px 12px rgba(37,99,235,0.2)">
                            <i class="fas fa-play me-2"></i>Generate Comprehensive Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(37,99,235,.04); display: none;">
            <div class="output-hero mb-5">
                <span class="output-hero-label">Summary Statistics</span>
                <div class="row g-4 mt-2">
                    <div class="col-md-4 border-end">
                        <div class="label small text-muted">MEAN (x̄)</div>
                        <div class="value fs-2 fw-bold" id="res-mean">0</div>
                    </div>
                    <div class="col-md-4 border-end">
                        <div class="label small text-muted">MEDIAN</div>
                        <div class="value fs-2 fw-bold" id="res-median">0</div>
                    </div>
                    <div class="col-md-4">
                        <div class="label small text-muted">STD DEV (σ)</div>
                        <div class="value fs-2 fw-bold" id="res-std">0</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-4"><i class="fas fa-table me-2 text-primary"></i>Complete Dataset Metrics</h6>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr><td class="ps-4 fw-bold">Sample Size (n)</td><td id="res-n">0</td></tr>
                            <tr><td class="ps-4 fw-bold">Sum (Σx)</td><td id="res-sum">0</td></tr>
                            <tr><td class="ps-4 fw-bold">Mode</td><td id="res-mode">0</td></tr>
                            <tr><td class="ps-4 fw-bold">Range</td><td id="res-range">0</td></tr>
                            <tr><td class="ps-4 fw-bold">Variance (s²)</td><td id="res-var">0</td></tr>
                            <tr><td class="ps-4 fw-bold">IQR</td><td id="res-iqr">0</td></tr>
                            <tr><td class="ps-4 fw-bold">Five-Number Summary</td><td id="res-5num">0, 0, 0, 0, 0</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Statistics
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
        const data = $('data-input').value.split(/[\s,;\n]+/).filter(v => v.trim() !== '' && !isNaN(v)).map(Number).sort((a,b) => a-b);
        if (data.length === 0) return;

        const mean = math.mean(data);
        const median = math.median(data);
        const std = math.std(data);
        const variance = math.var(data);
        const sum = math.sum(data);
        const min = data[0];
        const max = data[data.length-1];
        const q1 = math.quantileSeq(data, 0.25);
        const q3 = math.quantileSeq(data, 0.75);

        // Mode calculation
        const freq = {}; data.forEach(x => freq[x] = (freq[x] || 0) + 1);
        let maxF = 0; Object.values(freq).forEach(f => { if(f > maxF) maxF = f; });
        const modes = Object.keys(freq).filter(x => freq[x] === maxF);

        $('res-mean').textContent = mean.toFixed(2);
        $('res-median').textContent = median.toFixed(2);
        $('res-std').textContent = std.toFixed(2);
        $('res-n').textContent = data.length;
        $('res-sum').textContent = sum.toLocaleString();
        $('res-mode').textContent = maxF > 1 ? modes.join(', ') : "None";
        $('res-range').textContent = (max - min).toLocaleString();
        $('res-var').textContent = variance.toFixed(4);
        $('res-iqr').textContent = (q3 - q1).toFixed(2);
        $('res-5num').textContent = `${min}, ${q1.toFixed(1)}, ${median}, ${q3.toFixed(1)}, ${max}`;

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
.output-hero { background: #fff; border-radius: 20px; border: 1px solid #f1f5f9; padding: 2rem; }
.table td { padding: 1rem; }
</style>

