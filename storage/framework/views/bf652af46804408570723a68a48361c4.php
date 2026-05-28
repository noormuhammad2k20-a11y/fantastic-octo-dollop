<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Dividend (Number to divide)</label>
                        <input type="number" id="ld-dividend" class="form-control form-control-lg rounded-3" placeholder="e.g. 4567" value="4567">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Divisor (Divided by)</label>
                        <input type="number" id="ld-divisor" class="form-control form-control-lg rounded-3" placeholder="e.g. 23" value="23">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="ld-output-card" style="--tool-hue:210;--tool-color:#1d4ed8;--tool-bg:rgba(59, 130, 246, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Division Results</span>
                <div class="output-hero-value" id="out-ld-result">198 R 13</div>
                <span class="output-hero-unit" id="out-ld-equation">4567 ÷ 23 = 198 Rem 13</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Quotient</span><span class="stat-card-value" id="out-ld-q">198</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Remainder</span><span class="stat-card-value" id="out-ld-r">13</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Decimal Form</span><span class="stat-card-value" id="out-ld-dec">198.56</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="ld-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Full Solution
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    


    function calculate() {
        const dividend = parseInt($('ld-dividend').value, 10);
        const divisor = parseInt($('ld-divisor').value, 10);
        
        if (isNaN(dividend) || isNaN(divisor)) {
            $('out-ld-result').textContent = '--';
            $('out-ld-equation').textContent = 'Waiting for input...';
            $('out-ld-q').textContent = '--';
            $('out-ld-r').textContent = '--';
            $('out-ld-dec').textContent = '--';

        if (divisor === 0) {
            showError('Cannot divide by zero.');
            return;
        }

        const quotient = Math.floor(Math.abs(dividend) / Math.abs(divisor));
        const remainder = Math.abs(dividend) % Math.abs(divisor);
        const isNeg = (dividend < 0 && divisor > 0) || (dividend > 0 && divisor < 0);
        const finalQ = isNeg ? -quotient : quotient;
        const decResult = dividend / divisor;

        $('out-ld-result').textContent = `${finalQ} R ${remainder}`;
        $('out-ld-equation').textContent = `${dividend} ÷ ${divisor} = ${finalQ} Rem ${remainder}`;
        $('out-ld-q').textContent = finalQ;
        $('out-ld-r').textContent = remainder;
        $('out-ld-dec').textContent = Number.isInteger(decResult) ? decResult : decResult.toFixed(4);
    }

    function showError(msg) {
        $('out-ld-result').textContent = 'Error';
        $('out-ld-equation').textContent = msg;
        $('out-ld-q').textContent = '--';
        $('out-ld-r').textContent = '--';
        $('out-ld-dec').textContent = '--';
    }

    ['ld-dividend', 'ld-divisor'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('ld-copy').addEventListener('click', function() {
        const text = `Long Division Result\nEquation: ${$('out-ld-equation').textContent}\nQuotient: ${$('out-ld-q').textContent}\nRemainder: ${$('out-ld-r').textContent}\n— ToolsHub Performance`;
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

.ld-visualization-box { background: #f8fafc; padding: 2rem; border-radius: 12px; border: 1px solid #e2e8f0; font-family: 'JetBrains Mono', 'Fira Code', monospace; font-size: 1.1rem; line-height: 1.5; color: #1e293b; overflow-x: auto; white-space: pre; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\long-division-calculator.blade.php ENDPATH**/ ?>