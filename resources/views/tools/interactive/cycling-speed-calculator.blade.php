<div class="container-fluid cycling-speed-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(16, 185, 129, 0.1); color:#10b981;">
                        <i class="fas fa-person-cycling"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Velocimetric Cycling Analytics</h3>
                        <p class="tool-subtitle">Calculate aerodynamic performance, average speed, and estimated power output across variable terrain and durations.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Total Distance</label>
                            <div class="input-group-custom">
                                <input type="number" id="distance" class="form-control-custom" value="40" step="0.1">
                                <span class="input-addon dist-unit">km</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Moving Time</label>
                            <div class="d-flex gap-2">
                                <div class="input-group-custom flex-grow-1">
                                    <input type="number" id="time_h" class="form-control-custom" value="1" placeholder="H">
                                    <span class="input-addon">h</span>
                                </div>
                                <div class="input-group-custom flex-grow-1">
                                    <input type="number" id="time_m" class="form-control-custom" value="30" placeholder="M">
                                    <span class="input-addon">m</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Elevation Gain</label>
                            <div class="input-group-custom">
                                <input type="number" id="elevation" class="form-control-custom" value="200" step="1">
                                <span class="input-addon elev-unit">m</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Rider Weight (Incl. Bike)</label>
                            <div class="input-group-custom">
                                <input type="number" id="rider_weight" class="form-control-custom" value="85" step="0.1">
                                <span class="input-addon weight-unit">kg</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Terrain Type</label>
                            <select id="terrain" class="form-select-custom">
                                <option value="flat" selected>Flat / Rolling (Tarmac)</option>
                                <option value="climb">Hill Climb (Alpe d'Huez style)</option>
                                <option value="offroad">Gravel / MTB</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4 text-center">
                            <div class="d-inline-flex bg-light p-1 rounded-pill">
                                <button class="btn btn-sm px-4 rounded-pill btn-unit active" data-unit="metric">Metric (km/h)</button>
                                <button class="btn btn-sm px-4 rounded-pill btn-unit" data-unit="imperial">Imperial (mph)</button>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#10b981;" onclick="calculateCycling()">
                                    <i class="fas fa-stopwatch me-2"></i> Compute Performance Stats
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetCycling()">
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
            <div class="output-card-themed" id="cy-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-speed-badge">
                            <span class="hero-label">Average Velocity</span>
                            <h2 class="hero-value" id="final-speed">26.7</h2>
                            <div class="hero-unit-tag speed-unit">km/h</div>
                            <div class="hero-status-pill mt-3" id="cycling-status">Club Rider</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="performance-viz">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted fw-bold">Intensity Spectrum</span>
                                <span class="small fw-bold text-success" id="intensity-level">Moderate</span>
                            </div>
                            <div class="intensity-bar">
                                <div id="cy-indicator" class="intensity-indicator"></div>
                                <div class="intensity-segments">
                                    <div class="i-seg i-recreational"></div>
                                    <div class="i-seg i-club"></div>
                                    <div class="i-seg i-elite"></div>
                                    <div class="i-seg i-pro"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1 tiny text-muted fw-bold ls-1">
                                <span>Rec</span><span>Club</span><span>Elite</span><span>Tour</span>
                            </div>
                        </div>

                        <div class="row g-3 mt-4">
                            <div class="col-6">
                                <div class="stat-mini-card">
                                    <span class="sm-label">Est. Avg Power</span>
                                    <span class="sm-value" id="est-power">185 W</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-mini-card">
                                    <span class="sm-label">Pace per Unit</span>
                                    <span class="sm-value" id="pace-val">2:15 min/km</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="analysis-box py-3 px-4 rounded-4 bg-light">
                            <h6 class="fw-bold mb-2 small uppercase ls-1 text-primary"><i class="fas fa-chart-simple me-2"></i> Aerodynamic Intelligence</h6>
                            <p id="cycling-insights" class="small text-muted mb-0">
                                This speed corresponds to a standard aerobic endurance intensity. Efficiency can be improved by optimizing riding position by approximately 15%.
                            </p>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3 border-top">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyCyclingReport()">
                                    <i class="fas fa-copy me-2 text-info"></i> Copy Ride Stats
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn d-block mx-auto -action-outline py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="shareRide()">
                                    <i class="fas fa-share-nodes me-2"></i> Share Ride
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
.cycling-speed-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.btn-unit.active { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); color: #1e293b; font-weight: 800; }
.btn-unit { color: #64748b; font-weight: 600; border: none; }

.input-group-custom { display: flex; align-items: stretch; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
.form-control-custom, .form-select-custom { background: transparent; border: none; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; }
.input-addon { display: flex; align-items: center; background: #f1f5f9; padding: 0 1.25rem; font-size: 0.8rem; font-weight: 700; color: #64748b; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-speed-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; }
.hero-value { font-size: 6rem; font-weight: 900; color: #1e293b; margin: 0.25rem 0; letter-spacing: -4px; line-height: 1; }
.hero-unit-tag { font-size: 1.5rem; font-weight: 800; color: #10b981; letter-spacing: 1px; }

.intensity-bar { height: 12px; border-radius: 10px; position: relative; margin: 1.5rem 0; background: #f1f5f9; }
.intensity-segments { position: absolute; width: 100%; height: 100%; display: flex; border-radius: 10px; overflow: hidden; opacity: 0.3; }
.i-seg { height: 100%; }
.i-recreational { width: 25%; background: #94a3b8; }
.i-club { width: 35%; background: #10b981; }
.i-elite { width: 25%; background: #3b82f6; }
.i-pro { width: 15%; background: #a855f7; }

.intensity-indicator { position: absolute; top: -8px; width: 4px; height: 28px; background: #1e293b; border-radius: 10px; z-index: 2; border: 2px solid white; transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

.stat-mini-card { background: #f8fafc; padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.02); }
.sm-label { display: block; font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.25rem; }
.sm-value { font-size: 1.1rem; font-weight: 800; color: #1e293b; }

.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }
.btn-action-outline { background: transparent; border: 2px solid #e2e8f0; color: #1e293b; padding: calc(1.1rem - 2px); border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.uppercase { text-transform: uppercase; }
.tiny { font-size: 0.7rem; }
</style>

<script>
function calculateCycling() {
    const unit = document.querySelector('.btn-unit.active').dataset.unit;
    const dist = parseFloat(document.getElementById('distance').value) || 0;
    const h = parseFloat(document.getElementById('time_h').value) || 0;
    const m = parseFloat(document.getElementById('time_m').value) || 0;
    const elev = parseFloat(document.getElementById('elevation').value) || 0;
    const weight = parseFloat(document.getElementById('rider_weight').value) || 0;
    const terrain = document.getElementById('terrain').value;

    if (dist <= 0 || (h === 0 && m === 0)) return;

    const totalHours = h + (m / 60);
    const speed = dist / totalHours;

    // Estimated Power calculation (Simplified Watts)
    // P = P_rolling + P_air + P_gravity
    // Assuming CdA 0.35, Crr 0.005
    const speed_mps = (unit === 'imperial' ? speed * 1.60934 : speed) / 3.6;
    const weight_kg = unit === 'imperial' ? weight * 0.453592 : weight;
    const grade = (elev / (dist * 1000));
    
    // Simplistic power model
    const gravityPower = 9.81 * weight_kg * grade * speed_mps;
    const airPower = 0.5 * 1.225 * 0.35 * Math.pow(speed_mps, 3);
    const rollingPower = 9.81 * weight_kg * 0.005 * speed_mps;
    const totalWatts = Math.round(gravityPower + airPower + rollingPower);

    displayCyclingResults(speed, totalWatts, unit);
}

function displayCyclingResults(speed, watts, unit) {
    document.getElementById('final-speed').innerText = speed.toFixed(1);
    document.getElementById('est-power').innerText = Math.max(20, watts) + " W";
    
    const pace = 60 / speed;
    const m = Math.floor(pace);
    const s = Math.round((pace - m) * 60);
    document.getElementById('pace-val').innerText = `${m}:${s.toString().padStart(2, '0')} min/${unit === 'metric' ? 'km' : 'mi'}`;

    let status = "Club Rider";
    let clr = "#10b981";
    let level = "Moderate";
    let pos = 45;
    
    // Scale speed for benchmarks (km/h)
    const normSpeed = unit === 'imperial' ? speed * 1.60934 : speed;

    if (normSpeed > 45) {
        status = "Pro / Tour"; clr = "#a855f7"; level = "Exceptional"; pos = 92;
    } else if (normSpeed > 35) {
        status = "Elite / Cat 1"; clr = "#3b82f6"; level = "High Performance"; pos = 75;
    } else if (normSpeed > 30) {
        status = "Advanced Club"; clr = "#10b981"; level = "Strong"; pos = 55;
    } else if (normSpeed < 20) {
        status = "Recreational"; clr = "#94a3b8"; level = "Easy Pace"; pos = 15;
    }

    const pill = document.getElementById('cycling-status');
    pill.innerText = status;
    pill.style.background = clr + "15";
    pill.style.color = clr;
    pill.style.border = "1.5px solid " + clr + "30";
    
    document.getElementById('intensity-level').innerText = level;
    document.getElementById('intensity-level').style.color = clr;
    document.getElementById('cy-indicator').style.left = pos + "%";
    document.getElementById('cy-indicator').style.background = clr;

    const insights = normSpeed > 35 
        ? "Excellent aerodynamic efficiency. To increase speed further, focus on interval training at threshold levels."
        : "Steady performance. Increasing cadence and reducing frontal area could yield significant speed gains.";
    document.getElementById('cycling-insights').innerText = insights;
}

function resetCycling() {
    document.getElementById('distance').value = 40;
    document.getElementById('time_h').value = 1;
    document.getElementById('time_m').value = 30;
    calculateCycling();
}

function copyCyclingReport() {
    const speed = document.getElementById('final-speed').innerText;
    const unit = document.querySelector('.speed-unit').innerText;
    const power = document.getElementById('est-power').innerText;
    const status = document.getElementById('cycling-status').innerText;
    const text = `Ride Performance Report\n━━━━━━━━━━━━━━━━━━━━━━\nAvg Speed: ${speed} ${unit}\nEstimated Power: ${power}\nClassification: ${status}\n\nTracked via ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Report Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Ride Stats', 2000);
    });
}

function shareRide() {
    if (navigator.share) {
        navigator.share({
            title: 'My Cycling Performance',
            text: `I just analyzed my ride on ToolsHub. My average speed was ${document.getElementById('final-speed').innerText} ${document.querySelector('.speed-unit').innerText}!`,
            url: window.location.href
        });
    }
}

// UI Triggers
document.querySelectorAll('.btn-unit').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-unit').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const unit = this.dataset.unit;
        document.querySelector('.dist-unit').innerText = unit === 'metric' ? 'km' : 'mi';
        document.querySelector('.speed-unit').innerText = unit === 'metric' ? 'km/h' : 'mph';
        document.querySelector('.elev-unit').innerText = unit === 'metric' ? 'm' : 'ft';
        document.querySelector('.weight-unit').innerText = unit === 'metric' ? 'kg' : 'lbs';
        calculateCycling();
    });
});

['distance', 'time_h', 'time_m', 'elevation', 'rider_weight', 'terrain'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateCycling);
});

document.addEventListener('DOMContentLoaded', calculateCycling);
</script>
