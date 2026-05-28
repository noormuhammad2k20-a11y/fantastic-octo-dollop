<div class="container-fluid a1c-converter-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(239, 68, 68, 0.1); color:#ef4444;">
                        <i class="fas fa-droplet"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">A1c & Glucose Architect</h3>
                        <p class="tool-subtitle">Convert between HbA1c percentages and Estimated Average Glucose (eAG) using clinical ADAG formulas.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Calculation Objective</label>
                            <select id="calc_mode" class="form-select-custom">
                                <option value="a1c_to_eag" selected>Convert A1c (%) to Glucose (eAG)</option>
                                <option value="eag_to_a1c">Convert Glucose (eAG) to A1c (%)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom" id="main-input-label">HbA1c Percentage (%)</label>
                            <div class="input-group-custom">
                                <input type="number" id="main_input_val" class="form-control-custom" value="7.0" step="0.1">
                                <select id="glucose_unit" class="select-addon d-none">
                                    <option value="mgdl">mg/dL</option>
                                    <option value="mmoll">mmol/L</option>
                                </select>
                                <span class="input-addon" id="unit-tag">%</span>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" onclick="calculateA1C()">
                                    <i class="fas fa-sync-alt me-2"></i> Perform Direct Conversion
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetA1C()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Action Benchmarks --}}
                    <div class="mt-4 pt-3 border-top">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bookmark text-danger me-1"></i>Clinical Benchmarks:</span>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn-preset-pill" onclick="setA1c(5.6)">🟢 Normal (< 5.7%)</button>
                            <button class="btn-preset-pill" onclick="setA1c(6.0)">🟡 Prediabetes (5.7-6.4%)</button>
                            <button class="btn-preset-pill" onclick="setA1c(8.5)">🔴 High Risk (8.5%+)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Results Card --}}
        <div class="col-lg-12">
            <div class="output-card-themed" id="a1c-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="hero-converter-badge">
                            <span class="hero-label" id="res-label">Estimated Glucose</span>
                            <h2 class="hero-value" id="final-res">154</h2>
                            <div class="hero-unit-tag" id="final-unit">mg/dL</div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="diagnosis-spectrum-card">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Glycemic Status (ADA)</span>
                                <span class="badge rounded-pill px-3 py-1" id="status-pill" style="background:#fee2e2; color:#991b1b;">High Risk</span>
                            </div>
                            <div class="progress-container-pro">
                                <div id="status-ptr" class="status-pointer"></div>
                                <div class="progress-bar-pro" style="width: 100%; height: 10px; border-radius: 20px; display: flex; overflow: hidden; background: #f1f5f9;">
                                    <div style="width: 40%; background: #22c55e;"></div>
                                    <div style="width: 25%; background: #eab308;"></div>
                                    <div style="width: 35%; background: #ef4444;"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 x-small text-muted fw-bold px-1">
                                    <span>NORMAL</span>
                                    <span>PRE-DIABETIC</span>
                                    <span>DIABETIC</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 row g-3">
                            <div class="col-6 col-md-4">
                                <div class="mini-stat-card">
                                    <span class="ms-label">A1c Equivalent</span>
                                    <span class="ms-value" id="stat-a1c">7.0%</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mini-stat-card">
                                    <span class="ms-label">eAG (mg/dL)</span>
                                    <span class="ms-value" id="stat-mg">154</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mini-stat-card">
                                    <span class="ms-label">eAG (mmol/L)</span>
                                    <span class="ms-value" id="stat-mmol">8.6</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div id="result-insights" class="insights-container-soft">
                            <h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2 text-primary"></i> Medical Interpretation</h6>
                            <div id="a1c-interpretation" class="small text-muted">
                                Enter your data to view clinical observations and estimated average glucose readings.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <button class="btn-action-dark w-100" onclick="copyReport()" id="copy-btn" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Glycemic Conversion Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.a1c-converter-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

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

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; transition: 0.2s; }
.input-group-custom:focus-within { border-color: #ef4444; box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1); background: #fff; }

.form-control-custom { 
    background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; 
}
.form-select-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.form-select-custom:focus { border-color: #ef4444; }

.select-addon { background: #f1f5f9; border: none; border-left: 1.5px solid #e2e8f0; padding: 0 1rem; font-weight: 700; cursor: pointer; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { background: #ef4444; border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-calculate-pro:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(239, 68, 68, 0.2); }

.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; }
.btn-preset-pill:hover { border-color: #ef4444; color: #ef4444; background: #fff5f5; }

/* Output Card */
.output-card-themed {
    background: #ffffff;
    border-radius: 32px;
    padding: 3rem;
    border: 1px solid rgba(0,0,0,0.06);
    box-shadow: 0 25px 70px rgba(0,0,0,0.06);
    margin-top: 2rem;
}

.hero-converter-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 6rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-unit-tag { font-size: 1.25rem; font-weight: 700; color: #64748b; }

.progress-container-pro { position: relative; padding-top: 15px; }
.status-pointer { 
    position: absolute; top: -5px; left: 50%; width: 14px; height: 14px; background: #1e293b; border-radius: 50%; border: 3px solid #fff; z-index: 10; 
    transition: left 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.mini-stat-card { background: #f8fafc; padding: 1.25rem; border-radius: 20px; text-align: center; border: 1px solid rgba(0,0,0,0.03); }
.ms-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.ms-value { font-size: 1.2rem; font-weight: 800; color: #1e293b; }

.insights-container-soft { background: #f8fafc; padding: 1.75rem; border-radius: 20px; border: 1px solid rgba(0,0,0,0.02); margin-top: 1.5rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.x-small { font-size: 0.65rem; }
</style>

<script>
function calculateA1C() {
    const mode = document.getElementById('calc_mode').value;
    const input = parseFloat(document.getElementById('main_input_val').value) || 0;
    const unit = document.getElementById('glucose_unit').value;

    let a1c = 0;
    let eagMg = 0;
    let eagMmol = 0;

    if (mode === 'a1c_to_eag') {
        a1c = input;
        eagMg = 28.7 * a1c - 46.7;
        eagMmol = eagMg / 18.0182;

        document.getElementById('res-label').innerText = "Estimated Glucose";
        document.getElementById('final-res').innerText = Math.round(eagMg).toString();
        document.getElementById('final-unit').innerText = "mg/dL";
    } else {
        const valMg = unit === 'mmoll' ? input * 18.0182 : input;
        a1c = (valMg + 46.7) / 28.7;
        eagMg = valMg;
        eagMmol = eagMg / 18.0182;

        document.getElementById('res-label').innerText = "HbA1c Equivalent";
        document.getElementById('final-res').innerText = a1c.toFixed(1);
        document.getElementById('final-unit').innerText = "Percentage (%)";
    }

    // Update Stats
    document.getElementById('stat-a1c').innerText = a1c.toFixed(1) + "%";
    document.getElementById('stat-mg').innerText = Math.round(eagMg).toString();
    document.getElementById('stat-mmol').innerText = eagMmol.toFixed(1);

    // Status logic
    let risk = "Normal";
    let color = "#16a34a";
    let bg = "#f0fdf4";
    let ptrPos = 20;
    let interpretation = "";

    if (a1c >= 6.5) {
        risk = "Diabetic Range";
        color = "#dc2626";
        bg = "#fef2f2";
        ptrPos = 85;
        interpretation = "The American Diabetes Association (ADA) categorizes an A1c above 6.5% as being within the diabetic range. Consult a healthcare professional for clinical confirmation.";
    } else if (a1c >= 5.7) {
        risk = "Prediabetes";
        color = "#ca8a04";
        bg = "#fefce8";
        ptrPos = 52;
        interpretation = "An A1c between 5.7% and 6.4% indicates prediabetes. Lifestyle changes such as diet and exercise can significantly reduce the risk of progressing to Type 2 diabetes.";
    } else {
        risk = "Normal Range";
        color = "#16a34a";
        bg = "#f0fdf4";
        ptrPos = 18;
        interpretation = "An A1c below 5.7% is considered normal. This indicates an average blood glucose level within the healthy physiological range over the past 90 days.";
    }

    const pill = document.getElementById('status-pill');
    pill.innerText = risk;
    pill.style.background = bg;
    pill.style.color = color;
    document.getElementById('status-ptr').style.left = ptrPos + "%";
    document.getElementById('a1c-interpretation').innerText = interpretation;
}

function setA1c(val) {
    document.getElementById('calc_mode').value = 'a1c_to_eag';
    document.getElementById('calc_mode').dispatchEvent(new Event('change'));
    document.getElementById('main_input_val').value = val;
    calculateA1C();
}

function resetA1C() {
    document.getElementById('calc_mode').value = 'a1c_to_eag';
    document.getElementById('calc_mode').dispatchEvent(new Event('change'));
    document.getElementById('main_input_val').value = 7.0;
    calculateA1C();
}

function copyReport() {
    const a1c = document.getElementById('stat-a1c').innerText;
    const mg = document.getElementById('stat-mg').innerText;
    const mmol = document.getElementById('stat-mmol').innerText;
    const risk = document.getElementById('status-pill').innerText;
    const text = `HbA1c & eAG Analysis Report\n━━━━━━━━━━━━━━━━━━━━━━\nHbA1c: ${a1c}\neAG (mg/dL): ${mg}\neAG (mmol/L): ${mmol}\nStatus: ${risk}\n\nGenerated by ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check me-2"></i> Report Copied to Clipboard';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Glycemic Conversion Report', 2000);
    });
}

// UI Triggers
document.getElementById('calc_mode').addEventListener('change', function() {
    const mode = this.value;
    if (mode === 'a1c_to_eag') {
        document.getElementById('main-input-label').innerText = "HbA1c Percentage (%)";
        document.getElementById('glucose_unit').classList.add('d-none');
        document.getElementById('unit-tag').classList.remove('d-none');
        document.getElementById('main_input_val').value = 7.0;
    } else {
        document.getElementById('main-input-label').innerText = "Average Glucose (eAG)";
        document.getElementById('glucose_unit').classList.remove('d-none');
        document.getElementById('unit-tag').classList.add('d-none');
        document.getElementById('main_input_val').value = 154;
    }
    calculateA1C();
});

document.getElementById('main_input_val').addEventListener('input', calculateA1C);
document.getElementById('glucose_unit').addEventListener('change', calculateA1C);

document.addEventListener('DOMContentLoaded', calculateA1C);
</script>
