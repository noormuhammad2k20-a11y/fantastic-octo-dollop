<div class="row g-4">
    <!-- Input Card -->
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            

            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label-custom">Conversion Mode</label>
                    <select id="convertMode" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <option value="cgpa-to-percent">CGPA to Percentage</option>
                        <option value="percent-to-cgpa">Percentage to CGPA</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Value</label>
                    <input type="number" id="inputValue" class="form-control-custom" step="0.01" placeholder="e.g. 8.5">
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Max Scale</label>
                    <select id="maxScale" class="form-select border-0 shadow-sm py-2" style="border-radius: var(--radius-md);">
                        <option value="10">Scale of 10.0</option>
                        <option value="4">Scale of 4.0</option>
                        <option value="5">Scale of 5.0</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-4 p-3 bg-light rounded border border-light-subtle" style="border-radius: var(--radius-md);">
                <div class="small fw-bold text-accent mb-1"><i class="fas fa-info-circle me-1"></i> Calculation Info:</div>
                <div id="formulaText" class="text-secondary small">Percentage = CGPA × 9.5</div>
                <div class="mt-2 text-muted x-small opacity-75">Grading formulas vary by university. Using standard multipliers for 10-point scales.</div>
            </div>
        </div>
    </div>

    <!-- Output Card -->
    <div class="col-lg-4">
        <div class="calculator-card h-100">
            <div class="calculator-header mb-4">
                <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                    <i class="fas fa-calculator"></i>
                </div>
                <div>
                    <h4>Result</h4>
                    <p>Converted value</p>
                </div>
            </div>

            <div class="text-center py-4">
                <div class="text-muted small mb-2 text-uppercase fw-bold letter-spacing-1">Calculated Result</div>
                <div id="resultDisplay" class="p-4 bg-light rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 150px; height: 150px; border: 5px solid var(--accent-soft);">
                    <div class="fs-2 fw-bold text-accent" id="resultValue">---</div>
                </div>
                <div class="small text-muted" id="resultLabel">Result will appear here</div>
            </div>

            <button id="copyResultBtn" class="btn d-block mx-auto -outline-custom mt-auto py-3 px-5 fw-bold rounded-pill shadow-sm">
                <i class="fas fa-copy me-2"></i> Copy Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const convertMode = document.getElementById('convertMode');
    const inputValue = document.getElementById('inputValue');
    const maxScale = document.getElementById('maxScale');
    const resultValue = document.getElementById('resultValue');
    const formulaText = document.getElementById('formulaText');

    function calculate() {
        const val = parseFloat(inputValue.value);
        const resultLabel = document.getElementById('resultLabel');
        
        if (isNaN(val)) {
            resultValue.textContent = "---";
            resultLabel.textContent = "Enter a value to calculate";
            return;
        }

        const scale = parseFloat(maxScale.value);
        let result = 0;
        let suffix = "";

        if (convertMode.value === "cgpa-to-percent") {
            if (scale === 10) {
                result = val * 9.5;
                formulaText.textContent = "Percentage = CGPA × 9.5";
            } else {
                result = (val / scale) * 100;
                formulaText.textContent = `Percentage = (CGPA / ${scale}) × 100`;
            }
            suffix = "%";
            resultLabel.textContent = "Equivalent Percentage";
        } else if (convertMode.value === "percent-to-cgpa") {
            if (scale === 10) {
                result = val / 9.5;
                formulaText.textContent = "CGPA = Percentage / 9.5";
            } else {
                result = (val / 100) * scale;
                formulaText.textContent = `CGPA = (Percentage / 100) × ${scale}`;
            }
            suffix = `/${scale}`;
            resultLabel.textContent = "Equivalent CGPA";
        }

        resultValue.textContent = result.toFixed(2) + suffix;
    }

    const copyBtn = document.getElementById('copyResultBtn');
    copyBtn.addEventListener('click', function() {
        const val = resultValue.textContent;
        if (val === "---") return;
        
        navigator.clipboard.writeText(val).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { this.innerHTML = original; }, 2000);
        });
    });

    [convertMode, inputValue, maxScale].forEach(el => {
        el.addEventListener('input', calculate);
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cgpa-sgpa-converter.blade.php ENDPATH**/ ?>