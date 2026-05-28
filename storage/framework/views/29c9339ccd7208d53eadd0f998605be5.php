<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-plus-circle text-primary me-2"></i>Add Standard Drinks</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 bac-quick" data-val="1">🍺 1x Beer (12oz)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 bac-quick" data-val="1">🍷 1x Wine (5oz)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 bac-quick" data-val="1">🥃 1x Shot (1.5oz)</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Physical Profile</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Biological Gender</label>
                                <select id="bac-gender" class="form-select form-select-lg rounded-3">
                                    <option value="male">Male (0.73 r)</option>
                                    <option value="female">Female (0.66 r)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Body Weight</label>
                                <div class="input-group">
                                    <input type="number" id="bac-weight" class="form-control form-control-lg rounded-start-3" value="160">
                                    <select id="bac-w-unit" class="form-select form-select-lg rounded-end-3" style="max-width: 85px;">
                                        <option value="lb">lbs</option>
                                        <option value="kg">kg</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Consumption Stats</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Total Drinks</label>
                                <input type="number" id="bac-drinks" class="form-control form-control-lg rounded-3" value="2" min="0">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Time Elapsed (Hrs)</label>
                                <input type="number" id="bac-hours" class="form-control form-control-lg rounded-3" value="1" step="0.5" min="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Estimate BAC
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>

            <div class="mt-4 p-3 bg-danger-soft rounded-4 border-start border-danger border-4">
                <p class="mb-0 small text-danger fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Legal Disclaimer: Broad mathematical estimates only. Never drink and drive regardless of calculator output.</p>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Safety Analysis</h5>
                        <p class="text-muted small mb-0">Impairment level & sobriety timeline</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0" id="out-bac">0.000</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">% BAC Level</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold" id="out-status">SOBER</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Sobriety Countdown</div>
                                <div class="h4 fw-bold mb-0 text-danger" id="out-zero-time">0.0h</div>
                                <div class="x-small text-muted fw-bold">Until 0.00%</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Legal Limit (0.08)</div>
                                <div class="h4 fw-bold mb-0" id="out-legal">Below</div>
                                <div class="x-small text-muted fw-bold">Relative Status</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center">Impairment Scale</h6>
                        <div class="progress mb-2" style="height: 12px; border-radius: 6px;">
                            <div id="prog-bar" class="progress-bar" style="width: 0%; background: linear-gradient(90deg, #10b981 0%, #f59e0b 50%, #ef4444 100%);"></div>
                        </div>
                        <div class="d-flex justify-content-between x-small fw-bold text-muted">
                            <span>Sober</span>
                            <span>Limit</span>
                            <span>Severe</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-light border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1">
                    <i class="fas fa-lightbulb text-warning me-2"></i>Safety Guidelines
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
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

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .input-group-text { background: #f8fafc; border: 1.5px solid var(--border-color); border-radius: 12px 0 0 12px; font-weight: bold; color: #64748b; }
    .input-group .form-control { border-left: none; }
    .input-group .form-select { border-left: none; }

    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const weightE = document.getElementById('bac-weight');
    const unitE = document.getElementById('bac-w-unit');
    const drinksE = document.getElementById('bac-drinks');
    const hoursE = document.getElementById('bac-hours');
    const genderE = document.getElementById('bac-gender');
    
    const resultCard = document.getElementById('result-card');
    const outBac = document.getElementById('out-bac');
    const outStatus = document.getElementById('out-status');
    const outZeroTime = document.getElementById('out-zero-time');
    const outLegal = document.getElementById('out-legal');
    const progBar = document.getElementById('prog-bar');
    const outInsights = document.getElementById('out-insights');
    const btnCalculate = document.getElementById('btn-calculate');

    function calculate() {
        const w = parseFloat(weightE.value) || 0;
        const u = unitE.value;
        const d = parseFloat(drinksE.value) || 0;
        const t = parseFloat(hoursE.value) || 0;
        const g = genderE.value === 'male' ? 0.73 : 0.66;
        
        if (w <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const wLbs = (u === 'kg') ? w * 2.20462 : w;
            // Widmark Formula: BAC = [ (Drinks * 14 * 5.14) / (Weight * r) ] - (0.015 * hours)
            let bac = (d * 14 * 5.14) / (wLbs * g) - (0.015 * t);
            bac = Math.max(0, bac);
            
            outBac.textContent = bac.toFixed(3);
            
            // UI States
            const pct = Math.min(100, (bac / 0.20) * 100);
            progBar.style.width = pct + '%';

            if (bac === 0) {
                outStatus.textContent = 'SOBER';
                outStatus.className = 'badge bg-success rounded-pill px-3';
                outLegal.textContent = 'Below';
                outLegal.className = 'h4 fw-bold mb-0 text-success';
            } else if (bac < 0.08) {
                outStatus.textContent = 'RELAXED / MILD';
                outStatus.className = 'badge bg-info rounded-pill px-3';
                outLegal.textContent = 'Below';
                outLegal.className = 'h4 fw-bold mb-0 text-success';
            } else {
                outStatus.textContent = 'INTOXICATED';
                outStatus.className = 'badge bg-danger rounded-pill px-3';
                outLegal.textContent = 'ABOVE';
                outLegal.className = 'h4 fw-bold mb-0 text-danger';
            }

            const hrsToZero = (bac / 0.015);
            outZeroTime.textContent = (bac > 0) ? `${hrsToZero.toFixed(1)}h` : '0.0h';

            const ins = [];
            if (bac > 0.08) ins.push('<strong>Legal Intoxication Detected.</strong> Do not operate machinery or drive.');
            if (bac > 0) ins.push(`Alcohol elimination rate is ~0.015% per hour. Peak recovery in <strong>${hrsToZero.toFixed(1)} hours</strong>.`);
            ins.push('Hydration and food intake do not lower final peak BAC; only time does.');

            outInsights.innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Estimate BAC';
            btnCalculate.disabled = false;
        }, 500);
    }

    btnCalculate.addEventListener('click', calculate);

    document.querySelectorAll('.bac-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            drinksE.value = parseInt(drinksE.value || 0) + parseInt(btn.dataset.val);
            calculate();
        });
    });

    document.getElementById('btn-reset').addEventListener('click', () => {
        drinksE.value = 0;
        hoursE.value = 0;
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Alcohol Safety Report\nEstimated BAC: ${outBac.textContent}%\nStatus: ${outStatus.textContent}\nRecovery Time: ${outZeroTime.textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bac-calculator.blade.php ENDPATH**/ ?>