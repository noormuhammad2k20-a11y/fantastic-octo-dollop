<div class="container-fluid cal-burn-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(245, 158, 11, 0.1); color:#f59e0b;">
                        <i class="fas fa-fire"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Metabolic Energy Burndown</h3>
                        <p class="tool-subtitle">Calculate precise calories burned across hundreds of activities using the latest Metabolic Equivalent (MET) data.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Activity Category</label>
                            <select id="act_cat" class="form-select-custom">
                                <option value="running">Running & Jogging</option>
                                <option value="cycling">Cycling & Biking</option>
                                <option value="walking">Walking & Hiking</option>
                                <option value="gym">Gym & Strength</option>
                                <option value="swimming">Swimming & Water</option>
                                <option value="sports">Competitive Sports</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Specific Activity</label>
                            <select id="act_type" class="form-select-custom">
                                <!-- Populated by JS -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Duration</label>
                            <div class="input-group-custom">
                                <input type="number" id="duration" class="form-control-custom" value="30" min="1">
                                <span class="input-addon">Minutes</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Body Weight</label>
                            <div class="input-group-custom">
                                <input type="number" id="user_weight" class="form-control-custom" value="70">
                                <select id="weight_unit" class="select-addon">
                                    <option value="kg">kg</option>
                                    <option value="lbs">lbs</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Intensity Level</label>
                            <select id="intensity_mod" class="form-select-custom">
                                <option value="0.9">Low / Recovery (90%)</option>
                                <option value="1.0" selected>Moderate / Standard (100%)</option>
                                <option value="1.15">High / Vigorous (115%)</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#f59e0b;" onclick="calculateCalories()">
                                    <i class="fas fa-calculator me-2"></i> Calculate Energy Expenditure
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetCalories()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-4 pt-3 border-top">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-warning me-1"></i>Quick Sessions:</span>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn-preset-pill" onclick="setSession('running', 'running_8', 30)">🏃 30min Run (8mph)</button>
                            <button class="btn-preset-pill" onclick="setSession('cycling', 'cycling_standard', 60)">🚲 1hr Cycle</button>
                            <button class="btn-preset-pill" onclick="setSession('gym', 'heavy_lifting', 45)">🏋️ 45min Heavy Lift</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="output-card-themed" id="cal-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center">
                        <div class="hero-cal-badge">
                            <span class="hero-label">Total Burned</span>
                            <h2 class="hero-value" id="final-cal">0</h2>
                            <div class="hero-cal-tag">KCAL</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7">
                        <div class="burn-analysis-card">
                            <h6 class="fw-bold mb-3 small text-uppercase letter-spacing-1"><i class="fas fa-chart-line text-info me-2"></i>Performance Breakdown</h6>
                            <div class="d-flex flex-column gap-3">
                                <div class="burn-stat-row">
                                    <span class="small fw-bold text-muted">Energy Flux</span>
                                    <span class="fw-bold" id="cal-per-min">0.0 kcal/min</span>
                                </div>
                                <div class="burn-stat-row">
                                    <span class="small fw-bold text-muted">MET Intensity</span>
                                    <span class="fw-bold" id="met-value">0.0 METs</span>
                                </div>
                                <div class="burn-stat-row">
                                    <span class="small fw-bold text-muted">Fuel Type</span>
                                    <span class="fw-bold text-primary" id="fuel-type">Mixed (Fat/Carb)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="mini-impact-card">
                                    <i class="fas fa-pizza-slice text-danger mb-2"></i>
                                    <div class="mi-value" id="pizza-equiv">0.0</div>
                                    <div class="mi-label">Pizza Slices</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mini-impact-card">
                                    <i class="fas fa-cookie text-warning mb-2"></i>
                                    <div class="mi-value" id="cookie-equiv">0.0</div>
                                    <div class="mi-label">Cookies Earned</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mini-impact-card">
                                    <i class="fas fa-person-running text-success mb-2"></i>
                                    <div class="mi-value" id="step-equiv">0</div>
                                    <div class="mi-label">Step Equivalent</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2"><i class="fas fa-flask me-2 text-warning"></i> Metabolic Insight</h6>
                            <div id="cal-insights" class="small text-muted">
                                Select an activity and enter your weight to see your metabolic energy profile.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn-action-dark w-100" onclick="copyBurnReport()" id="copy-btn" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i> Copy Burn Report
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn-action-outline w-100" onclick="shareBurn()">
                                    <i class="fas fa-share-nodes me-2"></i> Share Progress
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cal-burn-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium {
    background: #ffffff;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
}

.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; transition: 0.2s; }
.input-group-custom:focus-within { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); background: #fff; }

.form-control-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; }
.form-select-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; transition: 0.2s; }
.form-select-custom:focus { border-color: #f59e0b; }

.select-addon { background: #f1f5f9; border: none; border-left: 1.5px solid #e2e8f0; padding: 0 0.5rem; font-weight: 700; cursor: pointer; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; }
.btn-preset-pill:hover { border-color: #f59e0b; color: #f59e0b; background: #fffbeb; }

/* Output Card */
.output-card-themed {
    background: #ffffff;
    border-radius: 32px;
    padding: 3rem;
    border: 1px solid rgba(0,0,0,0.06);
    box-shadow: 0 25px 70px rgba(0,0,0,0.06);
    margin-top: 2rem;
}

.hero-cal-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 6rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-cal-tag { font-size: 1.5rem; font-weight: 800; color: #f59e0b; letter-spacing: 2px; }

.burn-stat-row { display: flex; justify-content: space-between; align-items: center; p: 3px 0; border-bottom: 1.5px dashed #e2e8f0; padding-bottom: 0.75rem; }

.mini-impact-card { background: #f8fafc; padding: 1.5rem 1rem; border-radius: 20px; text-align: center; border: 1px solid rgba(0,0,0,0.02); }
.mi-value { font-size: 1.5rem; font-weight: 900; color: #1e293b; }
.mi-label { font-size: 0.7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-top: 0.25rem; }

.insights-container-soft { background: #fdfdfd; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 1.5rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }
.btn-action-outline { background: transparent; border: 2px solid #e2e8f0; color: #1e293b; padding: calc(1.1rem - 2px); border-radius: 16px; font-weight: 700; cursor: pointer; }

.letter-spacing-1 { letter-spacing: 1px; }
</style>

<script>
const activities = {
    running: {
        'running_5': { name: 'Running (5 mph)', met: 8.3 },
        'running_6': { name: 'Running (6 mph)', met: 9.8 },
        'running_7': { name: 'Running (7 mph)', met: 11.0 },
        'running_8': { name: 'Running (8 mph)', met: 11.8 },
        'running_trail': { name: 'Trail Running', met: 9.0 }
    },
    cycling: {
        'cycling_light': { name: 'Cycling (< 10 mph)', met: 4.0 },
        'cycling_standard': { name: 'Cycling (12-14 mph)', met: 8.0 },
        'cycling_vigorous': { name: 'Cycling (16-19 mph)', met: 12.0 },
        'cycling_mountain': { name: 'Mountain Biking', met: 8.5 }
    },
    walking: {
        'walking_slow': { name: 'Walking (2 mph)', met: 2.8 },
        'walking_brisk': { name: 'Walking (3.5 mph)', met: 4.3 },
        'walking_uphill': { name: 'Walking Uphill', met: 6.0 },
        'hiking': { name: 'Hiking with Pack', met: 7.8 }
    },
    gym: {
        'light_lifting': { name: 'Weight Lifting (Light)', met: 3.0 },
        'heavy_lifting': { name: 'Weight Lifting (Heavy)', met: 6.0 },
        'calisthenics': { name: 'Calisthenics (Vigorous)', met: 8.0 },
        'hiit': { name: 'HIIT / Circuit Training', met: 10.0 }
    },
    swimming: {
        'swimming_leisure': { name: 'Swimming (Leisure)', met: 6.0 },
        'swimming_laps': { name: 'Swimming (Laps, Freestyle)', met: 10.0 },
        'water_aerobics': { name: 'Water Aerobics', met: 5.5 }
    },
    sports: {
        'basketball': { name: 'Basketball (Game)', met: 8.0 },
        'soccer': { name: 'Soccer (Competitive)', met: 10.0 },
        'tennis': { name: 'Tennis (Singles)', met: 8.0 },
        'volleyball': { name: 'Volleyball (Game)', met: 4.0 }
    }
};

function populateActivities() {
    const cat = document.getElementById('act_cat').value;
    const typeSelect = document.getElementById('act_type');
    typeSelect.innerHTML = '';
    
    for (const key in activities[cat]) {
        const option = document.createElement('option');
        option.value = key;
        option.text = activities[cat][key].name;
        typeSelect.add(option);
    }
}

function calculateCalories() {
    const cat = document.getElementById('act_cat').value;
    const type = document.getElementById('act_type').value;
    const duration = parseFloat(document.getElementById('duration').value) || 0;
    const intensity = parseFloat(document.getElementById('intensity_mod').value);
    const weightUnit = document.getElementById('weight_unit').value;
    let weight = parseFloat(document.getElementById('user_weight').value) || 0;

    if (weight <= 0 || duration <= 0) return;

    // Standardize to KG
    const weightKg = weightUnit === 'lbs' ? weight * 0.453592 : weight;
    const metBase = activities[cat][type].met;
    const metAdjusted = metBase * intensity;

    // Formula: (MET * 3.5 * weightKg) / 200 = kcal/min
    const kcalPerMin = (metAdjusted * 3.5 * weightKg) / 200;
    const totalKcal = kcalPerMin * duration;

    document.getElementById('final-cal').innerText = Math.round(totalKcal);
    document.getElementById('cal-per-min').innerText = kcalPerMin.toFixed(1) + " kcal/min";
    document.getElementById('met-value').innerText = metAdjusted.toFixed(1) + " METs";
    
    // Impact calculations
    document.getElementById('pizza-equiv').innerText = (totalKcal / 285).toFixed(1);
    document.getElementById('cookie-equiv').innerText = (totalKcal / 50).toFixed(1);
    document.getElementById('step-equiv').innerText = Math.round(totalKcal * 25).toLocaleString();

    // Insights
    let fuel = "Mixed (Fat/Carbs)";
    if (metAdjusted < 4) fuel = "Predominantly Fat";
    else if (metAdjusted > 9) fuel = "Predominantly Glycogen";
    document.getElementById('fuel-type').innerText = fuel;

    let insight = `This activity represents a ${metAdjusted > 6 ? 'high' : 'moderate'} metabolic load. Your body is burning approximately ${Math.round(kcalPerMin * 60)} calories per hour at this intensity.`;
    document.getElementById('cal-insights').innerText = insight;
}

function setSession(cat, type, dur) {
    document.getElementById('act_cat').value = cat;
    populateActivities();
    document.getElementById('act_type').value = type;
    document.getElementById('duration').value = dur;
    calculateCalories();
}

function resetCalories() {
    document.getElementById('duration').value = 30;
    calculateCalories();
}

function copyBurnReport() {
    const cal = document.getElementById('final-cal').innerText;
    const met = document.getElementById('met-value').innerText;
    const steps = document.getElementById('step-equiv').innerText;
    const text = `Metabolic Burn Report\n━━━━━━━━━━━━━━━━━━━━━━\nTotal Calories: ${cal} kcal\nIntensity: ${met} METs\nStep Equivalent: ${steps}\n\nTracked via ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2"></i> Copy Burn Report', 2000);
    });
}

function shareBurn() {
    if (navigator.share) {
        navigator.share({
            title: 'My Calorie Burn Results',
            text: `I just burned ${document.getElementById('final-cal').innerText} calories! Check your burn on ToolsHub.`,
            url: window.location.href
        });
    }
}

// UI Triggers
document.getElementById('act_cat').addEventListener('change', () => {
    populateActivities();
    calculateCalories();
});

['act_type', 'duration', 'user_weight', 'weight_unit', 'intensity_mod'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateCalories);
});

document.addEventListener('DOMContentLoaded', () => {
    populateActivities();
    calculateCalories();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\calorie-burn-calculator.blade.php ENDPATH**/ ?>