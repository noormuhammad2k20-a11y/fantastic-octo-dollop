<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Primary Spirit --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-3">Primary Spirit / Base</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Volume (oz)</label>
                                <input type="number" id="spirit1-vol" class="form-control form-control-lg rounded-3" value="2.0" min="0" step="0.1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">ABV (%)</label>
                                <input type="number" id="spirit1-abv" class="form-control form-control-lg rounded-3" value="40" min="0" max="100">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Secondary Spirit / Modifier --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-3">Secondary Spirit / Liqueur</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Volume (oz)</label>
                                <input type="number" id="spirit2-vol" class="form-control form-control-lg rounded-3" value="0.75" min="0" step="0.1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">ABV (%)</label>
                                <input type="number" id="spirit2-abv" class="form-control form-control-lg rounded-3" value="20" min="0" max="100">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mixer & Method --}}
                <div class="col-md-12">
                    <div class="p-4 rounded-4 bg-light border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-3">Mixers & Ice Dilution</label>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Mixer Volume (oz)</label>
                                <input type="number" id="mixer-vol" class="form-control form-control-lg rounded-3" value="3.0" min="0" step="0.1">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Dilution Method</label>
                                <select id="dilution-method" class="form-select form-select-lg rounded-3">
                                    <option value="shaken" selected>Shaken on Ice (~25% dilution)</option>
                                    <option value="stirred">Stirred on Ice (~15% dilution)</option>
                                    <option value="neat">Neat / No Ice (0% dilution)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Volume Unit</label>
                                <select id="unit" class="form-select form-select-lg rounded-3">
                                    <option value="oz">Fluid Ounces (oz)</option>
                                    <option value="ml">Milliliters (ml)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-s1v="2.0" data-s1a="40" data-s2v="0.0" data-s2a="0" data-mix="0.0" data-method="stirred" data-unit="oz">
                    Martini (Stirred)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-s1v="2.0" data-s1a="40" data-s2v="0.75" data-s2a="20" data-mix="3.0" data-method="shaken" data-unit="oz">
                    Highball Mix (Shaken)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-s1v="1.5" data-s1a="40" data-s2v="1.5" data-s2a="15" data-mix="0.0" data-method="stirred" data-unit="oz">
                    Negroni (Stirred)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #db2777; border-color: #db2777;">
                    <i class="fas fa-cocktail me-2"></i> Calculate Strength
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
                    <div class="icon-box me-3" style="background-color: #fdf2f8; color: #db2777;">
                        <i class="fas fa-beer"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Drink Strength Analysis</h5>
                        <p class="text-muted small mb-0">Dilution and absolute alcohol calculations</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #db2777; border-color: #db2777;">
                        <i class="fas fa-copy me-1"></i> Copy Analysis
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #db2777;" id="result-abv">14.2%</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1">Estimated Final ABV</p>
            </div>

            <div class="row g-4">
                {{-- Volume Details --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-compress-alt me-2 text-pink"></i>Volume Properties</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Base Ingredients Vol:</span>
                                <span class="fw-bold text-dark" id="result-base-vol">5.75 oz</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Ice Dilution Added:</span>
                                <span class="fw-bold text-dark" id="result-dilution-vol">0.86 oz</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Total Serving Vol:</span>
                                <span class="fw-bold text-dark" id="result-total-vol">6.61 oz</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Intake Warnings / Standard Drinks --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-info-circle me-2 text-warning"></i>Alcohol Content & Standard Drinks</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Pure Alcohol:</span>
                                <span class="fw-bold text-dark" id="result-pure-alcohol">0.95 oz</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Standard Drinks:</span>
                                <span class="fw-bold text-dark" id="result-standard-drinks">1.68</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Drink Classification:</span>
                                <span class="badge rounded-pill px-3 py-1" id="result-class-badge" style="background-color: #fdf2f8; color: #db2777;">Strong</span>
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
    .form-control:focus, .form-select:focus { border-color: #db2777; box-shadow: 0 0 0 4px rgba(219, 39, 119, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const s1VolIn = document.getElementById('spirit1-vol');
    const s1AbvIn = document.getElementById('spirit1-abv');
    const s2VolIn = document.getElementById('spirit2-vol');
    const s2AbvIn = document.getElementById('spirit2-abv');
    const mixerVolIn = document.getElementById('mixer-vol');
    const dilutionIn = document.getElementById('dilution-method');
    const unitIn = document.getElementById('unit');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateCocktail() {
        const s1Vol = parseFloat(s1VolIn.value) || 0;
        const s1Abv = parseFloat(s1AbvIn.value) || 0;
        const s2Vol = parseFloat(s2VolIn.value) || 0;
        const s2Abv = parseFloat(s2AbvIn.value) || 0;
        const mixerVol = parseFloat(mixerVolIn.value) || 0;
        const method = dilutionIn.value;
        const unit = unitIn.value;

        if (s1Vol + s2Vol + mixerVol <= 0) {
            alert("Please enter a volume for at least one ingredient!");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Mix...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Absolute pure alcohol
            const pureAlcohol = (s1Vol * (s1Abv / 100)) + (s2Vol * (s2Abv / 100));
            const baseVol = s1Vol + s2Vol + mixerVol;

            // Dilution based on method
            let dilutionRate = 0.25; // Shaken
            if (method === 'stirred') dilutionRate = 0.15;
            if (method === 'neat') dilutionRate = 0.0;

            const dilutionVol = baseVol * dilutionRate;
            const totalVol = baseVol + dilutionVol;

            const finalAbv = totalVol > 0 ? (pureAlcohol / totalVol) * 100 : 0;

            // Standard drinks (US standard is 0.6 oz pure alcohol)
            // If ML is selected, 0.6 oz = 17.74 ml
            let standardDrinks = 0;
            if (unit === 'oz') {
                standardDrinks = pureAlcohol / 0.6;
            } else {
                standardDrinks = (pureAlcohol) / 17.74;
            }

            // Populate results
            document.getElementById('result-abv').innerText = finalAbv.toFixed(1) + "%";
            document.getElementById('result-base-vol').innerText = baseVol.toFixed(2) + " " + unit;
            document.getElementById('result-dilution-vol').innerText = dilutionVol.toFixed(2) + " " + unit;
            document.getElementById('result-total-vol').innerText = totalVol.toFixed(2) + " " + unit;
            document.getElementById('result-pure-alcohol').innerText = pureAlcohol.toFixed(2) + " " + unit;
            document.getElementById('result-standard-drinks').innerText = standardDrinks.toFixed(2);

            // Badge classification
            const badge = document.getElementById('result-class-badge');
            if (finalAbv < 5) {
                badge.innerText = "Low Alcohol / Session";
                badge.style.backgroundColor = "#e0f2fe";
                badge.style.color = "#0284c7";
            } else if (finalAbv < 12) {
                badge.innerText = "Medium / Wine Strength";
                badge.style.backgroundColor = "#e8f5e9";
                badge.style.color = "#2e7d32";
            } else if (finalAbv < 22) {
                badge.innerText = "Strong Cocktail";
                badge.style.backgroundColor = "#fdf2f8";
                badge.style.color = "#db2777";
            } else {
                badge.innerText = "Very Strong / Shot";
                badge.style.backgroundColor = "#fffbeb";
                badge.style.color = "#d97706";
            }

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-cocktail me-2"></i> Calculate Strength';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateCocktail);

    btnReset.addEventListener('click', () => {
        s1VolIn.value = 2.0;
        s1AbvIn.value = 40;
        s2VolIn.value = 0.75;
        s2AbvIn.value = 20;
        mixerVolIn.value = 3.0;
        dilutionIn.value = 'shaken';
        unitIn.value = 'oz';
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            s1VolIn.value = this.dataset.s1v;
            s1AbvIn.value = this.dataset.s1a;
            s2VolIn.value = this.dataset.s2v;
            s2AbvIn.value = this.dataset.s2a;
            mixerVolIn.value = this.dataset.mix;
            dilutionIn.value = this.dataset.method;
            unitIn.value = this.dataset.unit;
            calculateCocktail();
        });
    });

    btnCopy.addEventListener('click', function() {
        const abv = document.getElementById('result-abv').innerText;
        const totalVol = document.getElementById('result-total-vol').innerText;
        const stdDrinks = document.getElementById('result-standard-drinks').innerText;
        const text = `COCKTAIL ABV ANALYSIS SUMMARY\n` +
                     `=============================\n` +
                     `Primary Spirit: ${s1VolIn.value} oz @ ${s1AbvIn.value}%\n` +
                     `Liqueur/Modifier: ${s2VolIn.value} oz @ ${s2AbvIn.value}%\n` +
                     `Mixer: ${mixerVolIn.value} oz\n` +
                     `Method: ${dilutionIn.options[dilutionIn.selectedIndex].text}\n\n` +
                     `FINAL CALCULATED ABV: ${abv}\n` +
                     `Total Serving Vol: ${totalVol}\n` +
                     `Estimated US Standard Drinks: ${stdDrinks}\n` +
                     `Generated via ToolsHub Cocktail ABV Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
