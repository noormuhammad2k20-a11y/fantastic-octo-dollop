<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --gs-hue: 280;
        --gs-primary: hsl(var(--gs-hue), 75%, 55%);
        --gs-primary-light: hsl(var(--gs-hue), 75%, 96%);
        --gs-primary-glow: hsla(var(--gs-hue), 75%, 55%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 75%, 55%, 0.03), hsla(var(--gs-hue), 75%, 65%, 0.06));
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

    .schedule-container { max-height: 500px; overflow-y: auto; border-radius: 20px; border: 1px solid #f1f5f9; background: #fff; }
    .gs-table { font-size: 0.85rem; }
    .gs-table thead { position: sticky; top: 0; background: #0f172a; color: #fff; z-index: 10; }

    .ratio-bar { height: 12px; border-radius: 6px; background: #f1f5f9; overflow: hidden; display: flex; margin-top: 1rem; }
    .ratio-p { background: var(--gs-primary); height: 100%; transition: width 0.6s ease; }
    .ratio-i { background: #ef4444; height: 100%; transition: width 0.6s ease; }

    @media (max-width: 768px) {
        .gs-card { padding: 1.5rem; }
        .gs-header { flex-direction: column; text-align: center; gap: 0.75rem; }
        .gs-icon-box { width: 48px; height: 48px; font-size: 1.25rem; border-radius: 14px; margin: 0 auto; }
        .gs-header h4 { font-size: 1.25rem; }
        .gs-hero-value { font-size: 2.5rem; }
        .gs-stat-value { font-size: 1.25rem; }
    }

    @media print {
        .gs-card:not(.gs-card-output), .btn, .gs-presets, #am-toggle { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
        .schedule-container { max-height: none !important; overflow: visible !important; }
    }
</style>
<?php $__env->stopPush(); ?>

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <h4>Amortization Schedule</h4>
                        <p>Generate a detailed month-by-month projection of your loan repayment.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="gs-label">Loan Amount ($)</label>
                        <input type="number" id="am-loan" class="form-control gs-input" value="250000">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Interest Rate (%)</label>
                        <input type="number" id="am-rate" class="form-control gs-input" value="6.5" step="0.125">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Term (Years)</label>
                        <input type="number" id="am-years" class="form-control gs-input" value="30">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Extra Monthly ($)</label>
                        <input type="number" id="am-extra" class="form-control gs-input" value="0">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Start Date</label>
                        <input type="month" id="am-start" class="form-control gs-input">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Projection View</label>
                        <select id="am-view" class="form-select gs-input">
                            <option value="monthly" selected>Monthly Breakdown</option>
                            <option value="yearly">Yearly Summary</option>
                        </select>
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Presets:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 am-quick" data-l="350000" data-r="6.75" data-y="30">Home Mortgage</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 am-quick" data-l="35000" data-r="7.5" data-y="6">Auto Finance</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 am-quick" data-l="15000" data-r="12" data-y="3">Personal Loan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Monthly Payment</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="am-pmt">0</span></div>
                    <div class="d-flex justify-content-center gap-4 mt-2">
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1" style="color: var(--gs-primary);"></i> Principal</div>
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1 text-danger"></i> Interest</div>
                    </div>
                    <div class="ratio-bar mx-auto" style="max-width: 400px;">
                        <div id="am-bar-p" class="ratio-p"></div>
                        <div id="am-bar-i" class="ratio-i"></div>
                    </div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Repayment</span>
                            <span class="gs-stat-value text-primary" id="am-total">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Interest</span>
                            <span class="gs-stat-value text-danger" id="am-int">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Interest Ratio</span>
                            <span class="gs-stat-value text-warning" id="am-ratio">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Payoff Date</span>
                            <span class="gs-stat-value text-success" id="am-payoff">—</span>
                        </div>
                    </div>
                </div>

                <div id="am-savings-row" class="row g-4 mt-2" style="display:none;">
                    <div class="col-md-6">
                        <div class="gs-stat-card border-success" style="background: hsla(142, 70%, 45%, 0.05);">
                            <span class="gs-stat-label text-success">Extra Payment Savings</span>
                            <span class="gs-stat-value text-success" id="am-saved">$0</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="gs-stat-card border-success" style="background: hsla(142, 70%, 45%, 0.05);">
                            <span class="gs-stat-label text-success">Time Saved</span>
                            <span class="gs-stat-value text-success" id="am-months-saved">0 Months</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold small text-uppercase text-muted mb-0"><i class="fas fa-list-ol me-2 text-primary"></i>Repayment Schedule</h6>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-3" id="am-toggle">Show Schedule</button>
                    </div>
                    <div id="am-table-wrap" class="schedule-container" style="display:none;">
                        <table class="table gs-table mb-0">
                            <thead><tr><th>#</th><th>Date</th><th>Payment</th><th>Principal</th><th>Interest</th><th>Extra</th><th>Balance</th></tr></thead>
                            <tbody id="am-tbody"></tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="am-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Summary
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="am-reset">
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
    const now = new Date();
    $('am-start').value = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0');
    let amortData = [];

    function buildAmort(loan, mr, pmt, extra, startY, startM){
        let d = [], bal = loan, m = 0, ti = 0;
        while(bal > 0.01 && m < 600){
            m++;
            const ip = bal * mr;
            let pp = pmt - ip;
            let ex = extra;
            if(pp + ex > bal) { pp = bal; ex = 0; }
            const applied = Math.min(ex, Math.max(0, bal - pp));
            bal -= (pp + applied);
            if(bal < 0) bal = 0;
            ti += ip;
            const dt = new Date(startY, startM + m - 1, 1);
            d.push({month: m, date: dt.toLocaleDateString('en-US', {month: 'short', year: 'numeric'}), payment: ip + pp + applied, principal: pp, interest: ip, extra: applied, balance: bal});
        }
        return {data: d, totalInt: ti, months: m};
    }

    function calculate(){
        const loan = parseFloat($('am-loan').value) || 0;
        const rate = (parseFloat($('am-rate').value) || 0) / 100;
        const years = parseInt($('am-years').value) || 30;
        const extra = parseFloat($('am-extra').value) || 0;
        const mr = rate / 12;
        const n = years * 12;

        const sp = ($('am-start').value || '').split('-');
        const sY = sp[0] ? parseInt(sp[0]) : now.getFullYear();
        const sM = sp[1] ? parseInt(sp[1]) - 1 : now.getMonth();

        let pmt = 0;
        if(mr > 0) pmt = loan * (mr * Math.pow(1 + mr, n)) / (Math.pow(1 + mr, n) - 1);
        else pmt = n > 0 ? loan / n : 0;

        const base = buildAmort(loan, mr, pmt, 0, sY, sM);
        const withExtra = buildAmort(loan, mr, pmt, extra, sY, sM);
        amortData = withExtra.data;

        const totalPaid = amortData.reduce((s, r) => s + r.payment, 0);
        const pd = new Date(sY, sM + withExtra.months, 1);

        $('am-pmt').textContent = Math.round(pmt + extra).toLocaleString('en-US');
        $('am-total').textContent = fmt(totalPaid);
        $('am-int').textContent = fmt(withExtra.totalInt);
        
        const ratio = totalPaid > 0 ? (withExtra.totalInt / totalPaid) * 100 : 0;
        $('am-ratio').textContent = ratio.toFixed(1) + '%';
        $('am-payoff').textContent = pd.toLocaleDateString('en-US', {month: 'short', year: 'numeric'});

        if(totalPaid > 0){
            const pp = ((totalPaid - withExtra.totalInt) / totalPaid) * 100;
            $('am-bar-p').style.width = pp + '%';
            $('am-bar-i').style.width = (100 - pp) + '%';
        }

        if(extra > 0){
            $('am-saved').textContent = fmt(base.totalInt - withExtra.totalInt);
            $('am-months-saved').textContent = (base.months - withExtra.months) + ' Months';
            $('am-savings-row').style.display = 'flex';
        } else {
            $('am-savings-row').style.display = 'none';
        }

        const view = $('am-view').value;
        if(view === 'yearly'){
            let yearly = [];
            for(let y=0; y<Math.ceil(amortData.length / 12); y++){
                const slice = amortData.slice(y * 12, y * 12 + 12);
                const last = slice[slice.length - 1];
                yearly.push({
                    year: y + 1,
                    date: last.date.split(' ')[1],
                    payment: slice.reduce((s, r) => s + r.payment, 0),
                    principal: slice.reduce((s, r) => s + r.principal, 0),
                    interest: slice.reduce((s, r) => s + r.interest, 0),
                    extra: slice.reduce((s, r) => s + r.extra, 0),
                    balance: last.balance
                });
            }
            $('am-tbody').innerHTML = yearly.map(r => `
                <tr>
                    <td class="fw-bold">Year ${r.year}</td>
                    <td class="text-muted">${r.date}</td>
                    <td class="fw-semibold">${fmt(r.payment)}</td>
                    <td class="text-primary">${fmt(r.principal)}</td>
                    <td class="text-danger">${fmt(r.interest)}</td>
                    <td class="text-success">${r.extra > 0 ? fmt(r.extra) : '—'}</td>
                    <td class="fw-bold">${fmt(r.balance)}</td>
                </tr>
            `).join('');
        } else {
            $('am-tbody').innerHTML = amortData.map(r => `
                <tr>
                    <td>${r.month}</td>
                    <td class="text-muted">${r.date}</td>
                    <td class="fw-semibold">${fmt(r.payment)}</td>
                    <td class="text-primary">${fmt(r.principal)}</td>
                    <td class="text-danger">${fmt(r.interest)}</td>
                    <td class="text-success">${r.extra > 0 ? fmt(r.extra) : '—'}</td>
                    <td class="fw-bold">${fmt(r.balance)}</td>
                </tr>
            `).join('');
        }
    }

    ['am-loan', 'am-rate', 'am-years', 'am-extra', 'am-start', 'am-view'].forEach(id => {
        $(id).addEventListener('input', calculate);
        $(id).addEventListener('change', calculate);
    });

    $('am-toggle').addEventListener('click', function(){
        const wrap = $('am-table-wrap');
        if(wrap.style.display === 'none'){
            wrap.style.display = 'block';
            this.textContent = 'Hide Schedule';
        } else {
            wrap.style.display = 'none';
            this.textContent = 'Show Schedule';
        }
    });

    document.querySelectorAll('.am-quick').forEach(b => b.addEventListener('click', () => {
        $('am-loan').value = b.dataset.l;
        $('am-rate').value = b.dataset.r;
        $('am-years').value = b.dataset.y;
        $('am-extra').value = 0;
        calculate();
    }));

    $('am-copy').addEventListener('click', function(){
        const t = `Amortization Summary\nMonthly: $${$('am-pmt').textContent}\nInterest: ${$('am-int').textContent}\nPayoff: ${$('am-payoff').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('am-reset').addEventListener('click', () => location.reload());

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\amortization-calculator.blade.php ENDPATH**/ ?>