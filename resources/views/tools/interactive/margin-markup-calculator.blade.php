@push('styles')
<style>
    :root {
        --gs-hue: 310;
        --gs-primary: hsl(var(--gs-hue), 85%, 45%);
        --gs-primary-light: hsl(var(--gs-hue), 85%, 95%);
        --gs-primary-glow: hsla(var(--gs-hue), 85%, 45%, 0.15);
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
        background: linear-gradient(135deg, hsla(var(--gs-hue), 85%, 45%, 0.03), hsla(var(--gs-hue), 85%, 55%, 0.06));
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

    .ratio-bar { height: 14px; border-radius: 7px; background: #f1f5f9; overflow: hidden; display: flex; margin-top: 1rem; }
    .ratio-cost { background: #ef4444; height: 100%; }
    .ratio-profit { background: #22c55e; height: 100%; }

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
                    <div class="gs-icon-box"><i class="fas fa-tags"></i></div>
                    <div>
                        <h4>Margin & Markup Calculator</h4>
                        <p>Analyze product profitability, convert between pricing strategies, and set optimal selling prices.</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="gs-label">Solve Method</label>
                        <select id="mu-mode" class="form-select gs-input">
                            <option value="prices" selected>Known Cost & Sale Price</option>
                            <option value="markup">Cost & Desired Markup %</option>
                            <option value="margin">Cost & Desired Margin %</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Cost per Unit ($)</label>
                        <input type="number" id="mu-cost" class="form-control gs-input" value="50" step="0.01">
                    </div>
                    <div class="col-md-4" id="mu-sell-wrap">
                        <label class="gs-label">Selling Price ($)</label>
                        <input type="number" id="mu-sell" class="form-control gs-input" value="80" step="0.01">
                    </div>
                    <div class="col-md-4" id="mu-markup-wrap" style="display:none;">
                        <label class="gs-label">Markup (%)</label>
                        <input type="number" id="mu-markup-in" class="form-control gs-input" value="60" step="0.1">
                    </div>
                    <div class="col-md-4" id="mu-margin-wrap" style="display:none;">
                        <label class="gs-label">Margin (%)</label>
                        <input type="number" id="mu-margin-in" class="form-control gs-input" value="37.5" step="0.1">
                    </div>
                    <div class="col-md-4">
                        <label class="gs-label">Volume (Units/mo)</label>
                        <input type="number" id="mu-qty" class="form-control gs-input" value="100">
                    </div>
                </div>

                <div class="mt-5 gs-presets">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="fw-bold small text-uppercase text-muted"><i class="fas fa-bolt text-warning me-1"></i> Industry Norms:</span>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 mu-quick" data-c="2.50" data-s="5" data-q="500">Retail (50% Margin)</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 mu-quick" data-c="15" data-s="45" data-q="200">Apparel (200% Markup)</button>
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-4 mu-quick" data-c="0" data-s="29.99" data-q="1000">SaaS (100% Margin)</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="gs-card gs-card-output">
                <div class="gs-hero">
                    <span class="gs-hero-label">Gross Profit per Unit</span>
                    <div class="gs-hero-value"><span class="fs-2 text-muted opacity-50 me-2">$</span><span id="mu-profit">0</span></div>
                    <div class="d-flex justify-content-center gap-4 mt-2">
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1 text-danger"></i> Cost</div>
                        <div class="small fw-bold text-muted"><i class="fas fa-circle me-1 text-success"></i> Profit</div>
                    </div>
                    <div class="ratio-bar mx-auto" style="max-width: 400px;">
                        <div id="mu-bar-cost" class="ratio-cost"></div>
                        <div id="mu-bar-profit" class="ratio-profit"></div>
                    </div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Markup %</span>
                            <span class="gs-stat-value" style="color: var(--gs-primary);" id="mu-markup">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Margin %</span>
                            <span class="gs-stat-value text-indigo" id="mu-margin">0%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Monthly Profit</span>
                            <span class="gs-stat-value text-success" id="mu-monthly">$0</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gs-stat-card">
                            <span class="gs-stat-label">Gross Revenue</span>
                            <span class="gs-stat-value text-primary" id="mu-revenue">$0</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold small text-uppercase text-muted mb-3">Accounting Breakdown</h6>
                    <div class="table-responsive rounded-4 border p-3 bg-white">
                        <table class="table gs-table mb-0">
                            <tbody>
                                <tr><td class="text-muted">Unit Cost</td><td class="text-end fw-bold" id="mu-r-cost">$0</td></tr>
                                <tr><td class="text-muted">Unit Sale Price</td><td class="text-end fw-bold" id="mu-r-sell">$0</td></tr>
                                <tr class="border-top"><td class="text-muted pt-2">Unit Gross Profit</td><td class="text-end fw-bold text-success pt-2" id="mu-r-profit">$0</td></tr>
                                <tr><td class="text-muted">Markup Factor</td><td class="text-end fw-bold text-primary" id="mu-r-mult">0x</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="mm-copy" style="width: auto;">
                        <i class="fas fa-copy me-2"></i>Copy Analysis
                    </button>
                    <button class="btn btn-link text-muted text-decoration-none fw-bold" id="mm-reset">
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

    $('mu-mode').addEventListener('change', function(){
        const m = this.value;
        $('mu-markup-wrap').style.display = m === 'markup' ? 'block' : 'none';
        $('mu-margin-wrap').style.display = m === 'margin' ? 'block' : 'none';
        $('mu-sell-wrap').style.display = m === 'prices' ? 'block' : 'none';
        calculate();
    });

    function calculate(){
        const mode = $('mu-mode').value;
        let cost = parseFloat($('mu-cost').value) || 0;
        let sell = 0, profit = 0, markup = 0, margin = 0;

        if(mode === 'prices'){
            sell = parseFloat($('mu-sell').value) || 0;
        } else if(mode === 'markup'){
            const mkp = (parseFloat($('mu-markup-in').value) || 0) / 100;
            sell = cost * (1 + mkp);
            $('mu-sell').value = sell.toFixed(2);
        } else {
            const mgn = (parseFloat($('mu-margin-in').value) || 0) / 100;
            sell = mgn < 1 ? cost / (1 - mgn) : cost;
            $('mu-sell').value = sell.toFixed(2);
        }

        profit = sell - cost;
        markup = cost > 0 ? (profit / cost) * 100 : 0;
        margin = sell > 0 ? (profit / sell) * 100 : 0;

        const qty = parseInt($('mu-qty').value) || 0;
        const monthlyProfit = profit * qty;
        const monthlyRev = sell * qty;
        const mult = cost > 0 ? (sell / cost) : 0;

        $('mu-profit').textContent = profit.toFixed(2);
        $('mu-markup').textContent = markup.toFixed(1) + '%';
        $('mu-margin').textContent = margin.toFixed(1) + '%';
        $('mu-monthly').textContent = '$' + Math.round(monthlyProfit).toLocaleString();
        $('mu-revenue').textContent = '$' + Math.round(monthlyRev).toLocaleString();
        
        $('mu-r-cost').textContent = fmt(cost);
        $('mu-r-sell').textContent = fmt(sell);
        $('mu-r-profit').textContent = fmt(profit);
        $('mu-r-mult').textContent = mult.toFixed(2) + 'x';

        if(sell > 0){
            const cp = (cost / sell) * 100;
            $('mu-bar-cost').style.width = cp + '%';
            $('mu-bar-profit').style.width = (100 - cp) + '%';
        }
    }

    ['mu-cost', 'mu-sell', 'mu-markup-in', 'mu-margin-in', 'mu-qty'].forEach(id => {
        $(id).addEventListener('input', calculate);
    });

    document.querySelectorAll('.mu-quick').forEach(b => b.addEventListener('click', () => {
        $('mu-cost').value = b.dataset.c;
        $('mu-sell').value = b.dataset.s;
        $('mu-qty').value = b.dataset.q;
        $('mu-mode').value = 'prices';
        $('mu-markup-wrap').style.display = 'none';
        $('mu-margin-wrap').style.display = 'none';
        $('mu-sell-wrap').style.display = 'block';
        calculate();
    }));

    $('mm-copy').addEventListener('click', function(){
        const t = `Margin/Markup Analysis\nProfit/Unit: $${$('mu-profit').textContent}\nMarkup: ${$('mu-markup').textContent}\nMargin: ${$('mu-margin').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!'; setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('mm-reset').addEventListener('click', () => location.reload());

    calculate();
});
</script>
