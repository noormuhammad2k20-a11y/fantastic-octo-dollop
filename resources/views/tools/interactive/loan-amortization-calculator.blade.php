<div class="interactive-tool-grid loan-amortization-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Loan Principal ($)</label>
                    <input type="number" id="prin" class="form-control-custom" value="250000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Interest Rate (%)</label>
                    <input type="number" id="rate" class="form-control-custom" value="5.5" step="0.1">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-2 border-bottom pb-2 mb-3">
                <h5 class="text-secondary mb-0">Loan Term Structure</h5>
                <div>
                    <button class="btn btn-sm btn-outline-secondary me-1" id="qa-30" style="min-width: 280px; max-width: 100%;">30 Yrs</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-15" style="min-width: 280px; max-width: 100%;">15 Yrs</button>
                </div>
            </div>

            <div class="form-group-custom mb-3">
                <label class="form-label-custom">Standard Term Length (Months)</label>
                <input type="number" id="term" class="form-control-custom" value="360" min="12" step="12">
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-4 border-bottom pb-2 mb-3">
                <h5 class="text-secondary mb-0">Extra Pre-Payments</h5>
                <div><button class="btn btn-sm btn-outline-success" id="qa-100" style="min-width: 280px; max-width: 100%;">+ $100/mo</button></div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Extra Monthly Addition</label>
                    <input type="number" id="ex-mo" class="form-control-custom text-success fw-bold" value="0" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Extra Annual Addition</label>
                    <input type="number" id="ex-yr" class="form-control-custom text-success fw-bold" value="0" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #14b8a6;">
            <span class="result-label">Base Monthly Payment</span>
            <h1 class="result-main-value" id="base-pay" style="color: #0f766e;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Original Total Interest</td><td class="text-end fw-semibold text-danger" id="orig-int">$0</td></tr>
                    <tr><td>New Total Interest</td><td class="text-end fw-semibold text-danger" id="new-int">$0</td></tr>
                    <tr><td class="pt-2 border-top">Total Interest Saved</td><td class="text-end pt-2 border-top fw-bold fs-5 text-success" id="int-saved">$0</td></tr>
                    <tr><td>Time Saved</td><td class="text-end fw-bold text-primary" id="time-saved">0 Months</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function pmt(rate, nper, pv) {
        if(rate===0) return pv/nper;
        return pv * rate / (1 - Math.pow(1 + rate, -nper));
    }
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const prin = parseFloat(document.getElementById('prin').value) || 0;
        const rate = (parseFloat(document.getElementById('rate').value) || 0) / 100 / 12;
        const term = parseInt(document.getElementById('term').value) || 1;
        const exMo = parseFloat(document.getElementById('ex-mo').value) || 0;
        const exYr = parseFloat(document.getElementById('ex-yr').value) || 0;
        
        const basePay = pmt(rate, term, prin);
        const origInt = (basePay * term) - prin;
        
        let newInt = 0;
        let bal = prin;
        let months = 0;
        
        if (basePay + exMo > 0) {
            while(bal > 0 && months < 1200) {
                months++;
                let i = bal * rate;
                newInt += i;
                bal -= (basePay - i + exMo);
                if (months % 12 === 0) bal -= exYr;
            }
        }
        
        const savedInt = origInt - newInt;
        const savedMonths = Math.max(0, term - months);
        
        try {
            document.getElementById('base-pay').innerText = format(basePay);
            document.getElementById('orig-int').innerText = format(origInt);
            document.getElementById('new-int').innerText = format(Math.max(0, newInt));
            document.getElementById('int-saved').innerText = format(savedInt);
            
            const yrs = Math.floor(savedMonths/12);
            const mos = savedMonths % 12;
            document.getElementById('time-saved').innerText = yrs > 0 ? `${yrs}y ${mos}m` : `${mos} Months`;
        } catch(e) {}
    }
    
    ['prin','rate','term','ex-mo','ex-yr'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    document.getElementById('qa-30').addEventListener('click', () => { document.getElementById('term').value = 360; calc(); });
    document.getElementById('qa-15').addEventListener('click', () => { document.getElementById('term').value = 180; calc(); });
    document.getElementById('qa-100').addEventListener('click', () => { 
        document.getElementById('ex-mo').value = (parseFloat(document.getElementById('ex-mo').value)||0) + 100; calc(); 
    });
    
    calc();
});
</script>

