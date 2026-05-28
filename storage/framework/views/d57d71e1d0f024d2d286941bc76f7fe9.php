<div class="row g-4 martingale-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Bet / Trade Size</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="bet" class="form-control form-control-lg rounded-3 border-start-0" value="10" step="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Bankroll</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">$</span>
                            <input type="number" id="bankroll" class="form-control form-control-lg rounded-3 border-start-0" value="1000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Multiplier on Loss</label>
                        <input type="number" id="multiplier" class="form-control form-control-lg rounded-3" value="2.0" step="0.1">
                        <small class="text-muted mt-1 d-block">Standard Martingale uses 2.0x.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Max Consecutive Losses to Simulate</label>
                        <input type="number" id="rounds" class="form-control form-control-lg rounded-3" value="10" step="1" max="25">
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-danger btn-lg px-4 rounded-pill shadow-sm" id="btn-calculate"><i class="fas fa-calculator me-2"></i>Simulate Sequence</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" id="btn-reset"><i class="fas fa-redo me-2"></i>Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Losses Before Ruin</span>
                <div class="output-hero-value" id="out-ruin-rounds">—</div>
                <div class="mt-2 text-muted fw-bold" id="out-summary">Consecutive losses required to completely drain your bankroll.</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Potential Profit (Win)</span><span class="stat-card-value text-success" id="out-profit">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Max Bet Size Needed</span><span class="stat-card-value text-danger" id="out-max-bet">—</span></div></div>
                <div class="col-md-4"><div class="stat-card"><span class="stat-card-label">Bankroll Required (For Max Rounds)</span><span class="stat-card-value" id="out-req-bankroll">—</span></div></div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-4 border overflow-x-auto shadow-sm">
                <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="fas fa-list-ol me-2 text-danger"></i>Losing Streak Progression</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center mb-0" id="prog-table">
                        <thead class="table-light"><tr><th>Round (Loss #)</th><th>Current Bet Size</th><th>Cumulative Loss</th><th>Bankroll Remaining</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Simulation</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const betEl=$('bet'), bankrollEl=$('bankroll'), multEl=$('multiplier'), roundsEl=$('rounds');
    const nf = new Intl.NumberFormat('en-US', {style:'currency', currency:'USD', maximumFractionDigits:2});

    function calculate(){
        const initBet = parseFloat(betEl.value);
        const br = parseFloat(bankrollEl.value);
        const m = parseFloat(multEl.value);
        const maxR = parseInt(roundsEl.value);

        if(isNaN(initBet) || isNaN(br) || isNaN(m) || isNaN(maxR) || initBet <= 0) return;

        let ruinRound = 0;
        let cumulativeLoss = 0;
        let currentBet = initBet;
        
        let tableHtml = '';

        for(let i=1; i<=maxR; i++){
            cumulativeLoss += currentBet;
            const remaining = br - cumulativeLoss;
            
            if(remaining < 0 && ruinRound === 0){
                ruinRound = i;
            }

            tableHtml += `<tr class="${remaining < 0 ? 'table-danger text-danger' : ''}">
                <td>${i}</td>
                <td>${nf.format(currentBet)}</td>
                <td>${nf.format(cumulativeLoss)}</td>
                <td class="fw-bold">${remaining < 0 ? 'BROKE' : nf.format(remaining)}</td>
            </tr>`;

            currentBet *= m;
        }

        $('out-ruin-rounds').textContent = ruinRound === 0 ? '> ' + maxR : ruinRound;
        $('out-profit').textContent = nf.format(initBet); // A win always nets the initial bet size in pure martingale
        
        // Max bet and required bankroll for the given max rounds
        const maxBetAtRounds = initBet * Math.pow(m, maxR - 1);
        let reqBankroll = 0;
        let tempBet = initBet;
        for(let j=0; j<maxR; j++){
            reqBankroll += tempBet;
            tempBet *= m;
        }

        $('out-max-bet').textContent = nf.format(maxBetAtRounds);
        $('out-req-bankroll').textContent = nf.format(reqBankroll);
        
        $('prog-table').querySelector('tbody').innerHTML = tableHtml;
    }

    $('btn-calculate').addEventListener('click', calculate);
    $('btn-reset').addEventListener('click', ()=>{
        betEl.value=10; bankrollEl.value=1000; multEl.value=2.0; roundsEl.value=10;
        calculate();
    });

    $('btn-copy').addEventListener('click', function(){
        const text = `Martingale Simulation\nRuin at Loss #: ${$('out-ruin-rounds').textContent}\nBankroll Needed for ${roundsEl.value} losses: ${$('out-req-bankroll').textContent}\nInitial Bet: $${betEl.value}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.martingale-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.04)}
.martingale-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.martingale-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.martingale-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.martingale-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.martingale-calc-rebuilt .form-label-custom{font-size:.85rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.martingale-calc-rebuilt .stat-card{background:#fff;padding:1rem;border-radius:12px;border:1px solid #f1f5f9;text-align:center;transition:all .2s}
.martingale-calc-rebuilt .stat-card:hover{transform:translateY(-2px);box-shadow:0 4px 6px -1px rgba(0,0,0,.05);border-color:#e2e8f0}
.martingale-calc-rebuilt .stat-card-label{display:block;font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:.25rem}
.martingale-calc-rebuilt .stat-card-value{font-size:1.1rem;font-weight:800;color:#1e293b}

@media (max-width: 768px) {
    .martingale-calc-rebuilt .responsive-heading { font-size: 1.25rem; font-weight: 700; }
    .martingale-calc-rebuilt .calculator-card { padding: 1.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\martingale-strategy-calculator.blade.php ENDPATH**/ ?>