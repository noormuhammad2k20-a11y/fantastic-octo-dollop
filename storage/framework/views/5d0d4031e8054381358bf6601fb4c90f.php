<div class="row g-4 life-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Gender</label><select id="le-gender" class="form-select form-select-lg rounded-3"><option value="male">♂ Male</option><option value="female">♀ Female</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Current Age</label><input type="number" id="le-age" class="form-control form-control-lg rounded-3" value="30" min="1" max="100"></div>
                    <div class="col-md-4"><label class="form-label-custom">BMI <span class="text-muted">(optional)</span></label><input type="number" id="le-bmi" class="form-control form-control-lg rounded-3" placeholder="e.g. 24" min="10" max="60" step="0.1"></div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Weekly Exercise</label>
                        <div class="d-flex align-items-center gap-3"><input type="range" id="le-exercise" class="form-range flex-grow-1" min="0" max="21" value="3" style="accent-color:#1e40af"><span class="badge rounded-pill px-3 py-2" id="le-ex-val" style="background:#eff6ff;color:#1e40af;font-weight:700;min-width:70px">3 hrs</span></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Alcohol (drinks/week)</label>
                        <div class="d-flex align-items-center gap-3"><input type="range" id="le-alcohol" class="form-range flex-grow-1" min="0" max="30" value="3" style="accent-color:#1e40af"><span class="badge rounded-pill px-3 py-2" id="le-alc-val" style="background:#eff6ff;color:#1e40af;font-weight:700;min-width:70px">3 /wk</span></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Avg Sleep (hrs/night)</label>
                        <div class="d-flex align-items-center gap-3"><input type="range" id="le-sleep" class="form-range flex-grow-1" min="3" max="12" value="7" step="0.5" style="accent-color:#1e40af"><span class="badge rounded-pill px-3 py-2" id="le-sl-val" style="background:#eff6ff;color:#1e40af;font-weight:700;min-width:70px">7 hrs</span></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Lifestyle Factors</label>
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="le-smoker"><label class="form-check-label small fw-bold" for="le-smoker">Regular Smoker (−10 yrs)</label></div>
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="le-diet" checked><label class="form-check-label small fw-bold" for="le-diet">Balanced Diet (+2 yrs)</label></div>
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="le-family"><label class="form-check-label small fw-bold" for="le-family">Family History of Longevity (+3 yrs)</label></div>
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="le-chronic"><label class="form-check-label small fw-bold" for="le-chronic">Chronic Condition (−5 yrs)</label></div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 le-quick" data-v='{"gender":"male","age":35,"exercise":7,"alcohol":1,"sleep":8,"smoker":false,"diet":true,"family":true,"chronic":false}'>🏃 Health-Conscious</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 le-quick" data-v='{"gender":"male","age":40,"exercise":1,"alcohol":10,"sleep":6,"smoker":true,"diet":false,"family":false,"chronic":false}'>🪑 Sedentary</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 le-quick" data-v='{"gender":"male","age":30,"exercise":3,"alcohol":3,"sleep":7,"smoker":false,"diet":true,"family":false,"chronic":false}'>🔬 Reset</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:220;--tool-color:#1e40af;--tool-bg:rgba(30,64,175,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Estimated Life Expectancy</span>
                <div class="output-hero-value" id="out-le">81</div>
                <span class="output-hero-unit">years</span>
            </div>
            <div class="row g-3 mt-3">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Years Remaining</span><span class="stat-card-value" id="out-le-rem">51</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Life Progress</span><span class="stat-card-value" id="out-le-pct">37%</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">vs National Avg</span><span class="stat-card-value" id="out-le-diff">+5</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-2"><i class="fas fa-chart-line me-2 text-primary"></i>Life Progress</h6>
            <div class="progress rounded-pill mb-1" style="height:14px;background:#f1f5f9"><div id="out-le-bar" class="progress-bar rounded-pill" style="width:37%;background:linear-gradient(90deg,#60a5fa,#1e40af);transition:width .6s"></div></div>
            <div class="d-flex justify-content-between small text-muted px-1"><span>Birth</span><span id="out-le-mid">40</span><span id="out-le-end">81</span></div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-plus-minus me-2 text-primary"></i>Impact Breakdown</h6>
            <div class="table-responsive"><table class="table table-sm table-bordered text-center small mb-0" id="out-le-factors"><thead class="table-light"><tr><th>Factor</th><th>Impact</th></tr></thead><tbody></tbody></table></div>

            <div class="mt-4" id="out-le-insights"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="le-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-heart me-2"></i>Save Health Outlook</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const els = {gender:$('le-gender'),age:$('le-age'),bmi:$('le-bmi'),exercise:$('le-exercise'),alcohol:$('le-alcohol'),sleep:$('le-sleep'),smoker:$('le-smoker'),diet:$('le-diet'),family:$('le-family'),chronic:$('le-chronic')};

    function calculate(){
        const g=els.gender.value, age=parseInt(els.age.value)||30, bmi=parseFloat(els.bmi.value)||0;
        const ex=parseFloat(els.exercise.value)||0, alc=parseFloat(els.alcohol.value)||0, sl=parseFloat(els.sleep.value)||7;
        const smoke=els.smoker.checked, diet=els.diet.checked, fam=els.family.checked, chronic=els.chronic.checked;

        $('le-ex-val').textContent=ex+' hrs'; $('le-alc-val').textContent=alc+' /wk'; $('le-sl-val').textContent=sl+' hrs';

        const natAvg = g==='female'?81:76;
        let base = natAvg;
        const factors = [];

        // Exercise
        if(ex<1){base-=5;factors.push({f:'No Exercise',v:'-5 yrs'});}
        else if(ex>=7){base+=4;factors.push({f:'High Exercise (7+ hrs)',v:'+4 yrs'});}
        else if(ex>=3){base+=2;factors.push({f:'Regular Exercise (3+ hrs)',v:'+2 yrs'});}
        else{factors.push({f:'Light Exercise',v:'±0'});}

        if(smoke){base-=10;factors.push({f:'Regular Smoking',v:'-10 yrs'});}
        else{factors.push({f:'Non-Smoker',v:'±0'});}

        if(diet){base+=2;factors.push({f:'Balanced Diet',v:'+2 yrs'});}
        if(fam){base+=3;factors.push({f:'Family Longevity',v:'+3 yrs'});}
        if(chronic){base-=5;factors.push({f:'Chronic Condition',v:'-5 yrs'});}

        // Alcohol
        if(alc>14){base-=4;factors.push({f:'Heavy Drinking (14+)',v:'-4 yrs'});}
        else if(alc>7){base-=2;factors.push({f:'Moderate Drinking',v:'-2 yrs'});}
        else if(alc>0){base+=1;factors.push({f:'Light Drinking',v:'+1 yr'});}

        // Sleep
        if(sl<6){base-=3;factors.push({f:'Sleep Deprivation (<6h)',v:'-3 yrs'});}
        else if(sl>9){base-=1;factors.push({f:'Excessive Sleep (>9h)',v:'-1 yr'});}
        else if(sl>=7&&sl<=8){base+=1;factors.push({f:'Optimal Sleep (7-8h)',v:'+1 yr'});}

        // BMI
        if(bmi>0){
            if(bmi>=35){base-=5;factors.push({f:'BMI ≥35 (Obese II+)',v:'-5 yrs'});}
            else if(bmi>=30){base-=3;factors.push({f:'BMI 30-34.9 (Obese)',v:'-3 yrs'});}
            else if(bmi>=25){base-=1;factors.push({f:'BMI 25-29.9 (Overweight)',v:'-1 yr'});}
            else if(bmi<18.5){base-=2;factors.push({f:'BMI <18.5 (Underweight)',v:'-2 yrs'});}
            else{factors.push({f:'BMI 18.5-24.9 (Healthy)',v:'±0'});}
        }

        const remaining = Math.max(0, base - age);
        const pct = Math.min(100,(age/base)*100);

        $('out-le').textContent = base;
        $('out-le-rem').textContent = remaining;
        $('out-le-pct').textContent = Math.round(pct)+'%';
        $('out-le-bar').style.width = pct+'%';
        $('out-le-mid').textContent = Math.round(base/2);
        $('out-le-end').textContent = base;

        const diff = base - natAvg;
        $('out-le-diff').textContent = (diff>=0?'+':'')+diff+' yrs';
        $('out-le-diff').style.color = diff>=0?'#059669':'#dc2626';

        $('out-le-factors').querySelector('tbody').innerHTML = factors.map(f=>{
            const clr = f.v.startsWith('+')?'text-success':(f.v.startsWith('-')?'text-danger':'');
            return `<tr><td class="text-start">${f.f}</td><td class="fw-bold ${clr}">${f.v}</td></tr>`;
        }).join('');

        $('out-le-insights').innerHTML = `<h6 class="fw-bold mb-3"><i class="fas fa-dna me-2 text-primary"></i>Key Insights</h6><ul class="list-unstyled mb-0 small text-secondary"><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Biological baseline for ${g}: <strong>${natAvg} years</strong>.</li><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>${smoke?'Smoking reduces your expectancy by approximately <strong>10 years</strong>.':'Non-smoker status significantly improves your longevity.'}</li><li><i class="fas fa-check-circle text-success me-2"></i>${ex>=3?'Regular exercise is adding quality years to your life.':'Increasing to 3+ hrs/week of exercise could add 2-4 years.'}</li></ul>`;
    }

    Object.values(els).forEach(e=>e.addEventListener('input',calculate));
    Object.values(els).forEach(e=>{if(e.type==='checkbox')e.addEventListener('change',calculate)});

    document.querySelectorAll('.le-quick').forEach(btn=>{btn.addEventListener('click',()=>{
        const v=JSON.parse(btn.dataset.v);
        els.gender.value=v.gender;els.age.value=v.age;els.exercise.value=v.exercise;
        els.alcohol.value=v.alcohol;els.sleep.value=v.sleep;
        els.smoker.checked=v.smoker;els.diet.checked=v.diet;els.family.checked=v.family;els.chronic.checked=v.chronic;
        calculate();
    })});

    $('le-copy').addEventListener('click',function(){
        const text=`Longevity Outlook\nEstimated Lifespan: ${$('out-le').textContent} years\nYears Remaining: ${$('out-le-rem').textContent}\n— ToolsHub Longevity`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Saved!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>
<style>
.life-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.life-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.life-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.life-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.life-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.life-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\life-expectancy-calculator.blade.php ENDPATH**/ ?>