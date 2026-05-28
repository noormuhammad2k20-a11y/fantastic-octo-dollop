<div class="row g-4 moving-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Home Size</label><select class="form-select form-select-lg rounded-3" id="mv-size"><option value="1200">Studio/1BR</option><option value="2500" selected>2-3 BR</option><option value="5000">4+ BR</option><option value="8000">Large Home</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Distance (miles)</label><input type="number" id="mv-dist" class="form-control form-control-lg rounded-3" value="500" min="1"></div>
                    <div class="col-md-4"><label class="form-label-custom">Move Type</label><select class="form-select form-select-lg rounded-3" id="mv-type"><option value="local">Local (&lt; 100 mi)</option><option value="long" selected>Long Distance</option><option value="cross">Cross Country</option></select></div>
                    <div class="col-md-3"><label class="form-label-custom">Packing Service</label><select class="form-select form-select-lg rounded-3" id="mv-pack"><option value="0">Self-Pack</option><option value="500" selected>Partial ($500)</option><option value="1200">Full ($1,200)</option></select></div>
                    <div class="col-md-3"><label class="form-label-custom">Storage (months)</label><input type="number" id="mv-storage" class="form-control form-control-lg rounded-3" value="0" min="0" max="12"></div>
                    <div class="col-md-3"><label class="form-label-custom">Insurance</label><select class="form-select form-select-lg rounded-3" id="mv-ins"><option value="0">Basic (free)</option><option value="200" selected>Standard ($200)</option><option value="500">Premium ($500)</option></select></div>
                    <div class="col-md-3"><label class="form-label-custom">Season</label><select class="form-select form-select-lg rounded-3" id="mv-season"><option value="1.0">Off-Season</option><option value="1.15">Spring</option><option value="1.3" selected>Summer (Peak)</option><option value="1.1">Fall</option></select></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:145;--tool-color:#16a34a;--tool-bg:rgba(34,197,94,.04);">
            <div class="output-hero"><span class="output-hero-label">ESTIMATED MOVING COST</span><div class="output-hero-value" id="mv-total">$4,550</div><span class="output-hero-unit" id="mv-label">Long Distance · 500 mi</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">BASE COST</span><span class="stat-card-value text-success" id="mv-base">$3,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">SERVICES</span><span class="stat-card-value text-primary" id="mv-services">$700</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">SEASONAL MARKUP</span><span class="stat-card-value text-warning" id="mv-markup">$850</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">TIP (15%)</span><span class="stat-card-value" style="color:#a855f7" id="mv-tip">$683</span></div></div>
            </div>
            <div class="mt-4" id="mv-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mv-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Estimate</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mv-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const lbs=parseInt($('mv-size').value),dist=parseInt($('mv-dist').value)||0;
        const pack=parseInt($('mv-pack').value),storage=parseInt($('mv-storage').value)*150;
        const ins=parseInt($('mv-ins').value),season=parseFloat($('mv-season').value);
        const baseCost=dist<=100?lbs*0.5:lbs*0.5+(dist*0.5);
        const services=pack+storage+ins;
        const subtotal=baseCost+services;
        const total=subtotal*season;
        const markup=total-subtotal;
        const tip=total*0.15;
        $('mv-total').textContent=fmt(total);$('mv-label').textContent=$('mv-type').options[$('mv-type').selectedIndex].text+' · '+dist+' mi';
        $('mv-base').textContent=fmt(baseCost);$('mv-services').textContent=fmt(services);
        $('mv-markup').textContent=fmt(markup);$('mv-tip').textContent=fmt(tip);
        let ins2=[];ins2.push('Base rate for '+lbs+' lbs over '+dist+' miles: <strong>'+fmt(baseCost)+'</strong>');
        if(season>1)ins2.push('Peak season adds <strong>'+Math.round((season-1)*100)+'%</strong> ('+fmt(markup)+') — consider off-season!');
        ins2.push('Suggested mover tip: <strong>'+fmt(tip)+'</strong> (15% of total)');
        ins2.push('Total with tip: <strong>'+fmt(total+tip)+'</strong>');
        $('mv-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Moving Tips</h6><ul class="list-unstyled mb-0 small">'+ins2.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['mv-size','mv-dist','mv-type','mv-pack','mv-storage','mv-ins','mv-season'].forEach(id=>$(id).addEventListener('input',calculate));
    $('mv-copy').addEventListener('click',function(){const t='Moving Estimate\nTotal: '+$('mv-total').textContent+'\nBase: '+$('mv-base').textContent+'\nServices: '+$('mv-services').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('mv-reset').addEventListener('click',()=>{$('mv-size').value='2500';$('mv-dist').value=500;$('mv-type').value='long';$('mv-pack').value='500';$('mv-storage').value=0;$('mv-ins').value='200';$('mv-season').value='1.3';calculate();});
    calculate();
});
</script>
<style>
.moving-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.moving-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.moving-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.moving-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.moving-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.moving-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\moving-cost-calculator.blade.php ENDPATH**/ ?>