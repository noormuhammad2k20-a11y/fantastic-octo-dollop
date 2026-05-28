<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Pack A --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-3 d-flex align-items-center justify-content-between">
                            <span>Package A (Standard)</span>
                            <span class="badge bg-primary rounded-pill px-2">Pack A</span>
                        </label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Price ($)</label>
                                <input type="number" id="a-price" class="form-control form-control-lg rounded-3" value="9.99" min="0.1" step="0.01">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Total Rolls</label>
                                <input type="number" id="a-rolls" class="form-control form-control-lg rounded-3" value="12" min="1" step="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Sheets / Roll</label>
                                <input type="number" id="a-sheets" class="form-control form-control-lg rounded-3" value="220" min="10" step="5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Ply Layer</label>
                                <select id="a-ply" class="form-select form-select-lg rounded-3">
                                    <option value="1">1-Ply</option>
                                    <option value="2" selected>2-Ply</option>
                                    <option value="3">3-Ply</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pack B --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-3 d-flex align-items-center justify-content-between">
                            <span>Package B (Mega Roll)</span>
                            <span class="badge bg-success rounded-pill px-2">Pack B</span>
                        </label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Price ($)</label>
                                <input type="number" id="b-price" class="form-control form-control-lg rounded-3" value="14.99" min="0.1" step="0.01">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Total Rolls</label>
                                <input type="number" id="b-rolls" class="form-control form-control-lg rounded-3" value="8" min="1" step="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Sheets / Roll</label>
                                <input type="number" id="b-sheets" class="form-control form-control-lg rounded-3" value="450" min="10" step="5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Ply Layer</label>
                                <select id="b-ply" class="form-select form-select-lg rounded-3">
                                    <option value="1">1-Ply</option>
                                    <option value="2" selected>2-Ply</option>
                                    <option value="3">3-Ply</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Optional Dimensions --}}
                <div class="col-12">
                    <div class="p-4 rounded-4 bg-light border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Sheet Sizes (Optional for precise area comparison)</label>
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <label class="form-label small text-muted">Sheet Width (in)</label>
                                <input type="number" id="sheet-w" class="form-control form-control-lg rounded-3" value="4.0" min="2.0" max="6.0" step="0.1">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label small text-muted">Sheet Length (in)</label>
                                <input type="number" id="sheet-l" class="form-control form-control-lg rounded-3" value="4.0" min="2.0" max="6.0" step="0.1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Presets --}}
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-ap="8.99" data-ar="12" data-as="200" data-aply="2" data-bp="12.99" data-br="8" data-bs="350" data-bply="2">
                    Standard vs Double Roll (2-Ply)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-ap="5.49" data-ar="4" data-as="300" data-aply="2" data-bp="6.99" data-br="6" data-bs="200" data-bply="3">
                    2-Ply vs 3-Ply Luxury
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="background-color: #475569; border-color: #475569;">
                    <i class="fas fa-search-dollar me-2"></i> Compare Toilet Paper
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
                    <div class="icon-box me-3" style="background-color: #e2e8f0; color: #475569;">
                        <i class="fas fa-trophy text-warning"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Comparison Winner</h5>
                        <p class="text-muted small mb-0">Analysis of the raw cost per unit metrics</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #475569; border-color: #475569;">
                        <i class="fas fa-copy me-1"></i> Copy Analysis
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4 p-4 rounded-4" style="background-color: #f8fafc;" id="winner-banner">
                <h4 class="fw-bold mb-1" id="result-winner-label">Package B is the Winner!</h4>
                <p class="text-success fw-bold mb-0 h5" id="result-savings-pct">Saves you 12.5% per square foot</p>
            </div>

            <div class="row g-4">
                {{-- Pack A Details --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100" id="card-pack-a">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-box me-2 text-primary"></i>Package A Metrics</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Total Sheets:</span>
                                <span class="fw-bold text-dark" id="out-a-totalsheets">2,640</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Total Square Footage:</span>
                                <span class="fw-bold text-dark" id="out-a-sqft">293.3 sq ft</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Cost / 100 Sheets:</span>
                                <span class="fw-bold text-dark" id="out-a-cost100">$0.38</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Cost / Sq Ft (Raw):</span>
                                <span class="fw-bold text-dark" id="out-a-costsqft">$0.034</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Pack B Details --}}
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100" id="card-pack-b">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-box me-2 text-success"></i>Package B Metrics</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Total Sheets:</span>
                                <span class="fw-bold text-dark" id="out-b-totalsheets">3,600</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Total Square Footage:</span>
                                <span class="fw-bold text-dark" id="out-b-sqft">400.0 sq ft</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Cost / 100 Sheets:</span>
                                <span class="fw-bold text-dark" id="out-b-cost100">$0.42</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Cost / Sq Ft (Raw):</span>
                                <span class="fw-bold text-dark" id="out-b-costsqft">$0.037</span>
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
    .form-control:focus, .form-select:focus { border-color: #475569; box-shadow: 0 0 0 4px rgba(71, 85, 105, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const aPriceIn = document.getElementById('a-price');
    const aRollsIn = document.getElementById('a-rolls');
    const aSheetsIn = document.getElementById('a-sheets');
    const aPlyIn = document.getElementById('a-ply');
    const bPriceIn = document.getElementById('b-price');
    const bRollsIn = document.getElementById('b-rolls');
    const bSheetsIn = document.getElementById('b-sheets');
    const bPlyIn = document.getElementById('b-ply');
    const sheetWIn = document.getElementById('sheet-w');
    const sheetLIn = document.getElementById('sheet-l');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateValue() {
        const ap = parseFloat(aPriceIn.value) || 0;
        const ar = parseInt(aRollsIn.value) || 0;
        const as = parseInt(aSheetsIn.value) || 0;
        const aply = parseInt(aPlyIn.value) || 2;

        const bp = parseFloat(bPriceIn.value) || 0;
        const br = parseInt(bRollsIn.value) || 0;
        const bs = parseInt(bSheetsIn.value) || 0;
        const bply = parseInt(bPlyIn.value) || 2;

        const sw = parseFloat(sheetWIn.value) || 4.0;
        const sl = parseFloat(sheetLIn.value) || 4.0;

        if (ap <= 0 || ar <= 0 || as <= 0 || bp <= 0 || br <= 0 || bs <= 0) {
            alert("Please enter valid prices, rolls, and sheets for both packages.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Roll Densities...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const sheetAreaSqFt = (sw * sl) / 144;

            // Pack A
            const aTotalSheets = ar * as;
            const aSqFt = aTotalSheets * sheetAreaSqFt;
            const aCost100 = (ap / aTotalSheets) * 100;
            const aCostSqFt = ap / aSqFt;

            // Pack B
            const bTotalSheets = br * bs;
            const bSqFt = bTotalSheets * sheetAreaSqFt;
            const bCost100 = (bp / bTotalSheets) * 100;
            const bCostSqFt = bp / bSqFt;

            // Render stats
            document.getElementById('out-a-totalsheets').innerText = aTotalSheets.toLocaleString();
            document.getElementById('out-a-sqft').innerText = aSqFt.toFixed(1) + " sq ft";
            document.getElementById('out-a-cost100').innerText = "$" + aCost100.toFixed(3);
            document.getElementById('out-a-costsqft').innerText = "$" + aCostSqFt.toFixed(4);

            document.getElementById('out-b-totalsheets').innerText = bTotalSheets.toLocaleString();
            document.getElementById('out-b-sqft').innerText = bSqFt.toFixed(1) + " sq ft";
            document.getElementById('out-b-cost100').innerText = "$" + bCost100.toFixed(3);
            document.getElementById('out-b-costsqft').innerText = "$" + bCostSqFt.toFixed(4);

            // Determine winner based on cost per square foot
            let winnerLabel = '';
            let savingsText = '';
            const banner = document.getElementById('winner-banner');
            const cardA = document.getElementById('card-pack-a');
            const cardB = document.getElementById('card-pack-b');

            cardA.style.borderColor = "#dee2e6";
            cardB.style.borderColor = "#dee2e6";

            if (aCostSqFt < bCostSqFt) {
                winnerLabel = "Package A is the Winner!";
                const pct = ((bCostSqFt - aCostSqFt) / bCostSqFt) * 100;
                savingsText = `Saves you ${pct.toFixed(1)}% per square foot!`;
                banner.className = "text-center mb-4 p-4 rounded-4 bg-primary text-white";
                cardA.style.borderColor = "#0d6efd";
            } else if (bCostSqFt < aCostSqFt) {
                winnerLabel = "Package B is the Winner!";
                const pct = ((aCostSqFt - bCostSqFt) / aCostSqFt) * 100;
                savingsText = `Saves you ${pct.toFixed(1)}% per square foot!`;
                banner.className = "text-center mb-4 p-4 rounded-4 bg-success text-white";
                cardB.style.borderColor = "#198754";
            } else {
                winnerLabel = "It's an Exact Tie!";
                savingsText = "Both packages offer identical cost per square foot.";
                banner.className = "text-center mb-4 p-4 rounded-4 bg-secondary text-white";
            }

            document.getElementById('result-winner-label').innerText = winnerLabel;
            document.getElementById('result-savings-pct').innerText = savingsText;
            document.getElementById('result-savings-pct').className = "fw-bold mb-0 h5 text-white";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-search-dollar me-2"></i> Compare Toilet Paper';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateValue);

    btnReset.addEventListener('click', () => {
        aPriceIn.value = 9.99;
        aRollsIn.value = 12;
        aSheetsIn.value = 220;
        aPlyIn.value = 2;
        bPriceIn.value = 14.99;
        bRollsIn.value = 8;
        bSheetsIn.value = 450;
        bPlyIn.value = 2;
        sheetWIn.value = 4.0;
        sheetLIn.value = 4.0;
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            aPriceIn.value = this.dataset.ap;
            aRollsIn.value = this.dataset.ar;
            aSheetsIn.value = this.dataset.as;
            aPlyIn.value = this.dataset.aply;
            bPriceIn.value = this.dataset.bp;
            bRollsIn.value = this.dataset.br;
            bSheetsIn.value = this.dataset.bs;
            bPlyIn.value = this.dataset.bply;
            calculateValue();
        });
    });

    btnCopy.addEventListener('click', function() {
        const winner = document.getElementById('result-winner-label').innerText;
        const savings = document.getElementById('result-savings-pct').innerText;
        
        const aSheets = document.getElementById('out-a-totalsheets').innerText;
        const aSq = document.getElementById('out-a-sqft').innerText;
        const a100 = document.getElementById('out-a-cost100').innerText;
        const aSqCost = document.getElementById('out-a-costsqft').innerText;

        const bSheets = document.getElementById('out-b-totalsheets').innerText;
        const bSq = document.getElementById('out-b-sqft').innerText;
        const b100 = document.getElementById('out-b-cost100').innerText;
        const bSqCost = document.getElementById('out-b-costsqft').innerText;

        const text = `TOILET PAPER VALUE COMPARISON REPORT\n` +
                     `====================================\n` +
                     `WINNER SUMMARY: ${winner}\n` +
                     `${savings}\n\n` +
                     `PACKAGE A STATISTICS:\n` +
                     `- Price: $${aPriceIn.value} (${aRollsIn.value} rolls, ${aSheetsIn.value} sheets, ${aPlyIn.value}-Ply)\n` +
                     `- Total Sheets: ${aSheets}\n` +
                     `- Total Area: ${aSq}\n` +
                     `- Cost / 100 Sheets: ${a100}\n` +
                     `- Cost / Sq Ft: ${aSqCost}\n\n` +
                     `PACKAGE B STATISTICS:\n` +
                     `- Price: $${bPriceIn.value} (${bRollsIn.value} rolls, ${bSheetsIn.value} sheets, ${bPlyIn.value}-Ply)\n` +
                     `- Total Sheets: ${bSheets}\n` +
                     `- Total Area: ${bSq}\n` +
                     `- Cost / 100 Sheets: ${b100}\n` +
                     `- Cost / Sq Ft: ${bSqCost}\n\n` +
                     `Generated via ToolsHub Toilet Paper Value Calculator.`;

        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Report!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
