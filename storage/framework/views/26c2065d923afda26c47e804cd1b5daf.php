<div class="row g-4 strength-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Exercise</label><select id="str-exercise" class="form-select form-select-lg rounded-3"><option value="bench">Bench Press</option><option value="squat">Back Squat</option><option value="deadlift">Deadlift</option><option value="ohp">Overhead Press</option><option value="row">Barbell Row</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Weight Lifted</label><div class="input-group"><input type="number" id="str-weight" class="form-control form-control-lg rounded-start-3" value="100" min="1" step="0.5"><select id="str-unit" class="form-select rounded-end-3" style="max-width:80px"><option value="kg">kg</option><option value="lb">lb</option></select></div></div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Reps Performed</label>
                        <div class="d-flex align-items-center gap-3"><input type="range" id="str-reps" class="form-range flex-grow-1" min="1" max="12" value="5" style="accent-color:#475569"><span class="badge rounded-pill px-3 py-2 bg-secondary" id="str-reps-val" style="min-width:60px">5</span></div>
                    </div>
                    <div class="col-md-4"><label class="form-label-custom">Gender</label><select id="str-gender" class="form-select form-select-lg rounded-3"><option value="male">♂ Male</option><option value="female">♀ Female</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Body Weight</label><input type="number" id="str-bw" class="form-control form-control-lg rounded-3" value="80" min="30" step="0.5"></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 str-quick" data-v='{"exercise":"bench","weight":100,"reps":5,"unit":"kg"}'>🏋️ Bench 100kg×5</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 str-quick" data-v='{"exercise":"squat","weight":140,"reps":5,"unit":"kg"}'>🏋️ Squat 140kg×5</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 str-quick" data-v='{"exercise":"deadlift","weight":180,"reps":3,"unit":"kg"}'>🏋️ Deadlift 180kg×3</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 str-quick" data-v='{"exercise":"ohp","weight":60,"reps":8,"unit":"kg"}'>🏋️ OHP 60kg×8</button>
                </div>
                <div class="mt-3 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-flask text-secondary me-1"></i> <strong>Brzycki Formula:</strong> <code>1RM = Weight × (36 / (37 − Reps))</code> — globally recognized for reps ≤ 12.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:215;--tool-color:#334155;--tool-bg:rgba(71,85,105,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Estimated 1-Rep Max</span>
                <div class="output-hero-value" id="out-str-1rm">112</div>
                <span class="output-hero-unit" id="out-str-unit-label">kg</span>
            </div>
            <div class="row g-3 mt-3">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Relative Strength</span><span class="stat-card-value" id="out-str-rel">1.40×</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Strength Level</span><span class="stat-card-value" id="out-str-level">Intermediate</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Wilks-Style Score</span><span class="stat-card-value" id="out-str-wilks">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Percentage-Based Training Chart</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center small mb-0" id="out-str-chart">
                    <thead class="table-light"><tr><th>%1RM</th><th>Weight</th><th>Zone</th><th>Reps</th></tr></thead>
                    <tbody></tbody>
                </table>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-ranking-star me-2 text-warning"></i>Strength Standards</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center small mb-0" id="out-str-standards">
                    <thead class="table-light"><tr><th>Level</th><th>Multiplier (×BW)</th><th>Target 1RM</th><th>Status</th></tr></thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="mt-4" id="out-str-insights"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="str-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Strength Profile</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const exerciseEl=$('str-exercise'),weightEl=$('str-weight'),repsEl=$('str-reps'),unitEl=$('str-unit'),genderEl=$('str-gender'),bwEl=$('str-bw'),repsVal=$('str-reps-val');

    // Standards: multiplier of bodyweight for each level (male bench as baseline)
    const standards = {
        bench:  {male:[0.5,0.75,1.0,1.25,1.5,2.0], female:[0.25,0.5,0.65,0.85,1.0,1.25]},
        squat:  {male:[0.75,1.0,1.25,1.5,2.0,2.5], female:[0.5,0.65,0.85,1.0,1.25,1.5]},
        deadlift:{male:[1.0,1.25,1.5,2.0,2.5,3.0], female:[0.65,0.85,1.0,1.25,1.5,2.0]},
        ohp:    {male:[0.35,0.5,0.65,0.85,1.0,1.25], female:[0.2,0.35,0.5,0.6,0.75,0.9]},
        row:    {male:[0.5,0.65,0.85,1.0,1.25,1.5], female:[0.3,0.45,0.6,0.75,0.9,1.1]}
    };
    const levelNames=['Beginner','Novice','Intermediate','Advanced','Elite','World Class'];

    function calculate(){
        const w=parseFloat(weightEl.value)||0, r=parseInt(repsEl.value)||1, u=unitEl.value;
        const bw=parseFloat(bwEl.value)||80, g=genderEl.value, ex=exerciseEl.value;
        repsVal.textContent=r;
        $('out-str-unit-label').textContent=u;

        if(w<=0) return;
        const oneRM = w * (36 / (37 - r));
        $('out-str-1rm').textContent = Math.round(oneRM);

        // Relative strength
        const rel = oneRM / bw;
        $('out-str-rel').textContent = rel.toFixed(2)+'×';

        // Strength level
        const stds = standards[ex][g];
        let levelIdx = 0;
        for(let i=stds.length-1;i>=0;i--){if(rel>=stds[i]){levelIdx=i;break}}
        $('out-str-level').textContent = levelNames[levelIdx];

        // Simplified Wilks-style score
        const wilksCoeff = g==='male'? (500/(1+0.003*(bw-80))) : (500/(1+0.004*(bw-60)));
        const wilks = Math.round((oneRM / bw) * wilksCoeff / 10);
        $('out-str-wilks').textContent = wilks;

        // Training Chart
        const zones=[
            {pct:100,zone:'Max',reps:'1'},
            {pct:95,zone:'Power',reps:'1-2'},
            {pct:90,zone:'Strength',reps:'2-3'},
            {pct:85,zone:'Strength',reps:'3-5'},
            {pct:80,zone:'Strength-Hyp',reps:'5-6'},
            {pct:75,zone:'Hypertrophy',reps:'8-10'},
            {pct:70,zone:'Hypertrophy',reps:'10-12'},
            {pct:65,zone:'Endurance',reps:'12-15'},
            {pct:60,zone:'Endurance',reps:'15-20'},
            {pct:50,zone:'Warm-Up',reps:'20+'}
        ];
        $('out-str-chart').querySelector('tbody').innerHTML = zones.map(z=>{
            const clr=z.pct>=90?'table-danger':z.pct>=75?'table-warning':z.pct>=60?'table-info':'table-light';
            return `<tr class="${clr}"><td>${z.pct}%</td><td class="fw-bold">${Math.round(oneRM*z.pct/100)} ${u}</td><td>${z.zone}</td><td>${z.reps}</td></tr>`;
        }).join('');

        // Standards table
        $('out-str-standards').querySelector('tbody').innerHTML = stds.map((s,i)=>{
            const target = Math.round(s*bw);
            const reached = rel >= s;
            return `<tr class="${reached?'table-success':''}"><td>${levelNames[i]}</td><td>${s.toFixed(2)}×</td><td>${target} ${u}</td><td>${reached?'✅ Achieved':'—'}</td></tr>`;
        }).join('');

        $('out-str-insights').innerHTML=`<h6 class="fw-bold mb-3"><i class="fas fa-trophy me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small text-secondary"><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Predicted 1RM: <strong>${Math.round(oneRM)} ${u}</strong> (${rel.toFixed(2)}× bodyweight)</li><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Strength Level: <strong>${levelNames[levelIdx]}</strong> for ${ex.replace(/^\w/,c=>c.toUpperCase())}</li><li><i class="fas fa-check-circle text-success me-2"></i>${levelIdx<3?'To reach '+levelNames[levelIdx+1]+', target <strong>'+Math.round(stds[levelIdx+1]*bw)+' '+u+'</strong> for 1RM.':'Impressive performance! You are at an advanced level.'}</li></ul>`;
    }

    [exerciseEl,weightEl,repsEl,unitEl,genderEl,bwEl].forEach(e=>e.addEventListener('input',calculate));

    document.querySelectorAll('.str-quick').forEach(btn=>{btn.addEventListener('click',()=>{
        const v=JSON.parse(btn.dataset.v);exerciseEl.value=v.exercise;weightEl.value=v.weight;repsEl.value=v.reps;unitEl.value=v.unit;repsVal.textContent=v.reps;calculate();
    })});

    $('str-copy').addEventListener('click',function(){
        const text=`Strength Profile\n1RM: ${$('out-str-1rm').textContent} ${unitEl.value}\nRel. Strength: ${$('out-str-rel').textContent}\nLevel: ${$('out-str-level').textContent}\n— ToolsHub Strength`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>
<style>
.strength-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.strength-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.strength-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.strength-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.strength-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.strength-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\strength-standards-calculator.blade.php ENDPATH**/ ?>