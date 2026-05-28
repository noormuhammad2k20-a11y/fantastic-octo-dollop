<div class="interactive-wrapper">
    {{-- Input Card --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Date of Birth</label>
                        <input type="date" id="dob" class="form-control form-control-lg rounded-3" value="2000-01-01">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Age at the Date of</label>
                        <input type="date" id="as-of-date" class="form-control form-control-lg rounded-3">
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Calculate Age
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Result Card --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-user-clock text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Chronological Report</h5>
                        <p class="text-muted small mb-0">Your precise age breakdown</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 px-4 pb-4 text-center">
            <div class="display-4 fw-bold text-dark mb-2" id="result-age">0 Years, 0 Months</div>
            <p class="text-muted mb-4" id="result-days-exact">0 days exactly</p>

            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-4 bg-light border">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Total Months</div>
                        <div class="h4 fw-bold mb-0" id="stat-months">0</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-4 bg-light border">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Total Weeks</div>
                        <div class="h4 fw-bold mb-0" id="stat-weeks">0</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-4 bg-light border">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Total Days</div>
                        <div class="h4 fw-bold mb-0" id="stat-days">0</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-4 bg-light border">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Total Hours</div>
                        <div class="h4 fw-bold mb-0" id="stat-hours">0</div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 shadow-sm bg-primary text-white mb-0 mx-auto" style="max-width: 500px;">
                <h6 class="fw-bold mb-2">Next Birthday Countdown</h6>
                <div id="next-birthday" class="display-6 fw-bold">Calculating...</div>
                <p class="small mb-0 opacity-75" id="next-birthday-date"></p>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }

    .transition-all { transition: all 0.2s ease; }
    
    .display-6 { font-size: 1.75rem; }
    .bg-primary { background-color: var(--primary-color) !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dobInput = document.getElementById('dob');
    const asOfInput = document.getElementById('as-of-date');
    const resultCard = document.getElementById('result-card');
    const resultAge = document.getElementById('result-age');
    const resultDaysExact = document.getElementById('result-days-exact');
    const statMonths = document.getElementById('stat-months');
    const statWeeks = document.getElementById('stat-weeks');
    const statDays = document.getElementById('stat-days');
    const statHours = document.getElementById('stat-hours');
    const nextBirthdayDisplay = document.getElementById('next-birthday');
    const nextBirthdayDateDisplay = document.getElementById('next-birthday-date');
    const btnCalculate = document.getElementById('btn-calculate');

    // Set default "as of" date to today
    const today = new Date().toISOString().split('T')[0];
    asOfInput.value = today;

    function calculate() {
        const birthDate = new Date(dobInput.value);
        const extraDate = new Date(asOfInput.value);
        
        if (isNaN(birthDate.getTime()) || isNaN(extraDate.getTime())) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Calculating...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            let years = extraDate.getFullYear() - birthDate.getFullYear();
            let months = extraDate.getMonth() - birthDate.getMonth();
            let days = extraDate.getDate() - birthDate.getDate();

            if (days < 0) {
                months--;
                const lastMonth = new Date(extraDate.getFullYear(), extraDate.getMonth(), 0);
                days += lastMonth.getDate();
            }

            if (months < 0) {
                years--;
                months += 12;
            }

            resultAge.innerText = `${years} Years, ${months} Months`;
            resultDaysExact.innerText = `And ${days} days exactly`;
            
            const totalMonths = (years * 12) + months;
            const msDiff = extraDate - birthDate;
            const totalDays = Math.floor(msDiff / (1000 * 60 * 60 * 24));
            const totalWeeks = Math.floor(totalDays / 7);
            const totalHours = totalDays * 24;
            
            statMonths.innerText = totalMonths.toLocaleString();
            statWeeks.innerText = totalWeeks.toLocaleString();
            statDays.innerText = totalDays.toLocaleString();
            statHours.innerText = totalHours.toLocaleString();

            // Next Birthday
            let nextBday = new Date(extraDate.getFullYear(), birthDate.getMonth(), birthDate.getDate());
            if (nextBday < extraDate) {
                nextBday.setFullYear(extraDate.getFullYear() + 1);
            }
            const diff = Math.ceil((nextBday - extraDate) / (1000 * 60 * 60 * 24));
            
            nextBirthdayDateDisplay.innerText = nextBday.toLocaleDateString(undefined, { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            
            if (diff === 0 || diff === 365) {
                nextBirthdayDisplay.innerText = "🎉 Happy Birthday!";
            } else {
                nextBirthdayDisplay.innerText = `${diff} Days to go`;
            }

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Calculate Age';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-reset').addEventListener('click', () => {
        dobInput.value = '2000-01-01';
        asOfInput.value = today;
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Age Report:\nDate of Birth: ${dobInput.value}\nExact Age: ${resultAge.innerText}, ${resultDaysExact.innerText}\nTotal Days Lived: ${statDays.innerText}\nNext Birthday: ${nextBirthdayDisplay.innerText}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Report!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>

