<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Gravity Settings --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Gravity Readings</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Original Gravity (OG)</label>
                                <input type="number" id="gravity-og" class="form-control form-control-lg rounded-3" value="1.055" min="1.000" max="1.160" step="0.001">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Final Gravity (FG)</label>
                                <input type="number" id="gravity-fg" class="form-control form-control-lg rounded-3" value="1.012" min="0.980" max="1.060" step="0.001">
                            </div>
                        </div>
                        <div class="mt-3 small text-muted">
                            <i class="fas fa-info-circle me-1"></i> Water is exactly 1.000. Typical ale final gravity is 1.008 to 1.016.
                        </div>
                    </div>
                </div>

                {{-- Equation Style --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Calculation Equation</label>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small text-muted">Calculation Method</label>
                                <select id="abv-eq" class="form-select form-select-lg rounded-3">
                                    <option value="standard" selected>Standard Equation (Recommended under 8% ABV)</option>
                                    <option value="alternate">Alternate / High-Gravity Equation (Over 8% ABV)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-og="1.045" data-fg="1.010" data-eq="standard">
                    Standard Blonde Ale (OG 1.045, FG 1.010)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-og="1.070" data-fg="1.014" data-eq="standard">
                    Double IPA (OG 1.070, FG 1.014)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-og="1.100" data-fg="1.022" data-eq="alternate">
                    Imperial Stout (OG 1.100, FG 1.022)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-warning btn-lg rounded-pill px-5 shadow-sm transition-all text-dark fw-bold" id="btn-calculate" style="background-color: #d97706; border-color: #d97706; color: #fff !important;">
                    <i class="fas fa-vial me-2"></i> Compute Brew Stats
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
                    <div class="icon-box me-3" style="background-color: #fef3c7; color: #d97706;">
                        <i class="fas fa-flask"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Brew Chemistry Report</h5>
                        <p class="text-muted small mb-0">Detailed ABV, attenuation, and calorie estimation results</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #d97706; border-color: #d97706; color: #fff;">
                        <i class="fas fa-copy me-1"></i> Copy Brew Sheet
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #d97706;" id="result-abv">5.6%</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1">Estimated Alcohol By Volume</p>
            </div>

            <div class="row g-4">
                {{-- Attenuation & Extract --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-chart-line me-2 text-warning"></i>Yeast Attenuation</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Apparent Attenuation:</span>
                                <span class="fw-bold text-dark" id="out-attenuation">77.4%</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Extract Drop (Points):</span>
                                <span class="fw-bold text-dark" id="out-points-drop">43 points</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Equation Formula Used:</span>
                                <span class="fw-bold text-dark" id="out-formula-label">Standard Formula</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Calorie Count --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-fire me-2 text-danger"></i>Caloric Content</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Calories (12oz Glass):</span>
                                <span class="fw-bold text-dark" id="out-calories">181 kcal</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Real Extract (Plato):</span>
                                <span class="fw-bold text-dark" id="out-plato-real">4.62 °P</span>
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
    .form-control:focus, .form-select:focus { border-color: #d97706; box-shadow: 0 0 0 4px rgba(217, 119, 6, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ogIn = document.getElementById('gravity-og');
    const fgIn = document.getElementById('gravity-fg');
    const eqIn = document.getElementById('abv-eq');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateABV() {
        const og = parseFloat(ogIn.value) || 1.050;
        const fg = parseFloat(fgIn.value) || 1.010;
        const eq = eqIn.value;

        if (og < fg) {
            alert("Original Gravity (OG) must be greater than Final Gravity (FG)!");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Fermenting Math...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            let abv = 0;
            if (eq === 'standard') {
                abv = (og - fg) * 131.25;
                document.getElementById('out-formula-label').innerText = "Standard Equation";
            } else {
                // High gravity alternate equation
                abv = (76.08 * (og - fg) / (1.775 - og)) * (fg / 0.794);
                document.getElementById('out-formula-label').innerText = "Alternate (High Gravity)";
            }

            // Apparent Attenuation
            const attenuation = ((og - fg) / (og - 1.000)) * 100;
            const pointsDrop = Math.round((og - fg) * 1000);

            // Calorie content per 12oz:
            // Standard brewer calculation: 
            // Calories per 12oz = 362.1 * FG * (1.811 * (OG - FG) + 0.188 * (FG - 1))
            // But if result is negative or odd, let's keep a robust standard:
            const calories = Math.max(0, 362.1 * fg * (1.811 * (og - fg) + 0.188 * (fg - 1)));

            // Plato equivalent (Real extract approx)
            const platoReal = (0.1808 * og + 0.8192 * fg) * 100 - 100; // Real extract estimate

            // Populate results
            document.getElementById('result-abv').innerText = abv.toFixed(2) + "%";
            document.getElementById('out-attenuation').innerText = attenuation.toFixed(1) + "%";
            document.getElementById('out-points-drop').innerText = pointsDrop + " gravity points";
            document.getElementById('out-calories').innerText = Math.round(calories) + " kcal";
            document.getElementById('out-plato-real').innerText = platoReal.toFixed(2) + " °P";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-vial me-2"></i> Compute Brew Stats';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateABV);

    btnReset.addEventListener('click', () => {
        ogIn.value = 1.055;
        fgIn.value = 1.012;
        eqIn.value = 'standard';
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            ogIn.value = this.dataset.og;
            fgIn.value = this.dataset.fg;
            eqIn.value = this.dataset.eq;
            calculateABV();
        });
    });

    btnCopy.addEventListener('click', function() {
        const abv = document.getElementById('result-abv').innerText;
        const att = document.getElementById('out-attenuation').innerText;
        const drop = document.getElementById('out-points-drop').innerText;
        const cals = document.getElementById('out-calories').innerText;
        const plato = document.getElementById('out-plato-real').innerText;

        const text = `HOMEBREW BEER CHEMISTRY ANALYSIS\n` +
                     `================================\n` +
                     `Original Gravity (OG): ${ogIn.value}\n` +
                     `Final Gravity (FG): ${fgIn.value}\n` +
                     `Equation Style: ${eqIn.options[eqIn.selectedIndex].text}\n\n` +
                     `ESTIMATED BEER ABV: ${abv}\n` +
                     `Apparent Attenuation: ${att}\n` +
                     `Gravity Points Consumed: ${drop}\n` +
                     `Calorie Estimate (12oz): ${cals}\n` +
                     `Real Extract: ${plato}\n\n` +
                     `Generated via ToolsHub Homebrew ABV Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Stats!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
