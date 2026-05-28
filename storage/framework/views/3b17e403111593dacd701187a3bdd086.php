<div class="container-fluid bench-press-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(59,130,246,0.1); color:#3b82f6;">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Bench Press & Strength Specialist</h3>
                        <p class="tool-subtitle">Calculate your 1RM, strength-to-weight ratio, and competitive rank.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Gender</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-toggle-custom active flex-grow-1" data-id="gender" data-value="male">Male</button>
                                <button type="button" class="btn-toggle-custom flex-grow-1" data-id="gender" data-value="female">Female</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Body Weight <span class="badge-unit">Lb/Kg</span></label>
                            <input type="number" class="form-control-custom" id="body_weight" value="180">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Weight Lifted <span class="badge-unit">Lb/Kg</span></label>
                            <input type="number" class="form-control-custom" id="lift_weight" value="135">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label-custom">Repetitions <span class="badge-unit">1-10</span></label>
                            <input type="range" class="form-range-custom" id="reps" min="1" max="10" value="5">
                            <div class="d-flex justify-content-between mt-1 text-muted small px-1">
                                <span>1 Rep</span>
                                <span id="reps-val" class="fw-bold text-primary">5 Reps</span>
                                <span>10 Reps</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Experience Level</label>
                            <select class="form-select-custom" id="exp_level">
                                <option value="untrained">Untrained</option>
                                <option value="novice" selected>Novice</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                                <option value="elite">Elite</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4">
                            <button class="btn-calculate-pro w-100" onclick="calculateStrength()">
                                <i class="fas fa-bolt me-2"></i> Analyze Strength Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="output-card-themed" id="strength-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="hero-score-badge">
                            <span class="hero-label">Estimated 1RM</span>
                            <h2 class="hero-value" id="one-rep-max">0</h2>
                            <span class="hero-tagline" id="strength-tier">Analyzing...</span>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="standards-visualizer">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Strength Standards (By Brzycki)</span>
                                <span class="small text-muted" id="lift-ratio">Ratio: 0.00x BW</span>
                            </div>
                            <div class="progress-container-pro">
                                <div class="progress-bar-pro" id="strength-progress"></div>
                                <div class="progress-markers">
                                    <div class="marker" style="left: 0%">Untrained</div>
                                    <div class="marker" style="left: 20%">Novice</div>
                                    <div class="marker" style="left: 50%">Inter.</div>
                                    <div class="marker" style="left: 80%">Elite</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 row g-3">
                            <div class="col-6 col-md-3 item-stat-card">
                                <div class="stat-value" id="load-90">0</div>
                                <div class="stat-label">90% Load</div>
                            </div>
                            <div class="col-6 col-md-3 item-stat-card">
                                <div class="stat-value" id="load-80">0</div>
                                <div class="stat-label">80% Load</div>
                            </div>
                            <div class="col-6 col-md-3 item-stat-card">
                                <div class="stat-value" id="load-70">0</div>
                                <div class="stat-label">70% Load</div>
                            </div>
                            <div class="col-6 col-md-3 item-stat-card">
                                <div class="stat-value" id="load-60">0</div>
                                <div class="stat-label">60% Load</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container text-start">
                            <h5 class="insight-title"><i class="fas fa-medal me-2"></i> Strength Specialist Insights</h5>
                            <div id="strength-insights" class="insight-content text-muted"> Enter your sets and reps to get started. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --tool-bg: #fdfdfd;
    --tool-color: #1a1a1b;
    --primary-blue: #3b82f6;
}

.bench-press-rebuilt {
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    color: var(--tool-color);
}

.tool-card-premium {
    background: #ffffff;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
}

.tool-header-modern {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
}

.tool-icon-circle {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.tool-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.tool-subtitle {
    color: #64748b;
    margin: 0;
}

.form-label-custom {
    font-size: 0.875rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 0.75rem;
    display: block;
}

.form-control-custom, .form-select-custom {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-weight: 500;
    transition: all 0.2s;
    width: 100%;
}

.form-control-custom:focus {
    background: #ffffff;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
    outline: none;
}

.form-range-custom {
    width: 100%;
    height: 6px;
    background: #e2e8f0;
    border-radius: 5px;
    outline: none;
    -webkit-appearance: none;
}

.form-range-custom::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    background: var(--primary-blue);
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 0 10px rgba(59,130,246,0.3);
}

.btn-toggle-custom {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-toggle-custom.active {
    background: var(--primary-blue);
    color: white;
    border-color: var(--primary-blue);
}

.btn-calculate-pro {
    background: var(--primary-blue);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 14px;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.3s;
    cursor: pointer;
}

.output-card-themed {
    background: #ffffff;
    color: var(--tool-color);
    border: 1px solid rgba(0,0,0,0.08);
    box-shadow: 0 10px 40px rgba(0,0,0,0.04);
}

.hero-value {
    font-size: 4.5rem;
    font-weight: 800;
    margin: 0;
    background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.progress-container-pro {
    height: 12px;
    background: #f1f5f9;
    border-radius: 20px;
    position: relative;
    margin: 2rem 0;
}

.progress-bar-pro {
    height: 100%;
    background: linear-gradient(90deg, #3b82f6, #60a5fa);
    border-radius: 20px;
    transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    width: 0%;
}

.progress-markers {
    display: flex;
    justify-content: space-between;
    position: absolute;
    width: 100%;
    top: 20px;
}

.marker {
    font-size: 0.65rem;
    color: #94a3b8;
    text-transform: uppercase;
    font-weight: 700;
    position: absolute;
    transform: translateX(-50%);
}

.item-stat-card {
    padding: 1rem;
    background: #f8fafc;
    border-radius: 14px;
    text-align: center;
    border: 1px solid rgba(0,0,0,0.05);
}

.stat-value { font-size: 1.25rem; font-weight: 700; color: var(--tool-color); }
.stat-label { font-size: 0.7rem; color: #64748b; font-weight: 600; text-transform: uppercase; }

.insights-container { background: #f8fafc; border-radius: 18px; padding: 1.5rem; margin-top: 2rem; border: 1px solid rgba(0,0,0,0.04); }
.insight-title { font-size: 1rem; font-weight: 700; margin-bottom: 1rem; color: var(--tool-color); }
.insight-content { color: #475569; font-size: 0.9rem; line-height: 1.6; }
</style>

<script>
function calculateStrength() {
    const gender = document.querySelector('[data-id="gender"].active').dataset.value;
    const bw = parseFloat(document.getElementById('body_weight').value) || 0;
    const lift = parseFloat(document.getElementById('lift_weight').value) || 0;
    const reps = parseInt(document.getElementById('reps').value) || 1;

    // 1RM Calculation (Brzycki Formula)
    const orm = reps === 1 ? lift : Math.round(lift / (1.0278 - (0.0278 * reps)));
    const ratio = (orm / bw).toFixed(2);

    // Update Primary Result
    document.getElementById('one-rep-max').innerText = orm;
    document.getElementById('lift-ratio').innerText = `Ratio: ${ratio}x BW`;

    // Strength Tiers & Distribution (Approximate for Males)
    let tier = "Untrained";
    let progress = 10;
    
    if (gender === 'male') {
        if (ratio >= 2.0) { tier = "Elite (Top 1%)"; progress = 100; }
        else if (ratio >= 1.5) { tier = "Advanced (Top 5%)"; progress = 80; }
        else if (ratio >= 1.1) { tier = "Intermediate"; progress = 50; }
        else if (ratio >= 0.75) { tier = "Novice"; progress = 30; }
    } else {
        if (ratio >= 1.25) { tier = "Elite (Top 1%)"; progress = 100; }
        else if (ratio >= 0.9) { tier = "Advanced (Top 5%)"; progress = 80; }
        else if (ratio >= 0.6) { tier = "Intermediate"; progress = 50; }
        else if (ratio >= 0.4) { tier = "Novice"; progress = 30; }
    }

    document.getElementById('strength-tier').innerText = tier;
    document.getElementById('strength-progress').style.width = progress + '%';

    // Load Breakdown
    document.getElementById('load-90').innerText = Math.round(orm * 0.9);
    document.getElementById('load-80').innerText = Math.round(orm * 0.8);
    document.getElementById('load-70').innerText = Math.round(orm * 0.7);
    document.getElementById('load-60').innerText = Math.round(orm * 0.6);

    // Insights
    let insights = `Building a strong bench press requires consistent training and proper technique. Your current strength-to-weight ratio is **${ratio}**. `;
    if (ratio < 1.0) {
        insights += "Focus on progressive overload to hit your bodyweight bench press goal.";
    } else if (ratio >= 1.5) {
        insights += "You are in the elite tier of lifters. Consider competitive powerlifting standards.";
    } else {
        insights += "You are well on your way to advanced strength levels.";
    }

    document.getElementById('strength-insights').innerHTML = insights;
}

// Ranges & Interaction
document.getElementById('reps').addEventListener('input', function() {
    document.getElementById('reps-val').innerText = this.value + (this.value == 1 ? ' Rep' : ' Reps');
    calculateStrength();
});

document.querySelectorAll('.btn-toggle-custom').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll(`[data-id="${this.dataset.id}"]`).forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        calculateStrength();
    });
});

document.addEventListener('DOMContentLoaded', calculateStrength);
</script><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bench-press-calculator.blade.php ENDPATH**/ ?>