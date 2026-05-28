@include('tools.partials.medical-disclaimer')

<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-3 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Quick Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ped-preset" data-med="acetaminophen" data-mg="160" data-ml="5">Tylenol 160/5</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ped-preset" data-med="ibuprofen" data-mg="100" data-ml="5">Advil 100/5</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 ped-preset" data-med="ibuprofen" data-mg="50" data-ml="1.25">Infant Advil 50/1.25</button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Child's Weight</label>
                    <div class="input-group"><input type="number" step="0.1" id="ped-weight" class="form-control form-control-lg" placeholder="15" value="15" min="0.1"><select id="ped-wunit" class="form-select" style="max-width:80px"><option value="kg">kg</option><option value="lbs">lbs</option></select></div>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Medication</label>
                    <select id="ped-med" class="form-select form-select-lg rounded-3">
                        <optgroup label="Pain & Fever"><option value="acetaminophen" selected>Acetaminophen (Tylenol)</option><option value="ibuprofen">Ibuprofen (Advil)</option></optgroup>
                        <optgroup label="Antibiotics"><option value="amoxicillin">Amoxicillin (40mg/kg/d)</option><option value="cephalexin">Cephalexin (25mg/kg/d)</option></optgroup>
                        <option value="custom">Custom (mg/kg)</option>
                    </select>
                </div>
                <div class="col-md-4 d-none" id="ped-cust-row">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Custom Dose</label>
                    <div class="input-group"><input type="number" step="0.1" id="ped-cust" class="form-control form-control-lg" value="10" min="0.1"><span class="input-group-text">mg/kg</span></div>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Concentration</label>
                    <div class="input-group"><input type="number" id="ped-cmg" class="form-control form-control-lg" value="160" min="0.1" step="any"><span class="input-group-text">mg per</span><input type="number" id="ped-cml" class="form-control form-control-lg" value="5" min="0.1" step="any"><span class="input-group-text">mL</span></div>
                    <small class="text-muted d-block mt-1">Match the label on the bottle</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-0 fw-bold text-dark">Dosage Result</h5><p class="text-muted small mb-0">Calculated volume and clinical details</p></div>
                </div>
                <div class="header-actions d-flex gap-2"><button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="ped-copy"><i class="fas fa-copy me-1"></i> Copy</button></div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="p-4 rounded-4 d-inline-block" style="background:#f0fdf4;border:2px solid #bbf7d0;min-width:220px">
                    <span class="d-block small fw-bold text-uppercase text-muted mb-1" style="letter-spacing:1px">Dose Volume</span>
                    <div class="display-4 fw-bold" style="color:#059669" id="ped-vol">--</div>
                    <span class="fw-bold text-muted">mL</span>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Total Dose</span><span class="stat-card-value" id="ped-mg">--</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Frequency</span><span class="stat-card-value" id="ped-freq">--</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Daily Limit</span><span class="stat-card-value" id="ped-lim">--</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Weight</span><span class="stat-card-value" id="ped-wt">--</span></div></div>
            </div>
            <div class="p-3 rounded-3 bg-light border">
                <h6 class="fw-bold mb-2"><i class="fas fa-notes-medical me-2" style="color:#ec4899"></i>Clinical Note</h6>
                <p id="ped-note" class="small text-secondary mb-0">Enter values above for automatic calculation.</p>
            </div>
        </div>
    </div>
</div>

<style>.tool-card-stacked{border-radius:16px;background:#fff}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}</style>

<script>
document.addEventListener('DOMContentLoaded',function(){
    var w=document.getElementById('ped-weight'),wu=document.getElementById('ped-wunit'),med=document.getElementById('ped-med'),cd=document.getElementById('ped-cust'),cmg=document.getElementById('ped-cmg'),cml=document.getElementById('ped-cml'),cr=document.getElementById('ped-cust-row');
    function calc(){
        var wt=parseFloat(w.value)||0,mg=parseFloat(cmg.value)||0,ml=parseFloat(cml.value)||0;
        if(wt<=0||mg<=0||ml<=0){document.getElementById('ped-vol').textContent='--';document.getElementById('ped-mg').textContent='--';document.getElementById('ped-freq').textContent='--';document.getElementById('ped-lim').textContent='--';document.getElementById('ped-wt').textContent='--';return;}
        var kg=wu.value==='lbs'?wt*0.453592:wt,mpk=0,fr='',lm='',nt='';
        if(med.value==='acetaminophen'){mpk=15;fr='Q 4-6 hrs';lm='5 doses/24h';nt='Standard antipyretic. Ensure no other acetaminophen products given simultaneously.';}
        else if(med.value==='ibuprofen'){mpk=10;fr='Q 6-8 hrs';lm='4 doses/24h';nt='Anti-inflammatory. Administer with food. Not for children under 6 months.';}
        else if(med.value==='amoxicillin'){mpk=40;fr='Q 8-12 hrs';lm='Daily total';nt='Total daily dose shown. Divide into 2-3 doses as directed.';}
        else if(med.value==='cephalexin'){mpk=25;fr='Q 6-12 hrs';lm='Daily total';nt='Total daily dose. Divide as prescribed.';}
        else{mpk=parseFloat(cd.value)||0;fr='As Rx';lm='As Rx';nt='Custom dose. Verify with provider.';}
        var tm=kg*mpk,tv=(tm/mg)*ml;
        if(!isFinite(tv)||tv<0)tv=0;if(!isFinite(tm)||tm<0)tm=0;
        document.getElementById('ped-vol').textContent=tv.toFixed(1);
        document.getElementById('ped-mg').textContent=Math.round(tm)+(med.value==='amoxicillin'||med.value==='cephalexin'?' mg/day':' mg/dose');
        document.getElementById('ped-freq').textContent=fr;document.getElementById('ped-lim').textContent=lm;
        document.getElementById('ped-wt').textContent=kg.toFixed(1)+' kg';document.getElementById('ped-note').textContent=nt;
    }
    med.addEventListener('change',function(){cr.classList.toggle('d-none',this.value!=='custom');calc();});
    [w,wu,cmg,cml,cd].forEach(function(e){e.addEventListener('input',calc);});
    wu.addEventListener('change',calc);
    document.querySelectorAll('.ped-preset').forEach(function(b){b.addEventListener('click',function(){med.value=this.dataset.med;cmg.value=this.dataset.mg;cml.value=this.dataset.ml;cr.classList.add('d-none');calc();});});
    document.getElementById('ped-reset').addEventListener('click',function(){w.value=15;wu.value='kg';med.value='acetaminophen';cmg.value=160;cml.value=5;cd.value=10;cr.classList.add('d-none');calc();});
    document.getElementById('ped-copy').addEventListener('click',function(){var t='Pediatric Dose Report\n========================\nVolume: '+document.getElementById('ped-vol').textContent+' mL\nDose: '+document.getElementById('ped-mg').textContent+'\nFrequency: '+document.getElementById('ped-freq').textContent+'\nLimit: '+document.getElementById('ped-lim').textContent+'\nWeight: '+document.getElementById('ped-wt').textContent+'\n\nVerify with healthcare provider.';navigator.clipboard.writeText(t).then(function(){var o=document.getElementById('ped-copy').innerHTML;document.getElementById('ped-copy').innerHTML='<i class="fas fa-check me-1"></i> Copied!';setTimeout(function(){document.getElementById('ped-copy').innerHTML=o;},2000);});});
    calc();
});
</script>