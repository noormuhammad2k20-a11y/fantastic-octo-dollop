<div class="interactive-tool-grid snow-day-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Snow Forecast (inches)</label>
                    <input type="number" class="form-control-custom" id="snow-amt" value="5" min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Region Type</label>
                    <select class="form-control-custom" id="snow-region">
                        <option value="rural">Rural (Poor Plowing)</option>
                        <option value="suburban" selected>Suburban (Standard)</option>
                        <option value="urban">Urban (Fast Plowing)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Day of Week</label>
                    <select class="form-control-custom" id="snow-day">
                        <option value="1">Monday - Thursday</option>
                        <option value="0.8">Friday (Higher Chance)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Extreme Factors</label>
                    <div class="p-2 border rounded bg-light">
                        <div class="form-check small mb-1">
                            <input class="form-check-input" type="checkbox" id="snow-ice">
                            <label class="form-check-label" for="snow-ice">Icy Conditions</label>
                        </div>
                        <div class="form-check small">
                            <input class="form-check-input" type="checkbox" id="snow-wind">
                            <label class="form-check-label" for="snow-wind">Extreme Wind</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Closure Probability</span>
            <div class="result-main-value" id="snow-prob">45%</div>
            
            <div class="progress mb-4" style="height: 10px; border-radius: 5px;">
                <div id="prog-bar" class="progress-bar bg-accent" role="progressbar" style="width: 45%;"></div>
            </div>

            <div id="snow-verdict" class="alert py-2 px-3 small fw-bold">
                Possible Delay
            </div>

            <button class="btn d-block mx-auto btn-accent mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-snow" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const amtInput = document.getElementById('snow-amt');
    const regionInput = document.getElementById('snow-region');
    const dayInput = document.getElementById('snow-day');
    const iceCheck = document.getElementById('snow-ice');
    const windCheck = document.getElementById('snow-wind');
    
    const probDisplay = document.getElementById('snow-prob');
    const bar = document.getElementById('prog-bar');
    const verdictBox = document.getElementById('snow-verdict');

    function calculate() {
        let prob = 0;
        const amt = parseFloat(amtInput.value) || 0;
        
        prob += amt * 10; 
        if (regionInput.value === 'rural') prob += 15;
        if (regionInput.value === 'urban') prob -= 10;
        if (dayInput.value === '0.8') prob += 5;
        if (iceCheck.checked) prob += 20;
        if (windCheck.checked) prob += 10;

        prob = Math.min(100, Math.max(0, prob));

        probDisplay.innerText = prob + "%";
        bar.style.width = prob + "%";

        verdictBox.classList.remove('alert-success', 'alert-warning', 'alert-danger', 'alert-info');
        if (prob >= 80) {
            verdictBox.innerText = "Very Likely (Snow Day!)";
            verdictBox.classList.add('alert-success');
        } else if (prob >= 50) {
            verdictBox.innerText = "Likely (Keep PJs on)";
            verdictBox.classList.add('alert-info');
        } else if (prob >= 20) {
            verdictBox.innerText = "Maybe (Possible Delay)";
            verdictBox.classList.add('alert-warning');
        } else {
            verdictBox.innerText = "Unlikely (Go to Bed)";
            verdictBox.classList.add('alert-danger');
        }
    }

    [amtInput, regionInput, dayInput, iceCheck, windCheck].forEach(el => {
        el.addEventListener(el.type === 'checkbox' ? 'change' : 'input', calculate);
    });

    document.getElementById('copy-snow').addEventListener('click', function() {
        const text = `Snow Day Prediction: ${probDisplay.innerText} chance of closure.\nCalculated via ToolsHub.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\snow-day-calculator.blade.php ENDPATH**/ ?>