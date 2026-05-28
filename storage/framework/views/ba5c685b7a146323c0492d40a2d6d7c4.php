<div class="interactive-tool-grid cgpa-to-marks">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-3 mb-4">
                <div class="col-md-12">
                    <label class="form-label-custom">Enter CGPA</label>
                    <input type="number" id="input-cgpa" class="form-control-custom" placeholder="e.g. 9.2" step="0.01" min="0">
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label-custom">Maximum CGPA</label>
                    <input type="number" id="max-cgpa" class="form-control-custom" value="10.0" step="0.1" min="1">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Maximum Marks</label>
                    <input type="number" id="max-marks" class="form-control-custom" value="1000" min="1">
                </div>
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> <strong>Formula:</strong> (CGPA / Max CGPA) × Max Marks
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Equivalent Marks Obtained</span>
            <div class="result-main-value" id="result-marks">0</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Percentage</span>
                    <span class="stat-value" id="stat-percent">0%</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Max Marks</span>
                    <span class="stat-value" id="stat-max">1000</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputCgpa = document.getElementById('input-cgpa');
    const maxCgpa = document.getElementById('max-cgpa');
    const maxMarks = document.getElementById('max-marks');
    const resultMarks = document.getElementById('result-marks');
    const statPercent = document.getElementById('stat-percent');
    const statMax = document.getElementById('stat-max');

    function calculate() {
        const cgpa = parseFloat(inputCgpa.value) || 0;
        const mCgpa = parseFloat(maxCgpa.value) || 10;
        const mMarks = parseFloat(maxMarks.value) || 1000;
        
        const ratio = mCgpa > 0 ? (cgpa / mCgpa) : 0;
        const marks = Math.round(ratio * mMarks);
        const percent = (ratio * 100).toFixed(1);
        
        resultMarks.innerText = marks;
        statPercent.innerText = percent + "%";
        statMax.innerText = mMarks;
    }

    [inputCgpa, maxCgpa, maxMarks].forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `CGPA to Marks Conversion:\nCGPA: ${inputCgpa.value}/${maxCgpa.value}\nEquivalent Marks: ${resultMarks.innerText} out of ${maxMarks.value}\nPercentage: ${statPercent.innerText}\nCalculated via ToolsHub.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cgpa-to-marks.blade.php ENDPATH**/ ?>