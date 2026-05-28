<div class="row g-4 risk-ruin-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Win Probability (%)</label>
                        <div class="input-group">
                            <input type="number" id="win-prob" class="form-control form-control-lg rounded-3" value="55" step="0.1">
                            <span class="input-group-text bg-transparent border-start-0 text-muted">%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Bankroll / Capital</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="bankroll" class="form-control form-control-lg rounded-3 border-start-0" value="10000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Risk Per Trade / Bet</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="bet" class="form-control form-control-lg rounded-3 border-start-0" value="200" step="10">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Payoff Ratio (Win:Loss)</label>
                        <select id="payoff" class="form-select form-select-lg rounded-3">
                            <option value="1" selected>1:1 (Even Money)</option>
                        </select>
                        <small class="text-muted mt-1 d-block">Note: Calculation assumes even money payout for simplified ruin probability.</small>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-danger btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Calculate Risk of Ruin</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Probability of Total Ruin</span>
                <div class="output-hero-value" id="out-ror">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">The chance you will hit zero before doubling your bankroll.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Trading Units</span><span class="stat-card-value" id="out-units">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Risk % of Bankroll</span><span class="stat-card-value text-danger" id="out-risk-pct">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Theoretical Edge</span><span class="stat-card-value" id="out-edge">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-shield-alt me-2 text-danger"></i>Risk Reduction Scenarios</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="sens-table">
                        <thead class="table-light"><tr><th>Bet Size</th><th>Units (Bankroll/Bet)</th><th>Risk of Ruin</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Risk Report</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const winEl=$('win-prob'), bankrollEl=$('bankroll'), betEl=$('bet');

    function calculate(){
        const p = parseFloat(winEl.value)/100;
        const b = parseFloat(bankrollEl.value);
        const s = parseFloat(betEl.value);

        if(isNaN(p) || isNaN(b) || isNaN(s) || s <= 0 || b <= 0) return;

        const q = 1 - p;
        const units = b / s;
        const riskPct = (s / b) * 100;
        const edge = p - q;

        let ror;
        if(p <= 0.5){
            ror = 1; // 100% chance of ruin if edge is negative or zero
        } else {
            ror = Math.pow(q / p, units);
        }

        $('out-ror').textContent = (ror * 100).toFixed(4) + '%';
        if(ror >= 0.9999) $('out-ror').textContent = '99.99%+';
        if(ror <= 0.000001) $('out-ror').textContent = '< 0.0001%';

        $('out-units').textContent = units.toFixed(1);
        $('out-risk-pct').textContent = riskPct.toFixed(2) + '%';
        $('out-edge').textContent = (edge > 0 ? '+' : '') + (edge * 100).toFixed(1) + '%';

        // Scenarios
        const fractions = [0.01, 0.02, 0.05, 0.10, 0.20];
        let tableHtml = '';
        fractions.forEach(f => {
            const scBet = b * f;
            const scUnits = b / scBet;
            let scRor = p <= 0.5 ? 1 : Math.pow(q/p, scUnits);
            let rorDisplay = (scRor * 100).toFixed(4) + '%';
            if(scRor >= 0.9999) rorDisplay = '99.99%+';
            if(scRor <= 0.000001) rorDisplay = '< 0.0001%';

            tableHtml += `<tr>
                <td>$${scBet.toFixed(0)} (${(f*100).toFixed(0)}%)</td>
                <td>${scUnits.toFixed(0)}</td>
                <td class="fw-bold ${scRor > 0.1 ? 'text-danger' : 'text-success'}">${rorDisplay}</td>
            </tr>`;
        });
        $('sens-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        winEl.value=55; bankrollEl.value=10000; betEl.value=200;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Risk of Ruin Analysis\nProbability of Ruin: ${$('out-ror').textContent}\nWin Prob: ${winEl.value}%\nBankroll: $${bankrollEl.value}\nRisk/Bet: $${betEl.value}\n— ToolsHub Trading`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.risk-ruin-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.risk-ruin-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.risk-ruin-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.risk-ruin-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.risk-ruin-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.risk-ruin-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.risk-ruin-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.risk-ruin-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.risk-ruin-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.risk-ruin-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .risk-ruin-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .risk-ruin-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
