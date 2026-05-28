<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Guest Configuration</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Total Guests</label>
                                <input type="number" id="guests" class="form-control form-control-lg rounded-3" value="100" min="1" step="5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Duration (hours)</label>
                                <input type="number" id="duration" class="form-control form-control-lg rounded-3" value="5" min="1" step="1">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Drinking Profile</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Crowd Drinking Style</label>
                                <select id="drink-style" class="form-select form-select-lg rounded-3">
                                    <option value="light">Light Drinkers (approx. 1 drink/hr)</option>
                                    <option value="average" selected>Standard (approx. 1.2 drinks/hr)</option>
                                    <option value="heavy">Heavy Drinkers (approx. 1.6 drinks/hr)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="p-4 rounded-4 bg-light border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Bar Preferences</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Drink Menu Type</label>
                                <select id="bar-split" class="form-select form-select-lg rounded-3">
                                    <option value="balanced" selected>Full Bar Balanced (35% Wine, 35% Beer, 30% Spirits)</option>
                                    <option value="beer_wine">Beer & Wine Only (60% Wine, 40% Beer)</option>
                                    <option value="spirits_heavy">Spirits/Cocktail Heavy (20% Wine, 20% Beer, 60% Spirits)</option>
                                </select>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check p-3 bg-white rounded-3 shadow-sm border border-light w-100 mt-md-4">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" id="champagne-toast" checked>
                                    <label class="form-check-label fw-bold text-dark" for="champagne-toast">
                                        Include Champagne Toast for Guests
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-guests="50" data-duration="4" data-style="light" data-split="beer_wine" data-toast="false">
                    Micro-Wedding (50 guests, Beer/Wine)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-guests="120" data-duration="5" data-style="average" data-split="balanced" data-toast="true">
                    Standard Reception (120 guests, Full Bar)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-guests="200" data-duration="6" data-style="heavy" data-split="spirits_heavy" data-toast="true">
                    Grand Feast (200 guests, Heavy Spirits)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #db2777; border-color: #db2777;">
                    <i class="fas fa-glass-cheers me-2"></i> Calculate Bar Stock
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #fdf2f8; color: #db2777;">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Bar Procurement Estimates</h5>
                        <p class="text-muted small mb-0">Recommended beverage quantities for purchase</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #db2777; border-color: #db2777;">
                        <i class="fas fa-copy me-1"></i> Copy Bar Checklist
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #db2777;" id="result-total-drinks">600 Drinks</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1">Estimated Total Drinks Served</p>
            </div>

            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-shopping-cart me-2 text-pink"></i>Recommended Alcohol Quantities</h6>
                        <ul class="list-group list-group-flush bg-transparent" id="alcohol-checklist">
                            
                        </ul>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-info-circle me-2 text-warning"></i>Event Coordination Notes</h6>
                        <ul class="list-unstyled mb-0" style="line-height: 1.6;">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <span><strong>Wine Serving Size:</strong> Standard 750ml bottles contain exactly 5 pours (5oz each). Buy an extra case if you have a wine-heavy guest profile.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <span><strong>Spirits / Liquor:</strong> 750ml bottles contain about 16 servings (1.5oz jigger pours). Don't forget mixers: plan for 3 cans of soda/tonic per bottle.</span>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                <span><strong>Glassware Estimates:</strong> Rent/buy approximately 1.5 - 2 glasses per guest to account for misplaced cups during the reception.</span>
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
    .form-control:focus, .form-select:focus { border-color: #db2777; box-shadow: 0 0 0 4px rgba(219, 39, 119, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const guestsIn = document.getElementById('guests');
    const durationIn = document.getElementById('duration');
    const styleIn = document.getElementById('drink-style');
    const splitIn = document.getElementById('bar-split');
    const toastIn = document.getElementById('champagne-toast');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateAlcohol() {
        const guests = parseInt(guestsIn.value) || 0;
        const duration = parseFloat(durationIn.value) || 0;
        const style = styleIn.value;
        const split = splitIn.value;
        const toast = toastIn.checked;

        if (guests <= 0 || duration <= 0) {
            alert("Please enter a valid guest count and duration.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Stocking Bar...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Slices per person
            let drinksRate = 1.2;
            if (style === 'light') drinksRate = 0.9;
            if (style === 'heavy') drinksRate = 1.6;

            const totalDrinks = Math.round(guests * (drinksRate * duration));

            // Split ratios
            let winePct = 0.35;
            let beerPct = 0.35;
            let spiritsPct = 0.30;

            if (split === 'beer_wine') {
                winePct = 0.60;
                beerPct = 0.40;
                spiritsPct = 0.00;
            } else if (split === 'spirits_heavy') {
                winePct = 0.20;
                beerPct = 0.20;
                spiritsPct = 0.60;
            }

            const wineDrinks = totalDrinks * winePct;
            const beerDrinks = totalDrinks * beerPct;
            const spiritsDrinks = totalDrinks * spiritsPct;

            // Quantities conversions
            const wineBottles = Math.ceil(wineDrinks / 5);
            const beerCases = Math.ceil(beerDrinks / 24); // 24 pack cases
            const spiritsBottles = Math.ceil(spiritsDrinks / 16); // 750ml bottles (16 drinks each)
            const champagneBottles = toast ? Math.ceil(guests / 6) : 0; // 6 glasses per bottle

            // Render list
            let checklistHtml = '';
            if (wineBottles > 0) {
                checklistHtml += `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold text-dark">Wine Bottles (750ml)</span>
                        <div class="small text-muted">Serves approx. ${Math.round(wineDrinks)} glasses</div>
                    </div>
                    <span class="badge bg-danger rounded-pill px-3 py-2">${wineBottles} Bottles (${Math.ceil(wineBottles/12)} cases)</span>
                </li>`;
            }
            if (beerCases > 0) {
                checklistHtml += `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold text-dark">Beer Cases (24 Packs)</span>
                        <div class="small text-muted">Serves approx. ${Math.round(beerDrinks)} cans/bottles</div>
                    </div>
                    <span class="badge bg-danger rounded-pill px-3 py-2">${beerCases} Cases (${beerCases * 24} individual beers)</span>
                </li>`;
            }
            if (spiritsBottles > 0) {
                checklistHtml += `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold text-dark">Spirits / Liquor Bottles (750ml)</span>
                        <div class="small text-muted">Serves approx. ${Math.round(spiritsDrinks)} mixed drinks</div>
                    </div>
                    <span class="badge bg-danger rounded-pill px-3 py-2">${spiritsBottles} Bottles</span>
                </li>`;
            }
            if (champagneBottles > 0) {
                checklistHtml += `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold text-dark">Champagne (750ml)</span>
                        <div class="small text-muted">For a single toast of ${guests} guests</div>
                    </div>
                    <span class="badge bg-danger rounded-pill px-3 py-2">${champagneBottles} Bottles</span>
                </li>`;
            }

            document.getElementById('alcohol-checklist').innerHTML = checklistHtml;
            document.getElementById('result-total-drinks').innerText = totalDrinks + " Drinks";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-glass-cheers me-2"></i> Calculate Bar Stock';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateAlcohol);

    btnReset.addEventListener('click', () => {
        guestsIn.value = 100;
        durationIn.value = 5;
        styleIn.value = 'average';
        splitIn.value = 'balanced';
        toastIn.checked = true;
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            guestsIn.value = this.dataset.guests;
            durationIn.value = this.dataset.duration;
            styleIn.value = this.dataset.style;
            splitIn.value = this.dataset.split;
            toastIn.checked = this.dataset.toast === 'true';
            calculateAlcohol();
        });
    });

    btnCopy.addEventListener('click', function() {
        const drinks = document.getElementById('result-total-drinks').innerText;
        let shoppingText = '';
        document.querySelectorAll('#alcohol-checklist li').forEach(li => {
            shoppingText += `- ${li.children[0].children[0].innerText}: ${li.children[1].innerText}\n`;
        });

        const text = `WEDDING & EVENT ALCOHOL PROCUREMENT REPORT\n` +
                     `==========================================\n` +
                     `Guests: ${guestsIn.value} | Event Duration: ${durationIn.value} Hours\n` +
                     `Drinking Profile: ${styleIn.options[styleIn.selectedIndex].text}\n` +
                     `Bar Preference split: ${splitIn.options[splitIn.selectedIndex].text}\n\n` +
                     `ESTIMATED TOTAL DRINKS SERVED: ${drinks}\n\n` +
                     `SHOPPING CHECKLIST:\n` +
                     shoppingText + `\n` +
                     `Generated via ToolsHub Wedding Alcohol Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Checklist!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\wedding-alcohol-calculator.blade.php ENDPATH**/ ?>