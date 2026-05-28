<div class="row g-4 margin-call-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Purchase Price per Share</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="price" class="form-control form-control-lg rounded-3 border-start-0" value="100" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Shares</label>
                        <input type="number" id="shares" class="form-control form-control-lg rounded-3" value="1000" step="10">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Margin Requirement (%)</label>
                        <div class="input-group">
                            <input type="number" id="initial-margin" class="form-control form-control-lg rounded-3" value="50" step="1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Maintenance Margin (%)</label>
                        <div class="input-group">
                            <input type="number" id="maint-margin" class="form-control form-control-lg rounded-3" value="25" step="1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-danger btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate Margin Call</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#dc2626;--tool-bg:rgba(220,38,38,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Margin Call Price</span>
                <div class="output-hero-value" id="out-mc-price">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">If the price drops below this, you must deposit more funds.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Loan (Margin)</span><span class="stat-card-value text-danger" id="out-loan">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Your Equity</span><span class="stat-card-value" id="out-equity">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Price Drop Allowed</span><span class="stat-card-value" id="out-drop">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-chart-line me-2 text-danger"></i>Account Status Simulator</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="sim-table">
                        <thead class="table-light"><tr><th>Market Price</th><th>Total Value</th><th>Your Equity %</th><th>Status</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Margin Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const priceEl=$('price'), sharesEl=$('shares'), imEl=$('initial-margin'), mmEl=$('maint-margin');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD'});

    function calculate(){
        const p = parseFloat(priceEl.value);
        const s = parseFloat(sharesEl.value);
        const im = parseFloat(imEl.value)/100;
        const mm = parseFloat(mmEl.value)/100;

        if(isNaN(p) || isNaN(s) || isNaN(im) || isNaN(mm) || p <= 0 || mm >= 1) return;

        // Margin Call Price = Purchase Price * (1 - Initial Margin) / (1 - Maintenance Margin)
        const mcPrice = p * (1 - im) / (1 - mm);
        
        const totalCost = p * s;
        const yourEquity = totalCost * im;
        const marginLoan = totalCost - yourEquity;
        const maxDrop = ((p - mcPrice) / p) * 100;

        $('out-mc-price').textContent = nf.format(mcPrice);
        $('out-loan').textContent = nf.format(marginLoan);
        $('out-equity').textContent = nf.format(yourEquity);
        $('out-drop').textContent = maxDrop.toFixed(2) + '%';

        // Simulation Table
        const pricePoints = [
            p,
            p * 0.9,
            p * 0.8,
            mcPrice,
            p * 0.6
        ];
        // Sort descending
        pricePoints.sort((a,b)=>b-a);

        let tableHtml = '';
        pricePoints.forEach(pt => {
            const val = pt * s;
            const eq = val - marginLoan;
            const eqPct = (eq / val) * 100;
            
            let status = 'Safe';
            let badgeClass = 'bg-success';
            
            if(eqPct < mm * 100){
                status = 'Margin Call';
                badgeClass = 'bg-danger';
            } else if(eqPct < (mm * 100) + 5){
                status = 'Warning';
                badgeClass = 'bg-warning text-dark';
            }

            tableHtml += `<tr>
                <td>${pt === mcPrice ? '<strong>' + nf.format(pt) + '</strong>' : nf.format(pt)}</td>
                <td>${nf.format(val)}</td>
                <td class="${eqPct < mm*100 ? 'text-danger fw-bold' : ''}">${eqPct.toFixed(1)}%</td>
                <td><span class="badge ${badgeClass}">${status}</span></td>
            </tr>`;
        });
        $('sim-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        priceEl.value=100; sharesEl.value=1000; imEl.value=50; mmEl.value=25;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Margin Call Analysis\nCall Price: ${$('out-mc-price').textContent}\nMargin Loan: ${$('out-loan').textContent}\nMax Price Drop: ${$('out-drop').textContent}\n— ToolsHub Trading`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.margin-call-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.margin-call-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.margin-call-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.margin-call-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.margin-call-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.margin-call-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.margin-call-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.margin-call-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.margin-call-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.margin-call-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .margin-call-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .margin-call-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\margin-call-calculator.blade.php ENDPATH**/ ?>