<div class="row g-4 jet-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(30, 41, 59, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm flight-glide" style="background: linear-gradient(135deg, #1E293B, #0F172A); color:#EAB308; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-plane-up"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a; letter-spacing: -0.5px;">Elite Horizon: Charter Analyst</h4>
                    <p class="text-muted small mb-0">High-luxury aviation cost modeling. Factor in aircraft class specifications, crew logistics, and airport handling premiums.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Mission Profile</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Total Flight Hours</label>
                                    <div class="input-group">
                                        <input type="number" id="v-hours" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="3.5" step="0.1">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">HRS</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Passengers (Pax)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-pax" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="4">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small"><i class="fas fa-user-group"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Aircraft Category</label>
                                <select id="v-class" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                    <option value="3500">Light Jet (Phenom 100/300) - $3.5k/hr</option>
                                    <option value="5500" selected>Mid-Size (Citation Latitude) - $5.5k/hr</option>
                                    <option value="8500">Super Mid-Size (Challenger 350) - $8.5k/hr</option>
                                    <option value="12000">Heavy Jet (Gulfstream G650) - $12k/hr</option>
                                    <option value="25000">Ultra Range / VIP (BBJ) - $25k/hr</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-gold">
                            <h6 class="fw-bold small mb-3 uppercase text-gold opacity-70">Logistics & Handling</h6>
                            <div class="vstack gap-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Empty Leg Discount (-40%)</label>
                                    <input class="form-check-input" type="checkbox" id="v-empty">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Overnight Crew Stay</label>
                                    <input class="form-check-input" type="checkbox" id="v-crew" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Premium Onboard Catering</label>
                                    <input class="form-check-input" type="checkbox" id="v-catering" checked>
                                </div>
                                <hr class="my-1 opacity-10">
                                <div class="p-3 rounded-3 bg-gold-50 border border-gold-100 text-center">
                                    <div class="small fw-bold text-gold-900">EST. LANDING & FBO FEES</div>
                                    <div class="h5 fw-900 text-gold-900 mb-0" id="out-fees">$2,500</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="2" data-c="3500">Regional Light Jet (2h)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="6" data-c="8500">Transcontinental Mid (6h)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-h="11" data-c="12000">Intercontinental Heavy (11h)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 45; --tool-color: #EAB308; --tool-bg: rgba(234, 179, 8, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL CHARTER ESTIMATE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$25,450</div>
                <div class="badge bg-gold-soft text-gold px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">$6,362 PER PASSENGER</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Financial Distribution</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">HOURLY TOTAL</div><div class="h5 fw-bold mb-0" id="out-hourly">$19,250</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">FUEL SURCHARGE</div><div class="h5 fw-bold mb-0" id="out-fuel">$2,800</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">HANDLING/FBO</div><div class="h5 fw-bold mb-0" id="out-handling">$2,500</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">SERVICE TAX (FET)</div><div class="h5 fw-bold mb-0" id="out-tax">$900</div></div></div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Elite Insight</h6>
                            <div class="p-3 rounded-4 bg-gold-50 border border-gold-100 mb-4 text-gold">
                                <i class="fas fa-crown me-2"></i>
                                <span class="small fw-bold" id="out-advice">Booking an Empty Leg can save you significant capital if your schedule is flexible.</span>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-gold rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-pdf me-2"></i>Export Flight Itinerary
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Mission
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
    const hrsE = $('v-hours'), paxE = $('v-pax'), classE = $('v-class');
    const emptyE = $('v-empty'), crewE = $('v-crew'), caterE = $('v-catering');

    function calculate(){
        const hrs = parseFloat(hrsE.value) || 0;
        const rate = parseFloat(classE.value);
        const pax = parseFloat(paxE.value) || 1;

        let hourlyTotal = hrs * rate;
        if(emptyE.checked) hourlyTotal *= 0.6; // 40% discount

        const fuel = hourlyTotal * 0.15; // 15% surcharge
        const handling = 1500 + (hrs * 250); // Base + per hour FBO
        const extras = (crewE.checked ? 1200 : 0) + (caterE.checked ? pax * 150 : 0);
        const tax = (hourlyTotal + fuel + handling + extras) * 0.075; // 7.5% FET Tax

        const total = hourlyTotal + fuel + handling + extras + tax;

        $('out-total').textContent = '$' + Math.round(total).toLocaleString();
        $('out-unit').textContent = '$' + Math.round(total / pax).toLocaleString() + ' PER PASSENGER';
        
        $('out-hourly').textContent = '$' + Math.round(hourlyTotal).toLocaleString();
        $('out-fuel').textContent = '$' + Math.round(fuel).toLocaleString();
        $('out-handling').textContent = '$' + Math.round(handling).toLocaleString();
        $('out-tax').textContent = '$' + Math.round(tax).toLocaleString();
        $('out-fees').textContent = '$' + Math.round(handling).toLocaleString();

        let adv = "Standard charter mission profile. High availability for this aircraft class.";
        if(emptyE.checked) adv = "Empty Leg discount applied! This is the most cost-effective way to fly private.";
        if(hrs > 10) adv = "Ultra-long range flight detected. Large or Global class aircraft required for non-stop transit.";
        $('out-advice').textContent = adv;
    }

    [hrsE, paxE, classE, emptyE, crewE, caterE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            hrsE.value = btn.dataset.h; classE.value = btn.dataset.c;
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Private Jet Charter Estimate\nAircraft: ${classE.options[classE.selectedIndex].text}\nFlight Time: ${hrsE.value} HRS\nTotal Est: ${$('out-total').textContent}\nGenerated by Elite Horizon Charter Analyst`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Itinerary Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { hrsE.value = 3.5; calculate(); });

    calculate();
});
</script>

<style>
.jet-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0f172a;opacity:.7;margin-bottom:8px;display:block}
.jet-rebuilt .calculator-card { transition: all 0.3s ease; }
.flight-glide { animation: jet-glide 4s infinite ease-in-out; }
@keyframes jet-glide { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-3px) rotate(2deg); } }
.btn-gold { background: #EAB308; color: #fff; transition: all .3s; border: none; }
.btn-gold:hover { background: #CA8A04; color: #fff; transform: translateY(-2px); }
.bg-gold-soft { background: #FEFCE8; color: #854D0E; }
.bg-gold-50 { background-color: #fffef0; }
.border-gold { border-color: #fef08a !important; }
.text-gold { color: #854D0E !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\private-jet-charter-cost-calculator.blade.php ENDPATH**/ ?>