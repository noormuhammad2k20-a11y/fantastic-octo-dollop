<div class="row g-4 fibo-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Number of Terms (n)</label>
                        <input type="number" id="n-input" class="form-control form-control-lg" value="20" min="1" max="100">
                        <div class="mt-2 text-muted small">We support up to 100 terms (F₁₀₀ ≈ 3.5 × 10²⁰).</div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill fibo-quick" data-val="10">First 10</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill fibo-quick" data-val="50">First 50</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill fibo-quick" data-val="100">First 100</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:40;--tool-color:#b45309;--tool-bg:rgba(234,179,8,.04);">
            <div class="output-hero">
                <span class="output-hero-label">The ${n}th Fibonacci Number (Fₙ)</span>
                <div class="output-hero-value" id="out-last" style="font-size: 2.5rem; word-break: break-all;">6,765</div>
                <div class="mt-2 text-muted fw-bold" id="out-phi">Golden Ratio Approx: 1.618</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list me-2 text-warning"></i>Fibonacci Sequence</h6>
            <div class="bg-white border rounded-3 p-3 overflow-auto" style="max-height: 400px;">
                <div id="out-pills" class="d-flex flex-wrap gap-2">
                    {{-- Dynamic Pills --}}
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Sequence</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const nInput = document.getElementById('n-input');
    const outLast = document.getElementById('out-last');
    const outPhi = document.getElementById('out-phi');
    const outPills = document.getElementById('out-pills');

    function calculate(){
        const n = parseInt(nInput.value);
        if(isNaN(n) || n < 1) return;

        let sequence = [BigInt(0)];
        if(n > 1) sequence.push(BigInt(1));
        
        for(let i=2; i<n; i++){
            sequence.push(sequence[i-1] + sequence[i-2]);
        }

        const last = sequence[sequence.length - 1];
        outLast.textContent = last.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        if(sequence.length > 2){
            const phi = Number(sequence[sequence.length-1]) / Number(sequence[sequence.length-2]);
            outPhi.textContent = `Ratio Fₙ/Fₙ₋₁: ${phi.toFixed(6)}`;
        } else {
            outPhi.textContent = 'Golden Ratio: 1.618...';
        }

        outPills.innerHTML = sequence.map((val, i) => `
            <div class="badge bg-light text-dark border p-2 fw-normal" style="font-size: 0.9rem;">
                <span class="text-muted small me-1">F<sub>${i}</sub>:</span> <span class="fw-bold text-warning" style="color:#b45309 !important;">${val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</span>
            </div>
        `).join('');
    }

    nInput.addEventListener('input', calculate);

    document.querySelectorAll('.fibo-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            nInput.value = btn.dataset.val;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const items = Array.from(outPills.querySelectorAll('.badge')).map(el => el.innerText);
        navigator.clipboard.writeText(items.join('\n'));
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.fibo-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.fibo-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.fibo-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.fibo-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.fibo-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.fibo-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.fibo-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.fibo-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.fibo-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.fibo-rebuilt .output-hero-value { font-weight: 900; color: var(--tool-color); line-height: 1.2; margin: .5rem 0; }

@media (max-width: 768px) {
    .fibo-rebuilt .output-hero-value { font-size: 1.75rem !important; }
}
</style>

