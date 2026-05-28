<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background-color:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Quick Examples</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 sec-ex" data-t="100">Length 100</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 sec-ex" data-t="1">Length 1</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 sec-ex" data-t="1920">1920px</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 sec-ex" data-t="500">Length 500</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Total Length (a + b)</label>
                    <input type="number" step="any" class="form-control form-control-lg rounded-3" id="sec-total" value="100" placeholder="Enter total length">
                    <small class="text-muted mt-1 d-block">Enter total to auto-calculate parts</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Long Part (a)</label>
                    <input type="number" step="any" class="form-control form-control-lg rounded-3" id="sec-long" value="61.8034" placeholder="Longer segment">
                    <small class="text-muted mt-1 d-block">≈ 61.8% of total</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Short Part (b)</label>
                    <input type="number" step="any" class="form-control form-control-lg rounded-3" id="sec-short" value="38.1966" placeholder="Shorter segment">
                    <small class="text-muted mt-1 d-block">≈ 38.2% of total</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Decimal Precision</label>
                    <select id="sec-prec" class="form-select rounded-3">
                        <option value="2">2 places</option>
                        <option value="4" selected>4 places</option>
                        <option value="6">6 places</option>
                        <option value="8">8 places</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 p-3 rounded-4" style="background:#ecfdf5;border:1.5px solid #a7f3d0">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#10b981"></i>
                    <strong>Golden Ratio Formula:</strong> φ = (1 + √5) / 2 ≈ 1.61803. A line divided in this ratio satisfies: (a + b) / a = a / b = φ
                </p>
            </div>
        </div>
    </div>

    <div class="card tool-card-stacked shadow-sm border-0" id="sec-result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(59,130,246,.1);color:#3b82f6"><i class="fas fa-divide"></i></div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Section Analysis</h5>
                        <p class="text-muted small mb-0">Visual breakdown and ratio verification</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="sec-copy"><i class="far fa-copy me-1"></i> Copy</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="alert alert-danger rounded-4 d-none" id="sec-error" role="alert"><i class="fas fa-exclamation-triangle me-2"></i><span id="sec-error-msg"></span></div>

            <div class="text-center mb-4">
                <svg viewBox="0 0 100 20" style="max-width:600px;width:100%;height:auto">
                    <rect x="0" y="8" width="100" height="4" fill="#e2e8f0" rx="2"/>
                    <rect id="svg-a" x="0" y="8" width="61.8" height="4" fill="#10b981" rx="2"/>
                    <text x="30.9" y="5" font-size="4" fill="#10b981" text-anchor="middle" font-weight="bold">Long (a)</text>
                    <text x="80.9" y="5" font-size="4" fill="#64748b" text-anchor="middle" font-weight="bold">Short (b)</text>
                    <line x1="61.8" y1="5" x2="61.8" y2="15" stroke="#1e293b" stroke-width="0.5" stroke-dasharray="1,1"/>
                </svg>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Ratio a/b</span><span class="stat-card-value" id="sec-r1">1.6180</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Ratio (a+b)/a</span><span class="stat-card-value" id="sec-r2">1.6180</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">φ Deviation</span><span class="stat-card-value" id="sec-dev">0.0000%</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Is Golden?</span><span class="stat-card-value" id="sec-valid">✓ Yes</span></div></div>
            </div>

            <div class="p-4 rounded-4 bg-light border" id="sec-steps-box">
                <h6 class="fw-bold mb-3"><i class="fas fa-list-ol me-2" style="color:#10b981"></i>Calculation Steps</h6>
                <div id="sec-steps" class="small text-secondary"></div>
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
.step-num{display:inline-flex;width:28px;height:28px;border-radius:50%;background:#10b981;color:#fff;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;margin-right:.75rem;flex-shrink:0}
</style>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const PHI=(1+Math.sqrt(5))/2;
    const tI=document.getElementById('sec-total'),aI=document.getElementById('sec-long'),bI=document.getElementById('sec-short'),precE=document.getElementById('sec-prec');
    const errDiv=document.getElementById('sec-error'),errMsg=document.getElementById('sec-error-msg');
    let lastEdited='total';

    function showErr(m){errDiv.classList.remove('d-none');errMsg.textContent=m}
    function hideErr(){errDiv.classList.add('d-none')}
    function fmt(n){if(!isFinite(n))return'—';return parseFloat(n.toFixed(parseInt(precE.value)))}

    function updateFromTotal(){
        const t=parseFloat(tI.value);
        if(isNaN(t)||t<=0){showErr('Total length must be a positive number.');return}
        hideErr();
        const a=t/PHI;const b=t-a;
        aI.value=fmt(a);bI.value=fmt(b);
        updateResults(t,a,b);
    }
    function updateFromLong(){
        const a=parseFloat(aI.value);
        if(isNaN(a)||a<=0){showErr('Long part must be positive.');return}
        hideErr();
        const t=a*PHI;const b=t-a;
        tI.value=fmt(t);bI.value=fmt(b);
        updateResults(t,a,b);
    }
    function updateFromShort(){
        const b=parseFloat(bI.value);
        if(isNaN(b)||b<=0){showErr('Short part must be positive.');return}
        hideErr();
        const a=b*PHI;const t=a+b;
        tI.value=fmt(t);aI.value=fmt(a);
        updateResults(t,a,b);
    }

    function updateResults(t,a,b){
        if(t<=0||a<=0||b<=0)return;
        const pct=(a/t)*100;
        document.getElementById('svg-a').setAttribute('width',Math.min(pct,100));

        const r1=b>0?a/b:Infinity;
        const r2=a>0?(a+b)/a:Infinity;
        const dev=Math.abs(r1-PHI)/PHI*100;
        const isGolden=dev<0.01;

        document.getElementById('sec-r1').textContent=isFinite(r1)?fmt(r1):'∞';
        document.getElementById('sec-r2').textContent=isFinite(r2)?fmt(r2):'∞';
        document.getElementById('sec-dev').textContent=fmt(dev)+'%';
        document.getElementById('sec-valid').textContent=isGolden?'✓ Yes':'✗ No';
        document.getElementById('sec-valid').style.color=isGolden?'#10b981':'#ef4444';

        const steps=[];
        steps.push({text:`<strong>Golden Ratio:</strong> φ = (1 + √5) / 2 = ${PHI.toFixed(10)}`});
        steps.push({text:`<strong>Total Length:</strong> ${fmt(t)}`});
        steps.push({text:`<strong>Long Part (a):</strong> total / φ = ${fmt(t)} / ${fmt(PHI)} = <strong>${fmt(a)}</strong>`});
        steps.push({text:`<strong>Short Part (b):</strong> total − a = ${fmt(t)} − ${fmt(a)} = <strong>${fmt(b)}</strong>`});
        steps.push({text:`<strong>Verify a/b:</strong> ${fmt(a)} / ${fmt(b)} = ${isFinite(r1)?fmt(r1):'∞'} ${isGolden?'≈ φ ✓':'≠ φ'}`});
        steps.push({text:`<strong>Verify (a+b)/a:</strong> ${fmt(t)} / ${fmt(a)} = ${isFinite(r2)?fmt(r2):'∞'} ${isGolden?'≈ φ ✓':'≠ φ'}`});
        document.getElementById('sec-steps').innerHTML=steps.map((s,i)=>`<div class="step-item d-flex align-items-start"><span class="step-num">${i+1}</span><span>${s.text}</span></div>`).join('');
    }

    tI.addEventListener('input',()=>{lastEdited='total';updateFromTotal()});
    aI.addEventListener('input',()=>{lastEdited='long';updateFromLong()});
    bI.addEventListener('input',()=>{lastEdited='short';updateFromShort()});
    precE.addEventListener('input',()=>{if(lastEdited==='total')updateFromTotal();else if(lastEdited==='long')updateFromLong();else updateFromShort()});

    document.querySelectorAll('.sec-ex').forEach(btn=>{btn.addEventListener('click',()=>{tI.value=btn.dataset.t;lastEdited='total';updateFromTotal()})});

    document.getElementById('sec-reset').addEventListener('click',()=>{tI.value=100;precE.value='4';lastEdited='total';updateFromTotal()});

    document.getElementById('sec-copy').addEventListener('click',function(){
        const t=`Golden Section Report\n${'='.repeat(30)}\nTotal: ${tI.value}\nLong Part (a): ${aI.value}\nShort Part (b): ${bI.value}\nRatio a/b: ${document.getElementById('sec-r1').textContent}\nRatio (a+b)/a: ${document.getElementById('sec-r2').textContent}\n\nGenerated via ToolsHub`;
        navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });

    updateFromTotal();
});
</script>
