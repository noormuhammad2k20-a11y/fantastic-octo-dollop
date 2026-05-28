<div class="row g-4 sip-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Monthly SIP Amount</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="sip-amt" class="form-control form-control-lg" value="5000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Expected Return (Annual %)</label><div class="input-group"><input type="number" id="sip-rate" class="form-control form-control-lg" value="12" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Investment Term (Years)</label><input type="number" id="sip-years" class="form-control form-control-lg rounded-3" value="10" min="1" max="40"></div>
                    <div class="col-md-4"><label class="form-label-custom">Annual Step-up (%)</label><div class="input-group"><input type="number" id="sip-stepup" class="form-control form-control-lg" value="0" min="0" max="50" step="1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Inflation Rate (%)</label><div class="input-group"><input type="number" id="sip-inflation" class="form-control form-control-lg" value="0" min="0" max="15" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero"><span class="output-hero-label">ESTIMATED FUTURE VALUE</span><div class="output-hero-value" id="sip-total">$1,161,695</div><span class="output-hero-unit" id="sip-real-val"></span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#10b981;background:rgba(16,185,129,.02);"><span class="stat-card-label">TOTAL INVESTED</span><span class="stat-card-value text-success" id="sip-invested">$600,000</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">ESTIMATED RETURNS</span><span class="stat-card-value text-primary" id="sip-returns">$561,695</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">RETURN RATIO</span><span class="stat-card-value text-warning" id="sip-ratio">48.3%</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Investment Portfolio</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#10b981" id="sip-bar-inv">Invested</div>
                <div class="progress-bar" style="background:#3b82f6" id="sip-bar-ret">Returns</div>
            </div>
            <div class="mt-4" id="sip-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sip-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Analysis</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sip-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const pInitial=parseFloat($('sip-amt').value)||0,rate=parseFloat($('sip-rate').value)/100;
        const yrs=parseInt($('sip-years').value)||1,stepup=parseFloat($('sip-stepup').value)/100;
        const inflation=parseFloat($('sip-inflation').value)/100;
        let totalInv=0,fv=0,mSip=pInitial,rMo=rate/12;
        for(let y=1;y<=yrs;y++){for(let m=1;m<=12;m++){fv=(fv+mSip)*(1+rMo);totalInv+=mSip;}mSip*=(1+stepup);}
        const realVal=fv/Math.pow(1+inflation,yrs);
        $('sip-total').textContent=fmt(fv);$('sip-invested').textContent=fmt(totalInv);
        $('sip-returns').textContent=fmt(fv-totalInv);$('sip-ratio').textContent=(( (fv-totalInv)/fv )*100).toFixed(1)+'%';
        $('sip-real-val').textContent=inflation>0?'Real Value (Adj. Inflation): '+fmt(realVal):'';
        if(fv>0){const ip=(totalInv/fv)*100;$('sip-bar-inv').style.width=ip+'%';$('sip-bar-inv').textContent=Math.round(ip)+'% Invested';$('sip-bar-ret').style.width=(100-ip)+'%';$('sip-bar-ret').textContent=Math.round(100-ip)+'% Gains';}
        let ins=[];ins.push('Total contributions over '+yrs+' years: <strong>'+fmt(totalInv)+'</strong>');
        if(stepup>0)ins.push('Annual step-up of '+(stepup*100)+'% significantly boosts your corpus.');
        if(inflation>0)ins.push('Factoring inflation, your corpus will have the purchasing power of <strong>'+fmt(realVal)+'</strong> today.');
        $('sip-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Wealth Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['sip-amt','sip-rate','sip-years','sip-stepup','sip-inflation'].forEach(id=>$(id).addEventListener('input',calculate));
    $('sip-copy').addEventListener('click',function(){const t='SIP Wealth Analysis\nFuture Value: '+$('sip-total').textContent+'\nInvested: '+$('sip-invested').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('sip-reset').addEventListener('click',()=>{$('sip-amt').value=5000;$('sip-rate').value=12;$('sip-years').value=10;$('sip-stepup').value=0;$('sip-inflation').value=0;calculate();});
    calculate();
});
</script>
<style>
.sip-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.sip-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.sip-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.sip-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.sip-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.sip-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

