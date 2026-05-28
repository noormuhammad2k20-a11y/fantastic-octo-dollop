<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --gs-hue: 235;
        --gs-primary: hsl(var(--gs-hue), 85%, 50%);
        --gs-primary-light: hsl(var(--gs-hue), 85%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 85%, 50%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 85%, 50%, 0.03), hsla(var(--gs-hue), 85%, 60%, 0.06));
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

    .gs-table { font-size: 0.9rem; }

    @media (max-width: 768px) {
        .gs-card { padding: 1.5rem; }
        .gs-header { flex-direction: column; text-align: center; gap: 0.75rem; }
        .gs-icon-box { width: 48px; height: 48px; font-size: 1.25rem; border-radius: 14px; margin: 0 auto; }
        .gs-header h4 { font-size: 1.25rem; }
        .gs-hero-value { font-size: 2.5rem; }
        .gs-stat-value { font-size: 1.25rem; }
    }

    @media print {
        .gs-card:not(.gs-card-output), .btn, .gs-presets { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
    }
</style>
<?php $__env->stopPush(); ?>

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fab fa-stripe"></i></div>
                    <div>
                        <h4>Stripe Fee Calculator</h4>
                        <p>Forecast processing costs for credit cards, wallets, and ACH transfers. Optimize for international settlement.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Transaction Amount ($)</label>
                        <input type="number" id="sf-amount" class="form-control gs-input" value="100" step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Payment Method</label>
                        <select id="sf-type" class="form-select gs-input">
                            <option value="card" selected>Card - Domestic (2.9% + $0.30)</option>
                            <option value="intl">Card - International (3.9% + $0.30)</option>
                            <option value="intl_conv">Intl + Conv. (4.9% + $0.30)</option>
                            <option value="ach">ACH Transfer (0.8%, $5 cap)</option>
                            <option value="custom">Custom Rate</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="sf-custom-wrap" style="display:none;">
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="gs-label">Rate (%)</label>
                                <input type="number" id="sf-custom-pct" class="form-control gs-input" value="2.9" step="0.01">
                            </div>
                            <div class="col-6">
                                <label class="gs-label">Fixed ($)</label>
                                <input type="number" id="sf-custom-fixed" class="form-control gs-input" value="0.30" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Calculation Mode</label>
                        <select id="sf-solve" class="form-select gs-input">
                            <option value="fee">Show Net Received</option>
                            <option value="charge">Show Amount to Invoice</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Batch Size (Qty)</label>
                        <input type="number" id="sf-qty" class="form-control gs-input" value="1" min="1">
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Amounts:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 sf-quick" data-a="25">$25</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 sf-quick" data-a="99">$99</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 sf-quick" data-a="499">$499</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 sf-quick" data-a="1500">$1,500</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label" id="sf-hero-label">Net Settlement Amount</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="sf-net">0</span></div>
                    <div class="text-muted fw-bold small">Rate Applied: <span id="sf-applied-rate">...</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Stripe Fee</span>
                            <span class="gs-stat-value text-danger" id="sf-fee">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Effective Rate</span>
                            <span class="gs-stat-value text-primary" id="sf-eff">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Batch Net</span>
                            <span class="gs-stat-value text-success" id="sf-batch-net">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Batch Fees</span>
                            <span class="gs-stat-value text-warning" id="sf-batch-fees">$0</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3">Fee Breakdown</h6>
                    <div class="table-responsive rounded-4 border p-3 bg-white">
                        <table class="table gs-table mb-0">
                            <tbody>
                                <tr><td class="text-muted">Gross Transaction</td><td class="text-end fw-bold" id="sf-r-gross">$0</td></tr>
                                <tr><td class="text-muted">Processing Fee (<span id="sf-r-pct">0</span>%)</td><td class="text-end text-danger" id="sf-r-pct-val">-$0</td></tr>
                                <tr><td class="text-muted">Fixed Transaction Fee</td><td class="text-end text-danger" id="sf-r-fixed-val">-$0</td></tr>
                                <tr class="border-top"><td class="fw-bold pt-2">Total Stripe Fee</td><td class="text-end fw-bold text-danger pt-2" id="sf-r-total-fee">-$0</td></tr>
                                <tr><td class="fw-bold text-success">Net Payout</td><td class="text-end fw-bold text-success fs-5" id="sf-r-net">$0</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="st-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Receipt
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="st-reset">
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
    const fmt = v => '$' + v.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    
    const rates = {
        card: {pct: 2.9, fixed: 0.30},
        intl: {pct: 3.9, fixed: 0.30},
        intl_conv: {pct: 4.9, fixed: 0.30},
        ach: {pct: 0.8, fixed: 0, cap: 5}
    };

    function calculate(){
        const amt = parseFloat($('sf-amount').value) || 0;
        const type = $('sf-type').value;
        const solve = $('sf-solve').value;
        const qty = parseInt($('sf-qty').value) || 1;
        
        let pct, fixed, cap = Infinity;
        if(type === 'custom'){
            pct = parseFloat($('sf-custom-pct').value) || 0;
            fixed = parseFloat($('sf-custom-fixed').value) || 0;
            $('sf-custom-wrap').style.display = 'block';
        } else {
            const r = rates[type];
            pct = r.pct;
            fixed = r.fixed;
            if(r.cap) cap = r.cap;
            $('sf-custom-wrap').style.display = 'none';
        }

        const pctDec = pct / 100;
        let gross, fee, net;

        if(solve === 'fee'){
            gross = amt;
            const pctFeeVal = Math.min(gross * pctDec, cap);
            fee = pctFeeVal + fixed;
            net = gross - fee;
            $('sf-hero-label').textContent = 'Net Settlement Amount';
        } else {
            // Note: pass-fee logic with caps is complex, using simplified formula
            gross = pctDec < 1 ? (amt + fixed) / (1 - pctDec) : amt;
            const pctFeeVal = Math.min(gross * pctDec, cap);
            fee = pctFeeVal + fixed;
            net = gross - fee;
            $('sf-hero-label').textContent = 'Amount to Invoice';
        }

        const effRate = gross > 0 ? (fee / gross) * 100 : 0;

        $('sf-net').textContent = (solve === 'fee' ? net : gross).toFixed(2);
        $('sf-fee').textContent = fmt(fee);
        $('sf-eff').textContent = effRate.toFixed(2) + '%';
        $('sf-batch-net').textContent = fmt(net * qty);
        $('sf-batch-fees').textContent = fmt(fee * qty);
        
        $('sf-applied-rate').textContent = `${pct}% + $${fixed.toFixed(2)} ${cap < Infinity ? '(Cap $'+cap+')' : ''}`;
        $('sf-r-gross').textContent = fmt(gross);
        $('sf-r-pct').textContent = pct;
        $('sf-r-pct-val').textContent = '-' + fmt(Math.min(gross * pctDec, cap));
        $('sf-r-fixed-val').textContent = '-' + fmt(fixed);
        $('sf-r-total-fee').textContent = '-' + fmt(fee);
        $('sf-r-net').textContent = fmt(net);
    }

    ['sf-amount', 'sf-type', 'sf-solve', 'sf-qty', 'sf-custom-pct', 'sf-custom-fixed'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    document.querySelectorAll('.sf-quick').forEach(b => b.addEventListener('click', () => {
        $('sf-amount').value = b.dataset.a;
        calculate();
    }));

    $('st-copy').addEventListener('click', function(){
        const t = `Stripe Fee Analysis\nGross: ${$('sf-r-gross').textContent}\nFee: ${$('sf-fee').textContent}\nNet: ${$('sf-r-net').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('st-reset').addEventListener('click', () => location.reload());

    calculate();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\stripe-fee-calculator.blade.php ENDPATH**/ ?>