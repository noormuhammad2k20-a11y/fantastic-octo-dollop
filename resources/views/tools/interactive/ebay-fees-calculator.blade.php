<div class="row g-4 ebay-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Selling Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-price" class="form-control form-control-lg" value="50" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Item Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-cost" class="form-control form-control-lg" value="20" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Shipping Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-ship" class="form-control form-control-lg" value="5" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">eBay Final Value Fee</label><div class="input-group"><input type="number" id="eb-fvf" class="form-control form-control-lg" value="13.25" step="0.01"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Payment Processing</label><div class="input-group"><input type="number" id="eb-pp" class="form-control form-control-lg" value="2.9" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">PP Fixed Fee</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-ppfixed" class="form-control form-control-lg" value="0.30" step="0.01" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero"><span class="output-hero-label">NET PROFIT</span><div class="output-hero-value" id="eb-profit">$16.33</div><span class="output-hero-unit" id="eb-margin-label">32.7% Margin</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">EBAY FEES</span><span class="stat-card-value text-danger" id="eb-fees">$7.28</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">PAYMENT FEES</span><span class="stat-card-value text-warning" id="eb-ppfees">$1.75</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">TOTAL FEES</span><span class="stat-card-value text-primary" id="eb-totalfees">$9.03</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">ROI</span><span class="stat-card-value text-success" id="eb-roi">81.6%</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Revenue Split</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#22c55e" id="eb-bar-profit">Profit</div>
                <div class="progress-bar" style="background:#94a3b8" id="eb-bar-cost">COGS</div>
                <div class="progress-bar" style="background:#ef4444" id="eb-bar-fees">Fees</div>
                <div class="progress-bar" style="background:#f59e0b" id="eb-bar-ship">Ship</div>
            </div>
            <div class="mt-4" id="eb-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="eb-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Breakdown</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="eb-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const price=parseFloat($('eb-price').value)||0,cost=parseFloat($('eb-cost').value)||0;
        const ship=parseFloat($('eb-ship').value)||0,fvf=(parseFloat($('eb-fvf').value)||0)/100;
        const pp=(parseFloat($('eb-pp').value)||0)/100,ppFixed=parseFloat($('eb-ppfixed').value)||0;
        const total=price+ship;
        const ebayFee=total*fvf,ppFee=total*pp+ppFixed;
        const totalFees=ebayFee+ppFee;
        const profit=price-cost-ship-totalFees;
        const margin=price>0?(profit/price)*100:0;
        const roi=cost>0?(profit/cost)*100:0;
        $('eb-profit').textContent=fmt(profit);$('eb-margin-label').textContent=margin.toFixed(1)+'% Margin';
        $('eb-fees').textContent=fmt(ebayFee);$('eb-ppfees').textContent=fmt(ppFee);
        $('eb-totalfees').textContent=fmt(totalFees);$('eb-roi').textContent=roi.toFixed(1)+'%';
        if(price>0){
            const pp2=(profit/price)*100,cp=(cost/price)*100,fp=(totalFees/price)*100,sp=(ship/price)*100;
            $('eb-bar-profit').style.width=Math.max(pp2,2)+'%';$('eb-bar-profit').textContent=Math.round(pp2)+'%';
            $('eb-bar-cost').style.width=Math.max(cp,2)+'%';$('eb-bar-cost').textContent=Math.round(cp)+'%';
            $('eb-bar-fees').style.width=Math.max(fp,2)+'%';$('eb-bar-fees').textContent=Math.round(fp)+'%';
            $('eb-bar-ship').style.width=Math.max(sp,2)+'%';$('eb-bar-ship').textContent=Math.round(sp)+'%';
        }
        let ins=[];ins.push('Total fees eat <strong>'+(price>0?((totalFees/price)*100).toFixed(1):0)+'%</strong> of your sale price.');
        ins.push('You need to sell at least <strong>'+fmt(cost+ship+totalFees)+'</strong> to break even.');
        if(profit<0)ins.push('<span class="text-danger fw-bold">⚠ You are losing money!</span> Raise price by at least '+fmt(Math.abs(profit))+'.');
        else ins.push('Selling 100 items/month = <strong>'+fmt(profit*100)+'</strong> monthly profit.');
        $('eb-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Seller Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['eb-price','eb-cost','eb-ship','eb-fvf','eb-pp','eb-ppfixed'].forEach(id=>$(id).addEventListener('input',calculate));
    $('eb-copy').addEventListener('click',function(){const t='eBay Fee Analysis\nSale: '+fmt(parseFloat($('eb-price').value))+'\nFees: '+$('eb-totalfees').textContent+'\nProfit: '+$('eb-profit').textContent+'\nROI: '+$('eb-roi').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('eb-reset').addEventListener('click',()=>{$('eb-price').value=50;$('eb-cost').value=20;$('eb-ship').value=5;$('eb-fvf').value=13.25;$('eb-pp').value=2.9;$('eb-ppfixed').value=0.30;calculate();});
    calculate();
});
</script>
<style>
.ebay-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.ebay-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.ebay-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.ebay-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.ebay-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.ebay-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

