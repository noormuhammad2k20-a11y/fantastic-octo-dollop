<div class="row g-4 tri-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-5">
                        <label class="form-label-custom text-center d-block">Value A</label>
                        <input type="number" id="rat-a" class="form-control form-control-lg text-center fw-bold rat-input" placeholder="e.g. 4" value="4">
                    </div>
                    <div class="col-2 text-center fs-3 fw-bold text-muted">:</div>
                    <div class="col-5">
                        <label class="form-label-custom text-center d-block">Value B</label>
                        <input type="number" id="rat-b" class="form-control form-control-lg text-center fw-bold rat-input" placeholder="e.g. 10" value="10">
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-12 text-center fs-3 fw-bold text-muted">=</div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="col-5">
                        <label class="form-label-custom text-center d-block">Value C</label>
                        <input type="number" id="rat-c" class="form-control form-control-lg text-center fw-bold rat-input" placeholder="e.g. 12" value="12">
                    </div>
                    <div class="col-2 text-center fs-3 fw-bold text-muted">:</div>
                    <div class="col-5">
                        <label class="form-label-custom text-center d-block text-danger">Value D (Missing)</label>
                        <input type="number" id="rat-d" class="form-control form-control-lg text-center fw-bold rat-input" placeholder="?" value="">
                    </div>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-rose me-1" style="color:#f43f5e"></i> Leave exactly one field empty to calculate its value.
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-outline-secondary btn-sm" id="rat-clear">Clear All Fields</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="rat-output-card" style="--tool-hue:350;--tool-color:#e11d48;--tool-bg:rgba(244, 63, 94, 0.04); transition: all 0.4s;">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Missing Value</span>
                <div class="output-hero-value" id="out-rat-result">30</div>
                <span class="output-hero-unit" id="out-rat-equation">4 : 10 = 12 : <span class="text-rose fw-bold">30</span></span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Decimal Ratio</span><span class="stat-card-value" id="out-rat-dec">0.40</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Percentage</span><span class="stat-card-value" id="out-rat-pct">40%</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Inverse Ratio</span><span class="stat-card-value" id="out-rat-inv">2.50</span></div></div>
            </div>


            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="rat-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Solution
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function calculate() {
        const aStr = $('rat-a').value.trim();
        const bStr = $('rat-b').value.trim();
        const cStr = $('rat-c').value.trim();
        const dStr = $('rat-d').value.trim();

        const a = aStr === '' ? null : parseFloat(aStr);
        const b = bStr === '' ? null : parseFloat(bStr);
        const c = cStr === '' ? null : parseFloat(cStr);
        const d = dStr === '' ? null : parseFloat(dStr);

        const nulls = [a, b, c, d].filter(x => x === null).length;

        if (nulls !== 1) {
            $('out-rat-result').textContent = '--';
            $('out-rat-equation').textContent = 'Waiting for input...';
            $('out-rat-dec').textContent = '--';
            $('out-rat-pct').textContent = '--';
            $('out-rat-inv').textContent = '--';
            return;
        }

        let result = 0, targetVar = '', formula = '', step1 = '', step2 = '';

        if (a === null) { result = (b * c) / d; targetVar = 'A'; formula = 'A = (B × C) / D'; step1 = `(${b} × ${c}) / ${d}`; step2 = `${b*c} / ${d}`; }
        else if (b === null) { result = (a * d) / c; targetVar = 'B'; formula = 'B = (A × D) / C'; step1 = `(${a} × ${d}) / ${c}`; step2 = `${a*d} / ${c}`; }
        else if (c === null) { result = (a * d) / b; targetVar = 'C'; formula = 'C = (A × D) / B'; step1 = `(${a} × ${d}) / ${b}`; step2 = `${a*d} / ${b}`; }
        else if (d === null) { result = (b * c) / a; targetVar = 'D'; formula = 'D = (B × C) / A'; step1 = `(${b} × ${c}) / ${a}`; step2 = `${b*c} / ${a}`; }

        if (!isFinite(result)) {
             $('out-rat-result').textContent = 'Error';
             $('out-rat-equation').textContent = 'Division by zero is impossible.';
             return;
        }

        const formattedResult = Number.isInteger(result) ? result : parseFloat(result.toFixed(4));
        const finalA = a === null ? formattedResult : a;
        const finalB = b === null ? formattedResult : b;
        
        const decimalRatio = finalA / finalB;

        $('out-rat-result').textContent = formattedResult.toLocaleString();
        $('out-rat-equation').innerHTML = `${a === null ? '<span class="text-rose">'+formattedResult+'</span>' : a} : ${b === null ? '<span class="text-rose">'+formattedResult+'</span>' : b} = ${c === null ? '<span class="text-rose">'+formattedResult+'</span>' : c} : ${d === null ? '<span class="text-rose">'+formattedResult+'</span>' : d}`;
        
        $('out-rat-dec').textContent = decimalRatio.toFixed(3);
        $('out-rat-pct').textContent = (decimalRatio * 100).toFixed(1) + '%';
        $('out-rat-inv').textContent = (1 / decimalRatio).toFixed(3);
    }

    document.querySelectorAll('.rat-input').forEach(el => el.addEventListener('input', calculate));
    $('rat-clear').addEventListener('click', () => { document.querySelectorAll('.rat-input').forEach(el => el.value = ''); calculate(); });

    $('rat-copy').addEventListener('click', function() {
        const text = `Equivalent Ratio Solution\n${$('out-rat-equation').innerText}\nMissing Value: ${$('out-rat-result').textContent}\n— ToolsHub Performance`;
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
.output-hero-unit { display:block; font-size:1.1rem; font-weight:600; color:#64748b; }

.stat-card { background:#fff; padding:1.25rem; border-radius:16px; text-align:center; border:1px solid #f1f5f9; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.stat-card-label { display:block; font-size:0.65rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.25rem; }
.stat-card-value { display:block; font-size:1.25rem; font-weight:800; color:#1e293b; }

.breakdown-item { transition: transform 0.2s; }
.breakdown-item:hover { transform: translateX(5px); }
.bg-rose-soft { background: rgba(244, 63, 94, 0.1); }
.text-rose { color: #f43f5e; }
.bg-slate-soft { background: rgba(148, 163, 184, 0.1); }
.text-slate { color: #64748b; }
.bg-emerald-soft { background: rgba(16, 185, 129, 0.1); }
.text-emerald { color: #10b981; }
</style>
