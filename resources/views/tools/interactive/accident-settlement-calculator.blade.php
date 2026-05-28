<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Special Damages Section --}}
                <div class="col-lg-8">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-4 letter-spacing-1">Economic Damages (Specials)</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Hospital/ER Bills</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" id="e-hosp" class="form-control form-control-lg e-val" value="5000" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">PT & Medications</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" id="e-pt" class="form-control form-control-lg e-val" value="2000" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Lost Wages</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" id="e-wage" class="form-control form-control-lg e-val" value="1500" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Property Damage</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" id="prop" class="form-control form-control-lg" value="3500" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- General Damages Section --}}
                <div class="col-lg-4">
                    <div class="p-4 rounded-4 h-100" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-4 letter-spacing-1">Pain & Suffering (Generals)</h6>
                        
                        <div class="d-grid gap-2 mb-4">
                            <button class="btn btn-outline-dark btn-sm rounded-pill fw-bold" id="qa-min" style="min-width: 280px; max-width: 100%;">Minor Injury (1.5x)</button>
                            <button class="btn btn-outline-danger btn-sm rounded-pill fw-bold" id="qa-sv" style="min-width: 280px; max-width: 100%;">Severe Injury (4.0x)</button>
                        </div>

                        <label class="form-label small fw-bold text-primary text-uppercase mb-3 d-block text-center">Multiplier: <span id="mult-disp" class="h5 mb-0">2.5x</span></label>
                        <input type="range" id="mult-rng" class="form-range custom-range" min="1.0" max="5.0" value="2.5" step="0.1">
                        
                        <p class="small text-muted mt-3 mb-0">Multiplier is typically applied to medical expenses (Specials).</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-gavel me-2"></i> Estimate Settlement
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-file-invoice-dollar text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Valuation Summary</h5>
                        <p class="text-muted small mb-0">Estimated gross claim value</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Estimate
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-danger mb-0" id="tot-set">$0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Estimated Gross Settlement</p>
                    
                    <div class="alert mt-3 border-0 p-3 rounded-4 bg-light text-muted small">
                        <i class="fas fa-info-circle me-1"></i> Note: Attorney fees (usually 33%) and medical liens will be deducted from this amount.
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                            <span class="text-muted fw-bold small text-uppercase">Economic Losses</span>
                            <span class="fw-bold h5 mb-0 text-dark" id="sum-econ">$0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                            <span class="text-muted fw-bold small text-uppercase">Pain & Suffering</span>
                            <span class="fw-bold h5 mb-0 text-danger" id="sum-pain">$0</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted fw-bold small text-uppercase">Property Damage</span>
                            <span class="fw-bold h5 mb-0 text-primary" id="sum-prop">$0</span>
                        </div>
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

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .input-group-text { background: #f8fafc; border: 1.5px solid var(--border-color); border-right: none; border-radius: 12px 0 0 12px; font-weight: bold; color: #64748b; }
    .input-group .form-control { border-left: none; }

    .transition-all { transition: all 0.2s ease; }
    
    .letter-spacing-1 { letter-spacing: 1px; }

    .custom-range::-webkit-slider-runnable-track { background: #e2e8f0; border-radius: 10px; height: 8px; }
    .custom-range::-webkit-slider-thumb { margin-top: -6px; background: var(--primary-color); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const resultCard = document.getElementById('result-card');
    const totSet = document.getElementById('tot-set');
    const sumEcon = document.getElementById('sum-econ');
    const sumPain = document.getElementById('sum-pain');
    const sumPropDisplay = document.getElementById('sum-prop');
    const multRng = document.getElementById('mult-rng');
    const multDisp = document.getElementById('mult-disp');
    const btnCalculate = document.getElementById('btn-calculate');

    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }

    function calc() {
        let econTotal = 0;
        document.querySelectorAll('.e-val').forEach(el => econTotal += (parseFloat(el.value)||0));
        
        const prop = parseFloat(document.getElementById('prop').value) || 0;
        const mult = parseFloat(multRng.value) || 1.5;
        multDisp.innerText = mult.toFixed(1) + 'x';
        
        const hosp = parseFloat(document.getElementById('e-hosp').value) || 0;
        const pt = parseFloat(document.getElementById('e-pt').value) || 0;
        const painValue = (hosp + pt) * mult;
        
        const grossTotal = econTotal + painValue + prop;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Estimating...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            totSet.innerText = format(grossTotal);
            sumEcon.innerText = format(econTotal);
            sumPain.innerText = format(painValue);
            sumPropDisplay.innerText = format(prop);

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-gavel me-2"></i> Estimate Settlement';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calc);

    document.getElementById('qa-min').addEventListener('click', () => { multRng.value = 1.5; calc(); });
    document.getElementById('qa-sv').addEventListener('click', () => { multRng.value = 4.0; calc(); });
    
    document.getElementById('btn-reset').addEventListener('click', () => {
        document.querySelectorAll('input[type="number"]').forEach(i => i.value = 0);
        multRng.value = 2.5;
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Accident Settlement Estimate:\nGross Settlement: ${totSet.innerText}\nEconomic Damages: ${sumEcon.innerText}\nPain & Suffering: ${sumPain.innerText}\nProperty Damage: ${sumPropDisplay.innerText}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Estimate!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });

    // Initial calc or just wait for click
});
</script>

