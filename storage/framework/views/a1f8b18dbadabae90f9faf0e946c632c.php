<div class="row g-4 hpr-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Investment Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="start-val" class="form-control form-control-lg rounded-3 border-start-0" value="10000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Ending Investment Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="end-val" class="form-control form-control-lg rounded-3 border-start-0" value="12500" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Income Received (Dividends/Interest)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="income" class="form-control form-control-lg rounded-3 border-start-0" value="500" step="10">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Holding Period (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="2.5" step="0.1">
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-warning btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#f97316;border-color:#f97316"><i class="fas fa-calculator me-2"></i>Calculate Return</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:24;--tool-color:#f97316;--tool-bg:rgba(249,115,22,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Holding Period Return</span>
                <div class="output-hero-value" id="out-hpr">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Cumulative return including appreciation and cash flow.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Annualized Return (CAGR)</span><span class="stat-card-value" id="out-cagr">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Dollar Profit</span><span class="stat-card-value text-orange" id="out-profit">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Capital Gains Yield</span><span class="stat-card-value" id="out-cg-yield">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-pie me-2 text-orange"></i>Return Component Breakdown</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="breakdown-table">
                        <thead class="table-light"><tr><th>Component</th><th>Amount</th><th>Contribution</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Return Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const startEl=$('start-val'), endEl=$('end-val'), incomeEl=$('income'), yearsEl=$('years');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD'});

    function calculate(){
        const s = parseFloat(startEl.value);
        const e = parseFloat(endEl.value);
        const i = parseFloat(incomeEl.value);
        const y = parseFloat(yearsEl.value);

        if(isNaN(s) || isNaN(e) || isNaN(i) || isNaN(y) || s <= 0 || y <= 0) return;

        const profit = (e - s) + i;
        const hpr = (profit / s);
        const cagr = Math.pow(1 + hpr, 1 / y) - 1;
        const cgYield = (e - s) / s;
        const divYield = i / s;

        $('out-hpr').textContent = (hpr * 100).toFixed(2) + '%';
        $('out-cagr').textContent = (cagr * 100).toFixed(2) + '%';
        $('out-profit').textContent = nf.format(profit);
        $('out-cg-yield').textContent = (cgYield * 100).toFixed(2) + '%';

        let tableHtml = `
            <tr><td>Capital Appreciation</td><td>${nf.format(e - s)}</td><td>${(cgYield * 100).toFixed(1)}%</td></tr>
            <tr><td>Income (Div/Int)</td><td>${nf.format(i)}</td><td>${(divYield * 100).toFixed(1)}%</td></tr>
            <tr class="table-light fw-bold"><td>Total Return</td><td>${nf.format(profit)}</td><td>${(hpr * 100).toFixed(1)}%</td></tr>
        `;
        $('breakdown-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        startEl.value=10000; endEl.value=12500; incomeEl.value=500; yearsEl.value=2.5;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Holding Period Return Summary\nTotal Return: ${$('out-hpr').textContent}\nAnnualized (CAGR): ${$('out-cagr').textContent}\nTotal Profit: ${$('out-profit').textContent}\nPeriod: ${yearsEl.value} Years\n— ToolsHub Investing`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.hpr-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.hpr-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.hpr-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.hpr-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.hpr-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.hpr-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.hpr-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.hpr-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.hpr-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.hpr-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.hpr-calc-rebuilt .text-orange{color:#f97316}

@media (max-width: 768px) {
    .hpr-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .hpr-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\holding-period-return-calculator.blade.php ENDPATH**/ ?>