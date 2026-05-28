<div class="row g-4 geometry-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">X Coordinate</label>
                        <input type="number" id="in-x" class="form-control form-control-lg rounded-3" value="3" step="any">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Y Coordinate</label>
                        <input type="number" id="in-y" class="form-control form-control-lg rounded-3" value="4" step="any">
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
                    <button type="button" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-sm text-white" id="btn-calc"><i class="fas fa-sync me-2"></i>Convert</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill px-4" id="btn-reset"><i class="fas fa-undo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12 d-none" id="output-wrapper">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero text-center">
                <span class="output-hero-label">Polar Form (r, θ)</span>
                <div class="output-hero-value" id="out-polar-summary">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Radius (r)</span>
                        <span class="stat-card-value" id="out-r">—</span>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Angle (θ) in Degrees</span>
                        <span class="stat-card-value" id="out-theta-deg">—</span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Angle (θ) in Radians</span>
                        <span class="stat-card-value" id="out-theta-rad">—</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-square-root-variable me-2 text-warning"></i>Conversion Steps</h6>
                <div class="p-4 bg-white rounded-4 border border-light-subtle shadow-sm">
                    <div class="step-item mb-4">
                        <div class="step-label">1. Calculate Radius (r)</div>
                        <div class="step-formula">r = \sqrt{x^2 + y^2}</div>
                        <div class="small text-muted mt-2" id="step-r-sub">—</div>
                    </div>
                    <div class="step-item">
                        <div class="step-label">2. Calculate Angle (θ)</div>
                        <div class="step-formula">\theta = \operatorname{atan2}(y, x)</div>
                        <div class="small text-muted mt-2" id="step-theta-sub">—</div>
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
        const x = parseFloat($('in-x').value);
        const y = parseFloat($('in-y').value);
        const prec = parseInt($('in-precision').value);

        if(isNaN(x) || isNaN(y)){
            $('output-wrapper').classList.add('d-none');
            return;
        }

        const r = Math.sqrt(x*x + y*y);
        const thetaRad = Math.atan2(y, x);
        const thetaDeg = thetaRad * (180 / Math.PI);

        const fr = r.toFixed(prec);
        const fRad = thetaRad.toFixed(prec + 2);
        const fDeg = thetaDeg.toFixed(prec);

        $('out-polar-summary').textContent = `(${fr}, ${fDeg}°)`;
        $('out-r').textContent = fr;
        $('out-theta-deg').textContent = `${fDeg}°`;
        $('out-theta-rad').textContent = `${fRad} rad`;

        // Steps
        $('step-r-sub').textContent = `r = √(${x}² + ${y}²) = √(${x*x} + ${y*y}) = ${fr}`;
        $('step-theta-sub').textContent = `θ = atan2(${y}, ${x}) = ${fRad} rad (${fDeg}°)`;

        $('output-wrapper').classList.remove('d-none');
        $('output-wrapper').scrollIntoView({behavior:'smooth', block:'nearest'});
    }

    $('btn-calc').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        $('in-x').value = 3;
        $('in-y').value = 4;
        $('output-wrapper').classList.add('d-none');
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Cartesian to Polar Conversion\n` +
                     `--------------------------\n` +
                     `Cartesian: (x: ${$('in-x').value}, y: ${$('in-y').value})\n` +
                     `Polar Radius (r): ${$('out-r').textContent}\n` +
                     `Polar Angle (θ): ${$('out-theta-deg').textContent} (${$('out-theta-rad').textContent})\n` +
                     `Form: ${$('out-polar-summary').textContent}\n` +
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
        $('in-x').addEventListener(evt, calculate);
        $('in-y').addEventListener(evt, calculate);
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
