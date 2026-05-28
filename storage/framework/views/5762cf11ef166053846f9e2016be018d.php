<div class="row g-4 morta-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Home Loan Amount</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ma-amt" class="form-control form-control-lg" value="300000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Interest Rate (Annual)</label><div class="input-group"><input type="number" id="ma-rate" class="form-control form-control-lg" value="6.5" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Loan Term (Years)</label><input type="number" id="ma-years" class="form-control form-control-lg rounded-3" value="30" min="1" max="50"></div>
                    <div class="col-md-6"><label class="form-label-custom">Extra Monthly Payment</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ma-extra" class="form-control form-control-lg" value="0" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero"><span class="output-hero-label">MONTHLY PRINCIPAL & INTEREST</span><div class="output-hero-value" id="ma-emi">$1,896</div><span class="output-hero-unit" id="ma-payoff-info">360 monthly payments</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">TOTAL INTEREST</span><span class="stat-card-value text-primary" id="ma-int">$382,633</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">TOTAL PAYOFF</span><span class="stat-card-value text-success" id="ma-total">$682,633</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">INTEREST RATIO</span><span class="stat-card-value text-danger" id="ma-ratio">56.1%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">INTEREST SAVED</span><span class="stat-card-value text-warning" id="ma-savings">$0</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Repayment Mix</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#3b82f6" id="ma-bar-prin">Principal</div>
                <div class="progress-bar" style="background:#ef4444" id="ma-bar-int">Interest</div>
            </div>
            <div class="mt-4" id="ma-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ma-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Breakdown</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ma-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const P=parseFloat($('ma-amt').value)||0,rate=(parseFloat($('ma-rate').value)||0)/100;
        const yrs=parseInt($('ma-years').value)||1,extra=parseFloat($('ma-extra').value)||0;
        const mRate=rate/12,totalMo=yrs*12;
        const emi=P*(mRate*Math.pow(1+mRate,totalMo))/(Math.pow(1+mRate,totalMo)-1);
        
        let b1=P,i1=0;for(let m=1;m<=totalMo;m++){let int=b1*mRate;i1+=int;b1-=(emi-int);}
        let b2=P,i2=0,mo=0;while(b2>0.01&&mo<600){mo++;let int=b2*mRate;let prin=Math.min(emi+extra-int,b2);i2+=int;b2-=prin;}
        
        const total=P+i2,savings=i1-i2;
        $('ma-emi').textContent=fmt(emi);$('ma-payoff-info').textContent='Payoff in '+mo+' months';
        $('ma-int').textContent=fmt(i2);$('ma-total').textContent=fmt(total);
        $('ma-ratio').textContent=((i2/total)*100).toFixed(1)+'%';
        $('ma-savings').textContent=fmt(Math.max(0,savings));
        if(total>0){const pp=(P/total)*100;$('ma-bar-prin').style.width=pp+'%';$('ma-bar-prin').textContent=Math.round(pp)+'% Principal';$('ma-bar-int').style.width=(100-pp)+'%';$('ma-bar-int').textContent=Math.round(100-pp)+'% Interest';}
        let ins=[];ins.push('Base monthly payment: <strong>'+fmt(emi)+'</strong>');
        if(extra>0)ins.push('Your extra payments save you <strong>'+fmt(savings)+'</strong> in interest and shave off <strong>'+(totalMo-mo)+'</strong> months.');
        ins.push('Over '+yrs+' years, you will pay <strong>'+fmt(i2)+'</strong> in interest.');
        $('ma-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Mortgage Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['ma-amt','ma-rate','ma-years','ma-extra'].forEach(id=>$(id).addEventListener('input',calculate));
    $('ma-copy').addEventListener('click',function(){const t='Mortgage Analysis\nMonthly P&I: '+$('ma-emi').textContent+'\nTotal Interest: '+$('ma-int').textContent+'\nInterest Saved: '+$('ma-savings').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('ma-reset').addEventListener('click',()=>{$('ma-amt').value=300000;$('ma-rate').value=6.5;$('ma-years').value=30;$('ma-extra').value=0;calculate();});
    calculate();
});
</script>
<style>
.morta-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.morta-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.morta-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.morta-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.morta-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.morta-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mortgage-amortization-calculator.blade.php ENDPATH**/ ?>