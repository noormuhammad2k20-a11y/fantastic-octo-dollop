<div class="row g-4 zero-bond-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Face Value (at maturity)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="face" class="form-control form-control-lg rounded-3 border-start-0" value="1000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Yield to Maturity (%)</label>
                        <div class="input-group">
                            <input type="number" id="yield" class="form-control form-control-lg rounded-3" value="5.5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Time to Maturity (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="10" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Compounding Frequency</label>
                        <select id="comp" class="form-select form-select-lg rounded-3">
                            <option value="1">Annual</option>
                            <option value="2" selected>Semi-Annual</option>
                            <option value="12">Monthly</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-warning btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#eab308;border-color:#eab308"><i class="fas fa-calculator me-2"></i>Calculate Bond Price</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:45;--tool-color:#eab308;--tool-bg:rgba(234,179,8,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Bond Price</span>
                <div class="output-hero-value" id="out-price">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">The discounted price you would pay today.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Interest Gain</span><span class="stat-card-value text-warning" id="out-gain">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Purchase % of Par</span><span class="stat-card-value" id="out-pct">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Effective APY</span><span class="stat-card-value" id="out-apy">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-chart-area me-2 text-warning"></i>Value Appreciation Path</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle text-center mb-0" id="path-table">
                        <thead class="bg-light">
                            <tr class="small fw-bold text-muted">
                                <th class="py-3">Year</th>
                                <th class="py-3">Implied Value</th>
                                <th class="py-3">Interest Accrued</th>
                                <th class="py-3">Appreciation %</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Bond Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const faceEl=$('face'), yieldEl=$('yield'), yearsEl=$('years'), compEl=$('comp');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD'});

    function calculate(){
        const f = parseFloat(faceEl.value);
        const y = parseFloat(yieldEl.value)/100;
        const t = parseFloat(yearsEl.value);
        const m = parseInt(compEl.value);

        if(isNaN(f) || isNaN(y) || isNaN(t) || t <= 0) return;

        const price = f / Math.pow(1 + (y / m), m * t);
        const gain = f - price;
        const apy = Math.pow(1 + (y / m), m) - 1;

        $('out-price').textContent = nf.format(price);
        $('out-gain').textContent = nf.format(gain);
        $('out-pct').textContent = ((price / f) * 100).toFixed(2) + '%';
        $('out-apy').textContent = (apy * 100).toFixed(2) + '%';

        let tableHtml = '';
        for(let yr=1; yr<=Math.min(t, 20); yr++){
            const val = price * Math.pow(1 + (y / m), m * yr);
            const accrued = val - price;
            const appPct = (accrued / price) * 100;
            tableHtml += `<tr>
                <td class="py-3">${yr}</td>
                <td class="py-3 fw-bold">${nf.format(val)}</td>
                <td class="py-3 text-success">${nf.format(accrued)}</td>
                <td class="py-3">${appPct.toFixed(1)}%</td>
            </tr>`;
        }
        $('path-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        faceEl.value=1000; yieldEl.value=5.5; yearsEl.value=10; compEl.value=2;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Zero-Coupon Bond Report\nPrice: ${$('out-price').textContent}\nFace Value: $${faceEl.value}\nYield: ${yieldEl.value}%\nGain: ${$('out-gain').textContent}\n— ToolsHub Fixed Income`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.zero-bond-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.zero-bond-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.zero-bond-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.zero-bond-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.zero-bond-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.zero-bond-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.zero-bond-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.zero-bond-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.zero-bond-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.zero-bond-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .zero-bond-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .zero-bond-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
