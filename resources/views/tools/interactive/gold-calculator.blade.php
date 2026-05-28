<div class="row g-4 gold-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Metal Type</label><select class="form-select form-select-lg rounded-3" id="gd-metal"><option value="gold" selected>Gold (Au)</option><option value="silver">Silver (Ag)</option><option value="platinum">Platinum (Pt)</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Spot Price / Troy Oz</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="gd-spot" class="form-control form-control-lg" value="2350" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Weight</label><div class="input-group"><input type="number" id="gd-weight" class="form-control form-control-lg" value="1" step="0.01" min="0"><select class="form-select form-select-lg" id="gd-unit" style="max-width:110px"><option value="oz" selected>Troy Oz</option><option value="g">Grams</option><option value="kg">Kilograms</option><option value="dwt">Pennyweight</option></select></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Purity / Karat</label><select class="form-select form-select-lg rounded-3" id="gd-purity"><option value="0.9999">24K (99.99%)</option><option value="0.9167">22K (91.67%)</option><option value="0.75">18K (75%)</option><option value="0.5833">14K (58.33%)</option><option value="0.4167">10K (41.67%)</option><option value="1" selected>Fine (.999)</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Dealer Premium</label><div class="input-group"><input type="number" id="gd-premium" class="form-control form-control-lg" value="3" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Quantity</label><input type="number" id="gd-qty" class="form-control form-control-lg rounded-3" value="1" min="1"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:40;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero"><span class="output-hero-label">TOTAL MELT VALUE</span><div class="output-hero-value" id="gd-value">$2,350.00</div><span class="output-hero-unit" id="gd-label">1 Troy Oz Fine Gold</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">MELT / UNIT</span><span class="stat-card-value text-warning" id="gd-melt-unit">$2,350.00</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">WITH PREMIUM</span><span class="stat-card-value text-primary" id="gd-with-premium">$2,420.50</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">PRICE / GRAM</span><span class="stat-card-value text-success" id="gd-per-gram">$75.57</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">PURE METAL WEIGHT</span><span class="stat-card-value" style="color:#a855f7" id="gd-pure-wt">31.10g</span></div></div>
            </div>
            <div class="mt-4" id="gd-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="gd-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Valuation</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="gd-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    const spots={gold:2350,silver:28.50,platinum:980};
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function toTroyOz(w,u){if(u==='oz')return w;if(u==='g')return w/31.1035;if(u==='kg')return w*32.1507;if(u==='dwt')return w/20;return w;}
    function calculate(){
        const metal=$('gd-metal').value,spot=parseFloat($('gd-spot').value)||0;
        const w=parseFloat($('gd-weight').value)||0,unit=$('gd-unit').value;
        const purity=parseFloat($('gd-purity').value)||1,premium=(parseFloat($('gd-premium').value)||0)/100;
        const qty=parseInt($('gd-qty').value)||1;
        const troyOz=toTroyOz(w,unit);
        const meltPerUnit=troyOz*spot*purity;
        const totalMelt=meltPerUnit*qty;
        const withPremium=meltPerUnit*(1+premium);
        const totalWithPremium=withPremium*qty;
        const pureWeightG=troyOz*31.1035*purity;
        const perGram=spot/31.1035;
        $('gd-value').textContent=fmt(totalMelt);
        $('gd-label').textContent=qty+(qty>1?' items ':' ')+(unit==='oz'?'Troy Oz':unit==='g'?'Grams':unit==='kg'?'Kg':'DWT')+' '+metal.charAt(0).toUpperCase()+metal.slice(1);
        $('gd-melt-unit').textContent=fmt(meltPerUnit);$('gd-with-premium').textContent=fmt(totalWithPremium);
        $('gd-per-gram').textContent=fmt(perGram);$('gd-pure-wt').textContent=(pureWeightG*qty).toFixed(2)+'g';
        let ins=[];ins.push('Pure '+metal+' content: <strong>'+(pureWeightG*qty).toFixed(2)+'g</strong> ('+(troyOz*purity*qty).toFixed(4)+' troy oz)');
        ins.push('Spot melt value: <strong>'+fmt(totalMelt)+'</strong> | With '+Math.round(premium*100)+'% dealer premium: <strong>'+fmt(totalWithPremium)+'</strong>');
        ins.push('Price per gram of pure '+metal+': <strong>'+fmt(perGram*purity)+'</strong>');
        if(purity<1)ins.push('Purity factor reduces value by <strong>'+((1-purity)*100).toFixed(1)+'%</strong> from spot price.');
        $('gd-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Valuation Notes</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    $('gd-metal').addEventListener('change',function(){$('gd-spot').value=spots[this.value]||0;calculate();});
    ['gd-spot','gd-weight','gd-unit','gd-purity','gd-premium','gd-qty','gd-metal'].forEach(id=>$(id).addEventListener('input',calculate));
    $('gd-copy').addEventListener('click',function(){const t='Gold Valuation\nMelt: '+$('gd-value').textContent+'\nWith Premium: '+$('gd-with-premium').textContent+'\nPure Weight: '+$('gd-pure-wt').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('gd-reset').addEventListener('click',()=>{$('gd-metal').value='gold';$('gd-spot').value=2350;$('gd-weight').value=1;$('gd-unit').value='oz';$('gd-purity').value='1';$('gd-premium').value=3;$('gd-qty').value=1;calculate();});
    calculate();
});
</script>
<style>
.gold-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.gold-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.gold-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.gold-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.gold-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.gold-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

