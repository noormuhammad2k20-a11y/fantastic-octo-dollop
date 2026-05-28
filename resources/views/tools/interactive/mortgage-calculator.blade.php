@push('styles')
<style>
    :root {
        --gs-hue: 210;
        --gs-primary: hsl(var(--gs-hue), 90%, 45%);
        --gs-primary-light: hsl(var(--gs-hue), 90%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 90%, 45%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 90%, 45%, 0.03), hsla(var(--gs-hue), 90%, 55%, 0.06));
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

    .cost-row { display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #f1f5f9; }
    .cost-row:last-child { border-bottom: none; }
    .cost-total { font-size: 1.25rem; font-weight: 900; color: var(--gs-primary); border-top: 2px solid var(--gs-primary-glow); margin-top: 1rem; padding-top: 1rem; }

    .schedule-wrap { max-height: 400px; overflow-y: auto; border-radius: 16px; border: 1px solid #f1f5f9; }
    .gs-table { font-size: 0.85rem; }
    .gs-table thead { position: sticky; top: 0; background: #0f172a; color: #fff; z-index: 10; }

    @media (max-width: 768px) {
        .gs-card { padding: 1.5rem; }
        .gs-header { flex-direction: column; text-align: center; gap: 0.75rem; }
        .gs-icon-box { width: 48px; height: 48px; font-size: 1.25rem; border-radius: 14px; margin: 0 auto; }
        .gs-header h4 { font-size: 1.25rem; }
        .gs-hero-value { font-size: 2.5rem; }
        .gs-stat-value { font-size: 1.25rem; }
    }

    @media print {
        .gs-card:not(.gs-card-output), .btn, .gs-presets, .schedule-toggle { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
        .schedule-wrap { max-height: none !important; overflow: visible !important; }
    }
</style>
@endpush

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-house-chimney"></i></div>
                    <div>
                        <h4>Mortgage Calculator</h4>
                        <p>Detailed breakdown of your monthly housing costs and amortization schedule.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Home Purchase Price ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="mg-price" class="form-control gs-input border-start-0" value="400000" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Down Payment ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="mg-down" class="form-control gs-input border-start-0" value="80000" min="0">
                        </div>
                        <small class="text-muted mt-2 d-block fw-bold" id="mg-down-pct">20.0% Down Payment</small>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="mg-rate" class="form-control gs-input border-end-0" value="6.75" step="0.125" min="0">
                            <span class="input-group-text bg-white border-start-0 px-3 fs-5 fw-bold">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Loan Term</label>
                        <select id="mg-term" class="form-select gs-input">
                            <option value="15">15 Years (Fixed)</option>
                            <option value="20">20 Years (Fixed)</option>
                            <option value="30" selected>30 Years (Fixed)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Extra Monthly ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="mg-extra" class="form-control gs-input border-start-0" value="0" min="0">
                        </div>
                    </div>
                </div>

                <div class="mt-5 p-4 bg-light rounded-4 border-dashed">
                    <h6 class="fw-bold small text-uppercase text-muted mb-4"><i class="fas fa-file-invoice-dollar me-2 text-primary"></i>Taxes & Fees (Monthly)</h6>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="gs-label">Prop. Tax / Yr</label>
                            <input type="number" id="mg-tax" class="form-control gs-input" value="4800">
                        </div>
                        <div class="col-md-3">
                            <label class="gs-label">Insurance / Yr</label>
                            <input type="number" id="mg-ins" class="form-control gs-input" value="1500">
                        </div>
                        <div class="col-md-3">
                            <label class="gs-label">PMI / Yr</label>
                            <input type="number" id="mg-pmi" class="form-control gs-input" value="0">
                        </div>
                        <div class="col-md-3">
                            <label class="gs-label">HOA / Mo</label>
                            <input type="number" id="mg-hoa" class="form-control gs-input" value="0">
                        </div>
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Scenarios:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 mg-quick" data-p="250000" data-d="12500" data-r="7" data-t="30">Starter Home</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 mg-quick" data-p="500000" data-d="100000" data-r="6.5" data-t="30">Executive Home</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 mg-quick" data-p="1000000" data-d="200000" data-r="6" data-t="30">Estate Luxury</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Total Monthly Payment</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="mg-monthly">0</span></div>
                    <div class="text-muted fw-bold small" id="mg-pi-label">P&I: $0 + Taxes/Fees: $0</div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Loan Principal</span>
                            <span class="gs-stat-value text-primary" id="mg-loan">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Interest</span>
                            <span class="gs-stat-value text-danger" id="mg-int">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Cost</span>
                            <span class="gs-stat-value" style="color: #6366f1;" id="mg-true">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Payoff Year</span>
                            <span class="gs-stat-value text-success" id="mg-payoff">—</span>
                        </div>
                    </div>
                </div>

                <div id="mg-savings-row" class="row g-4 mt-2" style="display:none;">
                    <div class="col-md-4">
                        <div class="gs-stat-card border-success" style="background: hsla(142, 70%, 45%, 0.05);">
                            <span class="gs-stat-label text-success">Interest Saved</span>
                            <span class="gs-stat-value text-success" id="mg-saved">$0</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="gs-stat-card border-success" style="background: hsla(142, 70%, 45%, 0.05);">
                            <span class="gs-stat-label text-success">Time Saved</span>
                            <span class="gs-stat-value text-success" id="mg-yrs-saved">0 yrs</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="gs-stat-card border-success" style="background: hsla(142, 70%, 45%, 0.05);">
                            <span class="gs-stat-label text-success">Early Payoff</span>
                            <span class="gs-stat-value text-success" id="mg-early">—</span>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mt-4">
                    <div class="col-lg-6">
                        <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                            <h6 class="fw-bold small text-uppercase text-muted mb-3">Cost Composition</h6>
                            <div class="cost-row"><span>Principal & Interest</span><span class="fw-bold" id="mg-r-pi">$0</span></div>
                            <div class="cost-row"><span>Property Taxes</span><span class="text-muted" id="mg-r-tax">$0</span></div>
                            <div class="cost-row"><span>Home Insurance</span><span class="text-muted" id="mg-r-ins">$0</span></div>
                            <div class="cost-row"><span>PMI</span><span class="text-muted" id="mg-r-pmi">$0</span></div>
                            <div class="cost-row"><span>HOA Dues</span><span class="text-muted" id="mg-r-hoa">$0</span></div>
                            <div class="cost-total d-flex justify-content-between"><span>Monthly Total</span><span id="mg-r-total">$0</span></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold small text-uppercase text-muted mb-0">Amortization Table</h6>
                                <button class="btn btn-sm btn-outline-dark rounded-pill px-3 schedule-toggle" id="mg-toggle">Show Schedule</button>
                            </div>
                            <div id="mg-table-wrap" class="schedule-wrap" style="display:none;">
                                <table class="table gs-table mb-0">
                                    <thead><tr><th>Yr</th><th>Payment</th><th>Principal</th><th>Interest</th><th>Balance</th></tr></thead>
                                    <tbody id="mg-tbody"></tbody>
                                </table>
                            </div>
                            <div id="mg-table-placeholder" class="text-center py-5 text-muted small">
                                <i class="fas fa-table-list fa-2x mb-2 opacity-25"></i>
                                <p>Click 'Show Schedule' to view yearly projection</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="mc-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="mc-reset">
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

    function calculate(){
        const price = parseFloat($('mg-price').value) || 0;
        const down = parseFloat($('mg-down').value) || 0;
        const rate = (parseFloat($('mg-rate').value) || 0) / 100;
        const term = parseInt($('mg-term').value) || 30;
        const extra = parseFloat($('mg-extra').value) || 0;
        const tax = (parseFloat($('mg-tax').value) || 0) / 12;
        const ins = (parseFloat($('mg-ins').value) || 0) / 12;
        const pmi = (parseFloat($('mg-pmi').value) || 0) / 12;
        const hoa = parseFloat($('mg-hoa').value) || 0;

        const loan = Math.max(0, price - down);
        const mr = rate / 12;
        const n = term * 12;

        const downPct = price > 0 ? (down / price) * 100 : 0;
        $('mg-down-pct').textContent = downPct.toFixed(1) + '% Down Payment';

        let pi = 0;
        if(mr > 0){
            pi = loan * (mr * Math.pow(1 + mr, n)) / (Math.pow(1 + mr, n) - 1);
        } else {
            pi = n > 0 ? loan / n : 0;
        }

        const totalMonthly = pi + tax + ins + pmi + hoa + extra;

        amort = [];
        let bal = loan;
        let totalInt = 0;
        let month = 0;
        while(bal > 0.01 && month < n + 120){
            month++;
            const ip = bal * mr;
            let pp = pi - ip + extra;
            if(pp > bal) pp = bal;
            bal -= pp;
            if(bal < 0) bal = 0;
            totalInt += ip;
            amort.push({month, payment: ip + pp, principal: pp, interest: ip, balance: bal});
        }

        let baseTotalInt = 0;
        if(mr > 0) baseTotalInt = pi * n - loan;

        const trueCost = price + totalInt + tax * amort.length + ins * amort.length;
        const now = new Date();
        const pd = new Date(now.getFullYear(), now.getMonth() + amort.length, 1);

        $('mg-monthly').textContent = Math.round(totalMonthly).toLocaleString('en-US');
        $('mg-pi-label').textContent = `P&I: ${fmt(pi)} + Escrow: ${fmt(tax + ins + pmi + hoa)}`;
        $('mg-loan').textContent = fmt(loan);
        $('mg-int').textContent = fmt(totalInt);
        $('mg-true').textContent = fmt(trueCost);
        $('mg-payoff').textContent = pd.getFullYear();

        $('mg-r-pi').textContent = fmt(pi);
        $('mg-r-tax').textContent = fmt(tax);
        $('mg-r-ins').textContent = fmt(ins);
        $('mg-r-pmi').textContent = fmt(pmi);
        $('mg-r-hoa').textContent = fmt(hoa);
        $('mg-r-total').textContent = fmt(totalMonthly);

        if(extra > 0 && mr > 0){
            const saved = baseTotalInt - totalInt;
            const mSaved = n - amort.length;
            $('mg-saved').textContent = fmt(saved);
            $('mg-yrs-saved').textContent = (mSaved / 12).toFixed(1) + ' Years';
            const earlyDate = new Date(now.getFullYear(), now.getMonth() + amort.length, 1);
            $('mg-early').textContent = earlyDate.toLocaleDateString('en-US', {month: 'short', year: 'numeric'});
            $('mg-savings-row').style.display = 'flex';
        } else {
            $('mg-savings-row').style.display = 'none';
        }

        $('mg-tbody').innerHTML = amort.filter((_, i) => (i + 1) % 12 === 0 || i === amort.length - 1).map(r => `
            <tr>
                <td class="fw-bold">Yr ${Math.ceil(r.month / 12)}</td>
                <td>${fmt(r.payment)}</td>
                <td class="text-success">${fmt(r.principal)}</td>
                <td class="text-danger">${fmt(r.interest)}</td>
                <td class="fw-bold">${fmt(r.balance)}</td>
            </tr>
        `).join('');
    }

    ['mg-price', 'mg-down', 'mg-rate', 'mg-term', 'mg-extra', 'mg-tax', 'mg-ins', 'mg-pmi', 'mg-hoa'].forEach(id => {
        $(id).addEventListener('input', calculate);
        $(id).addEventListener('change', calculate);
    });

    $('mg-toggle').addEventListener('click', function(){
        const wrap = $('mg-table-wrap');
        const place = $('mg-table-placeholder');
        if(wrap.style.display === 'none'){
            wrap.style.display = 'block';
            place.style.display = 'none';
            this.textContent = 'Hide Schedule';
        } else {
            wrap.style.display = 'none';
            place.style.display = 'block';
            this.textContent = 'Show Schedule';
        }
    });

    document.querySelectorAll('.mg-quick').forEach(b => b.addEventListener('click', () => {
        $('mg-price').value = b.dataset.p;
        $('mg-down').value = b.dataset.d;
        $('mg-rate').value = b.dataset.r;
        $('mg-term').value = b.dataset.t;
        $('mg-extra').value = 0;
        calculate();
    }));

    $('mc-copy').addEventListener('click', function(){
        const t = `Mortgage Summary\nMonthly: $${$('mg-monthly').textContent}\nLoan: ${$('mg-loan').textContent}\nPayoff: ${$('mg-payoff').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('mc-reset').addEventListener('click', () => location.reload());

    calculate();
});
</script>
