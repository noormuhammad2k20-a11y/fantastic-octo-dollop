<div class="interactive-wrapper">
    {{-- Input Card (Apocalypse Profile) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Shelter and Supplies --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Base & Stockpile</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Shelter Location</label>
                                <select id="zb-location" class="form-select form-select-lg rounded-3">
                                    <option value="urban">Downtown High-Rise (Urban • Very High Risk)</option>
                                    <option value="suburban" selected>Suburban House (Suburban • High Risk)</option>
                                    <option value="rural">Isolated Farmhouse (Rural • Moderate Risk)</option>
                                    <option value="mountain">Mountain Fortress (Wilderness • Low Risk)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Supplies Stockpile (Days of Food/Water)</label>
                                <input type="number" id="zb-supplies" class="form-control form-control-lg rounded-3" value="30" min="1" max="1000">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gear and Group --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Tactical Inventory & Biology</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Defensive Weapons Level</label>
                                <select id="zb-weapon" class="form-select form-select-lg rounded-3">
                                    <option value="none">None / Bare Hands</option>
                                    <option value="blunt" selected>Blunt Tools (Bat / Axe / Crowbar)</option>
                                    <option value="melee">Sharp Weapons (Machete / Sword / Spear)</option>
                                    <option value="firearm">Ranged Weapons (Pistol / Rifle / Crossbow)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Group Dynamic</label>
                                <select id="zb-group" class="form-select form-select-lg rounded-3">
                                    <option value="solo">Solo (Stealthy)</option>
                                    <option value="small" selected>Small Squad (2-5 Cohesive)</option>
                                    <option value="medium">Medium Band (6-15 Mixed)</option>
                                    <option value="clan">Large Clan (15+ Strife)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Fitness Tier</label>
                                <select id="zb-fitness" class="form-select form-select-lg rounded-3">
                                    <option value="poor">Sedentary (Cardio? No.)</option>
                                    <option value="average" selected>Average Condition</option>
                                    <option value="athlete">Athletic / Fast Runner</option>
                                    <option value="commando">Elite Commando / Prepper</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-skull me-2"></i> Compute Survival Duration
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Simulation Results) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Survival Diagnostics</h5>
                        <p class="text-muted small mb-0">Projected lifespan and actuarial cause-of-death breakdowns</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Survival Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                {{-- Survival Time --}}
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0 font-monospace" id="out-duration">0 Days</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Estimated Lifespan</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-badge" style="background-color: #ef4444; color: #fff;">ZOMBIE BAIT</span>
                    </div>
                </div>

                {{-- Cause of Death distribution --}}
                <div class="col-lg-7">
                    <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 text-center">Primary Death Factor Distributions</h6>
                    
                    {{-- Progress Bars --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small text-secondary mb-1">
                            <span>Overrun by Zombie Horde</span>
                            <span class="fw-bold" id="lbl-death-horde">0%</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 5px;">
                            <div id="bar-death-horde" class="progress-bar bg-danger" style="width: 0%;"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small text-secondary mb-1">
                            <span>Dehydration / Starvation</span>
                            <span class="fw-bold" id="lbl-death-hunger">0%</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 5px;">
                            <div id="bar-death-hunger" class="progress-bar bg-warning" style="width: 0%;"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small text-secondary mb-1">
                            <span>Internal Strife / Group Betrayal</span>
                            <span class="fw-bold" id="lbl-death-strife">0%</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 5px;">
                            <div id="bar-death-strife" class="progress-bar bg-secondary" style="width: 0%;"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small text-secondary mb-1">
                            <span>Accidental / Sickness / Tripped</span>
                            <span class="fw-bold" id="lbl-death-accident">0%</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 5px;">
                            <div id="bar-death-accident" class="progress-bar bg-info" style="width: 0%;"></div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-light border text-center">
                        <span class="x-small text-muted fw-bold text-uppercase d-block mb-1">Survival Strategy Insight</span>
                        <div class="small text-dark" id="out-strategy-insight">Injected dynamically</div>
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

    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #e2e8f0; }

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
    const locSelect = document.getElementById('zb-location');
    const supInput = document.getElementById('zb-supplies');
    const wpnSelect = document.getElementById('zb-weapon');
    const grpSelect = document.getElementById('zb-group');
    const fitSelect = document.getElementById('zb-fitness');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    
    const outDuration = document.getElementById('out-duration');
    const outBadge = document.getElementById('out-badge');
    const outStrategy = document.getElementById('out-strategy-insight');

    // Death labels and bars
    const lblHorde = document.getElementById('lbl-death-horde');
    const barHorde = document.getElementById('bar-death-horde');
    const lblHunger = document.getElementById('lbl-death-hunger');
    const barHunger = document.getElementById('bar-death-hunger');
    const lblStrife = document.getElementById('lbl-death-strife');
    const barStrife = document.getElementById('bar-death-strife');
    const lblAccident = document.getElementById('lbl-death-accident');
    const barAccident = document.getElementById('bar-death-accident');

    function calculate() {
        const location = locSelect.value;
        const supplies = parseInt(supInput.value) || 0;
        const weapon = wpnSelect.value;
        const group = grpSelect.value;
        const fitness = fitSelect.value;

        if (supplies <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Outbreak...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Location baseline
            let baseDays = 15;
            let forageCoeff = 0.05;
            if (location === 'suburban') { baseDays = 40; forageCoeff = 0.1; }
            else if (location === 'rural') { baseDays = 100; forageCoeff = 0.25; }
            else if (location === 'mountain') { baseDays = 200; forageCoeff = 0.6; }

            // Weapon Modifiers
            let wpnMod = 0.4;
            if (weapon === 'blunt') wpnMod = 1.0;
            else if (weapon === 'melee') wpnMod = 1.45;
            else if (weapon === 'firearm') wpnMod = 2.1;

            // Group Dynamics Modifiers
            let grpMod = 1.0; // Solo
            if (group === 'small') grpMod = 1.5; // Optimal
            else if (group === 'medium') grpMod = 0.95;
            else if (group === 'clan') grpMod = 0.7; // high stress, high consumption

            // Fitness Modifiers
            let fitMod = 0.5; // Poor
            if (fitness === 'average') fitMod = 1.0;
            else if (fitness === 'athlete') fitMod = 1.45;
            else if (fitness === 'commando') fitMod = 2.25;

            // Core Lifespan equation
            // Supplies provide absolute core security, while tactical modifiers scale the defensive survival baseline
            let totalSurvival = (baseDays * wpnMod * grpMod * fitMod) + (supplies * (1 + forageCoeff));
            totalSurvival = Math.max(1, Math.round(totalSurvival));

            // Format Days, Months, Years
            let displayTime = '';
            if (totalSurvival >= 365) {
                const yrs = Math.floor(totalSurvival / 365);
                const remaining = Math.round(totalSurvival % 365);
                displayTime = `${yrs} Yr${yrs > 1 ? 's' : ''} ${Math.round(remaining/30)} Mo`;
            } else if (totalSurvival >= 30) {
                const mos = Math.floor(totalSurvival / 30);
                const remaining = Math.round(totalSurvival % 30);
                displayTime = `${mos} Mo${mos > 1 ? 's' : ''} ${remaining} D`;
            } else {
                displayTime = `${totalSurvival} Day${totalSurvival > 1 ? 's' : ''}`;
            }

            // Safety Class badge mappings
            let badge = 'ZOMBIE BAIT';
            let badgeColor = '#ef4444';
            let strategyMsg = '';

            if (totalSurvival >= 365) {
                badge = 'APOCALYPSE LEGEND';
                badgeColor = '#10b981';
                strategyMsg = 'You are a master of survival. Your high-security retreat, physical prowess, and strategic supply management allow you to outlast the collapse.';
            } else if (totalSurvival >= 120) {
                badge = 'FORTRESS SURVIVOR';
                badgeColor = '#3b82f6';
                strategyMsg = 'Excellent strategic balance. Your defensive capabilities allow you to easily survive multiple winters.';
            } else if (totalSurvival >= 30) {
                badge = 'HURRIED SCAVENGER';
                badgeColor = '#f59e0b';
                strategyMsg = 'Decent survival odds, but eventually you will run out of water. Scavenging inside active sectors will be necessary.';
            } else {
                strategyMsg = 'Extremely low survival probability. You will be overrun during the initial infection surge.';
            }

            // Death Cause Actuarial logic
            let pctHorde = 45;
            let pctHunger = 25;
            let pctStrife = 15;
            let pctAccident = 15;

            // Adjust based on inputs
            if (weapon === 'none') {
                pctHorde += 30;
                pctHunger -= 10;
                pctStrife -= 10;
                pctAccident -= 10;
            }
            if (supplies < 15) {
                pctHunger += 35;
                pctHorde -= 15;
                pctStrife -= 10;
                pctAccident -= 10;
            }
            if (group === 'clan' || group === 'medium') {
                pctStrife += 25;
                pctHorde -= 15;
                pctHunger -= 5;
                pctAccident -= 5;
            }
            if (fitness === 'poor') {
                pctAccident += 25; // tripped
                pctHorde += 10; // caught
                pctHunger -= 15;
                pctStrife -= 20;
            }

            // Normalization
            const totalPct = pctHorde + pctHunger + pctStrife + pctAccident;
            const factor = 100 / totalPct;

            const finalHorde = Math.round(pctHorde * factor);
            const finalHunger = Math.round(pctHunger * factor);
            const finalStrife = Math.round(pctStrife * factor);
            const finalAccident = Math.round(pctAccident * factor);

            // Update UI Outputs
            outDuration.textContent = displayTime;
            outBadge.textContent = badge;
            outBadge.style.backgroundColor = badgeColor;
            outStrategy.textContent = strategyMsg;

            // Render Death Bars
            lblHorde.textContent = `${finalHorde}%`;
            barHorde.style.width = `${finalHorde}%`;

            lblHunger.textContent = `${finalHunger}%`;
            barHunger.style.width = `${finalHunger}%`;

            lblStrife.textContent = `${finalStrife}%`;
            barStrife.style.width = `${finalStrife}%`;

            lblAccident.textContent = `${finalAccident}%`;
            barAccident.style.width = `${finalAccident}%`;

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-skull me-2"></i> Compute Survival Duration';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        locSelect.value = 'suburban';
        supInput.value = '30';
        wpnSelect.value = 'blunt';
        grpSelect.value = 'small';
        fitSelect.value = 'average';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Outbreak Survival Simulation Report\n━━━━━━━━━━━━━━━━━━━━━━\nLocation: ${locSelect.options[locSelect.selectedIndex].text}\nDefense Tier: ${wpnSelect.options[wpnSelect.selectedIndex].text}\nPhysical Fitness: ${fitSelect.options[fitSelect.selectedIndex].text}\nProjected Lifespan: ${outDuration.textContent}\nSurvival Class Rating: ${outBadge.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
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
