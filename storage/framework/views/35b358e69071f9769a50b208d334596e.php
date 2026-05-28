<div class="row g-4 pv-growing-ann-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">First Payment Amount (P)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="payment" class="form-control form-control-lg rounded-3 border-start-0" value="5000" step="500">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Discount Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="8" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Growth Rate per Period (%)</label>
                        <div class="input-group">
                            <input type="number" id="growth" class="form-control form-control-lg rounded-3" value="3" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Periods (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="15" step="1">
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-teal btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#14b8a6;border-color:#14b8a6"><i class="fas fa-calculator me-2"></i>Calculate PV</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:171;--tool-color:#14b8a6;--tool-bg:rgba(20,184,166,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Present Value of Growing Annuity</span>
                <div class="output-hero-value" id="out-pv">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">The total discounted value of the growing cash flow stream.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Nominal Payout</span><span class="stat-card-value" id="out-total">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Final Payment</span><span class="stat-card-value text-teal" id="out-final">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Value Multiplier</span><span class="stat-card-value" id="out-mult">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-table me-2 text-teal"></i>Cash Flow Projections</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle text-center mb-0" id="flow-table">
                        <thead class="bg-light">
                            <tr class="small fw-bold text-muted">
                                <th class="py-3">Year</th>
                                <th class="py-3">Nominal Payment</th>
                                <th class="py-3">Discounted (PV)</th>
                                <th class="py-3">Cumulative PV</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Results</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const payEl=$('payment'), rateEl=$('rate'), growthEl=$('growth'), yearsEl=$('years');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:0});

    function calculate(){
        const p = parseFloat(payEl.value);
        const r = parseFloat(rateEl.value)/100;
        const g = parseFloat(growthEl.value)/100;
        const n = parseFloat(yearsEl.value);

        if(isNaN(p) || isNaN(r) || isNaN(g) || isNaN(n) || n <= 0) return;

        let pv;
        if(Math.abs(r - g) < 0.00001){
            pv = n * p / (1 + r);
        } else {
            pv = p * (1 - Math.pow((1 + g) / (1 + r), n)) / (r - g);
        }

        let tableHtml = '';
        let totalNominal = 0;
        let cumulativePV = 0;
        let lastPay = 0;

        for(let yr=1; yr<=n; yr++){
            const yrPay = p * Math.pow(1 + g, yr - 1);
            const yrPV = yrPay / Math.pow(1 + r, yr);
            totalNominal += yrPay;
            cumulativePV += yrPV;
            lastPay = yrPay;

            if(yr <= 20 || yr === n){
                tableHtml += `<tr>
                    <td class="py-3">${yr}</td>
                    <td class="py-3">${nf.format(yrPay)}</td>
                    <td class="py-3 text-teal">${nf.format(yrPV)}</td>
                    <td class="py-3 fw-bold">${nf.format(cumulativePV)}</td>
                </tr>`;
                if(yr === 20 && n > 21){
                    tableHtml += `<tr><td colspan="4" class="text-muted py-2">... up to year ${n} ...</td></tr>`;
                }
            }
        }

        $('out-pv').textContent = nf.format(pv);
        $('out-total').textContent = nf.format(totalNominal);
        $('out-final').textContent = nf.format(lastPay);
        $('out-mult').textContent = (pv / p).toFixed(2) + 'x';
        $('flow-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        payEl.value=5000; rateEl.value=8; growthEl.value=3; yearsEl.value=15;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Growing Annuity Analysis\nPresent Value: ${$('out-pv').textContent}\nTotal Nominal: ${$('out-total').textContent}\nGrowth: ${growthEl.value}%\nDiscount: ${rateEl.value}%\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pv-growing-ann-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pv-growing-ann-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pv-growing-ann-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pv-growing-ann-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pv-growing-ann-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pv-growing-ann-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.pv-growing-ann-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.pv-growing-ann-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.pv-growing-ann-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.pv-growing-ann-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.pv-growing-ann-rebuilt .text-teal{color:#14b8a6}

@media (max-width: 768px) {
    .pv-growing-ann-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pv-growing-ann-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\pv-growing-annuity-calculator.blade.php ENDPATH**/ ?>