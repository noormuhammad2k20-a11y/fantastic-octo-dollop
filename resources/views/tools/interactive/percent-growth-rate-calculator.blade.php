@push('styles')
<style>
    :root {
        --gs-hue: 150;
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

    .multi-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 1rem; margin-top: 1.5rem; }
    .multi-input-box { background: #f8fafc; padding: 1rem; border-radius: 16px; border: 1px solid #f1f5f9; }

    @media (max-width: 768px) {
        .gs-card { padding: 1.5rem; }
        .gs-header { flex-direction: column; text-align: center; gap: 0.75rem; }
        .gs-icon-box { width: 48px; height: 48px; font-size: 1.25rem; border-radius: 14px; margin: 0 auto; }
        .gs-header h4 { font-size: 1.25rem; }
        .gs-hero-value { font-size: 2.5rem; }
        .gs-stat-value { font-size: 1.25rem; }
    }

    @media print {
        .gs-card:not(.gs-card-output), .btn, .gs-presets, #pgr-multi-inputs input { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
        #pgr-multi-wrap { display: block !important; }
    }
</style>
@endpush

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-arrow-trend-up"></i></div>
                    <div>
                        <h4>Percent Growth Rate</h4>
                        <p>Track performance with percentage change, CAGR, and average growth analysis.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Calculation Mode</label>
                        <select id="pgr-mode" class="form-select gs-input">
                            <option value="pct" selected>Point-to-Point Change</option>
                            <option value="cagr">CAGR (Compound Annual)</option>
                            <option value="avg">Multi-Period Average</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="pgr-periods-wrap" style="display:none;">
                        <label class="gs-label">Number of Periods</label>
                        <input type="number" id="pgr-periods" class="form-control gs-input" value="5" min="2" max="20">
                    </div>
                    
                    <div class="col-md-4 pgr-standard">
                        <label class="gs-label">Starting Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="pgr-start" class="form-control gs-input border-start-0" value="1000">
                        </div>
                    </div>
                    <div class="col-md-4 pgr-standard">
                        <label class="gs-label">Ending Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="pgr-end" class="form-control gs-input border-start-0" value="1500">
                        </div>
                    </div>
                    <div class="col-md-4 pgr-standard">
                        <label class="gs-label">Duration (Years)</label>
                        <input type="number" id="pgr-years" class="form-control gs-input" value="5">
                    </div>
                </div>

                <div id="pgr-multi-wrap" style="display:none;" class="mt-5">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3"><i class="fas fa-list-numeric me-2"></i>Enter Values for Each Period</h6>
                    <div id="pgr-multi-inputs" class="multi-grid"></div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Common Benchmarks:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 pgr-quick" data-s="10000" data-e="15000" data-y="3">50% Growth (3yr)</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 pgr-quick" data-s="50000" data-e="100000" data-y="7.2">Rule of 72 (Double)</button>
                        <button class="btn btn-sm btn-outline-danger rounded-pill px-4 pgr-quick" data-s="25000" data-e="18000" data-y="2">Drawdown (-28%)</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label" id="pgr-hero-label">Total Percentage Change</span>
                    <div class="gs-hero-value" id="pgr-result">0%</div>
                    <div class="text-muted fw-bold small" id="pgr-subtitle">Initial analysis ready</div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Return</span>
                            <span class="gs-stat-value" id="pgr-change">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">CAGR / Annual</span>
                            <span class="gs-stat-value text-primary" id="pgr-cagr">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Absolute Change</span>
                            <span class="gs-stat-value" id="pgr-abs">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Doubling Period</span>
                            <span class="gs-stat-value" style="color: #8b5cf6;" id="pgr-double">—</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="pgr-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="pgr-reset">
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

    $('pgr-mode').addEventListener('change', function(){
        const m = this.value;
        $('pgr-periods-wrap').style.display = m === 'avg' ? 'block' : 'none';
        $('pgr-multi-wrap').style.display = m === 'avg' ? 'block' : 'none';
        document.querySelectorAll('.pgr-standard').forEach(el => el.style.display = m === 'avg' ? 'none' : 'block');
        if(m === 'avg') renderMulti();
        calculate();
    });

    function renderMulti(){
        const n = parseInt($('pgr-periods').value) || 5;
        const c = $('pgr-multi-inputs'); c.innerHTML = '';
        for(let i = 0; i <= n; i++){
            c.insertAdjacentHTML('beforeend', `
                <div class="multi-input-box text-center">
                    <label class="gs-label mb-2">${i === 0 ? 'Start' : 'Period ' + i}</label>
                    <input type="number" class="form-control gs-input text-center pgr-pval" value="${1000 + i * 150}">
                </div>
            `);
        }
        c.querySelectorAll('.pgr-pval').forEach(el => el.addEventListener('input', calculate));
    }

    function calculate(){
        const mode = $('pgr-mode').value;
        const sv = parseFloat($('pgr-start').value) || 0;
        const ev = parseFloat($('pgr-end').value) || 0;
        const yrs = parseFloat($('pgr-years').value) || 1;

        let pctChange = 0, cagr = 0, absChange = 0, doubleTime = Infinity;

        if(mode === 'avg'){
            const vals = []; document.querySelectorAll('.pgr-pval').forEach(el => vals.push(parseFloat(el.value) || 0));
            if(vals.length >= 2){
                let rates = [];
                for(let i = 1; i < vals.length; i++){ if(vals[i-1] > 0) rates.push(((vals[i] - vals[i-1]) / vals[i-1]) * 100); }
                const avgRate = rates.length > 0 ? rates.reduce((s, r) => s + r, 0) / rates.length : 0;
                pctChange = avgRate;
                cagr = vals[0] > 0 ? ((Math.pow(vals[vals.length - 1] / vals[0], 1 / (vals.length - 1))) - 1) * 100 : 0;
                absChange = vals[vals.length - 1] - vals[0];
                doubleTime = avgRate > 0 ? 72 / avgRate : Infinity;
                
                $('pgr-hero-label').textContent = 'Average Periodic Growth';
                $('pgr-result').textContent = avgRate.toFixed(2) + '%';
                $('pgr-subtitle').textContent = `Aggregated across ${rates.length} active periods`;
            }
        } else {
            pctChange = sv > 0 ? ((ev - sv) / sv) * 100 : 0;
            cagr = sv > 0 ? ((Math.pow(ev / sv, 1 / yrs)) - 1) * 100 : 0;
            absChange = ev - sv;
            doubleTime = cagr > 0 ? 72 / cagr : Infinity;

            $('pgr-hero-label').textContent = mode === 'cagr' ? 'Compound Annual Growth' : 'Total Percentage Change';
            const displayVal = mode === 'cagr' ? cagr : pctChange;
            $('pgr-result').textContent = displayVal.toFixed(2) + '%';
            $('pgr-result').style.color = displayVal >= 0 ? 'inherit' : '#dc2626';
            $('pgr-subtitle').textContent = `From ${fmt(sv)} to ${fmt(ev)} over ${yrs} years`;
        }

        $('pgr-change').textContent = (pctChange >= 0 ? '+' : '') + pctChange.toFixed(2) + '%';
        $('pgr-change').style.color = pctChange >= 0 ? '#16a34a' : '#dc2626';
        $('pgr-cagr').textContent = cagr.toFixed(2) + '%';
        $('pgr-abs').textContent = (absChange >= 0 ? '+' : '-') + fmt(Math.abs(absChange));
        $('pgr-abs').style.color = absChange >= 0 ? '#16a34a' : '#dc2626';
        $('pgr-double').textContent = (doubleTime > 0 && doubleTime < 200) ? doubleTime.toFixed(1) + ' yrs' : 'N/A';
    }

    ['pgr-start', 'pgr-end', 'pgr-years', 'pgr-periods'].forEach(id => {
        $(id).addEventListener('input', () => {
            if($('pgr-mode').value === 'avg' && id === 'pgr-periods') renderMulti();
            calculate();
        });
    });

    document.querySelectorAll('.pgr-quick').forEach(b => b.addEventListener('click', () => {
        $('pgr-start').value = b.dataset.s;
        $('pgr-end').value = b.dataset.e;
        $('pgr-years').value = b.dataset.y;
        $('pgr-mode').value = 'pct';
        $('pgr-periods-wrap').style.display = 'none';
        $('pgr-multi-wrap').style.display = 'none';
        document.querySelectorAll('.pgr-standard').forEach(el => el.style.display = 'block');
        calculate();
    }));

    $('pgr-copy').addEventListener('click', function(){
        const t = `Growth Analysis\nTotal: ${$('pgr-change').textContent}\nCAGR: ${$('pgr-cagr').textContent}\nAbsolute: ${$('pgr-abs').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('pgr-reset').addEventListener('click', () => location.reload());

    calculate();
});
</script>
