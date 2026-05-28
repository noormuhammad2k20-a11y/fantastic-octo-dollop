<div class="row g-4 steps-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Steps</label>
                        <input type="number" id="st-steps" class="form-control form-control-lg rounded-3" value="10000" min="0" step="100">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Your Height (cm)</label>
                        <input type="number" id="st-height" class="form-control form-control-lg rounded-3" value="175" min="50" max="250">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Gender</label>
                        <select id="st-gender" class="form-select form-select-lg rounded-3"><option value="male">♂ Male</option><option value="female">♀ Female</option></select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Pace Type</label>
                        <select id="st-pace" class="form-select form-select-lg rounded-3">
                            <option value="walk" selected>🚶 Walking</option>
                            <option value="jog">🏃 Jogging</option>
                            <option value="run">💨 Running</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Weight (kg) <span class="text-muted small">for cal burn</span></label>
                        <input type="number" id="st-weight" class="form-control form-control-lg rounded-3" value="75" min="30" max="200" step="0.5">
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">Manual Stride Adjustment</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" id="st-stride-mod" class="form-range flex-grow-1" min="-15" max="15" value="0" step="0.5" style="accent-color:#f59e0b">
                            <span class="badge rounded-pill px-3 py-2" id="st-stride-val" style="background:#fffbeb;color:#d97706;font-weight:700;min-width:80px">±0 cm</span>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mt-1"><span>Shorter stride</span><span>Longer stride</span></div>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 st-quick" data-steps="5000">🚶 5,000 Steps</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 st-quick" data-steps="10000">🚶 10,000 Steps</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 st-quick" data-steps="15000">🏃 15,000 Steps</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 st-quick" data-steps="20000">💨 20,000 Steps</button>
                </div>
                <div class="mt-3 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-person-walking text-warning me-1"></i> Stride length ≈ <strong>41.5%</strong> of height (walking). Jogging increases stride by ~20%, running by ~40%.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:38;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Distance</span>
                <div class="output-hero-value" id="out-st-km">7.26</div>
                <span class="output-hero-unit">kilometers</span>
            </div>
            <div class="row g-3 mt-3">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Miles</span><span class="stat-card-value" id="out-st-mi">4.51</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Meters</span><span class="stat-card-value" id="out-st-m">7,263</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Stride Length</span><span class="stat-card-value" id="out-st-stride">72.6 cm</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card" style="border-color:#ef4444"><span class="stat-card-label">Calories Burned</span><span class="stat-card-value text-danger" id="out-st-cal">350</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-2"><i class="fas fa-bullseye me-2 text-warning"></i>Daily Goal (10,000 Steps)</h6>
            <div class="d-flex justify-content-between mb-1"><span class="small fw-bold text-muted">Progress</span><span class="small fw-bold" id="out-st-pct" style="color:#d97706">100%</span></div>
            <div class="progress rounded-pill" style="height:14px;background:#f1f5f9"><div id="out-st-bar" class="progress-bar rounded-pill" style="width:100%;background:linear-gradient(90deg,#fbbf24,#f59e0b);transition:width .5s"></div></div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-clock me-2 text-primary"></i>Estimated Walking Time</h6>
            <div class="row g-3">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Walking</span><span class="stat-card-value" id="out-st-walk-time">—</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Jogging</span><span class="stat-card-value" id="out-st-jog-time">—</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Running</span><span class="stat-card-value" id="out-st-run-time">—</span></div></div>
            </div>

            <div class="mt-4" id="out-st-insights"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="st-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Exercise Stats</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const stepsEl=$('st-steps'),heightEl=$('st-height'),genderEl=$('st-gender'),paceEl=$('st-pace'),weightEl=$('st-weight'),strideModEl=$('st-stride-mod');
    const paceMultiplier={walk:1,jog:1.2,run:1.4};
    const metValues={walk:3.5,jog:7.0,run:10.0};
    const speedKph={walk:5,jog:8,run:12};

    function fmtTime(mins){const h=Math.floor(mins/60),m=Math.round(mins%60);return h>0?h+'h '+m+'m':m+'m';}

    function calculate(){
        const steps=parseInt(stepsEl.value)||0, height=parseFloat(heightEl.value)||175;
        const gender=genderEl.value, pace=paceEl.value, weight=parseFloat(weightEl.value)||75;
        const strideMod=parseFloat(strideModEl.value)||0;
        $('st-stride-val').textContent=(strideMod>=0?'+':'')+strideMod+' cm';

        const baseFactor=gender==='male'?0.415:0.413;
        const baseStride=height*baseFactor*paceMultiplier[pace];
        const finalStride=baseStride+strideMod;
        const distM=steps*finalStride/100;
        const distKm=distM/1000;
        const distMi=distKm*0.621371;

        // Calorie burn: MET * weight * duration_hours
        const durationHrs = distKm / speedKph[pace];
        const calories = metValues[pace] * weight * durationHrs;

        $('out-st-km').textContent=distKm.toFixed(2);
        $('out-st-mi').textContent=distMi.toFixed(2);
        $('out-st-m').textContent=Math.round(distM).toLocaleString();
        $('out-st-stride').textContent=finalStride.toFixed(1)+' cm';
        $('out-st-cal').textContent=Math.round(calories);

        const pct=Math.min(100,(steps/10000)*100);
        $('out-st-pct').textContent=Math.round(pct)+'%';
        $('out-st-bar').style.width=pct+'%';

        // Time estimates for all modes
        ['walk','jog','run'].forEach(p=>{
            const stride=height*baseFactor*paceMultiplier[p];
            const d=steps*stride/100/1000;
            const t=(d/speedKph[p])*60;
            $('out-st-'+p+'-time').textContent=fmtTime(t);
        });

        const cat=steps>=12000?'Highly Active':steps>=10000?'Active':steps>=7500?'Somewhat Active':steps>=5000?'Low Active':'Sedentary';
        $('out-st-insights').innerHTML=`<h6 class="fw-bold mb-3"><i class="fas fa-fire-flame-curved me-2 text-primary"></i>Activity Analysis</h6><ul class="list-unstyled mb-0 small text-secondary"><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Activity Level: <strong>${cat}</strong></li><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Est. Calories Burned: <strong>${Math.round(calories)} kcal</strong></li><li><i class="fas fa-check-circle text-success me-2"></i>${steps<10000?'Walk <strong>'+(10000-steps).toLocaleString()+'</strong> more steps to hit your daily target!':'🎉 You hit the 10,000-step goal! Keep it up!'}</li></ul>`;
    }

    [stepsEl,heightEl,genderEl,paceEl,weightEl,strideModEl].forEach(e=>e.addEventListener('input',calculate));
    document.querySelectorAll('.st-quick').forEach(btn=>{btn.addEventListener('click',()=>{stepsEl.value=btn.dataset.steps;calculate()})});
    $('st-copy').addEventListener('click',function(){
        const text=`Exercise Report\nSteps: ${stepsEl.value}\nDistance: ${$('out-st-km').textContent} km (${$('out-st-mi').textContent} mi)\nCalories: ${$('out-st-cal').textContent} kcal\n— ToolsHub Fitness`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>
<style>
.steps-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.steps-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.steps-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.steps-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.steps-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.steps-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\steps-to-distance-calculator.blade.php ENDPATH**/ ?>