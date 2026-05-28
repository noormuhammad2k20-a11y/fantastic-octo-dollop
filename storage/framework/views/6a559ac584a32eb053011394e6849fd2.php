<div class="row g-4 rona-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Net Income ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="rona-ni" class="form-control form-control-lg" value="150000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Fixed Assets ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="rona-fa" class="form-control form-control-lg" value="500000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Net Working Capital ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="rona-wc" class="form-control form-control-lg" value="100000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Depreciation ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="rona-dep" class="form-control form-control-lg" value="20000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Tax Rate (%)</label><div class="input-group"><input type="number" id="rona-tr" class="form-control form-control-lg" value="21" min="0" max="50"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:270;--tool-color:#a855f7;--tool-bg:rgba(168,85,247,.04);">
            <div class="output-hero"><span class="output-hero-label">RETURN ON NET ASSETS</span><div class="output-hero-value" id="rona-val">25.0%</div><span class="output-hero-unit" id="rona-st">EFFICIENT CAPITAL</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">NET ASSETS</span><span class="stat-card-value text-success" id="rona-na">$600,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">NET INCOME</span><span class="stat-card-value text-primary" id="rona-nio">$150,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">PRE-DEP RONA</span><span class="stat-card-value" style="color:#f59e0b" id="rona-pd">28.3%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">AFTER-TAX ADJ</span><span class="stat-card-value" style="color:#a855f7" id="rona-at">19.8%</span></div></div>
            </div>
            <div class="mt-4" id="rona-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="rona-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="rona-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-secondary py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="rona-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calc(){
        const ni=parseFloat($('rona-ni').value)||0,fa=parseFloat($('rona-fa').value)||0,wc=parseFloat($('rona-wc').value)||0,dep=parseFloat($('rona-dep').value)||0,tr=(parseFloat($('rona-tr').value)||0)/100;
        const na=fa+wc;if(na<=0){$('rona-val').textContent='N/A';return;}
        const rona=(ni/na)*100,preDepRona=((ni+dep)/na)*100,afterTax=(ni*(1-tr)/na)*100;
        $('rona-val').textContent=rona.toFixed(2)+'%';$('rona-na').textContent=fmt(na);$('rona-nio').textContent=fmt(ni);
        $('rona-pd').textContent=preDepRona.toFixed(1)+'%';$('rona-at').textContent=afterTax.toFixed(1)+'%';
        $('rona-st').textContent=rona>=15?'EFFICIENT CAPITAL':rona>=8?'MODERATE':'UNDERPERFORMING';$('rona-st').style.color=rona>=15?'#22c55e':rona>=8?'#f59e0b':'#ef4444';
        let i=[];i.push('RONA of <strong>'+rona.toFixed(2)+'%</strong> on net assets of <strong>'+fmt(na)+'</strong>.');
        i.push('Before depreciation adjustments, RONA would be <strong>'+preDepRona.toFixed(1)+'%</strong>.');
        if(wc<0)i.push('⚠️ Negative working capital indicates potential liquidity risk.');
        $('rona-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['rona-ni','rona-fa','rona-wc','rona-dep','rona-tr'].forEach(id=>$(id).addEventListener('input',calc));
    $('rona-cb').addEventListener('click',calc);
    $('rona-cp').addEventListener('click',function(){navigator.clipboard.writeText('RONA: '+$('rona-val').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('rona-rs').addEventListener('click',()=>{$('rona-ni').value=150000;$('rona-fa').value=500000;$('rona-wc').value=100000;$('rona-dep').value=20000;$('rona-tr').value=21;calc();});
    calc();
});
</script>
<style>
.rona-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.rona-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.rona-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.rona-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.rona-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.rona-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\rona-calculator.blade.php ENDPATH**/ ?>