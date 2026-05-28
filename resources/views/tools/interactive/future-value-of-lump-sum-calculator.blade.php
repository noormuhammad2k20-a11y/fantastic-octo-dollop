<div class="row g-4 fv-lump-sum-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Present Value (PV)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="pv" class="form-control form-control-lg rounded-3 border-start-0" value="5000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="8" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Investment Term (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="10" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Compounding Frequency</label>
                        <select id="compounding" class="form-select form-select-lg rounded-3">
                            <option value="1">Annually</option>
                            <option value="2">Semi-Annually</option>
                            <option value="4">Quarterly</option>
                            <option value="12" selected>Monthly</option>
                            <option value="365">Daily</option>
                            <option value="continuous">Continuous</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate FV</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:217;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Future Value (FV)</span>
                <div class="output-hero-value" id="out-fv">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-growth">Projected total value at the end of the term.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Gains</span><span class="stat-card-value text-primary" id="out-gains">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Yield Multiplier</span><span class="stat-card-value" id="out-multiplier">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Effective APY</span><span class="stat-card-value" id="out-apy">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-area me-2 text-primary"></i>Growth Projections</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="growth-table">
                        <thead class="table-light"><tr><th>Year</th><th>Principal</th><th>Cumulative Interest</th><th>Ending Balance</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Projection</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const pvEl=$('pv'), rateEl=$('rate'), yearsEl=$('years'), compoundingEl=$('compounding');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:0});

    function calculate(){
        const pv = parseFloat(pvEl.value);
        const r = parseFloat(rateEl.value)/100;
        const t = parseFloat(yearsEl.value);
        const m = compoundingEl.value;

        if(isNaN(pv) || isNaN(r) || isNaN(t) || t <= 0) return;

        let fv, apy;
        if(m === 'continuous'){
            fv = pv * Math.exp(r * t);
            apy = Math.exp(r) - 1;
        } else {
            const freq = parseInt(m);
            fv = pv * Math.pow(1 + (r / freq), freq * t);
            apy = Math.pow(1 + (r / freq), freq) - 1;
        }

        const gains = fv - pv;

        $('out-fv').textContent = nf.format(fv);
        $('out-gains').textContent = nf.format(gains);
        $('out-multiplier').textContent = (fv / pv).toFixed(2) + 'x';
        $('out-apy').textContent = (apy * 100).toFixed(2) + '%';

        let tableHtml = '';
        for(let i=1; i<=Math.min(t, 20); i++){
            let yFv;
            if(m === 'continuous') yFv = pv * Math.exp(r * i);
            else yFv = pv * Math.pow(1 + (r / parseInt(m)), parseInt(m) * i);
            
            tableHtml += `<tr>
                <td>Year ${i}</td>
                <td>${nf.format(pv)}</td>
                <td class="text-success">${nf.format(yFv - pv)}</td>
                <td class="fw-bold">${nf.format(yFv)}</td>
            </tr>`;
        }
        $('growth-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        pvEl.value=5000; rateEl.value=8; yearsEl.value=10; compoundingEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Future Value Projection\nOriginal Investment: ${nf.format(pvEl.value)}\nFuture Value: ${$('out-fv').textContent}\nTotal Interest: ${$('out-gains').textContent}\nTerm: ${yearsEl.value} years @ ${rateEl.value}%\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.fv-lump-sum-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.fv-lump-sum-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.fv-lump-sum-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.fv-lump-sum-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.fv-lump-sum-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.fv-lump-sum-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.fv-lump-sum-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.fv-lump-sum-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.fv-lump-sum-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.fv-lump-sum-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .fv-lump-sum-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .fv-lump-sum-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
