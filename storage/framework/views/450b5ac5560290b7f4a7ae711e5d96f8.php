<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Shower Metrics</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Duration (mins)</label>
                                <input type="number" id="shower-duration" class="form-control form-control-lg rounded-3" value="10" min="1" step="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Flow Rate (GPM)</label>
                                <input type="number" id="shower-flow" class="form-control form-control-lg rounded-3" value="2.5" min="0.5" step="0.1">
                            </div>
                        </div>
                        <div class="mt-3 small text-muted">
                            <i class="fas fa-info-circle me-1"></i> Standard heads are 2.5 GPM; eco-friendly heads are 1.5 - 1.8 GPM.
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Energy & Heating</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Water Heating Source</label>
                                <select id="heating-source" class="form-select form-select-lg rounded-3">
                                    <option value="electric" selected>Electric Water Heater</option>
                                    <option value="gas">Natural Gas Heater</option>
                                    <option value="solar">Solar / Unheated (0 energy cost)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="p-4 rounded-4 bg-light border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Utility Rates</label>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Water Cost ($ / 1,000 Gallons)</label>
                                <input type="number" id="rate-water" class="form-control form-control-lg rounded-3" value="10.00" min="0" step="0.50">
                            </div>
                            <div class="col-md-4" id="energy-rate-container">
                                <label class="form-label small text-muted" id="energy-rate-label">Electricity Cost ($ / kWh)</label>
                                <input type="number" id="rate-energy" class="form-control form-control-lg rounded-3" value="0.15" min="0" step="0.01">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Showers per Week</label>
                                <input type="number" id="showers-week" class="form-control form-control-lg rounded-3" value="7" min="1" max="21" step="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-dur="8" data-flow="1.5" data-heat="electric" data-water="10.00" data-energy="0.15">
                    Standard Eco-Shower (8m @ 1.5 GPM)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-dur="15" data-flow="2.5" data-heat="electric" data-water="12.00" data-energy="0.22">
                    Luxury Power Bath (15m @ 2.5 GPM)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-dur="10" data-flow="2.5" data-heat="gas" data-water="10.00" data-energy="1.50">
                    Gas Heated Standard (10m @ 2.5 GPM)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #0284c7; border-color: #0284c7;">
                    <i class="fas fa-shower me-2"></i> Calculate Shower Cost
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #e0f2fe; color: #0284c7;">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Shower Cost & Consumption Report</h5>
                        <p class="text-muted small mb-0">Financial and ecological impact metrics</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #0284c7; border-color: #0284c7;">
                        <i class="fas fa-copy me-1"></i> Copy Cost Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #0284c7;" id="result-cost-per-shower">$0.93</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1">Estimated Cost Per Shower</p>
            </div>

            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-chart-line me-2 text-primary"></i>Financial Projections</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Water Cost / Shower:</span>
                                <span class="fw-bold text-dark" id="out-water-cost">$0.25</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Energy Cost / Shower:</span>
                                <span class="fw-bold text-dark" id="out-energy-cost">$0.68</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Weekly Total:</span>
                                <span class="fw-bold text-dark" id="out-cost-weekly">$6.51</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Annual Total Cost:</span>
                                <span class="fw-bold text-success h6 mb-0" id="out-cost-annual">$338.52</span>
                            </li>
                        </ul>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-tint me-2 text-info"></i>Resource Usage & Ecology</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Water Used / Shower:</span>
                                <span class="fw-bold text-dark" id="out-water-gal">25 Gallons</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Energy Consumption:</span>
                                <span class="fw-bold text-dark" id="out-energy-usage">4.50 kWh</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Annual Water Usage:</span>
                                <span class="fw-bold text-dark" id="out-water-annual">9,125 Gallons</span>
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
    .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const durationIn = document.getElementById('shower-duration');
    const flowIn = document.getElementById('shower-flow');
    const heatingIn = document.getElementById('heating-source');
    const waterRateIn = document.getElementById('rate-water');
    const energyRateIn = document.getElementById('rate-energy');
    const frequencyIn = document.getElementById('showers-week');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    // Dynamic energy rates labeling
    heatingIn.addEventListener('change', function() {
        const energyContainer = document.getElementById('energy-rate-container');
        const rateLabel = document.getElementById('energy-rate-label');
        
        if (this.value === 'electric') {
            energyContainer.classList.remove('d-none');
            rateLabel.innerText = "Electricity Cost ($ / kWh)";
            energyRateIn.value = "0.15";
        } else if (this.value === 'gas') {
            energyContainer.classList.remove('d-none');
            rateLabel.innerText = "Natural Gas Cost ($ / Therm)";
            energyRateIn.value = "1.50";
        } else {
            energyContainer.classList.add('d-none');
        }
    });

    function calculateShower() {
        const duration = parseFloat(durationIn.value) || 0;
        const flow = parseFloat(flowIn.value) || 0;
        const heating = heatingIn.value;
        const waterRate = parseFloat(waterRateIn.value) || 0;
        const energyRate = parseFloat(energyRateIn.value) || 0;
        const frequency = parseInt(frequencyIn.value) || 7;

        if (duration <= 0 || flow <= 0) {
            alert("Please enter valid duration and flow rates.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Utilities...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const gallonsPerShower = duration * flow;
            const annualShowers = frequency * 52;

            // Water cost
            const waterCostPerShower = (gallonsPerShower / 1000) * waterRate;

            // Energy usage and cost
            let energyUsage = 0; // kWh or Therms
            let energyCost = 0;
            let energyUnit = '';

            if (heating === 'electric') {
                // ~0.18 kWh of heat needed per gallon (assumes raising 50°F water to 105°F)
                energyUsage = gallonsPerShower * 0.18;
                energyCost = energyUsage * energyRate;
                energyUnit = 'kWh';
            } else if (heating === 'gas') {
                // ~0.008 Therms of gas per gallon
                energyUsage = gallonsPerShower * 0.008;
                energyCost = energyUsage * energyRate;
                energyUnit = 'Therms';
            }

            const totalCostPerShower = waterCostPerShower + energyCost;
            const totalWeeklyCost = totalCostPerShower * frequency;
            const totalAnnualCost = totalCostPerShower * annualShowers;
            const annualWaterUsage = gallonsPerShower * annualShowers;

            // Render results
            document.getElementById('result-cost-per-shower').innerText = "$" + totalCostPerShower.toFixed(2);
            document.getElementById('out-water-cost').innerText = "$" + waterCostPerShower.toFixed(2);
            document.getElementById('out-energy-cost').innerText = "$" + energyCost.toFixed(2);
            document.getElementById('out-cost-weekly').innerText = "$" + totalWeeklyCost.toFixed(2);
            document.getElementById('out-cost-annual').innerText = "$" + totalAnnualCost.toFixed(2);

            document.getElementById('out-water-gal').innerText = gallonsPerShower.toFixed(1) + " Gallons";
            
            if (heating !== 'solar') {
                document.getElementById('out-energy-usage').innerText = energyUsage.toFixed(2) + " " + energyUnit;
            } else {
                document.getElementById('out-energy-usage').innerText = "0.00 (Solar)";
            }
            
            document.getElementById('out-water-annual').innerText = Math.round(annualWaterUsage).toLocaleString() + " Gallons";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-shower me-2"></i> Calculate Shower Cost';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateShower);

    btnReset.addEventListener('click', () => {
        durationIn.value = 10;
        flowIn.value = 2.5;
        heatingIn.value = 'electric';
        waterRateIn.value = "10.00";
        energyRateIn.value = "0.15";
        frequencyIn.value = 7;
        document.getElementById('energy-rate-container').classList.remove('d-none');
        document.getElementById('energy-rate-label').innerText = "Electricity Cost ($ / kWh)";
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            durationIn.value = this.dataset.dur;
            flowIn.value = this.dataset.flow;
            heatingIn.value = this.dataset.heat;
            waterRateIn.value = this.dataset.water;
            energyRateIn.value = this.dataset.energy;
            
            // Trigger manual dropdown styling changes
            const energyContainer = document.getElementById('energy-rate-container');
            const rateLabel = document.getElementById('energy-rate-label');
            if (this.dataset.heat === 'electric') {
                energyContainer.classList.remove('d-none');
                rateLabel.innerText = "Electricity Cost ($ / kWh)";
            } else if (this.dataset.heat === 'gas') {
                energyContainer.classList.remove('d-none');
                rateLabel.innerText = "Natural Gas Cost ($ / Therm)";
            } else {
                energyContainer.classList.add('d-none');
            }
            calculateShower();
        });
    });

    btnCopy.addEventListener('click', function() {
        const cost = document.getElementById('result-cost-per-shower').innerText;
        const water = document.getElementById('out-water-cost').innerText;
        const energy = document.getElementById('out-energy-cost').innerText;
        const annual = document.getElementById('out-cost-annual').innerText;
        const gal = document.getElementById('out-water-gal').innerText;
        const usage = document.getElementById('out-energy-usage').innerText;

        const text = `SHOWER COST & UTILITY PLAN\n` +
                     `===========================\n` +
                     `Duration: ${durationIn.value} mins | Flow Rate: ${flowIn.value} GPM\n` +
                     `Heating Type: ${heatingIn.options[heatingIn.selectedIndex].text}\n` +
                     `Showers / Week: ${frequencyIn.value}\n\n` +
                     `COST PER SHOWER: ${cost}\n` +
                     `- Water Cost: ${water}\n` +
                     `- Energy Cost: ${energy}\n` +
                     `ESTIMATED ANNUAL COST: ${annual}\n\n` +
                     `RESOURCE CONSUMPTION:\n` +
                     `- Water Used: ${gal}\n` +
                     `- Heating Energy Used: ${usage}\n\n` +
                     `Generated via ToolsHub Shower Cost Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Report!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\shower-cost-calculator.blade.php ENDPATH**/ ?>