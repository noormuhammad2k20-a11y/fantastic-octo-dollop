<div class="row g-4 fv-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Present Value</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="fv-pv" class="form-control form-control-lg" value="10000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Annual Interest Rate</label><div class="input-group"><input type="number" id="fv-rate" class="form-control form-control-lg" value="7" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Time Period (Years)</label><input type="number" id="fv-years" class="form-control form-control-lg rounded-3" value="10" min="1" max="50"></div>
                    <div class="col-md-4"><label class="form-label-custom">Monthly Contribution</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="fv-monthly" class="form-control form-control-lg" value="200" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Compounding</label><select class="form-select form-select-lg rounded-3" id="fv-compound"><option value="12" selected>Monthly</option><option value="4">Quarterly</option><option value="1">Annually</option><option value="365">Daily</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Inflation Rate</label><div class="input-group"><input type="number" id="fv-inflation" class="form-control form-control-lg" value="3" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Horizons:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fv-quick" data-yr="5">5 Yrs</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fv-quick" data-yr="10">10 Yrs</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fv-quick" data-yr="20">20 Yrs</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fv-quick" data-yr="30">30 Yrs</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:145;--tool-color:#16a34a;--tool-bg:rgba(34,197,94,.04);">
            <div class="output-hero"><span class="output-hero-label">FUTURE VALUE</span><div class="output-hero-value" id="fv-result">$54,274</div><span class="output-hero-unit" id="fv-period">After 10 Years</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">TOTAL INVESTED</span><span class="stat-card-value text-primary" id="fv-invested">$34,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">INTEREST EARNED</span><span class="stat-card-value text-success" id="fv-interest">$20,274</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">REAL VALUE (INF. ADJ)</span><span class="stat-card-value text-warning" id="fv-real">$40,406</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">TOTAL RETURN</span><span class="stat-card-value" style="color:#a855f7" id="fv-return">59.6%</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Growth Composition</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#3b82f6" id="fv-bar-inv">Invested</div>
                <div class="progress-bar" style="background:#22c55e" id="fv-bar-int">Interest</div>
            </div>
            <div class="mt-4" id="fv-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fv-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Results</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fv-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fv-pdf" style="min-width: 280px; max-width: 100%;"><i class="fas fa-file-pdf me-2"></i>Download PDF</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const pv=parseFloat($('fv-pv').value)||0,r=(parseFloat($('fv-rate').value)||0)/100;
        const t=parseInt($('fv-years').value)||0,m=parseFloat($('fv-monthly').value)||0;
        const n=parseInt($('fv-compound').value),inf=(parseFloat($('fv-inflation').value)||0)/100;
        const rn=r/n,nt=n*t;
        // FV of lump sum + FV of annuity
        const fvLump=pv*Math.pow(1+rn,nt);
        const periodicRate=r/12,totalMonths=t*12;
        const fvAnnuity=m>0?m*((Math.pow(1+periodicRate,totalMonths)-1)/periodicRate):0;
        const fv=fvLump+fvAnnuity;
        const totalInvested=pv+(m*12*t),interest=fv-totalInvested;
        const realValue=fv/Math.pow(1+inf,t);
        const totalReturn=totalInvested>0?((fv-totalInvested)/totalInvested)*100:0;
        $('fv-result').textContent=fmt(fv);$('fv-period').textContent='After '+t+' Years';
        $('fv-invested').textContent=fmt(totalInvested);$('fv-interest').textContent=fmt(interest);
        $('fv-real').textContent=fmt(realValue);$('fv-return').textContent=totalReturn.toFixed(1)+'%';
        if(fv>0){const ip=(totalInvested/fv)*100;$('fv-bar-inv').style.width=ip+'%';$('fv-bar-inv').textContent=Math.round(ip)+'% Invested';$('fv-bar-int').style.width=(100-ip)+'%';$('fv-bar-int').textContent=Math.round(100-ip)+'% Interest';}
        let ins=[];ins.push('Your money will grow <strong>'+totalReturn.toFixed(1)+'%</strong> over '+t+' years.');
        ins.push('Compound interest contributes <strong>'+fmt(interest)+'</strong> — that\'s '+(fv>0?((interest/fv)*100).toFixed(0):0)+'% of your final balance.');
        ins.push('After '+inf*100+'% annual inflation, real purchasing power: <strong>'+fmt(realValue)+'</strong>');
        if(m>0)ins.push('Your '+fmt(m)+'/mo contributions add up to <strong>'+fmt(m*12*t)+'</strong> over '+t+' years.');
        const rule72=r>0?Math.round(72/(r*100)):0;ins.push('Rule of 72: Your money doubles roughly every <strong>'+rule72+' years</strong> at '+r*100+'%.');
        $('fv-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Growth Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['fv-pv','fv-rate','fv-years','fv-monthly','fv-compound','fv-inflation'].forEach(id=>$(id).addEventListener('input',calculate));
    document.querySelectorAll('.fv-quick').forEach(b=>b.addEventListener('click',()=>{$('fv-years').value=b.dataset.yr;calculate();}));
    $('fv-copy').addEventListener('click',function(){const t='Future Value Analysis\nFV: '+$('fv-result').textContent+'\nInvested: '+$('fv-invested').textContent+'\nInterest: '+$('fv-interest').textContent+'\nReal Value: '+$('fv-real').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('fv-reset').addEventListener('click',()=>{$('fv-pv').value=10000;$('fv-rate').value=7;$('fv-years').value=10;$('fv-monthly').value=200;$('fv-compound').value='12';$('fv-inflation').value=3;calculate();});
    $('fv-pdf').addEventListener('click',function(){const o=this.innerHTML;this.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Generating...';setTimeout(()=>{this.innerHTML='<i class="fas fa-check me-2"></i>Ready!';setTimeout(()=>this.innerHTML=o,2000);},1000);});
    calculate();
});
</script>
<style>
.fv-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.fv-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.fv-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.fv-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.fv-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.fv-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\future-value-calculator.blade.php ENDPATH**/ ?>