@push('styles')
<style>
    :root {
        --gs-hue: 340;
        --gs-primary: hsl(var(--gs-hue), 85%, 55%);
        --gs-primary-light: hsl(var(--gs-hue), 85%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 85%, 55%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 85%, 55%, 0.03), hsla(var(--gs-hue), 85%, 75%, 0.06));
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

    .cc-scroll { max-height: 400px; overflow-y: auto; border-radius: 16px; border: 1px solid #f1f5f9; }
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
        .gs-card:not(.gs-card-output), .btn, .gs-presets, #cc-toggle { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
        .cc-scroll { max-height: none !important; overflow: visible !important; }
    }
</style>
@endpush

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-credit-card"></i></div>
                    <div>
                        <h4>Credit Card Payoff Calculator</h4>
                        <p>Crush your credit card debt by optimizing your repayment strategy and minimizing interest.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Total Card Balance</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="cc-balance" class="form-control gs-input border-start-0" value="5000" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Annual Interest (APR %)</label>
                        <div class="input-group">
                            <input type="number" id="cc-apr" class="form-control gs-input border-end-0" value="22.99" step="0.01" min="0">
                            <span class="input-group-text bg-white border-start-0 px-3 fs-5 fw-bold">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Minimum Payment</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="cc-minpay" class="form-control gs-input border-start-0" value="150" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Extra Monthly</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="cc-extra" class="form-control gs-input border-start-0" value="50" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Payment Logic</label>
                        <select id="cc-mintype" class="form-select gs-input">
                            <option value="fixed" selected>Fixed Payment</option>
                            <option value="percent">% of Balance</option>
                        </select>
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Start:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 cc-quick" data-b="2000" data-r="19.99" data-p="100">Store Card</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 cc-quick" data-b="8000" data-r="24.99" data-p="250">Premium Card</button>
                        <button class="btn btn-sm btn-outline-danger rounded-pill px-4 cc-quick" data-b="15000" data-r="29.99" data-p="450">High-Interest</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Freedom Timeline</span>
                    <div class="gs-hero-value" id="cc-timeline">0 Months</div>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm" id="cc-date">Debt-free by —</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Interest</span>
                            <span class="gs-stat-value text-danger" id="cc-total-int">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Amount Paid</span>
                            <span class="gs-stat-value text-primary" id="cc-total-paid">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Interest Saved</span>
                            <span class="gs-stat-value text-success" id="cc-saved">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Months Saved</span>
                            <span class="gs-stat-value text-warning" id="cc-months-saved">0</span>
                        </div>
                    </div>
                </div>

                <div class="gs-progress-wrapper">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3 d-flex justify-content-between">
                        <span><i class="fas fa-chart-pie me-2 text-danger"></i>Debt Composition</span>
                        <span id="cc-progress-text">Principal vs Interest Costs</span>
                    </h6>
                    <div class="gs-progress">
                        <div class="gs-progress-bar" id="cc-bar-p" style="background: #3b82f6; width: 70%;">Principal</div>
                        <div class="gs-progress-bar" id="cc-bar-i" style="background: #ef4444; width: 30%;">Interest</div>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold small text-uppercase text-muted mb-0"><i class="fas fa-table me-2 text-danger"></i>Monthly Payoff Schedule</h6>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 fw-bold" id="cc-toggle">Show Schedule</button>
                    </div>
                    <div id="cc-table-wrap" style="display:none;">
                        <div class="cc-scroll mt-3">
                            <table class="table gs-table mb-0">
                                <thead><tr><th>Month</th><th>Payment</th><th>Principal</th><th>Interest</th><th>Balance</th></tr></thead>
                                <tbody id="cc-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="cc-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="cc-reset">
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
    let amort = [];

    function runPayoff(bal, mr, getPayment, extra){
        let d = [], m = 0, ti = 0;
        let currentBal = bal;
        while(currentBal > 0.01 && m < 600){
            m++;
            const interest = currentBal * mr;
            let pmt = getPayment(currentBal);
            if(pmt <= interest) pmt = interest + 1; // Force progress if min payment is too low
            
            let principal = (pmt + extra) - interest;
            if(principal > currentBal) principal = currentBal;
            
            currentBal -= principal;
            ti += interest;
            d.push({month: m, payment: interest + principal, principal: principal, interest: interest, balance: Math.max(0, currentBal)});
        }
        return {data: d, totalInt: ti, months: m};
    }

    function calculate(){
        const bal = parseFloat($('cc-balance').value) || 0;
        const apr = (parseFloat($('cc-apr').value) || 0) / 100;
        const minpay = parseFloat($('cc-minpay').value) || 0;
        const extra = parseFloat($('cc-extra').value) || 0;
        const mintype = $('cc-mintype').value;
        const mr = apr / 12;

        const getPmt = mintype === 'percent' ? (b => Math.max(25, b * 0.02)) : (() => minpay);

        if(bal <= 0){
            $('cc-timeline').textContent = 'No Balance';
            $('cc-date').textContent = 'Enter a balance to begin.';
            return;
        }

        const base = runPayoff(bal, mr, getPmt, 0);
        const withExtra = runPayoff(bal, mr, getPmt, extra);
        amort = withExtra.data;

        const totalPaid = bal + withExtra.totalInt;
        const yrs = Math.floor(withExtra.months / 12);
        const mos = withExtra.months % 12;

        $('cc-timeline').textContent = yrs > 0 ? `${yrs}y ${mos}m` : `${mos} Months`;
        const now = new Date();
        const pd = new Date(now.getFullYear(), now.getMonth() + withExtra.months, 1);
        $('cc-date').textContent = 'Debt-free by ' + pd.toLocaleDateString('en-US', {month: 'long', year: 'numeric'});
        
        $('cc-total-int').textContent = fmt(withExtra.totalInt);
        $('cc-total-paid').textContent = fmt(totalPaid);
        
        if(extra > 0){
            $('cc-saved').textContent = fmt(base.totalInt - withExtra.totalInt);
            $('cc-months-saved').textContent = (base.months - withExtra.months);
        } else {
            $('cc-saved').textContent = '—';
            $('cc-months-saved').textContent = '—';
        }

        if(totalPaid > 0){
            const pp = (bal / totalPaid) * 100;
            $('cc-bar-p').style.width = pp + '%';
            $('cc-bar-p').textContent = Math.round(pp) + '% Principal';
            $('cc-bar-i').style.width = (100-pp) + '%';
            $('cc-bar-i').textContent = Math.round(100-pp) + '% Interest';
            $('cc-progress-text').textContent = `${Math.round(pp)}% Principal • ${Math.round(100-pp)}% Interest Cost`;
        }

        $('cc-tbody').innerHTML = amort.map(r => `<tr>
            <td>${r.month}</td>
            <td class="fw-bold">${fmt(r.payment)}</td>
            <td class="text-primary">${fmt(r.principal)}</td>
            <td class="text-danger">${fmt(r.interest)}</td>
            <td class="fw-bold">${fmt(r.balance)}</td>
        </tr>`).join('');
    }

    ['cc-balance','cc-apr','cc-minpay','cc-extra','cc-mintype'].forEach(id => {
        $(id).addEventListener('input', calculate);
        $(id).addEventListener('change', calculate);
    });

    $('cc-toggle').addEventListener('click', function(){
        const c = $('cc-table-wrap');
        if(c.style.display === 'none'){
            c.style.display = '';
            this.textContent = 'Hide Schedule';
        } else {
            c.style.display = 'none';
            this.textContent = 'Show Schedule';
        }
    });

    document.querySelectorAll('.cc-quick').forEach(b => b.addEventListener('click', () => {
        $('cc-balance').value = b.dataset.b;
        $('cc-apr').value = b.dataset.r;
        $('cc-minpay').value = b.dataset.p;
        $('cc-extra').value = 0;
        calculate();
    }));

    $('cc-copy').addEventListener('click', function(){
        const text = `Credit Card Payoff Plan\nTimeline: ${$('cc-timeline').textContent}\nTotal Paid: ${$('cc-total-paid').textContent}\nInterest Saved: ${$('cc-saved').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('cc-reset').addEventListener('click', () => location.reload());
    calculate();
});
</script>

