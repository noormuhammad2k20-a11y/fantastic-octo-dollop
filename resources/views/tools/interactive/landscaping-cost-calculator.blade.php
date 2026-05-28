<div class="row g-4 terra-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(22, 101, 52, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm leaf-grow" style="background: linear-gradient(135deg, #166534, #14532D); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Terra Garden: Landscape Architect</h4>
                    <p class="text-muted small mb-0">High-fidelity outdoor space estimation. Factor in hardscape masonry, botanical softscaping, and terrain complexity.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Terrain & Scale --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Terrain & Dimensions</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Total Lot Area (to landscape)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-sqft" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="5000">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">SQFT</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Terrain Topography</label>
                                    <select id="v-terrain" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="1.0">Flat Ground (Standard)</option>
                                        <option value="1.3">Mild Slope (+30% Labor)</option>
                                        <option value="1.8">Steep / Terraced (+80% Labor)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Primary Design Aesthetic</label>
                                <select id="v-style" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                    <option value="5">Basic (Lawn & Mulch) - $5/sqft</option>
                                    <option value="15" selected>Standard (Plants, Beds, Edging) - $15/sqft</option>
                                    <option value="45">Premium (Hardscape, Lighting, Specimen Trees) - $45/sqft</option>
                                    <option value="120">Elite (Custom Pool, Luxury Masonry, Pond) - $120/sqft</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Features --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-green">
                            <h6 class="fw-bold small mb-3 uppercase text-green opacity-70">Custom Systems</h6>
                            <div class="vstack gap-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Smart Irrigation (Drip/Spray)</label>
                                    <input class="form-check-input" type="checkbox" id="v-irrigation" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Low-Voltage LED Lighting</label>
                                    <input class="form-check-input" type="checkbox" id="v-lighting">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Artificial Turf Upgrade</label>
                                    <input class="form-check-input" type="checkbox" id="v-turf">
                                </div>
                                <hr class="my-1 opacity-10">
                                <div class="p-3 rounded-3 bg-green-50 border border-green-100 text-center">
                                    <div class="small fw-bold text-green-900">CURB APPEAL SCORE</div>
                                    <div class="h5 fw-900 text-green-900 mb-0" id="out-score">B+ High Impact</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="1000" data-p="5">Front Yard Refresh</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="3000" data-p="15">Family Backyard Oasis</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-s="5000" data-p="45">Full Estate Landscaping</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 145; --tool-color: #166534; --tool-bg: rgba(22, 101, 52, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL OUTDOOR INVESTMENT</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$75,000</div>
                <div class="badge bg-green-soft text-green px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">EST. $15.00 PER SQFT</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Allocation Breakdown --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Resource Allocation</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">PLANTS & SOIL</div><div class="h5 fw-bold mb-0" id="out-soft">$25,000</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">MASONRY & HARDSCAPE</div><div class="h5 fw-bold mb-0" id="out-hard">$35,000</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">LABOR & DESIGN</div><div class="h5 fw-bold mb-0" id="out-lab">$15,000</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">ANNUAL MAINT.</div><div class="h5 fw-bold mb-0" id="out-maint">$2,400</div></div></div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Terra Insight</h6>
                            <div class="p-3 rounded-4 bg-green-50 border border-green-100 mb-4 text-green">
                                <i class="fas fa-tree me-2"></i>
                                <span class="small fw-bold" id="out-advice">Professional landscaping can increase your property's resale value by up to 15%.</span>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-green rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-invoice me-2"></i>Copy Landscape Proposal
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Garden
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
    const sqftE = $('v-sqft'), terrainE = $('v-terrain'), styleE = $('v-style');
    const irrE = $('v-irrigation'), lightE = $('v-lighting'), turfE = $('v-turf');

    function calculate(){
        const sqft = parseFloat(sqftE.value) || 0;
        const baseRate = parseFloat(styleE.value);
        const terrainMult = parseFloat(terrainE.value);

        let subtotal = sqft * baseRate;
        const labor = subtotal * 0.4 * terrainMult;
        const extras = (irrE.checked ? sqft * 0.8 : 0) + (lightE.checked ? 2500 : 0) + (turfE.checked ? sqft * 12 : 0);

        const total = subtotal + labor + extras;
        const perSqft = total / (sqft || 1);

        $('out-total').textContent = '$' + Math.round(total).toLocaleString();
        $('out-unit').textContent = `EST. $${perSqft.toFixed(2)} PER SQFT`;
        
        // Distribution
        $('out-soft').textContent = '$' + Math.round(total * 0.35).toLocaleString();
        $('out-hard').textContent = '$' + Math.round(total * 0.45).toLocaleString();
        $('out-lab').textContent = '$' + Math.round(total * 0.20).toLocaleString();
        $('out-maint').textContent = '$' + Math.round(total * 0.03).toLocaleString();

        let score = "C Average Impact";
        if(baseRate > 40) score = "A+ Luxury Estate";
        else if(baseRate > 10) score = "B+ High Impact";
        $('out-score').textContent = score;

        let adv = "Strategic planting and simple lawn care provides a consistent ROI.";
        if(terrainMult > 1.5) adv = "Steep terrain detected. Retaining walls and specialized drainage are critical for slope stability.";
        if(baseRate >= 45) adv = "Premium design tier includes specimen trees and automated systems. Hire a licensed Landscape Architect.";
        $('out-advice').textContent = adv;
    }

    [sqftE, terrainE, styleE, irrE, lightE, turfE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            sqftE.value = btn.dataset.s; styleE.value = btn.dataset.p;
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Landscape Design Proposal\nArea: ${sqftE.value} SQFT\nDesign: ${styleE.options[styleE.selectedIndex].text}\nTotal Est: ${$('out-total').textContent}\nGenerated by Terra Garden Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Proposal Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { sqftE.value = 5000; calculate(); });

    calculate();
});
</script>

<style>
.terra-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.terra-rebuilt .calculator-card { transition: all 0.3s ease; }
.leaf-grow { animation: leaf-sway 5s infinite ease-in-out; }
@keyframes leaf-sway { 0%, 100% { transform: rotate(0deg); } 50% { transform: rotate(5deg); } }
.btn-green { background: #166534; color: #fff; transition: all .3s; }
.btn-green:hover { background: #14532D; color: #fff; transform: translateY(-2px); }
.bg-green-soft { background: #F0FDF4; color: #166534; }
.bg-green-50 { background-color: #f7fff8; }
.border-green { border-color: #bbf7d0 !important; }
.text-green { color: #166534 !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
