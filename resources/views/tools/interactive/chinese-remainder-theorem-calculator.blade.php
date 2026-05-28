<div class="row g-4 stats-suite-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div id="congruences-container">
                    <div class="row g-3 mb-3 cong-row">
                        <div class="col-md-6">
                            <label class="form-label-custom">Remainder (a)</label>
                            <input type="number" class="form-control a-input" value="2">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Modulus (m)</label>
                            <input type="number" class="form-control m-input" value="3">
                        </div>
                    </div>
                    <div class="row g-3 mb-3 cong-row">
                        <div class="col-md-6">
                            <input type="number" class="form-control a-input" value="3">
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control m-input" value="5">
                        </div>
                    </div>
                    <div class="row g-3 mb-3 cong-row">
                        <div class="col-md-6">
                            <input type="number" class="form-control a-input" value="2">
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control m-input" value="7">
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-4">
                    <button class="btn btn-outline-danger flex-grow-1" id="btn-add-row" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus me-2"></i>Add Equation</button>
                    <button class="btn btn-outline-secondary" id="btn-remove-row" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash"></i></button>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#ef4444;box-shadow:0 4px 12px rgba(239,68,68,0.2)">
                            <i class="fas fa-play me-2"></i>Solve for x
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04); display: none;">
            <div class="output-hero">
                <span class="output-hero-label">Solution (x)</span>
                <div class="output-hero-value" id="res-x">0</div>
                <span class="output-hero-unit" id="res-mod">mod 105</span>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-danger"></i>System of Congruences</h6>
                <div id="res-system" class="p-4 rounded-4 bg-light border font-monospace fs-5 text-center">
                    x ≡ 2 (mod 3)<br>
                    x ≡ 3 (mod 5)<br>
                    x ≡ 2 (mod 7)
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Solution
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const container = $('congruences-container');

    $('btn-add-row').addEventListener('click', () => {
        const div = document.createElement('div');
        div.className = 'row g-3 mb-3 cong-row';
        div.innerHTML = `
            <div class="col-md-6"><input type="number" class="form-control a-input"></div>
            <div class="col-md-6"><input type="number" class="form-control m-input"></div>
        `;
        container.appendChild(div);
    });

    $('btn-remove-row').addEventListener('click', () => { if(container.children.length > 2) container.removeChild(container.lastChild); });

    function modInverse(a, m) {
        a = (a % m + m) % m;
        for (let x = 1; x < m; x++) {
            if ((a * x) % m == 1) return x;
        }
        return 1;
    }

    function calculate() {
        const rows = Array.from(container.querySelectorAll('.cong-row'));
        const a = [], m = [];
        let systemHtml = '';

        rows.forEach(row => {
            const valA = parseInt(row.querySelector('.a-input').value) || 0;
            const valM = parseInt(row.querySelector('.m-input').value) || 1;
            a.push(valA);
            m.push(valM);
            systemHtml += `x ≡ ${valA} (mod ${valM})<br>`;
        });

        const M = m.reduce((acc, val) => acc * val, 1);
        let x = 0;

        for (let i = 0; i < a.length; i++) {
            const Mi = M / m[i];
            const yi = modInverse(Mi, m[i]);
            x += a[i] * Mi * yi;
        }

        const resultX = x % M;

        $('res-x').textContent = resultX;
        $('res-mod').textContent = `(mod ${M})`;
        $('res-system').innerHTML = systemHtml;

        $('results-card').style.display = 'block';
        $('results-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', calculate);
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

