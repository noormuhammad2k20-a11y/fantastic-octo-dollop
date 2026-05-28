@push('styles')
<style>
    :root {
        --gs-hue: 185;
        --gs-primary: hsl(var(--gs-hue), 85%, 40%);
        --gs-primary-light: hsl(var(--gs-hue), 85%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 85%, 40%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 85%, 40%, 0.03), hsla(var(--gs-hue), 85%, 50%, 0.06));
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

    .be-bar { height: 14px; border-radius: 7px; background: #f1f5f9; overflow: hidden; display: flex; margin-top: 1rem; }
    .be-fixed { background: #ef4444; height: 100%; }
    .be-variable { background: #f59e0b; height: 100%; }
    .be-profit { background: #22c55e; height: 100%; }

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
                    <div class="gs-icon-box"><i class="fas fa-scale-balanced"></i></div>
                    <div>
                        <h4>Business Break-Even Calculator</h4>
                        <p>Determine the threshold where revenue covers all operational expenses. Analyze margins and safety levels.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="gs-label">Monthly Fixed Costs ($)</label>
                        <input type="number" id="be-fixed" class="form-control gs-input" value="10000">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Unit Sale Price ($)</label>
                        <input type="number" id="be-price" class="form-control gs-input" value="50" step="0.01">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Unit Variable Cost ($)</label>
                        <input type="number" id="be-variable" class="form-control gs-input" value="20" step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Expected Sales Volume (Units)</label>
                        <input type="number" id="be-sales" class="form-control gs-input" value="500">
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Desired Target Profit ($)</label>
                        <input type="number" id="be-target" class="form-control gs-input" value="0">
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Templates:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 be-quick" data-f="5000" data-p="25" data-v="10" data-s="400">Coffee Shop</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 be-quick" data-f="50000" data-p="99" data-v="5" data-s="1000">SaaS Enterprise</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 be-quick" data-f="20000" data-p="150" data-v="60" data-s="300">DTC E-commerce</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Break-Even Volume</span>
                    <div class="gs-hero-value"><span id="be-units">0</span><span class="fs-4 text-muted ms-2 fw-normal">Units</span></div>
                    <div class="text-muted fw-bold small" id="be-revenue-line">$0 in revenue required</div>
                    
                    <div class="be-bar mx-auto mt-4" style="max-width: 500px;">
                        <div id="be-bar-fixed" class="be-fixed"></div>
                        <div id="be-bar-variable" class="be-variable"></div>
                        <div id="be-bar-profit" class="be-profit"></div>
                    </div>
                    <div class="d-flex justify-content-center gap-4 mt-2">
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1 text-danger"></i> Fixed</div>
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1 text-warning"></i> Variable</div>
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1 text-success"></i> Profit</div>
                    </div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Contrib. Margin</span>
                            <span class="gs-stat-value text-primary" id="be-cm">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Margin Ratio</span>
                            <span class="gs-stat-value text-success" id="be-cmr">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Monthly EBITDA</span>
                            <span class="gs-stat-value" id="be-profit">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Safety Margin</span>
                            <span class="gs-stat-value text-indigo" id="be-safety">0%</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="be-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="be-reset">
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
        const fixed = parseFloat($('be-fixed').value) || 0;
        const price = parseFloat($('be-price').value) || 0.01;
        const variable = parseFloat($('be-variable').value) || 0;
        const sales = parseInt($('be-sales').value) || 0;
        const target = parseFloat($('be-target').value) || 0;

        const cm = price - variable;
        const cmr = price > 0 ? (cm / price) * 100 : 0;
        const beUnits = cm > 0 ? Math.ceil((fixed + target) / cm) : 0;
        const beRevenue = beUnits * price;
        const revenue = sales * price;
        const totalVC = sales * variable;
        const profit = revenue - fixed - totalVC;
        const safetyMargin = sales > 0 && beUnits > 0 ? ((sales - beUnits) / sales) * 100 : 0;

        $('be-units').textContent = beUnits.toLocaleString();
        $('be-revenue-line').textContent = fmt(beRevenue) + ' in revenue required';
        $('be-cm').textContent = fmt(cm);
        $('be-cmr').textContent = cmr.toFixed(1) + '%';
        
        $('be-profit').textContent = (profit >= 0 ? '' : '−') + fmt(Math.abs(profit));
        $('be-profit').style.color = profit >= 0 ? '#16a34a' : '#dc2626';
        $('be-safety').textContent = safetyMargin.toFixed(1) + '%';

        if(revenue > 0){
            const fp = (fixed / revenue) * 100;
            const vp = (totalVC / revenue) * 100;
            const pp = Math.max(0, 100 - fp - vp);
            $('be-bar-fixed').style.width = Math.min(100, fp) + '%';
            $('be-bar-variable').style.width = Math.min(100 - fp, vp) + '%';
            $('be-bar-profit').style.width = Math.max(0, 100 - fp - vp) + '%';
        }
    }

    ['be-fixed', 'be-price', 'be-variable', 'be-sales', 'be-target'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    document.querySelectorAll('.be-quick').forEach(b => b.addEventListener('click', () => {
        $('be-fixed').value = b.dataset.f;
        $('be-price').value = b.dataset.p;
        $('be-variable').value = b.dataset.v;
        $('be-sales').value = b.dataset.s;
        $('be-target').value = 0;
        calculate();
    }));

    $('be-copy').addEventListener('click', function(){
        const t = `Break-Even Analysis\nPoint: ${$('be-units').textContent} Units\nRevenue Required: ${$('be-revenue-line').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('be-reset').addEventListener('click', () => location.reload());

    calculate();
});
</script>

