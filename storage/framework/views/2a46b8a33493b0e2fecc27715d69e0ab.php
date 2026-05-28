<div class="row g-4 pvifa-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Discount Rate per Period (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Periods (n)</label>
                        <input type="number" id="periods" class="form-control form-control-lg rounded-3" value="10" step="1">
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate Factor</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:217;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">PVIFA Factor</span>
                <div class="output-hero-value" id="out-pvifa">—</div>
                <div class="mt-2 text-muted fw-bold">PVIFA = [1 - (1 + r)^-n] / r</div>
            </div>

            <div class="row g-3 mt-4 text-center">
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded-3 border">
                        <small class="text-muted d-block mb-1">Value of $1,000/yr</small>
                        <span class="h4 fw-bold text-primary" id="out-val-1k">—</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded-3 border">
                        <small class="text-muted d-block mb-1">Value of $5,000/yr</small>
                        <span class="h4 fw-bold text-primary" id="out-val-5k">—</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-th me-2 text-primary"></i>PVIFA Reference Matrix</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="matrix-table">
                        <thead class="table-light"><tr><th>Periods</th><th>1%</th><th>3%</th><th>5%</th><th>8%</th><th>10%</th></tr></thead>
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
    const rateEl=$('rate'), periodsEl=$('periods');

    function calculate(){
        const r = parseFloat(rateEl.value)/100;
        const n = parseFloat(periodsEl.value);

        if(isNaN(r) || isNaN(n) || n < 0) return;

        let pvifa;
        if(r === 0) pvifa = n;
        else pvifa = (1 - Math.pow(1 + r, -n)) / r;

        $('out-pvifa').textContent = pvifa.toFixed(5);
        $('out-val-1k').textContent = '$' + (pvifa * 1000).toLocaleString(undefined, {minimumFractionDigits:2});
        $('out-val-5k').textContent = '$' + (pvifa * 5000).toLocaleString(undefined, {minimumFractionDigits:2});

        // Matrix
        const pRange = [1, 5, 10, 15, 20, 30];
        const rRange = [0.01, 0.03, 0.05, 0.08, 0.10];
        let tableHtml = '';
        pRange.forEach(p => {
            tableHtml += `<tr><td>${p}</td>`;
            rRange.forEach(rv => {
                const f = rv === 0 ? p : (1 - Math.pow(1 + rv, -p)) / rv;
                tableHtml += `<td>${f.toFixed(4)}</td>`;
            });
            tableHtml += `</tr>`;
        });
        $('matrix-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        rateEl.value=5; periodsEl.value=10;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `PVIFA Analysis\nFactor: ${$('out-pvifa').textContent}\nRate: ${rateEl.value}%\nPeriods: ${periodsEl.value}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.pvifa-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.pvifa-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.pvifa-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pvifa-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pvifa-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.pvifa-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

@media (max-width: 768px) {
    .pvifa-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .pvifa-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\pvifa-calculator.blade.php ENDPATH**/ ?>