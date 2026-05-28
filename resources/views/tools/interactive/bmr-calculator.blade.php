<div class="row g-4 bmr-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                {{-- Quick Actions at Top --}}
                <div class="mb-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Profiles:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 bmr-quick" data-v='{"gender":"male","age":30,"weight":80,"height":180}'>👦 Avg. Male (30y, 80kg)</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 bmr-quick" data-v='{"gender":"female","age":30,"weight":65,"height":165}'>👩 Avg. Female (30y, 65kg)</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 bmr-quick" data-v='{"gender":"male","age":20,"weight":70,"height":175}'>🏃 Young Athlete</button>
                </div>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label-custom">Gender</label>
                        <select id="bmr-gender" class="form-select form-select-lg rounded-3">
                            <option value="male">♂ Male</option>
                            <option value="female">♀ Female</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Age (years)</label>
                        <input type="number" id="bmr-age" class="form-control form-control-lg rounded-3" value="30" min="15" max="100">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Weight (kg)</label>
                        <input type="number" id="bmr-weight" class="form-control form-control-lg rounded-3" value="75" step="0.1" min="30">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Height (cm)</label>
                        <input type="number" id="bmr-height" class="form-control form-control-lg rounded-3" value="175" step="0.1" min="100">
                    </div>
                </div>

                <div class="mt-4 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-info-circle text-primary me-1"></i> BMR is the number of calories your body burns to perform basic, life-sustaining functions at rest.
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.06);">
            <div class="output-hero">
                <span class="output-hero-label">YOUR ESTIMATED BMR</span>
                <div class="output-hero-value" id="out-bmr">1,731</div>
                <span class="output-hero-unit">kcal / day</span>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-12 col-md-6">
                    <div class="stat-card" style="border-left: 4px solid #ef4444;">
                        <span class="stat-card-label">Mifflin-St Jeor</span>
                        <span class="stat-card-value" id="out-msj">1,731 kcal</span>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="stat-card" style="border-left: 4px solid #64748b;">
                        <span class="stat-card-label">Harris-Benedict</span>
                        <span class="stat-card-value" id="out-hb">1,765 kcal</span>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="out-insights"></div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-walking me-2 text-warning"></i>Calories Needed by Activity Level (TDEE)</h6>
            <div class="table-responsive">
                <table class="table table-sm table-borderless mb-0 align-middle" id="out-tdee-table">
                    <thead class="text-muted small text-uppercase">
                        <tr>
                            <th>Activity Level</th>
                            <th class="text-end">Multiplier</th>
                            <th class="text-end">Daily Calories</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        {{-- Populated by JS --}}
                    </tbody>
                </table>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="bmr-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Metabolic Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const els = {
        gender: $('bmr-gender'),
        age: $('bmr-age'),
        weight: $('bmr-weight'),
        height: $('bmr-height')
    };
    const fmt = n => Math.round(n).toLocaleString();

    function calculate(){
        const g = els.gender.value;
        const a = parseFloat(els.age.value) || 0;
        const w = parseFloat(els.weight.value) || 0;
        const h = parseFloat(els.height.value) || 0;

        if(a < 1 || w < 1 || h < 1) return;

        // Mifflin-St Jeor
        let msj = (10 * w) + (6.25 * h) - (5 * a);
        msj = (g === 'male') ? msj + 5 : msj - 161;

        // Harris-Benedict (Revised)
        let hb;
        if(g === 'male') {
            hb = 88.362 + (13.397 * w) + (4.799 * h) - (5.677 * a);
        } else {
            hb = 447.593 + (9.247 * w) + (3.098 * h) - (4.330 * a);
        }

        $('out-bmr').textContent = fmt(msj); // Hero value
        $('out-msj').textContent = fmt(msj) + ' kcal';
        $('out-hb').textContent = fmt(hb) + ' kcal';

        // TDEE Table
        const activities = [
            { label: 'Sedentary (Little/No Exercise)', mult: 1.2 },
            { label: 'Lightly Active (1-3 days/week)', mult: 1.375 },
            { label: 'Moderately Active (3-5 days/week)', mult: 1.55 },
            { label: 'Very Active (6-7 days/week)', mult: 1.725 },
            { label: 'Extra Active (Hard labor/Athlete)', mult: 1.9 }
        ];

        let tbody = '';
        activities.forEach(act => {
            const cal = msj * act.mult;
            tbody += `
                <tr style="border-bottom: 1px solid rgba(0,0,0,0.05)">
                    <td class="py-2 fw-semibold text-secondary text-truncate" style="max-width: 200px;">${act.label}</td>
                    <td class="text-end text-muted">${act.mult}x</td>
                    <td class="text-end fw-bold text-dark">${fmt(cal)} kcal</td>
                </tr>
            `;
        });
        $('out-tdee-table').querySelector('tbody').innerHTML = tbody;

        // Insights
        const insights = [];
        insights.push(`Your body needs <strong>${fmt(msj)} calories</strong> simply to pump blood and breathe.`);
        insights.push(`The Mifflin-St Jeor formula is favored for accuracy in 82% of modern adult clinical cases.`);
        if(w > 100) insights.push(`At higher body weights, consider using "Lean Body Mass" for even higher precision.`);

        $('out-insights').innerHTML = `
            <div class="p-3 rounded-3" style="background: rgba(239,68,68,0.04); border: 1px dashed rgba(239,68,68,0.2)">
                <h6 class="fw-bold mb-2 small text-uppercase" style="color:#ef4444"><i class="fas fa-lightbulb me-2"></i>Metabolic Insight</h6>
                <ul class="list-unstyled mb-0">${insights.map(i=>`<li class="mb-1 small text-dark"><i class="fas fa-check text-success me-2"></i>${i}</li>`).join('')}</ul>
            </div>
        `;
    }

    Object.values(els).forEach(el => el.addEventListener('input', calculate));

    // Quick Actions
    document.querySelectorAll('.bmr-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            const v = JSON.parse(btn.dataset.v);
            els.gender.value = v.gender;
            els.age.value = v.age;
            els.weight.value = v.weight;
            els.height.value = v.height;
            calculate();
        });
    });

    // Copy
    $('bmr-copy').addEventListener('click', function(){
        const text = `Metabolic Report (BMR)\nBMR (Mifflin-St Jeor): ${$('out-msj').textContent}\nBMR (Harris-Benedict): ${$('out-hb').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.bmr-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.bmr-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.bmr-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b;font-size:1.5rem}
.bmr-rebuilt .calculator-header p{margin:0;font-size:.95rem;color:#64748b}
.bmr-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.bmr-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#475569;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:20px;padding:2rem;box-shadow:0 8px 32px rgba(0,0,0,.06)}
.output-hero{text-align:center;padding:1.5rem 0}
.output-hero-label{font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:2px;color:#64748b}
.output-hero-value{font-size:4rem;font-weight:900;color:var(--tool-color);line-height:1;margin:.5rem 0;letter-spacing:-2px}
.output-hero-unit{font-size:1rem;color:#94a3b8;font-weight:600}
.stat-card{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:1.25rem;transition:transform .2s}
.stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,.05)}
.stat-card-label{display:block;font-size:.7rem;font-weight:700;text-transform:uppercase;color:#94a3b8;letter-spacing:.5px;margin-bottom:.25rem}
.stat-card-value{font-size:1.5rem;font-weight:800;color:#1e293b}
</style>
