<div class="row g-4 bakingpan-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(236, 72, 153, 0.1); color: #ec4899;">
                    <i class="fas fa-cookie-bite"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Baking Pan Size Converter</h4>
                    <p class="text-muted small m-0">Scale baking recipes by converting base area and total volume between different pan sizes and shapes.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6 border-end-md pr-md-4">
                        <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-history me-2 text-muted"></i>Source Pan (Recipe Pan)</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label-custom">Shape</label>
                                <select id="src-shape" class="form-select rounded-3">
                                    <option value="round" selected>Round</option>
                                    <option value="square">Square</option>
                                    <option value="rectangle">Rectangular</option>
                                </select>
                            </div>
                            
                            
                            <div class="col-6" id="src-dim-1-container">
                                <label class="form-label-custom" id="src-dim-1-label">Diameter</label>
                                <div class="input-group">
                                    <input type="number" id="src-dim-1" class="form-control rounded-start-3" value="9" min="1" step="0.25">
                                    <span class="input-group-text bg-white rounded-end-3 text-muted unit-label">in</span>
                                </div>
                            </div>
                            <div class="col-6 d-none" id="src-dim-2-container">
                                <label class="form-label-custom" id="src-dim-2-label">Width</label>
                                <div class="input-group">
                                    <input type="number" id="src-dim-2" class="form-control rounded-start-3" value="9" min="1" step="0.25">
                                    <span class="input-group-text bg-white rounded-end-3 text-muted unit-label">in</span>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label-custom">Pan Depth</label>
                                <div class="input-group">
                                    <input type="number" id="src-depth" class="form-control rounded-start-3" value="2" min="0.5" step="0.25">
                                    <span class="input-group-text bg-white rounded-end-3 text-muted unit-label">in</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-bullseye me-2 text-pink"></i>Target Pan (Your Pan)</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label-custom">Shape</label>
                                <select id="tgt-shape" class="form-select rounded-3">
                                    <option value="round">Round</option>
                                    <option value="square">Square</option>
                                    <option value="rectangle" selected>Rectangular</option>
                                </select>
                            </div>
                            
                            
                            <div class="col-6" id="tgt-dim-1-container">
                                <label class="form-label-custom" id="tgt-dim-1-label">Length</label>
                                <div class="input-group">
                                    <input type="number" id="tgt-dim-1" class="form-control rounded-start-3" value="13" min="1" step="0.25">
                                    <span class="input-group-text bg-white rounded-end-3 text-muted unit-label">in</span>
                                </div>
                            </div>
                            <div class="col-6 animate-fade-in" id="tgt-dim-2-container">
                                <label class="form-label-custom" id="tgt-dim-2-label">Width</label>
                                <div class="input-group">
                                    <input type="number" id="tgt-dim-2" class="form-control rounded-start-3" value="9" min="1" step="0.25">
                                    <span class="input-group-text bg-white rounded-end-3 text-muted unit-label">in</span>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label-custom">Pan Depth</label>
                                <div class="input-group">
                                    <input type="number" id="tgt-depth" class="form-control rounded-start-3" value="2" min="0.5" step="0.25">
                                    <span class="input-group-text bg-white rounded-end-3 text-muted unit-label">in</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Measurement Unit</label>
                        <div class="form-check form-check-inline align-middle ms-2">
                            <input class="form-check-input" type="radio" name="pan-unit" id="unit-in" value="in" checked>
                            <label class="form-check-label small" for="unit-in">Inches (in)</label>
                        </div>
                        <div class="form-check form-check-inline align-middle">
                            <input class="form-check-input" type="radio" name="pan-unit" id="unit-cm" value="cm">
                            <label class="form-check-label small" for="unit-cm">Centimeters (cm)</label>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-cookie text-warning me-1"></i>Recipe Defaults:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 src-preset" data-shape="round" data-d1="9" data-d2="0" data-dep="2">Round 9" (std)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 src-preset" data-shape="round" data-d1="8" data-d2="0" data-dep="2">Round 8"</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 src-preset" data-shape="square" data-d1="8" data-d2="8" data-dep="2">Square 8x8"</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 src-preset" data-shape="rectangle" data-d1="13" data-d2="9" data-dep="2">Rect 9x13"</button>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Calculate Scaler</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="bakingpan-output-card" style="--tool-hue: 330; --tool-color: #ec4899; --tool-bg: rgba(236, 72, 153, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Recipe Scaling Factor</span>
                <div class="output-hero-value my-2 text-gradient" id="out-scaling-factor" style="font-size: 3rem; font-weight: 900;">1.84 x</div>
                <span class="output-hero-unit fs-5 fw-bold" id="out-scale-desc">Multiply all ingredients by 1.84</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Source Area</span>
                        <span class="stat-card-value text-secondary" id="stat-src-area">63.6 sq in</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Target Area</span>
                        <span class="stat-card-value text-secondary" id="stat-tgt-area">117.0 sq in</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Area Diff</span>
                        <span class="stat-card-value text-gradient" id="stat-area-diff">+84%</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Depth Shift</span>
                        <span class="stat-card-value text-success" id="stat-depth-shift">Same Depth</span>
                    </div>
                </div>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Conversion Report
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    const srcShape = $('src-shape');
    const srcDim1 = $('src-dim-1');
    const srcDim2 = $('src-dim-2');
    const srcDepth = $('src-depth');
    
    const tgtShape = $('tgt-shape');
    const tgtDim1 = $('tgt-dim-1');
    const tgtDim2 = $('tgt-dim-2');
    const tgtDepth = $('tgt-depth');
    
    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Dynamic Labels and Toggle based on Shape selection
    function adjustShapeUI(shapeEl, label1, label2, container2) {
        const shape = shapeEl.value;
        const c2 = $(container2);
        const l1 = $(label1);
        const l2 = $(label2);

        if (shape === 'round') {
            l1.textContent = 'Diameter';
            c2.classList.add('d-none');
        } else if (shape === 'square') {
            l1.textContent = 'Side Length';
            c2.classList.add('d-none');
        } else {
            l1.textContent = 'Length';
            l2.textContent = 'Width';
            c2.classList.remove('d-none');
        }
    }

    srcShape.addEventListener('change', () => adjustShapeUI(srcShape, 'src-dim-1-label', 'src-dim-2-label', 'src-dim-2-container'));
    tgtShape.addEventListener('change', () => adjustShapeUI(tgtShape, 'tgt-dim-1-label', 'tgt-dim-2-label', 'tgt-dim-2-container'));

    // Checkbox units shift labels
    document.querySelectorAll('input[name="pan-unit"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const unit = this.value;
            document.querySelectorAll('.unit-label').forEach(el => el.textContent = unit);
        });
    });

    // Presets Loader
    document.querySelectorAll('.src-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            srcShape.value = this.getAttribute('data-shape');
            adjustShapeUI(srcShape, 'src-dim-1-label', 'src-dim-2-label', 'src-dim-2-container');
            
            srcDim1.value = this.getAttribute('data-d1');
            srcDim2.value = this.getAttribute('data-d2');
            srcDepth.value = this.getAttribute('data-dep');
            calculate();
        });
    });

    function calculateArea(shape, dim1, dim2) {
        if (shape === 'round') {
            const r = dim1 / 2;
            return Math.PI * r * r;
        } else if (shape === 'square') {
            return dim1 * dim1;
        } else {
            return dim1 * dim2;
        }
    }

    function calculate() {
        const unit = document.querySelector('input[name="pan-unit"]:checked').value;
        
        const sShape = srcShape.value;
        const sD1 = parseFloat(srcDim1.value) || 0;
        const sD2 = sShape === 'rectangle' ? (parseFloat(srcDim2.value) || 0) : sD1;
        const sDep = parseFloat(srcDepth.value) || 0;
        
        const tShape = tgtShape.value;
        const tD1 = parseFloat(tgtDim1.value) || 0;
        const tD2 = tShape === 'rectangle' ? (parseFloat(tgtDim2.value) || 0) : tD1;
        const tDep = parseFloat(tgtDepth.value) || 0;

        if (sD1 <= 0 || sDep <= 0 || tD1 <= 0 || tDep <= 0) return;

        const srcArea = calculateArea(sShape, sD1, sD2);
        const tgtArea = calculateArea(tShape, tD1, tD2);
        
        const srcVol = srcArea * sDep;
        const tgtVol = tgtArea * tDep;
        
        const scaleFactor = tgtVol / srcVol;
        const areaDifference = ((tgtArea - srcArea) / srcArea) * 100;
        const depthDiff = tDep - sDep;

        // Render Values
        $('out-scaling-factor').textContent = scaleFactor.toFixed(2) + ' x';
        
        let multiplierDesc = '';
        if (scaleFactor > 1.02) {
            multiplierDesc = `Multiply all ingredients by ${scaleFactor.toFixed(2)}`;
        } else if (scaleFactor < 0.98) {
            multiplierDesc = `Divide/Reduce all ingredients by ${(1 / scaleFactor).toFixed(2)} (or multiply by ${scaleFactor.toFixed(2)})`;
        } else {
            multiplierDesc = 'Pans match perfectly. No scaling needed (1:1)';
        }
        $('out-scale-desc').textContent = multiplierDesc;

        $('stat-src-area').textContent = srcArea.toFixed(1) + ' sq ' + unit;
        $('stat-tgt-area').textContent = tgtArea.toFixed(1) + ' sq ' + unit;
        $('stat-area-diff').textContent = (areaDifference >= 0 ? '+' : '') + Math.round(areaDifference) + '%';
        
        let depthText = '';
        if (Math.abs(depthDiff) < 0.05) {
            depthText = 'Same Depth';
        } else if (depthDiff > 0) {
            depthText = `Thicker (+${depthDiff.toFixed(2)} ${unit})`;
        } else {
            depthText = `Thinner (${depthDiff.toFixed(2)} ${unit})`;
        }
        $('stat-depth-shift').textContent = depthText;

    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        srcShape.value = 'round';
        srcDim1.value = 9;
        srcDepth.value = 2;
        adjustShapeUI(srcShape, 'src-dim-1-label', 'src-dim-2-label', 'src-dim-2-container');

        tgtShape.value = 'rectangle';
        tgtDim1.value = 13;
        tgtDim2.value = 9;
        tgtDepth.value = 2;
        adjustShapeUI(tgtShape, 'tgt-dim-1-label', 'tgt-dim-2-label', 'tgt-dim-2-container');

        document.getElementById('unit-in').checked = true;
        document.querySelectorAll('.unit-label').forEach(el => el.textContent = 'in');
        
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const text = `Baking Pan Scaling Report\n-----------------------------------\nSource: ${srcShape.value.toUpperCase()} (${srcDim1.value}x${srcShape.value==='rectangle'?srcDim2.value:'d'}x${srcDepth.value}in)\nTarget: ${tgtShape.value.toUpperCase()} (${tgtDim1.value}x${tgtShape.value==='rectangle'?tgtDim2.value:'d'}x${tgtDepth.value}in)\nScaling Multiplier: ${$('out-scaling-factor').textContent}\nAdvice: ${$('out-scale-desc').textContent}\n— ToolsHub Culinary Suite`;
        navigator.clipboard.writeText(text).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = orig, 2000);
        });
    });

    // Run initial calculation
    calculate();
});
</script>

<style>
.bakingpan-calc-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.bakingpan-calc-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.bakingpan-calc-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.bakingpan-calc-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.bakingpan-calc-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.bakingpan-calc-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.bakingpan-calc-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.bakingpan-calc-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.bakingpan-calc-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(236, 72, 153, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(236, 72, 153, 0.02);
}
.bakingpan-calc-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.bakingpan-calc-rebuilt .text-gradient {
    background: linear-gradient(135deg, #ec4899 0%, #d946ef 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.bakingpan-calc-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
@media (min-width: 768px) {
    .border-end-md {
        border-right: 1px solid #e2e8f0 !important;
    }
    .pr-md-4 {
        padding-right: 1.5rem !important;
    }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\baking-pan-size-converter.blade.php ENDPATH**/ ?>