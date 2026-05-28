<div class="row g-4 brine-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(14, 116, 144, 0.1); color: #0e7490;">
                    <i class="fas fa-flask"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Brine and Salinity Calculator</h4>
                    <p class="text-muted small m-0">Calculate precise salt, sugar, and Prague Powder (nitrite) ratios for wet brining or dry equilibrium curing.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Curing / Brining Method</label>
                        <select id="brine-method" class="form-select form-select-lg rounded-3">
                            <option value="wet" selected>🌊 Wet Brining (Water Submersion)</option>
                            <option value="dry">🍖 Dry Curing (Equilibrium)</option>
                        </select>
                        <span class="text-muted small mt-1 d-block">Submersion vs. direct application</span>
                    </div>

                    
                    <div class="col-md-4" id="wet-input-water">
                        <label class="form-label-custom">Water Volume</label>
                        <div class="input-group">
                            <input type="number" id="wet-water" class="form-control form-control-lg rounded-start-3" value="4" min="0.1" step="0.1">
                            <select id="water-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 90px;">
                                <option value="L" selected>Liters</option>
                                <option value="gal">Gallons</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" id="wet-input-salt">
                        <label class="form-label-custom">Salt Weight</label>
                        <div class="input-group">
                            <input type="number" id="wet-salt" class="form-control form-control-lg rounded-start-3" value="200" min="1">
                            <span class="input-group-text bg-white rounded-end-3 text-muted">grams</span>
                        </div>
                    </div>

                    
                    <div class="col-md-4 d-none" id="dry-input-meat">
                        <label class="form-label-custom">Meat Weight</label>
                        <div class="input-group">
                            <input type="number" id="dry-meat" class="form-control form-control-lg rounded-start-3" value="1000" min="10">
                            <select id="meat-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 90px;">
                                <option value="g" selected>grams</option>
                                <option value="lb">lbs</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 d-none" id="dry-input-pct">
                        <label class="form-label-custom">Target Salt Percentage</label>
                        <div class="input-group">
                            <input type="number" id="dry-salt-pct" class="form-control form-control-lg rounded-start-3" value="2.5" min="0.5" max="10" step="0.1">
                            <span class="input-group-text bg-white rounded-end-3 text-muted">%</span>
                        </div>
                    </div>
                </div>

                
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Curing Salt Additive (Prague Powder)</label>
                        <select id="cure-salt" class="form-select rounded-3">
                            <option value="none" selected>No Curing Salt (Pure Table/Kosher Salt)</option>
                            <option value="pp1">Prague Powder #1 (Instacure #1 / Pink Salt - Hot Cooks)</option>
                            <option value="pp2">Prague Powder #2 (Dry Curing / Long Salami Cooks)</option>
                        </select>
                        <span class="text-muted small mt-1 d-block">Adds exactly 0.25% of meat/total weight for food safety</span>
                    </div>
                    <div class="col-md-6" id="dry-input-sugar">
                        <label class="form-label-custom">Sugar Weight <span class="text-muted">(Optional)</span></label>
                        <div class="input-group">
                            <input type="number" id="sugar" class="form-control rounded-start-3" value="0" min="0">
                            <span class="input-group-text bg-white rounded-end-3 text-muted" id="sugar-unit-label">grams</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cure-preset" data-method="wet" data-wat="4" data-wu="L" data-salt="200" data-cure="none" data-sugar="50">🦃 Turkey Wet Brine (5%)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cure-preset" data-method="wet" data-wat="2" data-wu="L" data-salt="160" data-cure="none" data-sugar="0">🐟 Fish/Salmon Wet Brine (8%)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cure-preset" data-method="dry" data-meat="2000" data-mu="g" data-saltpct="2.5" data-cure="pp1" data-sugar="20">🥓 Bacon Equilibrium Cure (2.5%)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 cure-preset" data-method="dry" data-meat="1500" data-mu="g" data-saltpct="3.0" data-cure="pp2" data-sugar="10">🍖 Charcuterie Dry Cure (3%)</button>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Calculate Curing</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="brine-output-card" style="--tool-hue: 190; --tool-color: #0e7490; --tool-bg: rgba(14, 116, 144, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75" id="out-hero-label">Wet Brine Salinity Percentage</span>
                <div class="output-hero-value my-2 text-gradient" id="out-salinity-pct" style="font-size: 3rem; font-weight: 900;">4.76 %</div>
                <span class="output-hero-unit fs-5 fw-bold" id="out-salinity-desc">Equivalently 48 grams per liter</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label" id="stat-lbl-1">Total Fluid Weight</span>
                        <span class="stat-card-value text-secondary" id="stat-val-1">4,000 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label" id="stat-lbl-2">Pure Kosher Salt</span>
                        <span class="stat-card-value text-secondary" id="stat-val-2">200 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label" id="stat-lbl-3">Prague Powder</span>
                        <span class="stat-card-value text-gradient" id="stat-val-3">None</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label" id="stat-lbl-4">Sugar Weight</span>
                        <span class="stat-card-value text-success" id="stat-val-4">50 g</span>
                    </div>
                </div>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Curing Blueprint
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const brineMethod = $('brine-method');
    const wetWat = $('wet-water');
    const waterUnit = $('water-unit');
    const wetSalt = $('wet-salt');
    const dryMeat = $('dry-meat');
    const meatUnit = $('meat-unit');
    const drySaltPct = $('dry-salt-pct');
    const cureSalt = $('cure-salt');
    const sugarInput = $('sugar');
    
    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Toggle Input Cards based on Method
    brineMethod.addEventListener('change', function() {
        if (this.value === 'wet') {
            $('wet-input-water').classList.remove('d-none');
            $('wet-input-salt').classList.remove('d-none');
            $('dry-input-meat').classList.add('d-none');
            $('dry-input-pct').classList.add('d-none');
            $('sugar-unit-label').textContent = 'grams';
        } else {
            $('wet-input-water').classList.add('d-none');
            $('wet-input-salt').classList.add('d-none');
            $('dry-input-meat').classList.remove('d-none');
            $('dry-input-pct').classList.remove('d-none');
            $('sugar-unit-label').textContent = meatUnit.value === 'g' ? 'grams' : 'ounces';
        }
        calculate();
    });

    meatUnit.addEventListener('change', function() {
        $('sugar-unit-label').textContent = this.value === 'g' ? 'grams' : 'ounces';
    });

    // Presets
    document.querySelectorAll('.cure-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            brineMethod.value = this.getAttribute('data-method');
            brineMethod.dispatchEvent(new Event('change'));

            if (brineMethod.value === 'wet') {
                wetWat.value = this.getAttribute('data-wat');
                waterUnit.value = this.getAttribute('data-wu');
                wetSalt.value = this.getAttribute('data-salt');
            } else {
                dryMeat.value = this.getAttribute('data-meat');
                meatUnit.value = this.getAttribute('data-mu');
                drySaltPct.value = this.getAttribute('data-saltpct');
            }
            
            cureSalt.value = this.getAttribute('data-cure');
            sugarInput.value = this.getAttribute('data-sugar');
            
            calculate();
        });
    });

    function calculate() {
        const method = brineMethod.value;
        const cure = cureSalt.value;
        const sugar = parseFloat(sugarInput.value) || 0;

        if (method === 'wet') {
            const wat = parseFloat(wetWat.value) || 0;
            const wu = waterUnit.value;
            const salt = parseFloat(wetSalt.value) || 0;

            if (wat <= 0 || salt <= 0) return;

            // Water to grams (1L = 1000g, 1gal = 3785.41g)
            const waterWeightG = wu === 'L' ? (wat * 1000) : (wat * 3785.41);
            
            // Total Wet Brine Salinity
            const salinityPct = (salt / (waterWeightG + salt)) * 100;
            
            let ppWeight = 0;
            let finalPureSalt = salt;
            if (cure !== 'none') {
                // For wet brine cure, cure salt is added at 0.25% of total liquid weight
                ppWeight = (waterWeightG + salt) * 0.0025;
                // Pure salt is reduced slightly to keep salinity stable
                finalPureSalt = Math.max(0, salt - ppWeight);
            }

            // Output Rendering
            $('out-hero-label').textContent = 'Wet Brine Salinity Percentage';
            $('out-salinity-pct').textContent = salinityPct.toFixed(2) + ' %';
            
            const gpl = (salt / wat).toFixed(0);
            $('out-salinity-desc').textContent = `${gpl} grams of salt per ${wu === 'L' ? 'liter' : 'gallon'} of water`;

            $('stat-lbl-1').textContent = 'Total Fluid Weight';
            $('stat-val-1').textContent = Math.round(waterWeightG) + ' g';
            
            $('stat-lbl-2').textContent = 'Kosher/Sea Salt';
            $('stat-val-2').textContent = Math.round(finalPureSalt) + ' g';
            
            $('stat-lbl-3').textContent = 'Prague Powder';
            $('stat-val-3').textContent = cure === 'none' ? 'None' : Math.round(ppWeight) + ' g';
            
            $('stat-lbl-4').textContent = 'Sugar Additive';
            $('stat-val-4').textContent = Math.round(sugar) + ' g';



        } else {
            // Dry Curing Method
            const meat = parseFloat(dryMeat.value) || 0;
            const mu = meatUnit.value;
            const saltPct = parseFloat(drySaltPct.value) || 0;

            if (meat <= 0 || saltPct <= 0) return;

            // Total dry salt weight based on target percentage
            const totalSaltG = meat * (saltPct / 100);
            
            let ppWeight = 0;
            let finalPureSalt = totalSaltG;
            if (cure !== 'none') {
                // Prague Powder strictly dosed at 0.25% of meat weight
                ppWeight = meat * 0.0025;
                // Pure salt is target salt weight minus curing salt weight (which is 93.75% table salt)
                finalPureSalt = Math.max(0, totalSaltG - ppWeight);
            }

            // Output Rendering
            $('out-hero-label').textContent = 'Dry Cure Equilibrium Salt Dosing';
            $('out-salinity-pct').textContent = totalSaltG.toFixed(1) + ' ' + mu;
            $('out-salinity-desc').textContent = `Exactly ${saltPct}% of total meat weight`;

            $('stat-lbl-1').textContent = 'Total Meat Weight';
            $('stat-val-1').textContent = meat + ' ' + mu;
            
            $('stat-lbl-2').textContent = 'Kosher/Sea Salt';
            $('stat-val-2').textContent = finalPureSalt.toFixed(1) + ' ' + mu;
            
            $('stat-lbl-3').textContent = 'Prague Powder';
            $('stat-val-3').textContent = cure === 'none' ? 'None' : ppWeight.toFixed(2) + ' ' + mu;
            
            $('stat-lbl-4').textContent = 'Sugar Additive';
            $('stat-val-4').textContent = sugar > 0 ? sugar.toFixed(1) + ' ' + mu : 'None';


        }
    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        brineMethod.value = 'wet';
        brineMethod.dispatchEvent(new Event('change'));
        
        wetWat.value = 4;
        waterUnit.value = 'L';
        wetSalt.value = 200;
        
        dryMeat.value = 1000;
        meatUnit.value = 'g';
        drySaltPct.value = 2.5;
        
        cureSalt.value = 'none';
        sugarInput.value = 0;
        
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const method = brineMethod.value.toUpperCase();
        let text = '';
        if (method === 'WET') {
            text = `Wet Brining Salinity Report\n-----------------------------------\nWater Volume: ${wetWat.value}${waterUnit.value}\nSalinity: ${$('out-salinity-pct').textContent}\nSalt Weight: ${$('stat-val-2').textContent}\nCure Salt: ${$('stat-val-3').textContent}\nSugar: ${$('stat-val-4').textContent}\n— ToolsHub Culinary Suite`;
        } else {
            text = `Equilibrium Dry Curing Report\n-----------------------------------\nMeat Weight: ${dryMeat.value}${meatUnit.value}\nTarget Salt Percentage: ${drySaltPct.value}%\nSalt Weight Needed: ${$('stat-val-2').textContent}\nCure Additive: ${$('stat-val-3').textContent}\nSugar: ${$('stat-val-4').textContent}\n— ToolsHub Culinary Suite`;
        }
        
        navigator.clipboard.writeText(text).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = orig, 2000);
        });
    });

    // Run initial calculation
    calculate();
});
</script>

<style>
.brine-calc-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.brine-calc-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.brine-calc-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.brine-calc-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.brine-calc-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.brine-calc-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.brine-calc-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.brine-calc-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.brine-calc-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(14, 116, 144, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(14, 116, 144, 0.02);
}
.brine-calc-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.brine-calc-rebuilt .text-gradient {
    background: linear-gradient(135deg, #0e7490 0%, #06b6d4 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.brine-calc-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\brine-and-salinity-calculator.blade.php ENDPATH**/ ?>