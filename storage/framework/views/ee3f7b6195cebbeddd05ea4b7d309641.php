<div class="row g-4 elec-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Appliance Wattage</label><div class="input-group"><input type="number" id="el-watts" class="form-control form-control-lg" value="1000" min="0"><span class="input-group-text bg-light fw-bold">W</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Hours Used / Day</label><div class="input-group"><input type="number" id="el-hours" class="form-control form-control-lg" value="8" step="0.5" min="0" max="24"><span class="input-group-text bg-light fw-bold">hrs</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Electricity Rate</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="el-rate" class="form-control form-control-lg" value="0.12" step="0.01" min="0"><span class="input-group-text bg-light fw-bold">/kWh</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Days Used / Month</label><input type="number" id="el-days" class="form-control form-control-lg rounded-3" value="30" min="1" max="31"></div>
                    <div class="col-md-4"><label class="form-label-custom">Number of Appliances</label><input type="number" id="el-qty" class="form-control form-control-lg rounded-3" value="1" min="1"></div>
                    <div class="col-md-4"><label class="form-label-custom">Standby Power (W)</label><div class="input-group"><input type="number" id="el-standby" class="form-control form-control-lg" value="0" min="0"><span class="input-group-text bg-light fw-bold">W</span></div></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 el-pre" data-w="60">💡 LED Bulb (60W)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 el-pre" data-w="1500">🔥 Space Heater</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 el-pre" data-w="150">🖥 Desktop PC</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 el-pre" data-w="5000">❄ Central AC</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero"><span class="output-hero-label">MONTHLY COST</span><div class="output-hero-value" id="el-monthly">$28.80</div><span class="output-hero-unit" id="el-kwh-label">240 kWh/month</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#0ea5e9;background:rgba(14,165,233,.02);"><span class="stat-card-label">DAILY COST</span><span class="stat-card-value text-info" id="el-daily">$0.96</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">ANNUAL COST</span><span class="stat-card-value text-danger" id="el-annual">$345.60</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">DAILY kWh</span><span class="stat-card-value text-success" id="el-dkwh">8.0</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">CO₂ / YEAR</span><span class="stat-card-value text-warning" id="el-co2">2,074 lbs</span></div></div>
            </div>
            <div class="mt-4" id="el-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="el-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Estimate</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="el-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const watts=parseFloat($('el-watts').value)||0,hrs=parseFloat($('el-hours').value)||0;
        const rate=parseFloat($('el-rate').value)||0,days=parseInt($('el-days').value)||0;
        const qty=parseInt($('el-qty').value)||1,standby=parseFloat($('el-standby').value)||0;
        const activeKwh=(watts*hrs*qty)/1000;
        const standbyKwh=(standby*(24-hrs)*qty)/1000;
        const dailyKwh=activeKwh+standbyKwh;
        const monthlyKwh=dailyKwh*days,annualKwh=monthlyKwh*12;
        const dailyCost=dailyKwh*rate,monthlyCost=monthlyKwh*rate,annualCost=annualKwh*rate;
        const co2=annualKwh*0.72;
        $('el-monthly').textContent=fmt(monthlyCost);$('el-kwh-label').textContent=monthlyKwh.toFixed(0)+' kWh/month';
        $('el-daily').textContent=fmt(dailyCost);$('el-annual').textContent=fmt(annualCost);
        $('el-dkwh').textContent=dailyKwh.toFixed(1);$('el-co2').textContent=Math.round(co2).toLocaleString()+' lbs';
        let ins=[];ins.push('Running '+watts+'W for '+hrs+'h/day = <strong>'+dailyKwh.toFixed(1)+' kWh/day</strong>');
        if(standby>0)ins.push('Standby power adds <strong>'+standbyKwh.toFixed(2)+' kWh/day</strong> ('+fmt(standbyKwh*rate*365)+'/yr!)');
        ins.push('5-year cost projection: <strong>'+fmt(annualCost*5)+'</strong>');
        ins.push('Carbon footprint: <strong>'+Math.round(co2)+' lbs CO₂/year</strong> (US grid average)');
        $('el-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Energy Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['el-watts','el-hours','el-rate','el-days','el-qty','el-standby'].forEach(id=>$(id).addEventListener('input',calculate));
    document.querySelectorAll('.el-pre').forEach(b=>b.addEventListener('click',()=>{$('el-watts').value=b.dataset.w;calculate();}));
    $('el-copy').addEventListener('click',function(){const t='Electricity Estimate\nMonthly: '+$('el-monthly').textContent+'\nAnnual: '+$('el-annual').textContent+'\nkWh/month: '+$('el-kwh-label').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('el-reset').addEventListener('click',()=>{$('el-watts').value=1000;$('el-hours').value=8;$('el-rate').value=0.12;$('el-days').value=30;$('el-qty').value=1;$('el-standby').value=0;calculate();});
    calculate();
});
</script>
<style>
.elec-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.elec-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.elec-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.elec-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.elec-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.elec-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\electric-cost-calculator.blade.php ENDPATH**/ ?>