<div class="interactive-tool-grid coverage-gap-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Disaster Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-danger" id="qa-total" style="min-width: 280px; max-width: 100%;">Total House Loss</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-dent" style="min-width: 280px; max-width: 100%;">Minor Auto Dent</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-flood" style="min-width: 280px; max-width: 100%;">Uninsured Flood</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-jewel" style="min-width: 280px; max-width: 100%;">Jewelry Math (Sub-limit)</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-gap" style="min-width: 280px; max-width: 100%;">Huge Coverage Gap</button>
                    <button class="btn btn-sm btn-outline-success" id="qa-0gap" style="min-width: 280px; max-width: 100%;">Perfect Hedging</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-primary bg-white">True Replacement Cost of Loss ($)</label>
                    <input type="number" id="loss" class="form-control-custom" value="450000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-danger bg-white">Max Policy Limit for this Event ($)</label>
                    <input type="number" id="limit" class="form-control-custom" value="300000" min="0">
                </div>
                
                <h5 class="text-secondary mt-3 pb-2 border-bottom mb-2 w-100">Deductibles & Penalties</h5>
                <div class="col-md-6 form-group-custom mb-2 border-end">
                    <label class="form-label-custom">Policy Deductible ($)</label>
                    <input type="number" id="ded" class="form-control-custom" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Depreciation / Co-Insurance Penalty ($)</label>
                    <input type="number" id="pen" class="form-control-custom text-muted" value="0" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #ef4444;">
            <span class="result-label">Your Uninsured Gap (OOP)</span>
            <h1 class="result-main-value" id="gap" style="color: #b91c1c;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Loss Driven</td><td class="text-end fw-semibold text-secondary" id="s-loss">$0</td></tr>
                    <tr><td>Max Insurance Payout</td><td class="text-end fw-bold text-success" id="s-pay">+$0</td></tr>
                </table>
            </div>
            <div class="progress-custom mt-3 d-flex" style="height:12px; border-radius:6px; overflow:hidden;">
                <div id="bar-ins" style="background:#10b981; width:50%;"></div>
                <div id="bar-oop" style="background:#ef4444; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.75rem;">
                <span style="color:#10b981;font-weight:bold;">Covered</span>
                <span style="color:#ef4444;font-weight:bold;">Gap / OOP</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const loss = parseFloat(document.getElementById('loss').value) || 0;
        const limit = parseFloat(document.getElementById('limit').value) || 0;
        const ded = parseFloat(document.getElementById('ded').value) || 0;
        const pen = parseFloat(document.getElementById('pen').value) || 0;
        
        let payout = loss - ded - pen;
        if(payout > limit) payout = limit;
        if(payout < 0) payout = 0;
        
        const gap = loss - payout;
        
        let pcIns = loss > 0 ? (payout / loss) * 100 : 0;
        let pcOop = 100 - pcIns;
        
        try {
            document.getElementById('gap').innerText = format(gap);
            document.getElementById('gap').style.color = gap > 0 ? "#b91c1c" : "#10b981";
            
            document.getElementById('s-loss').innerText = format(loss);
            document.getElementById('s-pay').innerText = '+' + format(payout);
            
            document.getElementById('bar-ins').style.width = Math.max(0, pcIns) + '%';
            document.getElementById('bar-oop').style.width = Math.max(0, pcOop) + '%';
        } catch(e) {}
    }
    
    ['loss','limit','ded','pen'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-total').addEventListener('click', () => { document.getElementById('loss').value=450000; document.getElementById('limit').value=300000; document.getElementById('ded').value=5000; document.getElementById('pen').value=20000; calc(); });
    document.getElementById('qa-dent').addEventListener('click', () => { document.getElementById('loss').value=1500; document.getElementById('limit').value=50000; document.getElementById('ded').value=1000; document.getElementById('pen').value=0; calc(); });
    document.getElementById('qa-flood').addEventListener('click', () => { document.getElementById('loss').value=45000; document.getElementById('limit').value=0; document.getElementById('ded').value=0; document.getElementById('pen').value=0; calc(); });
    document.getElementById('qa-jewel').addEventListener('click', () => { document.getElementById('loss').value=15000; document.getElementById('limit').value=2500; document.getElementById('ded').value=500; document.getElementById('pen').value=0; calc(); });
    document.getElementById('qa-gap').addEventListener('click', () => { document.getElementById('loss').value=1000000; document.getElementById('limit').value=100000; document.getElementById('ded').value=1000; document.getElementById('pen').value=0; calc(); });
    document.getElementById('qa-0gap').addEventListener('click', () => { document.getElementById('loss').value=14500; document.getElementById('limit').value=250000; document.getElementById('ded').value=0; document.getElementById('pen').value=0; calc(); });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\coverage-gap-calculator.blade.php ENDPATH**/ ?>