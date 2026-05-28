<div class="row g-4 pos-size-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Account Balance</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="account" class="form-control form-control-lg rounded-3 border-start-0" value="10000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Risk Percentage (%)</label>
                        <div class="input-group">
                            <input type="number" id="risk-pct" class="form-control form-control-lg rounded-3" value="1" step="0.1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Entry Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="entry" class="form-control form-control-lg rounded-3 border-start-0" value="150" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Stop Loss Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="stop" class="form-control form-control-lg rounded-3 border-start-0" value="142.50" step="0.01">
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-info btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#0ea5e9;border-color:#0ea5e9"><i class="fas fa-calculator me-2"></i>Calculate Position</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:199;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Ideal Position Size</span>
                <div class="output-hero-value" id="out-units">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Maximum units/shares to buy to stay within your risk tolerance.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Capital at Risk</span><span class="stat-card-value text-danger" id="out-risk-amt">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Capital Required</span><span class="stat-card-value text-info" id="out-capital">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Stop Distance</span><span class="stat-card-value" id="out-dist">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-balance-scale me-2 text-info"></i>Risk/Reward Scenarios</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="rr-table">
                        <thead class="table-light"><tr><th>R:R Ratio</th><th>Target Price</th><th>Potential Profit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Trade Plan</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const accEl=$('account'), riskEl=$('risk-pct'), entryEl=$('entry'), stopEl=$('stop');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD'});

    function calculate(){
        const a = parseFloat(accEl.value);
        const rPct = parseFloat(riskEl.value)/100;
        const e = parseFloat(entryEl.value);
        const s = parseFloat(stopEl.value);

        if(isNaN(a) || isNaN(rPct) || isNaN(e) || isNaN(s) || e === s || a <= 0) return;

        const riskAmt = a * rPct;
        const stopDist = Math.abs(e - s);
        const units = riskAmt / stopDist;
        const capitalReq = units * e;
        
        const isLong = e > s;

        $('out-units').textContent = Math.floor(units) + ' Units';
        $('out-risk-amt').textContent = nf.format(riskAmt);
        $('out-capital').textContent = nf.format(capitalReq);
        $('out-dist').textContent = nf.format(stopDist) + ' (' + ((stopDist/e)*100).toFixed(2) + '%)';

        // R:R Table
        const rrRatios = [1, 2, 3, 5];
        let tableHtml = '';
        rrRatios.forEach(rr => {
            const profitTarget = isLong ? e + (stopDist * rr) : e - (stopDist * rr);
            const profitAmt = riskAmt * rr;
            tableHtml += `<tr>
                <td>1 : ${rr}</td>
                <td class="fw-bold">${nf.format(profitTarget)}</td>
                <td class="text-success">+${nf.format(profitAmt)}</td>
            </tr>`;
        });
        $('rr-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        accEl.value=10000; riskEl.value=1; entryEl.value=150; stopEl.value=142.50;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Trade Position Plan\nUnits: ${$('out-units').textContent}\nCapital Required: ${$('out-capital').textContent}\nRisk Amount: ${$('out-risk-amt').textContent}\nEntry: $${entryEl.value} | Stop: $${stopEl.value}\n— ToolsHub Trading`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pos-size-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pos-size-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pos-size-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pos-size-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pos-size-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pos-size-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.pos-size-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.pos-size-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.pos-size-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.pos-size-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .pos-size-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pos-size-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\position-size-calculator.blade.php ENDPATH**/ ?>