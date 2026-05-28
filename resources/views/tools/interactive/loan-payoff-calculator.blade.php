@push('styles')
<style>
    :root {
        --gs-hue: 220;
        --gs-primary: hsl(var(--gs-hue), 90%, 50%);
        --gs-primary-light: hsl(var(--gs-hue), 90%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 90%, 50%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 90%, 50%, 0.03), hsla(var(--gs-hue), 90%, 70%, 0.06));
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
        .gs-card:not(.gs-card-output), .btn, .gs-presets, #lp-toggle { display: none !important; }
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
                    <div class="gs-icon-box"><i class="fas fa-hand-holding-dollar"></i></div>
                    <div>
                        <h4>Loan Payoff Calculator</h4>
                        <p>Analyze your debt payoff timeline and discover how extra payments accelerate your freedom.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Current Loan Balance</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="lp-balance" class="form-control gs-input border-start-0" value="25000" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Annual Interest (%)</label>
                        <div class="input-group">
                            <input type="number" id="lp-rate" class="form-control gs-input border-end-0" value="6.5" step="0.1" min="0">
                            <span class="input-group-text bg-white border-start-0 px-3 fs-5 fw-bold">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Monthly Payment</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="lp-payment" class="form-control gs-input border-start-0" value="500" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Extra Monthly</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="lp-extra" class="form-control gs-input border-start-0" value="0" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">One-Time Lump Sum</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="lp-lump" class="form-control gs-input border-start-0" value="0" min="0">
                        </div>
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Loans:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 lp-quick" data-b="15000" data-r="5" data-p="300">Personal Loan</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 lp-quick" data-b="40000" data-r="4.5" data-p="750">Auto Loan</button>
                        <button class="btn btn-sm btn-outline-danger rounded-pill px-4 lp-quick" data-b="5000" data-r="22" data-p="200">Credit Card</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Time to Payoff</span>
                    <div class="gs-hero-value" id="lp-timeline">0 Months</div>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm" id="lp-payoff-date">Debt-free by —</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Interest</span>
                            <span class="gs-stat-value text-danger" id="lp-total-int">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Paid</span>
                            <span class="gs-stat-value text-primary" id="lp-total-paid">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Interest Saved</span>
                            <span class="gs-stat-value text-success" id="lp-saved">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Months Saved</span>
                            <span class="gs-stat-value text-warning" id="lp-months-saved">0</span>
                        </div>
                    </div>
                </div>

                <div class="gs-progress-wrapper">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3 d-flex justify-content-between">
                        <span><i class="fas fa-chart-pie me-2 text-primary"></i>Repayment Breakdown</span>
                        <span id="lp-progress-text">Principal vs Interest</span>
                    </h6>
                    <div class="gs-progress">
                        <div class="gs-progress-bar" id="lp-bar-principal" style="background: #3b82f6; width: 80%;">Principal</div>
                        <div class="gs-progress-bar" id="lp-bar-interest" style="background: #ef4444; width: 20%;">Interest</div>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold small text-uppercase text-muted mb-0"><i class="fas fa-table me-2 text-primary"></i>Amortization Schedule</h6>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 fw-bold" id="lp-toggle">Show Details</button>
                    </div>
                    <div id="lp-table-wrap" style="display:none;">
                        <div class="amort-scroll mt-3">
                            <table class="table gs-table mb-0">
                                <thead><tr><th>#</th><th>Payment</th><th>Principal</th><th>Interest</th><th>Extra</th><th>Balance</th></tr></thead>
                                <tbody id="lp-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="lp-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Summary
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="lp-reset">
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

    function runAmort(bal, mr, pmt, extra){
        let d = [], m = 0, ti = 0;
        while(bal > 0.01 && m < 600){
            m++;
            const ip = bal * mr;
            let pp = pmt - ip + extra;
            if(pp > bal) pp = bal;
            bal -= pp;
            if(bal < 0) bal = 0;
            ti += ip;
            d.push({month: m, payment: ip + pp, principal: pp, interest: ip, balance: bal, extraApplied: extra});
        }
        return {data: d, totalInt: ti, months: m};
    }

    function calculate(){
        let initialBal = parseFloat($('lp-balance').value) || 0;
        const rate = (parseFloat($('lp-rate').value) || 0) / 100;
        const pmt = parseFloat($('lp-payment').value) || 0;
        const extra = parseFloat($('lp-extra').value) || 0;
        const lump = parseFloat($('lp-lump').value) || 0;
        const mr = rate / 12;

        let bal = Math.max(0, initialBal - lump);
        if(pmt <= bal * mr && mr > 0){
            $('lp-timeline').textContent = '⚠️ Payment too low';
            $('lp-payoff-date').textContent = 'Debt will never be paid off.';
            return;
        }

        const base = runAmort(bal, mr, pmt, 0);
        const withExtra = runAmort(bal, mr, pmt, extra);
        amort = withExtra.data;

        const saved = base.totalInt - withExtra.totalInt;
        const mSaved = base.months - withExtra.months;
        const totalPaid = initialBal + withExtra.totalInt;

        const now = new Date();
        const pd = new Date(now.getFullYear(), now.getMonth() + withExtra.months, 1);
        const yrs = Math.floor(withExtra.months / 12);
        const mos = withExtra.months % 12;

        $('lp-timeline').textContent = yrs > 0 ? `${yrs}y ${mos}m` : `${mos} months`;
        $('lp-payoff-date').textContent = 'Debt-free by ' + pd.toLocaleDateString('en-US', {month: 'long', year: 'numeric'});
        $('lp-total-int').textContent = fmt(withExtra.totalInt);
        $('lp-total-paid').textContent = fmt(totalPaid);
        $('lp-saved').textContent = extra > 0 || lump > 0 ? fmt(saved) : '—';
        $('lp-months-saved').textContent = extra > 0 || lump > 0 ? mSaved : '—';

        if(totalPaid > 0){
            const pPrin = (initialBal / totalPaid) * 100;
            $('lp-bar-principal').style.width = pPrin + '%';
            $('lp-bar-principal').textContent = Math.round(pPrin) + '% Principal';
            $('lp-bar-interest').style.width = (100-pPrin) + '%';
            $('lp-bar-interest').textContent = Math.round(100-pPrin) + '% Interest';
            $('lp-progress-text').textContent = `${Math.round(pPrin)}% Principal • ${Math.round(100-pPrin)}% Total Interest`;
        }

        $('lp-tbody').innerHTML = amort.map(r => `<tr>
            <td>${r.month}</td><td>${fmt(r.payment)}</td>
            <td class="text-primary">${fmt(r.principal)}</td>
            <td class="text-danger">${fmt(r.interest)}</td>
            <td class="text-success">${r.extraApplied > 0 ? fmt(r.extraApplied) : '—'}</td>
            <td class="fw-bold">${fmt(r.balance)}</td>
        </tr>`).join('');
    }

    ['lp-balance','lp-rate','lp-payment','lp-extra','lp-lump'].forEach(id => $(id).addEventListener('input', calculate));

    $('lp-toggle').addEventListener('click', function(){
        const c = $('lp-table-wrap');
        if(c.style.display === 'none'){
            c.style.display = '';
            this.textContent = 'Hide Details';
        } else {
            c.style.display = 'none';
            this.textContent = 'Show Details';
        }
    });

    document.querySelectorAll('.lp-quick').forEach(b => b.addEventListener('click', () => {
        $('lp-balance').value = b.dataset.b;
        $('lp-rate').value = b.dataset.r;
        $('lp-payment').value = b.dataset.p;
        $('lp-extra').value = 0;
        $('lp-lump').value = 0;
        calculate();
    }));

    $('lp-copy').addEventListener('click', function(){
        const text = `Loan Payoff Summary\nTimeline: ${$('lp-timeline').textContent}\nTotal Paid: ${$('lp-total-paid').textContent}\nInterest Saved: ${$('lp-saved').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('lp-reset').addEventListener('click', () => location.reload());
    calculate();
});
</script>

