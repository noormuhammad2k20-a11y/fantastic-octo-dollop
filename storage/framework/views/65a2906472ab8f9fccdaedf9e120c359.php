<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-lg-4">
                    <div class="p-3 rounded-4 bg-white h-100" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Tank Specifications</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Volume Unit</label>
                                <select id="stk-unit" class="form-select form-select-lg rounded-3">
                                    <option value="gal" selected>US Gallons (gal)</option>
                                    <option value="litres">Litres (L)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Tank Volume</label>
                                <input type="number" id="stk-volume" class="form-control form-control-lg rounded-3" value="20" min="2">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Filter Performance</label>
                                <select id="stk-filter" class="form-select form-select-lg rounded-3">
                                    <option value="standard" selected>Standard Internal Filter (100%)</option>
                                    <option value="canister">High Capacity Canister (150%)</option>
                                    <option value="sponge">Basic Sponge Filter (70%)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-8">
                    <div class="p-3 rounded-4 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Fish Inventory Selection</h6>
                        <div class="row g-3" id="fish-selection-grid">
                            
                            <div class="col-md-6 col-12">
                                <div class="p-2 border rounded-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-bold text-dark small">Neon Tetra (1.5")</div>
                                        <span class="x-small text-muted fw-bold">Peaceful • Min 10 gal</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="neon" data-action="minus" style="width:24px; height:24px; padding:0; line-height:1;">-</button>
                                        <input type="number" class="form-control text-center fish-qty-input font-monospace p-1" id="qty-neon" value="0" min="0" max="100" style="width:40px; font-size:0.85rem;" readonly>
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="neon" data-action="plus" style="width:24px; height:24px; padding:0; line-height:1;">+</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="p-2 border rounded-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-bold text-dark small">Guppy (2.0")</div>
                                        <span class="x-small text-muted fw-bold">Peaceful • Min 5 gal</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="guppy" data-action="minus" style="width:24px; height:24px; padding:0; line-height:1;">-</button>
                                        <input type="number" class="form-control text-center fish-qty-input font-monospace p-1" id="qty-guppy" value="0" min="0" max="100" style="width:40px; font-size:0.85rem;" readonly>
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="guppy" data-action="plus" style="width:24px; height:24px; padding:0; line-height:1;">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="p-2 border rounded-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-bold text-dark small">Male Betta (2.5")</div>
                                        <span class="x-small text-muted fw-bold">Semi-Aggressive • Min 5 gal</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="betta" data-action="minus" style="width:24px; height:24px; padding:0; line-height:1;">-</button>
                                        <input type="number" class="form-control text-center fish-qty-input font-monospace p-1" id="qty-betta" value="0" min="0" max="100" style="width:40px; font-size:0.85rem;" readonly>
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="betta" data-action="plus" style="width:24px; height:24px; padding:0; line-height:1;">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="p-2 border rounded-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-bold text-dark small">Angelfish (6.0")</div>
                                        <span class="x-small text-muted fw-bold">Semi-Aggressive • Min 30 gal</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="angelfish" data-action="minus" style="width:24px; height:24px; padding:0; line-height:1;">-</button>
                                        <input type="number" class="form-control text-center fish-qty-input font-monospace p-1" id="qty-angelfish" value="0" min="0" max="100" style="width:40px; font-size:0.85rem;" readonly>
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="angelfish" data-action="plus" style="width:24px; height:24px; padding:0; line-height:1;">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="p-2 border rounded-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-bold text-dark small">Goldfish Fancy (8.0")</div>
                                        <span class="x-small text-muted fw-bold">High Bio-load • Min 20 gal</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="goldfish" data-action="minus" style="width:24px; height:24px; padding:0; line-height:1;">-</button>
                                        <input type="number" class="form-control text-center fish-qty-input font-monospace p-1" id="qty-goldfish" value="0" min="0" max="100" style="width:40px; font-size:0.85rem;" readonly>
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="goldfish" data-action="plus" style="width:24px; height:24px; padding:0; line-height:1;">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="p-2 border rounded-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-bold text-dark small">Tiger Barb (3.0")</div>
                                        <span class="x-small text-muted fw-bold">Aggressive Nipper • Min 20 gal</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="tigerbarb" data-action="minus" style="width:24px; height:24px; padding:0; line-height:1;">-</button>
                                        <input type="number" class="form-control text-center fish-qty-input font-monospace p-1" id="qty-tigerbarb" value="0" min="0" max="100" style="width:40px; font-size:0.85rem;" readonly>
                                        <button type="button" class="btn btn-outline-secondary btn-xs rounded-circle counter-btn" data-fish="tigerbarb" data-action="plus" style="width:24px; height:24px; padding:0; line-height:1;">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Analyze Stocking Levels
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Eco-Balance Report</h5>
                        <p class="text-muted small mb-0">Biological load estimates, water changes, and species compatibility logs</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Stocking Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0 font-monospace" id="out-stocking">0%</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Biological Stocking Capacity</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-verdict" style="background-color: #10b981; color: #fff;">SAFE</span>
                    </div>
                </div>

                
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Water Change</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-water-change">15%</div>
                                <div class="x-small text-muted fw-bold">Recommended weekly</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Total Fish Length</div>
                                <div class="h5 fw-bold mb-0 text-secondary" id="out-length">0"</div>
                                <div class="x-small text-muted fw-bold">Combined index</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center">Tank Compatibility & Safety Logs</h6>
                        <ul class="list-unstyled mb-0 small text-secondary" id="out-insights">
                            
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
    const volInput = document.getElementById('stk-volume');
    const unitSelect = document.getElementById('stk-unit');
    const filterSelect = document.getElementById('stk-filter');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    const outStocking = document.getElementById('out-stocking');
    const outVerdict = document.getElementById('out-verdict');
    const outWaterChange = document.getElementById('out-water-change');
    const outLength = document.getElementById('out-length');
    const outInsights = document.getElementById('out-insights');

    // Species profile database
    const fishDatabase = {
        neon: { size: 1.5, minTank: 10, bioLoad: 0.8, aggressive: false, nipper: false, label: 'Neon Tetra' },
        guppy: { size: 2.0, minTank: 5, bioLoad: 1.0, aggressive: false, nipper: false, label: 'Guppy' },
        betta: { size: 2.5, minTank: 5, bioLoad: 1.2, aggressive: true, nipper: false, label: 'Male Betta' },
        angelfish: { size: 6.0, minTank: 30, bioLoad: 3.5, aggressive: true, nipper: false, label: 'Angelfish' },
        goldfish: { size: 8.0, minTank: 20, bioLoad: 5.5, aggressive: false, nipper: false, label: 'Fancy Goldfish' },
        tigerbarb: { size: 3.0, minTank: 20, bioLoad: 1.8, aggressive: true, nipper: true, label: 'Tiger Barb' }
    };

    // Increment/Decrement logic
    document.querySelectorAll('.counter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const fish = btn.dataset.fish;
            const action = btn.dataset.action;
            const input = document.getElementById(`qty-${fish}`);
            let val = parseInt(input.value) || 0;

            if (action === 'plus') {
                val++;
            } else if (action === 'minus' && val > 0) {
                val--;
            }
            input.value = val;
        });
    });

    function calculate() {
        let volume = parseFloat(volInput.value) || 0;
        const isLitres = unitSelect.value === 'litres';
        
        if (volume <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Assessing load...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Convert litres to US Gallons for calculation baseline
            let volumeGal = volume;
            if (isLitres) {
                volumeGal = volume / 3.78541;
            }

            let totalBioLoad = 0;
            let combinedLength = 0;
            let maxMinTankSize = 0;

            let bettasQty = 0;
            let angelfishQty = 0;
            let neonQty = 0;
            let tigerQty = 0;

            // Compute cumulative parameters
            Object.keys(fishDatabase).forEach(key => {
                const qty = parseInt(document.getElementById(`qty-${key}`).value) || 0;
                if (qty > 0) {
                    const fish = fishDatabase[key];
                    totalBioLoad += qty * fish.size * fish.bioLoad;
                    combinedLength += qty * fish.size;
                    maxMinTankSize = Math.max(maxMinTankSize, fish.minTank);

                    if (key === 'betta') bettasQty = qty;
                    if (key === 'angelfish') angelfishQty = qty;
                    if (key === 'neon') neonQty = qty;
                    if (key === 'tigerbarb') tigerQty = qty;
                }
            });

            // Adjust bio-load capacity based on filter type
            let filterModifier = 1.0;
            const filterVal = filterSelect.value;
            if (filterVal === 'canister') filterModifier = 1.5;
            else if (filterVal === 'sponge') filterModifier = 0.7;

            // Stocking level percentage calculation (baseline: 1 inch per gallon of biological capacity)
            const stockingLevel = (totalBioLoad / (volumeGal * filterModifier)) * 100;

            // Water Change calculations
            let waterChange = '15%';
            if (stockingLevel > 120) waterChange = '50% (CRITICAL)';
            else if (stockingLevel > 100) waterChange = '35% (HIGH)';
            else if (stockingLevel > 70) waterChange = '25%';

            // Verdict
            let verdict = 'SAFE & STABLE';
            let verdictColor = '#10b981';
            if (stockingLevel > 120) {
                verdict = 'CRITICALLY OVERSTOCKED';
                verdictColor = '#ef4444';
            } else if (stockingLevel > 100) {
                verdict = 'WARNING: FULL CAP';
                verdictColor = '#f59e0b';
            } else if (stockingLevel === 0) {
                verdict = 'EMPTY TANK';
                verdictColor = '#64748b';
            }

            outStocking.textContent = `${Math.round(stockingLevel)}%`;
            outVerdict.textContent = verdict;
            outVerdict.style.backgroundColor = verdictColor;
            outWaterChange.textContent = waterChange;
            outLength.textContent = `${combinedLength.toFixed(1)}"`;

            // Insights and warnings builder
            const logs = [];

            if (combinedLength === 0) {
                logs.push(`Add fish to examine biosystem parameters.`);
            } else {
                // Tank size warning
                if (volumeGal < maxMinTankSize) {
                    logs.push(`<strong class="text-danger"><i class="fas fa-exclamation-triangle"></i> Tank Size Alert:</strong> The selected species require a minimum of <strong>${Math.round(isLitres ? maxMinTankSize * 3.78541 : maxMinTankSize)} ${isLitres ? 'L' : 'gal'}</strong> tank size. Your current tank is too small.`);
                } else {
                    logs.push(`Tank volume is adequate for the largest species selected.`);
                }

                // Betta multi alert
                if (bettasQty > 1) {
                    logs.push(`<strong class="text-danger"><i class="fas fa-exclamation-triangle"></i> Aggressive Clash:</strong> Multiple male bettas detected! Male Bettas will fight aggressively to the death. Keep only one.`);
                }

                // Angelfish and neons
                if (angelfishQty > 0 && neonQty > 0) {
                    logs.push(`<strong class="text-warning"><i class="fas fa-exclamation-circle"></i> Predatory Danger:</strong> Angelfish are natural predators. Large Angelfish will easily swallow small Neon Tetras!`);
                }

                // Tiger barbs nipping
                if (tigerQty > 0 && (bettasQty > 0 || angelfishQty > 0)) {
                    logs.push(`<strong class="text-warning"><i class="fas fa-exclamation-circle"></i> Fin Nipping Threat:</strong> Tiger Barbs are notoriously nippy. They will harass and nip the delicate fins of Bettas or Angelfish.`);
                }

                // Standard stocking advice
                if (stockingLevel <= 70) {
                    logs.push(`Biological load is very comfortable. High chemical stability.`);
                } else if (stockingLevel <= 100) {
                    logs.push(`Healthy biological capacity. Ensure standard routine weekly maintenance.`);
                } else {
                    logs.push(`<strong class="text-warning"><i class="fas fa-exclamation-circle"></i> High Bio-load:</strong> Overstocked. Increase filter oxygenation and perform water changes twice a week.`);
                }
            }

            outInsights.innerHTML = logs.map(l => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-circle-notch text-primary me-2 mt-1" style="font-size:0.75rem;"></i><span>${l}</span></li>`).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Analyze Stocking Levels';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        volInput.value = '20';
        unitSelect.value = 'gal';
        filterSelect.value = 'standard';
        
        // Reset all inputs to 0
        document.querySelectorAll('.fish-qty-input').forEach(input => input.value = 0);
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const fishList = Object.keys(fishDatabase).map(key => {
            const qty = document.getElementById(`qty-${key}`).value;
            return qty > 0 ? `${fishDatabase[key].label}: ${qty}` : '';
        }).filter(Boolean).join('\n');

        const text = `Aquarium Biological Stocking Report\n━━━━━━━━━━━━━━━━━━━━━━\nTank Volume: ${volInput.value} ${unitSelect.value}\nFilter Class: ${filterSelect.value.toUpperCase()}\nStocking level: ${outStocking.textContent}\nSafety State: ${outVerdict.textContent}\nWeekly Water Change: ${outWaterChange.textContent}\n\nInventory:\n${fishList || 'Empty inventory.'}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\aquarium-stocking-calculator.blade.php ENDPATH**/ ?>