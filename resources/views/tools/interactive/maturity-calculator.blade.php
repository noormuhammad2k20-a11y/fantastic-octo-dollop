<div class="row g-4 mat-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Principal Amount</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mt-principal" class="form-control form-control-lg" value="10000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Annual Interest Rate</label><div class="input-group"><input type="number" id="mt-rate" class="form-control form-control-lg" value="5.0" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Term (Months)</label><input type="number" id="mt-term" class="form-control form-control-lg rounded-3" value="24" min="1"></div>
                    <div class="col-md-6"><label class="form-label-custom">Compounding</label><select class="form-select form-select-lg rounded-3" id="mt-comp"><option value="12" selected>Monthly</option><option value="4">Quarterly</option><option value="2">Semi-Annual</option><option value="1">Annual</option></select></div>
                    <div class="col-md-6"><label class="form-label-custom">Tax on Interest</label><div class="input-group"><input type="number" id="mt-tax" class="form-control form-control-lg" value="0" min="0" max="50"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:270;--tool-color:#7c3aed;--tool-bg:rgba(168,85,247,.04);">
            <div class="output-hero"><span class="output-hero-label">MATURITY VALUE</span><div class="output-hero-value" id="mt-value">$11,049</div><span class="output-hero-unit" id="mt-label">24-Month Term</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">INTEREST EARNED</span><span class="stat-card-value text-success" id="mt-interest">$1,049</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">EFFECTIVE YIELD</span><span class="stat-card-value text-primary" id="mt-yield">5.12%</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">AFTER-TAX RETURN</span><span class="stat-card-value text-warning" id="mt-after-tax">$1,049</span></div></div>
            </div>
            <div class="mt-4" id="mt-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mt-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Results</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mt-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const P=parseFloat($('mt-principal').value)||0,r=(parseFloat($('mt-rate').value)||0)/100;
        const tMo=parseInt($('mt-term').value)||0,n=parseInt($('mt-comp').value);
        const tax=(parseFloat($('mt-tax').value)||0)/100,tYr=tMo/12;
        const A=P*Math.pow(1+r/n,n*tYr),interest=A-P;
        const apy=(Math.pow(1+r/n,n)-1)*100;
        const afterTax=interest*(1-tax);
        $('mt-value').textContent=fmt(A);$('mt-label').textContent=tMo+'-Month Term';
        $('mt-interest').textContent=fmt(interest);$('mt-yield').textContent=apy.toFixed(2)+'%';
        $('mt-after-tax').textContent=fmt(afterTax);
        let ins=[];ins.push('Effective annual yield: <strong>'+apy.toFixed(2)+'%</strong> (compounding adds '+(apy-r*100).toFixed(2)+'%)');
        ins.push('Monthly interest income: <strong>'+fmt(interest/tMo)+'/mo</strong>');
        if(tax>0)ins.push('Tax reduces earnings by <strong>'+fmt(interest*tax)+'</strong> ('+Math.round(tax*100)+'% bracket)');
        $('mt-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['mt-principal','mt-rate','mt-term','mt-comp','mt-tax'].forEach(id=>$(id).addEventListener('input',calculate));
    $('mt-copy').addEventListener('click',function(){const t='Maturity Report\nValue: '+$('mt-value').textContent+'\nInterest: '+$('mt-interest').textContent+'\nYield: '+$('mt-yield').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('mt-reset').addEventListener('click',()=>{$('mt-principal').value=10000;$('mt-rate').value=5;$('mt-term').value=24;$('mt-comp').value='12';$('mt-tax').value=0;calculate();});
    calculate();
});
</script>
<style>
.mat-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.mat-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.mat-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.mat-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.mat-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.mat-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

