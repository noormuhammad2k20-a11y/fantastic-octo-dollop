<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --gs-hue: 160;
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

    .period-scroll { max-height: 400px; overflow-y: auto; border-radius: 16px; border: 1px solid #f1f5f9; }
    .gs-table { font-size: 0.85rem; }
    .gs-table thead { position: sticky; top: 0; background: #0f172a; color: #fff; z-index: 10; }
    .gs-table th { padding: 1rem; }
    .gs-table td { padding: 0.75rem 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }

    .npv-period-input {
        background: #fff; border-radius: 16px; padding: 1.25rem; border: 1px solid #f1f5f9;
        transition: all 0.2s;
    }
    .npv-period-input:hover { border-color: var(--gs-primary); }

    @media (max-width: 768px) {
        .gs-card { padding: 1.5rem; }
        .gs-header { flex-direction: column; text-align: center; gap: 0.75rem; }
        .gs-icon-box { width: 48px; height: 48px; font-size: 1.25rem; border-radius: 14px; margin: 0 auto; }
        .gs-header h4 { font-size: 1.25rem; }
        .gs-hero-value { font-size: 2.5rem; }
        .gs-stat-value { font-size: 1.25rem; }
    }

    @media print {
        .gs-card:not(.gs-card-output), .btn, .gs-presets, #npv-flows { display: none !important; }
        .gs-card-output { border: none; box-shadow: none; padding: 0; }
        .period-scroll { max-height: none !important; overflow: visible !important; }
    }
</style>
<?php $__env->stopPush(); ?>

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-money-bill-trend-up"></i></div>
                    <div>
                        <h4>Net Present Value (NPV)</h4>
                        <p>Evaluate the profitability of an investment by discounting projected cash flows.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Initial Investment ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="npv-invest" class="form-control gs-input border-start-0" value="100000" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Discount Rate (Annual %)</label>
                        <div class="input-group">
                            <input type="number" id="npv-rate" class="form-control gs-input border-end-0" value="10" step="0.1" min="0">
                            <span class="input-group-text bg-white border-start-0 px-3 fs-5 fw-bold">%</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold small text-uppercase text-muted mb-4 d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-stream me-2 text-primary"></i>Cash Inflows by Period</span>
                        <div class="btn-group">
                            <button class="btn btn-xs btn-outline-dark rounded-start-pill px-3" id="npv-remove"><i class="fas fa-minus"></i></button>
                            <button class="btn btn-xs btn-outline-dark rounded-end-pill px-3" id="npv-add"><i class="fas fa-plus"></i></button>
                        </div>
                    </h6>
                    <div id="npv-flows" class="row g-3"></div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Analysis:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 npv-quick" data-i="50000" data-r="8" data-cf="15000,18000,22000,25000,30000">Growth Project</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 npv-quick" data-i="200000" data-r="12" data-cf="50000,50000,50000,50000,50000,50000">Stable Asset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Net Present Value</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2" id="npv-sign">$</span><span id="npv-result">0</span></div>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm" id="npv-verdict">ANALYZING...</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Gross Inflows</span>
                            <span class="gs-stat-value text-primary" id="npv-inflows">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">PV of Inflows</span>
                            <span class="gs-stat-value text-success" id="npv-pv">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Profitability Index</span>
                            <span class="gs-stat-value text-warning" id="npv-pi">0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Payback Period</span>
                            <span class="gs-stat-value" style="color: #6366f1;" id="npv-payback">—</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5 p-4 bg-white rounded-4 border shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold small text-uppercase text-muted mb-0"><i class="fas fa-table me-2 text-primary"></i>Period Breakdown</h6>
                    </div>
                    <div class="period-scroll">
                        <table class="table gs-table mb-0">
                            <thead><tr><th>Period</th><th>Cash Flow</th><th>Disc. Factor</th><th>Present Value</th><th>Cum. PV</th></tr></thead>
                            <tbody id="npv-tbody"></tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="npv-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="npv-reset">
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
    let tableData = [];

    function renderInputs(){
        const c = $('npv-flows');
        c.innerHTML = '';
        for(let i=1; i<=periods; i++){
            c.insertAdjacentHTML('beforeend', `
                <div class="col-md-4 col-lg-3">
                    <div class="npv-period-input">
                        <label class="gs-label mb-2">Year ${i}</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0 px-2 fw-bold">$</span>
                            <input type="number" class="form-control border-start-0 fw-bold npv-cf" data-period="${i}" value="${i<=5 ? [25000, 30000, 35000, 30000, 25000][i-1] : 20000}">
                        </div>
                    </div>
                </div>
            `);
        }
        c.querySelectorAll('.npv-cf').forEach(el => el.addEventListener('input', calculate));
    }

    function calculate(){
        const invest = parseFloat($('npv-invest').value) || 0;
        const rate = (parseFloat($('npv-rate').value) || 0) / 100;
        const cfs = [];
        document.querySelectorAll('.npv-cf').forEach(el => cfs.push(parseFloat(el.value) || 0));

        let npv = -invest;
        let pvTotal = 0;
        let totalInflows = 0;
        let cumPV = -invest;
        let payback = null;

        tableData = [{period: 'Initial', cf: -invest, df: 1, pv: -invest, cum: -invest}];

        for(let i=0; i<cfs.length; i++){
            const df = 1 / Math.pow(1 + rate, i + 1);
            const pv = cfs[i] * df;
            npv += pv;
            pvTotal += pv;
            totalInflows += cfs[i];
            cumPV += pv;
            if(payback === null && cumPV >= 0) payback = i + 1;
            tableData.push({period: i+1, cf: cfs[i], df: df, pv: pv, cum: cumPV});
        }

        const pi = invest > 0 ? (pvTotal / invest) : 0;
        
        $('npv-result').textContent = Math.abs(Math.round(npv)).toLocaleString('en-US');
        $('npv-sign').textContent = npv < 0 ? '-$' : '$';
        $('npv-result').style.color = npv >= 0 ? '#059669' : '#dc2626';

        const badge = $('npv-verdict');
        if(npv >= 0){
            badge.textContent = 'INVESTMENT PROFITABLE';
            badge.className = 'badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm bg-success text-white';
        } else {
            badge.textContent = 'INVESTMENT UNPROFITABLE';
            badge.className = 'badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm bg-danger text-white';
        }

        $('npv-inflows').textContent = fmt(totalInflows);
        $('npv-pv').textContent = fmt(pvTotal);
        $('npv-pi').textContent = pi.toFixed(2) + 'x';
        $('npv-payback').textContent = payback ? payback + ' Year' + (payback > 1 ? 's' : '') : 'N/A';

        $('npv-tbody').innerHTML = tableData.map(r => `
            <tr class="${r.period === 'Initial' ? 'table-light' : ''}">
                <td class="fw-bold">${r.period}</td>
                <td>${fmt(r.cf)}</td>
                <td class="text-muted">${r.df.toFixed(4)}</td>
                <td class="${r.pv >= 0 ? 'text-success' : 'text-danger'} fw-bold">${fmt(r.pv)}</td>
                <td class="${r.cum >= 0 ? 'text-success' : 'text-danger'} fw-bold">${fmt(r.cum)}</td>
            </tr>
        `).join('');
    }

    $('npv-add').addEventListener('click', () => { if(periods < 25) { periods++; renderInputs(); calculate(); } });
    $('npv-remove').addEventListener('click', () => { if(periods > 1) { periods--; renderInputs(); calculate(); } });
    ['npv-invest', 'npv-rate'].forEach(id => $(id).addEventListener('input', calculate));

    document.querySelectorAll('.npv-quick').forEach(b => b.addEventListener('click', () => {
        $('npv-invest').value = b.dataset.i;
        $('npv-rate').value = b.dataset.r;
        const cfs = b.dataset.cf.split(',');
        periods = cfs.length;
        renderInputs();
        document.querySelectorAll('.npv-cf').forEach((el, i) => { if(i < cfs.length) el.value = cfs[i]; });
        calculate();
    }));

    $('npv-copy').addEventListener('click', function(){
        const text = `NPV Analysis\nNPV: ${$('npv-sign').textContent}${$('npv-result').textContent}\nPI: ${$('npv-pi').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('npv-reset').addEventListener('click', () => location.reload());

    renderInputs();
    calculate();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\npv-calculator.blade.php ENDPATH**/ ?>