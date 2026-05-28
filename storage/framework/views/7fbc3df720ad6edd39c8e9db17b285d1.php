<div class="row g-4 cheese-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                    <i class="fas fa-cheese"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Cheese Board Calculator</h4>
                    <p class="text-muted small m-0">Plan the perfect catering or charcuterie board with precise ingredient weights based on guest count, course type, and dietary needs.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Guests</label>
                        <div class="input-group">
                            <input type="number" id="guests-count" class="form-control form-control-lg rounded-start-3" value="8" min="1" max="500">
                            <span class="input-group-text bg-white rounded-end-3 text-muted"><i class="fas fa-users"></i></span>
                        </div>
                        <span class="text-muted small mt-1 d-block">Total attendees</span>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Course Type / Portion</label>
                        <select id="course-type" class="form-select form-select-lg rounded-3">
                            <option value="appetizer" selected>🍇 Appetizer / Cocktail Hour</option>
                            <option value="main">🧀 Main Event / Heavy Platter</option>
                        </select>
                        <span class="text-muted small mt-1 d-block">Adjusts weight per person</span>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Dietary Restriction</label>
                        <select id="dietary-pref" class="form-select form-select-lg rounded-3">
                            <option value="none" selected>Standard (All Ingredients)</option>
                            <option value="veg">Vegetarian (No Charcuterie Meats)</option>
                            <option value="gf">Gluten-Free (No Gluten Starches)</option>
                            <option value="nutfree">Nut-Free (No Tree Nuts/Peanuts)</option>
                        </select>
                        <span class="text-muted small mt-1 d-block">Customizes ingredient pairing recommendations</span>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Gatherings:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 guest-preset" data-guests="2" data-course="appetizer">💑 Intimate Date (2)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 guest-preset" data-guests="6" data-course="appetizer">🍷 Small Dinner (6)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 guest-preset" data-guests="12" data-course="main">🎉 Party Platter (12)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 guest-preset" data-guests="30" data-course="appetizer">🏢 Large Gala (30)</button>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Calculate Platter</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="cheese-output-card" style="--tool-hue: 38; --tool-color: #f59e0b; --tool-bg: rgba(245, 158, 11, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Total Estimated Board Weight</span>
                <div class="output-hero-value my-2 text-gradient" id="out-total-weight" style="font-size: 3rem; font-weight: 900;">2.4 lbs</div>
                <span class="output-hero-unit fs-5 fw-bold" id="out-weight-desc">Recommended for 8 guests</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Hard & Soft Cheese</span>
                        <span class="stat-card-value text-secondary" id="stat-cheese">1.0 lbs (454 g)</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label" id="stat-lbl-meat">Charcuterie Meats</span>
                        <span class="stat-card-value text-secondary" id="stat-meat">0.75 lbs (340 g)</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Crackers & Breads</span>
                        <span class="stat-card-value text-gradient" id="stat-starch">0.5 lbs (227 g)</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Fruits & Accompaniments</span>
                        <span class="stat-card-value text-success" id="stat-sides">0.8 lbs (363 g)</span>
                    </div>
                </div>
            </div>

            
            <h6 class="fw-bold mt-4 mb-3 text-dark"><i class="fas fa-utensils me-2 text-warning"></i>Caterer Pairing Blueprint</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered bg-white text-center small mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Category</th>
                            <th>Recommended Ingredients</th>
                            <th>Target Weight / Serving</th>
                        </tr>
                    </thead>
                    <tbody id="out-pairing-table">
                        
                    </tbody>
                </table>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Platter Checklist
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const guestsInput = $('guests-count');
    const courseType = $('course-type');
    const dietaryPref = $('dietary-pref');
    
    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Presets
    document.querySelectorAll('.guest-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            guestsInput.value = this.getAttribute('data-guests');
            courseType.value = this.getAttribute('data-course');
            calculate();
        });
    });

    function calculate() {
        const guests = Math.max(1, parseInt(guestsInput.value) || 0);
        const course = courseType.value;
        const diet = dietaryPref.value;

        // portion factors (ounces per person)
        let cheeseOz = (course === 'appetizer') ? 2 : 4;
        let meatOz = (course === 'appetizer') ? 1.5 : 3;
        let starchOz = 1.5;
        let sidesOz = 2;

        if (diet === 'veg') {
            // Transfer meat portion to cheese & sides
            cheeseOz += meatOz * 0.4;
            sidesOz += meatOz * 0.6;
            meatOz = 0;
        }

        // calculations (in ounces)
        const totalCheese = cheeseOz * guests;
        const totalMeat = meatOz * guests;
        const totalStarch = starchOz * guests;
        const totalSides = sidesOz * guests;
        const totalBoardOz = totalCheese + totalMeat + totalStarch + totalSides;

        // convert to pounds and grams
        const toLbs = oz => (oz / 16).toFixed(1);
        const toGrams = oz => Math.round(oz * 28.3495);

        // Update UI stats
        $('out-total-weight').textContent = toLbs(totalBoardOz) + ' lbs';
        $('out-weight-desc').textContent = `Total recommended for ${guests} guest${guests > 1 ? 's' : ''}`;

        $('stat-cheese').textContent = `${toLbs(totalCheese)} lbs (${toGrams(totalCheese)} g)`;
        
        if (diet === 'veg') {
            $('stat-lbl-meat').textContent = 'Spreads & Hummus';
            $('stat-meat').textContent = `${toLbs(totalSides * 0.4)} lbs (${toGrams(totalSides * 0.4)} g)`;
        } else {
            $('stat-lbl-meat').textContent = 'Charcuterie Meats';
            $('stat-meat').textContent = `${toLbs(totalMeat)} lbs (${toGrams(totalMeat)} g)`;
        }

        $('stat-starch').textContent = `${toLbs(totalStarch)} lbs (${toGrams(totalStarch)} g)`;
        $('stat-sides').textContent = `${toLbs(totalSides)} lbs (${toGrams(totalSides)} g)`;

        // Pairings Table Assembly
        let cheesePairings = 'Brie, Manchego, Aged Cheddar';
        if (guests >= 8) cheesePairings = 'Brie, Manchego, Sharp White Cheddar, Gorgonzola, Goat Cheese';
        else if (guests >= 4) cheesePairings = 'Double Cream Brie, Manchego, Sharp White Cheddar, Creamy Goat Cheese';

        let meatPairings = 'Prosciutto di Parma, Genoa Salami, Sopressata';
        if (diet === 'veg') {
            meatPairings = 'Gourmet Red Pepper Hummus, Olive Tapenade, Artichoke Spread';
        } else if (guests >= 8) {
            meatPairings = 'Prosciutto, Genoa Salami, Spicy Capicola, Spanish Chorizo';
        }

        let starchPairings = 'Artisanal Crackers, Sliced Sourdough Baguette';
        if (diet === 'gf') {
            starchPairings = 'Gluten-Free Seed Crackers, Rosemary Rice Crackers, GF Crostini';
        }

        let sidesPairings = 'Fresh Grapes, Strawberries, Honeycomb, Mixed Tree Nuts';
        if (diet === 'nutfree') {
            sidesPairings = 'Fresh Grapes, Strawberries, Dried Apricots, Fig Jam, Olives';
        }

        const tableBody = `
            <tr>
                <td class="fw-bold text-warning text-uppercase small">Artisanal Cheeses</td>
                <td class="text-start">${cheesePairings}</td>
                <td><strong>${toGrams(totalCheese)} g</strong> (${toLbs(totalCheese)} lbs)</td>
            </tr>
            <tr>
                <td class="fw-bold text-danger text-uppercase small">${diet === 'veg' ? 'Gourmet Spreads' : 'Charcuterie Meats'}</td>
                <td class="text-start">${meatPairings}</td>
                <td><strong>${diet === 'veg' ? toGrams(totalSides * 0.4) : toGrams(totalMeat)} g</strong> (${diet === 'veg' ? toLbs(totalSides * 0.4) : toLbs(totalMeat)} lbs)</td>
            </tr>
            <tr>
                <td class="fw-bold text-primary text-uppercase small">Starches & Breads</td>
                <td class="text-start">${starchPairings}</td>
                <td><strong>${toGrams(totalStarch)} g</strong> (${toLbs(totalStarch)} lbs)</td>
            </tr>
            <tr>
                <td class="fw-bold text-success text-uppercase small">Accompaniments</td>
                <td class="text-start">${sidesPairings}</td>
                <td><strong>${toGrams(totalSides)} g</strong> (${toLbs(totalSides)} lbs)</td>
            </tr>
        `;
        $('out-pairing-table').innerHTML = tableBody;

    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        guestsInput.value = 8;
        courseType.value = 'appetizer';
        dietaryPref.value = 'none';
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        const dText = dietaryPref.options[dietaryPref.selectedIndex].text;
        const cText = courseType.options[courseType.selectedIndex].text;
        const text = `Cheese Board Planner Report\n-----------------------------------\nGuests: ${guestsInput.value}\nStyle: ${cText} (${dText})\nTotal Board Weight: ${$('out-total-weight').textContent}\nCheese Weight: ${$('stat-cheese').textContent}\nMeat/Spread Weight: ${$('stat-meat').textContent}\nStarches: ${$('stat-starch').textContent}\nAccompaniments: ${$('stat-sides').textContent}\n— ToolsHub Catering Planner`;
        
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
.cheese-calc-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.cheese-calc-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.cheese-calc-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.cheese-calc-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.cheese-calc-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.cheese-calc-rebuilt .stat-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
}
.cheese-calc-rebuilt .stat-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.25rem;
}
.cheese-calc-rebuilt .stat-card-value {
    font-size: 1.1rem;
    font-weight: 800;
    display: block;
}
.cheese-calc-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(245, 158, 11, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(245, 158, 11, 0.02);
}
.cheese-calc-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.cheese-calc-rebuilt .text-gradient {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.cheese-calc-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cheese-board-calculator.blade.php ENDPATH**/ ?>