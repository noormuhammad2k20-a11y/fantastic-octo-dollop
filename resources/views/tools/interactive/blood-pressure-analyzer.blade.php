<div class="container-fluid bp-calc-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(239, 68, 68, 0.1); color:#ef4444;">
                        <i class="fas fa-heart-pulse"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Hypertension Risk Interpreter</h3>
                        <p class="tool-subtitle">Categorize clinical readings using AHA (American Heart Association) and WHO cardiac standards.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Systolic (Upper #)</label>
                            <div class="input-group-custom">
                                <input type="number" id="bp-sys" class="form-control-custom" value="120" min="60" max="250">
                                <span class="input-addon">mmHg</span>
                            </div>
                            <span class="text-muted tiny mt-1">Pressure during heartbeat</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Diastolic (Lower #)</label>
                            <div class="input-group-custom">
                                <input type="number" id="bp-dia" class="form-control-custom" value="80" min="40" max="180">
                                <span class="input-addon">mmHg</span>
                            </div>
                            <span class="text-muted tiny mt-1">Pressure between beats</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Pulse Rate</label>
                            <div class="input-group-custom">
                                <input type="number" id="bp-pulse" class="form-control-custom" placeholder="Optional">
                                <span class="input-addon">BPM</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Measurement Position</label>
                            <select id="bp-pos" class="form-select-custom">
                                <option value="sitting" selected>Sitting (Standard)</option>
                                <option value="standing">Standing</option>
                                <option value="lying">Lying Down</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Measurement Time</label>
                            <select id="bp-time" class="form-select-custom">
                                <option value="morning">Morning (Fasting)</option>
                                <option value="afternoon" selected>Afternoon</option>
                                <option value="evening">Evening</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="mt-2 d-flex flex-wrap gap-2">
                                <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Select:</span>
                                <button type="button" class="btn-preset-pill" onclick="quickBP(120, 80)">🟢 Normal</button>
                                <button type="button" class="btn-preset-pill" onclick="quickBP(135, 85)">🟡 Stage 1</button>
                                <button type="button" class="btn-preset-pill" onclick="quickBP(155, 95)">🟠 Stage 2</button>
                                <button type="button" class="btn-preset-pill" onclick="quickBP(185, 125)">🔴 Crisis</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Results Card --}}
        <div class="col-lg-12">
            <div class="output-card-themed" id="bp-output-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-bp-badge">
                            <span class="hero-label">Status Assessment</span>
                            <h2 class="hero-value" id="out-bp-cat" style="font-size:3rem; letter-spacing: -1px; line-height: 1.1;">Normal</h2>
                            <div class="hero-reading-tag" id="out-bp-reading">120/80 mmHg</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="bp-spectrum-container">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Hypertension Spectrum</span>
                                <span class="small fw-bold" id="risk-level-tag">Optimal</span>
                            </div>
                            <div class="spectrum-bar">
                                <div id="bp-indicator" class="spectrum-indicator"></div>
                                <div class="spectrum-segments">
                                    <div class="seg seg-normal"></div>
                                    <div class="seg seg-elevated"></div>
                                    <div class="seg seg-stage1"></div>
                                    <div class="seg seg-stage2"></div>
                                    <div class="seg seg-crisis"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted letter-spacing-1 fw-bold">
                                <span>120</span><span>130</span><span>140</span><span>180+</span>
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Mean Arterial (MAP)</span><span class="sm-value" id="out-bp-map">93</span></div></div>
                            <div class="col-6"><div class="stat-mini-card"><span class="sm-label">Pulse Pressure</span><span class="sm-value" id="out-bp-pp">40</span></div></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="analysis-grid-soft py-3 px-4 rounded-4 bg-light">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="fas fa-stethoscope text-primary fs-4"></i>
                                <h6 class="fw-bold mb-0">Clinical Guidelines & Context</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle small mb-0">
                                    <thead class="text-muted"><tr class="tiny uppercase ls-1"><th>Category</th><th>Systolic</th><th>Diastolic</th><th>Status</th></tr></thead>
                                    <tbody id="out-bp-table"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="out-bp-advice"></div>

                    <div class="col-12 border-top pt-4">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="bp-copy" onclick="copyBP()">
                                    <i class="fas fa-copy me-2 text-info"></i> Copy Reading Report
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto -action-outline py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="shareBP()">
                                    <i class="fas fa-share-nodes me-2"></i> Share Results
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 mt-4 text-center bg-danger bg-opacity-10 border border-danger border-opacity-20">
                <p class="mb-0 small text-danger fw-bold"><i class="fas fa-triangle-exclamation me-2"></i><strong>Disclaimer:</strong> This tool provides information only and is not medical advice. Consult a doctor for any health concerns.</p>
            </div>
        </div>
    </div>
</div>

<style>
.bp-calc-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom, .form-select-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-preset-pill { background: #fff; border: 1.5px solid #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 100px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: 0.2s; }
.btn-preset-pill:hover { background: #f8fafc; border-color: #cbd5e1; }

.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-bp-badge { padding: 1rem; }
.hero-label { font-size: 0.8rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 0.5rem; }
.hero-reading-tag { font-size: 1.2rem; font-weight: 800; color: #64748b; margin-top: 1rem; padding: 0.5rem 1rem; background: #f1f5f9; border-radius: 12px; display: inline-block; }

.spectrum-bar { height: 12px; border-radius: 10px; position: relative; margin: 1.5rem 0; background: #f1f5f9; }
.spectrum-segments { position: absolute; width: 100%; height: 100%; display: flex; border-radius: 10px; overflow: hidden; opacity: 0.4; }
.seg { height: 100%; }
.seg-normal { width: 30%; background: #10b981; }
.seg-elevated { width: 15%; background: #fbbf24; }
.seg-stage1 { width: 15%; background: #f97316; }
.seg-stage2 { width: 25%; background: #ef4444; }
.seg-crisis { width: 15%; background: #881337; }

.spectrum-indicator { position: absolute; top: -8px; width: 4px; height: 28px; background: #1e293b; border-radius: 10px; z-index: 2; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.stat-mini-card { background: #f8fafc; padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.02); }
.sm-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.sm-value { font-size: 1.1rem; font-weight: 800; color: #1e293b; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }
.btn-action-outline { background: transparent; border: 2px solid #e2e8f0; color: #1e293b; padding: calc(1.1rem - 2px); border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.tiny { font-size: 0.7rem; }
</style>

<script>
const categories = [
    { name: 'Normal', sys: [0, 120], dia: [0, 80], color: '#10b981', risk: 'Optimal', pos: 15 },
    { name: 'Elevated', sys: [120, 130], dia: [0, 80], color: '#fbbf24', risk: 'Monitor', pos: 37 },
    { name: 'Hypertension Stage 1', sys: [130, 140], dia: [80, 90], color: '#f97316', risk: 'Caution', pos: 52 },
    { name: 'Hypertension Stage 2', sys: [140, 180], dia: [90, 120], color: '#ef4444', risk: 'High Risk', pos: 72 },
    { name: 'Hypertensive Crisis', sys: [180, 999], dia: [120, 999], color: '#881337', risk: 'URGENT', pos: 92 }
];

function classify(s, d) {
    if (s >= 180 || d >= 120) return categories[4];
    if (s >= 140 || d >= 90) return categories[3];
    if (s >= 130 || d >= 80) return categories[2];
    if (s >= 120 && d < 80) return categories[1];
    return categories[0];
}

function calculateBP() {
    const sys = parseInt(document.getElementById('bp-sys').value) || 0;
    const dia = parseInt(document.getElementById('bp-dia').value) || 0;
    const pulse = parseInt(document.getElementById('bp-pulse').value) || 0;

    if (sys < 40 || dia < 30) return;

    const cat = classify(sys, dia);
    const map = Math.round((sys + 2 * dia) / 3);
    const pp = sys - dia;

    // UI Updates
    document.getElementById('out-bp-cat').textContent = cat.name;
    document.getElementById('out-bp-cat').style.color = cat.color;
    document.getElementById('out-bp-reading').textContent = `${sys} / ${dia} mmHg`;
    document.getElementById('out-bp-map').textContent = map;
    document.getElementById('out-bp-pp').textContent = pp;
    document.getElementById('risk-level-tag').textContent = cat.risk;
    document.getElementById('risk-level-tag').style.color = cat.color;
    document.getElementById('bp-indicator').style.left = cat.pos + "%";

    // Table Update
    document.getElementById('out-bp-table').innerHTML = categories.map(c => {
        const active = c.name === cat.name;
        return `
            <tr style="${active ? 'background:rgba(0,0,0,0.02);' : ''}">
                <td class="fw-bold" style="color:${c.color}">${c.name}</td>
                <td class="${active ? 'fw-bold' : ''}">${c.sys[1] > 900 ? '180+' : '< ' + c.sys[1]}</td>
                <td class="${active ? 'fw-bold' : ''}">${c.dia[1] > 900 ? '120+' : '< ' + c.dia[1]}</td>
                <td class="ls-1">
                    ${active ? '<span class="badge rounded-pill bg-dark">YOUR READING</span>' : '<span class="text-muted opacity-50">—</span>'}
                </td>
            </tr>
        `;
    }).join('');

    // Advice Logic
    const adviceMap = {
        'Normal': 'Excellent! Maintain your healthy habits.',
        'Elevated': 'Your BP is slightly elevated. Monitor your salt intake and stress.',
        'Hypertension Stage 1': 'Consult your doctor. Consider lifestyle changes.',
        'Hypertension Stage 2': 'High Risk. Medical guidance is likely necessary.',
        'Hypertensive Crisis': 'Emergency! Seek medical help immediately.'
    };

    let advHtml = `
        <div class="mt-4 p-4 rounded-4" style="background:${cat.color}10; border: 1px solid ${cat.color}20;">
            <div class="d-flex gap-3">
                <i class="fas fa-circle-info mt-1" style="color:${cat.color}"></i>
                <div>
                    <h6 class="fw-bold mb-1" style="color:${cat.color}">Analysis Insight</h6>
                    <p class="small text-muted mb-0">${adviceMap[cat.name]} MAP for this reading was <strong>${map} mmHg</strong>.</p>
                </div>
            </div>
        </div>
    `;
    document.getElementById('out-bp-advice').innerHTML = advHtml;
}

function quickBP(s, d) {
    document.getElementById('bp-sys').value = s;
    document.getElementById('bp-dia').value = d;
    calculateBP();
}

function copyBP() {
    const text = `Blood Pressure Status: ${document.getElementById('out-bp-cat').textContent}\nReading: ${document.getElementById('out-bp-reading').textContent}\nMAP: ${document.getElementById('out-bp-map').textContent}\n\nTracked via ToolsHub Health`;
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('bp-copy');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Reading Report', 2000);
    });
}

function shareBP() {
    if (navigator.share) {
        navigator.share({
            title: 'My Blood Pressure Reading',
            text: `I just checked my blood pressure using ToolsHub. My category is: ${document.getElementById('out-bp-cat').textContent}`,
            url: window.location.href
        });
    }
}

['bp-sys', 'bp-dia', 'bp-pulse', 'bp-pos', 'bp-time'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateBP);
});

document.addEventListener('DOMContentLoaded', calculateBP);
</script>
