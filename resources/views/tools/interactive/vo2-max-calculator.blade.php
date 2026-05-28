<div class="row g-4 vo2-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Test Method</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-vo2 active flex-grow-1" data-method="hr">❤️ Heart Rate Ratio</button>
                        <button type="button" class="btn btn-outline-vo2 flex-grow-1" data-method="cooper">🏃 Cooper 12-Min Test</button>
                        <button type="button" class="btn btn-outline-vo2 flex-grow-1" data-method="mile">🏁 1.5-Mile Run</button>
                    </div>
                </div>
                <div id="vo2-hr-inputs">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label-custom">Resting Heart Rate (BPM)</label><input type="number" id="vo2-rest-hr" class="form-control form-control-lg rounded-3" value="65" min="30" max="150"></div>
                        <div class="col-md-6"><label class="form-label-custom">Max Heart Rate (BPM)</label><input type="number" id="vo2-max-hr" class="form-control form-control-lg rounded-3" value="185" min="100" max="250"></div>
                    </div>
                </div>
                <div id="vo2-cooper-inputs" style="display:none">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label-custom">Distance Covered in 12 mins (meters)</label><input type="number" id="vo2-cooper-dist" class="form-control form-control-lg rounded-3" value="2800" min="500" max="5000" step="10"></div>
                    </div>
                </div>
                <div id="vo2-mile-inputs" style="display:none">
                    <div class="row g-3">
                        <div class="col-md-4"><label class="form-label-custom">1.5-Mile Time (Min)</label><input type="number" id="vo2-mile-min" class="form-control form-control-lg rounded-3" value="12" min="5" max="30"></div>
                        <div class="col-md-4"><label class="form-label-custom">Seconds</label><input type="number" id="vo2-mile-sec" class="form-control form-control-lg rounded-3" value="0" min="0" max="59"></div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-4"><label class="form-label-custom">Age</label><input type="number" id="vo2-age" class="form-control form-control-lg rounded-3" value="30" min="15" max="90"></div>
                    <div class="col-md-4"><label class="form-label-custom">Gender</label><select id="vo2-gender" class="form-select form-select-lg rounded-3"><option value="male">♂ Male</option><option value="female">♀ Female</option></select></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 vo2-quick" data-rest="60" data-max="190">❤️ RHR 60 / MHR 190</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 vo2-quick" data-rest="70" data-max="185">❤️ RHR 70 / MHR 185</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 vo2-quick" data-rest="80" data-max="180">❤️ RHR 80 / MHR 180</button>
                </div>
                <div class="mt-3 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-microscope text-success me-1"></i> <strong>HR Ratio:</strong> Uth-Sørensen formula: <code>15.3 × (HRmax / HRrest)</code>. <strong>Cooper:</strong> <code>(dist_m − 504.9) / 44.73</code>. <strong>1.5-Mile:</strong> <code>3.5 + 483 / time_min</code>.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Estimated VO2 Max</span>
                <div class="output-hero-value" id="out-vo2">43.5</div>
                <span class="output-hero-unit">ml/kg/min</span>
            </div>

            <h6 class="fw-bold mt-4 mb-2"><i class="fas fa-gauge-high me-2 text-success"></i>Fitness Level</h6>
            <div class="d-flex justify-content-between mb-1"><span class="small fw-bold text-muted">Category</span><span class="small fw-bold" id="out-vo2-level" style="color:#059669">Good</span></div>
            <div class="progress rounded-pill" style="height:14px;background:#f1f5f9"><div id="out-vo2-bar" class="progress-bar rounded-pill" style="width:65%;background:linear-gradient(90deg,#34d399,#059669);transition:all .5s"></div></div>
            <div class="d-flex justify-content-between small text-muted mt-1 px-1"><span>Poor</span><span>Fair</span><span>Good</span><span>Excellent</span><span>Superior</span></div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Category</span><span class="stat-card-value" id="out-vo2-cat">Good</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Percentile</span><span class="stat-card-value" id="out-vo2-pctl">~60th</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Method Used</span><span class="stat-card-value" id="out-vo2-method">HR Ratio</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Fitness Classification</h6>
            <div class="table-responsive"><table class="table table-sm table-bordered text-center small mb-0" id="out-vo2-table"><thead class="table-light"><tr><th>Category</th><th>Male</th><th>Female</th><th>Status</th></tr></thead><tbody></tbody></table></div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-heartbeat me-2 text-danger"></i>Training Zones</h6>
            <div id="out-vo2-zones" class="d-flex flex-column gap-2"></div>

            <div class="mt-4" id="out-vo2-insights"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="vo2-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Fitness Data</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    let method='hr';
    const restHr=$('vo2-rest-hr'),maxHr=$('vo2-max-hr'),cooperDist=$('vo2-cooper-dist'),mileMin=$('vo2-mile-min'),mileSec=$('vo2-mile-sec'),ageEl=$('vo2-age'),genderEl=$('vo2-gender');

    const catsMale=[{name:'Superior',min:52,pctl:'95+'},{name:'Excellent',min:44,pctl:'80-95'},{name:'Good',min:35,pctl:'50-80'},{name:'Fair',min:30,pctl:'20-50'},{name:'Poor',min:0,pctl:'<20'}];
    const catsFemale=[{name:'Superior',min:45,pctl:'95+'},{name:'Excellent',min:38,pctl:'80-95'},{name:'Good',min:31,pctl:'50-80'},{name:'Fair',min:26,pctl:'20-50'},{name:'Poor',min:0,pctl:'<20'}];

    function calculate(){
        let vo2=0;
        if(method==='hr'){
            const rest=parseInt(restHr.value)||65,max=parseInt(maxHr.value)||185;
            if(rest>0&&max>0) vo2=15.3*(max/rest);
            $('out-vo2-method').textContent='HR Ratio';
        } else if(method==='cooper'){
            const dist=parseFloat(cooperDist.value)||0;
            vo2=(dist-504.9)/44.73;
            $('out-vo2-method').textContent='Cooper Test';
        } else {
            const mins=(parseInt(mileMin.value)||0)+(parseInt(mileSec.value)||0)/60;
            if(mins>0) vo2=3.5+483/mins;
            $('out-vo2-method').textContent='1.5-Mile Run';
        }
        if(vo2<=0) return;
        $('out-vo2').textContent=vo2.toFixed(1);

        const g=genderEl.value, cats=g==='male'?catsMale:catsFemale;
        let cat=cats[cats.length-1], pct=10;
        for(const c of cats){if(vo2>=c.min){cat=c;break}}

        const colorMap={Superior:'#059669',Excellent:'#10b981',Good:'#3b82f6',Fair:'#f59e0b',Poor:'#ef4444'};
        const pctMap={Superior:95,Excellent:80,Good:60,Fair:35,Poor:15};
        pct=pctMap[cat.name]||50;

        $('out-vo2-level').textContent=cat.name;$('out-vo2-level').style.color=colorMap[cat.name];
        $('out-vo2-bar').style.width=pct+'%';$('out-vo2-bar').style.background=colorMap[cat.name];
        $('out-vo2-cat').textContent=cat.name;
        $('out-vo2-pctl').textContent='~'+cat.pctl;

        // Classification table
        const refCats=g==='male'?catsMale:catsFemale;
        const refOther=g==='male'?catsFemale:catsMale;
        $('out-vo2-table').querySelector('tbody').innerHTML=refCats.map((c,i)=>{
            const isCurrent=c.name===cat.name;
            return `<tr class="${isCurrent?'table-success fw-bold':''}"><td style="color:${colorMap[c.name]}">${c.name}</td><td>≥ ${catsMale[i].min}</td><td>≥ ${catsFemale[i].min}</td><td>${isCurrent?'◉ You':'—'}</td></tr>`;
        }).join('');

        // Training zones based on VO2 max
        const zones=[{name:'Zone 1 — Recovery',pct:50,color:'#94a3b8'},{name:'Zone 2 — Aerobic Base',pct:60,color:'#3b82f6'},{name:'Zone 3 — Tempo',pct:70,color:'#22c55e'},{name:'Zone 4 — Threshold',pct:80,color:'#f59e0b'},{name:'Zone 5 — VO2 Max',pct:90,color:'#ef4444'}];
        $('out-vo2-zones').innerHTML=zones.map(z=>`<div class="d-flex justify-content-between align-items-center p-2 rounded-2" style="background:${z.color}10;border-left:4px solid ${z.color}"><span class="small fw-bold">${z.name}</span><span class="fw-bold" style="color:${z.color}">${(vo2*z.pct/100).toFixed(1)} ml/kg/min</span></div>`).join('');

        $('out-vo2-insights').innerHTML=`<h6 class="fw-bold mb-3"><i class="fas fa-heart-pulse me-2 text-primary"></i>Assessment</h6><ul class="list-unstyled mb-0 small text-secondary"><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Aerobic Capacity: <strong>${cat.name}</strong> (${cat.pctl} percentile)</li><li><i class="fas fa-check-circle text-success me-2"></i>${vo2<40?'Focus on Zone 2 cardio (60-70% effort) to build your aerobic engine.':'Excellent cardiovascular fitness — maintain with varied intensity training.'}</li></ul>`;
    }

    document.querySelectorAll('[data-method]').forEach(btn=>{btn.addEventListener('click',()=>{
        method=btn.dataset.method;
        document.querySelectorAll('[data-method]').forEach(b=>b.classList.remove('active'));btn.classList.add('active');
        $('vo2-hr-inputs').style.display=method==='hr'?'':'none';
        $('vo2-cooper-inputs').style.display=method==='cooper'?'':'none';
        $('vo2-mile-inputs').style.display=method==='mile'?'':'none';
        calculate();
    })});

    [restHr,maxHr,cooperDist,mileMin,mileSec,ageEl,genderEl].forEach(e=>e.addEventListener('input',calculate));
    document.querySelectorAll('.vo2-quick').forEach(btn=>{btn.addEventListener('click',()=>{restHr.value=btn.dataset.rest;maxHr.value=btn.dataset.max;document.querySelector('[data-method="hr"]').click()})});

    $('vo2-copy').addEventListener('click',function(){
        const text=`VO2 Max Report\nEstimated: ${$('out-vo2').textContent} ml/kg/min\nCategory: ${$('out-vo2-cat').textContent}\nMethod: ${$('out-vo2-method').textContent}\n— ToolsHub Fitness`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>
<style>
.vo2-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.vo2-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.vo2-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.vo2-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.vo2-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.vo2-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.btn-outline-vo2{border:1.5px solid #d1fae5;color:#065f46;font-weight:600;border-radius:12px;padding:.6rem .75rem;transition:all .2s;font-size:.85rem}
.btn-outline-vo2:hover{background:#ecfdf5;border-color:#6ee7b7}
.btn-outline-vo2.active{background:#10b981;color:#fff;border-color:#10b981;box-shadow:0 4px 14px rgba(16,185,129,.2)}
</style>

