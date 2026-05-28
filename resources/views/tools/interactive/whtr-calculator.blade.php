<div class="row g-4 whtr-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Waist Circumference</label>
                        <div class="input-group"><input type="number" id="wh-waist" class="form-control form-control-lg rounded-start-3" value="85" step="0.1" min="1"><select id="wh-unit" class="form-select rounded-end-3" style="max-width:80px"><option value="cm">cm</option><option value="in">in</option></select></div>
                    </div>
                    <div class="col-md-4"><label class="form-label-custom">Height</label>
                        <div class="input-group"><input type="number" id="wh-height" class="form-control form-control-lg rounded-start-3" value="175" step="0.1" min="1"><span class="input-group-text bg-light fw-bold small" id="wh-height-unit">cm</span></div>
                    </div>
                    <div class="col-md-4"><label class="form-label-custom">Gender</label><select id="wh-gender" class="form-select form-select-lg rounded-3"><option value="male">♂ Male</option><option value="female">♀ Female</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Age Group</label><select id="wh-age" class="form-select form-select-lg rounded-3"><option value="child">Child (< 15)</option><option value="adult" selected>Adult (15-64)</option><option value="senior">Senior (65+)</option></select></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-purple rounded-pill px-3 wh-quick" data-w="85" data-h="175" data-g="male">📏 Avg Male (85/175cm)</button>
                    <button type="button" class="btn btn-sm btn-outline-purple rounded-pill px-3 wh-quick" data-w="75" data-h="165" data-g="female">📏 Avg Female (75/165cm)</button>
                    <button type="button" class="btn btn-sm btn-outline-purple rounded-pill px-3 wh-quick" data-w="70" data-h="180" data-g="male">💪 Fit Male (70/180cm)</button>
                </div>
                <div class="mt-3 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-check-double text-purple me-1"></i> <strong>The Simple Rule:</strong> Keep your waist to <strong>less than half</strong> your height. Research shows WHtR is a stronger predictor of cardiovascular disease and diabetes than BMI.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:270;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">YOUR WHtR RATIO</span>
                <div class="output-hero-value" id="out-wh">0.49</div>
                <span class="badge rounded-pill px-4 py-2 mt-2" id="out-wh-status" style="background:#ede9fe;color:#7c3aed;font-weight:700">Healthy</span>
            </div>

            <h6 class="fw-bold mt-4 mb-2"><i class="fas fa-gauge-high me-2" style="color:#8b5cf6"></i>Risk Gauge</h6>
            <div class="progress rounded-pill mb-1" style="height:14px;background:#f1f5f9"><div id="out-wh-bar" class="progress-bar rounded-pill" style="width:49%;background:linear-gradient(90deg,#a78bfa,#7c3aed);transition:all .5s"></div></div>
            <div class="d-flex justify-content-between small text-muted mt-1 px-1"><span>Underweight<br>&lt;0.40</span><span>Healthy<br>0.40–0.49</span><span>Overweight<br>0.50–0.59</span><span>Obese<br>≥0.60</span></div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Status</span><span class="stat-card-value" id="out-wh-cat">Healthy</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Ideal Target</span><span class="stat-card-value" id="out-wh-target">< 0.50</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Max Healthy Waist</span><span class="stat-card-value" id="out-wh-max-waist">—</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Classification Boundaries</h6>
            <div class="table-responsive"><table class="table table-sm table-bordered text-center small mb-0" id="out-wh-table"><thead class="table-light"><tr><th>Category</th><th>WHtR Range</th><th>Risk</th><th>Status</th></tr></thead><tbody></tbody></table></div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-scale-balanced me-2 text-primary"></i>WHtR vs BMI Comparison</h6>
            <div class="p-3 rounded-3 small" style="background:#f5f3ff;border:1px solid #ddd6fe;color:#5b21b6" id="out-wh-bmi-note">
                <i class="fas fa-info-circle me-1"></i> WHtR accounts for <strong>central adiposity</strong> — where fat is stored matters more than overall weight. Two people with the same BMI can have very different WHtR scores and health risks.
            </div>

            <div class="mt-4" id="out-wh-insights"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="wh-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Health Stats</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const waistEl=$('wh-waist'),heightEl=$('wh-height'),unitEl=$('wh-unit'),genderEl=$('wh-gender'),ageEl=$('wh-age');

    const boundaries=[
        {name:'Underweight',range:'< 0.40',max:0.40,risk:'Low (nutritional)',color:'#0ea5e9',bg:'#f0f9ff'},
        {name:'Healthy',range:'0.40 – 0.49',max:0.50,risk:'Low',color:'#059669',bg:'#ecfdf5'},
        {name:'Overweight',range:'0.50 – 0.59',max:0.60,risk:'Increased',color:'#d97706',bg:'#fffbeb'},
        {name:'Obese',range:'≥ 0.60',max:999,risk:'High',color:'#dc2626',bg:'#fef2f2'}
    ];

    function calculate(){
        const w=parseFloat(waistEl.value)||0, h=parseFloat(heightEl.value)||0;
        if(w<=0||h<=0) return;
        const ratio=w/h;
        $('out-wh').textContent=ratio.toFixed(2);

        let cat=boundaries[1]; // default healthy
        if(ratio>=0.60) cat=boundaries[3];
        else if(ratio>=0.50) cat=boundaries[2];
        else if(ratio<0.40) cat=boundaries[0];
        else cat=boundaries[1];

        $('out-wh-status').textContent=cat.name;$('out-wh-status').style.color=cat.color;$('out-wh-status').style.background=cat.bg;
        $('out-wh').style.color=cat.color;
        $('out-wh-cat').textContent=cat.name;
        $('out-wh-bar').style.width=Math.min(100,ratio*100)+'%';$('out-wh-bar').style.background=cat.color;
        $('out-wh-target').textContent='< 0.50';

        const unit=unitEl.value;
        const maxWaist=(h*0.5).toFixed(1);
        $('out-wh-max-waist').textContent=maxWaist+' '+unit;
        $('wh-height-unit').textContent=unit;

        // Table
        $('out-wh-table').querySelector('tbody').innerHTML=boundaries.map(b=>{
            const isCurrent=b.name===cat.name;
            return `<tr class="${isCurrent?'fw-bold':''}"><td style="color:${b.color}">${b.name}</td><td>${b.range}</td><td>${b.risk}</td><td>${isCurrent?'◉ You':'—'}</td></tr>`;
        }).join('');

        const tip = ratio>=0.50
            ? `Your waist exceeds half your height by <strong>${(w-h*0.5).toFixed(1)} ${unit}</strong>. Reducing waist circumference through diet and exercise is recommended.`
            : `Your waist is <strong>${(h*0.5-w).toFixed(1)} ${unit}</strong> under the threshold. Great fat distribution!`;

        $('out-wh-insights').innerHTML=`<h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-primary"></i>Assessment</h6><ul class="list-unstyled mb-0 small text-secondary"><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>WHtR Score: <strong>${ratio.toFixed(2)}</strong> — ${cat.name} (${cat.risk} risk)</li><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>${tip}</li><li><i class="fas fa-check-circle text-success me-2"></i>Maximum healthy waist for your height: <strong>${maxWaist} ${unit}</strong></li></ul>`;
    }

    [waistEl,heightEl,unitEl,genderEl,ageEl].forEach(e=>e.addEventListener('input',calculate));
    unitEl.addEventListener('change',()=>{$('wh-height-unit').textContent=unitEl.value});

    document.querySelectorAll('.wh-quick').forEach(btn=>{btn.addEventListener('click',()=>{waistEl.value=btn.dataset.w;heightEl.value=btn.dataset.h;genderEl.value=btn.dataset.g;calculate()})});

    $('wh-copy').addEventListener('click',function(){
        const text=`WHtR Health Report\nWaist-to-Height Ratio: ${$('out-wh').textContent}\nStatus: ${$('out-wh-status').textContent}\nMax Healthy Waist: ${$('out-wh-max-waist').textContent}\n— ToolsHub Wellness`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>
<style>
.whtr-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.whtr-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.whtr-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.whtr-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.whtr-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.whtr-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.text-purple{color:#8b5cf6}
.btn-outline-purple{border:1.5px solid #ede9fe;color:#6d28d9;font-weight:600;border-radius:20px;transition:all .2s}
.btn-outline-purple:hover{background:#f5f3ff;border-color:#a78bfa;color:#7c3aed}
</style>

