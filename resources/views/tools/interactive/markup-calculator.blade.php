<div class="row g-4 markup-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Cost Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mk-cost" class="form-control form-control-lg" value="50" min="0" step="0.01"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Selling Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mk-sell" class="form-control form-control-lg" value="75" min="0" step="0.01"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Units Sold / Month</label><input type="number" id="mk-units" class="form-control form-control-lg rounded-3" value="100" min="0"></div>
                    <div class="col-md-4"><label class="form-label-custom">Fixed Overhead / Month</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mk-overhead" class="form-control form-control-lg" value="500" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Tax Rate</label><div class="input-group"><input type="number" id="mk-tax" class="form-control form-control-lg" value="0" min="0" max="50"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Shipping / Unit</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mk-ship" class="form-control form-control-lg" value="0" min="0" step="0.01"></div></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Markup Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 mk-preset" data-pct="25">25%</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 mk-preset" data-pct="50">50%</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 mk-preset" data-pct="100">100% (2x)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 mk-preset" data-pct="200">200% (3x)</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero"><span class="output-hero-label">PROFIT PER UNIT</span><div class="output-hero-value" id="mk-profit">$25.00</div><span class="output-hero-unit" id="mk-margin-label">33.3% Margin</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#0ea5e9;background:rgba(14,165,233,.02);"><span class="stat-card-label">MARKUP</span><span class="stat-card-value text-info" id="mk-markup-pct">50.0%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">MONTHLY REVENUE</span><span class="stat-card-value text-success" id="mk-revenue">$7,500</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">MONTHLY PROFIT</span><span class="stat-card-value text-warning" id="mk-monthly">$2,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">BREAK-EVEN</span><span class="stat-card-value text-danger" id="mk-breakeven">20 units</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Revenue Breakdown</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#ef4444" id="mk-bar-cost">Cost</div>
                <div class="progress-bar" style="background:#f59e0b" id="mk-bar-overhead">Overhead</div>
                <div class="progress-bar" style="background:#22c55e" id="mk-bar-profit">Profit</div>
            </div>
            <div class="mt-4" id="mk-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mk-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Analysis</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mk-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const cost=parseFloat($('mk-cost').value)||0,sell=parseFloat($('mk-sell').value)||0;
        const units=parseInt($('mk-units').value)||0,overhead=parseFloat($('mk-overhead').value)||0;
        const tax=(parseFloat($('mk-tax').value)||0)/100,ship=parseFloat($('mk-ship').value)||0;
        const totalCost=cost+ship,profit=sell-totalCost,markup=totalCost>0?(profit/totalCost)*100:0;
        const margin=sell>0?(profit/sell)*100:0;
        const revenue=sell*units,totalCosts=(totalCost*units)+overhead;
        const grossProfit=revenue-totalCosts,taxAmt=grossProfit>0?grossProfit*tax:0;
        const netProfit=grossProfit-taxAmt,breakeven=profit>0?Math.ceil(overhead/profit):0;
        $('mk-profit').textContent=fmt(profit);$('mk-margin-label').textContent=margin.toFixed(1)+'% Margin';
        $('mk-markup-pct').textContent=markup.toFixed(1)+'%';$('mk-revenue').textContent=fmt(revenue);
        $('mk-monthly').textContent=fmt(netProfit);$('mk-breakeven').textContent=breakeven+' units';
        if(revenue>0){const cp=(totalCost*units/revenue)*100,op=(overhead/revenue)*100,pp=Math.max(100-cp-op,0);
        $('mk-bar-cost').style.width=cp+'%';$('mk-bar-cost').textContent=Math.round(cp)+'% COGS';
        $('mk-bar-overhead').style.width=Math.max(op,2)+'%';$('mk-bar-overhead').textContent=Math.round(op)+'% OH';
        $('mk-bar-profit').style.width=Math.max(pp,2)+'%';$('mk-bar-profit').textContent=Math.round(pp)+'% Profit';}
        let ins=[];ins.push('Markup of <strong>'+markup.toFixed(1)+'%</strong> translates to <strong>'+margin.toFixed(1)+'% margin</strong>.');
        ins.push('You need to sell <strong>'+breakeven+' units</strong> to cover '+fmt(overhead)+' monthly overhead.');
        if(netProfit>0)ins.push('Net monthly profit after tax: <strong>'+fmt(netProfit)+'</strong> ('+fmt(netProfit*12)+'/yr).');
        else ins.push('<span class="text-danger">You are losing '+fmt(Math.abs(netProfit))+'/month</span>. Increase price or reduce costs.');
        $('mk-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Profit Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['mk-cost','mk-sell','mk-units','mk-overhead','mk-tax','mk-ship'].forEach(id=>$(id).addEventListener('input',calculate));
    document.querySelectorAll('.mk-preset').forEach(b=>b.addEventListener('click',()=>{const c=parseFloat($('mk-cost').value)||0;$('mk-sell').value=(c*(1+parseInt(b.dataset.pct)/100)).toFixed(2);calculate();}));
    $('mk-copy').addEventListener('click',function(){const t='Markup Analysis\nCost: '+fmt(parseFloat($('mk-cost').value))+'\nSell: '+fmt(parseFloat($('mk-sell').value))+'\nMarkup: '+$('mk-markup-pct').textContent+'\nMargin: '+$('mk-margin-label').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('mk-reset').addEventListener('click',()=>{$('mk-cost').value=50;$('mk-sell').value=75;$('mk-units').value=100;$('mk-overhead').value=500;$('mk-tax').value=0;$('mk-ship').value=0;calculate();});
    calculate();
});
</script>
<style>
.markup-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.markup-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.markup-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.markup-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.markup-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.markup-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

