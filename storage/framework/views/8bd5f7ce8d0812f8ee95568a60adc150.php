<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<div class="interactive-tool-grid conversion-tracking-tool">
    <div class="calculator-card">
        
        <div class="calculator-body">
            <div class="alert bg-light border p-2 mb-3 mt-2">
                <h6 class="text-secondary mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Campaign Profiles</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="qa-btn-component qa-primary" id="qa-fb" style="min-width: 280px; max-width: 100%;">Facebook Ads (Avg)</button>
                    <button class="qa-btn-component qa-success" id="qa-goog" style="min-width: 280px; max-width: 100%;">Google Search (High Intent)</button>
                    <button class="qa-btn-component qa-warning" id="qa-influ" style="min-width: 280px; max-width: 100%;">Influencer Shoutout</button>
                    <button class="qa-btn-component qa-danger" id="qa-bomb" style="min-width: 280px; max-width: 100%;">Failed Campaign</button>
                    <button class="qa-btn-component qa-info" id="qa-email" style="min-width: 280px; max-width: 100%;">Email List (Warm)</button>
                    <button class="qa-btn-component qa-dark" id="qa-tiktok" style="min-width: 280px; max-width: 100%;">TikTok Viral (Low CVR)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom mb-3">
                    <label class="form-label-custom">Total Ad Spend ($)</label>
                    <input type="number" id="spend" class="form-control-custom fw-bold text-danger" value="2500" min="0">
                </div>
                <div class="col-md-6 form-group-custom mb-3 border-start">
                    <label class="form-label-custom">Avg Product / Order Value ($)</label>
                    <input type="number" id="aov" class="form-control-custom fw-bold text-success" value="85" min="0">
                </div>
            </div>
            
            <h5 class="text-secondary mt-2 pb-2 border-bottom mb-2 w-100">Traffic Data</h5>
            <div class="row">
                <div class="col-md-4 form-group-custom mb-2">
                    <label class="form-label-custom">Link Clicks</label>
                    <input type="number" id="clicks" class="form-control-custom" value="5000" min="1">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom">Add to Carts</label>
                    <input type="number" id="atc" class="form-control-custom" value="250" min="0">
                </div>
                <div class="col-md-4 form-group-custom mb-2 border-start">
                    <label class="form-label-custom text-primary">Purchases</label>
                    <input type="number" id="purch" class="form-control-custom" value="50" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="result-panel">
        <div class="result-card-v2" style="border-top: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="result-label">Return On Ad Spend (ROAS)</span>
                <span id="roas-badge" class="status-badge badge-info">Calculating</span>
            </div>
            <h1 class="result-main-value fs-1" id="roas" style="color: #047857;">0x</h1>
            
            <div class="summary-table-container mt-4 pt-3 border-top">
                <table class="table table-sm table-borderless summary-table">
                    <tr><td>Gross Revenue</td><td class="text-end fw-bold fs-6 text-success" id="s-rev">$0</td></tr>
                    <tr><td>Net Profit (Rev - Spend)</td><td class="text-end fw-bold text-dark fs-6" id="s-net">$0</td></tr>
                    <tr><td class="pt-2 border-top">Cost Per Acquisition (CPA)</td><td class="text-end pt-2 border-top fw-semibold text-danger" id="s-cpa">$0</td></tr>
                    <tr><td>Click to Purchase CVR</td><td class="text-end fw-semibold text-primary" id="s-cvr">0%</td></tr>
                </table>
            </div>

            <p class="text-muted mt-3 mb-1" style="font-size: 0.8rem; font-weight: bold;">Profitability Threshold Matrix</p>
            <div class="enhanced-progress-bar" style="height:12px;">
                <div id="bar-spend" class="enhanced-progress-segment" style="background:#ef4444; width:50%;"></div>
                <div id="bar-profit" class="enhanced-progress-segment" style="background:#10b981; width:50%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-1" style="font-size:0.7rem;">
                <span style="color:#ef4444;font-weight:bold;">Breakeven Mark</span>
                <span style="color:#10b981;font-weight:bold;">Profit Scaling</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }
    function calc() {
        const spend = parseFloat(document.getElementById('spend').value) || 0;
        const aov = parseFloat(document.getElementById('aov').value) || 0;
        const clicks = parseFloat(document.getElementById('clicks').value) || 0;
        const purch = parseFloat(document.getElementById('purch').value) || 0;
        
        const rev = purch * aov;
        const net = rev - spend;
        
        const roas = spend > 0 ? rev / spend : 0;
        const cpa = purch > 0 ? spend / purch : 0;
        const cvr = clicks > 0 ? (purch / clicks) * 100 : 0;

        let badge = document.getElementById('roas-badge');
        let color = '#047857';
        if(roas < 1) { badge.innerText = "LOSING MONEY"; badge.className = "status-badge badge-critical"; color='#ef4444'; }
        else if(roas < 2.5) { badge.innerText = "MARGINAL PROFIT"; badge.className = "status-badge badge-warning"; color='#f59e0b'; }
        else if (roas < 5) { badge.innerText = "HIGHLY PROFITABLE"; badge.className = "status-badge badge-info"; color='#0ea5e9'; }
        else { badge.innerText = "MONEY PRINTER"; badge.className = "status-badge badge-optimal"; color='#10b981'; }

        try {
            document.getElementById('roas').innerText = roas.toFixed(2) + 'x';
            document.getElementById('roas').style.color = color;
            
            document.getElementById('s-rev').innerText = format(rev);
            
            let netObj = document.getElementById('s-net');
            netObj.innerText = (net<0?'-':'') + format(Math.abs(net));
            netObj.style.color = net<0 ? '#ef4444' : '#10b981';
            
            document.getElementById('s-cpa').innerText = format(cpa);
            document.getElementById('s-cvr').innerText = cvr.toFixed(2) + '%';

            // Visual bar mappings. The "bar" represents Revenue. Spend is X%, Profit is Y%.
            if(rev > 0) {
                const sPct = Math.min(100, (spend / rev) * 100);
                const pPct = net > 0 ? (net / rev) * 100 : 0;
                document.getElementById('bar-spend').style.width = sPct + '%';
                document.getElementById('bar-profit').style.width = pPct + '%';
            } else {
                document.getElementById('bar-spend').style.width = '100%';
                document.getElementById('bar-profit').style.width = '0%';
            }
        } catch(e) {}
    }
    
    ['spend','aov','clicks','atc','purch'].forEach(id => document.getElementById(id).addEventListener('input', calc));

    document.getElementById('qa-fb').addEventListener('click', () => { document.getElementById('spend').value=1500; document.getElementById('aov').value=50; document.getElementById('clicks').value=2500; document.getElementById('atc').value=150; document.getElementById('purch').value=60; calc(); });
    document.getElementById('qa-goog').addEventListener('click', () => { document.getElementById('spend').value=3000; document.getElementById('aov').value=120; document.getElementById('clicks').value=1200; document.getElementById('atc').value=200; document.getElementById('purch').value=80; calc(); });
    document.getElementById('qa-influ').addEventListener('click', () => { document.getElementById('spend').value=5000; document.getElementById('aov').value=75; document.getElementById('clicks').value=15000; document.getElementById('atc').value=800; document.getElementById('purch').value=300; calc(); });
    document.getElementById('qa-bomb').addEventListener('click', () => { document.getElementById('spend').value=1000; document.getElementById('aov').value=45; document.getElementById('clicks').value=800; document.getElementById('atc').value=10; document.getElementById('purch').value=2; calc(); });
    document.getElementById('qa-email').addEventListener('click', () => { document.getElementById('spend').value=250; document.getElementById('aov').value=99; document.getElementById('clicks').value=3500; document.getElementById('atc').value=450; document.getElementById('purch').value=180; calc(); });
    document.getElementById('qa-tiktok').addEventListener('click', () => { document.getElementById('spend').value=800; document.getElementById('aov').value=25; document.getElementById('clicks').value=25000; document.getElementById('atc').value=500; document.getElementById('purch').value=85; calc(); });

    calc();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\conversion-tracking-tool.blade.php ENDPATH**/ ?>