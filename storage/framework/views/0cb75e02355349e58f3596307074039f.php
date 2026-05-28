<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Input Data Set</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="5" placeholder="Enter numbers separated by commas, spaces, or new lines...&#10;e.g., 3, 13, 7, 5, 21, 23, 39">3, 13, 7, 5, 21, 23, 39</textarea>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="appendDemoData()">Sample Data</button>
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="clearData()">Clear</button>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-primary-stats flex-grow-1 py-3 fw-bold" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#10b981;box-shadow:0 4px 12px rgba(16,185,129,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Median
                        </button>
                        <button class="btn btn-outline-secondary px-4" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Statistical Median (x̃)</span>
                <div class="output-hero-value" id="res-median">0</div>
                <span class="output-hero-unit">Middle Value</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Count (n)</span>
                        <span class="value" id="res-count">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Minimum</span>
                        <span class="value" id="res-min">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Maximum</span>
                        <span class="value" id="res-max">0</span>
                    </div>
                </div>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-success"></i>How the Median was Found</h6>
                <div class="step-card mb-3">
                    <div class="step-header">Step 1: Sort the Data</div>
                    <div class="step-body">
                        <p>To find the median, we must first arrange the data in ascending order (smallest to largest):</p>
                        <div id="data-sorted" class="p-3 bg-white rounded border font-monospace small mb-2 overflow-auto" style="max-height: 100px;"></div>
                    </div>
                </div>
                <div class="step-card mb-3">
                    <div class="step-header">Step 2: Determine Position</div>
                    <div class="step-body" id="step-pos-body">
                        <p>Your dataset has <strong>n = 0</strong> values.</p>
                    </div>
                </div>
                <div class="step-card mb-3">
                    <div class="step-header">Step 3: Final Median Value</div>
                    <div class="step-body">
                        <div class="formula-block text-center py-3">
                            <span class="fs-4 mt-2 d-inline-block" id="step-final-formula">Median = 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Report
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

    function parseData() {
        return input.value.split(/[\s,;\n]+/).filter(x => x.trim() !== '' && !isNaN(x)).map(Number);
    }

    function calculate() {
        const data = parseData();
        if (data.length === 0) return;

        const sorted = [...data].sort((a, b) => a - b);
        const count = sorted.length;
        let median;
        let posText = '';

        if (count % 2 === 1) {
            const mid = Math.floor(count / 2);
            median = sorted[mid];
            posText = `Since the count is <strong>odd</strong> (n = ${count}), the median is the value at the middle position <strong>(${(count+1)/2})</strong>.`;
            $('step-final-formula').innerHTML = `Median = ${median}`;
        } else {
            const mid1 = (count / 2) - 1;
            const mid2 = count / 2;
            median = (sorted[mid1] + sorted[mid2]) / 2;
            posText = `Since the count is <strong>even</strong> (n = ${count}), the median is the average of the two middle values at positions <strong>${mid1+1}</strong> and <strong>${mid2+1}</strong>.`;
            $('step-final-formula').innerHTML = `Median = (${sorted[mid1]} + ${sorted[mid2]}) / 2 = ${median}`;
        }

        $('res-median').textContent = median.toLocaleString();
        $('res-count').textContent = count;
        $('res-min').textContent = sorted[0].toLocaleString();
        $('res-max').textContent = sorted[count-1].toLocaleString();
        $('data-sorted').textContent = sorted.join(', ');
        $('step-pos-body').innerHTML = `<p>${posText}</p>`;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-copy').addEventListener('click', function() {
        const text = `Median Report:\nMedian: ${$('res-median').textContent}\nCount: ${$('res-count').textContent}\nSorted: ${$('data-sorted').textContent}\n\nToolsHub Stats`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    window.appendDemoData = () => {
        const d = ["3, 13, 7, 5, 21, 23, 39", "1, 2, 3, 4, 5, 6", "10, 50, 100, 20"];
        input.value = d[Math.floor(Math.random()*d.length)];
        calculate();
    };
    window.clearData = () => { input.value = ''; resultsCard.style.display = 'none'; };
});
</script>

<style>
.stats-suite-rebuilt .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.stats-suite-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.stats-suite-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.stats-suite-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.stats-suite-rebuilt .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.stats-suite-rebuilt .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { background: #2563eb; color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-primary-stats:hover { transform: translateY(-2px); filter: brightness(1.1); }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; position: relative; }
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\median-calculator.blade.php ENDPATH**/ ?>