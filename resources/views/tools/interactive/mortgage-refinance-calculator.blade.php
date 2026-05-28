<div class="interactive-tool-grid mortgage-refinance-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-secondary mb-0">Current Loan Profile</h5>
                <div><button class="btn btn-sm btn-outline-primary" id="qa-drop" style="min-width: 280px; max-width: 100%;"><i class="fas fa-arrow-down"></i> Test -1% Rate Drop</button></div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Current Principal Balance ($)</label>
                    <input type="number" id="bal" class="form-control-custom" value="350000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Current Interest Rate (%)</label>
                    <input type="number" id="r-old" class="form-control-custom" value="6.5" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Remaining Term (Months)</label>
                    <input type="number" id="t-old" class="form-control-custom" value="280">
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-3 mb-3">
                <h5 class="text-secondary mb-0">New Refinance Loan</h5>
                <div><button class="btn btn-sm btn-outline-success" id="qa-zero" style="min-width: 280px; max-width: 100%;">Zero Closing Costs</button></div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">New Interest Rate (%)</label>
                    <input type="number" id="r-new" class="form-control-custom" value="5.5" step="0.1">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">New Term (Months)</label>
                    <input type="number" id="t-new" class="form-control-custom" value="360">
                </div>
                <div class="col-12 form-group-custom mb-2">
                    <label class="form-label-custom text-danger">Estimated Closing Costs & Fees ($)</label>
                    <input type="number" id="fees" class="form-control-custom" value="6000" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #2563eb;">
            <span class="result-label">Break-Even Point</span>
            <h1 class="result-main-value" id="breakeven" style="color: #1e40af;">0 Months</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Monthly Payment Saving</td><td class="text-end fw-bold text-success" id="diff-pay">$0</td></tr>
                    <tr><td>Lifetime Interest Saved</td><td class="text-end fw-bold text-primary" id="diff-int">$0</td></tr>
                </table>
            </div>
            <div class="alert mt-3 text-center border-0 p-2 rounded" id="alert-box"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function pmt(rate, nper, pv) {
        if(rate===0) return pv/nper;
        return pv * rate / (1 - Math.pow(1 + rate, -nper));
    }
    function format(n) { return '$' + Math.abs(n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const bal = parseFloat(document.getElementById('bal').value) || 0;
        const r_old = (parseFloat(document.getElementById('r-old').value) || 0) / 100 / 12;
        const t_old = parseInt(document.getElementById('t-old').value) || 1;
        
        const r_new = (parseFloat(document.getElementById('r-new').value) || 0) / 100 / 12;
        const t_new = parseInt(document.getElementById('t-new').value) || 1;
        const fees = parseFloat(document.getElementById('fees').value) || 0;
        
        const pay_old = pmt(r_old, t_old, bal);
        const pay_new = pmt(r_new, t_new, bal); // assuming out of pocket fees, not rolled into loan for simple math
        
        const m_saving = pay_old - pay_new;
        let be = 0;
        if(m_saving > 0) be = fees / m_saving;
        else be = Infinity; // Negative savings = never break even
        
        const int_old = (pay_old * t_old) - bal;
        const int_new = (pay_new * t_new) - bal + fees; // fees added to mathematical cost of new loan
        
        const total_saved = int_old - int_new;
        
        try {
            if(be === Infinity || be < 0) {
                document.getElementById('breakeven').innerText = "Never";
                document.getElementById('breakeven').style.color = "#ef4444";
                document.getElementById('alert-box').innerText = "Refinancing increases your monthly payment. Usually a bad idea unless accessing equity.";
                document.getElementById('alert-box').className = "alert bg-danger text-white mt-3 text-center border-0 p-2 rounded";
            } else {
                const yrs = (be/12).toFixed(1);
                document.getElementById('breakeven').innerText = `${Math.ceil(be)} Months (${yrs} Yrs)`;
                document.getElementById('breakeven').style.color = "#1e40af";
                if(total_saved > 0) {
                    document.getElementById('alert-box').innerText = "Good Refi! If you plan to stay in the home longer than the breakeven point, do it.";
                    document.getElementById('alert-box').className = "alert bg-success text-white mt-3 text-center border-0 p-2 rounded";
                } else {
                    document.getElementById('alert-box').innerText = "Warning: Modest monthly savings, but you will pay MORE total interest over the life of the loan due to the term reset.";
                    document.getElementById('alert-box').className = "alert bg-warning text-dark mt-3 text-center border-0 p-2 rounded";
                }
            }
            
            document.getElementById('diff-pay').innerText = (m_saving >= 0 ? '+' : '-') + format(m_saving);
            document.getElementById('diff-pay').style.color = m_saving >= 0 ? '#10b981' : '#ef4444';
            
            document.getElementById('diff-int').innerText = (total_saved >= 0 ? '+' : '-') + format(total_saved);
            document.getElementById('diff-int').style.color = total_saved >= 0 ? '#1e40af' : '#ef4444';
        } catch(e) {}
    }
    
    ['bal','r-old','t-old','r-new','t-new','fees'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    document.getElementById('qa-drop').addEventListener('click', () => {
        let r = parseFloat(document.getElementById('r-old').value) || 0;
        document.getElementById('r-new').value = Math.max(0.1, r - 1.0);
        calc();
    });
    
    document.getElementById('qa-zero').addEventListener('click', () => {
        document.getElementById('fees').value = 0;
        calc();
    });
    
    calc();
});
</script>

