<div class="tool-interactive-container">
    <div class="row g-4">
        <!-- Input Side -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: var(--radius-lg);">
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                        <i class="fas fa-edit text-accent me-2"></i> Loan Details
                    </h5>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase">Loan Amount</label>
                            <input type="number" id="emi-amount-val" class="form-control form-control-sm border-0 fw-bold text-end text-accent" value="500000" style="width: 140px; background: var(--bg-surface); border-radius: 8px;">
                        </div>
                        <input type="range" class="form-range custom-range" id="emi-amount" min="10000" max="10000000" step="10000" value="500000">
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase">Interest Rate (% p.a)</label>
                            <input type="number" id="emi-rate-val" class="form-control form-control-sm border-0 fw-bold text-end text-accent" value="8.5" step="0.1" style="width: 100px; background: var(--bg-surface); border-radius: 8px;">
                        </div>
                        <input type="range" class="form-range custom-range" id="emi-rate" min="1" max="25" step="0.1" value="8.5">
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase">Loan Tenure (Years)</label>
                            <input type="number" id="emi-tenure-val" class="form-control form-control-sm border-0 fw-bold text-end text-accent" value="5" style="width: 100px; background: var(--bg-surface); border-radius: 8px;">
                        </div>
                        <input type="range" class="form-range custom-range" id="emi-tenure" min="1" max="30" step="1" value="5">
                    </div>
                </div>

                <div class="p-3 rounded-4 mb-4 border" style="background: var(--accent-soft);">
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" type="checkbox" id="emi-prepayment-toggle">
                        <label class="form-check-label small fw-bold text-dark" for="emi-prepayment-toggle">Advanced Options (Fees/Start Date)</label>
                    </div>
                    <div id="extra-options" class="d-none mt-3 row g-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Processing Fee (%)</label>
                            <input type="number" id="emi-fee" class="form-control border-2" value="0" step="0.1" style="border-radius: 8px;">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Starting Month</label>
                            <input type="month" id="emi-start" class="form-control border-2" style="border-radius: 8px;">
                        </div>
                    </div>
                </div>

                <button id="emi-recalc-btn" class="btn d-block mx-auto btn-accent fw-bold rounded-pill shadow-sm d-lg-none py-3 px-5 fw-bold rounded-pill shadow-sm">
                    <i class="fas fa-sync-alt me-2"></i> Recalculate
                </button>
            </div>
        </div>

        <!-- Result Side -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 h-100 bg-white text-center" style="border-radius: var(--radius-lg);">
                <h5 class="fw-bold text-dark mb-4">Payment Summary</h5>
                
                <div class="mb-4 py-4 bg-light rounded-4 border border-dashed">
                    <p class="text-muted small text-uppercase fw-bold mb-1">Monthly EMI</p>
                    <div id="res-emi" class="fw-black text-accent mb-0" style="font-size: 3rem; letter-spacing: -2px;">10,258</div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6 border-end">
                        <p class="text-muted small text-uppercase fw-bold mb-1">Total Interest</p>
                        <h5 id="res-interest" class="fw-bold text-dark">1,15,480</h5>
                    </div>
                    <div class="col-6">
                        <p class="text-muted small text-uppercase fw-bold mb-1">Total Payment</p>
                        <h5 id="res-total" class="fw-bold text-dark">6,15,480</h5>
                    </div>
                </div>

                <!-- Simple Chart (CSS based) -->
                <div class="mt-2 mb-4 px-2">
                    <div class="progress rounded-pill shadow-sm" style="height: 35px; background: #eee;">
                        <div id="chart-principal" class="progress-bar" role="progressbar" style="width: 80%; background: var(--accent-gradient);" title="Principal"></div>
                        <div id="chart-interest" class="progress-bar bg-secondary opacity-50" role="progressbar" style="width: 20%;" title="Interest"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-3 small fw-bold">
                        <span class="text-accent"><i class="fas fa-circle me-1"></i> Principal</span>
                        <span class="text-secondary"><i class="fas fa-circle me-1"></i> Interest</span>
                    </div>
                </div>

                <div class="vstack gap-2 mt-auto">
                    <button id="emi-schedule-btn" class="btn btn-accent rounded-pill py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#scheduleModal">
                        <i class="fas fa-table me-2"></i> View Full Schedule
                    </button>
                    <button class="btn btn-outline-secondary rounded-pill py-2 fw-bold" onclick="window.print()">
                        <i class="fas fa-print me-2"></i> Print as PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Amortization Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 p-4 bg-light rounded-top-4">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-calendar-alt text-accent me-2"></i> Yearly Amortization Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="sticky-top" style="background: var(--bg-surface);">
                            <tr>
                                <th class="ps-4 border-0">Year</th>
                                <th class="border-0">Principal (A)</th>
                                <th class="border-0">Interest (B)</th>
                                <th class="border-0">Total (A+B)</th>
                                <th class="pe-4 border-0">Balance</th>
                            </tr>
                        </thead>
                        <tbody id="schedule-body">
                            <!-- Rows will be injected here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --accent: #FF6A00;
        --accent-soft: rgba(255, 106, 0, 0.05);
        --accent-gradient: linear-gradient(135deg, #FF6A00 0%, #FF8C33 100%);
    }

    .custom-range::-webkit-slider-thumb { background: var(--accent); }
    .custom-range::-moz-range-thumb { background: var(--accent); }
    .btn-accent { background: var(--accent-gradient); color: white; border: none; }
    .btn-accent:hover { color: white; opacity: 0.9; transform: translateY(-1px); }
    .text-accent { color: var(--accent) !important; }
    .bg-accent-soft { background-color: var(--accent-soft); }
    .progress-bar { transition: width 0.6s ease; }
    .modal-lg { max-width: 850px; }
    .table thead th { font-size: 0.75rem; text-transform: uppercase; padding: 15px; color: var(--text-muted); font-weight: 800; }
    .table tbody td { padding: 15px; font-size: 0.95rem; border-color: #f8f9fa; }
    .fw-black { font-weight: 900; }
    
    @media print {
        .navbar, .site-footer, .breadcrumb, h1, .lead, #emi-recalc-btn, .btn, .related-tools-section { display: none !important; }
        .col-lg-7, .col-lg-5 { width: 100% !important; flex: 0 0 100% !important; max-width: 100% !important; }
        .card { box-shadow: none !important; border: 1px solid #eee !important; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['emi-amount', 'emi-rate', 'emi-tenure'];
    const amountVal = document.getElementById('emi-amount-val');
    const rateVal = document.getElementById('emi-rate-val');
    const tenureVal = document.getElementById('emi-tenure-val');
    const prepaymentToggle = document.getElementById('emi-prepayment-toggle');
    const extraOptions = document.getElementById('extra-options');

    // Handle Sliders and Inputs
    inputs.forEach(id => {
        const slider = document.getElementById(id);
        const input = document.getElementById(id + '-val');
        
        slider.addEventListener('input', () => {
            input.value = slider.value;
            calculate();
        });
        
        input.addEventListener('input', () => {
            slider.value = input.value;
            calculate();
        });
    });

    prepaymentToggle.addEventListener('change', () => {
        extraOptions.classList.toggle('d-none', !prepaymentToggle.checked);
        calculate();
    });

    // Smart Prefill System
    const path = window.location.pathname;
    if (path.includes('2-lakh')) setVal('emi-amount', 200000);
    else if (path.includes('5-lakh')) setVal('emi-amount', 500000);
    else if (path.includes('car-loan') || path.includes('bike-loan') || path.includes('auto-loan')) {
        setVal('emi-rate', 9.5);
        setVal('emi-tenure', 5);
        if (path.includes('bike')) setVal('emi-amount', 80000);
    } else if (path.includes('home-loan') || path.includes('mortgage')) {
        setVal('emi-rate', 8.5);
        setVal('emi-tenure', 20);
    } else if (path.includes('personal-loan')) {
        setVal('emi-rate', 12.5);
        setVal('emi-tenure', 3);
    }

    function setVal(id, val) {
        const slider = document.getElementById(id);
        const input = document.getElementById(id + '-val');
        if (slider) slider.value = val;
        if (input) input.value = val;
    }

    function calculate() {
        const P = parseFloat(document.getElementById('emi-amount').value);
        const R_annual = parseFloat(document.getElementById('emi-rate').value);
        const N_years = parseFloat(document.getElementById('emi-tenure').value);
        
        const R = R_annual / 12 / 100;
        const N = N_years * 12;

        const emi = (P * R * Math.pow(1 + R, N)) / (Math.pow(1 + R, N) - 1);
        const totalPayment = emi * N;
        const totalInterest = totalPayment - P;

        // Display results
        document.getElementById('res-emi').innerText = formatCurrency(emi);
        document.getElementById('res-interest').innerText = formatCurrency(totalInterest);
        document.getElementById('res-total').innerText = formatCurrency(totalPayment);

        // Update Chart
        const intPercent = (totalInterest / totalPayment) * 100;
        document.getElementById('chart-principal').style.width = (100 - intPercent) + '%';
        document.getElementById('chart-interest').style.width = intPercent + '%';

        // Update Schedule
        generateSchedule(P, R, N_years);
    }

    function generateSchedule(P, R, years) {
        const body = document.getElementById('schedule-body');
        body.innerHTML = '';
        let balance = P;
        const emi = (P * R * Math.pow(1 + R, years * 12)) / (Math.pow(1 + R, years * 12) - 1);

        for (let y = 1; y <= years; y++) {
            let yearlyPrincipal = 0;
            let yearlyInterest = 0;
            
            for (let m = 1; m <= 12; m++) {
                let interest = balance * R;
                let principal = emi - interest;
                yearlyPrincipal += principal;
                yearlyInterest += interest;
                balance -= principal;
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="ps-4 fw-bold text-dark">Year ${y}</td>
                <td class="text-secondary">${formatCurrency(yearlyPrincipal)}</td>
                <td class="text-secondary">${formatCurrency(yearlyInterest)}</td>
                <td class="fw-bold text-dark">${formatCurrency(yearlyPrincipal + yearlyInterest)}</td>
                <td class="pe-4 text-accent fw-medium">${formatCurrency(Math.max(0, balance))}</td>
            `;
            body.appendChild(row);
        }
    }

    function formatCurrency(val) {
        return '$' + val.toLocaleString('en-US', { maximumFractionDigits: 0 });
    }

    // Initial calculation
    calculate();
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['emi-amount', 'emi-rate', 'emi-tenure'];
    const amountVal = document.getElementById('emi-amount-val');
    const rateVal = document.getElementById('emi-rate-val');
    const tenureVal = document.getElementById('emi-tenure-val');
    const prepaymentToggle = document.getElementById('emi-prepayment-toggle');
    const extraOptions = document.getElementById('extra-options');

    // Handle Sliders and Inputs
    inputs.forEach(id => {
        const slider = document.getElementById(id);
        const input = document.getElementById(id + '-val');
        
        slider.addEventListener('input', () => {
            input.value = slider.value;
            calculate();
        });
        
        input.addEventListener('input', () => {
            slider.value = input.value;
            calculate();
        });
    });

    prepaymentToggle.addEventListener('change', () => {
        extraOptions.classList.toggle('d-none', !prepaymentToggle.checked);
        calculate();
    });

    // Smart Prefill System
    const path = window.location.pathname;
    if (path.includes('2-lakh')) setVal('emi-amount', 200000);
    else if (path.includes('5-lakh')) setVal('emi-amount', 500000);
    else if (path.includes('car-loan') || path.includes('bike-loan') || path.includes('auto-loan')) {
        setVal('emi-rate', 9.5);
        setVal('emi-tenure', 5);
        if (path.includes('bike')) setVal('emi-amount', 100000);
    } else if (path.includes('home-loan') || path.includes('mortgage')) {
        setVal('emi-rate', 8.5);
        setVal('emi-tenure', 20);
    } else if (path.includes('personal-loan')) {
        setVal('emi-rate', 12.5);
        setVal('emi-tenure', 3);
    } else if (path.includes('gold-loan')) {
        setVal('emi-rate', 7.5);
        setVal('emi-tenure', 2);
    }

    function setVal(id, val) {
        const slider = document.getElementById(id);
        const input = document.getElementById(id + '-val');
        if (slider) slider.value = val;
        if (input) input.value = val;
    }

    function calculate() {
        const P = parseFloat(document.getElementById('emi-amount').value);
        const R_annual = parseFloat(document.getElementById('emi-rate').value);
        const N_years = parseFloat(document.getElementById('emi-tenure').value);
        
        const R = R_annual / 12 / 100;
        const N = N_years * 12;

        const emi = (P * R * Math.pow(1 + R, N)) / (Math.pow(1 + R, N) - 1);
        const totalPayment = emi * N;
        const totalInterest = totalPayment - P;

        // Display results
        document.getElementById('res-emi').innerText = formatCurrency(emi);
        document.getElementById('res-interest').innerText = formatCurrency(totalInterest);
        document.getElementById('res-total').innerText = formatCurrency(totalPayment);

        // Update Chart
        const intPercent = (totalInterest / totalPayment) * 100;
        document.getElementById('chart-principal').style.width = (100 - intPercent) + '%';
        document.getElementById('chart-interest').style.width = intPercent + '%';

        // Update Schedule
        generateSchedule(P, R, N_years);
    }

    function generateSchedule(P, R, years) {
        const body = document.getElementById('schedule-body');
        body.innerHTML = '';
        let balance = P;
        const emi = (P * R * Math.pow(1 + R, years * 12)) / (Math.pow(1 + R, years * 12) - 1);

        for (let y = 1; y <= years; y++) {
            let yearlyPrincipal = 0;
            let yearlyInterest = 0;
            
            for (let m = 1; m <= 12; m++) {
                let interest = balance * R;
                let principal = emi - interest;
                yearlyPrincipal += principal;
                yearlyInterest += interest;
                balance -= principal;
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="ps-4 fw-bold">Year ${y}</td>
                <td>${formatCurrency(yearlyPrincipal)}</td>
                <td>${formatCurrency(yearlyInterest)}</td>
                <td class="fw-bold">${formatCurrency(yearlyPrincipal + yearlyInterest)}</td>
                <td class="pe-4 text-muted">${formatCurrency(Math.max(0, balance))}</td>
            `;
            body.appendChild(row);
        }
    }

    function formatCurrency(val) {
        return '$' + val.toLocaleString('en-US', { maximumFractionDigits: 0 });
    }

    // Initial calculation
    calculate();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\loan-emi-calculator.blade.php ENDPATH**/ ?>