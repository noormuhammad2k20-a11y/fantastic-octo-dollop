<div class="row g-4 sourdough-calc-rebuilt">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(180, 83, 9, 0.1); color: #b45309;">
                    <i class="fas fa-bread-slice"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Sourdough Calculator</h4>
                    <p class="text-muted small m-0">Formulate artisan sourdough recipes with exact component weights based on inoculation, hydration, and salt percentages.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    {{-- Calculation Mode --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Target Parameter</label>
                        <select id="sourdough-mode" class="form-select form-select-lg rounded-3">
                            <option value="dough" selected>🥣 Total Dough Weight (g)</option>
                            <option value="flour">🌾 Total Flour Weight (g)</option>
                        </select>
                        <span class="text-muted small mt-1 d-block">Base for baker's percentages</span>
                    </div>

                    {{-- Target Weight Input --}}
                    <div class="col-md-4">
                        <label class="form-label-custom" id="weight-label">Target Dough Weight (g)</label>
                        <div class="input-group">
                            <input type="number" id="sourdough-weight" class="form-control form-control-lg rounded-start-3" value="950" min="100" max="10000">
                            <span class="input-group-text bg-white rounded-end-3 text-muted">grams</span>
                        </div>
                        <span class="text-muted small mt-1 d-block" id="weight-desc">Standard loaf is ~950g</span>
                    </div>

                    {{-- Target Hydration --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Overall Hydration (%)</label>
                        <div class="input-group">
                            <input type="number" id="sourdough-hydration" class="form-control form-control-lg rounded-start-3" value="72" min="50" max="95" step="0.5">
                            <span class="input-group-text bg-white rounded-end-3 text-muted">%</span>
                        </div>
                        <span class="text-muted small mt-1 d-block">Total water-to-flour percentage</span>
                    </div>
                </div>

                {{-- Sourdough Specifics --}}
                <div class="row g-3 mt-3">
                    {{-- Starter Inoculation --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Starter Inoculation (%)</label>
                        <div class="input-group">
                            <input type="number" id="sourdough-inoc" class="form-control form-control-lg rounded-start-3" value="20" min="5" max="50">
                            <span class="input-group-text bg-white rounded-end-3 text-muted">%</span>
                        </div>
                        <span class="text-muted small mt-1 d-block">Active starter ratio (standard: 20%)</span>
                    </div>

                    {{-- Salt percentage --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Salt Percentage (%)</label>
                        <div class="input-group">
                            <input type="number" id="sourdough-salt" class="form-control form-control-lg rounded-start-3" value="2.0" min="0" max="5" step="0.1">
                            <span class="input-group-text bg-white rounded-end-3 text-muted">%</span>
                        </div>
                        <span class="text-muted small mt-1 d-block">Usually 2% for bread flavor</span>
                    </div>

                    {{-- Starter Hydration --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Starter Hydration (%)</label>
                        <div class="input-group">
                            <input type="number" id="sourdough-shyd" class="form-control form-control-lg rounded-start-3" value="100" min="50" max="200">
                            <span class="input-group-text bg-white rounded-end-3 text-muted">%</span>
                        </div>
                        <span class="text-muted small mt-1 d-block">Usually fed equal water and flour (100%)</span>
                    </div>
                </div>

                {{-- Quick Presets --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Loaves:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 boule-preset" data-mode="dough" data-wt="950" data-hyd="68" data-inoc="20" data-salt="2">🍞 Beginner's Boule (68%)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 boule-preset" data-mode="dough" data-wt="950" data-hyd="75" data-inoc="20" data-salt="2">🍞 Classic Country (75%)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 boule-preset" data-mode="dough" data-wt="950" data-hyd="80" data-inoc="15" data-salt="2">🍞 High Hydration (80%)</button>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Formulate Loaf</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Output Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="sourdough-output-card" style="--tool-hue: 28; --tool-color: #b45309; --tool-bg: rgba(180, 83, 9, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Formulated Dough Weights</span>
                <div class="output-hero-value my-2 text-gradient" id="out-total-weight" style="font-size: 3rem; font-weight: 900;">950 g</div>
                <span class="output-hero-unit fs-5 fw-bold" id="out-weight-desc">Ready to shape into 1 country boule</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Flour to Add</span>
                        <span class="stat-card-value text-secondary" id="stat-flour">522 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Water to Add</span>
                        <span class="stat-card-value text-secondary" id="stat-water">323 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Active Starter</span>
                        <span class="stat-card-value text-gradient" id="stat-starter">104 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Sea Salt</span>
                        <span class="stat-card-value text-success" id="stat-salt">10.4 g</span>
                    </div>
                </div>
            </div>

            {{-- baker percentage table --}}
            <h6 class="fw-bold mt-4 mb-3 text-dark"><i class="fas fa-balance-scale me-2 text-warning"></i>Baking Ingredient Blueprint</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered bg-white text-center small mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Ingredient</th>
                            <th>Baker's %</th>
                            <th>Exact Weight (g)</th>
                            <th>Weight (oz)</th>
                        </tr>
                    </thead>
                    <tbody id="out-sourdough-table">
                        {{-- Filled by JS --}}
                    </tbody>
                </table>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Sourdough Formula
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const sdMode = $('sourdough-mode');
    const sdWeight = $('sourdough-weight');
    const sdHyd = $('sourdough-hydration');
    const sdInoc = $('sourdough-inoc');
    const sdSalt = $('sourdough-salt');
    const sdShyd = $('sourdough-shyd');

    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Dynamic Labels based on Mode
    sdMode.addEventListener('change', function() {
        if (this.value === 'dough') {
            $('weight-label').textContent = 'Target Dough Weight (g)';
            $('weight-desc').textContent = 'Standard loaf is ~950g';
            sdWeight.value = 950;
        } else {
            $('weight-label').textContent = 'Target Flour Weight (g)';
            $('weight-desc').textContent = 'Yields approx. 1.7x total dough weight';
            sdWeight.value = 500;
        }
        calculate();
    });

    // Presets
    document.querySelectorAll('.boule-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            sdMode.value = btn.getAttribute('data-mode');
            sdMode.dispatchEvent(new Event('change'));
            sdWeight.value = btn.getAttribute('data-wt');
            sdHyd.value = btn.getAttribute('data-hyd');
            sdInoc.value = btn.getAttribute('data-inoc');
            sdSalt.value = btn.getAttribute('data-salt');
            sdShyd.value = 100;
            calculate();
        });
    });

    function calculate() {
        const mode = sdMode.value;
        const targetWt = parseFloat(sdWeight.value) || 0;
        const hyd = parseFloat(sdHyd.value) || 0;
        const inoc = parseFloat(sdInoc.value) || 0;
        const salt = parseFloat(sdSalt.value) || 0;
        const shyd = parseFloat(sdShyd.value) || 100;

        if (targetWt <= 0) return;

        let totalFlour = 0;
        let totalDough = 0;

        if (mode === 'flour') {
            totalFlour = targetWt;
            // Total dough weight = flour + water + starter + salt
            // Since starter is a percentage of total flour, water is hydration % of total flour...
            totalDough = totalFlour + (totalFlour * (hyd / 100)) + (totalFlour * (inoc / 100)) + (totalFlour * (salt / 100));
        } else {
            totalDough = targetWt;
            // Back-calculate total flour
            // Dough Weight = Flour (1.0) + Water (hyd/100) + Starter (inoc/100) + Salt (salt/100)
            const sumFactor = 1.0 + (hyd / 100) + (inoc / 100) + (salt / 100);
            totalFlour = totalDough / sumFactor;
        }

        const totalWater = totalFlour * (hyd / 100);
        const starterWeight = totalFlour * (inoc / 100);
        const saltWeight = totalFlour * (salt / 100);

        // Deconstruct Sourdough Starter weights based on starter hydration
        // Starter weight = Starter Flour + Starter Water
        // Starter Water = Starter Flour * (shyd / 100)
        // Starter Weight = Starter Flour * (1 + shyd / 100)
        const starterFlour = starterWeight / (1.0 + (shyd / 100));
        const starterWater = starterWeight - starterFlour;

        // Final ingredients to actually weigh into the bowl
        const recipeFlour = totalFlour - starterFlour;
        const recipeWater = totalWater - starterWater;

        // Render stats
        $('out-total-weight').textContent = Math.round(totalDough).toLocaleString() + ' g';
        $('out-weight-desc').textContent = mode === 'dough' ? `Resolved from target dough weight` : `Calculated from ${targetWt}g base flour`;

        $('stat-flour').textContent = Math.round(recipeFlour) + ' g';
        $('stat-water').textContent = Math.round(recipeWater) + ' g';
        $('stat-starter').textContent = Math.round(starterWeight) + ' g';
        $('stat-salt').textContent = saltWeight.toFixed(1) + ' g';

        // Table Rows
        const toOz = g => (g * 0.035274).toFixed(2);
        const tableBody = `
            <tr>
                <td class="text-start fw-bold text-dark">🌾 Bread Flour (White/Whole)</td>
                <td>${((recipeFlour / totalFlour) * 100).toFixed(1)}%</td>
                <td><strong>${Math.round(recipeFlour)} g</strong></td>
                <td>${toOz(recipeFlour)} oz</td>
            </tr>
            <tr>
                <td class="text-start">💧 Filtered Water</td>
                <td>${((recipeWater / totalFlour) * 100).toFixed(1)}%</td>
                <td><strong>${Math.round(recipeWater)} g</strong></td>
                <td>${toOz(recipeWater)} oz</td>
            </tr>
            <tr>
                <td class="text-start">🧪 Active Starter (${shyd}% Hyd)</td>
                <td>${inoc}%</td>
                <td><strong>${Math.round(starterWeight)} g</strong></td>
                <td>${toOz(starterWeight)} oz</td>
            </tr>
            <tr>
                <td class="text-start">🧂 Fine Sea Salt</td>
                <td>${salt}%</td>
                <td><strong>${saltWeight.toFixed(1)} g</strong></td>
                <td>${toOz(saltWeight)} oz</td>
            </tr>
            <tr class="table-light fw-bold text-dark">
                <td class="text-start">✨ Total Recipe Batch</td>
                <td>${(100 + hyd + inoc + salt).toFixed(1)}%</td>
                <td><strong>${Math.round(totalDough)} g</strong></td>
                <td>${toOz(totalDough)} oz</td>
            </tr>
        `;
        $('out-sourdough-table').innerHTML = tableBody;


    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        sdMode.value = 'dough';
        sdMode.dispatchEvent(new Event('change'));
        sdWeight.value = 950;
        sdHyd.value = 72;
        sdInoc.value = 20;
        sdSalt.value = 2.0;
        sdShyd.value = 100;
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const text = `Artisan Sourdough Recipe Blueprint\n-----------------------------------\nTarget Dough Weight: ${$('out-total-weight').textContent}\nOverall Hydration: ${sdHyd.value}%\nStarter Inoculation: ${sdInoc.value}%\n\nBowl Assembly (Grams):\nBread Flour: ${$('stat-flour').textContent}\nWater: ${$('stat-water').textContent}\nActive Starter: ${$('stat-starter').textContent}\nSea Salt: ${$('stat-salt').textContent}\n\n— ToolsHub Sourdough Bakery`;
        
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
.sourdough-calc-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.sourdough-calc-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.sourdough-calc-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.sourdough-calc-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.sourdough-calc-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.sourdough-calc-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.sourdough-calc-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.sourdough-calc-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.sourdough-calc-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(180, 83, 9, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(180, 83, 9, 0.02);
}
.sourdough-calc-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.sourdough-calc-rebuilt .text-gradient {
    background: linear-gradient(135deg, #b45309 0%, #d97706 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.sourdough-calc-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
</style>
