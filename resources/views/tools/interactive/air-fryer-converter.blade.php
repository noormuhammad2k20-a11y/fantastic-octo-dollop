<div class="row g-4 airfryer-calc-rebuilt">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(249, 115, 22, 0.1); color: #f97316;">
                    <i class="fas fa-wind"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Air Fryer Converter</h4>
                    <p class="text-muted small m-0">Translate standard oven recipes into precise air fryer temperature and time settings.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    {{-- Temperature Input --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Oven Temperature</label>
                        <div class="input-group">
                            <input type="number" id="oven-temp" class="form-control form-control-lg rounded-start-3" value="375" min="1" max="600">
                            <select id="temp-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 90px;">
                                <option value="F" selected>°F</option>
                                <option value="C">°C</option>
                            </select>
                        </div>
                        <span class="text-muted small mt-1 d-block">Recommended max: 450°F / 230°C</span>
                    </div>

                    {{-- Cooking Time Input --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Oven Baking Time</label>
                        <div class="input-group">
                            <input type="number" id="oven-time" class="form-control form-control-lg rounded-start-3" value="30" min="1" max="600">
                            <span class="input-group-text bg-white rounded-end-3 text-muted">minutes</span>
                        </div>
                        <span class="text-muted small mt-1 d-block">Standard baking duration</span>
                    </div>

                    {{-- Recipe Food Type Presets --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Food Category / Preset</label>
                        <select id="food-preset" class="form-select form-select-lg rounded-3">
                            <option value="custom" selected>Custom Recipe (General)</option>
                            <option value="fries" data-t="400" data-u="F" data-m="25">🍟 Frozen French Fries</option>
                            <option value="chicken" data-t="375" data-u="F" data-m="20">🍗 Chicken Breasts</option>
                            <option value="bacon" data-t="400" data-u="F" data-m="10">🥓 Bacon / Pork Strips</option>
                            <option value="salmon" data-t="350" data-u="F" data-m="12">🐟 Salmon / Fish Fillets</option>
                            <option value="veg" data-t="375" data-u="F" data-m="15">🥦 Roasted Vegetables</option>
                            <option value="cake" data-t="325" data-u="F" data-m="25">🍰 Cakes / Baking</option>
                        </select>
                        <span class="text-muted small mt-1 d-block">Optimizes time-reduction ratio</span>
                    </div>
                </div>

                {{-- Quick Temperature Presets --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Oven Temps:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 temp-quick" data-temp="325">325°F (160°C)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 temp-quick" data-temp="350">350°F (175°C)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 temp-quick" data-temp="375">375°F (190°C)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 temp-quick" data-temp="400">400°F (200°C)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 temp-quick" data-temp="425">425°F (220°C)</button>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Calculate Settings</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Output Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="airfryer-output-card" style="--tool-hue: 24; --tool-color: #f97316; --tool-bg: rgba(249, 115, 22, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Estimated Air Fryer Settings</span>
                <div class="output-hero-value my-2 text-gradient" id="out-airfryer-temp" style="font-size: 2.8rem; font-weight: 900;">350 °F</div>
                <span class="output-hero-unit fs-4 fw-bold" id="out-airfryer-time">24 minutes</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Oven Temp</span>
                        <span class="stat-card-value text-secondary" id="stat-oven-temp">375°F</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Oven Time</span>
                        <span class="stat-card-value text-secondary" id="stat-oven-time">30 mins</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Temp Drop</span>
                        <span class="stat-card-value text-gradient" id="stat-temp-drop">-25°F</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Time Saved</span>
                        <span class="stat-card-value text-success" id="stat-time-saved">6 mins</span>
                    </div>
                </div>
            </div>

            {{-- Progress Bar (Percentage Time Saved) --}}
            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="small fw-semibold text-muted">Cooking Time Reduced By:</span>
                    <span class="small fw-bold text-success" id="out-percent-saved">20% Faster</span>
                </div>
                <div class="progress rounded-pill shadow-inner" style="height: 12px; background: #e2e8f0;">
                    <div id="out-progress-bar" class="progress-bar rounded-pill" style="width: 20%; background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); transition: all 0.5s;"></div>
                </div>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Air Fryer Settings
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const ovenTemp = $('oven-temp');
    const tempUnit = $('temp-unit');
    const ovenTime = $('oven-time');
    const foodPreset = $('food-preset');
    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Presets Action
    foodPreset.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        if (option.value !== 'custom') {
            const presetTemp = parseFloat(option.getAttribute('data-t'));
            const presetUnit = option.getAttribute('data-u');
            const presetTime = parseFloat(option.getAttribute('data-m'));

            tempUnit.value = presetUnit;
            ovenTemp.value = presetTemp;
            ovenTime.value = presetTime;
            calculate();
        }
    });

    // Quick Select Temperature Action
    document.querySelectorAll('.temp-quick').forEach(btn => {
        btn.addEventListener('click', function() {
            foodPreset.value = 'custom';
            tempUnit.value = 'F';
            ovenTemp.value = this.getAttribute('data-temp');
            calculate();
        });
    });

    function calculate() {
        const t = parseFloat(ovenTemp.value) || 0;
        const u = tempUnit.value;
        const m = parseFloat(ovenTime.value) || 0;
        const preset = foodPreset.value;

        if (t <= 0 || m <= 0) return;

        // Custom time factor depending on food type
        let timeFactor = 0.80; // Default: 20% faster
        let tempDrop = 25; // Default: 25F drop

        if (u === 'C') {
            tempDrop = 15; // 15C drop
        }

        if (preset === 'cake') {
            timeFactor = 0.85; // 15% reduction
            tempDrop = (u === 'F') ? 15 : 10;
        } else if (preset === 'fries' || preset === 'bacon') {
            timeFactor = 0.75; // 25% faster
        }

        const afTemp = Math.round(t - tempDrop);
        const afTime = Math.max(1, Math.round(m * timeFactor));
        const timeDifference = Math.max(0, Math.round(m - afTime));
        const percentSaved = Math.round((1 - timeFactor) * 100);

        // Update Outputs
        $('out-airfryer-temp').textContent = afTemp + ' °' + u;
        $('out-airfryer-time').textContent = afTime + ' minutes';

        $('stat-oven-temp').textContent = t + '°' + u;
        $('stat-oven-time').textContent = m + ' mins';
        $('stat-temp-drop').textContent = '-' + tempDrop + '°' + u;
        $('stat-time-saved').textContent = timeDifference + ' mins';

        $('out-percent-saved').textContent = percentSaved + '% Faster';
        $('out-progress-bar').style.width = percentSaved + '%';

    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        ovenTemp.value = 375;
        tempUnit.value = 'F';
        ovenTime.value = 30;
        foodPreset.value = 'custom';
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const text = `Air Fryer Conversion Report\n-----------------------------------\nOven Settings: ${ovenTemp.value}°${tempUnit.value} for ${ovenTime.value} mins\nAir Fryer Settings: ${$('out-airfryer-temp').textContent} for ${$('out-airfryer-time').textContent}\nTime Saved: ${$('stat-time-saved').textContent}\nPreset Selected: ${foodPreset.options[foodPreset.selectedIndex].text}\n— ToolsHub Culinary Suite`;
        navigator.clipboard.writeText(text).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = orig, 2000);
        });
    });

    // Run calculation once initially
    calculate();
});
</script>

<style>
.airfryer-calc-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.airfryer-calc-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.airfryer-calc-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.airfryer-calc-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.airfryer-calc-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.airfryer-calc-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.airfryer-calc-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.airfryer-calc-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.airfryer-calc-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(249, 115, 22, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(249, 115, 22, 0.02);
}
.airfryer-calc-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.airfryer-calc-rebuilt .text-gradient {
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.airfryer-calc-rebuilt .progress-bar {
    border-radius: 10px;
}
.airfryer-calc-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
</style>
