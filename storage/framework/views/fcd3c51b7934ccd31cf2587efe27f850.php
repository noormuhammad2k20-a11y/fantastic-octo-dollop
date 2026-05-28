<div class="interactive-tool-grid final-grade-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Current Grade (%)</label>
                    <div class="input-group-custom">
                        <input type="number" class="form-control-custom" id="fg-current" value="85" min="0" max="100">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Desired Grade (%)</label>
                    <div class="input-group-custom">
                        <input type="number" class="form-control-custom" id="fg-desired" value="90" min="0" max="100">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label-custom">Final Exam Weight (%)</label>
                    <div class="input-group-custom">
                        <input type="number" class="form-control-custom" id="fg-weight" value="20" min="0" max="100">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Required Score</span>
            <div class="result-main-value" id="fg-needed">110%</div>
            
            <div id="fg-verdict" class="alert py-2 px-3 small fw-bold mb-4 alert-danger">
                Better luck next time!
            </div>

            <p class="text-muted small mb-4" id="fg-detail">You need a very high score to reach your goal.</p>

            <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-fg" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Goal
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const curInput = document.getElementById('fg-current');
    const desInput = document.getElementById('fg-desired');
    const wInput = document.getElementById('fg-weight');
    
    const neededDisplay = document.getElementById('fg-needed');
    const verdictBox = document.getElementById('fg-verdict');
    const detailText = document.getElementById('fg-detail');

    function calculate() {
        const C = parseFloat(curInput.value) || 0;
        const D = parseFloat(desInput.value) || 0;
        const W = (parseFloat(wInput.value) || 0) / 100;

        if (W === 0) {
            neededDisplay.innerText = "N/A";
            return;
        }

        // Formula: Desired = (Current * (1 - Weight)) + (Needed * Weight)
        // Needed = (Desired - (Current * (1 - Weight))) / Weight
        const needed = (D - (C * (1 - W))) / W;
        neededDisplay.innerText = Math.max(0, needed).toFixed(1) + "%";

        verdictBox.classList.remove('alert-success', 'alert-warning', 'alert-danger');
        if (needed <= 50) {
            verdictBox.innerText = "Easy Goal! 🎉";
            verdictBox.classList.add('alert-success');
            detailText.innerText = "You're in great shape to reach your target.";
        } else if (needed <= 100) {
            verdictBox.innerText = "Achievable! 💪";
            verdictBox.classList.add('alert-warning');
            detailText.innerText = "Study hard and you'll reach your goal.";
        } else {
            verdictBox.innerText = "Extra Credit Needed! 😅";
            verdictBox.classList.add('alert-danger');
            detailText.innerText = "You'll need more than 100% on the final to get this grade.";
        }
    }

    [curInput, desInput, wInput].forEach(el => el.addEventListener('input', calculate));

    document.getElementById('copy-fg').addEventListener('click', function() {
        const text = `Final Grade Goal:\nDesired: ${desInput.value}%\nRequired on Final: ${neededDisplay.innerText}\nCalculated via ToolsHub.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\final-grade-calculator.blade.php ENDPATH**/ ?>