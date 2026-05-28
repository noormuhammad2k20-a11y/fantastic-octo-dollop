<div class="row g-4 jewel-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Metal Type</label><select class="form-select form-select-lg rounded-3" id="jw-metal"><option value="gold" selected>Gold</option><option value="silver">Silver</option><option value="platinum">Platinum</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Weight (grams)</label><input type="number" id="jw-weight" class="form-control form-control-lg rounded-3" value="10" step="0.1" min="0"></div>
                    <div class="col-md-4"><label class="form-label-custom">Purity / Karat</label><select class="form-select form-select-lg rounded-3" id="jw-purity"><option value="0.9999">24K (99.99%)</option><option value="0.916" selected>22K (91.6%)</option><option value="0.75">18K (75%)</option><option value="0.583">14K (58.3%)</option><option value="0.417">10K (41.7%)</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Metal Spot Price ($/oz)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="jw-spot" class="form-control form-control-lg" value="2350" step="1" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Gemstone Value</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="jw-gem" class="form-control form-control-lg" value="0" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Craftsmanship Premium</label><div class="input-group"><input type="number" id="jw-craft" class="form-control form-control-lg" value="20" min="0" max="200"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero"><span class="output-hero-label">ESTIMATED RETAIL VALUE</span><div class="output-hero-value" id="jw-total">$830</div><span class="output-hero-unit">Jewelry Appraisal</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ec4899;background:rgba(236,72,153,.02);"><span class="stat-card-label">METAL MELT VALUE</span><span class="stat-card-value" style="color:#ec4899" id="jw-melt">$692</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">PURE METAL (g)</span><span class="stat-card-value text-success" id="jw-pure">9.16g</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">CRAFT PREMIUM</span><span class="stat-card-value text-primary" id="jw-premium">$138</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">INSURANCE VALUE</span><span class="stat-card-value text-warning" id="jw-insure">$1,245</span></div></div>
            </div>
            <div class="mt-4" id="jw-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="jw-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Appraisal</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="jw-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const metal=$('jw-metal').value,wt=parseFloat($('jw-weight').value)||0;
        const purity=parseFloat($('jw-purity').value)||1,spot=parseFloat($('jw-spot').value)||0;
        const gem=parseFloat($('jw-gem').value)||0,craft=(parseFloat($('jw-craft').value)||0)/100;
        const pureWt=wt*purity,troyOz=wt/31.1035;
        const meltValue=troyOz*spot*purity;
        const premium=meltValue*craft;
        const total=meltValue+gem+premium;
        const insuranceValue=total*1.5;
        $('jw-total').textContent=fmt(total);$('jw-melt').textContent=fmt(meltValue);
        $('jw-pure').textContent=pureWt.toFixed(2)+'g';$('jw-premium').textContent=fmt(premium);
        $('jw-insure').textContent=fmt(insuranceValue);
        let ins=[];ins.push('Pure '+metal+' content: <strong>'+pureWt.toFixed(2)+'g</strong> ('+troyOz.toFixed(4)+' troy oz)');
        ins.push('Melt value: <strong>'+fmt(meltValue)+'</strong> + '+Math.round(craft*100)+'% craftsmanship = <strong>'+fmt(meltValue+premium)+'</strong>');
        if(gem>0)ins.push('Gemstone adds <strong>'+fmt(gem)+'</strong> to total value.');
        ins.push('Recommended insurance coverage: <strong>'+fmt(insuranceValue)+'</strong> (150% of appraisal).');
        $('jw-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Appraisal Notes</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['jw-metal','jw-weight','jw-purity','jw-spot','jw-gem','jw-craft'].forEach(id=>$(id).addEventListener('input',calculate));
    $('jw-copy').addEventListener('click',function(){const t='Jewelry Appraisal\nValue: '+$('jw-total').textContent+'\nMelt: '+$('jw-melt').textContent+'\nInsurance: '+$('jw-insure').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('jw-reset').addEventListener('click',()=>{$('jw-metal').value='gold';$('jw-weight').value=10;$('jw-purity').value='0.916';$('jw-spot').value=2350;$('jw-gem').value=0;$('jw-craft').value=20;calculate();});
    calculate();
});
</script>
<style>
.jewel-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.jewel-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.jewel-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.jewel-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.jewel-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.jewel-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\jewelry-calculator.blade.php ENDPATH**/ ?>