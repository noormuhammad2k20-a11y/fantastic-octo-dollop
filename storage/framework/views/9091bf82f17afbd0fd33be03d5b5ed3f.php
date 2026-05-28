<div class="row g-4 spaghetti-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                    <i class="fas fa-utensils"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Spaghetti Portion Calculator</h4>
                    <p class="text-muted small m-0">Measure dry long or short pasta portions accurately. Features a real-scale dynamic bundle diameter circle with authentic Italian cooking ratio calculations.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Number of Servings</label>
                        <div class="input-group input-group-lg">
                            <button type="button" class="btn btn-outline-secondary border-end-0" id="btn-serv-minus" style="border-radius: 12px 0 0 12px;"><i class="fas fa-minus"></i></button>
                            <input type="number" id="serv-count" class="form-control text-center border-start-0 border-end-0" value="2" min="1" max="100" style="font-weight: 700; width: 60px;">
                            <button type="button" class="btn btn-outline-secondary border-start-0" id="btn-serv-plus" style="border-radius: 0 12px 12px 0;"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Appetite Size</label>
                        <select id="appetite-size" class="form-select form-select-lg rounded-3">
                            <option value="light">🥗 Light Appetizer (60g / 2.1 oz)</option>
                            <option value="normal" selected>🍝 Standard (90g / 3.2 oz)</option>
                            <option value="heavy">🦁 Hungry / Large (120g / 4.2 oz)</option>
                            <option value="child">👶 Kid's portion (45g / 1.6 oz)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Course Role</label>
                        <select id="course-type" class="form-select form-select-lg rounded-3">
                            <option value="main" selected>Main Entrée</option>
                            <option value="starter">Primo / Starter</option>
                            <option value="side">Contorno / Side Dish</option>
                        </select>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Pasta Shape</label>
                        <select id="pasta-shape" class="form-select form-select-lg rounded-3">
                            <option value="long" selected>🍝 Long Dry (Spaghetti, Fettuccine)</option>
                            <option value="short">🐚 Short Dry (Penne, Fusilli, Farfalle)</option>
                        </select>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Gatherings:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 serv-preset" data-serv="1" data-appetite="normal" data-course="main">🍝 Solo Feast (1)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 serv-preset" data-serv="2" data-appetite="normal" data-course="main">💑 Romantic Duo (2)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 serv-preset" data-serv="4" data-appetite="normal" data-course="main">👨‍👩‍👧‍👦 Family dinner (4)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 serv-preset" data-serv="8" data-appetite="heavy" data-course="main">🎉 Dinner Party (8)</button>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Portion Pasta</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="spaghetti-output-card" style="--tool-hue: 0; --tool-color: #ef4444; --tool-bg: rgba(239, 68, 68, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Required Dry Pasta Weight</span>
                <div class="output-hero-value my-2 text-gradient" id="out-total-weight" style="font-size: 3rem; font-weight: 900;">180 grams</div>
                <span class="output-hero-unit fs-5 fw-bold text-muted" id="out-weight-desc">6.3 ounces of dry spaghetti</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Recommended Water</span>
                        <span class="stat-card-value text-secondary" id="stat-water">1.8 Liters (1.9 qt)</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Coarse Salt (1%)</span>
                        <span class="stat-card-value text-secondary" id="stat-salt">18 grams (3.6 tsp)</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Bundle Diameter</span>
                        <span class="stat-card-value text-gradient" id="stat-diameter">35.2 mm (1.39 in)</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Cooked Yield (approx.)</span>
                        <span class="stat-card-value text-success" id="stat-yield">405 grams (14.3 oz)</span>
                    </div>
                </div>
            </div>

            
            <div class="row g-4 mt-4 align-items-center">
                <div class="col-md-6 text-center">
                    <div class="p-3 border rounded-3 bg-white shadow-sm d-flex flex-column align-items-center justify-content-center" style="min-height: 280px;">
                        <h6 class="fw-bold text-dark mb-1"><i class="fas fa-circle-notch text-danger me-1"></i>Real-Scale Bundle Size Guide</h6>
                        <p class="text-muted small mb-3" id="guide-type-desc">Place dry spaghetti directly over this circle to measure.</p>
                        
                        <div class="d-flex align-items-center justify-content-center position-relative mb-3" style="width: 160px; height: 160px; background: #fafafa; border-radius: 50%; border: 1px dashed #cbd5e1;">
                            
                            <div id="bundle-circle" class="rounded-circle shadow-sm" style="background: linear-gradient(135deg, #fef08a 0%, #facc15 100%); border: 3px solid #eab308; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);"></div>
                        </div>

                        <span class="badge bg-light text-dark border px-3 py-2 small fw-bold" id="bundle-coin-match">Slightly larger than a Half Dollar coin</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded-3 bg-white shadow-sm" style="min-height: 280px;">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-pizza-slice text-danger me-2"></i>Authentic Pasta Water Chemistry (100:10:1 Rule)</h6>
                        <p class="small text-muted mb-3">Professional Italian chefs utilize the strict volumetric ratio rule to guarantee perfectly gelatinized starch expansion and flavor profile integration:</p>
                        
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0 small text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Component</th>
                                        <th>Chef's Ratio</th>
                                        <th>Your Batch Target</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-start fw-semibold text-danger">🍝 Dry Pasta</td>
                                        <td>100 parts</td>
                                        <td id="table-pasta-wt" class="fw-bold">180g</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">💧 Boiling Water</td>
                                        <td>1000 parts</td>
                                        <td id="table-water-vol">1.8 Liters</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">🧂 Coarse Salt</td>
                                        <td>10 parts</td>
                                        <td id="table-salt-wt">18g</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-warning py-2 px-3 mt-3 mb-0 small border-0 rounded-3">
                            <i class="fas fa-info-circle me-1"></i><strong>Why Salt Matters:</strong> Adding salt increases the water's boiling point slightly and seasons the core structure of the pasta during cooking, preventing a bland tasting noodle.
                        </div>
                    </div>
                </div>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Pasta Portion Guide
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const servCount = $('serv-count');
    const appetiteSize = $('appetite-size');
    const courseType = $('course-type');
    const pastaShape = $('pasta-shape');

    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Increment/Decrement servings
    $('btn-serv-minus').addEventListener('click', () => {
        const val = Math.max(1, (parseInt(servCount.value) || 2) - 1);
        servCount.value = val;
        calculate();
    });

    $('btn-serv-plus').addEventListener('click', () => {
        const val = Math.min(100, (parseInt(servCount.value) || 2) + 1);
        servCount.value = val;
        calculate();
    });

    // Presets
    document.querySelectorAll('.serv-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            servCount.value = this.getAttribute('data-serv');
            appetiteSize.value = this.getAttribute('data-appetite');
            courseType.value = this.getAttribute('data-course');
            calculate();
        });
    });

    function calculate() {
        const servings = Math.max(1, parseInt(servCount.value) || 2);
        const appetite = appetiteSize.value;
        const course = courseType.value;
        const shape = pastaShape.value;

        // Base portion weight per person in grams (standard adult main course)
        let portionG = 90;
        if (appetite === 'light') portionG = 60;
        else if (appetite === 'heavy') portionG = 120;
        else if (appetite === 'child') portionG = 45;

        // Adjust based on Course Role
        // Starter is usually smaller, Side is even smaller
        if (course === 'starter') {
            portionG *= 0.65;
        } else if (course === 'side') {
            portionG *= 0.5;
        }

        // enforce reasonable limits
        portionG = Math.max(10, Math.round(portionG));

        const totalDryG = portionG * servings;
        const totalDryOz = totalDryG * 0.035274;

        // Cooking water calculation: 1 Liter per 100g of pasta
        const waterL = (totalDryG / 100) * 1.0;
        const waterQt = waterL * 1.05669;

        // Salt calculation: 10g coarse sea salt per 1 Liter water (1% salinity)
        const saltG = waterL * 10;
        const saltTsp = saltG / 5; // approx. 5g of salt per teaspoon

        // Cooked pasta yield (roughly 2.25x the dry weight)
        const cookedG = totalDryG * 2.25;
        const cookedOz = totalDryOz * 2.25;

        // Sizing of physical spaghetti bundle circle
        // Math: diameter = 2.625 * sqrt(weight) mm
        // We calculate for a single serving size, as user usually measures one bundle at a time!
        const singleG = portionG;
        const diameterMm = 2.625 * Math.sqrt(singleG);

        // Update UI
        $('out-total-weight').textContent = `${Math.round(totalDryG)} grams`;
        $('out-weight-desc').textContent = `${totalDryOz.toFixed(1)} ounces of dry ${shape === 'long' ? 'spaghetti' : 'short pasta'}`;

        $('stat-water').textContent = `${waterL.toFixed(1)} L (${waterQt.toFixed(1)} qt)`;
        $('stat-salt').textContent = `${Math.round(saltG)}g (${saltTsp.toFixed(1)} tsp)`;
        $('stat-diameter').textContent = `${diameterMm.toFixed(1)} mm (${(diameterMm * 0.0393701).toFixed(2)} in)`;
        $('stat-yield').textContent = `${Math.round(cookedG)}g (${cookedOz.toFixed(1)} oz)`;

        $('table-pasta-wt').textContent = `${Math.round(totalDryG)}g`;
        $('table-water-vol').textContent = `${waterL.toFixed(1)} L`;
        $('table-salt-wt').textContent = `${Math.round(saltG)}g`;

        // Render the visual circle (using viewport-friendly calibration)
        // 1mm ~ 2.83 pixels at standard desktop screen resolution (96 DPI)
        // Let's constrain visual output to maximum box container size (140px)
        const displayDiameterPx = Math.min(140, diameterMm * 2.5);
        const bundleCircle = $('bundle-circle');

        if (shape === 'short') {
            $('guide-type-desc').textContent = 'Short pasta cannot be packed into a cylinder bundle. Use scales instead!';
            bundleCircle.style.width = '0px';
            bundleCircle.style.height = '0px';
            $('bundle-coin-match').textContent = 'Short pasta: scale by dry weight';
        } else {
            $('guide-type-desc').textContent = 'Hold a single portion bundle against this circle.';
            bundleCircle.style.width = `${displayDiameterPx}px`;
            bundleCircle.style.height = `${displayDiameterPx}px`;

            // Coin reference lookup based on mm
            let coinMatch = 'Custom Bundle';
            if (diameterMm < 15) coinMatch = 'Smaller than a U.S. Dime';
            else if (diameterMm < 18) coinMatch = 'Size of a U.S. Dime (17.9mm)';
            else if (diameterMm < 20.5) coinMatch = 'Size of a U.S. Penny (19.0mm)';
            else if (diameterMm < 22) coinMatch = 'Size of a U.S. Nickel (21.2mm)';
            else if (diameterMm < 25) coinMatch = 'Size of a U.S. Quarter (24.3mm)';
            else if (diameterMm < 28) coinMatch = 'Size of a U.S. Half Dollar (27.3mm)';
            else if (diameterMm < 32) coinMatch = 'Size of a Susan B. Anthony Dollar (26.5mm)';
            else coinMatch = 'Significantly larger than standard coins';

            $('bundle-coin-match').textContent = coinMatch;
        }


    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        servCount.value = 2;
        appetiteSize.value = 'normal';
        courseType.value = 'main';
        pastaShape.value = 'long';
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const shapeText = pastaShape.options[pastaShape.selectedIndex].text;
        const text = `Spaghetti Portion & Chef Cooking Report\n-----------------------------------\nServings: ${servCount.value} (${appetiteSize.options[appetiteSize.selectedIndex].text})\nType: ${shapeText}\n\nRequired dry weight: ${$('out-total-weight').textContent} (${$('out-weight-desc').textContent})\nBoiling water needed: ${$('stat-water').textContent}\nCoarse salt needed: ${$('stat-salt').textContent}\nBundle diameter: ${$('stat-diameter').textContent}\nCooked yield weight: ${$('stat-yield').textContent}\n— ToolsHub Kitchen Suite`;
        
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
.spaghetti-calc-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.spaghetti-calc-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.spaghetti-calc-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.spaghetti-calc-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.spaghetti-calc-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.spaghetti-calc-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.spaghetti-calc-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.spaghetti-calc-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.spaghetti-calc-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(239, 68, 68, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(239, 68, 68, 0.02);
}
.spaghetti-calc-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.spaghetti-calc-rebuilt .text-gradient {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.spaghetti-calc-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\spaghetti-portion-calculator.blade.php ENDPATH**/ ?>