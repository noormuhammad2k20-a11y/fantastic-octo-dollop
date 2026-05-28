@push('styles')
<style>
    :root {
        --gs-hue: 35;
        --gs-primary: hsl(var(--gs-hue), 90%, 45%);
        --gs-primary-light: hsl(var(--gs-hue), 90%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 90%, 45%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 90%, 45%, 0.03), hsla(var(--gs-hue), 90%, 55%, 0.06));
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

    .ratio-bar { height: 12px; border-radius: 6px; background: #f1f5f9; overflow: hidden; display: flex; margin-top: 1rem; }
    .ratio-p { background: #3b82f6; height: 100%; }
    .ratio-i { background: var(--gs-primary); height: 100%; }

    .gs-table { font-size: 0.85rem; }
    .gs-table thead { background: #0f172a; color: #fff; }

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
                    <div class="gs-icon-box"><i class="fas fa-percent"></i></div>
                    <div>
                        <h4>Simple Interest Calculator</h4>
                        <p>Basic interest calculations for loans, deposits, and short-term investments.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="gs-label">Solve For</label>
                        <select id="si-mode" class="form-select gs-input">
                            <option value="interest" selected>Interest & Total Amount</option>
                            <option value="principal">Required Principal</option>
                            <option value="rate">Required Interest Rate</option>
                            <option value="time">Required Time (Years)</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="si-target-wrap" style="display:none;">
                        <label class="gs-label">Target Total Amount ($)</label>
                        <input type="number" id="si-target" class="form-control gs-input" value="12500">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Principal Amount ($)</label>
                        <input type="number" id="si-principal" class="form-control gs-input" value="10000">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Interest Rate (%)</label>
                        <input type="number" id="si-rate" class="form-control gs-input" value="5" step="0.1">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Time Period (Years)</label>
                        <input type="number" id="si-years" class="form-control gs-input" value="5" step="0.5">
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Quick Scenarios:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 si-quick" data-p="5000" data-r="3.5" data-y="2">Savings CD</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 si-quick" data-p="25000" data-r="6" data-y="10">Investment Bond</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 si-quick" data-p="100000" data-r="4.25" data-y="20">Trust Fund</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label" id="si-hero-label">Interest Earned</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="si-result">0</span></div>
                    <div class="d-flex justify-content-center gap-4 mt-2">
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1" style="color: #3b82f6;"></i> Principal</div>
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1" style="color: var(--gs-primary);"></i> Interest</div>
                    </div>
                    <div class="ratio-bar mx-auto" style="max-width: 400px;">
                        <div id="si-bar-p" class="ratio-p"></div>
                        <div id="si-bar-i" class="ratio-i"></div>
                    </div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Principal</span>
                            <span class="gs-stat-value text-primary" id="si-out-principal">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Interest</span>
                            <span class="gs-stat-value" style="color: var(--gs-primary);" id="si-out-interest">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Total Amount</span>
                            <span class="gs-stat-value text-success" id="si-out-total">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Compound Diff.</span>
                            <span class="gs-stat-value text-warning" id="si-out-diff">+$0</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3">Growth Projection</h6>
                    <div class="table-responsive rounded-4 border">
                        <table class="table gs-table mb-0">
                            <thead><tr><th>Year</th><th>Simple Int.</th><th>Simple Total</th><th>Compound Int.</th><th>Compound Total</th></tr></thead>
                            <tbody id="si-tbody"></tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="si-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="si-reset">
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

    $('si-mode').addEventListener('change', function(){
        $('si-target-wrap').style.display = this.value !== 'interest' ? 'block' : 'none';
        calculate();
    });

    function calculate(){
        const mode = $('si-mode').value;
        let P = parseFloat($('si-principal').value) || 0;
        let r = (parseFloat($('si-rate').value) || 0) / 100;
        let t = parseFloat($('si-years').value) || 0;
        const target = parseFloat($('si-target').value) || 0;
        let interest, total;

        if(mode === 'interest'){
            interest = P * r * t;
            total = P + interest;
            $('si-hero-label').textContent = 'Total Interest Earned';
            $('si-result').textContent = Math.round(interest).toLocaleString('en-US');
        } else if(mode === 'principal'){
            P = r * t > 0 ? target / (1 + r * t) : target;
            $('si-principal').value = Math.round(P);
            interest = P * r * t;
            total = P + interest;
            $('si-hero-label').textContent = 'Principal Required';
            $('si-result').textContent = Math.round(P).toLocaleString('en-US');
        } else if(mode === 'rate'){
            r = P * t > 0 ? (target - P) / (P * t) : 0;
            $('si-rate').value = (r * 100).toFixed(2);
            interest = P * r * t;
            total = P + interest;
            $('si-hero-label').textContent = 'Required Annual Rate';
            $('si-result').textContent = (r * 100).toFixed(2) + '%';
        } else {
            t = P * r > 0 ? (target - P) / (P * r) : 0;
            $('si-years').value = t.toFixed(1);
            interest = P * r * t;
            total = P + interest;
            $('si-hero-label').textContent = 'Required Time (Years)';
            $('si-result').textContent = t.toFixed(1);
        }

        const compoundTotal = P * Math.pow(1 + r, t);
        const compoundInt = compoundTotal - P;
        const diff = compoundTotal - total;

        $('si-out-principal').textContent = fmt(P);
        $('si-out-interest').textContent = fmt(interest);
        $('si-out-total').textContent = fmt(total);
        $('si-out-diff').textContent = '+' + fmt(diff);

        if(total > 0){
            const pp = (P / total) * 100;
            $('si-bar-p').style.width = pp + '%';
            $('si-bar-i').style.width = (100 - pp) + '%';
        }

        yearData = [];
        const maxYrs = Math.ceil(t) || 10;
        for(let y = 1; y <= Math.min(maxYrs, 50); y++){
            const si = P * r * y;
            const ci = P * Math.pow(1 + r, y) - P;
            yearData.push({year: y, si, sTotal: P + si, ci, cTotal: P + ci});
        }

        $('si-tbody').innerHTML = yearData.map(r => `
            <tr>
                <td class="fw-bold">Year ${r.year}</td>
                <td>${fmt(r.si)}</td>
                <td class="text-primary fw-semibold">${fmt(r.sTotal)}</td>
                <td>${fmt(r.ci)}</td>
                <td class="text-success fw-semibold">${fmt(r.cTotal)}</td>
            </tr>
        `).join('');
    }

    ['si-principal', 'si-rate', 'si-years', 'si-target'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    document.querySelectorAll('.si-quick').forEach(b => b.addEventListener('click', () => {
        $('si-principal').value = b.dataset.p;
        $('si-rate').value = b.dataset.r;
        $('si-years').value = b.dataset.y;
        $('si-mode').value = 'interest';
        $('si-target-wrap').style.display = 'none';
        calculate();
    }));

    $('si-copy').addEventListener('click', function(){
        const t = `Simple Interest Analysis\nPrincipal: ${$('si-out-principal').textContent}\nInterest: ${$('si-out-interest').textContent}\nTotal: ${$('si-out-total').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('si-reset').addEventListener('click', () => location.reload());
    calculate();
});
</script>

}
</style>
