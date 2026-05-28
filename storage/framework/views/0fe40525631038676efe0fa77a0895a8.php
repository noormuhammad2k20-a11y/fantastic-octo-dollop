<div class="row g-3 kinetic-energy-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label-custom">Mass ($m$)</label>
                        <div class="input-group">
                            <input type="number" id="ke-mass" class="form-control form-control-sm rounded-start-3" value="70" min="0.0001" step="any">
                            <select id="ke-mass-unit" class="form-select form-select-sm" style="max-width:100px;">
                                <option value="kg" selected>Kilograms (kg)</option>
                                <option value="lb">Pounds (lb)</option>
                                <option value="g">Grams (g)</option>
                                <option value="oz">Ounces (oz)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Velocity ($v$)</label>
                        <div class="input-group">
                            <input type="number" id="ke-velocity" class="form-control form-control-sm rounded-start-3" value="10" min="0" step="any">
                            <select id="ke-velocity-unit" class="form-select form-select-sm" style="max-width:110px;">
                                <option value="m/s" selected>m/s</option>
                                <option value="km/h">km/h</option>
                                <option value="mph">mph</option>
                                <option value="ft/s">ft/s</option>
                            </select>
                        </div>
                    </div>
                </div>

                
                <div class="mt-3 d-flex flex-wrap gap-1.5 align-items-center">
                    <span class="fw-bold text-xxs text-slate-400 text-uppercase tracking-wider me-1"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ke-quick text-xxs" data-m="0.145" data-munit="kg" data-v="95" data-vunit="mph">Baseball (95 mph)</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ke-quick text-xxs" data-m="0.009" data-munit="kg" data-v="380" data-vunit="m/s">Handgun Bullet</button>
                    <button type="button" class="btn btn-xs btn-light border rounded-pill px-2.5 ke-quick text-xxs" data-m="1500" data-munit="kg" data-v="60" data-vunit="mph">Car (60 mph)</button>
                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill px-2.5 text-xxs ms-auto" id="ke-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:24;--tool-color:#ea580c;--tool-bg:rgba(234,88,12,.03);">
            <div class="output-hero py-3">
                <span class="output-hero-label text-xxs text-uppercase tracking-widest text-slate-500">Calculated Kinetic Energy</span>
                <div class="output-hero-value text-xl font-bold tracking-tight my-1" id="out-ke-val" style="color:#ea580c;">—</div>
                <div class="text-xs text-slate-500" id="out-ke-sub">—</div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Kilojoules (kJ)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ke-kj">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Foot-Pounds (ft-lb)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ke-ftlb">—</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card p-2 text-center bg-white rounded-3 border">
                        <span class="stat-card-label text-xxs text-slate-400 block mb-0.5">Kilocalories (kcal)</span>
                        <span class="stat-card-value text-sm font-semibold text-slate-800" id="out-ke-kcal">—</span>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-3 py-2 px-4 text-sm fw-bold rounded-pill shadow-sm" id="ke-copy" style="min-width: 240px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Energy Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);

    const massEl=$('ke-mass'), massUnitEl=$('ke-mass-unit');
    const velocityEl=$('ke-velocity'), velocityUnitEl=$('ke-velocity-unit');

    function calculate(){
        let massVal = parseFloat(massEl.value) || 0;
        let velVal = parseFloat(velocityEl.value) || 0;
        if (massVal <= 0) return;

        // Metric Conversions (to kg and m/s)
        let m_kg = massVal;
        if (massUnitEl.value === 'lb') m_kg = massVal * 0.45359237;
        else if (massUnitEl.value === 'g') m_kg = massVal / 1000;
        else if (massUnitEl.value === 'oz') m_kg = massVal * 0.02834952;

        let v_ms = velVal;
        if (velocityUnitEl.value === 'km/h') v_ms = velVal / 3.6;
        else if (velocityUnitEl.value === 'mph') v_ms = velVal * 0.44704;
        else if (velocityUnitEl.value === 'ft/s') v_ms = velVal * 0.3048;

        // Kinetic Energy formula: KE = 0.5 * m * v^2
        const ke_joules = 0.5 * m_kg * v_ms * v_ms;

        // Derived units
        const ke_kj = ke_joules / 1000;
        const ke_ftlb = ke_joules * 0.73756215;
        const ke_kcal = ke_joules * 0.0002390057;

        // Update displays
        if (ke_joules >= 1000000) {
            $('out-ke-val').textContent = (ke_joules / 1000000).toFixed(4) + ' MJ';
        } else if (ke_joules >= 1000) {
            $('out-ke-val').textContent = (ke_joules / 1000).toFixed(3) + ' kJ';
        } else {
            $('out-ke-val').textContent = ke_joules.toFixed(2) + ' J';
        }

        $('out-ke-sub').textContent = ke_joules.toLocaleString(undefined, {maximumFractionDigits:2}) + ' Joules';
        $('out-ke-kj').textContent = ke_kj.toFixed(3);
        $('out-ke-ftlb').textContent = ke_ftlb.toFixed(2);
        $('out-ke-kcal').textContent = ke_kcal.toFixed(4);
    }

    // Input listeners
    [massEl, massUnitEl, velocityEl, velocityUnitEl].forEach(el=>{
        el.addEventListener('input', calculate);
    });

    // Preset handler
    document.querySelectorAll('.ke-quick').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            massEl.value = btn.dataset.m;
            massUnitEl.value = btn.dataset.munit;
            velocityEl.value = btn.dataset.v;
            velocityUnitEl.value = btn.dataset.vunit;
            calculate();
        });
    });

    $('ke-reset').addEventListener('click', ()=>{
        massEl.value = 70;
        massUnitEl.value = 'kg';
        velocityEl.value = 10;
        velocityUnitEl.value = 'm/s';
        calculate();
    });

    $('ke-copy').addEventListener('click', function(){
        const text = `Kinetic Energy Report\nMass: ${massEl.value} ${massUnitEl.value}\nVelocity: ${velocityEl.value} ${velocityUnitEl.value}\nKinetic Energy: ${$('out-ke-val').textContent}\n— ToolsHub Physics`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.kinetic-energy-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
}
.kinetic-energy-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.kinetic-energy-rebuilt .tool-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.kinetic-energy-rebuilt .form-label-custom {
    font-size: 0.75rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 0.25rem;
    display: block;
}
.kinetic-energy-rebuilt .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 9999px;
}
.kinetic-energy-rebuilt .text-xxs {
    font-size: 0.65rem;
}
.kinetic-energy-rebuilt .text-xxs.tracking-wider {
    letter-spacing: 0.05em;
}
.kinetic-energy-rebuilt .stat-card {
    transition: transform 0.2s;
}
.kinetic-energy-rebuilt .stat-card:hover {
    transform: translateY(-1px);
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\kinetic-energy-calculator.blade.php ENDPATH**/ ?>