<div class="row g-4 roof-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(71, 85, 105, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #475569, #1E293B); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-house-chimney-window"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a; letter-spacing: -0.5px;">Skyline Shield: Roofing Analyst</h4>
                    <p class="text-muted small mb-0">Professional roof replacement estimation factoring in pitch complexity, material grade, and tear-off logistics.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Dimensions --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Dimensions & Pitch</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Roof Area (Surface)</label>
                                    <div class="input-group">
                                        <input type="number" id="v-area" class="form-control border-0 bg-white shadow-sm rounded-start-3 fw-bold h5 mb-0" value="2000">
                                        <span class="input-group-text border-0 bg-white shadow-sm rounded-end-3 text-muted small">SQFT</span>
                                    </div>
                                    <small class="text-muted mt-1 d-block" id="out-squares">≈ 20.0 Squares</small>
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Roof Pitch / Slope</label>
                                    <select id="v-pitch" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                        <option value="1.0">Flat (0/12 - 2/12)</option>
                                        <option value="1.1" selected>Standard (4/12 - 6/12)</option>
                                        <option value="1.3">Steep (7/12 - 9/12)</option>
                                        <option value="1.6">Extreme (12/12+)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Material Specification</label>
                                <select id="v-mat" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                    <option value="4.5">Architectural Shingles ($4.50/sqft)</option>
                                    <option value="12.0">Standing Seam Metal ($12.00/sqft)</option>
                                    <option value="15.0">Clay / Concrete Tile ($15.00/sqft)</option>
                                    <option value="25.0">Natural Slate ($25.00/sqft)</option>
                                    <option value="3.5">3-Tab Asphalt ($3.50/sqft)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Logistics --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-slate">
                            <h6 class="fw-bold small mb-3 uppercase text-slate opacity-70">Logistics & Prep</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Old Roof Tear-off</label>
                                <select id="v-tear" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="0">None (Overlay)</option>
                                    <option value="1.50" selected>1 Layer ($1.50/sqft)</option>
                                    <option value="2.75">2 Layers ($2.75/sqft)</option>
                                </select>
                            </div>
                            <div class="vstack gap-2">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Flashings & Vents</label>
                                    <input class="form-check-input" type="checkbox" id="v-flash" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Gutter Replacement</label>
                                    <input class="form-check-input" type="checkbox" id="v-gutters">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-a="1500" data-p="1.1" data-m="4.5">Standard Ranch</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-a="3000" data-p="1.3" data-m="12.0">Modern Metal Estate</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-a="1200" data-p="1.6" data-m="15.0">Victorian steep Tile</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 215; --tool-color: #475569; --tool-bg: rgba(71, 85, 105, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL ESTIMATED PROJECT COST</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$14,500</div>
                <div class="badge bg-slate-soft text-slate px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">$7.25 PER SQFT</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Technical Breakdown --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Estimated Bill of Materials</h6>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">MATERIAL COST</div><div class="h5 fw-bold mb-0" id="out-mat">$9,000</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">LABOR & TEAROFF</div><div class="h5 fw-bold mb-0" id="out-lab">$4,500</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">DISPOSAL FEES</div><div class="h5 fw-bold mb-0" id="out-disp">$1,000</div></div></div>
                            <div class="col-6"><div class="p-3 border rounded-3 bg-light text-center"><div class="small fw-bold opacity-50">WARRANTY GRADE</div><div class="h5 fw-bold mb-0">Lifetime</div></div></div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Summary Analysis</h6>
                            <div class="p-3 rounded-4 bg-slate-50 border border-slate-100 mb-4 text-slate">
                                <i class="fas fa-circle-info me-2"></i>
                                <span class="small fw-bold" id="out-advice">Projected cost is based on market averages. Steep roofs (7/12+) require specialized safety rigging which increases labor by 30%.</span>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-slate rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Quote Breakdown
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Specs
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
    const areaE = $('v-area'), pitchE = $('v-pitch'), matE = $('v-mat'), tearE = $('v-tear'), flashE = $('v-flash'), gutterE = $('v-gutters');

    function calculate(){
        const area = parseFloat(areaE.value) || 0;
        const pitchMod = parseFloat(pitchE.value);
        const matRate = parseFloat(matE.value);
        const tearRate = parseFloat(tearE.value);

        const surfaceArea = area * pitchMod;
        const squares = surfaceArea / 100;

        const matCost = surfaceArea * matRate;
        const laborBase = surfaceArea * 2.50 * pitchMod; // Labor scales with pitch
        const tearCost = area * tearRate; // Tearoff usually on footprint
        const misc = (flashE.checked ? 500 : 0) + (gutterE.checked ? area * 0.08 : 0);

        const total = matCost + laborBase + tearCost + misc;
        const perSqft = total / (area || 1);

        $('out-total').textContent = '$' + Math.round(total).toLocaleString();
        $('out-unit').textContent = '$' + perSqft.toFixed(2) + ' PER SQFT';
        $('out-squares').textContent = `≈ ${squares.toFixed(1)} Squares`;
        
        $('out-mat').textContent = '$' + Math.round(matCost).toLocaleString();
        $('out-lab').textContent = '$' + Math.round(laborBase + tearCost).toLocaleString();
        $('out-disp').textContent = '$' + Math.round(tearCost * 0.2).toLocaleString();

        let adv = "Standard pitch project. Most contractors can complete this in 1-2 days.";
        if(pitchMod > 1.2) adv = "Steep roof alert: Labor costs are higher due to safety requirements and slower progress.";
        if(matRate > 10) adv = "Premium material choice: Metal and Tile require specialized crews and tools.";
        $('out-advice').textContent = adv;
    }

    [areaE, pitchE, matE, tearE, flashE, gutterE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { 
            areaE.value = btn.dataset.a; pitchE.value = btn.dataset.p; matE.value = btn.dataset.m;
            calculate(); 
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Roofing Project Quote\nFootprint: ${areaE.value} SQFT\nSquares: ${$('out-squares').textContent}\nTotal Est: ${$('out-total').textContent}\nGenerated by Skyline Shield`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Quote Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { areaE.value = 2000; calculate(); });

    calculate();
});
</script>

<style>
.roof-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e293b;opacity:.7;margin-bottom:8px;display:block}
.roof-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-slate { background: #475569; color: #fff; transition: all .3s; }
.btn-slate:hover { background: #1e293b; color: #fff; transform: translateY(-2px); }
.bg-slate-soft { background: #F1F5F9; color: #475569; }
.bg-slate-50 { background-color: #f8fafc; }
.border-slate { border-color: #e2e8f0 !important; }
.text-slate { color: #475569 !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>
