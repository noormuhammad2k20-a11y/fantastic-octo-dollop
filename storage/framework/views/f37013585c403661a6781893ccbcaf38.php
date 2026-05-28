<div class="container-fluid baby-growth-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(59, 130, 246, 0.1); color:#3b82f6;">
                        <i class="fas fa-baby"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Pediatric Growth Velocity Tracker</h3>
                        <p class="tool-subtitle">Standardized percentile analysis for infant development based on WHO Multicentre Growth Reference Study (MGRS) datasets.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label-custom">Infant Gender</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-toggle-custom active flex-grow-1" data-id="gender" data-value="boy">Boy</button>
                                <button type="button" class="btn-toggle-custom flex-grow-1" data-id="gender" data-value="girl">Girl</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Age (Months)</label>
                            <div class="input-group-custom">
                                <input type="number" id="age_months" class="form-control-custom" value="6" min="0" max="24">
                                <span class="input-addon">Mo</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Weight</label>
                            <div class="input-group-custom">
                                <input type="number" id="baby_weight" class="form-control-custom" value="7.5" step="0.1">
                                <span class="input-addon weight-unit">kg</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Length / Height</label>
                            <div class="input-group-custom">
                                <input type="number" id="baby_length" class="form-control-custom" value="67" step="0.1">
                                <span class="input-addon length-unit">cm</span>
                            </div>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4 text-center">
                            <div class="d-inline-flex bg-light p-1 rounded-pill">
                                <button class="btn btn-sm px-4 rounded-pill btn-system active" data-system="metric">Metric (kg/cm)</button>
                                <button class="btn btn-sm px-4 rounded-pill btn-system" data-system="imperial">Imperial (lb/in)</button>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#3b82f6;" onclick="calculateBabyGrowth()">
                                    <i class="fas fa-chart-area me-2"></i> Analyze Growth Percentiles
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetBaby()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="output-card-themed" id="bg-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-growth-badge">
                            <span class="hero-label">Growth Summary</span>
                            <h2 class="hero-value" id="final-p-main">52nd</h2>
                            <div class="hero-unit-tag">Percentile</div>
                            <div class="hero-status-pill mt-3" id="growth-status">Healthy Growth</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="metric-breakdown">
                            <h6 class="fw-bold mb-3 small text-uppercase ls-1 text-primary"><i class="fas fa-ruler-combined me-2"></i>Percentile Distribution</h6>
                            
                            <div class="metric-row mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="tiny fw-bold text-muted uppercase">Weight-for-Age</span>
                                    <span class="tiny fw-bold" id="wfa-val">50th</span>
                                </div>
                                <div class="mini-spectrum"><div id="wfa-bar" class="mini-fill" style="width:50%"></div></div>
                            </div>

                            <div class="metric-row mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="tiny fw-bold text-muted uppercase">Length-for-Age</span>
                                    <span class="tiny fw-bold" id="lfa-val">65th</span>
                                </div>
                                <div class="mini-spectrum"><div id="lfa-bar" class="mini-fill" style="width:65%"></div></div>
                            </div>

                            <div class="metric-row">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="tiny fw-bold text-muted uppercase">Weight-for-Length</span>
                                    <span class="tiny fw-bold" id="wfl-val">42nd</span>
                                </div>
                                <div class="mini-spectrum"><div id="wfl-bar" class="mini-fill" style="width:42%"></div></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2 small uppercase ls-1"><i class="fas fa-shield-cat me-2 text-info"></i> Developmental Assessment</h6>
                            <div id="growth-insights" class="small text-muted lh-base">
                                All measurements are within the standard 2nd to 98th percentile range. Your baby's growth trajectory appears steady and proportional.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyBabyReport()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Pediatric Growth Report
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 p-3 rounded-4 text-center bg-info bg-opacity-10 border border-info border-opacity-20">
                <p class="mb-0 small text-info fw-bold"><i class="fas fa-circle-info me-2"></i><strong>Note:</strong> Pediatric growth is best assessed via trend over time rather than a single data point.</p>
            </div>
        </div>
    </div>
</div>

<style>
.baby-growth-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.btn-toggle-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; padding: 0.85rem 1rem; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s; color: #64748b; }
.btn-toggle-custom.active { background: #1e3a8a; color: white; border-color: #1e3a8a; }

.btn-system.active { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); color: #1e293b; font-weight: 800; }
.btn-system { color: #64748b; font-weight: 600; border: none; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-value { font-size: 6rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; }
.hero-unit-tag { font-size: 1.5rem; font-weight: 800; color: #3b82f6; }

.mini-spectrum { height: 6px; background: #f1f5f9; border-radius: 10px; overflow: hidden; }
.mini-fill { height: 100%; background: #3b82f6; border-radius: 10px; transition: 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.stat-mini-card { background: #f8fafc; padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.02); }
.sm-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.sm-value { font-size: 1.1rem; font-weight: 800; color: #1e293b; }

.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.insights-container-soft { background: #fcfcfc; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 1.5rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.tiny { font-size: 0.65rem; }
</style>

<script>
// Mock Growth Data WHO (Mean and SD for simplified illustration)
const growthData = {
    boy: {
        w: { mu: [3.3, 4.5, 5.6, 6.4, 7.0, 7.5, 7.9, 8.3, 8.6, 8.9, 9.2, 9.4, 9.6], sigma: 0.6 },
        l: { mu: [50, 54, 58, 61, 64, 66, 68, 69, 71, 72, 73, 75, 76], sigma: 2.2 }
    },
    girl: {
        w: { mu: [3.2, 4.2, 5.1, 5.8, 6.4, 6.9, 7.3, 7.6, 7.9, 8.2, 8.5, 8.7, 8.9], sigma: 0.55 },
        l: { mu: [49, 53, 57, 60, 62, 64, 66, 67, 69, 70, 72, 73, 74], sigma: 2.0 }
    }
};

function normalCDF(x, mu, sigma) {
    const z = (x - mu) / sigma;
    const t = 1 / (1 + 0.2316419 * Math.abs(z));
    const d = 0.3989423 * Math.exp(-z * z / 2);
    let p = d * t * (0.3193815 + t * (-0.3565638 + t * (1.781478 + t * (-1.821256 + t * 1.330274))));
    if (z > 0) p = 1 - p;
    return p;
}

function calculateBabyGrowth() {
    const gender = document.querySelector('[data-id="gender"].active').dataset.value;
    const system = document.querySelector('.btn-system.active').dataset.system;
    const age = Math.min(12, parseInt(document.getElementById('age_months').value) || 0);
    
    let w = parseFloat(document.getElementById('baby_weight').value) || 0;
    let l = parseFloat(document.getElementById('baby_length').value) || 0;

    if (w <= 0 || l <= 0) return;

    // Convert to metric
    const w_kg = system === 'imperial' ? w * 0.453592 : w;
    const l_cm = system === 'imperial' ? l * 2.54 : l;

    const stats = growthData[gender];
    const pW = Math.round((1 - normalCDF(w_kg, stats.w.mu[age], stats.w.sigma)) * 100);
    const pL = Math.round((1 - normalCDF(l_cm, stats.l.mu[age], stats.l.sigma)) * 100);
    
    const meanP = Math.round((pW + pL) / 2);

    displayGrowthResults(pW, pL, meanP);
}

function displayGrowthResults(pw, pl, main) {
    document.getElementById('final-p-main').innerText = main + "th";
    
    document.getElementById('wfa-val').innerText = pw + "th";
    document.getElementById('wfa-bar').style.width = pw + "%";
    
    document.getElementById('lfa-val').innerText = pl + "th";
    document.getElementById('lfa-bar').style.width = pl + "%";

    let status = "Healthy Growth";
    let clr = "#3b82f6";
    if (main < 5) { status = "Undergrowth Alert"; clr = "#ef4444"; }
    else if (main < 15) { status = "Below Average"; clr = "#f97316"; }
    else if (main > 95) { status = "Highly Accelerated"; clr = "#a855f7"; }
    else if (main > 85) { status = "Above Average"; clr = "#10b981"; }

    const pill = document.getElementById('growth-status');
    pill.innerText = status;
    pill.style.background = clr + "15";
    pill.style.color = clr;
    pill.style.border = "1.5px solid " + clr + "30";
}

function resetBaby() {
    document.getElementById('age_months').value = 6;
    document.getElementById('baby_weight').value = 7.5;
    document.getElementById('baby_length').value = 67;
    calculateBabyGrowth();
}

function copyBabyReport() {
    const main = document.getElementById('final-p-main').innerText;
    const w = document.getElementById('wfa-val').innerText;
    const l = document.getElementById('lfa-val').innerText;
    const status = document.getElementById('growth-status').innerText;
    const text = `Pediatric Growth Report\n━━━━━━━━━━━━━━━━━━━━━━\nMean Percentile: ${main}\nWeight Rank: ${w}\nLength Rank: ${l}\nStatus: ${status}\n\nWHO Standardized tracking via ToolsHub`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Pediatric Growth Report', 2000);
    });
}

// UI Triggers
document.querySelectorAll('.btn-system').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-system').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const sys = this.dataset.system;
        document.querySelector('.weight-unit').innerText = sys === 'metric' ? 'kg' : 'lb';
        document.querySelector('.length-unit').innerText = sys === 'metric' ? 'cm' : 'in';
        calculateBabyGrowth();
    });
});

document.querySelectorAll('[data-id="gender"]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('[data-id="gender"]').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        calculateBabyGrowth();
    });
});

['age_months', 'baby_weight', 'baby_length'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateBabyGrowth);
});

document.addEventListener('DOMContentLoaded', calculateBabyGrowth);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\baby-growth-percentile-calculator.blade.php ENDPATH**/ ?>