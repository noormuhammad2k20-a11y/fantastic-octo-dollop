<div class="row g-4 keto-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Total Fat</label>
                        <div class="input-group">
                            <input type="number" id="keto-f" class="form-control form-control-lg rounded-start-3" value="120" min="0" step="1">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold">grams</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Total Protein</label>
                        <div class="input-group">
                            <input type="number" id="keto-p" class="form-control form-control-lg rounded-start-3" value="30" min="0" step="1">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold">grams</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Net Carbs</label>
                        <div class="input-group">
                            <input type="number" id="keto-c" class="form-control form-control-lg rounded-start-3" value="10" min="0" step="1">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold">grams</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Profiles:</span>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 keto-quick" data-f="120" data-p="60" data-c="20">⚖️ Balanced Keto (1.5:1)</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 keto-quick" data-f="150" data-p="40" data-c="10">🔥 High Performance (3:1)</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 keto-quick" data-f="180" data-p="35" data-c="10">💊 Therapeutic (4:1)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#d97706;--tool-bg:rgba(217,119,6,.06);">
            <div class="output-hero">
                <span class="output-hero-label">CURRENT KETOGENIC RATIO</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-ratio">3.00</span>
                    <span class="output-hero-unit">: 1</span>
                </div>
                <div class="mt-2">
                    <span class="badge rounded-pill px-3 py-2 fw-bold" id="out-status" style="font-size: 0.9rem;">Analysing...</span>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#d97706; background: rgba(217,119,6,.02);">
                        <span class="stat-card-label">TOTAL CALORIES</span>
                        <span class="stat-card-value text-warning" id="out-cals">0</span>
                        <div class="small text-muted fw-bold" id="out-pct-f">0% Fat</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="stat-card" style="border-color:#64748b; background: rgba(100,116,139,.02);">
                        <span class="stat-card-label">MACRONUTRIENT DISTRIBUTION</span>
                        <div class="progress mt-3" style="height: 12px; border-radius: 20px; background: rgba(0,0,0,0.05);">
                            <div id="bar-f" class="progress-bar bg-warning" role="progressbar" style="width: 70%"></div>
                            <div id="bar-p" class="progress-bar bg-primary" role="progressbar" style="width: 25%"></div>
                            <div id="bar-c" class="progress-bar bg-success" role="progressbar" style="width: 5%"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 small fw-bold">
                            <span class="text-warning">Fat</span>
                            <span class="text-primary">Protein</span>
                            <span class="text-success">Carbs</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border" id="out-insights"></div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="keto-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Ratio Report
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="keto-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Nutrition Plan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const fE = $('keto-f'), pE = $('keto-p'), cE = $('keto-c');

    function calculate(){
        const f = parseFloat(fE.value) || 0;
        const p = parseFloat(pE.value) || 0;
        const c = parseFloat(cE.value) || 0;

        const totalCals = (f * 9) + (p * 4) + (c * 4);
        if(totalCals <= 0) return;

        const denom = p + c;
        const ratio = denom > 0 ? (f / denom) : f;
        
        $('out-ratio').textContent = ratio.toFixed(2);
        $('out-cals').textContent = Math.round(totalCals).toLocaleString();
        
        const fPct = ((f * 9) / totalCals) * 100;
        const pPct = ((p * 4) / totalCals) * 100;
        const cPct = ((c * 4) / totalCals) * 100;

        $('out-pct-f').textContent = Math.round(fPct) + '% Calories from Fat';
        $('bar-f').style.width = fPct + '%';
        $('bar-p').style.width = pPct + '%';
        $('bar-c').style.width = cPct + '%';

        // Status Handler
        const st = $('out-status');
        if(ratio < 1.0) {
            st.textContent = 'Non-Ketogenic / Low Carb';
            st.className = 'badge rounded-pill px-3 py-2 fw-bold bg-secondary';
        } else if(ratio < 2.0) {
            st.textContent = 'Mild Ketosis / MAD';
            st.className = 'badge rounded-pill px-3 py-2 fw-bold bg-info';
        } else if(ratio < 4.0) {
            st.textContent = 'Standard Nutritional Ketosis';
            st.className = 'badge rounded-pill px-3 py-2 fw-bold bg-success';
        } else {
            st.textContent = 'Therapeutic Ketosis Range';
            st.className = 'badge rounded-pill px-3 py-2 fw-bold bg-primary';
        }

        // Insights
        const ins = [];
        ins.push(`Your ratio is <strong>${ratio.toFixed(2)}:1</strong>, meaning you consumed ${ratio.toFixed(1)}g of fat for every 1g of protein and carbs combined.`);
        
        if(ratio >= 3.0) {
            ins.push(`<span class="text-primary fw-bold">Tip:</span> This is a high ratio used for therapeutic purposes. Monitor for micronutrient deficiencies.`);
        } else if(ratio >= 1.5) {
            ins.push(`<span class="text-success fw-bold">Tip:</span> Ideal range for weight loss and blood sugar stability.`);
        } else {
            ins.push(`<span class="text-warning fw-bold">Warning:</span> This ratio may be too low to maintain deep ketosis if you are not very active.`);
        }

        $('out-insights').innerHTML = `<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Keto Insights</h6><ul class="list-unstyled mb-0 small">${ins.map(i=>`<li class="mb-1 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [fE, pE, cE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.keto-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            fE.value = btn.dataset.f;
            pE.value = btn.dataset.p;
            cE.value = btn.dataset.c;
            calculate();
        });
    });

    $('keto-copy-btn').addEventListener('click', function(){
        const text = `Ketogenic Ratio Report\nRatio: ${$('out-ratio').textContent}:1\nTotal Calories: ${$('out-cals').textContent}\nMacros: ${fE.value}g Fat | ${pE.value}g Protein | ${cE.value}g Carbs\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Report Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.keto-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.keto-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.keto-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b;letter-spacing:-0.5px}
.keto-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b;line-height:1.5}
.keto-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.keto-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:20px;padding:2rem;box-shadow:0 8px 32px rgba(0,0,0,.06)}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:1px solid rgba(0,0,0,.05);margin-bottom:1.5rem}
.output-hero-label{display:block;font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:2px;color:#64748b;margin-bottom:0.5rem}
.output-hero-value{font-size:4rem;font-weight:900;color:#1e293b;line-height:1;letter-spacing:-2px}
.output-hero-unit{font-size:1.5rem;color:#64748b;font-weight:700;margin-left:5px}
.stat-card{background:#fff;border:2px solid #e5e7eb;border-radius:18px;padding:1.25rem 1rem;text-align:center;transition:all .3s ease;height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:800;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:5px}
.stat-card-value{font-size:2rem;font-weight:900;display:block;line-height:1.2}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\keto-ratio-calculator.blade.php ENDPATH**/ ?>