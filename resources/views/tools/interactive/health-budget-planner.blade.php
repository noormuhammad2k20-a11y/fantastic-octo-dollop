<div class="interactive-tool-grid health-budget-planner">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Household Planners</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-fam" style="min-width: 280px; max-width: 100%;">Standard Family</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-sing" style="min-width: 280px; max-width: 100%;">Single Healthy</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-hdhp" style="min-width: 280px; max-width: 100%;">HDHP Max HSA</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-gold" style="min-width: 280px; max-width: 100%;">Gold PPO Shield</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-med" style="min-width: 280px; max-width: 100%;">Medicare Supp</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-cob" style="min-width: 280px; max-width: 100%;">COBRA Spender</button>
                </div>
            </div>

            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Annual Guarantees</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Annual Premiums Ded. ($)</label>
                    <input type="number" id="p-prem" class="form-control-custom a-val" value="4800" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Annual Prescriptions Est. ($)</label>
                    <input type="number" id="p-rx" class="form-control-custom a-val" value="600" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Routine Dental/Vision ($)</label>
                    <input type="number" id="p-den" class="form-control-custom a-val" value="300" min="0">
                </div>
                
                <h5 class="text-secondary mt-3 pb-2 border-bottom mb-2 w-100">Contingency Padding</h5>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Unplanned Deductible Risk/Padding ($)</label>
                    <input type="number" id="p-pad" class="form-control-custom" value="1500" min="0">
                </div>
            </div>
            <div class="form-group-custom mb-3 mt-2 pt-2 border-top">
                <label class="form-label-custom text-primary fw-bold">Employer / HSA Contributions Offset ($)</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-minus text-muted"></i></span>
                    <input type="number" id="p-off" class="form-control-custom border-start-0 ps-0" value="1000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">Monthly Savings Target</span>
            <h1 class="result-main-value" id="mo-target" style="color: #047857;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Gross Annual Healthcare Budget</td><td class="text-end fw-semibold text-secondary" id="s-gross">$0</td></tr>
                    <tr><td>Minus Employer/System Offsets</td><td class="text-end fw-semibold text-success" id="s-off">-$0</td></tr>
                    <tr><td class="pt-2 border-top">Net Annual Burden</td><td class="text-end pt-2 border-top fw-bold text-danger fs-6" id="s-net">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        let gross = 0;
        document.querySelectorAll('.a-val').forEach(el => gross += (parseFloat(el.value)||0));
        
        let pad = parseFloat(document.getElementById('p-pad').value) || 0;
        gross += pad;
        
        let off = parseFloat(document.getElementById('p-off').value) || 0;
        
        let net = Math.max(0, gross - off);
        let mo = net / 12;
        
        try {
            document.getElementById('mo-target').innerText = format(mo);
            document.getElementById('s-gross').innerText = format(gross);
            document.getElementById('s-off').innerText = '-' + format(off);
            document.getElementById('s-net').innerText = format(net);
        } catch(e) {}
    }
    
    document.querySelectorAll('.a-val, #p-pad, #p-off').forEach(inp => inp.addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-fam').addEventListener('click', () => { document.getElementById('p-prem').value=7200; document.getElementById('p-rx').value=1200; document.getElementById('p-den').value=800; document.getElementById('p-pad').value=3000; document.getElementById('p-off').value=2000; calc(); });
    document.getElementById('qa-sing').addEventListener('click', () => { document.getElementById('p-prem').value=1800; document.getElementById('p-rx').value=100; document.getElementById('p-den').value=150; document.getElementById('p-pad').value=500; document.getElementById('p-off').value=500; calc(); });
    document.getElementById('qa-hdhp').addEventListener('click', () => { document.getElementById('p-prem').value=1200; document.getElementById('p-rx').value=0; document.getElementById('p-den').value=100; document.getElementById('p-pad').value=4150; document.getElementById('p-off').value=1000; calc(); });
    document.getElementById('qa-gold').addEventListener('click', () => { document.getElementById('p-prem').value=6000; document.getElementById('p-rx').value=300; document.getElementById('p-den').value=300; document.getElementById('p-pad').value=500; document.getElementById('p-off').value=0; calc(); });
    document.getElementById('qa-med').addEventListener('click', () => { document.getElementById('p-prem').value=3600; document.getElementById('p-rx').value=2500; document.getElementById('p-den').value=600; document.getElementById('p-pad').value=1000; document.getElementById('p-off').value=0; calc(); });
    document.getElementById('qa-cob').addEventListener('click', () => { document.getElementById('p-prem').value=9500; document.getElementById('p-rx').value=500; document.getElementById('p-den').value=0; document.getElementById('p-pad').value=2500; document.getElementById('p-off').value=0; calc(); });

    calc();
});
</script>

