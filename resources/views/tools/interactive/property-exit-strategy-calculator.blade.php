<div class="row g-4 exit-strategy-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-violet">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- The Property --}}
                    <div class="col-md-5 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-violet small"><i class="fas fa-home me-2"></i>The Transaction</h6>
                        
                        <label class="form-label-custom">Expected Sale Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="es-sale" class="form-control form-control-lg border-start-0 ps-0 fw-bold" value="850000" step="1000">
                        </div>

                        <label class="form-label-custom tooltip-label" title="Original contract price you paid when you acquired it.">Original Purchase Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="es-purch" class="form-control border-start-0 ps-0" value="500000" step="1000">
                        </div>

                        <label class="form-label-custom">Remaining Loan Balance</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="es-loan" class="form-control border-start-0 ps-0 text-danger fw-bold bg-soft-red" value="400000" step="1000">
                        </div>

                        <label class="form-label-custom tooltip-label" title="Realtor commissions, transfer taxes, staging. Usually 6-8%.">Cost of Sale (%)</label>
                        <div class="input-group">
                            <input type="number" id="es-cost-pct" class="form-control border-end-0 text-danger bg-soft-red" value="7.0" step="0.5">
                            <span class="input-group-text bg-soft-red border-start-0 text-danger">%</span>
                        </div>
                    </div>

                    {{-- Taxes & Basis --}}
                    <div class="col-md-7 ps-md-4 mt-5 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-teal small"><i class="fas fa-file-invoice-dollar me-2"></i>Taxes & Adjusted Basis</h6>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label class="form-label-custom tooltip-label" title="Major renovations, roof, etc. Adds to your basis to reduce taxes.">Capital Improvements ($)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-hammer"></i></span>
                                    <input type="number" id="es-cap-ex" class="form-control border-start-0 ps-0 text-teal bg-soft-teal" value="50000" step="500">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label-custom tooltip-label" title="Depreciation claimed during rental years. Lowers basis (increases tax).">Depreciation Taken ($)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-arrow-down"></i></span>
                                    <input type="number" id="es-deprec" class="form-control border-start-0 ps-0 text-danger bg-soft-red" value="0" step="1000" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label class="form-label-custom tooltip-label" title="Section 121 Excludes up to $500k in gains if you lived in it 2 of the last 5 years.">Primary Residence Exclusion (Sec 121)</label>
                                <select id="es-121" class="form-select border-violet text-violet fw-bold bg-violet-soft">
                                    <option value="0" selected>Not Primary Residence (No Exclusion)</option>
                                    <option value="250000">Single Filer ($250k Tax-Free Gain)</option>
                                    <option value="500000">Married Filing Jointly ($500k Tax-Free Gain)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label-custom tooltip-label" title="Federal + State long-term capital gains tax. Usually 15-20% + State">Capital Gains Rate (%)</label>
                                <div class="input-group">
                                    <input type="number" id="es-cg-tax" class="form-control border-end-0" value="20" step="1">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label-custom tooltip-label" title="Tax rate on recovering depreciation (capped federally at 25%)">Depreciation Recapture Rate (%)</label>
                                <div class="input-group">
                                    <input type="number" id="es-dr-tax" class="form-control border-end-0" value="25" step="1">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-violet me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 es-quick" data-p="1">Married Homeowner (Tax Free)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 es-quick" data-p="2">Rental Flipper (1031 Candidate)</button>
                    <div class="flex-grow-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#8b5cf6;--tool-bg:#f5f3ff;">
            
            <div class="row text-center mb-5 align-items-center justify-content-center">
                <div class="col-md-5">
                    <span class="output-hero-label text-violet">CASH IN POCKET AT CLOSING</span>
                    <h1 class="output-hero-value text-dark m-0" id="out-cash-hand" style="font-size:3.5rem;">$0</h1>
                    <p class="text-muted small mt-2 fw-bold mb-0">After Loan, Realtor Fees, & IRS Taxes.</p>
                </div>
                <div class="col-md-2 text-center text-muted fs-4"></div>
                <div class="col-md-5">
                    <div class="payment-box">
                        <span class="stat-card-label text-danger">TOTAL TAX OBLIGATION</span>
                        <div class="fs-2 fw-black text-danger" id="out-tax-bill">$0</div>
                        <div class="small fw-bold text-muted mt-1" id="out-tax-desc">Owed to both Fed & State</div>
                    </div>
                </div>
            </div>

            <hr class="opacity-10 my-4">

            {{-- The Breakdown Steps --}}
            <div class="row g-4">
                {{-- STEP 1: BASIS --}}
                <div class="col-md-4">
                    <div class="breakdown-card border-violet shadow-sm">
                        <div class="bc-header bg-violet-soft text-violet fw-black">
                            1. ADJUSTED BASIS
                        </div>
                        <div class="bc-body">
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>Purchase Price:</span> <span id="s-purch"></span>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>+ Improvements:</span> <span class="text-success" id="s-imp"></span>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>+ Selling Costs:</span> <span class="text-success" id="s-cost"></span>
                            </div>
                            <div class="d-flex justify-content-between small text-muted pb-2 border-bottom">
                                <span>- Depreciation:</span> <span class="text-danger" id="s-dep"></span>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span class="fw-bold">Adjusted Basis:</span> <strong class="fs-5 text-dark" id="out-adj-basis">$0</strong>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 2: TAXABLE GAINS --}}
                <div class="col-md-4">
                    <div class="breakdown-card border-orange shadow-sm">
                        <div class="bc-header bg-soft-orange text-orange fw-black">
                            2. TAXABLE GAIN
                        </div>
                        <div class="bc-body">
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>Sale Price:</span> <span id="s-sale"></span>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>- Adjusted Basis:</span> <span class="text-danger" id="s-abasis"></span>
                            </div>
                            <div class="d-flex justify-content-between small text-muted pb-2 border-bottom">
                                <span>- Sec 121 Exclusion:</span> <span class="text-success" id="s-exc"></span>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span class="fw-bold text-orange">Subj. to Cap Gains:</span> <strong class="fs-5 text-dark" id="out-taxable-gain">$0</strong>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 3: CLOSING PROCEEDS --}}
                <div class="col-md-4">
                    <div class="breakdown-card border-green shadow-sm">
                        <div class="bc-header bg-soft-green text-green fw-black">
                            3. FINAL DISBURSEMENT
                        </div>
                        <div class="bc-body">
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>Gross Net (Price - Fees):</span> <span id="s-gross-net"></span>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>- Loan Payoff:</span> <span class="text-danger" id="s-loan"></span>
                            </div>
                            <div class="d-flex justify-content-between small text-muted pb-2 border-bottom">
                                <span>- Tax Owed:</span> <span class="text-danger" id="s-tax"></span>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span class="fw-bold text-green">Cash in Pocket:</span> <strong class="fs-5 text-dark" id="out-pocket">$0</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Insight Bar --}}
            <div class="mt-4 print-hide">
                <div class="alert border d-flex align-items-start gap-3 mb-0" id="tip-container">
                    <i class="fas fa-lightbulb fs-4 mt-1" id="tip-icon"></i>
                    <div>
                        <h6 class="fw-bold mb-1" id="tip-title">Exit Strategy Insight</h6>
                        <p class="mb-0 small" id="out-tip">Calculating insights...</p>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="es-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-violet"></i>Copy Exit Breakdown
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="es-reset" style="min-width: 280px; max-width: 100%;">Reset Scenarios</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Strategy Sheet
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
        sale: $('es-sale'), purch: $('es-purch'), loan: $('es-loan'), costPct: $('es-cost-pct'),
        capEx: $('es-cap-ex'), deprec: $('es-deprec'),
        sec121: $('es-121'), cgTax: $('es-cg-tax'), drTax: $('es-dr-tax')
    };

    function calculate() {
        const sale = parseFloat(els.sale.value) || 0;
        const purch = parseFloat(els.purch.value) || 0;
        const loan = parseFloat(els.loan.value) || 0;
        const costPct = parseFloat(els.costPct.value) || 0;
        
        const capEx = parseFloat(els.capEx.value) || 0;
        const deprec = parseFloat(els.deprec.value) || 0;
        
        const sec121 = parseFloat(els.sec121.value) || 0;
        const cgTax = parseFloat(els.cgTax.value) || 0;
        const drTax = parseFloat(els.drTax.value) || 0;

        // Selling Costs
        const sellingCosts = sale * (costPct / 100);

        // Step 1: Adjusted Basis
        // Basis = Purchase Price + Improvements + Selling Costs - Depreciation
        const adjBasis = purch + capEx + sellingCosts - deprec;

        // Step 2: Taxable Gain
        // Total Gain = Sale Price - Adjusted Basis
        const totalGain = sale - adjBasis;
        
        // Depreciation Recapture happens FIRST, up to the amount of total gain.
        // It is NOT shielded by Section 121 (generally). You must pay tax on recapture if taking sec 121.
        let recaptureExposure = Math.min(Math.max(totalGain, 0), deprec);
        let recaptureTax = recaptureExposure * (drTax / 100);

        // Remaining Gain after Recapture
        let remainingGain = Math.max(0, totalGain - recaptureExposure);
        
        // Apply Sec 121 (Primary Residence Exclusion) to the remaining gain
        let taxableCapGain = Math.max(0, remainingGain - sec121);
        let capGainsTax = taxableCapGain * (cgTax / 100);

        const totalTaxOwed = recaptureTax + capGainsTax;

        // Step 3: Cash In Pocket
        const netBeforeLoanOrTax = sale - sellingCosts;
        const cashInPocket = netBeforeLoanOrTax - loan - totalTaxOwed;

        // UI Updates -- Step 1
        $('s-purch').textContent = fmtC(purch);
        $('s-imp').textContent = '+'+fmtC(capEx);
        $('s-cost').textContent = '+'+fmtC(sellingCosts);
        $('s-dep').textContent = '-'+fmtC(deprec);
        $('out-adj-basis').textContent = fmtC(adjBasis);

        // UI Updates -- Step 2
        $('s-sale').textContent = fmtC(sale);
        $('s-abasis').textContent = '-'+fmtC(adjBasis);
        $('s-exc').textContent = '-'+fmtC(sec121);
        $('out-taxable-gain').textContent = fmtC(taxableCapGain);

        // UI Updates -- Step 3
        $('s-gross-net').textContent = fmtC(netBeforeLoanOrTax);
        $('s-loan').textContent = '-'+fmtC(loan);
        $('s-tax').textContent = '-'+fmtC(totalTaxOwed);
        $('out-pocket').textContent = fmtC(cashInPocket);

        // Heroes
        $('out-cash-hand').textContent = fmtC(cashInPocket);
        $('out-tax-bill').textContent = fmtC(totalTaxOwed);
        
        if (cashInPocket < 0) {
            $('out-cash-hand').className = 'output-hero-value text-danger m-0';
        } else {
            $('out-cash-hand').className = 'output-hero-value text-dark m-0';
        }

        // Insights / Tips
        let tipCon = $('tip-container');
        let tipIcon = $('tip-icon');
        let tipTitle = $('tip-title');
        let tipText = $('out-tip');

        if (cashInPocket < 0) {
             tipCon.className = "alert alert-soft-danger border-danger d-flex align-items-start gap-3 mb-0";
             tipIcon.className = "fas fa-exclamation-triangle fs-4 mt-1 text-danger";
             tipTitle.className = "fw-bold mb-1 text-danger";
             tipTitle.textContent = "Underwater Sale";
             tipText.innerHTML = `You do not have enough equity to cover the loan, selling costs, and taxes. You will need to bring <strong>${fmtC(Math.abs(cashInPocket))}</strong> to the closing table to sell this property.`;
        } else if (sec121 > 0 && taxableCapGain === 0 && recaptureTax === 0) {
             tipCon.className = "alert alert-soft-success border-success d-flex align-items-start gap-3 mb-0";
             tipIcon.className = "fas fa-check-circle fs-4 mt-1 text-success";
             tipTitle.className = "fw-bold mb-1 text-success";
             tipTitle.textContent = "Perfect Primary Sale";
             tipText.innerHTML = `Because this is your primary residence, the Section 121 exclusion completely shields your gains from the IRS. You walk away with <strong>100%</strong> of your net equity tax-free.`;
        } else if (totalTaxOwed > 40000) {
             tipCon.className = "alert alert-soft-violet border-violet d-flex align-items-start gap-3 mb-0";
             tipIcon.className = "fas fa-shield-alt fs-4 mt-1 text-violet";
             tipTitle.className = "fw-bold mb-1 text-violet";
             tipTitle.textContent = "1031 Exchange Recommended";
             tipText.innerHTML = `You are paying a massive <strong>${fmtC(totalTaxOwed)}</strong> in taxes on this sale. If this is an investment property, you can legally defer 100% of these taxes indefinitely by utilizing a <strong>1031 Exchange</strong> and rolling the equity into a new property.`;
        } else {
             tipCon.className = "alert alert-soft-slate border-slate d-flex align-items-start gap-3 mb-0";
             tipIcon.className = "fas fa-info-circle fs-4 mt-1 text-slate";
             tipTitle.className = "fw-bold mb-1 text-slate";
             tipTitle.textContent = "Solid Exit";
             tipText.innerHTML = `You are walking away with <strong>${fmtC(cashInPocket)}</strong> of liquidity while paying a manageable ${fmtC(totalTaxOwed)} in taxes.`;
        }
    }

    // Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculate));
    
    document.querySelectorAll('.es-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === '1') { // Married Primary Homeowner
                els.sale.value = 950000; els.purch.value = 500000; els.loan.value = 350000; 
                els.sec121.value = 500000; els.deprec.value = 0; els.capEx.value = 20000;
            } else if (p === '2') { // Rental Flipper
                els.sale.value = 1200000; els.purch.value = 600000; els.loan.value = 450000; 
                els.sec121.value = 0; els.deprec.value = 85000; els.capEx.value = 40000;
            }
            calculate();
        });
    });
    
    $('es-reset').addEventListener('click', () => {
        els.sale.value = 850000; els.purch.value = 500000; els.loan.value = 400000; els.costPct.value = 7.0;
        els.capEx.value = 50000; els.deprec.value = 0; els.sec121.value = 0; els.cgTax.value = 20; els.drTax.value = 25;
        calculate();
    });

    $('es-copy').addEventListener('click', function(){
        const text = `Property Exit Summary:\nSale Price: ${fmtC(els.sale.value)}\nTax Owed: ${$('out-tax-bill').textContent}\nCash In Pocket: ${$('out-pocket').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.exit-strategy-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(139,92,246,.05)}
.exit-strategy-rebuilt .border-violet { border-top: 4px solid #8b5cf6 !important; }
.exit-strategy-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.exit-strategy-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.exit-strategy-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.exit-strategy-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.exit-strategy-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.text-violet { color: #8b5cf6 !important; }
.bg-violet-soft { background-color: #f5f3ff !important; }
.text-teal { color: #0d9488 !important; }
.bg-soft-teal { background-color: #f0fdfa !important; }
.bg-soft-red { background-color: #fef2f2 !important; }

.text-orange { color: #ea580c !important; }
.bg-soft-orange { background-color: #fff7ed !important; }
.border-orange { border: 1px solid #ffedd5 !important; }

.text-green { color: #16a34a !important; }
.bg-soft-green { background-color: #f0fdf4 !important; }
.border-green { border: 1px solid #dcfce7 !important; }

.border-end-md { border-right: 1px dashed #e2e8f0; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}

.payment-box { background:#fff; border: 2px solid #e5e7eb; border-radius: 16px; padding: 1.5rem; text-align: left; }
.stat-card-label {font-size:.7rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:4px; display:block;}

.breakdown-card { background: #fff; border-radius: 12px; height: 100%; overflow: hidden; }
.bc-header { padding: 10px 15px; font-size: 0.85rem; letter-spacing: 1px; }
.bc-body { padding: 1.25rem 1.25rem; }

.alert-soft-violet { background-color: #f5f3ff; color: #6d28d9; }
.alert-soft-success { background-color: #f0fdf4; color: #166534; }
.alert-soft-danger { background-color: #fef2f2; color: #991b1b; }
.alert-soft-slate { background-color: #f8fafc; color: #334155; }
.border-slate { border-color: #cbd5e1 !important; }
.text-slate { color: #475569 !important; }

@media (max-width: 768px) {
    .border-end-md { border-right: none; border-bottom: 1px dashed #e2e8f0; padding-bottom: 2rem; }
    .ps-md-4 { padding-left: 0 !important; }
    .pe-md-4 { padding-right: 0 !important; }
}
@media print {
    .print-hide { display: none !important; }
    .output-card-themed { border: 1px solid #000; box-shadow: none; background: #fff !important; }
}
</style>

