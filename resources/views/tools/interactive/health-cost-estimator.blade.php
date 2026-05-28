<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-3 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Medical Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 hc-qa" data-g="300" data-cp="50">Healthy Year</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 hc-qa" data-g="55000">Surgery Year ($50k)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 hc-qa" data-g="15000" data-cp="500">Chronic Condition</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 hc-qa" data-d="3500" data-c="30" data-o="7000">HDHP Math</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 hc-qa" data-d="500" data-c="10" data-o="3000">Gold PPO Plan</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 hc-qa" data-g="0" data-cp="0">Preventative Only</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Gross Billed by Docs ($)</label>
                    <input type="number" id="hc-gross" class="form-control form-control-lg hc-in text-danger fw-bold" value="2500" min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Annual Deductible ($)</label>
                    <input type="number" id="hc-ded" class="form-control form-control-lg hc-in" value="1500" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Patient Co-Ins (%)</label>
                    <input type="number" id="hc-coin" class="form-control form-control-lg hc-in" value="20" min="0" max="100">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Sum of Co-pays ($)</label>
                    <input type="number" id="hc-cop" class="form-control form-control-lg hc-in" value="100" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-dark text-uppercase mb-2">Out of Pocket Max ($)</label>
                    <input type="number" id="hc-oopm" class="form-control form-control-lg hc-in fw-bold" value="6500" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Estimated Costs</h5><p class="text-muted small mb-0">What you pay vs what insurance pays</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="hc-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#f0fdf4;border:2px solid #bbf7d0;min-width:260px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px">You Will Pay (OOP)</span>
                    <div class="display-4 fw-bold" style="color:#059669" id="hc-oop">$0</div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Insurance Pays</span><span class="stat-card-value text-primary" id="hc-ins">$0</span></div></div>
                <div class="col-md-6"><div class="stat-card"><span class="stat-card-label">Effective Rate Paid</span><span class="stat-card-value" id="hc-rate">0%</span></div></div>
            </div>
            <div class="p-3 rounded-3 bg-light border text-center">
                <h6 class="fw-bold mb-1" id="hc-status-title">Status</h6>
                <p id="hc-status-msg" class="small text-secondary mb-0 fw-bold">Enter values above to see status.</p>
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
        var gross=parseFloat($('hc-gross').value)||0,ded=parseFloat($('hc-ded').value)||0,coin=(parseFloat($('hc-coin').value)||0)/100,cop=parseFloat($('hc-cop').value)||0,oopm=parseFloat($('hc-oopm').value)||0;
        var cp=0;
        var ad=Math.min(gross,ded);cp+=ad;
        var rem=Math.max(0,gross-ad);cp+=rem*coin;
        cp+=cop;
        if(cp>oopm)cp=oopm;
        // Fix insurance calculation: ins pays the billed amount MINUS the patient's share of that billed amount.
        // Patient's share of the billed amount is (cp - copays) because copays are flat fees on top of the contracted rate for visits, usually not applied to the gross billed sum directly in this simplified model, but here we assume gross covers all.
        // The insurance company doesn't pay the patient's copay.
        var insPays=Math.max(0,gross-(cp-cop));
        if(gross===0){insPays=0;cp=0;}
        
        $('hc-oop').textContent=fmt(cp);$('hc-ins').textContent=fmt(insPays);
        $('hc-rate').textContent=gross>0?((cp/gross)*100).toFixed(1)+'%':'0%';
        
        var stT=$('hc-status-title'),stM=$('hc-status-msg');
        if(cp>=oopm){stT.textContent='MAX PROTECTED';stT.className='fw-bold mb-1 text-danger';stM.textContent='You hit your Out of Pocket Max. Insurance covers 100% of remaining covered costs.';}
        else if(gross>ded){stT.textContent='CO-INSURANCE TIER';stT.className='fw-bold mb-1 text-warning';stM.textContent='You passed your deductible. You split costs via Co-Insurance.';}
        else{stT.textContent='DEDUCTIBLE PHASE';stT.className='fw-bold mb-1 text-primary';stM.textContent='You are paying 100% of the negotiated rate towards your deductible.';}
    }
    document.querySelectorAll('.hc-in').forEach(function(e){e.addEventListener('input',calc);});
    document.querySelectorAll('.hc-qa').forEach(function(b){b.addEventListener('click',function(){
        if(this.dataset.g!==undefined)$('hc-gross').value=this.dataset.g;
        if(this.dataset.cp!==undefined)$('hc-cop').value=this.dataset.cp;
        if(this.dataset.d!==undefined)$('hc-ded').value=this.dataset.d;
        if(this.dataset.c!==undefined)$('hc-coin').value=this.dataset.c;
        if(this.dataset.o!==undefined)$('hc-oopm').value=this.dataset.o;
        calc();
    });});
    $('hc-reset').addEventListener('click',function(){$('hc-gross').value=2500;$('hc-ded').value=1500;$('hc-coin').value=20;$('hc-cop').value=100;$('hc-oopm').value=6500;calc();});
    $('hc-copy').addEventListener('click',function(){
        var t='Health Insurance Estimate\n=========================\nGross Billed: '+$('hc-gross').value+'\nYou Pay (OOP): '+$('hc-oop').textContent+'\nInsurance Pays: '+$('hc-ins').textContent+'\nStatus: '+$('hc-status-title').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=$('hc-copy').innerHTML;$('hc-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){$('hc-copy').innerHTML=o;},2000);});
    });
    calc();
});
</script>
