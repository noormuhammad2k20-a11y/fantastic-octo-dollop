<div class="row g-4 adsense-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Daily Page Views</label>
                        <input type="number" id="ad-views" class="form-control form-control-lg rounded-3" placeholder="1000" min="0" step="100">
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">CTR (%)</label>
                        <div class="input-group input-group-lg">
                            <input type="number" id="ad-ctr" class="form-control rounded-start-3" placeholder="1.5" min="0" step="0.1">
                            <span class="input-group-text rounded-end-3 bg-light">%</span>
                        </div>
                        <div class="small text-muted mt-1">Click-Through Rate</div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">CPC ($)</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text rounded-start-3 bg-light">$</span>
                            <input type="number" id="ad-cpc" class="form-control rounded-end-3" placeholder="0.25" min="0" step="0.01">
                        </div>
                        <div class="small text-muted mt-1">Cost Per Click</div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-calculate" style="background-color: #16a34a; border-color: #16a34a;"><i class="fas fa-calculator me-2"></i>Calculate Revenue</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:142;--tool-color:#16a34a;--tool-bg:rgba(22,163,74,.04); display: none;">
            
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                        <div class="text-muted fw-bold mb-2 text-uppercase small">Daily Earnings</div>
                        <div class="display-5 fw-bold" style="color: var(--tool-color);" id="out-daily">$0.00</div>
                        <div class="mt-2 small text-secondary"><span id="out-clicks-daily">0</span> clicks / day</div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 border shadow-sm h-100 position-relative">
                        <div class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger shadow-sm">Popular</div>
                        <div class="text-muted fw-bold mb-2 text-uppercase small">Monthly Earnings</div>
                        <div class="display-5 fw-bold" style="color: var(--tool-color);" id="out-monthly">$0.00</div>
                        <div class="mt-2 small text-secondary"><span id="out-clicks-monthly">0</span> clicks / month</div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                        <div class="text-muted fw-bold mb-2 text-uppercase small">Yearly Earnings</div>
                        <div class="display-5 fw-bold" style="color: var(--tool-color);" id="out-yearly">$0.00</div>
                        <div class="mt-2 small text-secondary"><span id="out-clicks-yearly">0</span> clicks / year</div>
                    </div>
                </div>
            </div>

            <div class="alert alert-light mt-4 mb-0 small border text-center text-muted">
                <i class="fas fa-info-circle me-1"></i> These are estimates. Actual AdSense earnings may vary depending on ad placement, niche, user location, and seasonal trends.
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const viewsEl = $('ad-views');
    const ctrEl = $('ad-ctr');
    const cpcEl = $('ad-cpc');
    
    const outContainer = $('output-container');
    
    $('action-calculate').addEventListener('click', function() {
        const views = parseFloat(viewsEl.value) || 0;
        const ctr = parseFloat(ctrEl.value) || 0;
        const cpc = parseFloat(cpcEl.value) || 0;
        
        if(views <= 0) {
            alert('Please enter a valid number of daily page views.');
            return;
        }
        
        const dailyClicks = views * (ctr / 100);
        const dailyEarn = dailyClicks * cpc;
        
        const monthlyClicks = dailyClicks * 30;
        const monthlyEarn = dailyEarn * 30;
        
        const yearlyClicks = dailyClicks * 365;
        const yearlyEarn = dailyEarn * 365;
        
        $('out-daily').textContent = '$' + dailyEarn.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        $('out-monthly').textContent = '$' + monthlyEarn.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        $('out-yearly').textContent = '$' + yearlyEarn.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        
        $('out-clicks-daily').textContent = Math.round(dailyClicks).toLocaleString();
        $('out-clicks-monthly').textContent = Math.round(monthlyClicks).toLocaleString();
        $('out-clicks-yearly').textContent = Math.round(yearlyClicks).toLocaleString();
        
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        viewsEl.value = '';
        ctrEl.value = '';
        cpcEl.value = '';
        outContainer.style.display = 'none';
    });
});
</script>

<style>
.form-label-custom {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}
.calculator-card {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
    overflow: hidden;
}
.calculator-header {
    padding: 2rem 2rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 1.25rem;
}
.tool-icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}
.calculator-header h4 {
    margin: 0 0 0.25rem 0;
    font-weight: 700;
    color: #111827;
}
.calculator-header p {
    margin: 0;
    color: #6b7280;
    font-size: 0.95rem;
}
.calculator-body {
    padding: 2rem;
}
.output-card-themed {
    background: #fff;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid var(--tool-bg);
    border-top: 4px solid var(--tool-color);
}
</style>
