@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid user-behavior-analyzer">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Engagement Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-app" style="min-width: 280px; max-width: 100%;">Daily App (High)</button>
                    <button class="qa-btn-component qa-warning" id="qa-util" style="min-width: 280px; max-width: 100%;">Utility Tool (Low)</button>
                    <button class="qa-btn-component qa-success" id="qa-sock" style="min-width: 280px; max-width: 100%;">Social Net (Viral)</button>
                    <button class="qa-btn-component qa-danger" id="qa-dead" style="min-width: 280px; max-width: 100%;">Dead Site</button>
                    <button class="qa-btn-component qa-info" id="qa-b2b" style="min-width: 280px; max-width: 100%;">B2B SaaS (Med)</button>
                    <button class="qa-btn-component qa-dark" id="qa-game" style="min-width: 280px; max-width: 100%;">Mobile Game</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-primary">Monthly Active Users (MAU)</label>
                    <input type="number" id="mau" class="form-control-custom fw-bold" value="100000" min="0">
                </div>
                <!-- DAU must be <= MAU -->
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-success">Daily Active Users (DAU)</label>
                    <input type="number" id="dau" class="form-control-custom fw-bold" value="20000" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Monthly Flows</h5>
            <div class="row">
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">New Signups This Month</label>
                    <input type="number" id="newu" class="form-control-custom" value="5000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-2">
                    <label class="form-label-custom">Dormant / Lost Users This Month</label>
                    <input type="number" id="lostu" class="form-control-custom text-danger" value="2500" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #8b5cf6;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">DAU/MAU Stickiness Ratio</span>
                <span id="behav-badge" class="status-badge badge-optimal">Standard</span>
            </div>
            <h1 class="result-main-value fs-1" id="stick" style="color: #6d28d9;">0%</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Net User Growth (MoM)</td><td class="text-end fw-bold fs-6" id="netg">0</td></tr>
                    <tr><td>Gross Churn Rate</td><td class="text-end fw-semibold text-danger" id="churn">0%</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">User Base Composition (End of Month)</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-ret" class="enhanced-progress-segment" style="background:#8b5cf6; width:80%;"></div>
                <div id="bar-new" class="enhanced-progress-segment" style="background:#10b981; width:20%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#8b5cf6;font-weight:bold;">Retained</span>
                <span style="color:#10b981;font-weight:bold;">New Users</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calc() {
        const mau = parseFloat(document.getElementById('mau').value) || 0;
        let d = parseFloat(document.getElementById('dau').value) || 0;

        if(d > mau && mau > 0) d = mau; // Prevent illogical input
        
        const newu = parseFloat(document.getElementById('newu').value) || 0;
        const lostu = parseFloat(document.getElementById('lostu').value) || 0;

        const stick = mau > 0 ? (d / mau) * 100 : 0;
        const netGrowth = newu - lostu;
        const churn = mau > 0 ? (lostu / mau) * 100 : 0;

        let badge = document.getElementById('behav-badge');
        if(stick > 40) { badge.innerText = "WORLD CLASS"; badge.className = "status-badge badge-optimal"; }
        else if(stick >= 20) { badge.innerText = "HEALTHY APP"; badge.className = "status-badge badge-info"; }
        else if (stick < 10) { badge.innerText = "LOW ENGAGEMENT"; badge.className = "status-badge badge-warning"; }
        else { badge.innerText = "AVERAGE"; badge.className = "status-badge badge-optimal"; }

        if (netGrowth < 0) { badge.innerText = "SHRINKING DANGER!"; badge.className = "status-badge badge-critical"; }

        try {
            document.getElementById('stick').innerText = stick.toFixed(1) + '%';
            
            let netObj = document.getElementById('netg');
            netObj.innerText = (netGrowth>=0?'+':'') + netGrowth.toLocaleString('en-US');
            netObj.style.color = netGrowth>=0 ? '#10b981' : '#ef4444';
            
            document.getElementById('churn').innerText = churn.toFixed(2) + '%';

            // Composition
            const eom = mau + netGrowth;
            if(eom > 0) {
                const pcNew = (newu / eom) * 100;
                const pcRet = 100 - pcNew;
                document.getElementById('bar-ret').style.width = pcRet + '%';
                document.getElementById('bar-new').style.width = pcNew + '%';
            }
        } catch(e) {}
    }
    
    ['mau','dau','newu','lostu'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-app').addEventListener('click', () => { document.getElementById('mau').value=10000; document.getElementById('dau').value=4500; document.getElementById('newu').value=1200; document.getElementById('lostu').value=300; calc(); });
    document.getElementById('qa-util').addEventListener('click', () => { document.getElementById('mau').value=50000; document.getElementById('dau').value=3000; document.getElementById('newu').value=2000; document.getElementById('lostu').value=1500; calc(); });
    document.getElementById('qa-sock').addEventListener('click', () => { document.getElementById('mau').value=1000000; document.getElementById('dau').value=650000; document.getElementById('newu').value=150000; document.getElementById('lostu').value=8000; calc(); });
    document.getElementById('qa-dead').addEventListener('click', () => { document.getElementById('mau').value=5000; document.getElementById('dau').value=150; document.getElementById('newu').value=10; document.getElementById('lostu').value=400; calc(); });
    document.getElementById('qa-b2b').addEventListener('click', () => { document.getElementById('mau').value=25000; document.getElementById('dau').value=5000; document.getElementById('newu').value=1000; document.getElementById('lostu').value=850; calc(); });
    document.getElementById('qa-game').addEventListener('click', () => { document.getElementById('mau').value=250000; document.getElementById('dau').value=80000; document.getElementById('newu').value=40000; document.getElementById('lostu').value=39000; calc(); });

    calc();
});
</script>

