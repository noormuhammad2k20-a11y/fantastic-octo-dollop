<div class="row g-4 bmr-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Gender Profile</label>
                        <select id="bmr-gender" class="form-select form-select-lg rounded-3">
                            <option value="male">♂ Male Profile</option>
                            <option value="female">♀ Female Profile</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Current Age</label>
                        <input type="number" id="bmr-age" class="form-control form-control-lg rounded-3" value="30" min="15" max="110">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Weight (<span class="unit-w">kg</span>)</label>
                        <input type="number" id="bmr-weight" class="form-control form-control-lg rounded-3" value="75" step="0.1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Height (<span class="unit-h">cm</span>)</label>
                        <input type="number" id="bmr-height" class="form-control form-control-lg rounded-3" value="175" step="0.1">
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary px-4 active unit-toggle" data-unit="metric">Metric Standards</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary px-4 unit-toggle" data-unit="imperial">Imperial Standards</button>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 bmr-quick" data-v='{"g":"male","a":30,"w":80,"h":180}'>👦 Avg. Male</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 bmr-quick" data-v='{"g":"female","a":30,"w":60,"h":165}'>👩 Avg. Female</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="bmr-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="bmr-theme" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.06);">
            <div class="output-hero">
                <span class="output-hero-label">EXPECTED CALORIC TURNOVER</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-bmr">1,731</span>
                    <span class="output-hero-unit">kcal / day</span>
                </div>
                <div class="mt-2 text-muted fw-bold small">Baseline Metabolism @ Rest</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="stat-card" style="border-left: 5px solid #ef4444; background: #fff;">
                        <span class="stat-card-label">Mifflin-St Jeor (Modern)</span>
                        <span class="stat-card-value text-danger" id="out-msj">1,731 kcal</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-left: 5px solid #1e293b; background: #fff;">
                        <span class="stat-card-label">Harris-Benedict (Legacy)</span>
                        <span class="stat-card-value text-dark" id="out-hb">1,765 kcal</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-burn text-danger me-2"></i>Daily Energy Requirements (TDEE)
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless mb-0 align-middle">
                        <thead class="text-muted xx-small text-uppercase">
                            <tr>
                                <th>Activity Level</th>
                                <th class="text-end">Multiplier</th>
                                <th class="text-end">Target Calories</th>
                            </tr>
                        </thead>
                        <tbody id="tdee-body"></tbody>
                    </table>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="bmr-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Full Report
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="bmr-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Analysis
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const genderE = $('bmr-gender'), ageE = $('bmr-age'),
          weightE = $('bmr-weight'), heightE = $('bmr-height');
    
    let units = 'metric';

    function calculate(){
        let g = genderE.value;
        let a = parseFloat(ageE.value) || 0;
        let w = parseFloat(weightE.value) || 0;
        let h = parseFloat(heightE.value) || 0;

        if(a < 1 || w < 1 || h < 1) return;

        let wKg = (units === 'metric') ? w : w * 0.453592;
        let hCm = (units === 'metric') ? h : h * 2.54;

        // Mifflin-St Jeor
        let msj = (10 * wKg) + (6.25 * hCm) - (5 * a);
        msj = (g === 'male') ? msj + 5 : msj - 161;

        // Harris-Benedict
        let hb;
        if(g === 'male') hb = 88.362 + (13.397 * wKg) + (4.799 * hCm) - (5.677 * a);
        else hb = 447.593 + (9.247 * wKg) + (3.098 * hCm) - (4.330 * a);

        const fmt = n => Math.round(n).toLocaleString();
        
        $('out-bmr').textContent = fmt(msj);
        $('out-msj').textContent = fmt(msj) + ' kcal';
        $('out-hb').textContent = fmt(hb) + ' kcal';

        // TDEE
        const activity = [
            { l: 'Sedentary', m: 1.2 },
            { l: 'Lightly Active', m: 1.375 },
            { l: 'Moderately Active', m: 1.55 },
            { l: 'Very Active', m: 1.725 },
            { l: 'Athlete / Physical Labor', m: 1.9 }
        ];

        $('tdee-body').innerHTML = activity.map(act => `
            <tr>
                <td class="small fw-bold">${act.l}</td>
                <td class="text-end text-muted small">${act.m}x</td>
                <td class="text-end fw-bold text-dark">${fmt(msj * act.m)} kcal</td>
            </tr>
        `).join('');
    }

    [genderE, ageE, weightE, heightE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.unit-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            if(btn.dataset.unit === units) return;
            const prev = units;
            units = btn.dataset.unit;
            
            document.querySelectorAll('.unit-toggle').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const wF = (units === 'metric') ? 0.453592 : 2.20462;
            const hF = (units === 'metric') ? 2.54 : 1/2.54;
            
            weightE.value = (weightE.value * wF).toFixed(1);
            heightE.value = (heightE.value * hF).toFixed(1);
            
            document.querySelectorAll('.unit-w').forEach(e => e.textContent = (units==='metric'?'kg':'lb'));
            document.querySelectorAll('.unit-h').forEach(e => e.textContent = (units==='metric'?'cm':'in'));
            calculate();
        });
    });

    document.querySelectorAll('.bmr-quick').forEach(btn => {
        btn.onclick = () => {
            const v = JSON.parse(btn.dataset.v);
            units = 'metric';
            document.querySelectorAll('.unit-toggle').forEach(b => b.classList.toggle('active', b.dataset.unit === 'metric'));
            genderE.value = v.g; ageE.value = v.a; weightE.value = v.w; heightE.value = v.h;
            calculate();
        };
    });

    $('bmr-reset').onclick = () => {
        ageE.value = 30; weightE.value = 75; heightE.value = 175; calculate();
    };

    $('bmr-copy-btn').onclick = function(){
        const text = `Metabolic Analysis (BMR)\nMifflin-St Jeor: ${$('out-msj').textContent}\nDaily Target (Sedentary TDEE): ${Math.round(parseFloat($('out-msj').textContent.replace(/,/g,'')) * 1.2)} kcal\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.bmr-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(239,68,68,.05)}
.bmr-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.bmr-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.bmr-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.bmr-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.bmr-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.letter-spacing-1 { letter-spacing: 1px; }
.xx-small { font-size: 0.65rem; }

@media (max-width: 768px) {
    .bmr-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bmr-calculator-pro.blade.php ENDPATH**/ ?>