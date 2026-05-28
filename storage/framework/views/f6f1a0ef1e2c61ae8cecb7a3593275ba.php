<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Radicand (Number inside root)</label>
                        <input type="number" id="nr-radicand" class="form-control form-control-lg rounded-3" placeholder="e.g. 81" value="81">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Index or Degree (n)</label>
                        <input type="number" id="nr-index" class="form-control form-control-lg rounded-3" placeholder="e.g. 4" value="4">
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-sky me-1" style="color:#0ea5e9"></i> The <strong>n</strong>th root of a number <strong>x</strong> is a value that, when multiplied by itself <strong>n</strong> times, equals <strong>x</strong>.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="nr-output-card" style="--tool-hue:190;--tool-color:#0284c7;--tool-bg:rgba(14, 165, 233, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Root</span>
                <div class="output-hero-value" id="out-nr-result">3</div>
                <span class="output-hero-unit" id="out-nr-equation">3 × 3 × 3 × 3 = 81</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Radical Form</span><span class="stat-card-value" id="out-nr-rad"><sup>4</sup>√81</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Exponent Form</span><span class="stat-card-value" id="out-nr-exp">81<sup>1/4</sup></span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Result Type</span><span class="stat-card-value" id="out-nr-type">Perfect</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="nr-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Calculation
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const x = parseFloat($('nr-radicand').value);
        const n = parseFloat($('nr-index').value);
        
        if (isNaN(x) || isNaN(n)) {
            $('out-nr-result').textContent = '--';
            $('out-nr-equation').textContent = 'Waiting for input...';
            $('out-nr-rad').textContent = '--';
            $('out-nr-exp').textContent = '--';
            $('out-nr-type').textContent = '--';
            return;
        }

        if (n === 0) {
            $('out-nr-result').textContent = 'Undefined';
            $('out-nr-equation').textContent = 'Degree 0 is mathematically undefined.';
            return;
        }

        if (x < 0 && n % 2 === 0) {
            $('out-nr-result').textContent = 'Imaginary';
            $('out-nr-equation').textContent = 'Even roots of negative numbers are complex.';
            return;
        }

        const isNeg = x < 0;
        const absX = Math.abs(x);
        let root = Math.pow(absX, 1/n);
        if (isNeg) root = -root;

        // Correct for precision
        const rounded = Math.round(root);
        if (Math.abs(root - rounded) < 1e-10) root = rounded;

        const isPerfect = Number.isInteger(root);
        const displayRoot = isPerfect ? root : parseFloat(root.toFixed(6));

        $('out-nr-result').textContent = displayRoot.toLocaleString();
        $('out-nr-rad').innerHTML = `<sup>${n}</sup>√${x}`;
        $('out-nr-exp').innerHTML = `${x}<sup>1/${n}</sup>`;
        $('out-nr-type').textContent = isPerfect ? 'Perfect' : 'Irrational';

        if (isPerfect && Math.abs(n) <= 10 && n > 0) {
             $('out-nr-equation').textContent = `${Array(Math.abs(n)).fill(displayRoot).join(' × ')} = ${x}`;
        } else {
             $('out-nr-equation').textContent = `${displayRoot}^${n} ≈ ${x}`;
        }
    }

    ['nr-radicand', 'nr-index'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('nr-copy').addEventListener('click', function() {
        const text = `nth Root Solution\nEquation: ${$('out-nr-rad').textContent} = ${$('out-nr-result').textContent}\nResult Type: ${$('out-nr-type').textContent}\n— ToolsHub Performance`;
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
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\nth-root-calculator.blade.php ENDPATH**/ ?>