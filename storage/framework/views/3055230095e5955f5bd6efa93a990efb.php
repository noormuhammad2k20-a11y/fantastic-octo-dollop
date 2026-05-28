<div class="row g-4 roi-finance-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-blue">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-blue small"><i class="fas fa-university me-2"></i>Capital & Leverage</h6>
                        
                        <label class="form-label-custom">Property Purchase Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="roif-price" class="form-control border-start-0 ps-0 fw-bold" value="500000" step="1000">
                        </div>

                        <label class="form-label-custom">Down Payment ($)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="roif-down" class="form-control border-start-0 ps-0 text-blue fw-bold bg-soft-blue" value="100000" step="1000">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label-custom">Interest Rate (%)</label>
                                <div class="input-group">
                                    <input type="number" id="roif-rate" class="form-control border-end-0" value="6.5" step="0.125">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">Amortization (Yrs)</label>
                                <select id="roif-term" class="form-select">
                                    <option value="15">15 Years</option>
                                    <option value="30" selected>30 Years</option>
                                </select>
                            </div>
                        </div>

                        <label class="form-label-custom tooltip-label" title="Your closing costs and initial repair budget. Counted as initial cash invested.">Closing & Repair Costs ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-hammer"></i></span>
                            <input type="number" id="roif-closing" class="form-control border-start-0 ps-0" value="15000" step="500">
                        </div>
                    </div>

                    
                    <div class="col-md-6 ps-md-4 mt-5 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-emerald small"><i class="fas fa-seedling me-2"></i>Operations & Market</h6>
                        
                        <label class="form-label-custom text-emerald">Gross Monthly Rent</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-soft-emerald border-end-0 text-emerald"><i class="fas fa-plus"></i></span>
                            <input type="number" id="roif-rent" class="form-control border-start-0 ps-0 fw-bold text-emerald bg-soft-emerald" value="3500" step="100">
                        </div>

                        <label class="form-label-custom tooltip-label" title="Taxes, Insurance, HOA, Maintenance, Vacancy buffer">Total Monthly OpEx ($/mo)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-minus text-danger"></i></span>
                            <input type="number" id="roif-opex" class="form-control border-start-0 ps-0 text-danger fw-bold" value="1200" step="50">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label-custom">Annual Apprec. (%)</label>
                                <div class="input-group">
                                    <input type="number" id="roif-apprec" class="form-control border-end-0" value="4.0" step="0.5">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom tooltip-label" title="Used to calculate your tax savings from depreciation">Your Tax Bracket</label>
                                <div class="input-group">
                                    <input type="number" id="roif-bracket" class="form-control border-end-0" value="24" step="1">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#2563eb;--tool-bg:#eff6ff;">
            
            <div class="row text-center mb-5 align-items-center justify-content-center">
                <div class="col-md-5">
                    <span class="output-hero-label text-blue">TRUE YEAR-1 ROI</span>
                    <h1 class="output-hero-value text-dark m-0" id="out-true-roi" style="font-size:4rem;">0%</h1>
                    <p class="text-muted small mt-2 fw-bold mb-0">Total Return on Initial Cash Invested</p>
                </div>
                <div class="col-md-2 text-center text-muted fs-4">vs</div>
                <div class="col-md-4">
                    <span class="output-hero-label text-muted">CASH-ON-CASH ROI</span>
                    <h1 class="display-4 fw-black text-secondary m-0" id="out-coc-roi">0%</h1>
                    <p class="text-muted small mt-2 fw-bold mb-0">Yield from Cashflow alone</p>
                </div>
            </div>

            <hr class="opacity-10 my-4">

            
            <h6 class="fw-bold mb-4 small text-uppercase text-muted letter-spacing-1 text-center">
                The 4 Wealth Generators (Year 1 Returns)
            </h6>

            <div class="row g-3">
                
                <div class="col-md-3">
                    <div class="generator-card border-green">
                        <div class="g-icon bg-green text-white"><i class="fas fa-money-bill-wave"></i></div>
                        <h6 class="g-title">1. Free Cashflow</h6>
                        <div class="g-val text-green" id="out-gen-cf">$0</div>
                        <p class="g-desc">Rent minus OpEx and Mortgage.</p>
                    </div>
                </div>

                
                <div class="col-md-3">
                    <div class="generator-card border-purple">
                        <div class="g-icon bg-purple text-white"><i class="fas fa-piggy-bank"></i></div>
                        <h6 class="g-title">2. Principal Paydown</h6>
                        <div class="g-val text-purple" id="out-gen-pr">$0</div>
                        <p class="g-desc">Tenants paying off your loan principal.</p>
                    </div>
                </div>

                
                <div class="col-md-3">
                    <div class="generator-card border-orange">
                        <div class="g-icon bg-orange text-white"><i class="fas fa-arrow-trend-up"></i></div>
                        <h6 class="g-title">3. Appreciation</h6>
                        <div class="g-val text-orange" id="out-gen-ap">$0</div>
                        <p class="g-desc">Growth on the total asset value, leveraged against down payment.</p>
                    </div>
                </div>

                
                <div class="col-md-3">
                    <div class="generator-card border-cyan">
                        <div class="g-icon bg-cyan text-white"><i class="fas fa-file-invoice-dollar"></i></div>
                        <h6 class="g-title">4. Tax Shield</h6>
                        <div class="g-val text-cyan" id="out-gen-tx">$0</div>
                        <p class="g-desc">Savings via depreciation deduction (simplified 27.5 yrs).</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 pt-3">
                <span class="badge bg-dark px-3 py-2 fs-6 rounded-pill">Total Year-1 Wealth Created: <span id="out-total-wealth" class="ms-1 text-info fw-black">$0</span></span>
            </div>

            <div class="row g-2 mt-5 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="roif-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-blue"></i>Copy Report
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="roif-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-download me-2"></i>Save PDF
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
        price: $('roif-price'), down: $('roif-down'), rate: $('roif-rate'),
        term: $('roif-term'), closing: $('roif-closing'),
        rent: $('roif-rent'), opex: $('roif-opex'),
        apprec: $('roif-apprec'), bracket: $('roif-bracket')
    };

    function calculateROI() {
        const price = parseFloat(els.price.value) || 0;
        const down = parseFloat(els.down.value) || 0;
        const rate = parseFloat(els.rate.value) || 0;
        const term = parseInt(els.term.value) || 30;
        const closing = parseFloat(els.closing.value) || 0;
        
        const rent = parseFloat(els.rent.value) || 0;
        const opex = parseFloat(els.opex.value) || 0;
        const apprec = parseFloat(els.apprec.value) || 0;
        const bracket = parseFloat(els.bracket.value) || 0;

        const totalCashInvested = down + closing;
        if(totalCashInvested <= 0) return;

        // 1. Cashflow
        const loanAmt = Math.max(0, price - down);
        const rMonthly = (rate / 100) / 12;
        let monthPI = 0;
        let totalInterestYr1 = 0;
        let totalPrincipalYr1 = 0;

        if(loanAmt > 0 && rate > 0) {
            monthPI = rMonthly * loanAmt / (1 - Math.pow(1 + rMonthly, -term * 12));
            // rough year 1 calc
            let bal = loanAmt;
            for(let i=1; i<=12; i++){
                let int = bal * rMonthly;
                let prin = monthPI - int;
                totalInterestYr1 += int;
                totalPrincipalYr1 += prin;
                bal -= prin;
            }
        }

        const noiAnnual = (rent - opex) * 12;
        const cashFlowAnnual = noiAnnual - (monthPI * 12);

        // 2. Principal Paydown
        const principalAnnual = totalPrincipalYr1;

        // 3. Appreciation
        const appreciationAnnual = price * (apprec / 100);

        // 4. Tax Shield (Depreciation)
        // Assume 80% improvement ratio for depreciation over 27.5 yrs
        const improvementValue = price * 0.80;
        const annualDepreciation = improvementValue / 27.5;
        // Tax savings = Deduction * Marginal Bracket
        const taxSavingsAnnual = annualDepreciation * (bracket / 100);

        // Summation
        const totalWealthCreated = cashFlowAnnual + principalAnnual + appreciationAnnual + taxSavingsAnnual;
        const trueROI = (totalWealthCreated / totalCashInvested) * 100;
        const cocROI = (cashFlowAnnual / totalCashInvested) * 100;

        // Update UI
        $('out-true-roi').textContent = trueROI.toFixed(1) + '%';
        $('out-coc-roi').textContent = cocROI.toFixed(1) + '%';

        $('out-gen-cf').textContent = fmtC(cashFlowAnnual);
        $('out-gen-pr').textContent = fmtC(principalAnnual);
        $('out-gen-ap').textContent = fmtC(appreciationAnnual);
        $('out-gen-tx').textContent = fmtC(taxSavingsAnnual);

        $('out-total-wealth').textContent = fmtC(totalWealthCreated);
    }

    // Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculateROI));
    
    $('roif-reset').addEventListener('click', () => {
        els.price.value = 500000; els.down.value = 100000; els.rate.value = 6.5; 
        els.closing.value = 15000; els.rent.value = 3500; els.opex.value = 1200;
        calculateROI();
    });

    $('roif-copy').addEventListener('click', function(){
        const text = `Real Estate True ROI (${fmtC(els.price.value)} Property):\nTotal Cash Invested: ${fmtC(parseFloat(els.down.value)+parseFloat(els.closing.value))}\nTrue ROI: ${$('out-true-roi').textContent}\nCash-on-Cash: ${$('out-coc-roi').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculateROI();
});
</script>

<style>
.roi-finance-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(37,99,235,.05)}
.roi-finance-rebuilt .border-blue { border-top: 4px solid #3b82f6; }
.roi-finance-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.roi-finance-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.roi-finance-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.roi-finance-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.roi-finance-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.text-blue { color: #2563eb !important; }
.bg-blue { background-color: #2563eb !important; }
.bg-blue-soft { background-color: #eff6ff !important; }
.bg-soft-blue { background-color: #eff6ff !important; }

.text-emerald { color: #10b981 !important; }
.bg-soft-emerald { background-color: #ecfdf5 !important; }

.border-end-md { border-right: 1px dashed #e2e8f0; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}

.generator-card { background: #fff; border-radius: 16px; padding: 1.5rem; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,.03); height:100%; position: relative; overflow: hidden; }
.generator-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 4px; }
.border-green::before { background: #10b981; }
.border-purple::before { background: #8b5cf6; }
.border-orange::before { background: #f59e0b; }
.border-cyan::before { background: #06b6d4; }

.g-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin: 0 auto 1rem auto; }
.bg-green { background: #10b981; }
.text-green { color: #10b981; }
.bg-purple { background: #8b5cf6; }
.text-purple { color: #8b5cf6; }
.bg-orange { background: #f59e0b; }
.text-orange { color: #f59e0b; }
.bg-cyan { background: #06b6d4; }
.text-cyan { color: #06b6d4; }

.g-title { font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; margin-bottom: 0.5rem; }
.g-val { font-weight: 900; font-size: 1.7rem; line-height: 1; margin-bottom: 0.5rem; }
.g-desc { font-size: 0.75rem; color: #94a3b8; margin: 0; line-height: 1.4; }

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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\real-estate-roi-with-financing-calculator.blade.php ENDPATH**/ ?>