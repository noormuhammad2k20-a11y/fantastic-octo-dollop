<div class="interactive-wrapper">
    {{-- Input Card (Smoking Habit Parameters) --}}
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                {{-- Habit Inputs --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Habit Details</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Currency Symbol</label>
                                <select id="smk-currency" class="form-select form-select-lg rounded-3">
                                    <option value="$">$ (USD/CAD/AUD)</option>
                                    <option value="€">€ (EUR)</option>
                                    <option value="£">£ (GBP)</option>
                                    <option value="₹">₹ (INR)</option>
                                    <option value="₪">₪ (ILS)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Packs Per Day</label>
                                <input type="number" id="smk-packs" class="form-control form-control-lg rounded-3" value="1" min="0.1" step="0.1">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Price Per Pack</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3" id="smk-currency-addon">$</span>
                                    <input type="number" id="smk-price" class="form-control form-control-lg rounded-end-3" value="9.00" min="0.01" step="0.05">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Timeframe & Investment Inputs --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-4 h-100 bg-white" style="border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Financial Analysis Settings</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Analysis Timeframe (Years)</label>
                                <input type="number" id="smk-years" class="form-control form-control-lg rounded-3" value="10" min="1" max="60">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Alternative Investment Annual Return (%)</label>
                                <div class="input-group">
                                    <input type="number" id="smk-return" class="form-control form-control-lg rounded-start-3" value="8" min="0" max="25" step="0.5">
                                    <span class="input-group-text rounded-end-3">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-calculator me-2"></i> Compute Habit Cost
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    {{-- Output Card (Habit Analysis) --}}
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Financial Damage Report</h5>
                        <p class="text-muted small mb-0">Total cost breakdown and investment comparison metrics</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Financial Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                {{-- Main Metric --}}
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-dark mb-0 font-monospace" id="out-total-spent">0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Direct Habit Cost</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold text-uppercase" id="out-cigarettes" style="background-color: #ef4444; color: #fff;">0 Cigarettes</span>
                    </div>
                </div>

                {{-- Investment Column --}}
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Lost Investment Wealth</div>
                                <div class="h5 fw-bold mb-0 text-danger" id="out-invested">0</div>
                                <div class="x-small text-muted fw-bold" id="out-lost-interest">Interest forgone</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4 bg-light border text-center">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Annual Habit Expense</div>
                                <div class="h5 fw-bold mb-0 text-dark" id="out-annual">0</div>
                                <div class="x-small text-muted fw-bold" id="out-monthly">0 / Month</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-3 rounded-4 bg-white border">
                        <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 text-center">Cumulative Timeline Comparison</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0 small text-secondary">
                                <thead>
                                    <tr class="border-bottom text-dark fw-bold">
                                        <th>Interval</th>
                                        <th class="text-end">Direct Cash Spent</th>
                                        <th class="text-end" id="tbl-invest-header">If Invested (8%)</th>
                                    </tr>
                                </thead>
                                <tbody id="out-table-body">
                                    {{-- Injected dynamically --}}
                                </tbody>
                            </table>
                        </div>
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
    const curSelect = document.getElementById('smk-currency');
    const curAddon = document.getElementById('smk-currency-addon');
    
    const packsInput = document.getElementById('smk-packs');
    const priceInput = document.getElementById('smk-price');
    const yearsInput = document.getElementById('smk-years');
    const returnInput = document.getElementById('smk-return');

    const btnCalculate = document.getElementById('btn-calculate');
    const btnReset = document.getElementById('btn-reset');
    const btnCopy = document.getElementById('btn-copy');

    const resultCard = document.getElementById('result-card');
    const outTotalSpent = document.getElementById('out-total-spent');
    const outCigarettes = document.getElementById('out-cigarettes');
    const outInvested = document.getElementById('out-invested');
    const outLostInterest = document.getElementById('out-lost-interest');
    const outAnnual = document.getElementById('out-annual');
    const outMonthly = document.getElementById('out-monthly');
    const tblInvestHeader = document.getElementById('tbl-invest-header');
    const outTableBody = document.getElementById('out-table-body');

    // Currency selector synchronization
    curSelect.addEventListener('change', function() {
        curAddon.textContent = curSelect.value;
    });

    function calculate() {
        const packs = parseFloat(packsInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        const years = parseInt(yearsInput.value) || 1;
        const returnRate = (parseFloat(returnInput.value) || 0) / 100;
        const currency = curSelect.value;

        if (packs <= 0 || price <= 0 || years <= 0) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Computing...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const daily = packs * price;
            const monthly = daily * 30.44;
            const annual = daily * 365.25;

            // Direct Cumulative Cost
            const totalSpent = annual * years;
            const totalCigarettes = packs * 20 * 365.25 * years; // 20 cigarettes in a standard pack

            // Opportunity Cost Compound Interest
            // FV = PMT * (((1 + r)^n - 1) / r)
            const r = returnRate / 12;
            const n = years * 12;
            let fv = 0;
            
            if (r > 0) {
                fv = monthly * ((Math.pow(1 + r, n) - 1) / r);
            } else {
                fv = totalSpent;
            }

            const lostInterest = fv - totalSpent;

            // Update UI Output
            outTotalSpent.textContent = `${currency}${Math.round(totalSpent).toLocaleString()}`;
            outCigarettes.textContent = `${Math.round(totalCigarettes).toLocaleString()} Cigarettes`;
            outInvested.textContent = `${currency}${Math.round(fv).toLocaleString()}`;
            outLostInterest.textContent = `Forfeited wealth: +${currency}${Math.round(lostInterest).toLocaleString()}`;
            outAnnual.textContent = `${currency}${Math.round(annual).toLocaleString()}/yr`;
            outMonthly.textContent = `${currency}${Math.round(monthly).toLocaleString()} / month`;

            tblInvestHeader.textContent = `If Invested (${(returnRate * 100).toFixed(1)}%)`;

            // Helper function to calculate FV for specific intervals
            function getFVForYears(y) {
                const n_y = y * 12;
                if (r > 0) {
                    return monthly * ((Math.pow(1 + r, n_y) - 1) / r);
                }
                return annual * y;
            }

            // Build Timeline Table Rows
            const intervals = [
                { label: '1 Month', cost: monthly, invest: monthly },
                { label: '1 Year', cost: annual, invest: getFVForYears(1) },
                { label: '5 Years', cost: annual * 5, invest: getFVForYears(5) },
                { label: '10 Years', cost: annual * 10, invest: getFVForYears(10) },
                { label: '20 Years', cost: annual * 20, invest: getFVForYears(20) },
                { label: '40 Years (Lifetime)', cost: annual * 40, invest: getFVForYears(40) }
            ];

            outTableBody.innerHTML = intervals.map(item => `
                <tr class="border-bottom-soft">
                    <td class="fw-bold text-dark">${item.label}</td>
                    <td class="text-end text-secondary font-monospace">${currency}${Math.round(item.cost).toLocaleString()}</td>
                    <td class="text-end text-danger fw-bold font-monospace">${currency}${Math.round(item.invest).toLocaleString()}</td>
                </tr>
            `).join('');

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-calculator me-2"></i> Compute Habit Cost';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calculate);

    btnReset.addEventListener('click', function() {
        packsInput.value = '1';
        priceInput.value = '9.00';
        yearsInput.value = '10';
        returnInput.value = '8';
        resultCard.classList.add('d-none');
    });

    btnCopy.addEventListener('click', function() {
        const text = `Smoking Financial Impact Report\n━━━━━━━━━━━━━━━━━━━━━━\nPacks Per Day: ${packsInput.value}\nCost Per Pack: ${curSelect.value}${priceInput.value}\nAnalysis Window: ${yearsInput.value} Years\nCumulative Cost: ${outTotalSpent.textContent}\nCigarettes Ingested: ${outCigarettes.textContent}\nInvestment Opportunity Cost: ${outInvested.textContent}\n━━━━━━━━━━━━━━━━━━━━━━\nGenerated via ToolsHub.`;
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
