<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-magic text-primary me-2"></i>Quick Actions</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-price="50" data-div="2.50" data-shares="1000" data-gr="2" data-yrs="1" data-freq="4">Avg Dividend Stock</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-price="25" data-div="2.00" data-shares="2000" data-gr="5" data-yrs="10" data-freq="4">High Yield REIT</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="qa-drip">🔄 Simulate 5yr DRIP</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="qa-yield">📈 Set 8% Yield</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Stock Info</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Share Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dy-price" class="form-control form-control-lg" value="50.00" step="0.01" min="0"></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Annual Dividend / Share</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dy-div" class="form-control form-control-lg" value="2.50" step="0.01" min="0"></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Payment Frequency</label><select id="dy-freq" class="form-select form-select-lg"><option value="4">Quarterly</option><option value="12">Monthly</option><option value="2">Semi-Annual</option><option value="1">Annual</option></select></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Portfolio &amp; Growth</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Shares Owned</label><input type="number" id="dy-shares" class="form-control form-control-lg" value="1000" min="0"></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Annual Div Growth Rate</label><div class="input-group"><input type="number" id="dy-gr" class="form-control form-control-lg" value="2.0" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Projection Years</label><input type="number" id="dy-yrs" class="form-control form-control-lg" value="1" min="1" max="50"></div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center"><button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calc" style="min-width:280px;max-width:100%"><i class="fas fa-calculator me-2"></i> Calculate Yield</button></div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(34,197,94,.1);"><i class="fas fa-check-circle" style="color:#22c55e"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Dividend Analysis</h5><p class="text-muted small mb-0">Yield &amp; cash flow projections</p></div>
                </div>
                <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy"><i class="fas fa-copy me-1"></i> Copy</button>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold mb-0" id="out-yield" style="color:#047857">0.0%</div>
                    <p class="text-muted fw-bold text-uppercase small" style="letter-spacing:1px">Current Yield</p>
                    <span class="badge rounded-pill px-4 py-2 fw-bold" id="out-status" style="background:#dcfce7;color:#16a34a">AVERAGE</span>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Portfolio Value</div><div class="h4 fw-bold mb-0 text-primary" id="out-value">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Annual Income (Yr 1)</div><div class="h4 fw-bold mb-0 text-success" id="out-cf1">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Projected (Future)</div><div class="h4 fw-bold mb-0 text-info" id="out-cff">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Per Payment</div><div class="h4 fw-bold mb-0 text-warning" id="out-per">$0</div></div></div>
                    </div>
                </div>
            </div>
            <div class="p-4 rounded-4 bg-light border shadow-sm mt-4"><h6 class="fw-bold mb-3 small text-uppercase text-muted" style="letter-spacing:1px"><i class="fas fa-lightbulb text-warning me-2"></i>Dividend Insights</h6><div id="out-insights" class="small text-secondary"></div></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy2" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-reset2" style="min-width:280px;max-width:100%"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:24px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id),fmt=v=>'$'+Math.max(0,v).toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});
function calc(){
    const price=parseFloat($('dy-price').value)||0,div=parseFloat($('dy-div').value)||0,shares=parseFloat($('dy-shares').value)||0,
    gr=(parseFloat($('dy-gr').value)||0)/100,yrs=parseInt($('dy-yrs').value)||1,freq=parseInt($('dy-freq').value)||4;
    const yld=price>0?(div/price)*100:0,totVal=shares*price,cf1=shares*div;
    const divF=div*Math.pow(1+gr,Math.max(0,yrs-1)),cff=shares*divF,perPayment=cf1/freq;
    $('out-yield').textContent=yld.toFixed(2)+'%';$('out-value').textContent=fmt(totVal);
    $('out-cf1').textContent=fmt(cf1);$('out-cff').textContent=fmt(cff);$('out-per').textContent=fmt(perPayment);
    const s=$('out-status');
    if(yld>=6){s.textContent='HIGH YIELD';s.style.background='#dcfce7';s.style.color='#16a34a';}
    else if(yld>=3){s.textContent='ABOVE AVERAGE';s.style.background='#fef3c7';s.style.color='#d97706';}
    else if(yld>=1){s.textContent='AVERAGE YIELD';s.style.background='#e0f2fe';s.style.color='#0284c7';}
    else{s.textContent='LOW/NO YIELD';s.style.background='#fee2e2';s.style.color='#dc2626';}
    const ins=[`Current yield of <strong>${yld.toFixed(2)}%</strong> on a <strong>${fmt(price)}</strong> share.`,
    `Annual income: <strong>${fmt(cf1)}</strong> across <strong>${freq}</strong> payments of <strong>${fmt(perPayment)}</strong>.`,
    yrs>1?`With ${(gr*100).toFixed(1)}% annual growth, projected Year ${yrs} income: <strong>${fmt(cff)}</strong>.`:'',
    `Portfolio value: <strong>${fmt(totVal)}</strong> across ${shares.toLocaleString()} shares.`,
    yld>=6?'🏆 High-yield stock — watch for dividend sustainability and payout ratio.':yld<2?'ℹ️ Low yield may indicate growth stock or recently cut dividend.':'✅ Solid dividend income stream.'].filter(Boolean);
    $('out-insights').innerHTML='<ul class="list-unstyled mb-0">'+ins.map(x=>'<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>'+x+'</span></li>').join('')+'</ul>';
}
$('btn-calc').addEventListener('click',function(){this.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Processing...';this.disabled=true;setTimeout(()=>{calc();this.innerHTML='<i class="fas fa-calculator me-2"></i> Calculate Yield';this.disabled=false;},400);});
['dy-price','dy-div','dy-shares','dy-gr','dy-yrs','dy-freq'].forEach(id=>$(id).addEventListener('input',calc));
document.querySelectorAll('.preset-btn').forEach(b=>{b.addEventListener('click',()=>{$('dy-price').value=b.dataset.price;$('dy-div').value=b.dataset.div;$('dy-shares').value=b.dataset.shares;$('dy-gr').value=b.dataset.gr;$('dy-yrs').value=b.dataset.yrs;$('dy-freq').value=b.dataset.freq;calc();});});
$('qa-drip').addEventListener('click',()=>{$('dy-yrs').value=5;const yld=(parseFloat($('dy-div').value)||0)/(parseFloat($('dy-price').value)||1);$('dy-shares').value=Math.floor((parseFloat($('dy-shares').value)||0)*Math.pow(1+yld,5));calc();});
$('qa-yield').addEventListener('click',()=>{const p=parseFloat($('dy-price').value)||50;$('dy-div').value=(p*0.08).toFixed(2);calc();});
function reset(){$('dy-price').value=50;$('dy-div').value=2.50;$('dy-shares').value=1000;$('dy-gr').value=2.0;$('dy-yrs').value=1;$('dy-freq').value=4;calc();}
$('btn-reset').addEventListener('click',reset);$('btn-reset2').addEventListener('click',reset);
function copy(){navigator.clipboard.writeText('Dividend Yield Report\nYield: '+$('out-yield').textContent+'\nAnnual Income: '+$('out-cf1').textContent+'\nPortfolio: '+$('out-value').textContent+'\n— ToolsHub').then(()=>{['btn-copy','btn-copy2'].forEach(id=>{const b=$(id);if(b){const o=b.innerHTML;b.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>b.innerHTML=o,2000);}});});}
$('btn-copy').addEventListener('click',copy);$('btn-copy2').addEventListener('click',copy);calc();});
</script>
