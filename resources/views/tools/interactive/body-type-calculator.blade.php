<div class="container-fluid body-type-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(236, 72, 153, 0.1); color:#ec4899;">
                        <i class="fas fa-person-rays"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Physique Architecture Decoder</h3>
                        <p class="tool-subtitle">Identify your anatomical body shape using chest, waist, and hip ratios to optimize fitness and styling strategies.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label-custom">Biological Gender</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-toggle-custom active flex-grow-1" data-id="gender" data-value="female">Female</button>
                                <button type="button" class="btn-toggle-custom flex-grow-1" data-id="gender" data-value="male">Male</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Chest / Bust</label>
                            <div class="input-group-custom">
                                <input type="number" id="chest" class="form-control-custom" value="90" step="0.1">
                                <span class="input-addon unit-label">cm</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Waist Circ.</label>
                            <div class="input-group-custom">
                                <input type="number" id="waist" class="form-control-custom" value="70" step="0.1">
                                <span class="input-addon unit-label">cm</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Hip Circ.</label>
                            <div class="input-group-custom">
                                <input type="number" id="hips" class="form-control-custom" value="95" step="0.1">
                                <span class="input-addon unit-label">cm</span>
                            </div>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4 text-center">
                            <label class="form-label-custom mb-3">Measurement System</label>
                            <div class="d-inline-flex bg-light p-1 rounded-pill">
                                <button class="btn btn-sm px-4 rounded-pill btn-system active" data-system="metric">Metric (cm)</button>
                                <button class="btn btn-sm px-4 rounded-pill btn-system" data-system="imperial">Imperial (in)</button>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#ec4899;" onclick="calculateBodyType()">
                                    <i class="fas fa-wand-magic-sparkles me-2"></i> Decode Physique Geometry
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetBodyType()">
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
            <div class="output-card-themed" id="bt-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-shape-badge">
                            <span class="hero-label">Identified Shape</span>
                            <h2 class="hero-value" id="final-shape" style="font-size:3.5rem; letter-spacing: -1px; line-height: 1.1;">Hourglass</h2>
                            <div class="hero-icon-box mt-3" id="shape-icon">
                                <i class="fas fa-hourglass-start fa-3x text-pink"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="physique-details">
                            <h6 class="fw-bold mb-3 small text-uppercase ls-1 text-primary"><i class="fas fa-dna me-2"></i>Physique Characteristics</h6>
                            <p id="shape-desc" class="text-muted small lh-base">
                                Your measurements show a balanced relationship between bust and hips with a significantly defined waistline.
                            </p>
                            
                            <div class="mt-4 d-flex flex-column gap-2">
                                <div class="ratio-row">
                                    <span class="r-label">Hips vs Chest</span>
                                    <span class="r-value" id="h-c-ratio">1.05</span>
                                </div>
                                <div class="ratio-row">
                                    <span class="r-label">Waist vs Hips</span>
                                    <span class="r-value" id="w-h-ratio">0.73</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="summary-pills d-flex flex-wrap gap-2 justify-content-center">
                            <div class="type-pill" id="pill-balanced">Balanced Vertically</div>
                            <div class="type-pill" id="pill-waist">Defined Midsection</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="insights-container-soft bg-light">
                            <h6 class="fw-bold mb-2 small uppercase ls-1"><i class="fas fa-lightbulb text-warning me-2"></i> Tactical Insight</h6>
                            <div id="shape-insights" class="small text-muted">
                                This body type typically responds well to full-body compound exercises. Focus on core stability to maintain midsection definition.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyShapeReport()">
                                    <i class="fas fa-copy me-2 text-info"></i> Copy Physique Profile
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
.body-type-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.btn-toggle-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; padding: 0.85rem 1rem; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s; color: #64748b; }
.btn-toggle-custom.active { background: #1e293b; color: white; border-color: #1e293b; }

.btn-system.active { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); color: #1e293b; font-weight: 800; }
.btn-system { color: #64748b; font-weight: 600; border: none; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-shape-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 4rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -2px; }

.ratio-row { display: flex; justify-content: space-between; align-items: center; border-bottom: 1.5px dashed #e2e8f0; padding-bottom: 0.75rem; }
.r-label { font-size: 0.85rem; font-weight: 600; color: #64748b; }
.r-value { font-weight: 800; color: #ec4899; font-size: 1rem; }

.type-pill { background: #fdf2f8; color: #db2777; padding: 0.5rem 1.25rem; border-radius: 100px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; border: 1px solid #fce7f3; }

.insights-container-soft { background: #fcfcfc; padding: 1.5rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 1.5rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.text-pink { color: #ec4899; }
</style>

<script>
function calculateBodyType() {
    const gender = document.querySelector('[data-id="gender"].active').dataset.value;
    const chest = parseFloat(document.getElementById('chest').value) || 0;
    const waist = parseFloat(document.getElementById('waist').value) || 0;
    const hips = parseFloat(document.getElementById('hips').value) || 0;

    if (chest <= 0 || waist <= 0 || hips <= 0) return;

    let shape = "";
    let desc = "";
    let icon = "fa-person-rays";
    let insights = "";

    const hc_ratio = hips / chest;
    const wh_ratio = waist / hips;
    const wc_ratio = waist / chest;

    document.getElementById('h-c-ratio').innerText = hc_ratio.toFixed(2);
    document.getElementById('w-h-ratio').innerText = wh_ratio.toFixed(2);

    if (gender === 'female') {
        const bustHipsDiff = Math.abs(chest - hips);
        if ((chest / hips) <= 1.05 && (chest / hips) >= 0.95 && (waist / chest) <= 0.75) {
            shape = "Hourglass";
            icon = "fa-hourglass";
            desc = "Balanced bust and hips with a clearly defined waist. A proportional silhouette.";
            insights = "Train for metabolic conditioning. You carry weight evenly.";
        } else if (hips > (chest * 1.05)) {
            shape = "Pear (Triangle)";
            icon = "fa-caret-up";
            desc = "Hips are wider than the bust and shoulders. Common and very healthy distribution.";
            insights = "Focus on shoulder and back training to create visual balance.";
        } else if (chest > (hips * 1.05)) {
            shape = "Inverted Triangle";
            icon = "fa-caret-down";
            desc = "Shoulders/bust are broader than the hips. Strong, athletic look.";
            insights = "Prioritize lower body volume to balance the silhouette.";
        } else if (Math.abs(chest - hips) < (chest * 0.05) && (waist / chest) > 0.75) {
            shape = "Rectangle";
            icon = "fa-square";
            desc = "Bust, waist, and hips are fairly uniform. Athletic and straight frame.";
            insights = "Focus on core rotational work and lateral lower body movements.";
        } else {
            shape = "Apple (Oval)";
            icon = "fa-circle";
            desc = "Weight is primarily carried around the midsection. Softer silhouette.";
            insights = "Cardiovascular health is key. Prioritize steady-state walking.";
        }
    } else {
        // Male logic
        if (chest > (hips * 1.1) && waist < (chest * 0.8)) {
            shape = "Inverted Triangle";
            icon = "fa-caret-down";
            desc = "The 'V-Taper' physique. Broad shoulders with a narrow waist.";
            insights = "Classic athletic build. Focus on heavy compound lifts.";
        } else if (Math.abs(chest - hips) < (chest * 0.1) && waist < (chest * 0.9)) {
            shape = "Rectangle";
            icon = "fa-square";
            desc = "Straight build where shoulders and hips are aligned.";
            insights = "Hypertrophy training for shoulders and lats will enhance taper.";
        } else if (waist > chest || waist > hips) {
            shape = "Oval / Apple";
            icon = "fa-circle";
            desc = "Midsection is the broadest part of the physique.";
            insights = "High intensity interval training (HIIT) is highly effective.";
        } else {
            shape = "Triangle";
            icon = "fa-caret-up";
            desc = "Hips/waist are broader than the shoulders.";
            insights = "Prioritize upper body vertical pressing and pulling.";
        }
    }

    document.getElementById('final-shape').innerText = shape;
    document.getElementById('shape-icon').innerHTML = `<i class="fas ${icon} fa-3x text-pink"></i>`;
    document.getElementById('shape-desc').innerText = desc;
    document.getElementById('shape-insights').innerText = insights;
}

function resetBodyType() {
    document.getElementById('chest').value = 90;
    document.getElementById('waist').value = 70;
    document.getElementById('hips').value = 95;
    calculateBodyType();
}

function copyShapeReport() {
    const shape = document.getElementById('final-shape').innerText;
    const desc = document.getElementById('shape-desc').innerText;
    const text = `Physique Geometry Report\n━━━━━━━━━━━━━━━━━━━━━━\nIdentified Shape: ${shape}\nCharacteristics: ${desc}\n\nAnalyzed via ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Profile Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Physique Profile', 2000);
    });
}

// UI Triggers
document.querySelectorAll('.btn-system').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-system').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const sys = this.dataset.system;
        document.querySelectorAll('.unit-label').forEach(l => l.innerText = sys === 'metric' ? 'cm' : 'in');
        calculateBodyType();
    });
});

document.querySelectorAll('[data-id="gender"]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('[data-id="gender"]').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        calculateBodyType();
    });
});

['chest', 'waist', 'hips'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateBodyType);
});

document.addEventListener('DOMContentLoaded', calculateBodyType);
</script>
