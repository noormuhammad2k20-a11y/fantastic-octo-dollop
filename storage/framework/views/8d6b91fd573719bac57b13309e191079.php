<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-building text-primary me-2"></i>Property Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-rent="2400" data-units="4" data-vac="5" data-mgmt="8" data-maint="200" data-ins="150" data-tax="300" data-price="400000">4-Unit Residential</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-rent="5000" data-units="8" data-vac="7" data-mgmt="10" data-maint="400" data-ins="300" data-tax="600" data-price="1200000">Small Apartment</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-rent="15000" data-units="1" data-vac="5" data-mgmt="5" data-maint="500" data-ins="400" data-tax="800" data-price="2500000">Commercial</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Income</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Monthly Rent per Unit</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cr-rent" class="form-control form-control-lg" value="2400" min="0"></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Number of Units</label><input type="number" id="cr-units" class="form-control form-control-lg" value="4" min="1"></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Vacancy Rate (%)</label><div class="input-group"><input type="number" id="cr-vac" class="form-control form-control-lg" value="5" min="0" max="100" step="1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Expenses & Price</h6>
                        <div class="row g-3">
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Mgmt Fee (%)</label><div class="input-group"><input type="number" id="cr-mgmt" class="form-control form-control-lg" value="8" min="0" max="100"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Maint / Mo</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cr-maint" class="form-control form-control-lg" value="200" min="0"></div></div>
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Insurance / Mo</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cr-ins" class="form-control form-control-lg" value="150" min="0"></div></div>
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Tax / Mo</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cr-tax" class="form-control form-control-lg" value="300" min="0"></div></div>
                        </div>
                        <div class="mt-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Property Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cr-price" class="form-control form-control-lg" value="400000" min="0"></div></div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center"><button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calc" style="min-width:280px;max-width:100%"><i class="fas fa-calculator me-2"></i> Calculate Cap Rate</button></div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(34,197,94,.1);"><i class="fas fa-check-circle" style="color:#22c55e"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Investment Analysis</h5><p class="text-muted small mb-0">Cap rate &amp; NOI breakdown</p></div>
                </div>
                <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy"><i class="fas fa-copy me-1"></i> Copy</button>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0" id="out-cap">0%</div>
                    <p class="text-muted fw-bold text-uppercase small" style="letter-spacing:1px">Cap Rate</p>
                    <span class="badge rounded-pill px-4 py-2 fw-bold" id="out-status" style="background:#dcfce7;color:#16a34a">GOOD</span>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Annual NOI</div><div class="h4 fw-bold mb-0 text-primary" id="out-noi">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Gross Income</div><div class="h4 fw-bold mb-0 text-success" id="out-gri">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Total Expenses</div><div class="h4 fw-bold mb-0 text-danger" id="out-exp">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Monthly Cash Flow</div><div class="h4 fw-bold mb-0 text-info" id="out-mcf">$0</div></div></div>
                    </div>
                </div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Income vs Expenses</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar bg-success" id="bar-noi">NOI</div>
                <div class="progress-bar bg-danger" id="bar-exp">Expenses</div>
                <div class="progress-bar bg-secondary" id="bar-vac">Vacancy</div>
            </div>
            <div class="p-4 rounded-4 bg-light border shadow-sm mt-4"><h6 class="fw-bold mb-3 small text-uppercase text-muted" style="letter-spacing:1px"><i class="fas fa-lightbulb text-warning me-2"></i>Investment Insights</h6><div id="out-insights" class="small text-secondary"></div></div>
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
const $=id=>document.getElementById(id),fmt=v=>'$'+Math.round(v).toLocaleString();
function calc(){
    const rent=parseFloat($('cr-rent').value)||0,units=parseFloat($('cr-units').value)||1,vac=parseFloat($('cr-vac').value)||0,
    mgmt=parseFloat($('cr-mgmt').value)||0,maint=parseFloat($('cr-maint').value)||0,ins=parseFloat($('cr-ins').value)||0,
    tax=parseFloat($('cr-tax').value)||0,price=parseFloat($('cr-price').value)||0;
    const grossMonthly=rent*units,grossAnnual=grossMonthly*12,vacLoss=grossAnnual*(vac/100),effGross=grossAnnual-vacLoss;
    const mgmtCost=effGross*(mgmt/100),totalExpAnnual=(maint+ins+tax)*12+mgmtCost,noi=effGross-totalExpAnnual;
    const capRate=price>0?(noi/price)*100:0,mcf=noi/12;
    $('out-cap').textContent=capRate.toFixed(2)+'%';$('out-noi').textContent=fmt(noi);$('out-gri').textContent=fmt(grossAnnual);
    $('out-exp').textContent=fmt(totalExpAnnual);$('out-mcf').textContent=fmt(mcf);
    const s=$('out-status');
    if(capRate>=8){s.textContent='EXCELLENT DEAL';s.style.background='#dcfce7';s.style.color='#16a34a';}
    else if(capRate>=5){s.textContent='GOOD INVESTMENT';s.style.background='#fef3c7';s.style.color='#d97706';}
    else if(capRate>=3){s.textContent='MODERATE';s.style.background='#e0f2fe';s.style.color='#0284c7';}
    else{s.textContent='LOW RETURN';s.style.background='#fee2e2';s.style.color='#dc2626';}
    if(grossAnnual>0){const np=(noi/grossAnnual)*100,ep=(totalExpAnnual/grossAnnual)*100,vp=(vacLoss/grossAnnual)*100;
    $('bar-noi').style.width=Math.max(0,np)+'%';$('bar-noi').textContent=Math.round(np)+'% NOI';
    $('bar-exp').style.width=ep+'%';$('bar-exp').textContent=Math.round(ep)+'% Exp';
    $('bar-vac').style.width=vp+'%';$('bar-vac').textContent=vp>3?Math.round(vp)+'%':'';}
    const ins2=[`Cap rate of <strong>${capRate.toFixed(2)}%</strong> on a <strong>${fmt(price)}</strong> property.`,
    `Annual NOI: <strong>${fmt(noi)}</strong> from <strong>${fmt(grossAnnual)}</strong> gross rent.`,
    `Monthly cash flow: <strong>${fmt(mcf)}</strong> after all expenses.`,
    capRate>=8?'🏆 Above-average cap rate — high yield relative to price.':capRate<4?'⚠️ Low cap rate typical of premium locations or overpriced properties.':'✅ Solid cap rate for most markets.',
    `Vacancy loss of <strong>${vac}%</strong> = <strong>${fmt(vacLoss)}</strong>/yr. Management: <strong>${fmt(mgmtCost)}</strong>/yr.`];
    $('out-insights').innerHTML='<ul class="list-unstyled mb-0">'+ins2.map(x=>'<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>'+x+'</span></li>').join('')+'</ul>';
}
$('btn-calc').addEventListener('click',function(){this.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Processing...';this.disabled=true;setTimeout(()=>{calc();this.innerHTML='<i class="fas fa-calculator me-2"></i> Calculate Cap Rate';this.disabled=false;},400);});
['cr-rent','cr-units','cr-vac','cr-mgmt','cr-maint','cr-ins','cr-tax','cr-price'].forEach(id=>$(id).addEventListener('input',calc));
document.querySelectorAll('.preset-btn').forEach(b=>{b.addEventListener('click',()=>{$('cr-rent').value=b.dataset.rent;$('cr-units').value=b.dataset.units;$('cr-vac').value=b.dataset.vac;$('cr-mgmt').value=b.dataset.mgmt;$('cr-maint').value=b.dataset.maint;$('cr-ins').value=b.dataset.ins;$('cr-tax').value=b.dataset.tax;$('cr-price').value=b.dataset.price;calc();});});
function reset(){$('cr-rent').value=2400;$('cr-units').value=4;$('cr-vac').value=5;$('cr-mgmt').value=8;$('cr-maint').value=200;$('cr-ins').value=150;$('cr-tax').value=300;$('cr-price').value=400000;calc();}
$('btn-reset').addEventListener('click',reset);$('btn-reset2').addEventListener('click',reset);
function copy(){navigator.clipboard.writeText('Cap Rate Report\nCap Rate: '+$('out-cap').textContent+'\nNOI: '+$('out-noi').textContent+'\nPrice: '+$('cr-price').value+'\n— ToolsHub').then(()=>{['btn-copy','btn-copy2'].forEach(id=>{const b=$(id);if(b){const o=b.innerHTML;b.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>b.innerHTML=o,2000);}});});}
$('btn-copy').addEventListener('click',copy);$('btn-copy2').addEventListener('click',copy);calc();});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cap-rate-calculator.blade.php ENDPATH**/ ?>