<div class="interactive-wrapper">
    {{-- Input Card (Beverage Cooling Settings) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Thermal States --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Thermal profile</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Starting Temp</label>
                                <select id="ch-start" class="form-select form-select-lg rounded-3">
                                    <option value="32">Trunk / Warm Day (32°C / 90°F)</option>
                                    <option value="22" selected>Room Temp (22°C / 72°F)</option>
                                    <option value="15">Cellar Temp (15°C / 59°F)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Target Temp</label>
                                <select id="ch-target" class="form-select form-select-lg rounded-3">
                                    <option value="12">Cellar / Real Ale (12°C / 54°F)</option>
                                    <option value="4" selected>Perfectly Chilled (4°C / 39°F)</option>
                                    <option value="1">Ice-Cold Frosty (1°C / 34°F)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Vessel / Container Type</label>
                                <select id="ch-vessel" class="form-select form-select-lg rounded-3">
                                    <option value="can">Standard Aluminum Can (Fast Cooling)</option>
                                    <option value="bottle" selected>Standard Glass Bottle (Thicker Glass)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Environment method --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Chilling environment</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Cooling Method</label>
                                <select id="ch-method" class="form-select form-select-lg rounded-3">
                                    <option value="fridge">Standard Refrigerator (4°C)</option>
                                    <option value="freezer" selected>Standard Freezer (-18°C)</option>
                                    <option value="towel">Wet Paper Towel + Freezer (-18°C Convection)</option>
                                    <option value="ice">Ice Water Bucket (0°C)</option>
                                    <option value="saltice">Salted Ice Water Bucket (-5°C)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-beer me-2"></i> Compute Chilling Time
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Chill Results) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Chilling Thermodynamics</h5>
                        <p class="text-muted small mb-0">Total cooling timeline and emergency safety warnings</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Chilling Specs
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                {{-- Main Metric --}}
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0 font-monospace" id="out-minutes">0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Estimated Minutes</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-status-badge" style="background-color: #10b981; color: #fff;">READY</span>
                    </div>
                </div>

                {{-- Chilling and safety --}}
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Freezer Safe Time</div>
                                <div class="h5 fw-bold mb-0 text-danger" id="out-safe-time">N/A</div>
                                <div class="x-small text-muted fw-bold">Before freezing / explosion</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Vessel Type</div>
                                <div class="h5 fw-bold mb-0 text-secondary" id="out-container">Glass Bottle</div>
                                <div class="x-small text-muted fw-bold">Conductivity rating</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center">Thermodynamic Timeline</h6>
                        <ul class="list-unstyled mb-0 small text-secondary" id="out-timeline">
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
    const startSelect = document.getElementById('ch-start');
    const targetSelect = document.getElementById('ch-target');
    const vesselSelect = document.getElementById('ch-vessel');
    const methodSelect = document.getElementById('ch-method');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    const outMinutes = document.getElementById('out-minutes');
    const outStatusBadge = document.getElementById('out-status-badge');
    const outSafeTime = document.getElementById('out-safe-time');
    const outContainer = document.getElementById('out-container');
    const outTimeline = document.getElementById('out-timeline');

    // Chilling constants mapping
    const methodData = {
        fridge: { env: 4, k: 0.012, name: 'Refrigerator' },
        freezer: { env: -18, k: 0.024, name: 'Freezer' },
        towel: { env: -18, k: 0.045, name: 'Wet Paper Towel + Freezer' },
        ice: { env: 0, k: 0.06, name: 'Ice Water Bucket' },
        saltice: { env: -5, k: 0.08, name: 'Salted Ice Water Bucket' }
    };

    function calculate() {
        const startTemp = parseFloat(startSelect.value);
        let targetTemp = parseFloat(targetSelect.value);
        const vessel = vesselSelect.value;
        const method = methodSelect.value;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Heat Transfer...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const currentMethod = methodData[method];
            const envTemp = currentMethod.env;
            let baseK = currentMethod.k;

            // Adjust vessel conductivity multiplier
            // Aluminum cans cool faster (~0.6 multiplier on cooling time resistance)
            // Glass bottles cool slower (~1.2 multiplier)
            const vesselMultiplier = vessel === 'can' ? 0.65 : 1.25;
            
            // Adjust thermodynamic coefficient
            baseK = baseK / vesselMultiplier;

            // Avoid thermodynamic impossibility (target cooler than environment)
            if (targetTemp <= envTemp) {
                targetTemp = envTemp + 0.5;
            }

            // Newton's Law of Cooling rearranged: t = -ln((T_t - T_env) / (T_s - T_env)) / k
            const ratio = (targetTemp - envTemp) / (startTemp - envTemp);
            let timeMins = -Math.log(ratio) / baseK;

            timeMins = Math.max(1, Math.round(timeMins));

            // Set freezer safe-time to prevent beer freezing/exploding
            let safeMins = 'N/A (Safe)';
            let isFreezer = method === 'freezer' || method === 'towel';

            if (isFreezer) {
                // Freezing time estimation
                const freezingRatio = (0 - envTemp) / (startTemp - envTemp);
                let freezeTime = -Math.log(freezingRatio) / baseK;
                freezeTime = Math.max(15, Math.round(freezeTime));
                
                // Buffer to safety threshold
                const safetyThreshold = Math.round(freezeTime * 0.9);
                safeMins = `${safetyThreshold} mins`;
            }

            outMinutes.textContent = `${timeMins} min`;
            outContainer.textContent = vessel === 'can' ? 'Aluminum Can' : 'Glass Bottle';
            outSafeTime.textContent = safeMins;

            // Set status badges
            if (timeMins <= 10) {
                outStatusBadge.textContent = 'BLAZING FAST';
                outStatusBadge.style.backgroundColor = '#10b981';
            } else if (timeMins <= 30) {
                outStatusBadge.textContent = 'MODERATE CHILL';
                outStatusBadge.style.backgroundColor = '#4f46e5';
            } else {
                outStatusBadge.textContent = 'SLOW CHILL';
                outStatusBadge.style.backgroundColor = '#f59e0b';
            }

            // Timeline dynamic builder
            const logs = [];
            logs.push(`Initial Beverage State: <strong>${startTemp}°C / ${Math.round(startTemp * 1.8 + 32)}°F</strong>.`);
            logs.push(`Cooling Environment: <strong>${currentMethod.name} (${envTemp}°C)</strong>.`);
            
            if (isFreezer) {
                const safetyVal = parseInt(safeMins);
                if (timeMins >= safetyVal) {
                    logs.push(`<strong class="text-danger"><i class="fas fa-exclamation-triangle"></i> Freeze Danger:</strong> Your target temp requires ${timeMins} min, but the beer will freeze & explode after <strong>${safetyVal} min</strong>. Remove early!`);
                } else {
                    logs.push(`<strong class="text-success"><i class="fas fa-shield-alt"></i> Safe Cooling Window:</strong> Chills to target before freezing point.`);
                }
            } else {
                logs.push(`Safe cooling method. No freezing or bottle explosion risk.`);
            }

            logs.push(`Perfect drinkability window: Drink immediately upon removal for optimal carbonation retention.`);

            outTimeline.innerHTML = logs.map(l => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-info-circle text-primary me-2 mt-1" style="font-size:0.85rem;"></i><span>${l}</span></li>`).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-beer me-2"></i> Compute Chilling Time';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        startSelect.value = '22';
        targetSelect.value = '4';
        vesselSelect.value = 'bottle';
        methodSelect.value = 'freezer';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Thermodynamic Beverage Chill Report\n━━━━━━━━━━━━━━━━━━━━━━\nCooling Method: ${methodSelect.options[methodSelect.selectedIndex].text}\nContainer: ${vesselSelect.options[vesselSelect.selectedIndex].text}\nChilling Time: ${outMinutes.textContent}\nFreezer Safe Window: ${outSafeTime.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
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
