<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Number of Elements (n)</label>
                        <input type="number" id="input-n" class="form-control form-control-lg" value="5" min="0" max="100">
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#ef4444;box-shadow:0 4px 12px rgba(239,68,68,0.2)">
                            <i class="fas fa-play me-2"></i>Calculate Subfactorial (!n)
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-load-10" style="min-width: 280px; max-width: 100%;">Try n=10</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Derangements (!n)</span>
                <div class="output-hero-value" id="res-val">44</div>
                <span class="output-hero-unit">Subfactorial of n</span>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Probability (!n / n!)</span>
                        <span class="value" id="res-prob">36.67%</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-pill">
                        <span class="label">Total Permutations (n!)</span>
                        <span class="value" id="res-fact">120</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-danger"></i>Recursive Iteration Table</h6>
                <div class="table-responsive rounded-3 border bg-white">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr><th>k</th><th>Calculation Step</th><th class="text-end">!k Value</th></tr>
                        </thead>
                        <tbody id="steps-table"></tbody>
                    </table>
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
        if (isNaN(n) || n < 0) return;

        if (n > 20) {
            alert('Calculations for n > 20 may exceed integer precision in JS. Using BigInt approximation.');
        }

        let d_prev2 = BigInt(1); // !0 = 1
        let d_prev1 = BigInt(0); // !1 = 0
        let stepsHtml = `
            <tr><td>0</td><td>Base case: !0</td><td class="text-end">1</td></tr>
            <tr><td>1</td><td>Base case: !1</td><td class="text-end">0</td></tr>
        `;

        let current = BigInt(0);
        if (n === 0) current = BigInt(1);
        else if (n === 1) current = BigInt(0);

        for (let i = 2; i <= n; i++) {
            current = BigInt(i - 1) * (d_prev1 + d_prev2);
            stepsHtml += `<tr><td>${i}</td><td>(${i}-1) * (!${i-1} + !${i-2})</td><td class="text-end font-monospace">${current.toString()}</td></tr>`;
            d_prev2 = d_prev1;
            d_prev1 = current;
        }

        const fact = math.factorial(n);
        const prob = (Number(current) / fact) * 100;

        $('res-val').textContent = current.toString();
        $('res-prob').textContent = prob.toFixed(4) + "%";
        $('res-fact').textContent = fact.toLocaleString();
        $('steps-table').innerHTML = stepsHtml;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-load-10').addEventListener('click', () => { $('input-n').value = 10; calculate(); });
});
</script>

<style>
.math-suite-modernized .calculator-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
.math-suite-modernized .calculator-header { display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2.5rem; }
.math-suite-modernized .calculator-header h4 { margin: 0; font-weight: 800; color: #0f172a; }
.math-suite-modernized .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; }
.math-suite-modernized .tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
.math-suite-modernized .form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 0.6rem; display: block; }
.btn-primary-stats { color: #fff; border: none; border-radius: 12px; transition: all 0.3s; }
.btn-dark-stats { background: #0f172a; color: #fff; border: none; border-radius: 12px; }
.output-card-themed { background: #fff; border: 2px solid #e2e8f0; border-radius: 24px; padding: 2.5rem; margin-top: 1rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
.output-hero-label { font-size: 0.9rem; font-weight: 700; color: var(--tool-color); text-transform: uppercase; }
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; word-break: break-all; }
.stat-pill { background: #f8fafc; padding: 1.2rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; }
</style>

