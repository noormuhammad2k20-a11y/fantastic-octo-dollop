<div class="container-fluid thr-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(239, 68, 68, 0.1); color:#ef4444;">
                        <i class="fas fa-heart-pulse"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Cardio Intensity Optimizer</h3>
                        <p class="tool-subtitle">Precision calculation of target heart rate (THR) zones using the Karvonen method to maximize metabolic efficiency.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Current Age</label>
                            <div class="input-group-custom">
                                <input type="number" id="age" class="form-control-custom" value="30" min="10" max="100">
                                <span class="input-addon">Years</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Resting HR (RHR)</label>
                            <div class="input-group-custom">
                                <input type="number" id="rhr" class="form-control-custom" value="65" min="30" max="120">
                                <span class="input-addon">BPM</span>
                            </div>
                            <span class="text-muted tiny mt-1">Check upon waking for accuracy</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Primary Training Goal</label>
                            <select id="thr_goal" class="form-select-custom">
                                <option value="fat_burn">Fat Burn (50-60%)</option>
                                <option value="aerobic" selected>Aerobic / Base (60-70%)</option>
                                <option value="threshold">Lactate Threshold (70-85%)</option>
                                <option value="anaerobic">Anaerobic / VO2 Max (85-95%)</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#ef4444;" onclick="calculateTHR()">
                                    <i class="fas fa-gauge-high me-2"></i> Calibrate Training Zones
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetTHR()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-4 pt-3 border-top">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-warning me-1"></i>Quick Adjust Intensity:</span>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn-preset-pill" onclick="setIntensity(55)">🚶 Warm-up</button>
                            <button class="btn-preset-pill" onclick="setIntensity(75)">🏃 Tempo</button>
                            <button class="btn-preset-pill" onclick="setIntensity(90)">🚴 Sprint</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="output-card-themed" id="thr-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-thr-badge">
                            <span class="hero-label">Target Zone</span>
                            <h2 class="hero-value" id="final-thr" style="font-size:4rem; letter-spacing: -2px; line-height: 1.1;">140 - 155</h2>
                            <div class="hero-unit-tag">BPM</div>
                            <div class="hero-status-pill mt-3" id="thr-status">Aerobic Development</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="intensity-viz">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Heart Rate Reserve (%)</span>
                                <span class="small fw-bold text-danger" id="intensity-val">Intensity: 70%</span>
                            </div>
                            <div class="intensity-bar">
                                <div id="thr-indicator" class="intensity-indicator"></div>
                                <div class="intensity-segments">
                                    <div class="t-seg t-recovery"></div>
                                    <div class="t-seg t-fatburn"></div>
                                    <div class="t-seg t-aerobic"></div>
                                    <div class="t-seg t-threshold"></div>
                                    <div class="t-seg t-max"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted fw-bold ls-1">
                                <span>RHR</span><span>60%</span><span>80%</span><span>Max</span>
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-6">
                                <div class="stat-mini-card">
                                    <span class="sm-label">Calculated Max HR</span>
                                    <span class="sm-value" id="max-hr">190 BPM</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-mini-card">
                                    <span class="sm-label">HR Reserve (HRR)</span>
                                    <span class="sm-value" id="hr-reserve">125 BPM</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="zone-breakdown-grid rounded-4 bg-light p-4">
                            <h6 class="fw-bold mb-3 small uppercase ls-1 text-dark"><i class="fas fa-list-check me-2 text-primary"></i> Complete Zone Profile</h6>
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm small mb-0 align-middle">
                                    <thead><tr class="tiny text-muted uppercase ls-1"><th>Zone</th><th>Intensity</th><th>Range</th><th>Effect</th></tr></thead>
                                    <tbody id="zone-table-body"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyTHRReport()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Heart Rate Zones
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="alert-safety mt-4 p-4 rounded-4 text-center">
                <p class="mb-0 small text-danger fw-bold"><i class="fas fa-triangle-exclamation me-2"></i><strong>Safety Note:</strong> Always consult a physician before starting a high-intensity exercise program, especially if you have history of cardiac issues.</p>
            </div>
        </div>
    </div>
</div>

<style>
.thr-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.form-select-custom, .form-control-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; }
.btn-preset-pill:hover { background: #fee2e2; border-color: #ef4444; color: #ef4444; }

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-value { font-size: 4rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -2px; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; }

.intensity-bar { height: 12px; border-radius: 10px; position: relative; margin: 1.5rem 0; background: #f1f5f9; }
.intensity-segments { position: absolute; width: 100%; height: 100%; display: flex; border-radius: 10px; overflow: hidden; opacity: 0.3; }
.t-seg { height: 100%; }
.t-recovery { width: 10%; background: #94a3b8; }
.t-fatburn { width: 20%; background: #10b981; }
.t-aerobic { width: 25%; background: #3b82f6; }
.t-threshold { width: 25%; background: #f97316; }
.t-max { width: 20%; background: #ef4444; }

.intensity-indicator { position: absolute; top: -8px; width: 4px; height: 28px; background: #ef4444; border-radius: 10px; z-index: 2; border: 2px solid white; transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.stat-mini-card { background: #fcfcfc; padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.02); }
.sm-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.sm-value { font-size: 1.1rem; font-weight: 800; color: #1e293b; }

.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.alert-safety { background: #fef2f2; border: 1px solid #fee2e2; }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.tiny { font-size: 0.7rem; }
</style>

<script>
function calculateTHR() {
    const age = parseInt(document.getElementById('age').value) || 30;
    const rhr = parseInt(document.getElementById('rhr').value) || 60;
    const goal = document.getElementById('thr_goal').value;

    const maxHR = 220 - age;
    const hrr = maxHR - rhr;
    
    document.getElementById('max-hr').innerText = maxHR + " BPM";
    document.getElementById('hr-reserve').innerText = hrr + " BPM";

    // Standard zones based on goal
    let lowerPct, upperPct;
    switch(goal) {
        case 'fat_burn': lowerPct = 0.50; upperPct = 0.60; break;
        case 'threshold': lowerPct = 0.70; upperPct = 0.85; break;
        case 'anaerobic': lowerPct = 0.85; upperPct = 0.95; break;
        default: lowerPct = 0.60; upperPct = 0.70; // Aerobic
    }

    const tLower = Math.round((hrr * lowerPct) + rhr);
    const tUpper = Math.round((hrr * upperPct) + rhr);

    document.getElementById('final-thr').innerText = `${tLower} - ${tUpper}`;
    
    // UI Update
    updateTHRUI(lowerPct, upperPct, hrr, rhr, age);
}

function updateTHRUI(l, u, hrr, rhr, age) {
    const avgInt = Math.round((l + u) / 2 * 100);
    document.getElementById('intensity-val').innerText = `Intensity: ${avgInt}%`;
    document.getElementById('thr-indicator').style.left = avgInt + "%";

    let label = "Aerobic Base";
    let clr = "#3b82f6";
    if (avgInt < 55) { label = "Recovery"; clr = "#94a3b8"; }
    else if (avgInt < 65) { label = "Fat Burning"; clr = "#10b981"; }
    else if (avgInt > 85) { label = "Max Effort"; clr = "#ef4444"; }
    else if (avgInt > 75) { label = "Lactate Threshold"; clr = "#f97316"; }

    const pill = document.getElementById('thr-status');
    pill.innerText = label;
    pill.style.background = clr + "15";
    pill.style.color = clr;
    pill.style.border = "1.5px solid " + clr + "30";

    // Table
    const zones = [
        { name: 'Recovery', i: '50-60%', eff: 'Health/Recovery', range: [0.5, 0.6] },
        { name: 'Fat Burn', i: '60-70%', eff: 'Weight Control', range: [0.6, 0.7] },
        { name: 'Aerobic', i: '70-80%', eff: 'Endurance', range: [0.7, 0.8] },
        { name: 'Anaerobic', i: '80-90%', eff: 'Conditioning', range: [0.8, 0.9] },
        { name: 'Red Line', i: '90-100%', eff: 'Speed / VO2', range: [0.9, 1.0] }
    ];

    document.getElementById('zone-table-body').innerHTML = zones.map(z => {
        const lb = Math.round((hrr * z.range[0]) + rhr);
        const ub = Math.round((hrr * z.range[1]) + rhr);
        const active = (l >= z.range[0] && l < z.range[1]);
        return `
            <tr style="${active ? 'background:rgba(0,0,0,0.02);' : ''}">
                <td class="fw-bold ${active ? 'text-danger' : 'text-muted'}">${z.name}</td>
                <td>${z.i}</td>
                <td class="fw-bold">${lb}-${ub} <span class="tiny text-muted">BPM</span></td>
                <td class="tiny">${z.eff}</td>
            </tr>
        `;
    }).join('');
}

function setIntensity(pct) {
    const age = parseInt(document.getElementById('age').value) || 30;
    const rhr = parseInt(document.getElementById('rhr').value) || 60;
    const hrr = (220 - age) - rhr;
    
    const l = pct / 100;
    const u = (pct + 10) / 100;
    
    document.getElementById('final-thr').innerText = `${Math.round(hrr * l + rhr)} - ${Math.round(hrr * u + rhr)}`;
    updateTHRUI(l, u, hrr, rhr, age);
}

function resetTHR() {
    document.getElementById('age').value = 30;
    document.getElementById('rhr').value = 65;
    calculateTHR();
}

function copyTHRReport() {
    const thr = document.getElementById('final-thr').innerText;
    const status = document.getElementById('thr-status').innerText;
    const max = document.getElementById('max-hr').innerText;
    const text = `Cardio Zone Optimization Report\n━━━━━━━━━━━━━━━━━━━━━━\nTarget Range: ${thr} BPM\nPhase: ${status}\nBiological Max: ${max}\n\nOptimized via ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Zones Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Heart Rate Zones', 2000);
    });
}

// UI Triggers
['age', 'rhr', 'thr_goal'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateTHR);
});

document.addEventListener('DOMContentLoaded', calculateTHR);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\target-heart-rate-calculator.blade.php ENDPATH**/ ?>