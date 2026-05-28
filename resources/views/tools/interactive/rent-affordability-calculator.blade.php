<div class="row g-4 rent-affordability-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-cyan">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Income & Debt --}}
                    <div class="col-md-6 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-cyan small"><i class="fas fa-hand-holding-usd me-2"></i>Income & Obligations</h6>
                        
                        <label class="form-label-custom">Gross Annual Income</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="ra-income" class="form-control form-control-lg border-start-0 ps-0 fw-bold" value="85000" step="1000">
                        </div>

                        <label class="form-label-custom tooltip-label" title="Your estimated Take-Home Pay after taxes and standard deductions. Usually 70-80% of Gross.">Estimated Monthly Net (Take-Home)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-money-check-alt"></i></span>
                            <input type="number" id="ra-net" class="form-control border-start-0 ps-0 text-dark fw-bold bg-light" value="5300" step="100">
                        </div>

                        <label class="form-label-custom tooltip-label" title="Student loans, credit cards, auto loans.">Total Monthly Debt Payments</label>
                        <div class="input-group">
                            <span class="input-group-text bg-soft-red border-end-0 text-danger"><i class="fas fa-minus"></i></span>
                            <input type="number" id="ra-debt" class="form-control border-start-0 ps-0 text-danger fw-bold bg-soft-red" value="600" step="50">
                        </div>
                    </div>

                    {{-- Lifestyle & Savings --}}
                    <div class="col-md-6 ps-md-4 mt-5 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-purple small"><i class="fas fa-cocktail me-2"></i>Lifestyle & Future Goals</h6>
                        
                        <label class="form-label-custom tooltip-label" title="Groceries, gas, streaming, fun money, restaurants.">Monthly Lifestyle Target ($)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-shopping-cart"></i></span>
                            <input type="number" id="ra-life" class="form-control form-control-lg border-start-0 ps-0 text-purple fw-bold bg-purple-soft" value="1200" step="50">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-12">
                                <label class="form-label-custom tooltip-label" title="Percentage of your gross income you want to invest/save each month.">Target Savings Goal (%)</label>
                                <div class="input-group">
                                    <input type="number" id="ra-save-pct" class="form-control form-control-lg border-end-0 fw-bold" value="15" step="1">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-cyan me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ra-quick" data-p="1">Frugal Saver (Aggressive Savings)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ra-quick" data-p="2">High Debt Graduate</button>
                    <div class="flex-grow-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#06b6d4;--tool-bg:#ecfeff;">
            
            <div class="row align-items-center mb-5">
                <div class="col-md-7 text-center text-md-start">
                    <span class="output-hero-label text-cyan mb-1">YOUR IDEAL BUDGET</span>
                    <h2 class="display-3 fw-black text-dark m-0 pb-1" id="out-target-rent">$0</h2>
                    <p class="text-muted fw-bold mb-0">Monthly Rent that fits your lifestyle & savings goals.</p>
                </div>
                <div class="col-md-5 mt-4 mt-md-0 d-flex justify-content-center justify-content-md-end">
                    <div class="approval-card bg-white p-3 border shadow-sm rounded-4 text-center" style="border-left: 5px solid #0f766e !important;">
                        <span class="stat-card-label text-teal">LANDLORD CHECK (40X RULE)</span>
                        <div class="fs-3 fw-black text-dark" id="out-40x-max">$0</div>
                        <div class="small fw-bold text-muted mt-1">Maximum Approval Limit</div>
                    </div>
                </div>
            </div>

            {{-- The Tri-Tier Matrix --}}
            <div class="row g-4 mb-4">
                {{-- Frugal --}}
                <div class="col-md-4">
                    <div class="tier-card border-green-top">
                        <div class="text-center mb-3">
                            <span class="fw-bold text-muted small letter-spacing-1 text-uppercase">Conservative</span>
                            <div class="fs-2 fw-black text-green mt-1" id="out-tier-frugal">$0</div>
                            <div class="small text-muted fw-bold">~25% Target</div>
                        </div>
                        <ul class="tier-list text-muted small">
                            <li><i class="fas fa-check text-green me-2"></i>Maximized Savings</li>
                            <li><i class="fas fa-check text-green me-2"></i>Zero financial stress</li>
                            <li><i class="fas fa-check text-green me-2"></i>Heavy debt paydown</li>
                        </ul>
                    </div>
                </div>

                {{-- Standard --}}
                <div class="col-md-4">
                    <div class="tier-card border-cyan-top bg-cyan-soft shadow-sm">
                        <div class="text-center mb-3">
                            <span class="fw-bold text-cyan small letter-spacing-1 text-uppercase">The 30% Rule</span>
                            <div class="fs-1 fw-black text-dark mt-1" id="out-tier-standard">$0</div>
                            <div class="small text-muted fw-bold">Standard Recommendation</div>
                        </div>
                        <ul class="tier-list text-dark fw-bold small">
                            <li><i class="fas fa-check text-cyan me-2"></i>Balanced lifestyle</li>
                            <li><i class="fas fa-check text-cyan me-2"></i>Fits average apartments</li>
                            <li><i class="fas fa-check text-cyan me-2"></i>Standard approvals</li>
                        </ul>
                    </div>
                </div>

                {{-- Stressed Max --}}
                <div class="col-md-4">
                    <div class="tier-card border-red-top">
                        <div class="text-center mb-3">
                            <span class="fw-bold text-danger small letter-spacing-1 text-uppercase">Stressed Max (40%)</span>
                            <div class="fs-2 fw-black text-danger mt-1" id="out-tier-stressed">$0</div>
                            <div class="small text-muted fw-bold">House Poor Zone</div>
                        </div>
                        <ul class="tier-list text-muted small">
                            <li><i class="fas fa-times text-danger me-2"></i>Zero savings buffer</li>
                            <li><i class="fas fa-times text-danger me-2"></i>One emergency from broke</li>
                            <li><i class="fas fa-times text-danger me-2"></i>May require guarantors</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- The Lifestyle Squeeze --}}
            <div class="p-4 bg-white rounded-4 border shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="fw-bold text-purple mb-2 d-flex align-items-center"><i class="fas fa-lemon me-2"></i> The "Lifestyle Squeeze" Test</h6>
                        <p class="small text-muted mb-0">If you try to rent the Stressed Max apartment (<strong><span id="squeeze-rent"></span></strong>) while hitting your savings goal and servicing your debt, you will only have <strong class="text-danger" id="squeeze-left"></strong> left per month for food, gas, bills, and fun.</p>
                    </div>
                    <div class="col-md-4 text-center mt-3 mt-md-0 border-start-md px-3">
                        <span class="stat-card-label">YOUR STATED LIFESTYLE COST</span>
                        <div class="fs-3 fw-bold text-dark mt-1" id="squeeze-target">$0</div>
                        <div class="badge mt-2" id="squeeze-status">Result</div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ra-copy">
                        <i class="fas fa-copy me-2 text-cyan"></i>Copy Budget Sheet
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="ra-reset">Reset Stats</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Guidelines
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const fmtC = val => new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD', maximumFractionDigits: 0}).format(val);

    const els = {
        gross: $('ra-income'), net: $('ra-net'), debt: $('ra-debt'),
        life: $('ra-life'), savePct: $('ra-save-pct')
    };

    function calculate() {
        const grossA = parseFloat(els.gross.value) || 0;
        const netMo = parseFloat(els.net.value) || 0;
        const debtMo = parseFloat(els.debt.value) || 0;
        const lifeMo = parseFloat(els.life.value) || 0;
        const savePct = parseFloat(els.savePct.value) || 0;

        const grossMo = grossA / 12;

        // 40x Rule (Landlord limit: Annual Gross / 40 == Monthly Gross / 3.33)
        const landlordMax = grossA > 0 ? (grossA / 40) : 0;
        $('out-40x-max').textContent = fmtC(landlordMax);

        // Standard Rules of Thumb (Based on GROSS, but we will test it against NET via the Squeeze)
        const frugal = grossMo * 0.25;
        const standard = grossMo * 0.30;
        const stressed = grossMo * 0.40;

        $('out-tier-frugal').textContent = fmtC(frugal);
        $('out-tier-standard').textContent = fmtC(standard);
        $('out-tier-stressed').textContent = fmtC(stressed);

        // Calculate IDEAL Budget purely backwards from Take-Home Pay (Net)
        // Net Income - Debt - Savings Goal - Lifestyle = Ideal Rent
        const savingsReq = grossMo * (savePct / 100);
        let idealRent = netMo - debtMo - savingsReq - lifeMo;
        if(idealRent < 0) idealRent = 0;
        
        $('out-target-rent').textContent = fmtC(idealRent);

        // The Squeeze Calculation (If they hit the 40% Stressed Mark)
        const squeezeRent = stressed;
        const moneyLeftForLife = netMo - debtMo - savingsReq - squeezeRent;

        $('squeeze-rent').textContent = fmtC(squeezeRent);
        $('squeeze-target').textContent = fmtC(lifeMo);
        
        const sqLeft = $('squeeze-left');
        const sqStat = $('squeeze-status');

        sqLeft.textContent = fmtC(moneyLeftForLife);
        
        if (moneyLeftForLife < 0) {
            sqLeft.className = "text-danger text-decoration-underline fw-black";
            sqStat.className = "badge bg-danger";
            sqStat.textContent = "Math Impossible (Debt Spiral)";
        } else if (moneyLeftForLife < lifeMo) {
            sqLeft.className = "text-warning text-decoration-underline fw-black";
            sqStat.className = "badge bg-warning text-dark";
            sqStat.textContent = "Requires Lifestyle Cuts";
        } else {
            sqLeft.className = "text-success text-decoration-underline fw-black";
            sqStat.className = "badge bg-success";
            sqStat.textContent = "Perfectly Affordable";
        }

    }

    // Auto calculate net pay as 75% of gross if user changes gross directly and leaves net alone
    els.gross.addEventListener('blur', function() {
        const grossA = parseFloat(this.value) || 0;
        els.net.value = Math.round((grossA * 0.75) / 12);
        calculate();
    });

    // Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculate));
    
    document.querySelectorAll('.ra-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === '1') { // Frugal Saver
                els.gross.value = 95000; els.net.value = 5900; els.debt.value = 200; els.life.value = 1000; els.savePct.value = 25;
            } else if (p === '2') { // High Debt
                els.gross.value = 65000; els.net.value = 4000; els.debt.value = 850; els.life.value = 1400; els.savePct.value = 5;
            }
            calculate();
        });
    });
    
    $('ra-reset').addEventListener('click', () => {
        els.gross.value = 85000; els.net.value = 5300; els.debt.value = 600; els.life.value = 1200; els.savePct.value = 15;
        calculate();
    });

    $('ra-copy').addEventListener('click', function(){
        const text = `Rent Affordability Specs:\nIdeal Custom Budget: ${$('out-target-rent').textContent}\nLandlord 40x Approval Max: ${$('out-40x-max').textContent}\nStandard 30% Rule: ${$('out-tier-standard').textContent}\nStressed House-Poor Max: ${$('out-tier-stressed').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.rent-affordability-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(6,182,212,.05)}
.rent-affordability-rebuilt .border-cyan { border-top: 4px solid #06b6d4 !important; }
.rent-affordability-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.rent-affordability-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.rent-affordability-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.rent-affordability-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.rent-affordability-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-cyan { color: #0891b2 !important; }
.bg-cyan-soft { background-color: #ecfeff !important; }

.text-purple { color: #9333ea !important; }
.bg-purple-soft { background-color: #faf5ff !important; }
.text-teal { color: #0d9488 !important; }

.bg-soft-red { background-color: #fef2f2 !important; }

.border-end-md { border-right: 1px dashed #e2e8f0; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}
.stat-card-label {font-size:.65rem;font-weight:900;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:4px; display:block;}

.tier-card { background: #fff; border-radius: 16px; padding: 1.5rem; border: 1px solid #e2e8f0; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,.02); }
.border-green-top { border-top: 4px solid #10b981; }
.border-cyan-top { border-top: 4px solid #06b6d4; }
.border-red-top { border-top: 4px solid #ef4444; }
.text-green { color: #10b981 !important; }

.tier-list { list-style: none; padding-left: 0; margin-top: 1.5rem; margin-bottom: 0; }
.tier-list li { margin-bottom: 8px; }

.border-start-md { border-left: 1px dashed #e2e8f0; }

@media (max-width: 768px) {
    .border-end-md { border-right: none; border-bottom: 1px dashed #e2e8f0; padding-bottom: 2rem; }
    .ps-md-4 { padding-left: 0 !important; }
    .pe-md-4 { padding-right: 0 !important; }
    .scale-up { transform: scale(1); }
    .border-start-md { border-left: none; border-top: 1px dashed #e2e8f0; padding-top: 1rem;}
}
@media print {
    .print-hide { display: none !important; }
    .output-card-themed { border: 1px solid #000; box-shadow: none; background: #fff !important; }
}
</style>

