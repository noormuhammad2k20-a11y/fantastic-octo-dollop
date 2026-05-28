<div class="interactive-tool-grid gpa-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div id="semesters-container">
                <div class="semester-block mb-4 p-4 border rounded shadow-sm bg-white">
                    <h5 class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold">Semester 1</span>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-semester" style="min-width: 280px; max-width: 100%; display:none;">
                            <i class="fas fa-trash me-1"></i> Remove
                        </button>
                    </h5>
                    
                    <div class="course-list">
                        <div class="course-row row g-3 mb-2 align-items-center">
                            <div class="col-md-5">
                                <label class="form-label-custom">Course Name</label>
                                <input type="text" class="form-control-custom" placeholder="e.g. Physics 101">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-custom">Grade</label>
                                <select class="form-control-custom grade-input">
                                    <option value="4.0">A (4.0)</option>
                                    <option value="3.7">A- (3.7)</option>
                                    <option value="3.3">B+ (3.3)</option>
                                    <option value="3.0">B (3.0)</option>
                                    <option value="2.7">B- (2.7)</option>
                                    <option value="2.3">C+ (2.3)</option>
                                    <option value="2.0">C (2.0)</option>
                                    <option value="1.7">C- (1.7)</option>
                                    <option value="1.3">D+ (1.3)</option>
                                    <option value="1.0">D (1.0)</option>
                                    <option value="0.0">F (0.0)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-custom">Credits</label>
                                <input type="number" class="form-control-custom credit-input" value="3" min="0">
                            </div>
                            <div class="col-md-1 text-end pt-4">
                                <button type="button" class="btn btn-link link-danger p-0 remove-course" title="Remove Course">
                                    <i class="fas fa-times-circle fa-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-sm btn-outline-accent add-course mt-3">
                        <i class="fas fa-plus me-1"></i> Add Course
                    </button>
                </div>
            </div>
            
            <div class="d-flex gap-3 mt-4">
                <button type="button" class="btn btn-outline-accent add-semester">
                    <i class="fas fa-plus-circle me-1"></i> Add Semester
                </button>
                <button type="button" class="btn btn-outline-secondary" id="reset-gpa" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-undo me-1"></i> Reset All
                </button>
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Cumulative GPA</span>
            <div class="result-main-value" id="cumulative-gpa">4.00</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Total Credits</span>
                    <span class="stat-value" id="total-credits">3</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Semesters</span>
                    <span class="stat-value" id="total-semesters">1</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-gpa" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('semesters-container');
    const cumulativeDisplay = document.getElementById('cumulative-gpa');
    const totalCreditsDisplay = document.getElementById('total-credits');
    const totalSemestersDisplay = document.getElementById('total-semesters');

    function calculateGPA() {
        let totalPoints = 0;
        let totalCredits = 0;
        let semesterCount = 0;

        document.querySelectorAll('.semester-block').forEach(semester => {
            semesterCount++;
            semester.querySelectorAll('.course-row').forEach(course => {
                const grade = parseFloat(course.querySelector('.grade-input').value);
                const credits = parseFloat(course.querySelector('.credit-input').value) || 0;
                totalPoints += grade * credits;
                totalCredits += credits;
            });
        });

        const gpa = totalCredits > 0 ? (totalPoints / totalCredits).toFixed(2) : "0.00";
        cumulativeDisplay.innerText = gpa;
        totalCreditsDisplay.innerText = totalCredits;
        totalSemestersDisplay.innerText = semesterCount;
    }

    container.addEventListener('click', function(e) {
        if (e.target.closest('.add-course')) {
            const list = e.target.closest('.semester-block').querySelector('.course-list');
            const row = document.createElement('div');
            row.className = 'course-row row g-3 mb-2 align-items-center';
            row.innerHTML = `
                <div class="col-md-5">
                    <input type="text" class="form-control-custom" placeholder="Course Name">
                </div>
                <div class="col-md-3">
                    <select class="form-control-custom grade-input">
                        <option value="4.0">A (4.0)</option>
                        <option value="3.7">A- (3.7)</option>
                        <option value="3.3">B+ (3.3)</option>
                        <option value="3.0">B (3.0)</option>
                        <option value="2.7">B- (2.7)</option>
                        <option value="2.3">C+ (2.3)</option>
                        <option value="2.0">C (2.0)</option>
                        <option value="1.7">C- (1.7)</option>
                        <option value="1.3">D+ (1.3)</option>
                        <option value="1.0">D (1.0)</option>
                        <option value="0.0">F (0.0)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control-custom credit-input" value="3" min="0">
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-link link-danger p-0 remove-course"><i class="fas fa-times-circle fa-lg"></i></button>
                </div>
            `;
            list.appendChild(row);
            calculateGPA();
        }

        if (e.target.closest('.remove-course')) {
            const row = e.target.closest('.course-row');
            const list = row.parentElement;
            if (list.children.length > 1) {
                row.remove();
                calculateGPA();
            }
        }
    });

    document.querySelector('.add-semester').addEventListener('click', function() {
        const count = container.querySelectorAll('.semester-block').length + 1;
        const block = document.createElement('div');
        block.className = 'semester-block mb-4 p-4 border rounded shadow-sm bg-white';
        block.innerHTML = `
            <h5 class="d-flex justify-content-between align-items-center mb-4">
                <span class="fw-bold">Semester ${count}</span>
                <button type="button" class="btn btn-sm btn-outline-danger remove-semester">
                    <i class="fas fa-trash me-1"></i> Remove
                </button>
            </h5>
            <div class="course-list">
                <div class="course-row row g-3 mb-2 align-items-center">
                    <div class="col-md-5">
                        <input type="text" class="form-control-custom" placeholder="Course Name">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control-custom grade-input">
                            <option value="4.0">A (4.0)</option>
                            <option value="3.7">A- (3.7)</option>
                            <option value="3.3">B+ (3.3)</option>
                            <option value="3.0">B (3.0)</option>
                            <option value="2.7">B- (2.7)</option>
                            <option value="2.3">C+ (2.3)</option>
                            <option value="2.0">C (2.0)</option>
                            <option value="1.7">C- (1.7)</option>
                            <option value="1.3">D+ (1.3)</option>
                            <option value="1.0">D (1.0)</option>
                            <option value="0.0">F (0.0)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control-custom credit-input" value="3" min="0">
                    </div>
                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-link link-danger p-0 remove-course"><i class="fas fa-times-circle fa-lg"></i></button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-accent add-course mt-3">
                <i class="fas fa-plus me-1"></i> Add Course
            </button>
        `;
        container.appendChild(block);
        calculateGPA();
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-semester')) {
            e.target.closest('.semester-block').remove();
            calculateGPA();
        }
    });

    container.addEventListener('input', calculateGPA);
    container.addEventListener('change', calculateGPA);

    document.getElementById('reset-gpa').addEventListener('click', function() {
        if(confirm('Are you sure you want to reset all entries?')) location.reload();
    });

    document.getElementById('copy-gpa').addEventListener('click', function() {
        const text = `GPA Report:\nCumulative GPA: ${cumulativeDisplay.innerText}\nTotal Credits: ${totalCreditsDisplay.innerText}\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });

    calculateGPA();
});
</script>

