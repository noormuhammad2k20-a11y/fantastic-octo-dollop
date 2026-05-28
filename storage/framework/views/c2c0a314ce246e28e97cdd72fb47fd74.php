<div class="row g-4 closing-cost-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            <div class="calculator-header">
                <div class="tool-icon-circle" style="background:rgba(20,184,166,.1);color:#14b8a6">
                    <i class="fas fa-file-signature"></i>
                </div>
                <div>
                    <h4>Closing Cost Estimator</h4>
                    <p>Calculate the total "out-of-pocket" expenses required to finalize your home purchase or refinance.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Home Purchase Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="home-price" class="form-control form-control-lg border-start-0" value="350000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Down Payment (%)</label>
                        <div class="input-group">
                            <input type="number" id="down-pct" class="form-control form-control-lg border-end-0" value="20" step="0.5">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Origination Fees (%)</label>
                        <div class="input-group">
                            <input type="number" id="orig-fee" class="form-control form-control-lg border-end-0" value="1.0" step="0.1">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Fixed Local Fees ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="fixed-fees" class="form-control form-control-lg border-start-0" value="2500">
                        </div>
                        <small class="text-muted">Appraisal, Inspection, Title</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Transfer Taxes (%)</label>
                        <div class="input-group">
                            <input type="number" id="transfer-tax" class="form-control form-control-lg border-end-0" value="0.75" step="0.05">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 closing-quick" data-p="250000" data-f="1500">🏠 Starter Home</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 closing-quick" data-p="550000" data-f="3500">🏡 Family Home</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 closing-quick" data-p="1200000" data-f="7000">💎 Estate</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:170;--tool-color:#14b8a6;--tool-bg:rgba(20,184,166,.06);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL ESTIMATED CLOSING COSTS</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-unit">$</span>
                    <span class="output-hero-value" id="out-closing-total">8,625</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-total-cash">Total Cash Required: $78,625</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#14b8a6; background: rgba(20,184,166,.02);">
                        <span class="stat-card-label">LOAN FEES</span>
                        <span class="stat-card-value text-teal" id="out-loan-fees">$2,800</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6; background: rgba(59,130,246,.02);">
                        <span class="stat-card-label">GOVT TAXES</span>
                        <span class="stat-card-value text-primary" id="out-tax-fees">$2,625</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">OF SALE PRICE</span>
                        <span class="stat-card-value text-warning" id="out-closing-pct">2.5%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-info-circle text-teal me-2"></i>Closing Cost Breakdown
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="closing-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-teal"></i>Copy Closing Sheet
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="closing-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="closing-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Export to Realtor
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const priceE = $('home-price'), downE = $('down-pct'), 
          origE = $('orig-fee'), fixedE = $('fixed-fees'), taxE = $('transfer-tax');

    function calculate(){
        let price = parseFloat(priceE.value) || 0;
        let downPct = parseFloat(downE.value) || 0;
        let origPct = parseFloat(origE.value) || 0;
        let fixed = parseFloat(fixedE.value) || 0;
        let taxPct = parseFloat(taxE.value) || 0;

        if(price <= 0) return;

        const loanAmt = price * (1 - (downPct / 100));
        const downAmt = price * (downPct / 100);

        // Fees
        const loanFees = loanAmt * (origPct / 100);
        const taxFees = price * (taxPct / 100);
        const totalClosing = loanFees + taxFees + fixed;

        const totalCash = downAmt + totalClosing;
        const closingPct = (totalClosing / price) * 100;

        // Update UI
        $('out-closing-total').textContent = Math.round(totalClosing).toLocaleString();
        $('out-total-cash').textContent = `Total Cash Required: $${Math.round(totalCash).toLocaleString()}`;
        
        $('out-loan-fees').textContent = '$' + Math.round(loanFees).toLocaleString();
        $('out-tax-fees').textContent = '$' + Math.round(taxFees).toLocaleString();
        $('out-closing-pct').textContent = closingPct.toFixed(1) + '%';

        // Insights
        const ins = [];
        ins.push(`Your loan amount is estimated at <strong>$${Math.round(loanAmt).toLocaleString()}</strong> after the down payment.`);
        
        if(closingPct < 2) {
            ins.push('Closing costs are relatively low for this price range. Verify if points or prepaid interest are included.');
        } else if(closingPct > 5) {
            ins.push('<strong>High Cost Alert</strong>: Closing costs exceeding 5% are unusually high. Check for expensive lender "junk" fees.');
        } else {
            ins.push('Closing costs are within the national average range (2-5% of purchase price).');
        }

        if(taxPct > 2) {
            ins.push('Significant local transfer taxes detected. This is common in some urban high-tax jurisdictions.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-teal me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [priceE, downE, origE, fixedE, taxE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.closing-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            priceE.value = btn.dataset.p;
            fixedE.value = btn.dataset.f;
            calculate();
        });
    });

    $('closing-reset').addEventListener('click', ()=>{
        priceE.value = 350000;
        downE.value = 20;
        origE.value = 1.0;
        fixedE.value = 2500;
        taxE.value = 0.75;
        calculate();
    });

    $('closing-copy-btn').addEventListener('click', function(){
        const text = `Estimated Closing Statement\nTotal Closing Costs: $${$('out-closing-total').textContent}\nTotal Cash Required: ${$('out-total-cash').textContent}\nPercentage of Sale: ${$('out-closing-pct').textContent}\nGenerated by ToolsHub Closing Cost Estimator`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Analysis Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.closing-cost-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(20,184,166,.05)}
.closing-cost-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.closing-cost-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.closing-cost-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.closing-cost-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.closing-cost-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:2rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .closing-cost-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/closing-cost-calculator.blade.php ENDPATH**/ ?>