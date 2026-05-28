<div class="interactive-tool-grid credit-health-analyzer">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-secondary mb-0">Credit Report Profile</h5>
                <div>
                    <button class="btn btn-sm btn-outline-danger" id="qa-bkm" style="min-width: 280px; max-width: 100%;"><i class="fas fa-car-crash"></i> Add Derog</button>
                    <button class="btn btn-sm btn-outline-success ms-1" id="qa-perf" style="min-width: 280px; max-width: 100%;"><i class="fas fa-check-double"></i> Perfect</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Total Accounts (Open + Closed)</label>
                    <input type="number" id="tot-acc" class="form-control-custom" value="12" min="1">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Accounts with Missed Payments</label>
                    <input type="number" id="late-acc" class="form-control-custom" value="0" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Total Available Credit ($)</label>
                    <input type="number" id="avail" class="form-control-custom" value="25000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Total Revolving Balances ($)</label>
                    <input type="number" id="bal" class="form-control-custom" value="2000" min="0">
                </div>
                <div class="col-12 form-group-custom mb-2">
                    <label class="form-label-custom">Public Records (Bankruptcies/Collections)</label>
                    <input type="number" id="pub" class="form-control-custom" value="0" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <span class="result-label">Overall Health Grade</span>
            <h1 class="result-main-value" id="grade" style="color: #0369a1;">A</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Payment History Flag</td><td class="text-end fw-bold text-success" id="h-pay">Clean</td></tr>
                    <tr><td>Utilization Flag</td><td class="text-end fw-bold text-success" id="h-util">Optimal (8%)</td></tr>
                    <tr><td class="pt-2 border-top">Derogatory Flag</td><td class="text-end pt-2 border-top fw-bold text-success" id="h-derog">Clear</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const acc = parseInt(document.getElementById('tot-acc').value) || 1;
        const late = parseInt(document.getElementById('late-acc').value) || 0;
        const avail = parseFloat(document.getElementById('avail').value) || 0;
        const bal = parseFloat(document.getElementById('bal').value) || 0;
        const pub = parseInt(document.getElementById('pub').value) || 0;
        
        let gValue = 100;
        
        let pFlag = "Clean"; let pCol = "#10b981";
        if(late > 0) { 
            gValue -= 30; 
            pFlag = `${late} Delinquent`; pCol = "#ef4444"; 
        }
        
        const pct = avail > 0 ? (bal / avail) * 100 : 0;
        let uFlag = `Optimal (${pct.toFixed(0)}%)`; let uCol = "#10b981";
        if (pct > 30) { gValue -= 15; uFlag = `High (${pct.toFixed(0)}%)`; uCol = "#f59e0b"; }
        if (pct > 70) { gValue -= 20; uFlag = `Maxed (${pct.toFixed(0)}%)`; uCol = "#ef4444"; }
        
        let dFlag = "Clear"; let dCol = "#10b981";
        if(pub > 0) {
            gValue -= 40;
            dFlag = `${pub} Public Records`; dCol = "#b91c1c";
        }
        
        gValue = Math.min(100, Math.max(0, gValue));
        
        let gradeLetter = "F"; let colLetter = "#b91c1c";
        if(gValue >= 90) { gradeLetter = "A"; colLetter = "#10b981"; }
        else if(gValue >= 80) { gradeLetter = "B"; colLetter = "#3b82f6"; }
        else if(gValue >= 70) { gradeLetter = "C"; colLetter = "#f59e0b"; }
        else if(gValue >= 60) { gradeLetter = "D"; colLetter = "#ef4444"; }
        
        try {
            document.getElementById('grade').innerText = gradeLetter;
            document.getElementById('grade').style.color = colLetter;
            
            document.getElementById('h-pay').innerText = pFlag;
            document.getElementById('h-pay').style.color = pCol;
            
            document.getElementById('h-util').innerText = uFlag;
            document.getElementById('h-util').style.color = uCol;
            
            document.getElementById('h-derog').innerText = dFlag;
            document.getElementById('h-derog').style.color = dCol;
        } catch(e) {}
    }
    
    ['tot-acc','late-acc','avail','bal','pub'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    document.getElementById('qa-bkm').addEventListener('click', () => { document.getElementById('pub').value = 1; calc(); });
    document.getElementById('qa-perf').addEventListener('click', () => { 
        document.getElementById('late-acc').value = 0;
        document.getElementById('bal').value = 0;
        document.getElementById('pub').value = 0;
        calc(); 
    });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-health-analyzer.blade.php ENDPATH**/ ?>