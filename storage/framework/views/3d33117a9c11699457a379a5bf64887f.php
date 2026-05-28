<div class="row g-4 tey-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Tax-Free Yield (%)</label>
                        <div class="input-group">
                            <input type="number" id="tf-yield" class="form-control form-control-lg rounded-3" value="4" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Marginal Federal Tax Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="fed-tax" class="form-control form-control-lg rounded-3" value="24" step="1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">State Tax Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="state-tax" class="form-control form-control-lg rounded-3" value="5" step="0.1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Investment Type</label>
                        <select id="inv-type" class="form-select form-select-lg rounded-3">
                            <option value="both">State & Federal Tax-Free</option>
                            <option value="fed">Federal Tax-Free Only</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-info btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#06b6d4;border-color:#06b6d4"><i class="fas fa-calculator me-2"></i>Calculate TEY</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:188;--tool-color:#06b6d4;--tool-bg:rgba(6,182,212,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Tax Equivalent Yield (TEY)</span>
                <div class="output-hero-value" id="out-tey">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">A taxable investment must yield this much to match your tax-free option.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Combined Tax Rate</span><span class="stat-card-value" id="out-total-tax">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Yield Boost</span><span class="stat-card-value text-cyan" id="out-boost">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Tax Savings (per $10k)</span><span class="stat-card-value" id="out-savings">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-bar me-2 text-cyan"></i>Yield Comparison by Tax Bracket</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="bracket-table">
                        <thead class="table-light"><tr><th>Federal Bracket</th><th>Effective TEY</th><th>Yield Advantage</th></tr></thead>
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
    const tfYieldEl=$('tf-yield'), fedTaxEl=$('fed-tax'), stateTaxEl=$('state-tax'), typeEl=$('inv-type');

    function calculate(){
        const y = parseFloat(tfYieldEl.value)/100;
        const fed = parseFloat(fedTaxEl.value)/100;
        const state = parseFloat(stateTaxEl.value)/100;
        const type = typeEl.value;

        if(isNaN(y) || isNaN(fed) || isNaN(state)) return;

        let totalTax;
        if(type === 'both'){
            // Municipal bond usually state tax free if held in-state
            totalTax = fed + state;
        } else {
            totalTax = fed;
        }

        const tey = y / (1 - totalTax);
        const boost = tey - y;
        const savings = (tey - y) * 10000;

        $('out-tey').textContent = (tey * 100).toFixed(2) + '%';
        $('out-total-tax').textContent = (totalTax * 100).toFixed(1) + '%';
        $('out-boost').textContent = '+' + (boost * 100).toFixed(2) + '%';
        $('out-savings').textContent = '$' + savings.toFixed(2);

        // Bracket Table
        const brackets = [10, 12, 22, 24, 32, 35, 37];
        let tableHtml = '';
        brackets.forEach(b => {
            const bTax = (b/100) + (type==='both' ? state : 0);
            const bTey = y / (1 - bTax);
            const bAdv = bTey - y;
            tableHtml += `<tr>
                <td>${b}%</td>
                <td class="fw-bold">${(bTey * 100).toFixed(2)}%</td>
                <td class="text-success">+${(bAdv * 100).toFixed(2)}%</td>
            </tr>`;
        });
        $('bracket-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        tfYieldEl.value=4; fedTaxEl.value=24; stateTaxEl.value=5; typeEl.value='both';
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Tax Equivalent Yield Analysis\nTax-Free Yield: ${tfYieldEl.value}%\nEquivalent Taxable Yield: ${$('out-tey').textContent}\nTotal Tax Rate: ${$('out-total-tax').textContent}\n— ToolsHub Investing`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.tey-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.tey-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.tey-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.tey-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.tey-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.tey-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.tey-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.tey-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.tey-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.tey-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.tey-calc-rebuilt .text-cyan{color:#0891b2}

@media (max-width: 768px) {
    .tey-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .tey-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\tax-equivalent-yield-calculator.blade.php ENDPATH**/ ?>