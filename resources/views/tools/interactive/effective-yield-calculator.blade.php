<div class="row g-4 effective-yield-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Nominal Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="6" step="0.01">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Compounding Frequency</label>
                        <select id="compounding" class="form-select form-select-lg rounded-3">
                            <option value="1">Annually (m=1)</option>
                            <option value="2">Semi-Annually (m=2)</option>
                            <option value="4">Quarterly (m=4)</option>
                            <option value="12" selected>Monthly (m=12)</option>
                            <option value="365">Daily (m=365)</option>
                            <option value="continuous">Continuous</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-teal btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#14b8a6;border-color:#14b8a6"><i class="fas fa-calculator me-2"></i>Calculate APY</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:171;--tool-color:#14b8a6;--tool-bg:rgba(20,184,166,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Effective Annual Yield (APY)</span>
                <div class="output-hero-value" id="out-yield">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-formula">APY = (1 + r/m)^m - 1</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Daily Yield</span><span class="stat-card-value" id="out-daily">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Yield Premium</span><span class="stat-card-value text-teal" id="out-premium">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Compounding Hits</span><span class="stat-card-value" id="out-hits">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-balance-scale me-2 text-teal"></i>Compounding Comparison Table</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="comp-table">
                        <thead class="table-light"><tr><th>Frequency</th><th>Effective Rate</th><th>APY Increase</th></tr></thead>
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
    const rateEl=$('rate'), compoundingEl=$('compounding');

    function getEff(r, m){
        if(m === 'continuous') return Math.exp(r) - 1;
        return Math.pow(1 + r/m, m) - 1;
    }

    function calculate(){
        const r = parseFloat(rateEl.value)/100;
        const m = compoundingEl.value === 'continuous' ? 'continuous' : parseInt(compoundingEl.value);

        if(isNaN(r)) return;

        const eff = getEff(r, m);
        const premium = eff - r;

        $('out-yield').textContent = (eff * 100).toFixed(4) + '%';
        $('out-daily').textContent = (r / 365 * 100).toFixed(6) + '%';
        $('out-premium').textContent = '+' + (premium * 100).toFixed(4) + '%';
        $('out-hits').textContent = m === 'continuous' ? 'Infinite' : m;
        $('out-formula').textContent = m === 'continuous' ? 'APY = e^r - 1' : 'APY = (1 + r/m)^m - 1';

        // Comparison Table
        const freqs = [
            {n:'Annual', m:1},
            {n:'Semi-Annual', m:2},
            {n:'Quarterly', m:4},
            {n:'Monthly', m:12},
            {n:'Weekly', m:52},
            {n:'Daily', m:365},
            {n:'Continuous', m:'continuous'}
        ];

        let tableHtml = '';
        freqs.forEach(f => {
            const fEff = getEff(r, f.m);
            const inc = (fEff - r) * 100;
            const active = (f.m === m);
            tableHtml += `<tr class="${active ? 'table-teal fw-bold' : ''}">
                <td>${f.n}</td>
                <td>${(fEff * 100).toFixed(4)}%</td>
                <td class="text-success">+${inc.toFixed(4)}%</td>
            </tr>`;
        });
        $('comp-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        rateEl.value=6; compoundingEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Effective Yield Comparison\nNominal Rate: ${rateEl.value}%\nSelected APY: ${$('out-yield').textContent}\nYield Premium: ${$('out-premium').textContent}\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.effective-yield-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.effective-yield-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.effective-yield-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.effective-yield-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.effective-yield-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.effective-yield-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.effective-yield-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.effective-yield-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.effective-yield-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.effective-yield-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.effective-yield-rebuilt .text-teal{color:#14b8a6}
.effective-yield-rebuilt .table-teal{background:rgba(20,184,166,.08)}

@media (max-width: 768px) {
    .effective-yield-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .effective-yield-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
