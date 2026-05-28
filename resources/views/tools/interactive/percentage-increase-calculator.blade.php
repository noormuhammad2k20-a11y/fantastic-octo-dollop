<div class="row g-4 percent-increase-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Original Value</label>
                        <input type="number" id="v1" class="form-control form-control-lg" placeholder="e.g. 50" value="50" step="any">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">New Value</label>
                        <input type="number" id="v2" class="form-control form-control-lg" placeholder="e.g. 75" value="75" step="any">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill inc-quick" data-v1="50" data-v2="100">2x Growth</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill inc-quick" data-v1="100" data-v2="110">10% Jump</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill inc-quick" data-v1="80" data-v2="120">50% Boost</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:140;--tool-color:#16a34a;--tool-bg:rgba(34,197,94,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Percentage Increase</span>
                <div class="output-hero-value" id="out-increase">50%</div>
                <div class="mt-2 text-muted fw-bold" id="out-amount">Growth Amount: 25</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Growth Factor</span>
                        <span class="stat-card-value" id="out-factor">1.5x</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Total Percentage</span>
                        <span class="stat-card-value" id="out-total">150%</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-line me-2 text-success"></i>Calculation Logic</h6>
            <div class="bg-white border rounded-3 p-3 small text-secondary">
                <div id="step-1" class="mb-2">1. Find the growth: New - Original = Difference</div>
                <div id="step-2" class="mb-2">2. Divide difference by Original</div>
                <div id="step-3">3. Result × 100 = Percentage Increase</div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Result</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const v1El = document.getElementById('v1');
    const v2El = document.getElementById('v2');
    const outInc = document.getElementById('out-increase');
    const outAmt = document.getElementById('out-amount');
    const outFact = document.getElementById('out-factor');
    const outTot = document.getElementById('out-total');

    function calculate(){
        const v1 = parseFloat(v1El.value);
        const v2 = parseFloat(v2El.value);

        if(isNaN(v1) || isNaN(v2) || v1 === 0){
            outInc.textContent = '—';
            outAmt.textContent = 'Growth Amount: —';
            outFact.textContent = '—';
            outTot.textContent = '—';
            return;
        }

        const diff = v2 - v1;
        const percent = (diff / v1) * 100;
        const factor = v2 / v1;
        const total = factor * 100;

        outInc.textContent = percent.toFixed(2).replace(/\.00$/, '') + '%';
        outAmt.textContent = `Growth Amount: ${diff.toLocaleString()}`;
        outFact.textContent = factor.toFixed(4).replace(/\.?0+$/, '') + 'x';
        outTot.textContent = total.toFixed(2).replace(/\.00$/, '') + '%';

        document.getElementById('step-1').innerHTML = `1. Growth: ${v2} - ${v1} = <strong>${diff.toLocaleString()}</strong>`;
        document.getElementById('step-2').innerHTML = `2. Ratio: ${diff} / ${v1} = <strong>${(diff/v1).toFixed(4)}</strong>`;
        document.getElementById('step-3').innerHTML = `3. Percentage: ${(diff/v1).toFixed(4)} × 100 = <strong>${percent.toFixed(2)}%</strong>`;
    }

    v1El.addEventListener('input', calculate);
    v2El.addEventListener('input', calculate);

    document.querySelectorAll('.inc-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            v1El.value = btn.dataset.v1;
            v2El.value = btn.dataset.v2;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        if(outInc.textContent === '—') return;
        const text = `Percentage Increase Result\nOriginal: ${v1El.value}\nNew: ${v2El.value}\nIncrease: ${outInc.textContent}`;
        navigator.clipboard.writeText(text);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.percent-increase-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.percent-increase-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.percent-increase-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.percent-increase-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.percent-increase-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.percent-increase-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.percent-increase-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.percent-increase-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.percent-increase-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.percent-increase-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.percent-increase-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.percent-increase-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.percent-increase-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .percent-increase-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

