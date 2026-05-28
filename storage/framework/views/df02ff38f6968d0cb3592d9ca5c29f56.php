<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-shield-alt text-primary me-2"></i>Industry Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-prob="15" data-impact="500000" data-spend="50000" data-reduce="60" data-staff="2" data-salary="85000" data-downtime="8" data-hourly="5000">SMB</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-prob="25" data-impact="5000000" data-spend="500000" data-reduce="75" data-staff="10" data-salary="95000" data-downtime="24" data-hourly="50000">Enterprise</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-prob="30" data-impact="10000000" data-spend="2000000" data-reduce="80" data-staff="25" data-salary="110000" data-downtime="48" data-hourly="100000">Financial Sector</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Risk Assessment</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Breach Probability (%/yr)</label><div class="input-group"><input type="number" id="cs-prob" class="form-control form-control-lg" value="15" min="0" max="100" step="1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Breach Impact Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cs-impact" class="form-control form-control-lg" value="500000" min="0"></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Risk Reduction (%)</label><div class="input-group"><input type="number" id="cs-reduce" class="form-control form-control-lg" value="60" min="0" max="100"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Costs &amp; Downtime</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Annual Security Spend</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cs-spend" class="form-control form-control-lg" value="50000" min="0"></div></div>
                        <div class="row g-3">
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Security Staff</label><input type="number" id="cs-staff" class="form-control form-control-lg" value="2" min="0"></div>
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Avg Salary</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cs-salary" class="form-control form-control-lg" value="85000" min="0"></div></div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Downtime (hrs)</label><input type="number" id="cs-downtime" class="form-control form-control-lg" value="8" min="0"></div>
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Hourly Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cs-hourly" class="form-control form-control-lg" value="5000" min="0"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center"><button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calc" style="min-width:280px;max-width:100%"><i class="fas fa-calculator me-2"></i> Calculate ROI</button></div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(34,197,94,.1);"><i class="fas fa-check-circle" style="color:#22c55e"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Security ROI Analysis</h5><p class="text-muted small mb-0">Risk reduction &amp; financial impact</p></div>
                </div>
                <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy"><i class="fas fa-copy me-1"></i> Copy</button>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0" id="out-roi">0%</div>
                    <p class="text-muted fw-bold text-uppercase small" style="letter-spacing:1px">Security ROI</p>
                    <span class="badge rounded-pill px-4 py-2 fw-bold" id="out-status" style="background:#dcfce7;color:#16a34a">POSITIVE</span>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">ALE (Before)</div><div class="h4 fw-bold mb-0 text-danger" id="out-ale-before">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">ALE (After)</div><div class="h4 fw-bold mb-0 text-success" id="out-ale-after">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Risk Saved</div><div class="h4 fw-bold mb-0 text-primary" id="out-saved">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Total Cost</div><div class="h4 fw-bold mb-0 text-warning" id="out-total-cost">$0</div></div></div>
                    </div>
                </div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Cost vs Benefit</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar bg-success" id="bar-benefit">Benefit</div>
                <div class="progress-bar bg-danger" id="bar-cost">Cost</div>
            </div>
            <div class="p-4 rounded-4 bg-light border shadow-sm mt-4"><h6 class="fw-bold mb-3 small text-uppercase text-muted" style="letter-spacing:1px"><i class="fas fa-lightbulb text-warning me-2"></i>Security Analysis</h6><div id="out-insights" class="small text-secondary"></div></div>
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
    const prob=parseFloat($('cs-prob').value)||0,impact=parseFloat($('cs-impact').value)||0,spend=parseFloat($('cs-spend').value)||0,
    reduce=parseFloat($('cs-reduce').value)||0,staff=parseFloat($('cs-staff').value)||0,salary=parseFloat($('cs-salary').value)||0,
    downtime=parseFloat($('cs-downtime').value)||0,hourly=parseFloat($('cs-hourly').value)||0;
    const aleBefore=(prob/100)*impact,downtimeCost=downtime*hourly*(prob/100),aleAfter=(prob/100)*(1-reduce/100)*impact;
    const riskSaved=aleBefore-aleAfter,totalCost=spend+(staff*salary),netBenefit=riskSaved-totalCost;
    const roi=totalCost>0?((riskSaved-totalCost)/totalCost)*100:0;
    $('out-roi').textContent=roi.toFixed(1)+'%';$('out-ale-before').textContent=fmt(aleBefore);
    $('out-ale-after').textContent=fmt(aleAfter);$('out-saved').textContent=fmt(riskSaved);$('out-total-cost').textContent=fmt(totalCost);
    const s=$('out-status');
    if(roi>=100){s.textContent='EXCELLENT ROI';s.style.background='#dcfce7';s.style.color='#16a34a';}
    else if(roi>=0){s.textContent='POSITIVE ROI';s.style.background='#fef3c7';s.style.color='#d97706';}
    else{s.textContent='NEGATIVE ROI';s.style.background='#fee2e2';s.style.color='#dc2626';}
    const total=riskSaved+totalCost;if(total>0){const bp=(riskSaved/total)*100,cp=(totalCost/total)*100;
    $('bar-benefit').style.width=bp+'%';$('bar-benefit').textContent=Math.round(bp)+'% Savings';
    $('bar-cost').style.width=cp+'%';$('bar-cost').textContent=Math.round(cp)+'% Cost';}
    const ins=[`Annual Loss Expectancy drops from <strong>${fmt(aleBefore)}</strong> to <strong>${fmt(aleAfter)}</strong> (${reduce}% risk reduction).`,
    `Net benefit: <strong>${fmt(netBenefit)}</strong> after <strong>${fmt(totalCost)}</strong> total security investment.`,
    `Estimated downtime cost per incident: <strong>${fmt(downtime*hourly)}</strong>.`,
    roi>=100?'🛡️ Outstanding security ROI — every dollar invested saves multiple dollars in risk.':roi<0?'⚠️ Security spend exceeds risk reduction. Consider optimizing your security portfolio.':'✅ Positive ROI — security investment is justified.',
    `For every $1 spent on security, you save <strong>$${(riskSaved/Math.max(1,totalCost)).toFixed(2)}</strong> in expected losses.`];
    $('out-insights').innerHTML='<ul class="list-unstyled mb-0">'+ins.map(x=>'<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>'+x+'</span></li>').join('')+'</ul>';
}
$('btn-calc').addEventListener('click',function(){this.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Processing...';this.disabled=true;setTimeout(()=>{calc();this.innerHTML='<i class="fas fa-calculator me-2"></i> Calculate ROI';this.disabled=false;},400);});
['cs-prob','cs-impact','cs-spend','cs-reduce','cs-staff','cs-salary','cs-downtime','cs-hourly'].forEach(id=>$(id).addEventListener('input',calc));
document.querySelectorAll('.preset-btn').forEach(b=>{b.addEventListener('click',()=>{$('cs-prob').value=b.dataset.prob;$('cs-impact').value=b.dataset.impact;$('cs-spend').value=b.dataset.spend;$('cs-reduce').value=b.dataset.reduce;$('cs-staff').value=b.dataset.staff;$('cs-salary').value=b.dataset.salary;$('cs-downtime').value=b.dataset.downtime;$('cs-hourly').value=b.dataset.hourly;calc();});});
function reset(){$('cs-prob').value=15;$('cs-impact').value=500000;$('cs-spend').value=50000;$('cs-reduce').value=60;$('cs-staff').value=2;$('cs-salary').value=85000;$('cs-downtime').value=8;$('cs-hourly').value=5000;calc();}
$('btn-reset').addEventListener('click',reset);$('btn-reset2').addEventListener('click',reset);
function copy(){navigator.clipboard.writeText('Security ROI Report\nROI: '+$('out-roi').textContent+'\nRisk Saved: '+$('out-saved').textContent+'\nTotal Cost: '+$('out-total-cost').textContent+'\n— ToolsHub').then(()=>{['btn-copy','btn-copy2'].forEach(id=>{const b=$(id);if(b){const o=b.innerHTML;b.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>b.innerHTML=o,2000);}});});}
$('btn-copy').addEventListener('click',copy);$('btn-copy2').addEventListener('click',copy);calc();});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cybersecurity-roi-calculator.blade.php ENDPATH**/ ?>