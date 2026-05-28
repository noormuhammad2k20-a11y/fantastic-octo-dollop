<div class="row g-4 prime-range-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Start Range</label>
                        <input type="number" id="start-in" class="form-control form-control-lg" value="1" min="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">End Range</label>
                        <input type="number" id="end-in" class="form-control form-control-lg" value="100" min="1" max="10000">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill range-quick" data-s="1" data-e="100">1 to 100</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill range-quick" data-s="100" data-e="500">100 to 500</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill range-quick" data-s="1000" data-e="1100">1000 to 1100</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Primes Found</span>
                <div class="output-hero-value" id="out-count">25</div>
                <div class="mt-2 text-muted fw-bold" id="out-meta">Range: 1 to 100</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Prime Density</span><span class="stat-card-value" id="out-density">25.00%</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Largest Prime</span><span class="stat-card-value" id="out-largest">97</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list me-2 text-success"></i>Primes in Range</h6>
            <div class="bg-white border rounded-3 p-3 overflow-auto" style="max-height: 400px;">
                <div id="out-pills" class="d-flex flex-wrap gap-2">
                    {{-- Dynamic Pills --}}
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Primes</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const startIn = document.getElementById('start-in');
    const endIn = document.getElementById('end-in');
    const outCount = document.getElementById('out-count');
    const outMeta = document.getElementById('out-meta');
    const outDensity = document.getElementById('out-density');
    const outLargest = document.getElementById('out-largest');
    const outPills = document.getElementById('out-pills');

    function isPrime(num){
        if(num < 2) return false;
        for(let i=2, sqrt=Math.sqrt(num); i<=sqrt; i++){
            if(num % i === 0) return false;
        }
        return true;
    }

    function calculate(){
        let start = parseInt(startIn.value);
        let end = parseInt(endIn.value);

        if(isNaN(start) || isNaN(end)) return;
        if(start > end) { [start, end] = [end, start]; }
        if(end - start > 2000) end = start + 2000; // Limit range for performance

        let primes = [];
        for(let i = start; i <= end; i++){
            if(isPrime(i)) primes.push(i);
        }

        const totalRange = end - start + 1;
        const density = (primes.length / totalRange) * 100;

        outCount.textContent = primes.length;
        outMeta.textContent = `Range: ${start} to ${end}`;
        outDensity.textContent = density.toFixed(2) + '%';
        outLargest.textContent = primes.length > 0 ? primes[primes.length - 1] : 'N/A';

        outPills.innerHTML = primes.map(p => `
            <div class="badge bg-light text-dark border p-2 fw-normal" style="font-size: 0.9rem;">
                <span class="fw-bold text-success">${p}</span>
            </div>
        `).join('');
    }

    [startIn, endIn].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.range-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            startIn.value = btn.dataset.s;
            endIn.value = btn.dataset.e;
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
.prime-range-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.prime-range-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.prime-range-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.prime-range-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.prime-range-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.prime-range-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.prime-range-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.prime-range-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.prime-range-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.prime-range-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; }

.prime-range-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.prime-range-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }
.prime-range-rebuilt .stat-card-value { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

@media (max-width: 768px) {
    .prime-range-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

