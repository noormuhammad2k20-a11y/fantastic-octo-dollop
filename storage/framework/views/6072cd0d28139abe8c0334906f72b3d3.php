<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Number of Decimal Places (1 - 5,000)</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="pi-range" class="form-range flex-grow-1" min="1" max="5000" value="100">
                            <input type="number" id="pi-input" class="form-control form-control-lg text-center" style="width: 120px;" value="100" min="1" max="5000">
                        </div>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-pink me-1" style="color:#ec4899"></i> Pi (π) is the ratio of a circle's circumference to its diameter, approximately equal to 3.14159.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="pi-output-card" style="--tool-hue:330;--tool-color:#be185d;--tool-bg:rgba(236, 72, 153, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Generated Pi (π) Value</span>
                <div class="pi-digits-container" id="out-pi-result">3.14159...</div>
                <span class="output-hero-unit mt-3">Displaying <span id="out-pi-count-hero">100</span> decimal places</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Precision (n)</span><span class="stat-card-value" id="out-pi-precision">100</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Base Value</span><span class="stat-card-value">3.1415</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Constant Type</span><span class="stat-card-value">Transcendental</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="pi-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Digits
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function spigotPi(digits) {
        let q = 1n, r = 180n, t = 60n, i = 2n, res = "", count = 0;
        while (count <= digits) {
            let y = (q * (27n * i - 12n) + 5n * r) / (5n * t);
            let u = 3n * (3n * i + 1n) * (3n * i + 2n);
            let nextR = 10n * u * (q * (5n * i - 2n) + r - y * t);
            let nextQ = 10n * q * i * (2n * i - 1n);
            t = t * u; q = nextQ; r = nextR; i = i + 1n;
            res += y.toString();
            count++;
            if (count === 1) res += ".";
        }
        return res;
    }

    let piCache = "";

    function calculate() {
        let n = parseInt($('pi-input').value, 10);
        if (isNaN(n) || n < 1) n = 1;
        if (n > 5000) n = 5000;
        
        $('pi-input').value = n;
        $('pi-range').value = n;
        $('out-pi-precision').textContent = n.toLocaleString();

        if (!piCache) {
            $('out-pi-result').innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin me-2"></i>Computing Precision...</div>';
            setTimeout(() => {
                piCache = spigotPi(5000);
                displayDigits(n);
            }, 50);
        } else {
            displayDigits(n);
        }
    }

    function displayDigits(n) {
        $('out-pi-result').textContent = piCache.substring(0, n + 2);
        $('out-pi-count-hero').textContent = n.toLocaleString();
    }

    $('pi-range').addEventListener('input', function() {
        $('pi-input').value = this.value;
        calculate();
    });

    $('pi-input').addEventListener('input', function() {
        $('pi-range').value = this.value;
        calculate();
    });

    $('pi-copy').addEventListener('click', function() {
        const result = $('out-pi-result').textContent;
        const text = `Pi (π) to ${$('pi-input').value} decimal places:\n${result}\n— ToolsHub Performance`;
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

.pi-digits-container { word-break: break-all; max-height: 300px; overflow-y: auto; text-align: left; font-family: 'JetBrains Mono', 'Fira Code', monospace; font-size: 1.1rem; line-height: 1.8; padding: 1.5rem; background: #fdf2f8; border: 1px solid #fbcfe8; border-radius: 12px; color: var(--tool-color); }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\first-n-digits-of-pi.blade.php ENDPATH**/ ?>