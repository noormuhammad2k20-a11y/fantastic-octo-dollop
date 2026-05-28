<div class="interactive-wrapper">
    {{-- Input Card (Thermodynamic Slap Settings) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            {{-- Quick Presets --}}
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-magic text-primary me-2"></i>Impact presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-hand="0.4" data-vel="11" data-eff="10">✋ Standard Human (11 m/s)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-hand="0.5" data-vel="25" data-eff="15">🥊 Athlete Punch (25 m/s)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-hand="2.0" data-vel="343" data-eff="50">🤖 Supersonic Robotic Arm (343 m/s)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-hand="10.0" data-vel="3000" data-eff="90">⚡ Superhero Fist (3000 m/s)</button>
                </div>
            </div>

            <div class="row g-4">
                {{-- Chicken specifications --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Chicken Specifications</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Weight (kg)</label>
                                <input type="number" id="sl-mass" class="form-control form-control-lg rounded-3" value="1.5" min="0.1" step="0.1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Initial Temp (°C)</label>
                                <input type="number" id="sl-init-temp" class="form-control form-control-lg rounded-3" value="20" min="-20" max="40">
                            </div>
                            <div class="col-12">
                                <span class="x-small text-muted fw-bold d-block mt-2"><i class="fas fa-info-circle me-1"></i> Target cooking temperature is standardly set to <strong>74°C (165°F)</strong>.</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Impact specifications --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Impact Velocity & Hand</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Slap Speed (m/s)</label>
                                <input type="number" id="sl-vel" class="form-control form-control-lg rounded-3" value="11" min="1" max="100000">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Hand Weight (kg)</label>
                                <input type="number" id="sl-hand-mass" class="form-control form-control-lg rounded-3" value="0.4" min="0.01" step="0.05">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Thermal Efficiency (%)</label>
                                <div class="input-group">
                                    <input type="number" id="sl-efficiency" class="form-control form-control-lg rounded-start-3" value="10" min="0.1" max="100" step="0.5">
                                    <span class="input-group-text rounded-end-3">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-fire me-2"></i> Compute Required Slaps
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Meme Results) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Thermodynamic Analysis</h5>
                        <p class="text-muted small mb-0">Total kinetic slaps required to fully thermalize the protein</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Slap Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                {{-- Slap Count --}}
                <div class="col-lg-5 text-center border-end">
                    <div class="display-4 fw-bold text-dark mb-0 font-monospace" id="out-slaps">0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Slaps Required</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-speed-class" style="background-color: #ef4444; color: #fff;">SUBSONIC</span>
                    </div>
                </div>

                {{-- Kinetic statistics --}}
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Total Kinetic Energy</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-energy">0 J</div>
                                <div class="x-small text-muted fw-bold">Combined energy output</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Explosive Force</div>
                                <div class="h5 fw-bold mb-0 text-danger" id="out-tnt">0 g TNT</div>
                                <div class="x-small text-muted fw-bold">Equivalent energy release</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Temp Rise Per Slap</div>
                                <div class="h5 fw-bold mb-0 text-success" id="out-temp-rise">0.000000000°C</div>
                                <div class="x-small text-muted fw-bold">Absorbed thermal delta</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center">Thermodynamic Insights</h6>
                        <ul class="list-unstyled mb-0 small text-secondary" id="out-insights">
                            {{-- Injected dynamically --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --danger-soft: #fef2f2;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-danger-soft { background-color: var(--danger-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1.5px solid #e2e8f0; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.05rem; padding: 0.65rem 0.85rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .font-monospace { font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const massInput = document.getElementById('sl-mass');
    const initTempInput = document.getElementById('sl-init-temp');
    const velInput = document.getElementById('sl-vel');
    const handMassInput = document.getElementById('sl-hand-mass');
    const effInput = document.getElementById('sl-efficiency');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    const outSlaps = document.getElementById('out-slaps');
    const outSpeedClass = document.getElementById('out-speed-class');
    const outEnergy = document.getElementById('out-energy');
    const outTnt = document.getElementById('out-tnt');
    const outTempRise = document.getElementById('out-temp-rise');
    const outInsights = document.getElementById('out-insights');

    // Preset Selection
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            handMassInput.value = btn.dataset.hand;
            velInput.value = btn.dataset.vel;
            effInput.value = btn.dataset.eff;
        });
    });

    function calculate() {
        const chickenMass = parseFloat(massInput.value) || 0;
        const initTemp = parseFloat(initTempInput.value) || 0;
        const slapVel = parseFloat(velInput.value) || 0;
        const handMass = parseFloat(handMassInput.value) || 0;
        const efficiency = (parseFloat(effInput.value) || 0) / 100;

        if (chickenMass <= 0 || slapVel <= 0 || handMass <= 0 || efficiency <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Converting Kinetic Energy...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const targetTemp = 74; // standard cooked chicken target
            const deltaT = targetTemp - initTemp;

            // Enforce realistic bounds
            if (deltaT <= 0) {
                alert("Initial temperature is already at or above standard fully cooked temperature (74°C)!");
                btnCalculate.innerHTML = '<i class="fas fa-fire me-2"></i> Compute Required Slaps';
                btnCalculate.disabled = false;
                return;
            }

            // Chicken specific heat capacity: standard approximation is 3.5 kJ/(kg * °C) = 3500 J/(kg * °C)
            const specificHeat = 3500;
            const requiredEnergy = chickenMass * specificHeat * deltaT; // Joules

            // Hand kinetic energy: 0.5 * m * v^2
            const kineticEnergyPerSlap = 0.5 * handMass * Math.pow(slapVel, 2); // Joules
            const thermalEnergyAbsorbedPerSlap = kineticEnergyPerSlap * efficiency; // Joules

            let slapsRequired = requiredEnergy / thermalEnergyAbsorbedPerSlap;
            
            // Check speed bounds and status classifications
            let speedClass = 'SUBSONIC SLAP';
            let speedColor = '#3b82f6';
            let hazardRating = '';

            if (slapVel >= 3000) {
                speedClass = 'COSMIC SLAP';
                speedColor = '#ec4899';
                hazardRating = 'At cosmic speeds, a single slap releases extreme thermal energy, but the resulting shockwave would completely vaporize the atomic molecular integrity of the chicken.';
            } else if (slapVel >= 343) {
                speedClass = 'SUPERSONIC SLAP';
                speedColor = '#ef4444';
                hazardRating = 'Supersonic slaps create structural mechanical failure. The kinetic shockwave will shatter bone tissue.';
            } else if (slapVel >= 50) {
                speedClass = 'HYPER VELOCITY';
                speedColor = '#f59e0b';
                hazardRating = 'Highly accelerated manual strike. Specialized mechanical protection recommended for the slapper.';
            }

            // Calculations for output
            let displaySlaps = '';
            if (slapsRequired < 1.0) {
                displaySlaps = slapsRequired.toFixed(5);
            } else {
                displaySlaps = Math.round(slapsRequired).toLocaleString();
            }

            const totalEnergy = slapsRequired * kineticEnergyPerSlap;
            const tempRise = deltaT / slapsRequired;
            const tntGrams = totalEnergy / 4184; // 1g TNT releases 4184 Joules

            outSlaps.textContent = displaySlaps;
            outSpeedClass.textContent = speedClass;
            outSpeedClass.style.backgroundColor = speedColor;
            outEnergy.textContent = `${Math.round(totalEnergy).toLocaleString()} Joules`;
            outTnt.textContent = `${tntGrams.toFixed(2)} g TNT`;
            outTempRise.textContent = `${tempRise.toFixed(9)}°C`;

            // Insights list builder
            const logs = [];
            logs.push(`Thermal capacity: <strong>${Math.round(requiredEnergy).toLocaleString()} J</strong> required to raise protein temperature by ${deltaT}°C.`);
            logs.push(`Hand Kinetic potential: <strong>${Math.round(kineticEnergyPerSlap).toLocaleString()} J</strong> generated per impact.`);
            
            if (slapsRequired < 1.0) {
                logs.push(`<strong class="text-danger"><i class="fas fa-meteor"></i> Instant Cooking Slap:</strong> A single slap at <strong>${slapVel.toLocaleString()} m/s</strong> is so powerful it cooks the chicken in <strong>${slapsRequired.toFixed(4)} slaps</strong>. (Hand velocity is equivalent to Mach ${(slapVel / 343).toFixed(1)}).`);
            } else {
                logs.push(`Repetitive thermal build: Standard hand velocity cooks the chicken after repeated impacts over a stable duration.`);
            }

            if (hazardRating) {
                logs.push(`<strong class="text-warning"><i class="fas fa-radiation"></i> Velocity Warning:</strong> ${hazardRating}`);
            }

            outInsights.innerHTML = logs.map(l => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-bolt text-warning me-2 mt-1" style="font-size:0.85rem;"></i><span>${l}</span></li>`).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-fire me-2"></i> Compute Required Slaps';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        massInput.value = '1.5';
        initTempInput.value = '20';
        velInput.value = '11';
        handMassInput.value = '0.4';
        effInput.value = '10';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Thermodynamic Slap Cooker Report\n━━━━━━━━━━━━━━━━━━━━━━\nChicken Mass: ${massInput.value} kg\nInitial Temp: ${initTempInput.value}°C\nHand Strike Speed: ${velInput.value} m/s\n━━━━━━━━━━━━━━━━━━━━━━\nVelocity Class: ${outSpeedClass.textContent}\nTotal Impact Slaps: ${outSlaps.textContent}\nCombined Energy Output: ${outEnergy.textContent}\nExplosive equivalent: ${outTnt.textContent}\nTemp rise per impact: ${outTempRise.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btnCopy.innerHTML;
            btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btnCopy.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                btnCopy.innerHTML = originalText;
                btnCopy.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
