<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Meat Selection</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Cut of Meat</label>
                                <select id="meat-type" class="form-select form-select-lg rounded-3">
                                    <option value="brisket" selected>Beef Brisket (~50% shrinkage)</option>
                                    <option value="pork_shoulder">Pork Shoulder / Butt (~40% shrinkage)</option>
                                    <option value="ribs">Pork Ribs / Baby Backs (~30% shrinkage)</option>
                                    <option value="chicken">Whole Chicken (~35% shrinkage)</option>
                                    <option value="burgers">Burgers & Sausages (~20% shrinkage)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-muted">Raw Meat Weight (lbs)</label>
                                <input type="number" id="raw-weight" class="form-control form-control-lg rounded-3" value="10.0" min="0.5" step="0.5">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Service & Grill Size</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Cooked Portion Size (oz per person)</label>
                                <select id="portion-size" class="form-select form-select-lg rounded-3">
                                    <option value="4">4 oz (Light Portion)</option>
                                    <option value="6" selected>6 oz (Standard Buffet)</option>
                                    <option value="8">8 oz (Hearty Serving)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-muted">Grill Surface Area Style</label>
                                <select id="grill-size" class="form-select form-select-lg rounded-3">
                                    <option value="portable">Small Portable / Tailgate (~150 sq in)</option>
                                    <option value="kamado">Large Kamado / Egg (~260 sq in)</option>
                                    <option value="kettle" selected>Standard 22" Kettle (~380 sq in)</option>
                                    <option value="offset">Large Offset / Pellet Smoker (~550+ sq in)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-meat="brisket" data-weight="12.0" data-portion="6" data-grill="offset">
                    Whole Packer Brisket (12 lbs)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-meat="pork_shoulder" data-weight="8.0" data-portion="8" data-grill="kettle">
                    Pork Shoulder Butt (8 lbs)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-meat="ribs" data-weight="6.0" data-portion="6" data-grill="kamado">
                    Ribs Feeder (3 racks, ~6 lbs)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-warning btn-lg rounded-pill px-5 shadow-sm transition-all text-white fw-bold" id="btn-calculate" style="background-color: #ea580c; border-color: #ea580c;">
                    <i class="fas fa-fire me-2"></i> Compute Pitmaster Specs
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #fff7ed; color: #ea580c;">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">BBQ Pitmaster Yield Forecast</h5>
                        <p class="text-muted small mb-0">Cooked yield, cooking times, and grill spacing analytics</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #ea580c; border-color: #ea580c; color: #fff;">
                        <i class="fas fa-copy me-1"></i> Copy Pitmaster Plan
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #ea580c;" id="result-cooked-weight">5.0 lbs</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1" id="result-servings-count">Yields 13 servings (6 oz cooked per serving)</p>
            </div>

            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-clock me-2 text-warning"></i>Smoker & Cook Times</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Est. Cook Duration:</span>
                                <span class="fw-bold text-dark" id="out-cook-time">11.5 hours</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Ideal Cook Temp:</span>
                                <span class="fw-bold text-danger" id="out-cook-temp">225°F - 250°F</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Wood/Charcoal Needed:</span>
                                <span class="fw-bold text-dark" id="out-fuel-needed">15 lbs</span>
                            </li>
                        </ul>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-expand me-2 text-primary"></i>Grill Surface Spacing</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Meat Footprint:</span>
                                <span class="fw-bold text-dark" id="out-footprint">~120 sq in</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Grill Capacity Taken:</span>
                                <span class="fw-bold text-dark" id="out-capacity-pct">31% capacity</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Fit Classification:</span>
                                <span class="badge bg-success rounded-pill px-3 py-1 text-white" id="out-fit-badge">Fits Comfortably</span>
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
    .form-control:focus, .form-select:focus { border-color: #ea580c; box-shadow: 0 0 0 4px rgba(234, 88, 12, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const meatIn = document.getElementById('meat-type');
    const rawWeightIn = document.getElementById('raw-weight');
    const portionIn = document.getElementById('portion-size');
    const grillIn = document.getElementById('grill-size');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateBBQYield() {
        const meat = meatIn.value;
        const rawWeight = parseFloat(rawWeightIn.value) || 0;
        const portion = parseInt(portionIn.value) || 6;
        const grill = grillIn.value;

        if (rawWeight <= 0) {
            alert("Please enter a valid raw meat weight.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Smoker Dynamics...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Shrinkage calculations
            let shrinkRate = 0.40;
            let timePerLb = 1.25; // hours per lb
            let flatTime = 0;
            let tempRange = '225°F - 250°F';

            if (meat === 'brisket') {
                shrinkRate = 0.50;
                timePerLb = 1.20;
            } else if (meat === 'pork_shoulder') {
                shrinkRate = 0.40;
                timePerLb = 1.40;
            } else if (meat === 'ribs') {
                shrinkRate = 0.30;
                flatTime = 6.0; // Standard 3-2-1 ribs method
            } else if (meat === 'chicken') {
                shrinkRate = 0.35;
                flatTime = 2.5; // Smoked whole bird
                tempRange = '275°F - 300°F';
            } else if (meat === 'burgers') {
                shrinkRate = 0.20;
                flatTime = 0.25; // Simple high-heat grilling
                tempRange = '375°F - 400°F';
            }

            const cookedWeight = rawWeight * (1 - shrinkRate);
            const cookedWeightOz = cookedWeight * 16;
            const servings = Math.floor(cookedWeightOz / portion);

            // Cook time
            let totalHours = flatTime > 0 ? flatTime : rawWeight * timePerLb;
            // Round to nearest quarter hour
            totalHours = Math.round(totalHours * 4) / 4;

            // Fuel needed
            let fuelLbs = rawWeight * 1.1 + 3;
            if (meat === 'burgers') fuelLbs = 5; // Charcoal bag standard minimum

            // Grill area footprint and capacity
            let grillSqIn = 380; // Kettle standard
            if (grill === 'portable') grillSqIn = 150;
            if (grill === 'kamado') grillSqIn = 260;
            if (grill === 'offset') grillSqIn = 550;

            // Sq inches of meat: roughly 10 sq inches per pound of raw meat
            const meatFootprint = Math.round(rawWeight * 12);
            const capacityPct = Math.round((meatFootprint / grillSqIn) * 100);

            // Format render
            document.getElementById('result-cooked-weight').innerText = cookedWeight.toFixed(1) + " lbs";
            document.getElementById('result-servings-count').innerText = `Yields ~ ${servings} Servings (${portion} oz cooked per serving)`;

            const hourLabel = totalHours === 1 ? " hour" : " hours";
            document.getElementById('out-cook-time').innerText = totalHours + hourLabel;
            document.getElementById('out-cook-temp').innerText = tempRange;
            document.getElementById('out-fuel-needed').innerText = Math.round(fuelLbs) + " lbs";

            document.getElementById('out-footprint').innerText = `~${meatFootprint} sq in`;
            document.getElementById('out-capacity-pct').innerText = capacityPct + "% capacity";

            const badge = document.getElementById('out-fit-badge');
            if (capacityPct <= 60) {
                badge.innerText = "Fits Easily";
                badge.className = "badge bg-success rounded-pill px-3 py-1 text-white";
            } else if (capacityPct <= 90) {
                badge.innerText = "Tight Fit (Requires arrangement)";
                badge.className = "badge bg-warning rounded-pill px-3 py-1 text-dark";
            } else {
                badge.innerText = "Too Large! Will not fit";
                badge.className = "badge bg-danger rounded-pill px-3 py-1 text-white";
            }

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-fire me-2"></i> Compute Pitmaster Specs';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateBBQYield);

    btnReset.addEventListener('click', () => {
        meatIn.value = 'brisket';
        rawWeightIn.value = 10.0;
        portionIn.value = '6';
        grillIn.value = 'kettle';
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            meatIn.value = this.dataset.meat;
            rawWeightIn.value = this.dataset.weight;
            portionIn.value = this.dataset.portion;
            grillIn.value = this.dataset.grill;
            calculateBBQYield();
        });
    });

    btnCopy.addEventListener('click', function() {
        const yieldWeight = document.getElementById('result-cooked-weight').innerText;
        const servings = document.getElementById('result-servings-count').innerText;
        const time = document.getElementById('out-cook-time').innerText;
        const temp = document.getElementById('out-cook-temp').innerText;
        const fuel = document.getElementById('out-fuel-needed').innerText;
        const footprint = document.getElementById('out-footprint').innerText;
        const capacity = document.getElementById('out-capacity-pct').innerText;

        const text = `BBQ PITMASTER COOKING PLAN\n` +
                     `===========================\n` +
                     `Meat Cut: ${meatIn.options[meatIn.selectedIndex].text}\n` +
                     `Raw Weight: ${rawWeightIn.value} lbs\n` +
                     `Portion Size: ${portionIn.options[portionIn.selectedIndex].text}\n` +
                     `Grill Style: ${grillIn.options[grillIn.selectedIndex].text}\n\n` +
                     `COOKED MEAT YIELD: ${yieldWeight}\n` +
                     `${servings}\n\n` +
                     `COOKING SPECIFICATIONS:\n` +
                     `- Estimated Cook Time: ${time}\n` +
                     `- Target Smoker Temperature: ${temp}\n` +
                     `- Wood/Fuel Estimate: ${fuel}\n\n` +
                     `GRILL CAPACITY ANALYSIS:\n` +
                     `- Meat Surface Area: ${footprint}\n` +
                     `- Smoker Area Capacity Taken: ${capacity}\n\n` +
                     `Generated via ToolsHub BBQ Pitmaster Yield Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Plan Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bbq-calculator.blade.php ENDPATH**/ ?>