<div class="row g-4 epf-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Current EPF Balance (RM)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">RM</span><input type="number" id="epf-bal" class="form-control form-control-lg" value="50000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Monthly Contribution (RM)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">RM</span><input type="number" id="epf-monthly" class="form-control form-control-lg" value="1000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Expected Dividend (%)</label><div class="input-group"><input type="number" id="epf-rate" class="form-control form-control-lg" value="5.5" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Current Age</label><input type="number" id="epf-cage" class="form-control form-control-lg rounded-3" value="30" min="1"></div>
                    <div class="col-md-4"><label class="form-label-custom">Retirement Age</label><input type="number" id="epf-rage" class="form-control form-control-lg rounded-3" value="60" min="1"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero"><span class="output-hero-label">ESTIMATED TOTAL AT RETIREMENT</span><div class="output-hero-value" id="epf-total">RM 1,114,832</div><span class="output-hero-unit" id="epf-label">In 30 Years (Age 60)</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#10b981;background:rgba(16,185,129,.02);"><span class="stat-card-label">TOTAL CONTRIBUTIONS</span><span class="stat-card-value text-success" id="epf-contrib">RM 410,000</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">INTEREST EARNED</span><span class="stat-card-value text-primary" id="epf-int">RM 704,832</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">YEARS TO GROW</span><span class="stat-card-value text-warning" id="epf-yrs">30 Years</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Savings Composition</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#10b981" id="epf-bar-contrib">Contributions</div>
                <div class="progress-bar" style="background:#3b82f6" id="epf-bar-int">Interest</div>
            </div>
            <div class="mt-4" id="epf-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="epf-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Estimation</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="epf-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'RM '+Math.round(v).toLocaleString();}
    function calculate(){
        const bal=parseFloat($('epf-bal').value)||0,monthly=parseFloat($('epf-monthly').value)||0;
        const rate=(parseFloat($('epf-rate').value)||0)/100,cage=parseInt($('epf-cage').value)||0,rage=parseInt($('epf-rage').value)||0;
        const yrs=rage-cage;
        if(yrs<=0){
            $('epf-total').textContent=fmt(bal);$('epf-label').textContent='Already Retired';
            $('epf-contrib').textContent=fmt(0);$('epf-int').textContent=fmt(0);$('epf-yrs').textContent='0 Years';
            return;
        }
        const mr=rate/12,months=yrs*12;
        const fvBal=bal*Math.pow(1+mr,months);
        const fvContrib=mr>0?monthly*(Math.pow(1+mr,months)-1)/mr:monthly*months;
        const total=fvBal+fvContrib,totalContrib=bal+(monthly*months),totalInt=total-totalContrib;
        $('epf-total').textContent=fmt(total);$('epf-label').textContent='In '+yrs+' Years (Age '+rage+')';
        $('epf-contrib').textContent=fmt(totalContrib);$('epf-int').textContent=fmt(totalInt);$('epf-yrs').textContent=yrs+' Years';
        if(total>0){const cp=(totalContrib/total)*100;$('epf-bar-contrib').style.width=cp+'%';$('epf-bar-contrib').textContent=Math.round(cp)+'% Principal';$('epf-bar-int').style.width=(100-cp)+'%';$('epf-bar-int').textContent=Math.round(100-cp)+'% Interest';}
        let ins=[];ins.push('Interest will account for <strong>'+(total>0?((totalInt/total)*100).toFixed(1):0)+'%</strong> of your final corpus.');
        ins.push('Total monthly contributions over '+yrs+' years: <strong>'+fmt(monthly*months)+'</strong>');
        if(rate>=0.06)ins.push('🎉 High dividend projection! Consistently beating inflation.');
        $('epf-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Retirement Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['epf-bal','epf-monthly','epf-rate','epf-cage','epf-rage'].forEach(id=>$(id).addEventListener('input',calculate));
    $('epf-copy').addEventListener('click',function(){const t='EPF Retirement Estimate\nTotal: '+$('epf-total').textContent+'\nInterest: '+$('epf-int').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('epf-reset').addEventListener('click',()=>{$('epf-bal').value=50000;$('epf-monthly').value=1000;$('epf-rate').value=5.5;$('epf-cage').value=30;$('epf-rage').value=60;calculate();});
    calculate();
});
</script>
<style>
.epf-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.epf-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.epf-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.epf-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.epf-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.epf-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

