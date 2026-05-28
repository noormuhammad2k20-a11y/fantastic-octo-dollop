<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-tags text-primary me-2"></i>Product Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-price="25" data-cost="8" data-ship="4" data-qty="1" data-ads="0">Sticker Pack ($25)</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-price="50" data-cost="15" data-ship="5" data-qty="1" data-ads="0">Handmade Jewelry ($50)</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-price="150" data-cost="40" data-ship="10" data-qty="1" data-ads="15">Custom Art ($150)</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-price="5" data-cost="0.50" data-ship="0" data-qty="50" data-ads="0">Digital Download ($5×50)</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Product Info</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Listing Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="et-price" class="form-control form-control-lg" value="50" step="0.01" min="0"></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Production Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="et-cost" class="form-control form-control-lg" value="15" step="0.01" min="0"></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Shipping Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="et-ship" class="form-control form-control-lg" value="5" step="0.01" min="0"></div></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Sales &amp; Ads</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Quantity Sold</label><input type="number" id="et-qty" class="form-control form-control-lg" value="1" min="1"></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Etsy Ads Spend</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="et-ads" class="form-control form-control-lg" value="0" step="0.01" min="0"></div></div>
                        <div class="p-3 rounded-3 mt-2" style="background:#fef3c7;border:1px solid #fbbf24"><small class="fw-bold text-warning"><i class="fas fa-info-circle me-1"></i>Fees: $0.20 listing + 6.5% transaction + 3% + $0.25 processing</small></div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center"><button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calc" style="min-width:280px;max-width:100%"><i class="fas fa-calculator me-2"></i> Calculate Fees</button></div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(34,197,94,.1);"><i class="fas fa-check-circle" style="color:#22c55e"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Profit Analysis</h5><p class="text-muted small mb-0">Fee breakdown &amp; net earnings</p></div>
                </div>
                <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy"><i class="fas fa-copy me-1"></i> Copy</button>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold mb-0" id="out-profit" style="color:#047857">$0.00</div>
                    <p class="text-muted fw-bold text-uppercase small" style="letter-spacing:1px">Net Profit</p>
                    <span class="badge rounded-pill px-4 py-2 fw-bold" id="out-status" style="background:#dcfce7;color:#16a34a">PROFITABLE</span>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Total Etsy Fees</div><div class="h4 fw-bold mb-0 text-danger" id="out-fees">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Profit Margin</div><div class="h4 fw-bold mb-0 text-primary" id="out-margin">0%</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Revenue</div><div class="h4 fw-bold mb-0 text-success" id="out-revenue">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Fee Rate</div><div class="h4 fw-bold mb-0 text-warning" id="out-feerate">0%</div></div></div>
                    </div>
                </div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Revenue Breakdown</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar bg-success" id="bar-profit">Profit</div>
                <div class="progress-bar bg-warning" id="bar-cost">Cost</div>
                <div class="progress-bar bg-danger" id="bar-fees">Fees</div>
                <div class="progress-bar bg-info" id="bar-ship">Ship</div>
            </div>
            <div class="p-4 rounded-4 bg-light border shadow-sm mt-4"><h6 class="fw-bold mb-3 small text-uppercase text-muted" style="letter-spacing:1px"><i class="fas fa-lightbulb text-warning me-2"></i>Seller Insights</h6><div id="out-insights" class="small text-secondary"></div></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy2" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Report</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-reset2" style="min-width:280px;max-width:100%"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:24px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id),fmt=v=>'$'+v.toFixed(2);
function calc(){
    const price=parseFloat($('et-price').value)||0,cost=parseFloat($('et-cost').value)||0,
    ship=parseFloat($('et-ship').value)||0,qty=parseInt($('et-qty').value)||1,ads=parseFloat($('et-ads').value)||0;
    const listFee=0.20*qty,transFee=price*0.065*qty,procFee=(price*0.03+0.25)*qty;
    const totalFees=listFee+transFee+procFee,revenue=price*qty,totalCost=cost*qty,totalShip=ship*qty;
    const profit=revenue-totalCost-totalShip-totalFees-ads,margin=revenue>0?(profit/revenue)*100:0,feeRate=revenue>0?(totalFees/revenue)*100:0;
    $('out-profit').textContent=fmt(profit);$('out-fees').textContent=fmt(totalFees);
    $('out-margin').textContent=margin.toFixed(1)+'%';$('out-revenue').textContent=fmt(revenue);$('out-feerate').textContent=feeRate.toFixed(1)+'%';
    $('out-profit').style.color=profit>=0?'#047857':'#dc2626';
    const s=$('out-status');
    if(margin>=40){s.textContent='HIGH MARGIN';s.style.background='#dcfce7';s.style.color='#16a34a';}
    else if(margin>=15){s.textContent='PROFITABLE';s.style.background='#fef3c7';s.style.color='#d97706';}
    else if(margin>=0){s.textContent='LOW MARGIN';s.style.background='#ffedd5';s.style.color='#ea580c';}
    else{s.textContent='LOSING MONEY';s.style.background='#fee2e2';s.style.color='#dc2626';}
    if(revenue>0){const pp=Math.max(0,(profit/revenue)*100),cp=(totalCost/revenue)*100,fp=(totalFees/revenue)*100,sp=(totalShip/revenue)*100;
    $('bar-profit').style.width=pp+'%';$('bar-profit').textContent=pp>5?Math.round(pp)+'%':'';
    $('bar-cost').style.width=cp+'%';$('bar-cost').textContent=cp>5?Math.round(cp)+'%':'';
    $('bar-fees').style.width=fp+'%';$('bar-fees').textContent=fp>5?Math.round(fp)+'%':'';
    $('bar-ship').style.width=sp+'%';$('bar-ship').textContent=sp>5?Math.round(sp)+'%':'';}
    const ins=[`Revenue: <strong>${fmt(revenue)}</strong> from ${qty} sale(s) at <strong>${fmt(price)}</strong> each.`,
    `Etsy takes <strong>${fmt(totalFees)}</strong> in fees (${feeRate.toFixed(1)}% of revenue): listing $${(listFee).toFixed(2)} + transaction $${transFee.toFixed(2)} + processing $${procFee.toFixed(2)}.`,
    `Production cost: <strong>${fmt(totalCost)}</strong> + Shipping: <strong>${fmt(totalShip)}</strong>.`,
    ads>0?`Etsy Ads spend: <strong>${fmt(ads)}</strong> — included in profit calculation.`:'',
    margin>=30?'🏆 Great margins! Your pricing and costs are well-optimized.':margin<10?'⚠️ Consider raising prices or reducing production costs to improve margins.':'✅ Healthy profit after all Etsy fees.'].filter(Boolean);
    $('out-insights').innerHTML='<ul class="list-unstyled mb-0">'+ins.map(x=>'<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>'+x+'</span></li>').join('')+'</ul>';
}
$('btn-calc').addEventListener('click',function(){this.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Processing...';this.disabled=true;setTimeout(()=>{calc();this.innerHTML='<i class="fas fa-calculator me-2"></i> Calculate Fees';this.disabled=false;},400);});
['et-price','et-cost','et-ship','et-qty','et-ads'].forEach(id=>$(id).addEventListener('input',calc));
document.querySelectorAll('.preset-btn').forEach(b=>{b.addEventListener('click',()=>{$('et-price').value=b.dataset.price;$('et-cost').value=b.dataset.cost;$('et-ship').value=b.dataset.ship;$('et-qty').value=b.dataset.qty;$('et-ads').value=b.dataset.ads;calc();});});
function reset(){$('et-price').value=50;$('et-cost').value=15;$('et-ship').value=5;$('et-qty').value=1;$('et-ads').value=0;calc();}
$('btn-reset').addEventListener('click',reset);$('btn-reset2').addEventListener('click',reset);
function copy(){navigator.clipboard.writeText('Etsy Fee Report\nPrice: $'+$('et-price').value+'\nProfit: '+$('out-profit').textContent+'\nFees: '+$('out-fees').textContent+'\nMargin: '+$('out-margin').textContent+'\n— ToolsHub').then(()=>{['btn-copy','btn-copy2'].forEach(id=>{const b=$(id);if(b){const o=b.innerHTML;b.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>b.innerHTML=o,2000);}});});}
$('btn-copy').addEventListener('click',copy);$('btn-copy2').addEventListener('click',copy);calc();});
</script>
