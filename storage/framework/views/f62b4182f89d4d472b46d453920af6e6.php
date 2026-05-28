<div class="interactive-tool-grid mcat-score-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label-custom">Bio Correct</label>
                    <input type="number" id="mcat-bio" class="form-control-custom mcat-in" value="45" max="59">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label-custom">Chem Correct</label>
                    <input type="number" id="mcat-chem" class="form-control-custom mcat-in" value="45" max="59">
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label-custom">Psych Correct</label>
                    <input type="number" id="mcat-psych" class="form-control-custom mcat-in" value="45" max="59">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label-custom">CARS Correct</label>
                    <input type="number" id="mcat-cars" class="form-control-custom mcat-in" value="40" max="53">
                </div>
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Scale: 472 (Min) to 528 (Max).
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Estimated Total Score</span>
            <div class="result-main-value" id="result-mcat">510</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Percentile</span>
                    <span class="stat-value" id="stat-perc">80th</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Academic</span>
                    <span class="stat-value text-accent" id="stat-rank">Strong</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Score Report
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const bio = (parseInt(document.getElementById('mcat-bio').value) || 0) / 59;
        const chem = (parseInt(document.getElementById('mcat-chem').value) || 0) / 59;
        const psych = (parseInt(document.getElementById('mcat-psych').value) || 0) / 59;
        const cars = (parseInt(document.getElementById('mcat-cars').value) || 0) / 53;

        const avg = (bio + chem + psych + cars) / 4;
        const score = Math.round(472 + (528 - 472) * avg);

        document.getElementById('result-mcat').innerText = score;
        document.getElementById('stat-perc').innerText = Math.round(avg * 100) + "th";
        document.getElementById('stat-rank').innerText = score > 515 ? "Excellent" : (score > 505 ? "Strong" : "Average");
    }

    document.querySelectorAll('.mcat-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `MCAT Prediction:\nTotal Score: ${document.getElementById('result-mcat').innerText}\nPercentile: ${document.getElementById('stat-perc').innerText}\nCalculated via ToolsHub Academy.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mcat-score-calculator.blade.php ENDPATH**/ ?>