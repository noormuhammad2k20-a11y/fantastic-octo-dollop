<div class="row g-4 volt-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(250, 204, 21, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm lightning-pulse" style="background: linear-gradient(135deg, #FACC15, #EAB308); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#422006; letter-spacing: -0.5px;">Volt Explorer: EV Charging Analyst</h4>
                    <p class="text-muted small mb-0">Optimize electric mobility costs, analyze charging efficiency, and compare energy-to-gasoline equivalents.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Energy & Rate Spec</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Battery Capacity</label>
                                    <div class="input-group">
                                        <input type="number" id="v-bat" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="75">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">kWh</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Electricity Rate</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-start-3 text-muted small">$</span>
                                        <input type="number" id="v-rate" class="form-control border-0 bg-white shadow-sm rounded-end-3 fw-bold h5 mb-0" value="0.15" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Vehicle Preset (Auto-load Spec)</label>
                                <select id="v-preset" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                    <option value="custom">-- Custom Specification --</option>
                                    <option value="54">Tesla Model 3 RWD (54 kWh)</option>
                                    <option value="82">Tesla Model Y LR (82 kWh)</option>
                                    <option value="135">Rivian R1S (135 kWh)</option>
                                    <option value="98">Ford F-150 Lightning (98 kWh)</option>
                                    <option value="64">Hyundai Ioniq 5 (77.4 kWh)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-yellow">
                            <h6 class="fw-bold small mb-3 uppercase text-yellow opacity-70">Charging Environment</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Charging Level / Efficiency</label>
                                <select id="v-level" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="0.85">Level 1 - Home (85% Eff.)</option>
                                    <option value="0.92" selected>Level 2 - Wallbox (92% Eff.)</option>
                                    <option value="0.95">DC Fast - Supercharger (95% Eff.)</option>
                                </select>
                            </div>
                            <div class="p-3 rounded-4 bg-yellow-50 border border-yellow-100">
                                <div class="small fw-bold text-yellow-900 mb-1">MILEAGE RANGE (EST)</div>
                                <div class="h5 fw-900 text-yellow-900 mb-0" id="out-range">280 MILES</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-b="100" data-r="0.12">Public AC Station</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-b="75" data-r="0.45">Tesla Supercharger (Peak)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-b="60" data-r="0.08">Overnight Home Charging</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 45; --tool-color: #EAB308; --tool-bg: rgba(250, 204, 21, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL CHARGING COST (0-100%)</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$12.23</div>
                <div class="badge bg-yellow-soft text-yellow px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">$0.04 PER MILE</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Energy Intelligence Matrix</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">ENERGY LOAD</div><div class="h5 fw-bold mb-0" id="out-load">81.5 kWh</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">GAS EQUIVALENT</div><div class="h5 fw-bold mb-0" id="out-gas">$42.10</div></div></div>
                            <div class="col-12">
                                <div class="p-3 rounded-4 bg-yellow-50 border border-yellow-100 mt-2">
                                    <div class="small fw-bold text-yellow-900 mb-1">CHARGING PROGRESSION</div>
                                    <div class="progress" style="height: 12px; border-radius: 6px; background: #fefce8;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-yellow" id="out-prog" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Efficiency Insight</h6>
                            <div class="p-3 rounded-4 bg-yellow-50 border border-yellow-100 mb-4">
                                <div class="small fw-bold text-yellow-900 lh-base" id="out-advice">Charging at home saves you approx. $29.87 compared to gas per 300 miles.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-yellow rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-plug me-2"></i>Copy Energy Report
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Grid
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const batE = $('v-bat'), rateE = $('v-rate'), presE = $('v-preset'), levE = $('v-level');

    function calculate(){
        const bat = parseFloat(batE.value) || 0;
        const rate = parseFloat(rateE.value) || 0;
        const eff = parseFloat(levE.value);

        const totalEnergy = bat / eff;
        const cost = totalEnergy * rate;
        const range = bat * 3.8; // Avg 3.8 miles per kWh
        const costPerMile = cost / range;

        $('out-total').textContent = '$' + cost.toFixed(2);
        $('out-load').textContent = totalEnergy.toFixed(1) + ' kWh';
        $('out-range').textContent = Math.round(range) + ' MILES';
        $('out-unit').textContent = '$' + costPerMile.toFixed(2) + ' PER MILE';
        
        // Gas comparison ($4/gallon, 30mpg)
        const gasCost = (range / 30) * 4.00;
        $('out-gas').textContent = '$' + gasCost.toFixed(2);
        $('out-prog').style.width = Math.min(100, (cost/gasCost)*100) + '%';

        let adv = `Charging at home saves you approx. $${(gasCost - cost).toFixed(2)} compared to gas per ${Math.round(range)} miles.`;
        if(costPerMile > 0.10) adv = "Warning: High energy rate detected. Public charging is approaching gasoline price levels.";
        $('out-advice').textContent = adv;
    }

    [batE, rateE, levE].forEach(e => e.addEventListener('input', calculate));
    presE.addEventListener('change', () => {
        if(presE.value !== 'custom') batE.value = presE.value;
        calculate();
    });

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { batE.value = btn.dataset.b; rateE.value = btn.dataset.r; calculate(); });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `EV Energy Report\nBattery: ${batE.value} kWh\nTotal Cost: ${$('out-total').textContent}\nRange: ${$('out-range').textContent}\nGenerated by ToolsHub Volt Explorer`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Report Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { batE.value = 75; rateE.value = 0.15; calculate(); });

    calculate();
});
</script>

<style>
.volt-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#422006;opacity:.7;margin-bottom:8px;display:block}
.volt-rebuilt .calculator-card { transition: all 0.3s ease; }
.lightning-pulse { animation: volt-pulse 2s infinite; }
@keyframes volt-pulse { 0% { box-shadow: 0 0 0 0 rgba(250, 204, 21, 0.4); } 70% { box-shadow: 0 0 0 15px rgba(250, 204, 21, 0); } 100% { box-shadow: 0 0 0 0 rgba(250, 204, 21, 0); } }
.btn-yellow { background: #FACC15; color: #422006; transition: all .3s; border: none; }
.btn-yellow:hover { background: #EAB308; transform: translateY(-2px); }
.bg-yellow-soft { background: #FEFCE8; color: #A16207; }
.bg-yellow-50 { background-color: #fffef0; }
.bg-yellow { background-color: #FACC15 !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ev-charging-cost-calculator.blade.php ENDPATH**/ ?>