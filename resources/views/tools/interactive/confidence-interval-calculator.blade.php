<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Sample Mean (x̄)</label>
                        <input type="number" id="input-mean" class="form-control form-control-lg" value="100">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Sample Size (n)</label>
                        <input type="number" id="input-n" class="form-control form-control-lg" value="50">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Standard Deviation (σ)</label>
                        <input type="number" id="input-sigma" class="form-control form-control-lg" value="15">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Confidence Level (%)</label>
                        <select id="input-confidence" class="form-select form-select-lg">
                            <option value="95">95%</option>
                            <option value="99">99%</option>
                            <option value="90">90%</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">SD Type</label>
                        <select id="input-type" class="form-select form-select-lg">
                            <option value="pop">Population SD known (Z-interval)</option>
                            <option value="sample">Sample SD known (T-interval)</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12 d-flex gap-2">
                        <button class="btn btn-primary-stats flex-grow-1 py-3 fw-bold" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#ec4899;box-shadow:0 4px 12px rgba(236,72,153,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Interval
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:330;--tool-color:#ec4899;--tool-bg:rgba(236,72,153,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Confidence Interval Range</span>
                <div class="output-hero-value" id="res-range">0.00 to 0.00</div>
                <span class="output-hero-unit" id="res-cl">95% Confidence</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Margin of Error (E)</span>
                        <span class="value" id="res-error">0.00</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Critical Value (z* or t*)</span>
                        <span class="value" id="res-critical">0.00</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-pink"></i>Step-by-Step Calculation</h6>
                <div class="step-card mb-3">
                    <div class="step-header">Step 1: Determine the Standard Error</div>
                    <div class="step-body" id="step-se">SE = σ / √n = ...</div>
                </div>
                <div class="step-card mb-3">
                    <div class="step-header">Step 2: Calculate Margin of Error</div>
                    <div class="step-body" id="step-me">E = Critical Value × SE = ...</div>
                </div>
                <div class="step-card mb-3">
                    <div class="step-header">Step 3: Final Interval</div>
                    <div class="step-body">
                        <div class="formula-block text-center py-3">
                            <span class="fs-4 mt-2 d-inline-block" id="step-final">Interval = [x̄ - E, x̄ + E] = ...</span>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstat/1.9.6/jstat.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    function calculate() {
        const mean = parseFloat($('input-mean').value);
        const n = parseFloat($('input-n').value);
        const sigma = parseFloat($('input-sigma').value);
        const cl = parseFloat($('input-confidence').value) / 100;
        const type = $('input-type').value;

        if (isNaN(mean) || isNaN(n) || isNaN(sigma) || n <= 1) return;

        const alpha = 1 - cl;
        let critical;
        if (type === 'pop') {
            critical = jStat.normal.inv(1 - alpha/2, 0, 1);
        } else {
            critical = jStat.studentt.inv(1 - alpha/2, n - 1);
        }

        const se = sigma / Math.sqrt(n);
        const me = critical * se;
        const lower = mean - me;
        const upper = mean + me;

        $('res-range').textContent = `${lower.toFixed(4)} to ${upper.toFixed(4)}`;
        $('res-cl').textContent = (cl * 100) + "% Confidence";
        $('res-error').textContent = `± ${me.toFixed(4)}`;
        $('res-critical').textContent = critical.toFixed(4);

        $('step-se').innerHTML = `SE = σ / √n = ${sigma} / √${n} = <strong>${se.toFixed(4)}</strong>`;
        $('step-me').innerHTML = `E = ${critical.toFixed(4)} × ${se.toFixed(4)} = <strong>${me.toFixed(4)}</strong>`;
        $('step-final').textContent = `Interval = [${mean} - ${me.toFixed(4)}, ${mean} + ${me.toFixed(4)}] = [${lower.toFixed(4)}, ${upper.toFixed(4)}]`;

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
.step-card { background: #f8fafc; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden; }
.step-header { background: #fff; padding: 1rem 1.5rem; font-weight: 700; border-bottom: 1px solid #f1f5f9; }
.step-body { padding: 1.5rem; }
.formula-block { background: #0f172a; color: #e2e8f0; padding: 1.5rem; border-radius: 12px; font-family: monospace; }
</style>

