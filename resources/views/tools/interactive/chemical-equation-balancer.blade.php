<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            {{-- Quick Action Buttons --}}
            <div class="p-3 rounded-4 mb-4" style="background-color:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-bolt text-warning me-2"></i>Quick Examples</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-eq" data-eq="H2 + O2 = H2O">H₂ + O₂ → H₂O</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-eq" data-eq="Fe + O2 = Fe2O3">Fe + O₂ → Fe₂O₃</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-eq" data-eq="CH4 + O2 = CO2 + H2O">CH₄ + O₂ → CO₂ + H₂O</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-eq" data-eq="C3H8 + O2 = CO2 + H2O">C₃H₈ + O₂ → CO₂ + H₂O</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-eq" data-eq="Na + H2O = NaOH + H2">Na + H₂O → NaOH + H₂</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12">
                    <div class="p-4 rounded-4" style="background:#fff;border:1.5px solid #f1f5f9">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Equation Input</h6>
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Chemical Equation</label>
                        <input type="text" id="eq-input" class="form-control form-control-lg rounded-3" placeholder="e.g. H2 + O2 = H2O" value="H2 + O2 = H2O">
                        <div class="form-text text-muted mt-2">Use = or → to separate reactants and products. Separate compounds with +</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Conditions (Optional)</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Temperature</label>
                                <div class="input-group">
                                    <input type="number" id="eq-temp" class="form-control form-control-lg rounded-start-3" value="25">
                                    <select id="eq-temp-unit" class="form-select form-select-lg rounded-end-3" style="max-width:80px">
                                        <option value="C">°C</option>
                                        <option value="K">K</option>
                                        <option value="F">°F</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Pressure</label>
                                <div class="input-group">
                                    <input type="number" id="eq-press" class="form-control form-control-lg rounded-start-3" value="1" step="0.01">
                                    <select id="eq-press-unit" class="form-select form-select-lg rounded-end-3" style="max-width:85px">
                                        <option value="atm">atm</option>
                                        <option value="Pa">Pa</option>
                                        <option value="mmHg">mmHg</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Options</h6>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="eq-stepbystep" checked>
                            <label class="form-check-label small fw-bold text-secondary" for="eq-stepbystep">Show Step-by-Step</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calculate" style="min-width:280px;max-width:100%">
                    <i class="fas fa-scale-balanced me-2"></i> Balance Equation
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>

            <div class="mt-4 p-3 rounded-4 border" style="background:#f8fafc">
                <p class="mb-0 small text-muted"><i class="fas fa-info-circle text-primary me-2"></i><strong>Formula:</strong> Balancing uses the <strong>Law of Conservation of Mass</strong> — atoms of each element are equal on both sides of the equation.</p>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Balanced Equation</h5>
                        <p class="text-muted small mb-0">Result with coefficient breakdown</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width:140px;max-width:100%">
                        <i class="fas fa-copy me-1"></i> Copy Result
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="p-4 rounded-4 bg-light border text-center mb-4">
                <div class="small fw-bold text-uppercase text-muted mb-2">Balanced Equation</div>
                <div class="h4 fw-bold text-dark mb-0" id="out-balanced" style="word-break:break-word;overflow-wrap:break-word"></div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Reactant Compounds</div>
                        <div class="h5 fw-bold mb-0 text-primary" id="out-reactants">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Product Compounds</div>
                        <div class="h5 fw-bold mb-0 text-success" id="out-products">0</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Elements Involved</div>
                        <div class="h5 fw-bold mb-0 text-warning" id="out-elements">0</div>
                    </div>
                </div>
            </div>

            <div id="out-steps" class="p-4 rounded-4 bg-light border shadow-sm mb-4" style="display:none">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-list-ol text-primary me-2"></i>Step-by-Step Breakdown
                </h6>
                <div id="out-steps-content" class="small text-secondary"></div>
            </div>

            <div class="p-4 rounded-4 bg-light border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-lightbulb text-warning me-2"></i>Analysis
                </h6>
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
.letter-spacing-1{letter-spacing:1px}.x-small{font-size:.75rem}
.card-body-v2{overflow-x:auto}
</style>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const eqInput=document.getElementById('eq-input'),
          resultCard=document.getElementById('result-card'),
          outBalanced=document.getElementById('out-balanced'),
          outReactants=document.getElementById('out-reactants'),
          outProducts=document.getElementById('out-products'),
          outElements=document.getElementById('out-elements'),
          outSteps=document.getElementById('out-steps'),
          outStepsContent=document.getElementById('out-steps-content'),
          outInsights=document.getElementById('out-insights'),
          btnCalc=document.getElementById('btn-calculate'),
          stepToggle=document.getElementById('eq-stepbystep');

    function parseFormula(f){
        const elems={};
        const re=/([A-Z][a-z]?)(\d*)/g;
        let m;
        while((m=re.exec(f))!==null){
            if(m[1]){
                const el=m[1],cnt=parseInt(m[2]||'1');
                elems[el]=(elems[el]||0)+cnt;
            }
        }
        return elems;
    }

    function parseCompound(c){
        c=c.trim();
        // Handle parentheses like Ca(OH)2
        let expanded='';
        let i=0;
        while(i<c.length){
            if(c[i]==='('){
                let j=c.indexOf(')',i);
                if(j===-1) j=c.length;
                let inner=c.substring(i+1,j);
                let k=j+1;
                let numStr='';
                while(k<c.length&&/\d/.test(c[k])){numStr+=c[k];k++;}
                let mult=parseInt(numStr||'1');
                let parsed=parseFormula(inner);
                for(let el in parsed){
                    let sym=el+String(parsed[el]*mult);
                    expanded+=sym;
                }
                i=k;
            } else {
                expanded+=c[i];
                i++;
            }
        }
        return parseFormula(expanded);
    }

    function balanceEquation(eq){
        eq=eq.replace(/→/g,'=').replace(/—>/g,'=').replace(/->/g,'=');
        const sides=eq.split('=');
        if(sides.length!==2) return null;

        const reactantStrs=sides[0].split('+').map(s=>s.trim()).filter(Boolean);
        const productStrs=sides[1].split('+').map(s=>s.trim()).filter(Boolean);
        const allCompounds=[...reactantStrs,...productStrs];
        const n=allCompounds.length;

        // Parse each compound
        const parsed=allCompounds.map(c=>parseCompound(c));
        const elementSet=new Set();
        parsed.forEach(p=>{for(let e in p) elementSet.add(e)});
        const elements=[...elementSet];

        // Build matrix
        const m=elements.length;
        const matrix=[];
        for(let i=0;i<m;i++){
            const row=[];
            for(let j=0;j<n;j++){
                let val=parsed[j][elements[i]]||0;
                if(j>=reactantStrs.length) val=-val;
                row.push(val);
            }
            matrix.push(row);
        }

        // Try coefficients 1-20 brute force for small systems
        function tryBalance(maxCoeff){
            const nR=reactantStrs.length,nP=productStrs.length;
            function check(coeffs){
                for(let el of elements){
                    let left=0,right=0;
                    for(let i=0;i<nR;i++) left+=coeffs[i]*(parsed[i][el]||0);
                    for(let i=0;i<nP;i++) right+=coeffs[nR+i]*(parsed[nR+i][el]||0);
                    if(left!==right) return false;
                }
                return true;
            }
            function enumerate(idx,current){
                if(idx===n){
                    if(check(current)) return [...current];
                    return null;
                }
                for(let c=1;c<=maxCoeff;c++){
                    current[idx]=c;
                    const res=enumerate(idx+1,current);
                    if(res) return res;
                }
                return null;
            }
            return enumerate(0,new Array(n).fill(1));
        }

        const coeffs=tryBalance(n<=4?15:10);
        if(!coeffs) return null;

        const nR=reactantStrs.length;
        const balanced=[];
        const reactantParts=[],productParts=[];
        for(let i=0;i<nR;i++){
            const part=(coeffs[i]>1?coeffs[i]:'')+reactantStrs[i];
            reactantParts.push(part);
        }
        for(let i=0;i<productStrs.length;i++){
            const part=(coeffs[nR+i]>1?coeffs[nR+i]:'')+productStrs[i];
            productParts.push(part);
        }

        return {
            balanced: reactantParts.join(' + ')+' → '+productParts.join(' + '),
            coefficients: coeffs,
            reactants: reactantStrs,
            products: productStrs,
            elements: elements,
            parsed: parsed
        };
    }

    function calculate(){
        const eq=eqInput.value.trim();
        if(!eq){return;}

        btnCalc.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Balancing...';
        btnCalc.disabled=true;

        setTimeout(()=>{
            const result=balanceEquation(eq);
            if(!result){
                outBalanced.textContent='⚠ Could not balance — check your equation format';
                outBalanced.classList.add('text-danger');
                outReactants.textContent='—';
                outProducts.textContent='—';
                outElements.textContent='—';
                outSteps.style.display='none';
                outInsights.innerHTML='<p class="text-danger">Make sure you use valid chemical formulas separated by + signs, with = between reactants and products.</p>';
            } else {
                outBalanced.textContent=result.balanced;
                outBalanced.classList.remove('text-danger');
                outReactants.textContent=result.reactants.length;
                outProducts.textContent=result.products.length;
                outElements.textContent=result.elements.length;

                if(stepToggle.checked){
                    outSteps.style.display='block';
                    let steps='<ol class="mb-0">';
                    steps+='<li class="mb-2">Identified <strong>'+result.elements.length+'</strong> unique elements: '+result.elements.join(', ')+'</li>';
                    steps+='<li class="mb-2">Parsed <strong>'+result.reactants.length+'</strong> reactant(s) and <strong>'+result.products.length+'</strong> product(s)</li>';
                    steps+='<li class="mb-2">Solved coefficient matrix to satisfy conservation of mass</li>';
                    steps+='<li class="mb-2">Applied smallest whole-number coefficients: ['+result.coefficients.join(', ')+']</li>';
                    steps+='<li class="mb-2">Verified: atoms on both sides are equal ✓</li>';
                    steps+='</ol>';
                    outStepsContent.innerHTML=steps;
                } else {
                    outSteps.style.display='none';
                }

                const ins=[];
                ins.push('Balanced using the <strong>Law of Conservation of Mass</strong>: matter cannot be created or destroyed.');
                ins.push('Coefficients: ['+result.coefficients.join(', ')+'] represent the mole ratios of the reaction.');
                if(result.elements.includes('O')&&result.elements.includes('C')) ins.push('This appears to be a <strong>combustion reaction</strong> (contains C and O).');
                outInsights.innerHTML='<ul class="list-unstyled mb-0">'+ins.map(i=>'<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>'+i+'</span></li>').join('')+'</ul>';
            }

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({behavior:'smooth'});
            btnCalc.innerHTML='<i class="fas fa-scale-balanced me-2"></i> Balance Equation';
            btnCalc.disabled=false;
        },400);
    }

    btnCalc.addEventListener('click',calculate);

    document.querySelectorAll('.quick-eq').forEach(btn=>{
        btn.addEventListener('click',()=>{
            eqInput.value=btn.dataset.eq;
            calculate();
        });
    });

    document.getElementById('btn-reset').addEventListener('click',()=>{
        eqInput.value='H2 + O2 = H2O';
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click',function(){
        const text='Balanced Equation: '+outBalanced.textContent+'\nGenerated by ToolsHub';
        navigator.clipboard.writeText(text).then(()=>{
            const btn=this,orig=btn.innerHTML;
            btn.innerHTML='<i class="fas fa-check me-1"></i> Copied!';
            btn.classList.replace('btn-success','btn-dark');
            setTimeout(()=>{btn.innerHTML=orig;btn.classList.replace('btn-dark','btn-success');},2000);
        });
    });
});
</script>
