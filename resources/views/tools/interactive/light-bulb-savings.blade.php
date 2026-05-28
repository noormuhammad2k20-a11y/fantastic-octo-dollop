<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Bulbs Quantity & Hours --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Lighting Usage</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Number of Bulbs</label>
                                <input type="number" id="bulb-qty" class="form-control form-control-lg rounded-3" value="10" min="1" step="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Usage (Hours / Day)</label>
                                <input type="number" id="hours-day" class="form-control form-control-lg rounded-3" value="5" min="1" max="24" step="0.5">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Wattage Comparison --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Wattage Profile</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Old Bulb Wattage</label>
                                <input type="number" id="old-watt" class="form-control form-control-lg rounded-3" value="60" min="5" max="150" step="5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">New LED Wattage</label>
                                <input type="number" id="led-watt" class="form-control form-control-lg rounded-3" value="9" min="1" max="30" step="0.5">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Financial Metrics --}}
                <div class="col-12">
                    <div class="p-4 rounded-4 bg-light border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Rates & Purchasing</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Electricity Rate ($ / kWh)</label>
                                <input type="number" id="rate-elec" class="form-control form-control-lg rounded-3" value="0.15" min="0" step="0.01">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">LED Purchase Price ($ / bulb)</label>
                                <input type="number" id="led-price" class="form-control form-control-lg rounded-3" value="2.50" min="0" step="0.10">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-qty="15" data-hours="4" data-old="60" data-led="9" data-rate="0.15" data-price="2.50">
                    Home Refit (15 Bulbs, 60W -> 9W)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-qty="30" data-hours="8" data-old="75" data-led="11" data-rate="0.18" data-price="3.00">
                    Office Corridor (30 Bulbs, 75W -> 11W)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-qty="8" data-hours="3" data-old="100" data-led="14" data-rate="0.14" data-price="4.00">
                    High Brightness (8 Bulbs, 100W -> 14W)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-warning btn-lg rounded-pill px-5 shadow-sm transition-all text-dark fw-bold" id="btn-calculate" style="background-color: #ca8a04; border-color: #ca8a04;">
                    <i class="fas fa-bolt me-2 text-dark"></i> Analyze Energy Savings
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
                    <div class="icon-box me-3" style="background-color: #fef9c3; color: #ca8a04;">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Financial & Environmental Projections</h5>
                        <p class="text-muted small mb-0">Total cost reductions and ecological impact forecasts</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #ca8a04; border-color: #ca8a04; color: #1e293b;">
                        <i class="fas fa-copy me-1"></i> Copy Analysis
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #ca8a04;" id="result-annual-savings">$139.79</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1">Estimated Annual Savings</p>
            </div>

            <div class="row g-4">
                {{-- Financial Return --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-piggy-bank me-2 text-success"></i>Financial ROI Summary</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Total LED Purchase Cost:</span>
                                <span class="fw-bold text-dark" id="out-led-purchase">$25.00</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Monthly Bill Reduction:</span>
                                <span class="fw-bold text-dark" id="out-bill-monthly">$11.65</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Breakeven / Payback Time:</span>
                                <span class="fw-bold text-success" id="out-payback-months">2.1 months</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Est. 10-Year Return:</span>
                                <span class="fw-bold text-success h6 mb-0" id="out-savings-10y">$1,397.90</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Environmental Return --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-leaf me-2 text-success"></i>Eco & Carbon Impact</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Annual Energy Saved:</span>
                                <span class="fw-bold text-dark font-monospace" id="out-energy-saved">930.8 kWh</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">CO₂ Greenhouse Gas Reduced:</span>
                                <span class="fw-bold text-success" id="out-carbon-saved">791 lbs/yr</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Equivalency in Trees Planted:</span>
                                <span class="fw-bold text-dark" id="out-trees-planted">9 trees</span>
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
    .form-control:focus, .form-select:focus { border-color: #ca8a04; box-shadow: 0 0 0 4px rgba(202, 138, 4, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const qtyIn = document.getElementById('bulb-qty');
    const hoursIn = document.getElementById('hours-day');
    const oldWattIn = document.getElementById('old-watt');
    const ledWattIn = document.getElementById('led-watt');
    const rateElecIn = document.getElementById('rate-elec');
    const ledPriceIn = document.getElementById('led-price');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateBulbSavings() {
        const qty = parseInt(qtyIn.value) || 0;
        const hours = parseFloat(hoursIn.value) || 0;
        const oldW = parseFloat(oldWattIn.value) || 0;
        const ledW = parseFloat(ledWattIn.value) || 0;
        const rate = parseFloat(rateElecIn.value) || 0;
        const ledPrice = parseFloat(ledPriceIn.value) || 0;

        if (qty <= 0 || hours <= 0 || oldW <= 0 || ledW <= 0) {
            alert("Please enter valid positive quantities.");
            return;
        }

        if (ledW >= oldW) {
            alert("LED Wattage should be lower than your old bulb wattage!");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Lumens...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Daily energy calculations in kWh
            const oldEnergyDaily = (oldW * hours * qty) / 1000;
            const ledEnergyDaily = (ledW * hours * qty) / 1000;
            const dailySavedKWh = oldEnergyDaily - ledEnergyDaily;

            const annualSavedKWh = dailySavedKWh * 365;
            const annualSavingsDollar = annualSavedKWh * rate;

            const totalUpfrontCost = ledPrice * qty;
            const monthlySavings = annualSavingsDollar / 12;
            const paybackMonths = monthlySavings > 0 ? (totalUpfrontCost / monthlySavings) : 0;

            // Environmental metrics
            // 1 kWh saved is approx 0.85 lbs CO2 reduced
            const carbonReducedLbs = annualSavedKWh * 0.85;
            // 1 mature tree absorbs ~48 lbs CO2 per year
            const treesEquivalent = carbonReducedLbs / 48;

            const savings10Y = annualSavingsDollar * 10;

            // Render output
            document.getElementById('result-annual-savings').innerText = "$" + annualSavingsDollar.toFixed(2);
            document.getElementById('out-led-purchase').innerText = "$" + totalUpfrontCost.toFixed(2);
            document.getElementById('out-bill-monthly').innerText = "$" + monthlySavings.toFixed(2);
            document.getElementById('out-payback-months').innerText = paybackMonths.toFixed(1) + " months";
            document.getElementById('out-savings-10y').innerText = "$" + savings10Y.toFixed(2);

            document.getElementById('out-energy-saved').innerText = annualSavedKWh.toFixed(1) + " kWh";
            document.getElementById('out-carbon-saved').innerText = Math.round(carbonReducedLbs).toLocaleString() + " lbs/yr";
            document.getElementById('out-trees-planted').innerText = Math.round(treesEquivalent) + " trees";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-bolt me-2 text-dark"></i> Analyze Energy Savings';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateBulbSavings);

    btnReset.addEventListener('click', () => {
        qtyIn.value = 10;
        hoursIn.value = 5;
        oldWattIn.value = 60;
        ledWattIn.value = 9;
        rateElecIn.value = 0.15;
        ledPriceIn.value = 2.50;
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            qtyIn.value = this.dataset.qty;
            hoursIn.value = this.dataset.hours;
            oldWattIn.value = this.dataset.old;
            ledWattIn.value = this.dataset.led;
            rateElecIn.value = this.dataset.rate;
            ledPriceIn.value = this.dataset.price;
            calculateBulbSavings();
        });
    });

    btnCopy.addEventListener('click', function() {
        const annual = document.getElementById('result-annual-savings').innerText;
        const purchase = document.getElementById('out-led-purchase').innerText;
        const monthly = document.getElementById('out-bill-monthly').innerText;
        const payback = document.getElementById('out-payback-months').innerText;
        const saving10 = document.getElementById('out-savings-10y').innerText;
        const energy = document.getElementById('out-energy-saved').innerText;
        const carbon = document.getElementById('out-carbon-saved').innerText;
        const trees = document.getElementById('out-trees-planted').innerText;

        const text = `LED LIGHTING ENERGY SAVINGS ANALYSIS\n` +
                     `====================================\n` +
                     `Bulbs Replaced: ${qtyIn.value} | Hours Daily: ${hoursIn.value} Hours\n` +
                     `Old Wattage: ${oldWattIn.value}W | LED Wattage: ${ledWattIn.value}W\n` +
                     `Electricity Rate: $${rateElecIn.value}/kWh\n\n` +
                     `ESTIMATED ANNUAL FINANCIAL SAVINGS: ${annual}\n` +
                     `- Upfront Purchase Cost: ${purchase}\n` +
                     `- Monthly Bill Reduction: ${monthly}\n` +
                     `- Payback Period: ${payback}\n` +
                     `- Projected 10-Year Savings: ${saving10}\n\n` +
                     `ECOLOGICAL IMPACTS:\n` +
                     `- Annual Energy Saved: ${energy}\n` +
                     `- Carbon Dioxide Reduction: ${carbon}\n` +
                     `- Equiv. Trees Planted Value: ${trees}\n\n` +
                     `Generated via ToolsHub LED Savings Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Report Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
