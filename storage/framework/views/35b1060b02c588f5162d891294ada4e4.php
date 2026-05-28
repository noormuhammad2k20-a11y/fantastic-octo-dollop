<div class="row g-4 buy-vs-rent-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-slate">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-indigo small"><i class="fas fa-home me-2"></i>The Buying Scenario</h6>
                        
                        <label class="form-label-custom">Target Home Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="bvr-price" class="form-control form-control-lg border-start-0 ps-0 fw-bold" value="450000" step="1000">
                        </div>

                        <label class="form-label-custom">Available Down Payment</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="bvr-down" class="form-control form-control-lg border-start-0 ps-0 text-indigo fw-bold bg-soft-indigo" value="90000" step="1000">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label-custom">Interest Rate (%)</label>
                                <div class="input-group">
                                    <input type="number" id="bvr-rate" class="form-control border-end-0" value="6.5" step="0.125">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom" title="Expected yearly growth in home value">Appreciation (%)</label>
                                <div class="input-group">
                                    <input type="number" id="bvr-apprec" class="form-control border-end-0" value="3.5" step="0.1">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                        </div>

                        <label class="form-label-custom">Taxes, HOA & Maint ($/mo)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="bvr-buy-fees" class="form-control border-start-0 ps-0" value="750" step="50">
                        </div>
                    </div>

                    
                    <div class="col-md-6 ps-md-4 mt-5 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-teal small"><i class="fas fa-key me-2"></i>The Renting Scenario</h6>
                        
                        <label class="form-label-custom">Current Equivalent Rent ($/mo)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="bvr-rent" class="form-control form-control-lg border-start-0 ps-0 fw-bold" value="2300" step="50">
                        </div>

                        <label class="form-label-custom tooltip-label" title="Renters invest the down payment (and any monthly savings) into the market.">Assumed Market Return (%)</label>
                        <div class="input-group mb-3">
                            <input type="number" id="bvr-market" class="form-control form-control-lg border-end-0 text-teal fw-bold bg-soft-teal" value="7.0" step="0.5">
                            <span class="input-group-text bg-soft-teal border-start-0 text-teal fw-bold">%</span>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label-custom">Rent Increase (%) / Yr</label>
                                <div class="input-group">
                                    <input type="number" id="bvr-rent-inc" class="form-control border-end-0" value="3.5" step="0.1">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">Years to Compare</label>
                                <select id="bvr-years" class="form-select">
                                    <option value="5">5 Years</option>
                                    <option value="10" selected>10 Years</option>
                                    <option value="15">15 Years</option>
                                    <option value="30">30 Years</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-slate me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 bvr-quick" data-p="1">Coastal Market (High Cost)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 bvr-quick" data-p="2">Midwest (Low Cost)</button>
                    <div class="flex-grow-1"></div>
                    <button type="button" class="btn btn-sm text-muted" id="bvr-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-undo me-1"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#334155;--tool-bg:#f8fafc;">
            
            
            <div class="decision-banner text-center mb-5 p-4 rounded-4" id="out-banner">
                <span class="output-hero-label text-slate mb-2">THE VERDICT</span>
                <h1 class="display-5 fw-black text-dark m-0" id="out-decision-text">Analyzing Scenario...</h1>
                <p class="text-muted fw-bold mt-2 mb-0" id="out-decision-sub">Comparing wealth generation trajectories over <span id="lbl-y1">X</span> years.</p>
            </div>

            
            <div class="row g-4 mb-4">
                
                <div class="col-md-6">
                    <div class="wealth-card border-indigo-top">
                        <div class="text-center mb-3">
                            <span class="stat-card-label text-indigo">TOTAL NET WORTH IF BUYING</span>
                            <div class="fs-2 fw-black text-dark" id="out-buy-nw">$0</div>
                        </div>
                        <div class="wealth-breakdown mt-3">
                            <div class="d-flex justify-content-between small mb-2"><span class="text-muted">Home Value</span><span class="fw-bold text-dark" id="out-buy-val">$0</span></div>
                            <div class="d-flex justify-content-between small mb-2"><span class="text-muted">Remaining Debt</span><span class="fw-bold text-danger" id="out-buy-debt">-$0</span></div>
                            <hr class="my-2 opacity-10">
                            <div class="d-flex justify-content-between small"><span class="text-muted">Taxes/Maint/Iterest Spent (Sunk Cost)</span><span class="fw-bold text-danger" id="out-buy-sunk">$0</span></div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="wealth-card border-teal-top">
                        <div class="text-center mb-3">
                            <span class="stat-card-label text-teal">TOTAL NET WORTH IF RENTING</span>
                            <div class="fs-2 fw-black text-dark" id="out-rent-nw">$0</div>
                        </div>
                        <div class="wealth-breakdown mt-3">
                            <div class="d-flex justify-content-between small mb-2"><span class="text-muted">Stock Portfolio (Invested Down Pmt)</span><span class="fw-bold text-dark" id="out-rent-val">$0</span></div>
                            <div class="d-flex justify-content-between small mb-2"><span class="text-muted">Invested Monthly Savings</span><span class="fw-bold text-success" id="out-rent-sav">+$0</span></div>
                            <hr class="my-2 opacity-10">
                            <div class="d-flex justify-content-between small"><span class="text-muted">Total Rent Paid (Sunk Cost)</span><span class="fw-bold text-danger" id="out-rent-sunk">$0</span></div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm print-hide">
                <h6 class="fw-bold mb-4 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-chart-line text-slate me-2"></i>Net Worth Trajectory
                </h6>
                <div class="trajectory-graph">
                    <div class="traj-row">
                        <div class="traj-label fw-bold text-indigo">BUYER</div>
                        <div class="traj-bar-wrap">
                            <div class="traj-fill bg-indigo" id="bar-buy"></div>
                        </div>
                    </div>
                    <div class="traj-row mt-3">
                        <div class="traj-label fw-bold text-teal">RENTER</div>
                        <div class="traj-bar-wrap">
                            <div class="traj-fill bg-teal" id="bar-rent"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const fmtC = val => new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD', maximumFractionDigits: 0}).format(val);
    
    // Mortgage Payment formula
    function PMT(ir, np, pv) {
        if(ir === 0) return -(pv / np);
        return ir * pv / (1 - Math.pow(1 + ir, -np));
    }

    const els = {
        price: $('bvr-price'), down: $('bvr-down'), rate: $('bvr-rate'), apprec: $('bvr-apprec'),
        fees: $('bvr-buy-fees'),
        rent: $('bvr-rent'), market: $('bvr-market'), rentInc: $('bvr-rent-inc'),
        yrs: $('bvr-years')
    };

    function calculate() {
        const price = parseFloat(els.price.value) || 0;
        const down = parseFloat(els.down.value) || 0;
        const rate = parseFloat(els.rate.value) || 0;
        const apprec = parseFloat(els.apprec.value) || 0;
        const fees = parseFloat(els.fees.value) || 0;
        
        const rentStart = parseFloat(els.rent.value) || 0;
        const marketRtn = parseFloat(els.market.value) || 0;
        const rentInc = parseFloat(els.rentInc.value) || 0;
        
        const yrs = parseInt(els.yrs.value) || 10;
        $('lbl-y1').textContent = yrs;

        // Buying Simulation
        const loanAmt = Math.max(0, price - down);
        const rMonthly = (rate / 100) / 12;
        let monthPI = 0;
        if(loanAmt > 0 && rate > 0) {
            monthPI = rMonthly * loanAmt / (1 - Math.pow(1 + rMonthly, -360));
        }
        
        let buyHomeVal = price;
        let buyDebt = loanAmt;
        let buySunk = 0; // Cumulative Interest + Taxes/Fees
        
        // Renting Simulation
        let rentPortfolio = down; // Renter invests down payment initially
        let rentMonth = rentStart;
        let rentSunk = 0; // Cumulative rent paid
        const mMarketRtn = (marketRtn / 100) / 12;
        let investedMonthlySav = 0;

        for (let m = 1; m <= yrs * 12; m++) {
            // -- BUYER STEP --
            const interestPayment = buyDebt * rMonthly;
            const principalPayment = monthPI > 0 ? (monthPI - interestPayment) : 0;
            buyDebt -= principalPayment;
            if(buyDebt < 0) buyDebt = 0;
            buySunk += interestPayment + fees;

            // Appreciate home monthly
            buyHomeVal *= (1 + (apprec/100)/12);

            // -- RENTER STEP --
            rentSunk += rentMonth;
            
            // Rent goes up annually
            if (m % 12 === 0) {
                rentMonth *= (1 + (rentInc / 100));
            }

            // Difference in payment is invested (if buying costs more than renting)
            const housingCostBuy = monthPI + fees;
            const savingsInvested = housingCostBuy - rentMonth;
            
            // Portfolio grows
            rentPortfolio *= (1 + mMarketRtn);
            
            if (savingsInvested > 0) {
                rentPortfolio += savingsInvested;
                investedMonthlySav += savingsInvested;
            }
        }

        const buyNetWorth = buyHomeVal - buyDebt;
        const rentNetWorth = rentPortfolio;

        // Update UI Text
        $('out-buy-nw').textContent = fmtC(buyNetWorth);
        $('out-buy-val').textContent = fmtC(buyHomeVal);
        $('out-buy-debt').textContent = '-' + fmtC(Math.max(0, buyDebt));
        $('out-buy-sunk').textContent = fmtC(buySunk);

        $('out-rent-nw').textContent = fmtC(rentNetWorth);
        
        // Base growth of just the down payment
        const baseGrowth = down * Math.pow(1 + (marketRtn/100), yrs);
        $('out-rent-val').textContent = fmtC(baseGrowth);
        $('out-rent-sav').textContent = "+" + fmtC(Math.max(0, rentPortfolio - baseGrowth));
        $('out-rent-sunk').textContent = fmtC(rentSunk);

        // Verdict & Trajectory
        let maxNW = Math.max(buyNetWorth, rentNetWorth);
        if (maxNW <= 0) maxNW = 1; // avoid /0

        $('bar-buy').style.width = ((buyNetWorth / maxNW) * 100) + '%';
        $('bar-rent').style.width = ((rentNetWorth / maxNW) * 100) + '%';

        const decText = $('out-decision-text');
        const decBanner = $('out-banner');
        const diff = Math.abs(buyNetWorth - rentNetWorth);

        if (buyNetWorth > rentNetWorth) {
            decText.textContent = "Buying Wins by " + fmtC(diff);
            decText.style.color = '#3730a3'; // Indigo
            decBanner.style.backgroundColor = '#e0e7ff';
            decBanner.style.border = '2px solid #a5b4fc';
        } else {
            decText.textContent = "Renting Wins by " + fmtC(diff);
            decText.style.color = '#0f766e'; // Teal
            decBanner.style.backgroundColor = '#ccfbf1';
            decBanner.style.border = '2px solid #5eead4';
        }
    }

    // Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculate));
    
    document.querySelectorAll('.bvr-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === '1') {
                els.price.value = 900000; els.down.value = 180000; els.rent.value = 3500; els.apprec.value = 4.0;
            } else if (p === '2') {
                els.price.value = 250000; els.down.value = 50000; els.rent.value = 1800; els.apprec.value = 2.5;
            }
            calculate();
        });
    });
    
    $('bvr-reset').addEventListener('click', () => {
        els.price.value = 450000; els.down.value = 90000; els.rent.value = 2300; els.market.value = 7.0; els.yrs.value = 10;
        calculate();
    });

    calculate();
});
</script>

<style>
.buy-vs-rent-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(15,23,42,.04)}
.buy-vs-rent-rebuilt .border-slate { border-top: 4px solid #475569; }
.buy-vs-rent-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.buy-vs-rent-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.buy-vs-rent-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.buy-vs-rent-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.buy-vs-rent-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.text-slate { color: #475569 !important; }
.bg-slate-soft { background-color: #f1f5f9 !important; }
.text-indigo { color: #4f46e5 !important; }
.bg-indigo { background-color: #4f46e5 !important; }
.bg-soft-indigo { background-color: #eef2ff !important; }
.text-teal { color: #0d9488 !important; }
.bg-teal { background-color: #0d9488 !important; }
.bg-soft-teal { background-color: #f0fdfa !important; }

.border-end-md { border-right: 1px dashed #e2e8f0; }
@media (max-width: 768px) {
    .border-end-md { border-right: none; border-bottom: 1px dashed #e2e8f0; padding-bottom: 2rem; }
    .ps-md-4 { padding-left: 0 !important; }
    .pe-md-4 { padding-right: 0 !important; }
}

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}

.wealth-card { background: #fff; border-radius: 16px; padding: 2rem 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,.03); height: 100%; border: 1px solid #e2e8f0; transition: transform 0.3s;}
.wealth-card:hover { transform: translateY(-4px); }
.border-indigo-top { border-top: 4px solid #4f46e5; }
.border-teal-top { border-top: 4px solid #0d9488; }
.stat-card-label {font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px; display:block;}

.trajectory-graph { width: 100%; }
.traj-row { display: flex; align-items: center; gap: 15px; }
.traj-label { min-width: 60px; font-size: 0.8rem; letter-spacing:1px; }
.traj-bar-wrap { background: #e2e8f0; height: 16px; border-radius: 8px; flex-grow: 1; overflow: hidden;}
.traj-fill { height: 100%; min-width: 2px; border-radius: 8px; transition: width 0.8s cubic-bezier(0.2, 0.8, 0.2, 1); }

@media print {
    .print-hide { display: none !important; }
    .output-card-themed { border: 1px solid #000; box-shadow: none; background: #fff !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\buy-vs-rent-long-term-wealth-calculator.blade.php ENDPATH**/ ?>