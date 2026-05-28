<div class="row g-4 disc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Original Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" class="form-control form-control-lg" id="disc-price" value="100" min="0" step="0.01"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Discount (%)</label><div class="input-group"><input type="number" class="form-control form-control-lg" id="disc-percent" value="20" min="0" max="100"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Second Discount (Stacked)</label><div class="input-group"><input type="number" class="form-control form-control-lg" id="disc-percent2" value="0" min="0" max="100"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Sales Tax Rate</label><div class="input-group"><input type="number" class="form-control form-control-lg" id="disc-tax" value="0" min="0" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Quantity</label><input type="number" class="form-control form-control-lg rounded-3" id="disc-qty" value="1" min="1"></div>
                    <div class="col-md-4"><label class="form-label-custom">Currency</label><select class="form-select form-select-lg rounded-3" id="disc-currency"><option value="USD" selected>USD ($)</option><option value="EUR">EUR (€)</option><option value="GBP">GBP (£)</option><option value="INR">INR (₹)</option></select></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 disc-quick" data-val="10">10%</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 disc-quick" data-val="15">15%</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 disc-quick" data-val="25">25%</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 disc-quick" data-val="50">50%</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:270;--tool-color:#a855f7;--tool-bg:rgba(168,85,247,.04);">
            <div class="output-hero"><span class="output-hero-label">FINAL PRICE</span><div class="output-hero-value" id="disc-final">$80.00</div><span class="output-hero-unit" id="disc-qty-label">for 1 item</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">YOU SAVE</span><span class="stat-card-value text-success" id="disc-savings">$20.00</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">EFFECTIVE DISCOUNT</span><span class="stat-card-value" style="color:#a855f7" id="disc-effective">20.0%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">TAX AMOUNT</span><span class="stat-card-value text-warning" id="disc-tax-amt">$0.00</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">PRICE PER UNIT</span><span class="stat-card-value text-primary" id="disc-per-unit">$80.00</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Allocation</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9"><div class="progress-bar" style="background:#a855f7" id="disc-bar-paid">Paid</div><div class="progress-bar" style="background:#22c55e" id="disc-bar-save">Saved</div></div>
            <div class="mt-4" id="disc-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="disc-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Breakdown</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="disc-reset-btn" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    const pI=$('disc-price'),d1=$('disc-percent'),d2=$('disc-percent2'),tI=$('disc-tax'),qI=$('disc-qty'),cI=$('disc-currency');
    const sym={USD:'$',EUR:'€',GBP:'£',INR:'₹'};
    function fmt(v){return(sym[cI.value]||'$')+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const P=parseFloat(pI.value)||0,D1=(parseFloat(d1.value)||0)/100,D2=(parseFloat(d2.value)||0)/100;
        const T=(parseFloat(tI.value)||0)/100,Q=parseInt(qI.value)||1;
        const unit=P*(1-D1)*(1-D2),sub=unit*Q,tax=sub*T,fin=sub+tax,sav=(P*Q)-sub;
        const eff=P>0?((P-unit)/P)*100:0;
        $('disc-final').textContent=fmt(fin);$('disc-savings').textContent=fmt(sav);
        $('disc-effective').textContent=eff.toFixed(1)+'%';$('disc-tax-amt').textContent=fmt(tax);
        $('disc-per-unit').textContent=fmt(unit);$('disc-qty-label').textContent=Q>1?'for '+Q+' items':'for 1 item';
        if(P>0){const pp=((P-sav/(Q||1))/P)*100;$('disc-bar-paid').style.width=Math.max(pp,5)+'%';$('disc-bar-paid').textContent=Math.round(pp)+'% Paid';$('disc-bar-save').style.width=Math.max(100-pp,2)+'%';$('disc-bar-save').textContent=Math.round(100-pp)+'% Saved';}
        let ins=[];ins.push('Original total: <strong>'+fmt(P*Q)+'</strong>');
        if(D2>0)ins.push('Stacked: '+Math.round(D1*100)+'% + '+Math.round(D2*100)+'% = effective <strong>'+eff.toFixed(1)+'%</strong>');
        if(sav>100)ins.push('🎉 You save over '+fmt(100)+'!');
        if(T>0)ins.push('Tax adds <strong>'+fmt(tax)+'</strong>');
        $('disc-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    [pI,d1,d2,tI,qI,cI].forEach(el=>el.addEventListener('input',calculate));
    document.querySelectorAll('.disc-quick').forEach(b=>b.addEventListener('click',()=>{d1.value=b.dataset.val;calculate();}));
    $('disc-reset-btn').addEventListener('click',()=>{pI.value=100;d1.value=20;d2.value=0;tI.value=0;qI.value=1;calculate();});
    $('disc-copy').addEventListener('click',function(){const t='Discount Summary\nOriginal: '+fmt(parseFloat(pI.value))+'\nFinal: '+$('disc-final').textContent+'\nSaved: '+$('disc-savings').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    calculate();
});
</script>
<style>
.disc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.disc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.disc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.disc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.disc-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.disc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\discount-calculator.blade.php ENDPATH**/ ?>