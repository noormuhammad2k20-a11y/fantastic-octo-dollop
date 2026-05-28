<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter a Number</label>
                        <input type="text" id="nd-input" class="form-control form-control-lg rounded-3" placeholder="e.g. -1,234.56" value="123456789">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="nd-output-card" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16, 185, 129, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Total Digit Count</span>
                <div class="output-hero-value" id="out-nd-result">9</div>
                <span class="output-hero-unit" id="out-nd-summary">Total digits in 123,456,789</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Integer Digits</span><span class="stat-card-value" id="out-nd-whole">9</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Decimal Digits</span><span class="stat-card-value" id="out-nd-decimal">0</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Log10 Scale</span><span class="stat-card-value" id="out-nd-log">8.09</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="nd-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Solution
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const rawInput = $('nd-input').value.trim();
        
        if (rawInput === '') {
            $('out-nd-result').textContent = '0';
            $('out-nd-summary').textContent = 'Waiting for input...';
            $('out-nd-whole').textContent = '0';
            $('out-nd-decimal').textContent = '0';
            $('out-nd-log').textContent = '0';
            return;
        }

        const cleanStr = rawInput.replace(/[^0-9\.\-]/g, '');
        const justDigits = cleanStr.replace(/[^0-9]/g, '');
        const digitCount = justDigits.length;

        const decParts = cleanStr.split('.');
        const wholeStr = decParts[0].replace(/[^0-9]/g, '');
        const decimalStr = decParts.length > 1 ? decParts[1].replace(/[^0-9]/g, '') : '';

        const wholeCount = wholeStr.length;
        const decCount = decimalStr.length;

        const numVal = Math.abs(parseFloat(cleanStr));
        const logVal = (!isNaN(numVal) && numVal > 0) ? Math.log10(numVal).toFixed(2) : '0';

        $('out-nd-result').textContent = digitCount.toLocaleString();
        $('out-nd-summary').textContent = `Total digits found in "${rawInput}"`;
        $('out-nd-whole').textContent = wholeCount;
        $('out-nd-decimal').textContent = decCount;
        $('out-nd-log').textContent = logVal;
    }

    $('nd-input').addEventListener('input', calculate);

    $('nd-copy').addEventListener('click', function() {
        const text = `Number of Digits Analysis\nInput: ${$('nd-input').value}\nTotal Digits: ${$('out-nd-result').textContent}\n— ToolsHub Performance`;
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
.output-hero-value { font-size:3.5rem; font-weight:900; line-height:1.2; margin-bottom:.5rem; color:var(--tool-color); }
.output-hero-unit { display:block; font-size:.95rem; font-weight:600; color:#94a3b8; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }

.breakdown-item { transition: transform 0.2s; }
.breakdown-item:hover { transform: translateX(5px); }
.bg-emerald-soft { background: rgba(16, 185, 129, 0.1); }
.text-emerald { color: #10b981; }
.bg-slate-soft { background: rgba(148, 163, 184, 0.1); }
.text-slate { color: #64748b; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\number-of-digits-calculator.blade.php ENDPATH**/ ?>