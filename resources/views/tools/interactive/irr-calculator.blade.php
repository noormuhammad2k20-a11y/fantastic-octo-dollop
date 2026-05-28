@push('styles')
<style>
    :root {
        --gs-hue: 20;
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 90%, 50%, 0.03), hsla(var(--gs-hue), 90%, 60%, 0.06));
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

    .irr-flow-box {
        background: #fff; border-radius: 16px; padding: 1.25rem; border: 1px solid #f1f5f9;
        transition: all 0.2s;
    }
    .irr-flow-box:hover { border-color: var(--gs-primary); }

    @media (max-width: 768px) {
        .gs-card { padding: 1.5rem; }
        .gs-header { flex-direction: column; text-align: center; gap: 0.75rem; }
        .gs-icon-box { width: 48px; height: 48px; font-size: 1.25rem; border-radius: 14px; margin: 0 auto; }
        .gs-header h4 { font-size: 1.25rem; }
        .gs-hero-value { font-size: 2.5rem; }
        .gs-stat-value { font-size: 1.25rem; }
    }

    @media print {
        .gs-card:not(.gs-card-output), .btn, .gs-presets, #irr-flows { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
    }
</style>
@endpush

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-chart-line"></i></div>
                    <div>
                        <h4>Internal Rate of Return (IRR)</h4>
                        <p>Determine the annualized rate of earnings for your investment project.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Initial Outlay ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="irr-invest" class="form-control gs-input border-start-0" value="100000" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Hurdle Rate (WACC %)</label>
                        <div class="input-group">
                            <input type="number" id="irr-hurdle" class="form-control gs-input border-end-0" value="10" step="0.1" min="0">
                            <span class="input-group-text bg-white border-start-0 px-3 fs-5 fw-bold">%</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold small text-uppercase text-muted mb-4 d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-calendar-alt me-2 text-primary"></i>Annual Cash Inflows</span>
                        <div class="btn-group shadow-sm">
                            <button class="btn btn-xs btn-outline-dark rounded-start-pill px-3" id="irr-remove"><i class="fas fa-minus"></i></button>
                            <button class="btn btn-xs btn-outline-dark rounded-end-pill px-3" id="irr-add"><i class="fas fa-plus"></i></button>
                        </div>
                    </h6>
                    <div id="irr-flows" class="row g-3"></div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Templates:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 irr-quick" data-i="80000" data-h="8" data-cf="20000,25000,30000,35000,40000">Expansion</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 irr-quick" data-i="150000" data-h="12" data-cf="40000,40000,40000,40000,40000">Replacement</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Project IRR</span>
                    <div class="gs-hero-value" id="irr-result">0%</div>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm" id="irr-verdict">ANALYZING...</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Calculated IRR</span>
                            <span class="gs-stat-value" style="color: var(--gs-primary);" id="irr-pct">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Hurdle Rate</span>
                            <span class="gs-stat-value text-muted" id="irr-hurdle-out">10%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">NPV @ Hurdle</span>
                            <span class="gs-stat-value text-primary" id="irr-npv">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Rate Spread</span>
                            <span class="gs-stat-value" id="irr-spread">0%</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="irr-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="irr-reset">
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
    const fmt = v => (v < 0 ? '-$' : '$') + Math.abs(Math.round(v)).toLocaleString('en-US');
    let periods = 5;

    function renderInputs(){
        const c = $('irr-flows');
        c.innerHTML = '';
        const defs = [25000, 30000, 35000, 30000, 25000];
        for(let i=1; i<=periods; i++){
            c.insertAdjacentHTML('beforeend', `
                <div class="col-md-4 col-lg-3">
                    <div class="irr-flow-box">
                        <label class="gs-label mb-2">Year ${i}</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0 px-2 fw-bold">$</span>
                            <input type="number" class="form-control border-start-0 fw-bold irr-cf" data-period="${i}" value="${defs[i-1] || 20000}">
                        </div>
                    </div>
                </div>
            `);
        }
        c.querySelectorAll('.irr-cf').forEach(el => el.addEventListener('input', calculate));
    }

    function calcNPV(cfs, rate){
        let npv = cfs[0];
        for(let i=1; i<cfs.length; i++) npv += cfs[i] / Math.pow(1 + rate, i);
        return npv;
    }

    function calcIRR(cfs){
        let lo = -0.99, hi = 10, mid, npv;
        for(let i=0; i<100; i++){
            mid = (lo + hi) / 2;
            npv = calcNPV(cfs, mid);
            if(Math.abs(npv) < 0.001) return mid;
            if(npv > 0) lo = mid; else hi = mid;
        }
        return mid;
    }

    function calculate(){
        const invest = parseFloat($('irr-invest').value) || 0;
        const hurdle = (parseFloat($('irr-hurdle').value) || 0) / 100;
        const cfs = [-invest];
        document.querySelectorAll('.irr-cf').forEach(el => cfs.push(parseFloat(el.value) || 0));

        const irr = calcIRR(cfs);
        const irrPct = irr * 100;
        const npvAtHurdle = calcNPV(cfs, hurdle);
        const spread = irrPct - (hurdle * 100);

        $('irr-result').textContent = irrPct.toFixed(2) + '%';
        $('irr-result').style.color = irr >= hurdle ? '#059669' : '#dc2626';
        $('irr-pct').textContent = irrPct.toFixed(2) + '%';
        $('irr-hurdle-out').textContent = (hurdle * 100).toFixed(1) + '%';
        $('irr-npv').textContent = fmt(npvAtHurdle);
        
        const spreadEl = $('irr-spread');
        spreadEl.textContent = (spread >= 0 ? '+' : '') + spread.toFixed(2) + '%';
        spreadEl.style.color = spread >= 0 ? '#059669' : '#dc2626';

        const badge = $('irr-verdict');
        if(irr >= hurdle){
            badge.textContent = 'ABOVE HURDLE RATE';
            badge.className = 'badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm bg-success text-white';
        } else {
            badge.textContent = 'BELOW HURDLE RATE';
            badge.className = 'badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm bg-danger text-white';
        }
    }

    $('irr-add').addEventListener('click', () => { if(periods < 25) { periods++; renderInputs(); calculate(); } });
    $('irr-remove').addEventListener('click', () => { if(periods > 1) { periods--; renderInputs(); calculate(); } });
    ['irr-invest', 'irr-hurdle'].forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.irr-quick').forEach(b => b.addEventListener('click', () => {
        $('irr-invest').value = b.dataset.i;
        $('irr-hurdle').value = b.dataset.h;
        const cfs = b.dataset.cf.split(',');
        periods = cfs.length;
        renderInputs();
        document.querySelectorAll('.irr-cf').forEach((el, i) => { if(i < cfs.length) el.value = cfs[i]; });
        calculate();
    }));

    $('irr-copy').addEventListener('click', function(){
        const text = `IRR Analysis\nResult: ${$('irr-result').textContent}\nSpread: ${$('irr-spread').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('irr-reset').addEventListener('click', () => location.reload());

    renderInputs();
    calculate();
});
</script>

