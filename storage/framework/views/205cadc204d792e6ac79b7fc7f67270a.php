<div class="row g-4 pv-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Future Amount (FV)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="fv" class="form-control form-control-lg rounded-3 border-start-0" value="50000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Discount Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="6" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Time Horizon (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="10" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Compounding Method</label>
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

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:243;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Calculated Present Value</span>
                <div class="output-hero-value" id="out-pv">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">This is the value of your future sum in today's dollars.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Buying Power Loss</span><span class="stat-card-value text-danger" id="out-loss">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Discount Factor</span><span class="stat-card-value" id="out-factor">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Inflation</span><span class="stat-card-value" id="out-total-infl">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-chart-line me-2 text-indigo"></i>Year-by-Year Value Erosion</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle text-center mb-0" id="erosion-table">
                        <thead class="bg-light rounded-3">
                            <tr class="text-uppercase small fw-bold text-muted">
                                <th class="py-3">Year</th>
                                <th class="py-3">Nominal Value</th>
                                <th class="py-3">Real Value (Today $)</th>
                                <th class="py-3">Value Retained</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y"></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Analysis</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const fvEl=$('fv'), rateEl=$('rate'), yearsEl=$('years'), compoundingEl=$('compounding');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:0});

    function calculate(){
        const fv = parseFloat(fvEl.value);
        const r = parseFloat(rateEl.value)/100;
        const n = parseFloat(yearsEl.value);
        const m = parseInt(compoundingEl.value);

        if(isNaN(fv) || isNaN(r) || isNaN(n) || isNaN(m) || n <= 0) return;

        const periodicRate = r / m;
        const factor = 1 / Math.pow(1 + periodicRate, n * m);
        const pv = fv * factor;
        const loss = fv - pv;
        const totalInfl = (fv/pv - 1) * 100;

        $('out-pv').textContent = nf.format(pv);
        $('out-loss').textContent = nf.format(loss);
        $('out-factor').textContent = factor.toFixed(6);
        $('out-total-infl').textContent = totalInfl.toFixed(2) + '%';

        let tableHtml = '';
        for(let i=1; i<=Math.min(n, 20); i++){
            const yFactor = 1 / Math.pow(1 + periodicRate, i * m);
            const yPv = fv * yFactor;
            const retained = (yPv / fv) * 100;
            tableHtml += `<tr>
                <td class="py-3 fw-bold">${i}</td>
                <td class="py-3 text-muted">${nf.format(fv)}</td>
                <td class="py-3 fw-bold text-indigo">${nf.format(yPv)}</td>
                <td class="py-3">
                    <div class="progress" style="height:6px; width:60px; margin:0 auto;">
                        <div class="progress-bar bg-indigo" style="width:${retained}%"></div>
                    </div>
                    <small class="text-muted mt-1 d-block">${retained.toFixed(1)}%</small>
                </td>
            </tr>`;
        }
        $('erosion-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        fvEl.value=50000; rateEl.value=6; yearsEl.value=10; compoundingEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `PV Analysis Summary\nFuture Amount: ${nf.format(fvEl.value)}\nValue Today: ${$('out-pv').textContent}\nBuying Power Lost: ${$('out-loss').textContent}\nPeriod: ${yearsEl.value} years\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pv-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 20px 25px -5px rgba(0,0,0,.04)}
.pv-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.pv-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b; letter-spacing:-0.5px}
.pv-calc-rebuilt .calculator-header p{margin:0;font-size:.95rem;color:#64748b}
.pv-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:20px;display:flex;align-items:center;justify-content:center;font-size:1.75rem;flex-shrink:0}
.pv-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.75px;margin-bottom:.6rem;display:block}
.pv-calc-rebuilt .stat-card{background:#fff;padding:1.25rem;border-radius:16px;border:1px solid #f1f5f9;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1)}
.pv-calc-rebuilt .stat-card:hover{transform:translateY(-4px);box-shadow:0 12px 20px -5px rgba(0,0,0,.08);border-color:#e2e8f0}
.pv-calc-rebuilt .stat-card-label{display:block;font-size:.75rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.5rem}
.pv-calc-rebuilt .stat-card-value{font-size:1.25rem;font-weight:800;color:#1e293b}
.pv-calc-rebuilt .text-indigo { color: #4f46e5 !important; }
.pv-calc-rebuilt .bg-indigo { background-color: #4f46e5 !important; }

@media (max-width: 768px) {
    .pv-calc-rebuilt .responsive-heading { font-size: 1.4rem; }
    .pv-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .pv-calc-rebuilt .stat-card-value { font-size: 1.1rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\present-value-calculator.blade.php ENDPATH**/ ?>