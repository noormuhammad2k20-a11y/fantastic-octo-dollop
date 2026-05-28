<div class="interactive-tool-grid retirement-lifestyle-sustainability-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Current Nest Egg ($)</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-dollar-sign text-muted"></i></span>
                    <input type="number" id="nest" class="form-control-custom border-start-0 ps-0" value="1250000" min="0" step="10000">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-4 border-bottom pb-2 mb-3">
                <h5 class="text-secondary mb-0">Yearly Expenses</h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary me-1" id="qa-4" style="min-width: 280px; max-width: 100%;">4% Rule Math</button>
                    <button class="btn btn-sm btn-outline-success" id="qa-chubby" style="min-width: 280px; max-width: 100%;">Chubby FIRE</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Basic Housing & Utils</label>
                    <input type="number" id="e-house" class="form-control-custom e-val" value="24000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Food & Sustenance</label>
                    <input type="number" id="e-food" class="form-control-custom e-val" value="12000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Leisure, Travel, Luxuries</label>
                    <input type="number" id="e-fun" class="form-control-custom e-val" value="10000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Healthcare Premium</label>
                    <input type="number" id="e-health" class="form-control-custom e-val" value="8000" min="0">
                </div>
            </div>

            <div class="row pt-3 border-top mt-2">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Assume Inflation (%)</label>
                    <input type="number" id="inf" class="form-control-custom" value="3.0" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Assume Return (%)</label>
                    <input type="number" id="ret" class="form-control-custom" value="6.0" step="0.1">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <span class="result-label">Sustainability Status</span>
            <h1 class="result-main-value" id="status" style="color: #0369a1;">Sustainable</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Expected Yearly Draw</td><td class="text-end fw-semibold text-danger" id="tot-draw">$0</td></tr>
                    <tr><td>Actual Withdrawal Rate</td><td class="text-end fw-bold text-dark" id="w-rate">0%</td></tr>
                    <tr><td class="pt-2 border-top">Real Rate of Return (after inflation)</td><td class="text-end pt-2 border-top fw-bold fs-6 text-primary" id="real-ret">0%</td></tr>
                </table>
            </div>
            
            <div class="alert mt-3 text-center border-0 p-2 rounded" id="alert-box"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const nest = parseFloat(document.getElementById('nest').value) || 0;
        let draw = 0;
        document.querySelectorAll('.e-val').forEach(el => draw += (parseFloat(el.value)||0));
        
        const inf = parseFloat(document.getElementById('inf').value) || 0;
        const ret = parseFloat(document.getElementById('ret').value) || 0;
        
        const wrate = nest > 0 ? (draw / nest) * 100 : Infinity;
        const real = ret - inf;
        
        let status = "Sustainable";
        let col = "#10b981";
        let msg = "Your nest egg grows faster than your inflation-adjusted lifestyle drain.";
        
        if (wrate > real) {
            status = "Depleting";
            col = "#f59e0b";
            msg = "You are drawing down principal. Safe for a typical retirement length, but not infinite.";
            
            // if dangerously high
            if (wrate > 6) {
                status = "High Risk Failure";
                col = "#ef4444";
                msg = "Danger! Draw rate exceeds 6%. High probability of portfolio failure.";
            }
        }
        
        try {
            document.getElementById('status').innerText = status;
            document.getElementById('status').style.color = col;
            document.getElementById('tot-draw').innerText = format(draw);
            document.getElementById('w-rate').innerText = wrate === Infinity ? 'Infinity' : wrate.toFixed(2) + '%';
            document.getElementById('w-rate').style.color = col;
            document.getElementById('real-ret').innerText = real.toFixed(2) + '%';
            
            const ab = document.getElementById('alert-box');
            ab.innerText = msg;
            ab.style.backgroundColor = col === "#10b981" ? "#ecfdf5" : (col === "#f59e0b" ? "#fffbeb" : "#fef2f2");
            ab.style.color = col;
        } catch(e) {}
    }
    
    document.getElementById('nest').addEventListener('input', calc);
    document.getElementById('inf').addEventListener('input', calc);
    document.getElementById('ret').addEventListener('input', calc);
    document.querySelectorAll('.e-val').forEach(inp => inp.addEventListener('input', calc));
    
    document.getElementById('qa-4').addEventListener('click', () => {
        const nest = parseFloat(document.getElementById('nest').value) || 0;
        const rule4 = nest * 0.04;
        document.getElementById('e-house').value = Math.floor(rule4 * 0.4);
        document.getElementById('e-food').value = Math.floor(rule4 * 0.3);
        document.getElementById('e-fun').value = Math.floor(rule4 * 0.1);
        document.getElementById('e-health').value = Math.floor(rule4 * 0.2);
        calc();
    });
    
    document.getElementById('qa-chubby').addEventListener('click', () => {
        document.getElementById('e-house').value = 40000;
        document.getElementById('e-food').value = 24000;
        document.getElementById('e-fun').value = 36000;
        document.getElementById('e-health').value = 15000;
        calc();
    });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\retirement-lifestyle-sustainability-calculator.blade.php ENDPATH**/ ?>