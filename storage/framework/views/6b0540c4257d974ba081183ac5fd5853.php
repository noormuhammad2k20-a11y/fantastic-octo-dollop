<div class="row g-3 inertia-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="mb-3">
                    <label class="form-label-custom">Calculation Mode</label>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-custom active flex-grow-1 py-1.5 text-sm" id="ine-mode-area" data-mode="area"><i class="fas fa-border-all me-1"></i>Area Moment (Structural Beam)</button>
                        <button type="button" class="btn btn-outline-custom flex-grow-1 py-1.5 text-sm" id="ine-mode-mass" data-mode="mass"><i class="fas fa-weight-hanging me-1"></i>Mass Moment (Rotational Dynamics)</button>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Profile Shape</label>
                        <select id="ine-shape" class="form-select form-select-sm">
                            <option value="rectangle" selected>Rectangle (Solid)</option>
                            <option value="circle">Circle (Solid)</option>
                            <option value="hollow_cyl">Hollow Cylinder / Pipe</option>
                            <option value="ibeam">I-Beam (Standard profile)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-6 col-sm-12" id="ine-mass-input-container" style="display:none;">
                        <label class="form-label-custom">Object Mass ($m$, kg)</label>
                        <input type="number" id="ine-mass" class="form-control form-control-sm" value="10" min="0.01" step="any">
                    </div>

                    
                    <div class="col-12 mt-2">
                        <div class="p-3 bg-light rounded-3 border">
                            <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600"><i class="fas fa-ruler-combined me-1"></i>Cross-Section Dimensions (mm)</h6>
                            <div class="row g-2" id="ine-dims-grid">
                                
                                <div class="col-6 col-sm-4 dim-field" data-shapes="rectangle ibeam">
                                    <label class="form-label-custom-sub" id="lbl-dim-w">Width ($b$, mm)</label>
                                    <input type="number" id="ine-dim-w" class="form-control form-control-sm" value="50" min="1" step="any">
                                </div>
                                <div class="col-6 col-sm-4 dim-field" data-shapes="rectangle ibeam">
                                    <label class="form-label-custom-sub" id="lbl-dim-h">Height ($h$, mm)</label>
                                    <input type="number" id="ine-dim-h" class="form-control form-control-sm" value="100" min="1" step="any">
                                </div>
                                
                                
                                <div class="col-6 col-sm-4 dim-field" data-shapes="circle hollow_cyl">
                                    <label class="form-label-custom-sub">Outer Diameter ($D$, mm)</label>
                                    <input type="number" id="ine-dim-od" class="form-control form-control-sm" value="80" min="1" step="any">
                                </div>
                                <div class="col-6 col-sm-4 dim-field" data-shapes="hollow_cyl">
                                    <label class="form-label-custom-sub">Inner Diameter ($d$, mm)</label>
                                    <input type="number" id="ine-dim-id" class="form-control form-control-sm" value="60" min="0.1" step="any">
                                </div>

                                
                                <div class="col-6 col-sm-4 dim-field" data-shapes="ibeam">
                                    <label class="form-label-custom-sub">Flange Thick ($t_f$, mm)</label>
                                    <input type="number" id="ine-dim-tf" class="form-control form-control-sm" value="8" min="0.1" step="any">
                                </div>
                                <div class="col-6 col-sm-4 dim-field" data-shapes="ibeam">
                                    <label class="form-label-custom-sub">Web Thick ($t_w$, mm)</label>
                                    <input type="number" id="ine-dim-tw" class="form-control form-control-sm" value="6" min="0.1" step="any">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-3 d-flex flex-wrap gap-1.5 align-items-center">
                    <span class="fw-bold text-xxs text-slate-400 text-uppercase tracking-wider me-1"><i class="fas fa-bolt text-warning me-1"></i>Quick Profiles:</span>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ine-quick text-xxs" data-shape="ibeam" data-w="100" data-h="200" data-tf="10" data-tw="7">🏗️ Standard I-Beam (IPE 200)</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ine-quick text-xxs" data-shape="hollow_cyl" data-od="60" data-id="50">🚰 2" Steel Conduit</button>
                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill px-2.5 text-xxs ms-auto" id="ine-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:270;--tool-color:#8b5cf6;--tool-bg:rgba(139, 92, 246, 0.03);">
            <div class="output-hero py-3">
                <span class="output-hero-label text-xxs text-uppercase tracking-widest text-slate-500" id="out-ine-hero-lbl">Moment of Inertia (I_x)</span>
                <div class="output-hero-value text-xl font-bold tracking-tight my-1" id="out-ine-hero-val" style="color:#8b5cf6;">—</div>
                <div class="text-xs text-slate-500" id="out-ine-hero-sub">—</div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5" id="out-ine-stat1-lbl">Cross Section Area</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ine-stat1-val">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5" id="out-ine-stat2-lbl">Section Modulus</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ine-stat2-val">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5" id="out-ine-stat3-lbl">Radius of Gyration</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ine-stat3-val">—</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-3 p-3 bg-light rounded-3 border text-center">
                <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600 text-left"><i class="fas fa-vector-square me-1"></i>Conductor Profile & Axis view</h6>
                <div class="d-flex align-items-center justify-content-center bg-white rounded border py-2" style="height:110px;">
                    <svg id="ine-schematic" viewBox="0 0 120 100" class="w-100 h-100" style="max-width: 130px;">
                        <!-- Neutral Axis lines -->
                        <line x1="10" y1="50" x2="110" y2="50" stroke="#94a3b8" stroke-width="0.75" stroke-dasharray="2 2"/>
                        <line x1="60" y1="5" x2="60" y2="95" stroke="#94a3b8" stroke-width="0.75" stroke-dasharray="2 2"/>
                        <text x="110" y="47" font-size="5" fill="#64748b" font-weight="bold">X-Axis</text>

                        <!-- Dynamic profile shapes -->
                        <rect id="svg-rect" x="35" y="20" width="50" height="60" fill="rgba(139,92,246,0.1)" stroke="#8b5cf6" stroke-width="1.5" class="d-none"/>
                        <circle id="svg-circle" cx="60" cy="50" r="30" fill="rgba(139,92,246,0.1)" stroke="#8b5cf6" stroke-width="1.5" class="d-none"/>
                        <g id="svg-hollow" class="d-none">
                            <circle cx="60" cy="50" r="30" fill="rgba(139,92,246,0.05)" stroke="#8b5cf6" stroke-width="1.5"/>
                            <circle cx="60" cy="50" r="22" fill="#ffffff" stroke="#8b5cf6" stroke-width="1" stroke-dasharray="2 2"/>
                        </g>
                        <path id="svg-ibeam" d="M30 15 L90 15 L90 25 L65 25 L65 75 L90 75 L90 85 L30 85 L30 75 L55 75 L55 25 L30 25 Z" fill="rgba(139,92,246,0.1)" stroke="#8b5cf6" stroke-width="1.5" class="d-none"/>
                    </svg>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-3 py-2 px-4 text-sm fw-bold rounded-pill shadow-sm" id="ine-copy" style="min-width: 240px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Inertia Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);

    let mode = 'area';
    const shapeEl=$('ine-shape');

    const massEl=$('ine-mass');
    const dimWEl=$('ine-dim-w'), dimHEl=$('ine-dim-h');
    const dimODEl=$('ine-dim-od'), dimIDEl=$('ine-dim-id');
    const dimTFEl=$('ine-dim-tf'), dimTWEl=$('ine-dim-tw');

    function toggleFields(){
        const shape = shapeEl.value;
        
        document.querySelectorAll('.dim-field').forEach(el => {
            const allowedShapes = el.dataset.shapes.split(' ');
            if (allowedShapes.includes(shape)) {
                el.style.display = 'block';
            } else {
                el.style.display = 'none';
            }
        });

        if (mode === 'mass') {
            $('ine-mass-input-container').style.display = 'block';
        } else {
            $('ine-mass-input-container').style.display = 'none';
        }

        ['rect', 'circle', 'hollow', 'ibeam'].forEach(s => {
            $('svg-' + s).classList.add('d-none');
        });
        if (shape === 'rectangle') $('svg-rect').classList.remove('d-none');
        else if (shape === 'circle') $('svg-circle').classList.remove('d-none');
        else if (shape === 'hollow_cyl') $('svg-hollow').classList.remove('d-none');
        else if (shape === 'ibeam') $('svg-ibeam').classList.remove('d-none');
    }

    function calculate(){
        toggleFields();

        const shape = shapeEl.value;
        const mass = parseFloat(massEl.value) || 10;

        const b = (parseFloat(dimWEl.value) || 0) / 1000;
        const h = (parseFloat(dimHEl.value) || 0) / 1000;
        const D = (parseFloat(dimODEl.value) || 0) / 1000;
        const d = (parseFloat(dimIDEl.value) || 0) / 1000;
        const tf = (parseFloat(dimTFEl.value) || 0) / 1000;
        const tw = (parseFloat(dimTWEl.value) || 0) / 1000;

        let Ix = 0, Iy = 0;
        let Area = 0;

        if (mode === 'area') {
            if (shape === 'rectangle') {
                if (b <= 0 || h <= 0) return;
                Ix = (b * Math.pow(h, 3)) / 12;
                Iy = (h * Math.pow(b, 3)) / 12;
                Area = b * h;
            } else if (shape === 'circle') {
                if (D <= 0) return;
                Ix = (Math.PI * Math.pow(D, 4)) / 64;
                Iy = Ix;
                Area = (Math.PI * D * D) / 4;
            } else if (shape === 'hollow_cyl') {
                if (D <= 0 || d <= 0) return;
                Ix = (Math.PI * (Math.pow(D, 4) - Math.pow(d, 4))) / 64;
                Iy = Ix;
                Area = (Math.PI * (D*D - d*d)) / 4;
            } else if (shape === 'ibeam') {
                if (b <= 0 || h <= 0 || tf <= 0 || tw <= 0) return;
                const h_web = h - 2*tf;
                Ix = (b * Math.pow(h, 3) - (b - tw) * Math.pow(h_web, 3)) / 12;
                Iy = (2 * tf * Math.pow(b, 3) + h_web * Math.pow(tw, 3)) / 12;
                Area = 2 * b * tf + h_web * tw;
            }

            const Ix_cm4 = Ix * 1e8;
            const Iy_cm4 = Iy * 1e8;
            const Sx = Ix / (h / 2 || D / 2);
            const rg = Math.sqrt(Ix / Area);

            $('out-ine-hero-lbl').textContent = 'Area Moment of Inertia (I_x)';
            $('out-ine-hero-val').textContent = Ix_cm4.toLocaleString(undefined, {maximumFractionDigits:2}) + ' cm⁴';
            $('out-ine-hero-sub').textContent = `Minor Axis: I_y = ${Iy_cm4.toLocaleString(undefined, {maximumFractionDigits:2})} cm⁴`;

            $('out-ine-stat1-lbl').textContent = 'Cross Section Area';
            $('out-ine-stat1-val').textContent = (Area*1e4).toFixed(1) + ' cm²';
            $('out-ine-stat2-lbl').textContent = 'Elastic Section Modulus';
            $('out-ine-stat2-val').textContent = (Sx*1e6).toFixed(1) + ' cm³';
            $('out-ine-stat3-lbl').textContent = 'Radius of Gyration (r_g)';
            $('out-ine-stat3-val').textContent = (rg*100).toFixed(2) + ' cm';
        } else {
            let I_mass = 0;
            if (shape === 'rectangle') {
                I_mass = (1/12) * mass * (b*b + h*h);
            } else if (shape === 'circle') {
                I_mass = 0.5 * mass * Math.pow(D/2, 2);
            } else if (shape === 'hollow_cyl') {
                const R = D / 2, r_inner = d / 2;
                I_mass = 0.5 * mass * (R*R + r_inner*r_inner);
            } else if (shape === 'ibeam') {
                I_mass = (1/12) * mass * (b*b + h*h);
            }

            const k_gyr = Math.sqrt(I_mass / mass);

            $('out-ine-hero-lbl').textContent = 'Mass Moment of Inertia (I_mass)';
            $('out-ine-hero-val').textContent = I_mass.toFixed(4) + ' kg·m²';
            $('out-ine-hero-sub').textContent = `Rotational Radius of Gyration: ${k_gyr.toFixed(3)} m`;

            $('out-ine-stat1-lbl').textContent = 'Mass';
            $('out-ine-stat1-val').textContent = mass.toFixed(1) + ' kg';
            $('out-ine-stat2-lbl').textContent = 'Rotational Energy @ 10rad/s';
            $('out-ine-stat2-val').textContent = (0.5 * I_mass * 100).toFixed(1) + ' Joules';
            $('out-ine-stat3-lbl').textContent = 'Gyration Radius';
            $('out-ine-stat3-val').textContent = k_gyr.toFixed(3) + ' m';
        }

        const svgRect = $('svg-rect');
        if (shape === 'rectangle' && b > 0 && h > 0) {
            const scale = Math.max(b, h);
            const w_scaled = (b / scale) * 70;
            const h_scaled = (h / scale) * 70;
            svgRect.setAttribute('x', 60 - w_scaled/2);
            svgRect.setAttribute('y', 50 - h_scaled/2);
            svgRect.setAttribute('width', w_scaled);
            svgRect.setAttribute('height', h_scaled);
        }
    }

    document.querySelectorAll('[data-mode]').forEach(btn => {
        btn.addEventListener('click', () => {
            mode = btn.dataset.mode;
            document.querySelectorAll('[data-mode]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            calculate();
        });
    });

    shapeEl.addEventListener('change', calculate);
    [massEl, dimWEl, dimHEl, dimODEl, dimIDEl, dimTFEl, dimTWEl].forEach(el => {
        if (el) el.addEventListener('input', calculate);
    });

    document.querySelectorAll('.ine-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            shapeEl.value = btn.dataset.shape;
            if (btn.dataset.shape === 'ibeam') {
                dimWEl.value = btn.dataset.w;
                dimHEl.value = btn.dataset.h;
                dimTFEl.value = btn.dataset.tf;
                dimTWEl.value = btn.dataset.tw;
            } else if (btn.dataset.shape === 'hollow_cyl') {
                dimODEl.value = btn.dataset.od;
                dimIDEl.value = btn.dataset.id;
            }
            calculate();
        });
    });

    $('ine-reset').addEventListener('click', ()=>{
        shapeEl.value = 'rectangle';
        dimWEl.value = 50;
        dimHEl.value = 100;
        dimODEl.value = 80;
        dimIDEl.value = 60;
        dimTFEl.value = 8;
        dimTWEl.value = 6;
        calculate();
    });

    $('ine-copy').addEventListener('click', function(){
        const text = `Moment of Inertia Report\nShape: ${shapeEl.options[shapeEl.selectedIndex].text}\nMode: ${mode === 'area' ? 'Area Moment (Structural)' : 'Mass Moment (Rotational)'}\nResult: ${$('out-ine-hero-val').textContent}\n— ToolsHub Structural`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.inertia-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
}
.inertia-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.inertia-rebuilt .tool-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.inertia-rebuilt .form-label-custom {
    font-size: 0.75rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 0.25rem;
    display: block;
}
.inertia-rebuilt .form-label-custom-sub {
    font-size: 0.7rem;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 0.2rem;
    display: block;
}
.inertia-rebuilt .btn-outline-custom {
    border: 1px solid #e2e8f0;
    color: #64748b;
    font-weight: 600;
    border-radius: 8px;
    transition: all .2s;
    background: #f8fafc;
}
.inertia-rebuilt .btn-outline-custom:hover {
    background: #f5f3ff;
    color: #8b5cf6;
    border-color: #ddd6fe;
}
.inertia-rebuilt .btn-outline-custom.active {
    background: #8b5cf6;
    color: #fff;
    border-color: #8b5cf6;
}
.inertia-rebuilt .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 9999px;
}
.inertia-rebuilt .text-xxs {
    font-size: 0.65rem;
}
.inertia-rebuilt .text-xxs.tracking-wider {
    letter-spacing: 0.05em;
}
.inertia-rebuilt .stat-card {
    transition: transform 0.2s;
}
.inertia-rebuilt .stat-card:hover {
    transform: translateY(-1px);
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\moment-of-inertia-calc.blade.php ENDPATH**/ ?>