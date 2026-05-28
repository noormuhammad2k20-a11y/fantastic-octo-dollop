@include('tools.partials.medical-disclaimer')

<div class="row g-4 crcl-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Gender</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="crcl-gender" id="crcl-m" value="male" checked>
                            <label class="btn btn-outline-info py-3 rounded-start-4" for="crcl-m"><i class="fas fa-mars me-2"></i>Male</label>
                            <input type="radio" class="btn-check" name="crcl-gender" id="crcl-f" value="female">
                            <label class="btn btn-outline-info py-3 rounded-end-4" for="crcl-f"><i class="fas fa-venus me-2"></i>Female</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Age</label>
                        <input type="number" id="crcl-age" class="form-control form-control-lg rounded-3" value="45">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Weight</label>
                        <div class="input-group">
                            <input type="number" id="crcl-weight" class="form-control form-control-lg rounded-start-3" value="70">
                            <select id="crcl-w-unit" class="form-select form-select-lg rounded-end-3" style="max-width:100px">
                                <option value="kg" selected>kg</option>
                                <option value="lb">lb</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Serum Creatinine</label>
                        <div class="input-group">
                            <input type="number" id="crcl-scr" class="form-control form-control-lg rounded-start-3" value="1.0" step="0.1">
                            <span class="input-group-text bg-light fw-bold text-muted">mg/dL</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Clinical Scenarios:</span>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 crcl-quick" data-age="65" data-w="75" data-scr="1.8">Moderate CKD</button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 crcl-quick" data-age="25" data-w="70" data-scr="0.9">Healthy Profile</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="crcl-output-card" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Estimated CrCl</span>
                <div class="output-hero-value" id="out-crcl-val" style="font-size:3.5rem">97.2</div>
                <span class="output-hero-unit">mL/min</span>
            </div>

            <div class="position-relative mt-4 mb-1 px-4">
                <div class="progress rounded-pill" style="height:12px;background:#e2e8f0">
                    <div id="crcl-bar" class="progress-bar rounded-pill" style="width:65%;background:#10b981;transition:all .5s"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-4 mb-4"><span>Severe (<30)</span><span>Moderate</span><span>Normal (>90)</span></div>

            <div class="stats-grid mt-4">
                <div class="row g-3 text-center">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <span class="stat-card-label">Renal Impairment</span>
                            <span class="stat-card-value" id="out-crcl-imp">None</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <span class="stat-card-label">Dosing Grade</span>
                            <span class="stat-card-value text-info" id="out-crcl-dose">Standard</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-info shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-info"></i>Clinical Insight</h6>
                <div id="crcl-advice" class="small text-secondary"></div>
                <div class="mt-3 p-3 rounded-3 bg-light small border">
                    <i class="fas fa-circle-exclamation text-warning me-2"></i><strong>Note:</strong> The Cockcroft-Gault formula is primarily used for drug dosing adjustments and may over-predict clearance in obese patients.
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="crcl-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Clinical Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const ageEl=$('crcl-age'), wEl=$('crcl-weight'), wuEl=$('crcl-w-unit'), scrEl=$('crcl-scr');
    const genEls=document.getElementsByName('crcl-gender');

    function calculate(){
        const age = parseFloat(ageEl.value)||0;
        let weight = parseFloat(wEl.value)||0;
        const scr = parseFloat(scrEl.value)||0;
        const gender = document.querySelector('input[name="crcl-gender"]:checked').value;

        if(age<=0 || weight<=0 || scr<=0) return;
        if(wuEl.value === 'lb') weight *= 0.453592;

        // Cockcroft-Gault: ((140 - Age) * Weight) / (72 * SCr)  [* 0.85 if female]
        let crcl = ((140 - age) * weight) / (72 * scr);
        if(gender === 'female') crcl *= 0.85;

        $('out-crcl-val').textContent = crcl.toFixed(1);

        let imp = "", dose = "", color = "#10b981", advice = "";
        let pct = Math.min(100, (crcl/150)*100);

        if(crcl < 30) {
            imp = "Severe"; dose = "Adjust Necessary"; color = "#dc2626";
            advice = "<strong>Severe Renal Impairment:</strong> High risk of drug toxicity. Immediate dose adjustment required for renal-cleared medications.";
        } else if(crcl < 60) {
            imp = "Moderate"; dose = "Review Dosing"; color = "#f59e0b";
            advice = "<strong>Moderate Renal Impairment:</strong> Moderate reduction in clearance. Many medications require dose titration or increased intervals.";
        } else if(crcl < 90) {
            imp = "Mild"; dose = "Near Standard"; color = "#10b981";
            advice = "<strong>Mild Renal Reduction:</strong> Often age-related. Generally standard dosing is safe, but caution with highly toxic renal-cleared drugs.";
        } else {
            imp = "None"; dose = "Standard"; color = "#059669";
            advice = "<strong>Normal Renal Function:</strong> Clearance is within the expected physiological range. Standard drug dosing protocols apply.";
        }

        $('out-crcl-imp').textContent = imp;
        $('out-crcl-imp').style.color = color;
        $('out-crcl-dose').textContent = dose;
        $('out-crcl-dose').style.color = color;
        $('crcl-bar').style.width = pct + "%";
        $('crcl-bar').style.background = color;
        $('crcl-advice').innerHTML = advice;
        $('crcl-output-card').style.setProperty('--tool-color', color);
    }

    [ageEl, wEl, wuEl, scrEl].forEach(e=>e.addEventListener('input', calculate));
    genEls.forEach(e=>e.addEventListener('change', calculate));
    
    document.querySelectorAll('.crcl-quick').forEach(btn=>{btn.addEventListener('click',()=>{
        ageEl.value=btn.dataset.age; wEl.value=btn.dataset.w; scrEl.value=btn.dataset.scr;
        calculate();
    })});

    $('crcl-copy').addEventListener('click',function(){
        const text=`CrCl Report (Cockcroft-Gault)\nResult: ${$('out-crcl-val').textContent} mL/min\nImpairment: ${$('out-crcl-imp').textContent}\nLabs: Age ${ageEl.value}, Weight ${wEl.value}${wuEl.value}, SCr ${scrEl.value}\n— ToolsHub BioLabs`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>

<style>
.crcl-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.crcl-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.crcl-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.crcl-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.crcl-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.crcl-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.rounded-start-4{border-top-left-radius:1rem !important;border-bottom-left-radius:1rem !important}
.rounded-end-4{border-top-right-radius:1rem !important;border-bottom-right-radius:1rem !important}
</style>

