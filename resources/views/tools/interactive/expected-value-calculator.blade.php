<div class="interactive-tool-grid expected-value-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Winning Amount ($)</label>
                <input type="number" id="ev-win-amt" class="form-control-custom ev-in" value="100">
            </div>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Probability of Winning (%)</label>
                <input type="number" id="ev-win-prob" class="form-control-custom ev-in" value="50" max="100">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Losing Amount (usually negative)</label>
                <input type="number" id="ev-lose-amt" class="form-control-custom ev-in" value="-100">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> (P(Win) * Win) + (P(Lose) * Lose)
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Expected Value (EV)</span>
            <div class="result-main-value" id="result-ev">$0.00</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">Outlook</span>
                    <span class="stat-value" id="stat-outlook">Neutral</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">Loss Prob.</span>
                    <span class="stat-value" id="stat-loss-p">50%</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Analysis
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const wAmt = parseFloat(document.getElementById('ev-win-amt').value) || 0;
        const wProb = (parseFloat(document.getElementById('ev-win-prob').value) || 0) / 100;
        const lAmt = parseFloat(document.getElementById('ev-lose-amt').value) || 0;
        const lProb = 1 - wProb;

        const ev = (wProb * wAmt) + (lProb * lAmt);

        document.getElementById('result-ev').innerText = (ev >= 0 ? "$" : "-$") + Math.abs(ev).toFixed(2);
        document.getElementById('stat-loss-p').innerText = Math.round(lProb * 100) + "%";
        document.getElementById('stat-outlook').innerText = ev > 0 ? "Positive" : (ev < 0 ? "Negative" : "Neutral");
    }

    document.querySelectorAll('.ev-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `EV Analysis:\nWin Probability: ${document.getElementById('ev-win-prob').value}%\nExpected Value: ${document.getElementById('result-ev').innerText}\nOutlook: ${document.getElementById('stat-outlook').innerText}\nCalculated via ToolsHub Stats.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });

    calculate();
});
</script>

