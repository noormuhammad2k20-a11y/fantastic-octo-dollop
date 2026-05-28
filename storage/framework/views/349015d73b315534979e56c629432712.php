<div class="interactive-tool-grid credit-profile-strength-score">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Payment History (%)</label>
                    <input type="number" id="pay-hist" class="form-control-custom" value="100" min="0" max="100">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Credit Utilization (%)</label>
                    <input type="number" id="util" class="form-control-custom" value="15" min="0" max="100">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Avg Age of Accounts (Years)</label>
                    <input type="number" id="age" class="form-control-custom" value="4" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Recent Hard Inquiries</label>
                    <input type="number" id="inq" class="form-control-custom" value="1" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <span class="result-label">Estimated FICO Range</span>
            <h1 class="result-main-value" id="strength" style="color: #0369a1;">740 - 780</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Payment History (35%)</td><td class="text-end fw-bold" id="s-pay">Perfect</td></tr>
                    <tr><td>Utilization (30%)</td><td class="text-end fw-bold" id="s-util">Excellent</td></tr>
                    <tr><td>Length of History (15%)</td><td class="text-end fw-bold" id="s-age">Fair</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const pay = parseFloat(document.getElementById('pay-hist').value) || 0;
        const util = parseFloat(document.getElementById('util').value) || 0;
        const age = parseFloat(document.getElementById('age').value) || 0;
        const inq = parseInt(document.getElementById('inq').value) || 0;
        
        let score = 300; // Base baseline
        
        // Payment (35%) - 0 to 192 pts
        if(pay >= 100) { score += 192; document.getElementById('s-pay').innerText="Perfect"; document.getElementById('s-pay').style.color="#10b981"; }
        else if(pay >= 98) { score += 150; document.getElementById('s-pay').innerText="Good"; document.getElementById('s-pay').style.color="#3b82f6"; }
        else { score += 50; document.getElementById('s-pay').innerText="Poor"; document.getElementById('s-pay').style.color="#ef4444"; }
        
        // Util (30%) - 0 to 165 pts
        if(util < 10) { score += 165; document.getElementById('s-util').innerText="Excellent"; document.getElementById('s-util').style.color="#10b981"; }
        else if(util <= 30) { score += 130; document.getElementById('s-util').innerText="Good"; document.getElementById('s-util').style.color="#3b82f6"; }
        else { score += 40; document.getElementById('s-util').innerText="High"; document.getElementById('s-util').style.color="#ef4444"; }
        
        // Age (15%) - 0 to 82 pts
        if(age >= 7) { score += 82; document.getElementById('s-age').innerText="Excellent"; document.getElementById('s-age').style.color="#10b981"; }
        else if(age >= 4) { score += 60; document.getElementById('s-age').innerText="Good"; document.getElementById('s-age').style.color="#3b82f6"; }
        else { score += 30; document.getElementById('s-age').innerText="Fair"; document.getElementById('s-age').style.color="#f59e0b"; }
        
        // Inquiries (10%) roughly. Subtract pts. Max 55. We assume 55 base.
        score += Math.max(0, 55 - (inq * 15));
        
        // Extra 10% for mix, we assume average mix +30
        score += 30; 
        
        score = Math.min(850, Math.max(300, score));
        const low = Math.max(300, score - 20);
        const high = Math.min(850, score + 20);
        
        try {
            document.getElementById('strength').innerText = `${Math.floor(low)} - ${Math.floor(high)}`;
        } catch(e) {}
    }
    ['pay-hist','util','age','inq'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    calc();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-profile-strength-score.blade.php ENDPATH**/ ?>