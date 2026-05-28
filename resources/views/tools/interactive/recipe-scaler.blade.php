<div class="row g-4 recipe-scaler-rebuilt">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card p-4 p-md-5">
            <div class="calculator-header d-flex align-items-center gap-3 mb-4">
                <div class="tool-icon-circle" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                    <i class="fas fa-expand-alt"></i>
                </div>
                <div>
                    <h4 class="m-0 fw-bold text-dark">Recipe Scaler</h4>
                    <p class="text-muted small m-0">Scale recipe ingredients up or down using a simple decimal multiplier or fraction factor.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-3">
                    {{-- Scaling Factor --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Scaling Multiplier</label>
                        <div class="input-group">
                            <input type="number" id="scale-factor" class="form-control form-control-lg rounded-start-3" value="2" min="0.01" max="100" step="0.05">
                            <select id="scale-quick-select" class="form-select form-select-lg rounded-end-3" style="max-width: 140px;">
                                <option value="custom" selected>Custom</option>
                                <option value="0.5">Halve (0.5x)</option>
                                <option value="1.5">1.5x Batch</option>
                                <option value="2.0">Double (2x)</option>
                                <option value="3.0">Triple (3x)</option>
                                <option value="4.0">Quadruple (4x)</option>
                            </select>
                        </div>
                        <span class="text-muted small mt-1 d-block">Multiply ingredients by this number</span>
                    </div>

                    {{-- Ingredients list --}}
                    <div class="col-md-8">
                        <label class="form-label-custom">Ingredients List (One per line)</label>
                        <textarea id="ingredients-input" class="form-control rounded-3" rows="6" placeholder="e.g.&#10;2 cups of flour&#10;1 1/2 tsp baking powder&#10;1/2 cup butter&#10;2 large eggs&#10;1.5 cups whole milk"></textarea>
                        <span class="text-muted small mt-1 d-block">Supports integers (2), decimals (1.5), and fractions (1/2, 1 1/2)</span>
                    </div>
                </div>

                {{-- Quick Presets --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-history text-warning me-1"></i>Recipes:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 recipe-preset" data-recipe="pancakes">🥞 Fluffy Pancakes (Serves 4)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 recipe-preset" data-recipe="cookies">🍪 Chocolate Chip Cookies (24 count)</button>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="button" id="btn-calc" class="btn btn-primary rounded-3 px-4 py-2"><i class="fas fa-calculator me-2"></i>Scale Recipe</button>
                    <button type="button" id="btn-reset" class="btn btn-light border rounded-3 px-3 py-2 text-secondary"><i class="fas fa-redo-alt me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Output Card --}}
    <div class="col-lg-12">
        <div class="output-card-themed p-4 p-md-5" id="recipe-output-card" style="--tool-hue: 150; --tool-color: #10b981; --tool-bg: rgba(16, 185, 129, 0.03); transition: all 0.4s;">
            <div class="output-hero text-center py-3">
                <span class="output-hero-label text-uppercase fw-bold letter-spacing-wide small opacity-75">Scaled Ingredients List</span>
                <div class="output-hero-value my-2 text-gradient" id="out-scale-title" style="font-size: 2.2rem; font-weight: 900;">2.0x Scaled Batch</div>
                <span class="output-hero-unit fs-6 fw-bold" id="out-scale-desc">All quantities multiplied by exactly 2</span>
            </div>

            <div class="row g-4 mt-3">
                {{-- Left: Original list --}}
                <div class="col-md-6 border-end-md pr-md-4">
                    <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-history me-2 text-muted"></i>Original Ingredients</h6>
                    <ul class="list-group list-group-flush small" id="out-original-list">
                        {{-- Filled by JS --}}
                    </ul>
                </div>

                {{-- Right: Scaled list --}}
                <div class="col-md-6">
                    <h6 class="fw-bold text-success mb-3"><i class="fas fa-expand-arrows-alt me-2"></i>Scaled Ingredients</h6>
                    <ul class="list-group list-group-flush small" id="out-scaled-list">
                        {{-- Filled by JS --}}
                    </ul>
                </div>
            </div>



            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Scaled Recipe
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const scaleInput = $('scale-factor');
    const scaleSelect = $('scale-quick-select');
    const ingredientsInput = $('ingredients-input');

    const btnCalc = $('btn-calc');
    const btnReset = $('btn-reset');
    const btnCopy = $('btn-copy-report');

    // Sync input with select
    scaleSelect.addEventListener('change', function() {
        if (this.value !== 'custom') {
            scaleInput.value = this.value;
            calculate();
        }
    });

    scaleInput.addEventListener('input', function() {
        scaleSelect.value = 'custom';
    });

    // Recipes Presets
    const recipesMap = {
        pancakes: `2 cups all-purpose flour
2 tsp baking powder
1/2 tsp sea salt
2 tbsp caster sugar
1.5 cups whole milk
1 large egg
4 tbsp unsalted butter (melted)`,
        cookies: `2.25 cups all-purpose flour
1 tsp baking soda
1 tsp fine salt
1 cup butter (softened)
0.75 cup brown sugar
0.75 cup white granulated sugar
2 large eggs
2 cups semi-sweet chocolate chips`
    };

    document.querySelectorAll('.recipe-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            ingredientsInput.value = recipesMap[this.getAttribute('data-recipe')];
            calculate();
        });
    });

    // Advanced Parser for quantities
    // Match fractions like 1 1/2, 1/2, or decimals like 1.5, or integers
    function parseQuantity(str) {
        // Trim whitespace
        str = str.trim();
        if (!str) return null;

        // Check for fractions with whole number: "1 1/2" or "2 3/4"
        const wholeFractionMatch = str.match(/^(\d+)\s+(\d+)\/(\d+)$/);
        if (wholeFractionMatch) {
            const whole = parseInt(wholeFractionMatch[1]);
            const num = parseInt(wholeFractionMatch[2]);
            const den = parseInt(wholeFractionMatch[3]);
            return whole + (num / den);
        }

        // Check for simple fraction: "1/2"
        const fractionMatch = str.match(/^(\d+)\/(\d+)$/);
        if (fractionMatch) {
            const num = parseInt(fractionMatch[1]);
            const den = parseInt(fractionMatch[2]);
            return num / den;
        }

        // Decimal or Integer: "1.5" or "2"
        const numMatch = str.match(/^(\d*(?:\.\d+)?)$/);
        if (numMatch && numMatch[1]) {
            return parseFloat(numMatch[1]);
        }

        return null;
    }

    // Convert decimal back to fraction or clean decimal representation
    function formatScaled(val) {
        if (val % 1 === 0) return val.toString(); // integer
        
        // Check for common fractional parts
        const decimal = val % 1;
        const whole = Math.floor(val);
        
        let fractionStr = '';
        if (Math.abs(decimal - 0.5) < 0.05) fractionStr = '1/2';
        else if (Math.abs(decimal - 0.25) < 0.05) fractionStr = '1/4';
        else if (Math.abs(decimal - 0.75) < 0.05) fractionStr = '3/4';
        else if (Math.abs(decimal - 0.33) < 0.05) fractionStr = '1/3';
        else if (Math.abs(decimal - 0.66) < 0.05) fractionStr = '2/3';

        if (fractionStr) {
            return whole > 0 ? `${whole} ${fractionStr}` : fractionStr;
        }

        return val.toFixed(2).replace(/\.?0+$/, ''); // clean decimal
    }

    function scaleLine(line, factor) {
        // Regex to match the quantity at the start of a line
        // E.g. "1.5 cups", "1 1/2 cups", "2 eggs", "1/4 tsp"
        // Captures either digits+fraction or simple digits or fractional string
        const quantityRegex = /^(\d+\s+\d+\/\d+|\d+\/\d+|\d+(?:\.\d+)?)\s*(.*)$/;
        const match = line.match(quantityRegex);
        
        if (match) {
            const qtyStr = match[1];
            const rest = match[2];
            const parsedQty = parseQuantity(qtyStr);

            if (parsedQty !== null) {
                const scaledQty = parsedQty * factor;
                return {
                    original: `${qtyStr} ${rest}`,
                    scaled: `${formatScaled(scaledQty)} ${rest}`
                };
            }
        }

        return { original: line, scaled: line };
    }

    function calculate() {
        const factor = parseFloat(scaleInput.value) || 1;
        const text = ingredientsInput.value.trim();

        if (!text) {
            // Load dummy list initially
            ingredientsInput.value = recipesMap['pancakes'];
            calculate();
            return;
        }

        const lines = text.split('\n');
        
        let originalHtml = '';
        let scaledHtml = '';

        lines.forEach(line => {
            if (line.trim()) {
                const res = scaleLine(line, factor);
                originalHtml += `<li class="list-group-item bg-transparent text-secondary py-1 border-0"><i class="fas fa-circle-notch text-muted me-2 small"></i>${res.original}</li>`;
                scaledHtml += `<li class="list-group-item bg-transparent text-dark py-1 border-0 fw-semibold"><i class="fas fa-arrow-right text-success me-2 small"></i>${res.scaled}</li>`;
            }
        });

        $('out-scale-title').textContent = factor.toFixed(2) + 'x Scaled Batch';
        $('out-scale-desc').textContent = `All quantities scaled by a factor of ${factor.toFixed(2)}`;

        $('out-original-list').innerHTML = originalHtml;
        $('out-scaled-list').innerHTML = scaledHtml;


    }

    btnCalc.addEventListener('click', calculate);
    btnReset.addEventListener('click', function() {
        scaleInput.value = 2;
        scaleSelect.value = '2.0';
        ingredientsInput.value = recipesMap['pancakes'];
        calculate();
    });

    btnCopy.addEventListener('click', function() {
        // Collect plain text scaled list
        const textLines = [];
        const factor = parseFloat(scaleInput.value) || 1;
        const text = ingredientsInput.value.trim();
        
        text.split('\n').forEach(line => {
            if (line.trim()) {
                const res = scaleLine(line, factor);
                textLines.push(res.scaled);
            }
        });

        const reportText = `Scaled Recipe List (${scaleInput.value}x)\n-----------------------------------\n${textLines.join('\n')}\n— Scaled via ToolsHub`;
        
        navigator.clipboard.writeText(reportText).then(() => {
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
.recipe-scaler-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
}
.recipe-scaler-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
}
.recipe-scaler-rebuilt .calculator-header p {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
}
.recipe-scaler-rebuilt .tool-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.recipe-scaler-rebuilt .form-label-custom {
    font-size: 0.8rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
    display: block;
}
.recipe-scaler-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid rgba(16, 185, 129, 0.15);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(16, 185, 129, 0.02);
}
.recipe-scaler-rebuilt .output-hero-label {
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #94a3b8;
}
.recipe-scaler-rebuilt .text-gradient {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.recipe-scaler-rebuilt .equation-container {
    background: #fafafa;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #334155;
}
@media (min-width: 768px) {
    .border-end-md {
        border-right: 1px solid #e2e8f0 !important;
    }
    .pr-md-4 {
        padding-right: 1.5rem !important;
    }
}
</style>
