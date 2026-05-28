<div class="interactive-tool-grid net-worth-optimization-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <h5 class="mb-3 text-secondary pb-2 border-bottom">Assets (What you own)</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Cash & Bank ($)</label>
                    <input type="number" id="a-cash" class="form-control-custom a-val" value="10000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Investments ($)</label>
                    <input type="number" id="a-inv" class="form-control-custom a-val" value="25000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Real Estate Value ($)</label>
                    <input type="number" id="a-re" class="form-control-custom a-val" value="300000" min="0">
                </div>
            </div>
            <h5 class="mt-3 mb-3 text-secondary pb-2 border-bottom">Liabilities (What you owe)</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Credit Card Debt ($)</label>
                    <input type="number" id="l-cc" class="form-control-custom l-val" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Auto/Student Loans ($)</label>
                    <input type="number" id="l-loan" class="form-control-custom l-val" value="20000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Mortgage ($)</label>
                    <input type="number" id="l-mort" class="form-control-custom l-val" value="250000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <span class="result-label">Total Net Worth</span>
            <h1 class="result-main-value" id="net-worth" style="color: #0369a1;">$0</h1>
            
            <div class="progress-custom mt-4 mb-2 d-flex" style="height: 14px; border-radius: 7px; overflow:hidden">
                <div id="bar-a" style="background:#10b981; width:60%;"></div>
                <div id="bar-l" style="background:#ef4444; width:40%;"></div>
            </div>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Assets</td><td class="text-end fw-semibold text-success" id="tot-a">$0</td></tr>
                    <tr><td>Total Liabilities</td><td class="text-end fw-semibold text-danger" id="tot-l">$0</td></tr>
                    <tr><td class="pt-2 border-top">Debt Ratio</td><td class="text-end pt-2 border-top fw-bold" id="ratio">0%</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.abs(n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        let ast = 0;
        document.querySelectorAll('.a-val').forEach(el => ast += (parseFloat(el.value)||0));
        
        let lia = 0;
        document.querySelectorAll('.l-val').forEach(el => lia += (parseFloat(el.value)||0));
        
        const net = ast - lia;
        
        let aPct = 50; let lPct = 50;
        if(ast + lia > 0) {
            aPct = (ast / (ast + lia)) * 100;
            lPct = (lia / (ast + lia)) * 100;
        }
        
        const ratio = ast > 0 ? (lia / ast) * 100 : 0;
        
        try {
            document.getElementById('net-worth').innerText = (net < 0 ? '-' : '') + format(net);
            document.getElementById('net-worth').style.color = net < 0 ? '#ef4444' : '#0369a1';
            
            document.getElementById('bar-a').style.width = aPct + '%';
            document.getElementById('bar-l').style.width = lPct + '%';
            
            document.getElementById('tot-a').innerText = format(ast);
            document.getElementById('tot-l').innerText = format(lia);
            document.getElementById('ratio').innerText = ratio.toFixed(1) + '%';
        } catch(e) {}
    }
    document.querySelectorAll('.a-val, .l-val').forEach(inp => inp.addEventListener('input', calc));
    calc();
});
</script>
