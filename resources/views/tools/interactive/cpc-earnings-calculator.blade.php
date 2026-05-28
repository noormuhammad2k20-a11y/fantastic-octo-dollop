@push('styles')
<link href="{{ asset('css/interactive-tools.css') }}" rel="stylesheet">
@endpush

<div class="interactive-tool-grid cpc-earnings-calculator">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Ad Placements</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-std" style="min-width: 280px; max-width: 100%;">Sidebar Native (1%)</button>
                    <button class="qa-btn-component qa-success" id="qa-high" style="min-width: 280px; max-width: 100%;">In-Article (High CTR)</button>
                    <button class="qa-btn-component qa-danger" id="qa-junk" style="min-width: 280px; max-width: 100%;">Footer Junk (0.1%)</button>
                    <button class="qa-btn-component qa-warning" id="qa-fin" style="min-width: 280px; max-width: 100%;">Finance CPC ($2.50)</button>
                    <button class="qa-btn-component qa-info" id="qa-tech" style="min-width: 280px; max-width: 100%;">Tech CPC ($1.20)</button>
                    <button class="qa-btn-component qa-dark" id="qa-ent" style="min-width: 280px; max-width: 100%;">Entertainment ($0.15)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom mb-3">
                    <label class="form-label-custom border-bottom pb-1">Total Ad Impressions</label>
                    <input type="number" id="imp" class="form-control-custom fw-bold fs-5 text-primary" value="100000" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Click Through Rate (CTR %)</label>
                    <input type="number" id="ctr" class="form-control-custom text-primary" value="2.5" step="0.1" max="100">
                </div>
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom text-success fw-bold">Cost Per Click (CPC $) <br><small class="fw-normal text-muted">(What advertisers pay)</small></label>
                    <input type="number" id="cpc" class="form-control-custom" value="0.75" step="0.10">
                </div>
            </div>

            <div class="form-group-custom border-top pt-3 mt-1">
                <label class="form-label-custom fs-6">Platform Revenue Share (%) <small class="text-muted">(e.g., AdSense takes 32%, you get 68%)</small></label>
                <input type="number" id="share" class="form-control-custom text-muted" value="68" min="0" max="100">
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #f97316;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Net Publisher Earnings</span>
                <span id="cpc-badge" class="status-badge badge-optimal">Calculated</span>
            </div>
            <h1 class="result-main-value fs-1" id="net" style="color: #c2410c;">$0</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Total Ad Clicks Generated</td><td class="text-end fw-semibold text-secondary" id="s-clicks">0</td></tr>
                    <tr><td>Gross Ad Spend (Advertiser Cost)</td><td class="text-end fw-bold text-dark fs-6" id="s-gross">$0</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Revenue Split</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-net" class="enhanced-progress-segment" style="background:#10b981; width:68%;"></div>
                <div id="bar-plat" class="enhanced-progress-segment" style="background:#ef4444; width:32%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#10b981;font-weight:bold;">Your Cut</span>
                <span style="color:#ef4444;font-weight:bold;">Ad Network Cut</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }
    function calc() {
        const imp = parseFloat(document.getElementById('imp').value) || 0;
        const ctr = (parseFloat(document.getElementById('ctr').value) || 0) / 100;
        const cpc = parseFloat(document.getElementById('cpc').value) || 0;
        const share = (parseFloat(document.getElementById('share').value) || 0) / 100;

        const clicks = Math.floor(imp * ctr);
        const gross = clicks * cpc;
        const net = gross * share;

        let badge = document.getElementById('cpc-badge');
        if(cpc < 0.20) { badge.innerText = "LOW CPC WALL"; badge.className = "status-badge badge-critical"; }
        else if (ctr < 0.005) { badge.innerText = "AD BLINDNESS"; badge.className = "status-badge badge-warning"; }
        else if (net > 2000) { badge.innerText = "HIGH YIELD"; badge.className = "status-badge badge-optimal"; }
        else { badge.innerText = "STANDARD"; badge.className = "status-badge badge-info"; }

        try {
            document.getElementById('net').innerText = format(net);
            document.getElementById('s-clicks').innerText = clicks.toLocaleString('en-US');
            document.getElementById('s-gross').innerText = format(gross);

            const sPct = share * 100;
            const pPct = 100 - sPct;
            document.getElementById('bar-net').style.width = sPct + '%';
            document.getElementById('bar-plat').style.width = pPct + '%';
        } catch(e) {}
    }
    
    ['imp','ctr','cpc','share'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-std').addEventListener('click', () => { document.getElementById('ctr').value=1.0; document.getElementById('cpc').value=0.55; calc(); });
    document.getElementById('qa-high').addEventListener('click', () => { document.getElementById('ctr').value=4.5; document.getElementById('cpc').value=0.85; calc(); });
    document.getElementById('qa-junk').addEventListener('click', () => { document.getElementById('ctr').value=0.1; document.getElementById('cpc').value=0.25; calc(); });
    document.getElementById('qa-fin').addEventListener('click', () => { document.getElementById('ctr').value=1.5; document.getElementById('cpc').value=2.50; calc(); });
    document.getElementById('qa-tech').addEventListener('click', () => { document.getElementById('ctr').value=2.0; document.getElementById('cpc').value=1.20; calc(); });
    document.getElementById('qa-ent').addEventListener('click', () => { document.getElementById('ctr').value=1.2; document.getElementById('cpc').value=0.15; calc(); });

    calc();
});
</script>

