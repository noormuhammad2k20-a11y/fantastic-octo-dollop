<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            
            <div class="p-3 rounded-4 mb-4" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-bolt text-warning me-2"></i>Niche Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-primary btn-sm rounded-pill fw-bold" id="qa-amz" style="min-width: 280px; max-width: 100%;">Amazon Associates (3%)</button>
                    <button class="btn btn-outline-success btn-sm rounded-pill fw-bold" id="qa-saas" style="min-width: 280px; max-width: 100%;">SaaS Recurring (30%)</button>
                    <button class="btn btn-outline-warning btn-sm rounded-pill fw-bold" id="qa-high" style="min-width: 280px; max-width: 100%;">High Ticket ($997)</button>
                    <button class="btn btn-outline-info btn-sm rounded-pill fw-bold" id="qa-cpa" style="min-width: 280px; max-width: 100%;">CPA Lead Gen ($5)</button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill fw-bold" id="qa-fin" style="min-width: 280px; max-width: 100%;">Finance/Credit ($50)</button>
                    <button class="btn btn-outline-dark btn-sm rounded-pill fw-bold" id="qa-host" style="min-width: 280px; max-width: 100%;">Hosting Bounties ($100)</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Traffic Metrics</h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Monthly Clicks / Traffic Sent</label>
                            <input type="number" id="clicks" class="form-control form-control-lg rounded-3" value="10000" min="0">
                        </div>
                        <div>
                            <label class="form-label small fw-bold text-primary text-uppercase mb-2">Conversion Rate (%)</label>
                            <div class="input-group">
                                <input type="number" id="cvr" class="form-control form-control-lg rounded-3" value="2.5" step="0.1">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Payout Structure</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Avg Price ($)</label>
                                <input type="number" id="price" class="form-control form-control-lg rounded-3" value="100" min="0">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-success text-uppercase mb-2">Comm. Rate (%)</label>
                                <input type="number" id="comm" class="form-control form-control-lg rounded-3" value="20" min="0" max="100">
                            </div>
                            <div class="col-12 mt-3 pt-3 border-top">
                                <label class="form-label small fw-bold text-muted text-uppercase mb-2">OR Flat CPA Payout ($)</label>
                                <input type="number" id="flat" class="form-control form-control-lg rounded-3" value="0" min="0">
                                <small class="text-muted d-block mt-1">If > 0, overrides percentage calc</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-success btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-chart-line me-2"></i> Forecast Earnings
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-primary-soft">
                        <i class="fas fa-coins text-primary"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Earnings Analysis</h5>
                        <p class="text-muted small mb-0" id="aff-badge">Passive income potential</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Analysis
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-3 fw-bold text-success mb-0" id="earn">$0</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Estimated Monthly Earnings</p>
                    
                    <div class="alert mt-4 border-0 p-3 rounded-4 fw-bold" id="epc-msg" style="font-size: 0.85rem; background: #f0fdf4; color: #166534;">
                        EPC dictates your maximum profitable ad spend.
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                            <span class="text-muted fw-bold small text-uppercase">Sales Generated</span>
                            <span class="fw-bold h5 mb-0 text-dark" id="s-sales">0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                            <span class="text-muted fw-bold small text-uppercase">Earnings Per Click (EPC)</span>
                            <span class="fw-bold h5 mb-0 text-primary" id="s-epc">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted fw-bold small text-uppercase">Expected Annual Payout</span>
                            <span class="fw-bold h5 mb-0 text-dark" id="s-arr">$0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.1rem; padding: 0.75rem 1rem; }
    .form-control:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }
    
    .input-group-text { background: #f8fafc; border: 1.5px solid var(--border-color); border-left: none; border-radius: 0 12px 12px 0; font-weight: bold; color: #64748b; }
    .input-group .form-control { border-right: none; }

    .transition-all { transition: all 0.2s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const clicksIn = document.getElementById('clicks');
    const cvrIn = document.getElementById('cvr');
    const priceIn = document.getElementById('price');
    const commIn = document.getElementById('comm');
    const flatIn = document.getElementById('flat');
    
    const resultCard = document.getElementById('result-card');
    const earnDisplay = document.getElementById('earn');
    const salesDisplay = document.getElementById('s-sales');
    const epcDisplay = document.getElementById('s-epc');
    const arrDisplay = document.getElementById('s-arr');
    const badgeDisplay = document.getElementById('aff-badge');
    const msgDisplay = document.getElementById('epc-msg');
    const btnCalculate = document.getElementById('btn-calculate');

    function format(n) { return '$' + Math.max(0, n).toLocaleString('en-US', {minimumFractionDigits:0, maximumFractionDigits:2}); }

    function calc() {
        const clicks = parseFloat(clicksIn.value) || 0;
        const cvr = (parseFloat(cvrIn.value) || 0) / 100;
        const price = parseFloat(priceIn.value) || 0;
        const commPct = (parseFloat(commIn.value) || 0) / 100;
        const flat = parseFloat(flatIn.value) || 0;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Forecasting...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const sales = clicks * cvr;
            let earn = flat > 0 ? (sales * flat) : (sales * (price * commPct));
            const epc = clicks > 0 ? earn / clicks : 0;
            const arr = earn * 12;

            earnDisplay.innerText = format(earn);
            salesDisplay.innerText = Math.floor(sales).toLocaleString('en-US');
            epcDisplay.innerText = format(epc);
            arrDisplay.innerText = format(arr);

            if (earn > 10000) { badgeDisplay.innerText = "Super Affiliate Tier"; msgDisplay.innerText = "Scale at this performance is world-class."; msgDisplay.style.background="#f0fdf4"; msgDisplay.style.color="#166534"; }
            else if (earn > 2000) { badgeDisplay.innerText = "Professional Revenue"; msgDisplay.innerText = "Highly sustainable passive income stream."; msgDisplay.style.background="#f0f9ff"; msgDisplay.style.color="#075985"; }
            else if (earn > 100) { badgeDisplay.innerText = "Growing Side Hustle"; msgDisplay.innerText = "Focus on increasing traffic volume now."; msgDisplay.style.background="#fffbeb"; msgDisplay.style.color="#92400e"; }
            else { badgeDisplay.innerText = "Early Stage Yield"; msgDisplay.innerText = "Convert more traffic to reach the next tier."; msgDisplay.style.background="#fef2f2"; msgDisplay.style.color="#991b1b"; }

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth' });

            btnCalculate.innerHTML = '<i class="fas fa-chart-line me-2"></i> Forecast Earnings';
            btnCalculate.disabled = false;
        }, 400);
    }

    btnCalculate.addEventListener('click', calc);

    document.getElementById('qa-amz').addEventListener('click', () => { clicksIn.value=50000; cvrIn.value=5; priceIn.value=30; commIn.value=3; flatIn.value=0; calc(); });
    document.getElementById('qa-saas').addEventListener('click', () => { clicksIn.value=2000; cvrIn.value=1.5; priceIn.value=99; commIn.value=30; flatIn.value=0; calc(); });
    document.getElementById('qa-high').addEventListener('click', () => { clicksIn.value=500; cvrIn.value=0.5; priceIn.value=997; commIn.value=50; flatIn.value=0; calc(); });
    document.getElementById('qa-cpa').addEventListener('click', () => { clicksIn.value=15000; cvrIn.value=15; priceIn.value=0; commIn.value=0; flatIn.value=5; calc(); });
    document.getElementById('qa-fin').addEventListener('click', () => { clicksIn.value=3000; cvrIn.value=2; priceIn.value=0; commIn.value=0; flatIn.value=50; calc(); });
    document.getElementById('qa-host').addEventListener('click', () => { clicksIn.value=1500; cvrIn.value=1; priceIn.value=0; commIn.value=0; flatIn.value=100; calc(); });

    document.getElementById('btn-reset').addEventListener('click', () => {
        clicksIn.value = 10000; cvrIn.value = 2.5; priceIn.value = 100; commIn.value = 20; flatIn.value = 0;
        resultCard.classList.add('d-none');
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Affiliate Earnings Forecast:\nMonthly Earnings: ${earnDisplay.innerText}\nSales: ${salesDisplay.innerText}\nEPC: ${epcDisplay.innerText}\nAnnual Payout: ${arrDisplay.innerText}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied Report!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\affiliate-income-calculator.blade.php ENDPATH**/ ?>