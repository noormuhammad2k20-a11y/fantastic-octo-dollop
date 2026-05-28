<div class="row g-4 cd-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Maintenance Calories (TDEE)</label>
                        <div class="input-group">
                            <input type="number" id="cd-tdee" class="form-control form-control-lg rounded-start-3" value="2500">
                            <span class="input-group-text rounded-end-3 fw-bold small">kcal / day</span>
                        </div>
                        <div class="mt-2">
                            <small class="text-muted">Not sure? Use the <a href="<?php echo e(url('/bmr-calculator-pro')); ?>" class="text-decoration-none text-primary fw-bold">BMR Pro</a> tool first.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Target Loss Velocity</label>
                        <select id="cd-goal" class="form-select form-select-lg rounded-3">
                            <option value="0.25">0.25 kg / week (Gentle)</option>
                            <option value="0.5" selected>0.50 kg / week (Recommended)</option>
                            <option value="0.75">0.75 kg / week (Moderate)</option>
                            <option value="1.0">1.00 kg / week (Aggressive)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Protein Strategy</label>
                        <select id="cd-protein" class="form-select form-select-lg rounded-3">
                            <option value="standard">Standard (0.8g per lb)</option>
                            <option value="high" selected>High Protein (1.2g per lb - Body Recomp)</option>
                        </select>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Deficit Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cd-quick" data-t="2000" data-g="0.5">📉 -500 kcal (Std)</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 cd-quick" data-t="3000" data-g="1.0">🔥 -1000 kcal (Max)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="cd-reset" style="min-width: 280px; max-width: 100%;">Reset Fields</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="cd-theme" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.06);">
            <div class="output-hero">
                <span class="output-hero-label">TARGET INTAKE FOR LOSS</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-target">1,950</span>
                    <span class="output-hero-unit">kcal / day</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-velocity" style="letter-spacing:1px; color:#10b981">Phase 1: Sustainable Reduction</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: #fff;">
                        <span class="stat-card-label">DAILY DEFICIT</span>
                        <span class="stat-card-value text-danger" id="out-deficit">-550 kcal</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#1e293b; background: #fff;">
                        <span class="stat-card-label">EST. FAT LOSS / MONTH</span>
                        <span class="stat-card-value text-dark" id="out-monthly">~2.2 kg</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6; background: #fff;">
                        <span class="stat-card-label">EST. PROTEIN TARGET</span>
                        <span class="stat-card-value text-primary" id="out-protein">180g / day</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-lightbulb text-success me-2"></i>Fat Loss Scientific Guidelines
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cd-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Macros & Deficit
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cd-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Plan
                    </button>
                </div>
            </div>
            
            <div id="cd-warning" class="alert alert-warning mt-4 d-none mb-0 rounded-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Metabolic Warning:</strong> This deficit drops your intake below the recommended nutritional floor (1200 kcal).
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const tdeeE = $('cd-tdee'), goalE = $('cd-goal'), proteinE = $('cd-protein');

    function calculate(){
        let tdee = parseFloat(tdeeE.value) || 0;
        let goal = parseFloat(goalE.value) || 0;
        
        if(tdee <= 0) return;

        // 1kg of fat ≈ 7700 calories
        let dailyDeficit = (goal * 7700) / 7;
        let target = tdee - dailyDeficit;

        const fmt = n => Math.round(n).toLocaleString();
        
        $('out-target').textContent = fmt(target);
        $('out-deficit').textContent = '-' + fmt(dailyDeficit) + ' kcal';
        $('out-monthly').textContent = '~' + (goal * 4.3).toFixed(1) + ' kg';
        
        // Protein (Simple estimate based on TDEE/Activity)
        let prot = (tdee / 14); // Baseline
        if(proteinE.value === 'high') prot *= 1.3;
        $('out-protein').textContent = Math.round(prot) + 'g / day';

        // Warning
        $('cd-warning').classList.toggle('d-none', target >= 1200);

        // Insights
        const ins = [];
        ins.push(`To maintain this deficit, aim for <strong>${fmt(target)} calories</strong> across 3-4 structured meals.`);
        ins.push('Sustainable weight loss is defined as 0.5% - 1.0% of body weight per week.');
        if(goal >= 0.75) ins.push('Moderate to high deficits require higher protein intake to prevent muscle lean mass loss.');
        
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [tdeeE, goalE, proteinE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.cd-quick').forEach(btn => {
        btn.onclick = () => {
            tdeeE.value = btn.dataset.t;
            goalE.value = btn.dataset.g;
            calculate();
        };
    });

    $('cd-reset').onclick = () => {
        tdeeE.value = 2500; goalE.value = 0.5; calculate();
    };

    $('cd-copy-btn').onclick = function(){
        const text = `Weight Loss Strategy\nTarget: ${$('out-target').textContent} kcal/day\nDaily Deficit: ${$('out-deficit').textContent}\nProtein Goal: ${$('out-protein').textContent}\nGenerated by ToolsHub Optimizer`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Strategy Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.cd-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(16,185,129,.05)}
.cd-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.cd-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.cd-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.cd-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.cd-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .cd-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\calorie-deficit-calculator.blade.php ENDPATH**/ ?>