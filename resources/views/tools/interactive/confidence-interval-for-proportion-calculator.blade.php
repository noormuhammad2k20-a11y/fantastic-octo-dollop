<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Successes (x)</label>
                        <input type="number" id="input-x" class="form-control form-control-lg" value="45">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Sample Size (n)</label>
                        <input type="number" id="input-n" class="form-control form-control-lg" value="100">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Confidence Level (%)</label>
                        <select id="input-conf" class="form-select form-select-lg">
                            <option value="0.80">80%</option>
                            <option value="0.90">90%</option>
                            <option value="0.95" selected>95%</option>
                            <option value="0.98">98%</option>
                            <option value="0.99">99%</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#2563eb;box-shadow:0 4px 12px rgba(37,99,235,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Interval
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(37,99,235,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">95% Confidence Interval</span>
                <div class="output-hero-value" id="res-range">0.352 to 0.548</div>
                <span class="output-hero-unit" id="res-p">Sample Proportion (p̂) = 0.450</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Margin of Error (E)</span>
                        <span class="value" id="res-moe">0.098</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Critical Value (z*)</span>
                        <span class="value" id="res-z">1.96</span>
                    </div>
                </div>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-primary"></i>Mathematical Steps</h6>
                <div class="step-card mb-3 p-4 bg-light rounded-4 border">
                    <div class="small text-muted mb-2">Step 1: Calculate Sample Proportion (p̂)</div>
                    <div class="fw-bold fs-5 mb-3" id="step-1">p̂ = 45 / 100 = 0.45</div>
                    <div class="small text-muted mb-2">Step 2: Calculate Standard Error (SE)</div>
                    <div class="fw-bold fs-5 mb-3" id="step-2">SE = √[(0.45 * 0.55) / 100] = 0.05</div>
                    <div class="small text-muted mb-2">Step 3: Calculate Margin of Error (E)</div>
                    <div class="fw-bold fs-5" id="step-3">E = 1.96 * 0.05 = 0.098</div>
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
        const x = parseInt($('input-x').value);
        const n = parseInt($('input-n').value);
        const conf = parseFloat($('input-conf').value);

        if (isNaN(x) || isNaN(n) || n <= 0 || x > n) {
            alert('Invalid input: x must be less than or equal to n.');
            return;
        }

        const p_hat = x / n;
        const q_hat = 1 - p_hat;
        const z = Math.abs(jStat.normal.inv((1 - conf) / 2, 0, 1));
        const se = Math.sqrt((p_hat * q_hat) / n);
        const moe = z * se;

        const lower = p_hat - moe;
        const upper = p_hat + moe;

        $('res-range').textContent = `${lower.toFixed(4)} to ${upper.toFixed(4)}`;
        $('res-p').textContent = `Sample Proportion (p̂) = ${p_hat.toFixed(4)}`;
        $('res-moe').textContent = moe.toFixed(4);
        $('res-z').textContent = z.toFixed(2);

        $('step-1').textContent = `p̂ = ${x} / ${n} = ${p_hat.toFixed(4)}`;
        $('step-2').textContent = `SE = √[(${p_hat.toFixed(4)} * ${q_hat.toFixed(4)}) / ${n}] = ${se.toFixed(4)}`;
        $('step-3').textContent = `E = ${z.toFixed(2)} * ${se.toFixed(4)} = ${moe.toFixed(4)}`;

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
</style>

