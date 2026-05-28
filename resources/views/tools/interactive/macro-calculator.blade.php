<div class="row g-4 macro-calc-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Daily Caloric Target</label>
                        <div class="input-group">
                            <input type="number" id="macro-cals" class="form-control form-control-lg rounded-start-3" value="2000" min="500" max="10000">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold">kcal</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Nutritional Strategy</label>
                        <select id="macro-split" class="form-select form-select-lg rounded-3">
                            <option value="30|35|35">Balanced Maintenance (30/35/35)</option>
                            <option value="40|40|20" selected>Fat Loss / Bodybuilding (40/40/20)</option>
                            <option value="25|55|20">Endurance Performance (25/55/20)</option>
                            <option value="25|5|70">Ketogenic / Low Carb (25/5/70)</option>
                            <option value="45|25|30">Aggressive Cutting (45/25/30)</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Profiles:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 macro-quick" data-v='{"c":1800,"s":"40|40|20"}'>🔥 1800 Cutting</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 macro-quick" data-v='{"c":2500,"s":"30|35|35"}'>⚖️ 2500 Balanced</button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 macro-quick" data-v='{"c":3200,"s":"25|55|20"}'>💪 3200 Bulking</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="macro-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="macro-theme" style="--tool-hue:161;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.06);">
            <div class="output-hero">
                <span class="output-hero-label">DAILY MACRONUTRIENT ALLOCATION</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-total-val">2000</span>
                    <span class="output-hero-unit">kcal / day</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" style="letter-spacing:1px;color:#10b981;">Precision Targets Calculated</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #3b82f6; background: #fff;">
                        <span class="stat-card-label">PROTEIN (4 kcal/g)</span>
                        <span class="stat-card-value text-primary" id="out-p">200g</span>
                        <div class="small text-muted fw-bold mt-1" id="out-p-cals">800 kcal</div>
                        <div class="progress mt-2" style="height: 6px; border-radius: 10px; background: rgba(59,130,246,0.1);">
                            <div id="bar-p" class="progress-bar bg-primary" style="width: 40%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #10b981; background: #fff;">
                        <span class="stat-card-label">CARBS (4 kcal/g)</span>
                        <span class="stat-card-value text-success" id="out-c">200g</span>
                        <div class="small text-muted fw-bold mt-1" id="out-c-cals">800 kcal</div>
                        <div class="progress mt-2" style="height: 6px; border-radius: 10px; background: rgba(16,185,129,0.1);">
                            <div id="bar-c" class="progress-bar bg-success" style="width: 40%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #f59e0b; background: #fff;">
                        <span class="stat-card-label">FATS (9 kcal/g)</span>
                        <span class="stat-card-value text-warning" id="out-f">44g</span>
                        <div class="small text-muted fw-bold mt-1" id="out-f-cals">400 kcal</div>
                        <div class="progress mt-2" style="height: 6px; border-radius: 10px; background: rgba(245,158,11,0.1);">
                            <div id="bar-f" class="progress-bar bg-warning" style="width: 20%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-microscope text-success me-2"></i>Nutritional Strategy Summary
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="macro-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Macro Plan
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="macro-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Assessment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const cEl = $('macro-cals'), sEl = $('macro-split');

    function calculate(){
        const calories = parseFloat(cEl.value) || 0;
        if(calories < 500) return;

        const split = sEl.value.split('|');
        const pPct = parseFloat(split[0]), cPct = parseFloat(split[1]), fPct = parseFloat(split[2]);

        const pCals = calories * (pPct/100), cCals = calories * (cPct/100), fCals = calories * (fPct/100);
        const pGrams = Math.round(pCals / 4), cGrams = Math.round(cCals / 4), fGrams = Math.round(fCals / 9);

        $('out-total-val').textContent = calories.toLocaleString();
        $('out-p').textContent = pGrams + 'g';
        $('out-c').textContent = cGrams + 'g';
        $('out-f').textContent = fGrams + 'g';
        
        $('out-p-cals').textContent = Math.round(pCals).toLocaleString() + ' kcal';
        $('out-c-cals').textContent = Math.round(cCals).toLocaleString() + ' kcal';
        $('out-f-cals').textContent = Math.round(fCals).toLocaleString() + ' kcal';

        $('bar-p').style.width = pPct + '%';
        $('bar-c').style.width = cPct + '%';
        $('bar-f').style.width = fPct + '%';

        // Insights
        const ins = [];
        ins.push(`Protein: <strong>${pGrams}g</strong> targeted for muscle tissue synthesis.`);
        ins.push(`Carbohydrates: <strong>${cGrams}g</strong> designated for muscular glycogen replenishment.`);
        ins.push(`Health Tip: Ensure your dietary fats come from unsaturated sources like avocados and nuts.`);

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [cEl, sEl].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.macro-quick').forEach(btn => {
        btn.onclick = () => {
            const v = JSON.parse(btn.dataset.v);
            cEl.value = v.c; sEl.value = v.s;
            calculate();
        };
    });

    $('macro-reset').onclick = () => {
        cEl.value = 2000; sEl.value = "30|35|35";
        calculate();
    };

    $('macro-copy-btn').onclick = function(){
        const text = `Macro Nutritional Report\nTotal: ${cEl.value} kcal\nProtein: ${$('out-p').textContent}\nCarbs: ${$('out-c').textContent}\nFats: ${$('out-f').textContent}\n— ToolsHub Nutrition`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.macro-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(16,185,129,.05)}
.macro-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.macro-calc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.macro-calc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.macro-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.macro-calc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:4rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-2px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.8rem;font-weight:800;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .macro-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3rem; }
}
</style>
