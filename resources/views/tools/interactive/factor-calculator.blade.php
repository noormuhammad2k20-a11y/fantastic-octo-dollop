<div class="interactive-tool-grid factor-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Enter a Positive Integer</label>
                <input type="number" id="factor-num" class="form-control-custom" value="100" min="1">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Instantly lists divisors and prime factors.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v3 p-4" style="background: var(--surface-v2); border-radius: 15px; min-height: 100%;">
            <span class="result-label mb-2 d-block">All Factors</span>
            <div id="factors-list" class="d-flex flex-wrap gap-2 mb-4">
                <!-- Factors injected here -->
            </div>
            
            <span class="result-label mb-2 d-block">Prime Factorization</span>
            <div id="prime-factors" class="fw-bold" style="color: var(--accent-color); font-size: 1.2rem;">
                2² × 5²
            </div>

            <button class="btn d-block mx-auto btn-accent mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Factors
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('factor-num');

    function calculate() {
        const n = parseInt(input.value);
        if (isNaN(n) || n < 1) return;

        // Factors
        let factors = [];
        for (let i = 1; i <= Math.sqrt(n); i++) {
            if (n % i === 0) {
                factors.push(i);
                if (i !== n / i) factors.push(n / i);
            }
        }
        factors.sort((a,b) => a - b);

        const listEl = document.getElementById('factors-list');
        listEl.innerHTML = factors.map(f => `<span class="badge bg-secondary-soft p-2">${f}</span>`).join('');

        // Prime Factors
        let d = 2;
        let temp = n;
        let pFactors = {};
        while (temp > 1) {
            if (temp % d === 0) {
                pFactors[d] = (pFactors[d] || 0) + 1;
                temp /= d;
            } else {
                d++;
            }
        }

        const pList = Object.keys(pFactors).map(p => {
            return pFactors[p] > 1 ? `${p}<sup>${pFactors[p]}</sup>` : p;
        }).join(' × ');
        
        document.getElementById('prime-factors').innerHTML = pList || '1';
    }

    input.addEventListener('input', calculate);

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Factors of ${input.value}:\n${document.getElementById('factors-list').innerText}\nPrime Factorization: ${document.getElementById('prime-factors').innerText}\nCalculated via ToolsHub Math.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });

    calculate();
});
</script>

<style>
    .bg-secondary-soft { background: rgba(128,128,128,0.1); color: var(--text-color); border: 1px solid var(--border-color); }
</style>

