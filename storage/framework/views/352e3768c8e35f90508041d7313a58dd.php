<div class="row g-4 roce-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">EBIT ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roce-ebit" class="form-control form-control-lg" value="300000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Total Assets ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roce-ta" class="form-control form-control-lg" value="1500000" min="1"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Current Liabilities ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roce-cl" class="form-control form-control-lg" value="200000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Long-term Debt ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roce-ltd" class="form-control form-control-lg" value="500000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Shareholder Equity ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roce-se" class="form-control form-control-lg" value="800000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Tax Rate (%)</label><div class="input-group"><input type="number" id="roce-tr" class="form-control form-control-lg" value="21" min="0" max="50"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero"><span class="output-hero-label">RETURN ON CAPITAL EMPLOYED</span><div class="output-hero-value" id="roce-val">23.1%</div><span class="output-hero-unit" id="roce-st">EFFICIENT CAPITAL USE</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">CAPITAL EMPLOYED</span><span class="stat-card-value text-success" id="roce-ce">$1,300,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">AFTER-TAX ROCE</span><span class="stat-card-value text-primary" id="roce-at">18.2%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">DEBT-TO-CE</span><span class="stat-card-value" style="color:#f59e0b" id="roce-dc">38.5%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">EQUITY-TO-CE</span><span class="stat-card-value" style="color:#a855f7" id="roce-ec">61.5%</span></div></div>
            </div>
            <div class="mt-4" id="roce-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="roce-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="roce-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-info py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="roce-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calc(){
        const ebit=parseFloat($('roce-ebit').value)||0,ta=parseFloat($('roce-ta').value)||1,cl=parseFloat($('roce-cl').value)||0,ltd=parseFloat($('roce-ltd').value)||0,se=parseFloat($('roce-se').value)||0,tr=(parseFloat($('roce-tr').value)||0)/100;
        const ce=ta-cl;if(ce<=0){$('roce-val').textContent='N/A';return;}
        const roce=(ebit/ce)*100,afterTax=(ebit*(1-tr)/ce)*100,debtToCe=(ltd/ce)*100,eqToCe=(se/ce)*100;
        $('roce-val').textContent=roce.toFixed(2)+'%';$('roce-ce').textContent=fmt(ce);$('roce-at').textContent=afterTax.toFixed(1)+'%';$('roce-dc').textContent=debtToCe.toFixed(1)+'%';$('roce-ec').textContent=eqToCe.toFixed(1)+'%';
        $('roce-st').textContent=roce>=15?'EFFICIENT CAPITAL USE':roce>=8?'MODERATE':'LOW EFFICIENCY';$('roce-st').style.color=roce>=15?'#22c55e':roce>=8?'#f59e0b':'#ef4444';
        let i=[];i.push('ROCE of <strong>'+roce.toFixed(2)+'%</strong> on capital employed of <strong>'+fmt(ce)+'</strong>.');
        i.push('After-tax ROCE is <strong>'+afterTax.toFixed(1)+'%</strong>. A ROCE above WACC creates shareholder value.');
        if(debtToCe>60)i.push('⚠️ High debt-to-capital ratio ('+debtToCe.toFixed(0)+'%). Consider deleveraging.');
        $('roce-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['roce-ebit','roce-ta','roce-cl','roce-ltd','roce-se','roce-tr'].forEach(id=>$(id).addEventListener('input',calc));
    $('roce-cb').addEventListener('click',calc);
    $('roce-cp').addEventListener('click',function(){navigator.clipboard.writeText('ROCE: '+$('roce-val').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('roce-rs').addEventListener('click',()=>{$('roce-ebit').value=300000;$('roce-ta').value=1500000;$('roce-cl').value=200000;$('roce-ltd').value=500000;$('roce-se').value=800000;$('roce-tr').value=21;calc();});
    calc();
});
</script>
<style>
.roce-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.roce-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.roce-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.roce-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.roce-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.roce-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\roce-calculator.blade.php ENDPATH**/ ?>