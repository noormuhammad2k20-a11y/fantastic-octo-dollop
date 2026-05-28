@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid net-income-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Business Flow Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Standard Small Biz</button>
                    <button class="qa-btn-component qa-success" id="qa-saas" style="min-width: 280px; max-width: 100%;">SaaS (High Gross Margin)</button>
                    <button class="qa-btn-component qa-warning" id="qa-ecom" style="min-width: 280px; max-width: 100%;">Retail (High COGS)</button>
                    <button class="qa-btn-component qa-danger" id="qa-debt" style="min-width: 280px; max-width: 100%;">Debt Heavy (High Interest)</button>
                    <button class="qa-btn-component qa-info" id="qa-corp" style="min-width: 280px; max-width: 100%;">Corporate Tax Burden</button>
                    <button class="qa-btn-component qa-dark" id="qa-loss" style="min-width: 280px; max-width: 100%;">Operating Loss</button>
                </div>
            </div>

            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Top Line</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom text-success fw-bold">Gross Revenue</label>
                    <input type="number" id="rev" class="form-control-custom" value="250000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-danger">Cost of Goods Sold (COGS)</label>
                    <input type="number" id="cogs" class="form-control-custom" value="75000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Below the Line Deductions</h5>
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">Operating Expenses</label>
                    <input type="number" id="opex" class="form-control-custom" value="50000" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom">Interest Paid</label>
                    <input type="number" id="int" class="form-control-custom" value="5000" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom">Corporate Tax Rate (%)</label>
                    <input type="number" id="tax" class="form-control-custom" value="21" step="1" max="100">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Net Income (Bottom Line)</span>
                <span id="ni-badge" class="status-badge badge-optimal">Profitable</span>
            </div>
            <h1 class="result-main-value fs-1" id="ni" style="color: #047857;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Gross Profit</td><td class="text-end fw-semibold text-secondary" id="s-gp">$0</td></tr>
                    <tr><td>EBITDA (Operating Profit)</td><td class="text-end fw-semibold text-secondary" id="s-ebitda">$0</td></tr>
                    <tr><td>Pre-Tax Income (EBT)</td><td class="text-end fw-semibold text-secondary" id="s-ebt">$0</td></tr>
                    <tr><td class="pt-2 border-top">Actual Tax Burden</td><td class="text-end pt-2 border-top fw-bold text-danger fs-6" id="s-tax">-$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Net Profit Margin</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-margin" class="enhanced-progress-segment" style="background:#10b981; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-end mt-1" style="font-size:0.75rem; font-weight:bold; color:#10b981;" id="margin-val">
                20%
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }
    function calc() {
        const rev = parseFloat(document.getElementById('rev').value) || 0;
        const cogs = parseFloat(document.getElementById('cogs').value) || 0;
        const opex = parseFloat(document.getElementById('opex').value) || 0;
        const interest = parseFloat(document.getElementById('int').value) || 0;
        const taxRate = (parseFloat(document.getElementById('tax').value) || 0) / 100;

        const grossProfit = rev - cogs;
        const ebitda = grossProfit - opex; // Simple proxy
        const ebt = ebitda - interest;
        
        let taxes = 0;
        let netIncome = ebt;
        if(ebt > 0) {
            taxes = ebt * taxRate;
            netIncome = ebt - taxes;
        }

        const margin = rev > 0 ? (netIncome / rev) * 100 : 0;

        let badge = document.getElementById('ni-badge');
        let color = '#047857';
        if(netIncome < 0) { badge.innerText = "NET LOSS"; badge.className = "status-badge badge-critical"; color='#ef4444'; }
        else if (margin < 5) { badge.innerText = "RAZOR THIN"; badge.className = "status-badge badge-warning"; color='#f59e0b'; }
        else if (margin > 20) { badge.innerText = "HIGH MARGIN"; badge.className = "status-badge badge-optimal"; }
        else { badge.innerText = "HEALTHY"; badge.className = "status-badge badge-info"; color='#0ea5e9'; }

        try {
            document.getElementById('ni').innerText = (netIncome<0?'-':'') + format(Math.abs(netIncome));
            document.getElementById('ni').style.color = color;
            
            document.getElementById('s-gp').innerText = format(grossProfit);
            document.getElementById('s-ebitda').innerText = format(ebitda);
            document.getElementById('s-ebt').innerText = format(ebt);
            document.getElementById('s-tax').innerText = '-' + format(taxes);

            document.getElementById('margin-val').innerText = margin.toFixed(1) + '%';
            document.getElementById('margin-val').style.color = margin > 0 ? '#10b981' : '#ef4444';

            document.getElementById('bar-margin').style.width = Math.min(100, Math.max(0, margin)) + '%';
            document.getElementById('bar-margin').style.background = margin > 0 ? '#10b981' : 'transparent';
        } catch(e) {}
    }
    
    ['rev','cogs','opex','int','tax'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('rev').value=250000; document.getElementById('cogs').value=75000; document.getElementById('opex').value=50000; document.getElementById('int').value=5000; document.getElementById('tax').value=21; calc(); });
    document.getElementById('qa-saas').addEventListener('click', () => { document.getElementById('rev').value=500000; document.getElementById('cogs').value=50000; document.getElementById('opex').value=200000; document.getElementById('int').value=0; document.getElementById('tax').value=21; calc(); });
    document.getElementById('qa-ecom').addEventListener('click', () => { document.getElementById('rev').value=1000000; document.getElementById('cogs').value=600000; document.getElementById('opex').value=250000; document.getElementById('int').value=15000; document.getElementById('tax').value=21; calc(); });
    document.getElementById('qa-debt').addEventListener('click', () => { document.getElementById('rev').value=300000; document.getElementById('cogs').value=100000; document.getElementById('opex').value=100000; document.getElementById('int').value=80000; document.getElementById('tax').value=21; calc(); });
    document.getElementById('qa-corp').addEventListener('click', () => { document.getElementById('rev').value=2000000; document.getElementById('cogs').value=800000; document.getElementById('opex').value=400000; document.getElementById('int').value=20000; document.getElementById('tax').value=35; calc(); });
    document.getElementById('qa-loss').addEventListener('click', () => { document.getElementById('rev').value=150000; document.getElementById('cogs').value=80000; document.getElementById('opex').value=100000; document.getElementById('int').value=10000; document.getElementById('tax').value=21; calc(); });

    calc();
});
</script>

