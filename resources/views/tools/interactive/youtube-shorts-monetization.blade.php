<div class="row g-4 roi-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Total Shorts Views (Monthly)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-eye text-muted"></i></span>
                            <input type="number" id="yts-views" class="form-control form-control-lg" value="1000000" min="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Primary Audience Location</label>
                        <select id="yts-country" class="form-select form-select-lg">
                            <option value="0.06">Tier 1 (US, UK, CA, AU) - High RPM</option>
                            <option value="0.025">Tier 2 (Europe, LatAm) - Medium RPM</option>
                            <option value="0.008">Tier 3 (India, SE Asia) - Low RPM</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Commercial Music Usage?</label>
                        <select id="yts-music" class="form-select form-select-lg">
                            <option value="no">No Music (100% to Creator Pool)</option>
                            <option value="yes">Used 1 Track (50% to Creator Pool)</option>
                            <option value="yes2">Used 2 Tracks (33% to Creator Pool)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ff0000;--tool-bg:rgba(255,0,0,.04);">
            <div class="output-hero">
                <span class="output-hero-label">ESTIMATED SHORTS REVENUE</span>
                <div class="output-hero-value" id="yts-total">$27.00</div>
                <span class="output-hero-unit" id="yts-rpm">Effective Creator RPM: $0.027</span>
            </div>
            
            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Total Ad Revenue Generated</span>
                        <span class="fs-4 fw-bold" id="yts-ad-rev">$60.00</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Creator Pool Allocation</span>
                        <span class="fs-4 fw-bold" id="yts-pool">$60.00</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Creator Share (45%)</span>
                        <span class="fs-4 fw-bold" id="yts-share">$27.00</span>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="yts-insights"></div>
            
            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="yts-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy Result
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="yts-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-rotate-left me-2"></i>Reset Fields
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function fmt(v){ return '$' + v.toFixed(2); }
    
    function calculate() {
        const views = parseFloat($('yts-views').value) || 0;
        const rpmBase = parseFloat($('yts-country').value); // Gross RPM per 1000 views
        const music = $('yts-music').value;
        
        if (views === 0) {
            $('yts-total').textContent = '$0.00';
            $('yts-rpm').textContent = 'Effective Creator RPM: $0.00';
            $('yts-ad-rev').textContent = '$0.00';
            $('yts-pool').textContent = '$0.00';
            $('yts-share').textContent = '$0.00';
            $('yts-insights').innerHTML = '';
            return;
        }

        // 1. Calculate Gross Ad Revenue from the Shorts Feed based on location
        const grossRevenue = (views / 1000) * rpmBase;
        
        // 2. Allocate to Creator Pool vs Music Publishers
        let poolMultiplier = 1.0;
        if (music === 'yes') {
            poolMultiplier = 0.50; // 50% to creator pool, 50% to music
        } else if (music === 'yes2') {
            poolMultiplier = 0.3333; // 33% to creator pool, 66% to music
        }
        
        const creatorPool = grossRevenue * poolMultiplier;
        
        // 3. Creator Share (Fixed 45% of the Creator Pool)
        const finalEarnings = creatorPool * 0.45;
        
        // Effective RPM for the creator
        const effectiveRPM = (finalEarnings / views) * 1000;

        $('yts-ad-rev').textContent = fmt(grossRevenue);
        $('yts-pool').textContent = fmt(creatorPool);
        $('yts-share').textContent = fmt(finalEarnings);
        $('yts-total').textContent = fmt(finalEarnings);
        $('yts-rpm').textContent = `Effective Creator RPM: ${fmt(effectiveRPM)}`;

        let ins = [];
        ins.push(`Of the total <strong>${fmt(grossRevenue)}</strong> ad revenue generated by your views, <strong>${(poolMultiplier*100).toFixed(0)}%</strong> is allocated to the Creator Pool.`);
        
        if (music !== 'no') {
            ins.push(`Because you used commercial music, a portion of the revenue is diverted to music publishers before it reaches the Creator Pool.`);
        } else {
            ins.push(`Since you did not use commercial music, 100% of the ad revenue goes into the Creator Pool.`);
        }
        
        ins.push(`You receive a flat <strong>45% share</strong> of your Creator Pool allocation, totaling <strong>${fmt(finalEarnings)}</strong>.`);
        
        if (rpmBase < 0.02) {
            ins.push('Note: Viewers in Tier 3 regions generally have lower ad engagement and advertiser bids, resulting in a lower RPM.');
        }

        $('yts-insights').innerHTML = '<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Monetization Breakdown</h6>' + 
                                     '<ul class="list-unstyled mb-0">' + 
                                     ins.map(i => `<li class="mb-2 pb-1" style="font-size:0.9rem"><i class="fas fa-check-circle text-success me-2"></i>${i}</li>`).join('') + 
                                     '</ul>';
    }

    ['yts-views', 'yts-country', 'yts-music'].forEach(id => $(id).addEventListener('input', calculate));
    $('yts-country').addEventListener('change', calculate);
    $('yts-music').addEventListener('change', calculate);

    $('yts-copy').addEventListener('click', function() {
        const t = `YouTube Shorts Earnings Estimate\nViews: ${$('yts-views').value}\nGross Ad Revenue: ${$('yts-ad-rev').textContent}\nCreator Pool Allocation: ${$('yts-pool').textContent}\nFinal Creator Share (45%): ${$('yts-total').textContent}\nEffective RPM: ${$('yts-rpm').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('yts-reset').addEventListener('click', () => {
        $('yts-views').value = 1000000;
        $('yts-country').value = '0.06';
        $('yts-music').value = 'no';
        calculate();
    });

    calculate();
});
</script>

<style>
.roi-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,.04); }
.roi-rebuilt .calculator-header { display:flex; align-items:center; gap:1.25rem; margin-bottom:2rem; }
.roi-rebuilt .calculator-header h4 { margin:0; font-weight:800; color:#1e293b; font-size:1.4rem; }
.roi-rebuilt .calculator-header p { margin:0; font-size:0.95rem; color:#64748b; }
.roi-rebuilt .tool-icon-circle { width:60px; height:60px; border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.6rem; flex-shrink:0; }
.roi-rebuilt .form-label-custom { font-size:.8rem; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:.8px; margin-bottom:.5rem; display:block; }
.roi-rebuilt .output-card-themed { background:var(--tool-bg); border:1px solid rgba(0,0,0,.05); border-radius:20px; padding:2rem; }
.roi-rebuilt .output-hero { background:#fff; border-radius:16px; padding:2rem; text-align:center; box-shadow:0 4px 12px rgba(0,0,0,.02); border:1px solid rgba(0,0,0,.04); }
.roi-rebuilt .output-hero-label { font-size:.85rem; font-weight:700; color:#64748b; letter-spacing:1px; display:block; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-value { font-size:2.5rem; font-weight:800; color:var(--tool-color); line-height:1.2; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-unit { font-size:1rem; font-weight:700; color:#475569; }
.roi-rebuilt .overflow-x-auto { overflow-x: auto; }
.roi-rebuilt .break-words { word-break: break-word; }
@media(max-width:768px){ 
    .roi-rebuilt .calculator-card, .roi-rebuilt .output-card-themed { padding:1.5rem; }
    .roi-rebuilt .output-hero-value { font-size:2rem; }
    .roi-rebuilt .calculator-header h4 { font-size:1.2rem; }
}
</style>
