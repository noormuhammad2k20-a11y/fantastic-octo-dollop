<div class="interactive-tool-grid grade-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Current Class Grade (%)</label>
                <input type="number" id="curr-grade" class="form-control-custom grade-in" value="85">
            </div>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Target Grade (%)</label>
                <input type="number" id="target-grade" class="form-control-custom grade-in" value="90">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Final Exam Weight (%)</label>
                <input type="number" id="final-weight" class="form-control-custom grade-in" value="20">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Helps you prioritize your study time for finals!
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Needed Final Exam Score</span>
            <div class="result-main-value" id="result-needed">110%</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Difficulty</span>
                    <span class="stat-value text-danger" id="stat-diff">High</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Cur. Weight</span>
                    <span class="stat-value" id="stat-cur-w">80%</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-report" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Study Goals
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const cur = parseFloat(document.getElementById('curr-grade').value) || 0;
        const target = parseFloat(document.getElementById('target-grade').value) || 0;
        const weight = (parseFloat(document.getElementById('final-weight').value) || 0) / 100;

        if (weight > 0) {
            const needed = (target - (cur * (1 - weight))) / weight;
            document.getElementById('result-needed').innerText = Math.round(needed) + "%";
            document.getElementById('stat-diff').innerText = needed > 100 ? "Impossible" : (needed > 90 ? "Hard" : "Doable");
            document.getElementById('stat-cur-w').innerText = Math.round((1 - weight) * 100) + "%";
        }
    }

    document.querySelectorAll('.grade-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-report').addEventListener('click', function() {
        const text = `Final Exam Goal:\nTarget: ${document.getElementById('target-grade').value}%\nNeeded on Final: ${document.getElementById('result-needed').innerText}\nCalculated via ToolsHub Academy.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\grade-calculator.blade.php ENDPATH**/ ?>