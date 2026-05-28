<div class="row g-4 etax-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Total Taxable Income (Annual)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="et-income" class="form-control form-control-lg" value="75000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Total Tax Paid</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="et-paid" class="form-control form-control-lg" value="12000" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero"><span class="output-hero-label">EFFECTIVE TAX RATE</span><div class="output-hero-value" id="et-rate">16.0%</div><span class="output-hero-unit" id="et-status">STANDARD TAX BURDEN</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">NET TAKE-HOME</span><span class="stat-card-value text-success" id="et-net">$63,000</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">MONTHLY (NET)</span><span class="stat-card-value text-primary" id="et-monthly">$5,250</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">KEEP RATIO</span><span class="stat-card-value text-warning" id="et-ratio">84.0%</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Income Allocation</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#22c55e" id="et-bar-net">Net Income</div>
                <div class="progress-bar" style="background:#ef4444" id="et-bar-tax">Tax Paid</div>
            </div>
            <div class="mt-4" id="et-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="et-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Analysis</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="et-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const income=parseFloat($('et-income').value)||0,paid=parseFloat($('et-paid').value)||0;
        if(income===0){$('et-rate').textContent='0%';return;}
        const rate=(paid/income)*100,net=income-paid,ratio=(net/income)*100;
        $('et-rate').textContent=rate.toFixed(1)+'%';$('et-net').textContent=fmt(net);
        $('et-monthly').textContent=fmt(net/12);$('et-ratio').textContent=ratio.toFixed(1)+'%';
        if(rate<=15){$('et-status').textContent='LOW TAX BURDEN';$('et-status').style.color='#22c55e';}
        else if(rate<=25){$('et-status').textContent='STANDARD TAX BURDEN';$('et-status').style.color='#3b82f6';}
        else{$('et-status').textContent='HIGH TAX BURDEN';$('et-status').style.color='#ef4444';}
        if(income>0){
            $('et-bar-net').style.width=ratio+'%';$('et-bar-net').textContent=Math.round(ratio)+'% Keep';
            $('et-bar-tax').style.width=(100-ratio)+'%';$('et-bar-tax').textContent=Math.round(100-ratio)+'% Tax';
        }
        let ins=[];ins.push('Out of every dollar earned, you keep <strong>'+(ratio/100).toFixed(2)+'</strong> cents.');
        ins.push('Your effective rate of <strong>'+rate.toFixed(1)+'%</strong> is the actual percentage of your income paid in taxes.');
        if(rate>30)ins.push('⚠️ High effective rate! Consider reviewing available deductions or credits.');
        $('et-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Tax Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['et-income','et-paid'].forEach(id=>$(id).addEventListener('input',calculate));
    $('et-copy').addEventListener('click',function(){const t='Tax Analysis\nIncome: '+$('et-income').value+'\nTax Paid: '+$('et-paid').value+'\nEffective Rate: '+$('et-rate').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('et-reset').addEventListener('click',()=>{$('et-income').value=75000;$('et-paid').value=12000;calculate();});
    calculate();
});
</script>
<style>
.etax-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.etax-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.etax-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.etax-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.etax-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.etax-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\effective-tax-rate-calculator.blade.php ENDPATH**/ ?>