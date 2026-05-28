<div class="row g-3 bernoulli-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-2">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Variable to Solve For</label>
                        <select id="bern-solve-for" class="form-select form-select-sm">
                            <option value="p2" selected>Pressure at Outlet (P₂)</option>
                            <option value="p1">Pressure at Inlet (P₁)</option>
                            <option value="v2">Velocity at Outlet (v₂)</option>
                            <option value="v1">Velocity at Inlet (v₁)</option>
                            <option value="z2">Elevation at Outlet (z₂)</option>
                            <option value="z1">Elevation at Inlet (z₁)</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Fluid Density ($\rho$, kg/m³)</label>
                        <div class="input-group">
                            <input type="number" id="bern-density" class="form-control form-control-sm" value="1000" min="0.01" step="any">
                            <select id="bern-preset" class="form-select form-select-sm" style="max-width:110px;">
                                <option value="1000" selected>Water</option>
                                <option value="1.204">Air</option>
                                <option value="800">Kerosene</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-12 mt-2">
                        <div class="p-3 bg-light rounded-3 border">
                            <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600"><i class="fas fa-arrow-right text-success me-1"></i>Point 1 (Inlet Parameters)</h6>
                            <div class="row g-2">
                                <div class="col-4">
                                    <label class="form-label-custom-sub">Pressure ($P_1$, Pa)</label>
                                    <input type="number" id="bern-p1" class="form-control form-control-sm" value="101325" step="any">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom-sub">Velocity ($v_1$, m/s)</label>
                                    <input type="number" id="bern-v1" class="form-control form-control-sm" value="2.0" step="any">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom-sub">Elevation ($z_1$, m)</label>
                                    <input type="number" id="bern-z1" class="form-control form-control-sm" value="0.0" step="any">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-12 mt-2">
                        <div class="p-3 bg-light rounded-3 border">
                            <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600"><i class="fas fa-arrow-right text-info me-1"></i>Point 2 (Outlet Parameters)</h6>
                            <div class="row g-2">
                                <div class="col-4">
                                    <label class="form-label-custom-sub">Pressure ($P_2$, Pa)</label>
                                    <input type="number" id="bern-p2" class="form-control form-control-sm" value="" placeholder="Solving..." step="any" disabled>
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom-sub">Velocity ($v_2$, m/s)</label>
                                    <input type="number" id="bern-v2" class="form-control form-control-sm" value="6.0" step="any">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom-sub">Elevation ($z_2$, m)</label>
                                    <input type="number" id="bern-z2" class="form-control form-control-sm" value="1.5" step="any">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-3 d-flex flex-wrap gap-1.5 align-items-center">
                    <span class="fw-bold text-xxs text-slate-400 text-uppercase tracking-wider me-1"><i class="fas fa-bolt text-warning me-1"></i>Quick Scenarios:</span>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 bern-quick text-xxs" data-type="venturi">📐 Venturi Tube</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 bern-quick text-xxs" data-type="drain">🚰 Water Tank Drain</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 bern-quick text-xxs" data-type="siphon">🌀 Elevational Siphon</button>
                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill px-2.5 text-xxs ms-auto" id="bern-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(5, 150, 105, 0.03);">
            <div class="output-hero py-3">
                <span class="output-hero-label text-xxs text-uppercase tracking-widest text-slate-500" id="out-bern-hero-lbl">Calculated Parameter</span>
                <div class="output-hero-value text-xl font-bold tracking-tight my-1" id="out-bern-hero-val" style="color:#059669;">—</div>
                <div class="text-xs text-slate-500" id="out-bern-hero-sub">—</div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Total Head (Point 1)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-bern-head1">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Dyn Press Change</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-bern-dyn">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Elev Press Change</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-bern-elev">—</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-3 p-3 bg-light rounded-3 border text-center">
                <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600 text-left"><i class="fas fa-eye me-1"></i>Venturi & Elevation Profile</h6>
                <div class="d-flex align-items-center justify-content-center bg-white rounded border py-2" style="height:90px;">
                    <svg id="bern-schematic" viewBox="0 0 200 80" class="w-100 h-100" style="max-width: 320px;">
                        <!-- Custom Venturi Pipe Layout with dynamic heights -->
                        <path id="bern-pipe-path" d="M10 20 L60 20 Q100 20 100 35 Q100 20 140 20 L190 20 L190 60 L140 60 Q100 60 100 45 Q100 60 60 60 L10 60 Z" fill="#eff6ff" stroke="#059669" stroke-width="1.5"/>
                        <!-- Fluid streams -->
                        <path d="M10 40 L190 40" stroke="rgba(5,150,105,0.15)" stroke-width="20" stroke-dasharray="5 5"/>
                        <!-- Point markers -->
                        <circle cx="35" cy="40" r="4" fill="#059669"/>
                        <text x="35" y="32" font-size="7" font-weight="bold" fill="#059669" text-anchor="middle">Point 1</text>
                        <circle cx="165" cy="40" r="4" fill="#3b82f6"/>
                        <text x="165" y="32" font-size="7" font-weight="bold" fill="#3b82f6" text-anchor="middle">Point 2</text>
                    </svg>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-3 py-2 px-4 text-sm fw-bold rounded-pill shadow-sm" id="bern-copy" style="min-width: 240px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Fluid Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);

    const solveForEl=$('bern-solve-for');
    const densityEl=$('bern-density');
    const presetEl=$('bern-preset');

    const p1El=$('bern-p1'), v1El=$('bern-v1'), z1El=$('bern-z1');
    const p2El=$('bern-p2'), v2El=$('bern-v2'), z2El=$('bern-z2');
    const g = 9.80665;

    const inputElements = {
        p1: p1El, v1: v1El, z1: z1El,
        p2: p2El, v2: v2El, z2: z2El
    };

    function updateInputsState(){
        const solveFor = solveForEl.value;
        Object.keys(inputElements).forEach(key => {
            const input = inputElements[key];
            if (key === solveFor) {
                input.setAttribute('disabled', 'true');
                input.value = "";
                input.placeholder = "Solving...";
            } else {
                input.removeAttribute('disabled');
                if (input.value === "") {
                    if (key.startsWith('p')) input.value = "101325";
                    else if (key.startsWith('v')) input.value = "2.0";
                    else if (key.startsWith('z')) input.value = "0.0";
                }
            }
        });
    }

    function calculate(){
        const solveFor = solveForEl.value;
        const rho = parseFloat(densityEl.value) || 1000;

        let p1 = parseFloat(p1El.value);
        let v1 = parseFloat(v1El.value);
        let z1 = parseFloat(z1El.value);
        let p2 = parseFloat(p2El.value);
        let v2 = parseFloat(v2El.value);
        let z2 = parseFloat(z2El.value);

        let C;
        if (solveFor.endsWith('2')) {
            if (isNaN(p1) || isNaN(v1) || isNaN(z1)) return;
            C = p1 + 0.5 * rho * v1 * v1 + rho * g * z1;
        } else {
            if (isNaN(p2) || isNaN(v2) || isNaN(z2)) return;
            C = p2 + 0.5 * rho * v2 * v2 + rho * g * z2;
        }

        let solvedVal = 0;
        let solvedLabel = "";
        let solvedSub = "";

        if (solveFor === 'p2') {
            solvedVal = C - (0.5 * rho * v2 * v2 + rho * g * z2);
            p2 = solvedVal;
            solvedLabel = "Calculated Pressure at Outlet (P₂)";
            solvedSub = solvedVal.toLocaleString(undefined, {maximumFractionDigits:1}) + ' Pascals (Pa)';
        } else if (solveFor === 'p1') {
            solvedVal = C - (0.5 * rho * v1 * v1 + rho * g * z1);
            p1 = solvedVal;
            solvedLabel = "Calculated Pressure at Inlet (P₁)";
            solvedSub = solvedVal.toLocaleString(undefined, {maximumFractionDigits:1}) + ' Pascals (Pa)';
        } else if (solveFor === 'v2') {
            const rad = (C - p2 - rho * g * z2) / (0.5 * rho);
            solvedVal = Math.sqrt(Math.abs(rad));
            v2 = solvedVal;
            solvedLabel = "Calculated Velocity at Outlet (v₂)";
            solvedSub = solvedVal.toFixed(3) + ' m/s';
        } else if (solveFor === 'v1') {
            const rad = (C - p1 - rho * g * z1) / (0.5 * rho);
            solvedVal = Math.sqrt(Math.abs(rad));
            v1 = solvedVal;
            solvedLabel = "Calculated Velocity at Inlet (v₁)";
            solvedSub = solvedVal.toFixed(3) + ' m/s';
        } else if (solveFor === 'z2') {
            solvedVal = (C - p2 - 0.5 * rho * v2 * v2) / (rho * g);
            z2 = solvedVal;
            solvedLabel = "Calculated Elevation at Outlet (z₂)";
            solvedSub = solvedVal.toFixed(3) + ' meters (m)';
        } else if (solveFor === 'z1') {
            solvedVal = (C - p1 - 0.5 * rho * v1 * v1) / (rho * g);
            z1 = solvedVal;
            solvedLabel = "Calculated Elevation at Inlet (z₁)";
            solvedSub = solvedVal.toFixed(3) + ' meters (m)';
        }

        // Output Display
        $('out-bern-hero-lbl').textContent = solvedLabel;
        $('out-bern-hero-val').textContent = solvedSub;
        $('out-bern-hero-sub').textContent = `Constant energy head: ${(C/1000).toFixed(2)} kPa`;

        const head1_m = C / (rho * g);
        const dp_dyn = 0.5 * rho * (v2 * v2 - v1 * v1);
        const dp_elev = rho * g * (z2 - z1);

        $('out-bern-head1').textContent = head1_m.toFixed(2) + ' m';
        $('out-bern-dyn').textContent = (dp_dyn/1000).toFixed(2) + ' kPa';
        $('out-bern-elev').textContent = (dp_elev/1000).toFixed(2) + ' kPa';

        // Animate schematic based on elevation differences
        const pipe = $('bern-pipe-path');
        const elevDiff = z2 - z1;
        
        let pathD = "M10 20 L60 20 Q100 20 100 35 Q100 20 140 20 L190 20 L190 60 L140 60 Q100 60 100 45 Q100 60 60 60 L10 60 Z";
        if (elevDiff > 0.5) {
            pathD = "M10 30 L60 30 Q100 30 100 25 Q100 10 140 10 L190 10 L190 50 L140 50 Q100 50 100 45 Q100 70 60 70 L10 70 Z";
        } else if (elevDiff < -0.5) {
            pathD = "M10 10 L60 10 Q100 10 100 25 Q100 30 140 30 L190 30 L190 70 L140 70 Q100 70 100 45 Q100 50 60 50 L10 50 Z";
        }
        pipe.setAttribute('d', pathD);
    }

    presetEl.addEventListener('change', ()=>{
        if (presetEl.value !== 'custom') {
            densityEl.value = presetEl.value;
        }
        calculate();
    });

    solveForEl.addEventListener('change', ()=>{
        updateInputsState();
        calculate();
    });

    [densityEl, p1El, v1El, z1El, p2El, v2El, z2El].forEach(el=>{
        el.addEventListener('input', calculate);
    });

    // Quick presets
    document.querySelectorAll('.bern-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const type = btn.dataset.type;
            if (type === 'venturi') {
                solveForEl.value = 'p2';
                densityEl.value = 1000;
                presetEl.value = '1000';
                p1El.value = 150000;
                v1El.value = 1.0;
                z1El.value = 0.0;
                v2El.value = 4.0;
                z2El.value = 0.0;
            } else if (type === 'drain') {
                solveForEl.value = 'v2';
                densityEl.value = 1000;
                presetEl.value = '1000';
                p1El.value = 101325;
                v1El.value = 0.0;
                z1El.value = 5.0;
                p2El.value = 101325;
                z2El.value = 0.0;
            } else if (type === 'siphon') {
                solveForEl.value = 'p2';
                densityEl.value = 800;
                presetEl.value = '800';
                p1El.value = 101325;
                v1El.value = 0.5;
                z1El.value = 2.0;
                v2El.value = 2.5;
                z2El.value = -1.0;
            }
            updateInputsState();
            calculate();
        });
    });

    $('bern-reset').addEventListener('click', ()=>{
        solveForEl.value = 'p2';
        densityEl.value = 1000;
        presetEl.value = '1000';
        p1El.value = 101325;
        v1El.value = 2.0;
        z1El.value = 0.0;
        v2El.value = 6.0;
        z2El.value = 1.5;
        updateInputsState();
        calculate();
    });

    $('bern-copy').addEventListener('click', function(){
        const text = `Bernoulli Pro Report\nFluid Density: ${densityEl.value} kg/m³\nSolved Variable: ${solveForEl.value.toUpperCase()}\nValue: ${$('out-bern-hero-val').textContent}\nTotal Head: ${$('out-bern-head1').textContent}\n— ToolsHub Fluids`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    updateInputsState();
    calculate();
});
</script>

<style>
.bernoulli-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
}
.bernoulli-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.bernoulli-rebuilt .tool-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.bernoulli-rebuilt .form-label-custom {
    font-size: 0.75rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 0.25rem;
    display: block;
}
.bernoulli-rebuilt .form-label-custom-sub {
    font-size: 0.7rem;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 0.2rem;
    display: block;
}
.bernoulli-rebuilt .btn-outline-custom {
    border: 1px solid #e2e8f0;
    color: #64748b;
    font-weight: 600;
    border-radius: 8px;
    transition: all .2s;
    background: #f8fafc;
}
.bernoulli-rebuilt .btn-outline-custom:hover {
    background: #ecfdf5;
    color: #059669;
    border-color: #a7f3d0;
}
.bernoulli-rebuilt .btn-outline-custom.active {
    background: #059669;
    color: #fff;
    border-color: #059669;
}
.bernoulli-rebuilt .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 9999px;
}
.bernoulli-rebuilt .text-xxs {
    font-size: 0.65rem;
}
.bernoulli-rebuilt .text-xxs.tracking-wider {
    letter-spacing: 0.05em;
}
.bernoulli-rebuilt .stat-card {
    transition: transform 0.2s;
}
.bernoulli-rebuilt .stat-card:hover {
    transform: translateY(-1px);
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bernoulli-equation-pro.blade.php ENDPATH**/ ?>