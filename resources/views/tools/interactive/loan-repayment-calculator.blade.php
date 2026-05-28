<div class="row g-4 loan-repay-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Loan Amount</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="amount" class="form-control form-control-lg rounded-3 border-start-0" value="50000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="5.5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Loan Term (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="5" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Payment Frequency</label>
                        <select id="freq" class="form-select form-select-lg rounded-3">
                            <option value="12" selected>Monthly</option>
                            <option value="26">Bi-Weekly</option>
                            <option value="52">Weekly</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-success btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate Repayment</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:142;--tool-color:#22c55e;--tool-bg:rgba(34,197,94,.04);">
            <div class="output-hero">
                <span class="output-hero-label" id="out-label">Monthly Payment</span>
                <div class="output-hero-value" id="out-payment">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Your estimated recurring payment for this loan.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Principal</span><span class="stat-card-value" id="out-principal">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Interest</span><span class="stat-card-value text-success" id="out-interest">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Cost</span><span class="stat-card-value" id="out-cost">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-table me-2 text-success"></i>Amortization Schedule (Summary)</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle text-center mb-0" id="schedule-table">
                        <thead class="bg-light">
                            <tr class="small fw-bold text-muted">
                                <th class="py-3">Year</th>
                                <th class="py-3">Principal Paid</th>
                                <th class="py-3">Interest Paid</th>
                                <th class="py-3">Ending Balance</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Loan Summary</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const amountEl=$('amount'), rateEl=$('rate'), yearsEl=$('years'), freqEl=$('freq');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:0});

    function calculate(){
        const p = parseFloat(amountEl.value);
        const r = parseFloat(rateEl.value)/100;
        const t = parseFloat(yearsEl.value);
        const f = parseInt(freqEl.value);

        if(isNaN(p) || isNaN(r) || isNaN(t) || t <= 0 || p <= 0) return;

        const i = r / f;
        const n = t * f;

        const pmt = p * (i * Math.pow(1 + i, n)) / (Math.pow(1 + i, n) - 1);
        const totalCost = pmt * n;
        const totalInterest = totalCost - p;

        $('out-label').textContent = freqEl.options[freqEl.selectedIndex].text + ' Payment';
        $('out-payment').textContent = nf.format(pmt);
        $('out-principal').textContent = nf.format(p);
        $('out-interest').textContent = nf.format(totalInterest);
        $('out-cost').textContent = nf.format(totalCost);

        let tableHtml = '';
        let currentBalance = p;
        for(let yr=1; yr<=t; yr++){
            let yrPrincipal = 0;
            let yrInterest = 0;
            for(let k=1; k<=f; k++){
                const interest = currentBalance * i;
                const principal = pmt - interest;
                yrInterest += interest;
                yrPrincipal += principal;
                currentBalance -= principal;
            }
            if(currentBalance < 0) currentBalance = 0;
            tableHtml += `<tr>
                <td class="py-3">${yr}</td>
                <td class="py-3">${nf.format(yrPrincipal)}</td>
                <td class="py-3 text-muted">${nf.format(yrInterest)}</td>
                <td class="py-3 fw-bold">${nf.format(currentBalance)}</td>
            </tr>`;
        }
        $('schedule-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        amountEl.value=50000; rateEl.value=5.5; yearsEl.value=5; freqEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Loan Repayment Summary\nLoan Amount: ${nf.format(amountEl.value)}\n${$('out-label').textContent}: ${$('out-payment').textContent}\nTotal Interest: ${$('out-interest').textContent}\nTotal Cost: ${$('out-cost').textContent}\n— ToolsHub Loans`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.loan-repay-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.loan-repay-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.loan-repay-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.loan-repay-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.loan-repay-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.loan-repay-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.loan-repay-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.loan-repay-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.loan-repay-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.loan-repay-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .loan-repay-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .loan-repay-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
