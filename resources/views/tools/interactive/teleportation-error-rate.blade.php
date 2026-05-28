<div class="interactive-wrapper">
    {{-- Input Card (Quantum Link Settings) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Range and Coherence --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Emitter Configuration</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Transport Distance (Light Years)</label>
                                <div class="input-group">
                                    <input type="number" id="tp-distance" class="form-control form-control-lg rounded-start-3" value="4.2" min="0.0001" step="0.1">
                                    <span class="input-group-text rounded-end-3">LY</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Quantum Coherence Level (%)</label>
                                <div class="input-group">
                                    <input type="number" id="tp-coherence" class="form-control form-control-lg rounded-start-3" value="99.98" min="0.01" max="100" step="0.01">
                                    <span class="input-group-text rounded-end-3">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Buffers and Flare activity --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Buffer & Environmental factors</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Pattern Buffer Capacity (Terabytes - TB)</label>
                                <div class="input-group">
                                    <input type="number" id="tp-buffer" class="form-control form-control-lg rounded-start-3" value="2048" min="1">
                                    <span class="input-group-text rounded-end-3">TB</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Solar Flare / Cosmic Storm Activity</label>
                                <select id="tp-storm" class="form-select form-select-lg rounded-3">
                                    <option value="1.0" selected>Low Activity / Quiet space (1.0x)</option>
                                    <option value="1.8">Moderate Activity / Solar Winds (1.8x)</option>
                                    <option value="3.5">Cosmic Storm / Magnetic Interference (3.5x)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-bolt me-2"></i> Initialize Transporter Beam
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Quantum Grid Output) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Materialization Diagnostics</h5>
                        <p class="text-muted small mb-0">Entanglement stream statistics and particle resolution diagnostics</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Diagnostics Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                {{-- Overall Integrity Gauge --}}
                <div class="col-lg-5 text-center border-end">
                    <div class="display-4 fw-bold text-dark mb-0 font-monospace" id="out-error-rate">0.000%</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Transport Error Rate</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-safety-badge" style="background-color: #10b981; color: #fff;">CLASS A SAFE</span>
                    </div>
                </div>

                {{-- Quantum indicators --}}
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Survival Probability</div>
                                <div class="h5 fw-bold mb-0 text-success" id="out-survival">100%</div>
                                <div class="x-small text-muted fw-bold">Atomic stability index</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Decay Rate</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-degrade">0.00%</div>
                                <div class="x-small text-muted fw-bold">Cellular variance</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Fly Hybridization Odds</div>
                                <div class="h5 fw-bold mb-0 text-danger" id="out-fly-chance">0.0000%</div>
                                <div class="x-small text-muted fw-bold">Chances of fusing with a housefly</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center">Diagnostics telemetry</h6>
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
    const distInput = document.getElementById('tp-distance');
    const cohInput = document.getElementById('tp-coherence');
    const buffInput = document.getElementById('tp-buffer');
    const stormSelect = document.getElementById('tp-storm');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    
    const outError = document.getElementById('out-error-rate');
    const outSafetyBadge = document.getElementById('out-safety-badge');
    const outSurvival = document.getElementById('out-survival');
    const outDegrade = document.getElementById('out-degrade');
    const outFlyChance = document.getElementById('out-fly-chance');
    const outInsights = document.getElementById('out-insights');

    function calculate() {
        const dist = parseFloat(distInput.value) || 0;
        const coherence = parseFloat(cohInput.value) || 0;
        const buffer = parseFloat(buffInput.value) || 0;
        const stormMultiplier = parseFloat(stormSelect.value) || 1.0;

        if (dist <= 0 || coherence <= 0 || buffer <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Confining Matrix...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Quantum base error
            let errCoherence = (100 - coherence) * 0.85;

            // Distance dispersion factor (logarithmic)
            let errDist = Math.log10(dist + 1) * 3.5;

            // Pattern buffer deficiency penalty (a human molecular blueprint requires min 1024 TB)
            let errBuffer = 0;
            if (buffer < 1024) {
                errBuffer = ((1024 - buffer) / 8);
            }

            // Cumulative raw error rate
            let finalError = (errCoherence + errDist + errBuffer) * stormMultiplier;

            // Enforce realistic bounds
            finalError = Math.max(0.000001, Math.min(99.99999, finalError));

            // Survival Probability
            const survival = Math.max(0, 100 - finalError);

            // Atomic variance degradation
            const degrade = finalError * 0.65;

            // Fusing with a housefly (Brundlefly probability)
            let flyChance = 0.000001; // tiny standard cosmic dust quantum probability
            if (coherence < 80 || stormMultiplier > 2.0 || buffer < 512) {
                flyChance = (100 - coherence) * 0.6 + (buffer < 1024 ? (1024 - buffer)/25 : 0) + (stormMultiplier * 2.5);
                flyChance = Math.min(48.5, flyChance);
            }

            // Set dynamic text and style classes
            outError.textContent = `${finalError.toFixed(4)}%`;
            outSurvival.textContent = `${survival.toFixed(2)}%`;
            outDegrade.textContent = `${degrade.toFixed(2)}%`;
            outFlyChance.textContent = `${flyChance.toFixed(4)}%`;

            // Safety standards badge mapping
            let badge = 'CLASS A SAFE';
            let badgeColor = '#10b981';
            
            if (finalError > 25) {
                badge = 'CLASS D AVOID';
                badgeColor = '#ef4444';
            } else if (finalError > 5) {
                badge = 'CLASS C WARNING';
                badgeColor = '#f59e0b';
            } else if (finalError > 0.05) {
                badge = 'CLASS B TRANSIT';
                badgeColor = '#3b82f6';
            }

            outSafetyBadge.textContent = badge;
            outSafetyBadge.style.backgroundColor = badgeColor;

            // Insights list builder
            const logs = [];
            logs.push(`Particle coherence integrity: <strong>${coherence.toFixed(2)}%</strong> entropic synchronization.`);
            if (buffer < 1024) {
                logs.push(`<strong class="text-danger"><i class="fas fa-exclamation-triangle"></i> Buffer Underflow:</strong> Buffer size (${buffer} TB) is below standard human genetic footprint (1024 TB). Severe compression risk.`);
            } else {
                logs.push(`Pattern buffer memory is stable and within biological standards.`);
            }

            if (stormMultiplier > 2.0) {
                logs.push(`<strong class="text-warning"><i class="fas fa-solar-panel"></i> Cosmic Storm Alert:</strong> High solar magnetic winds are scattering vector particles. Quantum containment field is highly stressed.`);
            }

            if (finalError > 15) {
                logs.push(`<strong class="text-danger"><i class="fas fa-biohazard"></i> Genetic Alert:</strong> Extremely high likelihood of cellular rearrangement or particle dislocation upon arrival. Travel heavily advised against.`);
            } else {
                logs.push(`Safe materialization matrix. Cellular dislocation rates are mathematically negligible.`);
            }

            outInsights.innerHTML = logs.map(l => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-satellite-dish text-primary me-2 mt-1" style="font-size:0.85rem;"></i><span>${l}</span></li>`).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-bolt me-2"></i> Initialize Transporter Beam';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        distInput.value = '4.2';
        cohInput.value = '99.98';
        buffInput.value = '2048';
        stormSelect.value = '1.0';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Quantum Teleportation Diagnostics\n━━━━━━━━━━━━━━━━━━━━━━\nDistance: ${distInput.value} LY\nQuantum Coherence: ${cohInput.value}%\nPattern Buffer: ${buffInput.value} TB\n━━━━━━━━━━━━━━━━━━━━━━\nContainment Class: ${outSafetyBadge.textContent}\nBeam Error Rate: ${outError.textContent}\nReconstitution Probability: ${outSurvival.textContent}\nInsectoid Hybridization Risk: ${outFlyChance.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
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
