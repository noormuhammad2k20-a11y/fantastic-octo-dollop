<div class="interactive-tool-grid mixed-number-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4 align-items-center">
                <div class="col-md-5">
                    <div class="p-3 border rounded bg-light">
                        <label class="form-label-custom mb-3">First Number</label>
                        <div class="d-flex gap-2">
                            <div style="flex: 1;">
                                <label class="x-small text-muted d-block mb-1">Whole</label>
                                <input type="number" class="form-control-custom" id="mix-w1" value="1">
                            </div>
                            <div style="flex: 1;">
                                <label class="x-small text-muted d-block mb-1">Num</label>
                                <input type="number" class="form-control-custom" id="mix-n1" value="1">
                            </div>
                            <div style="flex: 1;">
                                <label class="x-small text-muted d-block mb-1">Den</label>
                                <input type="number" class="form-control-custom" id="mix-d1" value="2">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 text-center">
                    <select class="form-control-custom text-center fw-bold fs-4" id="mix-op">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="*">×</option>
                        <option value="/">÷</option>
                    </select>
                </div>

                <div class="col-md-5">
                    <div class="p-3 border rounded bg-light">
                        <label class="form-label-custom mb-3">Second Number</label>
                        <div class="d-flex gap-2">
                            <div style="flex: 1;">
                                <label class="x-small text-muted d-block mb-1">Whole</label>
                                <input type="number" class="form-control-custom" id="mix-w2" value="2">
                            </div>
                            <div style="flex: 1;">
                                <label class="x-small text-muted d-block mb-1">Num</label>
                                <input type="number" class="form-control-custom" id="mix-n2" value="1">
                            </div>
                            <div style="flex: 1;">
                                <label class="x-small text-muted d-block mb-1">Den</label>
                                <input type="number" class="form-control-custom" id="mix-d2" value="4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Resulting Fraction</span>
            <div class="result-main-value" id="mix-res">3 3/4</div>
            
            <div class="result-sub-stats border-top pt-4">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Improper</span>
                    <span class="stat-value text-accent" id="res-improper">15/4</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Decimal</span>
                    <span class="stat-value" id="res-decimal">3.75</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-mix" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy result
            </button>
        </div>
    </div>
</div>

<style>
.x-small { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['mix-w1', 'mix-n1', 'mix-d1', 'mix-w2', 'mix-n2', 'mix-d2', 'mix-op'];
    const els = {};
    inputs.forEach(id => els[id] = document.getElementById(id));

    function gcd(a, b) { return b === 0 ? a : gcd(b, a % b); }

    function calculate() {
        const w1 = parseInt(els['mix-w1'].value) || 0;
        const n1 = parseInt(els['mix-n1'].value) || 0;
        const d1 = parseInt(els['mix-d1'].value) || 1;
        
        const w2 = parseInt(els['mix-w2'].value) || 0;
        const n2 = parseInt(els['mix-n2'].value) || 0;
        const d2 = parseInt(els['mix-d2'].value) || 1;
        
        const op = els['mix-op'].value;

        // Convert to improper fractions
        let num1 = (w1 * d1) + n1;
        let den1 = d1;
        
        let num2 = (w2 * d2) + n2;
        let den2 = d2;

        let numRes, denRes;

        if (op === '+') {
            numRes = (num1 * den2) + (num2 * den1);
            denRes = den1 * den2;
        } else if (op === '-') {
            numRes = (num1 * den2) - (num2 * den1);
            denRes = den1 * den2;
        } else if (op === '*') {
            numRes = num1 * num2;
            denRes = den1 * den2;
        } else {
            numRes = num1 * den2;
            denRes = den1 * num2;
        }

        if (denRes === 0) return;

        // Simplify
        const common = Math.abs(gcd(numRes, denRes));
        numRes /= common;
        denRes /= common;

        document.getElementById('res-improper').innerText = `${numRes}/${denRes}`;
        document.getElementById('res-decimal').innerText = (numRes / denRes).toFixed(2);

        // Convert back to mixed
        const whole = Math.floor(Math.abs(numRes) / denRes);
        const rem = Math.abs(numRes) % denRes;
        const sign = numRes < 0 ? '-' : '';

        if (rem === 0) {
            document.getElementById('mix-res').innerText = sign + whole;
        } else if (whole === 0) {
            document.getElementById('mix-res').innerText = sign + `${rem}/${denRes}`;
        } else {
            document.getElementById('mix-res').innerText = sign + `${whole} ${rem}/${denRes}`;
        }
    }

    inputs.forEach(id => els[id].addEventListener('input', calculate));

    document.getElementById('copy-mix').addEventListener('click', function() {
        const text = `Mixed Number Result:\nMixed: ${document.getElementById('mix-res').innerText}\nImproper: ${document.getElementById('res-improper').innerText}\nDecimal: ${document.getElementById('res-decimal').innerText}\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = orig; }, 2000);
        });
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mixed-number-calculator.blade.php ENDPATH**/ ?>