<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Source Game Settings --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Source Settings</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Source Game</label>
                                <select id="source-game" class="form-select form-select-lg rounded-3">
                                    <option value="cs2" selected>Counter-Strike 2 / CS:GO / Apex</option>
                                    <option value="val">Valorant</option>
                                    <option value="ow2">Overwatch 2 / Call of Duty</option>
                                    <option value="fortnite">Fortnite</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-muted">Current Sensitivity</label>
                                <input type="number" id="source-sens" class="form-control form-control-lg rounded-3" value="2.0" min="0.01" max="100" step="0.01">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Target Game & DPI --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Target Settings & DPI</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Target Game</label>
                                <select id="target-game" class="form-select form-select-lg rounded-3">
                                    <option value="cs2">Counter-Strike 2 / CS:GO / Apex</option>
                                    <option value="val" selected>Valorant</option>
                                    <option value="ow2">Overwatch 2 / Call of Duty</option>
                                    <option value="fortnite">Fortnite</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-muted">Mouse DPI</label>
                                <select id="mouse-dpi" class="form-select form-select-lg rounded-3">
                                    <option value="400">400 DPI</option>
                                    <option value="800" selected>800 DPI</option>
                                    <option value="1200">1200 DPI</option>
                                    <option value="1600">1600 DPI</option>
                                    <option value="3200">3200 DPI</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-src="cs2" data-sens="2.0" data-tgt="val" data-dpi="800">
                    CS2 standard to Valorant (2.0 @ 800 DPI)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-src="val" data-sens="0.31" data-tgt="cs2" data-dpi="1600">
                    Valorant Pro to CS2 (0.31 @ 1600 DPI)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-src="cs2" data-sens="1.5" data-tgt="ow2" data-dpi="800">
                    CS2 low-sens to Overwatch 2 (1.5 @ 800 DPI)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #0284c7; border-color: #0284c7;">
                    <i class="fas fa-exchange-alt me-2"></i> Convert Mouse Sensitivity
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #e0f2fe; color: #0284c7;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Converted Sensitivity</h5>
                        <p class="text-muted small mb-0 font-monospace">1:1 Muscle Memory Preservation</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #0284c7; border-color: #0284c7;">
                        <i class="fas fa-copy me-1"></i> Copy Settings
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #0284c7;" id="result-target-sens">0.63</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1" id="result-target-name">Recommended Valorant Sensitivity</p>
            </div>

            <div class="row g-4">
                {{-- Physical Metrics (360 Distance) --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-ruler me-2 text-primary"></i>Physical 360° Turn Distance</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">360° Distance (Metric):</span>
                                <span class="fw-bold text-dark font-monospace" id="out-dist-cm">25.9 cm</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">360° Distance (Imperial):</span>
                                <span class="fw-bold text-dark font-monospace" id="out-dist-in">10.2 inches</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- eDPI details --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-tachometer-alt me-2 text-success"></i>eDPI Comparisons</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Source eDPI:</span>
                                <span class="fw-bold text-dark font-monospace" id="out-src-edpi">1,600 eDPI</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Target eDPI:</span>
                                <span class="fw-bold text-dark font-monospace" id="out-tgt-edpi">504 eDPI</span>
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
    .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const srcGameIn = document.getElementById('source-game');
    const srcSensIn = document.getElementById('source-sens');
    const tgtGameIn = document.getElementById('target-game');
    const dpiIn = document.getElementById('mouse-dpi');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateSensitivity() {
        const srcGame = srcGameIn.value;
        const srcSens = parseFloat(srcSensIn.value) || 2.0;
        const tgtGame = tgtGameIn.value;
        const dpi = parseInt(dpiIn.value) || 800;

        if (srcSens <= 0) {
            alert("Sensitivity must be greater than zero!");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Converting Muscle Memory...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // First step: convert source sensitivity to standard CS2 base
            let baseCS2Sens = srcSens;
            if (srcGame === 'val') {
                baseCS2Sens = srcSens * 3.181818;
            } else if (srcGame === 'ow2') {
                baseCS2Sens = srcSens / 3.333333;
            } else if (srcGame === 'fortnite') {
                baseCS2Sens = srcSens / 25.3086;
            }

            // Second step: convert CS2 base to target sensitivity
            let targetSens = baseCS2Sens;
            if (tgtGame === 'val') {
                targetSens = baseCS2Sens / 3.181818;
            } else if (tgtGame === 'ow2') {
                targetSens = baseCS2Sens * 3.333333;
            } else if (tgtGame === 'fortnite') {
                targetSens = baseCS2Sens * 25.3086;
            }

            // Calculate eDPIs (Sens * DPI)
            const srcEdpi = srcSens * dpi;
            const tgtEdpi = targetSens * dpi;

            // Physical 360 distance: standard formula using CS2 base
            // CS2 360 distance (cm) = 32918.4 / (DPI * CS2 Sens)
            const distCm = 32918.4 / (dpi * baseCS2Sens);
            const distInches = distCm / 2.54;

            // Render Output
            document.getElementById('result-target-sens').innerText = targetSens.toFixed(3);
            document.getElementById('result-target-name').innerText = `Recommended ${tgtGameIn.options[tgtGameIn.selectedIndex].text} Sensitivity`;

            document.getElementById('out-dist-cm').innerText = distCm.toFixed(1) + " cm";
            document.getElementById('out-dist-in').innerText = distInches.toFixed(1) + " inches";
            
            document.getElementById('out-src-edpi').innerText = Math.round(srcEdpi).toLocaleString() + " eDPI";
            document.getElementById('out-tgt-edpi').innerText = Math.round(tgtEdpi).toLocaleString() + " eDPI";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-exchange-alt me-2"></i> Convert Mouse Sensitivity';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateSensitivity);

    btnReset.addEventListener('click', () => {
        srcGameIn.value = 'cs2';
        srcSensIn.value = 2.0;
        tgtGameIn.value = 'val';
        dpiIn.value = '800';
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            srcGameIn.value = this.dataset.src;
            srcSensIn.value = this.dataset.sens;
            tgtGameIn.value = this.dataset.tgt;
            dpiIn.value = this.dataset.dpi;
            calculateSensitivity();
        });
    });

    btnCopy.addEventListener('click', function() {
        const tgtSens = document.getElementById('result-target-sens').innerText;
        const tgtName = document.getElementById('result-target-name').innerText;
        const cm = document.getElementById('out-dist-cm').innerText;
        const inches = document.getElementById('out-dist-in').innerText;
        const srcEd = document.getElementById('out-src-edpi').innerText;
        const tgtEd = document.getElementById('out-tgt-edpi').innerText;

        const text = `MOUSE SENSITIVITY CONVERSION REPORT\n` +
                     `====================================\n` +
                     `Source Game: ${srcGameIn.options[srcGameIn.selectedIndex].text}\n` +
                     `Source Sensitivity: ${srcSensIn.value}\n` +
                     `Mouse DPI: ${dpiIn.value} DPI\n\n` +
                     `RECOMMENDED SETTING:\n` +
                     `- Target Game: ${tgtGameIn.options[tgtGameIn.selectedIndex].text}\n` +
                     `- Target Sensitivity: ${tgtSens}\n\n` +
                     `PHYSICAL 360° DISTANCE:\n` +
                     `- Metric: ${cm}\n` +
                     `- Imperial: ${inches}\n\n` +
                     `EDPI COMPARISONS:\n` +
                     `- Source: ${srcEd}\n` +
                     `- Target: ${tgtEd}\n\n` +
                     `Generated via ToolsHub Mouse Sensitivity Converter.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Settings Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
