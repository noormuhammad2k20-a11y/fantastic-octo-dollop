<div class="row g-4 geometry-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Base (a)</label>
                        <input type="number" id="in-base-a" class="form-control form-control-lg rounded-3" value="10" step="any">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Base (b)</label>
                        <input type="number" id="in-base-b" class="form-control form-control-lg rounded-3" value="15" step="any">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Height (h)</label>
                        <input type="number" id="in-height" class="form-control form-control-lg rounded-3" value="5" step="any">
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-8">
                        <label class="form-label-custom">Unit</label>
                        <select id="in-unit" class="form-select form-select-lg rounded-3">
                            <option value="mm">mm</option>
                            <option value="cm" selected>cm</option>
                            <option value="m">m</option>
                            <option value="in">in</option>
                            <option value="ft">ft</option>
                            <option value="yd">yd</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Decimal Precision</label>
                        <select id="in-precision" class="form-select form-select-lg rounded-3">
                            <option value="2" selected>2 places</option>
                            <option value="4">4 places</option>
                            <option value="6">6 places</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm" id="btn-calc" style="background:#ec4899;border-color:#ec4899;"><i class="fas fa-calculator me-2"></i>Calculate</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill px-4" id="btn-reset"><i class="fas fa-undo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12 d-none" id="output-wrapper">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero text-center">
                <span class="output-hero-label">Calculated Area</span>
                <div class="output-hero-value" id="out-area">—</div>
                <div class="mt-1 text-muted fw-medium" id="out-unit-display">sq. units</div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-square-root-variable me-2 text-danger"></i>Calculation Steps</h6>
                <div class="p-4 bg-white rounded-4 border border-light-subtle shadow-sm">
                    <div class="step-item mb-4">
                        <div class="step-label">1. Formula for Area</div>
                        <div class="step-formula">A = \frac{a + b}{2} \times h</div>
                    </div>
                    <div class="step-item mb-4">
                        <div class="step-label">2. Substitution</div>
                        <div class="step-formula" id="step-substitution">—</div>
                    </div>
                    <div class="step-item">
                        <div class="step-label">3. Final Result</div>
                        <div class="step-formula" id="step-final">—</div>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-5 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Results</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);

    function calculate(){
        const a = parseFloat($('in-base-a').value);
        const b = parseFloat($('in-base-b').value);
        const h = parseFloat($('in-height').value);
        const unit = $('in-unit').value;
        const prec = parseInt($('in-precision').value);

        if(isNaN(a) || isNaN(b) || isNaN(h) || a <= 0 || b <= 0 || h <= 0){
            $('output-wrapper').classList.add('d-none');
            return;
        }

        const area = ((a + b) / 2) * h;
        const fArea = area.toFixed(prec);

        $('out-area').textContent = fArea;
        $('out-unit-display').textContent = `sq. ${unit}`;

        // Steps
        $('step-substitution').textContent = `A = \\frac{${a} + ${b}}{2} \\times ${h}`;
        $('step-final').textContent = `A = ${fArea} \text{ ${unit}}^2`;

        $('output-wrapper').classList.remove('d-none');
    }

    $('btn-calc').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('in-base-a').value = 10;
        $('in-base-b').value = 15;
        $('in-height').value = 5;
        $('output-wrapper').classList.add('d-none');
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Trapezoid Area Calculation\n` +
                     `--------------------------\n` +
                     `Base a: ${$('in-base-a').value} ${$('in-unit').value}\n` +
                     `Base b: ${$('in-base-b').value} ${$('in-unit').value}\n` +
                     `Height: ${$('in-height').value} ${$('in-unit').value}\n` +
                     `Area: ${$('out-area').textContent} sq. ${$('in-unit').value}\n` +
                     `— ToolsHub Geometry Solver`;
        
        navigator.clipboard.writeText(text).then(()=>{
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            this.classList.replace('btn-dark', 'btn-success');
            setTimeout(()=>{
                this.innerHTML = original;
                this.classList.replace('btn-success', 'btn-dark');
            }, 2000);
        });
    });

    ['input', 'change'].forEach(evt => {
        $('in-base-a').addEventListener(evt, calculate);
        $('in-base-b').addEventListener(evt, calculate);
        $('in-height').addEventListener(evt, calculate);
        $('in-unit').addEventListener(evt, calculate);
        $('in-precision').addEventListener(evt, calculate);
    });

    calculate();
});
</script>

<style>
.geometry-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 15px 30px -5px rgba(0,0,0,.04)}
.geometry-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.geometry-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b;letter-spacing:-0.5px}
.geometry-calc-rebuilt .calculator-header p{margin:0;font-size:.95rem;color:#64748b}
.geometry-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.75rem;flex-shrink:0}
.geometry-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:1px;margin-bottom:.6rem;display:block}

.geometry-calc-rebuilt .output-card-themed{background:var(--tool-bg);border:2px solid #fff;border-radius:32px;padding:3rem;margin-top:2rem;box-shadow:0 20px 40px rgba(0,0,0,.03);position:relative;overflow:hidden}
.geometry-calc-rebuilt .output-hero-label{font-size:1rem;font-weight:700;color:var(--tool-color);text-transform:uppercase;letter-spacing:2px;display:block;margin-bottom:.5rem}
.geometry-calc-rebuilt .output-hero-value{font-size:4.5rem;font-weight:900;color:#1e293b;line-height:1;margin-bottom:.5rem;word-break:break-all}
.geometry-calc-rebuilt .stat-card{background:#fff;padding:1.5rem;border-radius:20px;border:1px solid rgba(0,0,0,.05);height:100%;transition:transform .2s}
.geometry-calc-rebuilt .stat-card:hover{transform:translateY(-3px)}
.geometry-calc-rebuilt .stat-card-label{display:block;font-size:.8rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.4rem}
.geometry-calc-rebuilt .stat-card-value{display:block;font-size:1.4rem;font-weight:800;color:#1e293b;word-break:break-all}

.geometry-calc-rebuilt .step-item{border-left:3px solid var(--tool-color);padding-left:1.5rem;position:relative}
.geometry-calc-rebuilt .step-label{font-size:.85rem;font-weight:700;color:#64748b;margin-bottom:.5rem}
.geometry-calc-rebuilt .step-formula{font-family:'Cambria','Cochin',Georgia,Times,'Times New Roman',serif;font-style:italic;font-size:1.25rem;color:#1e293b;background:#f8fafc;padding:.75rem 1.25rem;border-radius:12px;display:inline-block;min-width:200px}

@media (max-width: 768px) {
    .geometry-calc-rebuilt .calculator-card{padding:1.5rem}
    .geometry-calc-rebuilt .output-card-themed{padding:2rem 1.5rem}
    .geometry-calc-rebuilt .output-hero-value{font-size:3rem}
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\area-of-a-trapezoid-calculator.blade.php ENDPATH**/ ?>