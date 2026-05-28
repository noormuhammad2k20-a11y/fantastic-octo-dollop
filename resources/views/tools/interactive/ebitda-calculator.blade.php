<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-magic text-primary me-2"></i>Quick Examples</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-i="100000" data-int="15000" data-t="25000" data-d="30000" data-a="10000" data-r="1000000">Startup</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-i="1500000" data-int="200000" data-t="400000" data-d="300000" data-a="100000" data-r="10000000">Mid-Size</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 preset-btn" data-i="15000000" data-int="2000000" data-t="4000000" data-d="3000000" data-a="1000000" data-r="100000000">Enterprise</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Income Statement</h6>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Total Revenue</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-revenue" class="form-control form-control-lg" value="1000000" min="0"></div></div>
                        <div class="mb-3"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Net Income</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-income" class="form-control form-control-lg" value="100000" min="0"></div></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px">Add-Backs</h6>
                        <div class="row g-3">
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Interest</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-interest" class="form-control form-control-lg" value="15000" min="0"></div></div>
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Taxes</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-taxes" class="form-control form-control-lg" value="25000" min="0"></div></div>
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Depreciation</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-dep" class="form-control form-control-lg" value="30000" min="0"></div></div>
                            <div class="col-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Amortization</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="eb-amort" class="form-control form-control-lg" value="10000" min="0"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center"><button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calc" style="min-width:280px;max-width:100%"><i class="fas fa-calculator me-2"></i> Calculate EBITDA</button></div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(34,197,94,.1);"><i class="fas fa-check-circle" style="color:#22c55e"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">EBITDA Analysis</h5><p class="text-muted small mb-0">Profitability metrics breakdown</p></div>
                </div>
                <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy"><i class="fas fa-copy me-1"></i> Copy</button>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0" id="out-ebitda">$0</div>
                    <p class="text-muted fw-bold text-uppercase small" style="letter-spacing:1px">EBITDA</p>
                    <span class="badge rounded-pill px-4 py-2 fw-bold" id="out-status" style="background:#dcfce7;color:#16a34a">HEALTHY</span>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">EBITDA Margin</div><div class="h4 fw-bold mb-0 text-primary" id="out-margin">0%</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">EBIT</div><div class="h4 fw-bold mb-0 text-success" id="out-ebit">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">D&amp;A Total</div><div class="h4 fw-bold mb-0 text-info" id="out-da">$0</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Net Margin</div><div class="h4 fw-bold mb-0 text-warning" id="out-net-margin">0%</div></div></div>
                    </div>
                </div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>EBITDA Composition</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#3b82f6" id="bar-i">Income</div>
                <div class="progress-bar" style="background:#f59e0b" id="bar-int">Interest</div>
                <div class="progress-bar" style="background:#ef4444" id="bar-t">Taxes</div>
                <div class="progress-bar" style="background:#8b5cf6" id="bar-da">D&amp;A</div>
            </div>
            <div class="p-4 rounded-4 bg-light border shadow-sm mt-4"><h6 class="fw-bold mb-3 small text-uppercase text-muted" style="letter-spacing:1px"><i class="fas fa-lightbulb text-warning me-2"></i>Analysis</h6><div id="out-insights" class="small text-secondary"></div></div>
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
    const r=parseFloat($('eb-revenue').value)||0,i=parseFloat($('eb-income').value)||0,
    int=parseFloat($('eb-interest').value)||0,t=parseFloat($('eb-taxes').value)||0,
    d=parseFloat($('eb-dep').value)||0,a=parseFloat($('eb-amort').value)||0;
    const da=d+a,ebitda=i+int+t+da,ebit=i+int+t,margin=r>0?(ebitda/r)*100:0,nMargin=r>0?(i/r)*100:0;
    $('out-ebitda').textContent=fmt(ebitda);$('out-margin').textContent=margin.toFixed(1)+'%';
    $('out-ebit').textContent=fmt(ebit);$('out-da').textContent=fmt(da);$('out-net-margin').textContent=nMargin.toFixed(1)+'%';
    const s=$('out-status');
    if(margin>=20){s.textContent='EXCELLENT';s.style.background='#dcfce7';s.style.color='#16a34a';}
    else if(margin>=10){s.textContent='HEALTHY';s.style.background='#fef3c7';s.style.color='#d97706';}
    else{s.textContent='LOW MARGIN';s.style.background='#fee2e2';s.style.color='#dc2626';}
    if(ebitda>0){const ip=(i/ebitda)*100,inp=(int/ebitda)*100,tp=(t/ebitda)*100,dp=(da/ebitda)*100;
    $('bar-i').style.width=ip+'%';$('bar-i').textContent=Math.round(ip)+'%';
    $('bar-int').style.width=inp+'%';$('bar-int').textContent=inp>4?Math.round(inp)+'%':'';
    $('bar-t').style.width=tp+'%';$('bar-t').textContent=tp>4?Math.round(tp)+'%':'';
    $('bar-da').style.width=dp+'%';$('bar-da').textContent=dp>4?Math.round(dp)+'%':'';}
    const ins=[`EBITDA of <strong>${fmt(ebitda)}</strong> = <strong>${margin.toFixed(1)}%</strong> margin on ${fmt(r)} revenue.`,
    `D&A adds back <strong>${fmt(da)}</strong> of non-cash expenses.`,
    margin>=20?'🚀 Excellent EBITDA margin — strong cash flow generation.':margin<10?'⚠️ Low margin may indicate high costs or pricing pressure.':'✅ Healthy profitability level.',
    `EBIT: <strong>${fmt(ebit)}</strong> | Net income margin: <strong>${nMargin.toFixed(1)}%</strong>.`];
    $('out-insights').innerHTML='<ul class="list-unstyled mb-0">'+ins.map(x=>'<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>'+x+'</span></li>').join('')+'</ul>';
}
$('btn-calc').addEventListener('click',function(){this.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Processing...';this.disabled=true;setTimeout(()=>{calc();this.innerHTML='<i class="fas fa-calculator me-2"></i> Calculate EBITDA';this.disabled=false;},400);});
['eb-revenue','eb-income','eb-interest','eb-taxes','eb-dep','eb-amort'].forEach(id=>$(id).addEventListener('input',calc));
document.querySelectorAll('.preset-btn').forEach(b=>{b.addEventListener('click',()=>{$('eb-revenue').value=b.dataset.r;$('eb-income').value=b.dataset.i;$('eb-interest').value=b.dataset.int;$('eb-taxes').value=b.dataset.t;$('eb-dep').value=b.dataset.d;$('eb-amort').value=b.dataset.a;calc();});});
function reset(){$('eb-revenue').value=1000000;$('eb-income').value=100000;$('eb-interest').value=15000;$('eb-taxes').value=25000;$('eb-dep').value=30000;$('eb-amort').value=10000;calc();}
$('btn-reset').addEventListener('click',reset);$('btn-reset2').addEventListener('click',reset);
function copy(){navigator.clipboard.writeText('EBITDA Report\nEBITDA: '+$('out-ebitda').textContent+'\nMargin: '+$('out-margin').textContent+'\nEBIT: '+$('out-ebit').textContent+'\n— ToolsHub').then(()=>{['btn-copy','btn-copy2'].forEach(id=>{const b=$(id);if(b){const o=b.innerHTML;b.innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(()=>b.innerHTML=o,2000);}});});}
$('btn-copy').addEventListener('click',copy);$('btn-copy2').addEventListener('click',copy);calc();});
</script>
