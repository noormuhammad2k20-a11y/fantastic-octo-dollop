<div class="container-fluid lbm-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(79, 70, 229, 0.1); color:#4f46e5;">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Lean Body Mass (LBM) Analyzer</h3>
                        <p class="tool-subtitle">Evaluate your non-fat body composition using Boer and James clinical equations for athletic and metabolic assessment.</p>
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
                                <option value="metric">Metric (kg/cm)</option>
                                <option value="imperial">Imperial (lbs/in)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Total Weight</label>
                            <div class="input-group-custom">
                                <input type="number" id="total_weight" class="form-control-custom" value="75">
                                <span class="input-addon" id="w-unit">kg</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Height</label>
                            <div class="input-group-custom">
                                <input type="number" id="height_val" class="form-control-custom" value="180">
                                <span class="input-addon" id="h-unit">cm</span>
                            </div>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#4f46e5;" onclick="calculateLBM()">
                                    <i class="fas fa-microchip me-2"></i> Analyze Body Composition
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetLBM()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-4 pt-3">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-warning me-1"></i>Quick Benchmarks:</span>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn-preset-pill" onclick="setLBM(85, 185, 'male')">🏋️ Sport Performance (85kg)</button>
                            <button class="btn-preset-pill" onclick="setLBM(60, 165, 'female')">🏃 Fitness Athlete (60kg)</button>
                            <button class="btn-preset-pill" onclick="setLBM(70, 175, 'male')">📊 Average Male (70kg)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="output-card-themed" id="lbm-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="hero-lbm-badge">
                            <span class="hero-label">Your Lean Mass</span>
                            <h2 class="hero-value" id="final-lbm">62.5</h2>
                            <div class="hero-unit-tag" id="main-unit-tag">KG</div>
                            <div class="hero-subtitle-tag" id="boer-ref">Boer Equation</div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="lbm-viz-container">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Body Logic Breakdown</span>
                                <span class="small fw-bold text-primary" id="body-fat-pct">16.7% Est. Fat</span>
                            </div>
                            <div class="progress-bar-pro" style="height: 24px; background: #f1f5f9; border-radius: 12px; overflow: hidden; display: flex;">
                                <div id="lbm-bar" style="width: 83.3%; background: #4f46e5; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.7rem; font-weight: 800;">LEAN MASS</div>
                                <div id="fat-bar" style="width: 16.7%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 0.7rem; font-weight: 800;">FAT</div>
                            </div>
                        </div>

                        <div class="mt-4 row g-3">
                            <div class="col-6 col-md-4">
                                <div class="mini-stat-card">
                                    <span class="ms-label">James Formula</span>
                                    <span class="ms-value" id="james-res">0.0 kg</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mini-stat-card">
                                    <span class="ms-label">Hume Formula</span>
                                    <span class="ms-value" id="hume-res">0.0 kg</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mini-stat-card">
                                    <span class="ms-label">Fat Mass</span>
                                    <span class="ms-value" id="fat-mass-res">12.5 kg</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2"><i class="fas fa-vial me-2 text-primary"></i> Composition Insight</h6>
                            <div id="lbm-insights" class="small text-muted">
                                Lean body mass includes muscles, bones, organs, and water. Essential for calculating BMR and protein needs.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button class="btn-action-dark w-100" id="copy-btn" onclick="copyLBM()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Body Composition Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.lbm-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium {
    background: #ffffff;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
}

.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.4rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.9rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.btn-toggle-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; padding: 0.85rem 1rem; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s; color: #64748b; }
.btn-toggle-custom.active { background: #1e293b; color: white; border-color: #1e293b; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom, .form-select-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; }
.btn-preset-pill:hover { border-color: #4f46e5; color: #4f46e5; background: #eef2ff; }

/* Output */
.output-card-themed {
    background: #ffffff;
    border-radius: 32px;
    padding: 3rem;
    border: 1px solid rgba(0,0,0,0.06);
    box-shadow: 0 25px 70px rgba(0,0,0,0.06);
    margin-top: 2rem;
}

.hero-lbm-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 6rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-unit-tag { font-size: 1.5rem; font-weight: 800; color: #4f46e5; letter-spacing: 2px; }
.hero-subtitle-tag { color: #94a3b8; font-weight: 600; font-size: 0.9rem; }

.mini-stat-card { background: #f8fafc; padding: 1.25rem; border-radius: 20px; text-align: center; border: 1px solid rgba(0,0,0,0.03); }
.ms-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.ms-value { font-size: 1.1rem; font-weight: 800; color: #1e293b; }

.insights-container-soft { background: #fcfcfc; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 1.5rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.letter-spacing-1 { letter-spacing: 1px; }
</style>

<script>
function calculateLBM() {
    const gender = document.querySelector('[data-id="gender"].active').dataset.value;
    const system = document.getElementById('unit_system').value;
    
    let weight, height;
    if (system === 'metric') {
        weight = parseFloat(document.getElementById('total_weight').value) || 0;
        height = parseFloat(document.getElementById('height_val').value) || 0;
    } else {
        weight = (parseFloat(document.getElementById('total_weight').value) || 0) * 0.453592;
        height = (parseFloat(document.getElementById('height_val').value) || 0) * 2.54;
    }

    if (weight <= 0 || height <= 0) return;

    let boer, james, hume;

    if (gender === 'male') {
        boer = (0.407 * weight) + (0.267 * height) - 19.2;
        james = (1.1 * weight) - (128 * Math.pow(weight/height, 2));
        hume = (0.32810 * weight) + (0.33929 * height) - 29.5336;
    } else {
        boer = (0.252 * weight) + (0.473 * height) - 48.3;
        james = (1.07 * weight) - (148 * Math.pow(weight/height, 2));
        hume = (0.29569 * weight) + (0.41813 * height) - 43.2933;
    }

    // Fat analysis based on Boer
    const fatMass = weight - boer;
    const fatPct = (fatMass / weight) * 100;

    displayLBM(boer, james, hume, fatMass, fatPct);
}

function displayLBM(b, j, h, fm, fp) {
    const system = document.getElementById('unit_system').value;
    const unit = system === 'metric' ? 'kg' : 'lbs';
    const factor = system === 'metric' ? 1 : 2.20462;

    document.getElementById('final-lbm').innerText = (b * factor).toFixed(1);
    document.getElementById('main-unit-tag').innerText = unit.toUpperCase();
    
    document.getElementById('james-res').innerText = (j * factor).toFixed(1) + " " + unit;
    document.getElementById('hume-res').innerText = (h * factor).toFixed(1) + " " + unit;
    document.getElementById('fat-mass-res').innerText = (fm * factor).toFixed(1) + " " + unit;
    document.getElementById('body-fat-pct').innerText = fp.toFixed(1) + "% Est. Fat";

    // Viz
    const fpClamped = Math.min(Math.max(fp, 5), 50); // for display only
    document.getElementById('lbm-bar').style.width = (100 - fpClamped) + "%";
    document.getElementById('fat-bar').style.width = fpClamped + "%";
}

function setLBM(w, h, gender) {
    document.getElementById('unit_system').value = 'metric';
    document.getElementById('unit_system').dispatchEvent(new Event('change'));
    document.getElementById('total_weight').value = w;
    document.getElementById('height_val').value = h;
    document.querySelectorAll('[data-id="gender"]').forEach(b => {
        b.classList.remove('active');
        if(b.dataset.value === gender) b.classList.add('active');
    });
    calculateLBM();
}

function resetLBM() {
    document.getElementById('total_weight').value = 75;
    document.getElementById('height_val').value = 180;
    calculateLBM();
}

function copyLBM() {
    const lbm = document.getElementById('final-lbm').innerText;
    const unit = document.getElementById('main-unit-tag').innerText;
    const fat = document.getElementById('body-fat-pct').innerText;
    const text = `Lean Body Mass (LBM) Report\n━━━━━━━━━━━━━━━━━━━━━━\nLean Mass: ${lbm} ${unit}\nFat Percent: ${fat}\n\nClinical tracking by ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Body Composition Report', 2000);
    });
}

// UI Triggers
document.getElementById('unit_system').addEventListener('change', function() {
    const u = this.value;
    document.getElementById('w-unit').innerText = u === 'metric' ? 'kg' : 'lbs';
    document.getElementById('h-unit').innerText = u === 'metric' ? 'cm' : 'in';
    calculateLBM();
});

document.querySelectorAll('.btn-toggle-custom').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll(`[data-id="${this.dataset.id}"]`).forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        calculateLBM();
    });
});

['total_weight', 'height_val'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateLBM);
});

document.addEventListener('DOMContentLoaded', calculateLBM);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\lean-body-mass-calculator.blade.php ENDPATH**/ ?>