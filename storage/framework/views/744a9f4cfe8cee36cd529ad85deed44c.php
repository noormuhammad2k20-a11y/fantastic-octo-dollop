<div class="interactive-tool-grid lease-buy-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Deal Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-success" id="qa-buy" style="min-width: 280px; max-width: 100%;">Standard Buy</button>
                    <button class="btn btn-sm btn-outline-primary" id="qa-lease" style="min-width: 280px; max-width: 100%;">Standard Lease</button>
                    <button class="btn btn-sm btn-outline-danger" id="qa-0lease" style="min-width: 280px; max-width: 100%;">Zero Down Lease</button>
                    <button class="btn btn-sm btn-outline-warning" id="qa-72" style="min-width: 280px; max-width: 100%;">72-Mo Buy</button>
                    <button class="btn btn-sm btn-outline-secondary" id="qa-over" style="min-width: 280px; max-width: 100%;">Mileage Over-Limit</button>
                    <button class="btn btn-sm btn-outline-dark" id="qa-keep" style="min-width: 280px; max-width: 100%;">Keep 10 Years</button>
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group-custom mb-3 border-bottom pb-3">
                    <label class="form-label-custom">Term of Comparison (Months)</label>
                    <input type="number" id="term" class="form-control-custom fw-bold text-center" value="36" min="12" step="12">
                </div>
            </div>

            <div class="row">
                <!-- BUY SIDE -->
                <div class="col-md-6 border-end pe-3">
                    <h5 class="text-primary mb-3">Buying (Financing)</h5>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Vehicle MSRP ($)</label>
                        <input type="number" id="b-price" class="form-control-custom" value="35000" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Down Payment ($)</label>
                        <input type="number" id="b-down" class="form-control-custom" value="5000" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Interest Rate / APR (%)</label>
                        <input type="number" id="b-rate" class="form-control-custom" value="6.5" step="0.1">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Est. Resale Value at Term End ($)</label>
                        <input type="number" id="b-resale" class="form-control-custom" value="20000" min="0">
                    </div>
                </div>

                <!-- LEASE SIDE -->
                <div class="col-md-6 ps-3">
                    <h5 class="text-secondary mb-3">Leasing</h5>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Capitalized Cost (Lease Price)</label>
                        <input type="number" id="l-price" class="form-control-custom" value="34000" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Due at Signing / Down ($)</label>
                        <input type="number" id="l-down" class="form-control-custom" value="3000" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Monthly Lease Payment ($)</label>
                        <input type="number" id="l-pmt" class="form-control-custom" value="450" min="0">
                    </div>
                    <div class="form-group-custom mb-2">
                        <label class="form-label-custom">Turn-in/Mileage Penalty Est ($)</label>
                        <input type="number" id="l-pen" class="form-control-custom text-danger" value="400" min="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <span class="result-label">Net Cost Over Term</span>
            <h1 class="result-main-value" id="winner" style="color: #047857;">Buying is cheaper by $0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Out of pocket (Buy)</td><td class="text-end fw-semibold text-primary" id="o-buy">$0</td></tr>
                    <tr><td>Minus Equity (Resale minus Load Bal)</td><td class="text-end fw-semibold text-success" id="eq-buy">+$0</td></tr>
                    <tr><td class="pt-2 border-top">True Net Cost to Buy</td><td class="text-end pt-2 border-top fw-bold fs-6 text-dark" id="net-buy">$0</td></tr>
                </table>
                
                <table class="table table-sm table-borderless summary-table mt-3">
                    <tr><td>Total Out of pocket (Lease)</td><td class="text-end fw-semibold text-secondary" id="o-lease">$0</td></tr>
                    <tr><td>Plus End-of-Lease Penalties</td><td class="text-end fw-semibold text-danger" id="eq-lease">-$0</td></tr>
                    <tr><td class="pt-2 border-top">True Net Cost to Lease</td><td class="text-end pt-2 border-top fw-bold fs-6 text-dark" id="net-lease">$0</td></tr>
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
        const term = parseInt(document.getElementById('term').value) || 12;
        
        // Buy math
        const bp = parseFloat(document.getElementById('b-price').value) || 0;
        const bd = parseFloat(document.getElementById('b-down').value) || 0;
        const br = (parseFloat(document.getElementById('b-rate').value) || 0) / 100 / 12;
        const bResale = parseFloat(document.getElementById('b-resale').value) || 0;
        
        const bLoan = Math.max(0, bp - bd);
        const bMo = pmt(br, term, bLoan);
        const outBuy = bd + (bMo * term);
        // at end of term, loan is $0 if we bought it FOR that term.
        const netBuy = outBuy - bResale;
        
        // Lease math
        const ld = parseFloat(document.getElementById('l-down').value) || 0;
        const lMo = parseFloat(document.getElementById('l-pmt').value) || 0;
        const lPen = parseFloat(document.getElementById('l-pen').value) || 0;
        
        const outLease = ld + (lMo * term);
        const netLease = outLease + lPen;
        
        const diff = Math.abs(netBuy - netLease);
        const winWord = netBuy < netLease ? "Buying" : "Leasing";
        
        try {
            document.getElementById('o-buy').innerText = format(outBuy);
            document.getElementById('eq-buy').innerText = '+' + format(bResale);
            document.getElementById('net-buy').innerText = format(netBuy);
            
            document.getElementById('o-lease').innerText = format(outLease);
            document.getElementById('eq-lease').innerText = '-' + format(lPen);
            document.getElementById('net-lease').innerText = format(netLease);
            
            document.getElementById('winner').innerText = `${winWord} is cheaper by ${format(diff)}`;
        } catch(e) {}
    }
    
    ['term','b-price','b-down','b-rate','b-resale','l-price','l-down','l-pmt','l-pen'].forEach(id => document.getElementById(id).addEventListener('input', calc));
    
    document.getElementById('qa-buy').addEventListener('click', () => { document.getElementById('b-down').value=5000; calc(); });
    document.getElementById('qa-lease').addEventListener('click', () => { document.getElementById('l-down').value=3000; document.getElementById('l-pen').value=400; calc(); });
    document.getElementById('qa-0lease').addEventListener('click', () => { document.getElementById('l-down').value=0; document.getElementById('l-pmt').value=540; calc(); });
    document.getElementById('qa-72').addEventListener('click', () => { document.getElementById('term').value=72; document.getElementById('b-resale').value=12000; calc(); });
    document.getElementById('qa-over').addEventListener('click', () => { document.getElementById('l-pen').value=2500; calc(); });
    document.getElementById('qa-keep').addEventListener('click', () => { document.getElementById('term').value=120; document.getElementById('b-resale').value=5000; calc(); });
    
    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\lease-buy-calculator.blade.php ENDPATH**/ ?>