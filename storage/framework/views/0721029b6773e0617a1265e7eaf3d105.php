<div class="row g-4 fva-due-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Payment Amount (at start)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="payment" class="form-control form-control-lg rounded-3 border-start-0" value="1000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Growth Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="7" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Years of Investment</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="15" step="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Deposit Frequency</label>
                        <select id="freq" class="form-select form-select-lg rounded-3">
                            <option value="1">Annually</option>
                            <option value="4">Quarterly</option>
                            <option value="12" selected>Monthly</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Compounding</label>
                        <select id="comp" class="form-select form-select-lg rounded-3">
                            <option value="1">Annually</option>
                            <option value="12" selected>Monthly</option>
                            <option value="365">Daily</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-fuchsia btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#d946ef;border-color:#d946ef"><i class="fas fa-calculator me-2"></i>Calculate FV Due</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:295;--tool-color:#d946ef;--tool-bg:rgba(217,70,239,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Future Value of Annuity Due</span>
                <div class="output-hero-value" id="out-fva-due">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-diff">Payments earn interest for one additional period compared to ordinary annuities.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Extra Interest Earned</span><span class="stat-card-value text-fuchsia" id="out-extra">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total End Balance</span><span class="stat-card-value" id="out-total">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Growth Multiple</span><span class="stat-card-value" id="out-mult">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-balance-scale me-2 text-fuchsia"></i>Annuity Due vs. Ordinary Comparison</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle text-center mb-0" id="compare-table">
                        <thead class="bg-light">
                            <tr class="small fw-bold text-muted">
                                <th class="py-3">Scenario</th>
                                <th class="py-3">Total Payments</th>
                                <th class="py-3">Total Interest</th>
                                <th class="py-3">Final Value</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Comparison</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const payEl=$('payment'), rateEl=$('rate'), yearsEl=$('years'), freqEl=$('freq'), compEl=$('comp');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:0});

    function calculate(){
        const p = parseFloat(payEl.value);
        const r = parseFloat(rateEl.value)/100;
        const t = parseFloat(yearsEl.value);
        const f = parseInt(freqEl.value);
        const m = parseInt(compEl.value);

        if(isNaN(p) || isNaN(r) || isNaN(t) || t <= 0) return;

        const i = Math.pow(1 + (r / m), m / f) - 1;
        const n = t * f;

        const fva_ord = p * ((Math.pow(1 + i, n) - 1) / i);
        const fva_due = fva_ord * (1 + i);
        
        const totalContrib = p * n;
        const extraInterest = fva_due - fva_ord;

        $('out-fva-due').textContent = nf.format(fva_due);
        $('out-extra').textContent = nf.format(extraInterest);
        $('out-total').textContent = nf.format(fva_due);
        $('out-mult').textContent = (fva_due / totalContrib).toFixed(2) + 'x';

        let tableHtml = `
            <tr>
                <td class="py-3 text-start ps-3">Ordinary (End of Period)</td>
                <td class="py-3">${nf.format(totalContrib)}</td>
                <td class="py-3 text-muted">${nf.format(fva_ord - totalContrib)}</td>
                <td class="py-3 fw-bold">${nf.format(fva_ord)}</td>
            </tr>
            <tr class="bg-soft-fuchsia">
                <td class="py-3 text-start ps-3 fw-bold text-fuchsia">Annuity Due (Start of Period)</td>
                <td class="py-3 fw-bold">${nf.format(totalContrib)}</td>
                <td class="py-3 fw-bold text-success">${nf.format(fva_due - totalContrib)}</td>
                <td class="py-3 fw-bold text-fuchsia">${nf.format(fva_due)}</td>
            </tr>
        `;
        $('compare-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        payEl.value=1000; rateEl.value=7; yearsEl.value=15; freqEl.value=12; compEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Annuity Due Comparison\nAnnuity Due FV: ${$('out-fva-due').textContent}\nOrdinary FV: ${nf.format(parseFloat($('out-fva-due').textContent.replace(/[^0-9.-]+/g,"")) / (1 + (parseFloat(rateEl.value)/100/parseInt(freqEl.value))))}\nExtra Earned: ${$('out-extra').textContent}\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.fva-due-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.fva-due-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.fva-due-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.fva-due-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.fva-due-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.fva-due-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.fva-due-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.fva-due-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.fva-due-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.fva-due-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.fva-due-calc-rebuilt .text-fuchsia{color:#d946ef}
.fva-due-calc-rebuilt .bg-soft-fuchsia{background:rgba(217,70,239,.05)}

@media (max-width: 768px) {
    .fva-due-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .fva-due-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\future-value-of-annuity-due-calculator.blade.php ENDPATH**/ ?>