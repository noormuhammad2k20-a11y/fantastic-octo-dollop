<div class="row g-4 pv-ann-due-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Periodic Payment (P)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="payment" class="form-control form-control-lg rounded-3 border-start-0" value="1000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Discount Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="6" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Periods (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="10" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Payment Frequency</label>
                        <select id="freq" class="form-select form-select-lg rounded-3">
                            <option value="1">Annually</option>
                            <option value="4">Quarterly</option>
                            <option value="12" selected>Monthly</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-fuchsia btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#d946ef;border-color:#d946ef"><i class="fas fa-calculator me-2"></i>Calculate PV Due</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:295;--tool-color:#d946ef;--tool-bg:rgba(217,70,239,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Present Value of Annuity Due</span>
                <div class="output-hero-value" id="out-pv-due">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Current worth of all future payments adjusted for time and interest.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Cash Outlay</span><span class="stat-card-value" id="out-total">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Interest Discount</span><span class="stat-card-value text-fuchsia" id="out-discount">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">PVIFA Due Factor</span><span class="stat-card-value" id="out-factor">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3 text-fuchsia"><i class="fas fa-balance-scale me-2"></i>Due vs Ordinary PV Comparison</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="compare-table">
                        <thead class="table-light"><tr><th>Type</th><th>Present Value</th><th>Difference</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy PV Analysis</button>
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

        const pv_ord = p * ((1 - Math.pow(1 + i, -n)) / i);
        const pv_due = pv_ord * (1 + i);
        const totalPayments = p * n;

        $('out-pv-due').textContent = nf.format(pv_due);
        $('out-total').textContent = nf.format(totalPayments);
        $('out-discount').textContent = nf.format(totalPayments - pv_due);
        $('out-factor').textContent = (pv_due / p).toFixed(4);

        let tableHtml = `
            <tr><td>Ordinary Annuity</td><td>${nf.format(pv_ord)}</td><td>-</td></tr>
            <tr class="fw-bold text-fuchsia"><td>Annuity Due</td><td>${nf.format(pv_due)}</td><td>+${nf.format(pv_due - pv_ord)}</td></tr>
        `;
        $('compare-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        payEl.value=1000; rateEl.value=6; yearsEl.value=10; freqEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `PV of Annuity Due Analysis\nPV Due: ${$('out-pv-due').textContent}\nTotal Payments: ${$('out-total').textContent}\nInterest Discount: ${$('out-discount').textContent}\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pv-ann-due-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pv-ann-due-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pv-ann-due-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pv-ann-due-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pv-ann-due-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pv-ann-due-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.pv-ann-due-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.pv-ann-due-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.pv-ann-due-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.pv-ann-due-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.pv-ann-due-rebuilt .text-fuchsia{color:#d946ef}

@media (max-width: 768px) {
    .pv-ann-due-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pv-ann-due-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
