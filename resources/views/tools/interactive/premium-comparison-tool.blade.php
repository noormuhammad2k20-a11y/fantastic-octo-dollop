<div class="interactive-tool-grid premium-comparison-tool">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Medical Cost Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-0" style="min-width: 280px; max-width: 100%;">Zero Medical ($0)</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-500" style="min-width: 280px; max-width: 100%;">Healthy Year ($500)</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-2k" style="min-width: 280px; max-width: 100%;">Average ($2,000)</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-5k" style="min-width: 280px; max-width: 100%;">Chronic ($5,000)</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-20k" style="min-width: 280px; max-width: 100%;">Surgery ($20,000)</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-100k" style="min-width: 280px; max-width: 100%;">Catastrophic ($100k)</button>
                </div>
            </div>

            <div class="form-group-custom mb-3 border-bottom pb-4">
                <label class="form-label-custom text-primary fs-5">Expected Annual Medical Bills (Gross $)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                    <input type="number" id="med" class="form-control-custom fs-5" value="2000" min="0">
                </div>
            </div>

            <div class="row">
                <!-- PLAN A -->
                <div class="col-md-6 border-end pe-3">
                    <h5 class="text-danger mb-3">Plan A (HDHP)</h5>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Monthly Premium ($)</label>
                        <input type="number" id="a-prem" class="form-control-custom" value="150" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Annual Deductible ($)</label>
                        <input type="number" id="a-ded" class="form-control-custom" value="4000" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Out of Pocket Max ($)</label>
                        <input type="number" id="a-oop" class="form-control-custom" value="7500" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Co-Insurance (%)</label>
                        <input type="number" id="a-coin" class="form-control-custom" value="30" min="0" max="100">
                    </div>
                </div>

                <!-- PLAN B -->
                <div class="col-md-6 ps-3">
                    <h5 class="text-success mb-3">Plan B (PPO)</h5>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Monthly Premium ($)</label>
                        <input type="number" id="b-prem" class="form-control-custom" value="450" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Annual Deductible ($)</label>
                        <input type="number" id="b-ded" class="form-control-custom" value="500" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Out of Pocket Max ($)</label>
                        <input type="number" id="b-oop" class="form-control-custom" value="3500" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Co-Insurance (%)</label>
                        <input type="number" id="b-coin" class="form-control-custom" value="10" min="0" max="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #0ea5e9;">
            <span class="result-label">The Cheaper Plan is</span>
            <h1 class="result-main-value fs-2" id="winner" style="color: #0369a1;">Plan A by $0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td><strong class="text-danger">Plan A</strong> Annual Prem. Sink</td><td class="text-end fw-semibold text-danger" id="a-p-sink">$0</td></tr>
                    <tr><td><strong class="text-danger">Plan A</strong> OOP Medical Paid</td><td class="text-end fw-semibold text-danger" id="a-m-sink">+$0</td></tr>
                    <tr><td class="pt-2 border-top">Plan A True Annual Cost</td><td class="text-end pt-2 border-top fw-bold text-dark fs-6" id="a-tot">$0</td></tr>
                </table>
                
                <table class="table table-sm table-borderless summary-table mt-4">
                    <tr><td><strong class="text-success">Plan B</strong> Annual Prem. Sink</td><td class="text-end fw-semibold text-success" id="b-p-sink">$0</td></tr>
                    <tr><td><strong class="text-success">Plan B</strong> OOP Medical Paid</td><td class="text-end fw-semibold text-success" id="b-m-sink">+$0</td></tr>
                    <tr><td class="pt-2 border-top">Plan B True Annual Cost</td><td class="text-end pt-2 border-top fw-bold text-dark fs-6" id="b-tot">$0</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calcOOP(med, ded, oopm, coinPct) {
        let oop = 0;
        let appliedDed = Math.min(med, ded);
        oop += appliedDed;
        
        let rem = Math.max(0, med - appliedDed);
        oop += (rem * coinPct);
        
        if (oop > oopm) oop = oopm;
        return oop;
    }
    
    function calc() {
        const med = parseFloat(document.getElementById('med').value) || 0;
        
        const ap = (parseFloat(document.getElementById('a-prem').value) || 0) * 12;
        const ad = parseFloat(document.getElementById('a-ded').value) || 0;
        const ao = parseFloat(document.getElementById('a-oop').value) || 0;
        const ac = (parseFloat(document.getElementById('a-coin').value) || 0) / 100;
        
        const bp = (parseFloat(document.getElementById('b-prem').value) || 0) * 12;
        const bd = parseFloat(document.getElementById('b-ded').value) || 0;
        const bo = parseFloat(document.getElementById('b-oop').value) || 0;
        const bc = (parseFloat(document.getElementById('b-coin').value) || 0) / 100;
        
        const aMeds = calcOOP(med, ad, ao, ac);
        const bMeds = calcOOP(med, bd, bo, bc);
        
        const aTot = ap + aMeds;
        const bTot = bp + bMeds;
        
        const diff = Math.abs(aTot - bTot);
        let win = "";
        if(aTot < bTot) win = `Plan A by ${format(diff)}`;
        else if (bTot < aTot) win = `Plan B by ${format(diff)}`;
        else win = "Exact Tie!";
        
        try {
            document.getElementById('winner').innerText = win;
            
            document.getElementById('a-p-sink').innerText = format(ap);
            document.getElementById('a-m-sink').innerText = '+' + format(aMeds);
            document.getElementById('a-tot').innerText = format(aTot);
            
            document.getElementById('b-p-sink').innerText = format(bp);
            document.getElementById('b-m-sink').innerText = '+' + format(bMeds);
            document.getElementById('b-tot').innerText = format(bTot);
        } catch(e) {}
    }
    
    ['med','a-prem','a-ded','a-oop','a-coin','b-prem','b-ded','b-oop','b-coin'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    // Quick Actions
    document.getElementById('qa-0').addEventListener('click', () => { document.getElementById('med').value=0; calc(); });
    document.getElementById('qa-500').addEventListener('click', () => { document.getElementById('med').value=500; calc(); });
    document.getElementById('qa-2k').addEventListener('click', () => { document.getElementById('med').value=2000; calc(); });
    document.getElementById('qa-5k').addEventListener('click', () => { document.getElementById('med').value=5000; calc(); });
    document.getElementById('qa-20k').addEventListener('click', () => { document.getElementById('med').value=20000; calc(); });
    document.getElementById('qa-100k').addEventListener('click', () => { document.getElementById('med').value=100000; calc(); });
    
    calc();
});
</script>

