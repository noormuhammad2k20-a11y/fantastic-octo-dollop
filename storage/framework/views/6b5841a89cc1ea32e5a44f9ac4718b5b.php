<div class="row g-4 house-affordability-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-12 mb-2">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-wallet text-indigo me-2"></i>Household Income & Debt</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Monthly Take-Home Pay (After Tax)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="haf-income" class="form-control form-control-lg border-start-0 ps-0" value="7000" step="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Current Mo. Debt (Car, Student)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="haf-debt" class="form-control form-control-lg border-start-0 ps-0" value="600" step="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom tooltip-label" title="Food, Fun, Travel, Hobbies, Basic Savings">Desired Lifestyle Spend / Month</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="haf-lifestyle" class="form-control form-control-lg border-start-0 ps-0" value="2500" step="100">
                        </div>
                    </div>

                    
                    <div class="col-12 mb-2 mt-4">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-file-contract text-indigo me-2"></i>Mortgage Terms & Property</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Available Down Payment</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="haf-down" class="form-control form-control-lg border-start-0 ps-0" value="60000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="haf-rate" class="form-control form-control-lg border-end-0" value="6.5" step="0.125">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Loan Term</label>
                        <select id="haf-term" class="form-select form-select-lg">
                            <option value="30" selected>30 Years</option>
                            <option value="15">15 Years</option>
                        </select>
                    </div>

                    
                    <div class="col-md-6 mt-3">
                        <label class="form-label-custom">Annual Property Tax Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="haf-taxrate" class="form-control form-control-lg border-end-0" value="1.2" step="0.1">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="form-label-custom">Monthly HOA & Insurance Est.</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="haf-hoains" class="form-control form-control-lg border-start-0 ps-0" value="300" step="50">
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 haf-quick" data-p="1">Frugal First-Time Buyer</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 haf-quick" data-p="2">DINKs Premium Buyer</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 haf-quick" data-p="3">High-Debt Buyer</button>
                    <div class="flex-grow-1"></div>
                    <button type="button" id="haf-calculate" class="btn btn-primary px-4 py-2 fw-bold text-white shadow-sm" style="min-width: 280px; max-width: 100%; background:#4f46e5; border-color:#4f46e5;">Calculate Scenario</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#4f46e5;--tool-bg:#f8fafc;">
            <div class="row align-items-center mb-4">
                <div class="col-md-7 text-center text-md-start">
                    <span class="output-hero-label text-indigo">MAX SAFE HOME PRICE</span>
                    <h2 class="output-hero-value m-0" id="out-max-price">$0</h2>
                    <p class="text-muted small mt-2 fw-bold mb-0">Based on keeping your <span class="text-dark" id="out-lifestyle-target"></span> lifestyle intact.</p>
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <div class="payment-box">
                        <span class="stat-card-label">MAX MONTHLY HOUSING (PITI)</span>
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <span class="fs-2 fw-black text-indigo" id="out-monthly">$0</span><span class="text-muted fw-bold ms-1 pb-1">/mo</span>
                        </div>
                        <div class="small text-secondary fw-bold mt-1" id="out-dti">DTI: 0%</div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm">
                <h6 class="fw-bold mb-4 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-chart-pie text-primary me-2"></i>Your Lifestyle Budget Breakdown
                </h6>
                
                <div class="budget-bar-container mb-3">
                    <div class="budget-bar housing-bar" id="bar-housing" data-bs-toggle="tooltip" title="Housing"></div>
                    <div class="budget-bar lifestyle-bar" id="bar-lifestyle" data-bs-toggle="tooltip" title="Lifestyle"></div>
                    <div class="budget-bar debt-bar" id="bar-debt" data-bs-toggle="tooltip" title="Existing Debt"></div>
                    <div class="budget-bar buffer-bar" id="bar-buffer" data-bs-toggle="tooltip" title="Remaining Buffer"></div>
                </div>
                
                <div class="d-flex flex-wrap gap-4 mt-2 justify-content-center">
                    <div class="legend-item"><span class="legend-dot bg-housing"></span> Housing (<span id="pct-housing">0</span>%)</div>
                    <div class="legend-item"><span class="legend-dot bg-lifestyle"></span> Lifestyle (<span id="pct-lifestyle">0</span>%)</div>
                    <div class="legend-item"><span class="legend-dot bg-debt"></span> Debt (<span id="pct-debt">0</span>%)</div>
                    <div class="legend-item"><span class="legend-dot bg-buffer"></span> Savings/Buffer (<span id="pct-buffer">0</span>%)</div>
                </div>
            </div>

            
            <div class="mt-4 print-hide">
                <div class="alert alert-soft-indigo border-indigo d-flex align-items-start gap-3 mb-0">
                    <i class="fas fa-lightbulb fs-4 mt-1"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Affordability Pro-Tip</h6>
                        <p class="mb-0 small" id="out-tip">Calculating insights...</p>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="haf-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Breakdown
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="haf-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print / Save PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const fmtC = val => new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD', maximumFractionDigits: 0}).format(val);
    
    const els = {
        inc: $('haf-income'),
        debt: $('haf-debt'),
        life: $('haf-lifestyle'),
        down: $('haf-down'),
        rate: $('haf-rate'),
        term: $('haf-term'),
        tax: $('haf-taxrate'),
        hoains: $('haf-hoains')
    };

    function PMT(ir, np, pv) {
        if(ir === 0) return -(pv / np);
        return ir * pv / (1 - Math.pow(1 + ir, -np));
    }

    function calculateAffordability() {
        const income = parseFloat(els.inc.value) || 0;
        const debt = parseFloat(els.debt.value) || 0;
        const lifestyle = parseFloat(els.life.value) || 0;
        const down = parseFloat(els.down.value) || 0;
        const rate = parseFloat(els.rate.value) || 0;
        const termYears = parseInt(els.term.value) || 30;
        const taxRate = parseFloat(els.tax.value) || 0;
        const hoaIns = parseFloat(els.hoains.value) || 0;

        if(income <= 0) return;

        // Determine max housing budget (Income - Debt - Lifestyle - 10% buffer)
        // Ensure standard DTI rules apply too. Max Front-End = 28%, Back-End = 36%
        // But our tool prioritizes LIFESTYLE explicitly.
        const minimumBuffer = income * 0.10; // 10% pure savings/buffer minimum
        let availableForHousing = income - debt - lifestyle - minimumBuffer;

        // Apply strict DTI cap (Back-end DTI max 43% conventionally)
        const maxConventionalHousing = (income * 0.43) - debt;
        const maxHousingAllowed = Math.max(0, Math.min(availableForHousing, maxConventionalHousing));

        // Now reverse engineer the property price from maxHousingAllowed
        // PITI = Principal + Interest + Tax + Ins/HOA
        // Math: 
        // monthTax = (Price * taxRate/100) / 12
        // monthPI = PMT(rate/100/12, termYears*12, Price - Down)
        // maxHousing = monthPI + monthTax + hoaIns + PMI (ignoring PMI for simplicity here or approximating)
        // Let's use a binary search or iterative approach to find the max Price

        let maxPrice = 0;
        let pmtMonthly = 0;
        let taxMonthly = 0;

        if (maxHousingAllowed > hoaIns) {
            let low = down; 
            let high = 5000000;
            let bestPrice = down;

            const rMonthly = (rate / 100) / 12;
            const nMonths = termYears * 12;
            
            for(let i=0; i<40; i++){
                let mid = (low + high) / 2;
                let tLoan = Math.max(0, mid - down);
                let _pmt = rMonthly > 0 ? (tLoan * rMonthly) / (1 - Math.pow(1 + rMonthly, -nMonths)) : (tLoan / nMonths);
                let _tax = (mid * (taxRate / 100)) / 12;
                let totalReq = _pmt + _tax + hoaIns;
                
                // Estimate PMI (0.5% annually) if down < 20%
                if (down < mid * 0.20 && tLoan > 0) {
                    totalReq += (tLoan * 0.005) / 12;
                }

                if(totalReq > maxHousingAllowed) {
                    high = mid;
                } else {
                    bestPrice = mid;
                    low = mid;
                    pmtMonthly = _pmt;
                    taxMonthly = _tax;
                }
            }
            maxPrice = bestPrice;
        }

        // Finalize allocations based on maxPrice found
        let realHousingCost = 0;
        let isHousePoor = false;

        if (maxPrice <= down) {
            maxPrice = down;
            realHousingCost = 0;
            $('out-tip').innerHTML = `With your current lifestyle spend and debt, a mortgage is not advisable. Keep saving to increase your down payment or reduce monthly debt!`;
        } else {
            realHousingCost = maxHousingAllowed;
            
            // Generate dynamic tip
            if (maxHousingAllowed < availableForHousing) {
                // Constrained by DTI, not lifestyle
                $('out-tip').innerHTML = `Your affordability is currently capped by lender DTI (Debt-to-Income) limits rather than your lifestyle budget. Paying off your <strong>${fmtC(debt)}/mo</strong> debt will directly increase your buying power.`;
            } else if (lifestyle > income * 0.4) {
                 $('out-tip').innerHTML = `You allocate a massive portion of income to lifestyle <strong>(${fmtC(lifestyle)}/mo)</strong>. You can safely afford this home, but if you need a larger house, trimming lifestyle expenses directly translates to mortgage power.`;
            } else {
                 $('out-tip').innerHTML = `Excellent balance! You are staying within safe lender rules while completely preserving your <strong>${fmtC(lifestyle)}/mo</strong> lifestyle budget.`;
            }
        }

        // Update UI
        $('out-max-price').textContent = fmtC(Math.floor(maxPrice / 1000) * 1000);
        $('out-lifestyle-target').textContent = fmtC(lifestyle);
        $('out-monthly').textContent = fmtC(realHousingCost);
        
        let dti = ((realHousingCost + debt) / income) * 100;
        $('out-dti').innerHTML = `Back-End DTI: <span class="${dti > 43 ? 'text-danger' : (dti > 36 ? 'text-warning' : 'text-success')}">${dti.toFixed(1)}%</span>`;

        // Update Budget Bar
        let bufferCost = Math.max(0, income - realHousingCost - lifestyle - debt);
        let pctH = (realHousingCost / income) * 100;
        let pctL = (lifestyle / income) * 100;
        let pctD = (debt / income) * 100;
        let pctB = (bufferCost / income) * 100;

        $('bar-housing').style.width = pctH + '%';
        $('bar-lifestyle').style.width = pctL + '%';
        $('bar-debt').style.width = pctD + '%';
        $('bar-buffer').style.width = pctB + '%';

        $('pct-housing').textContent = pctH.toFixed(1);
        $('pct-lifestyle').textContent = pctL.toFixed(1);
        $('pct-debt').textContent = pctD.toFixed(1);
        $('pct-buffer').textContent = pctB.toFixed(1);
    }

    // Event Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculateAffordability));
    $('haf-calculate').addEventListener('click', calculateAffordability);

    // Presets
    document.querySelectorAll('.haf-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === '1') { // Frugal
                els.inc.value = 6000; els.debt.value = 200; els.life.value = 1200; els.down.value = 40000;
            } else if (p === '2') { // DINKs
                els.inc.value = 14000; els.debt.value = 800; els.life.value = 4500; els.down.value = 150000;
            } else if (p === '3') { // High Debt
                els.inc.value = 8500; els.debt.value = 1500; els.life.value = 2000; els.down.value = 35000;
            }
            calculateAffordability();
        });
    });

    $('haf-reset').addEventListener('click', () => {
        els.inc.value = 7000; els.debt.value = 600; els.life.value = 2500; 
        els.down.value = 60000; els.rate.value = 6.5; els.term.value = 30;
        els.tax.value = 1.2; els.hoains.value = 300;
        calculateAffordability();
    });

    $('haf-copy-btn').addEventListener('click', function(){
        const text = `Lifestyle Affordability Breakdown:\nMax House Price: ${$('out-max-price').textContent}\nMax Monthly Payment: ${$('out-monthly').textContent}\nLifestyle Preserved: ${$('out-lifestyle-target').textContent}/mo\nRemaining Savings/Buffer: ${$('pct-buffer').textContent}%\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculateAffordability();
});
</script>

<style>
.house-affordability-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(79,70,229,.05)}
.house-affordability-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.house-affordability-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.house-affordability-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.house-affordability-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.house-affordability-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}
.output-hero-value{font-size:4rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-2.5px}

.text-indigo { color: #4f46e5 !important; }
.bg-indigo { background-color: #4f46e5 !important; }
.border-indigo { border-color: #c7d2fe !important; }
.alert-soft-indigo { background-color: #eef2ff; color: #3730a3; }

.payment-box { background:#fff; border: 2px solid #e5e7eb; border-radius: 16px; padding: 1.5rem; }
.stat-card-label {font-size:.7rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:4px; display:block;}

/* Budget Bar Styles */
.budget-bar-container { width: 100%; height: 28px; background: #f1f5f9; border-radius: 14px; display: flex; overflow: hidden; }
.budget-bar { height: 100%; transition: width 0.5s ease; }
.bg-housing { background: #4f46e5 !important; }
.bg-lifestyle { background: #10b981 !important; }
.bg-debt { background: #f43f5e !important; }
.bg-buffer { background: #0ea5e9 !important; }

.housing-bar { background: #4f46e5; }
.lifestyle-bar { background: #10b981; }
.debt-bar { background: #f43f5e; }
.buffer-bar { background: #0ea5e9; }

.legend-item { font-size: 0.85rem; font-weight: 700; color: #475569; display: flex; align-items: center; }
.legend-dot { width: 12px; height: 12px; border-radius: 50%; display: inline-block; margin-right: 6px; }

@media (max-width: 768px) {
    .house-affordability-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 2.8rem; }
}
@media print {
    .print-hide { display: none !important; }
    .output-card-themed { border: 1px solid #000; box-shadow: none; background: #fff !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\house-affordability-vs-lifestyle-calculator.blade.php ENDPATH**/ ?>