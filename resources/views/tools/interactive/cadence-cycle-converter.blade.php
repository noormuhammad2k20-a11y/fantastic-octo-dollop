<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Drivetrain --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Drivetrain Gears</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Chainring Teeth (Front)</label>
                                <input type="number" id="gear-chainring" class="form-control form-control-lg rounded-3" value="50" min="20" max="65" step="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Cog Teeth (Rear)</label>
                                <input type="number" id="gear-cog" class="form-control form-control-lg rounded-3" value="15" min="9" max="52" step="1">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cadence & Wheel --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Cadence & Tires</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Pedal Cadence (RPM)</label>
                                <input type="number" id="pedal-cadence" class="form-control form-control-lg rounded-3" value="90" min="20" max="150" step="5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Tire Dimension</label>
                                <select id="tire-size" class="form-select form-select-lg rounded-3">
                                    <option value="700x25" selected>Road (700x25c - 2105mm)</option>
                                    <option value="700x28">Road (700x28c - 2136mm)</option>
                                    <option value="700x38">Gravel (700x38c - 2180mm)</option>
                                    <option value="29x22">MTB 29er (29"x2.2" - 2330mm)</option>
                                    <option value="27x21">MTB 27.5" (27.5"x2.1" - 2185mm)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Preferences --}}
                <div class="col-12">
                    <div class="p-4 rounded-4 bg-light border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Display Units</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Speed Unit</label>
                                <select id="speed-unit" class="form-select form-select-lg rounded-3">
                                    <option value="mph" selected>Miles per Hour (mph)</option>
                                    <option value="kph">Kilometers per Hour (km/h)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-ring="50" data-cog="15" data-cadence="90" data-tire="700x25">
                    Road Paceline (50x15, 90 RPM)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-ring="34" data-cog="28" data-cadence="80" data-tire="700x28">
                    Climbing Spin (34x28, 80 RPM)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-ring="32" data-cog="10" data-cadence="100" data-tire="29x22">
                    MTB Singletrack Sprint (32x10, 100 RPM)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-success btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #15803d; border-color: #15803d;">
                    <i class="fas fa-bicycle me-2"></i> Compute Speed Metrics
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #f0fdf4; color: #15803d;">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Speed & Gear Development Plan</h5>
                        <p class="text-muted small mb-0">Total speed, gearing development, and rotation analytics</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #15803d; border-color: #15803d;">
                        <i class="fas fa-copy me-1"></i> Copy Gearing Plan
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #15803d;" id="result-speed">24.5 mph</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1" id="result-ratio-label">Gear Ratio: 3.33 (50 / 15)</p>
            </div>

            <div class="row g-4">
                {{-- Drivetrain metrics --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-cog me-2 text-success"></i>Gearing Specifications</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Gear Ratio:</span>
                                <span class="fw-bold text-dark" id="out-ratio">3.33 : 1</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Gear Inches:</span>
                                <span class="fw-bold text-dark" id="out-gear-inches">87.8"</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Development (Rollout):</span>
                                <span class="fw-bold text-dark" id="out-rollout">23.0 ft per stroke</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Rotational metrics --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-redo me-2 text-primary"></i>Rotational Properties</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Wheel Revolutions:</span>
                                <span class="fw-bold text-dark" id="out-wheel-rpm">300 RPM</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Tire Circumference:</span>
                                <span class="fw-bold text-dark" id="out-circumference">2,105 mm</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Pedal Strokes / Mile:</span>
                                <span class="fw-bold text-dark" id="out-strokes-mile">230 strokes</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }
    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }
    .form-control-lg, .form-select-lg { border: 1.5px solid #cbd5e1; border-radius: 12px; font-size: 1rem; }
    .form-control:focus, .form-select:focus { border-color: #15803d; box-shadow: 0 0 0 4px rgba(21, 128, 61, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ringIn = document.getElementById('gear-chainring');
    const cogIn = document.getElementById('gear-cog');
    const cadenceIn = document.getElementById('pedal-cadence');
    const tireIn = document.getElementById('tire-size');
    const unitIn = document.getElementById('speed-unit');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateSpeed() {
        const ring = parseInt(ringIn.value) || 50;
        const cog = parseInt(cogIn.value) || 15;
        const cadence = parseFloat(cadenceIn.value) || 90;
        const tire = tireIn.value;
        const unit = unitIn.value;

        if (ring <= 0 || cog <= 0 || cadence <= 0) {
            alert("Please enter valid gears and cadence.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Gears...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Tire circumferences in mm & nominal diameter in inches
            let cMm = 2105;
            let diameterIn = 26.3;

            if (tire === '700x28') {
                cMm = 2136;
                diameterIn = 26.8;
            } else if (tire === '700x38') {
                cMm = 2180;
                diameterIn = 27.3;
            } else if (tire === '29x22') {
                cMm = 2330;
                diameterIn = 29.1;
            } else if (tire === '27x21') {
                cMm = 2185;
                diameterIn = 27.5;
            }

            const gearRatio = ring / cog;
            const gearInches = gearRatio * diameterIn;

            // Rollout distance in feet: (cMm * gearRatio) converted to feet
            // 1 mm = 0.00328084 feet
            const rolloutFt = cMm * gearRatio * 0.00328084;

            // Speed calculation
            // wheel RPM = cadence * gearRatio
            const wheelRpm = cadence * gearRatio;
            
            // Speed = wheelRpm * cMm (mm per minute)
            // mm per minute to km/h = (val * 60) / 1,000,000
            const speedKph = (wheelRpm * cMm * 60) / 1000000;
            const speedMph = speedKph * 0.621371;

            // Pedal strokes per mile:
            // 5280 feet per mile / rolloutFt
            const strokesMile = 5280 / rolloutFt;

            // Populate render outputs
            document.getElementById('result-ratio-label').innerText = `Gear Ratio: ${gearRatio.toFixed(2)} (${ring} / ${cog})`;
            
            if (unit === 'mph') {
                document.getElementById('result-speed').innerText = speedMph.toFixed(1) + " mph";
            } else {
                document.getElementById('result-speed').innerText = speedKph.toFixed(1) + " km/h";
            }

            document.getElementById('out-ratio').innerText = gearRatio.toFixed(2) + " : 1";
            document.getElementById('out-gear-inches').innerText = gearInches.toFixed(1) + " inches";
            document.getElementById('out-rollout').innerText = rolloutFt.toFixed(1) + " feet";
            
            document.getElementById('out-wheel-rpm').innerText = Math.round(wheelRpm) + " RPM";
            document.getElementById('out-circumference').innerText = cMm.toLocaleString() + " mm";
            document.getElementById('out-strokes-mile').innerText = Math.round(strokesMile) + " strokes";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-bicycle me-2"></i> Compute Speed Metrics';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateSpeed);

    btnReset.addEventListener('click', () => {
        ringIn.value = 50;
        cogIn.value = 15;
        cadenceIn.value = 90;
        tireIn.value = '700x25';
        unitIn.value = 'mph';
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            ringIn.value = this.dataset.ring;
            cogIn.value = this.dataset.cog;
            cadenceIn.value = this.dataset.cadence;
            tireIn.value = this.dataset.tire;
            calculateSpeed();
        });
    });

    btnCopy.addEventListener('click', function() {
        const speed = document.getElementById('result-speed').innerText;
        const ratioText = document.getElementById('result-ratio-label').innerText;
        const ratio = document.getElementById('out-ratio').innerText;
        const inches = document.getElementById('out-gear-inches').innerText;
        const rollout = document.getElementById('out-rollout').innerText;
        const wheelRpm = document.getElementById('out-wheel-rpm').innerText;
        const circ = document.getElementById('out-circumference').innerText;
        const strokes = document.getElementById('out-strokes-mile').innerText;

        const text = `CYCLING CADENCE & GEAR DEVELOPMENT REPORT\n` +
                     `===========================================\n` +
                     `Chainring: ${ringIn.value}T | Rear Cog: ${cogIn.value}T\n` +
                     `Target Cadence: ${cadenceIn.value} RPM | Tire Size: ${tireIn.options[tireIn.selectedIndex].text}\n\n` +
                     `CALCULATED SPEED: ${speed}\n` +
                     `${ratioText}\n\n` +
                     `DRIVETRAIN METRICS:\n` +
                     `- Gear Ratio: ${ratio}\n` +
                     `- Gear Inches: ${inches}\n` +
                     `- Gearing Rollout: ${rollout}\n\n` +
                     `ROTATIONAL ANALYSIS:\n` +
                     `- Wheel Speed: ${wheelRpm}\n` +
                     `- Circumference: ${circ}\n` +
                     `- Pedals / Mile: ${strokes}\n\n` +
                     `Generated via ToolsHub Cycling Cadence Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Gearing Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
