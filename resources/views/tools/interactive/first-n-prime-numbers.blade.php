<div class="row g-4 prime-list-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">How many primes (n)?</label>
                        <input type="number" id="count-in" class="form-control form-control-lg" value="50" min="1" max="1000">
                        <div class="mt-2 text-muted small">Generating more than 1,000 primes may impact browser performance.</div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill prime-quick" data-count="10">First 10</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill prime-quick" data-count="100">First 100</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill prime-quick" data-count="500">First 500</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">The ${n}th Prime</span>
                <div class="output-hero-value" id="out-last">229</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">Sequence: 2, 3, 5...</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list-ol me-2 text-danger"></i>Prime Number Sequence</h6>
            <div class="bg-white border rounded-3 p-3 overflow-auto" style="max-height: 400px;">
                <div id="out-pills" class="d-flex flex-wrap gap-2">
                    {{-- Dynamic Pills --}}
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Primes (CSV)</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const countIn = document.getElementById('count-in');
    const outLast = document.getElementById('out-last');
    const outMeta = document.getElementById('out-meta');
    const outPills = document.getElementById('out-pills');

    function isPrime(num){
        if(num < 2) return false;
        for(let i=2, sqrt=Math.sqrt(num); i<=sqrt; i++){
            if(num % i === 0) return false;
        }
        return true;
    }

    function calculate(){
        const n = parseInt(countIn.value);
        if(isNaN(n) || n < 1) return;

        let primes = [];
        let num = 2;
        while(primes.length < n){
            if(isPrime(num)) primes.push(num);
            num++;
        }

        const last = primes[primes.length - 1];
        outLast.textContent = last.toLocaleString();
        outMeta.textContent = `List of the first ${n} primes`;

        outPills.innerHTML = primes.map((p, i) => `
            <div class="badge bg-light text-dark border p-2 fw-normal" style="font-size: 0.9rem;">
                <span class="text-muted small me-1">#${i+1}:</span> <span class="fw-bold text-danger">${p}</span>
            </div>
        `).join('');
    }

    countIn.addEventListener('input', calculate);

    document.querySelectorAll('.prime-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            countIn.value = btn.dataset.count;
            calculate();
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        const items = Array.from(outPills.querySelectorAll('.fw-bold')).map(el => el.innerText);
        navigator.clipboard.writeText(items.join(', '));
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });

    calculate();
});
</script>

<style>
.prime-list-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.prime-list-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.prime-list-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.prime-list-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.prime-list-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.prime-list-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.prime-list-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.prime-list-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.prime-list-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.prime-list-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

@media (max-width: 768px) {
    .prime-list-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

