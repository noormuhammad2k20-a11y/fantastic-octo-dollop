<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-3 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Funnel Health Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 fn-qa" data-s1="30" data-s2="20" data-s3="15">Standard SaaS</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 fn-qa" data-s1="50" data-s2="40" data-s3="25">High CVR Flow</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 fn-qa" data-s1="40" data-s2="35" data-s3="2">Leaky Checkout</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 fn-qa" data-s1="5" data-s2="50" data-s3="20">High Bounce / Low ATC</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 fn-qa" data-t="1000" data-s1="10" data-s2="10" data-s3="20" data-a="5000">High-Ticket Sales</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 fn-qa" data-s1="15" data-s2="10" data-s3="5">Cold Traffic</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Top of Funnel: Total Leads</label>
                    <input type="number" id="fn-traf" class="form-control form-control-lg fn-in border-primary" value="50000" min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Avg Deal Size ($)</label>
                    <input type="number" id="fn-aov" class="form-control form-control-lg fn-in" value="150" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">View → Engage (%)</label>
                    <input type="number" id="fn-s1" class="form-control form-control-lg fn-in" value="20" step="1" max="100">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Engage → Intent (%)</label>
                    <input type="number" id="fn-s2" class="form-control form-control-lg fn-in" value="30" step="1" max="100">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Intent → Buyer (%)</label>
                    <input type="number" id="fn-s3" class="form-control form-control-lg fn-in fw-bold text-success" value="15" step="1" max="100">
                </div>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Funnel Yield</h5><p class="text-muted small mb-0">Total revenue, buyers, and conversion rate</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="fn-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#fffbeb;border:2px solid #fde68a;min-width:260px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px">Final Revenue Yield</span>
                    <div class="display-4 fw-bold" style="color:#d97706" id="fn-rev">$0</div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-4 col-6"><div class="stat-card"><span class="stat-card-label">Total Buyers</span><span class="stat-card-value" id="fn-buyers">0</span></div></div>
                <div class="col-md-4 col-6"><div class="stat-card"><span class="stat-card-label">Cumulative CVR</span><span class="stat-card-value text-primary" id="fn-cvr">0.00%</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Funnel Health</span><span class="stat-card-value" id="fn-health">Checking...</span></div></div>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var $=function(id){return document.getElementById(id);};
    function fmt(n){return '$'+Math.max(0,n).toLocaleString('en-US',{minimumFractionDigits:0,maximumFractionDigits:0});}
    function calc(){
        var traf=parseFloat($('fn-traf').value)||0,s1=(parseFloat($('fn-s1').value)||0)/100,s2=(parseFloat($('fn-s2').value)||0)/100,s3=(parseFloat($('fn-s3').value)||0)/100,aov=parseFloat($('fn-aov').value)||0;
        var p1=Math.floor(traf*s1),p2=Math.floor(p1*s2),buyers=Math.floor(p2*s3);
        var rev=buyers*aov,cvr=traf>0?(buyers/traf)*100:0;
        $('fn-rev').textContent=fmt(rev);$('fn-buyers').textContent=buyers.toLocaleString('en-US');$('fn-cvr').textContent=cvr.toFixed(2)+'%';
        var h='';if(s3<0.05)h='Leaky Checkout';else if(cvr>2)h='Hyper-Optimized';else h='Standard Yield';
        $('fn-health').textContent=h;
    }
    document.querySelectorAll('.fn-in').forEach(function(e){e.addEventListener('input',calc);});
    document.querySelectorAll('.fn-qa').forEach(function(b){b.addEventListener('click',function(){
        if(this.dataset.t!==undefined)$('fn-traf').value=this.dataset.t;
        if(this.dataset.s1!==undefined)$('fn-s1').value=this.dataset.s1;
        if(this.dataset.s2!==undefined)$('fn-s2').value=this.dataset.s2;
        if(this.dataset.s3!==undefined)$('fn-s3').value=this.dataset.s3;
        if(this.dataset.a!==undefined)$('fn-aov').value=this.dataset.a;
        calc();
    });});
    $('fn-reset').addEventListener('click',function(){$('fn-traf').value=50000;$('fn-aov').value=150;$('fn-s1').value=20;$('fn-s2').value=30;$('fn-s3').value=15;calc();});
    $('fn-copy').addEventListener('click',function(){
        var t='Funnel Optimization Report\n==========================\nRevenue Yield: '+$('fn-rev').textContent+'\nTotal Buyers: '+$('fn-buyers').textContent+'\nCumulative CVR: '+$('fn-cvr').textContent+'\nHealth: '+$('fn-health').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=$('fn-copy').innerHTML;$('fn-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){$('fn-copy').innerHTML=o;},2000);});
    });
    calc();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\funnel-optimization-tool.blade.php ENDPATH**/ ?>