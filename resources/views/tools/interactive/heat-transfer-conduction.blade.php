<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-3 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Material Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ht-mat" data-k="401">Copper (401)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ht-mat" data-k="205">Aluminum (205)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ht-mat" data-k="50">Steel (50)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ht-mat" data-k="1.1">Glass (1.1)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ht-mat" data-k="0.04">Fiberglass (0.04)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ht-mat" data-k="0.6">Water (0.6)</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Thermal Conductivity (k)</label>
                    <div class="input-group"><input type="number" id="ht-k" class="form-control form-control-lg" value="205" step="any" min="0"><span class="input-group-text">W/m·K</span></div>
                    <small class="text-muted d-block mt-1">Material's ability to conduct heat</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Temperature Difference (ΔT)</label>
                    <div class="input-group"><input type="number" id="ht-dt" class="form-control form-control-lg" value="100" step="any"><span class="input-group-text">°C / K</span></div>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Cross-Sectional Area (A)</label>
                    <div class="input-group"><input type="number" id="ht-a" class="form-control form-control-lg" value="1" step="any" min="0.001"><span class="input-group-text">m²</span></div>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Material Thickness (d)</label>
                    <div class="input-group"><input type="number" id="ht-d" class="form-control form-control-lg" value="0.05" step="any" min="0.001"><span class="input-group-text">m</span></div>
                </div>
            </div>
            <div class="mt-3 p-3 rounded-3" style="background:#fef2f2;border:1.5px solid #fecaca">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#ef4444"></i><strong>Fourier's Law:</strong> Q = k × A × ΔT / d — Heat transfers from the hot side to the cold side at a rate proportional to the temperature gradient and material conductivity.</p>
            </div>
        </div>
    </div>
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Conduction Analysis</h5><p class="text-muted small mb-0">Heat transfer rate, flux, and thermal resistance</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="ht-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#f0fdf4;border:2px solid #bbf7d0;min-width:260px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px">Heat Transfer Rate (Q)</span>
                    <div class="display-4 fw-bold" style="color:#059669" id="ht-q">0</div>
                    <span class="fw-bold text-muted">Watts</span>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Heat Flux (q″)</span><span class="stat-card-value" id="ht-flux">0 W/m²</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Thermal Resistance</span><span class="stat-card-value" id="ht-r">0 K/W</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Insulation Rating</span><span class="stat-card-value" id="ht-ins">Low</span></div></div>
                <div class="col-md-3 col-6"><div class="stat-card"><span class="stat-card-label">Conductivity (k)</span><span class="stat-card-value" id="ht-kout">205</span></div></div>
            </div>
        </div>
    </div>
</div>
<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var kE=document.getElementById('ht-k'),dtE=document.getElementById('ht-dt'),aE=document.getElementById('ht-a'),dE=document.getElementById('ht-d');
    function calc(){
        var k=parseFloat(kE.value)||0,A=parseFloat(aE.value)||0,d=parseFloat(dE.value)||0,dT=parseFloat(dtE.value)||0;
        if(d<=0)d=0.001;if(A<=0)A=0.001;
        var Q=(k*A*dT)/d,flux=A>0?Q/A:0,R=(k>0&&A>0)?d/(k*A):0;
        if(!isFinite(Q))Q=0;if(!isFinite(flux))flux=0;if(!isFinite(R))R=0;
        document.getElementById('ht-q').textContent=Q.toLocaleString(undefined,{maximumFractionDigits:2});
        document.getElementById('ht-flux').textContent=flux.toLocaleString(undefined,{maximumFractionDigits:2})+' W/m²';
        document.getElementById('ht-r').textContent=R.toFixed(6)+' K/W';
        document.getElementById('ht-kout').textContent=k;
        var ins='Low';if(k<0.1)ins='Excellent';else if(k<1)ins='Good';else if(k<10)ins='Moderate';
        document.getElementById('ht-ins').textContent=ins;
    }
    [kE,dtE,aE,dE].forEach(function(e){e.addEventListener('input',calc);});
    document.querySelectorAll('.ht-mat').forEach(function(b){b.addEventListener('click',function(){kE.value=this.dataset.k;calc();});});
    document.getElementById('ht-reset').addEventListener('click',function(){kE.value=205;dtE.value=100;aE.value=1;dE.value=0.05;calc();});
    document.getElementById('ht-copy').addEventListener('click',function(){
        var t='Heat Transfer (Conduction) Report\n================================\nQ = '+document.getElementById('ht-q').textContent+' W\nFlux = '+document.getElementById('ht-flux').textContent+'\nR = '+document.getElementById('ht-r').textContent+'\nInsulation: '+document.getElementById('ht-ins').textContent;
        navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('ht-copy').innerHTML;document.getElementById('ht-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('ht-copy').innerHTML=o;},2000);});
    });
    calc();
});
</script>
