<div class="row g-4 cross-stitch-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Width in Stitches</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fas fa-arrows-left-right"></i></span>
                            <input type="number" id="stitch-width" class="form-control rounded-end-3" value="140" min="1" max="10000" placeholder="e.g. 140">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Height in Stitches</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fas fa-arrows-up-down"></i></span>
                            <input type="number" id="stitch-height" class="form-control rounded-end-3" value="100" min="1" max="10000" placeholder="e.g. 100">
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Fabric Count (Aida / Linen)</label>
                        <select id="fabric-count" class="form-select rounded-3">
                            <option value="11">11 Count (Aida)</option>
                            <option value="14" selected>14 Count (Aida - Standard)</option>
                            <option value="16">16 Count (Aida)</option>
                            <option value="18">18 Count (Aida)</option>
                            <option value="22">22 Count (Hardanger)</option>
                            <option value="25">25 Count (Evenweave)</option>
                            <option value="28">28 Count (Linen / Evenweave)</option>
                            <option value="32">32 Count (Linen / Evenweave)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Framing Margin (per side)</label>
                        <div class="input-group">
                            <input type="number" id="margin-allowance" class="form-control rounded-start-3" value="3" step="0.5" min="0" max="10" placeholder="3">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold unit-text">inches</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Measurement Unit</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-rose active flex-grow-1 py-2 fw-bold rounded-3 unit-btn" data-unit="inches">
                                Inches
                            </button>
                            <button type="button" class="btn btn-outline-rose flex-grow-1 py-2 fw-bold rounded-3 unit-btn" data-unit="cm">
                                Metric (cm)
                            </button>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cross-stitch-preset" data-w="50" data-h="50" data-c="14">🌸 Small Motif (50x50 on 14ct)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cross-stitch-preset" data-w="150" data-h="120" data-c="14">🧵 Medium Design (150x120 on 14ct)</button>
                    <button type="button" class="btn btn-sm btn-outline-rose rounded-pill px-3 cross-stitch-preset" data-w="300" data-h="250" data-c="18">🌟 Large Piece (300x250 on 18ct)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:350;--tool-color:#e11d48;--tool-bg:rgba(225,29,72,.04);">
            <div class="output-hero">
                <span class="output-hero-label">RECOMMENDED FABRIC CUT SIZE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-fabric-size">16.0" x 13.1"</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-stitch-status">Aida Size Recommended</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Design Width</span>
                        <span class="stat-card-value text-dark" id="out-design-w">10.0"</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Design Height</span>
                        <span class="stat-card-value text-dark" id="out-design-h">7.1"</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Total Stitches</span>
                        <span class="stat-card-value text-dark" id="out-total-stitches">14,000</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Total Margin</span>
                        <span class="stat-card-value text-dark" id="out-total-margin">6.0"</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-magic text-rose me-2"></i>Crafter's Custom Insights
                </h6>
                <div id="out-stitch-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="stitch-copy-btn">
                        <i class="fas fa-copy me-2 text-rose"></i>Copy Fabric Specs
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="stitch-reset">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="stitch-share-btn">
                        <i class="fas fa-share-alt me-2"></i>Share Design Config
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const stitchWidthE = $('stitch-width'),
          stitchHeightE = $('stitch-height'),
          fabricCountE = $('fabric-count'),
          marginAllowanceE = $('margin-allowance');

    let currentUnit = 'inches';

    function calculateCrossStitch() {
        const wStitches = parseInt(stitchWidthE.value) || 0;
        const hStitches = parseInt(stitchHeightE.value) || 0;
        const count = parseInt(fabricCountE.value) || 14;
        let margin = parseFloat(marginAllowanceE.value) || 0;

        if (wStitches <= 0 || hStitches <= 0) {
            $('out-fabric-size').textContent = 'Invalid Input';
            $('out-design-w').textContent = '-';
            $('out-design-h').textContent = '-';
            $('out-total-stitches').textContent = '-';
            $('out-total-margin').textContent = '-';
            $('out-stitch-insights').innerHTML = '<p class="text-danger mb-0"><i class="fas fa-exclamation-triangle me-1"></i>Please enter valid width and height stitch counts.</p>';
            return;
        }

        // Calculate design dimensions
        let designW = wStitches / count;
        let designH = hStitches / count;

        // If unit is cm, we display calculations in cm.
        // The user's input margin is assumed to be in the current active unit.
        let totalMarginVal = margin * 2;
        let finalW = designW + totalMarginVal;
        let finalH = designH + totalMarginVal;

        let unitLabel = currentUnit === 'inches' ? '"' : ' cm';

        if (currentUnit === 'cm') {
            // If current unit is cm, convert design inches to cm
            designW = designW * 2.54;
            designH = designH * 2.54;
            finalW = designW + totalMarginVal;
            finalH = designH + totalMarginVal;
        }

        const totalStitches = wStitches * hStitches;

        // Format outputs
        $('out-fabric-size').textContent = `${finalW.toFixed(1)}${unitLabel} x ${finalH.toFixed(1)}${unitLabel}`;
        $('out-design-w').textContent = `${designW.toFixed(1)}${unitLabel}`;
        $('out-design-h').textContent = `${designH.toFixed(1)}${unitLabel}`;
        $('out-total-stitches').textContent = totalStitches.toLocaleString();
        $('out-total-margin').textContent = `${totalMarginVal.toFixed(1)}${unitLabel}`;

        // Dynamic status
        let densityStatus = "Fine/Mini Design";
        if (totalStitches > 50000) densityStatus = "Grand Masterpiece Project";
        else if (totalStitches > 15000) densityStatus = "Full Coverage Project";
        else if (totalStitches > 5000) densityStatus = "Standard Mid-size Design";
        $('out-stitch-status').textContent = `${count} Count — ${densityStatus}`;

        // Insights
        const ins = [];
        
        // Margin adequacy suggestion
        if (margin < 2) {
            ins.push('<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i> <strong>Tight Margin Warning</strong>: We recommend at least 2" (5 cm) of margin for finishing/hooping, and 3" (7.5 cm) for professional framing.</span>');
        } else {
            ins.push('<span class="text-success"><i class="fas fa-check-circle me-1"></i> Margins are ample for secure framing or stretching on scroll frames.</span>');
        }

        // Hoop recommendation
        const maxDesignDim = Math.max(designW, designH);
        let recommendedHoop = "";
        if (currentUnit === 'inches') {
            if (maxDesignDim < 4) recommendedHoop = '5" or 6" embroidery hoop';
            else if (maxDesignDim < 6) recommendedHoop = '7" or 8" embroidery hoop';
            else if (maxDesignDim < 8) recommendedHoop = '9" or 10" hoop, or a Q-Snap frame';
            else recommendedHoop = '11"+ Q-Snap frame or Scroll Frame';
        } else {
            // cm limits
            if (maxDesignDim < 10) recommendedHoop = '12cm to 15cm hoop';
            else if (maxDesignDim < 15) recommendedHoop = '18cm to 20cm hoop';
            else if (maxDesignDim < 20) recommendedHoop = '22cm to 25cm hoop or Q-Snap frame';
            else recommendedHoop = 'Large Q-Snap frame or Scroll Frame';
        }
        ins.push(`<strong>Hoop/Frame Suggestion</strong>: For comfortable stitching, use a <strong>${recommendedHoop}</strong>.`);

        // Fabric specific recommendations
        if (count >= 28) {
            ins.push('<strong>Tip</strong>: Since you are using a higher count fabric (28ct+), it is common to stitch "two threads over two grid intersections" unless you prefer microscopic details.');
        }

        $('out-stitch-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2">${i}</li>`).join('')}</ul>`;
    }

    // Handle Unit Toggles
    document.querySelectorAll('.unit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const newUnit = btn.dataset.unit;
            if (newUnit === currentUnit) return;

            document.querySelectorAll('.unit-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Convert margin value to give user a smooth experience
            let currentMarginVal = parseFloat(marginAllowanceE.value) || 0;
            if (newUnit === 'cm') {
                marginAllowanceE.value = (currentMarginVal * 2.54).toFixed(1);
                document.querySelectorAll('.unit-text').forEach(el => el.textContent = 'cm');
            } else {
                marginAllowanceE.value = (currentMarginVal / 2.54).toFixed(1);
                document.querySelectorAll('.unit-text').forEach(el => el.textContent = 'inches');
            }

            currentUnit = newUnit;
            calculateCrossStitch();
        });
    });

    // Handle Presets
    document.querySelectorAll('.cross-stitch-preset').forEach(btn => {
        btn.addEventListener('click', () => {
            stitchWidthE.value = btn.dataset.w;
            stitchHeightE.value = btn.dataset.h;
            fabricCountE.value = btn.dataset.c;
            // Default safe margin
            marginAllowanceE.value = currentUnit === 'inches' ? '3' : '7.5';
            calculateCrossStitch();
        });
    });

    // Reset fields
    $('stitch-reset').addEventListener('click', () => {
        stitchWidthE.value = 140;
        stitchHeightE.value = 100;
        fabricCountE.value = 14;
        marginAllowanceE.value = currentUnit === 'inches' ? '3' : '7.5';
        calculateCrossStitch();
    });

    // Copy Specifications
    $('stitch-copy-btn').addEventListener('click', function(){
        const text = `Cross-Stitch Fabric Calculator Specifications:\n` +
                     `-------------------------------------------\n` +
                     `Stitch Dimensions: ${stitchWidthE.value} W x ${stitchHeightE.value} H\n` +
                     `Fabric Count: ${fabricCountE.value} count Aida/Linen\n` +
                     `Framing Margin: ${marginAllowanceE.value} ${currentUnit} per side\n` +
                     `-------------------------------------------\n` +
                     `Total Fabric Size Needed: ${$('out-fabric-size').textContent}\n` +
                     `Exact Design Area: ${$('out-design-w').textContent} W x ${$('out-design-h').textContent} H\n` +
                     `Total Stitches: ${$('out-total-stitches').textContent}\n` +
                     `Calculated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied Specifications!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Share link simple implementation
    $('stitch-share-btn').addEventListener('click', function(){
        const dummyUrl = window.location.href;
        navigator.clipboard.writeText(dummyUrl).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied URL Link!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Set listener triggers
    [stitchWidthE, stitchHeightE, fabricCountE, marginAllowanceE].forEach(el => {
        el.addEventListener('input', calculateCrossStitch);
    });

    calculateCrossStitch();
});
</script>

<style>
.cross-stitch-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:1.5rem;box-shadow:0 8px 48px rgba(225,29,72,.03)}
.cross-stitch-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:1.25rem}
.cross-stitch-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.25rem}
.cross-stitch-calculator-rebuilt .calculator-header p{margin:0;font-size:0.875rem;color:#64748b;line-height:1.6}
.cross-stitch-calculator-rebuilt .tool-icon-circle{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;flex-shrink:0}
.cross-stitch-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.cross-stitch-calculator-rebuilt .btn-outline-rose{border-color:#e11d48; color:#e11d48; border-width:2.5px}
.cross-stitch-calculator-rebuilt .btn-outline-rose.active{background-color:#e11d48; border-color:#e11d48; color:#fff}
.cross-stitch-calculator-rebuilt .btn-outline-rose:hover{background-color:rgba(225,29,72,.1); color:#e11d48}
.cross-stitch-calculator-rebuilt .btn-outline-rose.active:hover{background-color:#e11d48; color:#fff}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:1.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:1.25rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:1rem}
.output-hero-label{display:block;font-size:.75rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:0.5rem}
.output-hero-value{font-size:2.25rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-2px}
.stat-card{border:2.5px solid #f1f5f9;border-radius:16px;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:4px}
.stat-card-value{font-size:1.15rem;font-weight:900;display:block;line-height:1.2}
.text-rose { color:#e11d48!important; }
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .cross-stitch-calculator-rebuilt .calculator-card { padding: 1rem; }
    .output-card-themed { padding: 1rem; }
    .output-hero-value { font-size: 1.6rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cross-stitch-size-calculator.blade.php ENDPATH**/ ?>