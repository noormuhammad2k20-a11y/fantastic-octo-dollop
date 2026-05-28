<div class="row g-4 protein-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Body Weight</label>
                        <div class="input-group">
                            <input type="number" id="prot-weight" class="form-control form-control-lg rounded-start-3" value="70">
                            <select id="prot-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 100px;">
                                <option value="kg">kg</option>
                                <option value="lbs">lbs</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label-custom">Training Goal / Activity Level</label>
                        <select id="prot-goal" class="form-select form-select-lg rounded-3">
                            <option value="0.8">Sedentary (General Health Maintenance) - 0.8g/kg</option>
                            <option value="1.2">Light Activity / Endurance Training - 1.2g/kg</option>
                            <option value="1.6" selected>Moderate Training / Muscle Hypertrophy - 1.6g/kg</option>
                            <option value="2.0">Heavy Strength Training / Elite Athlete - 2.0g/kg</option>
                            <option value="2.4">Extreme Calorie Deficit (Max Muscle Retention) - 2.4g/kg</option>
                        </select>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Profiles:</span>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 prot-quick" data-w="75" data-u="kg" data-g="1.6">💪 75kg Athlete</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 prot-quick" data-w="180" data-u="lbs" data-g="1.2">🏃 180lbs Runner</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 prot-quick" data-w="90" data-u="kg" data-g="2.0">🏋️ 90kg Powerlifter</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(2,132,199,.06);">
            <div class="output-hero">
                <span class="output-hero-label">RECOMMENDED DAILY PROTEIN</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-total">112</span>
                    <span class="output-hero-unit">grams / day</span>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#0284c7; background: rgba(2,132,199,.02);">
                        <span class="stat-card-label">PER MEAL (4 MEALS)</span>
                        <span class="stat-card-value text-primary" id="out-meal">28g</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">FOOD EQUIVALENT</span>
                        <span class="stat-card-value text-success" id="out-food" style="font-size: 1.5rem; margin-top: 0.5rem;">360g Chicken</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">CALORIC CONTENT</span>
                        <span class="stat-card-value text-warning" id="out-cals">448</span>
                        <div class="small text-muted fw-bold">kcal from Protein</div>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="out-insights"></div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="prot-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Protein Report
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="prot-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Hydration Plan
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
        let w = parseFloat(wE.value) || 0;
        const u = uE.value;
        const mult = parseFloat(gE.value);
        
        if(w <= 0) return;
        
        // Convert to kg for internal calc
        const wKg = (u === 'lbs') ? w / 2.20462 : w;
        const target = Math.round(wKg * mult);
        
        $('out-total').textContent = target;
        $('out-meal').textContent = Math.round(target / 4) + 'g';
        $('out-cals').textContent = (target * 4).toLocaleString();
        
        // Food Equivalent (Chicken Breast ~31g protein per 100g)
        const chickG = Math.round((target / 31) * 100);
        if(u === 'lbs') {
            const chickOz = (chickG / 28.35).toFixed(1);
            $('out-food').textContent = chickOz + ' oz Chicken';
        } else {
            $('out-food').textContent = chickG + 'g Chicken';
        }

        // Insights
        const ins = [];
        if(mult <= 0.8) ins.push('This is the <strong>RDA</strong> to avoid deficiency; athletes usually require significantly more.');
        if(mult >= 1.6) ins.push('This range is optimal for <strong>muscle protein synthesis</strong> and recovery during high-intensity training.');
        if(mult >= 2.2) ins.push('High protein intake helps preserve lean mass while in a significant <strong>caloric deficit</strong>.');
        
        ins.push(`Aim to consume <strong>${Math.round(target / 4)}g</strong> of protein per meal over 4-5 meals for optimal distribution.`);
        
        $('out-insights').innerHTML = `<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Protein Strategy</h6><ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 small text-secondary d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [wE, uE, gE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.prot-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            wE.value = btn.dataset.w;
            uE.value = btn.dataset.u;
            gE.value = btn.dataset.g;
            calculate();
        });
    });

    $('prot-copy-btn').addEventListener('click', function(){
        const text = `Daily Protein Report\nTotal Goal: ${$('out-total').textContent}g\nPer Meal: ${$('out-meal').textContent}\nTotal Calories: ${$('out-cals').textContent} kcal\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Report Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.protein-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.protein-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.protein-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b;letter-spacing:-0.5px}
.protein-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b;line-height:1.5}
.protein-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.protein-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:20px;padding:2rem;box-shadow:0 8px 32px rgba(0,0,0,.06)}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:1px solid rgba(0,0,0,.05);margin-bottom:1.5rem}
.output-hero-label{display:block;font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:2px;color:#64748b;margin-bottom:0.5rem}
.output-hero-value{font-size:4.5rem;font-weight:900;color:#1e293b;line-height:1;letter-spacing:-2px}
.output-hero-unit{font-size:1.5rem;color:#64748b;font-weight:700;margin-left:5px}
.stat-card{background:#fff;border:2px solid #e5e7eb;border-radius:18px;padding:1.25rem 1rem;text-align:center;transition:all .3s ease;height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:800;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:5px}
.stat-card-value{font-size:2rem;font-weight:900;display:block;line-height:1.2}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\protein-intake-calculator.blade.php ENDPATH**/ ?>