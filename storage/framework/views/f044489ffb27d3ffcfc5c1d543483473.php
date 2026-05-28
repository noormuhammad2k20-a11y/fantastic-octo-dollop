<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter Numbers (comma-separated)</label>
                        <input type="text" id="cf-input" class="form-control form-control-lg rounded-3" placeholder="e.g. 24, 36, 48" value="24, 36, 48">
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-purple me-1" style="color:#8b5cf6"></i> A common factor is a number that divides perfectly into two or more numbers without leaving a remainder.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="cf-output-card" style="--tool-hue:260;--tool-color:#6d28d9;--tool-bg:rgba(139, 92, 246, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Common Factors List</span>
                <div class="output-hero-value" id="out-cf-result" style="font-size: 2.5rem; word-break: break-word;">1, 2, 3, 4, 6, 12</div>
                <span class="output-hero-unit">Shared Divisors Found</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Total Shared</span><span class="stat-card-value" id="out-cf-count">6</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Greatest (GCF)</span><span class="stat-card-value" id="out-cf-gcf">12</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Coprime</span><span class="stat-card-value" id="out-cf-coprime">No</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="cf-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Divisors
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
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

    function intersection(arrays) {
        if (arrays.length === 0) return [];
        return arrays[0].filter(value => arrays.every(arr => arr.includes(value)));
    }

    function calculate() {
        const rawInput = $('cf-input').value;
        const numbers = rawInput.split(',').map(n => parseInt(n.trim(), 10)).filter(n => !isNaN(n) && n > 0);
        
        if (numbers.length === 0) {
            $('out-cf-result').textContent = '--';
            $('out-cf-count').textContent = '--';
            $('out-cf-gcf').textContent = '--';
            $('out-cf-coprime').textContent = '--';
            return;
        }

        const allFactors = numbers.map(n => getFactors(n));
        const commonFactors = intersection(allFactors);
        const gcf = commonFactors.length > 0 ? commonFactors[commonFactors.length - 1] : 0;
        const isCoprime = commonFactors.length === 1 && commonFactors[0] === 1;

        $('out-cf-result').textContent = commonFactors.length > 0 ? commonFactors.join(', ') : 'None';
        $('out-cf-count').textContent = commonFactors.length;
        $('out-cf-gcf').textContent = gcf || '--';
        $('out-cf-coprime').textContent = isCoprime ? 'Yes' : 'No';
    }

    $('cf-input').addEventListener('input', calculate);

    $('cf-copy').addEventListener('click', function() {
        const result = $('out-cf-result').textContent;
        const input = $('cf-input').value;
        const text = `Common Factors Results\nNumbers: ${input}\nShared Factors: ${result}\n— ToolsHub Performance`;
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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\common-factor-calculator.blade.php ENDPATH**/ ?>