<div class="interactive-tool-grid financial-independence-timeline-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Current Savings / Portfolio ($)</label>
                    <input type="number" id="savings" class="form-control-custom" value="50000" min="0" step="1000">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Monthly Contribution ($)</label>
                    <input type="number" id="contrib" class="form-control-custom" value="1500" min="0" step="100">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Expected Annual Return (%)</label>
                    <input type="number" id="return" class="form-control-custom" value="7.0" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Target FI Number ($)</label>
                    <input type="number" id="target" class="form-control-custom" value="1000000" min="0" step="10000">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">Years to Financial Independence</span>
            <h1 class="result-main-value" id="years-fi" style="color: #047857;">0.0</h1>
            
            <div class="progress-custom mt-4 mb-2" style="height: 12px; border-radius: 6px;">
                <div id="prog-bar" class="progress-bar-custom" style="background:#10b981; width:5%;"></div>
            </div>
            <div class="text-center fw-bold text-muted mb-3" id="pct-val">5% of Goal</div>

            <div class="summary-table-container pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Monthly Goal Adjust</td><td class="text-end fw-semibold text-secondary" id="adj-msg">-</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const pv = parseFloat(document.getElementById('savings').value) || 0;
        const pmt = parseFloat(document.getElementById('contrib').value) || 0;
        const r = (parseFloat(document.getElementById('return').value) || 0) / 100 / 12;
        const fv = parseFloat(document.getElementById('target').value) || 0;
        
        let pct = (pv / fv) * 100;
        pct = Math.min(100, Math.max(0, pct));
        
        let nper = 0;
        if (fv <= pv) {
            nper = 0;
        } else if (r === 0) {
            nper = pmt > 0 ? (fv - pv) / pmt : Infinity;
        } else {
            if(pmt === 0 && pv === 0) {
                nper = Infinity;
            } else {
                const num = (fv * r) + pmt;
                const den = (pv * r) + pmt;
                if(num <= 0 || den <= 0) nper = Infinity;
                else nper = Math.log(num / den) / Math.log(1 + r);
            }
        }
        
        const years = nper / 12;
        let yText = years.toFixed(1);
        if(years === Infinity || years > 100) yText = "Never";
        else if(years < 0) yText = "0.0";
        
        let msg = "Keep investing!";
        if(years > 20 && pmt > 0) msg = "Consider increasing monthly contributions.";
        if(years <= 0) msg = "You have already reached your FI Number!";
        
        try {
            document.getElementById('years-fi').innerText = yText;
            document.getElementById('prog-bar').style.width = pct + '%';
            document.getElementById('pct-val').innerText = pct.toFixed(1) + '% of Goal';
            document.getElementById('adj-msg').innerText = msg;
        } catch(e) {}
    }
    ['savings','contrib','return','target'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    calc();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\financial-independence-timeline-calculator.blade.php ENDPATH**/ ?>