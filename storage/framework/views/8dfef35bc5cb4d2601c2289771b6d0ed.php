<div class="row g-4 daily-comp-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Principal</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="principal" class="form-control form-control-lg rounded-3 border-start-0" value="1000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Daily Addition (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="addition" class="form-control form-control-lg rounded-3 border-start-0" value="10" step="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="5" step="0.1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Duration (Days)</label>
                        <input type="number" id="days" class="form-control form-control-lg rounded-3" value="365" step="1">
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-success btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate Daily</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:158;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Final Balance</span>
                <div class="output-hero-value" id="out-total">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Principal + Contributions + Daily Interest.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Contributions</span><span class="stat-card-value" id="out-contrib">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Interest Earned</span><span class="stat-card-value text-success" id="out-interest">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Effective APY</span><span class="stat-card-value" id="out-apy">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-chart-line me-2 text-success"></i>Daily Accumulation Preview</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle text-center mb-0" id="daily-table">
                        <thead class="bg-light">
                            <tr class="small fw-bold text-muted">
                                <th class="py-3">Day</th>
                                <th class="py-3">Start Balance</th>
                                <th class="py-3">Interest (Day)</th>
                                <th class="py-3">Addition</th>
                                <th class="py-3">End Balance</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="text-center mt-3"><small class="text-muted">Showing first 5 and last 5 days of period.</small></div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Summary</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const prinEl=$('principal'), addEl=$('addition'), rateEl=$('rate'), daysEl=$('days');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD'});

    function calculate(){
        const p = parseFloat(prinEl.value);
        const a = parseFloat(addEl.value) || 0;
        const r = parseFloat(rateEl.value)/100;
        const d = parseInt(daysEl.value);

        if(isNaN(p) || isNaN(r) || isNaN(d) || d <= 0) return;

        const dailyRate = r / 365;
        let balance = p;
        let totalInterest = 0;
        let totalContrib = p;

        const records = [];

        for(let i=1; i<=d; i++){
            const startBal = balance;
            const interest = balance * dailyRate;
            balance += interest + a;
            totalInterest += interest;
            totalContrib += a;

            if(i <= 5 || i > d - 5){
                records.push({
                    day: i,
                    start: startBal,
                    int: interest,
                    add: a,
                    end: balance
                });
            } else if(i === 6 && d > 10) {
                records.push(null); // separator
            }
        }

        const apy = (Math.pow(1 + dailyRate, 365) - 1);

        $('out-total').textContent = nf.format(balance);
        $('out-contrib').textContent = nf.format(totalContrib);
        $('out-interest').textContent = nf.format(totalInterest);
        $('out-apy').textContent = (apy * 100).toFixed(2) + '%';

        let tableHtml = '';
        records.forEach(rec => {
            if(rec === null){
                tableHtml += `<tr><td colspan="5" class="text-muted py-2">...</td></tr>`;
            } else {
                tableHtml += `<tr>
                    <td class="py-2">${rec.day}</td>
                    <td class="py-2">${nf.format(rec.start)}</td>
                    <td class="py-2 text-success">+${nf.format(rec.int)}</td>
                    <td class="py-2">+${nf.format(rec.add)}</td>
                    <td class="py-2 fw-bold">${nf.format(rec.end)}</td>
                </tr>`;
            }
        });
        $('daily-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        prinEl.value=1000; addEl.value=10; rateEl.value=5; daysEl.value=365;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Daily Compound Interest\nFinal Balance: ${$('out-total').textContent}\nTotal Contributions: ${$('out-contrib').textContent}\nInterest Earned: ${$('out-interest').textContent}\nPeriod: ${daysEl.value} days\n— ToolsHub Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.daily-comp-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.daily-comp-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.daily-comp-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.daily-comp-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.daily-comp-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.daily-comp-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.daily-comp-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.daily-comp-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.daily-comp-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.daily-comp-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .daily-comp-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .daily-comp-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\compound-daily-interest-calculator.blade.php ENDPATH**/ ?>