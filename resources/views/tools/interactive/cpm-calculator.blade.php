<div class="interactive-tool-grid cpm-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Total Campaign Cost ($)</label>
                <input type="number" id="total-cost" class="form-control-custom" value="500" min="0">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Total Impressions</label>
                <input type="number" id="total-impressions" class="form-control-custom" value="100000" min="1">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-chart-line me-1"></i> <strong>Formula:</strong> (Total Cost / Total Impressions) × 1000
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2 text-center py-5">
            <span class="result-label">Calculated CPM</span>
            <div class="result-main-value" id="result-cpm">$5.00</div>
            
            <div class="mt-4 p-3 border rounded bg-white">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Cost Per Impression</span>
                    <span class="fw-bold" id="stat-cpi">$0.0050</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Impressions Per 1$</span>
                    <span class="fw-bold text-accent" id="stat-ipd">200</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const costInput = document.getElementById('total-cost');
    const impressionsInput = document.getElementById('total-impressions');
    const resultCpm = document.getElementById('result-cpm');
    const statCpi = document.getElementById('stat-cpi');
    const statIpd = document.getElementById('stat-ipd');

    function calculate() {
        const cost = parseFloat(costInput.value) || 0;
        const impressions = parseFloat(impressionsInput.value) || 0;

        if (impressions > 0) {
            const cpm = (cost / impressions) * 1000;
            const cpi = cost / impressions;
            const ipd = cost > 0 ? impressions / cost : 0;

            resultCpm.innerText = "$" + cpm.toFixed(2);
            statCpi.innerText = "$" + cpi.toFixed(4);
            statIpd.innerText = Math.round(ipd).toLocaleString();
        } else {
            resultCpm.innerText = "$0.00";
            statCpi.innerText = "$0.00";
            statIpd.innerText = "0";
        }
    }

    [costInput, impressionsInput].forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `CPM Advertising Report:\nTotal Cost: $${costInput.value}\nTotal Impressions: ${impressionsInput.value}\nCalculated CPM: ${resultCpm.innerText}\nImpressions Per $1: ${statIpd.innerText}\nCalculated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const original = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = original; }, 2000);
        });
    });

    calculate();
});
</script>

