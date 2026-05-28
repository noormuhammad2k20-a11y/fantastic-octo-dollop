<div class="row g-4 pv-lump-sum-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Future Value (FV)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="fv" class="form-control form-control-lg rounded-3 border-start-0" value="10000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Interest Rate (Annual %)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="7" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Investment Period (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="5" step="1">
                    </div>
                    <div class="col-md-6">
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
                    <button type="button" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate PV</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:158;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Present Value (PV)</span>
                <div class="output-hero-value" id="out-pv">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-savings">You would need to invest this today to reach your goal.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Interest</span><span class="stat-card-value text-success" id="out-interest">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">PVIF Factor</span><span class="stat-card-value" id="out-factor">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Effective APR</span><span class="stat-card-value" id="out-eff-apr">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Time Horizon Analysis</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="time-table">
                        <thead class="table-light"><tr><th>Year</th><th>Present Value</th><th>Interest Earned</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Summary</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const fvEl=$('fv'), rateEl=$('rate'), yearsEl=$('years'), compoundingEl=$('compounding');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD'});

    function calculate(){
        const fv = parseFloat(fvEl.value);
        const r = parseFloat(rateEl.value)/100;
        const n = parseFloat(yearsEl.value);
        const m = parseInt(compoundingEl.value);

        if(isNaN(fv) || isNaN(r) || isNaN(n) || isNaN(m) || n <= 0) return;

        const totalPeriods = n * m;
        const periodicRate = r / m;
        const factor = 1 / Math.pow(1 + periodicRate, totalPeriods);
        const pv = fv * factor;
        const interest = fv - pv;
        const effApr = Math.pow(1 + periodicRate, m) - 1;

        $('out-pv').textContent = nf.format(pv);
        $('out-interest').textContent = nf.format(interest);
        $('out-factor').textContent = factor.toFixed(6);
        $('out-eff-apr').textContent = (effApr * 100).toFixed(2) + '%';

        // Table
        let tableHtml = '';
        for(let i=1; i<=Math.min(n, 20); i++){
            const yFactor = 1 / Math.pow(1 + periodicRate, i * m);
            const yPv = fv * yFactor;
            tableHtml += `<tr>
                <td>Year ${i}</td>
                <td class="fw-bold">${nf.format(yPv)}</td>
                <td class="text-success">${nf.format(fv - yPv)}</td>
            </tr>`;
        }
        $('time-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        fvEl.value=10000; rateEl.value=7; yearsEl.value=5; compoundingEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `PV Lump Sum Summary\nFuture Value: ${nf.format(fvEl.value)}\nRequired Today (PV): ${$('out-pv').textContent}\nTotal Interest: ${$('out-interest').textContent}\nRate: ${rateEl.value}% over ${yearsEl.value} years\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pv-lump-sum-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pv-lump-sum-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pv-lump-sum-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pv-lump-sum-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pv-lump-sum-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pv-lump-sum-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.pv-lump-sum-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.pv-lump-sum-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.pv-lump-sum-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.pv-lump-sum-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .pv-lump-sum-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pv-lump-sum-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
