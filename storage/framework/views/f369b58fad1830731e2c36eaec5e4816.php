<div class="interactive-tool-grid test-score-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Exam Type</label>
                <select id="exam-type" class="form-control-custom">
                    <option value="sat">SAT (1600 Scale)</option>
                    <option value="ap">AP Exam (1-5 Scale)</option>
                    <option value="gpa">Final Grade to GPA</option>
                </select>
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Raw Score / Percentage</label>
                <input type="number" id="raw-score" class="form-control-custom" placeholder="e.g. 85" min="0" max="100">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> <strong>Note:</strong> Estimates based on standard curving distributions.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label" id="res-label">Score Estimate</span>
            <div class="result-main-value" id="result-final">--</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Percentile</span>
                    <span class="stat-value" id="stat-percentile">--</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Grade</span>
                    <span class="stat-value" id="stat-grade">--</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Results
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const examType = document.getElementById('exam-type');
    const rawScore = document.getElementById('raw-score');

    function calculate() {
        const type = examType.value;
        const raw = parseFloat(rawScore.value) || 0;

        if (type === 'sat') {
            const score = Math.round(400 + (raw / 100) * 1200);
            document.getElementById('result-final').innerText = score;
            document.getElementById('stat-percentile').innerText = raw > 95 ? "99th" : (raw > 80 ? "85th" : "50th");
            document.getElementById('stat-grade').innerText = "SAT";
        } else if (type === 'ap') {
            const score = raw > 80 ? 5 : (raw > 70 ? 4 : (raw > 60 ? 3 : (raw > 50 ? 2 : 1)));
            document.getElementById('result-final').innerText = score;
            document.getElementById('stat-percentile').innerText = score >= 3 ? "Pass" : "Fail";
            document.getElementById('stat-grade').innerText = "Score";
        } else {
            const gpa = ((raw / 100) * 4).toFixed(2);
            document.getElementById('result-final').innerText = gpa;
            document.getElementById('stat-percentile').innerText = raw + "%";
            document.getElementById('stat-grade').innerText = raw > 90 ? "A" : (raw > 80 ? "B" : "C");
        }
    }

    examType.addEventListener('change', calculate);
    rawScore.addEventListener('input', calculate);

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Exam Score Estimation:\nType: ${examType.options[examType.selectedIndex].text}\nScore: ${document.getElementById('result-final').innerText}\nCalculated via ToolsHub Academics.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\test-score-calculator.blade.php ENDPATH**/ ?>