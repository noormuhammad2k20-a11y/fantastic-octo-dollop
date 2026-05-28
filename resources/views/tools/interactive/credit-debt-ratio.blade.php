@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid credit-debt-ratio">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Applicant Scenarios</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-optimal" style="min-width: 280px; max-width: 100%; background:#10b981;color:#fff;border:none;" id="qa-prime">Prime Buyer (0 Debt)</button>
                    <button class="qa-btn-component qa-primary" id="qa-avg" style="min-width: 280px; max-width: 100%;">Average Consumer</button>
                    <button class="qa-btn-component qa-warning" id="qa-heavy" style="min-width: 280px; max-width: 100%;">Heavy Car Loan</button>
                    <button class="qa-btn-component qa-danger" id="qa-deny" style="min-width: 280px; max-width: 100%;">High Risk (Likely Denied)</button>
                    <button class="qa-btn-component qa-info" id="qa-student" style="min-width: 280px; max-width: 100%;">Student Loans Heavy</button>
                    <button class="qa-btn-component qa-dark" id="qa-biz" style="min-width: 280px; max-width: 100%;">Business Owner</button>
                </div>
            </div>

            <div class="row">
                <h5 class="col-12 text-secondary mb-2">Monthly Gross Income (Pre-Tax)</h5>
                <div class="col-md-6 form-group-custom mb-3 border-start border-3 border-success">
                    <label class="form-label-custom text-success fw-bold">Primary Income ($)</label>
                    <input type="number" id="inc1" class="form-control-custom fw-bold fs-5" value="6000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Co-Borrower / Side Hustle ($)</label>
                    <input type="number" id="inc2" class="form-control-custom" value="2000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Monthly Debt Obligations</h5>
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2 border-start border-3 border-danger">
                    <label class="form-label-custom text-danger">Credit Card Mins ($)</label>
                    <input type="number" id="cc" class="form-control-custom" value="250" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">Auto Loans ($)</label>
                    <input type="number" id="auto" class="form-control-custom" value="500" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">Student/Other ($)</label>
                    <input type="number" id="oth" class="form-control-custom" value="350" min="0">
                </div>
                <div class="col-md-12 form-group-custom mb-2 mt-2 pt-2 border-top">
                    <label class="form-label-custom text-primary fw-bold">Proposed New Mortgage PITI ($)</label>
                    <input type="number" id="mort" class="form-control-custom" value="2200" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f43f5e;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Front-End / Back-End DTI</span>
                <span id="dti-badge" class="status-badge badge-warning">Elevated Risk</span>
            </div>
            <h1 class="result-main-value fs-2" id="dtis" style="color: #be123c;">0% / 0%</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Monthly Income</td><td class="text-end fw-semibold text-secondary" id="s-inc">$0</td></tr>
                    <tr><td>Total Monthly Debt</td><td class="text-end fw-bold text-danger fs-6" id="s-debt">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Back-End DTI Pressure (Target < 43%)</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-dti" class="enhanced-progress-segment" style="background:#10b981; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#64748b;font-weight:bold;">0%</span>
                <span style="color:#ef4444;font-weight:bold;">50%+ Denial Zone</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:0}); }
    
    function calc() {
        const inc = (parseFloat(document.getElementById('inc1').value)||0) + (parseFloat(document.getElementById('inc2').value)||0);
        
        const cc = parseFloat(document.getElementById('cc').value)||0;
        const auto = parseFloat(document.getElementById('auto').value)||0;
        const oth = parseFloat(document.getElementById('oth').value)||0;
        const mort = parseFloat(document.getElementById('mort').value)||0;

        const totalDebt = cc + auto + oth + mort;

        let frontdti = inc > 0 ? (mort / inc) * 100 : 0;
        let backdti = inc > 0 ? (totalDebt / inc) * 100 : 0;

        let badge = document.getElementById('dti-badge');
        let color = '#be123c';
        let barColor = '#10b981';

        if (backdti > 50) { badge.innerText = "DENIAL LIKELY (>50%)"; badge.className = "status-badge badge-critical"; color='#ef4444'; barColor='#ef4444'; }
        else if (backdti > 43) { badge.innerText = "HIGH DTI RISK"; badge.className = "status-badge badge-danger"; color='#ea580c'; barColor='#ea580c'; }
        else if (backdti > 36) { badge.innerText = "ELEVATED (FAIR)"; badge.className = "status-badge badge-warning"; color='#f59e0b'; barColor='#f59e0b'; }
        else if (backdti > 20) { badge.innerText = "CONFORMING SAFELY"; badge.className = "status-badge badge-info"; color='#0ea5e9'; barColor='#0ea5e9'; }
        else { badge.innerText = "EXCELLENT STANDING"; badge.className = "status-badge badge-optimal"; color='#047857'; }

        try {
            document.getElementById('dtis').innerText = frontdti.toFixed(1) + '% / ' + backdti.toFixed(1) + '%';
            document.getElementById('dtis').style.color = color;
            
            document.getElementById('s-inc').innerText = format(inc);
            document.getElementById('s-debt').innerText = format(totalDebt);

            let wDti = Math.min(100, (backdti / 50) * 100);
            if (backdti > 50) wDti = 100;
            
            document.getElementById('bar-dti').style.width = wDti + '%';
            document.getElementById('bar-dti').style.background = barColor;
        } catch(e) {}
    }
    
    ['inc1','inc2','cc','auto','oth','mort'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-prime').addEventListener('click', () => { document.getElementById('inc1').value=8000; document.getElementById('inc2').value=4000; document.getElementById('cc').value=0; document.getElementById('auto').value=0; document.getElementById('oth').value=0; document.getElementById('mort').value=2500; calc(); });
    document.getElementById('qa-avg').addEventListener('click', () => { document.getElementById('inc1').value=5000; document.getElementById('inc2').value=2000; document.getElementById('cc').value=250; document.getElementById('auto').value=400; document.getElementById('oth').value=150; document.getElementById('mort').value=1800; calc(); });
    document.getElementById('qa-heavy').addEventListener('click', () => { document.getElementById('inc1').value=6000; document.getElementById('inc2').value=0; document.getElementById('cc').value=300; document.getElementById('auto').value=1200; document.getElementById('oth').value=0; document.getElementById('mort').value=1800; calc(); });
    document.getElementById('qa-deny').addEventListener('click', () => { document.getElementById('inc1').value=4500; document.getElementById('inc2').value=0; document.getElementById('cc').value=600; document.getElementById('auto').value=550; document.getElementById('oth').value=200; document.getElementById('mort').value=2200; calc(); });
    document.getElementById('qa-student').addEventListener('click', () => { document.getElementById('inc1').value=9000; document.getElementById('inc2').value=0; document.getElementById('cc').value=100; document.getElementById('auto').value=450; document.getElementById('oth').value=1200; document.getElementById('mort').value=2800; calc(); });
    document.getElementById('qa-biz').addEventListener('click', () => { document.getElementById('inc1').value=15000; document.getElementById('inc2').value=0; document.getElementById('cc').value=1500; document.getElementById('auto').value=800; document.getElementById('oth').value=0; document.getElementById('mort').value=4500; calc(); });

    calc();
});
</script>

