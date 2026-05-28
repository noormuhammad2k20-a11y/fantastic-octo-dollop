<div class="row g-4 fabric-calculator-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Project Type and Fabric Roll Width --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Select Project Type</label>
                        <select id="project-type" class="form-select rounded-3 border-teal-custom">
                            <option value="curtains" selected>🛋️ Curtains & Drapes</option>
                            <option value="pillows">🛏️ Throw Pillows</option>
                            <option value="quilt">🧵 Quilt Backing & Top</option>
                            <option value="custom">📏 Custom Fabric Panels</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Fabric Roll Width</label>
                        <select id="roll-width" class="form-select rounded-3">
                            <option value="44">44 inches (Standard Quilting Fabric)</option>
                            <option value="54" selected>54 inches (Standard Home Decor / Upholstery)</option>
                            <option value="60">60 inches (Apparel / Wide Fabric)</option>
                            <option value="110">110 inches (Extra Wide backing/drapery)</option>
                        </select>
                    </div>
                </div>

                {{-- DYNAMIC PROJECT FIELDS PANEL --}}
                <div class="mt-4 p-4 rounded-3 bg-light border border-teal-light">
                    {{-- Curtains Panel --}}
                    <div id="panel-curtains" class="project-panel">
                        <h6 class="fw-bold mb-3 text-teal"><i class="fas fa-arrows-alt me-2"></i>Curtain Dimensions</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Window/Rod Width</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="curt-rod-w" class="form-control" value="60">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Finished Curtain Length</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="curt-len" class="form-control" value="84">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Fullness Multiplier</label>
                                <select id="curt-fullness" class="form-select form-select-sm">
                                    <option value="1.5">1.5x Fullness (Minimal)</option>
                                    <option value="2" selected>2.0x Fullness (Standard)</option>
                                    <option value="2.5">2.5x Fullness (Luxury)</option>
                                    <option value="3">3.0x Fullness (Heavy Gather)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Top Header & Bottom Hem Allowance</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="curt-hem" class="form-control" value="12">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Pattern Repeat Offset</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="curt-repeat" class="form-control" value="0">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Number of Panels</label>
                                <input type="number" id="curt-panels" class="form-control form-control-sm" value="2" min="1">
                            </div>
                        </div>
                    </div>

                    {{-- Pillows Panel --}}
                    <div id="panel-pillows" class="project-panel d-none">
                        <h6 class="fw-bold mb-3 text-teal"><i class="fas fa-square me-2"></i>Throw Pillow Details</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Pillow Form Dimensions</label>
                                <select id="pillow-preset" class="form-select form-select-sm">
                                    <option value="16">Square 16" x 16" (40x40 cm)</option>
                                    <option value="18" selected>Square 18" x 18" (45x45 cm)</option>
                                    <option value="20">Square 20" x 20" (50x50 cm)</option>
                                    <option value="24">Square 24" x 24" (60x60 cm)</option>
                                    <option value="custom">Custom Size...</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Custom Width / Side</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="pillow-custom-w" class="form-control" value="18" disabled>
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Pillow Quantity</label>
                                <input type="number" id="pillow-qty" class="form-control form-control-sm" value="2" min="1">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom-small">Seam Allowance (per side)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="pillow-seam" class="form-control" value="0.5" step="0.25">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom-small">Pillow Back Style</label>
                                <select id="pillow-style" class="form-select form-select-sm">
                                    <option value="solid" selected>Solid Panel (Front/Back Separate)</option>
                                    <option value="envelope">Envelope Back (+4 inches wrap)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Quilt Panel --}}
                    <div id="panel-quilt" class="project-panel d-none">
                        <h6 class="fw-bold mb-3 text-teal"><i class="fas fa-border-all me-2"></i>Quilt Dimensions</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Quilt Finished Width</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="quilt-w" class="form-control" value="60">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Quilt Finished Length</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="quilt-h" class="form-control" value="80">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Extra Border/Backing Margin</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="quilt-margin" class="form-control" value="4">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Custom Panel --}}
                    <div id="panel-custom" class="project-panel d-none">
                        <h6 class="fw-bold mb-3 text-teal"><i class="fas fa-arrows-spin me-2"></i>Custom Cuts & Panels</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Individual Panel Cut Length</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="custom-len" class="form-control" value="36">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Individual Panel Cut Width</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="custom-wid" class="form-control" value="24">
                                    <span class="input-group-text unit-label">inches</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom-small">Total Pieces/Panels Needed</label>
                                <input type="number" id="custom-qty" class="form-control form-control-sm" value="4" min="1">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Settings & Price calculation --}}
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Measurement Unit</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-teal active flex-grow-1 py-2 fw-bold rounded-3 unit-toggle-btn" data-unit="yards">
                                Yards
                            </button>
                            <button type="button" class="btn btn-outline-teal flex-grow-1 py-2 fw-bold rounded-3 unit-toggle-btn" data-unit="meters">
                                Meters
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Fabric Price (per Yard/Meter)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted fw-bold">$</span>
                            <input type="number" id="fabric-price" class="form-control" value="12" step="0.5" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Safety Overpack Margin</label>
                        <select id="safety-overpack" class="form-select rounded-3">
                            <option value="1.0">0% Extra (Exact fit)</option>
                            <option value="1.1" selected>+10% Extra (Recommended for errors)</option>
                            <option value="1.15">+15% Extra (Complex patterns / repeats)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:180;--tool-color:#0d9488;--tool-bg:rgba(13,148,136,.04);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL YARDAGE REQUIRED</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value text-teal" id="out-total-fabric">5.3</span>
                    <span class="output-hero-unit" id="out-fabric-unit">Yards</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-fabric-status">Calculated for 54" roll width</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Total Cost</span>
                        <span class="stat-card-value text-dark" id="out-total-cost">$63.60</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Cut Width Required</span>
                        <span class="stat-card-value text-dark" id="out-single-w">60"</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Single Cut Length</span>
                        <span class="stat-card-value text-dark" id="out-single-l">96"</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 p-1">
                    <div class="stat-card" style="border-color:#e2e8f0; background: #fff; padding: 1rem 0.5rem;">
                        <span class="stat-card-label" style="font-size:0.65rem;">Panels Across Width</span>
                        <span class="stat-card-value text-dark" id="out-panels-across">1 Panel</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-scissors text-teal me-2"></i>Professional Cut Layout Insights
                </h6>
                <div id="out-fabric-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="fabric-copy-btn">
                        <i class="fas fa-copy me-2 text-teal"></i>Copy Material List
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="fabric-reset">Reset Fields</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-2.5 px-4 fw-bold rounded-pill shadow-sm w-100" id="fabric-share-btn">
                        <i class="fas fa-share-alt me-2"></i>Share Measurements
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const projectTypeE = $('project-type'),
          rollWidthE = $('roll-width'),
          safetyOverpackE = $('safety-overpack'),
          fabricPriceE = $('fabric-price');

    // Curtain Elements
    const curtRodWE = $('curt-rod-w'),
          curtLenE = $('curt-len'),
          curtFullnessE = $('curt-fullness'),
          curtHemE = $('curt-hem'),
          curtRepeatE = $('curt-repeat'),
          curtPanelsE = $('curt-panels');

    // Pillow Elements
    const pillowPresetE = $('pillow-preset'),
          pillowCustomWE = $('pillow-custom-w'),
          pillowQtyE = $('pillow-qty'),
          pillowSeamE = $('pillow-seam'),
          pillowStyleE = $('pillow-style');

    // Quilt Elements
    const quiltWE = $('quilt-w'),
          quiltHE = $('quilt-h'),
          quiltMarginE = $('quilt-margin');

    // Custom Panel Elements
    const customLenE = $('custom-len'),
          customWidE = $('custom-wid'),
          customQtyE = $('custom-qty');

    let currentUnit = 'yards'; // yards vs meters
    let selectedProject = 'curtains';

    function calculateFabric() {
        const rollWidth = parseFloat(rollWidthE.value) || 54;
        const price = parseFloat(fabricPriceE.value) || 0;
        const multiplier = parseFloat(safetyOverpackE.value) || 1.0;

        let totalLengthInches = 0;
        let singleCutLength = 0;
        let singleCutWidth = 0;
        let panelsAcross = 0;
        let piecesNeeded = 0;
        
        let insightHtml = "";

        if (selectedProject === 'curtains') {
            const rodW = parseFloat(curtRodWE.value) || 0;
            const targetLen = parseFloat(curtLenE.value) || 0;
            const fullness = parseFloat(curtFullnessE.value) || 2.0;
            const hem = parseFloat(curtHemE.value) || 12;
            const repeat = parseFloat(curtRepeatE.value) || 0;
            const totalPanels = parseInt(curtPanelsE.value) || 2;

            singleCutLength = targetLen + hem;
            singleCutWidth = (rodW * fullness) / totalPanels;
            panelsAcross = Math.max(1, Math.floor(rollWidth / singleCutWidth));

            // Adjust single cut length for repeat match
            if (repeat > 0 && totalPanels > 1) {
                // First panel doesn't require repeat correction, succeeding ones do.
                const repeatsNeeded = Math.ceil(singleCutLength / repeat);
                singleCutLength = repeatsNeeded * repeat;
            }

            piecesNeeded = totalPanels;
            const columnsNeeded = Math.ceil(totalPanels / panelsAcross);
            totalLengthInches = singleCutLength * columnsNeeded;

            insightHtml = `<ul class="list-unstyled mb-0">
                <li class="mb-2"><i class="fas fa-info-circle text-teal me-1"></i> Each of your <strong>${totalPanels} curtain panels</strong> will be cut <strong>${singleCutLength}" long</strong> (including hem) and <strong>${singleCutWidth.toFixed(0)}" wide</strong>.</li>
                <li class="mb-2"><i class="fas fa-circle-dot text-teal me-1"></i> With a <strong>${rollWidth}" roll</strong>, you can fit <strong>${panelsAcross} panel(s)</strong> across the fabric width.</li>
                ${repeat > 0 ? `<li class="mb-2 text-warning"><i class="fas fa-sync text-teal me-1"></i> Pattern repeat of <strong>${repeat}"</strong> incorporated. Order an extra pattern length to align prints symmetrically.</li>` : ''}
            </ul>`;

        } else if (selectedProject === 'pillows') {
            const presetVal = pillowPresetE.value;
            let pillowW = 18;
            if (presetVal === 'custom') {
                pillowW = parseFloat(pillowCustomWE.value) || 18;
            } else {
                pillowW = parseFloat(presetVal);
            }
            const qty = parseInt(pillowQtyE.value) || 1;
            const seam = parseFloat(pillowSeamE.value) || 0.5;
            const style = pillowStyleE.value;

            singleCutWidth = pillowW + (seam * 2);
            singleCutLength = pillowW + (seam * 2);

            if (style === 'envelope') {
                singleCutLength = singleCutLength + 4; // Add overlap wrap fabric
            }

            // A throw pillow has 2 panels (front and back)
            const panelsPerPillow = 2;
            const totalPanels = qty * panelsPerPillow;

            // Compute how many panels fit across roll width
            panelsAcross = Math.max(1, Math.floor(rollWidth / singleCutWidth));
            piecesNeeded = totalPanels;

            const rowsNeeded = Math.ceil(totalPanels / panelsAcross);
            totalLengthInches = singleCutLength * rowsNeeded;

            insightHtml = `<ul class="list-unstyled mb-0">
                <li class="mb-2"><i class="fas fa-info-circle text-teal me-1"></i> To make <strong>${qty} pillows</strong>, you need <strong>${totalPanels} square cuts</strong> (front/back panels) of <strong>${singleCutWidth.toFixed(1)}" x ${singleCutLength.toFixed(1)}"</strong>.</li>
                <li class="mb-2"><i class="fas fa-circle-dot text-teal me-1"></i> You can fit <strong>${panelsAcross} square cuts</strong> side-by-side across the <strong>${rollWidth}" roll</strong>.</li>
            </ul>`;

        } else if (selectedProject === 'quilt') {
            const quiltW = parseFloat(quiltWE.value) || 0;
            const quiltL = parseFloat(quiltHE.value) || 0;
            const extra = parseFloat(quiltMarginE.value) || 4;

            // Total backing width/length needs extra allowance
            const totalBackW = quiltW + (extra * 2);
            const totalBackL = quiltL + (extra * 2);

            singleCutWidth = totalBackW;
            singleCutLength = totalBackL;

            // Backing fabrics standard: pieced together.
            if (totalBackW <= rollWidth) {
                panelsAcross = 1;
                totalLengthInches = totalBackL;
                insightHtml = `<ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="fas fa-check-circle text-teal me-1"></i> <strong>Seamless fit!</strong> The backing size of <strong>${totalBackW}"</strong> fits completely inside the <strong>${rollWidth}" roll</strong> without piecing.</li>
                </ul>`;
            } else {
                // Pieced backing needed
                const panelsNeeded = Math.ceil(totalBackW / rollWidth);
                panelsAcross = panelsNeeded;
                totalLengthInches = totalBackL * panelsNeeded;
                insightHtml = `<ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="fas fa-exclamation-triangle text-warning me-1"></i> <strong>Pieced Backing Required</strong>: The quilt backing width is larger than the fabric width. You will need to join <strong>${panelsNeeded} lengths</strong> of fabric vertically.</li>
                </ul>`;
            }
            piecesNeeded = panelsAcross;

        } else if (selectedProject === 'custom') {
            const cutL = parseFloat(customLenE.value) || 0;
            const cutW = parseFloat(customWidE.value) || 0;
            const qty = parseInt(customQtyE.value) || 1;

            singleCutLength = cutL;
            singleCutWidth = cutW;
            piecesNeeded = qty;

            panelsAcross = Math.max(1, Math.floor(rollWidth / singleCutWidth));
            const rowsNeeded = Math.ceil(qty / panelsAcross);
            totalLengthInches = singleCutLength * rowsNeeded;

            insightHtml = `<ul class="list-unstyled mb-0">
                <li class="mb-2"><i class="fas fa-info-circle text-teal me-1"></i> Cutting <strong>${qty} panels</strong> of <strong>${singleCutWidth}" W x ${singleCutLength}" L</strong>.</li>
                <li class="mb-2"><i class="fas fa-circle-dot text-teal me-1"></i> Layout allows <strong>${panelsAcross} panels</strong> across the fabric width.</li>
            </ul>`;
        }

        if (totalLengthInches <= 0) {
            $('out-total-fabric').textContent = '0';
            $('out-total-cost').textContent = '$0.00';
            return;
        }

        // Apply safety padding
        let paddedInches = totalLengthInches * multiplier;
        
        let yardage = paddedInches / 36;
        let meters = (paddedInches * 2.54) / 100;

        let finalVal = currentUnit === 'yards' ? yardage : meters;
        let displayUnit = currentUnit === 'yards' ? 'Yards' : 'Meters';

        // Calculate Cost
        let totalCost = finalVal * price;

        $('out-total-fabric').textContent = finalVal.toFixed(1);
        $('out-fabric-unit').textContent = displayUnit;
        $('out-total-cost').textContent = `$${totalCost.toFixed(2)}`;

        $('out-single-w').textContent = `${singleCutWidth.toFixed(1)}"`;
        $('out-single-l').textContent = `${singleCutLength.toFixed(1)}"`;
        $('out-panels-across').textContent = `${panelsAcross} Across`;
        $('out-fabric-status').textContent = `Padded with ${Math.round((multiplier - 1)*100)}% safety overpack`;

        $('out-fabric-insights').innerHTML = insightHtml;
    }

    // Handle Project Toggles
    projectTypeE.addEventListener('change', () => {
        selectedProject = projectTypeE.value;
        document.querySelectorAll('.project-panel').forEach(p => p.classList.add('d-none'));
        $(`panel-${selectedProject}`).classList.remove('d-none');
        calculateFabric();
    });

    // Handle Pillow custom size disabled state
    pillowPresetE.addEventListener('change', () => {
        if (pillowPresetE.value === 'custom') {
            pillowCustomWE.disabled = false;
        } else {
            pillowCustomWE.disabled = true;
            pillowCustomWE.value = pillowPresetE.value;
        }
        calculateFabric();
    });

    // Handle unit toggles
    document.querySelectorAll('.unit-toggle-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const unit = btn.dataset.unit;
            if (unit === currentUnit) return;

            document.querySelectorAll('.unit-toggle-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            currentUnit = unit;
            calculateFabric();
        });
    });

    // Trigger Calculations on inputs
    [
        rollWidthE, fabricPriceE, safetyOverpackE,
        curtRodWE, curtLenE, curtFullnessE, curtHemE, curtRepeatE, curtPanelsE,
        pillowPresetE, pillowCustomWE, pillowQtyE, pillowSeamE, pillowStyleE,
        quiltWE, quiltHE, quiltMarginE,
        customLenE, customWidE, customQtyE
    ].forEach(el => {
        el.addEventListener('input', calculateFabric);
    });

    // Reset Fields
    $('fabric-reset').addEventListener('click', () => {
        // Restore standard defaults
        curtRodWE.value = 60;
        curtLenE.value = 84;
        curtFullnessE.value = 2.0;
        curtHemE.value = 12;
        curtRepeatE.value = 0;
        curtPanelsE.value = 2;

        pillowPresetE.value = 18;
        pillowCustomWE.value = 18;
        pillowCustomWE.disabled = true;
        pillowQtyE.value = 2;
        pillowSeamE.value = 0.5;
        pillowStyleE.value = 'solid';

        quiltWE.value = 60;
        quiltHE.value = 80;
        quiltMarginE.value = 4;

        customLenE.value = 36;
        customWidE.value = 24;
        customQtyE.value = 4;

        fabricPriceE.value = 12;
        safetyOverpackE.value = 1.1;

        calculateFabric();
    });

    // Copy Material List
    $('fabric-copy-btn').addEventListener('click', function(){
        const text = `Fabric Yardage Estimator Specifications:\n` +
                     `-------------------------------------------\n` +
                     `Project Type: ${projectTypeE.value.toUpperCase()}\n` +
                     `Roll Width: ${rollWidthE.value}"\n` +
                     `Unit Cut Dimensions: ${$('out-single-w').textContent} Width x ${$('out-single-l').textContent} Length\n` +
                     `-------------------------------------------\n` +
                     `Fabric Needed: ${$('out-total-fabric').textContent} ${$('out-fabric-unit').textContent}\n` +
                     `Total Price Estimate: ${$('out-total-cost').textContent}\n` +
                     `Layout: ${$('out-panels-across').textContent}\n` +
                     `Calculated via ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied Material Specs!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    // Share link simple implementation
    $('fabric-share-btn').addEventListener('click', function(){
        const dummyUrl = window.location.href;
        navigator.clipboard.writeText(dummyUrl).then(()=>{
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied URL Link!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculateFabric();
});
</script>

<style>
.fabric-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:1.5rem;box-shadow:0 8px 48px rgba(13,148,136,.03)}
.fabric-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:1.25rem}
.fabric-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.25rem}
.fabric-calculator-rebuilt .calculator-header p{margin:0;font-size:0.875rem;color:#64748b;line-height:1.6}
.fabric-calculator-rebuilt .tool-icon-circle{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;flex-shrink:0}
.fabric-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.fabric-calculator-rebuilt .form-label-custom-small{font-size:.7rem;font-weight:700;color:#475569;margin-bottom:.4rem;display:block}
.fabric-calculator-rebuilt .border-teal-custom{border:2px solid #0d9488}
.fabric-calculator-rebuilt .btn-outline-teal{border-color:#0d9488; color:#0d9488; border-width:2.5px}
.fabric-calculator-rebuilt .btn-outline-teal.active{background-color:#0d9488; border-color:#0d9488; color:#fff}
.fabric-calculator-rebuilt .btn-outline-teal:hover{background-color:rgba(13,148,136,.1); color:#0d9488}
.fabric-calculator-rebuilt .btn-outline-teal.active:hover{background-color:#0d9488; color:#fff}
.border-teal-light{border-color:#ccfbf1!important}
.text-teal{color:#0d9488!important}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:1.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:1.25rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:1rem}
.output-hero-label{display:block;font-size:.75rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:0.5rem}
.output-hero-value{font-size:2.25rem;font-weight:900;line-height:1;letter-spacing:-2px}
.stat-card{border:2.5px solid #f1f5f9;border-radius:16px;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:4px}
.stat-card-value{font-size:1.15rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .fabric-calculator-rebuilt .calculator-card { padding: 1rem; }
    .output-card-themed { padding: 1rem; }
    .output-hero-value { font-size: 1.6rem; }
}
</style>
