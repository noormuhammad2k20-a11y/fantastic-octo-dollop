<div class="row g-4 bp-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Systolic (Upper #)</label>
                        <input type="number" id="bp-sys" class="form-control form-control-lg rounded-3" value="120" min="60" max="250">
                        <span class="text-muted small">Pressure when the heart beats</span>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Diastolic (Lower #)</label>
                        <input type="number" id="bp-dia" class="form-control form-control-lg rounded-3" value="80" min="40" max="180">
                        <span class="text-muted small">Pressure when heart rests</span>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Pulse Rate <span class="text-muted">(optional)</span></label>
                        <input type="number" id="bp-pulse" class="form-control form-control-lg rounded-3" placeholder="e.g. 72" min="30" max="200">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Position</label>
                        <select id="bp-pos" class="form-select form-select-lg rounded-3">
                            <option value="sitting" selected>Sitting (standard)</option>
                            <option value="standing">Standing</option>
                            <option value="lying">Lying down</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Time of Reading</label>
                        <select id="bp-time" class="form-select form-select-lg rounded-3">
                            <option value="morning">Morning</option>
                            <option value="afternoon" selected>Afternoon</option>
                            <option value="evening">Evening</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 bp-quick" data-s="120" data-d="80">💚 Normal (120/80)</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 bp-quick" data-s="135" data-d="85">⚠️ Stage 1 (135/85)</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 bp-quick" data-s="155" data-d="95">🔴 Stage 2 (155/95)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 bp-quick" data-s="185" data-d="125">🚨 Crisis (185/125)</button>
                </div>
                <div class="mt-3 p-3 rounded-3 small" style="background:#fef2f2;border:1px solid #fecaca;color:#991b1b">
                    <i class="fas fa-triangle-exclamation me-1"></i> <strong>Disclaimer:</strong> This tool is for educational purposes only. It is not a substitute for professional medical advice or diagnosis. Always consult a doctor.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="bp-output-card" style="--tool-hue:0;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);transition:all .4s">
            <div class="output-hero">
                <span class="output-hero-label">Reading Assessment</span>
                <div class="output-hero-value" id="out-bp-cat" style="font-size:2.5rem">Normal</div>
                <span class="output-hero-unit" id="out-bp-reading">120 / 80 mmHg</span>
            </div>

            <div class="position-relative mt-3 mb-1">
                <div class="progress rounded-pill" style="height:14px;background:#f1f5f9"><div id="out-bp-bar" class="progress-bar rounded-pill" style="width:20%;background:#10b981;transition:all .5s"></div></div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-1"><span>Normal</span><span>Elevated</span><span>Stage 1</span><span>Stage 2</span><span>Crisis</span></div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Systolic</span><span class="stat-card-value" id="out-bp-sys">120</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Diastolic</span><span class="stat-card-value" id="out-bp-dia">80</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">MAP</span><span class="stat-card-value" id="out-bp-map">93</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Pulse Pressure</span><span class="stat-card-value" id="out-bp-pp">40</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>AHA Classification Table</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center small mb-0">
                    <thead class="table-light"><tr><th>Category</th><th>Systolic</th><th>Diastolic</th><th>Status</th></tr></thead>
                    <tbody id="out-bp-table"></tbody>
                </table>
            </div>

            <div class="mt-4" id="out-bp-advice"></div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="bp-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy BP Report</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const sysEl=$('bp-sys'),diaEl=$('bp-dia'),pulseEl=$('bp-pulse'),posEl=$('bp-pos'),timeEl=$('bp-time');

    const categories=[
        {name:'Normal',sys:[0,120],dia:[0,80],color:'#059669',bg:'rgba(16,185,129,.04)',pct:15},
        {name:'Elevated',sys:[120,130],dia:[0,80],color:'#d97706',bg:'rgba(245,158,11,.04)',pct:35},
        {name:'Hypertension Stage 1',sys:[130,140],dia:[80,90],color:'#ea580c',bg:'rgba(234,88,12,.04)',pct:55},
        {name:'Hypertension Stage 2',sys:[140,180],dia:[90,120],color:'#dc2626',bg:'rgba(220,38,38,.04)',pct:78},
        {name:'Hypertensive Crisis',sys:[180,999],dia:[120,999],color:'#881337',bg:'rgba(136,19,55,.04)',pct:98}
    ];

    function classify(s,d){
        if(s>=180||d>=120) return categories[4];
        if(s>=140||d>=90) return categories[3];
        if(s>=130||d>=80) return categories[2];
        if(s>=120&&d<80) return categories[1];
        return categories[0];
    }

    function calculate(){
        const s=parseInt(sysEl.value)||0, d=parseInt(diaEl.value)||0, p=parseInt(pulseEl.value)||0;
        if(s<=0||d<=0) return;
        const cat = classify(s,d);
        const map = Math.round((s + 2*d)/3);
        const pp = s - d;

        $('out-bp-cat').textContent=cat.name;$('out-bp-cat').style.color=cat.color;
        $('out-bp-reading').textContent=s+' / '+d+' mmHg';
        $('out-bp-sys').textContent=s;$('out-bp-dia').textContent=d;
        $('out-bp-map').textContent=map;$('out-bp-pp').textContent=pp;
        $('out-bp-bar').style.width=cat.pct+'%';$('out-bp-bar').style.background=cat.color;
        $('bp-output-card').style.setProperty('--tool-color',cat.color);
        $('bp-output-card').style.setProperty('--tool-bg',cat.bg);

        // Table
        $('out-bp-table').innerHTML = categories.map(c=>{
            const isCurrent = c.name===cat.name;
            return `<tr class="${isCurrent?'fw-bold':''}"><td style="color:${c.color}">${c.name}</td><td>${c.sys[0]==0?'<':c.sys[0]+' –'} ${c.sys[1]==999?'+':c.sys[1]}</td><td>${c.dia[0]==0?'<':c.dia[0]+' –'} ${c.dia[1]==999?'+':c.dia[1]}</td><td>${isCurrent?'◉ You':'—'}</td></tr>`;
        }).join('');

        // Advice
        const adviceMap={
            'Normal':'<i class="fas fa-circle-check text-success me-2"></i>Congratulations! Your blood pressure is in the healthy range. Continue maintaining a healthy lifestyle.',
            'Elevated':'<i class="fas fa-circle-info text-warning me-2"></i>Slightly above ideal. Consider reducing sodium intake and increasing physical activity.',
            'Hypertension Stage 1':'<i class="fas fa-circle-info text-warning me-2"></i>Consistently high. Lifestyle modifications are recommended — your doctor may suggest medication.',
            'Hypertension Stage 2':'<i class="fas fa-exclamation-triangle text-danger me-2"></i>Significantly elevated. Consult your physician about medication options. High cardiovascular risk.',
            'Hypertensive Crisis':'<i class="fas fa-phone-flip text-danger me-2"></i><strong>Seek immediate medical attention.</strong> Readings above 180/120 require emergency evaluation.'
        };
        let advHtml = `<h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-primary"></i>Recommendations</h6><ul class="list-unstyled mb-0 small text-secondary"><li class="mb-2">${adviceMap[cat.name]}</li>`;
        advHtml += `<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>MAP (Mean Arterial Pressure): <strong>${map} mmHg</strong> — ${map>=70&&map<=100?'within normal range.':'outside typical range.'}</li>`;
        if(p>0) advHtml += `<li><i class="fas fa-check-circle text-success me-2"></i>Pulse: <strong>${p} BPM</strong> — ${p>=60&&p<=100?'normal resting heart rate.':'outside typical resting range.'}</li>`;
        advHtml += '</ul>';
        $('out-bp-advice').innerHTML = advHtml;
    }

    [sysEl,diaEl,pulseEl,posEl,timeEl].forEach(e=>e.addEventListener('input',calculate));
    document.querySelectorAll('.bp-quick').forEach(btn=>{btn.addEventListener('click',()=>{sysEl.value=btn.dataset.s;diaEl.value=btn.dataset.d;calculate()})});
    $('bp-copy').addEventListener('click',function(){
        const text=`Blood Pressure Report\nReading: ${$('out-bp-reading').textContent}\nCategory: ${$('out-bp-cat').textContent}\nMAP: ${$('out-bp-map').textContent}\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>
<style>
.bp-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.bp-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.bp-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.bp-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.bp-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.bp-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/blood-pressure-interpreter.blade.php ENDPATH**/ ?>