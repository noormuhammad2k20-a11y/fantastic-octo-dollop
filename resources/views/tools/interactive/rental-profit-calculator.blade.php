<div class="interactive-tool-grid rental-profit-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Property Purchase Price ($)</label>
                    <input type="number" id="price" class="form-control-custom" value="250000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Monthly Gross Rent ($)</label>
                    <input type="number" id="rent" class="form-control-custom" value="2200" min="0">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3 border-top pt-3">
                <h5 class="text-secondary mb-0">Monthly Expenses (OpEx)</h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary" id="qa-50" style="min-width: 280px; max-width: 100%;">50% Rule</button>
                    <button class="btn btn-sm btn-outline-success ms-1" id="qa-clear" style="min-width: 280px; max-width: 100%;">Clear All</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Mortgage P&I ($)</label>
                    <input type="number" id="e-mort" class="form-control-custom e-val" value="1100" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Taxes & Insurance</label>
                    <input type="number" id="e-tax" class="form-control-custom e-val" value="300" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Property Mgmt (e.g. 10%)</label>
                    <input type="number" id="e-mgt" class="form-control-custom e-val" value="220" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Maintenance / CapEx</label>
                    <input type="number" id="e-maint" class="form-control-custom e-val" value="150" min="0">
                </div>
                <div class="col-12 form-group-custom mb-2">
                    <label class="form-label-custom">Vacancy Reserve ($)</label>
                    <input type="number" id="e-vac" class="form-control-custom e-val" value="110" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">Net Monthly Cash Flow</span>
            <h1 class="result-main-value" id="cash-flow" style="color: #047857;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Monthly Income</td><td class="text-end fw-semibold text-success" id="tot-inc">$0</td></tr>
                    <tr><td>Total Monthly Expenses</td><td class="text-end fw-semibold text-danger" id="tot-exp">-$0</td></tr>
                    <tr><td class="pt-2 border-top">Capitalization Rate (Cap Rate)</td><td class="text-end pt-2 border-top fw-bold text-primary" id="cap-rate">0%</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    function calc() {
        const price = parseFloat(document.getElementById('price').value) || 0;
        const rent = parseFloat(document.getElementById('rent').value) || 0;
        
        let exp = 0;
        document.querySelectorAll('.e-val').forEach(el => exp += (parseFloat(el.value)||0));
        
        const cf = rent - exp;
        
        // Cap Rate = NOI / Price
        // NOI = (Rent - Expenses EXCLUDING Mortgage P&I) * 12
        const pni = parseFloat(document.getElementById('e-mort').value) || 0;
        const opex = exp - pni;
        const noi = (rent - opex) * 12;
        
        let cap = price > 0 ? (noi / price) * 100 : 0;
        
        try {
            document.getElementById('cash-flow').innerText = (cf < 0 ? '-' : '') + format(Math.abs(cf));
            document.getElementById('cash-flow').style.color = cf >= 0 ? '#047857' : '#ef4444';
            
            document.getElementById('tot-inc').innerText = format(rent);
            document.getElementById('tot-exp').innerText = '-' + format(exp);
            document.getElementById('cap-rate').innerText = cap.toFixed(2) + '%';
        } catch(e) {}
    }
    
    ['price','rent'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    document.querySelectorAll('.e-val').forEach(inp => inp.addEventListener('input', calc));
    
    document.getElementById('qa-50').addEventListener('click', () => { 
        const rent = parseFloat(document.getElementById('rent').value) || 0;
        document.getElementById('e-tax').value = 0;
        document.getElementById('e-mgt').value = 0;
        document.getElementById('e-maint').value = rent * 0.50; // The 50% rule blankets all opex
        document.getElementById('e-vac').value = 0;
        calc(); 
    });
    
    document.getElementById('qa-clear').addEventListener('click', () => {
        document.querySelectorAll('.e-val').forEach(el => el.value = 0);
        calc();
    });
    
    calc();
});
</script>

