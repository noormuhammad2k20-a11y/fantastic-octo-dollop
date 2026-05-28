<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Temperature Inputs --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Temperature Settings</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Initial Temp (°F)</label>
                                <input type="number" id="temp-initial" class="form-control form-control-lg rounded-3" value="72" min="33" max="110">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Target Temp (°F)</label>
                                <input type="number" id="temp-target" class="form-control form-control-lg rounded-3" value="38" min="20" max="60">
                            </div>
                        </div>
                        <div class="mt-3 small text-muted">
                            <i class="fas fa-info-circle me-1"></i> Standard beer drinking temp is 38°F to 44°F.
                        </div>
                    </div>
                </div>

                {{-- Environment & Container --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Cooling & Container</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Cooling Method</label>
                                <select id="cooling-env" class="form-select form-select-lg rounded-3">
                                    <option value="fridge">Refrigerator (35°F)</option>
                                    <option value="freezer" selected>Freezer (0°F)</option>
                                    <option value="ice_bath">Ice Water Bath (32°F)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-muted">Container Type</label>
                                <select id="container-type" class="form-select form-select-lg rounded-3">
                                    <option value="can" selected>Aluminum Can (12oz)</option>
                                    <option value="glass">Glass Bottle (12oz)</option>
                                    <option value="large_glass">Large Glass Bottle / Bomber (22oz)</option>
                                    <option value="plastic">Plastic Bottle (20oz)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-init="72" data-target="38" data-env="fridge" data-container="can">
                    Fridge Chill (Can, 72° to 38°)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-init="75" data-target="38" data-env="freezer" data-container="glass">
                    Freezer Quick (Glass, 75° to 38°)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-init="80" data-target="38" data-env="ice_bath" data-container="can">
                    Ice Bucket Rush (Can, 80° to 38°)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #0284c7; border-color: #0284c7;">
                    <i class="fas fa-wind me-2"></i> Calculate Chill Time
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #e0f2fe; color: #0284c7;">
                        <i class="fas fa-stopwatch"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Cooling Forecast</h5>
                        <p class="text-muted small mb-0">Thermodynamic temperature prediction results</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #0284c7; border-color: #0284c7;">
                        <i class="fas fa-copy me-1"></i> Copy Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #0284c7;" id="result-chill-time">24 minutes</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1">Estimated Chill Time</p>
            </div>

            {{-- Warning Banner --}}
            <div id="freeze-warning" class="alert alert-warning rounded-4 border-0 mb-4 p-3 d-none">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x me-3 text-warning"></i>
                    <div>
                        <strong class="text-dark">High Freezing Risk!</strong>
                        <div class="small text-muted" id="warning-text">Be sure to set an alarm. Leaving the bottle in the freezer for over 45 minutes may cause it to freeze and burst!</div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                {{-- Stats Grid --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-chart-line me-2 text-primary"></i>Cooling Milestones</h6>
                        <ul class="list-group list-group-flush bg-transparent" id="milestones-list">
                            {{-- Dynamically Populated --}}
                        </ul>
                    </div>
                </div>

                {{-- Expert Tips --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-bolt me-2 text-warning"></i>Pro Tips to Chill Faster</h6>
                        <ul class="list-unstyled mb-0" style="line-height: 1.6;">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <span><strong>The Wet Paper Towel Hack:</strong> Wrap a glass bottle in a wet paper towel before placing it in the freezer to cut chill time by 30-40%.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <span><strong>Add Salt to Ice Water:</strong> Adding rock salt to your ice water bath drops the liquid temperature below 32°F, chilling cans in just 5-8 minutes.</span>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <span><strong>Maximize Surface Area:</strong> Lay cans flat rather than upright in the ice bath or freezer to speed up convection currents inside the liquid.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }
    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }
    .form-control-lg, .form-select-lg { border: 1.5px solid #cbd5e1; border-radius: 12px; font-size: 1rem; }
    .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tempInitIn = document.getElementById('temp-initial');
    const tempTargetIn = document.getElementById('temp-target');
    const envIn = document.getElementById('cooling-env');
    const containerIn = document.getElementById('container-type');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');
    const freezeWarning = document.getElementById('freeze-warning');
    const warningText = document.getElementById('warning-text');

    function calculateChill() {
        const tInitial = parseFloat(tempInitIn.value) || 72;
        const tGoal = parseFloat(tempTargetIn.value) || 38;
        const env = envIn.value;
        const container = containerIn.value;

        // Environment temp definitions
        let tEnv = 35;
        if (env === 'freezer') tEnv = 0;
        if (env === 'ice_bath') tEnv = 32;

        if (tInitial <= tGoal) {
            alert("Initial temperature must be greater than target temperature!");
            return;
        }

        if (tGoal <= tEnv) {
            alert(`Target temperature must be greater than the environment temperature (${tEnv}°F)!`);
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Modeling Thermodynamics...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Newton's law cooling constants (k values per minute)
            // Modified base values for cans, glass, plastic
            let k = 0.015;

            if (container === 'can') {
                if (env === 'fridge') k = 0.012;
                if (env === 'freezer') k = 0.032;
                if (env === 'ice_bath') k = 0.160;
            } else if (container === 'glass') {
                if (env === 'fridge') k = 0.007;
                if (env === 'freezer') k = 0.017;
                if (env === 'ice_bath') k = 0.065;
            } else if (container === 'large_glass') {
                if (env === 'fridge') k = 0.004;
                if (env === 'freezer') k = 0.010;
                if (env === 'ice_bath') k = 0.040;
            } else if (container === 'plastic') {
                if (env === 'fridge') k = 0.005;
                if (env === 'freezer') k = 0.012;
                if (env === 'ice_bath') k = 0.032;
            }

            // Calculate exact time: t = -ln((T_goal - T_env)/(T_initial - T_env)) / k
            const ratio = (tGoal - tEnv) / (tInitial - tEnv);
            const minutes = Math.round(-Math.log(ratio) / k);

            document.getElementById('result-chill-time').innerText = minutes + " minutes";

            // Generate milestones table
            let milestoneHtml = '';
            const steps = [0.25, 0.5, 0.75, 1];
            steps.forEach(fraction => {
                const stepMin = Math.round(minutes * fraction);
                const stepTemp = Math.round(tEnv + (tInitial - tEnv) * Math.exp(-k * stepMin));
                milestoneHtml += `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between align-items-center">
                    <span class="text-muted">At ${stepMin} mins</span>
                    <span class="fw-bold text-dark font-monospace">${stepTemp}°F</span>
                </li>`;
            });
            document.getElementById('milestones-list').innerHTML = milestoneHtml;

            // Handle freezing risk / warning
            if (env === 'freezer') {
                // If it stays in freezer too long it freezes
                // Pure water freezes at 32°F, beer/soda around 28-30°F
                const timeToFreeze = Math.round(-Math.log((29 - tEnv) / (tInitial - tEnv)) / k);
                freezeWarning.classList.remove('d-none');
                warningText.innerHTML = `<strong>High risk of freezing after ${timeToFreeze} minutes!</strong> Set a timer to remove the beverage before it reaches 29°F, which can cause the container to warp or burst.`;
            } else {
                freezeWarning.classList.add('d-none');
            }

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-wind me-2"></i> Calculate Chill Time';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateChill);

    btnReset.addEventListener('click', () => {
        tempInitIn.value = 72;
        tempTargetIn.value = 38;
        envIn.value = 'freezer';
        containerIn.value = 'can';
        resultCard.classList.add('d-none');
        freezeWarning.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            tempInitIn.value = this.dataset.init;
            tempTargetIn.value = this.dataset.target;
            envIn.value = this.dataset.env;
            containerIn.value = this.dataset.container;
            calculateChill();
        });
    });

    btnCopy.addEventListener('click', function() {
        const time = document.getElementById('result-chill-time').innerText;
        const text = `BEER CHILL TIME ANALYSIS\n` +
                     `=======================\n` +
                     `Initial Temp: ${tempInitIn.value}°F\n` +
                     `Target Temp: ${tempTargetIn.value}°F\n` +
                     `Method: ${envIn.options[envIn.selectedIndex].text}\n` +
                     `Container: ${containerIn.options[containerIn.selectedIndex].text}\n\n` +
                     `ESTIMATED CHILL TIME: ${time}\n` +
                     `Generated via ToolsHub Beer Chill Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
