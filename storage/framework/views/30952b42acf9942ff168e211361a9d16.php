<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --gs-hue: 285;
        --gs-primary: hsl(var(--gs-hue), 70%, 45%);
        --gs-primary-light: hsl(var(--gs-hue), 70%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 70%, 45%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 70%, 45%, 0.03), hsla(var(--gs-hue), 70%, 55%, 0.06));
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

    .gs-tip { background: #fff; padding: 1.5rem; border-radius: 20px; border-left: 6px solid var(--gs-primary); box-shadow: 0 5px 15px rgba(0,0,0,0.02); margin-top: 2rem; }

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
                    <div class="gs-icon-box"><i class="fas fa-file-invoice-dollar"></i></div>
                    <div>
                        <h4>Inheritance Tax Estimator</h4>
                        <p>Evaluate potential tax liabilities on inherited assets based on beneficiary relationship.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Inheritance Value ($)</label>
                        <input type="number" id="inheritance-amt" class="form-control gs-input" value="250000">
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Relationship to Deceased</label>
                        <select id="relationship" class="form-select gs-input">
                            <option value="spouse" selected>Spouse (Standard Exemption)</option>
                            <option value="child">Child / Grandchild (Class A)</option>
                            <option value="sibling">Sibling (Class B)</option>
                            <option value="other">Unrelated / Other (Class C)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Local State Exemption ($)</label>
                        <input type="number" id="state-exempt" class="form-control gs-input" value="50000">
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Applicable Tax Rate (%)</label>
                        <input type="number" id="state-rate" class="form-control gs-input" value="5" step="1">
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Scenarios:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 inherit-quick" data-a="100000" data-r="spouse">Spouse Legacy</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 inherit-quick" data-a="500000" data-r="child">Family Distribution</button>
                        <button class="btn btn-sm btn-outline-danger rounded-pill px-4 inherit-quick" data-a="250000" data-r="other">Non-Relative Gift</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Estimated Tax Owed</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="out-tax-total">0</span></div>
                    <div class="text-muted fw-bold small" id="out-net-legacy">Net Legacy: $0</div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-4">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Taxable Amount</span>
                            <span class="gs-stat-value text-primary" id="out-taxable">$0</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Beneficiary Class</span>
                            <span class="gs-stat-value text-success" id="out-rel-grade">Exempt</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Effective Rate</span>
                            <span class="gs-stat-value text-warning" id="out-eff-rate">0%</span>
                        </div>
                    </div>
                </div>

                <div class="gs-tip" id="out-tip">
                    <h6 class="fw-bold small text-uppercase text-muted mb-2">Legal Context</h6>
                    <p class="small text-secondary mb-0" id="out-insights">Enter details above to see relevant tax insights.</p>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="it-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="it-reset">
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
    const amtE = $('inheritance-amt'), relE = $('relationship'), exE = $('state-exempt'), rateE = $('state-rate');

    function calculate(){
        let amt = parseFloat(amtE.value) || 0;
        let rel = relE.value;
        let exempt = parseFloat(exE.value) || 0;
        let rate = (parseFloat(rateE.value) || 0) / 100;

        let taxable = 0, tax = 0, relGrade = 'Class A';

        if(rel === 'spouse') {
            taxable = 0; tax = 0; relGrade = 'Exempt';
        } else {
            let effectiveExempt = exempt;
            if(rel === 'child') {
                effectiveExempt *= 2; relGrade = 'Class A';
            } else if(rel === 'sibling') {
                effectiveExempt *= 0.5; relGrade = 'Class B';
            } else {
                effectiveExempt = 0; relGrade = 'Class C';
            }
            taxable = Math.max(0, amt - effectiveExempt);
            tax = taxable * rate;
        }

        const net = amt - tax;
        const effRate = amt > 0 ? (tax / amt) * 100 : 0;

        $('out-tax-total').textContent = Math.round(tax).toLocaleString();
        $('out-net-legacy').textContent = `Net Legacy Received: $${Math.round(net).toLocaleString()}`;
        $('out-taxable').textContent = '$' + Math.round(taxable).toLocaleString();
        $('out-rel-grade').textContent = relGrade;
        $('out-eff-rate').textContent = effRate.toFixed(1) + '%';

        let msg = '';
        if(rel === 'spouse') {
            msg = 'In most jurisdictions, inheritances between spouses are 100% tax-free under the Unlimited Marital Deduction.';
        } else if(tax === 0) {
            msg = `Your inheritance of $${Math.round(amt).toLocaleString()} falls entirely within the exemption threshold for ${relGrade} beneficiaries.`;
        } else {
            msg = `Tax is calculated on the portion of inheritance exceeding your $${Math.round(amt-taxable).toLocaleString()} exemption. Unrelated beneficiaries typically face the highest rates.`;
        }
        $('out-insights').textContent = msg;
    }

    [amtE, relE, exE, rateE].forEach(el => el.addEventListener('input', calculate));
    document.querySelectorAll('.inherit-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{ amtE.value = btn.dataset.a; relE.value = btn.dataset.r; calculate(); });
    });

    $('it-reset').addEventListener('click', () => location.reload());

    $('it-copy').addEventListener('click', function(){
        const text = `Inheritance Tax Disclosure\nTotal Tax Due: $${$('out-tax-total').textContent}\nNet Received: ${$('out-net-legacy').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\inheritance-tax-calculator.blade.php ENDPATH**/ ?>