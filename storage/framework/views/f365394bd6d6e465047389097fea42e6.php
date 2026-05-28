<div class="row g-4 fva-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Periodic Payment (P)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="payment" class="form-control form-control-lg rounded-3 border-start-0" value="500" step="50">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="6" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Number of Years</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="10" step="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Payment Frequency</label>
                        <select id="freq" class="form-select form-select-lg rounded-3">
                            <option value="1">Annually</option>
                            <option value="2">Semi-Annually</option>
                            <option value="4">Quarterly</option>
                            <option value="12" selected>Monthly</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Compounding Frequency</label>
                        <select id="comp" class="form-select form-select-lg rounded-3">
                            <option value="1">Annually</option>
                            <option value="12" selected>Monthly</option>
                            <option value="365">Daily</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-success btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate FV</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:158;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Future Value of Ordinary Annuity</span>
                <div class="output-hero-value" id="out-fva">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Projected balance including all payments and compounded interest.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Contributions</span><span class="stat-card-value" id="out-contrib">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Interest</span><span class="stat-card-value text-success" id="out-interest">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">FVIFA Factor</span><span class="stat-card-value" id="out-factor">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-line me-2 text-success"></i>Accumulation Schedule</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="accumulation-table">
                        <thead class="table-light"><tr><th>Year</th><th>Total Payments</th><th>Interest Earned</th><th>End Balance</th></tr></thead>
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
    const payEl=$('payment'), rateEl=$('rate'), yearsEl=$('years'), freqEl=$('freq'), compEl=$('comp');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:0});

    function calculate(){
        const p = parseFloat(payEl.value);
        const r = parseFloat(rateEl.value)/100;
        const t = parseFloat(yearsEl.value);
        const f = parseInt(freqEl.value);
        const m = parseInt(compEl.value);

        if(isNaN(p) || isNaN(r) || isNaN(t) || t <= 0) return;

        // Effective rate per payment period
        // (1 + r/m)^(m/f) - 1
        const i = Math.pow(1 + (r / m), m / f) - 1;
        const n = t * f;

        const fva = p * ((Math.pow(1 + i, n) - 1) / i);
        const totalContrib = p * n;
        const totalInterest = fva - totalContrib;
        const factor = fva / p;

        $('out-fva').textContent = nf.format(fva);
        $('out-contrib').textContent = nf.format(totalContrib);
        $('out-interest').textContent = nf.format(totalInterest);
        $('out-factor').textContent = factor.toFixed(4);

        let tableHtml = '';
        let currentBalance = 0;
        let cumulativeContrib = 0;
        
        for(let yr=1; yr<=Math.min(t, 25); yr++){
            const yrPayments = p * f;
            cumulativeContrib += yrPayments;
            
            // Loop through payments in the year to be precise
            for(let py=1; py<=f; py++){
                const interest = currentBalance * i;
                currentBalance += interest + p;
            }
            
            tableHtml += `<tr>
                <td>Year ${yr}</td>
                <td>${nf.format(cumulativeContrib)}</td>
                <td class="text-success">${nf.format(currentBalance - cumulativeContrib)}</td>
                <td class="fw-bold">${nf.format(currentBalance)}</td>
            </tr>`;
        }
        $('accumulation-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        payEl.value=500; rateEl.value=6; yearsEl.value=10; freqEl.value=12; compEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `FVA Projection Report\nFuture Value: ${$('out-fva').textContent}\nContributions: ${$('out-contrib').textContent}\nInterest: ${$('out-interest').textContent}\nRate: ${rateEl.value}% over ${yearsEl.value} years\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.fva-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.fva-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.fva-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.fva-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.fva-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.fva-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.fva-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.fva-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.fva-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.fva-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .fva-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .fva-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\future-value-of-annuity-calculator.blade.php ENDPATH**/ ?>