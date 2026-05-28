<div class="interactive-wrapper">
    {{-- Input Card (Simulation Settings) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Starting Populations --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Starting Biome</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Initial Humans</label>
                                <input type="number" id="vp-humans" class="form-control form-control-lg rounded-3" value="100000" min="10">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Initial Vampires</label>
                                <input type="number" id="vp-vampires" class="form-control form-control-lg rounded-3" value="10" min="1">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Simulation Steps (Months)</label>
                                <input type="number" id="vp-months" class="form-control form-control-lg rounded-3" value="36" min="1" max="240">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Rates and Coefficients --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Coefficients & Transmission</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Infection / Bite Rate (Humans per Vampire/mo)</label>
                                <div class="input-group">
                                    <input type="number" id="vp-bite-rate" class="form-control form-control-lg rounded-start-3" value="1.2" min="0" step="0.1">
                                    <span class="input-group-text rounded-end-3">Bites</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Vampire Cull Rate (Slayers / Sunlight % / mo)</label>
                                <div class="input-group">
                                    <input type="number" id="vp-cull-rate" class="form-control form-control-lg rounded-start-3" value="15" min="0" max="100" step="1">
                                    <span class="input-group-text rounded-end-3">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-play me-2"></i> Execute Simulation Model
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Simulation Diagnostics) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Epidemic Trajectory Output</h5>
                        <p class="text-muted small mb-0">Simulation outcomes, demographic projections, and comparative ratio charts</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Simulation Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                {{-- Survival State Column --}}
                <div class="col-lg-5 text-center border-end">
                    <div class="display-5 fw-bold text-dark mb-0" id="out-extinction-point">Month 18</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1" id="out-extinction-label">Human Extinction Event</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-status-badge" style="background-color: #ef4444; color: #fff;">EXTINCT</span>
                    </div>
                </div>

                {{-- Demographic status --}}
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Final Humans</div>
                                <div class="h5 fw-bold mb-0 text-primary" id="out-final-humans">0</div>
                                <div class="x-small text-muted fw-bold">Remaining population</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Final Vampires</div>
                                <div class="h5 fw-bold mb-0 text-danger" id="out-final-vampires">0</div>
                                <div class="x-small text-muted fw-bold">Remaining population</div>
                            </div>
                        </div>
                    </div>

                    {{-- Dynamic Population Ratio Graph (Pure CSS Stacked Bars) --}}
                    <div class="mt-4 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 text-center">Demographic Ratio Timeline</h6>
                        <div class="d-flex flex-column gap-2" id="out-css-chart">
                            {{-- Bars will be injected dynamically --}}
                        </div>
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
    const humInput = document.getElementById('vp-humans');
    const vampInput = document.getElementById('vp-vampires');
    const monInput = document.getElementById('vp-months');
    const biteInput = document.getElementById('vp-bite-rate');
    const cullInput = document.getElementById('vp-cull-rate');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    const outExtinction = document.getElementById('out-extinction-point');
    const outExtinctionLabel = document.getElementById('out-extinction-label');
    const outStatusBadge = document.getElementById('out-status-badge');
    
    const outFinalHumans = document.getElementById('out-final-humans');
    const outFinalVampires = document.getElementById('out-final-vampires');
    const outCssChart = document.getElementById('out-css-chart');

    function calculate() {
        let humans = parseFloat(humInput.value) || 0;
        let vampires = parseFloat(vampInput.value) || 0;
        const totalMonths = parseInt(monInput.value) || 12;
        const biteRate = parseFloat(biteInput.value) || 0;
        const cullRate = (parseFloat(cullInput.value) || 0) / 100;

        if (humans <= 0 || vampires <= 0 || totalMonths <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Computing Biome Steps...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            let H = humans;
            let V = vampires;

            // Log states over time for graphing
            const timelineData = [];
            timelineData.push({ month: 0, H: H, V: V });

            let extinctionMonth = null;
            let outcomeState = 'equilibrium'; // 'equilibrium', 'human_extinct', 'vampire_extinct'

            for (let m = 1; m <= totalMonths; m++) {
                if (H <= 0 && V <= 0) {
                    H = 0; V = 0;
                    if (extinctionMonth === null) {
                        extinctionMonth = m;
                        outcomeState = 'both_extinct';
                    }
                    continue;
                }
                
                if (H <= 0) {
                    H = 0;
                    // Vampires slowly starve without human blood
                    const starvedVampires = V * 0.15; // 15% starve monthly without humans
                    V = Math.max(0, V - starvedVampires);
                    if (extinctionMonth === null) {
                        extinctionMonth = m;
                        outcomeState = 'human_extinct';
                    }
                    timelineData.push({ month: m, H: H, V: V });
                    continue;
                }

                if (V <= 0) {
                    V = 0;
                    // Humans grow slightly or stabilize
                    H = H * 1.002; // 0.2% monthly natural birth surplus
                    if (extinctionMonth === null) {
                        extinctionMonth = m;
                        outcomeState = 'vampire_extinct';
                    }
                    timelineData.push({ month: m, H: H, V: V });
                    continue;
                }

                // Epidemic formulas
                // E.g. new bite encounters: Vampires search and bite average biteRate humans
                let newBites = V * biteRate;
                if (newBites > H) {
                    newBites = H;
                }

                // Culled vampires
                const culledVampires = V * cullRate;

                // Adjust populations
                H = Math.max(0, H - newBites);
                V = Math.max(0, V + newBites - culledVampires);

                timelineData.push({ month: m, H: H, V: V });
            }

            H = Math.round(H);
            V = Math.round(V);

            // Update UI Counters
            outFinalHumans.textContent = H.toLocaleString();
            outFinalVampires.textContent = V.toLocaleString();

            // Set final survival state diagnostic
            if (outcomeState === 'human_extinct') {
                outExtinction.textContent = `Month ${extinctionMonth}`;
                outExtinctionLabel.textContent = 'Human Extinction Event';
                outStatusBadge.textContent = 'HUMAN EXTINCTION';
                outStatusBadge.style.backgroundColor = '#ef4444';
            } else if (outcomeState === 'vampire_extinct') {
                outExtinction.textContent = `Month ${extinctionMonth}`;
                outExtinctionLabel.textContent = 'Vampire Extinction Event';
                outStatusBadge.textContent = 'HUMANS SAVED';
                outStatusBadge.style.backgroundColor = '#10b981';
            } else {
                outExtinction.textContent = 'STABLE STATE';
                outExtinctionLabel.textContent = 'Dynamic Biome Coexistence';
                outStatusBadge.textContent = 'EQUILIBRIUM';
                outStatusBadge.style.backgroundColor = '#4f46e5';
            }

            // Build dynamic CSS comparative ratio timeline (Start, Mid, End etc.)
            // We slice 5 intervals from the timeline array
            const intervals = [];
            const step = Math.max(1, Math.floor(timelineData.length / 5));
            for (let i = 0; i < timelineData.length; i += step) {
                intervals.push(timelineData[i]);
            }
            if (intervals[intervals.length - 1].month !== timelineData[timelineData.length - 1].month) {
                intervals.push(timelineData[timelineData.length - 1]);
            }

            outCssChart.innerHTML = intervals.map(item => {
                const total = item.H + item.V;
                const hPct = total > 0 ? (item.H / total) * 100 : 0;
                const vPct = total > 0 ? (item.V / total) * 100 : 0;

                return `
                    <div class="mb-2">
                        <div class="d-flex justify-content-between x-small text-muted fw-bold mb-1">
                            <span>Month ${item.month}</span>
                            <span>Humans: ${Math.round(item.H).toLocaleString()} | Vampires: ${Math.round(item.V).toLocaleString()}</span>
                        </div>
                        <div class="progress" style="height: 16px; border-radius: 8px; overflow: hidden; background-color: #f1f5f9;">
                            <div class="progress-bar bg-primary" style="width: ${hPct}%;" title="Humans: ${hPct.toFixed(1)}%"></div>
                            <div class="progress-bar bg-danger" style="width: ${vPct}%;" title="Vampires: ${vPct.toFixed(1)}%"></div>
                        </div>
                    </div>
                `;
            }).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-play me-2"></i> Execute Simulation Model';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        humInput.value = '100000';
        vampInput.value = '10';
        monInput.value = '36';
        biteInput.value = '1.2';
        cullInput.value = '15';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Vampire Apocalypse Epidemic Report\n━━━━━━━━━━━━━━━━━━━━━━\nStarting Biome: Humans (${humInput.value}) | Vampires (${vampInput.value})\nBite Multiplier: ${biteInput.value}/mo\nCull Rate: ${cullInput.value}%\n━━━━━━━━━━━━━━━━━━━━━━\nSimulation Result: ${outExtinctionLabel.textContent}\nLifespan Milestone: ${outExtinction.textContent}\nFinal Human Population: ${outFinalHumans.textContent}\nFinal Vampire Population: ${outFinalVampires.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
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
