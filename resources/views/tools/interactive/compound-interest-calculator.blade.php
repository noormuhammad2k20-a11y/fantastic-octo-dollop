<div class="row g-4 comp-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Initial Investment</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ci-prin" class="form-control form-control-lg" value="10000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Monthly Contribution</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ci-monthly" class="form-control form-control-lg" value="100" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Annual Interest Rate</label><div class="input-group"><input type="number" id="ci-rate" class="form-control form-control-lg" value="8" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Investment Term (Years)</label><input type="number" id="ci-years" class="form-control form-control-lg rounded-3" value="10" min="1" max="50"></div>
                    <div class="col-md-4"><label class="form-label-custom">Compounding Frequency</label><select id="ci-freq" class="form-select form-select-lg rounded-3"><option value="1">Annually</option><option value="12" selected>Monthly</option><option value="365">Daily</option></select></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero"><span class="output-hero-label">ESTIMATED FUTURE VALUE</span><div class="output-hero-value" id="ci-total">$35,120</div><span class="output-hero-unit" id="ci-summary-label">After 10 Years</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#10b981;background:rgba(16,185,129,.02);"><span class="stat-card-label">TOTAL INVESTED</span><span class="stat-card-value text-success" id="ci-contrib">$22,000</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">INTEREST EARNED</span><span class="stat-card-value text-primary" id="ci-int">$13,120</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">EARNINGS RATIO</span><span class="stat-card-value text-warning" id="ci-ratio">37.4%</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Investment Mix</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#10b981" id="ci-bar-prin">Principal</div>
                <div class="progress-bar" style="background:#3b82f6" id="ci-bar-int">Interest</div>
            </div>
            <div class="mt-4" id="ci-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ci-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Estimation</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ci-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const P=parseFloat($('ci-prin').value)||0,r=(parseFloat($('ci-rate').value)||0)/100;
        const yrs=parseFloat($('ci-years').value)||0,n=parseInt($('ci-freq').value),mContrib=parseFloat($('ci-monthly').value)||0;
        const totalMonths=yrs*12,monthlyRate=r/12;
        let bal=P,totalContribs=P;
        for(let m=1;m<=totalMonths;m++){
            if(m%(12/n)===0||n>12){let pRate=r/n;bal*=(1+pRate);}
            bal+=mContrib;totalContribs+=mContrib;
        }
        const totalInt=bal-totalContribs;
        $('ci-total').textContent=fmt(bal);$('ci-summary-label').textContent='After '+yrs+' Years';
        $('ci-contrib').textContent=fmt(totalContribs);$('ci-int').textContent=fmt(totalInt);
        $('ci-ratio').textContent=((totalInt/bal)*100).toFixed(1)+'%';
        if(bal>0){const pp=(totalContribs/bal)*100;$('ci-bar-prin').style.width=pp+'%';$('ci-bar-prin').textContent=Math.round(pp)+'% Principal';$('ci-bar-int').style.width=(100-pp)+'%';$('ci-bar-int').textContent=Math.round(100-pp)+'% Interest';}
        let ins=[];ins.push('Your investment grows by <strong>'+fmt(totalInt)+'</strong> through interest alone.');
        ins.push('Total contributions over '+yrs+' years: <strong>'+fmt(totalContribs)+'</strong>');
        if(r>0.1)ins.push('🔥 High return rate! Your money is working hard.');
        $('ci-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Growth Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['ci-prin','ci-rate','ci-years','ci-freq','ci-monthly'].forEach(id=>$(id).addEventListener('input',calculate));
    $('ci-copy').addEventListener('click',function(){const t='Compound Interest Estimation\nTotal Value: '+$('ci-total').textContent+'\nInterest: '+$('ci-int').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('ci-reset').addEventListener('click',()=>{$('ci-prin').value=10000;$('ci-monthly').value=100;$('ci-rate').value=8;$('ci-years').value=10;$('ci-freq').value='12';calculate();});
    calculate();
});
</script>
<style>
.comp-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.comp-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.comp-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.comp-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.comp-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.comp-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

