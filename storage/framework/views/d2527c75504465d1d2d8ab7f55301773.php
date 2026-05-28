<div class="row g-4 loan-eligibility-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Net Monthly Income</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="monthly-income" class="form-control form-control-lg border-start-0" value="6500">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Monthly Debt Payments</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="monthly-debt" class="form-control form-control-lg border-start-0" value="450">
                        </div>
                        <small class="text-muted">Includes car loans, credit cards, and other student loans.</small>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="loan-rate" class="form-control form-control-lg border-end-0" value="6.5" step="0.1">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Loan Term (Years)</label>
                        <input type="number" id="loan-years" class="form-control form-control-lg" value="30">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Target DTI Ratio (%)</label>
                        <select id="target-dti" class="form-select form-select-lg">
                            <option value="36">36% (Golden Standard)</option>
                            <option value="43" selected>43% (Standard Limit)</option>
                            <option value="50">50% (High Debt Limit)</option>
                        </select>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 loan-quick" data-i="4000" data-d="200">🥗 Entry Level</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 loan-quick" data-i="8500" data-d="800">💼 Professional</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 loan-quick" data-i="15000" data-d="1500">🏢 High Earner</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:230;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.06);">
            <div class="output-hero">
                <span class="output-hero-label">ESTIMATED BORROWING LIMIT</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-unit">$</span>
                    <span class="output-hero-value" id="out-loan-amt">375,000</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-monthly-payment">Max Monthly P&I: $2,345</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#6366f1; background: rgba(99,102,241,.02);">
                        <span class="stat-card-label">CURRENT DTI</span>
                        <span class="stat-card-value text-primary" id="out-current-dti">6.9%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">LENDING GRADE</span>
                        <span class="stat-card-value text-success" id="out-grade">A+</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">AVAILABLE DTI GAP</span>
                        <span class="stat-card-value text-warning" id="out-dti-gap">36.1%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-file-contract text-primary me-2"></i>Bank Eligibility Analysis
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="loan-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-primary"></i>Copy Eligibility Report
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="loan-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="loan-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Send to Broker
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const incE = $('monthly-income'), debtE = $('monthly-debt'), 
          rateE = $('loan-rate'), yearE = $('loan-years'), dtiE = $('target-dti');

    function calculate(){
        let inc = parseFloat(incE.value) || 0;
        let dbt = parseFloat(debtE.value) || 0;
        let rat = (parseFloat(rateE.value) || 0) / 100 / 12; // monthly rate
        let yrs = parseFloat(yearE.value) || 0;
        let targetDTI = (parseFloat(dtiE.value) || 0) / 100;

        if(inc <= 0) return;

        // Current DTI
        const currentDTI = (dbt / inc) * 100;
        
        // Max Monthly Payment allowed by specific DTI
        // Max P&I = (Gross Income * DTI) - Debts
        const maxTotalPayment = inc * targetDTI;
        const maxPI = Math.max(0, maxTotalPayment - dbt);

        // Loan amount formula (Present Value of Annuity)
        // L = P * [1 - (1+r)^-n] / r
        let loanAmt = 0;
        if(rat > 0 && yrs > 0) {
            const n = yrs * 12;
            loanAmt = maxPI * (1 - Math.pow(1 + rat, -n)) / rat;
        } else if(yrs > 0) {
            loanAmt = maxPI * yrs * 12;
        }

        // Available Gap
        const availableGap = Math.max(0, (targetDTI * 100) - currentDTI);

        // Grade
        let grade = 'F';
        if(currentDTI < 10) grade = 'A+';
        else if(currentDTI < 25) grade = 'A';
        else if(currentDTI < 36) grade = 'B';
        else if(currentDTI < 43) grade = 'C';
        else grade = 'D';

        // Update UI
        $('out-loan-amt').textContent = Math.round(loanAmt).toLocaleString();
        $('out-monthly-payment').textContent = `Max Monthly P&I: $${Math.round(maxPI).toLocaleString()}`;
        
        $('out-current-dti').textContent = currentDTI.toFixed(1) + '%';
        $('out-grade').textContent = grade;
        $('out-dti-gap').textContent = availableGap.toFixed(1) + '%';

        // Insights
        const ins = [];
        ins.push(`Based on a ${Math.round(targetDTI*100)}% DTI limit, you can afford up to <strong>$${Math.round(maxPI).toLocaleString()}</strong> in additional monthly mortgage payments.`);
        
        if(currentDTI > 40) {
            ins.push('<strong>High Debt Load</strong>: Your existing debt is significant. Banks may require a larger down payment or higher credit score.');
        } else {
            ins.push('Healthy debt-to-income profile. You are in a strong position for competitive interest rates.');
        }

        if(rat * 12 * 100 > 7.5) {
            ins.push('Current rates are high. Consider a shorter term or looking for refinancing options in 12-24 months.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [incE, debtE, rateE, yearE, dtiE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.loan-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            incE.value = btn.dataset.i;
            debtE.value = btn.dataset.d;
            calculate();
        });
    });

    $('loan-reset').addEventListener('click', ()=>{
        incE.value = 6500;
        debtE.value = 450;
        rateE.value = 6.5;
        yearE.value = 30;
        dtiE.value = 43;
        calculate();
    });

    $('loan-copy-btn').addEventListener('click', function(){
        const text = `Loan Eligibility Report\nMax Loan Amount: $${$('out-loan-amt').textContent}\nMax Monthly Payment: ${$('out-monthly-payment').textContent}\nCurrent DTI: ${$('out-current-dti').textContent}\nGenerated by ToolsHub Borrowing Capacity Optimizer`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Report Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.loan-eligibility-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(99,102,241,.05)}
.loan-eligibility-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.loan-eligibility-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.loan-eligibility-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.loan-eligibility-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.loan-eligibility-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
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
    .loan-eligibility-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\loan-eligibility-calculator.blade.php ENDPATH**/ ?>