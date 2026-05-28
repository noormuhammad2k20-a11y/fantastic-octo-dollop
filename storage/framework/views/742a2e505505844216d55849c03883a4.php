<?php echo $__env->make('tools.partials.medical-disclaimer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="row g-4 bsa-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Weight</label>
                        <div class="input-group">
                            <input type="number" id="bsa-weight" class="form-control form-control-lg rounded-start-3" value="70">
                            <select id="bsa-w-unit" class="form-select form-select-lg rounded-end-3" style="max-width:100px">
                                <option value="kg" selected>kg</option>
                                <option value="lb">lb</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Height</label>
                        <div class="input-group">
                            <input type="number" id="bsa-height" class="form-control form-control-lg rounded-start-3" value="170">
                            <select id="bsa-h-unit" class="form-select form-select-lg rounded-end-3" style="max-width:100px">
                                <option value="cm" selected>cm</option>
                                <option value="in">in</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Primary Formula</label>
                        <select id="bsa-formula" class="form-select form-select-lg rounded-3">
                            <option value="mosteller" selected>Mosteller (Standard)</option>
                            <option value="dubois">Du Bois (Classic)</option>
                            <option value="haycock">Haycock (Pediatric/Adult)</option>
                            <option value="gehan">Gehan-George</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 bsa-quick" data-w="75" data-h="175">Average Adult</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 bsa-quick" data-w="15" data-h="100">Small Child</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 bsa-quick" data-w="100" data-h="185">Large Adult</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="bsa-output-card" style="--tool-hue:160;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Body Surface Area</span>
                <div class="output-hero-value" id="out-bsa-val" style="font-size:3.5rem">1.82</div>
                <span class="output-hero-unit">m²</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Mosteller</span><span class="stat-card-value" id="out-bsa-mosteller">1.82</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Du Bois</span><span class="stat-card-value" id="out-bsa-dubois">1.81</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Haycock</span><span class="stat-card-value" id="out-bsa-haycock">1.84</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Gehan</span><span class="stat-card-value" id="out-bsa-gehan">1.83</span></div></div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-opacity-10 border-success shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-microscope me-2 text-success"></i>Clinical Context</h6>
                <div id="bsa-advice" class="small text-secondary"></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="bsa-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy BSA Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const weightEl=$('bsa-weight'), wUnitEl=$('bsa-w-unit'), heightEl=$('bsa-height'), hUnitEl=$('bsa-h-unit'), formulaEl=$('bsa-formula');

    function calculate(){
        let w = parseFloat(weightEl.value)||0;
        let h = parseFloat(heightEl.value)||0;
        if(w<=0 || h<=0) return;

        if(wUnitEl.value==='lb') w *= 0.453592;
        if(hUnitEl.value==='in') h *= 2.54;

        // Mosteller: sqrt( (h*w)/3600 )
        const mosteller = Math.sqrt((h * w) / 3600);
        // Du Bois: 0.007184 * w^0.425 * h^0.725
        const dubois = 0.007184 * Math.pow(w, 0.425) * Math.pow(h, 0.725);
        // Haycock: 0.024265 * w^0.5378 * h^0.3964
        const haycock = 0.024265 * Math.pow(w, 0.5378) * Math.pow(h, 0.3964);
        // Gehan-George: 0.0235 * w^0.51456 * h^0.42246
        const gehan = 0.0235 * Math.pow(w, 0.51456) * Math.pow(h, 0.42246);

        const results = { mosteller, dubois, haycock, gehan };
        const primary = results[formulaEl.value];

        $('out-bsa-val').textContent = primary.toFixed(2);
        $('out-bsa-mosteller').textContent = mosteller.toFixed(2);
        $('out-bsa-dubois').textContent = dubois.toFixed(2);
        $('out-bsa-haycock').textContent = haycock.toFixed(2);
        $('out-bsa-gehan').textContent = gehan.toFixed(2);

        // Clinical Advice
        let advice = `BSA is used to calculate dosages for chemotherapy, monoclonal antibodies, and other potent medications. The average adult BSA is typically <strong>1.7 - 1.9 m²</strong>.`;
        if(primary < 0.5) advice += `<br><br><i class="fas fa-baby me-1"></i> Note: This result is consistent with a pediatric patient. Ensure formula protocol is followed.`;
        $('bsa-advice').innerHTML = advice;
    }

    [weightEl,wUnitEl,heightEl,hUnitEl,formulaEl].forEach(e=>e.addEventListener('input',calculate));
    document.querySelectorAll('.bsa-quick').forEach(btn=>{btn.addEventListener('click',()=>{
        weightEl.value=btn.dataset.w;heightEl.value=btn.dataset.h;
        wUnitEl.value='kg';hUnitEl.value='cm';
        calculate();
    })});

    $('bsa-copy').addEventListener('click',function(){
        const text=`BSA Report\nFormula: ${formulaEl.options[formulaEl.selectedIndex].text}\nResult: ${$('out-bsa-val').textContent} m²\nDetails: M:${$('out-bsa-mosteller').textContent}, D:${$('out-bsa-dubois').textContent}, H:${$('out-bsa-haycock').textContent}\n— ToolsHub Medical`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    calculate();
});
</script>

<style>
.bsa-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.bsa-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.bsa-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.bsa-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.bsa-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.bsa-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bsa-calculator.blade.php ENDPATH**/ ?>