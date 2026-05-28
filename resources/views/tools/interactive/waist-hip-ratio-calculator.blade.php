<div class="container-fluid whr-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(239, 68, 68, 0.1); color:#ef4444;">
                        <i class="fas fa-ruler-horizontal"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Waist-to-Hip Ratio (WHR) Analyzer</h3>
                        <p class="tool-subtitle">Clinical assessment of abdominal fat distribution and metabolic health risks based on WHO standards.</p>
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
                            <label class="form-label-custom">Waist Circumference (<span class="unit-label">cm</span>)</label>
                            <input type="number" class="form-control-custom" id="waist_measure" value="90" step="0.1">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Hip Circumference (<span class="unit-label">cm</span>)</label>
                            <input type="number" id="hip_measure" class="form-control-custom" value="100" step="0.1">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">System</label>
                            <select class="form-select-custom" id="unit_system">
                                <option value="metric">Metric (cm)</option>
                                <option value="imperial">Imperial (in)</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="btn-calculate-pro flex-grow-1" onclick="calculateWHR()">
                                    <i class="fas fa-chart-pie me-2"></i> Analyze Health Metrics
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetWHR()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Action Presets --}}
                    <div class="mt-4 pt-3 border-top">
                        <span class="fw-bold small text-muted me-2 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Presets:</span>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn-preset-pill" onclick="setWHR(90, 100, 'male')">👨 Avg Male</button>
                            <button class="btn-preset-pill" onclick="setWHR(80, 100, 'female')">👩 Avg Female</button>
                            <button class="btn-preset-pill" onclick="setWHR(105, 100, 'male')">⚠️ At Risk (Male)</button>
                            <button class="btn-preset-pill" onclick="setWHR(92, 102, 'female')">⚠️ At Risk (Female)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Results Card --}}
        <div class="col-lg-12">
            <div class="output-card-themed" id="whr-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="hero-score-badge">
                            <span class="hero-label">Your WHR Ratio</span>
                            <h2 class="hero-value" id="final-ratio">0.90</h2>
                            <span class="hero-tagline" id="risk-category">Moderate Risk</span>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="risk-visualizer-container">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">WHO Risk Spectrum</span>
                                <span class="small text-muted" id="who-standard">Target: < 0.90</span>
                            </div>
                            <div class="progress-container-pro">
                                <div id="risk-pointer" class="risk-pointer-pulse"></div>
                                <div class="progress-bar-pro" style="width: 100%; height: 12px; border-radius: 20px; display: flex; overflow: hidden; background: #f1f5f9;">
                                    <div style="width: 33%; background: #22c55e;"></div>
                                    <div style="width: 33%; background: #eab308;"></div>
                                    <div style="width: 34%; background: #ef4444;"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 x-small text-muted fw-bold px-1">
                                    <span>LOW RISK</span>
                                    <span>MODERATE</span>
                                    <span>HIGH RISK</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 row g-3">
                            <div class="col-6 col-md-4 item-stat-card">
                                <div class="stat-value" id="diff-target">0.00</div>
                                <div class="stat-label">From Target</div>
                            </div>
                            <div class="col-6 col-md-4 item-stat-card">
                                <div class="stat-value text-primary" id="waist-status">Optimal</div>
                                <div class="stat-label">Waist Profile</div>
                            </div>
                            <div class="col-12 col-md-4 item-stat-card">
                                <div class="stat-value text-success" id="mortality-impact">Normal</div>
                                <div class="stat-label">Morbidity Risk</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container text-start">
                            <h5 class="insight-title"><i class="fas fa-microscope me-2"></i> Clinical Insights & Analysis</h5>
                            <div id="whr-insights" class="insight-content">
                                Enter your measurements above to generate an abdominal fat distribution report.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn-action-dark w-100" id="copy-report" onclick="copyResult()">
                                    <i class="fas fa-copy me-2 text-info"></i> Copy Health Report
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn-action-outline w-100" onclick="shareResults()">
                                    <i class="fas fa-share-nodes me-2"></i> Share Summary
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.whr-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium {
    background: #ffffff;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
}

.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2.5rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
.tool-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem; }
.tool-subtitle { color: #64748b; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.75rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }
.form-control-custom, .form-select-custom { 
    background: #f8fafc; 
    border: 1px solid #e2e8f0; 
    border-radius: 12px; 
    padding: 0.85rem 1rem; 
    font-weight: 500; 
    transition: all 0.2s; 
    width: 100%; 
}
.form-control-custom:focus { outline: none; border-color: #ef4444; box-shadow: 0 0 0 4px rgba(239,68,68,0.1); }

.btn-toggle-custom { 
    background: #f8fafc; 
    border: 1px solid #e2e8f0; 
    padding: 0.85rem 1rem; 
    border-radius: 12px; 
    font-weight: 700; 
    cursor: pointer; 
    transition: all 0.2s; 
}
.btn-toggle-custom.active { background: #1e293b; color: white; border-color: #1e293b; }

.btn-calculate-pro { 
    background: #ef4444; 
    color: white; 
    border: none; 
    padding: 1.1rem 2rem; 
    border-radius: 14px; 
    font-weight: 800; 
    font-size: 1rem; 
    cursor: pointer; 
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
}
.btn-calculate-pro:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(239,68,68,0.2); }

.btn-reset-pro { background: #f1f5f9; color: #64748b; border: none; width: 56px; height: 56px; border-radius: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.2s; }
.btn-reset-pro:hover { background: #e2e8f0; color: #1e293b; }

.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.5rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; color: #475569; }
.btn-preset-pill:hover { border-color: #ef4444; color: #ef4444; background: #fff5f5; }

/* Output Section */
.output-card-themed {
    background: #ffffff;
    border-radius: 28px;
    padding: 3rem;
    margin-top: 2rem;
    border: 1px solid rgba(0,0,0,0.08);
    box-shadow: 0 20px 50px rgba(0,0,0,0.05);
}

.hero-score-badge { display: flex; flex-direction: column; align-items: center; justify-content: center; }
.hero-label { font-size: 0.9rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1.5px; color: #64748b; }
.hero-value { font-size: 5.5rem; font-weight: 900; margin: 0.5rem 0; letter-spacing: -3px; color: #1e293b; line-height: 1; }
.hero-tagline { font-size: 1.125rem; font-weight: 700; color: #22c55e; }

.progress-container-pro { position: relative; padding-top: 15px; }
.risk-pointer-pulse { 
    position: absolute; 
    top: -5px; 
    left: 50%; 
    width: 20px; 
    height: 20px; 
    background: #1e293b; 
    border-radius: 50%; 
    border: 4px solid #fff; 
    box-shadow: 0 4px 10px rgba(0,0,0,0.2); 
    z-index: 10; 
    transition: left 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.item-stat-card {
    background: #f8fafc;
    border: 1px solid rgba(0,0,0,0.04);
    border-radius: 18px;
    padding: 1.5rem 1rem;
    text-align: center;
}
.stat-value { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 0.25rem; }
.stat-label { font-size: 0.7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; }

.insights-container { 
    background: #f8fafc; 
    border-radius: 24px; 
    padding: 2rem; 
    border: 1px solid rgba(0,0,0,0.04); 
    margin-top: 1.5rem;
}
.insight-title { font-size: 1.1rem; font-weight: 800; color: #1e293b; margin-bottom: 1rem; }
.insight-content { color: #475569; line-height: 1.7; font-size: 0.95rem; }

.btn-action-dark { background: #1e293b; color: white; border: none; padding: 1.1rem; border-radius: 14px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-action-outline { background: white; color: #1e293b; border: 2px solid #e2e8f0; padding: calc(1.1rem - 2px); border-radius: 14px; font-weight: 700; cursor: pointer; transition: 0.2s; }

.x-small { font-size: 0.65rem; }
</style>

<script>
function calculateWHR() {
    const gender = document.querySelector('[data-id="gender"].active').dataset.value;
    const waist = parseFloat(document.getElementById('waist_measure').value) || 0;
    const hip = parseFloat(document.getElementById('hip_measure').value) || 0;
    const system = document.getElementById('unit_system').value;

    if (waist <= 0 || hip <= 0) return;

    const whr = waist / hip;
    const resultEl = document.getElementById('final-ratio');
    resultEl.innerText = whr.toFixed(2);

    let risk = "Low Risk";
    let color = "#22c55e";
    let ptrPos = 15;
    let mortality = "Normal";

    if (gender === 'male') {
        document.getElementById('who-standard').innerText = "WHO Target: < 0.90";
        if (whr >= 1.0) { risk = "High Health Risk"; color = "#ef4444"; ptrPos = 85; mortality = "Increased"; }
        else if (whr >= 0.9) { risk = "Moderate Health Risk"; color = "#eab308"; ptrPos = 50; mortality = "Borderline"; }
        else { risk = "Low Health Risk"; color = "#22c55e"; ptrPos = 15; mortality = "Normal"; }
    } else {
        document.getElementById('who-standard').innerText = "WHO Target: < 0.85";
        if (whr >= 0.86) { risk = "High Health Risk"; color = "#ef4444"; ptrPos = 85; mortality = "Increased"; }
        else if (whr >= 0.81) { risk = "Moderate Health Risk"; color = "#eab308"; ptrPos = 50; mortality = "Borderline"; }
        else { risk = "Low Health Risk"; color = "#22c55e"; ptrPos = 15; mortality = "Normal"; }
    }

    const tagEl = document.getElementById('risk-category');
    tagEl.innerText = risk;
    tagEl.style.color = color;
    resultEl.style.color = color;
    document.getElementById('risk-pointer').style.left = ptrPos + "%";

    const diff = (whr - (gender === 'male' ? 0.90 : 0.85)).toFixed(2);
    document.getElementById('diff-target').innerText = (diff > 0 ? "+" : "") + diff;
    document.getElementById('waist-status').innerText = whr > 1.0 ? "Heavy" : "Normal";
    document.getElementById('waist-status').style.color = whr > 1.0 ? "#ef4444" : "#22c55e";
    document.getElementById('mortality-impact').innerText = mortality;
    document.getElementById('mortality-impact').style.color = color;

    // Insights
    let insights = `
        <ul class="list-unstyled mb-0">
            <li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success mt-1 me-2"></i> <span>A ratio of <strong>${whr.toFixed(2)}</strong> indicates your body stores fat ${whr > (gender==='male'?0.9:0.85) ? 'centrally (Android fat distribution)' : 'peripherally'}.</span></li>
            <li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success mt-1 me-2"></i> <span>According to the <strong>WHO</strong>, central obesity is linked to a higher risk of metabolic syndrome and cardiovascular disease.</span></li>
            <li class="d-flex align-items-start"><i class="fas fa-check-circle text-success mt-1 me-2"></i> <span>Recommendation: ${whr > (gender==='male'?0.9:0.85) ? 'Focus on cardiovascular exercise and caloric balance to reduce visceral fat.' : 'Continue maintaining a balanced fat distribution for optimal metabolic health.'}</span></li>
        </ul>
    `;
    document.getElementById('whr-insights').innerHTML = insights;
}

function setWHR(w, h, g) {
    document.getElementById('waist_measure').value = w;
    document.getElementById('hip_measure').value = h;
    document.querySelectorAll('[data-id="gender"]').forEach(b => {
        b.classList.remove('active');
        if(b.dataset.value === g) b.classList.add('active');
    });
    calculateWHR();
}

function resetWHR() {
    document.getElementById('waist_measure').value = 90;
    document.getElementById('hip_measure').value = 100;
    calculateWHR();
}

function copyResult() {
    const ratio = document.getElementById('final-ratio').innerText;
    const cat = document.getElementById('risk-category').innerText;
    const text = `Waist-to-Hip Ratio Analysis\n━━━━━━━━━━━━━━━━━━━━━━\nRatio Score: ${ratio}\nRisk Category: ${cat}\nAnalysis by ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-report');
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = orig, 2000);
    });
}

function shareResults() {
    if (navigator.share) {
        navigator.share({
            title: 'WHR Analysis',
            text: `My Waist-to-Hip ratio is ${document.getElementById('final-ratio').innerText}. Check yours on ToolsHub!`,
            url: window.location.href
        });
    }
}

// Event Listeners for toggle buttons
document.querySelectorAll('.btn-toggle-custom').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll(`[data-id="${this.dataset.id}"]`).forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        calculateWHR();
    });
});

document.getElementById('waist_measure').addEventListener('input', calculateWHR);
document.getElementById('hip_measure').addEventListener('input', calculateWHR);
document.getElementById('unit_system').addEventListener('change', function() {
    const u = this.value;
    document.querySelectorAll('.unit-label').forEach(e => e.innerText = u === 'metric' ? 'cm' : 'in');
    calculateWHR();
});

document.addEventListener('DOMContentLoaded', calculateWHR);
</script>
