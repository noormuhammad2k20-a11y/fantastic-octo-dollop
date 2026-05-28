<div class="row g-4 fv-growing-annuity-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">First Payment Amount</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="payment" class="form-control form-control-lg rounded-3 border-start-0" value="1000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="7" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Growth Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="growth" class="form-control form-control-lg rounded-3" value="3" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Duration (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="10" step="1">
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate" style="background:#8b5cf6;border-color:#8b5cf6"><i class="fas fa-calculator me-2"></i>Calculate FV</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:258;--tool-color:#8b5cf6;--tool-bg:rgba(139,92,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Projected Future Value</span>
                <div class="output-hero-value" id="out-fv">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Final balance after compound growth and increasing payments.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Contributions</span><span class="stat-card-value" id="out-contrib">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Interest</span><span class="stat-card-value text-purple" id="out-interest">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Final Payment</span><span class="stat-card-value" id="out-final-pay">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-history me-2 text-purple"></i>Annual Payment & Growth Schedule</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="schedule-table">
                        <thead class="table-light"><tr><th>Year</th><th>Payment</th><th>Interest Earned</th><th>Balance</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Schedule</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const payEl=$('payment'), rateEl=$('rate'), growthEl=$('growth'), yearsEl=$('years');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:0});

    function calculate(){
        const p = parseFloat(payEl.value);
        const r = parseFloat(rateEl.value)/100;
        const g = parseFloat(growthEl.value)/100;
        const n = parseFloat(yearsEl.value);

        if(isNaN(p) || isNaN(r) || isNaN(g) || isNaN(n) || n <= 0) return;

        let fv;
        if(r === g){
            fv = p * n * Math.pow(1 + r, n - 1);
        } else {
            fv = p * (Math.pow(1 + r, n) - Math.pow(1 + g, n)) / (r - g);
        }

        let currentBalance = 0;
        let totalContrib = 0;
        let tableHtml = '';
        
        for(let i=1; i<=Math.min(n, 25); i++){
            const currentPay = p * Math.pow(1 + g, i - 1);
            const interest = currentBalance * r;
            currentBalance += currentPay + interest;
            totalContrib += currentPay;

            tableHtml += `<tr>
                <td>${i}</td>
                <td>${nf.format(currentPay)}</td>
                <td class="text-success">${nf.format(interest)}</td>
                <td class="fw-bold text-purple">${nf.format(currentBalance)}</td>
            </tr>`;
        }

        $('out-fv').textContent = nf.format(currentBalance); // Use calculated loop for accuracy if n is small
        if(n > 25) {
             // For long terms, the mathematical formula is better but we still want the table for preview
             $('out-fv').textContent = nf.format(fv);
        }
        
        $('out-contrib').textContent = nf.format(totalContrib);
        $('out-interest').textContent = nf.format(fv - totalContrib);
        $('out-final-pay').textContent = nf.format(p * Math.pow(1 + g, n - 1));
        $('schedule-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        payEl.value=1000; rateEl.value=7; growthEl.value=3; yearsEl.value=10;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Growing Annuity Projection\nStart Payment: ${nf.format(payEl.value)}\nGrowth: ${growthEl.value}%\nFuture Value: ${$('out-fv').textContent}\nContributions: ${$('out-contrib').textContent}\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.fv-growing-annuity-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.fv-growing-annuity-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.fv-growing-annuity-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.fv-growing-annuity-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.fv-growing-annuity-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.fv-growing-annuity-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.fv-growing-annuity-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.fv-growing-annuity-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.fv-growing-annuity-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.fv-growing-annuity-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.fv-growing-annuity-rebuilt .text-purple{color:#8b5cf6}

@media (max-width: 768px) {
    .fv-growing-annuity-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .fv-growing-annuity-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
