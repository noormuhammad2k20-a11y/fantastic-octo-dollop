<div class="row g-4 mortpay-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Remaining Balance</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mp-bal" class="form-control form-control-lg" value="250000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Interest Rate</label><div class="input-group"><input type="number" id="mp-rate" class="form-control form-control-lg" value="6.5" step="0.01" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Remaining Years</label><input type="number" id="mp-years" class="form-control form-control-lg rounded-3" value="30" min="1" max="40"></div>
                    <div class="col-md-4"><label class="form-label-custom">Extra Monthly Payment</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mp-extra" class="form-control form-control-lg" value="200" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Bi-Weekly Payments?</label><select class="form-select form-select-lg rounded-3" id="mp-biweek"><option value="0" selected>No — Monthly</option><option value="1">Yes — Bi-Weekly</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">One-Time Lump Sum</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mp-lump" class="form-control form-control-lg" value="0" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero"><span class="output-hero-label">PAYOFF DATE</span><div class="output-hero-value" id="mp-date">Apr 2049</div><span class="output-hero-unit" id="mp-saved-label">Save 6 years & $89,204</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#0ea5e9;background:rgba(14,165,233,.02);"><span class="stat-card-label">MONTHLY PAYMENT</span><span class="stat-card-value text-info" id="mp-pmt">$1,580</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">TOTAL INTEREST</span><span class="stat-card-value text-danger" id="mp-interest">$229,432</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">INTEREST SAVED</span><span class="stat-card-value text-success" id="mp-int-saved">$89,204</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">YEARS SAVED</span><span class="stat-card-value text-warning" id="mp-yrs-saved">6.2</span></div></div>
            </div>
            <div class="mt-4" id="mp-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mp-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Plan</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mp-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function amort(bal,apr,months,extra){
        const mr=apr/100/12;
        const basePmt=mr>0?bal*(mr*Math.pow(1+mr,months))/(Math.pow(1+mr,months)-1):bal/months;
        let b=bal,totalInt=0,mo=0;
        while(b>0.01&&mo<months*2){const i=b*mr;totalInt+=i;const p=basePmt+extra-i;b=Math.max(b-p,0);mo++;}
        return{months:mo,totalInt,basePmt};
    }
    function calculate(){
        const bal=(parseFloat($('mp-bal').value)||0)-(parseFloat($('mp-lump').value)||0);
        const apr=parseFloat($('mp-rate').value)||0,years=parseInt($('mp-years').value)||30;
        const extra=parseFloat($('mp-extra').value)||0,biweek=parseInt($('mp-biweek').value);
        const months=years*12;
        const biExtra=biweek?amort(bal,apr,months,0).basePmt/12:0;
        const totalExtra=extra+biExtra;
        const withExtra=amort(bal,apr,months,totalExtra);
        const noExtra=amort(bal,apr,months,0);
        const intSaved=noExtra.totalInt-withExtra.totalInt;
        const moSaved=noExtra.months-withExtra.months;
        const now=new Date();now.setMonth(now.getMonth()+withExtra.months);
        $('mp-date').textContent=now.toLocaleDateString('en-US',{month:'short',year:'numeric'});
        $('mp-saved-label').textContent='Save '+(moSaved/12).toFixed(1)+' years & '+fmt(intSaved);
        $('mp-pmt').textContent=fmt(withExtra.basePmt+totalExtra);
        $('mp-interest').textContent=fmt(withExtra.totalInt);
        $('mp-int-saved').textContent=fmt(intSaved);
        $('mp-yrs-saved').textContent=(moSaved/12).toFixed(1);
        let ins=[];
        ins.push('Base payment: <strong>'+fmt(withExtra.basePmt)+'/mo</strong> + '+fmt(totalExtra)+' extra');
        ins.push('Without extra payments: <strong>'+noExtra.months+' months</strong> ('+fmt(noExtra.totalInt)+' interest)');
        ins.push('With extra payments: <strong>'+withExtra.months+' months</strong> — <strong>'+moSaved+' months earlier!</strong>');
        if(biweek)ins.push('Bi-weekly adds ~1 extra payment/year: <strong>'+fmt(biExtra)+'/mo equivalent</strong>');
        $('mp-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Payoff Strategy</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['mp-bal','mp-rate','mp-years','mp-extra','mp-biweek','mp-lump'].forEach(id=>$(id).addEventListener('input',calculate));
    $('mp-copy').addEventListener('click',function(){const t='Mortgage Payoff\nPayoff: '+$('mp-date').textContent+'\nPayment: '+$('mp-pmt').textContent+'/mo\nInterest Saved: '+$('mp-int-saved').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('mp-reset').addEventListener('click',()=>{$('mp-bal').value=250000;$('mp-rate').value=6.5;$('mp-years').value=30;$('mp-extra').value=200;$('mp-biweek').value='0';$('mp-lump').value=0;calculate();});
    calculate();
});
</script>
<style>
.mortpay-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.mortpay-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.mortpay-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.mortpay-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.mortpay-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.mortpay-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

