<div class="row g-4 rental-yield-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-12 mb-1">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-key text-success me-2"></i>Acquisition & Financing</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Purchase Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="ry-price" class="form-control form-control-lg border-start-0 ps-0" value="350000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Down Payment Initial ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="ry-down" class="form-control form-control-lg border-start-0 ps-0" value="70000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom tooltip-label" title="Leave at 0 if bought in cash">Mortgage Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="ry-rate" class="form-control form-control-lg border-end-0" value="6.5" step="0.125">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>
                    </div>

                    
                    <div class="col-12 mb-1 mt-4">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-cash-register text-success me-2"></i>Income & Operating Expenses (OpEx)</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-success">Gross Monthly Rent</label>
                        <div class="input-group">
                            <span class="input-group-text bg-soft-green border-end-0 text-success fw-bold"><i class="fas fa-plus"></i></span>
                            <input type="number" id="ry-rent" class="form-control form-control-lg border-start-0 ps-0 text-success fw-bold bg-soft-green" value="2600" step="50">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Vacancy & Default Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="ry-vacancy" class="form-control form-control-lg border-end-0" value="5" step="1">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Property Taxes (Annual)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="ry-tax" class="form-control form-control-lg border-start-0 ps-0" value="4200" step="100">
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="form-label-custom">HOA & Insurance (Annual)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="ry-ins" class="form-control form-control-lg border-start-0 ps-0" value="1800" step="100">
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="form-label-custom tooltip-label" title="Repairs, Capex, Property Management">Maintenance / Mgmt (Annual)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="ry-maint" class="form-control form-control-lg border-start-0 ps-0" value="3000" step="100">
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="form-label-custom text-info tooltip-label" title="Your personal income tax bracket for standard cashflow. (Depreciation excluded for simplicity)">Investor Tax Bracket (%)</label>
                        <div class="input-group">
                            <input type="number" id="ry-inctax" class="form-control form-control-lg border-end-0 bg-light" value="24" step="1">
                            <span class="input-group-text bg-light border-start-0 text-muted">%</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-success me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ry-quick" data-p="1">1% Rule Winner</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ry-quick" data-p="2">Coastal Appreciation Trap</button>
                    <div class="flex-grow-1"></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#10b981;--tool-bg:#f0fdf4;">
            <div class="row align-items-center mb-4">
                <div class="col-md-6 text-center text-md-start">
                    <span class="output-hero-label text-success-dark">MONTHLY FREE CASHFLOW</span>
                    <div class="d-flex align-items-baseline justify-content-center justify-content-md-start">
                        <h2 class="output-hero-value m-0 text-dark" id="out-cashflow">$0</h2>
                    </div>
                    <p class="text-muted small mt-2 fw-bold mb-0">After all expenses, debt, and income taxes.</p>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="stat-card">
                                <span class="stat-card-label">CAP RATE (NET YIELD)</span>
                                <div class="fs-3 fw-black text-success-dark" id="out-cap">0%</div>
                                <div class="small fw-bold text-muted mt-1">Unleveraged Return</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card">
                                <span class="stat-card-label">CASH-ON-CASH (CoC)</span>
                                <div class="fs-3 fw-black text-primary" id="out-coc">0%</div>
                                <div class="small fw-bold text-muted mt-1">First Year ROI</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm">
                <h6 class="fw-bold mb-4 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-water text-primary me-2"></i>Annual Profit Waterfall
                </h6>
                
                <div class="waterfall-container">
                    <div class="wf-item">
                        <div class="wf-label">Gross Rent</div>
                        <div class="wf-val text-success fw-bold" id="wf-gross">+$0</div>
                    </div>
                    <div class="wf-item">
                        <div class="wf-label">Vacancy Loss</div>
                        <div class="wf-val text-danger fw-bold" id="wf-vac">-$0</div>
                    </div>
                    <div class="wf-item">
                        <div class="wf-label">OpEx (Tax/Ins/Maint)</div>
                        <div class="wf-val text-danger fw-bold" id="wf-opex">-$0</div>
                    </div>
                    <div class="wf-item wf-subtotal border-top pt-2 mt-1">
                        <div class="wf-label">Net Operating Income (NOI)</div>
                        <div class="wf-val text-dark fw-black fs-5" id="wf-noi">$0</div>
                    </div>
                    <div class="wf-item mt-2">
                        <div class="wf-label">Debt Service (Mortgage)</div>
                        <div class="wf-val text-danger fw-bold" id="wf-debt">-$0</div>
                    </div>
                    <div class="wf-item">
                        <div class="wf-label">Income Tax (Pre-Deprec.)</div>
                        <div class="wf-val text-danger fw-bold" id="wf-tax">-$0</div>
                    </div>
                    <div class="wf-item wf-total border-top pt-2 mt-1">
                        <div class="wf-label text-success-dark fw-bold">Net Free Cashflow (Annual)</div>
                        <div class="wf-val text-success-dark fw-black fs-4" id="wf-net">$0</div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 print-hide">
                <div class="alert alert-soft-success border-success d-flex align-items-start gap-3 mb-0" id="tip-container">
                    <i class="fas fa-search-dollar fs-4 mt-1 text-success-dark"></i>
                    <div>
                        <h6 class="fw-bold mb-1 text-success-dark" id="tip-title">Investment Assessment</h6>
                        <p class="mb-0 small" id="out-tip">Calculating insights...</p>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ry-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-success"></i>Copy Deal Summary
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="ry-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Export Deal Sheet
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
    
    function PMT(ir, np, pv) {
        if(ir === 0) return -(pv / np);
        return ir * pv / (1 - Math.pow(1 + ir, -np));
    }

    const els = {
        price: $('ry-price'), down: $('ry-down'), rate: $('ry-rate'),
        rent: $('ry-rent'), vac: $('ry-vacancy'),
        tax: $('ry-tax'), ins: $('ry-ins'), maint: $('ry-maint'),
        incTax: $('ry-inctax')
    };

    function calculateYield() {
        const price = parseFloat(els.price.value) || 0;
        const down = parseFloat(els.down.value) || 0;
        const rate = parseFloat(els.rate.value) || 0;
        
        const rent = parseFloat(els.rent.value) || 0;
        const vacPct = parseFloat(els.vac.value) || 0;
        const pt = parseFloat(els.tax.value) || 0;
        const ins = parseFloat(els.ins.value) || 0;
        const maint = parseFloat(els.maint.value) || 0;
        const iTax = parseFloat(els.incTax.value) || 0;

        // Income
        const grossAnnual = rent * 12;
        const vacLoss = grossAnnual * (vacPct / 100);
        const effectiveGross = grossAnnual - vacLoss;

        // OpEx
        const opEx = pt + ins + maint;
        const noi = effectiveGross - opEx;

        // Debt
        const loanAmount = Math.max(0, price - down);
        let annualDebt = 0;
        let interestPaidYear1 = 0;
        
        if (loanAmount > 0 && rate > 0) {
            const rMonthly = (rate / 100) / 12;
            const pmt = rMonthly * loanAmount / (1 - Math.pow(1 + rMonthly, -360));
            annualDebt = pmt * 12;
            // Rough Year 1 interest approx
            interestPaidYear1 = loanAmount * (rate / 100); 
        }

        const cashFlowBeforeTax = noi - annualDebt;

        // Tax (Simplified: NOI - Interest - Depreciation. But we ignore depreciation for safety here, or approximate it)
        // Let's use standard taxable income: NOI - Interest.
        const taxableIncome = Math.max(0, noi - interestPaidYear1);
        const incomeTax = taxableIncome * (iTax / 100);

        const netAnnualCF = cashFlowBeforeTax - incomeTax;
        const monthlyCF = netAnnualCF / 12;

        // Returns
        const capRate = price > 0 ? (noi / price) * 100 : 0;
        const cashInvested = down > 0 ? down : price; // Assuming closing costs are minimal or absorbed
        const coc = cashInvested > 0 ? (cashFlowBeforeTax / cashInvested) * 100 : 0; // CoC usually calculated pre-tax by convention, but we can display strictly pre-tax CoC here

        // Update UI
        $('out-cashflow').textContent = fmtC(monthlyCF);
        $('out-cashflow').className = monthlyCF < 0 ? 'output-hero-value m-0 text-danger' : 'output-hero-value m-0 text-success-dark';
        
        $('out-cap').textContent = capRate.toFixed(2) + '%';
        $('out-coc').textContent = coc.toFixed(2) + '%';

        // Waterfall
        $('wf-gross').textContent = '+'+fmtC(grossAnnual);
        $('wf-vac').textContent = '-'+fmtC(vacLoss);
        $('wf-opex').textContent = '-'+fmtC(opEx);
        $('wf-noi').textContent = fmtC(noi);
        $('wf-debt').textContent = '-'+fmtC(annualDebt);
        $('wf-tax').textContent = '-'+fmtC(incomeTax);
        $('wf-net').textContent = fmtC(netAnnualCF);
        $('wf-net').className = netAnnualCF < 0 ? 'wf-val text-danger fw-black fs-4' : 'wf-val text-success-dark fw-black fs-4';

        // Insights
        let tipContainer = $('tip-container');
        tipContainer.className = `alert border d-flex align-items-start gap-3 mb-0 `;
        tipContainer.classList.add(netAnnualCF < 0 ? 'alert-soft-danger border-danger' : 'alert-soft-success border-success');

        let insight = '';
        $('tip-title').textContent = netAnnualCF < 0 ? "Negative Cashflow Alert" : "Deal Viability";
        $('tip-title').className = netAnnualCF < 0 ? "fw-bold mb-1 text-danger" : "fw-bold mb-1 text-success-dark";

        if (netAnnualCF < 0) {
            insight = `This property <strong>loses money</strong> every month. You are relying entirely on future appreciation acting as speculation to make this deal work. Re-evaluate your financing or find a better price.`;
        } else if (coc < 5) {
            insight = `Your Cash-on-Cash return is <strong>${coc.toFixed(1)}%</strong>. This is lower than many high-yield savings accounts or unmanaged bonds. Evaluate if the hassle of landlording is worth this premium.`;
        } else if (capRate > 8) {
            insight = `Excellent Cap Rate (<strong>${capRate.toFixed(1)}%</strong>)! This property generates strong operating income relative to its price. Ensure you have properly accounted for large maintenance Capex.`;
        } else {
            insight = `Solid fundamentals. You hit positive cash flow while steadily having your tenants pay down the principal on the loan.`;
        }
        $('out-tip').innerHTML = insight;
    }

    // Listeners & Presets
    Object.values(els).forEach(el => el.addEventListener('input', calculateYield));
    
    document.querySelectorAll('.ry-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === '1') {
                els.price.value = 150000; els.down.value = 30000; els.rent.value = 1500; els.tax.value = 1800;
            } else if (p === '2') {
                els.price.value = 850000; els.down.value = 170000; els.rent.value = 3200; els.tax.value = 9000;
            }
            calculateYield();
        });
    });

    $('ry-reset').addEventListener('click', () => {
        els.price.value = 350000; els.down.value = 70000; els.rate.value = 6.5; els.rent.value = 2600; els.tax.value = 4200;
        calculateYield();
    });

    $('ry-copy-btn').addEventListener('click', function(){
        const text = `Rental ROI Summary:\nPrice: ${fmtC(els.price.value)} | Rent: ${fmtC(els.rent.value)}/mo\nNet Monthly Cashflow: ${$('out-cashflow').textContent}\nCap Rate: ${$('out-cap').textContent} | Cash-on-Cash: ${$('out-coc').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculateYield();
});
</script>

<style>
.rental-yield-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(16,185,129,.05)}
.rental-yield-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.rental-yield-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.rental-yield-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.rental-yield-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.rental-yield-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.bg-soft-green { background-color: #f0fdf4 !important; }
.text-success-dark { color: #047857 !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}
.output-hero-value{font-size:3.5rem;font-weight:900;line-height:1;letter-spacing:-2.5px}

.stat-card{background:#fff;border:2.5px solid #e5e7eb;border-radius:16px;padding:1.2rem; text-align:center;}
.stat-card-label {font-size:.7rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1px;margin-bottom:8px; display:block;}

.alert-soft-success { background-color: #f0fdf4; color: #166534; }
.alert-soft-danger { background-color: #fef2f2; color: #991b1b; }

.waterfall-container { display: flex; flex-direction: column; gap: 8px; }
.wf-item { display: flex; justify-content: space-between; align-items: center; font-size: 0.95rem; }
.wf-label { color: #475569; font-weight: 500; }
.wf-val { font-variant-numeric: tabular-nums; }

@media (max-width: 768px) {
    .rental-yield-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 2.5rem; }
}
@media print {
    .print-hide { display: none !important; }
    .output-card-themed { border: 1px solid #000; box-shadow: none; background: #fff !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\rental-yield-after-tax-calculator.blade.php ENDPATH**/ ?>