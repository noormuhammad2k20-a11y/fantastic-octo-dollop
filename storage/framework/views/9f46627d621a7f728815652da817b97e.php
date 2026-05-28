<div class="row g-4 wacc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Market Value of Equity ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="w-eq" class="form-control form-control-lg" value="1000000" min="1"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Market Value of Debt ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="w-dt" class="form-control form-control-lg" value="500000" min="0"></div></div>
                    <div class="col-md-3"><label class="form-label-custom">Cost of Equity (%)</label><div class="input-group"><input type="number" id="w-re" class="form-control form-control-lg" value="10" min="0" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-3"><label class="form-label-custom">Pre-Tax Cost of Debt (%)</label><div class="input-group"><input type="number" id="w-rd" class="form-control form-control-lg" value="6" min="0" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-3"><label class="form-label-custom">Tax Rate (%)</label><div class="input-group"><input type="number" id="w-tc" class="form-control form-control-lg" value="21" min="0" max="100"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-3"><label class="form-label-custom">Preferred Equity ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="w-pe" class="form-control form-control-lg" value="0" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Cost of Preferred (%)</label><div class="input-group"><input type="number" id="w-rp" class="form-control form-control-lg" value="8" min="0" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Risk-Free Rate (%)</label><div class="input-group"><input type="number" id="w-rf" class="form-control form-control-lg" value="4.5" min="0" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero"><span class="output-hero-label">WEIGHTED AVG COST OF CAPITAL</span><div class="output-hero-value" id="w-val">8.24%</div><span class="output-hero-unit" id="w-st">DISCOUNT RATE</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">EQUITY WEIGHT</span><span class="stat-card-value text-primary" id="w-ew">66.7%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">DEBT WEIGHT</span><span class="stat-card-value text-danger" id="w-dw">33.3%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">TAX SHIELD</span><span class="stat-card-value text-success" id="w-ts">0.42%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">AFTER-TAX DEBT</span><span class="stat-card-value" style="color:#f59e0b" id="w-ad">4.74%</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Capital Structure</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#3b82f6" id="w-b1">Equity</div>
                <div class="progress-bar bg-danger" id="w-b2">Debt</div>
                <div class="progress-bar" style="background:#a855f7" id="w-b3">Preferred</div>
            </div>
            <div class="mt-4" id="w-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="w-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="w-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-primary py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="w-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function calc(){
        const E=parseFloat($('w-eq').value)||0,D=parseFloat($('w-dt').value)||0,P=parseFloat($('w-pe').value)||0;
        const Re=(parseFloat($('w-re').value)||0)/100,Rd=(parseFloat($('w-rd').value)||0)/100,Rp=(parseFloat($('w-rp').value)||0)/100,Tc=(parseFloat($('w-tc').value)||0)/100;
        const V=E+D+P;if(V<=0){$('w-val').textContent='0%';return;}
        const wacc=(E/V*Re)+(D/V*Rd*(1-Tc))+(P/V*Rp);const wp=wacc*100;
        const ew=(E/V)*100,dw=(D/V)*100,pw=(P/V)*100,ts=D/V*Rd*Tc*100,ad=Rd*(1-Tc)*100;
        $('w-val').textContent=wp.toFixed(2)+'%';$('w-ew').textContent=ew.toFixed(1)+'%';$('w-dw').textContent=dw.toFixed(1)+'%';$('w-ts').textContent=ts.toFixed(2)+'%';$('w-ad').textContent=ad.toFixed(2)+'%';
        $('w-st').textContent='DISCOUNT RATE';$('w-st').style.color='#6366f1';
        $('w-b1').style.width=ew+'%';$('w-b1').textContent=Math.round(ew)+'% Equity';
        $('w-b2').style.width=dw+'%';$('w-b2').textContent=Math.round(dw)+'% Debt';
        $('w-b3').style.width=pw+'%';$('w-b3').textContent=pw>0?Math.round(pw)+'% Pref':'';
        let i=[];i.push('WACC is <strong>'+wp.toFixed(2)+'%</strong>. Projects must exceed this hurdle rate to create value.');
        i.push('After-tax cost of debt is <strong>'+ad.toFixed(2)+'%</strong>, benefiting from the <strong>'+ts.toFixed(2)+'%</strong> interest tax shield.');
        if(dw>60)i.push('⚠️ Heavy debt weighting ('+dw.toFixed(0)+'%). Financial distress risk may offset tax benefits.');
        $('w-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['w-eq','w-dt','w-re','w-rd','w-tc','w-pe','w-rp','w-rf'].forEach(id=>$(id).addEventListener('input',calc));
    $('w-cb').addEventListener('click',calc);
    $('w-cp').addEventListener('click',function(){navigator.clipboard.writeText('WACC: '+$('w-val').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('w-rs').addEventListener('click',()=>{$('w-eq').value=1000000;$('w-dt').value=500000;$('w-re').value=10;$('w-rd').value=6;$('w-tc').value=21;$('w-pe').value=0;$('w-rp').value=8;$('w-rf').value=4.5;calc();});
    calc();
});
</script>
<style>
.wacc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.wacc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.wacc-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.wacc-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.wacc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.wacc-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\wacc-calculator.blade.php ENDPATH**/ ?>