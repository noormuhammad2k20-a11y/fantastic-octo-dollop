<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-custom">Input Data Set</label>
                        <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="5" placeholder="Enter numbers...&#10;e.g., 4, 8, 15, 16, 23, 42">4, 8, 15, 16, 23, 42</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-primary-stats flex-grow-1 py-3 fw-bold" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#6366f1;box-shadow:0 4px 12px rgba(99,102,241,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Range
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
        <div id="results-card" class="output-card-themed" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Statistical Range (R)</span>
                <div class="output-hero-value" id="res-range">0</div>
                <span class="output-hero-unit">Maximum Spread</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Minimum (Low)</span>
                        <span class="value" id="res-min">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Maximum (High)</span>
                        <span class="value" id="res-max">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-pill">
                        <span class="label">Count (n)</span>
                        <span class="value" id="res-count">0</span>
                    </div>
                </div>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-indigo"></i>Step-by-Step Solution</h6>
                <div class="step-card mb-3">
                    <div class="step-header">Step 1: Identify Extrema</div>
                    <div class="step-body">
                        <p>Scanning the dataset for the lowest and highest values:</p>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-arrow-down text-danger me-2"></i>Minimum: <strong id="step-min">0</strong></li>
                            <li><i class="fas fa-arrow-up text-success me-2"></i>Maximum: <strong id="step-max">0</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="step-card mb-3">
                    <div class="step-header">Step 2: Subtraction</div>
                    <div class="step-body">
                        <p>The range is calculated by subtracting the minimum from the maximum:</p>
                        <div class="formula-block text-center py-3">
                            <span class="fs-4 mt-2 d-inline-block" id="step-formula">Range = Max - Min = 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Results
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
        if (data.length < 1) return;

        const min = Math.min(...data);
        const max = Math.max(...data);
        const range = max - min;

        $('res-range').textContent = range.toLocaleString();
        $('res-min').textContent = min.toLocaleString();
        $('res-max').textContent = max.toLocaleString();
        $('res-count').textContent = data.length;

        $('step-min').textContent = min;
        $('step-max').textContent = max;
        $('step-formula').textContent = `Range = ${max} - ${min} = ${range}`;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => { input.value = ''; resultsCard.style.display = 'none'; });
    $('btn-copy').addEventListener('click', function() {
        const text = `Range Report:\nRange: ${$('res-range').textContent}\nMin: ${$('res-min').textContent}\nMax: ${$('res-max').textContent}\nToolsHub Stats`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\range-calculator.blade.php ENDPATH**/ ?>