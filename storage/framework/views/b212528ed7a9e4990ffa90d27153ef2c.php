<div class="row g-4 dividend-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Portfolio Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="init-principal" class="form-control form-control-lg border-start-0" value="10000">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Dividend Yield (%)</label>
                        <div class="input-group">
                            <input type="number" id="div-yield" class="form-control form-control-lg border-end-0" value="4" step="0.1">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Dividend Growth (%)</label>
                        <div class="input-group">
                            <input type="number" id="div-growth" class="form-control form-control-lg border-end-0" value="7" step="0.1">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Monthly Contribution</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="monthly-add" class="form-control form-control-lg border-start-0" value="500">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Years To Model</label>
                        <input type="number" id="div-years" class="form-control form-control-lg" value="20" min="1" max="50">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Price Appreciation (%)</label>
                        <div class="input-group">
                            <input type="number" id="price-growth" class="form-control form-control-lg border-end-0" value="5" step="0.1">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 div-quick" data-p="1000" data-y="3.5" data-g="10">🏃 Growth Focus</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 div-quick" data-y="8" data-g="2">🏦 Income Focus</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 div-quick" data-p="100000" data-y="4" data-g="8">💎 High Net Worth</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:45;--tool-color:#eab308;--tool-bg:rgba(234,179,8,.06);">
            <div class="output-hero">
                <span class="output-hero-label">PROJECTED ANNUAL PASSIVE INCOME</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-unit">$</span>
                    <span class="output-hero-value" id="out-annual-income">32,450</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-future-val">Future Portfolio: $812,000</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#eab308; background: rgba(234,179,8,.02);">
                        <span class="stat-card-label">MONTHLY DIVIDEND</span>
                        <span class="stat-card-value text-warning" id="out-monthly-income">$2,704</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">YIELD ON COST</span>
                        <span class="stat-card-value text-success" id="out-yoc">24.5%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6; background: rgba(59,130,246,.02);">
                        <span class="stat-card-label">SNOWBALL POWER</span>
                        <span class="stat-card-value text-primary" id="out-snowball">8X</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-chart-line text-warning me-2"></i>Passive Income Growth Projection
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="div-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-warning"></i>Copy Growth Schedule
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="div-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="div-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Snowball Map
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const princE = $('init-principal'), yieldE = $('div-yield'), 
          growE = $('div-growth'), yearE = $('div-years'),
          addE = $('monthly-add'), priceE = $('price-growth');

    function calculate(){
        let p = parseFloat(princE.value) || 0;
        let y = (parseFloat(yieldE.value) || 0) / 100;
        let dg = (parseFloat(growE.value) || 0) / 100;
        let yrs = parseFloat(yearE.value) || 0;
        let add = parseFloat(addE.value) || 0;
        let pg = (parseFloat(priceE.value) || 0) / 100;

        if(yrs <= 0) return;

        let currentP = p;
        let currentY = y;
        let totalInvested = p;

        for(let i=0; i < yrs; i++) {
            // Annual income for current year
            let annualDiv = currentP * currentY;
            
            // Reinvest dividends + monthly contributions
            let reinvest = annualDiv + (add * 12);
            totalInvested += (add * 12);

            // Capital Appreciation
            currentP = (currentP * (1 + pg)) + reinvest;

            // Dividend Growth
            currentY = currentY * (1 + dg);
        }

        const finalIncome = currentP * currentY;
        const yoc = (finalIncome / totalInvested) * 100;
        const multiplier = finalIncome / (p * y + (yrs > 0 ? 1 : 0)); // How many times initial income

        // Update UI
        $('out-annual-income').textContent = Math.round(finalIncome).toLocaleString();
        $('out-future-val').textContent = `Future Portfolio: $${Math.round(currentP).toLocaleString()}`;
        
        $('out-monthly-income').textContent = '$' + Math.round(finalIncome / 12).toLocaleString();
        $('out-yoc').textContent = yoc.toFixed(1) + '%';
        $('out-snowball').textContent = multiplier.toFixed(1) + 'X';

        // Insights
        const ins = [];
        ins.push(`In ${yrs} years, your portfolio is projected to generate <strong>$${Math.round(finalIncome/12).toLocaleString()}</strong> per month in purely passive income.`);
        
        if(yoc > 15) {
            ins.push('<strong>Yield on Cost Power</strong>: Your long-term dividend growth has turned your initial cost basis into a high-yield machine.');
        }

        if(add > 1000) {
            ins.push('Aggressive Accumulation: Your high monthly contributions are significantly accelerating the snowball effect.');
        }

        if(pg > 0.08) {
            ins.push('Optimistic Growth: An 8%+ price appreciation targets aggressive equity sectors. Ensure your portfolio is diversified.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-warning me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [princE, yieldE, growE, yearE, addE, priceE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.div-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            if(btn.dataset.p) princE.value = btn.dataset.p;
            if(btn.dataset.y) yieldE.value = btn.dataset.y;
            if(btn.dataset.g) growE.value = btn.dataset.g;
            calculate();
        });
    });

    $('div-reset').addEventListener('click', ()=>{
        princE.value = 10000;
        yieldE.value = 4;
        growE.value = 7;
        yearE.value = 20;
        addE.value = 500;
        priceE.value = 5;
        calculate();
    });

    $('div-copy-btn').addEventListener('click', function(){
        const text = `Dividend Snowball Forecast\nProjected Annual Income: $${$('out-annual-income').textContent}\nFuture Portfolio Value: ${$('out-future-val').textContent}\nYield on Cost: ${$('out-yoc').textContent}\nGenerated by ToolsHub Dividend Snowball Engine`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Schedule Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.dividend-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(234,179,8,.05)}
.dividend-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.dividend-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.dividend-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.dividend-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.dividend-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
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
    .dividend-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\dividend-income-calculator.blade.php ENDPATH**/ ?>