<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Input Number (Rational or Decimal)</label>
                        <input type="text" id="input-num" class="form-control form-control-lg" value="3.1415926535" placeholder="e.g. 22/7 or 3.14">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Max Iterations / Depth</label>
                        <input type="number" id="input-depth" class="form-control form-control-lg" value="10" min="1" max="50">
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#d946ef;box-shadow:0 4px 12px rgba(217,70,239,0.2)">
                            <i class="fas fa-play me-2"></i>Generate Continued Fraction
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-load-pi" style="min-width: 280px; max-width: 100%;">Load π (Pi)</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-load-phi" style="min-width: 280px; max-width: 100%;">Load φ (Phi)</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:300;--tool-color:#d946ef;--tool-bg:rgba(217,70,239,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Notation</span>
                <div class="output-hero-value fs-2" id="res-notation">[3; 7, 15, 1, 292, ...]</div>
                <span class="output-hero-unit" id="res-count">Found 10 terms</span>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-table me-2 text-pink"></i>Convergent Table</h6>
                <div class="table-responsive rounded-3 border bg-white">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr><th>n</th><th>aₙ (Coefficient)</th><th>Fraction (hₙ/kₙ)</th><th class="text-end">Decimal Value</th></tr>
                        </thead>
                        <tbody id="convergent-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Notation
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
        let valStr = $('input-num').value.trim();
        let x;

        if (valStr.includes('/')) {
            const parts = valStr.split('/');
            x = parseFloat(parts[0]) / parseFloat(parts[1]);
        } else {
            x = parseFloat(valStr);
        }

        if (isNaN(x)) return;

        const depth = parseInt($('input-depth').value) || 10;
        const coefficients = [];
        const convergents = [];
        
        let h_prev2 = 0, h_prev1 = 1;
        let k_prev2 = 1, k_prev1 = 0;

        let temp = x;
        for (let i = 0; i < depth; i++) {
            const a = Math.floor(temp);
            coefficients.push(a);

            const h = a * h_prev1 + h_prev2;
            const k = a * k_prev1 + k_prev2;
            convergents.push({ n: i, a: a, h: h, k: k, val: h/k });

            h_prev2 = h_prev1; h_prev1 = h;
            k_prev2 = k_prev1; k_prev1 = k;

            temp = 1 / (temp - a);
            if (!isFinite(temp) || Math.abs(temp) < 1e-15) break;
        }

        const notation = `[${coefficients[0]}; ${coefficients.slice(1).join(', ')}]`;
        $('res-notation').textContent = notation;
        $('res-count').textContent = `Found ${coefficients.length} terms`;

        $('convergent-table').innerHTML = convergents.map(c => `
            <tr>
                <td>${c.n}</td>
                <td class="fw-bold text-primary">${c.a}</td>
                <td>${c.h} / ${c.k}</td>
                <td class="text-end font-monospace">${c.val.toFixed(10)}</td>
            </tr>
        `).join('');

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-load-pi').addEventListener('click', () => { $('input-num').value = Math.PI; calculate(); });
    $('btn-load-phi').addEventListener('click', () => { $('input-num').value = (1 + Math.sqrt(5)) / 2; calculate(); });
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
.output-hero-value { font-size: 2.5rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; word-break: break-all; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\continued-fraction-calculator.blade.php ENDPATH**/ ?>