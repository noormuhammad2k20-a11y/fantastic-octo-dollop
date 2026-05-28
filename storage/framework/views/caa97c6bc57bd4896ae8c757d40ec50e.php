<div class="row g-4 geometric-seq-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">First Term (a₁)</label>
                        <input type="number" id="a1" class="form-control form-control-lg" value="1" step="any">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Common Ratio (r)</label>
                        <input type="number" id="r" class="form-control form-control-lg" value="2" step="any">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Terms (n)</label>
                        <input type="number" id="n" class="form-control form-control-lg" value="10" min="1" max="50">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill geo-quick" data-a1="1" data-r="2" data-n="10">2x Growth</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill geo-quick" data-a1="100" data-r="0.5" data-n="10">Half-life</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill geo-quick" data-a1="1" data-r="3" data-n="8">Powers of 3</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Sum of Sequence (Sₙ)</span>
                <div class="output-hero-value" id="out-sum" style="font-size: 2.5rem; word-break: break-all;">1,023</div>
                <div class="mt-2 text-muted fw-bold" id="out-last">Last Term (aₙ): 512</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">General Formula</span><span class="stat-card-value font-monospace" style="font-size: 0.9rem;">aₙ = a₁ × rⁿ⁻¹</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Sum to Infinity</span><span class="stat-card-value" id="out-inf">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-pink"></i>Term Breakdown</h6>
            <div class="table-responsive bg-white border rounded-3 p-2">
                <table class="table table-sm table-hover mb-0 small text-center">
                    <thead class="table-light"><tr><th>n</th><th>Term (aₙ)</th><th>Ratio Impact</th></tr></thead>
                    <tbody id="out-table"></tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Sequence</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const a1El = document.getElementById('a1');
    const rEl = document.getElementById('r');
    const nEl = document.getElementById('n');
    const outSum = document.getElementById('out-sum');
    const outLast = document.getElementById('out-last');
    const outInf = document.getElementById('out-inf');
    const outTable = document.getElementById('out-table');

    function calculate(){
        const a1 = parseFloat(a1El.value);
        const r = parseFloat(rEl.value);
        const n = parseInt(nEl.value);

        if(isNaN(a1) || isNaN(r) || isNaN(n) || n < 1){
            reset();
            return;
        }

        const an = a1 * Math.pow(r, n - 1);
        const sn = r === 1 ? a1 * n : a1 * (1 - Math.pow(r, n)) / (1 - r);
        const infSum = Math.abs(r) < 1 ? (a1 / (1 - r)).toLocaleString() : 'Divergent';

        outSum.textContent = sn.toLocaleString();
        outLast.textContent = `Last Term (aₙ): ${an.toLocaleString()}`;
        outInf.textContent = infSum;

        let tableHTML = "";
        for(let i=1; i<=Math.min(n, 50); i++){
            const val = a1 * Math.pow(r, i - 1);
            tableHTML += `<tr><td>${i}</td><td class="fw-bold text-pink">${val.toLocaleString()}</td><td class="text-muted small">× ${r}<sup>${i-1}</sup></td></tr>`;
        }
        outTable.innerHTML = tableHTML;
    }

    function reset(){
        outSum.textContent = '—';
        outLast.textContent = 'Last Term (aₙ): —';
        outInf.textContent = '—';
        outTable.innerHTML = '';
    }

    [a1El, rEl, nEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.geo-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            a1El.value = btn.dataset.a1;
            rEl.value = btn.dataset.r;
            nEl.value = btn.dataset.n;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const rows = Array.from(outTable.querySelectorAll('tr')).map(tr => tr.innerText).join('\n');
        navigator.clipboard.writeText(`Geometric Sequence\nSum: ${outSum.textContent}\nLast: ${outLast.textContent}\n\n${rows}`);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.geometric-seq-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.geometric-seq-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.geometric-seq-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.geometric-seq-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.geometric-seq-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.geometric-seq-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.geometric-seq-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.geometric-seq-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.geometric-seq-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.geometric-seq-rebuilt .output-hero-value { font-weight: 900; color: var(--tool-color); line-height: 1.2; margin: .5rem 0; }

.geometric-seq-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.geometric-seq-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.geometric-seq-rebuilt .stat-card-value { font-size: 1.1rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .geometric-seq-rebuilt .output-hero-value { font-size: 1.75rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\geometric-sequence-calculator.blade.php ENDPATH**/ ?>