<div class="row g-4 geo-mean-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Dataset (Values must be > 0)</label>
                    <textarea id="data-input" class="form-control form-control-lg font-monospace" rows="4" placeholder="e.g. 2, 8">2, 8</textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill gm-quick" data-val="2, 8">2 & 8 (Mean 4)</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill gm-quick" data-val="1.05, 1.10, 1.07">Finance Growth</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill gm-quick" data-val="10, 100, 1000">Log Scale</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Geometric Mean (G)</span>
                <div class="output-hero-value" id="out-gm">4</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">n-th Root of Product</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Dataset Product</span>
                        <span class="stat-card-value" id="out-prod">16</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Number of Terms (n)</span>
                        <span class="stat-card-value" id="out-count">2</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-calculator me-2 text-pink"></i>Mathematical Logic</h6>
            <div class="bg-white border rounded-3 p-3">
                <div class="font-monospace small" id="out-logic">
                    G = ⁿ√(x₁ × x₂ × ... × xₙ)
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Result</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('data-input');
    const outGm = document.getElementById('out-gm');
    const outProd = document.getElementById('out-prod');
    const outCount = document.getElementById('out-count');
    const outLogic = document.getElementById('out-logic');

    function calculate(){
        const val = input.value;
        const numbers = val.split(/[,\s\n]+/).map(n => parseFloat(n.trim())).filter(n => !isNaN(n) && n > 0);

        if(numbers.length === 0){
            reset();
            return;
        }

        const n = numbers.length;
        const product = numbers.reduce((a, b) => a * b, 1);
        const gm = Math.pow(product, 1 / n);

        outGm.textContent = gm.toLocaleString(undefined, {maximumFractionDigits: 4});
        outProd.textContent = product.toLocaleString();
        outCount.textContent = n;

        outLogic.innerHTML = `G = ${n}√(${product.toLocaleString()}) = <strong>${gm.toLocaleString(undefined, {maximumFractionDigits: 4})}</strong>`;
    }

    function reset(){
        outGm.textContent = '—';
        outProd.textContent = '—';
        outCount.textContent = '—';
        outLogic.textContent = 'G = ⁿ√(x₁ × x₂ × ... × xₙ)';
    }

    input.addEventListener('input', calculate);

    document.querySelectorAll('.gm-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        navigator.clipboard.writeText(outGm.textContent);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.geo-mean-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.geo-mean-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.geo-mean-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.geo-mean-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.geo-mean-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.geo-mean-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.geo-mean-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.geo-mean-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.geo-mean-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.geo-mean-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.geo-mean-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; text-align: center; }
.geo-mean-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.geo-mean-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .geo-mean-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\geometric-mean-calculator.blade.php ENDPATH**/ ?>