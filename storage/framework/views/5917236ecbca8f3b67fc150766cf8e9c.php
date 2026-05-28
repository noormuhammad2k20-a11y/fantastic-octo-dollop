<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-3 rounded-4 mb-4" style="background-color:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-flask text-primary me-2"></i>Quick Compounds</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-formula" data-f="H2O">H₂O</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-formula" data-f="NaCl">NaCl</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-formula" data-f="C6H12O6">C₆H₁₂O₆</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-formula" data-f="H2SO4">H₂SO₄</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-formula" data-f="Ca(OH)2">Ca(OH)₂</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-formula" data-f="C2H5OH">C₂H₅OH</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12">
                    <div class="p-4 rounded-4" style="background:#fff;border:1.5px solid #f1f5f9">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Chemical Formula</label>
                        <input type="text" id="mm-formula" class="form-control form-control-lg rounded-3" placeholder="e.g. C6H12O6, Ca(OH)2" value="H2O">
                        <div class="form-text text-muted mt-2">Enter any valid molecular formula. Supports parentheses like Ca(OH)2</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calculate" style="min-width:280px;max-width:100%">
                    <i class="fas fa-calculator me-2"></i> Calculate Molar Mass
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
            <div class="mt-4 p-3 rounded-4 border" style="background:#f8fafc">
                <p class="mb-0 small text-muted"><i class="fas fa-info-circle text-primary me-2"></i><strong>Formula:</strong> M = Σ(nᵢ × Aᵢ) where nᵢ = atom count, Aᵢ = atomic weight (g/mol)</p>
            </div>
        </div>
    </div>

    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft"><i class="fas fa-check-circle text-success"></i></div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Molar Mass Result</h5>
                        <p class="text-muted small mb-0">Detailed elemental composition breakdown</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width:140px;max-width:100%"><i class="fas fa-copy me-1"></i> Copy</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-4 fw-bold text-dark mb-0" id="out-mass">0.000</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">g/mol</p>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Parsed Formula</div>
                                <div class="h5 fw-bold mb-0 text-primary" id="out-parsed" style="word-break:break-word">—</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Total Atoms</div>
                                <div class="h5 fw-bold mb-0 text-info" id="out-atoms">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 rounded-4 bg-light border shadow-sm mb-4">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1"><i class="fas fa-chart-pie text-primary me-2"></i>Elemental Composition</h6>
                <div id="out-composition" class="small text-secondary"></div>
            </div>
            <div class="p-4 rounded-4 bg-light border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1"><i class="fas fa-lightbulb text-warning me-2"></i>Insights</h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>
<style>
:root{--primary-color:#4f46e5;--primary-soft:#eef2ff;--success-soft:#ecfdf5;--danger-soft:#fef2f2;--border-color:#e2e8f0}
.bg-primary-soft{background-color:var(--primary-soft)}.bg-success-soft{background-color:var(--success-soft)}.bg-danger-soft{background-color:var(--danger-soft)}
.tool-card-stacked{border-radius:24px;background:#fff;word-break:break-word;overflow-wrap:break-word}
.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}
.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}
.form-control-lg,.form-select-lg{border:1.5px solid var(--border-color);border-radius:12px;font-size:1.05rem;padding:.75rem 1rem}
.form-control:focus,.form-select:focus{border-color:var(--primary-color);box-shadow:0 0 0 4px rgba(79,70,229,.1);outline:none}
.letter-spacing-1{letter-spacing:1px}.x-small{font-size:.75rem}.card-body-v2{overflow-x:auto}
</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const AW={H:1.008,He:4.0026,Li:6.941,Be:9.0122,B:10.81,C:12.011,N:14.007,O:15.999,F:18.998,Ne:20.180,Na:22.990,Mg:24.305,Al:26.982,Si:28.086,P:30.974,S:32.06,Cl:35.45,Ar:39.948,K:39.098,Ca:40.078,Sc:44.956,Ti:47.867,V:50.942,Cr:51.996,Mn:54.938,Fe:55.845,Co:58.933,Ni:58.693,Cu:63.546,Zn:65.38,Ga:69.723,Ge:72.630,As:74.922,Se:78.971,Br:79.904,Kr:83.798,Rb:85.468,Sr:87.62,Y:88.906,Zr:91.224,Nb:92.906,Mo:95.95,Ru:101.07,Rh:102.91,Pd:106.42,Ag:107.87,Cd:112.41,In:114.82,Sn:118.71,Sb:121.76,Te:127.60,I:126.90,Xe:131.29,Cs:132.91,Ba:137.33,La:138.91,Ce:140.12,Pr:140.91,Nd:144.24,Sm:150.36,Eu:151.96,Gd:157.25,Tb:158.93,Dy:162.50,Ho:164.93,Er:167.26,Tm:168.93,Yb:173.05,Lu:174.97,Hf:178.49,Ta:180.95,W:183.84,Re:186.21,Os:190.23,Ir:192.22,Pt:195.08,Au:196.97,Hg:200.59,Tl:204.38,Pb:207.2,Bi:208.98,Th:232.04,U:238.03};

    function parseFormula(f){
        const stack=[{}];
        let i=0;
        while(i<f.length){
            if(f[i]==='('){stack.push({});i++;}
            else if(f[i]===')'){
                i++;let numStr='';
                while(i<f.length&&/\d/.test(f[i])){numStr+=f[i];i++;}
                const mult=parseInt(numStr||'1');
                const top=stack.pop();
                const cur=stack[stack.length-1];
                for(let el in top) cur[el]=(cur[el]||0)+top[el]*mult;
            } else if(/[A-Z]/.test(f[i])){
                let el=f[i];i++;
                while(i<f.length&&/[a-z]/.test(f[i])){el+=f[i];i++;}
                let numStr='';
                while(i<f.length&&/\d/.test(f[i])){numStr+=f[i];i++;}
                const cnt=parseInt(numStr||'1');
                const cur=stack[stack.length-1];
                cur[el]=(cur[el]||0)+cnt;
            } else {i++;}
        }
        return stack[0];
    }

    function calculate(){
        const f=document.getElementById('mm-formula').value.trim();
        if(!f) return;
        const btn=document.getElementById('btn-calculate');
        btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Calculating...';btn.disabled=true;
        setTimeout(()=>{
            const elems=parseFormula(f);
            let totalMass=0,totalAtoms=0,valid=true;
            const breakdown=[];
            for(let el in elems){
                if(!AW[el]){valid=false;break;}
                const mass=elems[el]*AW[el];
                totalMass+=mass;totalAtoms+=elems[el];
                breakdown.push({element:el,count:elems[el],atomicWeight:AW[el],mass:mass});
            }
            if(!valid||Object.keys(elems).length===0){
                document.getElementById('out-mass').textContent='Error';
                document.getElementById('out-parsed').textContent='Invalid';
                document.getElementById('out-atoms').textContent='—';
                document.getElementById('out-composition').innerHTML='<p class="text-danger">Unknown element detected. Check your formula.</p>';
                document.getElementById('out-insights').innerHTML='';
            } else {
                document.getElementById('out-mass').textContent=totalMass.toFixed(4);
                document.getElementById('out-parsed').textContent=f;
                document.getElementById('out-atoms').textContent=totalAtoms;
                let compHTML='<table class="table table-sm mb-0"><thead><tr><th>Element</th><th>Count</th><th>Atomic Wt</th><th>Subtotal</th><th>%</th></tr></thead><tbody>';
                breakdown.forEach(b=>{
                    compHTML+='<tr><td><strong>'+b.element+'</strong></td><td>'+b.count+'</td><td>'+b.atomicWeight.toFixed(4)+'</td><td>'+b.mass.toFixed(4)+'</td><td>'+(b.mass/totalMass*100).toFixed(2)+'%</td></tr>';
                });
                compHTML+='</tbody></table>';
                document.getElementById('out-composition').innerHTML=compHTML;
                const ins=[];
                ins.push('Total molar mass: <strong>'+totalMass.toFixed(4)+' g/mol</strong>');
                ins.push('Contains <strong>'+Object.keys(elems).length+'</strong> unique element(s) and <strong>'+totalAtoms+'</strong> total atom(s)');
                if(totalMass<100) ins.push('This is a relatively <strong>light molecule</strong>.');
                else if(totalMass>500) ins.push('This is a <strong>heavy molecule</strong>, typical of biological macromolecules.');
                document.getElementById('out-insights').innerHTML='<ul class="list-unstyled mb-0">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
            }
            document.getElementById('result-card').classList.remove('d-none');
            document.getElementById('result-card').scrollIntoView({behavior:'smooth'});
            btn.innerHTML='<i class="fas fa-calculator me-2"></i> Calculate Molar Mass';btn.disabled=false;
        },400);
    }

    document.getElementById('btn-calculate').addEventListener('click',calculate);
    document.querySelectorAll('.quick-formula').forEach(b=>b.addEventListener('click',()=>{document.getElementById('mm-formula').value=b.dataset.f;calculate();}));
    document.getElementById('btn-reset').addEventListener('click',()=>{document.getElementById('mm-formula').value='H2O';document.getElementById('result-card').classList.add('d-none');});
    document.getElementById('btn-copy').addEventListener('click',function(){
        const t='Molar Mass: '+document.getElementById('out-mass').textContent+' g/mol\nFormula: '+document.getElementById('mm-formula').value+'\n— ToolsHub';
        navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-1"></i> Copied!';this.classList.replace('btn-success','btn-dark');setTimeout(()=>{this.innerHTML=o;this.classList.replace('btn-dark','btn-success');},2000);});
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\molar-mass-calculator.blade.php ENDPATH**/ ?>