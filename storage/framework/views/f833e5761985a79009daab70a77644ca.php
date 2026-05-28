<div class="row g-4 preg-weight-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Pre-Pregnancy Weight</label>
                        <div class="input-group">
                            <input type="number" id="preg-start-weight" class="form-control form-control-lg rounded-start-3" value="65">
                            <select id="preg-unit" class="form-select rounded-end-3" style="max-width: 80px;">
                                <option value="kg">kg</option>
                                <option value="lb">lb</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Height (<span class="unit-h">cm</span>)</label>
                        <input type="number" id="preg-height" class="form-control form-control-lg rounded-3" value="165">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Pregnancy Week</label>
                        <input type="number" id="preg-week" class="form-control form-control-lg rounded-3" value="20" min="1" max="42">
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Weight (<span class="unit-w">kg</span>)</label>
                        <input type="number" id="preg-current-weight" class="form-control form-control-lg rounded-3" value="70">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Pregnancy Type</label>
                        <select id="preg-multi" class="form-select form-select-lg rounded-3">
                            <option value="single" selected>Single Baby</option>
                            <option value="twins">Twins (Multi-gestation)</option>
                        </select>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 preg-quick" data-w="20">🤰 Mid-Term (20w)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 preg-quick" data-w="36">👶 Near-Term (36w)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="preg-reset" style="min-width: 280px; max-width: 100%;">Reset Tracker</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="preg-theme" style="--tool-hue:330;--tool-color:#ec4899;--tool-bg:rgba(236,72,153,.06);">
            <div class="output-hero">
                <span class="output-hero-label">CURRENT WEIGHT GAIN</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-gain">5.0</span>
                    <span class="output-hero-unit" id="out-unit">kg</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;">Calculating Track...</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#ec4899; background: #fff;">
                        <span class="stat-card-label">RECOMMENDED TOTAL GAIN</span>
                        <span class="stat-card-value" id="out-recom-total" style="font-size: 1.4rem;">11.5 - 16 kg</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#1e293b; background: #fff;">
                        <span class="stat-card-label">IDEAL GAIN @ WEEK <span id="out-week-num">20</span></span>
                        <span class="stat-card-value" id="out-ideal-now" style="font-size: 1.4rem;">4.5 - 6.2 kg</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6; background: #fff;">
                        <span class="stat-card-label">BASE BMI STATUS</span>
                        <span class="stat-card-value" id="out-bmi-cat" style="font-size: 1.2rem;">Normal</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-notes-medical text-pink-500 me-2" style="color:#ec4899"></i>Trimester Progress Advice
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="preg-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Progress Report
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="preg-share-btn" style="min-width: 280px; max-width: 100%;">
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
    const startWE = $('preg-start-weight'), curWE = $('preg-current-weight'),
          heightE = $('preg-height'), weekE = $('preg-week'),
          unitE = $('preg-unit'), multiE = $('preg-multi');

    let units = 'kg';

    function calculate(){
        let startW = parseFloat(startWE.value) || 0;
        let curW = parseFloat(curWE.value) || 0;
        let h = parseFloat(heightE.value) || 0;
        let wk = Math.min(42, Math.max(1, parseInt(weekE.value) || 0));
        units = unitE.value;

        if(startW <= 0 || h <= 0) return;

        // Calc Base BMI
        let hM = (units === 'kg') ? h/100 : (h*0.0254);
        let wKg = (units === 'kg') ? startW : (startW * 0.453592);
        let bmi = wKg / (hM * hM);

        let gain = curW - startW;
        $('out-gain').textContent = gain.toFixed(1);
        $('out-unit').textContent = units;
        $('out-week-num').textContent = wk;

        // Recommendations (IOM Standards)
        let totalMin, totalMax, rate;
        let cat = '';

        if(multiE.value === 'single'){
            if(bmi < 18.5) { cat='Underweight'; totalMin=12.5; totalMax=18; rate=0.51; }
            else if(bmi < 25) { cat='Normal'; totalMin=11.5; totalMax=16; rate=0.42; }
            else if(bmi < 30) { cat='Overweight'; totalMin=7; totalMax=11.5; rate=0.28; }
            else { cat='Obese'; totalMin=5; totalMax=9; rate=0.22; }
        } else {
            // Twins
            if(bmi < 25) { cat='Normal'; totalMin=17; totalMax=25; rate=0.68; }
            else if(bmi < 30) { cat='Overweight'; totalMin=14; totalMax=23; rate=0.57; }
            else { cat='Obese'; totalMin=11; totalMax=19; rate=0.46; }
        }

        $('out-bmi-cat').textContent = cat;

        // Imperial conversion for total
        const factor = (units === 'kg') ? 1 : 2.20462;
        $('out-recom-total').textContent = `${(totalMin * factor).toFixed(1)} - ${(totalMax * factor).toFixed(1)} ${units}`;

        // Ideal now
        let idealNowMin = 1.0; // Trimester 1 approx
        let idealNowMax = 2.0;
        if(wk > 12) {
            idealNowMin += (wk - 12) * (rate - 0.05); // Rough bracket
            idealNowMax += (wk - 12) * (rate + 0.05);
        }
        
        $('out-ideal-now').textContent = `${(idealNowMin * factor).toFixed(1)} - ${(idealNowMax * factor).toFixed(1)} ${units}`;

        // Status
        let status = '', hue = 330, color = '#ec4899';
        if(gain < (idealNowMin * factor) - 1) { status = 'Support Needed (Low Gain)'; hue = 45; color = '#f59e0b'; }
        else if(gain > (idealNowMax * factor) + 1) { status = 'Caution (High Gain)'; hue = 0; color = '#ef4444'; }
        else { status = 'Healthy Progression'; hue = 140; color = '#10b981'; }

        const outStatus = $('out-status');
        outStatus.textContent = status;
        outStatus.style.color = color;
        
        $('preg-theme').style.setProperty('--tool-hue', hue);
        $('preg-theme').style.setProperty('--tool-color', color);

        // Insights
        const ins = [];
        if(wk <= 12) ins.push('Trimester 1: Focus on nutrient-dense foods. Minimal weight gain (1-2kg) is expected.');
        else if (wk <= 27) ins.push('Trimester 2: Baby is growing rapidly. A steady gain of approx 0.3-0.5kg per week is standard.');
        else ins.push('Trimester 3: Growth peaks. Continue monitoring swellings and consult your midwife for any sudden changes.');
        
        if(status.includes('High')) ins.push('Slightly higher weight gain is common, but manage processed sugar intake to reduce Gestational Diabetes risk.');
        
        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-pink-500 me-2 mt-1" style="color:#ec4899"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [startWE, curWE, heightE, weekE, unitE, multiE].forEach(el => el.addEventListener('input', calculate));

    $('unit-unit')?.addEventListener('change', ()=>{
        units = unitE.value;
        const factor = (units === 'kg') ? 0.453592 : 2.20462;
        const hFactor = (units === 'kg') ? 2.54 : 1/2.54;
        
        startWE.value = (startWE.value * factor).toFixed(1);
        curWE.value = (curWE.value * factor).toFixed(1);
        heightE.value = (heightE.value * hFactor).toFixed(1);
        
        document.querySelectorAll('.unit-h').forEach(e => e.textContent = (units === 'kg' ? 'cm' : 'in'));
        document.querySelectorAll('.unit-w').forEach(e => e.textContent = units);
        calculate();
    });

    document.querySelectorAll('.preg-quick').forEach(btn => {
        btn.onclick = () => { weekE.value = btn.dataset.w; calculate(); };
    });

    $('preg-reset').onclick = () => {
        weekE.value = 20; startWE.value = 65; curWE.value = 70; heightE.value = 165; 
        calculate();
    };

    $('preg-copy-btn').onclick = function(){
        const text = `Pregnancy Progress Report (Week ${weekE.value})\nTotal Gain: ${$('out-gain').textContent} ${units}\nStatus: ${$('out-status').textContent}\nIdeal for now: ${$('out-ideal-now').textContent}\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.preg-weight-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(236,72,153,.05)}
.preg-weight-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.preg-weight-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.preg-weight-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.preg-weight-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.preg-weight-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.4rem;font-weight:800;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .preg-weight-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\pregnancy-weight-tracker.blade.php ENDPATH**/ ?>