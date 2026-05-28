<div class="row g-4 fvifa-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Periodic Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Payments (n)</label>
                        <input type="number" id="periods" class="form-control form-control-lg rounded-3" value="12" step="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Payment Timing</label>
                        <select id="timing" class="form-select form-select-lg rounded-3">
                            <option value="end">End of Period (Ordinary)</option>
                            <option value="beginning">Beginning (Annuity Due)</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-warning btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate Factor</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:38;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero">
                <span class="output-hero-label">FVIFA Multiplier</span>
                <div class="output-hero-value" id="out-fvifa">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-formula">FVIFA = ((1 + r)^n - 1) / r</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Future Value of $1/mo</span><span class="stat-card-value" id="out-dollar-val">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Growth Multiple</span><span class="stat-card-value text-warning" id="out-multiple">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Annuity Type</span><span class="stat-card-value" id="out-type">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-table me-2 text-warning"></i>Annuity Factor Matrix</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="matrix-table">
                        <thead class="table-light"><tr><th>Payments (n)</th><th>1% Rate</th><th>5% Rate</th><th>10% Rate</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Factor</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const rateEl=$('rate'), periodsEl=$('periods'), timingEl=$('timing');

    function calculate(){
        const r = parseFloat(rateEl.value)/100;
        const n = parseFloat(periodsEl.value);
        const type = timingEl.value;

        if(isNaN(r) || isNaN(n) || n <= 0) return;

        let fvifa;
        if(r === 0){
            fvifa = n;
        } else {
            fvifa = (Math.pow(1 + r, n) - 1) / r;
            if(type === 'beginning'){
                fvifa = fvifa * (1 + r);
            }
        }

        $('out-fvifa').textContent = fvifa.toFixed(6);
        $('out-dollar-val').textContent = '$' + fvifa.toFixed(2);
        $('out-multiple').textContent = (fvifa/n).toFixed(3) + 'x';
        $('out-type').textContent = type === 'end' ? 'Ordinary' : 'Due';
        $('out-formula').textContent = type === 'end' ? 'FVIFA = ((1 + r)^n - 1) / r' : 'FVIFA = [((1 + r)^n - 1) / r] * (1 + r)';

        // Table Matrix
        const pRange = [5, 10, 20, 50, 100];
        let tableHtml = '';
        pRange.forEach(p => {
            const f1 = r === 0 ? p : (Math.pow(1.01, p) - 1) / 0.01;
            const f5 = r === 0 ? p : (Math.pow(1.05, p) - 1) / 0.05;
            const f10 = r === 0 ? p : (Math.pow(1.10, p) - 1) / 0.10;
            tableHtml += `<tr>
                <td>${p}</td>
                <td>${f1.toFixed(4)}</td>
                <td class="fw-bold text-warning">${f5.toFixed(4)}</td>
                <td>${f10.toFixed(4)}</td>
            </tr>`;
        });
        $('matrix-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        rateEl.value=5; periodsEl.value=12; timingEl.value='end';
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `FVIFA Factor Summary\nFactor: ${$('out-fvifa').textContent}\nRate: ${rateEl.value}%\nPayments: ${periodsEl.value}\nType: ${timingEl.options[timingEl.selectedIndex].text}\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.fvifa-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.fvifa-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.fvifa-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.fvifa-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.fvifa-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.fvifa-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.fvifa-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.fvifa-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.fvifa-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.fvifa-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .fvifa-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .fvifa-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\fvifa-calculator.blade.php ENDPATH**/ ?>