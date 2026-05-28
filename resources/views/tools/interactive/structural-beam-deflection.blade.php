<div class="row g-3 beam-deflection-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-2">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Support Configuration</label>
                        <select id="beam-support" class="form-select form-select-sm">
                            <option value="simply" selected>Simply Supported (Pinned-Roller)</option>
                            <option value="cantilever">Cantilever (Fixed-Free)</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Load Profile</label>
                        <select id="beam-load-type" class="form-select form-select-sm">
                            <option value="point" selected>Concentrated Point Load (at center/tip)</option>
                            <option value="udl">Uniformly Distributed Load (UDL)</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-3 mt-2">
                        <label class="form-label-custom">Load Magnitude</label>
                        <div class="input-group">
                            <input type="number" id="beam-load-val" class="form-control form-control-sm rounded-start-3" value="5000" min="0.1" step="any">
                            <span class="input-group-text py-0 px-2 text-xxs" id="beam-load-unit">N</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <label class="form-label-custom">Beam Span ($L$, m)</label>
                        <input type="number" id="beam-length" class="form-control form-control-sm" value="4.0" min="0.1" step="any">
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <label class="form-label-custom">Elastic Modulus ($E$, GPa)</label>
                        <div class="input-group">
                            <input type="number" id="beam-modulus" class="form-control form-control-sm rounded-start-3" value="200" min="0.1" step="any">
                            <select id="beam-material-preset" class="form-select form-select-sm" style="max-width:85px;">
                                <option value="200" selected>Steel</option>
                                <option value="69">Alum</option>
                                <option value="11">Wood</option>
                                <option value="25">Conc</option>
                                <option value="custom">Cust</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <label class="form-label-custom">Inertia ($I$, cm⁴)</label>
                        <input type="number" id="beam-inertia" class="form-control form-control-sm" value="4500" min="0.1" step="any">
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-3 d-flex flex-wrap gap-1.5 align-items-center">
                    <span class="fw-bold text-xxs text-slate-400 text-uppercase tracking-wider me-1"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 beam-quick text-xxs" data-s="simply" data-l="point" data-p="5000" data-len="4.0" data-e="200" data-i="4500">🏗️ Steel I-Beam Point Load</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 beam-quick text-xxs" data-s="simply" data-l="udl" data-p="1200" data-len="6.0" data-e="11" data-i="12000">🌲 Timber Joist UDL</button>
                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill px-2.5 text-xxs ms-auto" id="beam-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0f172a;--tool-bg:rgba(15, 23, 42, 0.03);">
            <div class="output-hero py-3">
                <span class="output-hero-label text-xxs text-uppercase tracking-widest text-slate-500">Maximum Beam Deflection</span>
                <div class="output-hero-value text-xl font-bold tracking-tight my-1" id="out-beam-deflection" style="color:#0f172a;">—</div>
                <div class="text-xs text-slate-500" id="out-beam-safety">—</div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Bending Stiffness (EI)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-beam-ei">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Reaction Forces</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-beam-reactions">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Max Bending Moment</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-beam-moment">—</span>
                    </div>
                </div>
            </div>

            {{-- SVG Elastic Deflection Visualizer --}}
            <div class="mt-3 p-3 bg-light rounded-3 border text-center">
                <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600 text-left"><i class="fas fa-eye me-1"></i>Deflection Curve Profile</h6>
                <div class="d-flex align-items-center justify-content-center bg-white rounded border py-2" style="height:100px;">
                    <svg id="beam-schematic" viewBox="0 0 200 80" class="w-100 h-100" style="max-width: 320px;">
                        <!-- Beam original (ghost) line -->
                        <line x1="20" y1="40" x2="180" y2="40" stroke="#f1f5f9" stroke-width="4" stroke-linecap="round"/>
                        
                        <!-- Fixed end support (for cantilever) -->
                        <rect id="schem-support-fixed" x="12" y="15" width="8" height="50" fill="#94a3b8" class="d-none"/>
                        <!-- Simple supports -->
                        <g id="schem-supports-simple">
                            <polygon points="20,40 15,55 25,55" fill="#64748b"/>
                            <polygon points="180,40 175,55 185,55" fill="#64748b"/>
                        </g>

                        <!-- Deflected elastic curve path -->
                        <path id="schem-beam-curve" d="M20,40 Q100,40 180,40" fill="none" stroke="#3b82f6" stroke-width="3" stroke-linecap="round"/>

                        <!-- Load indicator vector arrow -->
                        <g id="schem-arrow" transform="translate(100, 10)">
                            <line x1="0" y1="0" x2="0" y2="20" stroke="#ef4444" stroke-width="1.5"/>
                            <polygon points="0,20 -3,14 3,14" fill="#ef4444"/>
                        </g>
                        <!-- UDL multi arrows -->
                        <g id="schem-udl-arrows" class="d-none">
                            <path d="M40,20 L40,35 M80,20 L80,35 M120,20 L120,35 M160,20 L160,35" stroke="#ef4444" stroke-width="1" marker-end="url(#arrow)"/>
                        </g>
                    </svg>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-3 py-2 px-4 text-sm fw-bold rounded-pill shadow-sm" id="beam-copy" style="min-width: 240px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Deflection Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);

    const supportEl=$('beam-support');
    const loadTypeEl=$('beam-load-type');
    const loadValEl=$('beam-load-val');
    const lengthEl=$('beam-length');
    const modulusEl=$('beam-modulus');
    const materialPresetEl=$('beam-material-preset');
    const inertiaEl=$('beam-inertia');
    const loadUnitEl=$('beam-load-unit');

    function updateLabels(){
        if (loadTypeEl.value === 'udl') {
            loadUnitEl.textContent = 'N/m';
        } else {
            loadUnitEl.textContent = 'N';
        }
    }

    function calculate(){
        updateLabels();

        const support = supportEl.value;
        const loadType = loadTypeEl.value;
        const load = parseFloat(loadValEl.value) || 0;
        const L = parseFloat(lengthEl.value) || 0;
        const E_gpa = parseFloat(modulusEl.value) || 200;
        const I_cm4 = parseFloat(inertiaEl.value) || 1000;

        if (load <= 0 || L <= 0 || E_gpa <= 0 || I_cm4 <= 0) return;

        // Convert GPa to N/m^2 (Pascal)
        const E = E_gpa * 1e9;
        // Convert cm^4 to m^4 (1 cm^4 = 1e-8 m^4)
        const I = I_cm4 * 1e-8;

        const EI = E * I; // Flexural rigidity

        let delta = 0;
        let R1 = 0, R2 = 0;
        let M_max = 0;

        if (support === 'simply') {
            $('schem-support-fixed').classList.add('d-none');
            $('schem-supports-simple').classList.remove('d-none');

            if (loadType === 'point') {
                delta = (load * Math.pow(L, 3)) / (48 * EI);
                R1 = load / 2;
                R2 = load / 2;
                M_max = (load * L) / 4;

                $('schem-arrow').setAttribute('transform', 'translate(100, 15)');
                $('schem-udl-arrows').classList.add('d-none');
                $('schem-arrow').classList.remove('d-none');
            } else {
                delta = (5 * load * Math.pow(L, 4)) / (384 * EI);
                R1 = (load * L) / 2;
                R2 = (load * L) / 2;
                M_max = (load * L * L) / 8;

                $('schem-arrow').classList.add('d-none');
                $('schem-udl-arrows').classList.remove('d-none');
            }
        } else {
            $('schem-support-fixed').classList.remove('d-none');
            $('schem-supports-simple').classList.add('d-none');

            if (loadType === 'point') {
                delta = (load * Math.pow(L, 3)) / (3 * EI);
                R1 = load;
                M_max = load * L;

                $('schem-arrow').setAttribute('transform', 'translate(170, 15)');
                $('schem-udl-arrows').classList.add('d-none');
                $('schem-arrow').classList.remove('d-none');
            } else {
                delta = (load * Math.pow(L, 4)) / (8 * EI);
                R1 = load * L;
                M_max = (load * L * L) / 2;

                $('schem-arrow').classList.add('d-none');
                $('schem-udl-arrows').classList.remove('d-none');
            }
        }

        // Display results
        const deltaMm = delta * 1000;
        $('out-beam-deflection').textContent = deltaMm.toFixed(2) + ' mm';
        
        // Deflection safety checks: Standard structural limit L/360
        const limit_360 = (L * 1000) / 360;
        const limit_180 = (L * 1000) / 180;
        let safetyText = "";
        if (deltaMm <= limit_360) {
            safetyText = `Safe: deflection within code limit L/360 (${limit_360.toFixed(1)} mm)`;
            $('out-beam-safety').style.color = "#059669";
        } else if (deltaMm <= limit_180) {
            safetyText = `Caution: exceeds L/360 (${limit_360.toFixed(1)} mm) but within L/180`;
            $('out-beam-safety').style.color = "#d97706";
        } else {
            safetyText = `Warning: exceeds code limit L/180 (${limit_180.toFixed(1)} mm) — increase beam sizing!`;
            $('out-beam-safety').style.color = "#dc2626";
        }
        $('out-beam-safety').textContent = safetyText;

        $('out-beam-ei').textContent = EI.toExponential(2) + ' N·m²';
        $('out-beam-reactions').textContent = R2 > 0 ? `${R1.toFixed(0)}N / ${R2.toFixed(0)}N` : `${R1.toFixed(0)}N (Wall)`;
        $('out-beam-moment').textContent = M_max >= 1000 ? (M_max/1000).toFixed(2) + ' kN·m' : M_max.toFixed(0) + ' N·m';

        // Schematic Vector Update
        const curve = $('schem-beam-curve');
        const visualDelta = Math.min(25, deltaMm * 1.5);
        if (support === 'simply') {
            curve.setAttribute('d', `M20 40 Q100 ${40 + visualDelta} 180 40`);
        } else {
            curve.setAttribute('d', `M20 40 Q100 40 180 ${40 + visualDelta}`);
        }
    }

    // Material Preset
    materialPresetEl.addEventListener('change', ()=>{
        if (materialPresetEl.value !== 'custom') {
            modulusEl.value = materialPresetEl.value;
        }
        calculate();
    });

    [supportEl, loadTypeEl, loadValEl, lengthEl, modulusEl, inertiaEl].forEach(el=>{
        el.addEventListener('input', calculate);
    });

    // Quick presets trigger
    document.querySelectorAll('.beam-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            supportEl.value = btn.dataset.s;
            loadTypeEl.value = btn.dataset.l;
            loadValEl.value = btn.dataset.p;
            lengthEl.value = btn.dataset.len;
            modulusEl.value = btn.dataset.e;
            materialPresetEl.value = btn.dataset.e;
            inertiaEl.value = btn.dataset.i;
            calculate();
        });
    });

    $('beam-reset').addEventListener('click', ()=>{
        supportEl.value = 'simply';
        loadTypeEl.value = 'point';
        loadValEl.value = 5000;
        lengthEl.value = 4.0;
        modulusEl.value = 200;
        materialPresetEl.value = '200';
        inertiaEl.value = 4500;
        calculate();
    });

    $('beam-copy').addEventListener('click', function(){
        const text = `Structural Beam Deflection Report\nSupport: ${supportEl.options[supportEl.selectedIndex].text}\nSpan Length: ${lengthEl.value} m\nMax Deflection: ${$('out-beam-deflection').textContent}\nStiffness: ${$('out-beam-ei').textContent}\n— ToolsHub Structural`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.beam-deflection-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
}
.beam-deflection-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.beam-deflection-rebuilt .tool-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.beam-deflection-rebuilt .form-label-custom {
    font-size: 0.75rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 0.25rem;
    display: block;
}
.beam-deflection-rebuilt .form-label-custom-sub {
    font-size: 0.7rem;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 0.2rem;
    display: block;
}
.beam-deflection-rebuilt .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 9999px;
}
.beam-deflection-rebuilt .text-xxs {
    font-size: 0.65rem;
}
.beam-deflection-rebuilt .text-xxs.tracking-wider {
    letter-spacing: 0.05em;
}
.beam-deflection-rebuilt .stat-card {
    transition: transform 0.2s;
}
.beam-deflection-rebuilt .stat-card:hover {
    transform: translateY(-1px);
}
</style>
