<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background-color:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Quick Examples</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 alog-ex" data-base="10" data-exp="2">10² = 100</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 alog-ex" data-base="e" data-exp="1">e¹ ≈ 2.718</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 alog-ex" data-base="2" data-exp="8">2⁸ = 256</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 alog-ex" data-base="10" data-exp="-2">10⁻² = 0.01</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 alog-ex" data-base="5" data-exp="3">5³ = 125</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Exponent (y)</label>
                    <input type="text" id="alog-exp" class="form-control form-control-lg rounded-3" value="2" placeholder="e.g. 2, -1.5, 1/2">
                    <small class="text-muted mt-1 d-block">Supports fractions like 1/2 or 1/3</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Base (b)</label>
                    <select id="alog-base-sel" class="form-select form-select-lg rounded-3">
                        <option value="10">Base 10 (Common)</option>
                        <option value="e">Base e (Natural)</option>
                        <option value="2">Base 2 (Binary)</option>
                        <option value="custom">Custom Base...</option>
                    </select>
                </div>
                <div class="col-md-4" id="alog-custom-wrap" style="display:none">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Custom Base Value</label>
                    <input type="number" id="alog-custom-base" class="form-control form-control-lg rounded-3" placeholder="e.g. 5" step="any" min="0.001">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimal Precision</label>
                    <select id="alog-prec" class="form-select rounded-3">
                        <option value="4">4 places</option>
                        <option value="6" selected>6 places</option>
                        <option value="8">8 places</option>
                        <option value="10">10 places</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 p-3 rounded-4" style="background:#faf5ff;border:1.5px solid #e9d5ff">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#a855f7"></i>
                    <strong>Formula:</strong> antilog<sub>b</sub>(y) = b<sup>y</sup>. The antilogarithm reverses the logarithm. If log<sub>b</sub>(x) = y, then antilog<sub>b</sub>(y) = x.
                </p>
            </div>
        </div>
    </div>

    <div class="card tool-card-stacked shadow-sm border-0" id="alog-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Step-by-Step Solution</h5>
                        <p class="text-muted small mb-0">Mathematical breakdown of the antilog computation</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="alog-copy"><i class="fas fa-copy me-1"></i> Copy</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="alert alert-danger rounded-4 d-none" id="alog-error" role="alert"><i class="fas fa-exclamation-triangle me-2"></i><span id="alog-error-msg"></span></div>
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#f0fdf4;border:2px solid #bbf7d0;min-width:260px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px" id="alog-eq-label">10² =</span>
                    <div class="display-3 fw-bold" style="color:#059669" id="alog-answer">100</div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Base</span><span class="stat-card-value" id="alog-out-base">10</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Exponent</span><span class="stat-card-value" id="alog-out-exp">2</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Scientific</span><span class="stat-card-value" id="alog-out-sci">1e+2</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Verify log</span><span class="stat-card-value" id="alog-out-log">2</span></div></div>
            </div>
            <div class="p-4 rounded-4 bg-light border" id="alog-steps-box">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2" style="color:#a855f7"></i>Solution Steps</h6>
                <div id="alog-steps" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>

<style>
.tool-card-stacked{border-radius:24px;background:#fff}
.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}
.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}
.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}
.step-item{padding:.75rem 1rem;background:#fff;border:1px solid #e5e7eb;border-radius:12px;margin-bottom:.5rem}
.step-num{display:inline-flex;width:28px;height:28px;border-radius:50%;background:#a855f7;color:#fff;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;margin-right:.75rem;flex-shrink:0}
</style>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const expE=document.getElementById('alog-exp'),baseSelE=document.getElementById('alog-base-sel'),customBaseE=document.getElementById('alog-custom-base'),customWrap=document.getElementById('alog-custom-wrap'),precE=document.getElementById('alog-prec'),errDiv=document.getElementById('alog-error'),errMsg=document.getElementById('alog-error-msg');

    baseSelE.addEventListener('change',()=>{customWrap.style.display=baseSelE.value==='custom'?'':'none';calculate()});

    function showErr(m){errDiv.classList.remove('d-none');errMsg.textContent=m}
    function hideErr(){errDiv.classList.add('d-none')}

    function parseExp(s){
        s=(s||'').trim();if(!s)return NaN;
        if(s.includes('/')){const p=s.split('/');const n=parseFloat(p[0]),d=parseFloat(p[1]);if(isNaN(n)||isNaN(d)||d===0)return NaN;return n/d}
        return parseFloat(s);
    }
    function getBase(){const v=baseSelE.value;if(v==='e')return Math.E;if(v==='custom')return parseFloat(customBaseE.value);return parseFloat(v)}
    function bLabel(){const v=baseSelE.value;if(v==='e')return'e';if(v==='custom')return customBaseE.value||'?';return v}
    function fmt(n){if(!isFinite(n))return String(n);return parseFloat(n.toFixed(parseInt(precE.value)))}

    function calculate(){
        hideErr();
        const y=parseExp(expE.value),b=getBase(),bl=bLabel();
        if(isNaN(y)){showErr('Enter a valid exponent.');document.getElementById('alog-answer').textContent='—';return}
        if(isNaN(b)||b<=0){showErr('Base must be positive (> 0).');document.getElementById('alog-answer').textContent='—';return}
        if(b===1&&y!==0){showErr('Base 1 raised to any non-zero power is 1.');document.getElementById('alog-answer').textContent='1';return}

        const result=Math.pow(b,y);
        if(!isFinite(result)){showErr('Result overflows. Try smaller values.');document.getElementById('alog-answer').textContent=result>0?'∞':'-∞';return}
        if(isNaN(result)){showErr('Cannot compute (negative base with fractional exponent).');document.getElementById('alog-answer').textContent='NaN';return}

        const steps=[];
        steps.push({text:`<strong>Given:</strong> base b = ${bl}${bl==='e'?' ≈ 2.71828':''}, exponent y = ${expE.value.trim()}`});
        steps.push({text:`<strong>Formula:</strong> antilog<sub>${bl}</sub>(${expE.value.trim()}) = ${bl}<sup>${expE.value.trim()}</sup>`});
        if(expE.value.includes('/')){const p=expE.value.split('/');steps.push({text:`<strong>Fraction → Decimal:</strong> ${p[0]}/${p[1]} = ${fmt(y)}`})}
        steps.push({text:`<strong>Compute:</strong> ${bl}<sup>${fmt(y)}</sup> = <strong>${fmt(result)}</strong>`});
        if(Number.isInteger(y)&&y>0&&y<=10&&b<100){steps.push({text:`<strong>Expansion:</strong> ${Array(Math.round(y)).fill(bl).join(' × ')} = ${fmt(result)}`})}
        if(y<0){const pr=Math.pow(b,Math.abs(y));if(isFinite(pr)&&pr!==0)steps.push({text:`<strong>Negative exp:</strong> 1/${bl}<sup>${fmt(Math.abs(y))}</sup> = 1/${fmt(pr)} = <strong>${fmt(result)}</strong>`})}

        let logCheck='—';
        if(result>0&&b>0&&b!==1){const lc=Math.log(result)/Math.log(b);if(isFinite(lc)){logCheck=fmt(lc);steps.push({text:`<strong>Verify:</strong> log<sub>${bl}</sub>(${fmt(result)}) = ${fmt(lc)} ✓`})}}

        document.getElementById('alog-answer').textContent=fmt(result);
        document.getElementById('alog-eq-label').innerHTML=`${bl}<sup>${expE.value.trim()}</sup> =`;
        document.getElementById('alog-out-base').textContent=bl;
        document.getElementById('alog-out-exp').textContent=expE.value.trim();
        document.getElementById('alog-out-sci').textContent=result.toExponential(2);
        document.getElementById('alog-out-log').textContent=logCheck;
        document.getElementById('alog-steps').innerHTML=steps.map((s,i)=>`<div class="step-item d-flex align-items-start"><span class="step-num">${i+1}</span><span>${s.text}</span></div>`).join('');
    }

    [expE,customBaseE,precE].forEach(el=>el.addEventListener('input',calculate));
    baseSelE.addEventListener('change',calculate);

    document.querySelectorAll('.alog-ex').forEach(btn=>{btn.addEventListener('click',()=>{
        const b=btn.dataset.base;
        if(['10','e','2'].includes(b)){baseSelE.value=b;customWrap.style.display='none'}else{baseSelE.value='custom';customBaseE.value=b;customWrap.style.display=''}
        expE.value=btn.dataset.exp;calculate();
    })});

    document.getElementById('alog-reset').addEventListener('click',()=>{baseSelE.value='10';expE.value='2';customWrap.style.display='none';precE.value='6';calculate()});

    document.getElementById('alog-copy').addEventListener('click',function(){
        const t=`Antilog Result\n${'='.repeat(30)}\n${document.getElementById('alog-eq-label').textContent} ${document.getElementById('alog-answer').textContent}\nScientific: ${document.getElementById('alog-out-sci').textContent}\n\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });

    calculate();
});
</script>
