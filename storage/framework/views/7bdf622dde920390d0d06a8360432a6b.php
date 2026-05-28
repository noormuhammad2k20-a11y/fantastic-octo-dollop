<div class="row g-4 tt-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Video Views</label>
                        <input type="number" id="tt-views" class="form-control form-control-lg rounded-3" value="1000000" min="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Average Likes</label>
                        <input type="number" id="tt-likes" class="form-control form-control-lg rounded-3" value="150000" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Est. Gift Value ($)</label>
                        <input type="number" id="tt-gifts" class="form-control form-control-lg rounded-3" value="50" min="0" step="1">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button id="btn-calculate" class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill shadow-sm" style="background: linear-gradient(45deg, #25F4EE, #FE2C55); border: none; color: white;">
                        <i class="fas fa-calculator me-2"></i> Calculate Earnings
                    </button>
                    <button type="button" id="btn-reset" class="btn btn-outline-secondary px-4 fw-bold rounded-pill shadow-sm">
                        <i class="fas fa-undo me-2"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#111827;--tool-bg:rgba(17, 24, 39, 0.03);">
            <div class="output-hero text-center">
                <span class="output-hero-label">Estimated Total Earnings</span>
                <div class="output-hero-value break-words overflow-x-auto" id="out-total">$0.00</div>
                <div class="mt-2 text-muted fw-bold" id="out-benchmark">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Creator Fund (Est)</span>
                        <span class="stat-card-value text-dark" id="out-fund">$0</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Engagement Rate</span>
                        <span class="stat-card-value" style="color:#FE2C55" id="out-engagement">0%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h5 class="fw-bold fs-6 text-uppercase text-muted mb-3 small letter-spacing-1">
                    <i class="fas fa-list-ol me-2 text-info"></i> Revenue Breakdown
                </h5>
                <div class="bg-white shadow-sm border p-4 rounded-3 small text-secondary break-words overflow-x-auto">
                    <ol class="mb-0 ps-3" style="line-height: 1.8;">
                        <li><strong>Step 1:</strong> Estimate Creator Rewards. (Average $0.035 per 1,000 views). 
                            (<span id="bd-views">0</span> &divide; 1,000) &times; $0.035 = <strong>$<span id="bd-fund">0</span></strong>.
                        </li>
                        <li><strong>Step 2:</strong> Add Live Gifts value.
                            $<span id="bd-fund2">0</span> + $<span id="bd-gifts">0</span> = <strong>$<span id="bd-total">0</span> Total</strong>.
                        </li>
                        <li><strong>Step 3:</strong> Calculate Engagement.
                            (<span id="bd-likes">0</span> Likes &divide; <span id="bd-views2">0</span> Views) &times; 100 = <strong><span id="bd-engagement">0</span>%</strong>.
                        </li>
                    </ol>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-5 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Results
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    
    const inputs = {
        views: $('tt-views'),
        likes: $('tt-likes'),
        gifts: $('tt-gifts')
    };

    function formatCurrency(num) {
        return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(num);
    }
    
    function formatNumber(num) {
        return new Intl.NumberFormat().format(num);
    }

    function calculate() {
        const views = parseFloat(inputs.views.value) || 0;
        const likes = parseFloat(inputs.likes.value) || 0;
        const gifts = parseFloat(inputs.gifts.value) || 0;

        if (views <= 0) {
            $('out-total').textContent = '$0.00';
            $('out-benchmark').textContent = 'Please enter valid video views.';
            return;
        }

        const fundEarnings = (views / 1000) * 0.035;
        const totalEarnings = fundEarnings + gifts;
        const engagementRate = (likes / views) * 100;

        // Output Card Updates
        $('out-total').textContent = formatCurrency(totalEarnings);
        $('out-fund').textContent = formatCurrency(fundEarnings);
        $('out-engagement').textContent = engagementRate.toFixed(2) + '%';

        // Benchmarks
        let benchmarkText = "Starter Content";
        if (engagementRate >= 5 && engagementRate < 10) benchmarkText = "Good Engagement";
        else if (engagementRate >= 10 && engagementRate < 15) benchmarkText = "High Engagement";
        else if (engagementRate >= 15) benchmarkText = "Viral Engagement Potential";
        
        $('out-benchmark').textContent = benchmarkText;

        // Breakdown Updates
        $('bd-views').textContent = formatNumber(views);
        $('bd-views2').textContent = formatNumber(views);
        $('bd-likes').textContent = formatNumber(likes);
        
        $('bd-fund').textContent = fundEarnings.toFixed(2);
        $('bd-fund2').textContent = fundEarnings.toFixed(2);
        $('bd-gifts').textContent = gifts.toFixed(2);
        $('bd-total').textContent = totalEarnings.toFixed(2);
        $('bd-engagement').textContent = engagementRate.toFixed(2);
    }

    // Event Listeners
    $('btn-calculate').addEventListener('click', calculate);
    
    Object.values(inputs).forEach(input => {
        input.addEventListener('input', calculate);
    });

    $('btn-reset').addEventListener('click', () => {
        inputs.views.value = '1000000';
        inputs.likes.value = '150000';
        inputs.gifts.value = '50';
        calculate();
    });

    $('btn-copy').addEventListener('click', function() {
        const text = `TikTok Estimated Earnings:\n` +
                     `Total: ${$('out-total').textContent}\n` +
                     `Fund: ${$('out-fund').textContent} | Gifts: $${inputs.gifts.value}\n` +
                     `Engagement Rate: ${$('out-engagement').textContent}\n` +
                     `Based on ${formatNumber(inputs.views.value)} views.\n` +
                     `— ToolsHub Calculators`;
                     
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = originalHTML, 2000);
        });
    });

    // Initial calculation
    calculate();
});
</script>

<style>
.tt-calc-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:24px; padding:2.5rem; box-shadow:0 8px 48px rgba(0,0,0,.05); }
.tt-calc-rebuilt .calculator-header { display:flex; align-items:center; gap:1.5rem; margin-bottom:2rem; }
.tt-calc-rebuilt .calculator-header h4 { margin:0; font-weight:900; color:#0f172a; letter-spacing:-0.5px; }
.tt-calc-rebuilt .tool-icon-circle { width:64px; height:64px; border-radius:18px; display:flex; align-items:center; justify-content:center; font-size:2rem; flex-shrink:0; }
.tt-calc-rebuilt .form-label-custom { font-size:0.75rem; font-weight:800; color:#1e293b; text-transform:uppercase; letter-spacing:1.2px; margin-bottom:0.75rem; display:block; }

.output-card-themed { background: var(--tool-bg, #f8fafc); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.08); }
.output-hero { padding: 2rem 0; border-bottom: 2px solid rgba(0,0,0,.04); margin-bottom: 2rem; }
.output-hero-label { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 4.5rem; font-weight: 900; color: var(--tool-color, #1e293b); line-height: 1; margin: 0.5rem 0; letter-spacing: -2px; }

.stat-card { background: #fff; border: 2.5px solid #f1f5f9; border-radius: 20px; padding: 1.5rem 1.25rem; text-align: center; height: 100%; display: flex; flex-direction: column; justify-content: center;}
.stat-card-label { display: block; font-size: .65rem; font-weight: 900; text-transform: uppercase; color: #94a3b8; letter-spacing: 1.5px; margin-bottom: 8px; }
.stat-card-value { font-size: 1.8rem; font-weight: 900; display: block; line-height: 1.2; color: #0f172a; }

.break-words { word-break: break-all; word-wrap: break-word; overflow-wrap: break-word; }
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 576px) {
    .tt-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3rem; letter-spacing: -1px; }
    .stat-card { padding: 1rem 0.5rem; }
    .stat-card-value { font-size: 1.4rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\tiktok-money-calculator.blade.php ENDPATH**/ ?>