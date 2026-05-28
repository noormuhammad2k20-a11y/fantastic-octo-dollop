<div class="row g-4 bvps-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Assets</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="assets" class="form-control form-control-lg rounded-3 border-start-0" value="50000000" step="10000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Liabilities</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="liab" class="form-control form-control-lg rounded-3 border-start-0" value="30000000" step="10000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Preferred Equity (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="pref" class="form-control form-control-lg rounded-3 border-start-0" value="5000000" step="10000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Shares Outstanding</label>
                        <input type="number" id="shares" class="form-control form-control-lg rounded-3" value="1000000" step="1000">
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-orange btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#ea580c;border-color:#ea580c"><i class="fas fa-calculator me-2"></i>Calculate BVPS</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:24;--tool-color:#ea580c;--tool-bg:rgba(234,88,12,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Book Value Per Share</span>
                <div class="output-hero-value" id="out-bvps">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">The theoretical value a shareholder would receive if the company was liquidated.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Equity</span><span class="stat-card-value text-orange" id="out-equity">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Common Equity</span><span class="stat-card-value" id="out-common">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Debt-to-Equity</span><span class="stat-card-value" id="out-dte">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-balance-scale me-2 text-orange"></i>Balance Sheet Summary</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle text-center mb-0" id="bs-table">
                        <thead class="bg-light">
                            <tr class="small fw-bold text-muted">
                                <th class="py-3 text-start ps-3">Component</th>
                                <th class="py-3">Amount</th>
                                <th class="py-3">% of Assets</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy BVPS Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const assetsEl=$('assets'), liabEl=$('liab'), prefEl=$('pref'), sharesEl=$('shares');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:2});

    function calculate(){
        const a = parseFloat(assetsEl.value);
        const l = parseFloat(liabEl.value);
        const p = parseFloat(prefEl.value) || 0;
        const s = parseFloat(sharesEl.value);

        if(isNaN(a) || isNaN(l) || isNaN(s) || s <= 0) return;

        const totalEquity = a - l;
        const commonEquity = totalEquity - p;
        const bvps = commonEquity / s;
        const dte = l / totalEquity;

        $('out-bvps').textContent = nf.format(bvps);
        $('out-equity').textContent = '$' + (totalEquity / 1000000).toFixed(2) + 'M';
        $('out-common').textContent = '$' + (commonEquity / 1000000).toFixed(2) + 'M';
        $('out-dte').textContent = (dte * 100).toFixed(1) + '%';

        let tableHtml = `
            <tr><td class="text-start ps-3 py-2 fw-bold">Total Assets</td><td class="py-2">${nf.format(a)}</td><td class="py-2">100.0%</td></tr>
            <tr><td class="text-start ps-3 py-2 text-danger">Less: Liabilities</td><td class="py-2 text-danger">-${nf.format(l)}</td><td class="py-2">${((l/a)*100).toFixed(1)}%</td></tr>
            <tr class="bg-light"><td class="text-start ps-3 py-2 fw-bold text-orange">Total Equity</td><td class="py-2 fw-bold text-orange">${nf.format(totalEquity)}</td><td class="py-2 fw-bold text-orange">${((totalEquity/a)*100).toFixed(1)}%</td></tr>
            <tr><td class="text-start ps-3 py-2 text-muted">Less: Preferred Equity</td><td class="py-2 text-muted">-${nf.format(p)}</td><td class="py-2 text-muted">${((p/a)*100).toFixed(1)}%</td></tr>
            <tr><td class="text-start ps-3 py-2 fw-bold text-success">Common Equity</td><td class="py-2 fw-bold text-success">${nf.format(commonEquity)}</td><td class="py-2 fw-bold text-success">${((commonEquity/a)*100).toFixed(1)}%</td></tr>
        `;
        $('bs-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        assetsEl.value=50000000; liabEl.value=30000000; prefEl.value=5000000; sharesEl.value=1000000;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `BVPS Analysis\nBook Value Per Share: ${$('out-bvps').textContent}\nTotal Equity: ${$('out-equity').textContent}\nDebt-to-Equity: ${$('out-dte').textContent}\n— ToolsHub Investing`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.bvps-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.bvps-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.bvps-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.bvps-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.bvps-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.bvps-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.bvps-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.bvps-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.bvps-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.bvps-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.bvps-calc-rebuilt .text-orange{color:#ea580c}

@media (max-width: 768px) {
    .bvps-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .bvps-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\book-value-per-share-calculator.blade.php ENDPATH**/ ?>