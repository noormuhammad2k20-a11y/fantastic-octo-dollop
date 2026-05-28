<div class="row g-4 botanical-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(16, 185, 129, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #10B981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-seedling"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Botanical Plot Architect</h4>
                    <p class="text-muted small mb-0">Professional spacing and yield estimation for sustainable gardening and landscaping.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Plot Geometry</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label-custom">Length (ft)</label>
                                    <input type="number" id="v-length" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="10">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Width (ft)</label>
                                    <input type="number" id="v-width" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h5 mb-0" value="10">
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Garden Layout</label>
                                <select id="v-layout" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold py-2">
                                    <option value="square">Standard Grid (Square)</option>
                                    <option value="offset">Offset Grid (Hexagonal)</option>
                                    <option value="raised">Raised Bed (Linear)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-emerald">
                            <h6 class="fw-bold small mb-3 uppercase text-emerald opacity-70">Plant Specifications</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Vegetable/Plant Type</label>
                                <select id="v-preset" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="custom">-- Custom Spacing --</option>
                                    <option value="12">🍅 Tomato (12")</option>
                                    <option value="6">🥬 Lettuce (6")</option>
                                    <option value="18">🥦 Broccoli (18")</option>
                                    <option value="3">🥕 Carrots (3")</option>
                                    <option value="24">🎃 Pumpkin (24")</option>
                                </select>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Manual Spacing (Inches)</label>
                                <div class="input-group">
                                    <input type="number" id="v-spacing" class="form-control border-0 bg-light rounded-start-3 fw-bold h5 mb-0" value="12">
                                    <span class="input-group-text border-0 bg-light shadow-sm rounded-end-3 text-muted small">inches</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-l="4" data-w="4">Standard Raised Bed (4x4)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-l="20" data-w="20">Large Vegetable Patch</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-l="10" data-w="2">Window Box</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 150; --tool-color: #10B981; --tool-bg: rgba(16, 185, 129, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">PLANTING CAPACITY</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-plants">100</div>
                <div class="badge bg-emerald-soft text-emerald px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">OPTIMIZED PLOT</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Projected Performance Matrix</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="p-3 border rounded-3 bg-light text-center">
                                    <div class="small fw-bold text-muted uppercase">Total Area</div>
                                    <div class="h5 fw-bold mb-0" id="out-area">100 sq ft</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border rounded-3 bg-light text-center">
                                    <div class="small fw-bold text-muted uppercase">Seed Density</div>
                                    <div class="h5 fw-bold mb-0" id="out-density">1.0 / sq ft</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 rounded-4 bg-emerald-50 border border-emerald-100 mt-2">
                                    <div class="small fw-bold text-emerald-900 mb-1"><i class="fas fa-info-circle me-1"></i>Soil & Mulch Estimator</div>
                                    <div class="small text-muted lh-base" id="out-soil">Requires approx. 16.7 cubic feet of soil (at 2" depth).</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Plot Export</h6>
                            <div class="p-3 rounded-4 bg-emerald-50 border border-emerald-100 mb-4">
                                <div class="small fw-bold text-emerald-900 lh-base" id="out-advice">Grid pattern optimized for airflow and pollination.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-emerald rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-clipboard-list me-2"></i>Copy Garden Plan
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Plot
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
    const lE = $('v-length'), wE = $('v-width'), sE = $('v-spacing'), pE = $('v-preset'), layE = $('v-layout');

    function calculate(){
        const l = parseFloat(lE.value) || 0;
        const w = parseFloat(wE.value) || 0;
        const s = parseFloat(sE.value) || 12;
        const layout = layE.value;

        const area = l * w;
        const sFt = s / 12;
        const sArea = sFt * sFt;

        // Formula adjustments for layouts
        let factor = 1.0;
        if(layout === 'offset') factor = 1.15; // Hexagonal packing is ~15% denser
        
        let plants = area > 0 ? Math.floor((area / sArea) * (layout === 'offset' ? 0.9 : 1.0)) : 0;
        
        $('out-plants').textContent = plants.toLocaleString();
        $('out-area').textContent = area.toFixed(1) + ' sq ft';
        $('out-density').textContent = (plants/area || 0).toFixed(2) + ' / sq ft';
        
        const soilCuFt = (area * (2/12)).toFixed(1);
        $('out-soil').textContent = `Requires approx. ${soilCuFt} cubic feet of soil/mulch (at 2" depth).`;

        $('out-advice').textContent = layout === 'offset' ? 'Offset grid provides maximum canopy coverage.' : 'Square grid is easiest for mechanized weeding.';
    }

    pE.addEventListener('change', () => {
        if(pE.value !== 'custom') sE.value = pE.value;
        calculate();
    });

    [lE, wE, sE, layE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { lE.value = btn.dataset.l; wE.value = btn.dataset.w; calculate(); });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Garden Plot Architect Report\nPlot: ${lE.value}x${wE.value} (${$('out-area').textContent})\nPlant Type: ${pE.options[pE.selectedIndex].text}\nTotal Plants: ${$('out-plants').textContent}\nGenerated by ToolsHub Botanical Architect`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Plan Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { lE.value = 10; wE.value = 10; calculate(); });

    calculate();
});
</script>

<style>
.botanical-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.botanical-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-emerald { background: #10B981; color: #fff; transition: all .3s; }
.btn-emerald:hover { background: #059669; color: #fff; transform: translateY(-2px); }
.bg-emerald-soft { background: #ECFDF5; color: #10B981; }
.bg-emerald-50 { background-color: #f0fdf4; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\garden-calculator.blade.php ENDPATH**/ ?>