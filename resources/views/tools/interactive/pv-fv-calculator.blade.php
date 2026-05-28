@push('styles')
<style>
    :root {
        --gs-hue: 260;
        --gs-primary: hsl(var(--gs-hue), 80%, 55%);
        --gs-primary-light: hsl(var(--gs-hue), 80%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 80%, 55%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 80%, 55%, 0.03), hsla(var(--gs-hue), 80%, 75%, 0.06));
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

    .gs-progress-wrapper { background: #fff; padding: 2rem; border-radius: 24px; border: 1px solid rgba(0,0,0,0.05); margin-top: 2rem; }
    .gs-progress { height: 32px; border-radius: 100px; background: #f1f5f9; overflow: hidden; display: flex; }
    .gs-progress-bar { height: 100%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; color: #fff; transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1); }

    .proj-scroll { max-height: 400px; overflow-y: auto; border-radius: 16px; border: 1px solid #f1f5f9; }
    .gs-table { font-size: 0.85rem; }
    .gs-table thead { position: sticky; top: 0; background: #0f172a; color: #fff; z-index: 10; }
    .gs-table th { padding: 1rem; }
    .gs-table td { padding: 0.75rem 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }

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
        .proj-scroll { max-height: none !important; overflow: visible !important; }
    }
</style>
@endpush

<div class="gs-rebuilt">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="gs-card">
                <div class="gs-header">
                    <div class="gs-icon-box"><i class="fas fa-clock-rotate-left"></i></div>
                    <div>
                        <h4>PV/FV Calculator</h4>
                        <p>Calculate the Time Value of Money — analyze present vs future values with ease.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Calculation Mode</label>
                        <select id="pv-mode" class="form-select gs-input">
                            <option value="fv" selected>Calculate Future Value (FV)</option>
                            <option value="pv">Calculate Present Value (PV)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label" id="pv-label-init">Initial Amount ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="pv-principal" class="form-control gs-input border-start-0" value="10000" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Annual Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="pv-rate" class="form-control gs-input border-end-0" value="7.5" step="0.1" min="0">
                            <span class="input-group-text bg-white border-start-0 px-3 fs-5 fw-bold">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Time Period (Years)</label>
                        <input type="number" id="pv-years" class="form-control gs-input" value="10" min="1" max="100">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Compounding</label>
                        <select id="pv-compound" class="form-select gs-input">
                            <option value="1">Annually</option>
                            <option value="4">Quarterly</option>
                            <option value="12" selected>Monthly</option>
                            <option value="365">Daily</option>
                            <option value="0">Continuous</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Periodic Contribution</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 px-3 fs-5 fw-bold">$</span>
                            <input type="number" id="pv-pmt" class="form-control gs-input border-start-0" value="250" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="gs-label">Timing</label>
                        <select id="pv-timing" class="form-select gs-input">
                            <option value="end" selected>End of Period</option>
                            <option value="begin">Beginning of Period</option>
                        </select>
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Presets:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 pv-quick" data-p="5000" data-r="5" data-y="5" data-pmt="100">Conservative</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 pv-quick" data-p="10000" data-r="10" data-y="20" data-pmt="500">Aggressive</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label" id="pv-hero-label">Future Value</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="pv-result">0</span></div>
                    <div class="mt-2"><span class="badge rounded-pill px-4 py-2 fs-6 fw-bold shadow-sm bg-primary text-white" id="pv-badge">ANALYSIS READY</span></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Initial Amount</span>
                            <span class="gs-stat-value text-primary" id="pv-out-init">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Contributions</span>
                            <span class="gs-stat-value" style="color: #3b82f6;" id="pv-out-contrib">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Interest Gained</span>
                            <span class="gs-stat-value text-success" id="pv-out-int">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Wealth Multiple</span>
                            <span class="gs-stat-value text-warning" id="pv-out-mult">0x</span>
                        </div>
                    </div>
                </div>

                <div class="gs-progress-wrapper" id="pv-progress-box">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3 d-flex justify-content-between">
                        <span><i class="fas fa-chart-pie me-2 text-primary"></i>Capital Breakdown</span>
                        <span id="pv-progress-text">Initial vs Interest</span>
                    </h6>
                    <div class="gs-progress">
                        <div class="gs-progress-bar" id="pv-bar-init" style="background: #8b5cf6; width: 40%;">Initial</div>
                        <div class="gs-progress-bar" id="pv-bar-contrib" style="background: #3b82f6; width: 30%;">Contrib</div>
                        <div class="gs-progress-bar" id="pv-bar-int" style="background: #10b981; width: 30%;">Interest</div>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm" id="pv-table-box">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold small text-uppercase text-muted mb-0"><i class="fas fa-table me-2 text-primary"></i>Year-by-Year Growth</h6>
                    </div>
                    <div class="proj-scroll">
                        <table class="table gs-table mb-0">
                            <thead><tr><th>Year</th><th>Contributions</th><th>Interest</th><th>End Balance</th></tr></thead>
                            <tbody id="pv-tbody"></tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="pv-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="pv-reset">
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
    let yearData = [];

    function calculate(){
        const mode = $('pv-mode').value;
        const P = parseFloat($('pv-principal').value) || 0;
        const r = (parseFloat($('pv-rate').value) || 0) / 100;
        const t = parseInt($('pv-years').value) || 1;
        const n = parseInt($('pv-compound').value);
        const pmt = parseFloat($('pv-pmt').value) || 0;
        const beginMode = $('pv-timing').value === 'begin';

        let fv, totalContrib, totalInt;
        
        if(mode === 'fv'){
            $('pv-hero-label').textContent = 'Future Value';
            $('pv-label-init').textContent = 'Initial Investment ($)';
            $('pv-progress-box').style.display = 'block';
            $('pv-table-box').style.display = 'block';
            
            if(n === 0){ // Continuous
                fv = P * Math.exp(r * t);
                totalContrib = P + (pmt * 12 * t);
            } else {
                const periodicRate = r / n;
                const periods = n * t;
                const pmtPerPeriod = pmt * 12 / n;
                
                const fvLump = P * Math.pow(1 + periodicRate, periods);
                let fvAnnuity = 0;
                if(periodicRate > 0){
                    fvAnnuity = pmtPerPeriod * ((Math.pow(1 + periodicRate, periods) - 1) / periodicRate);
                    if(beginMode) fvAnnuity *= (1 + periodicRate);
                } else {
                    fvAnnuity = pmtPerPeriod * periods;
                }
                fv = fvLump + fvAnnuity;
                totalContrib = P + (pmt * 12 * t);
            }
            totalInt = fv - totalContrib;
            
            $('pv-result').textContent = Math.round(fv).toLocaleString('en-US');
            $('pv-out-init').textContent = fmt(P);
            $('pv-out-contrib').textContent = fmt(totalContrib);
            $('pv-out-int').textContent = fmt(totalInt);
            $('pv-out-mult').textContent = totalContrib > 0 ? (fv / totalContrib).toFixed(2) + 'x' : '1.00x';

            const ip = (P / fv) * 100;
            const cp = ((totalContrib - P) / fv) * 100;
            const iip = (totalInt / fv) * 100;
            $('pv-bar-init').style.width = ip + '%';
            $('pv-bar-contrib').style.width = cp + '%';
            $('pv-bar-int').style.width = iip + '%';

            // Table
            yearData = [];
            let bal = P;
            const mRate = r / 12;
            for(let yr = 1; yr <= t; yr++){
                for(let m = 0; m < 12; m++){
                    const interest = bal * mRate;
                    bal += interest + pmt;
                }
                const yrContrib = P + (pmt * 12 * yr);
                yearData.push({year: yr, contrib: yrContrib, interest: bal - yrContrib, balance: bal});
            }
            $('pv-tbody').innerHTML = yearData.map(r => `<tr>
                <td class="fw-bold">Year ${r.year}</td>
                <td class="text-primary">${fmt(r.contrib)}</td>
                <td class="text-success">${fmt(r.interest)}</td>
                <td class="fw-bold">${fmt(r.balance)}</td>
            </tr>`).join('');

        } else {
            // PV Mode
            $('pv-hero-label').textContent = 'Present Value';
            $('pv-label-init').textContent = 'Future Value Goal ($)';
            $('pv-progress-box').style.display = 'none';
            $('pv-table-box').style.display = 'none';
            
            const fvDesired = P;
            let pv;
            if(n === 0){
                pv = fvDesired * Math.exp(-r * t);
            } else {
                const periodicRate = r / n;
                const periods = n * t;
                pv = fvDesired / Math.pow(1 + periodicRate, periods);
            }
            
            $('pv-result').textContent = Math.round(pv).toLocaleString('en-US');
            $('pv-out-init').textContent = fmt(pv);
            $('pv-out-contrib').textContent = fmt(fvDesired);
            $('pv-out-int').textContent = fmt(fvDesired - pv);
            $('pv-out-mult').textContent = pv > 0 ? (fvDesired / pv).toFixed(2) + 'x' : '—';
        }
    }

    ['pv-principal','pv-rate','pv-years','pv-compound','pv-pmt','pv-timing','pv-mode'].forEach(id => {
        $(id).addEventListener('input', calculate);
        $(id).addEventListener('change', calculate);
    });

    document.querySelectorAll('.pv-quick').forEach(b => b.addEventListener('click', () => {
        $('pv-principal').value = b.dataset.p;
        $('pv-rate').value = b.dataset.r;
        $('pv-years').value = b.dataset.y;
        $('pv-pmt').value = b.dataset.pmt;
        $('pv-mode').value = 'fv';
        calculate();
    }));

    $('pv-copy').addEventListener('click', function(){
        const text = `PV/FV Analysis\nResult: $${$('pv-result').textContent}\nInitial: ${$('pv-out-init').textContent}\nInterest: ${$('pv-out-int').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('pv-reset').addEventListener('click', () => location.reload());
    calculate();
});
</script>

