<div class="row g-4 protein-calc-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Current Weight</label>
                        <div class="input-group">
                            <input type="number" id="prot-weight" class="form-control form-control-lg rounded-start-3" value="70">
                            <select id="prot-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 100px;">
                                <option value="kg">kg</option>
                                <option value="lb">lb</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label-custom">Training Intensity & Adaptation Goal</label>
                        <select id="prot-goal" class="form-select form-select-lg rounded-3">
                            <option value="0.8">Sedentary (Clinicial Baseline) - 0.8g/kg</option>
                            <option value="1.2">Active / Endurance Support - 1.2g/kg</option>
                            <option value="1.6" selected>Muscle Hypertrophy / Strength Focus - 1.6g/kg</option>
                            <option value="2.2">Heavy Strength / Deficit Protection - 2.2g/kg</option>
                            <option value="2.6">Extreme High Protein / Bodybuilding - 2.6g/kg</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Athelete Profiles:</span>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 prot-quick" data-w="75" data-u="kg" data-g="1.6">💪 75kg Strength</button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 prot-quick" data-w="180" data-u="lb" data-g="1.2">🏃 180lb Endurance</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="prot-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="prot-theme" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(2,132,199,.06);">
            <div class="output-hero">
                <span class="output-hero-label">DAILY PROTEIN TARGET</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-total">112</span>
                    <span class="output-hero-unit">grams / day</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" style="letter-spacing:1px;color:#0284c7;">Optimal Intake Identified</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #0284c7; background: #fff;">
                        <span class="stat-card-label">PER MEAL (4 SERVINGS)</span>
                        <span class="stat-card-value text-primary" id="out-meal">28g</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #10b981; background: #fff;">
                        <span class="stat-card-label">ANALOG SOURCE (CHICKEN)</span>
                        <span class="stat-card-value text-success" id="out-food">360g</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #f59e0b; background: #fff;">
                        <span class="stat-card-label">CALORIC BURN</span>
                        <span class="stat-card-value text-warning" id="out-cals">448 kcal</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-drumstick-bite text-primary me-2"></i>Macronutrient Performance Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="prot-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Protein Roadmap
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="prot-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Summary
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const wE = $('prot-weight'), uE = $('prot-unit'), gE = $('prot-goal');

    function calculate(){
        const weight = parseFloat(wE.value) || 0;
        const multiplier = parseFloat(gE.value);
        if(weight <= 0) return;

        const weightKg = uE.value === 'lb' ? weight / 2.20462 : weight;
        const total = Math.round(weightKg * multiplier);

        $('out-total').textContent = total;
        $('out-meal').textContent = Math.round(total / 4) + 'g';
        $('out-cals').textContent = (total * 4).toLocaleString() + ' kcal';
        
        const chickenG = Math.round((total / 31) * 100);
        $('out-food').textContent = uE.value === 'lb' ? (chickenG / 28.35).toFixed(1) + ' oz' : chickenG + 'g';

        // Insights
        const ins = [];
        ins.push(`Targeting <strong>${total}g</strong> per day supports metabolic stability and tissue repair.`);
        ins.push(`Distribution: Aim for 4-5 servings of <strong>${Math.round(total / 4)}g</strong> throughout the day.`);
        ins.push(`Science: Consuming protein within 3-4 hours of training optimizes muscular adaptation.`);

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-info me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [wE, uE, gE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.prot-quick').forEach(btn => {
        btn.onclick = () => {
            wE.value = btn.dataset.w; uE.value = btn.dataset.u; gE.value = btn.dataset.g;
            calculate();
        };
    });

    $('prot-reset').onclick = () => {
        wE.value = 70; uE.value = 'kg'; gE.value = 1.6;
        calculate();
    };

    $('prot-copy-btn').onclick = function(){
        const text = `Daily Protein Requirement\nTotal: ${$('out-total').textContent}g\nPer Meal: ${$('out-meal').textContent}\n— ToolsHub Fitness`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Data Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.protein-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(2,132,199,.05)}
.protein-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.protein-calc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.protein-calc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.protein-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.protein-calc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:4.5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.5rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.5rem;font-weight:800;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .protein-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
