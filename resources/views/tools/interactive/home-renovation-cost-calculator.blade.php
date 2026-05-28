<div class="row g-4 reno-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(16, 185, 129, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #10B981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-drafting-compass"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Home Renovation Architect</h4>
                    <p class="text-muted small mb-0">High-fidelity estimation for residential remodeling, structural upgrades, and luxury interior finishing.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Scope & Scale --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Renovation Scope</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Total Area to Remodel</label>
                                    <div class="input-group">
                                        <input type="number" id="v-area" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="1000">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">SQFT</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Primary Space Type</label>
                                    <select id="v-type" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="150">Kitchen Remodel (Premium)</option>
                                        <option value="200">Bathroom Overhaul (High-end)</option>
                                        <option value="50" selected>Living / Bedroom Refresh</option>
                                        <option value="80">Full Basement Finish</option>
                                        <option value="250">Master Suite Addition</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Finish Quality Level</label>
                                <div class="btn-group w-100 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                    <input type="radio" class="btn-check" name="v-quality" id="q-econ" value="0.7">
                                    <label class="btn btn-outline-emerald py-3 small fw-bold" for="q-econ">Economy</label>
                                    <input type="radio" class="btn-check" name="v-quality" id="q-mid" value="1.0" checked>
                                    <label class="btn btn-outline-emerald py-3 small fw-bold" for="q-mid">Mid-Range</label>
                                    <input type="radio" class="btn-check" name="v-quality" id="q-lux" value="1.8">
                                    <label class="btn btn-outline-emerald py-3 small fw-bold" for="q-lux">Luxury</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Complexity --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-emerald">
                            <h6 class="fw-bold small mb-3 uppercase text-emerald opacity-70">Project Complexity</h6>
                            <div class="vstack gap-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Structural / Wall Removal</label>
                                    <input class="form-check-input" type="checkbox" id="v-struct">
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">New Plumbing / Electrical</label>
                                    <input class="form-check-input" type="checkbox" id="v-util" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Permits & Professional Fees</label>
                                    <input class="form-check-input" type="checkbox" id="v-permits" checked>
                                </div>
                                <hr class="my-1 opacity-10">
                                <div class="p-3 rounded-3 bg-emerald-50 border border-emerald-100 text-center">
                                    <div class="small fw-bold text-emerald-900">ESTIMATED TIMELINE</div>
                                    <div class="h5 fw-900 text-emerald-900 mb-0" id="out-time">4-6 WEEKS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-a="150" data-t="200">Small Bath Refresh</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-a="300" data-t="150">Gourmet Kitchen Upgrade</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-a="2000" data-t="50">Full Interior Paint/Floor</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 160; --tool-color: #10B981; --tool-bg: rgba(16, 185, 129, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL ESTIMATED INVESTMENT</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$50,000</div>
                <div class="badge bg-emerald-soft text-emerald px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">$50.00 PER SQFT</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Cost Allocation --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Resource Allocation Matrix</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">MATERIALS</div><div class="h5 fw-bold mb-0" id="out-mat">$20k</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">LABOR</div><div class="h5 fw-bold mb-0" id="out-lab">$25k</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">CONTINGENCY (10%)</div><div class="h5 fw-bold mb-0" id="out-cont">$5k</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">EQUIPMENT</div><div class="h5 fw-bold mb-0" id="out-eq">$0</div></div></div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Project Export</h6>
                            <div class="p-3 rounded-4 bg-emerald-50 border border-emerald-100 mb-4">
                                <div class="small fw-bold text-emerald-900 mb-1">CONTRACTOR TIP</div>
                                <div class="small text-muted lh-base" id="out-advice">Always budget an extra 15% for structural surprises in homes older than 30 years.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-emerald rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-invoice-dollar me-2"></i>Copy Budget Report
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Clear Blueprint
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
    const areaE = $('v-area'), typeE = $('v-type'), structE = $('v-struct'), utilE = $('v-util'), permitE = $('v-permits');

    function calculate(){
        const area = parseFloat(areaE.value) || 0;
        const baseRate = parseFloat(typeE.value);
        const quality = parseFloat(document.querySelector('input[name="v-quality"]:checked').value);

        let mod = 1.0;
        if(structE.checked) mod += 0.35;
        if(utilE.checked) mod += 0.20;
        if(permitE.checked) mod += 0.05;

        const total = area * baseRate * quality * mod;
        const perSqft = total / (area || 1);

        $('out-total').textContent = '$' + Math.round(total).toLocaleString();
        $('out-unit').textContent = '$' + perSqft.toFixed(2) + ' PER SQFT';

        // Distribution
        $('out-mat').textContent = '$' + Math.round(total * 0.45).toLocaleString();
        $('out-lab').textContent = '$' + Math.round(total * 0.45).toLocaleString();
        $('out-cont').textContent = '$' + Math.round(total * 0.10).toLocaleString();

        // Timeline
        let weeks = "2-4 WEEKS";
        if(total > 50000) weeks = "8-12 WEEKS";
        else if(total > 20000) weeks = "4-8 WEEKS";
        $('out-time').textContent = weeks;

        let adv = "Project scope is standard. Mid-range finishes provide the best ROI for resale.";
        if(quality > 1.5) adv = "Luxury finishes detected. Ensure your contractor has high-end portfolio experience.";
        if(structE.checked) adv = "Structural work requires engineering sign-off. Budget for load-bearing beam analysis.";
        $('out-advice').textContent = adv;
    }

    [areaE, typeE, structE, utilE, permitE].forEach(e => e.addEventListener('input', calculate));
    document.querySelectorAll('input[name="v-quality"]').forEach(e => e.addEventListener('change', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            areaE.value = btn.dataset.a; typeE.value = btn.dataset.t; 
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Home Renovation Budget Report\nArea: ${areaE.value} SQFT\nTotal Est: ${$('out-total').textContent}\nTimeline: ${$('out-time').textContent}\nGenerated by ToolsHub Project Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Budget Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { areaE.value = 1000; calculate(); });

    calculate();
});
</script>

<style>
.reno-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.reno-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-emerald { background: #10B981; color: #fff; transition: all .3s; }
.btn-emerald:hover { background: #059669; color: #fff; transform: translateY(-2px); }
.btn-outline-emerald { color: #10B981; border: 1px solid #10B981; }
.btn-check:checked + .btn-outline-emerald { background: #10B981; color: #fff; border-color: #10B981; }
.bg-emerald-soft { background: #ECFDF5; color: #10B981; }
.bg-emerald-50 { background-color: #f6fdfa; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
