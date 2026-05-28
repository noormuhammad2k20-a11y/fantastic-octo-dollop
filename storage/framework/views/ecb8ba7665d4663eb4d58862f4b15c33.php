<div class="row g-4 hvac-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(14, 165, 233, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm airflow-pulse" style="background: linear-gradient(135deg, #0EA5E9, #0284C7); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-fan"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0c4a6e; letter-spacing: -0.5px;">Climate Control: HVAC Strategist</h4>
                    <p class="text-muted small mb-0">High-precision climate systems estimation. Calculate cooling capacity (Tons), efficiency (SEER), and hardware vs. labor allocation.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Heating & Cooling Load</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Living Area (conditioned)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-sqft" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="2000">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">SQFT</span>
                                    </div>
                                    <small class="text-muted mt-1 d-block" id="out-tons">Required: 4.0 Tons</small>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">System Efficiency (SEER)</label>
                                    <select id="v-seer" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="1.0">14 SEER (Standard)</option>
                                        <option value="1.15">16 SEER (High Eff.)</option>
                                        <option value="1.4">18 SEER (Premium)</option>
                                        <option value="1.8">22+ SEER (Ultra)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Primary Technology</label>
                                <select id="v-tech" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                    <option value="3500">Central Split System (AC/Furnace)</option>
                                    <option value="5500">Dual Fuel Heat Pump</option>
                                    <option value="4200">Ductless Multi-Zone Mini-Split</option>
                                    <option value="2800">Forced Air Furnace Only</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-sky">
                            <h6 class="fw-bold small mb-3 uppercase text-sky opacity-70">Infrastructure & Add-ons</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Ductwork Status</label>
                                <select id="v-duct" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="0">Existing (Good Condition)</option>
                                    <option value="1500">Duct Repair / Cleaning (+$1.5k)</option>
                                    <option value="4500">Full Duct Installation (+$4.5k)</option>
                                </select>
                            </div>
                            <div class="vstack gap-2">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Smart Thermostat Integration</label>
                                    <input class="form-check-input" type="checkbox" id="v-smart" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Whole Home Air Purifier</label>
                                    <input class="form-check-input" type="checkbox" id="v-purify">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Local Utility Rebates (-)</label>
                                    <input class="form-check-input" type="checkbox" id="v-rebate" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="1200" data-t="4200">Condo Mini-Split</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="2500" data-t="3500">Family Central AC</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="3500" data-t="5500">Luxury Hybrid Heat Pump</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 195; --tool-color: #0EA5E9; --tool-bg: rgba(14, 165, 233, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL ESTIMATED SYSTEM COST</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$8,450</div>
                <div class="badge bg-sky-soft text-sky px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">EST. $4.23 PER SQFT</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Capital Allocation</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">HARDWARE/UNIT</div><div class="h5 fw-bold mb-0" id="out-unit-cost">$5,000</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">INSTALL LABOR</div><div class="h5 fw-bold mb-0" id="out-lab">$2,500</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">EST. REBATES</div><div class="h5 fw-bold mb-0 text-success" id="out-rebate">-$1,200</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">ANNUAL SAVINGS</div><div class="h5 fw-bold mb-0" id="out-save">$450</div></div></div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Efficiency Insight</h6>
                            <div class="p-3 rounded-4 bg-sky-50 border border-sky-100 mb-4 text-sky">
                                <i class="fas fa-snowflake me-2"></i>
                                <span class="small fw-bold" id="out-advice">High SEER systems (18+) can reduce monthly energy bills by up to 40% compared to standard units.</span>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-sky rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Export System Specs
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Clear Config
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
    const sqftE = $('v-sqft'), seerE = $('v-seer'), techE = $('v-tech'), ductE = $('v-duct'), smartE = $('v-smart'), purifyE = $('v-purify'), rebateE = $('v-rebate');

    function calculate(){
        const sqft = parseFloat(sqftE.value) || 0;
        const tons = Math.ceil(sqft / 500 * 2) / 2; // Round to nearest 0.5 ton
        const techBase = parseFloat(techE.value);
        const efficiency = parseFloat(seerE.value);
        const ductCost = parseFloat(ductE.value);

        const hardware = techBase * (tons / 2.5) * efficiency;
        const labor = hardware * 0.4;
        const addOns = (smartE.checked ? 350 : 0) + (purifyE.checked ? 1200 : 0);
        const rebates = rebateE.checked ? Math.min(hardware * 0.1, 2000) : 0;

        const total = hardware + labor + addOns + ductCost - rebates;

        $('out-total').textContent = '$' + Math.round(total).toLocaleString();
        $('out-unit').textContent = 'EST. $' + (total / (sqft || 1)).toFixed(2) + ' PER SQFT';
        $('out-tons').textContent = `Required: ${tons.toFixed(1)} Tons`;

        $('out-unit-cost').textContent = '$' + Math.round(hardware).toLocaleString();
        $('out-lab').textContent = '$' + Math.round(labor + ductCost).toLocaleString();
        $('out-rebate').textContent = rebateE.checked ? '-$' + Math.round(rebates).toLocaleString() : '$0';
        
        // Est Savings (based on efficiency)
        const annualBase = sqft * 0.6; 
        const savings = annualBase * (1 - (1 / efficiency));
        $('out-save').textContent = '$' + Math.round(savings).toLocaleString();

        let adv = "Standard efficiency selected. Reliable performance for moderate climates.";
        if(efficiency > 1.3) adv = "Premium SEER rating detected. Federal tax credits may apply for high-efficiency heat pumps.";
        if(sqft > 3000) adv = "Large home alert: Multi-zone mini-splits or dual central units may be more effective.";
        $('out-advice').textContent = adv;
    }

    [sqftE, seerE, techE, ductE, smartE, purifyE, rebateE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            sqftE.value = btn.dataset.s; techE.value = btn.dataset.t; 
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `HVAC System Estimation\nLoad: ${$('out-tons').textContent}\nTechnology: ${techE.options[techE.selectedIndex].text}\nTotal Est: ${$('out-total').textContent}\nGenerated by Climate Control Strategist`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Specs Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { sqftE.value = 2000; calculate(); });

    calculate();
});
</script>

<style>
.hvac-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0c4a6e;opacity:.7;margin-bottom:8px;display:block}
.hvac-rebuilt .calculator-card { transition: all 0.3s ease; }
.airflow-pulse { animation: flow-pulse 3s infinite ease-in-out; }
@keyframes flow-pulse { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.05); opacity: 0.8; } }
.btn-sky { background: #0EA5E9; color: #fff; transition: all .3s; }
.btn-sky:hover { background: #0284C7; color: #fff; transform: translateY(-2px); }
.bg-sky-soft { background: #F0F9FF; color: #0EA5E9; }
.bg-sky-50 { background-color: #f7faff; }
.border-sky { border-color: #bae6fd !important; }
.text-sky { color: #0EA5E9 !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\hvac-installation-cost-calculator.blade.php ENDPATH**/ ?>