<div class="interactive-tool-grid estate-tax-calculator">
    <div class="calculator-card">
        <div class="calculator-header">
            <div class="tool-icon-circle"><i class="fas fa-landmark"></i></div>
            <div><h4>Estate Tax Calculator</h4><p>Accurate Estimation Tool</p></div>
        </div>
        <div class="calculator-body">            <div class="form-group-custom mb-3"><label class="form-label-custom">Estate Value ($)</label><input type="number" id="estate-value" class="form-control-custom" placeholder="e.g. 15000000"></div>
</div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2">
            <span class="result-label">Projected Result</span>
            <h1 class="result-main-value" id="main-result">0</h1>
            <div class="visual-analytics mt-4 mb-4">
                <div class="progress-custom"><div id="visual-bar" class="progress-bar-custom"></div></div>
                <small class="text-muted mt-2 d-block">Visual Score / Distribution</small>
            </div>
            <div class="result-sub-stats">                <div class="stat-item border-end pe-3"><span class="stat-label">Taxable Amt</span><span class="stat-value" id="taxable-value">0</span></div>
                <div class="stat-item ps-3"><span class="stat-label">Est. Tax</span><span class="stat-value" id="estimated-tax">0</span></div>
</div>
            <div class="summary-table-container mt-4 pt-3 border-top">
                <h5>Breakdown Summary</h5>
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Primary Component</td><td class="text-end">90%</td></tr>
                    <tr><td>Processing Fees</td><td class="text-end">10%</td></tr>
                </table>
            </div>
            <button class="btn btn-accent w-100 py-3 mt-3 shadow-sm" id="copy-result"><i class="fas fa-copy me-2"></i> Export Results</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const estate_value = parseFloat(document.getElementById('estate-value').value) || 0;


        let res = 0; let mainUnit = '$';
        let v = Math.max(0, estate_value - 12000000); res = v * 0.40; try { document.getElementById('taxable-value').innerText = '$'+v.toLocaleString(); document.getElementById('estimated-tax').innerText = '$'+res.toLocaleString(); } catch(e){}

        const displayRes = (mainUnit === '%' || mainUnit === '' ? res.toFixed(2) : Math.round(res).toLocaleString());
        try { document.getElementById('main-result').innerText = mainUnit + displayRes; } catch(e){}
        
        // Dynamic Chart (Simple CSS Bar)
        try { 
            const bar = document.getElementById('visual-bar');
            if(bar) { 
                let pct = (res / (res + 10000)) * 100; 
                if (mainUnit === '%') pct = Math.min(100, res);
                bar.style.width = pct + '%'; 
            }
        } catch(e){}
    
    }
    ['estate-value'].forEach(id => {
        const el = document.getElementById(id);
        if(el) el.addEventListener('input', calculate);
    });
    document.getElementById('copy-result').addEventListener('click', function() {
        const text = 'Estate Tax Result: ' + document.getElementById('main-result').innerText;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this; const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => btn.innerHTML = orig, 2000);
        });
    });
    calculate();
});
</script>
<style>
.progress-custom { background: #eef2f7; height: 12px; border-radius: 10px; overflow: hidden; }
.progress-bar-custom { background: linear-gradient(90deg, #6366f1, #a855f7); width: 0%; height: 100%; transition: width 0.4s ease; }
.summary-table td { padding: 8px 0; font-size: 0.9rem; color: #4b5563; }
.summary-table .text-end { font-weight: 600; color: #1f2937; }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\estate-tax-calculator.blade.php ENDPATH**/ ?>