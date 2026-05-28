<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Room Dimensions</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Dimension Unit</label>
                                <select id="ac-unit" class="form-select form-select-lg rounded-3">
                                    <option value="ft">Feet (Imperial)</option>
                                    <option value="m">Meters (Metric)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Room Length</label>
                                <input type="number" id="ac-length" class="form-control form-control-lg rounded-3" value="15" min="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Room Width</label>
                                <input type="number" id="ac-width" class="form-control form-control-lg rounded-3" value="12" min="1">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Ceiling Height</label>
                                <div class="input-group">
                                    <input type="number" id="ac-height" class="form-control form-control-lg rounded-start-3" value="8" min="5" step="0.5">
                                    <span class="input-group-text rounded-end-3" id="ac-height-unit">ft</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Thermal factors</h6>
                        <div class="row g-3">
                            <div class="col-md-6 col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Sunlight Exposure</label>
                                <select id="ac-sun" class="form-select form-select-lg rounded-3">
                                    <option value="shaded">Heavily Shaded (-10%)</option>
                                    <option value="moderate" selected>Average Sun (Base)</option>
                                    <option value="sunny">Very Sunny (+10%)</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Insulation Grade</label>
                                <select id="ac-insulation" class="form-select form-select-lg rounded-3">
                                    <option value="excellent">Excellent / Sealed</option>
                                    <option value="normal" selected>Normal Insulation</option>
                                    <option value="poor">Poor / Unsealed (+1.5k BTU)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Occupants</label>
                                <input type="number" id="ac-occupants" class="form-control form-control-lg rounded-3" value="2" min="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Room is Kitchen?</label>
                                <select id="ac-kitchen" class="form-select form-select-lg rounded-3">
                                    <option value="no">No</option>
                                    <option value="yes">Yes (+4k BTU)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Calculate Cooling Capacity
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Required Cooling Capacity</h5>
                        <p class="text-muted small mb-0">Recommended equipment specifications based on room load</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy">
                        <i class="fas fa-copy me-1"></i> Copy AC Specs
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0 font-monospace" id="out-btu">0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">BTU / Hour Required</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-ton-badge" style="background-color: #10b981; color: #fff;">0.0 Ton</span>
                    </div>
                </div>

                
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Estimated Horsepower</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-hp">0.0 HP</div>
                                <div class="x-small text-muted fw-bold">Compressor Size</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Cooling Output</div>
                                <div class="h5 fw-bold mb-0 text-success" id="out-kw">0.00 kW</div>
                                <div class="x-small text-muted fw-bold">Thermodynamic equivalent</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center">Calculated Room Insights</h6>
                        <ul class="list-unstyled mb-0 small text-secondary" id="out-insights">
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --danger-soft: #fef2f2;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-danger-soft { background-color: var(--danger-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1.5px solid #e2e8f0; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.05rem; padding: 0.65rem 0.85rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .font-monospace { font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const lInput = document.getElementById('ac-length');
    const wInput = document.getElementById('ac-width');
    const hInput = document.getElementById('ac-height');
    const unitSelect = document.getElementById('ac-unit');
    const heightUnitLabel = document.getElementById('ac-height-unit');

    const sunSelect = document.getElementById('ac-sun');
    const insulationSelect = document.getElementById('ac-insulation');
    const occupantsInput = document.getElementById('ac-occupants');
    const kitchenSelect = document.getElementById('ac-kitchen');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    const outBtu = document.getElementById('out-btu');
    const outTonBadge = document.getElementById('out-ton-badge');
    const outHp = document.getElementById('out-hp');
    const outKw = document.getElementById('out-kw');
    const outInsights = document.getElementById('out-insights');

    // Unit toggle change listener
    unitSelect.addEventListener('change', function() {
        const val = unitSelect.value;
        if (val === 'm') {
            heightUnitLabel.textContent = 'm';
            if (lInput.value == '15') lInput.value = '4.5';
            if (wInput.value == '12') wInput.value = '3.5';
            if (hInput.value == '8') hInput.value = '2.5';
        } else {
            heightUnitLabel.textContent = 'ft';
            if (lInput.value == '4.5') lInput.value = '15';
            if (wInput.value == '3.5') wInput.value = '12';
            if (hInput.value == '2.5') hInput.value = '8';
        }
    });

    function calculate() {
        const length = parseFloat(lInput.value) || 0;
        const width = parseFloat(wInput.value) || 0;
        const height = parseFloat(hInput.value) || 0;
        const occupants = parseInt(occupantsInput.value) || 1;
        const isMetric = unitSelect.value === 'm';

        if (length <= 0 || width <= 0 || height <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Calculating...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Convert to square feet and standard height multiplier
            let areaSqFt = length * width;
            let heightFt = height;

            if (isMetric) {
                // 1 meter = 3.28084 feet
                areaSqFt = (length * 3.28084) * (width * 3.28084);
                heightFt = height * 3.28084;
            }

            // Standard ASHRAE rule: 20 BTUs per square foot as a baseline
            let baseBTU = areaSqFt * 20;

            // Adjust for high ceilings
            if (heightFt > 8) {
                baseBTU = baseBTU * (heightFt / 8);
            }

            // Adjust for sun exposure
            let sunMultiplier = 1.0;
            const sunVal = sunSelect.value;
            if (sunVal === 'shaded') sunMultiplier = 0.9;
            else if (sunVal === 'sunny') sunMultiplier = 1.1;
            
            let finalBTU = baseBTU * sunMultiplier;

            // Adjust for occupants (add 600 BTUs for each occupant after the first 2)
            if (occupants > 2) {
                finalBTU += (occupants - 2) * 600;
            }

            // Adjust for insulation quality
            const insulation = insulationSelect.value;
            if (insulation === 'poor') finalBTU += 1500;
            else if (insulation === 'excellent') finalBTU -= 1000;

            // Kitchen modifier
            if (kitchenSelect.value === 'yes') {
                finalBTU += 4000;
            }

            // Enforce minimum base
            finalBTU = Math.max(5000, Math.round(finalBTU));

            // Compute equivalent tonnage (1 Ton = 12,000 BTU/h)
            const tons = finalBTU / 12000;
            
            // HP estimates (Roughly 1 HP ≈ 9,000 to 10,000 BTUs/h cooling capacity depending on SEER)
            const hp = finalBTU / 9000;
            
            // kW thermal equivalent (1 BTU/h = 0.000293071 kW)
            const kw = finalBTU * 0.000293071;

            // Render Output
            outBtu.textContent = finalBTU.toLocaleString();
            outTonBadge.textContent = `${tons.toFixed(1)} Ton Capacity`;
            outHp.textContent = `${hp.toFixed(1)} HP`;
            outKw.textContent = `${kw.toFixed(2)} kW`;

            // Insights list building
            const ins = [];
            ins.push(`Calculated active floor area: <strong>${Math.round(length * width)} ${isMetric ? 'm²' : 'sq. ft.'}</strong>.`);
            if (heightFt > 8) {
                ins.push(`Applied a <strong>+${Math.round((heightFt/8 - 1)*100)}% ceiling volume load multiplier</strong> for high ceilings (${heightFt.toFixed(1)} ft).`);
            }
            if (sunVal === 'sunny') {
                ins.push(`Added <strong>10% sunlight factor allowance</strong> for high solar heat ingress.`);
            } else if (sunVal === 'shaded') {
                ins.push(`Deducted <strong>10% shaded factor allowance</strong> for minimal solar heat ingress.`);
            }
            if (occupants > 2) {
                ins.push(`Occupancy heat adjustment: <strong>+${(occupants - 2) * 600} BTU</strong> added for ${occupants} occupants.`);
            }
            if (kitchenSelect.value === 'yes') {
                ins.push(`Kitchen heat load appliance compensation: <strong>+4,000 BTU</strong> added.`);
            }
            ins.push(`Recommended standard air conditioning unit size: <strong>${tons.toFixed(1)} Tons</strong>.`);

            outInsights.innerHTML = ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Calculate Cooling Capacity';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        lInput.value = unitSelect.value === 'm' ? '4.5' : '15';
        wInput.value = unitSelect.value === 'm' ? '3.5' : '12';
        hInput.value = unitSelect.value === 'm' ? '2.5' : '8';
        sunSelect.value = 'moderate';
        insulationSelect.value = 'normal';
        occupantsInput.value = '2';
        kitchenSelect.value = 'no';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Air Conditioning Load Report\n━━━━━━━━━━━━━━━━━━━━━━\nRoom Dimensions: ${lInput.value} x ${wInput.value} (${unitSelect.value})\nTotal Heat Load: ${outBtu.textContent} BTU/hr\nRecommended Capacity: ${outTonBadge.textContent}\nPower Equivalents: ${outHp.textContent} / ${outKw.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btnCopy.innerHTML;
            btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btnCopy.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                btnCopy.innerHTML = originalText;
                btnCopy.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\air-conditioner-btu-calculator.blade.php ENDPATH**/ ?>