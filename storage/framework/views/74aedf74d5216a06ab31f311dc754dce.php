<div class="row g-4 smoking-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(185, 28, 28, 0.1); color: #b91c1c;">
                    <i class="fas fa-fire"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Meat Smoking Calculator</h4>
                    <p class="text-muted small m-0">Estimate your low-and-slow BBQ cook times, target internal pull temperatures, wrapping stages, and wood selection guidelines.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Meat Cut Selection</label>
                        <select id="meat-cut" class="form-select form-select-lg rounded-3">
                            <option value="brisket" selected>🥩 Beef Brisket (Whole Packer)</option>
                            <option value="porkbutt">🐖 Pork Butt / Shoulder (Pulled Pork)</option>
                            <option value="babyback">🐖 Baby Back Ribs (3-2-1 Method)</option>
                            <option value="stlouis">🐖 St. Louis Cut Ribs</option>
                            <option value="beefribs">🥩 Beef Short Ribs</option>
                            <option value="chicken">🍗 Whole Chicken</option>
                            <option value="turkey">🦃 Whole Turkey</option>
                        </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Meat Weight</label>
                        <div class="input-group">
                            <input type="number" id="meat-weight" class="form-control form-control-lg rounded-start-3" value="10" min="0.5" step="0.5">
                            <select id="weight-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 90px;">
                                <option value="lb" selected>lbs</option>
                                <option value="kg">kg</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Smoker Temperature</label>
                        <div class="input-group">
                            <input type="number" id="smoker-temp" class="form-control form-control-lg rounded-start-3" value="225" min="150" max="400">
                            <span class="input-group-text bg-white rounded-end-3 text-muted">°F</span>
                        </div>
                        <span class="text-muted small mt-1 d-block">Standard: 225°F – 275°F</span>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Cooks:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 smoke-preset" data-cut="brisket" data-w="12" data-t="225">🥩 Packer Brisket (12 lbs)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 smoke-preset" data-cut="porkbutt" data-w="8" data-t="225">🐖 Pork Shoulder (8 lbs)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 smoke-preset" data-cut="babyback" data-w="3.5" data-t="225">🐖 Baby Backs (3.5 lbs)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 smoke-preset" data-cut="chicken" data-w="4" data-t="275">🍗 Whole Chicken (4 lbs)</button>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Estimate Cook</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="smoking-output-card" style="--tool-hue: 0; --tool-color: #b91c1c; --tool-bg: rgba(185, 28, 28, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Estimated Total Cook Time</span>
                <div class="output-hero-value my-2 text-gradient" id="out-cook-time" style="font-size: 3rem; font-weight: 900;">15 hours</div>
                <span class="output-hero-unit fs-5 fw-bold text-dark" id="out-time-desc">Estimated pull window: 5:00 PM</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Target Internal Pull</span>
                        <span class="stat-card-value text-secondary" id="stat-pull-temp">203°F (95°C)</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Wrap Temperature</span>
                        <span class="stat-card-value text-secondary" id="stat-wrap-temp">165°F (74°C)</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Wood Selection</span>
                        <span class="stat-card-value text-gradient" id="stat-wood">Oak / Hickory</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Required Rest Time</span>
                        <span class="stat-card-value text-success" id="stat-rest">2 Hours</span>
                    </div>
                </div>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Smoke Blueprint
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const meatCut = $('meat-cut');
    const meatWeight = $('meat-weight');
    const weightUnit = $('weight-unit');
    const smokerTemp = $('smoker-temp');

    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Presets
    document.querySelectorAll('.smoke-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            meatCut.value = this.getAttribute('data-cut');
            meatWeight.value = this.getAttribute('data-w');
            weightUnit.value = 'lb';
            smokerTemp.value = this.getAttribute('data-t');
            calculate();
        });
    });

    function calculate() {
        const cut = meatCut.value;
        const wUnit = weightUnit.value;
        const rawW = parseFloat(meatWeight.value) || 0;
        const temp = parseFloat(smokerTemp.value) || 0;

        if (rawW <= 0 || temp <= 100) return;

        // Convert to lbs internally if kg selected
        const w = wUnit === 'kg' ? rawW * 2.20462 : rawW;

        let baseHoursPerLb = 1.25; // default
        let pullTemp = '203°F (95°C)';
        let wrapTemp = '165°F (74°C)';
        let wood = 'Oak / Hickory';
        let restTime = '2 Hours';
        let isRibs = false;

        switch (cut) {
            case 'brisket':
                baseHoursPerLb = 1.25;
                pullTemp = '203°F (95°C)';
                wrapTemp = '160°F – 165°F';
                wood = 'Post Oak / Hickory';
                restTime = '2 to 4 Hours';
                break;
            case 'porkbutt':
                baseHoursPerLb = 1.5;
                pullTemp = '205°F (96°C)';
                wrapTemp = '165°F (74°C)';
                wood = 'Apple / Cherry / Hickory';
                restTime = '1 Hour';
                break;
            case 'babyback':
                baseHoursPerLb = 1.71; // 6 hours flat for standard slab (around 3.5 lbs)
                pullTemp = '195°F – 200°F';
                wrapTemp = 'After 3 Hours (3-2-1 Method)';
                wood = 'Apple / Cherry';
                restTime = '15 Minutes';
                isRibs = true;
                break;
            case 'stlouis':
                baseHoursPerLb = 1.85; // 6.5 hours flat
                pullTemp = '195°F – 200°F';
                wrapTemp = 'After 3 Hours (3-2-1 Method)';
                wood = 'Hickory / Apple';
                restTime = '15 Minutes';
                isRibs = true;
                break;
            case 'beefribs':
                baseHoursPerLb = 1.6; // ~8 hours for typical 5lb rack
                pullTemp = '205°F (96°C)';
                wrapTemp = '160°F (no wrap optional)';
                wood = 'Post Oak / Mesquite';
                restTime = '1 Hour';
                break;
            case 'chicken':
                baseHoursPerLb = 0.75;
                pullTemp = '165°F (74°C)';
                wrapTemp = 'No Wrap (Crispy Skin)';
                wood = 'Apple / Pecan';
                restTime = '10 Minutes';
                break;
            case 'turkey':
                baseHoursPerLb = 0.6;
                pullTemp = '165°F (74°C)';
                wrapTemp = 'No Wrap (Foil Tent optional)';
                wood = 'Pecan / Cherry / Maple';
                restTime = '20 Minutes';
                break;
        }

        // Cook Time adjustment based on smoker temperature
        // 225°F is standard. Above that we cook faster. Below is slower.
        const tempFactor = 1.0 - ((temp - 225) / 100) * 0.75;
        
        let totalHours = 0;
        if (isRibs) {
            // Ribs cook times are standard and don't scale linearly by weight as much
            const baseRibHours = cut === 'babyback' ? 6.0 : 6.5;
            totalHours = baseRibHours * tempFactor;
        } else {
            totalHours = (w * baseHoursPerLb) * tempFactor;
        }

        // Keep values sane
        totalHours = Math.max(0.5, totalHours);

        const hours = Math.floor(totalHours);
        const minutes = Math.round((totalHours - hours) * 60);

        // UI rendering
        let renderTime = '';
        if (hours === 0) renderTime = `${minutes} mins`;
        else if (minutes === 0) renderTime = `${hours} hours`;
        else renderTime = `${hours} hrs ${minutes} mins`;

        $('out-cook-time').textContent = renderTime;

        // Pull window estimation
        const now = new Date();
        now.setMinutes(now.getMinutes() + Math.round(totalHours * 60));
        const options = { hour: '2-digit', minute: '2-digit' };
        $('out-time-desc').textContent = `If you start now, estimated pull window is: ${now.toLocaleTimeString([], options)}`;

        $('stat-pull-temp').textContent = pullTemp;
        $('stat-wrap-temp').textContent = wrapTemp;
        $('stat-wood').textContent = wood;
        $('stat-rest').textContent = restTime;


    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        meatCut.value = 'brisket';
        meatWeight.value = 10;
        weightUnit.value = 'lb';
        smokerTemp.value = 225;
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const cText = meatCut.options[meatCut.selectedIndex].text;
        const text = `Pitmaster Smoke Report\n-----------------------------------\nMeat: ${cText} (${meatWeight.value} ${weightUnit.value})\nSmoker Temperature: ${smokerTemp.value}°F\nEstimated Cook Duration: ${$('out-cook-time').textContent}\nTarget Pull Temp: ${$('stat-pull-temp').textContent}\nWrap Target: ${$('stat-wrap-temp').textContent}\nWood Pairing: ${$('stat-wood').textContent}\nRequired Rest: ${$('stat-rest').textContent}\n— ToolsHub Pitmaster Assistant`;
        
        navigator.clipboard.writeText(text).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = orig, 2000);
        });
    });

    // Run initially
    calculate();
});
</script>

<style>
.smoking-calc-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.smoking-calc-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.smoking-calc-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.smoking-calc-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.smoking-calc-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.smoking-calc-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.smoking-calc-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.smoking-calc-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.smoking-calc-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(185, 28, 28, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(185, 28, 28, 0.02);
}
.smoking-calc-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.smoking-calc-rebuilt .text-gradient {
    background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.smoking-calc-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\meat-smoking-calculator.blade.php ENDPATH**/ ?>