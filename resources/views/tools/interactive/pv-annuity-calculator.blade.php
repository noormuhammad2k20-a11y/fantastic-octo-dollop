<div class="row g-4 pv-ann-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Periodic Payment (P)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="payment" class="form-control form-control-lg rounded-3 border-start-0" value="2000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Discount Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annuity Term (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="5" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Payment Frequency</label>
                        <select id="freq" class="form-select form-select-lg rounded-3">
                            <option value="1" selected>Annually</option>
                            <option value="4">Quarterly</option>
                            <option value="12">Monthly</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-success btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate PV</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:158;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Present Value of Ordinary Annuity</span>
                <div class="output-hero-value" id="out-pv">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">The lump sum amount required today to fund these future payments.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Nominal Payout</span><span class="stat-card-value" id="out-total">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Interest Savings</span><span class="stat-card-value text-success" id="out-savings">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">PVIFA Factor</span><span class="stat-card-value" id="out-factor">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-chart-pie me-2 text-success"></i>Yearly Present Value Depletion</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle text-center mb-0" id="deplete-table">
                        <thead class="bg-light">
                            <tr class="small fw-bold text-muted">
                                <th class="py-3">Year</th>
                                <th class="py-3">Starting Value</th>
                                <th class="py-3">Interest Earned</th>
                                <th class="py-3">Payment Paid</th>
                                <th class="py-3">Ending Value</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy PV Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const payEl=$('payment'), rateEl=$('rate'), yearsEl=$('years'), freqEl=$('freq');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:0});

    function calculate(){
        const p = parseFloat(payEl.value);
        const r = parseFloat(rateEl.value)/100;
        const t = parseFloat(yearsEl.value);
        const f = parseInt(freqEl.value);

        if(isNaN(p) || isNaN(r) || isNaN(t) || t <= 0 || p <= 0) return;

        const i = r / f;
        const n = t * f;

        const pv = p * ((1 - Math.pow(1 + i, -n)) / i);
        const totalPayout = p * n;

        $('out-pv').textContent = nf.format(pv);
        $('out-total').textContent = nf.format(totalPayout);
        $('out-savings').textContent = nf.format(totalPayout - pv);
        $('out-factor').textContent = (pv / p).toFixed(4);

        let tableHtml = '';
        let currentBalance = pv;
        for(let yr=1; yr<=Math.min(t, 25); yr++){
            const startVal = currentBalance;
            let yrInterest = 0;
            let yrPayment = p * f;
            
            for(let k=1; k<=f; k++){
                const interest = currentBalance * i;
                yrInterest += interest;
                currentBalance = (currentBalance + interest) - p;
            }
            
            if(currentBalance < 1) currentBalance = 0;

            tableHtml += `<tr>
                <td class="py-3">${yr}</td>
                <td class="py-3">${nf.format(startVal)}</td>
                <td class="py-3 text-success">${nf.format(yrInterest)}</td>
                <td class="py-3 text-danger">-${nf.format(yrPayment)}</td>
                <td class="py-3 fw-bold">${nf.format(currentBalance)}</td>
            </tr>`;
        }
        $('deplete-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        payEl.value=2000; rateEl.value=5; yearsEl.value=5; freqEl.value=1;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `PV of Annuity Report\nPresent Value: ${$('out-pv').textContent}\nTotal Payouts: ${$('out-total').textContent}\nInterest Difference: ${$('out-savings').textContent}\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pv-ann-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pv-ann-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pv-ann-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pv-ann-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pv-ann-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pv-ann-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.pv-ann-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.pv-ann-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.pv-ann-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.pv-ann-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .pv-ann-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pv-ann-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
