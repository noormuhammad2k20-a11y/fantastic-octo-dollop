<div class="row g-4 arithmetic-mean-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Dataset</label>
                    <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="4" placeholder="e.g. 10, 20, 30, 40, 50">10, 20, 30, 40, 50</textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill mean-quick" data-val="5, 10, 15, 20, 25">Small Set</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill mean-quick" data-val="100, 250, 400, 550">Spaced Values</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill mean-quick" data-val="1.5, 2.5, 3.5">Decimals</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Arithmetic Mean (x̄)</span>
                <div class="output-hero-value" id="out-mean">30</div>
                <div class="mt-2 text-muted fw-bold" id="out-count">Count: 5 numbers</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Total Sum</span>
                        <span class="stat-card-value" id="out-sum">150</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Min Value</span>
                        <span class="stat-card-value" id="out-min">10</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Max Value</span>
                        <span class="stat-card-value" id="out-max">50</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-equals me-2 text-primary"></i>Formula</h6>
            <div class="bg-white border rounded-3 p-3 text-center">
                <div class="font-monospace fs-5">x̄ = Σx / n</div>
                <div class="text-muted small mt-2" id="out-logic">30 = 150 / 5</div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Mean Result</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('data-input');
    const outMean = document.getElementById('out-mean');
    const outCount = document.getElementById('out-count');
    const outSum = document.getElementById('out-sum');
    const outMin = document.getElementById('out-min');
    const outMax = document.getElementById('out-max');
    const outLogic = document.getElementById('out-logic');

    function calculate(){
        const val = input.value;
        const numbers = val.split(/[,\s\n]+/)
                          .map(n => parseFloat(n.trim()))
                          .filter(n => !isNaN(n));

        if(numbers.length === 0){
            reset();
            return;
        }

        const sum = numbers.reduce((a, b) => a + b, 0);
        const count = numbers.length;
        const mean = sum / count;
        const min = Math.min(...numbers);
        const max = Math.max(...numbers);

        outMean.textContent = mean.toLocaleString(undefined, {maximumFractionDigits: 4});
        outCount.textContent = `Count: ${count} numbers`;
        outSum.textContent = sum.toLocaleString();
        outMin.textContent = min.toLocaleString();
        outMax.textContent = max.toLocaleString();
        outLogic.textContent = `${mean.toLocaleString(undefined, {maximumFractionDigits: 4})} = ${sum.toLocaleString()} / ${count}`;
    }

    function reset(){
        outMean.textContent = '—';
        outCount.textContent = 'Count: 0';
        outSum.textContent = '—';
        outMin.textContent = '—';
        outMax.textContent = '—';
        outLogic.textContent = 'x̄ = Σx / n';
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.mean-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        if(outMean.textContent === '—') return;
        navigator.clipboard.writeText(outMean.textContent);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(()=>this.innerHTML=o, 2000);
    });

    calculate();
});
</script>

<style>
.arithmetic-mean-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.arithmetic-mean-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.arithmetic-mean-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.arithmetic-mean-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.arithmetic-mean-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.arithmetic-mean-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.arithmetic-mean-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.arithmetic-mean-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.arithmetic-mean-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.arithmetic-mean-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.arithmetic-mean-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.arithmetic-mean-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.arithmetic-mean-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .arithmetic-mean-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

