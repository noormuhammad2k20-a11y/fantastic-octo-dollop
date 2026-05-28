<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter Numbers (comma-separated)</label>
                        <input type="text" id="mult-input" class="form-control form-control-lg rounded-3" placeholder="e.g. 12, 15, 3" value="12, 15, 3">
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-warning me-1"></i> The product is the result of multiplying all provided numbers together.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="mult-output-card" style="--tool-hue:45;--tool-color:#ca8a04;--tool-bg:rgba(234, 179, 8, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Product</span>
                <div class="output-hero-value" id="out-mult-result">540</div>
                <span class="output-hero-unit" id="out-mult-equation">12 × 15 × 3 = 540</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Factor Count</span><span class="stat-card-value" id="out-mult-count">3</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Average Factor</span><span class="stat-card-value" id="out-mult-avg">10</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Scientific Notation</span><span class="stat-card-value" id="out-mult-sci">5.4e2</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="mult-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Solution
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const rawInput = $('mult-input').value;
        const numbers = rawInput.split(',').map(n => parseFloat(n.trim())).filter(n => !isNaN(n));
        
        if (numbers.length === 0) {
            $('out-mult-result').textContent = '--';
            $('out-mult-equation').textContent = 'Waiting for input...';
            $('out-mult-count').textContent = '0';
            $('out-mult-avg').textContent = '0';
            $('out-mult-sci').textContent = '0';
            return;
        }
        let product = 1;
        let sumFactors = 0;
        const eqParts = [];

        const displayProduct = Number.isInteger(product) ? product.toLocaleString() : parseFloat(product.toFixed(6)).toLocaleString();
        
        $('out-mult-result').textContent = displayProduct;
        $('out-mult-equation').textContent = `${eqParts.join(' × ')} = ${displayProduct}`;
        $('out-mult-count').textContent = numbers.length;
        $('out-mult-avg').textContent = (sumFactors / numbers.length).toLocaleString(undefined, {maximumFractionDigits: 2});
        $('out-mult-sci').textContent = product.toExponential(2);
    }

    $('mult-input').addEventListener('input', calculate);

    $('mult-copy').addEventListener('click', function() {
        const text = `Multiplication Solution\nEquation: ${$('out-mult-equation').textContent}\nProduct: ${$('out-mult-result').textContent}\n— ToolsHub Performance`;
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
.bg-warning-soft { background: rgba(234, 179, 8, 0.1); }
</style>
