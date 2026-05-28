<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Mean (μ)</label>
                        <input type="number" id="input-mu" class="form-control form-control-lg" value="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Standard Deviation (σ)</label>
                        <input type="number" id="input-sigma" class="form-control form-control-lg" value="1">
                    </div>
                    <div class="col-12 mt-4">
                        <label class="form-label-custom">Find Probability P(...)</label>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <button class="btn btn-outline-info flex-grow-1 active" data-type="less">P(X < x)</button>
                            <button class="btn btn-outline-info flex-grow-1" data-type="greater">P(X > x)</button>
                            <button class="btn btn-outline-info flex-grow-1" data-type="between">P(a < X < b)</button>
                        </div>
                        <div id="input-single" class="row g-3">
                            <div class="col-12">
                                <label class="form-label-custom">X Value</label>
                                <input type="number" id="input-x" class="form-control form-control-lg" value="1">
                            </div>
                        </div>
                        <div id="input-double" class="row g-3" style="display:none;">
                            <div class="col-6">
                                <label class="form-label-custom">Value (a)</label>
                                <input type="number" id="input-a" class="form-control form-control-lg" value="-1">
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">Value (b)</label>
                                <input type="number" id="input-b" class="form-control form-control-lg" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#0ea5e9;box-shadow:0 4px 12px rgba(14,165,233,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Probability
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Probability</span>
                <div class="output-hero-value" id="res-prob">0.0000</div>
                <span class="output-hero-unit" id="res-percent">0%</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Z-Score (Standardized)</span>
                        <span class="value" id="res-z">0.0000</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Area to the Right</span>
                        <span class="value" id="res-right">0.0000</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-chart-area me-2 text-info"></i>Normal Curve Analysis</h6>
                <div class="p-4 rounded-4 bg-light border">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fas fa-check-circle text-info me-2"></i><strong>Empirical Rule (68-95-99.7):</strong> Approximately 68% of data falls within 1σ, 95% within 2σ, and 99.7% within 3σ of the mean.</li>
                        <li><i class="fas fa-info-circle text-info me-2"></i>This calculator uses the cumulative distribution function (CDF) for exact precision beyond the empirical rule.</li>
                    </ul>
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
    let activeType = 'less';

    document.querySelectorAll('[data-type]').forEach(btn => {
        btn.addEventListener('click', () => {
            activeType = btn.dataset.type;
            document.querySelectorAll('[data-type]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            $('input-single').style.display = (activeType === 'between') ? 'none' : 'block';
            $('input-double').style.display = (activeType === 'between') ? 'flex' : 'none';
        });
    });

    function calculate() {
        const mu = parseFloat($('input-mu').value);
        const sigma = parseFloat($('input-sigma').value);

        if (isNaN(mu) || isNaN(sigma) || sigma <= 0) return;

        let prob = 0;
        let z = "";

        if (activeType === 'less') {
            const x = parseFloat($('input-x').value);
            prob = jStat.normal.cdf(x, mu, sigma);
            z = ((x - mu) / sigma).toFixed(4);
        } else if (activeType === 'greater') {
            const x = parseFloat($('input-x').value);
            prob = 1 - jStat.normal.cdf(x, mu, sigma);
            z = ((x - mu) / sigma).toFixed(4);
        } else {
            const a = parseFloat($('input-a').value);
            const b = parseFloat($('input-b').value);
            const p1 = jStat.normal.cdf(a, mu, sigma);
            const p2 = jStat.normal.cdf(b, mu, sigma);
            prob = Math.abs(p2 - p1);
            z = "N/A (Interval)";
        }

        $('res-prob').textContent = prob.toFixed(6);
        $('res-percent').textContent = (prob * 100).toFixed(4) + "%";
        $('res-z').textContent = z;
        $('res-right').textContent = (1 - prob).toFixed(6);

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
.stat-pill .label { font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; }
.stat-pill .value { font-size: 1.4rem; font-weight: 800; color: #0f172a; }
.btn-outline-info { border: 2px solid #e0f2fe; color: #0369a1; font-weight: 600; }
.btn-outline-info.active { background: #0ea5e9; color: #fff; border-color: #0ea5e9; }
</style>

