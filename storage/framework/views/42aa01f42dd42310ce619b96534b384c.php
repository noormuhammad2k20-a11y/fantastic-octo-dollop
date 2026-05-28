<div class="row g-4 sousvide-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(6, 182, 212, 0.1); color: #06b6d4;">
                    <i class="fas fa-water"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Sous Vide Calculator</h4>
                    <p class="text-muted small m-0">Determine precise water bath temperatures, thermal equilibrium heating times, and FDA-compliant pasteurization holding windows.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Protein Selection</label>
                        <select id="sv-meat" class="form-select form-select-lg rounded-3">
                            <option value="beef" selected>🥩 Beef, Lamb, or Game (Steak/Chops)</option>
                            <option value="pork">🐖 Pork (Chops or Tenderloin)</option>
                            <option value="chicken">🍗 Chicken Breast (Boneless)</option>
                            <option value="chickenthigh">🍗 Chicken Thigh / Dark Meat</option>
                            <option value="fish">🐟 Salmon, Halibut, or Fish Fillets</option>
                            <option value="veg">🥦 Root Vegetables / Asparagus</option>
                        </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Meat Thickness</label>
                        <div class="input-group">
                            <input type="number" id="sv-thickness" class="form-control form-control-lg rounded-start-3" value="1.5" min="0.25" max="6.0" step="0.25">
                            <select id="thickness-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 90px;">
                                <option value="in" selected>inches</option>
                                <option value="mm">mm</option>
                            </select>
                        </div>
                        <span class="text-muted small mt-1 d-block">Measured at thickest point</span>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Desired Doneness</label>
                        <select id="sv-doneness" class="form-select form-select-lg rounded-3">
                            <option value="rare">🔴 Rare (Delicate/Soft)</option>
                            <option value="medrare" selected>💗 Medium-Rare (Ideal/Juicy)</option>
                            <option value="medium">🌸 Medium (Firm/Traditional)</option>
                            <option value="welldone">🟤 Well-Done</option>
                        </select>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Baths:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 sv-preset" data-meat="beef" data-thick="1.5" data-done="medrare">🥩 Ribeye Steak (1.5")</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 sv-preset" data-meat="pork" data-thick="1.0" data-done="medium">🐖 Pork Chop (1.0")</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 sv-preset" data-meat="chicken" data-thick="1.25" data-done="medium">🍗 Chicken Breast (1.25")</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 sv-preset" data-meat="fish" data-thick="1.0" data-done="rare">🐟 Salmon Fillet (1.0")</button>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Calculate Bath</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="sousvide-output-card" style="--tool-hue: 188; --tool-color: #06b6d4; --tool-bg: rgba(6, 182, 212, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Recommended Water Bath Temperature</span>
                <div class="output-hero-value my-2 text-gradient" id="out-bath-temp" style="font-size: 3rem; font-weight: 900;">130 °F (54.5 °C)</div>
                <span class="output-hero-unit fs-5 fw-bold" id="out-bath-time">Estimated Cooking Time: 2 hours 15 minutes</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Bath Temperature</span>
                        <span class="stat-card-value text-secondary" id="stat-temp">130°F / 54.5°C</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Core Heat Time</span>
                        <span class="stat-card-value text-secondary" id="stat-heat-time">1 hr 45 mins</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Pasteurization Holding</span>
                        <span class="stat-card-value text-gradient" id="stat-hold-time">30 minutes</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Total Duration</span>
                        <span class="stat-card-value text-success" id="stat-total">2 hrs 15 mins</span>
                    </div>
                </div>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Sous Vide Blueprint
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const svMeat = $('sv-meat');
    const svThickness = $('sv-thickness');
    const thicknessUnit = $('thickness-unit');
    const svDoneness = $('sv-doneness');

    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Dynamically adjust doneness options based on meat cut
    svMeat.addEventListener('change', function() {
        const cut = this.value;
        const donenessEl = $('sv-doneness');
        donenessEl.innerHTML = '';

        if (cut === 'chicken' || cut === 'chickenthigh') {
            donenessEl.innerHTML = `
                <option value="tender" selected>🍗 Tender / Juicy (145°F / 63°C)</option>
                <option value="traditional">🍗 Traditional (150°F / 65.5°C)</option>
            `;
        } else if (cut === 'fish') {
            donenessEl.innerHTML = `
                <option value="rare" selected>🐟 Soft / Delicate (115°F / 46°C)</option>
                <option value="medium">🐟 Firm / Flaky (130°F / 54.5°C)</option>
            `;
        } else if (cut === 'veg') {
            donenessEl.innerHTML = `
                <option value="tender" selected>🥦 Tender / Fully Rendered (183°F / 84°C)</option>
            `;
        } else {
            donenessEl.innerHTML = `
                <option value="rare">🔴 Rare (125°F / 51.5°C)</option>
                <option value="medrare" selected>💗 Medium-Rare (130°F / 54.5°C)</option>
                <option value="medium">🌸 Medium (140°F / 60°C)</option>
                <option value="welldone">🟤 Well-Done (155°F / 68°C)</option>
            `;
        }
        calculate();
    });

    // Presets
    document.querySelectorAll('.sv-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            svMeat.value = this.getAttribute('data-meat');
            svMeat.dispatchEvent(new Event('change'));
            svThickness.value = this.getAttribute('data-thick');
            thicknessUnit.value = 'in';
            $('sv-doneness').value = this.getAttribute('data-done');
            calculate();
        });
    });

    function calculate() {
        const cut = svMeat.value;
        const thickVal = parseFloat(svThickness.value) || 0;
        const unit = thicknessUnit.value;
        const doneness = $('sv-doneness').value;

        if (thickVal <= 0) return;

        // Convert to inches internally
        const thick = unit === 'mm' ? thickVal / 25.4 : thickVal;

        let bathTempF = 130;
        let bathTempC = 54.5;
        let holdMinutes = 0;

        // Determine temperature
        if (cut === 'chicken') {
            if (doneness === 'tender') {
                bathTempF = 145; bathTempC = 63.0; holdMinutes = 30;
            } else {
                bathTempF = 150; bathTempC = 65.5; holdMinutes = 15;
            }
        } else if (cut === 'chickenthigh') {
            if (doneness === 'tender') {
                bathTempF = 160; bathTempC = 71.0; holdMinutes = 20;
            } else {
                bathTempF = 165; bathTempC = 74.0; holdMinutes = 10;
            }
        } else if (cut === 'fish') {
            if (doneness === 'rare') {
                bathTempF = 115; bathTempC = 46.0; holdMinutes = 0;
            } else {
                bathTempF = 130; bathTempC = 54.5; holdMinutes = 10;
            }
        } else if (cut === 'veg') {
            bathTempF = 183; bathTempC = 84.0; holdMinutes = 0;
        } else {
            // Beef / Pork
            if (doneness === 'rare') {
                bathTempF = 125; bathTempC = 51.5; holdMinutes = 0;
            } else if (doneness === 'medrare') {
                bathTempF = 130; bathTempC = 54.5; holdMinutes = 30; // 30m pasteurize holding
            } else if (doneness === 'medium') {
                bathTempF = 140; bathTempC = 60.0; holdMinutes = 20;
            } else {
                bathTempF = 155; bathTempC = 68.0; holdMinutes = 10;
            }
            if (cut === 'pork') {
                // Pork needs higher pasteurization minimums
                bathTempF = Math.max(bathTempF, 137);
                bathTempC = Math.max(bathTempC, 58.5);
                holdMinutes = Math.max(holdMinutes, 20);
            }
        }

        // Thermodynamic Heating Core time
        // Equation: t = 1.25 * thick^2 + 0.5 hours
        let heatHours = 1.25 * (thick * thick) + 0.3;
        
        // Root vegetables take slightly longer to fully break down
        if (cut === 'veg') heatHours = 1.5 * (thick * thick) + 0.5;

        const totalHours = heatHours + (holdMinutes / 60);

        // Deconstruct times
        const formatHoursMins = hr => {
            const h = Math.floor(hr);
            const m = Math.round((hr - h) * 60);
            if (h === 0) return `${m} mins`;
            if (m === 0) return `${h} hr${h > 1 ? 's' : ''}`;
            return `${h} hr${h > 1 ? 's' : ''} ${m} mins`;
        };

        // Render stats
        $('out-bath-temp').innerHTML = `${bathTempF} °F <span class="fs-4 text-muted">/ ${bathTempC.toFixed(1)} °C</span>`;
        $('out-bath-time').textContent = `Total Estimated Duration: ${formatHoursMins(totalHours)}`;

        $('stat-temp').textContent = `${bathTempF}°F / ${bathTempC.toFixed(1)}°C`;
        $('stat-heat-time').textContent = formatHoursMins(heatHours);
        $('stat-hold-time').textContent = holdMinutes > 0 ? `${holdMinutes} minutes` : 'None Required';
        $('stat-total').textContent = formatHoursMins(totalHours);


    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        svMeat.value = 'beef';
        svMeat.dispatchEvent(new Event('change'));
        svThickness.value = 1.5;
        thicknessUnit.value = 'in';
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const cText = svMeat.options[svMeat.selectedIndex].text;
        const dText = $('sv-doneness').options[$('sv-doneness').selectedIndex].text;
        const text = `Gourmet Sous Vide Circulator Report\n-----------------------------------\nProtein: ${cText}\nThickness: ${svThickness.value} ${thicknessUnit.value}\nStyle: ${dText}\n\nWater Bath Temperature: ${$('stat-temp').textContent}\nCore Heat Time: ${$('stat-heat-time').textContent}\nPasteurization Hold: ${$('stat-hold-time').textContent}\nTotal Circulator Time: ${$('stat-total').textContent}\n— ToolsHub Culinary Suite`;
        
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
.sousvide-calc-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.sousvide-calc-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.sousvide-calc-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.sousvide-calc-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.sousvide-calc-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.sousvide-calc-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.sousvide-calc-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.sousvide-calc-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.sousvide-calc-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(6, 182, 212, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(6, 182, 212, 0.02);
}
.sousvide-calc-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.sousvide-calc-rebuilt .text-gradient {
    background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.sousvide-calc-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\sous-vide-calculator.blade.php ENDPATH**/ ?>