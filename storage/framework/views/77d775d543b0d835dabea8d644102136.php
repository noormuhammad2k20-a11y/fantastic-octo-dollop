<div class="row g-4 freight-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(249, 115, 22, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm truck-move" style="background: linear-gradient(135deg, #F97316, #EA580C); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-truck-fast"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#431407; letter-spacing: -0.5px;">Logistics Pro: Freight Analyst</h4>
                    <p class="text-muted small mb-0">Enterprise-grade freight cost estimation. Support for NMFC Freight Classes, LTL vs. FTL routing, and dynamic fuel surcharges.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Shipment Specification</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Total Weight (Actual)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-weight" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="2000">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">LBS</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Haul Distance</label>
                                    <div class="input-group">
                                        <input type="number" id="v-dist" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="500">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">MILES</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">NMFC Freight Class</label>
                                    <select id="v-class" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="1.0">Class 50 (Dense/Bricks)</option>
                                        <option value="1.2" selected>Class 70 (Machinery)</option>
                                        <option value="1.8">Class 100 (Cartons)</option>
                                        <option value="2.5">Class 150 (Furniture)</option>
                                        <option value="5.0">Class 300 (Light/Bulky)</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Service Type</label>
                                    <select id="v-type" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="LTL">LTL (Less Truckload)</option>
                                        <option value="FTL">FTL (Full Truckload)</option>
                                        <option value="EXP">Expedited Critical</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-orange">
                            <h6 class="fw-bold small mb-3 uppercase text-orange opacity-70">Accessorials & Fuel</h6>
                            <div class="mb-4">
                                <label class="form-label-custom d-flex justify-content-between">Fuel Surcharge (%) <span id="fuel-val" class="text-orange">24%</span></label>
                                <input type="range" class="form-range" id="v-fuel" min="0" max="60" value="24">
                            </div>
                            <div class="vstack gap-2">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Liftgate Service</label>
                                    <input class="form-check-input" type="checkbox" id="v-lift">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Residential Delivery</label>
                                    <input class="form-check-input" type="checkbox" id="v-res">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Inside Pickup/Delivery</label>
                                    <input class="form-check-input" type="checkbox" id="v-inside">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-w="1500" data-d="800" data-c="1.2">Cross-Country Pallet</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-w="10000" data-d="300" data-c="1.0">Heavy Industrial (Short)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-w="500" data-d="1200" data-c="2.5">Light Volumetric Freight</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 24; --tool-color: #F97316; --tool-bg: rgba(249, 115, 22, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">ESTIMATED FREIGHT QUOTE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$1,450</div>
                <div class="badge bg-orange-soft text-orange px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">$2.90 PER MILE</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Logistics Breakdown</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">BASE FREIGHT</div><div class="h5 fw-bold mb-0" id="out-base">$1,000</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">FUEL SURCHARGE</div><div class="h5 fw-bold mb-0" id="out-fuel-cost">$240</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">ACCESSORIALS</div><div class="h5 fw-bold mb-0" id="out-acc">$210</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">RATE PER CWT</div><div class="h5 fw-bold mb-0" id="out-cwt">$50.00</div></div></div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Transit Estimate</h6>
                            <div class="p-3 rounded-4 bg-orange-50 border border-orange-100 mb-4 text-orange">
                                <i class="fas fa-clock me-2"></i>
                                <span class="small fw-bold" id="out-advice">Estimated Transit: 3-5 Business Days. NMFC Class 70 provides a balanced density-to-rate ratio.</span>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-orange rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-invoice me-2"></i>Copy Freight Quote
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Route
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
    const weightE = $('v-weight'), distE = $('v-dist'), classE = $('v-class'), typeE = $('v-type'), fuelE = $('v-fuel');
    const liftE = $('v-lift'), resE = $('v-res'), insideE = $('v-inside');

    function calculate(){
        const weight = parseFloat(weightE.value) || 0;
        const dist = parseFloat(distE.value) || 0;
        const fClass = parseFloat(classE.value);
        const sType = typeE.value;
        const fuelPct = parseFloat(fuelE.value) / 100;

        $('fuel-val').textContent = fuelE.value + '%';

        // LTL vs FTL logic
        let baseRate = 0;
        if(sType === 'FTL') {
            baseRate = dist * 2.50; // $2.50 per mile
        } else if(sType === 'EXP') {
            baseRate = (weight * 0.15) + (dist * 2.00);
        } else {
            // Standard LTL
            const cwt = weight / 100;
            const ratePerCwt = (35 + (fClass * 10)) * (dist / 1000 + 0.5);
            baseRate = cwt * ratePerCwt;
        }

        const fuelCost = baseRate * fuelPct;
        const acc = (liftE.checked ? 75 : 0) + (resE.checked ? 110 : 0) + (insideE.checked ? 150 : 0);
        
        const total = baseRate + fuelCost + acc;
        const perMile = total / (dist || 1);

        $('out-total').textContent = '$' + Math.round(total).toLocaleString();
        $('out-unit').textContent = '$' + perMile.toFixed(2) + ' PER MILE';
        
        $('out-base').textContent = '$' + Math.round(baseRate).toLocaleString();
        $('out-fuel-cost').textContent = '$' + Math.round(fuelCost).toLocaleString();
        $('out-acc').textContent = '$' + Math.round(acc).toLocaleString();
        $('out-cwt').textContent = '$' + (total / (weight / 100 || 1)).toFixed(2);

        let transit = "3-5 Business Days";
        if(dist > 1500) transit = "5-7 Business Days";
        if(dist < 300) transit = "1-2 Business Days";
        if(sType === 'EXP') transit = "1-3 Business Days (Guaranteed)";
        
        $('out-advice').textContent = `Estimated Transit: ${transit}. NMFC ${classE.options[classE.selectedIndex].text} used for basis.`;
    }

    [weightE, distE, classE, typeE, fuelE, liftE, resE, insideE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            weightE.value = btn.dataset.w; distE.value = btn.dataset.d; classE.value = btn.dataset.c;
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Freight Quote Report\nWeight: ${weightE.value} LBS\nDistance: ${distE.value} MI\nTotal Est: ${$('out-total').textContent}\nGenerated by Logistics Pro Analyst`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Quote Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { weightE.value = 2000; distE.value = 500; calculate(); });

    calculate();
});
</script>

<style>
.freight-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#431407;opacity:.7;margin-bottom:8px;display:block}
.freight-rebuilt .calculator-card { transition: all 0.3s ease; }
.truck-move { animation: truck-vibe 2s infinite ease-in-out; }
@keyframes truck-vibe { 0%, 100% { transform: translateX(0); } 50% { transform: translateX(5px); } }
.btn-orange { background: #F97316; color: #fff; transition: all .3s; }
.btn-orange:hover { background: #EA580C; color: #fff; transform: translateY(-2px); }
.bg-orange-soft { background: #FFF7ED; color: #F97316; }
.bg-orange-50 { background-color: #fffaf5; }
.border-orange { border-color: #fed7aa !important; }
.text-orange { color: #F97316 !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\freight-cost-calculator.blade.php ENDPATH**/ ?>