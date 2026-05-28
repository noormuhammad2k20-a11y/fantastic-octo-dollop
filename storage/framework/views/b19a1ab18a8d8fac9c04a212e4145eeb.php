<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter a Number</label>
                        <input type="number" id="pfc-input" class="form-control form-control-lg rounded-3" placeholder="e.g. 210" value="210" min="2">
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-teal me-1" style="color:#14b8a6"></i> A prime factor is a prime number that divides another number completely.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="pfc-output-card" style="--tool-hue:170;--tool-color:#0f766e;--tool-bg:rgba(20, 184, 166, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Unique Prime Factors</span>
                <div class="output-hero-value" id="out-pfc-result" style="font-size: 2.5rem;">2, 3, 5, 7</div>
                <span class="output-hero-unit" id="out-pfc-number">of 210</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Distinct Primes</span><span class="stat-card-value" id="out-pfc-count">4</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Smallest Factor</span><span class="stat-card-value" id="out-pfc-min">2</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Largest Factor</span><span class="stat-card-value" id="out-pfc-max">7</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="pfc-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Prime Factors
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function isPrime(num) {
        if (num <= 1) return false;
        if (num <= 3) return true;
        if (num % 2 === 0 || num % 3 === 0) return false;
        for (let i = 5; i * i <= num; i += 6) {
            if (num % i === 0 || num % (i + 2) === 0) return false;
        }
        return true;
    }

    function calculate() {
        const num = parseInt($('pfc-input').value, 10);
        
        if (isNaN(num) || num < 2) {
            $('out-pfc-result').textContent = '--';
            $('out-pfc-number').textContent = 'Invalid Input';
            $('out-pfc-count').textContent = '--';
            $('out-pfc-min').textContent = '--';
            $('out-pfc-max').textContent = '--';
            return;
        }

        if (num > 9007199254740991) {
             $('out-pfc-result').textContent = 'Limit Exceeded';
             $('out-pfc-breakdown').innerHTML = '<div class="text-danger small p-3 text-center bg-white rounded-3 border">Number exceeds safe JS integer limits.</div>';
             return;
        }

        $('out-pfc-number').textContent = `of ${num.toLocaleString()}`;

        if (isPrime(num)) {
            $('out-pfc-result').textContent = num.toString();
            $('out-pfc-count').textContent = '1';
            $('out-pfc-min').textContent = num;
            $('out-pfc-max').textContent = num;
            return;
        }

        let n = num;
        let factors = [];
        let divisor = 2;
        while (n >= 2 && divisor * divisor <= n) {
            if (n % divisor === 0) {
                factors.push(divisor);
                n = n / divisor;
            } else {
                divisor++;
            }
        }
        if (n > 1) factors.push(n);

        const uniqueFactors = [...new Set(factors)];
        $('out-pfc-result').textContent = uniqueFactors.join(', ');
        $('out-pfc-count').textContent = uniqueFactors.length;
        $('out-pfc-min').textContent = uniqueFactors[0];
        $('out-pfc-max').textContent = uniqueFactors[uniqueFactors.length - 1];
    }

    $('pfc-input').addEventListener('input', calculate);

    $('pfc-copy').addEventListener('click', function() {
        const result = $('out-pfc-result').textContent;
        const input = $('pfc-input').value;
        const text = `Prime Factors Results\nNumber: ${input}\nUnique Prime Factors: ${result}\n— ToolsHub Performance`;
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => { this.innerHTML = originalHTML; }, 2000);
        });
    });

    calculate();
});
</script>

<style>
.tri-calc-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,.04); }
.tri-calc-rebuilt .calculator-header { display:flex; align-items:center; gap:1rem; margin-bottom:2rem; }
.tri-calc-rebuilt .calculator-header h4 { margin:0; font-weight:800; color:#1e293b; }
.tri-calc-rebuilt .calculator-header p { margin:0; font-size:.9rem; color:#64748b; }
.tri-calc-rebuilt .tool-icon-circle { width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; flex-shrink:0; }
.tri-calc-rebuilt .form-label-custom { font-size:.8rem; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.4rem; display:block; }

.output-card-themed { background:var(--tool-bg); border:1px solid rgba(0,0,0,.05); border-radius:20px; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,.04); transition:all .4s }
.output-hero { text-align:center; padding:2rem; background:#fff; border-radius:16px; margin-bottom:2rem; box-shadow:0 2px 12px rgba(0,0,0,.03); border:1px solid rgba(0,0,0,.05); }
.output-hero-label { display:block; font-size:.85rem; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:.5rem; }
.output-hero-value { font-weight:900; line-height:1.2; margin-bottom:.5rem; color:var(--tool-color); }
.output-hero-unit { display:block; font-size:.95rem; font-weight:600; color:#94a3b8; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }

.segment-bar { transition:transform .2s; }
.segment-bar:hover { transform:translateX(4px); }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\prime-factor-calculator.blade.php ENDPATH**/ ?>