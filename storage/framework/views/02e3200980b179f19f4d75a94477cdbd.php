<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-3 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Journey Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ce-qa" data-d="300" data-dy="3">Weekend Getaway</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ce-qa" data-d="2800" data-dy="7" data-s="150">Cross-Country</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ce-qa" data-d="6000" data-dy="240" data-h="0" data-f="15">Daily Commute (Annual)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ce-qa" data-mpg="90" data-g="0.15">EV Trip</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ce-qa" data-h="450" data-f="200">Luxury Trip</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Distance (Miles)</label>
                    <input type="number" id="ce-dist" class="form-control form-control-lg ce-in" value="300" min="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Trip Duration (Days)</label>
                    <input type="number" id="ce-days" class="form-control form-control-lg ce-in" value="3" min="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Vehicle MPG</label>
                    <input type="number" id="ce-mpg" class="form-control form-control-lg ce-in" value="25" min="1">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Gas Price ($/unit)</label>
                    <input type="number" id="ce-gas" class="form-control form-control-lg ce-in" value="3.50" step="0.1">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Hotel Per Night ($)</label>
                    <input type="number" id="ce-hotel" class="form-control form-control-lg ce-in" value="120" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Food Daily Budget ($)</label>
                    <input type="number" id="ce-food" class="form-control form-control-lg ce-in" value="60" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Tolls & Parking ($)</label>
                    <input type="number" id="ce-tolls" class="form-control form-control-lg ce-in" value="40" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Trip Cost Breakdown</h5><p class="text-muted small mb-0">Fuel, lodging, food, and miscellaneous expenses</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="ce-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#f0fdf4;border:2px solid #bbf7d0;min-width:260px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px">Total Estimated Cost</span>
                    <div class="display-4 fw-bold" style="color:#059669" id="ce-total">$0</div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Fuel</span><span class="stat-card-value" id="ce-fuel">$0</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Lodging</span><span class="stat-card-value" id="ce-lod">$0</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Food</span><span class="stat-card-value" id="ce-fd">$0</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Tolls/Parking</span><span class="stat-card-value" id="ce-tl">$0</span></div></div>
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
        var dist=parseFloat($('ce-dist').value)||0,days=parseFloat($('ce-days').value)||0,mpg=parseFloat($('ce-mpg').value)||1,gas=parseFloat($('ce-gas').value)||0;
        var hotel=parseFloat($('ce-hotel').value)||0,food=parseFloat($('ce-food').value)||0,tolls=parseFloat($('ce-tolls').value)||0;
        var fc=(dist/mpg)*gas,nights=Math.max(0,Math.ceil(days-1)),lc=nights*hotel,fdc=days*food,total=fc+lc+fdc+tolls;
        $('ce-total').textContent=fmt(total);$('ce-fuel').textContent=fmt(fc);$('ce-lod').textContent=fmt(lc);$('ce-fd').textContent=fmt(fdc);$('ce-tl').textContent=fmt(tolls);
    }
    document.querySelectorAll('.ce-in').forEach(function(e){e.addEventListener('input',calc);});
    document.querySelectorAll('.ce-qa').forEach(function(b){b.addEventListener('click',function(){
        if(this.dataset.d)$('ce-dist').value=this.dataset.d;
        if(this.dataset.dy)$('ce-days').value=this.dataset.dy;
        if(this.dataset.s)$('ce-tolls').value=this.dataset.s;
        if(this.dataset.mpg)$('ce-mpg').value=this.dataset.mpg;
        if(this.dataset.g)$('ce-gas').value=this.dataset.g;
        if(this.dataset.h!==undefined)$('ce-hotel').value=this.dataset.h;
        if(this.dataset.f!==undefined)$('ce-food').value=this.dataset.f;
        calc();
    });});
    $('ce-reset').addEventListener('click',function(){$('ce-dist').value=300;$('ce-days').value=3;$('ce-mpg').value=25;$('ce-gas').value=3.50;$('ce-hotel').value=120;$('ce-food').value=60;$('ce-tolls').value=40;calc();});
    $('ce-copy').addEventListener('click',function(){
        var t='Trip Cost Breakdown\n===================\nTotal: '+$('ce-total').textContent+'\nFuel: '+$('ce-fuel').textContent+'\nLodging: '+$('ce-lod').textContent+'\nFood: '+$('ce-fd').textContent+'\nTolls/Parking: '+$('ce-tl').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=$('ce-copy').innerHTML;$('ce-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){$('ce-copy').innerHTML=o;},2000);});
    });
    calc();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\car-expense-calculator.blade.php ENDPATH**/ ?>