<div class="row g-4 fuel-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Trip Distance</label><div class="input-group"><input type="number" id="fc-dist" class="form-control form-control-lg" value="300" min="0"><select class="form-select form-select-lg" id="fc-dunit" style="max-width:100px"><option value="mi" selected>Miles</option><option value="km">Km</option></select></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Fuel Efficiency</label><div class="input-group"><input type="number" id="fc-mpg" class="form-control form-control-lg" value="28" step="0.1" min="1"><span class="input-group-text bg-light fw-bold" id="fc-eff-label">MPG</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Gas Price / Gallon</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="fc-price" class="form-control form-control-lg" value="3.50" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Round Trip?</label><select class="form-select form-select-lg rounded-3" id="fc-round"><option value="1">One Way</option><option value="2" selected>Round Trip</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Passengers to Split</label><input type="number" id="fc-pass" class="form-control form-control-lg rounded-3" value="1" min="1" max="10"></div>
                    <div class="col-md-4"><label class="form-label-custom">Trips per Month</label><input type="number" id="fc-freq" class="form-control form-control-lg rounded-3" value="1" min="0"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero"><span class="output-hero-label">TRIP FUEL COST</span><div class="output-hero-value" id="fc-total">$75.00</div><span class="output-hero-unit" id="fc-trip-label">600 mi Round Trip</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">GALLONS NEEDED</span><span class="stat-card-value text-danger" id="fc-gallons">21.4</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">COST PER MILE</span><span class="stat-card-value text-primary" id="fc-per-mile">$0.125</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">COST PER PERSON</span><span class="stat-card-value text-success" id="fc-per-person">$75.00</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">ANNUAL FUEL COST</span><span class="stat-card-value text-warning" id="fc-annual">$900</span></div></div>
            </div>
            <div class="mt-4" id="fc-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fc-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Estimate</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fc-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        let dist=parseFloat($('fc-dist').value)||0;
        const dunit=$('fc-dunit').value,mpg=parseFloat($('fc-mpg').value)||1;
        const price=parseFloat($('fc-price').value)||0,rt=parseInt($('fc-round').value);
        const pass=parseInt($('fc-pass').value)||1,freq=parseInt($('fc-freq').value)||0;
        if(dunit==='km')dist=dist*0.621371;
        const totalDist=dist*rt,gallons=totalDist/mpg;
        const cost=gallons*price,perMile=totalDist>0?cost/totalDist:0;
        const perPerson=cost/pass,annual=cost*freq*12;
        $('fc-total').textContent=fmt(cost);$('fc-trip-label').textContent=Math.round(totalDist)+' mi '+(rt===2?'Round Trip':'One Way');
        $('fc-gallons').textContent=gallons.toFixed(1);$('fc-per-mile').textContent=fmt(perMile);
        $('fc-per-person').textContent=fmt(perPerson);$('fc-annual').textContent=fmt(annual);
        let ins=[];ins.push('You need <strong>'+gallons.toFixed(1)+' gallons</strong> at '+fmt(price)+'/gal.');
        if(pass>1)ins.push('Split '+pass+' ways: <strong>'+fmt(perPerson)+'</strong> per person.');
        if(freq>0)ins.push('At '+freq+'x/month, annual fuel spend: <strong>'+fmt(annual)+'</strong>');
        const ev=totalDist*0.04;ins.push('EV comparison: Same trip would cost ~<strong>'+fmt(ev)+'</strong> in electricity ($0.04/mi avg).');
        $('fc-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Trip Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['fc-dist','fc-mpg','fc-price','fc-round','fc-pass','fc-freq','fc-dunit'].forEach(id=>$(id).addEventListener('input',calculate));
    $('fc-copy').addEventListener('click',function(){const t='Fuel Estimate\nCost: '+$('fc-total').textContent+'\nGallons: '+$('fc-gallons').textContent+'\nPer Person: '+$('fc-per-person').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('fc-reset').addEventListener('click',()=>{$('fc-dist').value=300;$('fc-mpg').value=28;$('fc-price').value=3.50;$('fc-round').value=2;$('fc-pass').value=1;$('fc-freq').value=1;calculate();});
    calculate();
});
</script>
<style>
.fuel-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.fuel-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.fuel-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.fuel-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.fuel-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.fuel-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\fuel-cost-calculator.blade.php ENDPATH**/ ?>