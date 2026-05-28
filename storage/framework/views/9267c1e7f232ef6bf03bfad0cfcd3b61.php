<div class="row g-4 taxw-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Annual Gross Salary</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="tw-salary" class="form-control form-control-lg" value="65000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Filing Status</label><select id="tw-status" class="form-select form-select-lg rounded-3"><option value="single" selected>Single</option><option value="married">Married (Jointly)</option><option value="head">Head of Household</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Pay Frequency</label><select id="tw-freq" class="form-select form-select-lg rounded-3"><option value="52">Weekly</option><option value="26">Bi-Weekly</option><option value="12" selected>Monthly</option><option value="1">Annually</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Children (Credits)</label><input type="number" id="tw-deps" class="form-control form-control-lg rounded-3" value="0" min="0" max="10"></div>
                    <div class="col-md-4"><label class="form-label-custom">Extra Withholding</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="tw-extra" class="form-control form-control-lg" value="0" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:25;--tool-color:#f97316;--tool-bg:rgba(249,115,22,.04);">
            <div class="output-hero"><span class="output-hero-label" id="tw-hero-label">MONTHLY TAKE-HOME PAY</span><div class="output-hero-value" id="tw-net">$4,250</div><span class="output-hero-unit" id="tw-eff-rate">19.5% Effective Tax Rate</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">FEDERAL TAX</span><span class="stat-card-value text-danger" id="tw-fed">$540</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">FICA (SS+MED)</span><span class="stat-card-value text-primary" id="tw-fica">$380</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">TOTAL TAXES</span><span class="stat-card-value text-success" id="tw-total-tax">$920</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">ANNUAL NET</span><span class="stat-card-value" style="color:#a855f7" id="tw-annual-net">$51,000</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Paycheck Allocation</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#22c55e" id="tw-bar-net">Net Pay</div>
                <div class="progress-bar" style="background:#ef4444" id="tw-bar-fed">Fed Tax</div>
                <div class="progress-bar" style="background:#3b82f6" id="tw-bar-fica">FICA</div>
            </div>
            <div class="mt-4" id="tw-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tw-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Breakdown</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tw-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const salary=parseFloat($('tw-salary').value)||0,status=$('tw-status').value;
        const freq=parseInt($('tw-freq').value),deps=parseInt($('tw-deps').value)||0;
        const extra=parseFloat($('tw-extra').value)||0;
        const stdDeduction={'single':15000,'married':30000,'head':22500}[status];
        const taxable=Math.max(0,salary-stdDeduction);
        let fed=0;
        const brackets=status==='married'?[{l:23850,r:0.10},{l:96950,r:0.12},{l:206700,r:0.22},{l:394600,r:0.24},{l:501050,r:0.32},{l:752700,r:0.35},{l:Infinity,r:0.37}]
                                          :[{l:11925,r:0.10},{l:48475,r:0.12},{l:103350,r:0.22},{l:197300,r:0.24},{l:250525,r:0.32},{l:626350,r:0.35},{l:Infinity,r:0.37}];
        let pL=0;for(const b of brackets){if(taxable>b.l){fed+=(b.l-pL)*b.r;pL=b.l;}else{fed+=(taxable-pL)*b.r;break;}}
        const credits=deps*2000;fed=Math.max(0,fed-credits)+(extra*freq);
        const ssTax=Math.min(salary,176100)*0.062,medTax=salary*0.0145,fica=ssTax+medTax;
        const totalTax=fed+fica,net=salary-totalTax,effRate=salary>0?(totalTax/salary)*100:0;
        const fText=$('tw-freq').options[$('tw-freq').selectedIndex].text;
        $('tw-hero-label').textContent=fText.toUpperCase()+' TAKE-HOME PAY';
        $('tw-net').textContent=fmt(net/freq);$('tw-fed').textContent=fmt(fed/freq);
        $('tw-fica').textContent=fmt(fica/freq);$('tw-total-tax').textContent=fmt(totalTax/freq);
        $('tw-annual-net').textContent=fmt(net);$('tw-eff-rate').textContent=effRate.toFixed(1)+'% Effective Tax Rate';
        if(salary>0){
            const np=(net/salary)*100,fp=(fed/salary)*100,fcp=(fica/salary)*100;
            $('tw-bar-net').style.width=np+'%';$('tw-bar-net').textContent=Math.round(np)+'%';
            $('tw-bar-fed').style.width=fp+'%';$('tw-bar-fed').textContent=Math.round(fp)+'%';
            $('tw-bar-fica').style.width=fcp+'%';$('tw-bar-fica').textContent=Math.round(fcp)+'%';
        }
        let ins=[];ins.push('Annual Federal Tax: <strong>'+fmt(fed)+'</strong>');
        ins.push('Total FICA (SS+Med): <strong>'+fmt(fica)+'</strong>');
        if(deps>0)ins.push('Child Tax Credit saves you <strong>'+fmt(credits)+'</strong> annually.');
        ins.push('Estimated 2026 tax brackets applied.');
        $('tw-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Tax Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['tw-salary','tw-status','tw-freq','tw-deps','tw-extra'].forEach(id=>$(id).addEventListener('input',calculate));
    $('tw-copy').addEventListener('click',function(){const t='Withholding Estimate\nTake-Home: '+$('tw-net').textContent+' ('+$('tw-freq').options[$('tw-freq').selectedIndex].text+')\nTax Rate: '+$('tw-eff-rate').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('tw-reset').addEventListener('click',()=>{$('tw-salary').value=65000;$('tw-status').value='single';$('tw-freq').value='12';$('tw-deps').value=0;$('tw-extra').value=0;calculate();});
    calculate();
});
</script>
<style>
.taxw-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.taxw-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.taxw-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.taxw-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.taxw-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.taxw-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\tax-withholding-calculator.blade.php ENDPATH**/ ?>