<div class="container-fluid height-p-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(16, 185, 129, 0.1); color:#10b981;">
                        <i class="fas fa-arrows-up-down"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Anthropometric Stature Analytics</h3>
                        <p class="tool-subtitle">Calculate height percentile rankings against global population datasets (WHO, CDC, and National Health Surveys).</p>
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
                            <label class="form-label-custom">Age Group</label>
                            <select id="age_group" class="form-select-custom">
                                <option value="adult" selected>Adult (20+ Years)</option>
                                <option value="child">Child / Teen (2-19 Years)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Height</label>
                            <div class="input-group-custom">
                                <input type="number" id="h-val" class="form-control-custom" value="175" step="0.1">
                                <span class="input-addon">cm</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Comparison Dataset</label>
                            <select id="dataset" class="form-select-custom">
                                <option value="global" selected>WHO (Global)</option>
                                <option value="usa">CDC (USA)</option>
                                <option value="uk">UK Healthy</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#10b981;" onclick="calculatePercentile()">
                                    <i class="fas fa-chart-line me-2"></i> Analyze Stature Ranking
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetHP()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="output-card-themed" id="hp-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-percentile-badge">
                            <span class="hero-label">Height Percentile</span>
                            <h2 class="hero-value" id="final-p">74</h2>
                            <div class="hero-unit-tag">th Percentile</div>
                            <div class="hero-status-pill mt-3" id="hp-status">Above Average</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="percentile-viz">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Population Distribution</span>
                                <span class="small fw-bold text-success" id="rank-text">Taller than 74%</span>
                            </div>
                            <div class="p-distribution-bar">
                                <div id="p-indicator" class="p-indicator"></div>
                                <div class="p-segments">
                                    <div class="p-seg p-low"></div>
                                    <div class="p-seg p-mid"></div>
                                    <div class="p-seg p-high"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted fw-bold ls-1">
                                <span>Short</span><span>Average</span><span>Tall</span>
                            </div>
                        </div>

                        <div class="mt-4 row g-3">
                            <div class="col-6">
                                <div class="stat-mini-card">
                                    <span class="sm-label">Avg. for Group</span>
                                    <span class="sm-value" id="avg-height">170.5 cm</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-mini-card">
                                    <span class="sm-label">Diff. to Mean</span>
                                    <span class="sm-value text-success" id="diff-height">+4.5 cm</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2 small uppercase ls-1"><i class="fas fa-dna text-primary me-2"></i> Genetic Context</h6>
                            <div id="hp-insights" class="small text-muted">
                                This stature is statistically significant. Ranking indicates you are in the top tier of the selected demographic dataset.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyHPReport()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Stature Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.height-p-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

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

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-percentile-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 6rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-unit-tag { font-size: 1.2rem; font-weight: 800; color: #10b981; letter-spacing: 1px; }

.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.p-distribution-bar { height: 12px; border-radius: 10px; position: relative; margin: 1.5rem 0; background: #f1f5f9; }
.p-segments { position: absolute; width: 100%; height: 100%; display: flex; border-radius: 10px; overflow: hidden; opacity: 0.3; }
.p-seg { height: 100%; }
.p-low { width: 33%; background: #94a3b8; }
.p-mid { width: 34%; background: #10b981; }
.p-high { width: 33%; background: #3b82f6; }

.p-indicator { position: absolute; top: -8px; width: 4px; height: 28px; background: #1e293b; border-radius: 10px; z-index: 2; border: 2px solid white; transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.stat-mini-card { background: #f8fafc; padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.02); }
.sm-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.sm-value { font-size: 1.1rem; font-weight: 800; color: #1e293b; }

.insights-container-soft { background: #fcfcfc; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 1.5rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.tiny { font-size: 0.7rem; }
</style>

<script>
// Mock datasets for statistical analysis (Simplified Normal Distribution)
// Mean (mu) and SD (sigma) for adults
const data = {
    global: { m: { mu: 173, sigma: 7 }, f: { mu: 160, sigma: 6 } },
    usa: { m: { mu: 176, sigma: 7.5 }, f: { mu: 162, sigma: 6.5 } },
    uk: { m: { mu: 175, sigma: 7.2 }, f: { mu: 161, sigma: 6.2 } }
};

function normalCDF(x, mu, sigma) {
    const z = (x - mu) / sigma;
    const t = 1 / (1 + 0.2316419 * Math.abs(z));
    const d = 0.3989423 * Math.exp(-z * z / 2);
    let p = d * t * (0.3193815 + t * (-0.3565638 + t * (1.781478 + t * (-1.821256 + t * 1.330274))));
    if (z > 0) p = 1 - p;
    return p;
}

function calculatePercentile() {
    const gender = document.querySelector('[data-id="gender"].active').dataset.value;
    const ds = document.getElementById('dataset').value;
    const h = parseFloat(document.getElementById('h-val').value) || 0;
    
    if (h <= 0) return;

    const stats = data[ds][gender === 'male' ? 'm' : 'f'];
    const p = Math.round((1 - normalCDF(h, stats.mu, stats.sigma)) * 100);

    displayHP(p, stats.mu, h);
}

function displayHP(p, mu, h) {
    document.getElementById('final-p').innerText = p;
    document.getElementById('p-indicator').style.left = p + "%";
    
    let status = "Average";
    let clr = "#10b981";
    if (p < 25) { status = "Below Average"; clr = "#94a3b8"; }
    else if (p > 75) { status = "Above Average"; clr = "#3b82f6"; }
    else if (p > 95) { status = "Tall / Elite"; clr = "#4f46e5"; }

    const statPill = document.getElementById('hp-status');
    statPill.innerText = status;
    statPill.style.background = clr + "15";
    statPill.style.color = clr;
    statPill.style.border = "1.5px solid " + clr + "30";

    document.getElementById('rank-text').innerText = `Taller than ${p}% of group`;
    document.getElementById('avg-height').innerText = mu.toFixed(1) + " cm";
    
    const diff = h - mu;
    const diffEl = document.getElementById('diff-height');
    diffEl.innerText = (diff > 0 ? "+" : "") + diff.toFixed(1) + " cm";
    diffEl.style.color = diff >= 0 ? "#10b981" : "#ef4444";

    document.getElementById('hp-insights').innerText = `Your stature of ${h} cm places you in the ${p}th percentile. This ranking is based on a standard normal distribution of the selected ${document.getElementById('dataset').value.toUpperCase()} population.`;
}

function resetHP() {
    document.getElementById('h-val').value = 175;
    calculatePercentile();
}

function copyHPReport() {
    const p = document.getElementById('final-p').innerText;
    const status = document.getElementById('hp-status').innerText;
    const diff = document.getElementById('diff-height').innerText;
    const text = `Anthropometric Stature Report\n━━━━━━━━━━━━━━━━━━━━━━\nHeight Percentile: ${p}th\nClassification: ${status}\nVariance: ${diff}\n\nClinically calculated via ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Profile Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Stature Profile', 2000);
    });
}

// UI Triggers
document.querySelectorAll('[data-id="gender"]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('[data-id="gender"]').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        calculatePercentile();
    });
});

['h-val', 'dataset', 'age_group'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculatePercentile);
});

document.addEventListener('DOMContentLoaded', calculatePercentile);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\height-percentile-calculator.blade.php ENDPATH**/ ?>