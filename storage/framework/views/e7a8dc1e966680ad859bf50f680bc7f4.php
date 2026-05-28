<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Real World Object Dimensions</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Input Unit</label>
                                <select id="real-unit" class="form-select form-select-lg rounded-3">
                                    <option value="in" selected>Inches (in)</option>
                                    <option value="ft">Feet (ft)</option>
                                    <option value="cm">Centimeters (cm)</option>
                                    <option value="m">Meters (m)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Width</label>
                                <input type="number" id="real-w" class="form-control form-control-lg rounded-3" value="12" min="0.1" step="0.1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Length</label>
                                <input type="number" id="real-l" class="form-control form-control-lg rounded-3" value="24" min="0.1" step="0.1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Height</label>
                                <input type="number" id="real-h" class="form-control form-control-lg rounded-3" value="8" min="0.1" step="0.1">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Lego Target Scale</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Scale Ratio Preset</label>
                                <select id="lego-scale" class="form-select form-select-lg rounded-3">
                                    <option value="1" selected>1:1 (Life Size Model)</option>
                                    <option value="42">1:42 (Minifigure Scale)</option>
                                    <option value="150">1:150 (Microscale)</option>
                                    <option value="custom">Custom Scale Ratio</option>
                                </select>
                            </div>
                            <div class="col-12 d-none" id="custom-scale-container">
                                <label class="form-label small text-muted">Custom Ratio (1 : X)</label>
                                <input type="number" id="custom-scale-val" class="form-control form-control-lg rounded-3" value="10" min="1" step="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-unit="in" data-w="12" data-l="12" data-h="12" data-scale="1">
                    Life-size Cube (12" x 12" x 12")
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-unit="ft" data-w="30" data-l="60" data-h="20" data-scale="150">
                    Microscale House (60ft x 30ft x 20ft)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-unit="cm" data-w="20" data-l="40" data-h="15" data-scale="1">
                    Tissue Box replica (40cm x 20cm x 15cm)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #dc2626; border-color: #dc2626;">
                    <i class="fas fa-cubes me-2"></i> Convert to Lego Scale
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #fef2f2; color: #dc2626;">
                        <i class="fas fa-drafting-compass"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Lego Build Specification Sheet</h5>
                        <p class="text-muted small mb-0">Exact dimensions in studs, bricks, plates, and estimated piece counts</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #dc2626; border-color: #dc2626;">
                        <i class="fas fa-copy me-1"></i> Copy Build Guide
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #dc2626;" id="result-lego-rc">38 x 76 Studs</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1" id="result-lego-height">21 Bricks + 1 Plate Tall</p>
            </div>

            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-ruler-combined me-2 text-danger"></i>Lego Unit Layout</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Studs Wide (Width):</span>
                                <span class="fw-bold text-dark font-monospace" id="out-studs-w">38 studs</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Studs Long (Length):</span>
                                <span class="fw-bold text-dark font-monospace" id="out-studs-l">76 studs</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Base Area Required:</span>
                                <span class="fw-bold text-dark" id="out-base-area">2,888 studs²</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Plate Height Equivalent:</span>
                                <span class="fw-bold text-dark" id="out-plates-total">64 plates</span>
                            </li>
                        </ul>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-boxes me-2 text-success"></i>Estimated Pieces Required</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Solid Build (2x4 Bricks):</span>
                                <span class="fw-bold text-dark" id="out-solid-bricks">~7,581 pieces</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Hollow Shell Model (1-stud wall):</span>
                                <span class="fw-bold text-dark" id="out-hollow-bricks font-monospace" id="out-hollow-bricks">~2,394 pieces</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Scale Used:</span>
                                <span class="badge bg-secondary rounded-pill px-3 py-1 text-white" id="out-scale-badge">1:1 Life Size</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }
    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }
    .form-control-lg, .form-select-lg { border: 1.5px solid #cbd5e1; border-radius: 12px; font-size: 1rem; }
    .form-control:focus, .form-select:focus { border-color: #dc2626; box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const unitIn = document.getElementById('real-unit');
    const wIn = document.getElementById('real-w');
    const lIn = document.getElementById('real-l');
    const hIn = document.getElementById('real-h');
    const scaleIn = document.getElementById('lego-scale');
    const customScaleVal = document.getElementById('custom-scale-val');
    const customScaleContainer = document.getElementById('custom-scale-container');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    scaleIn.addEventListener('change', function() {
        if (this.value === 'custom') {
            customScaleContainer.classList.remove('d-none');
        } else {
            customScaleContainer.classList.add('d-none');
        }
    });

    function calculateLegoScale() {
        const unit = unitIn.value;
        const wVal = parseFloat(wIn.value) || 0;
        const lVal = parseFloat(lIn.value) || 0;
        const hVal = parseFloat(hIn.value) || 0;
        
        let scaleRatio = parseFloat(scaleIn.value);
        if (scaleIn.value === 'custom') {
            scaleRatio = parseFloat(customScaleVal.value) || 1;
        }

        if (wVal <= 0 || lVal <= 0 || hVal <= 0) {
            alert("Please enter valid dimensions.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Brick Geometry...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Convert everything to millimeters
            let multiplier = 25.4; // inches to mm
            if (unit === 'ft') multiplier = 304.8;
            if (unit === 'cm') multiplier = 10;
            if (unit === 'm') multiplier = 1000;

            const wMm = wVal * multiplier;
            const lMm = lVal * multiplier;
            const hMm = hVal * multiplier;

            // Apply Scale Ratio
            const targetWMm = wMm / scaleRatio;
            const targetLMm = lMm / scaleRatio;
            const targetHMm = hMm / scaleRatio;

            // Standard Lego Dimensions: 
            // 1 Stud Wide/Long = 8 mm
            // 1 Brick Tall = 9.6 mm
            // 1 Plate Tall = 3.2 mm
            const studsW = Math.max(1, Math.round(targetWMm / 8));
            const studsL = Math.max(1, Math.round(targetLMm / 8));
            
            const bricksH = Math.floor(targetHMm / 9.6);
            const platesLeft = Math.max(0, Math.round((targetHMm % 9.6) / 3.2));
            const totalPlates = Math.round(targetHMm / 3.2);

            // Brick counts calculations:
            // Standard brick is 2x4 studs (covering 8 studs area).
            // Shell calculation: perimeter in studs times height.
            const totalBaseStuds = studsW * studsL;
            const totalSolidBricks = Math.ceil((totalBaseStuds * bricksH) / 8); 
            const hollowPerimeter = (studsW * 2 + studsL * 2);
            const totalHollowBricks = Math.ceil((hollowPerimeter * bricksH) / 8);

            // Format Labels
            document.getElementById('result-lego-rc').innerText = `${studsW} x ${studsL} Studs`;
            
            let hLabel = `${bricksH} ${bricksH === 1 ? 'Brick' : 'Bricks'}`;
            if (platesLeft > 0) {
                hLabel += ` + ${platesLeft} ${platesLeft === 1 ? 'Plate' : 'Plates'} Tall`;
            } else {
                hLabel += " Tall";
            }
            document.getElementById('result-lego-height').innerText = hLabel;

            document.getElementById('out-studs-w').innerText = studsW + " studs";
            document.getElementById('out-studs-l').innerText = studsL + " studs";
            document.getElementById('out-base-area').innerText = totalBaseStuds.toLocaleString() + " studs²";
            document.getElementById('out-plates-total').innerText = totalPlates + " plates";

            document.getElementById('out-solid-bricks').innerText = `~${totalSolidBricks.toLocaleString()} standard bricks`;
            document.getElementById('out-hollow-bricks').innerText = `~${totalHollowBricks.toLocaleString()} standard bricks`;
            document.getElementById('out-scale-badge').innerText = `Ratio 1 : ${scaleRatio}`;

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-cubes me-2"></i> Convert to Lego Scale';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateLegoScale);

    btnReset.addEventListener('click', () => {
        unitIn.value = 'in';
        wIn.value = 12;
        lIn.value = 24;
        hIn.value = 8;
        scaleIn.value = '1';
        customScaleVal.value = 10;
        customScaleContainer.classList.add('d-none');
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            unitIn.value = this.dataset.unit;
            wIn.value = this.dataset.w;
            lIn.value = this.dataset.l;
            hIn.value = this.dataset.h;
            scaleIn.value = this.dataset.scale;
            customScaleContainer.classList.add('d-none');
            calculateLegoScale();
        });
    });

    btnCopy.addEventListener('click', function() {
        const rc = document.getElementById('result-lego-rc').innerText;
        const ht = document.getElementById('result-lego-height').innerText;
        const studsW = document.getElementById('out-studs-w').innerText;
        const studsL = document.getElementById('out-studs-l').innerText;
        const base = document.getElementById('out-base-area').innerText;
        const plates = document.getElementById('out-plates-total').innerText;
        const solid = document.getElementById('out-solid-bricks').innerText;
        const hollow = document.getElementById('out-hollow-bricks').innerText;
        const scale = document.getElementById('out-scale-badge').innerText;

        const text = `LEGO BRICK SCALE REPLICA PLAN\n` +
                     `==============================\n` +
                     `Real Object: ${wIn.value} x ${lIn.value} x ${hIn.value} ${unitIn.value}\n` +
                     `Target Scale: ${scale}\n\n` +
                     `LEGO MODEL DIMENSIONS:\n` +
                     `- Width & Length: ${rc}\n` +
                     `- Target Height: ${ht}\n\n` +
                     `STUD DETAILED GRID:\n` +
                     `- Studs Wide: ${studsW}\n` +
                     `- Studs Long: ${studsL}\n` +
                     `- Footprint Stud Area: ${base}\n` +
                     `- Total Height in Plates: ${plates}\n\n` +
                     `ESTIMATED LEGO BRICK COUNTS:\n` +
                     `- Solid Brick Fill: ${solid}\n` +
                     `- Hollow Shell Model: ${hollow}\n\n` +
                     `Generated via ToolsHub Lego Brick Scale Converter.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Specs!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\lego-brick-calculator.blade.php ENDPATH**/ ?>