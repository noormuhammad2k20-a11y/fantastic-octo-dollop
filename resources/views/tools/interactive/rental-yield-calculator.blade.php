<div class="row g-4 rental-yield-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Row 1: Property Val & Monthly Rent --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Property Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="prop-val" class="form-control form-control-lg border-start-0" value="450000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Monthly Rental Income</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="monthly-rent" class="form-control form-control-lg border-start-0" value="2200" step="50">
                        </div>
                    </div>

                    {{-- Row 2: Expenses (Advanced) --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Operating Expenses</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" id="annual-expenses" class="form-control form-control-lg border-start-0" value="4500" step="100">
                        </div>
                        <small class="text-muted">Includes taxes, insurance, and maintenance.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Vacancy Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="vacancy-rate" class="form-control form-control-lg border-end-0" value="5" max="100" min="0">
                            <span class="input-group-text bg-light border-start-0">%</span>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 yield-quick" data-v="350000" data-r="1800">🏠 Small Residential</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 yield-quick" data-v="850000" data-r="4500">🏢 Multi-Unit</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 yield-quick" data-v="1200000" data-r="7000">💎 Luxury Property</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.06);">
            <div class="output-hero">
                <span class="output-hero-label">NET RENTAL YIELD</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-net-yield">4.8</span>
                    <span class="output-hero-unit">%</span>
                </div>
                <div class="mt-2 text-muted fw-bold small" id="out-annual-profit">Annual Cash Flow: $21,600</div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#10b981; background: rgba(16,185,129,.02);">
                        <span class="stat-card-label">GROSS YIELD</span>
                        <span class="stat-card-value text-success" id="out-gross-yield">5.9%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6; background: rgba(59,130,246,.02);">
                        <span class="stat-card-label">EXPENSE RATIO</span>
                        <span class="stat-card-value text-primary" id="out-expense-ratio">17%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#f59e0b; background: rgba(245,158,11,.02);">
                        <span class="stat-card-label">GRM (MULTIPLIER)</span>
                        <span class="stat-card-value text-warning" id="out-grm">17.0</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-chart-line text-success me-2"></i>Investment Analysis
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="yield-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-success"></i>Copy Analysis Plan
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="yield-reset" style="min-width: 280px; max-width: 100%;">Reset Inputs</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="yield-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Forecast
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const propValE = $('prop-val'), monthlyRentE = $('monthly-rent'), 
          expensesE = $('annual-expenses'), vacancyE = $('vacancy-rate');

    function calculate(){
        let v = parseFloat(propValE.value) || 0;
        let r = parseFloat(monthlyRentE.value) || 0;
        let e = parseFloat(expensesE.value) || 0;
        let vac = parseFloat(vacancyE.value) || 0;

        if(v <= 0) return;

        // Gross Calculations
        const grossAnnual = r * 12;
        const grossYield = (grossAnnual / v) * 100;

        // Effective Income (adjusted for vacancy)
        const effectiveAnnual = grossAnnual * (1 - (vac / 100));
        
        // Net profit
        const netProfit = effectiveAnnual - e;
        const netYield = (netProfit / v) * 100;

        // Metrics
        const expenseRatio = grossAnnual > 0 ? (e / grossAnnual) * 100 : 0;
        const grm = grossAnnual > 0 ? v / grossAnnual : 0;

        // Update UI
        $('out-net-yield').textContent = netYield.toFixed(2);
        $('out-annual-profit').textContent = `Annual Cash Flow: $${Math.round(netProfit).toLocaleString()}`;
        $('out-gross-yield').textContent = grossYield.toFixed(2) + '%';
        $('out-expense-ratio').textContent = Math.round(expenseRatio) + '%';
        $('out-grm').textContent = grm.toFixed(1);

        // Insights
        const ins = [];
        if(netYield > 8) {
            ins.push('Excellent high-yield investment. This property generates significant positive cash flow.');
        } else if(netYield > 5) {
            ins.push('Strong performance. This yield is healthy for most residential markets.');
        } else {
            ins.push('Moderate yield. Focus on appreciation potential or look for expense optimizations.');
        }

        if(expenseRatio > 35) {
            ins.push('<strong>High Expense Warning</strong>: Costs are consuming over 35% of gross income. Review your management fees.');
        }
        
        if(vac > 10) {
            ins.push('High vacancy rate factored. Ensure this matches local market risk.');
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [propValE, monthlyRentE, expensesE, vacancyE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.yield-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            propValE.value = btn.dataset.v;
            monthlyRentE.value = btn.dataset.r;
            calculate();
        });
    });

    $('yield-reset').addEventListener('click', ()=>{
        propValE.value = 450000;
        monthlyRentE.value = 2200;
        expensesE.value = 4500;
        vacancyE.value = 5;
        calculate();
    });

    $('yield-copy-btn').addEventListener('click', function(){
        const text = `Property Investment Analysis\nNet Yield: ${$('out-net-yield').textContent}%\nAnnual Cash Flow: ${$('out-annual-profit').textContent}\nGross Yield: ${$('out-gross-yield').textContent}\nGenerated by ToolsHub ROI Engine`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Analysis Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.rental-yield-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(16,185,129,.05)}
.rental-yield-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.rental-yield-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.rental-yield-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.rental-yield-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.rental-yield-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
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
    .rental-yield-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; }
}
</style>
