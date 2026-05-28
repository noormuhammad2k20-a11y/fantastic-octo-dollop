<div class="interactive-tool-grid home-equity-calculator">
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Mortgage Balance ($)</label>
                <input type="number" id="mort-bal" class="form-control-custom hel-in" value="200000">
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Current Home Market Value ($)</label>
                <input type="number" id="home-val" class="form-control-custom hel-in" value="350000">
            </div>

            <div class="alert alert-info py-2" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-info-circle me-1"></i> Estimates assume an 80% Loan-to-Value (LTV) limit.
            </div>
        </div>
    </div>

    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Available Potential Equity</span>
            <div class="result-main-value" id="result-equity">$150,000</div>
            
            <div class="result-sub-stats">
                <div class="stat-item border-end pe-3">
                    <span class="stat-label">LTV Ratio</span>
                    <span class="stat-value" id="stat-ltv">57%</span>
                </div>
                <div class="stat-item ps-3">
                    <span class="stat-label">HELOC Limit</span>
                    <span class="stat-value text-accent" id="stat-heloc">$80,000</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-3 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-result" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Loan Summary
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const bal = parseFloat(document.getElementById('mort-bal').value) || 0;
        const val = parseFloat(document.getElementById('home-val').value) || 1;

        const equity = val - bal;
        const ltv = (bal / val) * 100;
        const heloc = (val * 0.80) - bal;

        document.getElementById('result-equity').innerText = "$" + (equity > 0 ? equity : 0).toLocaleString();
        document.getElementById('stat-ltv').innerText = Math.round(ltv) + "%";
        document.getElementById('stat-heloc').innerText = "$" + (heloc > 0 ? heloc : 0).toLocaleString();
    }

    document.querySelectorAll('.hel-in').forEach(el => {
        el.addEventListener('input', calculate);
    });

    document.getElementById('copy-result').addEventListener('click', function() {
        const text = `Home Equity Summary:\nValue: $${document.getElementById('home-val').value}\nEquity: ${document.getElementById('result-equity').innerText}\nHELOC Potential: ${document.getElementById('stat-heloc').innerText}\nCalculated via ToolsHub Finance.`;
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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\home-equity-calculator.blade.php ENDPATH**/ ?>