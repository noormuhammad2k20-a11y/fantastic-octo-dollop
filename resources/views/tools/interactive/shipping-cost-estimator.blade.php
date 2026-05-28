<div class="row g-4 ship-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(107, 33, 168, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm package-bounce" style="background: linear-gradient(135deg, #7C3AED, #6D28D9); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-box-archive"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#2e1065; letter-spacing: -0.5px;">Global Courier: Shipping Analyst</h4>
                    <p class="text-muted small mb-0">Multi-carrier parcel estimation. Support for dimensional weight (DIM), multi-zone logistics, and professional service tiers.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Package Specs --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Parcel Specification</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-4">
                                    <label class="form-label-custom">Weight (LBS)</label>
                                    <input type="number" id="v-weight" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="5">
                                </div>
                                <div class="col-8">
                                    <label class="form-label-custom">Dimensions (L x W x H in)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-l" class="form-control border-0 bg-white shadow-sm fw-bold" value="12" placeholder="L">
                                        <input type="number" id="v-w" class="form-control border-0 bg-white shadow-sm fw-bold" value="10" placeholder="W">
                                        <input type="number" id="v-h" class="form-control border-0 bg-white shadow-sm fw-bold rounded-end-3" value="8" placeholder="H">
                                    </div>
                                    <small class="text-muted mt-1 d-block" id="out-dim">Dimensional Weight: 7.0 LBS</small>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Carrier Network</label>
                                    <select id="v-carrier" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="1.0">FedEx (Standard Rates)</option>
                                        <option value="1.05">UPS (Premium Direct)</option>
                                        <option value="0.85">USPS (Postal Economy)</option>
                                        <option value="1.45">DHL (International Exp.)</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Service Speed</label>
                                    <select id="v-speed" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="1.0">Ground (3-5 Days)</option>
                                        <option value="1.8">2-Day Air (Express)</option>
                                        <option value="3.5">Overnight (Priority)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Destination & Value --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-purple">
                            <h6 class="fw-bold small mb-3 uppercase text-purple opacity-70">Logistics & Protection</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Shipping Zone (Distance)</label>
                                <select id="v-zone" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="1.0">Zone 1-2 (Local < 150mi)</option>
                                    <option value="1.15" selected>Zone 3-4 (Regional 150-600mi)</option>
                                    <option value="1.4">Zone 5-8 (National 600mi+)</option>
                                </select>
                            </div>
                            <div class="vstack gap-2">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Full Value Insurance</label>
                                    <input class="form-check-input" type="checkbox" id="v-insure" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Signature Required</label>
                                    <input class="form-check-input" type="checkbox" id="v-sign">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Residential Surcharge</label>
                                    <input class="form-check-input" type="checkbox" id="v-res" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-w="2" data-l="8" data-wt="8" data-ht="6">Small Electronics Box</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-w="15" data-l="18" data-wt="18" data-ht="12">Medium Appliance</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-w="50" data-l="24" data-wt="24" data-ht="24">Heavy Large Carton</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 260; --tool-color: #7C3AED; --tool-bg: rgba(124, 58, 237, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">ESTIMATED POSTAGE & FEES</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$24.50</div>
                <div class="badge bg-purple-soft text-purple px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">BILLABLE WEIGHT: 7.0 LBS</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Quote Matrix --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Pricing Matrix Breakdown</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">BASE RATE</div><div class="h5 fw-bold mb-0" id="out-base">$12.50</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">SPEED PREMIUM</div><div class="h5 fw-bold mb-0" id="out-speed-cost">$0.00</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">SURCHARGES</div><div class="h5 fw-bold mb-0" id="out-sur">$4.50</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">EST. ARRIVAL</div><div class="h5 fw-bold mb-0" id="out-arrival">Oct 24</div></div></div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Logistics Recommendation</h6>
                            <div class="p-3 rounded-4 bg-purple-50 border border-purple-100 mb-4 text-purple">
                                <i class="fas fa-circle-check me-2"></i>
                                <span class="small fw-bold" id="out-advice">Dimensional weight applies. Try a smaller box to reduce billable weight to 5 lbs.</span>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-purple rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-barcode me-2"></i>Copy Label Quote
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Parcel
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
    const weightE = $('v-weight'), lE = $('v-l'), wE = $('v-w'), hE = $('v-h');
    const carrierE = $('v-carrier'), speedE = $('v-speed'), zoneE = $('v-zone');
    const insureE = $('v-insure'), signE = $('v-sign'), resE = $('v-res');

    function calculate(){
        const weight = parseFloat(weightE.value) || 0;
        const l = parseFloat(lE.value) || 0;
        const w = parseFloat(wE.value) || 0;
        const h = parseFloat(hE.value) || 0;
        
        const dimWeight = (l * w * h) / 139; // Standard carrier divisor
        const billable = Math.max(weight, dimWeight);
        
        const basePrice = (8.50 + (billable * 1.25)) * parseFloat(carrierE.value) * parseFloat(zoneE.zoneE?.value || 1.15);
        const speedMult = parseFloat(speedE.value);
        const speedPrem = basePrice * (speedMult - 1);
        
        const surcharges = (insureE.checked ? 5.00 : 0) + (signE.checked ? 6.50 : 0) + (resE.checked ? 4.85 : 0);
        
        const total = basePrice + speedPrem + surcharges;

        $('out-total').textContent = '$' + total.toFixed(2);
        $('out-unit').textContent = `BILLABLE WEIGHT: ${billable.toFixed(1)} LBS`;
        $('out-dim').textContent = `Dimensional Weight: ${dimWeight.toFixed(1)} LBS`;
        
        $('out-base').textContent = '$' + basePrice.toFixed(2);
        $('out-speed-cost').textContent = '$' + speedPrem.toFixed(2);
        $('out-sur').textContent = '$' + surcharges.toFixed(2);

        // Date Est
        const days = speedMult > 3 ? 1 : (speedMult > 1.5 ? 2 : 4);
        const date = new Date();
        date.setDate(date.getDate() + days);
        $('out-arrival').textContent = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });

        let adv = "Standard Ground shipping is the most cost-effective for this parcel.";
        if(dimWeight > weight + 2) adv = "Dimensional weight alert! Using a smaller box could save you up to $8.00.";
        if(speedMult > 3) adv = "Priority Overnight selected. Ensure the parcel is dropped off by 4 PM for next-day arrival.";
        $('out-advice').textContent = adv;
    }

    [weightE, lE, wE, hE, carrierE, speedE, zoneE, insureE, signE, resE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            weightE.value = btn.dataset.w; lE.value = btn.dataset.l; wE.value = btn.dataset.wt; hE.value = btn.dataset.ht;
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Shipping Quote Summary\nBillable Weight: ${billable.toFixed(1)} LBS\nCarrier: ${carrierE.options[carrierE.selectedIndex].text}\nTotal Est: ${$('out-total').textContent}\nGenerated by Global Courier Analyst`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Quote Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { weightE.value = 5; lE.value = 12; wE.value = 10; hE.value = 8; calculate(); });

    calculate();
});
</script>

<style>
.ship-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#2e1065;opacity:.7;margin-bottom:8px;display:block}
.ship-rebuilt .calculator-card { transition: all 0.3s ease; }
.package-bounce { animation: pack-bounce 2s infinite ease-in-out; }
@keyframes pack-bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }
.btn-purple { background: #7C3AED; color: #fff; transition: all .3s; }
.btn-purple:hover { background: #6D28D9; color: #fff; transform: translateY(-2px); }
.bg-purple-soft { background: #F5F3FF; color: #7C3AED; }
.bg-purple-50 { background-color: #fafaff; }
.border-purple { border-color: #ddd6fe !important; }
.text-purple { color: #7C3AED !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
