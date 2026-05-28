<div class="row g-4 synthetic-division-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-9">
                        <label class="form-label-custom">Polynomial Coefficients (e.g., 1, -5, 6)</label>
                        <input type="text" id="poly-coeffs" class="form-control form-control-lg rounded-3" value="1, -5, 6" placeholder="Space or comma separated">
                        <div class="form-text mt-2">Represents $1x^2 - 5x + 6$</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Value of c (for x - c)</label>
                        <input type="number" id="div-c" class="form-control form-control-lg rounded-3" value="2" step="any">
                    </div>
                </div>

                <div class="quick-actions-grid mt-4">
                    <button type="button" class="btn btn-primary-action" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-calculator me-2"></i>Divide Now
                    </button>
                    <button type="button" class="btn btn-secondary-action" id="btn-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" id="output-section" style="display: none;">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Quotient & Remainder</span>
                <div class="output-hero-value fs-2" id="out-result">x - 3</div>
                <span class="output-hero-unit" id="out-remainder">Remainder: 0</span>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm"" id="btn-copy-results" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i>Copy Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function calculate() {
        const coeffsInput = $('poly-coeffs').value;
        const c = parseFloat($('div-c').value);
        
        const coeffs = coeffsInput.split(/[\s,]+/).map(n => parseFloat(n)).filter(n => !isNaN(n));
        if (coeffs.length < 2 || isNaN(c)) return;

        const results = [];
        const additions = [0];
        const products = [];
        
        let current = coeffs[0];
        results.push(current);

        for (let i = 1; i < coeffs.length; i++) {
            const prod = current * c;
            products.push(prod);
            current = coeffs[i] + prod;
            results.push(current);
        }

        // Render Quotient
        let quotientStr = "";
        for (let i = 0; i < results.length - 1; i++) {
            const pow = results.length - 2 - i;
            if (results[i] === 0) continue;
            let term = (results[i] === 1 && pow > 0) ? "" : (results[i] === -1 && pow > 0) ? "-" : results[i];
            if (pow > 0) term += "x";
            if (pow > 1) term += "<sup>" + pow + "</sup>";
            quotientStr += (quotientStr && results[i] > 0 ? " + " : results[i] < 0 ? " " : "") + term;
        }
        if (!quotientStr) quotientStr = "0";

        $('out-result').innerHTML = quotientStr;
        const remainder = results[results.length - 1];
        $('out-remainder').textContent = `Remainder: ${remainder}`;

        $('output-section').style.display = 'block';
        $('output-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('btn-calculate').addEventListener('click', calculate);
});
</script>

<style>
.synthetic-division-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,.03); }
.quick-actions-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
.btn-primary-action { background: #1e293b; color: #fff; border: none; border-radius: 14px; padding: 1rem; font-weight: 700; transition: all 0.2s; }
.output-card-themed { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; margin-top: 2rem; }
.output-hero { text-align: center; padding: 2rem; background: var(--tool-bg); border-radius: 20px; border: 1px dashed rgba(236,72,153,0.2); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\synthetic-division.blade.php ENDPATH**/ ?>