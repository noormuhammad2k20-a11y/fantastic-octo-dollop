<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background-color:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Quick Examples</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 log-ex" data-x="100" data-b="10">log₁₀(100)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 log-ex" data-x="64" data-b="2">log₂(64)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 log-ex" data-x="125" data-b="5">log₅(125)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 log-ex" data-x="2.71828" data-b="e">ln(e)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 log-ex" data-x="1000" data-b="10">log₁₀(1000)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 log-ex" data-x="0.01" data-b="10">log₁₀(0.01)</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Argument (x)</label>
                    <input type="number" id="log-x" class="form-control form-control-lg rounded-3" value="100" step="any" min="0.0001" placeholder="Must be > 0">
                    <small class="text-muted mt-1 d-block">Must be positive (x > 0)</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Base (b)</label>
                    <select id="log-base-sel" class="form-select form-select-lg rounded-3">
                        <option value="10">Base 10 (Common log)</option>
                        <option value="e">Base e (Natural ln)</option>
                        <option value="2">Base 2 (Binary)</option>
                        <option value="custom">Custom Base...</option>
                    </select>
                </div>
                <div class="col-md-4" id="log-custom-wrap" style="display:none">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Custom Base Value</label>
                    <input type="number" id="log-custom-base" class="form-control form-control-lg rounded-3" placeholder="e.g. 5" step="any" min="0.001">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimal Precision</label>
                    <select id="log-prec" class="form-select rounded-3">
                        <option value="4">4 places</option>
                        <option value="6" selected>6 places</option>
                        <option value="8">8 places</option>
                        <option value="10">10 places</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 p-3 rounded-4" style="background:#fff7ed;border:1.5px solid #fed7aa">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#ea580c"></i>
                    <strong>Logarithm:</strong> log<sub>b</sub>(x) answers "What power must b be raised to, to get x?" — i.e., b<sup>result</sup> = x. Change-of-base: log<sub>b</sub>(x) = ln(x) / ln(b).
                </p>
            </div>
        </div>
    </div>

    <div class="card tool-card-stacked shadow-sm border-0" id="log-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Step-by-Step Solution</h5>
                        <p class="text-muted small mb-0">Detailed logarithm computation breakdown</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="log-copy-results"><i class="fas fa-copy me-1"></i> Copy</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="alert alert-danger rounded-4 d-none" id="log-error" role="alert"><i class="fas fa-exclamation-triangle me-2"></i><span id="log-error-msg"></span></div>
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#fff7ed;border:2px solid #fed7aa;min-width:280px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px" id="log-eq-label">log₁₀(100) =</span>
                    <div class="display-3 fw-bold" style="color:#ea580c" id="log-answer">2</div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Common (log₁₀)</span><span class="stat-card-value" id="log-out-common">2</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Natural (ln)</span><span class="stat-card-value" id="log-out-ln">4.6052</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Binary (log₂)</span><span class="stat-card-value" id="log-out-bin">6.6439</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Antilog Check</span><span class="stat-card-value" id="log-out-check">100</span></div></div>
            </div>
            <div class="p-4 rounded-4 bg-light border" id="log-steps-box">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2" style="color:#ea580c"></i>Solution Steps</h6>
                <div id="log-steps" class="small text-secondary"></div>
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
.step-num{display:inline-flex;width:28px;height:28px;border-radius:50%;background:#ea580c;color:#fff;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;margin-right:.75rem;flex-shrink:0}
</style>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const xE=document.getElementById('log-x'),baseSelE=document.getElementById('log-base-sel'),customBaseE=document.getElementById('log-custom-base'),customWrap=document.getElementById('log-custom-wrap'),precE=document.getElementById('log-prec'),errDiv=document.getElementById('log-error'),errMsg=document.getElementById('log-error-msg');

    baseSelE.addEventListener('change',()=>{customWrap.style.display=baseSelE.value==='custom'?'':'none';calculate()});

    function showErr(m){errDiv.classList.remove('d-none');errMsg.textContent=m}
    function hideErr(){errDiv.classList.add('d-none')}
    function getBase(){const v=baseSelE.value;if(v==='e')return Math.E;if(v==='custom')return parseFloat(customBaseE.value);return parseFloat(v)}
    function bl(){const v=baseSelE.value;if(v==='e')return'e';if(v==='custom')return customBaseE.value||'?';return v}
    function fmt(n){if(!isFinite(n))return String(n);return parseFloat(n.toFixed(parseInt(precE.value)))}

    function calculate(){
        hideErr();
        const x=parseFloat(xE.value),b=getBase(),label=bl();

        if(isNaN(x)||x===''){showErr('Enter a valid argument (x).');document.getElementById('log-answer').textContent='—';return}
        if(x<=0){showErr('Argument must be positive (x > 0). log of zero or negative is undefined.');document.getElementById('log-answer').textContent='undefined';return}
        if(isNaN(b)||b<=0){showErr('Base must be positive (b > 0).');document.getElementById('log-answer').textContent='—';return}
        if(b===1){showErr('Base cannot be 1. log base 1 is undefined (division by zero in change-of-base).');document.getElementById('log-answer').textContent='undefined';return}

        const result=Math.log(x)/Math.log(b);
        if(!isFinite(result)){showErr('Result is not finite.');document.getElementById('log-answer').textContent='—';return}

        const antilog=Math.pow(b,result);
        const steps=[];
        steps.push({text:`<strong>Given:</strong> x = ${x}, base b = ${label}${label==='e'?' ≈ 2.71828':''}`});
        steps.push({text:`<strong>Formula:</strong> log<sub>${label}</sub>(${x}) = ln(${x}) / ln(${label})`});
        steps.push({text:`<strong>Compute ln:</strong> ln(${x}) = ${fmt(Math.log(x))}, ln(${label}) = ${fmt(Math.log(b))}`});
        steps.push({text:`<strong>Divide:</strong> ${fmt(Math.log(x))} / ${fmt(Math.log(b))} = <strong>${fmt(result)}</strong>`});
        steps.push({text:`<strong>Verify:</strong> ${label}<sup>${fmt(result)}</sup> = ${fmt(antilog)} ${Math.abs(antilog-x)<0.0001?'✓':'≈ '+x}`});

        document.getElementById('log-answer').textContent=fmt(result);
        document.getElementById('log-eq-label').innerHTML=`log<sub>${label}</sub>(${x}) =`;
        document.getElementById('log-out-common').textContent=fmt(Math.log10(x));
        document.getElementById('log-out-ln').textContent=fmt(Math.log(x));
        document.getElementById('log-out-bin').textContent=fmt(Math.log2(x));
        document.getElementById('log-out-check').textContent=fmt(antilog);
        document.getElementById('log-steps').innerHTML=steps.map((s,i)=>`<div class="step-item d-flex align-items-start"><span class="step-num">${i+1}</span><span>${s.text}</span></div>`).join('');
    }

    [xE,customBaseE,precE].forEach(el=>el.addEventListener('input',calculate));
    baseSelE.addEventListener('change',calculate);

    document.querySelectorAll('.log-ex').forEach(btn=>{btn.addEventListener('click',()=>{
        xE.value=btn.dataset.x;
        const b=btn.dataset.b;
        if(['10','e','2'].includes(b)){baseSelE.value=b;customWrap.style.display='none'}else{baseSelE.value='custom';customBaseE.value=b;customWrap.style.display=''}
        calculate();
    })});

    document.getElementById('log-reset').addEventListener('click',()=>{xE.value=100;baseSelE.value='10';customWrap.style.display='none';precE.value='6';calculate()});

    document.getElementById('log-copy-results').addEventListener('click',function(){
        const t=`Logarithm Result\n${'='.repeat(30)}\n${document.getElementById('log-eq-label').textContent} ${document.getElementById('log-answer').textContent}\nCommon: ${document.getElementById('log-out-common').textContent}\nNatural: ${document.getElementById('log-out-ln').textContent}\nBinary: ${document.getElementById('log-out-bin').textContent}\n\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });

    calculate();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\log-calculator.blade.php ENDPATH**/ ?>