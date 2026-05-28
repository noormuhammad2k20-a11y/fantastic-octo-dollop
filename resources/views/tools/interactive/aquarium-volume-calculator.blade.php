<div class="interactive-wrapper">
    {{-- Input Card (Aquarium Parameters) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Configuration Section --}}
                <div class="col-md-5">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Tank Style & Unit</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Tank Shape</label>
                                <select id="aq-shape" class="form-select form-select-lg rounded-3">
                                    <option value="rectangular">Rectangular / Standard</option>
                                    <option value="cylinder">Cylinder / Column</option>
                                    <option value="hexagon">Hexagonal Column</option>
                                    <option value="bowfront">Bowfront Curved</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Measurement Unit</label>
                                <select id="aq-unit" class="form-select form-select-lg rounded-3">
                                    <option value="in">Inches (in)</option>
                                    <option value="cm">Centimeters (cm)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Dimension Inputs (Dynamic Fields) --}}
                <div class="col-md-7">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Measurements</h6>
                        
                        {{-- Rectangular Fields --}}
                        <div id="grp-rectangular" class="row g-3 shape-group">
                            <div class="col-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Length</label>
                                <input type="number" id="aq-l" class="form-control form-control-lg rounded-3" value="48" min="1">
                            </div>
                            <div class="col-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Width</label>
                                <input type="number" id="aq-w" class="form-control form-control-lg rounded-3" value="13" min="1">
                            </div>
                            <div class="col-4">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Height</label>
                                <input type="number" id="aq-h" class="form-control form-control-lg rounded-3" value="20" min="1">
                            </div>
                        </div>

                        {{-- Cylinder Fields --}}
                        <div id="grp-cylinder" class="row g-3 shape-group d-none">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Diameter</label>
                                <input type="number" id="aq-dia" class="form-control form-control-lg rounded-3" value="18" min="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Height</label>
                                <input type="number" id="aq-cyl-h" class="form-control form-control-lg rounded-3" value="24" min="1">
                            </div>
                        </div>

                        {{-- Hexagon Fields --}}
                        <div id="grp-hexagon" class="row g-3 shape-group d-none">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Flat-to-Flat Width</label>
                                <input type="number" id="aq-hex-w" class="form-control form-control-lg rounded-3" value="20" min="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Height</label>
                                <input type="number" id="aq-hex-h" class="form-control form-control-lg rounded-3" value="24" min="1">
                            </div>
                        </div>

                        {{-- Bowfront Fields --}}
                        <div id="grp-bowfront" class="row g-3 shape-group d-none">
                            <div class="col-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Length</label>
                                <input type="number" id="aq-bow-l" class="form-control form-control-lg rounded-3" value="36" min="1">
                            </div>
                            <div class="col-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Side Width</label>
                                <input type="number" id="aq-bow-w" class="form-control form-control-lg rounded-3" value="12" min="1">
                            </div>
                            <div class="col-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Center Depth</label>
                                <input type="number" id="aq-bow-d" class="form-control form-control-lg rounded-3" value="16" min="1">
                            </div>
                            <div class="col-3">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Height</label>
                                <input type="number" id="aq-bow-h" class="form-control form-control-lg rounded-3" value="20" min="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Compute Water Volume
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Volume Results) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Aquarium Volume Output</h5>
                        <p class="text-muted small mb-0">Total volume specs and full weight of the filled system</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Aquarium Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                {{-- Main Metric --}}
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0 font-monospace" id="out-gal">0.0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">US Gallons</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-litres" style="background-color: #10b981; color: #fff;">0.0 Litres</span>
                    </div>
                </div>

                {{-- Other volume and weight --}}
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Water Weight</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-weight-lbs">0.0 lbs</div>
                                <div class="x-small text-muted fw-bold" id="out-weight-kg">0.0 kg</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">UK/Imp. Volume</div>
                                <div class="h5 fw-bold mb-0 text-secondary" id="out-impgal">0.0 gal</div>
                                <div class="x-small text-muted fw-bold">Imperial Gallons</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center">System Recommendations</h6>
                        <ul class="list-unstyled mb-0 small text-secondary" id="out-insights">
                            {{-- Injected dynamically --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --danger-soft: #fef2f2;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-danger-soft { background-color: var(--danger-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1.5px solid #e2e8f0; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.05rem; padding: 0.65rem 0.85rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .font-monospace { font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const shapeSelect = document.getElementById('aq-shape');
    const unitSelect = document.getElementById('aq-unit');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    const outGal = document.getElementById('out-gal');
    const outLitres = document.getElementById('out-litres');
    const outWeightLbs = document.getElementById('out-weight-lbs');
    const outWeightKg = document.getElementById('out-weight-kg');
    const outImpGal = document.getElementById('out-impgal');
    const outInsights = document.getElementById('out-insights');

    // Shape toggles
    shapeSelect.addEventListener('change', function() {
        document.querySelectorAll('.shape-group').forEach(grp => grp.classList.add('d-none'));
        const shape = shapeSelect.value;
        document.getElementById(`grp-${shape}`).classList.remove('d-none');
    });

    function calculate() {
        const shape = shapeSelect.value;
        const isCm = unitSelect.value === 'cm';
        let cubicInches = 0;

        // Conversion helper from cm to inches
        const cmToIn = 0.393701;

        if (shape === 'rectangular') {
            const l = parseFloat(document.getElementById('aq-l').value) || 0;
            const w = parseFloat(document.getElementById('aq-w').value) || 0;
            const h = parseFloat(document.getElementById('aq-h').value) || 0;
            
            if (l <= 0 || w <= 0 || h <= 0) return;
            
            const l_in = isCm ? l * cmToIn : l;
            const w_in = isCm ? w * cmToIn : w;
            const h_in = isCm ? h * cmToIn : h;
            
            cubicInches = l_in * w_in * h_in;
        } 
        else if (shape === 'cylinder') {
            const dia = parseFloat(document.getElementById('aq-dia').value) || 0;
            const h = parseFloat(document.getElementById('aq-cyl-h').value) || 0;
            
            if (dia <= 0 || h <= 0) return;
            
            const dia_in = isCm ? dia * cmToIn : dia;
            const h_in = isCm ? h * cmToIn : h;
            
            const radius = dia_in / 2;
            cubicInches = Math.PI * Math.pow(radius, 2) * h_in;
        } 
        else if (shape === 'hexagon') {
            const hexW = parseFloat(document.getElementById('aq-hex-w').value) || 0;
            const h = parseFloat(document.getElementById('aq-hex-h').value) || 0;
            
            if (hexW <= 0 || h <= 0) return;
            
            const hexW_in = isCm ? hexW * cmToIn : hexW;
            const h_in = isCm ? h * cmToIn : h;
            
            // Hexagon width Flat to Flat (W). Area = (sqrt(3)/2) * W^2 ≈ 0.866025 * W^2
            cubicInches = 0.866025 * Math.pow(hexW_in, 2) * h_in;
        } 
        else if (shape === 'bowfront') {
            const l = parseFloat(document.getElementById('aq-bow-l').value) || 0;
            const w = parseFloat(document.getElementById('aq-bow-w').value) || 0;
            const d = parseFloat(document.getElementById('aq-bow-d').value) || 0;
            const h = parseFloat(document.getElementById('aq-bow-h').value) || 0;
            
            if (l <= 0 || w <= 0 || d <= 0 || h <= 0 || d < w) return;
            
            const l_in = isCm ? l * cmToIn : l;
            const w_in = isCm ? w * cmToIn : w;
            const d_in = isCm ? d * cmToIn : d;
            const h_in = isCm ? h * cmToIn : h;
            
            // Bowfront formula: L * W + (2/3) * L * (d - w)
            const baseArea = (l_in * w_in) + ((2/3) * l_in * (d_in - w_in));
            cubicInches = baseArea * h_in;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Computing...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // US Gallons (1 US Gallon = 231 cubic inches)
            const usGallons = cubicInches / 231;
            const litres = usGallons * 3.78541;
            const impGallons = usGallons * 0.832674;
            
            // Weights
            const weightLbs = usGallons * 8.34; // 1 gallon fresh water = 8.34 lbs
            const weightKg = litres; // 1 Litre fresh water = 1 kg

            // Stand/gravel weight approximation (approx 12-15% on top for glass + gravel)
            const totalEstLbs = weightLbs * 1.15;

            // Render Output
            outGal.textContent = usGallons.toFixed(1);
            outLitres.textContent = `${litres.toFixed(1)} Litres`;
            outWeightLbs.textContent = `${weightLbs.toFixed(1)} lbs`;
            outWeightKg.textContent = `${weightKg.toFixed(1)} kg`;
            outImpGal.textContent = `${impGallons.toFixed(1)} gal`;

            // Insights list building
            const ins = [];
            ins.push(`Substrate Estimation: Recommended <strong>${Math.round(usGallons * 1.2)} - ${Math.round(usGallons * 1.5)} lbs</strong> of sand or gravel for a standard 1.5-inch bed.`);
            ins.push(`Dry glass aquarium tank itself weighs approx. <strong>${Math.round(usGallons * 1.3)} lbs</strong> before water.`);
            ins.push(`Total filled static system load: approx. <strong>${Math.round(totalEstLbs)} lbs (${Math.round(totalEstLbs * 0.453592)} kg)</strong>. Verify stand capacity.`);
            ins.push(`Recommended filter flow rate: <strong>${Math.round(usGallons * 5)} Gallons Per Hour (GPH)</strong> minimum.`);

            outInsights.innerHTML = ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Compute Water Volume';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        const isCm = unitSelect.value === 'cm';
        
        // Reset defaults based on unit
        document.getElementById('aq-l').value = isCm ? '120' : '48';
        document.getElementById('aq-w').value = isCm ? '35' : '13';
        document.getElementById('aq-h').value = isCm ? '50' : '20';

        document.getElementById('aq-dia').value = isCm ? '45' : '18';
        document.getElementById('aq-cyl-h').value = isCm ? '60' : '24';

        document.getElementById('aq-hex-w').value = isCm ? '50' : '20';
        document.getElementById('aq-hex-h').value = isCm ? '60' : '24';

        document.getElementById('aq-bow-l').value = isCm ? '90' : '36';
        document.getElementById('aq-bow-w').value = isCm ? '30' : '12';
        document.getElementById('aq-bow-d').value = isCm ? '40' : '16';
        document.getElementById('aq-bow-h').value = isCm ? '50' : '20';

        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Aquarium Capacity & Load Report\n━━━━━━━━━━━━━━━━━━━━━━\nTank Shape: ${shapeSelect.value.toUpperCase()}\nUS Volume: ${outGal.textContent} Gallons\nMetric Volume: ${outLitres.textContent}\nWater Weight: ${outWeightLbs.textContent} (${outWeightKg.textContent})\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btnCopy.innerHTML;
            btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btnCopy.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                btnCopy.innerHTML = originalText;
                btnCopy.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
