<div class="row g-4 fire-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            <div class="calculator-header">
                <div class="tool-icon-circle" style="background:rgba(245,158,11,.1);color:#f59e0b">
                    <i class="fas fa-sun"></i>
                </div>
                <div>
                    <h4>Financial Freedom (FIRE) Planner</h4>
                    <p>Determine your "FIRE Number" and estimate when you can achieve full financial independence.</p>
                </div>
            </div>

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Living Expenses</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="annual-exp" class="form-control form-control-lg border-start-0" value="45000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Savings / Portfolio</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="current-savings" class="form-control form-control-lg border-start-0" value="50000">
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Monthly Contribution</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="monthly-invest" class="form-control form-control-lg border-start-0" value="2000">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Annual Return (%)</label>
                        <div class="input-group">
                            <input type="number" id="annual-return" class="form-control form-control-lg border-end-0" value="7" step="0.1">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Withdrawal Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="swr" class="form-control form-control-lg border-end-0" value="4" step="0.1">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fire-quick" data-e="30000" data-s="4">🧘 Lean FIRE</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 fire-quick" data-e="60000" data-s="4">🏦 Standard FIRE</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 fire-quick" data-e="150000" data-s="3.5">💎 Fat FIRE</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.06);">
            <div class="output-hero">
                <span class="output-hero-label">YOUR FIRE NUMBER</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-unit">$</span>
                    <span class="output-hero-value" id="out-fire-num">1,125,000</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-years-left">Estimated Timeline: 18.5 Years</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">SAVINGS GAP</span>
                        <span class="stat-card-value text-warning" id="out-gap">$1,075,000</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">PROGRESS</span>
                        <span class="stat-card-value text-success" id="out-pct">4.4%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#6366f1; background: rgba(99,102,241,.02);">
                        <span class="stat-card-label">MONTHLY INCOME</span>
                        <span class="stat-card-value text-primary" id="out-monthly-target">$3,750</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-route text-warning me-2"></i>Roadmap to Independence
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fire-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-warning"></i>Copy Journey Stats
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="fire-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="fire-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Roadmap
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const expE = $('annual-exp'), savE = $('current-savings'), 
          invE = $('monthly-invest'), retE = $('annual-return'), swrE = $('swr');

    function calculate(){
        let exp = parseFloat(expE.value) || 0;
        let sav = parseFloat(savE.value) || 0;
        let inv = parseFloat(invE.value) || 0;
        let ret = (parseFloat(retE.value) || 0) / 100;
        let swr = (parseFloat(swrE.value) || 0) / 100;

        if(exp <= 0 || swr <= 0) return;

        // FIRE Number = Annual Expenses / Withdrawal Rate
        const fireNum = exp / swr;
        const gap = Math.max(0, fireNum - sav);
        const progress = (sav / fireNum) * 100;

        // Years left (approx via future value of annuity formula)
        // FV = P(1+r)^n + C[((1+r)^n - 1)/r]
        // Here we solve for n: n = log((FV*r + C) / (P*r + C)) / log(1+r)
        let yearsLeft = 0;
        if(gap > 0) {
            const r = ret / 12; // monthly rate
            const c = inv; // monthly contribution
            const p = sav; // principal
            const fv = fireNum;

            if(r > 0) {
                yearsLeft = Math.log((fv * r + c) / (p * r + c)) / (12 * Math.log(1 + r));
            } else if(c > 0) {
                yearsLeft = gap / (c * 12);
            } else {
                yearsLeft = Infinity;
            }
        }

        // Update UI
        $('out-fire-num').textContent = Math.round(fireNum).toLocaleString();
        $('out-years-left').textContent = gap > 0 
            ? `Estimated Timeline: ${yearsLeft === Infinity ? 'Indefinite' : yearsLeft.toFixed(1) + ' Years'}`
            : 'CONGRATULATIONS! YOU ARE FINANCIALLY INDEPENDENT';
        
        $('out-gap').textContent = '$' + Math.round(gap).toLocaleString();
        $('out-pct').textContent = (progress > 100 ? 100 : progress).toFixed(1) + '%';
        $('out-monthly-target').textContent = '$' + Math.round(exp / 12).toLocaleString();

        // Insights
        const ins = [];
        if(gap === 0) {
            ins.push('You have reached your FIRE number. Your portfolio can likely sustain your current lifestyle indefinitely.');
        } else {
            ins.push(`You are <strong>${progress.toFixed(1)}%</strong> of the way to your goal. Stay consistent with your monthly contributions.`);
        }

        if(ret < 0.05) {
            ins.push('Note: Your expected return is conservative. Real market history (S&P 500) averages ~7-10% inflation-adjusted.');
        }

        if(swr > 0.04) {
            ins.push('<strong>Risk Alert</strong>: A withdrawal rate above 4% is considered aggressive and may deplete your funds in a down market.');
        } else if(swr <= 0.035) {
            ins.push('Safety Perk: A 3.5% or lower withdrawal rate is considered extremely safe for long-term (40+ year) retirement.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-warning me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [expE, savE, invE, retE, swrE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.fire-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            expE.value = btn.dataset.e;
            swrE.value = btn.dataset.s;
            calculate();
        });
    });

    $('fire-reset').addEventListener('click', ()=>{
        expE.value = 45000;
        savE.value = 50000;
        invE.value = 2000;
        retE.value = 7;
        swrE.value = 4;
        calculate();
    });

    $('fire-copy-btn').addEventListener('click', function(){
        const text = `Financial Freedom Roadmap\nFIRE Number: $${$('out-fire-num').textContent}\n${$('out-years-left').textContent}\nCurrent Progress: ${$('out-pct').textContent}\nGenerated by ToolsHub Independence Mapper`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Roadmap Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.fire-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(245,158,11,.05)}
.fire-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.fire-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.fire-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.fire-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.fire-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:1.8rem;color:#64748b;font-weight:800;margin-left:8px}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:2rem;font-weight:900;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .fire-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/interactive/financial-freedom-calculator.blade.php ENDPATH**/ ?>