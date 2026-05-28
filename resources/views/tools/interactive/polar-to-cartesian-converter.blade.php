<div class="row g-4 geometry-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Radius (r)</label>
                        <input type="number" id="in-r" class="form-control form-control-lg rounded-3" value="10" step="any">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Angle (θ)</label>
                        <div class="input-group">
                            <input type="number" id="in-theta" class="form-control form-control-lg rounded-start-3" value="45" step="any">
                            <select id="in-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 120px;">
                                <option value="deg" selected>Degrees</option>
                                <option value="rad">Radians</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Decimal Precision</label>
                        <select id="in-precision" class="form-select form-select-lg rounded-3">
                            <option value="2">2 places</option>
                            <option value="4" selected>4 places</option>
                            <option value="6">6 places</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-pink btn-lg rounded-pill px-5 fw-bold shadow-sm text-white" id="btn-calc" style="background:#ec4899;border:none;"><i class="fas fa-sync me-2"></i>Convert Now</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill px-4" id="btn-reset"><i class="fas fa-undo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12 d-none" id="output-wrapper">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero text-center">
                <span class="output-hero-label">Cartesian (x, y)</span>
                <div class="output-hero-value" id="out-cartesian-summary">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-6">
                    <div class="stat-card text-center">
                        <span class="stat-card-label">X Coordinate</span>
                        <span class="stat-card-value" id="out-x">—</span>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="stat-card text-center">
                        <span class="stat-card-label">Y Coordinate</span>
                        <span class="stat-card-value" id="out-y">—</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-square-root-variable me-2 text-pink" style="color:#ec4899"></i>Trigonometric Steps</h6>
                <div class="p-4 bg-white rounded-4 border border-light-subtle shadow-sm">
                    <div class="step-item mb-4">
                        <div class="step-label">1. Horizontal Component (x)</div>
                        <div class="step-formula">x = r \cdot \cos(\theta)</div>
                        <div class="small text-muted mt-2" id="step-x-sub">—</div>
                    </div>
                    <div class="step-item">
                        <div class="step-label">2. Vertical Component (y)</div>
                        <div class="step-formula">y = r \cdot \sin(\theta)</div>
                        <div class="small text-muted mt-2" id="step-y-sub">—</div>
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
        const r = parseFloat($('in-r').value);
        let theta = parseFloat($('in-theta').value);
        const unit = $('in-unit').value;
        const prec = parseInt($('in-precision').value);

        if(isNaN(r) || isNaN(theta)){
            $('output-wrapper').classList.add('d-none');
            return;
        }

        let thetaRad = theta;
        if(unit === 'deg') thetaRad = theta * (Math.PI / 180);

        const x = r * Math.cos(thetaRad);
        const y = r * Math.sin(thetaRad);

        const fx = x.toFixed(prec);
        const fy = y.toFixed(prec);

        $('out-cartesian-summary').textContent = `(${fx}, ${fy})`;
        $('out-x').textContent = fx;
        $('out-y').textContent = fy;

        // Steps
        $('step-x-sub').textContent = `x = ${r} \cdot \cos(${theta}${unit === 'deg' ? '°' : ' rad'}) = ${fx}`;
        $('step-y-sub').textContent = `y = ${r} \cdot \sin(${theta}${unit === 'deg' ? '°' : ' rad'}) = ${fy}`;

        $('output-wrapper').classList.remove('d-none');
        $('output-wrapper').scrollIntoView({behavior:'smooth', block:'nearest'});
    }

    $('btn-calc').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        $('in-r').value = 10;
        $('in-theta').value = 45;
        $('output-wrapper').classList.add('d-none');
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Polar to Cartesian Conversion\n` +
                     `--------------------------\n` +
                     `Polar: (r: ${$('in-r').value}, θ: ${$('in-theta').value}${$('in-unit').value === 'deg' ? '°' : ' rad'})\n` +
                     `X Coordinate: ${$('out-x').textContent}\n` +
                     `Y Coordinate: ${$('out-y').textContent}\n` +
                     `Rectangular Form: ${$('out-cartesian-summary').textContent}\n` +
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
        [$('in-r'), $('in-theta'), $('in-unit'), $('in-precision')].forEach(el => el.addEventListener(evt, calculate));
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
