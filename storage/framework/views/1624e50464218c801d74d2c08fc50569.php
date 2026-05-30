<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Personal Profile</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Gender</label>
                                <select id="cal-gender" class="form-select form-select-lg rounded-3">
                                    <option value="male">♂ Male</option>
                                    <option value="female">♀ Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Age</label>
                                <input type="number" id="cal-age" class="form-control form-control-lg rounded-3" value="30">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Weight (kg)</label>
                                <input type="number" id="cal-weight" class="form-control form-control-lg rounded-3" value="75">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Height (cm)</label>
                                <input type="number" id="cal-height" class="form-control form-control-lg rounded-3" value="175">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Activity & Goals</h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Activity Level</label>
                            <select id="cal-activity" class="form-select form-select-lg rounded-3">
                                <option value="1.2">Sedentary (Little/No Exercise)</option>
                                <option value="1.375">Lightly Active (1-3 days/week)</option>
                                <option value="1.55" selected>Moderately Active (3-5 days/week)</option>
                                <option value="1.725">Very Active (6-7 days/week)</option>
                                <option value="1.9">Extra Active (Athlete/Physical Labor)</option>
                            </select>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Health Goal</label>
                                <select id="cal-goal" class="form-select form-select-lg rounded-3">
                                    <option value="lose">🔻 Weight Loss</option>
                                    <option value="maintain" selected>⚖️ Maintenance</option>
                                    <option value="gain">🔺 Weight Gain</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Body Fat % (Optional)</label>
                                <input type="number" id="cal-bf" class="form-control form-control-lg rounded-3" placeholder="20%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Calculate Daily Needs
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-bolt text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Energy Expenditure Report</h5>
                        <p class="text-muted small mb-0">Total Daily Energy Expenditure (TDEE) and macro-nutrients</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0" id="out-tdee">2,585</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Maintenance (TDEE) kcal/day</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill bg-primary-soft text-primary px-4 py-2 fw-bold" id="out-goal-label">GOAL: 2,085 KCAL</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Protein</div>
                                <div class="h4 fw-bold mb-0 text-danger" id="out-protein">156g</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Carbs</div>
                                <div class="h4 fw-bold mb-0 text-warning" id="out-carbs">261g</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Fats</div>
                                <div class="h4 fw-bold mb-0 text-success" id="out-fat">69g</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 p-3 rounded-4 bg-white border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-2">Basal Metabolic Rate (BMR)</div>
                        <div class="h5 fw-bold mb-0 text-dark"><span id="out-bmr">1,668</span> kcal/day</div>
                        <div class="x-small text-muted fw-bold">Calories burned at absolute rest</div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">4-Week Weight Projection</h6>
            <div class="table-responsive mb-4">
                <table class="table table-hover align-middle border-0 mb-0" id="out-projection">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 rounded-start-4">Week</th>
                            <th class="border-0">Daily Intake</th>
                            <th class="border-0">Total Change</th>
                            <th class="border-0 rounded-end-4">Projected Weight</th>
                        </tr>
                    </thead>
                    <tbody class="small"></tbody>
                </table>
            </div>

            <div class="p-4 rounded-4 bg-light border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-lightbulb text-warning me-2"></i>Metabolic Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --warning-soft: #fffbeb;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-warning-soft { background-color: var(--warning-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .table th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; padding: 1rem; }
    .table td { padding: 1rem; border-color: #f1f5f9; }

    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const genderE = document.getElementById('cal-gender');
    const ageE = document.getElementById('cal-age');
    const weightE = document.getElementById('cal-weight');
    const heightE = document.getElementById('cal-height');
    const activityE = document.getElementById('cal-activity');
    const goalE = document.getElementById('cal-goal');
    const bfE = document.getElementById('cal-bf');
    
    const resultCard = document.getElementById('result-card');
    const outTdee = document.getElementById('out-tdee');
    const outBmr = document.getElementById('out-bmr');
    const outGoalLabel = document.getElementById('out-goal-label');
    const outProtein = document.getElementById('out-protein');
    const outCarbs = document.getElementById('out-carbs');
    const outFat = document.getElementById('out-fat');
    const outInsights = document.getElementById('out-insights');
    const outProjection = document.getElementById('out-projection').querySelector('tbody');
    const btnCalculate = document.getElementById('btn-calculate');

    function calculate() {
        const gender = genderE.value;
        const age = parseFloat(ageE.value) || 0;
        const weight = parseFloat(weightE.value) || 0;
        const height = parseFloat(heightE.value) || 0;
        const act = parseFloat(activityE.value) || 1.2;
        const goal = goalE.value;
        const bf = parseFloat(bfE.value) || 0;

        if (age <= 0 || weight <= 0 || height <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Metabolic Calculation
            let bmr;
            if (bf > 0) {
                // Katch-McArdle
                const lbm = weight * (1 - bf/100);
                bmr = 370 + (21.6 * lbm);
            } else {
                // Mifflin-St Jeor
                bmr = (10 * weight) + (6.25 * height) - (5 * age);
                bmr = (gender === 'male') ? bmr + 5 : bmr - 161;
            }

            const tdee = bmr * act;
            let goalCal = tdee;
            if (goal === 'lose') goalCal = tdee - 500;
            else if (goal === 'gain') goalCal = tdee + 500;

            outTdee.textContent = Math.round(tdee).toLocaleString();
            outBmr.textContent = Math.round(bmr).toLocaleString();
            outGoalLabel.textContent = `GOAL: ${Math.round(goalCal).toLocaleString()} KCAL`;

            // Macros (30% Protein, 40% Carbs, 30% Fat)
            outProtein.textContent = Math.round((goalCal * 0.30) / 4) + 'g';
            outCarbs.textContent = Math.round((goalCal * 0.40) / 4) + 'g';
            outFat.textContent = Math.round((goalCal * 0.30) / 9) + 'g';

            // Projection
            const weeklyDelta = (goalCal - tdee) * 7;
            const kgPerWeek = weeklyDelta / 7700;
            let tbody = '';
            for (let w = 1; w <= 4; w++) {
                const pw = weight + (kgPerWeek * w);
                const cls = kgPerWeek < 0 ? 'text-success' : (kgPerWeek > 0 ? 'text-primary' : '');
                tbody += `<tr>
                    <td class="fw-bold">Week ${w}</td>
                    <td>${Math.round(goalCal).toLocaleString()} kcal</td>
                    <td class="${cls} fw-bold">${kgPerWeek >= 0 ? '+' : ''}${(kgPerWeek * w).toFixed(2)} kg</td>
                    <td class="fw-bold text-dark">${pw.toFixed(1)} kg</td>
                </tr>`;
            }
            outProjection.innerHTML = tbody;

            // Insights
            const ins = [];
            ins.push(`Basal Metabolic Rate (BMR) is <strong>${Math.round(bmr).toLocaleString()} kcal</strong> — what your body burns at absolute rest.`);
            ins.push(`Activity level adds <strong>${Math.round(tdee - bmr).toLocaleString()} kcal</strong> to your daily burn.`);
            if (goal === 'lose') ins.push('Targeting a 500 kcal deficit creates a safe sustainable weight loss of ~0.5kg/week.');
            if (bf > 0) ins.push('Calculation used Katch-McArdle formula based on provided Body Fat %.');

            outInsights.innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Calculate Daily Needs';
            btnCalculate.disabled = false;
        }, 600);
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-reset').addEventListener('click', () => {
        ageE.value = 30; weightE.value = 75; heightE.value = 175;
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `TDEE & Nutritional Report\nDaily Calories: ${outTdee.textContent}\nGoal: ${outGoalLabel.textContent}\nMacros: P ${outProtein.textContent}, C ${outCarbs.textContent}, F ${outFat.textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied Report!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/calorie-calculator.blade.php ENDPATH**/ ?>