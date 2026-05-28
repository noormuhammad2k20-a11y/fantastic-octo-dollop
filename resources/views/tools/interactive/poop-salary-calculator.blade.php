<div class="interactive-wrapper">
    {{-- Input Card (Workplace Parameters) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Salary and Hours --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Compensation profile</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Annual Gross Salary</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3">$</span>
                                    <input type="number" id="pp-salary" class="form-control form-control-lg rounded-end-3" value="65000" min="1000">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Hours per Week</label>
                                <input type="number" id="pp-hours-wk" class="form-control form-control-lg rounded-3" value="40" min="1" max="100">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Work Days per Week</label>
                                <input type="number" id="pp-days-wk" class="form-control form-control-lg rounded-3" value="5" min="1" max="7">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Toilet parameters --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Restroom Metrics</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Restroom Minutes (Per Workday)</label>
                                <div class="input-group">
                                    <input type="number" id="pp-toilet-mins" class="form-control form-control-lg rounded-start-3" value="15" min="1" max="180">
                                    <span class="input-group-text rounded-end-3">Minutes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-dollar-sign me-2"></i> Compute Bathroom Revenue
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Restroom Revenue) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Bathroom Compensated Revenue</h5>
                        <p class="text-muted small mb-0">Total earnings accumulated while performing corporate restroom maintenance</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Restroom Earnings
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                {{-- Yearly Toilet Cash --}}
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0 font-monospace" id="out-yearly-cash">$0.00</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Yearly Toilet Revenue</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-productivity-badge" style="background-color: #10b981; color: #fff;">EXTREMELY PRODUCTIVE</span>
                    </div>
                </div>

                {{-- Periodic breakdowns --}}
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Weekly Cash</div>
                                <div class="h5 fw-bold mb-0 text-success font-monospace" id="out-weekly-cash">$0.00</div>
                                <div class="x-small text-muted fw-bold">Compensated</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Monthly Cash</div>
                                <div class="h5 fw-bold mb-0 text-success font-monospace" id="out-monthly-cash">$0.00</div>
                                <div class="x-small text-muted fw-bold">Compensated</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Annual Restroom Time</div>
                                <div class="h5 fw-bold mb-0 text-secondary font-monospace" id="out-yearly-hours">0 Hours</div>
                                <div class="x-small text-muted fw-bold">Accumulated toilet time per year</div>
                            </div>
                        </div>
                    </div>

                    {{-- Fun Purchasing comparisons --}}
                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center"> Restroom Purchasing Power Equivalents</h6>
                        <ul class="list-unstyled mb-0 small text-secondary" id="out-purchases">
                            {{-- Injected dynamically --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --danger-soft: #fef2f2;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }
    .bg-danger-soft { background-color: var(--danger-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1.5px solid #e2e8f0; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.05rem; padding: 0.65rem 0.85rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .font-monospace { font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const salInput = document.getElementById('pp-salary');
    const hrsInput = document.getElementById('pp-hours-wk');
    const daysInput = document.getElementById('pp-days-wk');
    const minsInput = document.getElementById('pp-toilet-mins');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    
    const outYearly = document.getElementById('out-yearly-cash');
    const outWeekly = document.getElementById('out-weekly-cash');
    const outMonthly = document.getElementById('out-monthly-cash');
    const outHours = document.getElementById('out-yearly-hours');
    const outBadge = document.getElementById('out-productivity-badge');
    const outPurchases = document.getElementById('out-purchases');

    function calculate() {
        const salary = parseFloat(salInput.value) || 0;
        const hrsWk = parseFloat(hrsInput.value) || 0;
        const daysWk = parseFloat(daysInput.value) || 0;
        const minsDay = parseFloat(minsInput.value) || 0;

        if (salary <= 0 || hrsWk <= 0 || daysWk <= 0 || minsDay <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Counting Nickels...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Yearly working hours (assuming 52 weeks)
            const yearlyWorkHours = hrsWk * 52;
            const hourlyRate = salary / yearlyWorkHours;
            const minRate = hourlyRate / 60;

            const dailyRestroomCash = minsDay * minRate;
            const weeklyRestroomCash = dailyRestroomCash * daysWk;
            const yearlyRestroomCash = weeklyRestroomCash * 52;
            const monthlyRestroomCash = yearlyRestroomCash / 12;

            // Accumulated restroom time per year (Hours)
            const totalHoursYear = (minsDay * daysWk * 52) / 60;

            // Formatter
            const fmt = (val) => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(val);

            outYearly.textContent = fmt(yearlyRestroomCash);
            outWeekly.textContent = fmt(weeklyRestroomCash);
            outMonthly.textContent = fmt(monthlyRestroomCash);
            outHours.textContent = `${Math.round(totalHoursYear)} Hours`;

            // Dynamic badges based on toilet hours
            let badge = 'STANDARD RESTROOM USER';
            let badgeColor = '#3b82f6';
            if (minsDay >= 30) {
                badge = 'TOILET WIZARD';
                badgeColor = '#ec4899';
            } else if (minsDay >= 15) {
                badge = 'EFFICIENT EARNER';
                badgeColor = '#10b981';
            }

            outBadge.textContent = badge;
            outBadge.style.backgroundColor = badgeColor;

            // Dynamic Purchase power lists
            const list = [];
            list.push(`Premium Coffee Cups ($5.50 each): <strong>${Math.floor(yearlyRestroomCash / 5.5).toLocaleString()} cups</strong>.`);
            list.push(`Netflix Subscriptions ($15.00/mo): <strong>${Math.floor(yearlyRestroomCash / 15).toLocaleString()} months</strong>.`);
            list.push(`Delicious Burritos ($12.00 each): <strong>${Math.floor(yearlyRestroomCash / 12).toLocaleString()} burritos</strong>.`);
            list.push(`Toilet Paper Rolls ($1.00 each): <strong>${Math.floor(yearlyRestroomCash).toLocaleString()} rolls</strong>.`);

            outPurchases.innerHTML = list.map(item => `
                <li class="mb-2 d-flex align-items-center justify-content-between border-bottom pb-1">
                    <span><i class="fas fa-piggy-bank text-success me-2"></i>${item.split(':')[0]}</span>
                    <span class="fw-bold text-dark">${item.split(':')[1]}</span>
                </li>
            `).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-dollar-sign me-2"></i> Compute Bathroom Revenue';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        salInput.value = '65000';
        hrsInput.value = '40';
        daysInput.value = '5';
        minsInput.value = '15';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Corporate Restroom Revenue Statement\n━━━━━━━━━━━━━━━━━━━━━━\nAnnual Gross Salary: $${salInput.value}\nToilet time: ${minsInput.value} min/day\nAccumulated Bathroom Hours: ${outHours.textContent}/yr\n━━━━━━━━━━━━━━━━━━━━━━\nYearly Restroom Revenue: ${outYearly.textContent}\nMonthly Restroom Revenue: ${outMonthly.textContent}\nWeekly Restroom Revenue: ${outWeekly.textContent}\nRestroom Earner Tier: ${outBadge.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btnCopy.innerHTML;
            btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            btnCopy.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => {
                btnCopy.innerHTML = originalText;
                btnCopy.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
