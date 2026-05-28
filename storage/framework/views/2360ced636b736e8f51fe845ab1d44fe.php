<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="d-flex justify-content-center mb-4">
                <div class="btn-group p-1 bg-light rounded-pill" role="group">
                    <input type="radio" class="btn-check" name="units" id="unit-metric" checked>
                    <label class="btn btn-sm rounded-pill px-4 fw-bold unit-label" for="unit-metric">Metric (cm/kg)</label>
                    
                    <input type="radio" class="btn-check" name="units" id="unit-imperial">
                    <label class="btn btn-sm rounded-pill px-4 fw-bold unit-label" for="unit-imperial">Imperial (in/lb)</label>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Basic Metrics</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Gender</label>
                                <select id="bmi-gender" class="form-select form-select-lg rounded-3">
                                    <option value="male">♂ Male</option>
                                    <option value="female">♀ Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Age</label>
                                <input type="number" id="bmi-age" class="form-control form-control-lg rounded-3" value="30">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Dimensions</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Height (<span class="unit-h-text">cm</span>)</label>
                                <input type="number" id="bmi-height" class="form-control form-control-lg rounded-3" value="175">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Weight (<span class="unit-w-text">kg</span>)</label>
                                <input type="number" id="bmi-weight" class="form-control form-control-lg rounded-3" value="75">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-heart-pulse me-2"></i> Calculate BMI
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Health Assessment</h5>
                        <p class="text-muted small mb-0">Clinical weight category and risk factor analysis</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Analysis
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0" id="out-bmi">24.5</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">BMI Score (kg/m²)</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold" id="out-category">NORMAL WEIGHT</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-3">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 text-center">Weight Status Spectrum</h6>
                        <div class="progress rounded-pill bg-light mb-2" style="height: 14px; position: relative;">
                            <div id="bmi-ptr" class="bmi-pointer"></div>
                            <div class="progress-bar bg-info" style="width: 20%"></div>
                            <div class="progress-bar bg-success" style="width: 30%"></div>
                            <div class="progress-bar bg-warning" style="width: 25%"></div>
                            <div class="progress-bar bg-danger" style="width: 25%"></div>
                        </div>
                        <div class="d-flex justify-content-between x-small fw-bold text-muted px-1">
                            <span>16.0</span>
                            <span>18.5</span>
                            <span>25.0</span>
                            <span>30.0</span>
                            <span>40.0+</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Ideal Weight Range</div>
                        <div class="h5 fw-bold mb-0 text-success" id="out-range">57.0 - 76.5 kg</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Ponderal Index</div>
                        <div class="h5 fw-bold mb-0 text-dark" id="out-pi">12.8 kg/m³</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Clinical Risk</div>
                        <div class="h5 fw-bold mb-0 text-primary" id="out-risk">Minimal</div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-primary-soft border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-microscope text-primary me-2"></i>AI Assessment Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .unit-label { background: transparent; color: #64748b; border: none; transition: all 0.2s; cursor: pointer; }
    .btn-check:checked + .unit-label { background: #fff; color: var(--primary-color); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }

    .bmi-pointer {
        position: absolute; top: -8px; width: 4px; height: 30px; 
        background: #1e293b; border-radius: 2px; z-index: 10;
        transition: left 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hE = document.getElementById('bmi-height');
    const wE = document.getElementById('bmi-weight');
    const ageE = document.getElementById('bmi-age');
    const genderE = document.getElementById('bmi-gender');
    const unitMetric = document.getElementById('unit-metric');
    
    const resultCard = document.getElementById('result-card');
    const outBmi = document.getElementById('out-bmi');
    const outCategory = document.getElementById('out-category');
    const outRange = document.getElementById('out-range');
    const outPi = document.getElementById('out-pi');
    const outRisk = document.getElementById('out-risk');
    const bmiPtr = document.getElementById('bmi-ptr');
    const outInsights = document.getElementById('out-insights');
    const btnCalculate = document.getElementById('btn-calculate');

    function calculate() {
        const units = unitMetric.checked ? 'metric' : 'imperial';
        let h = parseFloat(hE.value) || 0;
        let w = parseFloat(wE.value) || 0;
        
        if (h <= 0 || w <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            let hM = (units === 'metric') ? h/100 : h * 0.0254;
            let wKg = (units === 'metric') ? w : w * 0.453592;
            
            let bmi = wKg / (hM * hM);
            outBmi.textContent = bmi.toFixed(1);
            
            let cat='', badgeClass='bg-success', risk='', pos=0;
            if (bmi < 18.5) { cat='UNDERWEIGHT'; badgeClass='bg-info'; risk='Increased Nutritional Risk'; }
            else if (bmi < 25) { cat='NORMAL WEIGHT'; badgeClass='bg-success'; risk='Minimal'; }
            else if (bmi < 30) { cat='OVERWEIGHT'; badgeClass='bg-warning text-dark'; risk='Increased Health Risk'; }
            else { cat='OBESE'; badgeClass='bg-danger'; risk='High Clinical Risk'; }

            outCategory.textContent = cat;
            outCategory.className = `badge rounded-pill px-4 py-2 fw-bold ${badgeClass}`;
            outRisk.textContent = risk;

            // Pointer calculation (Scale 16 to 40)
            pos = ((bmi - 16) / (40 - 16)) * 100;
            bmiPtr.style.left = Math.max(0, Math.min(100, pos)) + '%';

            // Ideal Range
            let rMin = 18.5 * (hM * hM);
            let rMax = 25.0 * (hM * hM);
            const factor = (units === 'metric') ? 1 : 2.20462;
            const unitLabel = (units === 'metric') ? 'kg' : 'lb';
            outRange.textContent = `${(rMin * factor).toFixed(1)} - ${(rMax * factor).toFixed(1)} ${unitLabel}`;
            
            const pi = wKg / Math.pow(hM, 3);
            outPi.textContent = pi.toFixed(1) + ' kg/m³';

            const ins = [];
            ins.push(`Your BMI of <strong>${bmi.toFixed(1)}</strong> is categorised as <strong>${cat}</strong>.`);
            ins.push(`To maintain a "Normal" BMI, your weight should be between <strong>${outRange.textContent}</strong>.`);
            if (bmi >= 25) ins.push('Moderate weight reduction can significantly decrease risk factors for type 2 diabetes and hypertension.');

            outInsights.innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-heart-pulse me-2"></i> Calculate BMI';
            btnCalculate.disabled = false;
        }, 600);
    }

    btnCalculate.addEventListener('click', calculate);

    document.querySelectorAll('input[name="units"]').forEach(radio => {
        radio.addEventListener('change', () => {
            const isMetric = unitMetric.checked;
            document.querySelectorAll('.unit-h-text').forEach(e => e.textContent = isMetric ? 'cm' : 'in');
            document.querySelectorAll('.unit-w-text').forEach(e => e.textContent = isMetric ? 'kg' : 'lb');
            
            // Convert values
            let h = parseFloat(hE.value) || 0;
            let w = parseFloat(wE.value) || 0;
            if (isMetric) {
                hE.value = (h * 2.54).toFixed(1);
                wE.value = (w * 0.453592).toFixed(1);
            } else {
                hE.value = (h / 2.54).toFixed(1);
                wE.value = (w * 2.20462).toFixed(1);
            }
        });
    });

    document.getElementById('btn-reset').addEventListener('click', () => {
        hE.value = 175; wE.value = 75;
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `BMI Assessment Report\nBMI: ${outBmi.textContent}\nCategory: ${outCategory.textContent}\nIdeal Weight: ${outRange.textContent}\nGenerated via ToolsHub Health.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied Report!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bmi-calculator.blade.php ENDPATH**/ ?>