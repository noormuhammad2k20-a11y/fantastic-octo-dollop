<div class="row g-4 whr-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Gender</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-whr active flex-grow-1" data-gender="male"><i class="fas fa-mars me-1"></i>Male</button>
                            <button type="button" class="btn btn-outline-whr flex-grow-1" data-gender="female"><i class="fas fa-venus me-1"></i>Female</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Waist Circumference</label>
                        <div class="input-group"><input type="number" id="whr-waist" class="form-control form-control-lg rounded-start-3" value="90" step="0.1" min="1"><span class="input-group-text bg-light fw-bold small" id="whr-unit-label">cm</span></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Hip Circumference</label>
                        <div class="input-group"><input type="number" id="whr-hip" class="form-control form-control-lg rounded-start-3" value="100" step="0.1" min="1"><span class="input-group-text bg-light fw-bold small">cm</span></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Units</label>
                        <select id="whr-units" class="form-select form-select-lg rounded-3">
                            <option value="cm">Centimeters (cm)</option>
                            <option value="in">Inches (in)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Age Group</label>
                        <select id="whr-age" class="form-select form-select-lg rounded-3">
                            <option value="20-29">20-29</option>
                            <option value="30-39" selected>30-39</option>
                            <option value="40-49">40-49</option>
                            <option value="50-59">50-59</option>
                            <option value="60+">60+</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 whr-quick" data-v='{"gender":"male","waist":90,"hip":100}'>📏 Avg Male (90/100)</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 whr-quick" data-v='{"gender":"female","waist":80,"hip":95}'>📏 Avg Female (80/95)</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 whr-quick" data-v='{"gender":"male","waist":76,"hip":100}'>💪 Fit Male (76/100)</button>
                </div>
                <div class="mt-3 p-3 bg-light rounded-3 border small text-secondary">
                    <i class="fas fa-globe text-success me-1"></i> <strong>WHO Guidelines:</strong> Abdominal obesity is defined as WHR > 0.90 for men and > 0.85 for women. WHR is a stronger predictor of heart disease risk than BMI.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Your WHR Score</span>
                <div class="output-hero-value" id="out-whr">0.90</div>
                <span class="badge rounded-pill px-4 py-2 mt-2" id="out-whr-status" style="background:#d1fae5;color:#059669;font-weight:700">Normal Risk</span>
            </div>

            <h6 class="fw-bold mt-4 mb-2"><i class="fas fa-gauge-high me-2 text-success"></i>Risk Assessment</h6>
            <div class="position-relative mb-1">
                <div class="progress rounded-pill" style="height:14px;background:#f1f5f9"><div id="out-whr-bar" class="progress-bar rounded-pill" style="width:50%;background:linear-gradient(90deg,#34d399,#059669);transition:all .5s"></div></div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-1"><span>Low Risk</span><span>Moderate</span><span>High Risk</span></div>

            <div class="row g-3 mt-4">
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Category</span><span class="stat-card-value" id="out-whr-cat">Moderate</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Ideal Range</span><span class="stat-card-value" id="out-whr-ideal">< 0.90</span></div></div>
                <div class="col-4"><div class="stat-card"><span class="stat-card-label">Difference</span><span class="stat-card-value" id="out-whr-diff">0.00</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>WHO Classification Table</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center small mb-0" id="out-whr-table">
                    <thead class="table-light"><tr><th>Risk Level</th><th>Male</th><th>Female</th><th>Your Status</th></tr></thead>
                    <tbody>
                        <tr><td>Low</td><td>< 0.90</td><td>< 0.80</td><td id="whr-t-low">—</td></tr>
                        <tr><td>Moderate</td><td>0.90 – 0.99</td><td>0.80 – 0.84</td><td id="whr-t-mod">—</td></tr>
                        <tr><td>High</td><td>≥ 1.00</td><td>≥ 0.85</td><td id="whr-t-high">—</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4" id="out-whr-insights"></div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="whr-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Health Report</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    let gender='male';
    const waistEl=$('whr-waist'),hipEl=$('whr-hip'),unitsEl=$('whr-units'),ageEl=$('whr-age');

    function calculate(){
        const w=parseFloat(waistEl.value)||0, h=parseFloat(hipEl.value)||0;
        if(w<=0||h<=0) return;
        const ratio = w/h;
        $('out-whr').textContent = ratio.toFixed(2);

        const mThreshLow=0.90, mThreshHigh=1.0, fThreshLow=0.80, fThreshHigh=0.85;
        const low = gender==='male'?mThreshLow:fThreshLow;
        const high = gender==='male'?mThreshHigh:fThreshHigh;
        $('out-whr-ideal').textContent = '< '+low.toFixed(2);

        let status,color,bg,pct,cat;
        if(ratio < low){status='Low Risk';color='#059669';bg='#d1fae5';pct=25;cat='Healthy';}
        else if(ratio < high){status='Moderate Risk';color='#d97706';bg='#fef3c7';pct=55;cat='Elevated';}
        else{status='High Risk';color='#dc2626';bg='#fee2e2';pct=90;cat='At Risk';}

        $('out-whr-status').textContent=status;$('out-whr-status').style.color=color;$('out-whr-status').style.background=bg;
        $('out-whr').style.color=color;
        $('out-whr-bar').style.width=pct+'%';$('out-whr-bar').style.background=color;
        $('out-whr-cat').textContent=cat;
        $('out-whr-diff').textContent=(ratio<low?'':'+')+(ratio-low).toFixed(2);
        $('out-whr-diff').style.color=ratio<low?'#059669':'#dc2626';

        // Table highlights
        ['whr-t-low','whr-t-mod','whr-t-high'].forEach(id=>{ $(id).textContent=''; $(id).className=''; });
        if(ratio<low){$('whr-t-low').textContent='✅ You';$('whr-t-low').className='table-success fw-bold';}
        else if(ratio<high){$('whr-t-mod').textContent='⚠️ You';$('whr-t-mod').className='table-warning fw-bold';}
        else{$('whr-t-high').textContent='🔴 You';$('whr-t-high').className='table-danger fw-bold';}

        $('out-whr-insights').innerHTML=`<h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-primary"></i>Assessment</h6><ul class="list-unstyled mb-0 small text-secondary"><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>A ratio of <strong>${ratio.toFixed(2)}</strong> indicates ${status.toLowerCase()} for cardiovascular and metabolic diseases.</li><li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>WHR is often a more reliable indicator than BMI, especially for older adults.</li><li><i class="fas fa-check-circle text-success me-2"></i>${ratio>=low?'Consider consulting a specialist about weight management strategies.':'Your fat distribution is within the healthy range — great work!'}</li></ul>`;
    }

    document.querySelectorAll('[data-gender]').forEach(btn=>{btn.addEventListener('click',()=>{gender=btn.dataset.gender;document.querySelectorAll('[data-gender]').forEach(b=>b.classList.remove('active'));btn.classList.add('active');calculate()})});
    [waistEl,hipEl,unitsEl,ageEl].forEach(e=>e.addEventListener('input',calculate));
    unitsEl.addEventListener('change',()=>{document.querySelectorAll('#whr-unit-label,.input-group-text').forEach(s=>{if(s.closest('.whr-calc-rebuilt'))s.textContent=unitsEl.value})});

    document.querySelectorAll('.whr-quick').forEach(btn=>{btn.addEventListener('click',()=>{const v=JSON.parse(btn.dataset.v);document.querySelector(`[data-gender="${v.gender}"]`).click();waistEl.value=v.waist;hipEl.value=v.hip;calculate()})});

    $('whr-copy').addEventListener('click',function(){
        const text=`WHR Health Report\nWaist-to-Hip Ratio: ${$('out-whr').textContent}\nRisk: ${$('out-whr-status').textContent}\nCategory: ${$('out-whr-cat').textContent}\n— ToolsHub Wellness`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>
<style>
.whr-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.whr-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.whr-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.whr-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.whr-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.whr-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.btn-outline-whr{border:1.5px solid #d1fae5;color:#065f46;font-weight:600;border-radius:12px;padding:.6rem 1rem;transition:all .2s}
.btn-outline-whr:hover{background:#ecfdf5;color:#059669;border-color:#6ee7b7}
.btn-outline-whr.active{background:#10b981;color:#fff;border-color:#10b981;box-shadow:0 4px 14px rgba(16,185,129,.25)}
</style>

