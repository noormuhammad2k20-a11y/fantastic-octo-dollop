<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Dividend (Number to divide)</label>
                        <input type="number" id="qr-dividend" class="form-control form-control-lg rounded-3" placeholder="e.g. 100" value="100">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Divisor (Divided by)</label>
                        <input type="number" id="qr-divisor" class="form-control form-control-lg rounded-3" placeholder="e.g. 7" value="7">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="qr-output-card" style="--tool-hue:330;--tool-color:#be185d;--tool-bg:rgba(236, 72, 153, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Division Results</span>
                <div class="row g-0 align-items-center">
                    <div class="col-6 border-end border-light">
                        <div class="output-hero-value" id="out-qr-quotient">14</div>
                        <span class="output-hero-unit text-pink fw-bold">QUOTIENT</span>
                    </div>
                    <div class="col-6">
                        <div class="output-hero-value" id="out-qr-remainder">2</div>
                        <span class="output-hero-unit text-purple fw-bold">REMAINDER</span>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Decimal Value</span><span class="stat-card-value" id="out-qr-decimal">14.28</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Mixed Fraction</span><span class="stat-card-value" id="out-qr-fraction">14 2/7</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Modulo Form</span><span class="stat-card-value" id="out-qr-mod">100 mod 7</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="qr-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Solution
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const dividend = parseInt($('qr-dividend').value, 10);
        const divisor = parseInt($('qr-divisor').value, 10);
        
        if (isNaN(dividend) || isNaN(divisor)) {
            $('out-qr-quotient').textContent = '--';
            $('out-qr-remainder').textContent = '--';
            $('out-qr-decimal').textContent = '--';
            $('out-qr-fraction').textContent = '--';
            $('out-qr-mod').textContent = '--';
            return;
        }

        if (divisor === 0) {
            $('out-qr-quotient').textContent = 'Error';
            $('out-qr-remainder').textContent = 'NaN';
            return;
        }

        const quotient = Math.floor(dividend / divisor);
        const remainder = dividend % divisor;
        const decimal = dividend / divisor;
        
        $('out-qr-quotient').textContent = quotient.toLocaleString();
        $('out-qr-remainder').textContent = remainder.toLocaleString();
        $('out-qr-decimal').textContent = Number.isInteger(decimal) ? decimal : decimal.toFixed(4);
        $('out-qr-fraction').textContent = remainder !== 0 ? `${quotient} ${Math.abs(remainder)}/${Math.abs(divisor)}` : quotient;
        $('out-qr-mod').textContent = `${dividend} ≡ ${remainder} (mod ${divisor})`;
    }

    ['qr-dividend', 'qr-divisor'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('qr-copy').addEventListener('click', function() {
        const text = `Quotient & Remainder\n${$('qr-dividend').value} ÷ ${$('qr-divisor').value}\nQuotient: ${$('out-qr-quotient').textContent}\nRemainder: ${$('out-qr-remainder').textContent}\n— ToolsHub Performance`;
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
.output-hero-label { display:block; font-size:.85rem; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:1rem; }
.output-hero-value { font-size:3rem; font-weight:900; line-height:1.2; margin-bottom:.25rem; color:var(--tool-color); }
.output-hero-unit { display:block; font-size:0.75rem; letter-spacing:1px; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }

.text-pink { color: #ec4899; }
.text-purple { color: #8b5cf6; }
.breakdown-item { transition: transform 0.2s; }
.breakdown-item:hover { transform: translateX(5px); }
</style>
