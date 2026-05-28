<div class="row g-4 merc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Listing Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mc-price" class="form-control form-control-lg" value="40" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Item Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mc-cost" class="form-control form-control-lg" value="15" step="0.01" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Shipping Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="mc-ship" class="form-control form-control-lg" value="5" step="0.01" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Mercari Fee Rate</label><div class="input-group"><input type="number" id="mc-fee" class="form-control form-control-lg" value="10" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Payment Processing</label><div class="input-group"><input type="number" id="mc-pp" class="form-control form-control-lg" value="2.9" step="0.1"><span class="input-group-text bg-light fw-bold">%</span>  </div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero"><span class="output-hero-label">NET PROFIT</span><div class="output-hero-value" id="mc-profit">$14.84</div><span class="output-hero-unit" id="mc-margin">37.1% Margin</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">TOTAL FEES</span><span class="stat-card-value text-danger" id="mc-totalfee">$5.16</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">YOUR EARNINGS</span><span class="stat-card-value text-success" id="mc-earn">$29.84</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">ROI</span><span class="stat-card-value text-primary" id="mc-roi">74.2%</span></div></div>
            </div>
            <div class="mt-4" id="mc-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mc-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Breakdown</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mc-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const price=parseFloat($('mc-price').value)||0,cost=parseFloat($('mc-cost').value)||0;
        const ship=parseFloat($('mc-ship').value)||0,fee=(parseFloat($('mc-fee').value)||0)/100;
        const pp=(parseFloat($('mc-pp').value)||0)/100;
        const mercFee=price*fee,ppFee=price*pp,totalFee=mercFee+ppFee;
        const earnings=price-totalFee,profit=earnings-cost-ship;
        const margin=price>0?(profit/price)*100:0,roi=cost>0?(profit/cost)*100:0;
        $('mc-profit').textContent=fmt(profit);$('mc-margin').textContent=margin.toFixed(1)+'% Margin';
        $('mc-totalfee').textContent=fmt(totalFee);$('mc-earn').textContent=fmt(earnings);$('mc-roi').textContent=roi.toFixed(1)+'%';
        let ins=[];ins.push('Mercari takes <strong>'+fmt(totalFee)+'</strong> ('+(fee*100+pp*100).toFixed(1)+'%) from your '+fmt(price)+' sale.');
        if(profit<0)ins.push('<span class="text-danger fw-bold">⚠ Losing money!</span> Minimum price for break-even: <strong>'+fmt((cost+ship)/(1-fee-pp))+'</strong>');
        else ins.push('ROI of <strong>'+roi.toFixed(0)+'%</strong> — sell 50 items = <strong>'+fmt(profit*50)+'</strong> profit.');
        $('mc-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['mc-price','mc-cost','mc-ship','mc-fee','mc-pp'].forEach(id=>$(id).addEventListener('input',calculate));
    $('mc-copy').addEventListener('click',function(){const t='Mercari Analysis\nPrice: '+fmt(parseFloat($('mc-price').value))+'\nFees: '+$('mc-totalfee').textContent+'\nProfit: '+$('mc-profit').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('mc-reset').addEventListener('click',()=>{$('mc-price').value=40;$('mc-cost').value=15;$('mc-ship').value=5;$('mc-fee').value=10;$('mc-pp').value=2.9;calculate();});
    calculate();
});
</script>
<style>
.merc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.merc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.merc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.merc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.merc-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.merc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

