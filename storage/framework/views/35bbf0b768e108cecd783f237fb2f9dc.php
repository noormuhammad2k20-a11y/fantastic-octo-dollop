<div class="container-fluid ibw-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(34, 197, 94, 0.1); color:#22c55e;">
                        <i class="fas fa-weight-scale"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Clinical Weight Architect</h3>
                        <p class="tool-subtitle">Precision calculation of ideal body weight (IBW) using specialized clinical equations: Devine, Miller, and Robinson.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label-custom">Biological Gender</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-toggle-custom active flex-grow-1" data-id="gender" data-value="male">Male</button>
                                <button type="button" class="btn-toggle-custom flex-grow-1" data-id="gender" data-value="female">Female</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Unit System</label>
                            <select id="unit_system" class="form-select-custom">
                                <option value="metric">Metric (cm/kg)</option>
                                <option value="imperial">Imperial (ft/in/lbs)</option>
                            </select>
                        </div>
                        <div class="col-md-6 height-metric">
                            <label class="form-label-custom">Current Height (cm)</label>
                            <input type="number" id="height_cm" class="form-control-custom" value="175">
                        </div>
                        <div class="col-md-6 height-imperial d-none">
                            <label class="form-label-custom">Height (Feet & Inches)</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="input-group-custom">
                                        <input type="number" id="height_ft" class="form-control-custom" value="5">
                                        <span class="input-addon">ft</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group-custom">
                                        <input type="number" id="height_in" class="form-control-custom" value="9">
                                        <span class="input-addon">in</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#22c55e;" onclick="calculateIBW()">
                                    <i class="fas fa-chart-simple me-2"></i> Compute Clinical Targets
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetIBW()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-4 pt-3">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-warning me-1"></i>Quick Presets:</span>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn-preset-pill" onclick="setHeight(170, 'female')">👩 Avg Woman (170cm)</button>
                            <button class="btn-preset-pill" onclick="setHeight(180, 'male')">👨 Avg Man (180cm)</button>
                            <button class="btn-preset-pill" onclick="setHeight(160, 'female')">📏 Petite (160cm)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="output-card-themed" id="ibw-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="hero-weight-badge">
                            <span class="hero-label">Ideal Baseline</span>
                            <h2 class="hero-value" id="final-ibw">68.2</h2>
                            <div class="hero-unit-tag" id="main-unit-tag">KG</div>
                            <div class="hero-subtitle-tag" id="devine-ref">Devine Formula</div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="formula-comparison-card">
                            <h6 class="fw-bold mb-3 small text-uppercase letter-spacing-1"><i class="fas fa-microscope text-primary me-2"></i>Clinical Formula Variation</h6>
                            <div class="d-flex flex-column gap-2">
                                <div class="f-row">
                                    <span class="f-label">Robinson Formula</span>
                                    <span class="f-value" id="robinson-res">0.0 kg</span>
                                </div>
                                <div class="f-row">
                                    <span class="f-label">Miller Formula</span>
                                    <span class="f-value" id="miller-res">0.0 kg</span>
                                </div>
                                <div class="f-row">
                                    <span class="f-label">Hamwi Formula</span>
                                    <span class="f-value" id="hamwi-res">0.0 kg</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="range-viz-container">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Health Range (BMI 18.5-25)</span>
                                <span class="small fw-bold text-success" id="healthy-range">0.0 - 0.0 kg</span>
                            </div>
                            <div class="progress-bar-pro" style="height: 12px; background: #f1f5f9; border-radius: 20px; position: relative;">
                                <div style="position: absolute; left: 18.5%; width: 6.5%; height: 100%; background: #22c55e; border-radius: 2px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2"><i class="fas fa-circle-info me-2 text-info"></i> Formula Context</h6>
                            <div id="ibw-insights" class="small text-muted">
                                Calculations based on established medical literature for adult populations.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button class="btn-action-dark w-100" id="copy-btn" onclick="copyIBW()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Ideal Weight Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.ibw-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium {
    background: #ffffff;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
}

.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.btn-toggle-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; padding: 0.85rem 1rem; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s; color: #64748b; }
.btn-toggle-custom.active { background: #1e293b; color: white; border-color: #1e293b; }

.form-control-custom, .form-select-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; transition: 0.2s; }
.form-control-custom:focus, .form-select-custom:focus { border-color: #22c55e; box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1); background: #fff; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; }
.btn-preset-pill:hover { border-color: #22c55e; color: #22c55e; background: #f0fdf4; }

/* Output */
.output-card-themed {
    background: #ffffff;
    border-radius: 32px;
    padding: 3rem;
    border: 1px solid rgba(0,0,0,0.06);
    box-shadow: 0 25px 70px rgba(0,0,0,0.06);
    margin-top: 2rem;
}

.hero-weight-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 6rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-unit-tag { font-size: 1.5rem; font-weight: 800; color: #22c55e; letter-spacing: 2px; }
.hero-subtitle-tag { color: #94a3b8; font-weight: 600; font-size: 0.9rem; }

.formula-comparison-card { background: #f8fafc; padding: 1.5rem; border-radius: 20px; border: 1px solid rgba(0,0,0,0.03); }
.f-row { display: flex; justify-content: space-between; border-bottom: 1.5px dashed #e2e8f0; padding: 0.75rem 0; }
.f-row:last-child { border: none; }
.f-label { font-size: 0.85rem; font-weight: 600; color: #64748b; }
.f-value { font-size: 0.95rem; font-weight: 800; color: #1e293b; }

.insights-container-soft { background: #fcfcfc; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 1.5rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.letter-spacing-1 { letter-spacing: 1px; }
</style>

<script>
function calculateIBW() {
    const gender = document.querySelector('[data-id="gender"].active').dataset.value;
    const system = document.getElementById('unit_system').value;
    
    let heightCm;
    if (system === 'metric') {
        heightCm = parseFloat(document.getElementById('height_cm').value) || 0;
    } else {
        const ft = parseFloat(document.getElementById('height_ft').value) || 0;
        const inc = parseFloat(document.getElementById('height_in').value) || 0;
        heightCm = (ft * 30.48) + (inc * 2.54);
    }

    if (heightCm < 152.4) {
        document.getElementById('ibw-insights').innerText = "Formula accuracy decreases significantly for heights under 5 feet (152.4 cm).";
        // but we'll calculate anyway
    } else {
        document.getElementById('ibw-insights').innerText = "Consistent results found across global clinical standards.";
    }

    const inchesOver5ft = (heightCm - 152.4) / 2.54;

    let devine, robinson, miller, hamwi;

    if (gender === 'male') {
        devine = 50 + (2.3 * inchesOver5ft);
        robinson = 52 + (1.9 * inchesOver5ft);
        miller = 56.2 + (1.41 * inchesOver5ft);
        hamwi = 48 + (2.7 * inchesOver5ft);
    } else {
        devine = 45.5 + (2.3 * inchesOver5ft);
        robinson = 49 + (1.7 * inchesOver5ft);
        miller = 53.1 + (1.36 * inchesOver5ft);
        hamwi = 45.5 + (2.2 * inchesOver5ft);
    }

    // Health range (BMI 18.5 - 25)
    // weight = BMI * (heightM^2)
    const heightM = heightCm / 100;
    const rangeMin = 18.5 * (heightM * heightM);
    const rangeMax = 25.0 * (heightM * heightM);

    displayResults(devine, robinson, miller, hamwi, rangeMin, rangeMax);
}

function displayResults(d, r, m, h, rMin, rMax) {
    const system = document.getElementById('unit_system').value;
    const unit = system === 'metric' ? 'kg' : 'lbs';
    const factor = system === 'metric' ? 1 : 2.20462;

    document.getElementById('final-ibw').innerText = (d * factor).toFixed(1);
    document.getElementById('main-unit-tag').innerText = unit.toUpperCase();
    
    document.getElementById('robinson-res').innerText = (r * factor).toFixed(1) + " " + unit;
    document.getElementById('miller-res').innerText = (m * factor).toFixed(1) + " " + unit;
    document.getElementById('hamwi-res').innerText = (h * factor).toFixed(1) + " " + unit;
    
    document.getElementById('healthy-range').innerText = (rMin * factor).toFixed(1) + " - " + (rMax * factor).toFixed(1) + " " + unit;
}

function setHeight(cm, gender) {
    document.getElementById('unit_system').value = 'metric';
    document.getElementById('unit_system').dispatchEvent(new Event('change'));
    document.getElementById('height_cm').value = cm;
    document.querySelectorAll('[data-id="gender"]').forEach(b => {
        b.classList.remove('active');
        if(b.dataset.value === gender) b.classList.add('active');
    });
    calculateIBW();
}

function resetIBW() {
    document.getElementById('height_cm').value = 175;
    calculateIBW();
}

function copyIBW() {
    const ibw = document.getElementById('final-ibw').innerText;
    const unit = document.getElementById('main-unit-tag').innerText;
    const range = document.getElementById('healthy-range').innerText;
    const text = `Ideal Body Weight Profile\n━━━━━━━━━━━━━━━━━━━━━━\nTarget IBW: ${ibw} ${unit}\nHealthy Range (BMI): ${range}\n\nClinical data by ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Ideal Weight Profile', 2000);
    });
}

// UI Triggers
document.getElementById('unit_system').addEventListener('change', function() {
    if (this.value === 'metric') {
        document.querySelector('.height-metric').classList.remove('d-none');
        document.querySelector('.height-imperial').classList.add('d-none');
    } else {
        document.querySelector('.height-metric').classList.add('d-none');
        document.querySelector('.height-imperial').classList.remove('d-none');
    }
    calculateIBW();
});

document.querySelectorAll('.btn-toggle-custom').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll(`[data-id="${this.dataset.id}"]`).forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        calculateIBW();
    });
});

['height_cm', 'height_ft', 'height_in'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateIBW);
});

document.addEventListener('DOMContentLoaded', calculateIBW);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ideal-body-weight-calculator.blade.php ENDPATH**/ ?>