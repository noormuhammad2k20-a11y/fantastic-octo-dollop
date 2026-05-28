<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Raw Score (x)</label>
                        <input type="number" id="input-x" class="form-control form-control-lg" value="85">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Population Mean (μ)</label>
                        <input type="number" id="input-mean" class="form-control form-control-lg" value="70">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Std. Deviation (σ)</label>
                        <input type="number" id="input-sd" class="form-control form-control-lg" value="10">
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#10b981;box-shadow:0 4px 12px rgba(16,185,129,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Standard Score
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Standard Score (z)</span>
                <div class="output-hero-value" id="res-z">1.50</div>
                <span class="output-hero-unit" id="res-percentile">93.32nd Percentile</span>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-success"></i>Calculation Breakdown</h6>
                <div class="formula-card p-4 rounded-4 bg-dark text-light font-monospace text-center fs-4 mb-4">
                    z = (x - μ) / σ
                </div>
                <div class="step-card mb-3 p-4 bg-light rounded-4 border">
                    <div class="fw-bold fs-5" id="step-formula">z = (85 - 70) / 10 = 1.5</div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstat/1.9.6/jstat.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    function calculate() {
        const x = parseFloat($('input-x').value);
        const mean = parseFloat($('input-mean').value);
        const sd = parseFloat($('input-sd').value);

        if (isNaN(x) || isNaN(mean) || isNaN(sd) || sd === 0) {
            alert('Please enter valid numbers. Standard deviation cannot be zero.');
            return;
        }

        const z = (x - mean) / sd;
        const percentile = jStat.normal.cdf(z, 0, 1) * 100;

        $('res-z').textContent = z.toFixed(4);
        $('res-percentile').textContent = `${percentile.toFixed(2)}${getOrdinal(Math.round(percentile))} Percentile`;
        $('step-formula').textContent = `z = (${x} - ${mean}) / ${sd} = ${z.toFixed(4)}`;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function getOrdinal(n) {
        let s = ["th", "st", "nd", "rd"], v = n % 100;
        return (s[(v - 20) % 10] || s[v] || s[0]);
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
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\standard-score-calculator.blade.php ENDPATH**/ ?>