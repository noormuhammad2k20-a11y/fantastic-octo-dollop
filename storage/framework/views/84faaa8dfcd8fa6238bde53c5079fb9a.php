<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light h-100 border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Guest Configuration</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Guests</label>
                                <input type="number" id="guests" class="form-control form-control-lg rounded-3" value="10" min="1" step="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Duration (Hours)</label>
                                <input type="number" id="duration" class="form-control form-control-lg rounded-3" value="4" min="1" step="1">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light h-100 border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Preferences</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Average Appetite</label>
                                <select id="appetite" class="form-select form-select-lg rounded-3">
                                    <option value="light">Light Eaters (0.5 lbs meat/person)</option>
                                    <option value="standard" selected>Standard (0.75 lbs meat/person)</option>
                                    <option value="heavy">Big Eaters (1.0 lbs meat/person)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="p-4 rounded-4 bg-light border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-3">Select Meats to Serve (Total quantity will be split)</label>
                        <div class="row g-3">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-check p-3 bg-white rounded-3 shadow-sm border border-light">
                                    <input class="form-check-input ms-0 me-2 meat-checkbox" type="checkbox" value="burgers" id="meat-burgers" checked>
                                    <label class="form-check-label fw-bold text-dark" for="meat-burgers">
                                        Burgers & Hot Dogs
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-check p-3 bg-white rounded-3 shadow-sm border border-light">
                                    <input class="form-check-input ms-0 me-2 meat-checkbox" type="checkbox" value="ribs" id="meat-ribs" checked>
                                    <label class="form-check-label fw-bold text-dark" for="meat-ribs">
                                        Pork Ribs
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-check p-3 bg-white rounded-3 shadow-sm border border-light">
                                    <input class="form-check-input ms-0 me-2 meat-checkbox" type="checkbox" value="pork" id="meat-pork">
                                    <label class="form-check-label fw-bold text-dark" for="meat-pork">
                                        Pulled Pork/Brisket
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-check p-3 bg-white rounded-3 shadow-sm border border-light">
                                    <input class="form-check-input ms-0 me-2 meat-checkbox" type="checkbox" value="chicken" id="meat-chicken">
                                    <label class="form-check-label fw-bold text-dark" for="meat-chicken">
                                        BBQ Chicken
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-guests="5" data-duration="3" data-appetite="light">
                    Small Casual (5 guests)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-guests="12" data-duration="4" data-appetite="standard">
                    Family Cookout (12 guests)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-guests="30" data-duration="6" data-appetite="heavy">
                    Big Summer Bash (30 guests)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #d32f2f; border-color: #d32f2f;">
                    <i class="fas fa-calculator me-2"></i> Calculate BBQ Plan
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #e8f5e9; color: #2e7d32;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">BBQ Shopping & Prep Guide</h5>
                        <p class="text-muted small mb-0">Recommended food and fuel estimates for your cookout</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #2e7d32; border-color: #2e7d32;">
                        <i class="fas fa-copy me-1"></i> Copy Shopping List
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #d32f2f;" id="result-total-meat">7.5 lbs</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1">Total Raw Meat Required</p>
            </div>

            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-hamburger me-2 text-danger"></i>Meats Portioning</h6>
                        <ul class="list-group list-group-flush bg-transparent" id="meat-breakdown-list">
                            
                        </ul>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-utensils me-2 text-warning"></i>Sides & Supplies</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="text-muted py-2">Side Dishes (Potato Salad/Coleslaw):</td>
                                        <td class="fw-bold text-dark text-end py-2" id="result-sides">4.0 lbs</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-2">Drinks / Refreshments:</td>
                                        <td class="fw-bold text-dark text-end py-2" id="result-drinks">20 cans/bottles</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-2">Charcoal Required:</td>
                                        <td class="fw-bold text-dark text-end py-2" id="result-charcoal">10 lbs (1 bag)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-2">Ice for Coolers:</td>
                                        <td class="fw-bold text-dark text-end py-2" id="result-ice">15 lbs</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    .form-control:focus, .form-select:focus { border-color: #d32f2f; box-shadow: 0 0 0 4px rgba(211, 47, 47, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const guestsIn = document.getElementById('guests');
    const durationIn = document.getElementById('duration');
    const appetiteIn = document.getElementById('appetite');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateBBQ() {
        const guests = parseInt(guestsIn.value) || 0;
        const duration = parseFloat(durationIn.value) || 0;
        const appetite = appetiteIn.value;

        if (guests <= 0 || duration <= 0) {
            alert("Please enter a valid guest count and duration.");
            return;
        }

        // Get selected meats
        const selectedMeats = [];
        document.querySelectorAll('.meat-checkbox:checked').forEach(cb => {
            selectedMeats.push(cb.value);
        });

        if (selectedMeats.length === 0) {
            alert("Please select at least one meat option.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Generating Plan...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Factor based on appetite
            let baseMeatPerPerson = 0.75;
            if (appetite === 'light') baseMeatPerPerson = 0.5;
            if (appetite === 'heavy') baseMeatPerPerson = 1.0;

            // Scale slightly for longer events
            if (duration > 4) {
                baseMeatPerPerson += (duration - 4) * 0.05;
            }

            const totalMeatRaw = baseMeatPerPerson * guests;
            const portionShare = totalMeatRaw / selectedMeats.length;

            // Generate meat portions list
            let meatHtml = '';
            selectedMeats.forEach(meat => {
                if (meat === 'burgers') {
                    const patties = Math.round(guests * 1.5);
                    const hotdogs = Math.round(guests * 1.0);
                    meatHtml += `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold text-dark">Burgers & Hot Dogs</span>
                            <div class="small text-muted">Estimated patties / links</div>
                        </div>
                        <span class="badge bg-danger rounded-pill px-3 py-2">${patties} Burgers & ${hotdogs} Hot Dogs</span>
                    </li>`;
                } else if (meat === 'ribs') {
                    const slabs = Math.ceil(guests * 0.5);
                    meatHtml += `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold text-dark">Pork Ribs</span>
                            <div class="small text-muted">Raw slabs/racks</div>
                        </div>
                        <span class="badge bg-danger rounded-pill px-3 py-2">${slabs} Racks</span>
                    </li>`;
                } else if (meat === 'pork') {
                    const lbs = portionShare.toFixed(1);
                    meatHtml += `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold text-dark">Pulled Pork / Brisket</span>
                            <div class="small text-muted">Raw weight (pork shoulder/brisket)</div>
                        </div>
                        <span class="badge bg-danger rounded-pill px-3 py-2">${lbs} lbs</span>
                    </li>`;
                } else if (meat === 'chicken') {
                    const lbs = portionShare.toFixed(1);
                    meatHtml += `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold text-dark">BBQ Chicken</span>
                            <div class="small text-muted">Raw wings, thighs, or breasts</div>
                        </div>
                        <span class="badge bg-danger rounded-pill px-3 py-2">${lbs} lbs</span>
                    </li>`;
                }
            });

            document.getElementById('meat-breakdown-list').innerHTML = meatHtml;

            // Calculate sides & extra
            const sideDishes = (guests * 0.4).toFixed(1);
            const drinks = Math.round(guests * (2 + (duration - 1) * 0.8));
            const charcoal = Math.round(totalMeatRaw * 1.2 + 5);
            const bagText = charcoal > 15 ? ` (${Math.ceil(charcoal / 15)} bags)` : ' (1 bag)';
            const ice = Math.round(guests * 1.5);

            document.getElementById('result-total-meat').innerText = totalMeatRaw.toFixed(1) + " lbs";
            document.getElementById('result-sides').innerText = sideDishes + " lbs";
            document.getElementById('result-drinks').innerText = drinks + " cans/bottles";
            document.getElementById('result-charcoal').innerText = charcoal + " lbs" + bagText;
            document.getElementById('result-ice').innerText = ice + " lbs";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Calculate BBQ Plan';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateBBQ);

    btnReset.addEventListener('click', () => {
        guestsIn.value = 10;
        durationIn.value = 4;
        appetiteIn.value = 'standard';
        document.querySelectorAll('.meat-checkbox').forEach((cb, idx) => {
            cb.checked = idx < 2; // Burgers and ribs checked by default
        });
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            guestsIn.value = this.dataset.guests;
            durationIn.value = this.dataset.duration;
            appetiteIn.value = this.dataset.appetite;
            calculateBBQ();
        });
    });

    btnCopy.addEventListener('click', function() {
        let meatListText = '';
        const selectedMeats = [];
        document.querySelectorAll('.meat-checkbox:checked').forEach(cb => {
            selectedMeats.push(cb.value);
        });

        const totalMeat = document.getElementById('result-total-meat').innerText;
        const sides = document.getElementById('result-sides').innerText;
        const drinks = document.getElementById('result-drinks').innerText;
        const charcoal = document.getElementById('result-charcoal').innerText;
        const ice = document.getElementById('result-ice').innerText;

        let meatDetails = '';
        if (selectedMeats.includes('burgers')) {
            const patties = Math.round(parseInt(guestsIn.value) * 1.5);
            const hotdogs = Math.round(parseInt(guestsIn.value) * 1.0);
            meatDetails += `- Burgers: ${patties} patties\n- Hot Dogs: ${hotdogs} links\n`;
        }
        if (selectedMeats.includes('ribs')) {
            meatDetails += `- Pork Ribs: ${Math.ceil(parseInt(guestsIn.value) * 0.5)} racks\n`;
        }
        if (selectedMeats.includes('pork')) {
            meatDetails += `- Pulled Pork/Brisket: ${(parseFloat(totalMeat) / selectedMeats.length).toFixed(1)} lbs\n`;
        }
        if (selectedMeats.includes('chicken')) {
            meatDetails += `- BBQ Chicken: ${(parseFloat(totalMeat) / selectedMeats.length).toFixed(1)} lbs\n`;
        }

        const text = `BBQ PARTY PLANNER SUMMARY\n` +
                     `=========================\n` +
                     `Guests: ${guestsIn.value} | Duration: ${durationIn.value} Hours | Appetite: ${appetiteIn.value}\n\n` +
                     `MEATS SHOPPING LIST:\n` +
                     `Total Meat: ${totalMeat}\n` +
                     meatDetails + `\n` +
                     `SIDES, DRINKS & SUPPLIES:\n` +
                     `- Side Dishes: ${sides}\n` +
                     `- Drinks/Beverages: ${drinks}\n` +
                     `- Charcoal: ${charcoal}\n` +
                     `- Cooler Ice: ${ice}\n\n` +
                     `Generated via ToolsHub BBQ Party Planner.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Shopping List!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bbq-party-planner.blade.php ENDPATH**/ ?>