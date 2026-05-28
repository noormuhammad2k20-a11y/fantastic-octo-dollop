<div class="row g-4 arithmetic-seq-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">First Term (a₁)</label>
                        <input type="number" id="a1" class="form-control form-control-lg" value="1" step="any">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Common Difference (d)</label>
                        <input type="number" id="d" class="form-control form-control-lg" value="2" step="any">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Terms (n)</label>
                        <input type="number" id="n" class="form-control form-control-lg" value="10" min="1" max="1000">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill seq-quick" data-a1="1" data-d="1" data-n="10">1 to 10</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill seq-quick" data-a1="2" data-d="2" data-n="50">Even Numbers</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill seq-quick" data-a1="1" data-d="2" data-n="50">Odd Numbers</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Sum of Sequence (Sₙ)</span>
                <div class="output-hero-value" id="out-sum">100</div>
                <div class="mt-2 text-muted fw-bold" id="out-last">Last Term (aₙ): 19</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">General Formula</span><span class="stat-card-value font-monospace" style="font-size: 0.9rem;">aₙ = a₁ + (n-1)d</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Sum Formula</span><span class="stat-card-value font-monospace" style="font-size: 0.9rem;">Sₙ = (n/2)(a₁ + aₙ)</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-stream me-2 text-indigo"></i>Sequence Data Grid</h6>
            <div class="table-responsive bg-white border rounded-3 p-2">
                <table class="table table-sm table-hover mb-0 small text-center">
                    <thead class="table-light"><tr><th>Position (n)</th><th>Term Value (aₙ)</th><th>Cumulative Sum</th></tr></thead>
                    <tbody id="out-table"></tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Sequence Values</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const a1El = document.getElementById('a1');
    const dEl = document.getElementById('d');
    const nEl = document.getElementById('n');
    const outSum = document.getElementById('out-sum');
    const outLast = document.getElementById('out-last');
    const outTable = document.getElementById('out-table');

    function calculate(){
        const a1 = parseFloat(a1El.value);
        const d = parseFloat(dEl.value);
        const n = parseInt(nEl.value);

        if(isNaN(a1) || isNaN(d) || isNaN(n) || n < 1){
            reset();
            return;
        }

        const an = a1 + (n - 1) * d;
        const sn = (n / 2) * (a1 + an);

        outSum.textContent = sn.toLocaleString();
        outLast.textContent = `Last Term (aₙ): ${an.toLocaleString()}`;

        let tableHTML = "";
        let currentSum = 0;
        // Show first 50 terms to keep UI snappy
        const displayCount = Math.min(n, 50);
        for(let i=1; i<=displayCount; i++){
            const val = a1 + (i - 1) * d;
            currentSum += val;
            tableHTML += `<tr><td>${i}</td><td class="fw-bold">${val.toLocaleString()}</td><td class="text-muted">${currentSum.toLocaleString()}</td></tr>`;
        }
        if(n > 50) tableHTML += `<tr><td colspan="3" class="text-center py-2 text-muted italic">... showing first 50 of ${n} terms ...</td></tr>`;
        
        outTable.innerHTML = tableHTML;
    }

    function reset(){
        outSum.textContent = '—';
        outLast.textContent = 'Last Term (aₙ): —';
        outTable.innerHTML = '';
    }

    [a1El, dEl, nEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.seq-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            a1El.value = btn.dataset.a1;
            dEl.value = btn.dataset.d;
            nEl.value = btn.dataset.n;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const rows = Array.from(outTable.querySelectorAll('tr')).map(tr => tr.innerText.replace(/\t/g, ', ')).join('\n');
        navigator.clipboard.writeText(`Arithmetic Sequence\nSum: ${outSum.textContent}\nLast Term: ${outLast.textContent}\n\nData:\n${rows}`);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.arithmetic-seq-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.arithmetic-seq-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.arithmetic-seq-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.arithmetic-seq-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.arithmetic-seq-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.arithmetic-seq-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.arithmetic-seq-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.arithmetic-seq-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.arithmetic-seq-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.arithmetic-seq-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.arithmetic-seq-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.arithmetic-seq-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.arithmetic-seq-rebuilt .stat-card-value { font-size: 1.1rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .arithmetic-seq-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

