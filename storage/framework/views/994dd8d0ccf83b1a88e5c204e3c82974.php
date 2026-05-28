<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Commute Metrics</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">One-Way Time (mins)</label>
                                <input type="number" id="commute-time" class="form-control form-control-lg rounded-3" value="45" min="1" step="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">One-Way Distance (mi)</label>
                                <input type="number" id="commute-dist" class="form-control form-control-lg rounded-3" value="20" min="0" step="0.5">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Career & Wages</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Hourly Wage ($)</label>
                                <input type="number" id="hourly-wage" class="form-control form-control-lg rounded-3" value="25" min="0" step="0.50">
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Career Length (yrs)</label>
                                <input type="number" id="career-years" class="form-control form-control-lg rounded-3" value="30" min="1" max="60">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="p-4 rounded-4 bg-light border">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Work Habits</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Office Days per Week</label>
                                <select id="days-week" class="form-select form-select-lg rounded-3">
                                    <option value="1">1 Day</option>
                                    <option value="2">2 Days (Hybrid)</option>
                                    <option value="3">3 Days (Hybrid)</option>
                                    <option value="4">4 Days</option>
                                    <option value="5" selected>5 Days (Standard)</option>
                                    <option value="6">6 Days</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Transportation Type</label>
                                <select id="transport-type" class="form-select form-select-lg rounded-3">
                                    <option value="car_gas" selected>Gasoline Car (Avg: 25 MPG)</option>
                                    <option value="car_ev">Electric Vehicle (EV)</option>
                                    <option value="transit">Public Transit (Train / Bus)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-time="20" data-dist="8" data-wage="20" data-years="25" data-days="5">
                    Short Commute (20m, 5 Days)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-time="60" data-dist="35" data-wage="35" data-years="35" data-days="5">
                    Super Commuter (60m, 5 Days)
                </button>
                <button class="btn btn-light-v2 btn-sm rounded-pill px-4 fw-bold shadow-sm preset-btn" data-time="45" data-dist="20" data-wage="50" data-years="20" data-days="3">
                    Hybrid Office (45m, 3 Days)
                </button>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-warning btn-lg rounded-pill px-5 shadow-sm transition-all text-dark fw-bold" id="btn-calculate" style="background-color: #ffb300; border-color: #ffb300;">
                    <i class="fas fa-calculator me-2"></i> Reveal Wasted Time
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background-color: #fff8e1; color: #ffb300;">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Your Lifetime Commute Cost</h5>
                        <p class="text-muted small mb-0">A detailed reality check of travel time and expense</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="background-color: #ffb300; border-color: #ffb300; color: #1e293b;">
                        <i class="fas fa-copy me-1"></i> Copy Analysis
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="text-center mb-4">
                <div class="display-3 fw-bold mb-1" style="color: #e65100;" id="result-days-wasted">469 Days</div>
                <p class="text-muted mb-0 fw-bold text-uppercase small letter-spacing-1">Total Lifetime Hours Converted into 24-Hour Days</p>
            </div>

            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-coins me-2 text-warning"></i>Resource & Time Breakdown</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Total Hours Wasted:</span>
                                <span class="fw-bold text-dark" id="result-hours-wasted">11,250 hrs</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Potential Lost Income:</span>
                                <span class="fw-bold text-success" id="result-lost-earnings">$281,250</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">Lifetime Miles Traveled:</span>
                                <span class="fw-bold text-dark" id="result-miles">300,000 mi</span>
                            </li>
                        </ul>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="p-4 rounded-4 bg-light border h-100">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-globe-americas me-2 text-primary"></i>Perspective & Equivalencies</h6>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Earth Circumnavigations:</span>
                                <span class="fw-bold text-dark" id="result-earth-trips">12.0 times</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between">
                                <span class="text-muted">Books You Could Have Read:</span>
                                <span class="fw-bold text-dark" id="result-books">2,250 books</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-light d-flex justify-content-between border-bottom-0">
                                <span class="text-muted">CO₂ Emissions Generated:</span>
                                <span class="fw-bold text-danger" id="result-co2">264,000 lbs</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }
    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }
    .form-control-lg, .form-select-lg { border: 1.5px solid #cbd5e1; border-radius: 12px; font-size: 1rem; }
    .form-control:focus, .form-select:focus { border-color: #ffb300; box-shadow: 0 0 0 4px rgba(255, 179, 0, 0.1); outline: none; }
    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #f1f5f9 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const timeIn = document.getElementById('commute-time');
    const distIn = document.getElementById('commute-dist');
    const wageIn = document.getElementById('hourly-wage');
    const yearsIn = document.getElementById('career-years');
    const daysIn = document.getElementById('days-week');
    const transportIn = document.getElementById('transport-type');
    const resultCard = document.getElementById('result-card');
    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    function calculateCommute() {
        const timeVal = parseFloat(timeIn.value) || 0;
        const distVal = parseFloat(distIn.value) || 0;
        const wageVal = parseFloat(wageIn.value) || 0;
        const yearsVal = parseFloat(yearsIn.value) || 0;
        const daysVal = parseFloat(daysIn.value) || 5;
        const transport = transportIn.value;

        if (timeVal <= 0 || distVal < 0 || wageVal < 0 || yearsVal <= 0) {
            alert("Please enter valid time, distance, and career parameters.");
            return;
        }

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing Wasted Potential...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            // Minutes per year
            const minsPerWeek = timeVal * 2 * daysVal;
            const hoursPerWeek = minsPerWeek / 60;
            const hoursPerYear = hoursPerWeek * 50; // 50 work weeks
            const totalHours = hoursPerYear * yearsVal;
            const totalDays24H = totalHours / 24;

            // Financial loss (lost opportunity cost)
            const lostEarnings = totalHours * wageVal;

            // Distance Traveled
            const distPerWeek = distVal * 2 * daysVal;
            const totalDist = distPerWeek * 50 * yearsVal;

            // Equivalent circumnavigations (24,901 miles around equator)
            const circumnavigations = totalDist / 24901;

            // Books could have read (1 book per 5 hours of reading)
            const booksCount = totalHours / 5;

            // CO2 emissions per mile in lbs
            let co2Factor = 0.88; // Gas car standard
            if (transport === 'car_ev') co2Factor = 0.18; // Low grid emissions
            if (transport === 'transit') co2Factor = 0.22; // Shared ride public transit average

            const co2Lbs = totalDist * co2Factor;

            // Format results
            document.getElementById('result-days-wasted').innerText = Math.round(totalDays24H) + " Days";
            document.getElementById('result-hours-wasted').innerText = Math.round(totalHours).toLocaleString() + " hrs";
            document.getElementById('result-lost-earnings').innerText = "$" + Math.round(lostEarnings).toLocaleString();
            document.getElementById('result-miles').innerText = Math.round(totalDist).toLocaleString() + " miles";
            document.getElementById('result-earth-trips').innerText = circumnavigations.toFixed(1) + " times";
            document.getElementById('result-books').innerText = Math.round(booksCount).toLocaleString() + " books";
            document.getElementById('result-co2').innerText = Math.round(co2Lbs).toLocaleString() + " lbs";

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Reveal Wasted Time';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculateCommute);

    btnReset.addEventListener('click', () => {
        timeIn.value = 45;
        distIn.value = 20;
        wageIn.value = 25;
        yearsIn.value = 30;
        daysIn.value = "5";
        transportIn.value = "car_gas";
        resultCard.classList.add('d-none');
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            timeIn.value = this.dataset.time;
            distIn.value = this.dataset.dist;
            wageIn.value = this.dataset.wage;
            yearsIn.value = this.dataset.years;
            daysIn.value = this.dataset.days;
            calculateCommute();
        });
    });

    btnCopy.addEventListener('click', function() {
        const days = document.getElementById('result-days-wasted').innerText;
        const hours = document.getElementById('result-hours-wasted').innerText;
        const lostEarnings = document.getElementById('result-lost-earnings').innerText;
        const miles = document.getElementById('result-miles').innerText;
        const earth = document.getElementById('result-earth-trips').innerText;
        const books = document.getElementById('result-books').innerText;
        const co2 = document.getElementById('result-co2').innerText;

        const text = `COMMUTE LIFE WASTED REPORT\n` +
                     `===========================\n` +
                     `One-Way Time: ${timeIn.value} mins | One-Way Distance: ${distIn.value} miles\n` +
                     `Days Worked: ${daysIn.value} days/wk | Hourly Wage: $${wageIn.value}\n` +
                     `Career Length: ${yearsIn.value} years\n\n` +
                     `LIFETIME TIME LOST: ${hours} (${days} full 24-hr days)\n` +
                     `POTENTIAL LOST EARNINGS: ${lostEarnings}\n` +
                     `LIFETIME TRAVEL DISTANCE: ${miles}\n\n` +
                     `PERSPECTIVES:\n` +
                     `- Circumferences of Earth: ${earth}\n` +
                     `- Books You Could Have Read: ${books}\n` +
                     `- Est. CO2 Emissions: ${co2}\n\n` +
                     `Generated via ToolsHub Commute Life Wasted Calculator.`;

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
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\commute-life-wasted.blade.php ENDPATH**/ ?>