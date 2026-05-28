<div class="container-fluid caffeine-tox-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(185, 28, 28, 0.1); color:#b91c1c;">
                        <i class="fas fa-biohazard"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Caffeine Toxicity & Safety Analyzer</h3>
                        <p class="tool-subtitle">Biological safety threshold calculator based on body mass and FDA/EMA pharmacological safety standards for caffeine consumption.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Body Weight</label>
                            <div class="input-group-custom">
                                <input type="number" id="weight" class="form-control-custom" value="75" min="20" max="250">
                                <span class="input-addon weight-unit">kg</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Total Caffeine Intake</label>
                            <div class="input-group-custom">
                                <input type="number" id="caf_mg" class="form-control-custom" value="200" min="0" max="5000">
                                <span class="input-addon">mg</span>
                            </div>
                            <span class="text-muted tiny mt-1">Total cumulative dose in 24h</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Biological Tolerance</label>
                            <select id="tolerance" class="form-select-custom">
                                <option value="low">Low (Sensitive)</option>
                                <option value="normal" selected>Normal / Moderate</option>
                                <option value="high">High (Habitual User)</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4 text-center">
                            <div class="d-inline-flex bg-light p-1 rounded-pill">
                                <button class="btn btn-sm px-4 rounded-pill btn-weight active" data-unit="kg">Metric (kg)</button>
                                <button class="btn btn-sm px-4 rounded-pill btn-weight" data-unit="lbs">Imperial (lbs)</button>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#b91c1c;" onclick="calculateCaffeineTox()">
                                    <i class="fas fa-heart-circle-exclamation me-2"></i> Assess Toxic Load
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetCaffeineTox()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Results Card --}}
        <div class="col-lg-12">
            <div class="output-card-themed" id="ct-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-tox-badge">
                            <span class="hero-label">Safety Status</span>
                            <h2 class="hero-value" id="risk-status">Safe</h2>
                            <div class="hero-subtext mt-2">
                                <span id="mg-per-kg">2.6</span> mg/kg body weight
                            </div>
                            <div class="hero-status-pill mt-3" id="tox-pill">Optimal Level</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="tox-spectrum">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Toxicity Spectrum</span>
                                <span class="small fw-bold text-success" id="spectrum-text">Safe Reserve</span>
                            </div>
                            <div class="spectrum-bar">
                                <div id="tox-indicator" class="tox-indicator"></div>
                                <div class="spectrum-segments">
                                    <div class="s-seg s-safe"></div>
                                    <div class="s-seg s-warn"></div>
                                    <div class="s-seg s-high"></div>
                                    <div class="s-seg s-danger"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted fw-bold ls-1">
                                <span>3 mg/kg</span><span>6 mg/kg</span><span>9 mg/kg</span><span>12+</span>
                            </div>
                        </div>

                        <div class="clinical-limits mt-4 p-3 rounded-4 bg-light border border-danger border-opacity-10">
                            <h6 class="fw-bold small mb-2 uppercase ls-1 text-danger"><i class="fas fa-triangle-exclamation me-2"></i>Safety Thresholds</h6>
                            <div class="row g-2">
                                <div class="col-6"><span class="tiny fw-bold text-muted">Daily Max Rec.:</span> <span class="small fw-bold text-dark">400 mg</span></div>
                                <div class="col-6"><span class="tiny fw-bold text-muted">Dose Threshold:</span> <span class="small fw-bold" id="limit-val">450 mg</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="warnings-grid py-3 px-4 rounded-4" id="tox-warnings-container" style="background:#fef2f2; border:1px solid #fee2e2;">
                            <div class="d-flex align-items-center gap-2 mb-2 text-danger">
                                <i class="fas fa-circle-info"></i>
                                <h6 class="fw-bold mb-0 small uppercase ls-1">Physiological Warnings</h6>
                            </div>
                            <p id="tox-insights" class="small text-muted mb-0">
                                Current intake is within moderate safety limits. No acute physiological risk detected for healthy adults.
                            </p>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyToxReport()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Toxicity Report
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 mt-4 text-center bg-danger bg-opacity-10 border border-danger border-opacity-20">
                <p class="mb-0 small text-danger fw-bold"><i class="fas fa-phone-flip me-2"></i><strong>Medical Warning:</strong> If you experience severe heart palpitations, tremors, or dizziness, seek medical attention immediately.</p>
            </div>
        </div>
    </div>
</div>

<style>
.caffeine-tox-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.btn-weight.active { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); color: #1e293b; font-weight: 800; }
.btn-weight { color: #64748b; font-weight: 600; border: none; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom, .form-select-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-tox-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 4.5rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -2px; }
.hero-subtext { font-size: 1.1rem; color: #64748b; font-weight: 700; }

.spectrum-bar { height: 12px; border-radius: 10px; position: relative; margin: 1.5rem 0; background: #f1f5f9; }
.spectrum-segments { position: absolute; width: 100%; height: 100%; display: flex; border-radius: 10px; overflow: hidden; opacity: 0.3; }
.s-seg { height: 100%; }
.s-safe { width: 25%; background: #10b981; }
.s-warn { width: 25%; background: #fbbf24; }
.s-high { width: 25%; background: #f97316; }
.s-danger { width: 25%; background: #ef4444; }

.tox-indicator { position: absolute; top: -8px; width: 4px; height: 28px; background: #1e293b; border-radius: 10px; z-index: 2; border: 2px solid white; transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.tiny { font-size: 0.7rem; }
</style>

<script>
function calculateCaffeineTox() {
    const unit = document.querySelector('.btn-weight.active').dataset.unit;
    let w = parseFloat(document.getElementById('weight').value) || 0;
    const caf = parseFloat(document.getElementById('caf_mg').value) || 0;
    const tolerance = document.getElementById('tolerance').value;

    if (w <= 0) return;

    // Convert to kg for internal math
    const weight_kg = unit === 'lbs' ? w * 0.453592 : w;
    const ratio = caf / weight_kg;

    // Biological Safety Limits (mg per kg)
    let safeLimit = 6;
    if (tolerance === 'low') safeLimit = 3;
    if (tolerance === 'high') safeLimit = 9;

    document.getElementById('limit-val').innerText = Math.round(weight_kg * safeLimit) + " mg";
    document.getElementById('mg-per-kg').innerText = ratio.toFixed(1);

    displayToxResults(ratio, safeLimit);
}

function displayToxResults(ratio, safe) {
    let status = "Safe";
    let clr = "#10b981";
    let pillText = "Optimal Level";
    let insights = "Intake is within clinical safety guidelines for your weight. No physiological concerns noted.";
    let spect = "Safe Reserve";
    
    // Position 0-100 based on ratio 0 to 12 mg/kg
    let pos = (ratio / 12) * 100;
    pos = Math.min(100, Math.max(0, pos));

    if (ratio > 10) {
        status = "CRITICAL"; clr = "#ef4444"; pillText = "Extreme Danger"; spect = "High Toxicity";
        insights = "Dose exceeds acute toxicity threshold. Risk of severe arrhythmia, tremors, and nervous system overload. Seek medical advice.";
    } else if (ratio > 6) {
        status = "HIGH RISK"; clr = "#f97316"; pillText = "Excessive Load"; spect = "Anxiety Zone";
        insights = "Strong physiological impact. Significant risk of tachycardia, jitters, and gastrointestinal distress.";
    } else if (ratio > 3) {
        status = "MODERATE"; clr = "#fbbf24"; pillText = "Stimulant Warning"; spect = "Elevated Alert";
        insights = "High moderate level. May cause restlessness, insomnia, and mild palpitation in sensitive individuals.";
    }

    document.getElementById('risk-status').innerText = status;
    document.getElementById('risk-status').style.color = clr;
    document.getElementById('spectrum-text').innerText = spect;
    document.getElementById('spectrum-text').style.color = clr;
    
    document.getElementById('tox-indicator').style.left = pos + "%";
    document.getElementById('tox-indicator').style.background = clr;

    const pill = document.getElementById('tox-pill');
    pill.innerText = pillText;
    pill.style.background = clr + "15";
    pill.style.color = clr;
    pill.style.border = "1.5px solid " + clr + "30";

    document.getElementById('tox-insights').innerText = insights;
}

function resetCaffeineTox() {
    document.getElementById('weight').value = 75;
    document.getElementById('caf_mg').value = 200;
    calculateCaffeineTox();
}

function copyToxReport() {
    const status = document.getElementById('risk-status').innerText;
    const ratio = document.getElementById('mg-per-kg').innerText;
    const limit = document.getElementById('limit-val').innerText;
    const text = `Caffeine Toxicity Report\n━━━━━━━━━━━━━━━━━━━━━━\nAssessment: ${status}\nMg/Kg Ratio: ${ratio}\nBio-Limit: ${limit}\n\nClinically calculated via ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Toxicity Report', 2000);
    });
}

// UI Triggers
document.querySelectorAll('.btn-weight').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-weight').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const unit = this.dataset.unit;
        document.querySelector('.weight-unit').innerText = unit;
        calculateCaffeineTox();
    });
});

['weight', 'caf_mg', 'tolerance'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateCaffeineTox);
});

document.addEventListener('DOMContentLoaded', calculateCaffeineTox);
</script>
