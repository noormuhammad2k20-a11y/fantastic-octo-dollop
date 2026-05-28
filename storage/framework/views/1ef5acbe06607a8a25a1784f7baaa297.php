<div class="interactive-tool-grid medical-risk-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Risk Profiles</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-yh" style="min-width: 280px; max-width: 100%;">Young & Healthy (2%)</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-mom" style="min-width: 280px; max-width: 100%;">Expecting Mother (95%)</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-sen" style="min-width: 280px; max-width: 100%;">Senior on Med (60%)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-ath" style="min-width: 280px; max-width: 100%;">Pro Athlete (30%)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-dia" style="min-width: 280px; max-width: 100%;">Diabetic (Chronic)</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-noins" style="min-width: 280px; max-width: 100%;">Uninsured Math</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Annual Insurance Premium / Sunk Cost ($)</label>
                    <input type="number" id="prem" class="form-control-custom text-primary fw-bold" value="3600" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom">Annual Chronic/Rx Expected Costs ($)</label>
                    <input type="number" id="rx" class="form-control-custom" value="500" min="0">
                </div>
                
                <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Catastrophic Event Matrix (Hospitalization)</h5>
                
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Probability of Hospitalization (%)</label>
                    <input type="number" id="prob" class="form-control-custom text-danger fw-bold" value="5" min="0" max="100">
                </div>
                <!-- OOP Max limits risk. If uninsured, OOP max is basically infinite, let's use 100k proxy -->
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Your Plan's Out of Pocket Max ($)</label>
                    <input type="number" id="oopm" class="form-control-custom" value="7500" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f59e0b;">
            <span class="result-label">Expected Value (EV) Healthcare Burn</span>
            <h1 class="result-main-value" id="ev" style="color: #d97706;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Fixed Sunk Cost (Prems + Base Rx)</td><td class="text-end fw-semibold text-secondary" id="s-fixed">$0</td></tr>
                    <tr><td>Risk Premium (Prob * OOPM)</td><td class="text-end fw-semibold text-danger" id="s-risk">$0</td></tr>
                </table>
            </div>
            <div class="alert mt-3 text-center border-0 p-2 rounded bg-light text-muted" style="font-size:0.85rem;">
                This calculates your mathematical expected spend, blending your guaranteed base costs with the probability of hitting your worst-case OOP Max.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const prem = parseFloat(document.getElementById('prem').value) || 0;
        const rx = parseFloat(document.getElementById('rx').value) || 0;
        const prob = (parseFloat(document.getElementById('prob').value) || 0) / 100;
        const oopm = parseFloat(document.getElementById('oopm').value) || 0;
        
        const fixed = prem + rx;
        
        // Let's assume hitting hospital means hitting OOPM exactly.
        // Let's adjust OOPM by subtracting whatever was already spent on RX if RX counts towards OOPM.
        // For simplicity, risk premium = prob * Math.max(0, OOPM - RX)
        const gapToOOPM = Math.max(0, oopm - rx);
        const risk = prob * gapToOOPM;
        
        const ev = fixed + risk;
        
        try {
            document.getElementById('ev').innerText = format(ev);
            document.getElementById('s-fixed').innerText = format(fixed);
            document.getElementById('s-risk').innerText = '+' + format(risk);
        } catch(e) {}
    }
    
    ['prem','rx','prob','oopm'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-yh').addEventListener('click', () => { document.getElementById('prem').value=1500; document.getElementById('rx').value=100; document.getElementById('prob').value=2; document.getElementById('oopm').value=8000; calc(); });
    document.getElementById('qa-mom').addEventListener('click', () => { document.getElementById('prem').value=4500; document.getElementById('rx').value=1000; document.getElementById('prob').value=95; document.getElementById('oopm').value=6000; calc(); });
    document.getElementById('qa-sen').addEventListener('click', () => { document.getElementById('prem').value=2400; document.getElementById('rx').value=3500; document.getElementById('prob').value=60; document.getElementById('oopm').value=2500; calc(); });
    document.getElementById('qa-ath').addEventListener('click', () => { document.getElementById('prem').value=2400; document.getElementById('rx').value=500; document.getElementById('prob').value=30; document.getElementById('oopm').value=4000; calc(); });
    document.getElementById('qa-dia').addEventListener('click', () => { document.getElementById('prem').value=3600; document.getElementById('rx').value=6500; document.getElementById('prob').value=25; document.getElementById('oopm').value=7500; calc(); });
    document.getElementById('qa-noins').addEventListener('click', () => { document.getElementById('prem').value=0; document.getElementById('rx').value=1200; document.getElementById('prob').value=5; document.getElementById('oopm').value=150000; calc(); });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\medical-risk-calculator.blade.php ENDPATH**/ ?>