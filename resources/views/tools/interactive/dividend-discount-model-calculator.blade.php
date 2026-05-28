<div class="row g-4 ddm-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Next Year's Dividend (D1)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="div" class="form-control form-control-lg rounded-3 border-start-0" value="5.00" step="0.1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Required Rate of Return (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="10" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Constant Growth Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="growth" class="form-control form-control-lg rounded-3" value="4" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Market Price (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="price" class="form-control form-control-lg rounded-3 border-start-0" value="" placeholder="Market Price">
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-fuchsia btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#d946ef;border-color:#d946ef"><i class="fas fa-calculator me-2"></i>Calculate Intrinsic Value</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:295;--tool-color:#d946ef;--tool-bg:rgba(217,70,239,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Estimated Intrinsic Value</span>
                <div class="output-hero-value" id="out-value">—</div>
                <div class="mt-2" id="out-badge">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Dividend Yield</span><span class="stat-card-value text-fuchsia" id="out-yield">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Growth Spread</span><span class="stat-card-value" id="out-spread">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Price vs Value</span><span class="stat-card-value" id="out-comp">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-search-plus me-2 text-fuchsia"></i>Sensitivity Analysis (Intrinsic Value)</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="sens-table">
                        <thead class="table-light"><tr><th>Growth Rate</th><th>8% Return</th><th>10% Return</th><th>12% Return</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Valuation</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const divEl=$('div'), rateEl=$('rate'), growthEl=$('growth'), priceEl=$('price');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD'});

    function calculate(){
        const d1 = parseFloat(divEl.value);
        const r = parseFloat(rateEl.value)/100;
        const g = parseFloat(growthEl.value)/100;
        const mp = parseFloat(priceEl.value);

        if(isNaN(d1) || isNaN(r) || isNaN(g) || r <= g) {
             $('out-value').textContent = 'Invalid Input';
             $('out-badge').innerHTML = '<span class="badge bg-danger">R must be > G</span>';
             return;
        }

        const value = d1 / (r - g);
        $('out-value').textContent = nf.format(value);
        $('out-yield').textContent = ((d1 / value) * 100).toFixed(2) + '%';
        $('out-spread').textContent = ((r - g) * 100).toFixed(1) + '%';

        if(!isNaN(mp)){
            const diff = ((value - mp) / mp) * 100;
            $('out-comp').textContent = (diff > 0 ? '+' : '') + diff.toFixed(1) + '%';
            const status = diff > 0 ? 'Undervalued' : 'Overvalued';
            const color = diff > 0 ? 'bg-success' : 'bg-danger';
            $('out-badge').innerHTML = `<span class="badge ${color} fs-6 px-3 rounded-pill">${status}</span>`;
        } else {
            $('out-comp').textContent = 'N/A';
            $('out-badge').innerHTML = '<span class="badge bg-info fs-6 px-3 rounded-pill">Model Calculated</span>';
        }

        // Table
        const gRange = [0.02, 0.03, 0.04, 0.05, 0.06];
        const rRange = [0.08, 0.10, 0.12];
        let tableHtml = '';
        gRange.forEach(gv => {
            tableHtml += `<tr><td>${(gv*100).toFixed(0)}%</td>`;
            rRange.forEach(rv => {
                const v = rv > gv ? d1 / (rv - gv) : 0;
                tableHtml += `<td>${v > 0 ? nf.format(v) : '—'}</td>`;
            });
            tableHtml += `</tr>`;
        });
        $('sens-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        divEl.value=5.00; rateEl.value=10; growthEl.value=4; priceEl.value='';
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Gordon Growth Model Report\nIntrinsic Value: ${$('out-value').textContent}\nGrowth: ${growthEl.value}%\nRequired Return: ${rateEl.value}%\n— ToolsHub Investing`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.ddm-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.ddm-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.ddm-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.ddm-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.ddm-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.ddm-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.ddm-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.ddm-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.ddm-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.ddm-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.ddm-calc-rebuilt .text-fuchsia{color:#d946ef}

@media (max-width: 768px) {
    .ddm-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .ddm-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
