<div class="interactive-tool-grid wealth-gap-closing-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Current Net Worth ($)</label>
                    <input type="number" id="nw" class="form-control-custom" value="100000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Target Net Worth ($)</label>
                    <input type="number" id="tar" class="form-control-custom" value="1000000" min="0">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-2 border-bottom pb-2 mb-3">
                <h5 class="text-secondary mb-0">Timeline & Strategy</h5>
                <div>
                    <button class="btn btn-sm btn-outline-danger me-1" id="qa-less" style="min-width: 280px; max-width: 100%;"><i class="fas fa-fast-forward"></i> -5 Years</button>
                    <button class="btn btn-sm btn-outline-success" id="qa-more" style="min-width: 280px; max-width: 100%;"><i class="fas fa-percentage"></i> +2% ROI</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Years to Close Gap</label>
                    <input type="number" id="yrs" class="form-control-custom" value="10" min="1" max="50">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Expected ROI (%)</label>
                    <input type="number" id="roi" class="form-control-custom" value="7" step="0.5">
                </div>
                <div class="col-12 form-group-custom mb-2">
                    <label class="form-label-custom">Expected Yield Dividend (%)</label>
                    <input type="number" id="yld" class="form-control-custom" value="2" step="0.5">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #a855f7;">
            <span class="result-label">Required Monthly Savings</span>
            <h1 class="result-main-value" id="req-sav" style="color: #7e22ce;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Gap to Close</td><td class="text-end fw-semibold text-secondary" id="gap">$0</td></tr>
                    <tr><td>Compound Grwoth Will Cover</td><td class="text-end fw-bold text-success" id="auto-gr">+$0</td></tr>
                    <tr><td class="pt-2 border-top">You Must Inject</td><td class="text-end pt-2 border-top fw-bold fs-5 text-primary" id="inj">$0</td></tr>
                </table>
            </div>
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light text-muted" style="font-size:0.85rem;" id="alert-msg">
                Consistent monthly investments drastically reduce the manual capital needed.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const nw = parseFloat(document.getElementById('nw').value) || 0;
        const tar = parseFloat(document.getElementById('tar').value) || 0;
        const yrs = parseInt(document.getElementById('yrs').value) || 0;
        const roi = (parseFloat(document.getElementById('roi').value) || 0) / 100;
        const yld = (parseFloat(document.getElementById('yld').value) || 0) / 100;
        
        const r = (roi + yld) / 12;
        const m = yrs * 12;
        
        const gap = Math.max(0, tar - nw);
        
        let pmt = 0;
        let fv_nw = 0;
        
        if(m > 0) {
            if(r>0) fv_nw = nw * Math.pow(1+r, m);
            else fv_nw = nw;
            
            const remGap = Math.max(0, tar - fv_nw);
            if(r>0) pmt = remGap / (((Math.pow(1+r, m) - 1)/r));
            else pmt = remGap / m;
        }
        
        const inj = pmt * m;
        const autoGr = Math.max(0, tar - nw - inj);
        
        try {
            document.getElementById('gap').innerText = format(gap);
            document.getElementById('req-sav').innerText = format(pmt);
            document.getElementById('inj').innerText = format(inj);
            document.getElementById('auto-gr').innerText = '+' + format(autoGr);
            
            if(pmt <= 0) document.getElementById('alert-msg').innerText = "Gap is covered! Your current wealth will grow to hit the target naturally.";
            else document.getElementById('alert-msg').innerText = "Consistent monthly investments drastically reduce the manual capital needed.";
        } catch(e) {}
    }
    
    ['nw','tar','yrs','roi','yld'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    document.getElementById('qa-less').addEventListener('click', () => {
        const el = document.getElementById('yrs');
        el.value = Math.max(1, parseInt(el.value) - 5);
        calc();
    });
    
    document.getElementById('qa-more').addEventListener('click', () => {
        const el = document.getElementById('roi');
        el.value = parseFloat(el.value) + 2;
        calc();
    });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\wealth-gap-closing-calculator.blade.php ENDPATH**/ ?>