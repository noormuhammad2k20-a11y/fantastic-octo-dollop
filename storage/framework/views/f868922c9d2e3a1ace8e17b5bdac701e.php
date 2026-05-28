<div class="row g-4 percent-decrease-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Original Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">$</span>
                            <input type="number" id="v1" class="form-control form-control-lg" placeholder="e.g. 100" value="100" step="any">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">New Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">$</span>
                            <input type="number" id="v2" class="form-control form-control-lg" placeholder="e.g. 80" value="80" step="any">
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill dec-quick" data-v1="100" data-v2="50">50% Off</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill dec-quick" data-v1="1000" data-v2="900">10% Sale</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill dec-quick" data-v1="50" data-v2="40">20% Cut</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:25;--tool-color:#ea580c;--tool-bg:rgba(249,115,22,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Percentage Decrease</span>
                <div class="output-hero-value" id="out-decrease">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-amount">Amount Saved: —</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Ratio</span>
                        <span class="stat-card-value" id="out-ratio">—</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Remaining %</span>
                        <span class="stat-card-value" id="out-remaining">—</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Factor</span>
                        <span class="stat-card-value" id="out-factor">—</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-history me-2 text-orange"></i>Step-by-Step Logic</h6>
            <div class="bg-white border rounded-3 p-3 small text-secondary">
                <div id="step-1" class="mb-2">1. Find the difference between values...</div>
                <div id="step-2" class="mb-2">2. Divide the difference by the original...</div>
                <div id="step-3">3. Convert to percentage...</div>
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
    const outDec = document.getElementById('out-decrease');
    const outAmt = document.getElementById('out-amount');
    const outRatio = document.getElementById('out-ratio');
    const outRem = document.getElementById('out-remaining');
    const outFact = document.getElementById('out-factor');

    function calculate(){
        const v1 = parseFloat(v1El.value);
        const v2 = parseFloat(v2El.value);

        if(isNaN(v1) || isNaN(v2) || v1 === 0){
            reset();
            return;
        }

        const diff = v1 - v2;
        const percent = (diff / v1) * 100;
        const remaining = (v2 / v1) * 100;
        const factor = v2 / v1;

        outDec.textContent = percent.toFixed(2) + '%';
        outAmt.textContent = `Amount Saved: ${diff.toLocaleString()}`;
        outRatio.textContent = `${v2}:${v1}`;
        outRem.textContent = remaining.toFixed(2) + '%';
        outFact.textContent = factor.toFixed(4);

        document.getElementById('step-1').innerHTML = `1. Difference: ${v1} - ${v2} = <strong>${diff}</strong>`;
        document.getElementById('step-2').innerHTML = `2. Ratio: ${diff} / ${v1} = <strong>${(diff/v1).toFixed(4)}</strong>`;
        document.getElementById('step-3').innerHTML = `3. Percentage: ${(diff/v1).toFixed(4)} × 100 = <strong>${percent.toFixed(2)}%</strong>`;
    }

    function reset(){
        outDec.textContent = '—';
        outAmt.textContent = 'Amount Saved: —';
        outRatio.textContent = '—';
        outRem.textContent = '—';
        outFact.textContent = '—';
    }

    v1El.addEventListener('input', calculate);
    v2El.addEventListener('input', calculate);

    document.querySelectorAll('.dec-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            v1El.value = btn.dataset.v1;
            v2El.value = btn.dataset.v2;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        if(outDec.textContent === '—') return;
        const text = `Percentage Decrease Result\nOriginal: ${v1El.value}\nNew: ${v2El.value}\nDecrease: ${outDec.textContent}`;
        navigator.clipboard.writeText(text);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.percent-decrease-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.percent-decrease-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.percent-decrease-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.percent-decrease-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.percent-decrease-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.percent-decrease-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.percent-decrease-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.percent-decrease-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.percent-decrease-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.percent-decrease-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.percent-decrease-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.percent-decrease-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.percent-decrease-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .percent-decrease-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\percentage-decrease-calculator.blade.php ENDPATH**/ ?>