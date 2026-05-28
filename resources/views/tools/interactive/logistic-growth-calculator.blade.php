<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Population (P₀)</label>
                        <input type="number" id="input-p0" class="form-control form-control-lg" value="100">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Carrying Capacity (K)</label>
                        <input type="number" id="input-k" class="form-control form-control-lg" value="1000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Growth Rate (r) [Decimal]</label>
                        <input type="number" id="input-r" class="form-control form-control-lg" value="0.1" step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Time Elapsed (t)</label>
                        <input type="number" id="input-t" class="form-control form-control-lg" value="10">
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#10b981;box-shadow:0 4px 12px rgba(16,185,129,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Future Population
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Population at Time t</span>
                <div class="output-hero-value" id="res-p">0</div>
                <span class="output-hero-unit" id="res-status">Approaching Capacity</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">% of Carrying Capacity</span>
                        <span class="value" id="res-percent">0%</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Growth Amount</span>
                        <span class="value" id="res-growth">0</span>
                    </div>
                </div>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-success"></i>Logistic Growth Formula</h6>
                <div class="step-card mb-3">
                    <div class="step-body">
                        <div class="formula-block text-center py-3">
                            <span class="fs-4">P(t) = K / [1 + ((K - P₀)/P₀) * e^(-rt)]</span><br>
                            <span class="fs-5 mt-2 d-inline-block" id="step-formula">P(t) = 1000 / [1 + 9 * e^(-1)] = ...</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Projection
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const btnCalc = $('btn-calculate');
    const resultsCard = $('results-card');

    function calculate() {
        const p0 = parseFloat($('input-p0').value);
        const k = parseFloat($('input-k').value);
        const r = parseFloat($('input-r').value);
        const t = parseFloat($('input-t').value);

        if (isNaN(p0) || isNaN(k) || isNaN(r) || isNaN(t) || p0 <= 0 || k <= 0) return;

        const exponent = Math.exp(-r * t);
        const denominator = 1 + ((k - p0) / p0) * exponent;
        const pt = k / denominator;

        $('res-p').textContent = Math.round(pt).toLocaleString();
        $('res-percent').textContent = ((pt / k) * 100).toFixed(2) + "%";
        $('res-growth').textContent = Math.round(pt - p0).toLocaleString();
        $('res-status').textContent = pt >= k * 0.99 ? "Reached Carrying Capacity" : "Growing towards Capacity";

        $('step-formula').textContent = `P(${t}) = ${k} / [1 + ((${k} - ${p0})/${p0}) * e^(-${r} * ${t})] = ${Math.round(pt)}`;

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
.formula-block { background: #0f172a; color: #e2e8f0; padding: 1.5rem; border-radius: 12px; font-family: monospace; }
</style>

