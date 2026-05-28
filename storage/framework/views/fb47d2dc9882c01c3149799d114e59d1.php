<div class="row g-4 a1c-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Calculation Direction</label>
                        <select id="a1c-mode" class="form-select form-select-lg rounded-3">
                            <option value="eag_to_a1c">eAG (Glucose) → HbA1c (%)</option>
                            <option value="a1c_to_eag">HbA1c (%) → eAG (Glucose)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-6" id="input-container">
                        <label class="form-label-custom" id="input-label">Average Glucose Level</label>
                        <div class="input-group">
                            <input type="number" id="a1c-main-input" class="form-control form-control-lg rounded-start-3" value="154" step="0.1">
                            <select id="a1c-unit-select" class="form-select rounded-end-3" style="max-width: 100px;">
                                <option value="mg">mg/dL</option>
                                <option value="mmol">mmol/L</option>
                            </select>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Benchmarks:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 a1c-quick" data-v="110" data-u="mg" data-m="eag_to_a1c">✅ Healthy eAG (110)</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 a1c-quick" data-v="7.5" data-u="%" data-m="a1c_to_eag">⚠️ Target A1C (7.5%)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="a1c-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="a1c-theme" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(220,38,38,.06);">
            <div class="output-hero">
                <span class="output-hero-label" id="out-hero-label">ESTIMATED HBA1C</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-value">7.0</span>
                    <span class="output-hero-unit" id="out-unit">%</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;">Analyzing Profile...</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#dc2626; background: #fff;">
                        <span class="stat-card-label">GLUCOSE STABILITY</span>
                        <span class="stat-card-value" id="out-stability">Standard</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#1e293b; background: #fff;">
                        <span class="stat-card-label">CLINICAL CATEGORY</span>
                        <span class="stat-card-value" id="out-cat" style="font-size: 1.4rem;">Consistent</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Diabetic Management Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="a1c-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Conversion Data
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="a1c-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Analysis
                    </button>
                </div>
            </div>
            
            <div class="mt-4 p-3 bg-white border border-danger-subtle rounded-4 text-center">
                 <small class="text-muted"><i class="fas fa-info-circle me-1"></i> A1C reflects your average blood sugar level over the past 2-3 months.</small>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const modeE = $('a1c-mode'), inputE = $('a1c-main-input'),
          unitE = $('a1c-unit-select'), labelE = $('input-label');

    function calculate(){
        let mode = modeE.value;
        let val = parseFloat(inputE.value) || 0;
        let unit = unitE.value;

        if(val <= 0) return;

        let a1c_final, eag_final;
        
        if(mode === 'eag_to_a1c'){
            // val is eAG
            let eagMg = (unit === 'mmol') ? val * 18.0182 : val;
            a1c_final = (eagMg + 46.7) / 28.7;
            $('out-hero-label').textContent = 'ESTIMATED HBA1C';
            $('out-value').textContent = a1c_final.toFixed(1);
            $('out-unit').textContent = '%';
        } else {
            // val is A1C
            a1c_final = val;
            eag_final = 28.7 * a1c_final - 46.7;
            let displayEag = (unit === 'mmol') ? (eag_final / 18.0182).toFixed(1) : Math.round(eag_final);
            $('out-hero-label').textContent = 'ESTIMATED AVG GLUCOSE';
            $('out-value').textContent = displayEag;
            $('out-unit').textContent = (unit === 'mmol' ? 'mmol/L' : 'mg/dL');
        }

        // Status Logic
        let status = '', cat = '', hue = 0, color = '#dc2626';
        if(a1c_final < 5.7) {
            status = 'Normal Baseline'; cat = 'Non-Diabetic'; hue = 140; color = '#10b981';
        } else if(a1c_final < 6.5) {
            status = 'Pre-diabetic Range'; cat = 'Increased Risk'; hue = 45; color = '#f59e0b';
        } else {
            status = 'Diabetic Range'; cat = 'Action Required'; hue = 0; color = '#dc2626';
        }

        const outStatus = $('out-status');
        outStatus.textContent = status;
        outStatus.style.color = color;
        $('out-cat').textContent = cat;
        $('out-cat').style.color = color;
        $('out-stability').textContent = (a1c_final > 7.0 ? 'Elevated' : 'Optimal');

        $('a1c-theme').style.setProperty('--tool-hue', hue);
        $('a1c-theme').style.setProperty('--tool-color', color);

        // Insights
        const ins = [];
        if(a1c_final >= 6.5) ins.push('An A1C over 6.5% on two separate tests indicates diabetes.');
        else if(a1c_final >= 5.7) ins.push('You are in the pre-diabetes zone. Lifestyle intervention can reverse this trend.');
        else ins.push('Your glide path is normal. Keep monitoring once per year.');
        
        ins.push(`Conversion verified by ADA standards: eAG = 28.7 × A1C − 46.7`);

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-danger me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    modeE.addEventListener('change', () => {
        if(modeE.value === 'eag_to_a1c') {
            labelE.textContent = 'Average Glucose Level';
            inputE.value = 154;
            unitE.style.display = 'block';
        } else {
            labelE.textContent = 'HbA1c Percentage (%)';
            inputE.value = 7.0;
            unitE.style.display = 'none';
        }
        calculate();
    });

    [inputE, unitE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.a1c-quick').forEach(btn => {
        btn.onclick = () => {
             modeE.value = btn.dataset.m;
             modeE.dispatchEvent(new Event('change'));
             inputE.value = btn.dataset.v;
             if(btn.dataset.u !== '%') unitE.value = btn.dataset.u;
             calculate();
        };
    });

    $('a1c-reset').onclick = () => {
        modeE.value = 'eag_to_a1c';
        modeE.dispatchEvent(new Event('change'));
    };

    $('a1c-copy-btn').onclick = function(){
        const text = `A1C/eAG Conversion Report\nMode: ${modeE.options[modeE.selectedIndex].text}\nResult: ${$('out-value').textContent} ${$('out-unit').textContent}\nStatus: ${$('out-status').textContent}\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Data Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.a1c-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(220,38,38,.05)}
.a1c-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.a1c-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.a1c-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.a1c-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.a1c-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.5rem;font-weight:800;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .a1c-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\a1c-calculator.blade.php ENDPATH**/ ?>