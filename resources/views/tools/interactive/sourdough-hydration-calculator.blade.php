<div class="row g-4 sourdough-hydration-rebuilt">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(217, 119, 6, 0.1); color: #d97706;">
                    <i class="fas fa-microscope"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Sourdough Hydration Calculator</h4>
                    <p class="text-muted small m-0">Analyze the absolute true hydration ratio of your baking dough by accounting for water/flour contents of starters, milk, fats, and eggs.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    {{-- Recipe Flour weight --}}
                    <div class="col-md-3">
                        <label class="form-label-custom">Main Flour Weight (g)</label>
                        <input type="number" id="main-flour" class="form-control form-control-lg rounded-3" value="500" min="10" max="20000">
                        <span class="text-muted small mt-1 d-block">Weight of flour in bowl</span>
                    </div>

                    {{-- Recipe Water weight --}}
                    <div class="col-md-3">
                        <label class="form-label-custom">Main Water Weight (g)</label>
                        <input type="number" id="main-water" class="form-control form-control-lg rounded-3" value="350" min="0" max="20000">
                        <span class="text-muted small mt-1 d-block">Weight of added water</span>
                    </div>

                    {{-- Sourdough Starter weight --}}
                    <div class="col-md-3">
                        <label class="form-label-custom">Sourdough Starter (g)</label>
                        <input type="number" id="starter-wt" class="form-control form-control-lg rounded-3" value="100" min="0" max="5000">
                        <span class="text-muted small mt-1 d-block">Weight of active starter added</span>
                    </div>

                    {{-- Starter Hydration --}}
                    <div class="col-md-3">
                        <label class="form-label-custom">Starter Hydration (%)</label>
                        <input type="number" id="starter-hyd" class="form-control form-control-lg rounded-3" value="100" min="50" max="200">
                        <span class="text-muted small mt-1 d-block">Standard fed: 100%</span>
                    </div>
                </div>

                {{-- Enrichment & Liquids (Advanced Panel) --}}
                <h6 class="fw-bold text-dark mt-4 mb-3"><i class="fas fa-cookie-bite text-warning me-2"></i>Liquid & Fat Enrichments (Optional)</h6>
                <div class="row g-3">
                    {{-- Milk weight --}}
                    <div class="col-md-3">
                        <label class="form-label-custom">Whole Milk (g)</label>
                        <input type="number" id="milk-wt" class="form-control form-control-lg rounded-3" value="0" min="0" max="5000">
                        <span class="text-muted small mt-1 d-block">Calculated at 87% water</span>
                    </div>

                    {{-- Eggs weight --}}
                    <div class="col-md-3">
                        <label class="form-label-custom">Whole Eggs (g)</label>
                        <input type="number" id="eggs-wt" class="form-control form-control-lg rounded-3" value="0" min="0" max="2000">
                        <span class="text-muted small mt-1 d-block">Calculated at 74% water</span>
                    </div>

                    {{-- Butter weight --}}
                    <div class="col-md-3">
                        <label class="form-label-custom">Butter (g)</label>
                        <input type="number" id="butter-wt" class="form-control form-control-lg rounded-3" value="0" min="0" max="2000">
                        <span class="text-muted small mt-1 d-block">Calculated at 16% water</span>
                    </div>

                    {{-- Olive Oil / Oil weight --}}
                    <div class="col-md-3">
                        <label class="form-label-custom">Olive Oil / Fats (g)</label>
                        <input type="number" id="oil-wt" class="form-control form-control-lg rounded-3" value="0" min="0" max="2000">
                        <span class="text-muted small mt-1 d-block">Pure fat (0% water contribution)</span>
                    </div>
                </div>

                {{-- Presets --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Baking Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 preset-btn" data-flour="500" data-water="350" data-starter="100" data-shyd="100" data-milk="0" data-eggs="0" data-butter="0" data-oil="0">🍞 Classic Country Boule (72.5%)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 preset-btn" data-flour="500" data-water="390" data-starter="150" data-shyd="100" data-milk="0" data-eggs="0" data-butter="0" data-oil="10">🥖 High-Hydration Ciabatta (80.9%)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 preset-btn" data-flour="500" data-water="60" data-starter="100" data-shyd="100" data-milk="0" data-eggs="200" data-butter="120" data-oil="0">🥐 Rich Brioche (64.8%)</button>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Analyze Hydration</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Output Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="sourdough-output-card" style="--tool-hue: 28; --tool-color: #d97706; --tool-bg: rgba(217, 119, 6, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Resolved True Hydration</span>
                <div class="output-hero-value my-2 text-gradient" id="out-true-hyd" style="font-size: 3rem; font-weight: 900;">72.7 %</div>
                <span class="badge bg-warning text-dark fs-6 px-3 py-2 fw-bold" id="out-hyd-category">Medium-High Hydration</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Absolute Total Flour</span>
                        <span class="stat-card-value text-secondary" id="stat-total-flour">550 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Absolute Total Liquid</span>
                        <span class="stat-card-value text-secondary" id="stat-total-liquid">400 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Starter Water Contribution</span>
                        <span class="stat-card-value text-gradient" id="stat-starter-water">50 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Total Dough Batch Weight</span>
                        <span class="stat-card-value text-success" id="stat-total-batch">950 g</span>
                    </div>
                </div>
            </div>

            {{-- detailed component weight table --}}
            <h6 class="fw-bold mt-4 mb-3 text-dark"><i class="fas fa-list-ul me-2 text-warning"></i>Thermodynamic Moisture Contributions</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered bg-white text-center small mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Ingredient Component</th>
                            <th>Total Mass</th>
                            <th>Water Contribution</th>
                            <th>Flour Contribution</th>
                            <th>Pure Fats / Solids</th>
                        </tr>
                    </thead>
                    <tbody id="out-hydration-table">
                        {{-- Filled by JS --}}
                    </tbody>
                </table>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Hydration Audit
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const mainFlour = $('main-flour');
    const mainWater = $('main-water');
    const starterWt = $('starter-wt');
    const starterHyd = $('starter-hyd');

    // Enrichment Inputs
    const milkWt = $('milk-wt');
    const eggsWt = $('eggs-wt');
    const butterWt = $('butter-wt');
    const oilWt = $('oil-wt');

    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Presets Action
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            mainFlour.value = this.getAttribute('data-flour');
            mainWater.value = this.getAttribute('data-water');
            starterWt.value = this.getAttribute('data-starter');
            starterHyd.value = this.getAttribute('data-shyd');
            milkWt.value = this.getAttribute('data-milk');
            eggsWt.value = this.getAttribute('data-eggs');
            butterWt.value = this.getAttribute('data-butter');
            oilWt.value = this.getAttribute('data-oil');
            calculate();
        });
    });

    function calculate() {
        const fRecipe = parseFloat(mainFlour.value) || 0;
        const wRecipe = parseFloat(mainWater.value) || 0;
        const sWt = parseFloat(starterWt.value) || 0;
        const sHyd = parseFloat(starterHyd.value) || 100;

        const milk = parseFloat(milkWt.value) || 0;
        const eggs = parseFloat(eggsWt.value) || 0;
        const butter = parseFloat(butterWt.value) || 0;
        const oil = parseFloat(oilWt.value) || 0;

        if (fRecipe <= 0) return;

        // Starter deconstruction
        const sFlour = sWt / (1.0 + (sHyd / 100));
        const sWater = sWt - sFlour;

        // Enrichment water yields
        const milkWater = milk * 0.87;
        const milkSolids = milk - milkWater;

        const eggsWater = eggs * 0.74;
        const eggsSolids = eggs - eggsWater;

        const butterWater = butter * 0.16;
        const butterFats = butter * 0.82; // standard butter is ~82% fat, 2% solids
        const butterSolids = butter - butterWater - butterFats;

        // Absolute true counts
        const absoluteFlour = fRecipe + sFlour;
        const absoluteWater = wRecipe + sWater + milkWater + eggsWater + butterWater;
        const trueHydration = (absoluteWater / absoluteFlour) * 100;
        const totalBatchWt = fRecipe + wRecipe + sWt + milk + eggs + butter + oil;

        // Render stats
        $('out-true-hyd').textContent = trueHydration.toFixed(1) + ' %';
        $('stat-total-flour').textContent = Math.round(absoluteFlour) + ' g';
        $('stat-total-liquid').textContent = Math.round(absoluteWater) + ' g';
        $('stat-starter-water').textContent = Math.round(sWater) + ' g';
        $('stat-total-batch').textContent = Math.round(totalBatchWt) + ' g';

        // Categorize Hydration
        let category = 'Standard (65% – 72%)';
        let alertClass = 'bg-warning';
        let description = 'Moderate water level. The perfect sweet spot for country sourdoughs and standard loaves. Easy to handle and shape.';

        if (trueHydration < 60) {
            category = 'Stiff / Low Hydration (< 60%)';
            description = 'Very dry and firm. Perfect for bagels, pretzels, or standard sandwich bread. Slower fermentation but highly structured dough.';
        } else if (trueHydration >= 60 && trueHydration < 70) {
            category = 'Medium Hydration (60% – 70%)';
            description = 'Comfortable moisture levels. Exceptionally easy to knead, robust oven spring, tight regular cell structure.';
        } else if (trueHydration >= 70 && trueHydration < 80) {
            category = 'High Hydration (70% – 80%)';
            description = 'Wet and sticky dough. Ideal for professional artisan boules, baguettes, and country sourdough. Yields a highly open, beautiful lace-like crumb structure.';
        } else {
            category = 'Super-Wet / Focaccia Hydration (> 80%)';
            description = 'Very wet/slurry dough. Perfect for ciabatta, pan focaccia, and open slab breads. Requires coil folds or stand mixer kneading. Excellent crispness.';
        }

        $('out-hyd-category').textContent = category;

        // Build Details Table
        let tableRows = `
            <tr>
                <td class="text-start fw-bold">🌾 Main Recipe Flour</td>
                <td>${fRecipe}g</td>
                <td>-</td>
                <td>${fRecipe}g</td>
                <td>-</td>
            </tr>
            <tr>
                <td class="text-start fw-bold">💧 Main Recipe Water</td>
                <td>${wRecipe}g</td>
                <td>${wRecipe}g</td>
                <td>-</td>
                <td>-</td>
            </tr>
        `;

        if (sWt > 0) {
            tableRows += `
                <tr>
                    <td class="text-start">🧪 Active Starter (${sHyd}% Hyd)</td>
                    <td>${sWt}g</td>
                    <td class="text-success fw-semibold">+${Math.round(sWater)}g</td>
                    <td class="text-primary fw-semibold">+${Math.round(sFlour)}g</td>
                    <td>-</td>
                </tr>
            `;
        }

        if (milk > 0) {
            tableRows += `
                <tr>
                    <td class="text-start">🥛 Whole Milk (87% Water)</td>
                    <td>${milk}g</td>
                    <td class="text-success fw-semibold">+${Math.round(milkWater)}g</td>
                    <td>-</td>
                    <td>${Math.round(milkSolids)}g (Solids)</td>
                </tr>
            `;
        }

        if (eggs > 0) {
            tableRows += `
                <tr>
                    <td class="text-start">🥚 Whole Eggs (74% Water)</td>
                    <td>${eggs}g</td>
                    <td class="text-success fw-semibold">+${Math.round(eggsWater)}g</td>
                    <td>-</td>
                    <td>${Math.round(eggsSolids)}g (Solids)</td>
                </tr>
            `;
        }

        if (butter > 0) {
            tableRows += `
                <tr>
                    <td class="text-start">🧈 Salted/Unsalted Butter</td>
                    <td>${butter}g</td>
                    <td class="text-success fw-semibold">+${Math.round(butterWater)}g</td>
                    <td>-</td>
                    <td>${Math.round(butterFats)}g (Fats/Solids)</td>
                </tr>
            `;
        }

        if (oil > 0) {
            tableRows += `
                <tr>
                    <td class="text-start">🫒 Olive Oil (0% Water)</td>
                    <td>${oil}g</td>
                    <td>-</td>
                    <td>-</td>
                    <td>${oil}g (Pure Fat)</td>
                </tr>
            `;
        }

        tableRows += `
            <tr class="table-light fw-bold">
                <td class="text-start text-dark">✨ Cumulative Yield</td>
                <td>${Math.round(totalBatchWt)}g</td>
                <td class="text-success">${Math.round(absoluteWater)}g</td>
                <td class="text-primary">${Math.round(absoluteFlour)}g</td>
                <td>${Math.round(milkSolids + eggsSolids + butterFats + butterSolids + oil)}g</td>
            </tr>
        `;

        $('out-hydration-table').innerHTML = tableRows;


    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        mainFlour.value = 500;
        mainWater.value = 350;
        starterWt.value = 100;
        starterHyd.value = 100;
        milkWt.value = 0;
        eggsWt.value = 0;
        butterWt.value = 0;
        oilWt.value = 0;
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const text = `Sourdough True Hydration Audit\n-----------------------------------\nTrue Hydration: ${$('out-true-hyd').textContent}\nCategory: ${$('out-hyd-category').textContent}\nTotal Flour Mass: ${$('stat-total-flour').textContent}\nTotal Liquid Water Mass: ${$('stat-total-liquid').textContent}\nTotal Batch Weight: ${$('stat-total-batch').textContent}\n\nRecipe Formula (Grams):\nFlour in Recipe: ${mainFlour.value}g\nWater in Recipe: ${mainWater.value}g\nStarter added: ${starterWt.value}g @ ${starterHyd.value}%\nMilk added: ${milkWt.value}g\nEggs: ${eggsWt.value}g\nButter: ${butterWt.value}g\nOil/Fats: ${oilWt.value}g\n— Analyzed via ToolsHub Baker Lab`;
        
        navigator.clipboard.writeText(text).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = orig, 2000);
        });
    });

    // Run initially
    calculate();
});
</script>

<style>
.sourdough-hydration-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.sourdough-hydration-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.sourdough-hydration-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.sourdough-hydration-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.sourdough-hydration-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.sourdough-hydration-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.sourdough-hydration-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.sourdough-hydration-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.sourdough-hydration-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(217, 119, 6, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(217, 119, 6, 0.02);
}
.sourdough-hydration-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.sourdough-hydration-rebuilt .text-gradient {
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.sourdough-hydration-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
</style>
