@push('styles')
<style>
    :root {
        --gs-hue: 38;
        --gs-primary: hsl(var(--gs-hue), 95%, 45%);
        --gs-primary-light: hsl(var(--gs-hue), 95%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 95%, 45%, 0.15);
        --gs-bg-glass: rgba(255, 255, 255, 0.8);
        --gs-border: 1px solid rgba(0, 0, 0, 0.08);
        --gs-radius: 24px;
        --gs-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
    }

    .gs-rebuilt { font-family: 'Inter', sans-serif; color: #1e293b; }
    
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 95%, 45%, 0.03), hsla(var(--gs-hue), 95%, 65%, 0.06));
        border: 2px solid var(--gs-primary-glow);
    }

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

    .gs-label { font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569; margin-bottom: 0.75rem; display: block; }
    .gs-input {
        border-radius: 16px !important; border: 2px solid #f1f5f9 !important;
        padding: 1rem 1.25rem !important; font-size: 1.1rem !important; font-weight: 600 !important;
        transition: all 0.2s !important; background: #fff !important;
    }
    .gs-input:focus { border-color: var(--gs-primary) !important; box-shadow: 0 0 0 4px var(--gs-primary-glow) !important; outline: none; }
    
    .gs-hero { text-align: center; padding-bottom: 2rem; border-bottom: 2px solid rgba(0,0,0,0.03); }
    .gs-hero-label { font-size: 0.8rem; font-weight: 900; letter-spacing: 3px; color: #64748b; text-transform: uppercase; margin-bottom: 0.75rem; display: block; }
    .gs-hero-value { font-size: 4rem; font-weight: 900; color: #0f172a; line-height: 1; letter-spacing: -2px; margin-bottom: 0.5rem; word-break: break-all; }
    
    .gs-stat-card {
        background: #fff; border: 1px solid rgba(0,0,0,0.05); border-radius: 20px;
        padding: 1.25rem 1rem; text-align: center; height: 100%;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .gs-stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .gs-stat-label { font-size: 0.65rem; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 0.4rem; display: block; }
    .gs-stat-value { font-size: 1.5rem; font-weight: 900; color: #0f172a; display: block; }

    .gs-progress-wrapper { background: #fff; padding: 2rem; border-radius: 24px; border: 1px solid rgba(0,0,0,0.05); margin-top: 2rem; }
    .gs-progress { height: 32px; border-radius: 100px; background: #f1f5f9; overflow: hidden; display: flex; }
    .gs-progress-bar { height: 100%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; color: #fff; transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1); }

    .amort-scroll { max-height: 400px; overflow-y: auto; border-radius: 16px; border: 1px solid #f1f5f9; }
    .gs-table { font-size: 0.85rem; }
    .gs-table thead { position: sticky; top: 0; background: #0f172a; color: #fff; z-index: 10; }
    .gs-table th { padding: 1rem; }
    .gs-table td { padding: 0.75rem 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }

    @media (max-width: 768px) {
        .gs-card { padding: 1.5rem; }
        .gs-header { flex-direction: column; text-align: center; gap: 0.75rem; }
        .gs-icon-box { width: 48px; height: 48px; font-size: 1.25rem; border-radius: 14px; margin: 0 auto; }
        .gs-header h4 { font-size: 1.25rem; }
        .gs-hero-value { font-size: 2.5rem; }
        .gs-stat-value { font-size: 1.25rem; }
    }

    @media print {
        .gs-card:not(.gs-card-output), .btn, .gs-presets, #al-toggle-amort { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
        .amort-scroll { max-height: none !important; overflow: visible !important; }
    }
</style>
@endpush

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-car-side"></i></div>
                    <div>
                        <h4>Auto Loan Calculator</h4>
                        <p>Calculate your monthly car payments, total interest, and vehicle cost breakdown.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Vehicle Price (OTD)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="al-price" class="form-control gs-input border-start-0" value="35000" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Down Payment + Trade-In</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="al-down" class="form-control gs-input border-start-0" value="5000" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Interest Rate (APR %)</label>
                        <input type="number" id="al-apr" class="form-control gs-input" value="7.5" step="0.1" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Loan Term (Months)</label>
                        <select id="al-term" class="form-select gs-input">
                            <option value="24">24 Months (2 Yrs)</option>
                            <option value="36">36 Months (3 Yrs)</option>
                            <option value="48">48 Months (4 Yrs)</option>
                            <option value="60" selected>60 Months (5 Yrs)</option>
                            <option value="72">72 Months (6 Yrs)</option>
                            <option value="84">84 Months (7 Yrs)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Sales Tax Rate (%)</label>
                        <input type="number" id="al-tax" class="form-control gs-input" value="0" step="0.1" min="0" max="15">
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Extra Monthly Payment</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="al-extra" class="form-control gs-input border-start-0" value="0" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Start Date</label>
                        <input type="month" id="al-start" class="form-control gs-input">
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Presets:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 al-quick" data-p="15000" data-d="2000" data-r="9.5" data-t="48">Used Sedan</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 al-quick" data-p="32000" data-d="4000" data-r="1.9" data-t="36">Promo Rate</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 al-quick" data-p="45000" data-d="5000" data-r="7.5" data-t="72">SUV 72-Mo</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Monthly Payment</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="al-monthly">0</span></div>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm" id="al-badge">STANDARD</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Amount Financed</span>
                            <span class="gs-stat-value text-primary" id="al-financed">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Interest</span>
                            <span class="gs-stat-value text-danger" id="al-interest">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">True Vehicle Cost</span>
                            <span class="gs-stat-value" style="color: #8b5cf6;" id="al-truecost">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Payoff Date</span>
                            <span class="gs-stat-value text-success" id="al-payoff">—</span>
                        </div>
                    </div>
                </div>

                <div id="al-savings-row" class="row g-4 mt-1" style="display:none;">
                    <div class="col-md-4"><div class="gs-stat-card border-success"><span class="gs-stat-label">Interest Saved</span><span class="gs-stat-value text-success" id="al-saved">$0</span></div></div>
                    <div class="col-md-4"><div class="gs-stat-card border-success"><span class="gs-stat-label">Time Saved</span><span class="gs-stat-value text-success" id="al-months-saved">0 Months</span></div></div>
                    <div class="col-md-4"><div class="gs-stat-card border-success"><span class="gs-stat-label">Early Payoff</span><span class="gs-stat-value text-success" id="al-early-payoff">—</span></div></div>
                </div>

                <div class="gs-progress-wrapper">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3 d-flex justify-content-between">
                        <span><i class="fas fa-chart-pie me-2 text-primary"></i>Cost Composition</span>
                    </h6>
                    <div class="gs-progress">
                        <div class="gs-progress-bar" id="al-bar-principal" style="background: #3b82f6; width: 80%;">Principal</div>
                        <div class="gs-progress-bar" id="al-bar-interest" style="background: #ef4444; width: 20%;">Interest</div>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold small text-uppercase text-muted mb-0"><i class="fas fa-table me-2 text-primary"></i>Amortization Schedule</h6>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 fw-bold" id="al-toggle-amort">Show Details</button>
                    </div>
                    <div id="al-amort-container" style="display:none;">
                        <div class="amort-scroll mt-3">
                            <table class="table gs-table mb-0">
                                <thead><tr><th>#</th><th>Date</th><th>Payment</th><th>Principal</th><th>Interest</th><th>Extra</th><th>Balance</th></tr></thead>
                                <tbody id="al-amort-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="al-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Summary
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="al-reset">
                        <i class="fas fa-rotate-left me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const fmt = v => '$' + Math.round(v).toLocaleString('en-US');
    const startInput = $('al-start');
    const today = new Date();
    startInput.value = today.getFullYear() + '-' + String(today.getMonth()+1).padStart(2,'0');

    let amortData = [];

    function calculate(){
        const price = parseFloat($('al-price').value) || 0;
        const down = parseFloat($('al-down').value) || 0;
        const apr = (parseFloat($('al-apr').value) || 0) / 100;
        const term = parseInt($('al-term').value) || 60;
        const taxRate = (parseFloat($('al-tax').value) || 0) / 100;
        const extra = parseFloat($('al-extra').value) || 0;

        const taxAmount = price * taxRate;
        const financed = Math.max(0, price + taxAmount - down);
        const monthlyRate = apr / 12;

        let pmt = 0, totalInterest = 0, totalPaid = 0;
        if(financed > 0){
            if(monthlyRate === 0){
                pmt = financed / term;
            } else {
                pmt = financed * (monthlyRate * Math.pow(1 + monthlyRate, term)) / (Math.pow(1 + monthlyRate, term) - 1);
            }
        }

        amortData = [];
        let balance = financed;
        let totalIntWithExtra = 0;
        let monthCount = 0;
        const startParts = ($('al-start').value || '').split('-');
        let startYear = startParts[0] ? parseInt(startParts[0]) : today.getFullYear();
        let startMonth = startParts[1] ? parseInt(startParts[1]) - 1 : today.getMonth();

        while(balance > 0.01 && monthCount < 600){
            monthCount++;
            const intPortion = balance * monthlyRate;
            let prinPortion = pmt - intPortion;
            let extraThisMonth = extra;

            if(prinPortion + extraThisMonth > balance){
                extraThisMonth = Math.max(0, balance - prinPortion);
            }
            if(prinPortion > balance) prinPortion = balance;

            const extraApplied = Math.min(extraThisMonth, Math.max(0, balance - prinPortion));
            balance -= (prinPortion + extraApplied);
            if(balance < 0) balance = 0;
            totalIntWithExtra += intPortion;

            const d = new Date(startYear, startMonth + monthCount, 1);
            amortData.push({
                month: monthCount,
                date: d.toLocaleDateString('en-US', {month:'short', year:'numeric'}),
                payment: intPortion + prinPortion + extraApplied,
                principal: prinPortion,
                interest: intPortion,
                extra: extraApplied,
                balance: balance
            });
        }

        const trueCost = price + taxAmount + totalIntWithExtra;
        const actualPayoff = amortData.length;
        const payoffDate = new Date(startYear, startMonth + actualPayoff, 1);

        $('al-monthly').textContent = Math.round(pmt + extra).toLocaleString('en-US');
        $('al-financed').textContent = fmt(financed);
        $('al-interest').textContent = fmt(totalIntWithExtra);
        $('al-truecost').textContent = fmt(trueCost);
        $('al-payoff').textContent = payoffDate.toLocaleDateString('en-US', {month:'short', year:'numeric'});

        const badge = $('al-badge');
        if(apr > 0.15){ badge.textContent='⚠️ HIGH RATE'; badge.style.background='#ef4444'; }
        else if(term > 60){ badge.textContent='⏳ LONG TERM'; badge.style.background='#f59e0b'; }
        else if(apr < 0.04 && apr > 0){ badge.textContent='💰 CHEAP DEAL'; badge.style.background='#10b981'; }
        else { badge.textContent='✅ STANDARD'; badge.style.background='#3b82f6'; }

        if(trueCost > 0){
            const pPrin = ((price + taxAmount) / trueCost) * 100;
            $('al-bar-principal').style.width = pPrin + '%';
            $('al-bar-principal').textContent = Math.round(pPrin) + '% Principal';
            $('al-bar-interest').style.width = (100-pPrin) + '%';
            $('al-bar-interest').textContent = Math.round(100-pPrin) + '% Interest';
        }

        if(extra > 0 && monthlyRate > 0){
            $('al-savings-row').style.display = '';
            $('al-months-saved').textContent = (term - actualPayoff) + ' Months';
        } else {
            $('al-savings-row').style.display = 'none';
        }

        $('al-amort-body').innerHTML = amortData.map(r => `<tr>
            <td>${r.month}</td><td>${r.date}</td><td>${fmt(r.payment)}</td>
            <td class="text-primary">${fmt(r.principal)}</td><td class="text-danger">${fmt(r.interest)}</td>
            <td class="text-success">${r.extra > 0 ? fmt(r.extra) : '—'}</td><td class="fw-bold">${fmt(r.balance)}</td>
        </tr>`).join('');
    }

    ['al-price','al-down','al-apr','al-term','al-tax','al-extra','al-start'].forEach(id => {
        $(id).addEventListener('input', calculate);
        $(id).addEventListener('change', calculate);
    });

    $('al-toggle-amort').addEventListener('click', function(){
        const c = $('al-amort-container');
        if(c.style.display === 'none'){
            c.style.display = '';
            this.textContent = 'Hide Details';
        } else {
            c.style.display = 'none';
            this.textContent = 'Show Details';
        }
    });

    document.querySelectorAll('.al-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            $('al-price').value = btn.dataset.p;
            $('al-down').value = btn.dataset.d;
            $('al-apr').value = btn.dataset.r;
            $('al-term').value = btn.dataset.t;
            calculate();
        });
    });

    $('al-copy').addEventListener('click', function(){
        const text = `Auto Loan Summary\nMonthly Payment: $${$('al-monthly').textContent}\nFinanced: ${$('al-financed').textContent}\nTotal Interest: ${$('al-interest').textContent}\nPayoff: ${$('al-payoff').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('al-reset').addEventListener('click', () => location.reload());
    calculate();
});
</script>
