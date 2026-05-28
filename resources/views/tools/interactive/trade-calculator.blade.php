<div class="row g-4 trade-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Entry Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="tr-entry" class="form-control form-control-lg" value="100" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Exit Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="tr-exit" class="form-control form-control-lg" value="115" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Shares / Units</label><input type="number" id="tr-qty" class="form-control form-control-lg rounded-3" value="100" min="1"></div>
                    <div class="col-md-4"><label class="form-label-custom">Direction</label><select class="form-select form-select-lg rounded-3" id="tr-dir"><option value="long" selected>Long (Buy)</option><option value="short">Short (Sell)</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Commission (per trade)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="tr-comm" class="form-control form-control-lg" value="0" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Stop Loss</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="tr-stop" class="form-control form-control-lg" value="95" step="0.01" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="tr-card" style="--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero"><span class="output-hero-label">TRADE P&L</span><div class="output-hero-value" id="tr-pnl">+$1,500.00</div><span class="output-hero-unit" id="tr-pct">+15.0% Return</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">POSITION SIZE</span><span class="stat-card-value text-primary" id="tr-pos">$10,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">RISK/REWARD</span><span class="stat-card-value text-success" id="tr-rr">1:3.0</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">MAX RISK</span><span class="stat-card-value text-danger" id="tr-risk">$500</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">TOTAL FEES</span><span class="stat-card-value text-warning" id="tr-fees">$0.00</span></div></div>
            </div>
            <div class="mt-4" id="tr-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tr-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Trade Log</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tr-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.abs(v).toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const entry=parseFloat($('tr-entry').value)||0,exit=parseFloat($('tr-exit').value)||0;
        const qty=parseInt($('tr-qty').value)||0,dir=$('tr-dir').value;
        const comm=parseFloat($('tr-comm').value)||0,stop=parseFloat($('tr-stop').value)||0;
        const totalComm=comm*2; // entry + exit
        let pnl;
        if(dir==='long') pnl=(exit-entry)*qty-totalComm;
        else pnl=(entry-exit)*qty-totalComm;
        const posSize=entry*qty,pctReturn=posSize>0?(pnl/posSize)*100:0;
        const riskPerShare=dir==='long'?entry-stop:stop-entry;
        const maxRisk=Math.abs(riskPerShare)*qty;
        const reward=Math.abs(pnl);
        const rr=maxRisk>0?(reward/maxRisk):0;
        const sign=pnl>=0?'+':'-';
        $('tr-pnl').textContent=sign+fmt(pnl);$('tr-pnl').style.color=pnl>=0?'#16a34a':'#dc2626';
        $('tr-pct').textContent=sign+Math.abs(pctReturn).toFixed(1)+'% Return';
        $('tr-pos').textContent=fmt(posSize);$('tr-rr').textContent='1:'+rr.toFixed(1);
        $('tr-risk').textContent=fmt(maxRisk);$('tr-fees').textContent=fmt(totalComm);
        let ins=[];
        if(pnl>=0)ins.push('🎉 <strong>Winning trade!</strong> '+sign+fmt(pnl)+' profit ('+sign+Math.abs(pctReturn).toFixed(1)+'%)');
        else ins.push('📉 <strong>Losing trade:</strong> '+sign+fmt(pnl)+' loss ('+sign+Math.abs(pctReturn).toFixed(1)+'%)');
        ins.push('Risk/Reward ratio: <strong>1:'+rr.toFixed(1)+'</strong>'+(rr>=2?' ✅ Favorable':rr>=1?' ⚠️ Marginal':' ❌ Poor'));
        ins.push('Position size: <strong>'+fmt(posSize)+'</strong> with max risk of <strong>'+fmt(maxRisk)+'</strong>');
        $('tr-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Trade Analysis</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['tr-entry','tr-exit','tr-qty','tr-dir','tr-comm','tr-stop'].forEach(id=>$(id).addEventListener('input',calculate));
    $('tr-copy').addEventListener('click',function(){const t='Trade Log\nEntry: $'+$('tr-entry').value+' | Exit: $'+$('tr-exit').value+'\nP&L: '+$('tr-pnl').textContent+'\nR/R: '+$('tr-rr').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('tr-reset').addEventListener('click',()=>{$('tr-entry').value=100;$('tr-exit').value=115;$('tr-qty').value=100;$('tr-dir').value='long';$('tr-comm').value=0;$('tr-stop').value=95;calculate();});
    calculate();
});
</script>
<style>
.trade-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.trade-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.trade-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.trade-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.trade-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.trade-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

