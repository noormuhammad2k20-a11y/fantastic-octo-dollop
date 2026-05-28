<div class="row g-3 pcb-trace-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-2">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Current Load ($I$, Amps)</label>
                        <input type="number" id="pcb-current" class="form-control form-control-sm" value="2.0" min="0.01" step="any">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label-custom">Temp Rise ($\Delta T$, °C)</label>
                        <input type="number" id="pcb-temp-rise" class="form-control form-control-sm" value="10" min="0.1" step="any">
                    </div>
                    <div class="col-md-6 col-sm-12 mt-2">
                        <label class="form-label-custom">Copper Thickness ($T$)</label>
                        <select id="pcb-thickness" class="form-select form-select-sm">
                            <option value="0.5">0.5 oz (17.5 µm)</option>
                            <option value="1.0" selected>1.0 oz (35 µm)</option>
                            <option value="2.0">2.0 oz (70 µm)</option>
                            <option value="3.0">3.0 oz (105 µm)</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-2">
                        <label class="form-label-custom">Trace Placement</label>
                        <select id="pcb-layer" class="form-select form-select-sm">
                            <option value="external" selected>External Layer (Air Convection)</option>
                            <option value="internal">Internal Layer (Conduction only)</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-3 d-flex flex-wrap gap-1.5 align-items-center">
                    <span class="fw-bold text-xxs text-slate-400 text-uppercase tracking-wider me-1"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 pcb-quick text-xxs" data-i="0.5" data-dt="10">📡 Signal (0.5A)</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 pcb-quick text-xxs" data-i="3.0" data-dt="15">🔌 Power Rail (3A)</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 pcb-quick text-xxs" data-i="12.0" data-dt="30">⚡ High Power (12A)</button>
                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill px-2.5 text-xxs ms-auto" id="pcb-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:190;--tool-color:#06b6d4;--tool-bg:rgba(6, 182, 212, 0.03);">
            <div class="output-hero py-3">
                <span class="output-hero-label text-xxs text-uppercase tracking-widest text-slate-500">Minimum Conductor Width</span>
                <div class="output-hero-value text-xl font-bold tracking-tight my-1" id="out-pcb-width" style="color:#06b6d4;">—</div>
                <div class="text-xs text-slate-500" id="out-pcb-mils">—</div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Cross-Section Area</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-pcb-area">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Resistance / Meter</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-pcb-res">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Voltage Drop / M</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-pcb-drop">—</span>
                    </div>
                </div>
            </div>

            {{-- Conductor Profile Visualizer --}}
            <div class="mt-3 p-3 bg-light rounded-3 border text-center">
                <h6 class="fw-bold mb-2 text-xs text-uppercase tracking-wider text-slate-600 text-left"><i class="fas fa-eye me-1"></i>Conductor Profile Preview</h6>
                <div class="d-flex align-items-center justify-content-center bg-slate-900 rounded py-4 position-relative" style="height:100px; background:#1e293b;">
                    <div id="pcb-preview-trace" style="background:#fbbf24; border-radius: 2px; transition: all 0.3s ease; box-shadow:0 0 10px rgba(251,191,36,0.3);"></div>
                    <span class="text-white text-xxs absolute bottom-1 font-mono opacity-75" id="pcb-preview-lbl">Trace profile view</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-3 py-2 px-4 text-sm fw-bold rounded-pill shadow-sm" id="pcb-copy" style="min-width: 240px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Conductor Data</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);

    const currentEl=$('pcb-current');
    const tempRiseEl=$('pcb-temp-rise');
    const thicknessEl=$('pcb-thickness');
    const layerEl=$('pcb-layer');

    function calculate(){
        const I = parseFloat(currentEl.value) || 0;
        const dT = parseFloat(tempRiseEl.value) || 0;
        const oz = parseFloat(thicknessEl.value) || 1.0;
        const isInternal = layerEl.value === 'internal';

        if (I <= 0 || dT <= 0) return;

        // Constants per IPC-2221 standard
        const k = isInternal ? 0.024 : 0.048;
        const b = 0.44;
        const c = 0.725;

        // Area in mils^2
        const A_mils2 = Math.pow(I / (k * Math.pow(dT, b)), 1 / c);
        
        // Copper thickness in mils (1 oz = 1.378 mils = 35 µm)
        const t_mils = oz * 1.378;

        // Conductor width = Area / Thickness
        const W_mils = A_mils2 / t_mils;
        const W_mm = W_mils * 0.0254;

        // Electrical metrics per meter
        // Resistivity of copper @ 20°C: 1.724e-8 Ohm-m
        const rho_copper = 1.724e-8;
        const A_m2 = A_mils2 * 6.4516e-10; // mils^2 to m^2
        
        // Adjust resistivity for target temperature
        const tempCoeff = 0.00393; // per °C
        const targetTemp = 20 + dT;
        const rho_temp = rho_copper * (1 + tempCoeff * (targetTemp - 20));
        
        const resistance = rho_temp / A_m2;
        const drop = I * resistance;

        // UI Displays
        $('out-pcb-width').textContent = W_mm.toFixed(3) + ' mm';
        $('out-pcb-mils').textContent = W_mils.toFixed(1) + ' mils (' + (W_mm*1000).toFixed(0) + ' µm)';
        $('out-pcb-area').textContent = A_mils2.toFixed(1) + ' mils²';
        $('out-pcb-res').textContent = resistance.toFixed(4) + ' Ω/m';
        $('out-pcb-drop').textContent = drop.toFixed(3) + ' V/m';

        // Graphic preview scaling
        const trace = $('pcb-preview-trace');
        const visualWidth = Math.min(90, Math.max(8, W_mils * 0.8));
        const visualHeight = Math.min(40, Math.max(4, oz * 8));
        trace.style.width = visualWidth + '%';
        trace.style.height = visualHeight + 'px';
        $('pcb-preview-lbl').textContent = `Conductor: ${W_mm.toFixed(2)}mm x ${(oz*35).toFixed(0)}µm profile`;
    }

    [currentEl, tempRiseEl, thicknessEl, layerEl].forEach(el=>{
        el.addEventListener('input', calculate);
    });

    // Preset handlers
    document.querySelectorAll('.pcb-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            currentEl.value = btn.dataset.i;
            tempRiseEl.value = btn.dataset.dt;
            calculate();
        });
    });

    $('pcb-reset').addEventListener('click', ()=>{
        currentEl.value = 2.0;
        tempRiseEl.value = 10;
        thicknessEl.value = '1.0';
        layerEl.value = 'external';
        calculate();
    });

    $('pcb-copy').addEventListener('click', function(){
        const text = `PCB Trace Report (IPC-2221)\nCurrent: ${currentEl.value} A\nTemp Rise: ${tempRiseEl.value} °C\nCopper: ${thicknessEl.options[thicknessEl.selectedIndex].text}\nPlacement: ${layerEl.options[layerEl.selectedIndex].text}\nRequired Width: ${$('out-pcb-width').textContent} (${$('out-pcb-mils').textContent})\nResistance: ${$('out-pcb-res').textContent}\n— ToolsHub Hardware`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pcb-trace-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
}
.pcb-trace-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.pcb-trace-rebuilt .tool-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.pcb-trace-rebuilt .form-label-custom {
    font-size: 0.75rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 0.25rem;
    display: block;
}
.pcb-trace-rebuilt .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 9999px;
}
.pcb-trace-rebuilt .text-xxs {
    font-size: 0.65rem;
}
.pcb-trace-rebuilt .text-xxs.tracking-wider {
    letter-spacing: 0.05em;
}
.pcb-trace-rebuilt .stat-card {
    transition: transform 0.2s;
}
.pcb-trace-rebuilt .stat-card:hover {
    transform: translateY(-1px);
}
</style>
