<div class="container-fluid bio-age-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(16, 185, 129, 0.1); color:#10b981;">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Biological Age Analyst</h3>
                        <p class="tool-subtitle">Assess your cellular aging rate by correlating lifestyle markers, epigenetic habits, and physical metrics.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Chronological Age</label>
                            <div class="input-group-custom">
                                <input type="number" id="c_age" class="form-control-custom" value="30" min="15" max="100">
                                <span class="input-addon">Years</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Sleep Hygiene</label>
                            <select id="sleep" class="form-select-custom">
                                <option value="-1.5">Optimal (7-9h, deep)</option>
                                <option value="0" selected>Average (6-7h)</option>
                                <option value="1.5">Deficient (<6h, interrupted)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Physical Activity</label>
                            <select id="exercise" class="form-select-custom">
                                <option value="-2.5">High Performance (5x/week)</option>
                                <option value="-1">Active (3x/week)</option>
                                <option value="1" selected>Moderate (1-2x/week)</option>
                                <option value="2.5">Sedentary</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label-custom">Dietary Quality</label>
                            <select id="diet" class="form-select-custom">
                                <option value="-1.5">Whole Food / Anti-Inflammatory</option>
                                <option value="0" selected>Balanced Mixed</option>
                                <option value="2.0">High Processed / Sugar</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Stress Level</label>
                            <select id="stress" class="form-select-custom">
                                <option value="-0.5">Low / Mindfulness Practice</option>
                                <option value="0.5" selected>Moderate / Manageable</option>
                                <option value="2.5">Chronic / High Cortisol</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Smoking History</label>
                            <select id="smoking" class="form-select-custom">
                                <option value="-1" selected>Never Smoked</option>
                                <option value="1">Former Smoker</option>
                                <option value="4.5">Active Smoker</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#10b981;" onclick="calculateBioAge()">
                                    <i class="fas fa-microchip me-2"></i> Compute Epigenetic Age
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetBioAge()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="output-card-themed" id="ba-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-age-badge">
                            <span class="hero-label">Biological Age</span>
                            <h2 class="hero-value" id="final-ba">32.5</h2>
                            <div class="hero-unit-tag">Years Old</div>
                            <div class="hero-status-pill mt-3" id="age-status">Aging Slightly Faster</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="age-spectrum-container">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Aging Rate (vs Normal)</span>
                                <span class="small fw-bold" id="aging-rate-text">1.1x speed</span>
                            </div>
                            <div class="spectrum-bar">
                                <div id="ba-indicator" class="spectrum-indicator"></div>
                                <div class="spectrum-segments">
                                    <div class="seg seg-slow"></div>
                                    <div class="seg seg-normal"></div>
                                    <div class="seg seg-fast"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted fw-bold ls-1">
                                <span>Slow Aging</span><span>Average</span><span>Accelerated</span>
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Vitality Variance</span><span class="sm-value" id="ba-diff">+2.5 Years</span></div></div>
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Health Score</span><span class="sm-value" id="ba-score">78%</span></div></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2 small uppercase ls-1"><i class="fas fa-clipboard-check me-2 text-primary"></i> Longevity Insights</h6>
                            <div id="ba-insights" class="small text-muted lh-base">
                                Your epigenetic markers suggest moderate inflammatory stress. Optimizing sleep by just one hour could lower your biological age by 1.2 years over the next 6 months.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyBioReport()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Longevity Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bio-age-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

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

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-value { font-size: 6rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; }
.hero-unit-tag { font-size: 1.2rem; font-weight: 800; color: #10b981; }

.spectrum-bar { height: 12px; border-radius: 10px; position: relative; margin: 1.5rem 0; background: #f1f5f9; }
.spectrum-segments { position: absolute; width: 100%; height: 100%; display: flex; border-radius: 10px; overflow: hidden; opacity: 0.3; }
.seg { height: 100%; }
.seg-slow { width: 33.3%; background: #22c55e; }
.seg-normal { width: 33.3%; background: #3b82f6; }
.seg-fast { width: 33.4%; background: #ef4444; }

.spectrum-indicator { position: absolute; top: -8px; width: 4px; height: 28px; background: #1e293b; border-radius: 10px; z-index: 2; border: 2px solid white; transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.stat-mini-card { background: #f8fafc; padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.02); }
.sm-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.sm-value { font-size: 1.1rem; font-weight: 800; color: #1e293b; }

.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.insights-container-soft { background: #fcfcfc; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 1.5rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.tiny { font-size: 0.7rem; }
</style>

<script>
function calculateBioAge() {
    const chronAge = parseFloat(document.getElementById('c_age').value) || 30;
    const s = parseFloat(document.getElementById('sleep').value);
    const ex = parseFloat(document.getElementById('exercise').value);
    const d = parseFloat(document.getElementById('diet').value);
    const st = parseFloat(document.getElementById('stress').value);
    const sm = parseFloat(document.getElementById('smoking').value);

    const adjustment = s + ex + d + st + sm;
    const bioAge = chronAge + adjustment;
    const diff = bioAge - chronAge;

    displayBioResults(bioAge, diff);
}

function displayBioResults(bioAge, diff) {
    document.getElementById('final-ba').innerText = bioAge.toFixed(1);
    
    const diffSign = diff > 0 ? "+" : "";
    document.getElementById('ba-diff').innerText = diffSign + diff.toFixed(1) + " Years";
    document.getElementById('ba-diff').style.color = diff <= 0 ? "#10b981" : "#ef4444";

    const score = Math.max(0, Math.min(100, 100 - (diff * 5)));
    document.getElementById('ba-score').innerText = score + "%";

    let status = "Aging Normally";
    let clr = "#3b82f6";
    let pos = 50;
    let rate = "1.0x";

    if (diff < -3) {
        status = "Younger Biology"; clr = "#22c55e"; pos = 20; rate = "0.8x";
    } else if (diff < 0) {
        status = "Healthy Vitality"; clr = "#10b981"; pos = 40; rate = "0.9x";
    } else if (diff > 5) {
        status = "Accelerated Aging"; clr = "#ef4444"; pos = 85; rate = "1.3x";
    } else if (diff > 0) {
        status = "Aging Slightly Fast"; clr = "#f97316"; pos = 65; rate = "1.1x";
    }

    const pill = document.getElementById('age-status');
    pill.innerText = status;
    pill.style.background = clr + "15";
    pill.style.color = clr;
    pill.style.border = "1.5px solid " + clr + "30";

    document.getElementById('ba-indicator').style.left = pos + "%";
    document.getElementById('ba-indicator').style.background = clr;
    document.getElementById('aging-rate-text').innerText = rate + " speed";
    document.getElementById('aging-rate-text').style.color = clr;

    // Tactical insights logic
    let tips = "Your biological profile is stable. Maintain current protocols to preserve long-term health span.";
    if (diff > 0) tips = "Accelerated aging detected. Prioritize sleep depth and reduce processed carbohydrate intake to lower oxidative stress levels.";
    if (diff < -2) tips = "Exceptional vitality profile. Your biological system is significantly younger than chronological average. Continue high-quality protein and micronutrient intake.";
    
    document.getElementById('ba-insights').innerText = tips;
}

function resetBioAge() {
    document.getElementById('c_age').value = 30;
    document.querySelectorAll('.form-select-custom').forEach(s => s.selectedIndex = 1);
    calculateBioAge();
}

function copyBioReport() {
    const ba = document.getElementById('final-ba').innerText;
    const diff = document.getElementById('ba-diff').innerText;
    const score = document.getElementById('ba-score').innerText;
    const status = document.getElementById('age-status').innerText;
    const text = `Biological Age Report\n━━━━━━━━━━━━━━━━━━━━━━\nBio-Age: ${ba} Years\nVariance: ${diff}\nHealth Score: ${score}\nStatus: ${status}\n\nAnalyzed via ToolsHub Longevity`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Longevity Report', 2000);
    });
}

['c_age', 'sleep', 'exercise', 'diet', 'stress', 'smoking'].forEach(id => {
    const el = document.getElementById(id);
    if(el) {
        el.addEventListener('change', calculateBioAge);
        if(id === 'c_age') el.addEventListener('input', calculateBioAge);
    }
});

document.addEventListener('DOMContentLoaded', calculateBioAge);
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\biological-age-calculator.blade.php ENDPATH**/ ?>