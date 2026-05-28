<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter Numbers (comma-separated)</label>
                        <input type="text" id="gcf-input" class="form-control form-control-lg rounded-3" placeholder="e.g. 12, 18, 30" value="12, 18, 30">
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary" id="gcf-dist-summary">
                    <i class="fas fa-info-circle text-primary me-1"></i> The Greatest Common Factor (GCF) is the highest number that divides exactly into two or more numbers.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="gcf-output-card" style="--tool-hue:210;--tool-color:#1e40af;--tool-bg:rgba(59, 130, 246, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Greatest Common Factor</span>
                <div class="output-hero-value" id="out-gcf-result">6</div>
                <span class="output-hero-unit" id="out-gcf-label">Final GCF Result</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Dataset Size</span><span class="stat-card-value" id="out-gcf-count">3</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Minimum</span><span class="stat-card-value" id="out-gcf-min">12</span></div></div>
                <div class="col-12 col-md-4"><div class="stat-card"><span class="stat-card-label">Maximum</span><span class="stat-card-value" id="out-gcf-max">30</span></div></div>
            </div>

            <div class="mt-4" id="out-gcf-insights"></div>

            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="gcf-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy GCF Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    // Euclidean algorithm for GCD
    function gcd(a, b) {
        a = Math.abs(a);
        b = Math.abs(b);
        while (b) {
            let t = b;
            b = a % b;
            a = t;
        }
        return a;
    }

    // Get prime factors for a number
    function getPrimeFactors(n) {
        const factors = [];
        let divisor = 2;
        while (n >= 2) {
            if (n % divisor === 0) {
                factors.push(divisor);
                n = n / divisor;
            } else {
                divisor++;
            }
        }
        return factors.join(' × ') || 'Prime';
    }

    function calculate() {
        const rawInput = $('gcf-input').value;
        const numbers = rawInput.split(',').map(n => parseInt(n.trim(), 10)).filter(n => !isNaN(n) && n > 0);
        
        if (numbers.length === 0) {
            $('out-gcf-result').textContent = '--';
            $('out-gcf-count').textContent = '--';
            $('out-gcf-min').textContent = '--';
            $('out-gcf-max').textContent = '--';
            return;
        }

        // Stats update
        $('out-gcf-count').textContent = numbers.length;
        $('out-gcf-min').textContent = Math.min(...numbers);
        $('out-gcf-max').textContent = Math.max(...numbers);

        if (numbers.length === 1) {
            $('out-gcf-result').textContent = numbers[0];
            return;
        }

        // Calculate GCF for all numbers
        let currentGcd = numbers[0];
        for (let i = 1; i < numbers.length; i++) {
            currentGcd = gcd(currentGcd, numbers[i]);
        }

        $('out-gcf-result').textContent = currentGcd;

    }

    $('gcf-input').addEventListener('input', calculate);

    $('gcf-copy').addEventListener('click', function() {
        const result = $('out-gcf-result').textContent;
        const input = $('gcf-input').value;
        const text = `GCF Calculator Results\nNumbers: ${input}\nGreatest Common Factor: ${result}\n— ToolsHub Performance`;
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
.output-hero-value { font-size:3.5rem; font-weight:900; color:var(--tool-color); line-height:1.2; margin-bottom:.5rem; }
.output-hero-unit { display:block; font-size:.95rem; font-weight:600; color:#94a3b8; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }

.segment-bar { transition:transform .2s; }
.segment-bar:hover { transform:translateX(4px); }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\greatest-common-factor-calculator.blade.php ENDPATH**/ ?>