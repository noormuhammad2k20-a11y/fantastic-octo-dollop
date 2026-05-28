@push('styles')
<style>
    :root {
        --gs-hue: 45;
        --gs-primary: hsl(var(--gs-hue), 85%, 35%);
        --gs-primary-light: hsl(var(--gs-hue), 85%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 85%, 35%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 85%, 35%, 0.03), hsla(var(--gs-hue), 85%, 45%, 0.06));
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

    .dti-bar { height: 14px; border-radius: 7px; background: #f1f5f9; overflow: hidden; display: flex; margin-top: 1rem; }
    .bar-housing { background: #3b82f6; height: 100%; }
    .bar-debt { background: #ef4444; height: 100%; }
    .bar-free { background: #22c55e; height: 100%; }

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
                    <div class="gs-icon-box"><i class="fas fa-scale-unbalanced-flip"></i></div>
                    <div>
                        <h4>Debt-to-Income (DTI) Analyzer</h4>
                        <p>Evaluate your borrowing capacity and creditworthiness by comparing gross income to recurring monthly obligations.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-12"><h6 class="fw-bold small text-uppercase text-muted"><i class="fas fa-wallet me-2 text-primary"></i>Monthly Gross Income</h6></div>
                    <div class="col-md-4">
                        <label class="gs-label">Primary Income ($)</label>
                        <input type="number" id="dti-income" class="form-control gs-input" value="7500">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Co-Borrower ($)</label>
                        <input type="number" id="dti-spouse" class="form-control gs-input" value="0">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Other Sources ($)</label>
                        <input type="number" id="dti-other" class="form-control gs-input" value="0">
                    </div>

                    <div class="col-12 mt-4"><h6 class="fw-bold small text-uppercase text-muted"><i class="fas fa-house me-2 text-indigo"></i>Housing Obligations</h6></div>
                    <div class="col-md-3">
                        <label class="gs-label">Mortgage / Rent</label>
                        <input type="number" id="dti-mortgage" class="form-control gs-input" value="2000">
                    </div>
                    <div class="col-md-3">
                        <label class="gs-label">Property Tax / mo</label>
                        <input type="number" id="dti-ptax" class="form-control gs-input" value="400">
                    </div>
                    <div class="col-md-3">
                        <label class="gs-label">Insurance / mo</label>
                        <input type="number" id="dti-hins" class="form-control gs-input" value="125">
                    </div>
                    <div class="col-md-3">
                        <label class="gs-label">HOA / Fees / mo</label>
                        <input type="number" id="dti-hoa" class="form-control gs-input" value="0">
                    </div>

                    <div class="col-12 mt-4"><h6 class="fw-bold small text-uppercase text-muted"><i class="fas fa-credit-card me-2 text-danger"></i>Recurring Debts</h6></div>
                    <div class="col-md-3">
                        <label class="gs-label">Auto Loans</label>
                        <input type="number" id="dti-auto" class="form-control gs-input" value="450">
                    </div>
                    <div class="col-md-3">
                        <label class="gs-label">Student Loans</label>
                        <input type="number" id="dti-student" class="form-control gs-input" value="300">
                    </div>
                    <div class="col-md-3">
                        <label class="gs-label">Credit Card Min.</label>
                        <input type="number" id="dti-cc" class="form-control gs-input" value="200">
                    </div>
                    <div class="col-md-3">
                        <label class="gs-label">Personal / Other</label>
                        <input type="number" id="dti-othdebt" class="form-control gs-input" value="0">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Back-End DTI Ratio</span>
                    <div class="gs-hero-value"><span id="dti-result">0</span><span class="fs-2 text-muted ms-1">%</span></div>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fw-bold shadow-sm" id="dti-badge">...</span></div>
                    
                    <div class="dti-bar mx-auto mt-5" style="max-width: 500px;">
                        <div id="dti-bar-housing" class="bar-housing"></div>
                        <div id="dti-bar-debt" class="bar-debt"></div>
                        <div id="dti-bar-free" class="bar-free"></div>
                    </div>
                    <div class="d-flex justify-content-center gap-4 mt-2">
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1 text-primary"></i> Housing</div>
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1 text-danger"></i> Other Debt</div>
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1 text-success"></i> Discretionary</div>
                    </div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Front-End (Housing)</span>
                            <span class="gs-stat-value text-primary" id="dti-front">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Back-End (Total)</span>
                            <span class="gs-stat-value" style="color: var(--gs-primary);" id="dti-back">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Gross Income</span>
                            <span class="gs-stat-value text-success" id="dti-total-inc">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Liabilities</span>
                            <span class="gs-stat-value text-danger" id="dti-total-debt">$0</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3">Lending Qualification Guidelines</h6>
                    <div class="table-responsive rounded-4 border p-3 bg-white">
                        <table class="table mb-0 small">
                            <thead><tr><th>Threshold</th><th>Category</th><th class="text-end">Status</th></tr></thead>
                            <tbody>
                                <tr><td>≤ 28%</td><td>Housing (Front-End) Ideal</td><td class="text-end fw-bold" id="dti-g-28">...</td></tr>
                                <tr><td>≤ 36%</td><td>Total Debt (Back-End) Excellent</td><td class="text-end fw-bold" id="dti-g-36">...</td></tr>
                                <tr><td>≤ 43%</td><td>Conventional QM Limit</td><td class="text-end fw-bold" id="dti-g-43">...</td></tr>
                                <tr><td>≤ 50%</td><td>FHA Maximum Limit</td><td class="text-end fw-bold" id="dti-g-50">...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="dti-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="dti-reset">
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

    function calculate(){
        const income = (parseFloat($('dti-income').value) || 0) + (parseFloat($('dti-spouse').value) || 0) + (parseFloat($('dti-other').value) || 0);
        const housing = (parseFloat($('dti-mortgage').value) || 0) + (parseFloat($('dti-ptax').value) || 0) + (parseFloat($('dti-hins').value) || 0) + (parseFloat($('dti-hoa').value) || 0);
        const otherDebt = (parseFloat($('dti-auto').value) || 0) + (parseFloat($('dti-student').value) || 0) + (parseFloat($('dti-cc').value) || 0) + (parseFloat($('dti-othdebt').value) || 0);
        
        const totalDebt = housing + otherDebt;
        const frontEnd = income > 0 ? (housing / income) * 100 : 0;
        const backEnd = income > 0 ? (totalDebt / income) * 100 : 0;

        $('dti-result').textContent = backEnd.toFixed(1);
        $('dti-front').textContent = frontEnd.toFixed(1) + '%';
        $('dti-back').textContent = backEnd.toFixed(1) + '%';
        $('dti-total-inc').textContent = fmt(income);
        $('dti-total-debt').textContent = fmt(totalDebt);

        const badge = $('dti-badge');
        if(backEnd <= 36) { badge.textContent = '✅ EXCELLENT'; badge.className = 'badge rounded-pill px-4 py-2 fw-bold bg-success'; }
        else if(backEnd <= 43) { badge.textContent = '⚠️ ACCEPTABLE'; badge.className = 'badge rounded-pill px-4 py-2 fw-bold bg-warning text-dark'; }
        else if(backEnd <= 50) { badge.textContent = '⚠️ HIGH RISK'; badge.className = 'badge rounded-pill px-4 py-2 fw-bold bg-danger'; }
        else { badge.textContent = '🚨 OVER LIMIT'; badge.className = 'badge rounded-pill px-4 py-2 fw-bold bg-dark'; }

        if(income > 0){
            const hp = (housing / income) * 100;
            const dp = (otherDebt / income) * 100;
            const fp = Math.max(0, 100 - hp - dp);
            $('dti-bar-housing').style.width = hp + '%';
            $('dti-bar-debt').style.width = dp + '%';
            $('dti-bar-free').style.width = fp + '%';
        }

        const thresholds = [{id: '28', pct: 28, val: frontEnd}, {id: '36', pct: 36, val: backEnd}, {id: '43', pct: 43, val: backEnd}, {id: '50', pct: 50, val: backEnd}];
        thresholds.forEach(t => {
            const el = $('dti-g-' + t.id);
            if(t.val <= t.pct){ el.textContent = 'Pass'; el.className = 'text-end fw-bold text-success'; }
            else { el.textContent = 'Fail'; el.className = 'text-end fw-bold text-danger'; }
        });
    }

    ['dti-income', 'dti-spouse', 'dti-other', 'dti-mortgage', 'dti-ptax', 'dti-hins', 'dti-hoa', 'dti-auto', 'dti-student', 'dti-cc', 'dti-othdebt'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    $('dti-copy').addEventListener('click', function(){
        const t = `DTI Analysis\nFront-End: ${$('dti-front').textContent}\nBack-End: ${$('dti-back').textContent}\nIncome: ${$('dti-total-inc').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('dti-reset').addEventListener('click', () => location.reload());

    calculate();
});
</script>

