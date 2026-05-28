<div class="row g-4 water-intake-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Body Weight</label>
                        <div class="input-group">
                            <input type="number" id="wat-weight" class="form-control form-control-lg rounded-start-3" value="75">
                            <select id="wat-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 100px;">
                                <option value="kg">kg</option>
                                <option value="lb">lbs</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Gender Profile</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary active flex-grow-1 py-2 fw-bold rounded-3 gender-btn" data-gender="male">
                                <i class="fas fa-mars me-2"></i>Male
                            </button>
                            <button type="button" class="btn btn-outline-primary flex-grow-1 py-2 fw-bold rounded-3 gender-btn" data-gender="female">
                                <i class="fas fa-venus me-2"></i>Female
                            </button>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Activity Intensity</label>
                        <select id="wat-activity" class="form-select form-select-lg rounded-3">
                            <option value="sedentary">Sedentary (Office/Rest)</option>
                            <option value="light">Light (Walking/Yoga)</option>
                            <option value="moderate" selected>Moderate (Gym/Running)</option>
                            <option value="intense">Intense (Heavy Training/Sports)</option>
                            <option value="extreme">Extreme (Endurance/Manual Labor)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Environmental Climate</label>
                        <select id="wat-climate" class="form-select form-select-lg rounded-3">
                            <option value="temperate" selected>Temperate (Moderate Temp)</option>
                            <option value="hot">Hot / Very Humid</option>
                            <option value="cold">Cold / Dry</option>
                            <option value="tropical">Extreme Tropical Heat</option>
                        </select>
                    </div>

                    
                    <div class="col-12 d-none" id="female-options">
                        <label class="form-label-custom">Special Conditions</label>
                        <div class="d-flex gap-3">
                            <div class="form-check form-switch card p-3 flex-grow-1">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="wat-pregnant">
                                <label class="form-check-label fw-bold" for="wat-pregnant">Pregnant (+300ml)</label>
                            </div>
                            <div class="form-check form-switch card p-3 flex-grow-1">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="wat-nursing">
                                <label class="form-check-label fw-bold" for="wat-nursing">Breastfeeding (+700ml)</label>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 wat-quick" data-w="70" data-a="sedentary" data-c="temperate">🏢 Desk Worker</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 wat-quick" data-w="85" data-a="moderate" data-c="temperate">🏃 Regular Active</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 wat-quick" data-w="90" data-a="extreme" data-c="hot">☀️ Field Laborer</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.06);">
            <div class="output-hero">
                <span class="output-hero-label">RECOMMENDED DAILY TOTAL</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-liters">3.5</span>
                    <span class="output-hero-unit">Liters</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-glasses">~14 Glasses (250ml)</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#0ea5e9; background: rgba(14,165,233,.02);">
                        <span class="stat-card-label">BASE METABOLIC NEED</span>
                        <span class="stat-card-value text-info" id="out-base">2.8L</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">ACTIVITY ADJUSTMENT</span>
                        <span class="stat-card-value text-success" id="out-adjust">+0.7L</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">IDEAL INTAKE RATE</span>
                        <span class="stat-card-value text-warning" id="out-rate">220ml / hr</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-clipboard-list text-primary me-2"></i>Personalized Hydration Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="wat-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Hydration Plan
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="wat-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="wat-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Hydration Map
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const weightE = $('wat-weight'), unitE = $('wat-unit'), 
          activityE = $('wat-activity'), climateE = $('wat-climate'),
          pregE = $('wat-pregnant'), nursE = $('wat-nursing');
    
    let currentGender = 'male';

    function calculate(){
        let w = parseFloat(weightE.value) || 0;
        const u = unitE.value;
        const active = activityE.value;
        const climate = climateE.value;
        const isPreg = pregE.checked && currentGender === 'female';
        const isNurs = nursE.checked && currentGender === 'female';

        if(w <= 0) return;
        
        const wKg = (u === 'lb') ? w / 2.20462 : w;
        
        // Base calc (35ml per kg)
        let baseVol = wKg * 0.035;

        // Gender Adjustment (IOM standards: Male ~3.7, Female ~2.7 for average)
        if(currentGender === 'male') baseVol += 0.5;
        
        // Activity Logics
        let activeAdjust = 0;
        switch(active){
            case 'light': activeAdjust = 0.3; break;
            case 'moderate': activeAdjust = 0.7; break;
            case 'intense': activeAdjust = 1.2; break;
            case 'extreme': activeAdjust = 2.0; break;
        }

        // Climate Logics
        let climateAdjust = 0;
        switch(climate){
            case 'hot': climateAdjust = 0.6; break;
            case 'tropical': climateAdjust = 1.2; break;
            case 'cold': climateAdjust = 0.3; break; // Dry air increases loss
        }

        // Female specific conditions
        let conditionAdjust = 0;
        if(isPreg) conditionAdjust += 0.3;
        if(isNurs) conditionAdjust += 0.7;

        const total = baseVol + activeAdjust + climateAdjust + conditionAdjust;
        
        // Update UI
        $('out-liters').textContent = total.toFixed(1);
        $('out-glasses').textContent = `~${Math.ceil(total / 0.25)} Glasses (250ml)`;
        $('out-base').textContent = baseVol.toFixed(1) + 'L';
        $('out-adjust').textContent = '+' + (activeAdjust + climateAdjust + conditionAdjust).toFixed(1) + 'L';
        
        // Rate (Assuming 15 hour waking day)
        $('out-rate').textContent = Math.round((total * 1000) / 15) + 'ml / hr';

        // Insights
        const ins = [];
        ins.push(`Aim to drink about <strong>${Math.round((total*1000)/15)}ml every hour</strong> for optimal absorption.`);
        if(active === 'extreme' || active === 'intense' || climate === 'tropical') {
            ins.push('High sweat loss detected. Consider adding <strong>electrolytes</strong> (Sodium/Potassium) to your water.');
        }
        if(climate === 'cold') {
            ins.push('Dry cold air can mask thirst. Don\'t wait for thirst cues to hydrate.');
        }
        if(isNurs) {
            ins.push('Hydration is the \#1 factor in breast milk production. Drink a glass with every feed.');
        }
        
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [weightE, unitE, activityE, climateE, pregE, nursE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.gender-btn').forEach(btn => {
        btn.addEventListener('click', ()=>{
            currentGender = btn.dataset.gender;
            document.querySelectorAll('.gender-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            // Toggle female options
            $('female-options').classList.toggle('d-none', currentGender === 'male');
            
            calculate();
        });
    });

    document.querySelectorAll('.wat-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            weightE.value = btn.dataset.w;
            activityE.value = btn.dataset.a;
            climateE.value = btn.dataset.c;
            calculate();
        });
    });

    $('wat-reset').addEventListener('click', ()=>{
        weightE.value = 75;
        unitE.value = 'kg';
        activityE.value = 'moderate';
        climateE.value = 'temperate';
        pregE.checked = false;
        nursE.checked = false;
        calculate();
    });

    $('wat-copy-btn').addEventListener('click', function(){
        const text = `Personal Hydration Plan\nDaily Target: ${$('out-liters').textContent} Liters\nHourly Rate: ${$('out-rate').textContent}\nGenerated by ToolsHub Smart Hydration Mapper`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Plan Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.water-intake-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(14,165,233,.05)}
.water-intake-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.water-intake-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.water-intake-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.water-intake-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.water-intake-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.water-intake-rebuilt .btn-outline-primary{border-color:#0ea5e9; color:#0ea5e9; border-width:2.5px}
.water-intake-rebuilt .btn-outline-primary.active{background-color:#0ea5e9; border-color:#0ea5e9; color:#fff}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:2rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .water-intake-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\water-intake-calc.blade.php ENDPATH**/ ?>