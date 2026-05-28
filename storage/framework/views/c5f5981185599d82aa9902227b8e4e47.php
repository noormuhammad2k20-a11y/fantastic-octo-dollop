<div class="row g-4 stock-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Buy #1 — Shares</label><input type="number" id="sk-s1" class="form-control form-control-lg rounded-3" value="100" min="0"></div>
                    <div class="col-md-4"><label class="form-label-custom">Buy #1 — Price/Share</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="sk-p1" class="form-control form-control-lg" value="50" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Buy #2 — Shares</label><input type="number" id="sk-s2" class="form-control form-control-lg rounded-3" value="50" min="0"></div>
                    <div class="col-md-4"><label class="form-label-custom">Buy #2 — Price/Share</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="sk-p2" class="form-control form-control-lg" value="40" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Buy #3 — Shares</label><input type="number" id="sk-s3" class="form-control form-control-lg rounded-3" value="0" min="0"></div>
                    <div class="col-md-4"><label class="form-label-custom">Buy #3 — Price/Share</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="sk-p3" class="form-control form-control-lg" value="0" step="0.01" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Current Market Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="sk-current" class="form-control form-control-lg" value="55" step="0.01" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Commission (per trade)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="sk-comm" class="form-control form-control-lg" value="0" step="0.01" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:145;--tool-color:#16a34a;--tool-bg:rgba(34,197,94,.04);">
            <div class="output-hero"><span class="output-hero-label">AVERAGE COST PER SHARE</span><div class="output-hero-value" id="sk-avg">$46.67</div><span class="output-hero-unit" id="sk-shares-label">150 Total Shares</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">TOTAL INVESTED</span><span class="stat-card-value text-primary" id="sk-invested">$7,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">CURRENT VALUE</span><span class="stat-card-value text-success" id="sk-value">$8,250</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">UNREALIZED P/L</span><span class="stat-card-value text-warning" id="sk-pnl">+$1,250</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">RETURN</span><span class="stat-card-value" style="color:#a855f7" id="sk-return">+17.9%</span></div></div>
            </div>
            <div class="mt-4" id="sk-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sk-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Analysis</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sk-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const lots=[[parseFloat($('sk-s1').value)||0,parseFloat($('sk-p1').value)||0],[parseFloat($('sk-s2').value)||0,parseFloat($('sk-p2').value)||0],[parseFloat($('sk-s3').value)||0,parseFloat($('sk-p3').value)||0]];
        const curr=parseFloat($('sk-current').value)||0,comm=parseFloat($('sk-comm').value)||0;
        let totalShares=0,totalCost=0,trades=0;
        lots.forEach(l=>{if(l[0]>0){totalShares+=l[0];totalCost+=l[0]*l[1];trades++;}});
        totalCost+=comm*trades;
        const avg=totalShares>0?totalCost/totalShares:0;
        const currentVal=totalShares*curr,pnl=currentVal-totalCost;
        const ret=totalCost>0?(pnl/totalCost)*100:0;
        const sign=pnl>=0?'+':'-';
        $('sk-avg').textContent=fmt(avg);$('sk-shares-label').textContent=totalShares+' Total Shares';
        $('sk-invested').textContent=fmt(totalCost);$('sk-value').textContent=fmt(currentVal);
        $('sk-pnl').textContent=sign+fmt(Math.abs(pnl));$('sk-pnl').style.color=pnl>=0?'#16a34a':'#dc2626';
        $('sk-return').textContent=sign+Math.abs(ret).toFixed(1)+'%';$('sk-return').style.color=pnl>=0?'#7c3aed':'#dc2626';
        let ins=[];ins.push('Weighted avg cost: <strong>'+fmt(avg)+'</strong> across '+trades+' purchases.');
        if(pnl>=0)ins.push('🎉 Unrealized gain: <strong>'+sign+fmt(Math.abs(pnl))+'</strong> ('+sign+Math.abs(ret).toFixed(1)+'%)');
        else ins.push('📉 Unrealized loss: <strong>'+sign+fmt(Math.abs(pnl))+'</strong> — break-even at <strong>'+fmt(avg)+'</strong>');
        $('sk-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Position Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['sk-s1','sk-p1','sk-s2','sk-p2','sk-s3','sk-p3','sk-current','sk-comm'].forEach(id=>$(id).addEventListener('input',calculate));
    $('sk-copy').addEventListener('click',function(){const t='Stock Position\nAvg Cost: '+$('sk-avg').textContent+'\nShares: '+$('sk-shares-label').textContent+'\nP/L: '+$('sk-pnl').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('sk-reset').addEventListener('click',()=>{$('sk-s1').value=100;$('sk-p1').value=50;$('sk-s2').value=50;$('sk-p2').value=40;$('sk-s3').value=0;$('sk-p3').value=0;$('sk-current').value=55;$('sk-comm').value=0;calculate();});
    calculate();
});
</script>
<style>
.stock-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.stock-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.stock-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.stock-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.stock-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.stock-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\stock-calculator.blade.php ENDPATH**/ ?>