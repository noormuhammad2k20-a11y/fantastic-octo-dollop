<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Number of Decimal Places (1 - 10,000)</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="e-range" class="form-range flex-grow-1" min="1" max="10000" value="100">
                            <input type="number" id="e-input" class="form-control form-control-lg text-center" style="width: 120px;" value="100" min="1" max="10000">
                        </div>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-teal me-1" style="color:#14b8a6"></i> Euler's number (e) is a mathematical constant approximately equal to 2.71828, representing the base of the natural logarithm.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="e-output-card" style="--tool-hue:170;--tool-color:#0f766e;--tool-bg:rgba(20, 184, 166, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Generated Euler's Number (e)</span>
                <div class="e-digits-container" id="out-e-result">2.71828...</div>
                <span class="output-hero-unit mt-3">Displaying <span id="out-e-count-hero">100</span> decimal places</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Precision (n)</span><span class="stat-card-value" id="out-e-precision">100</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Base Value</span><span class="stat-card-value">2.7182</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Constant Type</span><span class="stat-card-value">Irrational</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="e-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Digits
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function generateE(digits) {
        const targetPrecision = digits + 10;
        const one = 10n ** BigInt(targetPrecision);
        let e = one;
        let factorial = 1n;
        
        for (let i = 1n; i < 5000n; i++) {
            factorial *= i;
            const term = one / factorial;
            if (term === 0n) break;
            e += term;
        }
        
        let eStr = e.toString();
        return "2." + eStr.substring(1, digits + 1);
    }

    let eCache = "";

    function calculate() {
        let n = parseInt($('e-input').value, 10);
        
        if (isNaN(n) || n < 1) n = 1;
        if (n > 10000) n = 10000;
        
        $('e-input').value = n;
        $('e-range').value = n;
        $('out-e-precision').textContent = n.toLocaleString();

        if (!eCache) {
            $('out-e-result').innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin me-2"></i>Computing Precision...</div>';
            setTimeout(() => {
                eCache = generateE(10000);
                displayDigits(n);
            }, 50);
        } else {
            displayDigits(n);
        }
    }

    function displayDigits(n) {
        $('out-e-result').textContent = eCache.substring(0, n + 2);
        $('out-e-count-hero').textContent = n.toLocaleString();
    }

    $('e-range').addEventListener('input', function() {
        $('e-input').value = this.value;
        calculate();
    });

    $('e-input').addEventListener('input', function() {
        $('e-range').value = this.value;
        calculate();
    });

    $('e-copy').addEventListener('click', function() {
        const result = $('out-e-result').textContent;
        const text = `Euler's Number (e) to ${$('e-input').value} decimal places:\n${result}\n— ToolsHub Performance`;
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => { this.innerHTML = originalHTML; }, 2000);
        });
    });

    displayDigits(100);
    setTimeout(calculate, 100);
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
.output-hero-unit { display:block; font-size:.95rem; font-weight:600; color:#94a3b8; }

.e-digits-container { word-break: break-all; max-height: 300px; overflow-y: auto; text-align: left; font-family: 'JetBrains Mono', 'Fira Code', monospace; font-size: 1.1rem; line-height: 1.8; padding: 1.5rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; color: var(--tool-color); }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }
</style>
