<div class="container-fluid caffeine-sleep-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(120, 66, 18, 0.1); color:#78350f;">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Caffeine vs. Sleep Cycle Optimizer</h3>
                        <p class="tool-subtitle">Pharmacokinetic simulation of caffeine metabolism to determine sleep onset impact and residual stimulant levels.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Cups of Coffee (8oz)</label>
                            <div class="input-group-custom">
                                <input type="number" id="cups" class="form-control-custom" value="2" min="1" max="10">
                                <span class="input-addon">Cups</span>
                            </div>
                            <span class="text-muted tiny mt-1">~95mg caffeine per cup</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Consumption Time</label>
                            <input type="time" id="cons_time" class="form-control-custom" value="14:00">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Target Bedtime</label>
                            <input type="time" id="bed_time" class="form-control-custom" value="23:00">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Metabolism Rate (Sensitivity)</label>
                            <select id="sensitivity" class="form-select-custom">
                                <option value="fast">Fast Metabolizer (SHL 4h)</option>
                                <option value="normal" selected>Standard (SHL 6h)</option>
                                <option value="slow">Slow Metabolizer (SHL 8h)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Caffeine Type</label>
                            <select id="caf_type" class="form-select-custom">
                                <option value="coffee" selected>Standard Coffee (95mg)</option>
                                <option value="espresso">Espresso Shot (64mg)</option>
                                <option value="energy">Energy Drink (160mg)</option>
                                <option value="tea">Black Tea (47mg)</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#78350f;" onclick="calculateCoffeeSleep()">
                                    <i class="fas fa-moon me-2"></i> Predict Sleep Impact
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetCoffeeSleep()">
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
            <div class="output-card-themed" id="cs-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-sleep-badge">
                            <span class="hero-label">Sleep Disrupt Risk</span>
                            <h2 class="hero-value" id="risk-level">Moderate</h2>
                            <div class="hero-subtext mt-2">
                                <span id="residual-mg">45</span> mg remaining at bedtime
                            </div>
                            <div class="hero-status-pill mt-3" id="sleep-status">Caution Advised</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="metabolic-viz">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Metabolic Decay Curve</span>
                                <span class="small fw-bold text-coffee" id="intensity-text">Intensity: 42%</span>
                            </div>
                            <div class="metabolic-bar">
                                <div id="caf-indicator" class="metabolic-indicator"></div>
                                <div class="metabolic-segments">
                                    <div class="m-seg m-low"></div>
                                    <div class="m-seg m-mid"></div>
                                    <div class="m-seg m-high"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted fw-bold ls-1">
                                <span>Zero</span><span>Threshold</span><span>Peak Stim</span>
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-6">
                                <div class="stat-mini-card">
                                    <span class="sm-label">Peak Concentration</span>
                                    <span class="sm-value" id="peak-mg">190 mg</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-mini-card">
                                    <span class="sm-label">Hours to Clearance</span>
                                    <span class="sm-value" id="clearance-hrs">14.5 Hours</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="analysis-grid-soft py-3 px-4 rounded-4 bg-light">
                            <h6 class="fw-bold mb-3 small uppercase ls-1"><i class="fas fa-brain text-primary me-2"></i> Cognitive & Sleep Analysis</h6>
                            <div id="sleep-insights" class="small text-muted lh-base">
                                Residual caffeine blocks adenosine receptors, potentially delaying REM onset by up to 45 minutes. Expect increased fragmentation during the first half of the sleep cycle.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyCoffeeReport()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Sleep/Caffeine Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.caffeine-sleep-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #451a03; margin: 0; }
.tool-subtitle { color: #78350f; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #78350f; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.form-select-custom, .form-control-custom { background: #fffaf7; border: 1.5px solid #fed7aa; border-radius: 14px; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #451a03; outline: none; }

.input-group-custom { display: flex; align-items: stretch; background: #fffaf7; border: 1.5px solid #fed7aa; border-radius: 14px; overflow: hidden; }
.form-control-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #451a03; outline: none; }
.input-addon { display: flex; align-items: center; background: #ffedd5; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #78350f; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #fff7ed; border: none; width: 60px; height: 60px; border-radius: 16px; color: #9a3412; cursor: pointer; transition: 0.2s; }

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-sleep-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 3.5rem; font-weight: 900; color: #451a03; margin: 0.25rem 0; letter-spacing: -1px; }
.hero-subtext { font-size: 1.1rem; color: #78350f; font-weight: 700; }

.metabolic-bar { height: 12px; border-radius: 10px; position: relative; margin: 1.5rem 0; background: #f1f5f9; }
.metabolic-segments { position: absolute; width: 100%; height: 100%; display: flex; border-radius: 10px; overflow: hidden; opacity: 0.3; }
.m-seg { height: 100%; }
.m-low { width: 30%; background: #10b981; }
.m-mid { width: 40%; background: #fbbf24; }
.m-high { width: 30%; background: #ef4444; }

.metabolic-indicator { position: absolute; top: -8px; width: 4px; height: 28px; background: #451a03; border-radius: 10px; z-index: 2; border: 2px solid white; transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.stat-mini-card { background: #fffcf9; padding: 1.25rem; border-radius: 16px; border: 1px solid #fed7aa; }
.sm-label { display: block; font-size: 0.65rem; font-weight: 800; color: #9a3412; text-transform: uppercase; margin-bottom: 0.25rem; }
.sm-value { font-size: 1.1rem; font-weight: 800; color: #451a03; }

.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.text-coffee { color: #78350f; }
</style>

<script>
function calculateCoffeeSleep() {
    const cups = parseFloat(document.getElementById('cups').value) || 0;
    const sensValue = document.getElementById('sensitivity').value;
    const typeValue = document.getElementById('caf_type').value;
    const consTimeStr = document.getElementById('cons_time').value;
    const bedTimeStr = document.getElementById('bed_time').value;

    if (!consTimeStr || !bedTimeStr) return;

    // Caffeine mg
    const mgMap = { coffee: 95, espresso: 64, energy: 160, tea: 47 };
    const initialMg = cups * mgMap[typeValue];

    // Half-lives
    const hlMap = { fast: 4, normal: 6, slow: 8 };
    const hl = hlMap[sensValue];

    // Time diff in hours
    const consTime = new Date(`2000-01-01T${consTimeStr}:00`);
    let bedTime = new Date(`2000-01-01T${bedTimeStr}:00`);
    if (bedTime < consTime) bedTime.setDate(bedTime.getDate() + 1);

    const hoursDiff = (bedTime - consTime) / (1000 * 60 * 60);

    // Formula: Final_Mg = Initial_Mg * (1/2)^(Hours / HL)
    const residualMg = initialMg * Math.pow(0.5, hoursDiff / hl);
    
    // Clearance hours (threshold 10mg)
    const clearanceHrs = hl * (Math.log(initialMg / 10) / Math.log(2));

    displayCSResults(residualMg, initialMg, clearanceHrs);
}

function displayCSResults(res, peak, clear) {
    document.getElementById('peak-mg').innerText = Math.round(peak) + " mg";
    document.getElementById('residual-mg').innerText = Math.round(res);
    document.getElementById('clearance-hrs').innerText = clear.toFixed(1) + " Hours";

    let risk = "Low";
    let clr = "#10b981";
    let status = "Optimal Sleep";
    let insights = "Caffeine levels are negligible at bedtime. Your sleep architecture should remain undisturbed.";
    let pos = 15;

    if (res > 100) {
        risk = "Critical"; clr = "#ef4444"; status = "Severe Disruption";
        insights = "High caffeine volume will likely inhibit melatonin secretion and block adenosine receptors. Expect significant delay in sleep onset and poor REM quality.";
        pos = 85;
    } else if (res > 50) {
        risk = "High"; clr = "#f97316"; status = "Impacting Quality";
        insights = "Substantial stimulant presence. You may experience 'light' sleep with frequent awakenings and reduced deep sleep duration.";
        pos = 65;
    } else if (res > 25) {
        risk = "Moderate"; clr = "#fbbf24"; status = "Caution Advised";
        insights = "Moderate stimulant level. Sleep onset might be delayed by 20-30 minutes. Consider a relaxation protocol before bed.";
        pos = 45;
    }

    document.getElementById('risk-level').innerText = risk;
    document.getElementById('risk-level').style.color = clr;
    document.getElementById('intensity-text').innerText = `Intensity: ${Math.round((res / peak) * 100)}%`;
    document.getElementById('caf-indicator').style.left = pos + "%";
    document.getElementById('caf-indicator').style.background = clr;

    const pill = document.getElementById('sleep-status');
    pill.innerText = status;
    pill.style.background = clr + "15";
    pill.style.color = clr;
    pill.style.border = "1.5px solid " + clr + "30";

    document.getElementById('sleep-insights').innerText = insights;
}

function resetCoffeeSleep() {
    document.getElementById('cups').value = 2;
    document.getElementById('cons_time').value = "14:00";
    document.getElementById('bed_time').value = "23:00";
    calculateCoffeeSleep();
}

function copyCoffeeReport() {
    const risk = document.getElementById('risk-level').innerText;
    const res = document.getElementById('residual-mg').innerText;
    const peak = document.getElementById('peak-mg').innerText;
    const text = `Caffeine Sleep Impact Analysis\n━━━━━━━━━━━━━━━━━━━━━━\nRisk Level: ${risk}\nResidual at Bedtime: ${res} mg\nPeak Load: ${peak}\n\nOptimized via ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Sleep/Caffeine Report', 2000);
    });
}

// UI Triggers
['cups', 'cons_time', 'bed_time', 'sensitivity', 'caf_type'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateCoffeeSleep);
});

document.addEventListener('DOMContentLoaded', calculateCoffeeSleep);
</script>
