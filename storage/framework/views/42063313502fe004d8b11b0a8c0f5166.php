<div class="interactive-tool-grid college-gpa-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div id="course-rows">
                <div class="row mb-2 course-row">
                    <div class="col-7">
                        <select class="form-control-custom grade-select">
                            <option value="4.0">A (4.0)</option>
                            <option value="3.7">A- (3.7)</option>
                            <option value="3.3">B+ (3.3)</option>
                            <option value="3.0">B (3.0)</option>
                            <option value="2.7">B- (2.7)</option>
                            <option value="2.0">C (2.0)</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <input type="number" class="form-control-custom credit-input" placeholder="Credits" value="3">
                    </div>
                </div>
            </div>
            
            <button class="btn btn-outline-accent w-100 py-2 mt-2 mb-4" id="add-course" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-plus me-1"></i> Add Course
            </button>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Current Cumulative GPA (Optional)</label>
                <input type="number" id="cum-gpa" class="form-control-custom cumul-in" value="3.5" step="0.01">
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Semester GPA</span>
            <div class="result-main-value" id="semester-gpa">4.00</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Total Credits</span>
                    <span class="stat-value" id="total-credits">3</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Honor</span>
                    <span class="stat-value text-success" id="honor-title">Dean's List</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Transcript Summary
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const courseRows = document.getElementById('course-rows');
    const addButton = document.getElementById('add-course');

    function calculate() {
        let totalPoints = 0;
        let totalCredits = 0;

        document.querySelectorAll('.course-row').forEach(row => {
            const grade = parseFloat(row.querySelector('.grade-select').value);
            const credits = parseFloat(row.querySelector('.credit-input').value) || 0;
            totalPoints += grade * credits;
            totalCredits += credits;
        });

        const gpa = totalCredits > 0 ? (totalPoints / totalCredits) : 0;
        document.getElementById('semester-gpa').innerText = gpa.toFixed(2);
        document.getElementById('total-credits').innerText = totalCredits;
        document.getElementById('honor-title').innerText = gpa >= 3.5 ? "Dean's List" : (gpa >= 3.0 ? "Good Stand" : "Needs Imp.");
    }

    addButton.addEventListener('click', () => {
        const div = document.createElement('div');
        div.className = 'row mb-2 course-row';
        div.innerHTML = `
            <div class="col-7">
                <select class="form-control-custom grade-select">
                    <option value="4.0">A (4.0)</option>
                    <option value="3.7">A- (3.7)</option>
                    <option value="3.3">B+ (3.3)</option>
                    <option value="3.0" selected>B (3.0)</option>
                    <option value="2.0">C (2.0)</option>
                </select>
            </div>
            <div class="col-5">
                <input type="number" class="form-control-custom credit-input" placeholder="Credits" value="3">
            </div>
        `;
        courseRows.appendChild(div);
        div.querySelectorAll('input, select').forEach(el => el.addEventListener('input', calculate));
        calculate();
    });

    courseRows.querySelectorAll('input, select').forEach(el => el.addEventListener('input', calculate));
    document.getElementById('cum-gpa').addEventListener('input', calculate);

    document.getElementById('copy-summary').addEventListener('click', function() {
        const text = `College Academic Summary:\nSemester GPA: ${document.getElementById('semester-gpa').innerText}\nTotal Credits: ${document.getElementById('total-credits').innerText}\nCalculated via ToolsHub Academy.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\college-gpa-calculator.blade.php ENDPATH**/ ?>