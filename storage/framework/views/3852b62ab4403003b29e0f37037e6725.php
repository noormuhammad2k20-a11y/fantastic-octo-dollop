<div class="row g-4 geometry-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-5">
                        <h6 class="fw-bold mb-3 text-muted small text-uppercase">Point 1 (x₁, y₁)</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label-custom">X₁</label>
                                <input type="number" id="in-x1" class="form-control form-control-lg rounded-3" value="0" step="any">
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">Y₁</label>
                                <input type="number" id="in-y1" class="form-control form-control-lg rounded-3" value="0" step="any">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h6 class="fw-bold mb-3 text-muted small text-uppercase">Point 2 (x₂, y₂)</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label-custom">X₂</label>
                                <input type="number" id="in-x2" class="form-control form-control-lg rounded-3" value="3" step="any">
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">Y₂</label>
                                <input type="number" id="in-y2" class="form-control form-control-lg rounded-3" value="4" step="any">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h6 class="fw-bold mb-3 text-muted small text-uppercase">Precision</h6>
                        <label class="form-label-custom">Decimals</label>
                        <select id="in-precision" class="form-select form-select-lg rounded-3">
                            <option value="2">2 places</option>
                            <option value="4" selected>4 places</option>
                            <option value="6">6 places</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-info btn-lg rounded-pill px-5 fw-bold shadow-sm text-white" id="btn-calc" style="background:#0ea5e9;border:none;"><i class="fas fa-sync me-2"></i>Calculate Distance</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill px-4" id="btn-reset"><i class="fas fa-undo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12 d-none" id="output-wrapper">
        <div class="output-card-themed" style="--tool-hue:199;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero text-center">
                <span class="output-hero-label">Total Distance (d)</span>
                <div class="output-hero-value" id="out-distance-summary">—</div>
            </div>

            <div class="row g-3 mt-4 text-center justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="p-4 bg-white border rounded-4 shadow-sm">
                        <svg id="dist-svg" viewBox="0 0 100 100" style="max-width: 400px; height: auto;">
                            <path d="M 0 50 L 100 50 M 50 0 L 50 100" stroke="#e5e7eb" stroke-width="0.5" />
                            <line id="svg-line" x1="50" y1="50" x2="80" y2="10" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" />
                            <circle id="svg-p1" cx="50" cy="50" r="3" fill="#10b981" />
                            <circle id="svg-p2" cx="80" cy="10" r="3" fill="#ef4444" />
                        </svg>
                        <div class="mt-2 text-muted small fw-bold">Point 1 (Green) to Point 2 (Red)</div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-square-root-variable me-2 text-info" style="color:#0ea5e9"></i>Step-by-Step Logic</h6>
                <div class="p-4 bg-white rounded-4 border border-light-subtle shadow-sm">
                    <div class="step-item mb-4">
                        <div class="step-label">1. Euclidean Distance Formula</div>
                        <div class="step-formula">d = \sqrt{(x_2-x_1)^2 + (y_2-y_1)^2}</div>
                        <div class="small text-muted mt-2" id="step-formula-sub">—</div>
                    </div>
                    <div class="step-item">
                        <div class="step-label">2. Solve the Equation</div>
                        <div class="step-formula" id="out-formula-result">d = \sqrt{\Delta x^2 + \Delta y^2}</div>
                        <div class="small text-muted mt-2" id="step-solve-sub">—</div>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-5 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy"><i class="fas fa-copy me-2"></i>Copy Results</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);

    function calculate(){
        const x1 = parseFloat($('in-x1').value);
        const y1 = parseFloat($('in-y1').value);
        const x2 = parseFloat($('in-x2').value);
        const y2 = parseFloat($('in-y2').value);
        const prec = parseInt($('in-precision').value);

        if(isNaN(x1) || isNaN(y1) || isNaN(x2) || isNaN(y2)){
            $('output-wrapper').classList.add('d-none');
            return;
        }

        const dx = x2 - x1;
        const dy = y2 - y1;
        const dist = Math.sqrt(dx*dx + dy*dy);
        const fdist = dist.toFixed(prec);

        $('out-distance-summary').textContent = fdist;

        // Steps
        $('step-formula-sub').textContent = `d = √[(${x2} - ${x1})² + (${y2} - ${y1})²]`;
        $('step-solve-sub').textContent = `d = √[(${dx.toFixed(2)})² + (${dy.toFixed(2)})²] = √[${(dx*dx).toFixed(2)} + ${(dy*dy).toFixed(2)}] = ${fdist}`;

        // SVG Update
        const minX = Math.min(x1, x2, 0) - 1;
        const maxX = Math.max(x1, x2, 0) + 1;
        const minY = Math.min(y1, y2, 0) - 1;
        const maxY = Math.max(y1, y2, 0) + 1;
        const scale = (val, min, max) => 5 + (val - min) / (max - min) * 90;
        
        const sx1 = scale(x1, minX, maxX);
        const sy1 = 100 - scale(y1, minY, maxY);
        const sx2 = scale(x2, minX, maxX);
        const sy2 = 100 - scale(y2, minY, maxY);

        $('svg-line').setAttribute('x1', sx1);
        $('svg-line').setAttribute('y1', sy1);
        $('svg-line').setAttribute('x2', sx2);
        $('svg-line').setAttribute('y2', sy2);
        $('svg-p1').setAttribute('cx', sx1);
        $('svg-p1').setAttribute('cy', sy1);
        $('svg-p2').setAttribute('cx', sx2);
        $('svg-p2').setAttribute('cy', sy2);

        $('output-wrapper').classList.remove('d-none');
        $('output-wrapper').scrollIntoView({behavior:'smooth', block:'nearest'});
    }

    $('btn-calc').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        $('in-x1').value = 0; $('in-y1').value = 0;
        $('in-x2').value = 3; $('in-y2').value = 4;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Distance Calculation\n` +
                     `--------------------------\n` +
                     `Point 1: (${$('in-x1').value}, ${$('in-y1').value})\n` +
                     `Point 2: (${$('in-x2').value}, ${$('in-y2').value})\n` +
                     `Calculated Distance: ${$('out-distance-summary').textContent}\n` +
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
        [$('in-x1'), $('in-y1'), $('in-x2'), $('in-y2'), $('in-precision')].forEach(el => el.addEventListener(evt, calculate));
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
.geometry-calc-rebuilt .stat-card{background:#fff;padding:1.5rem;border-radius:20px;border:1px solid rgba(0,0,0,.05);height:100%}
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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\distance-between-two-points-calculator.blade.php ENDPATH**/ ?>