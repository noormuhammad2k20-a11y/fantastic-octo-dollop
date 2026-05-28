<div class="interactive-tool-grid traffic-conversion-rate">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Marketing Benchmarks</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-primary" id="qa-saas" style="min-width: 280px; max-width: 100%;">SaaS Trial (5%)</button>
                    <button class="btn btn-sm btn-outline-success" id="qa-ecom" style="min-width: 280px; max-width: 100%;">E-com High Vol (2%)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-local" style="min-width: 280px; max-width: 100%;">Local Lead Gen (10%)</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-aov" style="min-width: 280px; max-width: 100%;">High AOV Agency</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-viral" style="min-width: 280px; max-width: 100%;">Viral Traffic (0.5%)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-lose" style="min-width: 280px; max-width: 100%;">Losing Campaign</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Monthly Unique Visitors (Traffic)</label>
                    <input type="number" id="traf" class="form-control-custom" value="10000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom text-primary">Conversion Rate (%)</label>
                    <input type="number" id="cvr" class="form-control-custom fw-bold" value="2.5" step="0.1">
                </div>
                
                <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Revenue & Acquisition Costs</h5>
                
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-success">Average Order Value (AOV) ($)</label>
                    <input type="number" id="aov" class="form-control-custom fw-bold" value="45" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Cost Per Click (CPC) / Visitor ($)</label>
                    <input type="number" id="cpc" class="form-control-custom" value="0.50" step="0.05">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #3b82f6;">
            <span class="result-label">Net Profit (Monthly)</span>
            <h1 class="result-main-value" id="net" style="color: #1d4ed8;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Gross Revenue</td><td class="text-end fw-semibold text-success" id="s-rev">$0</td></tr>
                    <tr><td>Total Ad / Traffic Spend</td><td class="text-end fw-semibold text-danger" id="s-spend">-$0</td></tr>
                    <tr><td class="pt-2 border-top">Return on Ad Spend (ROAS)</td><td class="text-end pt-2 border-top fw-bold fs-6" id="s-roas" style="color: #3b82f6;">0x</td></tr>
                </table>
            </div>
            
            <div class="alert mt-3 text-center border-0 p-2 rounded text-white fw-bold" id="status-msg"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const traf = parseFloat(document.getElementById('traf').value) || 0;
        const cvr = (parseFloat(document.getElementById('cvr').value) || 0) / 100;
        const aov = parseFloat(document.getElementById('aov').value) || 0;
        const cpc = parseFloat(document.getElementById('cpc').value) || 0;
        
        const conversions = traf * cvr;
        const revenue = conversions * aov;
        const spend = traf * cpc;
        
        const net = revenue - spend;
        
        let roas = spend > 0 ? (revenue / spend) : 0;
        
        try {
            document.getElementById('net').innerText = (net < 0 ? '-' : '') + format(Math.abs(net));
            document.getElementById('net').style.color = net < 0 ? "#ef4444" : "#1d4ed8";
            
            document.getElementById('s-rev').innerText = format(revenue);
            document.getElementById('s-spend').innerText = '-' + format(spend);
            document.getElementById('s-roas').innerText = roas.toFixed(2) + 'x';
            
            const msgObj = document.getElementById('status-msg');
            if(net > 0 && roas >= 3) {
                msgObj.innerText = "SCALING ZONE: Highly profitable ROAS map. Pump budget immediately.";
                msgObj.className = "alert bg-success mt-3 text-center border-0 p-2 rounded text-white fw-bold";
            } else if (net > 0) {
                msgObj.innerText = "PROFITABLE: Marginal yields, optimize AOV or CVR before massive scaling.";
                msgObj.className = "alert bg-primary mt-3 text-center border-0 p-2 rounded text-white fw-bold";
            } else {
                msgObj.innerText = "BLEEDING CASH: Your CPA is higher than your LTV. Stop traffic.";
                msgObj.className = "alert bg-danger mt-3 text-center border-0 p-2 rounded text-white fw-bold";
            }
        } catch(e) {}
    }
    
    ['traf','cvr','aov','cpc'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-saas').addEventListener('click', () => { document.getElementById('traf').value=5000; document.getElementById('cvr').value=5; document.getElementById('aov').value=120; document.getElementById('cpc').value=2.50; calc(); });
    document.getElementById('qa-ecom').addEventListener('click', () => { document.getElementById('traf').value=50000; document.getElementById('cvr').value=2; document.getElementById('aov').value=45; document.getElementById('cpc').value=0.35; calc(); });
    document.getElementById('qa-local').addEventListener('click', () => { document.getElementById('traf').value=1000; document.getElementById('cvr').value=10; document.getElementById('aov').value=250; document.getElementById('cpc').value=15.0; calc(); });
    document.getElementById('qa-aov').addEventListener('click', () => { document.getElementById('traf').value=2000; document.getElementById('cvr').value=1.5; document.getElementById('aov').value=3000; document.getElementById('cpc').value=5.0; calc(); });
    document.getElementById('qa-viral').addEventListener('click', () => { document.getElementById('traf').value=250000; document.getElementById('cvr').value=0.5; document.getElementById('aov').value=25; document.getElementById('cpc').value=0.01; calc(); });
    document.getElementById('qa-lose').addEventListener('click', () => { document.getElementById('traf').value=10000; document.getElementById('cvr').value=0.5; document.getElementById('aov').value=45; document.getElementById('cpc').value=1.50; calc(); });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\traffic-conversion-rate.blade.php ENDPATH**/ ?>