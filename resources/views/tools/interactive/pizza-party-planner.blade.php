<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Guests & Appetite --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Attendance & Appetite</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Number of Guests</label>
                                <input type="number" id="guests" class="form-control form-control-lg rounded-3" value="12" min="1" step="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Appetite Style</label>
                                <select id="appetite" class="form-select form-select-lg rounded-3">
                                    <option value="light">Light (2 slices/guest)</option>
                                    <option value="average" selected>Average (3 slices/guest)</option>
                                    <option value="heavy">Hungry (4 slices/guest)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pizza Preferences --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Pizza Dimensions</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Preferred Size</label>
                                <select id="pizza-size" class="form-select form-select-lg rounded-3">
                                    <option value="medium">Medium 12" (8 slices)</option>
                                    <option value="large" selected>Large 14" (8 slices)</option>
                                    <option value="xlarge">Extra Large 16" (10 slices)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-guests="8" data-appetite="average" data-size="large">
                    Office Lunch (8 guests)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-guests="20" data-appetite="heavy" data-size="xlarge">
                    Teen Party (20 guests)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-guests="5" data-appetite="light" data-size="medium">
                    Casual Game Night (5 guests)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #dc2626; border-color: #dc2626;">
                    <i class="fas fa-pizza-slice me-2"></i> Calculate Pizza Order
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #fef2f2; color: #dc2626;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Your Pizza Order Details</h5>
                        <p class="text-muted small mb-0">Recommended pies, slice count, and estimated budget</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #dc2626; border-color: #dc2626;">
                        <i class="fas fa-copy me-1"></i> Copy Order Summary
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #dc2626;" id="result-total-pizzas">5 Pizzas</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1" id="result-total-slices">Totaling 36 Slices (3 slices/person)</p>
            </div>

            <div class="row g-4">
                {{-- Recommended Splits --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-list me-2 text-danger"></i>Topping Recommendations</h6>
                        <ul class="list-group list-group-flush bg-transparent" id="recommended-toppings">
                            {{-- Dynamically Populated --}}
                        </ul>
                    </div>
                </div>

                {{-- Cost & Slices Stats --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-dollar-sign me-2 text-success"></i>Cost & Details</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="text-muted py-2">Total Slices Needed:</td>
                                        <td class="fw-bold text-dark text-end py-2" id="out-slices-req">36 slices</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-2">Slices Provided:</td>
                                        <td class="fw-bold text-dark text-end py-2" id="out-slices-prov">40 slices</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-2">Leftover Slices:</td>
                                        <td class="fw-bold text-dark text-end py-2 text-success" id="out-slices-left">4 slices</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-2 border-top">Estimated Total Cost:</td>
                                        <td class="fw-bold text-dark text-end py-2 border-top text-success h5 mb-0" id="out-cost">$90.00</td>
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
    .form-control:focus, .form-select:focus { border-color: #dc2626; box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const guestsIn = document.getElementById('guests');
    const appetiteIn = document.getElementById('appetite');
    const sizeIn = document.getElementById('pizza-size');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculatePizza() {
        const guests = parseInt(guestsIn.value) || 0;
        const appetite = appetiteIn.value;
        const size = sizeIn.value;

        if (guests <= 0) {
            alert("Please enter a valid guest count.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Baking Plan...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Slices per person
            let slicesPerPerson = 3;
            if (appetite === 'light') slicesPerPerson = 2;
            if (appetite === 'heavy') slicesPerPerson = 4;

            const totalSlicesReq = guests * slicesPerPerson;

            // Slices per pizza size
            let slicesPerPizza = 8;
            let baseCost = 18.00; // Large
            if (size === 'medium') {
                slicesPerPizza = 8;
                baseCost = 14.00;
            } else if (size === 'xlarge') {
                slicesPerPizza = 10;
                baseCost = 22.00;
            }

            const totalPizzas = Math.ceil(totalSlicesReq / slicesPerPizza);
            const totalSlicesProv = totalPizzas * slicesPerPizza;
            const leftoverSlices = totalSlicesProv - totalSlicesReq;
            const totalCost = totalPizzas * baseCost;

            // Dynamic recommendations
            let cheesePies = 1;
            let pepperPies = 1;
            let veggieSpecial = 0;

            if (totalPizzas === 1) {
                cheesePies = 1;
                pepperPies = 0;
                veggieSpecial = 0;
            } else if (totalPizzas === 2) {
                cheesePies = 1;
                pepperPies = 1;
                veggieSpecial = 0;
            } else {
                pepperPies = Math.ceil(totalPizzas * 0.45);
                veggieSpecial = Math.ceil(totalPizzas * 0.35);
                cheesePies = totalPizzas - pepperPies - veggieSpecial;
                if (cheesePies < 0) cheesePies = 0;
            }

            let toppingsHtml = `<li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                <span><i class="fas fa-circle text-danger me-2"></i>Pepperoni / Meat</span>
                <span class="fw-bold">${pepperPies} Pies</span>
            </li>
            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                <span><i class="fas fa-leaf text-success me-2"></i>Vegetarian / Specialty</span>
                <span class="fw-bold">${veggieSpecial} Pies</span>
            </li>
            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                <span><i class="fas fa-cheese text-warning me-2"></i>Cheese / Simple</span>
                <span class="fw-bold">${cheesePies} Pies</span>
            </li>`;

            document.getElementById('recommended-toppings').innerHTML = toppingsHtml;

            // Populate results
            document.getElementById('result-total-pizzas').innerText = totalPizzas + (totalPizzas === 1 ? " Pizza" : " Pizzas");
            document.getElementById('result-total-slices').innerText = `Totaling ${totalSlicesProv} Slices (${slicesPerPerson} slices/person)`;

            document.getElementById('out-slices-req').innerText = totalSlicesReq + " slices";
            document.getElementById('out-slices-prov').innerText = totalSlicesProv + " slices";
            document.getElementById('out-slices-left').innerText = leftoverSlices + " slices";
            document.getElementById('out-cost').innerText = "$" + totalCost.toFixed(2);

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-pizza-slice me-2"></i> Calculate Pizza Order';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculatePizza);

    btnReset.addEventListener('click', () => {
        guestsIn.value = 12;
        appetiteIn.value = 'average';
        sizeIn.value = 'large';
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            guestsIn.value = this.dataset.guests;
            appetiteIn.value = this.dataset.appetite;
            sizeIn.value = this.dataset.size;
            calculatePizza();
        });
    });

    btnCopy.addEventListener('click', function() {
        const pizzas = document.getElementById('result-total-pizzas').innerText;
        const slices = document.getElementById('result-total-slices').innerText;
        const cost = document.getElementById('out-cost').innerText;
        const sReq = document.getElementById('out-slices-req').innerText;
        const sProv = document.getElementById('out-slices-prov').innerText;
        const sLeft = document.getElementById('out-slices-left').innerText;

        let toppingBreakdown = '';
        document.querySelectorAll('#recommended-toppings li').forEach(li => {
            toppingBreakdown += `- ${li.children[0].innerText}: ${li.children[1].innerText}\n`;
        });

        const text = `PIZZA PARTY PLANNER SUMMARY\n` +
                     `===========================\n` +
                     `Guests: ${guestsIn.value} | Appetite Style: ${appetiteIn.options[appetiteIn.selectedIndex].text}\n` +
                     `Pizza Size: ${sizeIn.options[sizeIn.selectedIndex].text}\n\n` +
                     `ORDER RECOMMENDATION: ${pizzas}\n` +
                     `${slices}\n\n` +
                     `TOPPING BREAKDOWN:\n` +
                     toppingBreakdown + `\n` +
                     `COST & QUANTITY ANALYSIS:\n` +
                     `- Slices Required: ${sReq}\n` +
                     `- Slices Provided: ${sProv}\n` +
                     `- Leftover Slices: ${sLeft}\n` +
                     `- Estimated Total Cost: ${cost}\n\n` +
                     `Generated via ToolsHub Pizza Party Planner.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Summary!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
