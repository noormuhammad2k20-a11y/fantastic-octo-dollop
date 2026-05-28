@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid traffic-revenue-tool">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Monetization Models</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-adsh" style="min-width: 280px; max-width: 100%;">AdSense (Low RPM)</button>
                    <button class="qa-btn-component qa-success" id="qa-medv" style="min-width: 280px; max-width: 100%;">Mediavine/Premium</button>
                    <button class="qa-btn-component qa-warning" id="qa-vids" style="min-width: 280px; max-width: 100%;">Video Header Bidding</button>
                    <button class="qa-btn-component qa-danger" id="qa-tier3" style="min-width: 280px; max-width: 100%;">Tier 3 Traffic (Geo)</button>
                    <button class="qa-btn-component qa-info" id="qa-fin" style="min-width: 280px; max-width: 100%;">Finance Niche (High RPM)</button>
                    <button class="qa-btn-component qa-dark" id="qa-vol" style="min-width: 280px; max-width: 100%;">Massive Volume</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Monthly Page Views</label>
                    <input type="number" id="pv" class="form-control-custom fw-bold fs-5 text-primary" value="50000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Ad Impressions per PV</label>
                    <input type="number" id="imp" class="form-control-custom" value="2.5" step="0.5">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-success fw-bold">Effective RPM ($ per 1k views)</label>
                    <input type="number" id="rpm" class="form-control-custom" value="15.00" step="0.25">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #eab308;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Est. Display Ad Revenue (Mo)</span>
                <span id="rpm-badge" class="status-badge badge-optimal">Healthy</span>
            </div>
            <h1 class="result-main-value fs-1" id="rev" style="color: #ca8a04;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Ad Impressions Handled</td><td class="text-end fw-semibold text-secondary" id="s-imp">0</td></tr>
                    <tr><td>Calculated Page RPM (PRPM)</td><td class="text-end fw-bold text-success fs-6" id="s-prpm">$0</td></tr>
                </table>
            </div>

            <div class="alert mt-3 text-center border-0 p-2 rounded fw-bold" id="rpm-msg" style="font-size: 0.8rem; background: #fef9c3; color: #854d0e;">
                RPM (Revenue Per Mille) is the metric that dictates your raw publishing value.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }
    function calc() {
        const pv = parseFloat(document.getElementById('pv').value) || 0;
        const impRatio = parseFloat(document.getElementById('imp').value) || 0;
        const rpm = parseFloat(document.getElementById('rpm').value) || 0;

        const rev = (pv / 1000) * rpm;
        const totalImp = pv * impRatio;
        const prpm = pv > 0 ? (rev / pv) * 1000 : 0; // Page RPM

        let badge = document.getElementById('rpm-badge');
        let msg = document.getElementById('rpm-msg');
        
        if (rpm < 3) { badge.innerText = "LOW TIER RPM"; badge.className = "status-badge badge-critical"; msg.innerText="Traffic is largely unmonetizable."; msg.style.background="#fee2e2"; msg.style.color="#991b1b"; }
        else if (rpm < 10) { badge.innerText = "BASIC ADS"; badge.className = "status-badge badge-warning"; msg.innerText="Standard Google AdSense tier."; msg.style.background="#fef3c7"; msg.style.color="#92400e"; }
        else if (rpm < 30) { badge.innerText = "PREMIUM ADS"; badge.className = "status-badge badge-info"; msg.innerText="Mediavine/Raptive tier."; msg.style.background="#e0f2fe"; msg.style.color="#075985"; }
        else { badge.innerText = "ELITE FIN/TECH"; badge.className = "status-badge badge-optimal"; msg.innerText="Incredible RPMs. Highly lucrative niche."; msg.style.background="#dcfce7"; msg.style.color="#166534"; }

        try {
            document.getElementById('rev').innerText = format(rev);
            document.getElementById('s-imp').innerText = Math.floor(totalImp).toLocaleString('en-US');
            document.getElementById('s-prpm').innerText = format(prpm);
        } catch(e) {}
    }
    
    ['pv','imp','rpm'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-adsh').addEventListener('click', () => { document.getElementById('pv').value=250000; document.getElementById('imp').value=3; document.getElementById('rpm').value=2.50; calc(); });
    document.getElementById('qa-medv').addEventListener('click', () => { document.getElementById('pv').value=85000; document.getElementById('imp').value=4; document.getElementById('rpm').value=18.50; calc(); });
    document.getElementById('qa-vids').addEventListener('click', () => { document.getElementById('pv').value=150000; document.getElementById('imp').value=5; document.getElementById('rpm').value=28.00; calc(); });
    document.getElementById('qa-tier3').addEventListener('click', () => { document.getElementById('pv').value=500000; document.getElementById('imp').value=2; document.getElementById('rpm').value=0.85; calc(); });
    document.getElementById('qa-fin').addEventListener('click', () => { document.getElementById('pv').value=30000; document.getElementById('imp').value=3; document.getElementById('rpm').value=45.00; calc(); });
    document.getElementById('qa-vol').addEventListener('click', () => { document.getElementById('pv').value=2000000; document.getElementById('imp').value=3; document.getElementById('rpm').value=6.50; calc(); });

    calc();
});
</script>

