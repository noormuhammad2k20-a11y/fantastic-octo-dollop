<div class="row g-4 capm-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Risk-Free Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="rf" class="form-control form-control-lg rounded-3" value="3.5" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Beta (β)</label>
                        <input type="number" id="beta" class="form-control form-control-lg rounded-3" value="1.2" step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Expected Market Return (%)</label>
                        <div class="input-group">
                            <input type="number" id="rm" class="form-control form-control-lg rounded-3" value="9.0" step="0.01">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Tax Rate (%) - Optional</label>
                        <div class="input-group">
                            <input type="number" id="tax" class="form-control form-control-lg rounded-3" value="21" step="0.1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-rose btn-lg px-4 rounded-pill shadow-sm text-white" id="btn-calculate" style="background:#f43f5e;border-color:#f43f5e"><i class="fas fa-calculator me-2"></i>Calculate Expected Return</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:350;--tool-color:#f43f5e;--tool-bg:rgba(244,63,94,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Cost of Equity (Expected Return)</span>
                <div class="output-hero-value" id="out-re">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Re = Rf + β(Rm - Rf)</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Market Risk Premium</span><span class="stat-card-value text-rose" id="out-mrp">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Risk Premium Adjustment</span><span class="stat-card-value" id="out-adj">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Risk Category</span><span class="stat-card-value" id="out-cat">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-chart-line me-2 text-rose"></i>Return vs. Beta Sensitivity</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="sens-table">
                        <thead class="table-light"><tr><th>Beta (β)</th><th>Expected Return</th><th>Risk Over Market</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy CAPM Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const rfEl=$('rf'), betaEl=$('beta'), rmEl=$('rm');

    function calculate(){
        const rf = parseFloat(rfEl.value)/100;
        const b = parseFloat(betaEl.value);
        const rm = parseFloat(rmEl.value)/100;

        if(isNaN(rf) || isNaN(b) || isNaN(rm)) return;

        const mrp = rm - rf;
        const re = rf + (b * mrp);

        $('out-re').textContent = (re * 100).toFixed(2) + '%';
        $('out-mrp').textContent = (mrp * 100).toFixed(2) + '%';
        $('out-adj').textContent = (b * mrp * 100).toFixed(2) + '%';
        
        let cat = 'Neutral';
        if(b > 1.5) cat = 'High Risk';
        else if(b > 1) cat = 'Aggressive';
        else if(b < 1 && b > 0) cat = 'Defensive';
        else if(b < 0) cat = 'Inverted';
        $('out-cat').textContent = cat;

        // Table
        const bRange = [0.5, 0.8, 1.0, 1.2, 1.5, 2.0];
        let tableHtml = '';
        bRange.forEach(bv => {
            const rev = rf + (bv * mrp);
            const diff = rev - rm;
            tableHtml += `<tr>
                <td>${bv}</td>
                <td class="fw-bold">${(rev * 100).toFixed(2)}%</td>
                <td class="${diff > 0 ? 'text-danger' : 'text-success'}">${(diff * 100).toFixed(2)}% vs Mkt</td>
            </tr>`;
        });
        $('sens-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        rfEl.value=3.5; betaEl.value=1.2; rmEl.value=9.0;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `CAPM Analysis Report\nExpected Return (Re): ${$('out-re').textContent}\nBeta: ${betaEl.value}\nRisk-Free: ${rfEl.value}%\nMarket Return: ${rmEl.value}%\n— ToolsHub Corporate Finance`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.capm-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.capm-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.capm-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.capm-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.capm-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.capm-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.capm-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.capm-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.capm-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.capm-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}
.capm-calc-rebuilt .text-rose{color:#f43f5e}

@media (max-width: 768px) {
    .capm-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .capm-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
