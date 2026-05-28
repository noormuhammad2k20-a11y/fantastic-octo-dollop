<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Enter Number (Radicand)</label>
                        <input type="number" id="cr-input" class="form-control form-control-lg rounded-3" placeholder="e.g. 343" value="343">
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-indigo me-1" style="color:#6366f1"></i> The cube root of a number <strong>x</strong> is a number <strong>y</strong> such that <strong>y³ = x</strong>.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="cr-output-card" style="--tool-hue:230;--tool-color:#4338ca;--tool-bg:rgba(99, 102, 241, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Cube Root (∛x)</span>
                <div class="output-hero-value" id="out-cr-result">7</div>
                <span class="output-hero-unit" id="out-cr-equation">7 × 7 × 7 = 343</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Radicand</span><span class="stat-card-value" id="out-cr-val">343</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Root Index</span><span class="stat-card-value">3</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Perfect Cube</span><span class="stat-card-value" id="out-cr-perfect">Yes</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="cr-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const rawInput = $('cr-input').value;
        const num = parseFloat(rawInput);
        
        if (isNaN(num)) {
            $('out-cr-result').textContent = '--';
            $('out-cr-equation').textContent = 'Waiting for input...';
            $('out-cr-val').textContent = '--';
            $('out-cr-perfect').textContent = '--';
            return;
        }

        const isNegative = num < 0;
        const absNum = Math.abs(num);
        let root = Math.cbrt(absNum);
        if (isNegative) root = -root;

        const roundedRoot = Math.round(root);
        if (Math.abs(root - roundedRoot) < 1e-10) root = roundedRoot;

        const isPerfectCube = Number.isInteger(root);
        const displayRoot = isPerfectCube ? root : root.toFixed(6);

        $('out-cr-result').textContent = displayRoot;
        $('out-cr-equation').textContent = `${displayRoot} × ${displayRoot} × ${displayRoot} ≈ ${num}`;
        $('out-cr-val').textContent = num;
        $('out-cr-perfect').textContent = isPerfectCube ? 'Yes' : 'No';
    }

    $('cr-input').addEventListener('input', calculate);

    $('cr-copy').addEventListener('click', function() {
        const result = $('out-cr-result').textContent;
        const input = $('cr-input').value;
        const text = `Cube Root Results\nNumber: ${input}\nCube Root (∛): ${result}\n— ToolsHub Performance`;
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

.segment-bar { transition:transform .2s; }
.segment-bar:hover { transform:translateX(4px); }
</style>
