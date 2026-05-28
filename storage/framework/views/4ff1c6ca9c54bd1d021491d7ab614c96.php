<div class="row g-4 pizza-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(217, 119, 6, 0.1); color: #d97706;">
                    <i class="fas fa-pizza-slice"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Pizza Dough Calculator</h4>
                    <p class="text-muted small m-0">Scale pizza dough batches and calculate exact component weights using professional baker's percentages.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Dough Balls</label>
                        <input type="number" id="pizza-qty" class="form-control form-control-lg rounded-3" value="4" min="1" max="100">
                        <span class="text-muted small mt-1 d-block">Number of pizzas</span>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Ball Weight (g)</label>
                        <input type="number" id="pizza-weight" class="form-control form-control-lg rounded-3" value="250" min="50" max="1000">
                        <span class="text-muted small mt-1 d-block">Neapolitan standard: 250g</span>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Hydration (%)</label>
                        <input type="number" id="pizza-hydration" class="form-control form-control-lg rounded-3" value="62" min="45" max="95" step="0.5">
                        <span class="text-muted small mt-1 d-block">Water-to-flour percentage</span>
                    </div>

                    
                    <div class="col-md-3">
                        <label class="form-label-custom">Yeast (%)</label>
                        <input type="number" id="pizza-yeast" class="form-control form-control-lg rounded-3" value="0.3" min="0.01" max="5" step="0.05">
                        <span class="text-muted small mt-1 d-block">Instant/Active Dry Yeast</span>
                    </div>
                </div>

                
                <div class="row g-3 mt-2">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Salt (%)</label>
                        <input type="number" id="pizza-salt" class="form-control form-control-lg rounded-3" value="2.8" min="0" max="5" step="0.1">
                        <span class="text-muted small mt-1 d-block">Gluten structure + flavor</span>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Olive Oil (%)</label>
                        <input type="number" id="pizza-oil" class="form-control form-control-lg rounded-3" value="0" min="0" max="10" step="0.5">
                        <span class="text-muted small mt-1 d-block">Adds crust tenderness (crispness)</span>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Sugar (%)</label>
                        <input type="number" id="pizza-sugar" class="form-control form-control-lg rounded-3" value="0" min="0" max="5" step="0.5">
                        <span class="text-muted small mt-1 d-block">Feeds yeast + encourages browning</span>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Pizza Styles:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 style-preset" data-qty="4" data-wt="250" data-hyd="60" data-yeast="0.2" data-salt="2.8" data-oil="0" data-sugar="0">🍕 Neapolitan (Woodfired)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 style-preset" data-qty="3" data-wt="280" data-hyd="65" data-yeast="0.4" data-salt="2.5" data-oil="2" data-sugar="1">🗽 New York (Home Oven)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 style-preset" data-qty="2" data-wt="400" data-hyd="70" data-yeast="0.5" data-salt="2.5" data-oil="2" data-sugar="0.5">🍳 Detroit Style (Pan)</button>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Calculate Dough</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="pizza-output-card" style="--tool-hue: 35; --tool-color: #d97706; --tool-bg: rgba(217, 119, 6, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Total Batch Weight</span>
                <div class="output-hero-value my-2 text-gradient" id="out-total-dough" style="font-size: 3rem; font-weight: 900;">1,000 g</div>
                <span class="output-hero-unit fs-5 fw-bold" id="out-dough-desc">4 balls at 250g each</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Flour Weight</span>
                        <span class="stat-card-value text-secondary" id="stat-flour">606 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Water Weight</span>
                        <span class="stat-card-value text-secondary" id="stat-water">376 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Salt Weight</span>
                        <span class="stat-card-value text-gradient" id="stat-salt">17.0 g</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Yeast Weight</span>
                        <span class="stat-card-value text-success" id="stat-yeast">1.8 g</span>
                    </div>
                </div>
            </div>

            
            <h6 class="fw-bold mt-4 mb-3 text-dark"><i class="fas fa-balance-scale me-2 text-warning"></i>Baker's Percentage Formula</h6>
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
                    <tbody id="out-dough-table">
                        
                    </tbody>
                </table>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Dough Blueprint
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const qtyInput = $('pizza-qty');
    const wtInput = $('pizza-weight');
    const hydInput = $('pizza-hydration');
    const yeastInput = $('pizza-yeast');
    const saltInput = $('pizza-salt');
    const oilInput = $('pizza-oil');
    const sugarInput = $('pizza-sugar');

    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Presets Action
    document.querySelectorAll('.style-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            qtyInput.value = this.getAttribute('data-qty');
            wtInput.value = this.getAttribute('data-wt');
            hydInput.value = this.getAttribute('data-hyd');
            yeastInput.value = this.getAttribute('data-yeast');
            saltInput.value = this.getAttribute('data-salt');
            oilInput.value = this.getAttribute('data-oil');
            sugarInput.value = this.getAttribute('data-sugar');
            calculate();
        });
    });

    function calculate() {
        const qty = Math.max(1, parseInt(qtyInput.value) || 0);
        const ballWt = Math.max(10, parseFloat(wtInput.value) || 0);
        const hyd = parseFloat(hydInput.value) || 0;
        const yeast = parseFloat(yeastInput.value) || 0;
        const salt = parseFloat(saltInput.value) || 0;
        const oil = parseFloat(oilInput.value) || 0;
        const sugar = parseFloat(sugarInput.value) || 0;

        const totalBatchWt = qty * ballWt;
        
        // Sum of all Baker's percentages relative to flour (100%)
        const totalPct = 100 + hyd + yeast + salt + oil + sugar;
        
        // Flour weight (g)
        const flourWt = (totalBatchWt / totalPct) * 100;
        
        // Calculate other ingredients
        const waterWt = flourWt * (hyd / 100);
        const yeastWt = flourWt * (yeast / 100);
        const saltWt = flourWt * (salt / 100);
        const oilWt = flourWt * (oil / 100);
        const sugarWt = flourWt * (sugar / 100);

        // Render to UI
        $('out-total-dough').textContent = Math.round(totalBatchWt).toLocaleString() + ' g';
        $('out-dough-desc').textContent = `${qty} ball${qty > 1 ? 's' : ''} at ${ballWt}g each`;

        $('stat-flour').textContent = Math.round(flourWt) + ' g';
        $('stat-water').textContent = Math.round(waterWt) + ' g';
        $('stat-salt').textContent = saltWt.toFixed(1) + ' g';
        $('stat-yeast').textContent = yeastWt.toFixed(1) + ' g';

        // Table generation
        const toOz = g => (g * 0.035274).toFixed(2);
        
        let tableRows = `
            <tr>
                <td class="text-start fw-bold text-dark">🌾 Bread Flour (100%)</td>
                <td>100.0%</td>
                <td><strong>${Math.round(flourWt)} g</strong></td>
                <td>${toOz(flourWt)} oz</td>
            </tr>
            <tr>
                <td class="text-start">💧 Water (Hydration)</td>
                <td>${hyd}%</td>
                <td><strong>${Math.round(waterWt)} g</strong></td>
                <td>${toOz(waterWt)} oz</td>
            </tr>
            <tr>
                <td class="text-start">🧂 Fine Sea Salt</td>
                <td>${salt}%</td>
                <td><strong>${saltWt.toFixed(1)} g</strong></td>
                <td>${toOz(saltWt)} oz</td>
            </tr>
            <tr>
                <td class="text-start">🍞 Dry Yeast</td>
                <td>${yeast}%</td>
                <td><strong>${yeastWt.toFixed(1)} g</strong></td>
                <td>${toOz(yeastWt)} oz</td>
            </tr>
        `;

        if (oil > 0) {
            tableRows += `
                <tr>
                    <td class="text-start">🫒 Extra Virgin Olive Oil</td>
                    <td>${oil}%</td>
                    <td><strong>${oilWt.toFixed(1)} g</strong></td>
                    <td>${toOz(oilWt)} oz</td>
                </tr>
            `;
        }

        if (sugar > 0) {
            tableRows += `
                <tr>
                    <td class="text-start">🍭 Fine Caster Sugar</td>
                    <td>${sugar}%</td>
                    <td><strong>${sugarWt.toFixed(1)} g</strong></td>
                    <td>${toOz(sugarWt)} oz</td>
                </tr>
            `;
        }

        $('out-dough-table').innerHTML = tableRows;


    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        qtyInput.value = 4;
        wtInput.value = 250;
        hydInput.value = 62;
        yeastInput.value = 0.3;
        saltInput.value = 2.8;
        oilInput.value = 0;
        sugarInput.value = 0;
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const text = `Artisan Pizza Dough Blueprint\n-----------------------------------\nDough Balls: ${qtyInput.value} at ${wtInput.value}g\nTotal Weight: ${$('out-total-dough').textContent}\n\nIngredient Weights:\nFlour: ${$('stat-flour').textContent}\nWater: ${$('stat-water').textContent}\nSalt: ${$('stat-salt').textContent}\nYeast: ${$('stat-yeast').textContent}\nOlive Oil: ${oilInput.value > 0 ? (flourWt*oilInput.value/100).toFixed(1)+' g' : 'None'}\nSugar: ${sugarInput.value > 0 ? (flourWt*sugarInput.value/100).toFixed(1)+' g' : 'None'}\n— ToolsHub Pizza Bakery`;
        
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
.pizza-calc-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.pizza-calc-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.pizza-calc-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.pizza-calc-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.pizza-calc-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.pizza-calc-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.pizza-calc-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.pizza-calc-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.pizza-calc-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(217, 119, 6, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(217, 119, 6, 0.02);
}
.pizza-calc-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.pizza-calc-rebuilt .text-gradient {
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.pizza-calc-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\pizza-dough-calculator.blade.php ENDPATH**/ ?>