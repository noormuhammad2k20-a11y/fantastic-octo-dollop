<div class="row g-4 soap-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Lye Type (NaOH vs KOH)</label>
                        <select id="lye-type" class="form-select rounded-3 border-emerald-custom">
                            <option value="naoh" selected>NaOH (Sodium Hydroxide - Hard Bar Soap)</option>
                            <option value="koh">KOH (Potassium Hydroxide - Liquid Soap)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom d-flex justify-content-between">
                            <span>Superfat Percentage</span>
                            <span class="fw-bold text-emerald" id="superfat-display">5%</span>
                        </label>
                        <div class="pt-2">
                            <input type="range" id="superfat-rate" class="form-range" min="0" max="15" step="1" value="5">
                            <div class="d-flex justify-content-between small text-muted">
                                <span>0% (Stripped)</span>
                                <span>5% (Balanced)</span>
                                <span>15% (Extra Mild)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Weight Unit</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-emerald active flex-grow-1 py-2 fw-bold rounded-3 unit-toggle-btn" data-unit="oz">
                                Ounces (oz)
                            </button>
                            <button type="button" class="btn btn-outline-emerald flex-grow-1 py-2 fw-bold rounded-3 unit-toggle-btn" data-unit="grams">
                                Grams (g)
                            </button>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Water Ratio Calculation</label>
                        <select id="water-calc-type" class="form-select rounded-3">
                            <option value="percent" selected>Water as % of Total Oil Weight (Standard 33%)</option>
                            <option value="ratio2">Water-to-Lye Ratio (2:1 - Advanced Discount)</option>
                            <option value="ratio3">Water-to-Lye Ratio (3:1 - High Water)</option>
                        </select>
                    </div>
                    <div id="water-pct-wrapper" class="col-md-6">
                        <label class="form-label-custom d-flex justify-content-between">
                            <span>Water Strength Percentage</span>
                            <span id="water-pct-display">33%</span>
                        </label>
                        <input type="range" id="water-pct-slider" class="form-range" min="25" max="40" step="1" value="33">
                    </div>
                </div>

                
                <div class="mt-4 p-4 rounded-3 bg-light border border-emerald-light">
                    <h6 class="fw-bold mb-3 text-emerald"><i class="fas fa-seedling me-2"></i>Soap Making Fats & Oils (Enter Weights)</h6>
                    <div class="row g-3">
                        <div class="col-6 col-md-4">
                            <label class="form-label-custom-small">Olive Oil (Pure/Pomace)</label>
                            <div class="input-group input-group-sm">
                                <input type="number" id="oil-olive" class="form-control oil-input" value="16" min="0" step="0.1">
                                <span class="input-group-text unit-text-label">oz</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label-custom-small">Coconut Oil (76°F / 92°F)</label>
                            <div class="input-group input-group-sm">
                                <input type="number" id="oil-coconut" class="form-control oil-input" value="8" min="0" step="0.1">
                                <span class="input-group-text unit-text-label">oz</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label-custom-small">Palm Oil (Sustainable)</label>
                            <div class="input-group input-group-sm">
                                <input type="number" id="oil-palm" class="form-control oil-input" value="8" min="0" step="0.1">
                                <span class="input-group-text unit-text-label">oz</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label-custom-small">Castor Oil</label>
                            <div class="input-group input-group-sm">
                                <input type="number" id="oil-castor" class="form-control oil-input" value="2" min="0" step="0.1">
                                <span class="input-group-text unit-text-label">oz</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label-custom-small">Shea Butter (Refined)</label>
                            <div class="input-group input-group-sm">
                                <input type="number" id="oil-shea" class="form-control oil-input" value="2" min="0" step="0.1">
                                <span class="input-group-text unit-text-label">oz</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label-custom-small">Sweet Almond Oil</label>
                            <div class="input-group input-group-sm">
                                <input type="number" id="oil-almond" class="form-control oil-input" value="0" min="0" step="0.1">
                                <span class="input-group-text unit-text-label">oz</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(5,150,105,.04);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL LYE REQUIRED</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value text-emerald" id="out-lye-weight">4.76</span>
                    <span class="output-hero-unit" id="out-lye-unit">oz</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-lye-status">Sodium Hydroxide (NaOH) Bar Formulation</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Water Required</span>
                        <span class="stat-card-value text-dark" id="out-water-weight">11.88 oz</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Total Oil Weight</span>
                        <span class="stat-card-value text-dark" id="out-oils-weight">36.0 oz</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Total Batch Weight</span>
                        <span class="stat-card-value text-dark" id="out-total-batch">52.64 oz</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Lye Concentration</span>
                        <span class="stat-card-value text-dark" id="out-lye-conc">28.6%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-shield-halved text-emerald me-2"></i>Critical Soap Safety Warnings
                </h6>
                <div id="out-soap-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="soap-copy-btn">
                        <i class="fas fa-copy me-2 text-emerald"></i>Copy Soap Recipe
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="soap-reset">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="soap-share-btn">
                        <i class="fas fa-share-alt me-2"></i>Share Saponification Specs
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const lyeTypeE = $('lye-type'),
          superfatRateE = $('superfat-rate'),
          superfatDisplayE = $('superfat-display'),
          waterCalcTypeE = $('water-calc-type'),
          waterPctSliderE = $('water-pct-slider'),
          waterPctDisplayE = $('water-pct-display');

    // Oils
    const oliveE = $('oil-olive'),
          coconutE = $('oil-coconut'),
          palmE = $('oil-palm'),
          castorE = $('oil-castor'),
          sheaE = $('oil-shea'),
          almondE = $('oil-almond');

    let currentUnit = 'oz';

    // NaOH Saponification (SAP) Values
    const sapValues = {
        olive: 0.135,
        coconut: 0.191,
        palm: 0.141,
        castor: 0.128,
        shea: 0.128,
        almond: 0.136
    };

    function calculateSoap() {
        const lyeType = lyeTypeE.value;
        const superfat = parseFloat(superfatRateE.value) || 0;
        const waterCalc = waterCalcTypeE.value;
        const waterPctVal = parseFloat(waterPctSliderE.value) || 33;

        superfatDisplayE.textContent = `${superfat}%`;
        waterPctDisplayE.textContent = `${waterPctVal}%`;

        // Check toggled panel visibility
        if (waterCalc === 'percent') {
            $('water-pct-wrapper').classList.remove('d-none');
        } else {
            $('water-pct-wrapper').classList.add('d-none');
        }

        // Get oil weights
        const olive = parseFloat(oliveE.value) || 0;
        const coconut = parseFloat(coconutE.value) || 0;
        const palm = parseFloat(palmE.value) || 0;
        const castor = parseFloat(castorE.value) || 0;
        const shea = parseFloat(sheaE.value) || 0;
        const almond = parseFloat(almondE.value) || 0;

        const totalOils = olive + coconut + palm + castor + shea + almond;

        if (totalOils <= 0) {
            $('out-lye-weight').textContent = '0.00';
            $('out-water-weight').textContent = `0.00 ${currentUnit}`;
            $('out-oils-weight').textContent = `0.0 ${currentUnit}`;
            $('out-total-batch').textContent = `0.00 ${currentUnit}`;
            $('out-lye-conc').textContent = '0.0%';
            $('out-soap-insights').innerHTML = '<p class="text-danger mb-0"><i class="fas fa-exclamation-triangle me-1"></i>Please enter positive weights for at least one fat or oil.</p>';
            return;
        }

        // Calculate NaOH lye required before superfat
        let rawLye = (olive * sapValues.olive) +
                      (coconut * sapValues.coconut) +
                      (palm * sapValues.palm) +
                      (castor * sapValues.castor) +
                      (shea * sapValues.shea) +
                      (almond * sapValues.almond);

        // Convert if using KOH (molecular weights ratio)
        if (lyeType === 'koh') {
            rawLye = rawLye * 1.4025;
        }

        // Apply superfat reduction
        const lyeNeeded = rawLye * (1 - (superfat / 100));

        // Calculate Water
        let waterNeeded = 0;
        if (waterCalc === 'percent') {
            waterNeeded = totalOils * (waterPctVal / 100);
        } else if (waterCalc === 'ratio2') {
            waterNeeded = lyeNeeded * 2.0;
        } else if (waterCalc === 'ratio3') {
            waterNeeded = lyeNeeded * 3.0;
        }

        const totalBatch = totalOils + lyeNeeded + waterNeeded;
        const lyeConcentration = (lyeNeeded / (lyeNeeded + waterNeeded)) * 100;

        // Render Outputs
        $('out-lye-weight').textContent = lyeNeeded.toFixed(2);
        $('out-lye-unit').textContent = currentUnit;
        $('out-water-weight').textContent = `${waterNeeded.toFixed(2)} ${currentUnit}`;
        $('out-oils-weight').textContent = `${totalOils.toFixed(1)} ${currentUnit}`;
        $('out-total-batch').textContent = `${totalBatch.toFixed(2)} ${currentUnit}`;
        $('out-lye-conc').textContent = `${lyeConcentration.toFixed(1)}%`;

        const lyeName = lyeType === 'naoh' ? 'Sodium Hydroxide (NaOH)' : 'Potassium Hydroxide (KOH)';
        $('out-lye-status').textContent = `${lyeName} - Superfat: ${superfat}%`;

        // Safety Warnings & Soap Properties
        const ins = [];
        
        // Safety First
        ins.push('<span class="text-danger"><i class="fas fa-triangle-exclamation me-1"></i> <strong>Lye Safety</strong>: Always pour Lye crystals into the water—NEVER water into lye (avoid volcanic splashback!). Wear goggles and gloves.</span>');

        // Oil ratio diagnostics
        const coconutPct = (coconut / totalOils) * 100;
        if (coconutPct > 30) {
            ins.push('<span class="text-warning"><i class="fas fa-circle-exclamation me-1"></i> <strong>High Coconut Oil Alert</strong>: Coconut oil represents over 30% of total oil weight. This makes a very hard bar with massive lather, but may dry out sensitive skin. Consider increasing superfat to 8%+ to counteract drying.</span>');
        }

        const castorPct = (castor / totalOils) * 100;
        if (castorPct > 10) {
            ins.push('<span class="text-warning"><i class="fas fa-circle-exclamation me-1"></i> <strong>High Castor Oil</strong>: Castor oil represents over 10%. While great for boosting bubbles, too much castor oil makes the soap bar sticky and soft.</span>');
        }

        // Lye concentration diagnostic
        if (lyeConcentration < 26) {
            ins.push('<strong>Lye concentration is light</strong>. Soap will take longer to cure and remain soft in the mold for several days.');
        } else if (lyeConcentration > 35) {
            ins.push('<strong>Lye concentration is strong (discounted)</strong>. The batter will trace very quickly. Work fast and pour into molds immediately.');
        } else {
            ins.push('<span class="text-success"><i class="fas fa-circle-check me-1"></i> Standard lye concentration (28%-33%) is excellent for standard curing and slow-moving trace.</span>');
        }

        $('out-soap-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2">${i}</li>`).join('')}</ul>`;
    }

    // Handle Unit Toggles
    document.querySelectorAll('.unit-toggle-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const unit = btn.dataset.unit;
            if (unit === currentUnit) return;

            document.querySelectorAll('.unit-toggle-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Convert oil inputs
            document.querySelectorAll('.oil-input').forEach(el => {
                let val = parseFloat(el.value) || 0;
                if (unit === 'grams') {
                    el.value = (val * 28.3495).toFixed(0);
                } else {
                    el.value = (val / 28.3495).toFixed(1);
                }
            });

            document.querySelectorAll('.unit-text-label').forEach(el => el.textContent = unit === 'grams' ? 'g' : 'oz');

            currentUnit = unit;
            calculateSoap();
        });
    });

    // Listeners
    [lyeTypeE, superfatRateE, waterCalcTypeE, waterPctSliderE,
     oliveE, coconutE, palmE, castorE, sheaE, almondE].forEach(el => {
        el.addEventListener('input', calculateSoap);
    });

    // Reset Fields
    $('soap-reset').addEventListener('click', () => {
        lyeTypeE.value = 'naoh';
        superfatRateE.value = 5;
        waterCalcTypeE.value = 'percent';
        waterPctSliderE.value = 33;

        oliveE.value = currentUnit === 'oz' ? 16 : 450;
        coconutE.value = currentUnit === 'oz' ? 8 : 220;
        palmE.value = currentUnit === 'oz' ? 8 : 220;
        castorE.value = currentUnit === 'oz' ? 2 : 50;
        sheaE.value = currentUnit === 'oz' ? 2 : 50;
        almondE.value = 0;

        calculateSoap();
    });

    // Copy Specs
    $('soap-copy-btn').addEventListener('click', function(){
        const lyeName = lyeTypeE.options[lyeTypeE.selectedIndex].text;
        const text = `Saponification Soap Recipe Specifications:\n` +
                     `-------------------------------------------\n` +
                     `Lye Formulation: ${lyeName}\n` +
                     `Superfat percentage: ${superfatRateE.value}%\n` +
                     `Total Oil Weight: ${$('out-oils-weight').textContent}\n` +
                     `-------------------------------------------\n` +
                     `Actual Lye Required: ${$('out-lye-weight').textContent} ${currentUnit}\n` +
                     `Water Required: ${$('out-water-weight').textContent}\n` +
                     `Total Soap Batch Weight: ${$('out-total-batch').textContent}\n` +
                     `Lye Concentration: ${$('out-lye-conc').textContent}\n` +
                     `Calculated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied Recipe Specs!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Share link simple implementation
    $('soap-share-btn').addEventListener('click', function(){
        const dummyUrl = window.location.href;
        navigator.clipboard.writeText(dummyUrl).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied URL Link!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculateSoap();
});
</script>

<style>
.soap-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:1.5rem;box-shadow:0 8px 48px rgba(5,150,105,.03)}
.soap-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:1.25rem}
.soap-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.25rem}
.soap-calculator-rebuilt .calculator-header p{margin:0;font-size:0.875rem;color:#64748b;line-height:1.6}
.soap-calculator-rebuilt .tool-icon-circle{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;flex-shrink:0}
.soap-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.soap-calculator-rebuilt .form-label-custom-small{font-size:.7rem;font-weight:700;color:#475569;margin-bottom:.4rem;display:block}
.soap-calculator-rebuilt .border-emerald-custom{border:2px solid #059669}
.soap-calculator-rebuilt .btn-outline-emerald{border-color:#059669; color:#059669; border-width:2.5px}
.soap-calculator-rebuilt .btn-outline-emerald.active{background-color:#059669; border-color:#059669; color:#fff}
.soap-calculator-rebuilt .btn-outline-emerald:hover{background-color:rgba(5,150,105,.1); color:#059669}
.soap-calculator-rebuilt .btn-outline-emerald.active:hover{background-color:#059669; color:#fff}
.border-emerald-light{border-color:#a7f3d0!important}
.text-emerald{color:#059669!important}
.soap-calculator-rebuilt .form-range::-webkit-slider-thumb{background:#059669}
.soap-calculator-rebuilt .form-range::-moz-range-thumb{background:#059669}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:1.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:1.25rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:1rem}
.output-hero-label{display:block;font-size:.75rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:0.5rem}
.output-hero-value{font-size:2.25rem;font-weight:900;line-height:1;letter-spacing:-2px}
.stat-card{border:2.5px solid #f1f5f9;border-radius:16px;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:4px}
.stat-card-value{font-size:1.15rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .soap-calculator-rebuilt .calculator-card { padding: 1rem; }
    .output-card-themed { padding: 1rem; }
    .output-hero-value { font-size: 1.6rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\soap-making-lye-calculator.blade.php ENDPATH**/ ?>