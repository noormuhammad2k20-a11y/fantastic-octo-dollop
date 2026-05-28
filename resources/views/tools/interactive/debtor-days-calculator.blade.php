<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-clock text-primary me-2"></i>Period Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-sales="500000" data-deb="85000" data-days="365" data-credit="80" data-target="30">Annual (365d)</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-sales="125000" data-deb="60000" data-days="90" data-credit="75" data-target="30">Quarterly (90d)</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-sales="45000" data-deb="40000" data-days="30" data-credit="70" data-target="15">Monthly (30d)</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Financial Data</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Period Sales Revenue</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dd-sales" class="form-control form-control-lg" value="500000" min="1"></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Trade Debtors (Receivables)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dd-deb" class="form-control form-control-lg" value="85000" min="0"></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Credit Sales Ratio</label><div class="input-group"><input type="number" id="dd-credit" class="form-control form-control-lg" value="80" min="0" max="100"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Period &amp; Targets</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Days in Period</label><input type="number" id="dd-days" class="form-control form-control-lg" value="365" min="1"></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Target DSO (days)</label><input type="number" id="dd-target" class="form-control form-control-lg" value="30" min="1"></div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center"><button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calc" style="min-width:280px;max-width:100%"><i class="fas fa-calculator me-2"></i> Calculate DSO</button></div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(34,197,94,.1);"><i class="fas fa-check-circle" style="color:#22c55e"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">DSO Analysis</h5><p class="text-muted small mb-0">Days Sales Outstanding &amp; liquidity metrics</p></div>
                </div>
                <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy"><i class="fas fa-copy me-1"></i> Copy</button>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold mb-0" id="out-dso" style="color:#be123c">0 Days</div>
                    <p class="text-muted fw-bold text-uppercase small" style="letter-spacing:1px">Debtor Days (DSO)</p>
                    <span class="badge rounded-pill px-4 py-2 fw-bold" id="out-status" style="background:#dcfce7;color:#16a34a">HEALTHY</span>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">% Sales Tied Up</div><div class="h4 fw-bold mb-0 text-danger" id="out-pct">0%</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Daily Sales</div><div class="h4 fw-bold mb-0 text-primary" id="out-vel">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Cash Locked</div><div class="h4 fw-bold mb-0 text-warning" id="out-locked">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">vs Target</div><div class="h4 fw-bold mb-0" id="out-vs">0 days</div></div></div>
                    </div>
                </div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Liquidity Drag Index</h6>
            <div class="progress rounded-pill mb-2" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" id="bar-dso" style="background:#ef4444">0 days</div>
            </div>
            <div class="d-flex justify-content-between small fw-bold text-muted"><span style="color:#10b981">0d (Cash Only)</span><span style="color:#ef4444">100d+ (Trap)</span></div>
            <div class="p-4 rounded-4 bg-light border shadow-sm mt-4"><h6 class="fw-bold mb-3 small text-uppercase text-muted" style="letter-spacing:1px"><i class="fas fa-lightbulb text-warning me-2"></i>Liquidity Insights</h6><div id="out-insights" class="small text-secondary"></div></div>
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
    const sales=parseFloat($('dd-sales').value)||1,deb=parseFloat($('dd-deb').value)||0,
    days=parseFloat($('dd-days').value)||1,credit=(parseFloat($('dd-credit').value)||100)/100,
    target=parseFloat($('dd-target').value)||30;
    const creditSales=sales*credit,dso=creditSales>0?(deb/creditSales)*days:0,pct=(deb/sales)*100,vel=sales/days;
    const diff=dso-target,locked=deb;
    $('out-dso').textContent=Math.round(dso)+' Days';
    $('out-pct').textContent=pct.toFixed(1)+'%';$('out-vel').textContent=fmt(vel)+'/day';
    $('out-locked').textContent=fmt(locked);
    const vs=$('out-vs');vs.textContent=(diff>0?'+':'')+Math.round(diff)+' days';
    vs.className='h4 fw-bold mb-0 '+(diff>0?'text-danger':'text-success');
    const s=$('out-status');
    if(dso>90){s.textContent='LIQUIDITY TRAP';s.style.background='#fee2e2';s.style.color='#dc2626';$('out-dso').style.color='#be123c';}
    else if(dso>60){s.textContent='SLOW COLLECTION';s.style.background='#ffedd5';s.style.color='#ea580c';$('out-dso').style.color='#ea580c';}
    else if(dso>35){s.textContent='ELEVATED';s.style.background='#fef3c7';s.style.color='#d97706';$('out-dso').style.color='#d97706';}
    else{s.textContent='HEALTHY VELOCITY';s.style.background='#dcfce7';s.style.color='#16a34a';$('out-dso').style.color='#047857';}
    const pDso=Math.min(100,(dso/100)*100);
    $('bar-dso').style.width=pDso+'%';$('bar-dso').textContent=Math.round(dso)+' days';
    $('bar-dso').style.background=dso>90?'#be123c':dso>60?'#ea580c':dso>35?'#f59e0b':'#10b981';
    const excessCash=diff>0?vel*diff:0;
    const ins=[`DSO of <strong>${Math.round(dso)} days</strong> means it takes ~${Math.round(dso)} days to collect receivables.`,
    `<strong>${fmt(deb)}</strong> in receivables on <strong>${fmt(sales)}</strong> sales (${pct.toFixed(1)}% tied up).`,
    diff>0?`⚠️ <strong>${Math.round(diff)} days</strong> above your ${target}-day target. Excess cash locked: ~<strong>${fmt(excessCash)}</strong>.`:`✅ <strong>${Math.abs(Math.round(diff))} days</strong> better than your ${target}-day target!`,
    `Daily sales velocity: <strong>${fmt(vel)}</strong>. Credit sales: <strong>${(credit*100).toFixed(0)}%</strong> of total.`,
    dso>60?'💡 Consider tightening credit terms, offering early payment discounts, or automating follow-ups.':'💡 Maintain current collection efficiency with regular AR reviews.'];
    $('out-insights').innerHTML='<ul class="list-unstyled mb-0">'+ins.map(x=>'<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>'+x+'</span></li>').join('')+'</ul>';
}
$('btn-calc').addEventListener('click',function(){this.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Processing...';this.disabled=true;setTimeout(()=>{calc();this.innerHTML='<i class="fas fa-calculator me-2"></i> Calculate DSO';this.disabled=false;},400);});
['dd-sales','dd-deb','dd-days','dd-credit','dd-target'].forEach(id=>$(id).addEventListener('input',calc));
document.querySelectorAll('.preset-btn').forEach(b=>{b.addEventListener('click',()=>{$('dd-sales').value=b.dataset.sales;$('dd-deb').value=b.dataset.deb;$('dd-days').value=b.dataset.days;$('dd-credit').value=b.dataset.credit;$('dd-target').value=b.dataset.target;calc();});});
function reset(){$('dd-sales').value=500000;$('dd-deb').value=85000;$('dd-days').value=365;$('dd-credit').value=80;$('dd-target').value=30;calc();}
$('btn-reset').addEventListener('click',reset);$('btn-reset2').addEventListener('click',reset);
function copy(){navigator.clipboard.writeText('DSO Report\nDSO: '+$('out-dso').textContent+'\nReceivables: '+$('out-locked').textContent+'\nDaily Sales: '+$('out-vel').textContent+'\n— ToolsHub').then(()=>{['btn-copy','btn-copy2'].forEach(id=>{const b=$(id);if(b){const o=b.innerHTML;b.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>b.innerHTML=o,2000);}});});}
$('btn-copy').addEventListener('click',copy);$('btn-copy2').addEventListener('click',copy);calc();});
</script>
