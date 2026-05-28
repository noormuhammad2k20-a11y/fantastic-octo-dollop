<div class="row g-4 pvif-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Periods (n)</label>
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
                    <button type="button" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:243;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Present Value Interest Factor (PVIF)</span>
                <div class="output-hero-value" id="out-pvif">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-formula">PVIF = 1 / (1 + r/m)^(n*m)</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Periodic Rate</span><span class="stat-card-value" id="out-periodic-rate">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Periods</span><span class="stat-card-value" id="out-total-periods">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Effective Rate</span><span class="stat-card-value" id="out-effective-rate">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold m-0"><i class="fas fa-table me-2 text-primary"></i>Factor Sensitivity Table</h6>
                    <span class="badge bg-soft-primary text-primary">+/- 2% Rate Variance</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="factor-table">
                        <thead class="table-light"><tr><th>Rate Variant</th><th>PVIF Factor</th><th>Difference</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Results</button>
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

        const totalPeriods = n * m;
        const periodicRate = r / m;
        const pvif = 1 / Math.pow(1 + periodicRate, totalPeriods);
        const effectiveRate = Math.pow(1 + periodicRate, m) - 1;

        $('out-pvif').textContent = pvif.toFixed(6);
        $('out-periodic-rate').textContent = (periodicRate * 100).toFixed(4) + '%';
        $('out-total-periods').textContent = totalPeriods;
        $('out-effective-rate').textContent = (effectiveRate * 100).toFixed(2) + '%';

        // Table
        const variants = [-2, -1, 0, 1, 2];
        let tableHtml = '';
        variants.forEach(v => {
            const vr = r + (v/100);
            if(vr < 0) return;
            const vFactor = 1 / Math.pow(1 + (vr/m), totalPeriods);
            const diff = (vFactor - pvif).toFixed(6);
            const diffClass = diff > 0 ? 'text-success' : diff < 0 ? 'text-danger' : 'text-muted';
            tableHtml += `<tr>
                <td>${(vr*100).toFixed(2)}%</td>
                <td class="fw-bold">${vFactor.toFixed(6)}</td>
                <td class="${diffClass}">${diff > 0 ? '+' : ''}${diff}</td>
            </tr>`;
        });
        $('factor-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        rateEl.value=5; periodsEl.value=10; compoundingEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `PVIF Calculation\nFactor: ${$('out-pvif').textContent}\nRate: ${rateEl.value}%\nPeriods: ${periodsEl.value}\nCompounding: ${compoundingEl.options[compoundingEl.selectedIndex].text}\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pvif-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pvif-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pvif-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pvif-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pvif-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pvif-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.pvif-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.pvif-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.pvif-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.pvif-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.pvif-calc-rebuilt .bg-soft-primary{background:rgba(99,102,241,.1)}

@media (max-width: 768px) {
    .pvif-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pvif-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
