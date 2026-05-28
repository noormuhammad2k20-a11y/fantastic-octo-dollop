<div class="row g-4 fvif-factor-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Annual Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Time Periods (Years)</label>
                        <input type="number" id="periods" class="form-control form-control-lg rounded-3" value="10" step="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Compounding Frequency</label>
                        <select id="compounding" class="form-select form-select-lg rounded-3">
                            <option value="1">Annually</option>
                            <option value="2">Semi-Annually</option>
                            <option value="4">Quarterly</option>
                            <option value="12" selected>Monthly</option>
                            <option value="365">Daily</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-info btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#0ea5e9;border-color:#0ea5e9"><i class="fas fa-calculator me-2"></i>Calculate Factor</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:199;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">FVIF Multiplier</span>
                <div class="output-hero-value" id="out-fvif">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-formula">FVIF = (1 + r/m)^(n*m)</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Growth %</span><span class="stat-card-value text-info" id="out-growth-pct">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Value of $1,000</span><span class="stat-card-value" id="out-val-1k">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Effective APY</span><span class="stat-card-value" id="out-apy">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-table me-2 text-info"></i>FVIF Sensitivity Matrix</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="factor-table">
                        <thead class="table-light"><tr><th>Periods (n)</th><th>3% Rate</th><th>6% Rate</th><th>9% Rate</th><th>12% Rate</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Factor Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const rateEl=$('rate'), periodsEl=$('periods'), compoundingEl=$('compounding');

    function calculate(){
        const r = parseFloat(rateEl.value)/100;
        const n = parseFloat(periodsEl.value);
        const m = parseInt(compoundingEl.value);

        if(isNaN(r) || isNaN(n) || isNaN(m) || n <= 0) return;

        const fvif = Math.pow(1 + (r/m), n * m);
        const apy = Math.pow(1 + (r/m), m) - 1;

        $('out-fvif').textContent = fvif.toFixed(6);
        $('out-growth-pct').textContent = ((fvif - 1) * 100).toFixed(2) + '%';
        $('out-val-1k').textContent = '$' + (fvif * 1000).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
        $('out-apy').textContent = (apy * 100).toFixed(2) + '%';

        // Table Matrix
        const pRange = [1, 5, 10, 15, 20, 30];
        const rRange = [0.03, 0.06, 0.09, 0.12];
        let tableHtml = '';
        pRange.forEach(p => {
            tableHtml += `<tr><td>${p}</td>`;
            rRange.forEach(rv => {
                const f = Math.pow(1 + (rv/m), p * m);
                tableHtml += `<td class="${rv === 0.06 ? 'fw-bold text-info' : ''}">${f.toFixed(4)}</td>`;
            });
            tableHtml += `</tr>`;
        });
        $('factor-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        rateEl.value=5; periodsEl.value=10; compoundingEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `FVIF Factor Report\nFactor: ${$('out-fvif').textContent}\nGrowth: ${$('out-growth-pct').textContent}\nAPY: ${$('out-apy').textContent}\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.fvif-factor-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.fvif-factor-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.fvif-factor-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.fvif-factor-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.fvif-factor-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.fvif-factor-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.fvif-factor-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.fvif-factor-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.fvif-factor-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.fvif-factor-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .fvif-factor-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .fvif-factor-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
