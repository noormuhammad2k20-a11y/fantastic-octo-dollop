<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3 align-items-center">
                    <div class="col-5">
                        <div class="mb-2"><input type="text" id="cm-a" class="form-control form-control-lg text-center fw-bold" placeholder="A" value="2"></div>
                        <div class="border-top border-2 border-dark my-2"></div>
                        <div><input type="text" id="cm-b" class="form-control form-control-lg text-center fw-bold" placeholder="B" value="5"></div>
                    </div>
                    <div class="col-2 text-center fs-2 fw-bold text-muted">=</div>
                    <div class="col-5">
                        <div class="mb-2"><input type="text" id="cm-c" class="form-control form-control-lg text-center fw-bold" placeholder="C" value="x"></div>
                        <div class="border-top border-2 border-dark my-2"></div>
                        <div><input type="text" id="cm-d" class="form-control form-control-lg text-center fw-bold" placeholder="D" value="15"></div>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary text-center">
                    <i class="fas fa-info-circle text-danger me-1"></i> Leave exactly one field empty or type "x" for the unknown variable.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="cm-output-card" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239, 68, 68, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Unknown Variable (x)</span>
                <div class="output-hero-value" id="out-cm-result">6</div>
                <span class="output-hero-unit" id="out-cm-equation">x = (2 × 15) ÷ 5</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Variable Found</span><span class="stat-card-value" id="out-cm-var">X</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Ratio A/B</span><span class="stat-card-value" id="out-cm-ratio1">0.4</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Ratio C/D</span><span class="stat-card-value" id="out-cm-ratio2">0.4</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="cm-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Solution
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function parseVal(val) {
        val = val.trim().toLowerCase();
        if (val === '' || val === 'x' || val === '?') return null;
        const num = parseFloat(val);
        return isNaN(num) ? null : num;
    }

    function calculate() {
        const inputs = [
            { id: 'cm-a', val: parseVal($('cm-a').value), name: 'A' },
            { id: 'cm-b', val: parseVal($('cm-b').value), name: 'B' },
            { id: 'cm-c', val: parseVal($('cm-c').value), name: 'C' },
            { id: 'cm-d', val: parseVal($('cm-d').value), name: 'D' }
        ];

        const unknowns = inputs.filter(i => i.val === null);

        if (unknowns.length !== 1) {
            $('out-cm-result').textContent = '--';
            $('out-cm-equation').textContent = 'Waiting for inputs...';
            $('out-cm-var').textContent = '--';
            $('out-cm-ratio1').textContent = '--';
            $('out-cm-ratio2').textContent = '--';
            return;
        }

        const unknown = unknowns[0];
        const a = inputs[0].val !== null ? inputs[0].val : 'x';
        const b = inputs[1].val !== null ? inputs[1].val : 'x';
        const c = inputs[2].val !== null ? inputs[2].val : 'x';
        const d = inputs[3].val !== null ? inputs[3].val : 'x';

        let result = 0;
        let step1 = '';
        let step2 = '';
        let step3 = '';

        if (inputs[0].val === null) {
            if (d === 0) { showError('Cannot divide by zero (D=0)'); return; }
            result = (b * c) / d;
            step1 = `Cross multiply: x × ${d} = ${b} × ${c}`;
            step2 = `Simplify: ${d}x = ${b * c}`;
            step3 = `Isolate x: x = ${b * c} ÷ ${d} = <strong>${result}</strong>`;
            $('out-cm-equation').textContent = `x = (${b} × ${c}) ÷ ${d}`;
            $('out-cm-var').textContent = 'A';
        } 
        else if (inputs[1].val === null) {
            if (c === 0) { showError('Cannot divide by zero (C=0)'); return; }
            result = (a * d) / c;
            step1 = `Cross multiply: ${a} × ${d} = x × ${c}`;
            step2 = `Simplify: ${a * d} = ${c}x`;
            step3 = `Isolate x: x = ${a * d} ÷ ${c} = <strong>${result}</strong>`;
            $('out-cm-equation').textContent = `x = (${a} × ${d}) ÷ ${c}`;
            $('out-cm-var').textContent = 'B';
        }
        else if (inputs[2].val === null) {
            if (b === 0) { showError('Cannot divide by zero (B=0)'); return; }
            result = (a * d) / b;
            step1 = `Cross multiply: ${a} × ${d} = ${b} × x`;
            step2 = `Simplify: ${a * d} = ${b}x`;
            step3 = `Isolate x: x = ${a * d} ÷ ${b} = <strong>${result}</strong>`;
            $('out-cm-equation').textContent = `x = (${a} × ${d}) ÷ ${b}`;
            $('out-cm-var').textContent = 'C';
        }
        else if (inputs[3].val === null) {
            if (a === 0) { showError('Cannot divide by zero (A=0)'); return; }
            result = (b * c) / a;
            step1 = `Cross multiply: ${a} × x = ${b} × ${c}`;
            step2 = `Simplify: ${a}x = ${b * c}`;
            step3 = `Isolate x: x = ${b * c} ÷ ${a} = <strong>${result}</strong>`;
            $('out-cm-equation').textContent = `x = (${b} × ${c}) ÷ ${a}`;
            $('out-cm-var').textContent = 'D';
        }

        const formattedResult = Number.isInteger(result) ? result : parseFloat(result.toFixed(6));
        $('out-cm-result').textContent = formattedResult;

        // Calculate Ratios
        const r1 = (inputs[0].val !== null && inputs[1].val !== null) ? (inputs[0].val / inputs[1].val) : (formattedResult / inputs[1].val || inputs[0].val / formattedResult);
        const r2 = (inputs[2].val !== null && inputs[3].val !== null) ? (inputs[2].val / inputs[3].val) : (formattedResult / inputs[3].val || inputs[2].val / formattedResult);
        
        $('out-cm-ratio1').textContent = Number.isInteger(r1) ? r1 : r1.toFixed(3);
        $('out-cm-ratio2').textContent = Number.isInteger(r2) ? r2 : r2.toFixed(3);
    }

    function showError(msg) {
        $('out-cm-result').textContent = '--';
        $('out-cm-equation').textContent = 'Error';
        $('out-cm-var').textContent = '--';
        $('out-cm-ratio1').textContent = '--';
        $('out-cm-ratio2').textContent = '--';
    }

    ['cm-a', 'cm-b', 'cm-c', 'cm-d'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('cm-copy').addEventListener('click', function() {
        const result = $('out-cm-result').textContent;
        const eq = $('out-cm-equation').textContent;
        const text = `Cross Multiplication Solution\nEquation: ${eq}\nResult: x = ${result}\n— ToolsHub Performance`;
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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cross-multiplication-calculator.blade.php ENDPATH**/ ?>