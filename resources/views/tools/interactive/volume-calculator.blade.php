<div class="row g-4 geometry-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Select Shape</label>
                    <div class="d-flex gap-2 flex-wrap" id="shape-selector">
                        <button type="button" class="btn btn-outline-primary active flex-grow-1" data-shape="sphere"><i class="fas fa-circle me-1"></i>Sphere</button>
                        <button type="button" class="btn btn-outline-primary flex-grow-1" data-shape="cube"><i class="fas fa-cube me-1"></i>Cube</button>
                        <button type="button" class="btn btn-outline-primary flex-grow-1" data-shape="cylinder"><i class="fas fa-database me-1"></i>Cylinder</button>
                        <button type="button" class="btn btn-outline-primary flex-grow-1" data-shape="cone"><i class="fas fa-ice-cream me-1"></i>Cone</button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4" id="col-r">
                        <label class="form-label-custom" id="label-r">Radius (r)</label>
                        <input type="number" id="in-r" class="form-control form-control-lg rounded-3" value="5" step="any">
                    </div>
                    <div class="col-md-4 d-none" id="col-h">
                        <label class="form-label-custom">Height (h)</label>
                        <input type="number" id="in-h" class="form-control form-control-lg rounded-3" value="10" step="any">
                    </div>
                    <div class="col-md-4">
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
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Decimal Precision</label>
                        <select id="in-precision" class="form-select form-select-lg rounded-3">
                            <option value="2" selected>2 places</option>
                            <option value="4">4 places</option>
                            <option value="6">6 places</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm" id="btn-calc"><i class="fas fa-calculator me-2"></i>Calculate</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill px-4" id="btn-reset"><i class="fas fa-undo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12 d-none" id="output-wrapper">
        <div class="output-card-themed" style="--tool-hue:230;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero text-center">
                <span class="output-hero-label" id="out-label">Calculated Volume</span>
                <div class="output-hero-value" id="out-volume">—</div>
                <div class="mt-1 text-muted fw-medium" id="out-unit-display">cubic units</div>
            </div>

            <div class="mt-5">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-square-root-variable me-2 text-primary"></i>Calculation Steps</h6>
                <div class="p-4 bg-white rounded-4 border border-light-subtle shadow-sm">
                    <div class="step-item mb-4">
                        <div class="step-label">1. Formula</div>
                        <div class="step-formula" id="step-formula">—</div>
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
    const PI = Math.PI;
    let currentShape = 'sphere';

    function updateInputs(){
        if(currentShape === 'sphere'){
            $('label-r').textContent = 'Radius (r)';
            $('col-r').classList.remove('d-none');
            $('col-h').classList.add('d-none');
        } else if(currentShape === 'cube'){
            $('label-r').textContent = 'Side (s)';
            $('col-r').classList.remove('d-none');
            $('col-h').classList.add('d-none');
        } else if(currentShape === 'cylinder' || currentShape === 'cone'){
            $('label-r').textContent = 'Radius (r)';
            $('col-r').classList.remove('d-none');
            $('col-h').classList.remove('d-none');
        }
        calculate();
    }

    function calculate(){
        const r = parseFloat($('in-r').value);
        const h = parseFloat($('in-h').value);
        const unit = $('in-unit').value;
        const prec = parseInt($('in-precision').value);

        if(isNaN(r) || r <= 0 || ((currentShape === 'cylinder' || currentShape === 'cone') && (isNaN(h) || h <= 0))){
            $('output-wrapper').classList.add('d-none');
            return;
        }

        let volume = 0;
        let formula = '';
        let sub = '';

        if(currentShape === 'sphere'){
            volume = (4/3) * PI * Math.pow(r, 3);
            formula = 'V = \\frac{4}{3} \\pi r^3';
            sub = `V = \\frac{4}{3} \\times ${PI.toFixed(4)} \\times ${r}^3`;
        } else if(currentShape === 'cube'){
            volume = Math.pow(r, 3);
            formula = 'V = s^3';
            sub = `V = ${r}^3`;
        } else if(currentShape === 'cylinder'){
            volume = PI * Math.pow(r, 2) * h;
            formula = 'V = \\pi r^2 h';
            sub = `V = ${PI.toFixed(4)} \\times ${r}^2 \\times ${h}`;
        } else if(currentShape === 'cone'){
            volume = (1/3) * PI * Math.pow(r, 2) * h;
            formula = 'V = \\frac{1}{3} \\pi r^2 h';
            sub = `V = \\frac{1}{3} \\times ${PI.toFixed(4)} \\times ${r}^2 \\times ${h}`;
        }

        const fVol = volume.toFixed(prec);
        $('out-volume').textContent = fVol;
        $('out-unit-display').textContent = `cubic ${unit}`;
        $('out-label').textContent = `${currentShape.charAt(0).toUpperCase() + currentShape.slice(1)} Volume`;

        $('step-formula').textContent = formula;
        $('step-substitution').textContent = sub;
        $('step-final').textContent = `V = ${fVol} \text{ ${unit}}^3`;

        $('output-wrapper').classList.remove('d-none');
    }

    document.querySelectorAll('[data-shape]').forEach(btn => {
        btn.addEventListener('click', () => {
            currentShape = btn.dataset.shape;
            document.querySelectorAll('[data-shape]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            updateInputs();
        });
    });

    $('btn-calc').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', () => {
        $('in-r').value = 5;
        $('in-h').value = 10;
        $('output-wrapper').classList.add('d-none');
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Volume Calculation Result\n` +
                     `--------------------------\n` +
                     `Shape: ${currentShape}\n` +
                     `Dimensions: r/s=${$('in-r').value}, h=${$('in-h').value}\n` +
                     `Volume: ${$('out-volume').textContent} cubic ${$('in-unit').value}\n` +
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
        $('in-r').addEventListener(evt, calculate);
        $('in-h').addEventListener(evt, calculate);
        $('in-unit').addEventListener(evt, calculate);
        $('in-precision').addEventListener(evt, calculate);
    });

    updateInputs();
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

.geometry-calc-rebuilt .btn-outline-primary{border:2px solid #f1f5f9;color:#64748b;font-weight:600;border-radius:12px;padding:.75rem 1rem;transition:all .2s;background:#f8fafc}
.geometry-calc-rebuilt .btn-outline-primary:hover{background:#eef2ff;color:#4f46e5;border-color:#c7d2fe}
.geometry-calc-rebuilt .btn-outline-primary.active{background:#4f46e5;color:#fff;border-color:#4f46e5;box-shadow:0 4px 12px rgba(79,70,229,.25)}

@media (max-width: 768px) {
    .geometry-calc-rebuilt .calculator-card{padding:1.5rem}
    .geometry-calc-rebuilt .output-card-themed{padding:2rem 1.5rem}
    .geometry-calc-rebuilt .output-hero-value{font-size:3rem}
}
</style>
