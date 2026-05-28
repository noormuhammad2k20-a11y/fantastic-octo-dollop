<div class="row g-3 free-fall-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label-custom">Drop Height ($h$)</label>
                        <div class="input-group">
                            <input type="number" id="ff-height" class="form-control form-control-sm rounded-start-3" value="100" min="0.1" step="any">
                            <select id="ff-height-unit" class="form-select form-select-sm" style="max-width:90px;">
                                <option value="m" selected>Meters</option>
                                <option value="ft">Feet</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Velocity ($v_0$)</label>
                        <div class="input-group">
                            <input type="number" id="ff-v0" class="form-control form-control-sm rounded-start-3" value="0" min="0" step="any">
                            <select id="ff-v0-unit" class="form-select form-select-sm" style="max-width:90px;">
                                <option value="m/s" selected>m/s</option>
                                <option value="ft/s">ft/s</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-12 mt-2">
                        <label class="form-label-custom">Medium / Fluid Resistance</label>
                        <div class="d-flex gap-2 flex-wrap" id="ff-medium-group">
                            <button type="button" class="btn btn-outline-custom active flex-grow-1 py-1.5 text-sm" data-medium="vacuum"><i class="fas fa-space-shuttle me-1"></i>Vacuum (No Drag)</button>
                            <button type="button" class="btn btn-outline-custom flex-grow-1 py-1.5 text-sm" data-medium="air"><i class="fas fa-wind me-1"></i>Earth Atmosphere</button>
                            <button type="button" class="btn btn-outline-custom flex-grow-1 py-1.5 text-sm" data-medium="water"><i class="fas fa-tint me-1"></i>Water Column</button>
                        </div>
                    </div>

                    
                    <div class="col-12 mt-2 d-none" id="ff-drag-params">
                        <div class="p-3 bg-light rounded-3 border">
                            <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600"><i class="fas fa-sliders me-1"></i>Drag Parameters</h6>
                            <div class="row g-2">
                                <div class="col-6 col-sm-3">
                                    <label class="form-label-custom-sub">Object Mass ($m$, kg)</label>
                                    <input type="number" id="ff-mass" class="form-control form-control-sm" value="80" min="0.01" step="any">
                                </div>
                                <div class="col-6 col-sm-3">
                                    <label class="form-label-custom-sub">Cross-Sec Area ($A$, m²)</label>
                                    <input type="number" id="ff-area" class="form-control form-control-sm" value="0.7" min="0.001" step="any">
                                </div>
                                <div class="col-6 col-sm-3">
                                    <label class="form-label-custom-sub">Drag Coeff ($C_d$)</label>
                                    <input type="number" id="ff-cd" class="form-control form-control-sm" value="1.0" min="0.01" step="any">
                                </div>
                                <div class="col-6 col-sm-3">
                                    <label class="form-label-custom-sub">Fluid Density ($\rho$, kg/m³)</label>
                                    <input type="number" id="ff-rho" class="form-control form-control-sm" value="1.204" min="0.001" step="any" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-3 d-flex flex-wrap gap-1.5 align-items-center">
                    <span class="fw-bold text-xxs text-slate-400 text-uppercase tracking-wider me-1"><i class="fas fa-bolt text-warning me-1"></i>Quick Drops:</span>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ff-quick text-xxs" data-h="828" data-unit="m">Burj Khalifa (828m)</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ff-quick text-xxs" data-h="381" data-unit="m">Empire State (381m)</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ff-quick text-xxs" data-h="10000" data-unit="ft">10,000 ft Jump</button>
                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill px-2.5 text-xxs ms-auto" id="ff-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:250;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.03);">
            <div class="output-hero py-3">
                <span class="output-hero-label text-xxs text-uppercase tracking-widest text-slate-500">Terminal Impact Velocity</span>
                <div class="output-hero-value text-xl font-bold tracking-tight my-1" id="out-velocity" style="color:#6366f1;">—</div>
                <div class="text-xs text-slate-500" id="out-time-desc">— seconds to fall</div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Fall Duration</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-duration">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Kinetic Energy</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ke">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Avg Speed</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-avg-speed">—</span>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-3 py-2 px-4 text-sm fw-bold rounded-pill shadow-sm" id="ff-copy" style="min-width: 240px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Fall Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    let medium = 'vacuum';
    const g = 9.80665; // standard gravity in m/s^2

    // Elements
    const heightEl=$('ff-height'), heightUnitEl=$('ff-height-unit');
    const v0El=$('ff-v0'), v0UnitEl=$('ff-v0-unit');
    const massEl=$('ff-mass'), areaEl=$('ff-area'), cdEl=$('ff-cd'), rhoEl=$('ff-rho');

    // Fluid presets
    const presets = {
        vacuum: { rho: 0, cd: 0 },
        air: { rho: 1.204, cd: 1.0 },
        water: { rho: 998.2, cd: 1.2 }
    };

    function calculate(){
        let h = parseFloat(heightEl.value) || 0;
        let v0 = parseFloat(v0El.value) || 0;
        if (h <= 0) return;

        // Convert units to metric (meters, m/s)
        if (heightUnitEl.value === 'ft') h *= 0.3048;
        if (v0UnitEl.value === 'ft/s') v0 *= 0.3048;

        let m = parseFloat(massEl.value) || 1;
        let A = parseFloat(areaEl.value) || 0.1;
        let cd = parseFloat(cdEl.value) || 0;
        let rho = parseFloat(rhoEl.value) || 0;

        let vf = 0;
        let t = 0;
        let ke = 0;
        let avgV = 0;

        if (medium === 'vacuum') {
            // Standard equation of motion
            vf = Math.sqrt(v0*v0 + 2*g*h);
            t = (vf - v0) / g;
            ke = 0.5 * m * vf * vf;
            avgV = (v0 + vf) / 2;
        } else {
            const k_drag = 0.5 * cd * rho * A;
            if (k_drag <= 0) return;
            const vt = Math.sqrt((m * g) / k_drag);

            if (v0 === 0) {
                const expVal = Math.exp((g * h) / (vt * vt));
                t = (vt / g) * Math.log(expVal + Math.sqrt(expVal*expVal - 1));
                vf = vt * Math.tanh((g * t) / vt);
            } else {
                const e_term = Math.exp((-2 * g * h) / (vt * vt));
                vf = vt * Math.sqrt(Math.abs(1 - (1 - (v0*v0)/(vt*vt)) * e_term));
                const term1 = (vt + vf) / Math.max(0.0001, vt - vf);
                const term2 = (vt - v0) / (vt + v0);
                t = (vt / (2*g)) * Math.log(Math.abs(term1 * term2));
                if (isNaN(t) || t === Infinity) {
                    t = h / vt;
                }
            }

            ke = 0.5 * m * vf * vf;
            avgV = h / t;
        }

        // Display results
        const dispVf = heightUnitEl.value === 'ft' ? (vf / 0.3048).toFixed(1) + ' ft/s' : vf.toFixed(2) + ' m/s';
        const dispVfKmh = (vf * 3.6).toFixed(1) + ' km/h (' + (vf * 2.23694).toFixed(1) + ' mph)';
        
        $('out-velocity').textContent = dispVf;
        $('out-time-desc').textContent = dispVfKmh + ' impact speed';
        $('out-duration').textContent = t.toFixed(2) + ' s';
        $('out-ke').textContent = ke >= 1000 ? (ke/1000).toFixed(2) + ' kJ' : ke.toFixed(1) + ' J';
        
        const dispAvg = heightUnitEl.value === 'ft' ? (avgV / 0.3048).toFixed(1) + ' ft/s' : avgV.toFixed(2) + ' m/s';
        $('out-avg-speed').textContent = dispAvg;
    }

    // Handlers
    document.querySelectorAll('[data-medium]').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            medium = btn.dataset.medium;
            document.querySelectorAll('[data-medium]').forEach(b=>b.classList.remove('active'));
            btn.classList.add('active');

            if (medium === 'vacuum') {
                $('ff-drag-params').classList.add('d-none');
            } else {
                $('ff-drag-params').classList.remove('d-none');
                rhoEl.value = presets[medium].rho;
                cdEl.value = presets[medium].cd;
            }
            calculate();
        });
    });

    [heightEl, heightUnitEl, v0El, v0UnitEl, massEl, areaEl, cdEl, rhoEl].forEach(el=>{
        el.addEventListener('input', calculate);
    });

    // Quick Drop buttons
    document.querySelectorAll('.ff-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const h = parseFloat(btn.dataset.h);
            const unit = btn.dataset.unit;
            heightEl.value = h;
            heightUnitEl.value = unit;
            calculate();
        });
    });

    $('ff-reset').addEventListener('click', ()=>{
        heightEl.value = 100;
        heightUnitEl.value = 'm';
        v0El.value = 0;
        v0UnitEl.value = 'm/s';
        massEl.value = 80;
        areaEl.value = 0.7;
        cdEl.value = 1.0;
        rhoEl.value = 1.204;
        medium = 'vacuum';
        document.querySelectorAll('[data-medium]').forEach(b=>b.classList.remove('active'));
        document.querySelector('[data-medium="vacuum"]').classList.add('active');
        $('ff-drag-params').classList.add('d-none');
        calculate();
    });

    $('ff-copy').addEventListener('click', function(){
        const text = `Free Fall Report\nDrop Height: ${heightEl.value} ${heightUnitEl.value}\nImpact Velocity: ${$('out-velocity').textContent}\nFall Duration: ${$('out-duration').textContent}\nKinetic Energy: ${$('out-ke').textContent}\nMedium: ${medium}\n— ToolsHub Engineering`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    // Initial run
    calculate();
});
</script>

<style>
.free-fall-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
}
.free-fall-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.free-fall-rebuilt .tool-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.free-fall-rebuilt .form-label-custom {
    font-size: 0.75rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 0.25rem;
    display: block;
}
.free-fall-rebuilt .form-label-custom-sub {
    font-size: 0.7rem;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 0.2rem;
    display: block;
}
.free-fall-rebuilt .btn-outline-custom {
    border: 1px solid #e2e8f0;
    color: #64748b;
    font-weight: 600;
    border-radius: 8px;
    transition: all .2s;
    background: #f8fafc;
}
.free-fall-rebuilt .btn-outline-custom:hover {
    background: #eef2ff;
    color: #6366f1;
    border-color: #c7d2fe;
}
.free-fall-rebuilt .btn-outline-custom.active {
    background: #6366f1;
    color: #fff;
    border-color: #6366f1;
}
.free-fall-rebuilt .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 9999px;
}
.free-fall-rebuilt .text-xxs {
    font-size: 0.65rem;
}
.free-fall-rebuilt .text-xxs.tracking-wider {
    letter-spacing: 0.05em;
}
.free-fall-rebuilt .bg-light {
    background-color: #f8fafc !important;
}
.free-fall-rebuilt .stat-card {
    transition: transform 0.2s;
}
.free-fall-rebuilt .stat-card:hover {
    transform: translateY(-1px);
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\free-fall-calculator.blade.php ENDPATH**/ ?>