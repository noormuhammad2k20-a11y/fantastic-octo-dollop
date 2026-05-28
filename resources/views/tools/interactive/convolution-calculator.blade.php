<div class="row g-4 math-suite-modernized">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Input Signal f[n]</label>
                        <textarea id="input-f" class="form-control font-monospace" rows="3" placeholder="e.g. 1, 2, 3">1, 2, 3, 4</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Kernel / Pulse g[n]</label>
                        <textarea id="input-g" class="form-control font-monospace" rows="3" placeholder="e.g. 0.5, 0.5">1, 1, 1</textarea>
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-12">
                        <button class="btn d-block mx-auto btn-primary-stats py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-calculate" style="min-width: 280px; max-width: 100%; background:#059669;box-shadow:0 4px 12px rgba(5,150,105,0.2)">
                            <i class="fas fa-sync me-2"></i>Compute Convolution (f * g)
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-ma" style="min-width: 280px; max-width: 100%;">3-Point Moving Average</button>
                    <button class="btn btn-light btn-sm flex-grow-1 border" id="btn-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="results-card" class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(5,150,105,.04); display: none;">
            <div class="output-hero mb-4">
                <span class="output-hero-label">Resulting Signal (y[n])</span>
                <div class="output-hero-value fs-2" id="res-val">[1, 3, 6, 9, 7, 4]</div>
                <span class="output-hero-unit" id="res-len">Length: 6</span>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-4"><i class="fas fa-list-ol me-2 text-success"></i>Convolution Matrix / Summation Table</h6>
                <div class="table-responsive rounded-3 border bg-white">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr><th>n</th><th>Summation Formula</th><th class="text-end">Result y[n]</th></tr>
                        </thead>
                        <tbody id="steps-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-dark-stats px-4 py-3 rounded-3 flex-grow-1" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-copy me-2"></i>Copy Result Array
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
        const f = $('input-f').value.split(/[\s,;]+/).filter(v => v.trim() !== '').map(Number);
        const g = $('input-g').value.split(/[\s,;]+/).filter(v => v.trim() !== '').map(Number);

        if (f.length === 0 || g.length === 0) return;

        const n = f.length;
        const m = g.length;
        const outLen = n + m - 1;
        const y = new Array(outLen).fill(0);

        let stepsHtml = '';
        for (let i = 0; i < outLen; i++) {
            let formula = [];
            for (let j = 0; j < m; j++) {
                if (i - j >= 0 && i - j < n) {
                    const val = f[i - j] * g[j];
                    y[i] += val;
                    formula.push(`${f[i-j]}*${g[j]}`);
                }
            }
            stepsHtml += `<tr><td>${i}</td><td>${formula.join(' + ')}</td><td class="text-end fw-bold">${y[i]}</td></tr>`;
        }

        $('res-val').textContent = `[${y.join(', ')}]`;
        $('res-len').textContent = `Length: ${outLen}`;
        $('steps-table').innerHTML = stepsHtml;

        resultsCard.style.display = 'block';
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    btnCalc.addEventListener('click', calculate);
    $('btn-ma').addEventListener('click', () => { $('input-g').value = "0.33, 0.33, 0.33"; calculate(); });
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
.output-hero-value { font-size: 3rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0; word-break: break-all; }
</style>

