<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --gs-hue: 190;
        --gs-primary: hsl(var(--gs-hue), 90%, 40%);
        --gs-primary-light: hsl(var(--gs-hue), 90%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 90%, 40%, 0.15);
        --gs-bg-glass: rgba(255, 255, 255, 0.8);
        --gs-border: 1px solid rgba(0, 0, 0, 0.08);
        --gs-radius: 24px;
        --gs-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
    }

    .gs-rebuilt { font-family: 'Inter', sans-serif; color: #1e293b; }
    
    /* Premium Cards */
    .gs-card {
        background: var(--gs-bg-glass);
        backdrop-filter: blur(12px);
        border: var(--gs-border);
        border-radius: var(--gs-radius);
        padding: 2rem;
        box-shadow: var(--gs-shadow);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 2rem;
        overflow: hidden;
        word-break: break-word;
    }
    
    .gs-card-output {
        background: linear-gradient(135deg, hsla(var(--gs-hue), 90%, 40%, 0.03), hsla(var(--gs-hue), 90%, 60%, 0.06));
        border: 2px solid var(--gs-primary-glow);
    }

    /* Header Styling */
    .gs-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
    .gs-icon-box {
        width: 60px; height: 60px; border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; background: var(--gs-primary-light); color: var(--gs-primary);
        box-shadow: 0 10px 25px var(--gs-primary-glow);
        flex-shrink: 0;
    }
    .gs-header h4 { margin: 0; font-weight: 700; letter-spacing: -0.5px; font-size: 1.5rem; color: #0f172a; }
    .gs-header p { margin: 0; color: #64748b; font-size: 0.95rem; }

    /* Inputs */
    .gs-label { font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569; margin-bottom: 0.75rem; display: block; }
    .gs-input-group { position: relative; transition: all 0.2s; }
    .gs-input {
        border-radius: 16px !important; border: 2px solid #f1f5f9 !important;
        padding: 1rem 1.25rem !important; font-size: 1.1rem !important; font-weight: 600 !important;
        transition: all 0.2s !important; background: #fff !important;
    }
    .gs-input:focus { border-color: var(--gs-primary) !important; box-shadow: 0 0 0 4px var(--gs-primary-glow) !important; outline: none; }
    
    /* Hero Section */
    .gs-hero { text-align: center; padding-bottom: 2rem; border-bottom: 2px solid rgba(0,0,0,0.03); }
    .gs-hero-label { font-size: 0.8rem; font-weight: 900; letter-spacing: 3px; color: #64748b; text-transform: uppercase; margin-bottom: 0.75rem; display: block; }
    .gs-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; line-height: 1; letter-spacing: -2px; margin-bottom: 0.5rem; word-break: break-all; }
    
    /* Stat Cards */
    .gs-stat-card {
        background: #fff; border: 1px solid rgba(0,0,0,0.05); border-radius: 20px;
        padding: 1.25rem 1rem; text-align: center; height: 100%;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .gs-stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .gs-stat-label { font-size: 0.65rem; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 0.4rem; display: block; }
    .gs-stat-value { font-size: 1.5rem; font-weight: 900; color: #0f172a; display: block; }

    /* Progress & Tables */
    .gs-progress-wrapper { background: #fff; padding: 2rem; border-radius: 24px; border: 1px solid rgba(0,0,0,0.05); margin-top: 2rem; }
    .gs-progress { height: 32px; border-radius: 100px; background: #f1f5f9; overflow: hidden; display: flex; }
    .gs-progress-bar { height: 100%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; color: #fff; transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1); }

    .gs-table { font-size: 0.9rem; }
    .gs-table tr { border-bottom: 1px solid #f1f5f9; }
    .gs-table td { padding: 1rem 0.5rem; vertical-align: middle; }

    /* Responsive */
    @media (max-width: 768px) {
        .gs-card { padding: 1.5rem; }
        .gs-header { flex-direction: column; text-align: center; gap: 0.75rem; }
        .gs-icon-box { width: 48px; height: 48px; font-size: 1.25rem; border-radius: 14px; margin: 0 auto; }
        .gs-header h4 { font-size: 1.25rem; }
        .gs-hero-value { font-size: 2.5rem; }
        .gs-stat-value { font-size: 1.25rem; }
    }

    /* Print Optimization */
    @media print {
        .gs-card:not(.gs-card-output), .btn, .gs-presets, .gs-progress-wrapper { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
        body { background: white !important; }
    }
</style>
<?php $__env->stopPush(); ?>

<div class="gs-rebuilt">
    <div class="row g-4">
        
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-house-lock"></i></div>
                    <div>
                        <h4>Loan-to-Value (LTV) Ratio</h4>
                        <p>Evaluate your mortgage equity, refinancing potential, and PMI status.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Property Value (Current)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="ltv-value" class="form-control gs-input border-start-0" value="450000" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Loan Balance (Principal)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="ltv-loan" class="form-control gs-input border-start-0" value="360000" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Second Mortgage / HELOC</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="ltv-second" class="form-control gs-input border-start-0" value="0" min="0">
                        </div>
                        <small class="text-muted mt-1 d-block">Used for CLTV (Combined LTV) calculation.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Original Purchase Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="ltv-purchase" class="form-control gs-input border-start-0" value="400000" min="0">
                        </div>
                        <small class="text-muted mt-1 d-block">Required to track property appreciation.</small>
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Scenarios:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 ltv-quick" data-v="350000" data-l="339500">3% Down (FHA)</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 ltv-quick" data-v="500000" data-l="400000">20% Equity (No PMI)</button>
                        <button class="btn btn-sm btn-outline-danger rounded-pill px-4 ltv-quick" data-v="300000" data-l="310000">Underwater Loan</button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Loan-to-Value Ratio</span>
                    <div class="gs-hero-value" id="ltv-result">80.0%</div>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm" id="ltv-badge">EXCELLENT</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Equity</span>
                            <span class="gs-stat-value text-primary" id="ltv-equity">$90,000</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Equity Percent</span>
                            <span class="gs-stat-value text-success" id="ltv-equity-pct">20.0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">CLTV Ratio</span>
                            <span class="gs-stat-value text-indigo" id="ltv-cltv" style="color: #6366f1;">80.0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Appreciation</span>
                            <span class="gs-stat-value" id="ltv-appr">$50,000</span>
                        </div>
                    </div>
                </div>

                <div class="gs-progress-wrapper">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3 d-flex justify-content-between">
                        <span><i class="fas fa-chart-pie me-2 text-primary"></i>Equity vs Loan</span>
                        <span id="ltv-summary-text">80% Owed</span>
                    </h6>
                    <div class="gs-progress">
                        <div class="gs-progress-bar" id="ltv-bar-loan" style="background: #ef4444; width: 80%;">Loan</div>
                        <div class="gs-progress-bar" id="ltv-bar-equity" style="background: #22c55e; width: 20%;">Equity</div>
                    </div>

                    <div class="mt-5">
                        <h6 class="fw-bold small text-uppercase text-muted mb-3"><i class="fas fa-list-check me-2 text-primary"></i>LTV Threshold Analysis</h6>
                        <div class="table-responsive">
                            <table class="table table-borderless gs-table mb-0">
                                <thead><tr class="text-muted small uppercase"><th>Limit</th><th>Category</th><th class="text-end">Status</th></tr></thead>
                                <tbody>
                                    <tr id="ltv-t-97"><td><span class="badge bg-danger rounded-pill px-3">97%</span></td><td>FHA Minimum Down</td><td class="text-end fw-bold" id="ltv-t-97-v">—</td></tr>
                                    <tr id="ltv-t-95"><td><span class="badge bg-warning rounded-pill px-3">95%</span></td><td>Conv. Min (5% Down)</td><td class="text-end fw-bold" id="ltv-t-95-v">—</td></tr>
                                    <tr id="ltv-t-80"><td><span class="badge bg-success rounded-pill px-3">80%</span></td><td>PMI Termination Level</td><td class="text-end fw-bold" id="ltv-t-80-v">—</td></tr>
                                    <tr id="ltv-t-75"><td><span class="badge bg-primary rounded-pill px-3">75%</span></td><td>Cash-Out Refi Limit</td><td class="text-end fw-bold" id="ltv-t-75-v">—</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="ltv-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="ltv-reset">
                        <i class="fas fa-rotate-left me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const fmt = v => '$' + Math.round(v).toLocaleString('en-US');

    function calculate() {
        const val = parseFloat($('ltv-value').value) || 0;
        const loan = parseFloat($('ltv-loan').value) || 0;
        const second = parseFloat($('ltv-second').value) || 0;
        const purchase = parseFloat($('ltv-purchase').value) || 0;

        const ltv = val > 0 ? (loan / val) * 100 : 0;
        const cltv = val > 0 ? ((loan + second) / val) * 100 : 0;
        const equity = val - loan - second;
        const eqPct = val > 0 ? (equity / val) * 100 : 0;
        const appr = val - purchase;

        $('ltv-result').textContent = ltv.toFixed(1) + '%';
        $('ltv-result').style.color = ltv <= 80 ? '#16a34a' : ltv <= 95 ? '#d97706' : '#dc2626';

        const badge = $('ltv-badge');
        if (ltv > 100) { badge.textContent = '🚨 UNDERWATER'; badge.className = 'badge bg-danger rounded-pill px-4 py-2 shadow-sm'; }
        else if (ltv > 95) { badge.textContent = '⚠️ PMI REQUIRED (HIGH)'; badge.className = 'badge bg-danger rounded-pill px-4 py-2 shadow-sm'; }
        else if (ltv > 80) { badge.textContent = '⚠️ PMI REQUIRED'; badge.className = 'badge bg-warning rounded-pill px-4 py-2 shadow-sm'; }
        else if (ltv > 75) { badge.textContent = '✅ EXCELLENT EQUITY'; badge.className = 'badge bg-success rounded-pill px-4 py-2 shadow-sm'; }
        else { badge.textContent = '💎 PRISTINE EQUITY'; badge.className = 'badge bg-primary rounded-pill px-4 py-2 shadow-sm'; }

        $('ltv-equity').textContent = fmt(equity);
        $('ltv-equity-pct').textContent = eqPct.toFixed(1) + '%';
        $('ltv-cltv').textContent = cltv.toFixed(1) + '%';
        
        $('ltv-appr').textContent = (appr >= 0 ? '+' : '-') + fmt(Math.abs(appr));
        $('ltv-appr').style.color = appr >= 0 ? '#16a34a' : '#dc2626';

        if (val > 0) {
            const lp = Math.min(100, (loan + second) / val * 100);
            $('ltv-bar-loan').style.width = lp + '%';
            $('ltv-bar-loan').textContent = Math.round(lp) + '% Owed';
            $('ltv-bar-equity').style.width = (100 - lp) + '%';
            $('ltv-bar-equity').textContent = Math.round(100 - lp) + '% Equity';
            $('ltv-summary-text').textContent = `${Math.round(lp)}% Owed • ${Math.round(100-lp)}% Equity`;
        }

        const thresholds = [{id: '97', pct: 97}, {id: '95', pct: 95}, {id: '80', pct: 80}, {id: '75', pct: 75}];
        thresholds.forEach(t => {
            const maxLoan = val * (t.pct / 100);
            const diff = loan - maxLoan;
            const el = $('ltv-t-' + t.id + '-v');
            const row = $('ltv-t-' + t.id);
            if (ltv <= t.pct) {
                el.textContent = '✅ MET';
                el.style.color = '#16a34a';
                row.style.opacity = '1';
            } else {
                el.textContent = 'Need ' + fmt(diff) + ' paydown';
                el.style.color = '#dc2626';
                row.style.opacity = '0.7';
            }
        });
    }

    ['ltv-value', 'ltv-loan', 'ltv-second', 'ltv-purchase'].forEach(id => $(id).addEventListener('input', calculate));
    
    document.querySelectorAll('.ltv-quick').forEach(b => b.addEventListener('click', () => {
        $('ltv-value').value = b.dataset.v;
        $('ltv-loan').value = b.dataset.l;
        $('ltv-second').value = 0;
        $('ltv-purchase').value = b.dataset.v;
        calculate();
    }));

    $('ltv-copy').addEventListener('click', function() {
        const text = `Loan-to-Value Analysis\nLTV: ${$('ltv-result').textContent}\nEquity: ${$('ltv-equity').textContent} (${$('ltv-equity-pct').textContent})\nAppreciation: ${$('ltv-appr').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('ltv-reset').addEventListener('click', () => {
        $('ltv-value').value = 450000;
        $('ltv-loan').value = 360000;
        $('ltv-second').value = 0;
        $('ltv-purchase').value = 400000;
        calculate();
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\loan-to-value-ltv.blade.php ENDPATH**/ ?>