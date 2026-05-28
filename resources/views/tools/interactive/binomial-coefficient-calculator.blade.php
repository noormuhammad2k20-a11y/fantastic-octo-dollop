<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Items (n)</label>
                        <input type="number" id="input-n" class="form-control form-control-lg" value="10" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Items to Choose (k)</label>
                        <input type="number" id="input-k" class="form-control form-control-lg" value="2" min="0">
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#6366f1;box-shadow:0 4px 12px rgba(99,102,241,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate C(n, k)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Result (Combinations)</span>
                <div class="output-hero-value" id="res-val">45</div>
                <span class="output-hero-unit">Ways to choose</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Permutations P(n, k)</span>
                        <span class="value" id="res-perm">90</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Total Subsets</span>
                        <span class="value" id="res-subsets">2^n</span>
                    </div>
                </div>
            </div>

            <div class="step-container mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-indigo"></i>Mathematical Breakdown</h6>
                <div class="step-card mb-3">
                    <div class="step-header">Combination Formula</div>
                    <div class="step-body">
                        <div class="formula-block text-center py-3">
                            <span class="fs-4">C(n, k) = n! / [k! * (n - k)!]</span><br>
                            <span class="fs-5 mt-2 d-inline-block" id="step-formula">C(10, 2) = 10! / (2! * 8!) = 45</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Result
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
        const n = parseInt($('input-n').value);
        const k = parseInt($('input-k').value);

        if (isNaN(n) || isNaN(k) || k > n || n < 0 || k < 0) {
            alert('Invalid input. Ensure n ≥ k and both are non-negative.');
            return;
        }

        try {
            const combinations = math.combinations(n, k);
            const permutations = math.permutations(n, k);

            $('res-val').textContent = combinations.toLocaleString();
            $('res-perm').textContent = permutations.toLocaleString();
            $('res-subsets').textContent = Math.pow(2, n).toLocaleString();

            $('step-formula').textContent = `C(${n}, ${k}) = ${n}! / (${k}! * ${n-k}!) = ${combinations}`;

            resultsCard.style.display = 'block';
            resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } catch (e) {
            alert('Numbers too large for calculation.');
        }
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

