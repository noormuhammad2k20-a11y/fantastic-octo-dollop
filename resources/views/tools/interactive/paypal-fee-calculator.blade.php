@push('styles')
<style>
    :root {
        --gs-hue: 212;
        --gs-primary: hsl(var(--gs-hue), 100%, 40%);
        --gs-primary-light: hsl(var(--gs-hue), 100%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 100%, 40%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 100%, 40%, 0.03), hsla(var(--gs-hue), 100%, 50%, 0.06));
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
@endpush

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fab fa-paypal"></i></div>
                    <div>
                        <h4>PayPal Fee Calculator</h4>
                        <p>Calculate processing fees for goods, services, and micropayments. Precision estimates for global commerce.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Transaction Amount ($)</label>
                        <input type="number" id="pp-amount" class="form-control gs-input" value="100" step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Fee Structure</label>
                        <select id="pp-type" class="form-select gs-input">
                            <option value="standard" selected>Standard (2.99% + $0.49)</option>
                            <option value="international">International (4.49% + $0.49)</option>
                            <option value="micropay">Micropayments (5.0% + $0.09)</option>
                            <option value="qr">QR Code (2.29% + $0.09)</option>
                            <option value="friends">Friends & Family (0%)</option>
                            <option value="custom">Custom Rate</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="pp-custom-wrap" style="display:none;">
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="gs-label">Rate (%)</label>
                                <input type="number" id="pp-custom-pct" class="form-control gs-input" value="2.99" step="0.01">
                            </div>
                            <div class="col-6">
                                <label class="gs-label">Fixed ($)</label>
                                <input type="number" id="pp-custom-fixed" class="form-control gs-input" value="0.49" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Calculation Mode</label>
                        <select id="pp-solve" class="form-select gs-input">
                            <option value="fee">I am receiving money (Show Net)</option>
                            <option value="charge">I want to receive X (Show Gross)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Transaction Batch (Qty)</label>
                        <input type="number" id="pp-qty" class="form-control gs-input" value="1" min="1">
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Amounts:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 pp-quick" data-a="50">$50</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 pp-quick" data-a="100">$100</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 pp-quick" data-a="500">$500</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 pp-quick" data-a="1000">$1,000</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label" id="pp-hero-label">Net Received Amount</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="pp-net">0</span></div>
                    <div class="text-muted fw-bold small">Rate Applied: <span id="pp-applied-rate">...</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">PayPal Fee</span>
                            <span class="gs-stat-value text-danger" id="pp-fee">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Effective Rate</span>
                            <span class="gs-stat-value text-primary" id="pp-eff">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Batch Total (Net)</span>
                            <span class="gs-stat-value text-success" id="pp-batch-net">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Batch Total (Fees)</span>
                            <span class="gs-stat-value text-warning" id="pp-batch-fees">$0</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3">Transaction Receipt</h6>
                    <div class="table-responsive rounded-4 border p-3 bg-white">
                        <table class="table gs-table mb-0">
                            <tbody>
                                <tr><td class="text-muted">Gross Transaction</td><td class="text-end fw-bold" id="pp-r-gross">$0</td></tr>
                                <tr><td class="text-muted">Percentage Fee (<span id="pp-r-pct">0</span>%)</td><td class="text-end text-danger" id="pp-r-pct-val">-$0</td></tr>
                                <tr><td class="text-muted">Fixed Transaction Fee</td><td class="text-end text-danger" id="pp-r-fixed-val">-$0</td></tr>
                                <tr class="border-top"><td class="fw-bold pt-2">Total Fee per Item</td><td class="text-end fw-bold text-danger pt-2" id="pp-r-total-fee">-$0</td></tr>
                                <tr><td class="fw-bold text-success">Net Settlement</td><td class="text-end fw-bold text-success fs-5" id="pp-r-net">$0</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="pp-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Receipt
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="pp-reset">
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
        standard: {pct: 2.99, fixed: 0.49},
        international: {pct: 4.49, fixed: 0.49},
        micropay: {pct: 5.0, fixed: 0.09},
        qr: {pct: 2.29, fixed: 0.09},
        friends: {pct: 0, fixed: 0}
    };

    function calculate(){
        const amt = parseFloat($('pp-amount').value) || 0;
        const type = $('pp-type').value;
        const solve = $('pp-solve').value;
        const qty = parseInt($('pp-qty').value) || 1;
        
        let pct, fixed;
        if(type === 'custom'){
            pct = parseFloat($('pp-custom-pct').value) || 0;
            fixed = parseFloat($('pp-custom-fixed').value) || 0;
            $('pp-custom-wrap').style.display = 'block';
        } else {
            pct = rates[type].pct;
            fixed = rates[type].fixed;
            $('pp-custom-wrap').style.display = 'none';
        }

        const pctDec = pct / 100;
        let gross, fee, net;

        if(solve === 'fee'){
            gross = amt;
            fee = (gross * pctDec) + fixed;
            net = gross - fee;
            $('pp-hero-label').textContent = 'Net Received Amount';
        } else {
            gross = pctDec < 1 ? (amt + fixed) / (1 - pctDec) : amt;
            fee = (gross * pctDec) + fixed;
            net = gross - fee;
            $('pp-hero-label').textContent = 'Amount to Invoice';
        }

        const effRate = gross > 0 ? (fee / gross) * 100 : 0;

        $('pp-net').textContent = (solve === 'fee' ? net : gross).toFixed(2);
        $('pp-fee').textContent = fmt(fee);
        $('pp-eff').textContent = effRate.toFixed(2) + '%';
        $('pp-batch-net').textContent = fmt(net * qty);
        $('pp-batch-fees').textContent = fmt(fee * qty);
        
        $('pp-applied-rate').textContent = `${pct}% + $${fixed.toFixed(2)}`;
        $('pp-r-gross').textContent = fmt(gross);
        $('pp-r-pct').textContent = pct;
        $('pp-r-pct-val').textContent = '-' + fmt(gross * pctDec);
        $('pp-r-fixed-val').textContent = '-' + fmt(fixed);
        $('pp-r-total-fee').textContent = '-' + fmt(fee);
        $('pp-r-net').textContent = fmt(net);
    }

    ['pp-amount', 'pp-type', 'pp-solve', 'pp-qty', 'pp-custom-pct', 'pp-custom-fixed'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    document.querySelectorAll('.pp-quick').forEach(b => b.addEventListener('click', () => {
        $('pp-amount').value = b.dataset.a;
        calculate();
    }));

    $('pp-copy').addEventListener('click', function(){
        const t = `PayPal Fee Analysis\nGross: ${$('pp-r-gross').textContent}\nFee: ${fmt(parseFloat($('pp-fee').textContent.replace(/[^0-9.-]+/g,"")))}\nNet: ${$('pp-r-net').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('pp-reset').addEventListener('click', () => location.reload());

    calculate();
});
</script>

