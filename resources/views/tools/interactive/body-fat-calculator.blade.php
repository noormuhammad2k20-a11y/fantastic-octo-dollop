<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            {{-- Unit Toggle --}}
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
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Profile & Weight</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Gender</label>
                                <select id="bf-gender" class="form-select form-select-lg rounded-3">
                                    <option value="male">♂ Male</option>
                                    <option value="female">♀ Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Total Weight (<span class="unit-w-text">kg</span>)</label>
                                <input type="number" id="bf-weight" class="form-control form-control-lg rounded-3" value="75">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Height (<span class="unit-h-text">cm</span>)</label>
                                <input type="number" id="bf-height" class="form-control form-control-lg rounded-3" value="175">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Measurements</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Neck (<span class="unit-h-text">cm</span>)</label>
                                <input type="number" id="bf-neck" class="form-control form-control-lg rounded-3" value="38">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Waist (<span class="unit-h-text">cm</span>)</label>
                                <input type="number" id="bf-waist" class="form-control form-control-lg rounded-3" value="85">
                            </div>
                            <div class="col-12 d-none" id="bf-hip-wrap">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Hip (<span class="unit-h-text">cm</span>)</label>
                                <input type="number" id="bf-hip" class="form-control form-control-lg rounded-3" value="95">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-chart-line me-2"></i> Analyze Composition
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Composition Results</h5>
                        <p class="text-muted small mb-0">Detailed breakdown of fat vs lean body mass</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0" id="out-bf">18.5</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Body Fat %</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold" id="out-status">FITNESS</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-3">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 text-center">Fitness Tier Spectrum</h6>
                        <div class="progress rounded-pill bg-light mb-2" style="height: 14px; position: relative;">
                            <div id="bf-ptr" class="bf-pointer"></div>
                            <div class="progress-bar bg-info" style="width: 15%"></div>
                            <div class="progress-bar bg-success" style="width: 25%"></div>
                            <div class="progress-bar bg-warning" style="width: 30%"></div>
                            <div class="progress-bar bg-danger" style="width: 30%"></div>
                        </div>
                        <div class="d-flex justify-content-between x-small fw-bold text-muted px-1">
                            <span>Essential</span>
                            <span>Athlete</span>
                            <span>Fitness</span>
                            <span>Acceptable</span>
                            <span>Obese</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Fat Mass</div>
                        <div class="h5 fw-bold mb-0 text-danger" id="out-fat-mass">13.9 kg</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Lean Body Mass</div>
                        <div class="h5 fw-bold mb-0 text-success" id="out-lbm">61.1 kg</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light border text-center h-100">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Ideal Range</div>
                        <div class="h5 fw-bold mb-0 text-primary" id="out-ideal">14 - 17%</div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-primary-soft border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-microscope text-primary me-2"></i>Health Assessment Insights
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

    .bf-pointer {
        position: absolute; top: -8px; width: 4px; height: 30px; 
        background: #1e293b; border-radius: 2px; z-index: 10;
        transition: left 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const genderE = document.getElementById('bf-gender');
    const hE = document.getElementById('bf-height');
    const nE = document.getElementById('bf-neck');
    const wE = document.getElementById('bf-waist');
    const hipE = document.getElementById('bf-hip');
    const wtE = document.getElementById('bf-weight');
    const hipWrap = document.getElementById('bf-hip-wrap');
    const unitMetric = document.getElementById('unit-metric');
    
    const resultCard = document.getElementById('result-card');
    const outBf = document.getElementById('out-bf');
    const outStatus = document.getElementById('out-status');
    const outFatMass = document.getElementById('out-fat-mass');
    const outLbm = document.getElementById('out-lbm');
    const outIdeal = document.getElementById('out-ideal');
    const bfPtr = document.getElementById('bf-ptr');
    const outInsights = document.getElementById('out-insights');
    const btnCalculate = document.getElementById('btn-calculate');

    function calculate() {
        const units = unitMetric.checked ? 'metric' : 'imperial';
        const g = genderE.value;
        let h = parseFloat(hE.value) || 0;
        let n = parseFloat(nE.value) || 0;
        let w = parseFloat(wE.value) || 0;
        let hip = parseFloat(hipE.value) || 0;
        let wt = parseFloat(wtE.value) || 0;

        if (h <= 0 || n <= 0 || w <= 0 || wt <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            let h_cm = (units === 'imperial') ? h * 2.54 : h;
            let n_cm = (units === 'imperial') ? n * 2.54 : n;
            let w_cm = (units === 'imperial') ? w * 2.54 : w;
            let hip_cm = (units === 'imperial') ? hip * 2.54 : hip;
            let wt_kg = (units === 'imperial') ? wt * 0.453592 : wt;

            let bf;
            if (g === 'male') {
                bf = 495 / (1.0324 - 0.19077 * Math.log10(w_cm - n_cm) + 0.15456 * Math.log10(h_cm)) - 450;
            } else {
                bf = 495 / (1.29579 - 0.35004 * Math.log10(w_cm + hip_cm - n_cm) + 0.22100 * Math.log10(h_cm)) - 450;
            }
            bf = Math.max(2, Math.min(60, bf));

            outBf.textContent = bf.toFixed(1);
            
            let cat='', badgeClass='bg-success', pos=0, idealRange='';
            if (g === 'male') {
                if (bf < 6) { cat='ESSENTIAL FAT'; badgeClass='bg-info'; }
                else if (bf < 14) { cat='ATHLETES'; badgeClass='bg-success'; }
                else if (bf < 18) { cat='FITNESS'; badgeClass='bg-success'; }
                else if (bf < 25) { cat='ACCEPTABLE'; badgeClass='bg-warning text-dark'; }
                else { cat='OBESE'; badgeClass='bg-danger'; }
                idealRange = '10 - 20%';
            } else {
                if (bf < 14) { cat='ESSENTIAL FAT'; badgeClass='bg-info'; }
                else if (bf < 21) { cat='ATHLETES'; badgeClass='bg-success'; }
                else if (bf < 25) { cat='FITNESS'; badgeClass='bg-success'; }
                else if (bf < 32) { cat='ACCEPTABLE'; badgeClass='bg-warning text-dark'; }
                else { cat='OBESE'; badgeClass='bg-danger'; }
                idealRange = '18 - 28%';
            }

            outStatus.textContent = cat;
            outStatus.className = `badge rounded-pill px-4 py-2 fw-bold ${badgeClass}`;
            outIdeal.textContent = idealRange;

            // Pointer calculation (Scale 5 to 40)
            pos = ((bf - 5) / (40 - 5)) * 100;
            bfPtr.style.left = Math.max(0, Math.min(100, pos)) + '%';

            const fatMass = wt * (bf/100);
            const lbm = wt - fatMass;
            const unitLabel = (units === 'metric') ? 'kg' : 'lb';
            outFatMass.textContent = fatMass.toFixed(1) + ' ' + unitLabel;
            outLbm.textContent = lbm.toFixed(1) + ' ' + unitLabel;

            const ins = [];
            ins.push(`Your body fat is <strong>${bf.toFixed(1)}%</strong>, categorized as <strong>${cat}</strong>.`);
            ins.push(`Lean Body Mass: <strong>${outLbm.textContent}</strong>.`);
            if (bf >= 25) ins.push('High body fat percentages are associated with increased metabolic resistance and cardiovascular stress.');

            outInsights.innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-chart-line me-2"></i> Analyze Composition';
            btnCalculate.disabled = false;
        }, 600);
    }

    btnCalculate.addEventListener('click', calculate);

    genderE.addEventListener('change', function() {
        hipWrap.classList.toggle('d-none', this.value !== 'female');
    });

    document.querySelectorAll('input[name="units"]').forEach(radio => {
        radio.addEventListener('change', () => {
            const isMetric = unitMetric.checked;
            document.querySelectorAll('.unit-h-text').forEach(e => e.textContent = isMetric ? 'cm' : 'in');
            document.querySelectorAll('.unit-w-text').forEach(e => e.textContent = isMetric ? 'kg' : 'lb');
            
            // Convert values
            const hF = isMetric ? 2.54 : 1/2.54;
            const wF = isMetric ? 0.453592 : 2.20462;
            
            [hE, nE, wE, hipE].forEach(el => { if(el.value) el.value = (el.value * hF).toFixed(1); });
            wtE.value = (wtE.value * wF).toFixed(1);
        });
    });

    document.getElementById('btn-reset').addEventListener('click', () => {
        hE.value = 175; nE.value = 38; wE.value = 85; wtE.value = 75; hipE.value = 95;
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Body Composition Report\nFat Percentage: ${outBf.textContent}%\nCategory: ${outStatus.textContent}\nLean Mass: ${outLbm.textContent}\nGenerated via ToolsHub Health.`;
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
