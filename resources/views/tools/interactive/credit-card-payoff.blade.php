<div class="row g-4 ccpay-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Current Balance</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cc-bal" class="form-control form-control-lg" value="5000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">APR</label><div class="input-group"><input type="number" id="cc-apr" class="form-control form-control-lg" value="22.99" step="0.01" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Monthly Payment</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cc-pmt" class="form-control form-control-lg" value="200" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Minimum Payment (%)</label><div class="input-group"><input type="number" id="cc-min" class="form-control form-control-lg" value="2" step="0.1" min="1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Extra Monthly Payment</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cc-extra" class="form-control form-control-lg" value="0" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero"><span class="output-hero-label">PAYOFF TIME</span><div class="output-hero-value" id="cc-months">31 months</div><span class="output-hero-unit" id="cc-date">Debt-free by Nov 2028</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">TOTAL INTEREST</span><span class="stat-card-value text-danger" id="cc-interest">$1,654</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">TOTAL PAID</span><span class="stat-card-value text-primary" id="cc-total">$6,654</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">MIN-PAY INTEREST</span><span class="stat-card-value text-success" id="cc-min-int">$8,432</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">YOU SAVE</span><span class="stat-card-value text-warning" id="cc-savings">$6,778</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Payment Allocation</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#3b82f6" id="cc-bar-prin">Principal</div>
                <div class="progress-bar" style="background:#ef4444" id="cc-bar-int">Interest</div>
            </div>
            <div class="mt-4" id="cc-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cc-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Plan</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cc-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function payoff(bal,apr,pmt){
        const mr=apr/100/12;let b=bal,months=0,totalInt=0;
        while(b>0&&months<600){const i=b*mr;totalInt+=i;b=b+i-pmt;months++;if(pmt<=i)return{months:999,totalInt:bal*10};}
        return{months,totalInt};
    }
    function payoffMin(bal,apr,minPct){
        const mr=apr/100/12;let b=bal,months=0,totalInt=0;
        while(b>1&&months<600){const mp=Math.max(b*(minPct/100),25);const i=b*mr;totalInt+=i;b=b+i-mp;months++;}
        return{months,totalInt};
    }
    function calculate(){
        const bal=parseFloat($('cc-bal').value)||0,apr=parseFloat($('cc-apr').value)||0;
        const pmt=parseFloat($('cc-pmt').value)||0,extra=parseFloat($('cc-extra').value)||0;
        const minPct=parseFloat($('cc-min').value)||2;
        const totalPmt=pmt+extra;
        const fixed=payoff(bal,apr,totalPmt);
        const minimum=payoffMin(bal,apr,minPct);
        const savings=minimum.totalInt-fixed.totalInt;
        const totalPaid=bal+fixed.totalInt;
        const now=new Date();now.setMonth(now.getMonth()+fixed.months);
        const dateStr=now.toLocaleDateString('en-US',{month:'short',year:'numeric'});
        $('cc-months').textContent=fixed.months>=999?'Never!':fixed.months+' months';
        $('cc-date').textContent=fixed.months>=999?'Payment too low!':'Debt-free by '+dateStr;
        $('cc-interest').textContent=fmt(fixed.totalInt);$('cc-total').textContent=fmt(totalPaid);
        $('cc-min-int').textContent=fmt(minimum.totalInt);$('cc-savings').textContent=fmt(Math.max(savings,0));
        if(totalPaid>0){const pp=(bal/totalPaid)*100;$('cc-bar-prin').style.width=pp+'%';$('cc-bar-prin').textContent=Math.round(pp)+'% Principal';$('cc-bar-int').style.width=(100-pp)+'%';$('cc-bar-int').textContent=Math.round(100-pp)+'% Interest';}
        let ins=[];
        if(fixed.months<999){ins.push('At '+fmt(totalPmt)+'/mo, you\'ll be debt-free in <strong>'+fixed.months+' months</strong>.');ins.push('Minimum payments would take <strong>'+minimum.months+' months</strong> and cost <strong>'+fmt(minimum.totalInt)+'</strong> in interest!');}
        else ins.push('<span class="text-danger fw-bold">⚠ Payment is less than monthly interest!</span> Increase to at least <strong>'+fmt(bal*apr/100/12+1)+'</strong>.');
        if(savings>0)ins.push('You save <strong>'+fmt(savings)+'</strong> vs minimum payments!');
        $('cc-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Payoff Strategy</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['cc-bal','cc-apr','cc-pmt','cc-min','cc-extra'].forEach(id=>$(id).addEventListener('input',calculate));
    $('cc-copy').addEventListener('click',function(){const t='CC Payoff Plan\nBalance: '+fmt(parseFloat($('cc-bal').value))+'\nAPR: '+$('cc-apr').value+'%\nPayoff: '+$('cc-months').textContent+'\nInterest: '+$('cc-interest').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('cc-reset').addEventListener('click',()=>{$('cc-bal').value=5000;$('cc-apr').value=22.99;$('cc-pmt').value=200;$('cc-min').value=2;$('cc-extra').value=0;calculate();});
    calculate();
});
</script>
<style>
.ccpay-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.ccpay-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.ccpay-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.ccpay-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.ccpay-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.ccpay-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

