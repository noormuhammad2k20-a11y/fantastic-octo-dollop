<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter a Number</label>
                        <input type="number" id="prime-input" class="form-control form-control-lg rounded-3" placeholder="e.g. 97" value="97" min="1">
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-success me-1"></i> A prime number is a positive integer greater than 1 that has exactly two divisors: 1 and itself.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="prime-output-card" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16, 185, 129, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Primality Assessment</span>
                <div class="output-hero-value" id="out-prime-status">Is Prime</div>
                <span class="output-hero-unit" id="out-prime-number">97</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Previous Prime</span><span class="stat-card-value" id="out-prime-prev">89</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Next Prime</span><span class="stat-card-value" id="out-prime-next">101</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Divisors Count</span><span class="stat-card-value" id="out-prime-factors-label">2</span></div></div>
            </div>

            <div class="mt-4" id="out-prime-insights"></div>

            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="prime-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Analysis
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

    function getFactors(num) {
        if (num <= 0) return [];
        const factors = [];
        for (let i = 1; i <= Math.sqrt(num); i++) {
            if (num % i === 0) {
                factors.push(i);
                if (i !== num / i) {
                    factors.push(num / i);
                }
            }
        }
        return factors.sort((a, b) => a - b);
    }

    function findNextPrime(num) {
        let n = num + 1;
        while (!isPrime(n)) n++;
        return n;
    }

    function findPrevPrime(num) {
        if (num <= 2) return 'None';
        let n = num - 1;
        while (n > 1 && !isPrime(n)) n--;
        return n > 1 ? n : 'None';
    }

    function calculate() {
        const num = parseInt($('prime-input').value, 10);
        const card = $('prime-output-card');
        
        if (isNaN(num) || num < 1) {
            $('out-prime-status').textContent = 'Invalid Input';
            $('out-prime-status').style.color = '#ef4444';
            $('out-prime-number').textContent = '--';
            $('out-prime-prev').textContent = '--';
            $('out-prime-next').textContent = '--';
            $('out-prime-factors-label').textContent = '--';
            card.style.setProperty('--tool-color', '#ef4444');
            card.style.setProperty('--tool-bg', 'rgba(239, 68, 68, 0.04)');
            return;
        }

        $('out-prime-number').textContent = num.toLocaleString();

        const prime = isPrime(num);
        if (prime) {
            $('out-prime-status').textContent = 'Is Prime';
            $('out-prime-status').style.color = '#10b981';
            card.style.setProperty('--tool-color', '#10b981');
            card.style.setProperty('--tool-bg', 'rgba(16, 185, 129, 0.04)');
            $('out-prime-factors-label').textContent = '2';

        } else {
            const isOne = num === 1;
            $('out-prime-status').textContent = isOne ? 'Neither Prime Nor Composite' : 'Is Composite';
            const statusColor = isOne ? '#64748b' : '#f59e0b';
            $('out-prime-status').style.color = statusColor;
            card.style.setProperty('--tool-color', statusColor);
            card.style.setProperty('--tool-bg', isOne ? 'rgba(100, 116, 139, 0.04)' : 'rgba(245, 158, 11, 0.04)');
            
            const factors = getFactors(num);
            $('out-prime-factors-label').textContent = factors.length;

        }

        $('out-prime-prev').textContent = findPrevPrime(num).toLocaleString();
        $('out-prime-next').textContent = findNextPrime(num).toLocaleString();
    }

    $('prime-input').addEventListener('input', calculate);

    $('prime-copy').addEventListener('click', function() {
        const num = $('prime-input').value;
        const status = $('out-prime-status').textContent;
        const text = `Prime Number Analysis\nNumber: ${num}\nStatus: ${status}\n— ToolsHub Performance`;

        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => { this.innerHTML = originalHTML; }, 2000);
        });
    });

    // Initial calculation
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
.output-hero-value { font-size:3rem; font-weight:900; color:var(--tool-color); line-height:1.2; margin-bottom:.5rem; transition: color 0.4s; }
.output-hero-unit { display:block; font-size:.95rem; font-weight:600; color:#94a3b8; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }

.segment-bar { transition:transform .2s; }
.segment-bar:hover { transform:translateX(4px); }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\prime-number-checker.blade.php ENDPATH**/ ?>