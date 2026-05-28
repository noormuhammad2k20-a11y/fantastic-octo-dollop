<div class="container-fluid bf-navy-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(30, 58, 138, 0.1); color:#1e3a8a;">
                        <i class="fas fa-anchor"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">U.S. Navy Body Fat Calculator</h3>
                        <p class="tool-subtitle">Official DoD tape-measure method used by the Navy, Army, and Marines to assess body composition compliance.</p>
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
                            <select id="nbf-units" class="form-select-custom">
                                <option value="metric" selected>Metric (cm)</option>
                                <option value="imperial">Imperial (in)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Height</label>
                            <div class="input-group-custom">
                                <input type="number" id="nbf-height" class="form-control-custom" value="180" step="0.1">
                                <span class="input-addon unit-label">cm</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Neck Circ.</label>
                            <div class="input-group-custom">
                                <input type="number" id="nbf-neck" class="form-control-custom" value="40" step="0.1">
                                <span class="input-addon unit-label">cm</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Waist Circ.</label>
                            <div class="input-group-custom">
                                <input type="number" id="nbf-waist" class="form-control-custom" value="90" step="0.1">
                                <span class="input-addon unit-label">cm</span>
                            </div>
                        </div>
                        <div class="col-md-6" id="nbf-hip-row" style="display:none;">
                            <label class="form-label-custom">Hip Circ. (Female Only)</label>
                            <div class="input-group-custom">
                                <input type="number" id="nbf-hips" class="form-control-custom" value="100" step="0.1">
                                <span class="input-addon unit-label">cm</span>
                            </div>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#1e3a8a;" onclick="calculateNavyBF()">
                                    <i class="fas fa-certificate me-2"></i> Verify Compliance Status
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetNavyBF()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Action Presets --}}
                    <div class="mt-4 pt-3 border-top">
                        <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-warning me-1"></i>Official Benchmarks:</span>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <button class="btn-preset-pill" onclick="setNavyPreset(180, 40, 90, 0, 'male')">⚓ Male Standard</button>
                            <button class="btn-preset-pill" onclick="setNavyPreset(165, 35, 75, 100, 'female')">⚓ Female Standard</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Results Card --}}
        <div class="col-lg-12">
            <div class="output-card-themed" id="nbf-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-bf-badge">
                            <span class="hero-label">Navy Body Fat</span>
                            <h2 class="hero-value" id="final-bf">18.2</h2>
                            <div class="hero-unit-tag">%</div>
                            <div class="hero-status-pill mt-3" id="nbf-status">Satisfactory</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="navy-spectrum-container">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Compliance Spectrum</span>
                                <span class="small fw-bold text-success" id="compliance-text">PASS</span>
                            </div>
                            <div class="spectrum-bar">
                                <div id="nbf-indicator" class="spectrum-indicator"></div>
                                <div class="spectrum-segments">
                                    <div class="seg seg-essential"></div>
                                    <div class="seg seg-fitness"></div>
                                    <div class="seg seg-acceptable"></div>
                                    <div class="seg seg-over"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted fw-bold ls-1">
                                <span>6%</span><span>18%</span><span>25%</span><span>30%+</span>
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Lean Body Mass</span><span class="sm-value" id="nbf-lbm">73.6 kg</span></div></div>
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Fat Mass</span><span class="sm-value" id="nbf-fat-mass">16.4 kg</span></div></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2 small uppercase ls-1"><i class="fas fa-shield-halved me-2 text-primary"></i> Readiness Assessment</h6>
                            <div id="nbf-insights" class="small text-muted">
                                Calculations compliant with OPNAVINST 6110.1J criteria for active duty personnel.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyNavyReport()">
                                    <i class="fas fa-copy me-2 text-info"></i> Copy Military Report
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto -action-outline py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="shareNavy()">
                                    <i class="fas fa-share-nodes me-2"></i> Share Progress
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
.bf-navy-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.btn-toggle-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; padding: 0.85rem 1rem; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s; color: #64748b; }
.btn-toggle-custom.active { background: #1e293b; color: white; border-color: #1e293b; }

.form-select-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; }
.btn-preset-pill:hover { border-color: #1e3a8a; color: #1e3a8a; background: #eff6ff; }

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-bf-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 6rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-unit-tag { font-size: 1.5rem; font-weight: 800; color: #1e3a8a; letter-spacing: 2px; }

.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.spectrum-bar { height: 12px; border-radius: 10px; position: relative; margin: 1.5rem 0; background: #f1f5f9; }
.spectrum-segments { position: absolute; width: 100%; height: 100%; display: flex; border-radius: 10px; overflow: hidden; opacity: 0.4; }
.seg { height: 100%; }
.seg-essential { width: 25%; background: #3b82f6; }
.seg-fitness { width: 35%; background: #10b981; }
.seg-acceptable { width: 20%; background: #fbbf24; }
.seg-over { width: 20%; background: #ef4444; }

.spectrum-indicator { position: absolute; top: -8px; width: 4px; height: 28px; background: #1e293b; border-radius: 10px; z-index: 2; border: 2px solid white; transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.stat-mini-card { background: #f8fafc; padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.02); }
.sm-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.sm-value { font-size: 1.1rem; font-weight: 800; color: #1e293b; }

.insights-container-soft { background: #fcfcfc; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 1.5rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }
.btn-action-outline { background: transparent; border: 2px solid #e2e8f0; color: #1e293b; padding: calc(1.1rem - 2px); border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.tiny { font-size: 0.7rem; }
</style>

<script>
const n_categories = [
    { name: 'Essential', m: 6, f: 14, clr: '#3b82f6', pos: 12 },
    { name: 'Fitness', m: 18, f: 25, clr: '#10b981', pos: 42 },
    { name: 'Acceptable', m: 25, f: 32, clr: '#fbbf24', pos: 72 },
    { name: 'Over Limit', m: 99, f: 99, clr: '#ef4444', pos: 92 }
];

function calculateNavyBF() {
    const gender = document.querySelector('[data-id="gender"].active').dataset.value;
    const units = document.getElementById('nbf-units').value;
    
    let height = parseFloat(document.getElementById('nbf-height').value) || 0;
    let neck = parseFloat(document.getElementById('nbf-neck').value) || 0;
    let waist = parseFloat(document.getElementById('nbf-waist').value) || 0;
    let hips = parseFloat(document.getElementById('nbf-hips').value) || 0;

    if (height <= 0 || neck <= 0 || waist <= 0) return;

    let h_cm = units === 'imperial' ? height * 2.54 : height;
    let n_cm = units === 'imperial' ? neck * 2.54 : neck;
    let w_cm = units === 'imperial' ? waist * 2.54 : waist;
    let hip_cm = units === 'imperial' ? hips * 2.54 : hips;

    let bf;
    if (gender === 'male') {
        bf = 495 / (1.0324 - 0.19077 * Math.log10(w_cm - n_cm) + 0.15456 * Math.log10(h_cm)) - 450;
    } else {
        bf = 495 / (1.29579 - 0.35004 * Math.log10(w_cm + hip_cm - n_cm) + 0.22100 * Math.log10(h_cm)) - 450;
    }

    if (isNaN(bf) || bf < 0) bf = 2.0;
    bf = Math.max(2, Math.min(60, bf));

    displayNavyBF(bf, gender);
}

function displayNavyBF(bf, gender) {
    document.getElementById('final-bf').innerText = bf.toFixed(1);
    
    let cat = "Over Limit";
    let clr = "#ef4444";
    let pos = 92;

    for (let c of n_categories) {
        let threshold = gender === 'male' ? c.m : c.f;
        if (bf < threshold) {
            cat = c.name;
            clr = c.clr;
            pos = c.pos;
            break;
        }
    }

    const statPill = document.getElementById('nbf-status');
    statPill.innerText = cat;
    statPill.style.background = clr + "15";
    statPill.style.color = clr;
    statPill.style.border = "1.5px solid " + clr + "30";

    const comp = (gender === 'male' && bf < 26) || (gender === 'female' && bf < 33) ? "PASS" : "FAIL";

    document.getElementById('compliance-text').innerText = comp;
    document.getElementById('compliance-text').style.color = comp === "PASS" ? "#10b981" : "#ef4444";
    document.getElementById('nbf-indicator').style.left = pos + "%";
    document.getElementById('nbf-indicator').style.background = clr;

    const insights = comp === "PASS" 
        ? `Compliance check successful. Your body composition meets the standard for active duty personnel.`
        : `Reading exceeds standard limits. Consider lifestyle adjustments or official medical re-evaluation.`;
    document.getElementById('nbf-insights').innerText = insights;
}

function setNavyPreset(h, n, w, hi, g) {
    document.getElementById('nbf-units').value = 'metric';
    document.getElementById('nbf-height').value = h;
    document.getElementById('nbf-neck').value = n;
    document.getElementById('nbf-waist').value = w;
    document.getElementById('nbf-hips').value = hi;
    
    document.querySelectorAll('[data-id="gender"]').forEach(b => {
        b.classList.remove('active');
        if(b.dataset.value === g) b.classList.add('active');
    });
    
    document.getElementById('nbf-hip-row').style.display = g === 'female' ? 'block' : 'none';
    calculateNavyBF();
}

function resetNavyBF() {
    document.getElementById('nbf-height').value = 180;
    document.getElementById('nbf-neck').value = 40;
    document.getElementById('nbf-waist').value = 90;
    calculateNavyBF();
}

function copyNavyReport() {
    const bf = document.getElementById('final-bf').innerText;
    const cat = document.getElementById('nbf-status').innerText;
    const comp = document.getElementById('compliance-text').innerText;
    const text = `Navy Body Fat Report\n━━━━━━━━━━━━━━━━━━━━━━\nBody Fat: ${bf}%\nCategory: ${cat}\nStatus: ${comp}\n\nDoD Compliance tracked via ToolsHub`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Military Report', 2000);
    });
}

function shareNavy() {
    if (navigator.share) {
        navigator.share({
            title: 'My Navy Body Fat Results',
            text: `I just checked my body composition compliance using ToolsHub. Result: ${document.getElementById('final-bf').innerText}%`,
            url: window.location.href
        });
    }
}

// UI Triggers
document.getElementById('nbf-units').addEventListener('change', function() {
    const labels = document.querySelectorAll('.unit-label');
    labels.forEach(l => l.innerText = this.value === 'metric' ? 'cm' : 'in');
    calculateNavyBF();
});

document.querySelectorAll('[data-id="gender"]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('[data-id="gender"]').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('nbf-hip-row').style.display = this.dataset.value === 'female' ? 'block' : 'none';
        calculateNavyBF();
    });
});

['nbf-height', 'nbf-neck', 'nbf-waist', 'nbf-hips'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateNavyBF);
});

document.addEventListener('DOMContentLoaded', calculateNavyBF);
</script>
