<div class="row g-4 imm-ann-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Premium Amount (Lump Sum)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="premium" class="form-control form-control-lg rounded-3 border-start-0" value="100000" step="5000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Estimated Payout Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rate" class="form-control form-control-lg rounded-3" value="5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Payout Period (Years)</label>
                        <input type="number" id="years" class="form-control form-control-lg rounded-3" value="20" step="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Income Frequency</label>
                        <select id="freq" class="form-select form-select-lg rounded-3">
                            <option value="12" selected>Monthly</option>
                            <option value="4">Quarterly</option>
                            <option value="1">Annually</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-indigo btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#4f46e5;border-color:#4f46e5"><i class="fas fa-calculator me-2"></i>Calculate Income</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:243;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label" id="out-label">Monthly Income</span>
                <div class="output-hero-value" id="out-income">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Guaranteed payout based on your premium and chosen term.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Total Payouts</span><span class="stat-card-value" id="out-total">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Principal Return</span><span class="stat-card-value" id="out-principal">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Implied Interest</span><span class="stat-card-value text-indigo" id="out-interest">—</span></div></div>
            </div>

            <div class="mt-4 p-3 bg-white rounded-3 border overflow-x-auto">
                <h6 class="fw-bold mb-3"><i class="fas fa-table me-2 text-indigo"></i>Estimated Income Comparison</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="income-table">
                        <thead class="table-light"><tr><th>Payout Years</th><th>Monthly Income</th><th>Total Return</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Annuity Plan</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const premEl=$('premium'), rateEl=$('rate'), yearsEl=$('years'), freqEl=$('freq');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:0});

    function calculate(){
        const p = parseFloat(premEl.value);
        const r = parseFloat(rateEl.value)/100;
        const t = parseFloat(yearsEl.value);
        const f = parseInt(freqEl.value);

        if(isNaN(p) || isNaN(r) || isNaN(t) || t <= 0 || p <= 0) return;

        const i = r / f;
        const n = t * f;

        const income = p * (i * Math.pow(1 + i, n)) / (Math.pow(1 + i, n) - 1);
        const totalPayout = income * n;

        $('out-label').textContent = freqEl.options[freqEl.selectedIndex].text + ' Income';
        $('out-income').textContent = nf.format(income);
        $('out-total').textContent = nf.format(totalPayout);
        $('out-principal').textContent = nf.format(p);
        $('out-interest').textContent = nf.format(totalPayout - p);

        // Comparison Table
        const terms = [10, 15, 20, 25, 30];
        let tableHtml = '';
        terms.forEach(term => {
            const scN = term * 12;
            const scI = r / 12;
            const scInc = p * (scI * Math.pow(1 + scI, scN)) / (Math.pow(1 + scI, scN) - 1);
            tableHtml += `<tr>
                <td>${term} Years</td>
                <td class="fw-bold">${nf.format(scInc)}</td>
                <td>${nf.format(scInc * scN)}</td>
            </tr>`;
        });
        $('income-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        premEl.value=100000; rateEl.value=5; yearsEl.value=20; freqEl.value=12;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Immediate Annuity Plan\nPremium: ${nf.format(premEl.value)}\n${$('out-label').textContent}: ${$('out-income').textContent}\nTotal Payout: ${$('out-total').textContent}\nTerm: ${yearsEl.value} years\n— ToolsHub Retirement`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.imm-ann-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.imm-ann-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.imm-ann-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.imm-ann-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.imm-ann-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.imm-ann-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.imm-ann-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.imm-ann-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.imm-ann-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.imm-ann-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.imm-ann-rebuilt .text-indigo{color:#4f46e5}

@media (max-width: 768px) {
    .imm-ann-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .imm-ann-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\immediate-annuity-calculator.blade.php ENDPATH**/ ?>