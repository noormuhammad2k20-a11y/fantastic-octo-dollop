@include('tools.partials.medical-disclaimer')

<div class="row g-4 gfr-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Gender</label>
                        <select id="gfr-gender" class="form-select form-select-lg rounded-3">
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Age</label>
                        <input type="number" id="gfr-age" class="form-control form-control-lg rounded-3" value="45">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Serum Creatinine</label>
                        <div class="input-group">
                            <input type="number" id="gfr-creat" class="form-control form-control-lg rounded-start-3" value="1.0" step="0.01">
                            <select id="gfr-c-unit" class="form-select form-select-lg rounded-end-3" style="max-width:120px">
                                <option value="mg/dL" selected>mg/dL</option>
                                <option value="umol/L">µmol/L</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 gfr-quick" data-a="25" data-c="0.9">Healthy Adult</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 gfr-quick" data-a="65" data-c="1.5">CKD Stage 3</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 gfr-quick" data-a="75" data-c="3.5">CKD Stage 4</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="gfr-output-card" style="--tool-hue:160;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Estimated GFR</span>
                <div class="output-hero-value" id="out-gfr-val" style="font-size:3.5rem">94</div>
                <span class="output-hero-unit">mL/min/1.73m²</span>
            </div>

            <div class="position-relative mt-4 mb-1 px-4">
                <div class="progress rounded-pill" style="height:12px;background:#e2e8f0">
                    <div id="gfr-bar" class="progress-bar rounded-pill" style="width:80%;background:#10b981;transition:all .5s"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-4 mb-4"><span>Failure (G5)</span><span>Moderate</span><span>Normal (G1)</span></div>

            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">CKD Stage</span>
                        <span class="stat-card-value" id="out-gfr-stage">Stage 1</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Assessment</span>
                        <span class="stat-card-value text-success" id="out-gfr-assess">Normal</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-success shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-success"></i>Clinical Guidance</h6>
                <div id="gfr-advice" class="small text-secondary"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="gfr-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy GFR Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const genEl=$('gfr-gender'), ageEl=$('gfr-age'), creatEl=$('gfr-creat'), cUnitEl=$('gfr-c-unit');

    function calculate(){
        const age = parseFloat(ageEl.value)||0;
        let c = parseFloat(creatEl.value)||0;
        const gen = genEl.value;

        if(age<=0 || c<=0) return;
        if(cUnitEl.value==='umol/L') c /= 88.42;

        // CKD-EPI (2021) Equation
        // GFR = 142 * min(Scr/k, 1)^a * max(Scr/k, 1)^-1.200 * 0.9938^Age * [1.012 if female]
        const k = (gen === 'female') ? 0.7 : 0.9;
        const a = (gen === 'female') ? -0.241 : -0.302;
        const femaleAdj = (gen === 'female') ? 1.012 : 1.0;

        const scr_k_min = Math.min(c/k, 1);
        const scr_k_max = Math.max(c/k, 1);

        const gfr = 142 * Math.pow(scr_k_min, a) * Math.pow(scr_k_max, -1.200) * Math.pow(0.9938, age) * femaleAdj;

        $('out-gfr-val').textContent = Math.round(gfr);

        // Visuals & Logic
        let stage = "", assess = "", color = "#10b981", advice = "";
        let pct = Math.min(100, (gfr/120)*100);

        if(gfr >= 90) {
            stage = "Stage 1"; assess = "Normal"; color = "#059669";
            advice = "Kidney function is normal (G1). Persistently high eGFR is typical for healthy adults.";
        } else if(gfr >= 60) {
            stage = "Stage 2"; assess = "Mildly Dec."; color = "#10b981";
            advice = "Mild reduction in function (G2). Usually not significant unless other markers (like proteinuria) are present.";
        } else if(gfr >= 45) {
            stage = "Stage 3a"; assess = "Mild-Mod."; color = "#d97706";
            advice = "Mild to moderate reduction (G3a). CKD monitoring and risk assessment are recommended.";
        } else if(gfr >= 30) {
            stage = "Stage 3b"; assess = "Mod-Severe"; color = "#ea580c";
            advice = "Moderate to severe reduction (G3b). Increased cardiovascular risk and potential medication adjustment.";
        } else if(gfr >= 15) {
            stage = "Stage 4"; assess = "Severe Ref."; color = "#dc2626";
            advice = "Severe reduction (G4). Preparation for renal replacement therapy may be indicated.";
        } else {
            stage = "Stage 5"; assess = "Failure"; color = "#881337";
            advice = "Kidney failure (G5). Immediate nephrology consultation required.";
        }

        $('out-gfr-stage').textContent = stage;
        $('out-gfr-assess').textContent = assess;
        $('out-gfr-assess').style.color = color;
        $('gfr-bar').style.width = pct + "%";
        $('gfr-bar').style.background = color;
        $('gfr-advice').innerHTML = advice;
        $('gfr-output-card').style.setProperty('--tool-color', color);
    }

    [genEl, ageEl, creatEl, cUnitEl].forEach(e=>e.addEventListener('input', calculate));
    document.querySelectorAll('.gfr-quick').forEach(btn=>{btn.addEventListener('click',()=>{
        ageEl.value=btn.dataset.a; creatEl.value=btn.dataset.c;
        calculate();
    })});

    $('gfr-copy').addEventListener('click',function(){
        const text=`eGFR Report (CKD-EPI 2021)\nResult: ${$('out-gfr-val').textContent} mL/min/1.73m²\nStage: ${$('out-gfr-stage').textContent}\n— ToolsHub Medical`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>

<style>
.gfr-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.gfr-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.gfr-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.gfr-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.gfr-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.gfr-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

