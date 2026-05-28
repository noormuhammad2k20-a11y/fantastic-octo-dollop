<div class="row g-4 smoking-calc-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label-custom">Packs per Week</label>
                        <div class="input-group">
                            <input type="number" id="sm-packs" class="form-control form-control-lg rounded-start-3" value="7" min="0">
                            <span class="input-group-text rounded-end-3 bg-light text-muted fw-bold">Qty</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Price per Pack</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-3">$</span>
                            <input type="number" id="sm-price" class="form-control form-control-lg rounded-end-3" value="8.50" step="0.10">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Years of Usage</label>
                        <input type="number" id="sm-years" class="form-control form-control-lg rounded-3" value="5" min="0">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Investment Yield</label>
                        <select id="sm-yield" class="form-select form-select-lg rounded-3">
                            <option value="0.04">4% (Savings)</option>
                            <option value="0.07">7% (Conservative)</option>
                            <option value="0.10" selected>10% (Growth/S&P)</option>
                        </select>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Habit Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 sm-quick" data-p="3.5" data-pr="9.50">🛋️ Occasional (0.5/day)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 sm-quick" data-p="7" data-pr="11.00">🚬 Regular (1/day)</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 sm-quick" data-p="14" data-pr="12.50">⛓️ Heavy (2/day)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="sm-theme" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(71,85,105,.06);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL ACCUMULATED CAPITAL LOSS</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1">
                    <span class="output-hero-unit text-muted">$</span>
                    <span class="output-hero-value" id="out-sunk">15,470</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-spent-label" style="letter-spacing:1px;color:#475569;">Sunk Cost Calculation</div>
            </div>

            <div class="row g-3 mt-3 text-center">
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #ef4444; background: #fff;">
                        <span class="stat-card-label">ANNUAL EXPENSE</span>
                        <span class="stat-card-value text-danger" id="out-annual">$3,094</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #10b981; background: #fff;">
                        <span class="stat-card-label">OPPORTUNITY COST (10Y)</span>
                        <span class="stat-card-value text-success" id="out-opp">$48.2k</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 4px solid #3b82f6; background: #fff;">
                        <span class="stat-card-label">LOST WEALTH (25Y)</span>
                        <span class="stat-card-value text-primary" id="out-wealth">$240k</span>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1"><i class="fas fa-heartbeat text-danger me-2"></i>Physiological Recovery</h6>
                        <div id="sm-health" class="small text-secondary">
                            <div class="mb-2 pb-2 border-bottom d-flex justify-content-between"><span>20 Minutes</span><span class="fw-bold">BP Normalizes</span></div>
                            <div class="mb-2 pb-2 border-bottom d-flex justify-content-between"><span>1 Year</span><span class="fw-bold">Heart Risk -50%</span></div>
                            <div class="mb-2 pb-2 border-bottom d-flex justify-content-between"><span>5 Years</span><span class="fw-bold">Stroke Risk ↓</span></div>
                            <div class="d-flex justify-content-between"><span>15 Years</span><span class="fw-bold">Normal Risk Profile</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1"><i class="fas fa-wallet text-success me-2"></i>Purchasing Power Lost</h6>
                        <div id="sm-buy" class="small text-secondary fw-medium"></div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sm-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Impact Report
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sm-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Assessment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const packsE = $('sm-packs'), priceE = $('sm-price'), yearsE = $('sm-years'), yieldE = $('sm-yield');

    function calculate(){
        const pk = parseFloat(packsE.value) || 0;
        const pr = parseFloat(priceE.value) || 0;
        const yr = parseFloat(yearsE.value) || 0;
        const rate = parseFloat(yieldE.value);
        
        const yearly = pk * pr * 52;
        const totalSunk = yearly * yr;
        
        $('out-sunk').textContent = Math.round(totalSunk).toLocaleString();
        $('out-annual').textContent = '$' + Math.round(yearly).toLocaleString();
        $('out-spent-label').textContent = `Accumulated Cost Over ${yr} Years`;

        // FV = P * [ ((1 + r)^n - 1) / r ]
        const monthly = yearly / 12;
        const r_m = rate / 12;
        const fv10 = monthly * (Math.pow(1 + r_m, 120) - 1) / r_m;
        const fv25 = monthly * (Math.pow(1 + r_m, 300) - 1) / r_m;
        
        $('out-opp').textContent = '$' + (fv10 / 1000).toFixed(1) + 'k';
        $('out-wealth').textContent = '$' + (fv25 / 1000).toFixed(0) + 'k';

        // Power
        const auto = 35000 / yearly;
        const house = 80000 / yearly;
        $('sm-buy').innerHTML = `
            <div class="mb-3 d-flex align-items-center gap-3"><i class="fas fa-car-side fs-5 text-primary"></i><div><span class="d-block fw-bold text-dark">Luxury Sedan ($35k)</span>Every ${auto.toFixed(1)} years</div></div>
            <div class="d-flex align-items-center gap-3"><i class="fas fa-home fs-5 text-success"></i><div><span class="d-block fw-bold text-dark">House Deposit ($80k)</span>In ${house.toFixed(1)} years savings</div></div>
        `;
    }

    [packsE, priceE, yearsE, yieldE].forEach(el => el.addEventListener('input', calculate));

    document.querySelectorAll('.sm-quick').forEach(btn => {
        btn.onclick = () => {
            packsE.value = btn.dataset.p; priceE.value = btn.dataset.pr;
            calculate();
        };
    });

    $('sm-copy-btn').onclick = function(){
        const text = `Smoking Financial Impact Report\nTotal Sunk Cost: $${$('out-sunk').textContent}\nAnnual Loss: ${$('out-annual').textContent}\nFuture Value Lost (25Y): ${$('out-wealth').textContent}\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Report Copied!';
            setTimeout(()=>this.innerHTML=o,2000);
        });
    };

    calculate();
});
</script>

<style>
.smoking-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(71,85,105,.05)}
.smoking-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.smoking-calc-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.smoking-calc-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.smoking-calc-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.smoking-calc-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:2rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.output-hero-value{font-size:4.5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-3px}
.output-hero-unit{font-size:2rem;color:#64748b;font-weight:700;margin-right:4px;vertical-align:middle}
.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card-label{display:block;font-size:.65rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:8px}
.stat-card-value{font-size:1.6rem;font-weight:800;display:block;line-height:1.2}
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 768px) {
    .smoking-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 3rem; }
}
</style>
