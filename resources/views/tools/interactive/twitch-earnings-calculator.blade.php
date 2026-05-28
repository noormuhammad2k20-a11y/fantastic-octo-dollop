<div class="row g-4 roi-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Tier 1 Subs ($4.99)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-star text-muted"></i></span>
                            <input type="number" id="tw-t1" class="form-control form-control-lg" value="50" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Tier 2 Subs ($9.99)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-star text-muted"></i></span>
                            <input type="number" id="tw-t2" class="form-control form-control-lg" value="5" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Tier 3 Subs ($24.99)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-star text-muted"></i></span>
                            <input type="number" id="tw-t3" class="form-control form-control-lg" value="1" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Monthly Bits Received</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-gem text-muted"></i></span>
                            <input type="number" id="tw-bits" class="form-control form-control-lg" value="1500" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Monthly Ad Impressions</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-desktop text-muted"></i></span>
                            <input type="number" id="tw-ads" class="form-control form-control-lg" value="10000" min="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:264;--tool-color:#9146FF;--tool-bg:rgba(145,70,255,.04);">
            <div class="output-hero">
                <span class="output-hero-label">ESTIMATED MONTHLY EARNINGS</span>
                <div class="output-hero-value" id="tw-total">$182.50</div>
                <span class="output-hero-unit" id="tw-payout-status">Eligible for Payout (>$50 threshold)</span>
            </div>
            
            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Sub Revenue (50/50)</span>
                        <span class="fs-4 fw-bold" id="tw-sub-rev">$162.50</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Bits Revenue ($0.01/bit)</span>
                        <span class="fs-4 fw-bold" id="tw-bit-rev">$15.00</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Ad Revenue ($3.50 CPM)</span>
                        <span class="fs-4 fw-bold" id="tw-ad-rev">$35.00</span>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="tw-insights"></div>
            
            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tw-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy Result
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tw-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-rotate-left me-2"></i>Reset Fields
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    function fmt(v){ return '$' + v.toFixed(2); }
    
    function calculate() {
        const t1 = parseFloat($('tw-t1').value) || 0;
        const t2 = parseFloat($('tw-t2').value) || 0;
        const t3 = parseFloat($('tw-t3').value) || 0;
        const bits = parseFloat($('tw-bits').value) || 0;
        const ads = parseFloat($('tw-ads').value) || 0;
        
        // standard affiliate/partner 50/50 split (approximation)
        const subRev = (t1 * 2.50) + (t2 * 5.00) + (t3 * 12.50);
        const bitRev = bits * 0.01;
        const adRev = (ads / 1000) * 3.50; // standard $3.50 CPM approx
        
        const total = subRev + bitRev + adRev;

        $('tw-sub-rev').textContent = fmt(subRev);
        $('tw-bit-rev').textContent = fmt(bitRev);
        $('tw-ad-rev').textContent = fmt(adRev);
        $('tw-total').textContent = fmt(total);

        const statusEl = $('tw-payout-status');
        if (total >= 50) {
            statusEl.textContent = 'Eligible for Payout (>$50 threshold)';
            statusEl.style.color = '#22c55e';
        } else {
            statusEl.textContent = 'Below Payout Threshold (Needs $50)';
            statusEl.style.color = '#ef4444';
        }

        let ins = [];
        ins.push(`Your highest earning category is <strong>${
            (subRev >= bitRev && subRev >= adRev) ? 'Subscriptions' :
            (bitRev >= subRev && bitRev >= adRev) ? 'Bits' : 'Ads'
        }</strong>.`);
        
        ins.push('Note: This assumes a standard 50/50 split for subscriptions. Top-tier partners may receive a 70/30 split on subscriptions.');
        ins.push(`Bits payout exactly at $0.01 per bit (${fmt(bitRev)} total).`);
        ins.push(`Ad revenue is estimated using a standard $3.50 CPM, but can vary greatly based on viewer location and ad-blockers.`);

        $('tw-insights').innerHTML = '<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Earnings Breakdown</h6>' + 
                                     '<ul class="list-unstyled mb-0">' + 
                                     ins.map(i => `<li class="mb-2 pb-1" style="font-size:0.9rem"><i class="fas fa-check-circle text-success me-2"></i>${i}</li>`).join('') + 
                                     '</ul>';
    }

    ['tw-t1', 'tw-t2', 'tw-t3', 'tw-bits', 'tw-ads'].forEach(id => $(id).addEventListener('input', calculate));

    $('tw-copy').addEventListener('click', function() {
        const t = `Twitch Estimated Monthly Earnings\nSubs: ${$('tw-sub-rev').textContent}\nBits: ${$('tw-bit-rev').textContent}\nAds: ${$('tw-ad-rev').textContent}\nTotal: ${$('tw-total').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('tw-reset').addEventListener('click', () => {
        $('tw-t1').value = 50;
        $('tw-t2').value = 5;
        $('tw-t3').value = 1;
        $('tw-bits').value = 1500;
        $('tw-ads').value = 10000;
        calculate();
    });

    calculate();
});
</script>

<style>
.roi-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,.04); }
.roi-rebuilt .calculator-header { display:flex; align-items:center; gap:1.25rem; margin-bottom:2rem; }
.roi-rebuilt .calculator-header h4 { margin:0; font-weight:800; color:#1e293b; font-size:1.4rem; }
.roi-rebuilt .calculator-header p { margin:0; font-size:0.95rem; color:#64748b; }
.roi-rebuilt .tool-icon-circle { width:60px; height:60px; border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.6rem; flex-shrink:0; }
.roi-rebuilt .form-label-custom { font-size:.8rem; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:.8px; margin-bottom:.5rem; display:block; }
.roi-rebuilt .output-card-themed { background:var(--tool-bg); border:1px solid rgba(0,0,0,.05); border-radius:20px; padding:2rem; }
.roi-rebuilt .output-hero { background:#fff; border-radius:16px; padding:2rem; text-align:center; box-shadow:0 4px 12px rgba(0,0,0,.02); border:1px solid rgba(0,0,0,.04); }
.roi-rebuilt .output-hero-label { font-size:.85rem; font-weight:700; color:#64748b; letter-spacing:1px; display:block; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-value { font-size:2.5rem; font-weight:800; color:var(--tool-color); line-height:1.2; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-unit { font-size:1rem; font-weight:700; color:#475569; }
.roi-rebuilt .overflow-x-auto { overflow-x: auto; }
.roi-rebuilt .break-words { word-break: break-word; }
@media(max-width:768px){ 
    .roi-rebuilt .calculator-card, .roi-rebuilt .output-card-themed { padding:1.5rem; }
    .roi-rebuilt .output-hero-value { font-size:2rem; }
    .roi-rebuilt .calculator-header h4 { font-size:1.2rem; }
}
</style>
