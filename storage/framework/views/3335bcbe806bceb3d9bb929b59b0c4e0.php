<div class="interactive-tool-grid credit-age-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-secondary mb-0">Open Trade Lines</h5>
                <div>
                    <button class="btn btn-sm btn-outline-danger" id="qa-close" style="min-width: 280px; max-width: 100%;"><i class="fas fa-times"></i> Close Oldest Limit</button>
                </div>
            </div>

            <div id="date-cards">
                <div class="row align-items-end mb-2 dt-row">
                    <div class="col-8 form-group-custom">
                        <label class="form-label-custom">Year Opened (e.g., 2018)</label>
                        <input type="number" class="form-control-custom dt-val" value="2015" min="1950" max="2030">
                    </div>
                </div>
                <div class="row align-items-end mb-2 dt-row">
                    <div class="col-8 form-group-custom">
                        <label class="form-label-custom">Year Opened</label>
                        <input type="number" class="form-control-custom dt-val" value="2020" min="1950" max="2030">
                    </div>
                    <div class="col-4 text-end">
                        <button class="btn btn-outline-danger btn-sm w-100 rm-dt"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                <div class="row align-items-end mb-2 dt-row">
                    <div class="col-8 form-group-custom">
                        <label class="form-label-custom">Year Opened</label>
                        <input type="number" class="form-control-custom dt-val" value="2023" min="1950" max="2030">
                    </div>
                    <div class="col-4 text-end">
                        <button class="btn btn-outline-danger btn-sm w-100 rm-dt"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            
            <button class="btn btn-outline-primary btn-sm mt-3" id="add-dt" style="min-width: 280px; max-width: 100%;"><i class="fas fa-plus me-1"></i> Add Account</button>
            
            <div class="form-group-custom mt-4 border-top pt-3">
                <label class="form-label-custom">Current Year</label>
                <input type="number" id="curr-yr" class="form-control-custom" value="2026" readonly>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #a855f7;">
            <span class="result-label">Average Account Age</span>
            <h1 class="result-main-value" id="avg-yr" style="color: #7e22ce;">0 Years</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Score Impact Grade</td><td class="text-end fw-bold" id="age-grade">Fair</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Current year preset
    const currentYear = new Date().getFullYear();
    document.getElementById('curr-yr').value = currentYear;

    function calc() {
        const inputs = document.querySelectorAll('.dt-val');
        let totalYears = 0;
        let count = 0;
        inputs.forEach(inp => {
            const v = parseInt(inp.value);
            if(!isNaN(v) && v <= currentYear) { totalYears += (currentYear - v); count++; }
        });
        
        let avgY = count > 0 ? (totalYears / count) : 0;
        
        let grade = "Poor"; let col = "#ef4444";
        if(avgY >= 7) { grade = "Excellent (7+ Yrs)"; col = "#10b981"; }
        else if(avgY >= 5) { grade = "Good (5+ Yrs)"; col = "#3b82f6"; }
        else if(avgY >= 2) { grade = "Fair (2+ Yrs)"; col = "#f59e0b"; }
        
        try {
            document.getElementById('avg-yr').innerText = avgY.toFixed(1) + ' Years';
            document.getElementById('age-grade').innerText = grade;
            document.getElementById('age-grade').style.color = col;
        } catch(e) {}
    }
    
    function bindRow(row) {
        row.querySelector('.dt-val').addEventListener('input', calc);
        const rm = row.querySelector('.rm-dt');
        if(rm) {
            rm.addEventListener('click', function() {
                row.remove();
                calc();
                const remaining = document.querySelectorAll('.dt-row');
                if(remaining.length === 1) remaining[0].querySelector('.rm-dt').disabled = true;
            });
        }
    }
    
    document.querySelectorAll('.dt-row').forEach(bindRow);
    
    document.getElementById('add-dt').addEventListener('click', () => {
        const cont = document.getElementById('date-cards');
        const d = document.createElement('div');
        d.className = 'row align-items-end mb-2 dt-row';
        d.innerHTML = `<div class="col-8 form-group-custom"><label class="form-label-custom">Year Opened</label><input type="number" class="form-control-custom dt-val" value="${currentYear}" min="1950" max="2030"></div><div class="col-4 text-end"><button class="btn btn-outline-danger btn-sm w-100 rm-dt"><i class="fas fa-trash"></i></button></div>`;
        cont.appendChild(d);
        bindRow(d);
        calc();
    });
    
    document.getElementById('qa-close').addEventListener('click', () => {
        const inputs = Array.from(document.querySelectorAll('.dt-val'));
        if(inputs.length <= 1) return;
        
        // Find oldest (smallest year)
        let oldestIdx = 0; let minYear = 9999;
        inputs.forEach((inp, idx) => {
            const y = parseInt(inp.value)||9999;
            if(y < minYear) { minYear = y; oldestIdx = idx; }
        });
        
        const rowToRemove = inputs[oldestIdx].closest('.dt-row');
        rowToRemove.remove();
        calc();
    });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-age-calculator.blade.php ENDPATH**/ ?>