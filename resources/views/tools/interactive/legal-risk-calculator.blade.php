<div class="interactive-tool-grid legal-risk-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Current Settlement Offer on Table ($)</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-handshake text-muted"></i></span>
                    <input type="number" id="offer" class="form-control-custom border-start-0 ps-0" value="50000" min="0">
                </div>
            </div>
            
            <div class="alert bg-light border p-2 mb-3 mt-3">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Scenario Quick Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-slamdunk" style="min-width: 280px; max-width: 100%;">Slam Dunk (90%)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-cointoss" style="min-width: 280px; max-width: 100%;">Coin Toss (50%)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-uphill" style="min-width: 280px; max-width: 100%;">Uphill Battle (20%)</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-highcost" style="min-width: 280px; max-width: 100%;">High Defense Cost</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-maxpayout" style="min-width: 280px; max-width: 100%;">Max Payout Pot</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-lowball" style="min-width: 280px; max-width: 100%;">Lowball Offer</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Probability of Winning at Trial (%)</label>
                    <input type="number" id="prob-win" class="form-control-custom" value="60" min="0" max="100">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">If Won, Expected Jury Award ($)</label>
                    <input type="number" id="award" class="form-control-custom" value="120000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Probability of Losing purely (%)</label>
                    <input type="number" id="prob-lose" class="form-control-custom text-danger fw-bold" value="40" readonly>
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">If Lost, Counter-Liability/Costs ($)</label>
                    <input type="number" id="lose-cost" class="form-control-custom" value="0" min="0">
                </div>
                <div class="col-12 form-group-custom mb-2 mt-2 border-top pt-2">
                    <label class="form-label-custom">Future Trial Prep / Attorney Hard Costs ($)</label>
                    <input type="number" id="hard-costs" class="form-control-custom" value="15000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #ef4444;">
            <span class="result-label">Expected Value of Trial (EV)</span>
            <h1 class="result-main-value" id="ev" style="color: #b91c1c;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Gross Settlement Offer</td><td class="text-end fw-semibold text-secondary" id="tar-offer">$0</td></tr>
                    <tr><td>Net Gain/Loss of Refusing Offer</td><td class="text-end fw-bold fs-5" id="net-diff">$0</td></tr>
                </table>
            </div>
            
            <div class="alert mt-3 text-center border-0 p-2 rounded text-white" id="decision-msg" style="font-size:0.95rem; font-weight:bold;"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const offer = parseFloat(document.getElementById('offer').value) || 0;
        let winP = Math.min(100, Math.max(0, parseFloat(document.getElementById('prob-win').value) || 0));
        document.getElementById('prob-win').value = winP;
        
        let loseP = 100 - winP;
        document.getElementById('prob-lose').value = loseP;
        
        const award = parseFloat(document.getElementById('award').value) || 0;
        const loseCost = parseFloat(document.getElementById('lose-cost').value) || 0;
        const hardCosts = parseFloat(document.getElementById('hard-costs').value) || 0;
        
        // Expected Value = (Prob Win * Award) + (Prob Lose * -LoseCost) - HardCosts
        const evWin = (winP / 100) * award;
        const evLose = (loseP / 100) * (-loseCost);
        
        const totalEV = evWin + evLose - hardCosts;
        
        const netDiff = totalEV - offer;
        
        try {
            document.getElementById('ev').innerText = (totalEV < 0 ? '-' : '') + format(Math.abs(totalEV));
            document.getElementById('ev').style.color = totalEV < 0 ? "#ef4444" : "#b91c1c";
            
            document.getElementById('tar-offer').innerText = format(offer);
            
            document.getElementById('net-diff').innerText = (netDiff >= 0 ? '+' : '-') + format(Math.abs(netDiff));
            document.getElementById('net-diff').style.color = netDiff >= 0 ? '#10b981' : '#ef4444';
            
            const msgObj = document.getElementById('decision-msg');
            if(netDiff > 0) {
                msgObj.innerText = "Reject Offer Idea: Mathematically, taking this to trial is expected to yield more than the settlement offer.";
                msgObj.className = "alert bg-success mt-3 text-center border-0 p-2 rounded text-white";
            } else {
                msgObj.innerText = "Accept Offer Idea: The settlement guarantees more value than the massive risk vectors and costs of trial.";
                msgObj.className = "alert bg-primary mt-3 text-center border-0 p-2 rounded text-white";
            }
        } catch(e) {}
    }
    
    ['offer','prob-win','award','lose-cost','hard-costs'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-slamdunk').addEventListener('click', () => { document.getElementById('prob-win').value = 90; calc(); });
    document.getElementById('qa-cointoss').addEventListener('click', () => { document.getElementById('prob-win').value = 50; calc(); });
    document.getElementById('qa-uphill').addEventListener('click', () => { document.getElementById('prob-win').value = 20; calc(); });
    
    document.getElementById('qa-highcost').addEventListener('click', () => { 
        document.getElementById('hard-costs').value = (parseFloat(document.getElementById('hard-costs').value)||0) + 25000; calc(); 
    });
    
    document.getElementById('qa-maxpayout').addEventListener('click', () => { 
        document.getElementById('award').value = (parseFloat(document.getElementById('award').value)||0) * 3; calc(); 
    });
    
    document.getElementById('qa-lowball').addEventListener('click', () => { 
        document.getElementById('offer').value = 5000; calc(); 
    });
    
    calc();
});
</script>

