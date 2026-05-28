<div class="interactive-tool-grid percent-difference-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label-custom">Calculation Type</label>
                    <select class="form-control-custom" id="perc-type">
                        <option value="diff" selected>Percentage Difference (Two values)</option>
                        <option value="change">Percentage Change (Old vs New)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom" id="label-v1">Value 1</label>
                    <input type="number" class="form-control-custom" id="perc-v1" value="100" step="0.1">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom" id="label-v2">Value 2</label>
                    <input type="number" class="form-control-custom" id="perc-v2" value="150" step="0.1">
                </div>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Result</span>
            <div class="result-main-value" id="perc-result">40%</div>
            
            <div id="perc-verdict" class="alert py-2 px-3 small fw-bold mb-4 alert-success">
                Percentage Increase
            </div>

            <p class="text-muted small mb-4" id="perc-detail">Value 2 is 50.00% greater than Value 1.</p>

            <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-perc" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const v1Input = document.getElementById('perc-v1');
    const v2Input = document.getElementById('perc-v2');
    const typeSelect = document.getElementById('perc-type');
    
    const resultDisplay = document.getElementById('perc-result');
    const verdictBox = document.getElementById('perc-verdict');
    const detailText = document.getElementById('perc-detail');

    function calculate() {
        const v1 = parseFloat(v1Input.value) || 0;
        const v2 = parseFloat(v2Input.value) || 0;
        const type = typeSelect.value;
        
        let result, verb, percent;
        if (type === 'diff') {
            // Difference = |V1 - V2| / ((V1 + V2) / 2)
            if (v1 + v2 === 0) return;
            result = (Math.abs(v1 - v2) / ((v1 + v2) / 2)) * 100;
            resultDisplay.innerText = result.toFixed(2) + "%";
            verdictBox.innerText = "Difference";
            verdictBox.className = "alert py-2 px-3 small fw-bold mb-4 alert-info";
            detailText.innerText = `The percentage difference between ${v1} and ${v2} is ${result.toFixed(2)}%.`;
        } else {
            // Change = (New - Old) / Old
            if (v1 === 0) return;
            percent = ((v2 - v1) / v1) * 100;
            resultDisplay.innerText = Math.abs(percent).toFixed(2) + "%";
            if (percent >= 0) {
                verdictBox.innerText = "Percentage Increase";
                verdictBox.className = "alert py-2 px-3 small fw-bold mb-4 alert-success";
                detailText.innerText = `${v2} is ${percent.toFixed(2)}% greater than ${v1}.`;
            } else {
                verdictBox.innerText = "Percentage Decrease";
                verdictBox.className = "alert py-2 px-3 small fw-bold mb-4 alert-danger";
                detailText.innerText = `${v2} is ${Math.abs(percent).toFixed(2)}% less than ${v1}.`;
            }
        }
    }

    typeSelect.addEventListener('change', () => {
        const isChange = typeSelect.value === 'change';
        document.getElementById('label-v1').innerText = isChange ? "Old Value" : "Value 1";
        document.getElementById('label-v2').innerText = isChange ? "New Value" : "Value 2";
        calculate();
    });

    [v1Input, v2Input].forEach(el => el.addEventListener('input', calculate));

    document.getElementById('copy-perc').addEventListener('click', function() {
        const text = `Percent Calculation:\nResult: ${resultDisplay.innerText}\nType: ${verdictBox.innerText}\n${detailText.innerText}\nCalculated via ToolsHub.`;
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

