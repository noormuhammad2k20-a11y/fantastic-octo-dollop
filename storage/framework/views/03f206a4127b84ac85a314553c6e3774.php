<div class="row g-4 yt-calc-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Content Niche</label>
                        <select id="yt-niche" class="form-select form-select-lg rounded-3 fw-bold">
                            <option value="1.5">Tech, Business & Finance (High Rate)</option>
                            <option value="1.2">Education & Tutorials</option>
                            <option value="1.0" selected>General Lifestyle & Vlogs</option>
                            <option value="0.8">Gaming & Entertainment</option>
                            <option value="0.5">Meme & Reaction Channels (Low Rate)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Daily Video Views</label>
                        <input type="number" id="yt-views" class="form-control form-control-lg rounded-3" value="10000" min="1">
                    </div>
                </div>

                <div class="row g-3 mb-2">
                    <div class="col-12">
                        <label class="form-label-custom d-flex justify-content-between">
                            <span>Estimated CPM ($)</span>
                            <span id="cpm-val-display" class="fw-bold text-danger">$4.00</span>
                        </label>
                        <input type="range" id="yt-cpm" class="form-range" min="0.5" max="20" step="0.5" value="4.0">
                        <div class="d-flex justify-content-between text-muted small mt-1">
                            <span>$0.50</span>
                            <span>Average: $4 - $6</span>
                            <span>$20.00+</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button id="btn-calculate" class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill shadow-sm" style="background: linear-gradient(45deg, #ff0000, #cc0000); border: none;">
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
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#cc0000;--tool-bg:rgba(204, 0, 0, 0.04);">
            <div class="output-hero text-center">
                <span class="output-hero-label">Estimated Monthly Earnings</span>
                <div class="output-hero-value break-words overflow-x-auto" id="out-monthly">$0.00</div>
                <div class="mt-2 text-muted fw-bold" id="out-benchmark">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Daily Earnings</span>
                        <span class="stat-card-value text-danger" id="out-daily">$0</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-card">
                        <span class="stat-card-label">Yearly Potential</span>
                        <span class="stat-card-value text-success" id="out-yearly">$0</span>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h5 class="fw-bold fs-6 text-uppercase text-muted mb-3 small letter-spacing-1">
                    <i class="fas fa-list-ol me-2 text-info"></i> Revenue Breakdown
                </h5>
                <div class="bg-white shadow-sm border p-4 rounded-3 small text-secondary break-words overflow-x-auto">
                    <ol class="mb-0 ps-3" style="line-height: 1.8;">
                        <li><strong>Step 1:</strong> Calculate effective CPM based on Niche Multiplier.
                            ($<span id="bd-base-cpm">0</span> Base CPM &times; <span id="bd-multiplier">0</span> Niche Rate) = <strong>$<span id="bd-effective-cpm">0</span> Effective CPM</strong>.
                        </li>
                        <li><strong>Step 2:</strong> Calculate Daily Revenue.
                            (<span id="bd-views">0</span> Daily Views &divide; 1,000) &times; $<span id="bd-effective-cpm2">0</span> = <strong>$<span id="bd-daily">0</span> / day</strong>.
                        </li>
                        <li><strong>Step 3:</strong> Project Monthly & Yearly Revenue.
                            Daily &times; 30 = <strong>$<span id="bd-monthly">0</span> / mo</strong> | Daily &times; 365 = <strong>$<span id="bd-yearly">0</span> / yr</strong>.
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
        niche: $('yt-niche'),
        views: $('yt-views'),
        cpm: $('yt-cpm')
    };

    function formatCurrency(num) {
        return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(num);
    }
    
    function formatNumber(num) {
        return new Intl.NumberFormat().format(num);
    }

    // Update Slider Display
    inputs.cpm.addEventListener('input', function() {
        $('cpm-val-display').textContent = formatCurrency(this.value);
        calculate();
    });

    function calculate() {
        const views = parseFloat(inputs.views.value) || 0;
        const cpm = parseFloat(inputs.cpm.value) || 0;
        const nicheMultiplier = parseFloat(inputs.niche.value) || 1.0;

        if (views <= 0) {
            $('out-monthly').textContent = '$0.00';
            $('out-benchmark').textContent = 'Please enter valid daily views.';
            return;
        }

        const effectiveCPM = cpm * nicheMultiplier;
        const dailyEarnings = (views / 1000) * effectiveCPM;
        const monthlyEarnings = dailyEarnings * 30;
        const yearlyEarnings = dailyEarnings * 365;

        // Output Card Updates
        $('out-monthly').textContent = formatCurrency(monthlyEarnings);
        $('out-daily').textContent = formatCurrency(dailyEarnings);
        $('out-yearly').textContent = formatCurrency(yearlyEarnings);

        // Benchmarks
        let benchmarkText = "Starter Income";
        if (monthlyEarnings >= 1000 && monthlyEarnings < 5000) benchmarkText = "Part-Time Income";
        else if (monthlyEarnings >= 5000 && monthlyEarnings < 15000) benchmarkText = "Full-Time Income";
        else if (monthlyEarnings >= 15000) benchmarkText = "High-Earner / Professional";
        
        $('out-benchmark').textContent = benchmarkText;

        // Breakdown Updates
        $('bd-base-cpm').textContent = cpm.toFixed(2);
        $('bd-multiplier').textContent = nicheMultiplier.toFixed(2);
        $('bd-effective-cpm').textContent = effectiveCPM.toFixed(2);
        $('bd-effective-cpm2').textContent = effectiveCPM.toFixed(2);
        
        $('bd-views').textContent = formatNumber(views);
        $('bd-daily').textContent = dailyEarnings.toFixed(2);
        $('bd-monthly').textContent = monthlyEarnings.toFixed(2);
        $('bd-yearly').textContent = yearlyEarnings.toFixed(2);
    }

    // Event Listeners
    $('btn-calculate').addEventListener('click', calculate);
    
    Object.values(inputs).forEach(input => {
        if(input.id !== 'yt-cpm') { // CPM already has input listener above
            input.addEventListener('input', calculate);
        }
    });

    $('btn-reset').addEventListener('click', () => {
        inputs.niche.value = '1.0';
        inputs.views.value = '10000';
        inputs.cpm.value = '4.0';
        $('cpm-val-display').textContent = '$4.00';
        calculate();
    });

    $('btn-copy').addEventListener('click', function() {
        const text = `YouTube Estimated Earnings:\n` +
                     `Daily: ${$('out-daily').textContent}\n` +
                     `Monthly: ${$('out-monthly').textContent}\n` +
                     `Yearly: ${$('out-yearly').textContent}\n` +
                     `Based on ${formatNumber(inputs.views.value)} daily views.\n` +
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
.yt-calc-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:24px; padding:2.5rem; box-shadow:0 8px 48px rgba(0,0,0,.05); }
.yt-calc-rebuilt .calculator-header { display:flex; align-items:center; gap:1.5rem; margin-bottom:2rem; }
.yt-calc-rebuilt .calculator-header h4 { margin:0; font-weight:900; color:#0f172a; letter-spacing:-0.5px; }
.yt-calc-rebuilt .tool-icon-circle { width:64px; height:64px; border-radius:18px; display:flex; align-items:center; justify-content:center; font-size:1.8rem; flex-shrink:0; }
.yt-calc-rebuilt .form-label-custom { font-size:0.75rem; font-weight:800; color:#1e293b; text-transform:uppercase; letter-spacing:1.2px; margin-bottom:0.75rem; display:block; }

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
    .yt-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3rem; letter-spacing: -1px; }
    .stat-card { padding: 1rem 0.5rem; }
    .stat-card-value { font-size: 1.4rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\youtube-earnings-calculator.blade.php ENDPATH**/ ?>