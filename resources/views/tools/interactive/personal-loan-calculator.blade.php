<div class="row g-4 ploan-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Loan Amount</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="pl-amount" class="form-control form-control-lg" value="30000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Interest Rate (APR)</label><div class="input-group"><input type="number" id="pl-rate" class="form-control form-control-lg" value="10.5" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Loan Term (Years)</label><input type="number" id="pl-term" class="form-control form-control-lg rounded-3" value="5" min="1" max="30"></div>
                    <div class="col-md-4"><label class="form-label-custom">Payment Frequency</label><select id="pl-freq" class="form-select form-select-lg rounded-3"><option value="52">Weekly</option><option value="26">Bi-Weekly</option><option value="12" selected>Monthly</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Extra Payment / Month</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="pl-extra" class="form-control form-control-lg" value="0" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero"><span class="output-hero-label" id="pl-hero-label">MONTHLY PAYMENT</span><div class="output-hero-value" id="pl-emi">$644</div><span class="output-hero-unit" id="pl-date-label">Payoff in 60 months</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">TOTAL INTEREST</span><span class="stat-card-value text-primary" id="pl-int">$8,640</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">TOTAL REPAYMENT</span><span class="stat-card-value text-success" id="pl-total">$38,640</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">INTEREST RATIO</span><span class="stat-card-value text-danger" id="pl-ratio">22.4%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">INTEREST SAVED</span><span class="stat-card-value text-warning" id="pl-savings">$0</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Repayment Breakdown</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#22c55e" id="pl-bar-prin">Principal</div>
                <div class="progress-bar" style="background:#ef4444" id="pl-bar-int">Interest</div>
            </div>
            <div class="mt-4" id="pl-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="pl-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="pl-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const P=parseFloat($('pl-amount').value)||0,apr=(parseFloat($('pl-rate').value)||0)/100;
        const years=parseFloat($('pl-term').value)||0,freq=parseInt($('pl-freq').value);
        const extra=parseFloat($('pl-extra').value)||0;
        const r=apr/freq,n=years*freq;
        const emi=r>0?(P*r*Math.pow(1+r,n))/(Math.pow(1+r,n)-1):P/n;
        
        let bal=P,totalInt=0,mo=0,totalIntNoExtra=0,balNo=P;
        for(let i=1;i<=n;i++){let iNo=balNo*r;totalIntNoExtra+=iNo;balNo-=(emi-iNo);}
        while(bal>0.01&&mo<600){mo++;let interest=bal*r;let prin=Math.min(emi-interest+extra,bal);totalInt+=interest;bal-=prin;}
        
        const total=P+totalInt,savings=totalIntNoExtra-totalInt;
        const freqText=$('pl-freq').options[$('pl-freq').selectedIndex].text;
        $('pl-hero-label').textContent=freqText.toUpperCase()+' PAYMENT';
        $('pl-emi').textContent=fmt(emi+extra);$('pl-date-label').textContent='Payoff in '+mo+' periods';
        $('pl-int').textContent=fmt(totalInt);$('pl-total').textContent=fmt(total);
        $('pl-ratio').textContent=((totalInt/total)*100).toFixed(1)+'%';
        $('pl-savings').textContent=fmt(Math.max(0,savings));
        if(total>0){const pp=(P/total)*100;$('pl-bar-prin').style.width=pp+'%';$('pl-bar-prin').textContent=Math.round(pp)+'% Principal';$('pl-bar-int').style.width=(100-pp)+'%';$('pl-bar-int').textContent=Math.round(100-pp)+'% Interest';}
        let ins=[];ins.push('Base payment: <strong>'+fmt(emi)+'</strong> + '+fmt(extra)+' extra');
        if(savings>0)ins.push('Extra payments save you <strong>'+fmt(savings)+'</strong> in interest!');
        ins.push('Total cost of borrowing: <strong>'+fmt(totalInt)+'</strong> over '+years+' years.');
        $('pl-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Loan Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['pl-amount','pl-rate','pl-term','pl-freq','pl-extra'].forEach(id=>$(id).addEventListener('input',calculate));
    $('pl-copy').addEventListener('click',function(){const t='Personal Loan Summary\nPayment: '+$('pl-emi').textContent+'\nTotal Interest: '+$('pl-int').textContent+'\nSavings: '+$('pl-savings').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('pl-reset').addEventListener('click',()=>{$('pl-amount').value=30000;$('pl-rate').value=10.5;$('pl-term').value=5;$('pl-freq').value='12';$('pl-extra').value=0;calculate();});
    calculate();
});
</script>
<style>
.ploan-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.ploan-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.ploan-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.ploan-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.ploan-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.ploan-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

