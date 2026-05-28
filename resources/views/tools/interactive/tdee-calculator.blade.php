<div class="row g-4 tdee-calc-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Gender</label>
                        <select id="tdee-gender" class="form-select form-select-lg rounded-3">
                            <option value="male">♂ Male</option>
                            <option value="female">♀ Female</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Age (years)</label>
                        <input type="number" id="tdee-age" class="form-control form-control-lg rounded-3" value="30" min="1" max="120">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Weight (kg)</label>
                        <input type="number" id="tdee-weight" class="form-control form-control-lg rounded-3" value="75" step="0.1" min="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Height (cm)</label>
                        <input type="number" id="tdee-height" class="form-control form-control-lg rounded-3" value="175" step="0.1" min="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Activity Level</label>
                        <select id="tdee-activity" class="form-select form-select-lg rounded-3">
                            <option value="1.2">Sedentary (desk job, little exercise)</option>
                            <option value="1.375">Lightly Active (1-3 days/week)</option>
                            <option value="1.55" selected>Moderately Active (3-5 days/week)</option>
                            <option value="1.725">Very Active (6-7 days/week)</option>
                            <option value="1.9">Extra Active (athlete / physical labor)</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Fill:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 tdee-quick" data-v='{"gender":"male","age":25,"weight":75,"height":175,"activity":"1.55"}'>👦 Male 25y / 75kg</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 tdee-quick" data-v='{"gender":"female","age":30,"weight":60,"height":165,"activity":"1.375"}'>👩 Female 30y / 60kg</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 tdee-quick" data-v='{"gender":"male","age":28,"weight":85,"height":180,"activity":"1.725"}'>🏋️ Athlete 28y / 85kg</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:24;--tool-color:#ea580c;--tool-bg:rgba(234,88,12,.06);">
            <div class="output-hero">
                <span class="output-hero-label">YOUR MAINTENANCE CALORIES (TDEE)</span>
                <div class="output-hero-value" id="out-tdee">2,585</div>
                <span class="output-hero-unit">kcal / day</span>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-6 col-md-4">
                    <div class="stat-card"><span class="stat-card-label">BMR</span><span class="stat-card-value" id="out-bmr">1,668</span></div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="stat-card" style="border-color:#16a34a"><span class="stat-card-label">Weekly Burn</span><span class="stat-card-value text-success" id="out-weekly">18,095</span></div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6"><span class="stat-card-label">Active Calories</span><span class="stat-card-value text-info" id="out-active">917</span></div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-utensils me-2 text-warning"></i>Weight Management Goals</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="goal-card goal-loss">
                        <div class="goal-icon">🔻</div>
                        <div class="goal-lbl">Weight Loss</div>
                        <div class="goal-val" id="out-loss">2,085</div>
                        <div class="goal-sub">-500 kcal/day</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="goal-card goal-maintain">
                        <div class="goal-icon">⚖️</div>
                        <div class="goal-lbl">Maintain</div>
                        <div class="goal-val" id="out-maintain">2,585</div>
                        <div class="goal-sub">Stay consistent</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="goal-card goal-gain">
                        <div class="goal-icon">🔺</div>
                        <div class="goal-lbl">Weight Gain</div>
                        <div class="goal-val" id="out-gain">3,085</div>
                        <div class="goal-sub">+500 kcal/day</div>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="out-insights"></div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="tdee-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Energy Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const ids = ['tdee-gender','tdee-age','tdee-weight','tdee-height','tdee-activity'];
    const els = {}; ids.forEach(i => els[i] = $(i));
    const fmt = n => Math.round(n).toLocaleString();

    function calculate(){
        const gender = els['tdee-gender'].value;
        const age    = parseFloat(els['tdee-age'].value) || 0;
        const weight = parseFloat(els['tdee-weight'].value) || 0;
        const height = parseFloat(els['tdee-height'].value) || 0;
        const act    = parseFloat(els['tdee-activity'].value) || 1.2;

        if(age<=0||weight<=0||height<=0) return;

        // Mifflin-St Jeor Equation
        let bmr = (10 * weight) + (6.25 * height) - (5 * age);
        bmr = (gender === 'male') ? bmr + 5 : bmr - 161;

        const tdee = bmr * act;

        $('out-tdee').textContent = fmt(tdee);
        $('out-bmr').textContent = fmt(bmr);
        $('out-weekly').textContent = fmt(tdee * 7);
        $('out-active').textContent = fmt(tdee - bmr);
        
        $('out-loss').textContent = fmt(tdee - 500);
        $('out-maintain').textContent = fmt(tdee);
        $('out-gain').textContent = fmt(tdee + 500);

        // Insights
        const insights = [];
        insights.push(`Your BMR is <strong>${fmt(bmr)} kcal</strong>, representing the energy your body needs at complete rest.`);
        insights.push(`Your daily activity increases your energy needs by <strong>${fmt(tdee-bmr)} kcal</strong>.`);
        insights.push(`To maintain your current weight of <strong>${weight} kg</strong>, you should consume ~<strong>${fmt(tdee)} calories</strong> daily.`);
        
        const activityMap = {
            "1.2": "Sedentary (desk job, minimal exercise)",
            "1.375": "Lightly Active (1-3 days of exercise)",
            "1.55": "Moderately Active (3-5 days of exercise)",
            "1.725": "Very Active (6-7 days of heavy exercise)",
            "1.9": "Extra Active (athlete or physical labor job)"
        };
        insights.push(`Based on your <strong>${activityMap[els['tdee-activity'].value]}</strong> lifestyle, your metabolic multiplier is ${act}.`);

        $('out-insights').innerHTML = `<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Metabolic Insights</h6><ul class="list-unstyled mb-0">${insights.map(i=>`<li class="mb-2 small text-secondary"><i class="fas fa-check-circle text-success me-2"></i>${i}</li>`).join('')}</ul>`;
    }

    ids.forEach(i => els[i].addEventListener('input', calculate));

    // Quick Actions
    document.querySelectorAll('.tdee-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            const v = JSON.parse(btn.dataset.v);
            els['tdee-gender'].value = v.gender;
            els['tdee-age'].value = v.age;
            els['tdee-weight'].value = v.weight;
            els['tdee-height'].value = v.height;
            els['tdee-activity'].value = v.activity;
            calculate();
        });
    });

    // Copy
    $('tdee-copy').addEventListener('click', function(){
        const text = `TDEE Energy Report\nMaintenance Calories (TDEE): ${$('out-tdee').textContent} kcal/day\nBMR: ${$('out-bmr').textContent} kcal/day\nWeekly Total: ${$('out-weekly').textContent} kcal\nWeight Loss Goal: ${$('out-loss').textContent} kcal\nWeight Gain Goal: ${$('out-gain').textContent} kcal\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.tdee-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.tdee-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.tdee-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.tdee-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.tdee-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.tdee-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:20px;padding:2rem;box-shadow:0 8px 32px rgba(0,0,0,.06)}
.output-hero{text-align:center;padding:1.5rem 0}
.output-hero-label{font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:2px;color:#64748b}
.output-hero-value{font-size:3.5rem;font-weight:900;color:var(--tool-color);line-height:1;margin:.5rem 0;letter-spacing:-2px}
.output-hero-unit{font-size:.9rem;color:#94a3b8;font-weight:600}
.stat-card{background:#fff;border:2px solid #e5e7eb;border-radius:14px;padding:1rem;text-align:center;transition:border-color .2s}
.stat-card:hover{border-color:var(--tool-color,#ea580c)}
.stat-card-label{display:block;font-size:.7rem;font-weight:700;text-transform:uppercase;color:#94a3b8;letter-spacing:.5px;margin-bottom:.25rem}
.stat-card-value{font-size:1.4rem;font-weight:800;color:#1e293b}
.goal-card{text-align:center;padding:1.5rem 1rem;border-radius:16px;background:#fff;border:1px solid #e5e7eb;transition:transform .2s}
.goal-card:hover{transform:translateY(-3px);border-color:var(--tool-color)}
.goal-loss{border-left:4px solid #ef4444}
.goal-maintain{border-left:4px solid #3b82f6}
.goal-gain{border-left:4px solid #10b981}
.goal-icon{font-size:1.5rem;margin-bottom:.5rem}
.goal-lbl{font-size:.75rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.goal-val{font-size:1.5rem;font-weight:800;color:#1e293b}
.goal-sub{font-size:.7rem;color:#94a3b8;font-weight:600}
</style>
