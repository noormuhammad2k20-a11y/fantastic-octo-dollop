<div class="row g-4 cashflow-stress-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-orange">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- Standard Operations --}}
                    <div class="col-md-5 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-clipboard-list me-2"></i>Normal Operations (Baseline)</h6>
                        
                        <label class="form-label-custom">Current Monthly Rent</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="cs-rent" class="form-control form-control-lg border-start-0 ps-0 fw-bold" value="2500" step="50">
                        </div>

                        <label class="form-label-custom tooltip-label" title="Taxes, Insurance, HOA, Standard Maintenance factored monthly.">Monthly Operating Expenses (OpEx)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-minus"></i></span>
                            <input type="number" id="cs-opex" class="form-control border-start-0 ps-0" value="650" step="25">
                        </div>

                        <label class="form-label-custom">Mortgage Payment (P&I only)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-university"></i></span>
                            <input type="number" id="cs-mortgage" class="form-control border-start-0 ps-0 text-slate fw-bold" value="1400" step="50">
                        </div>

                        <label class="form-label-custom tooltip-label" title="How much liquid cash you have sitting in a bank account right now dedicated to this property.">Emergency Cash Reserves</label>
                        <div class="input-group">
                            <span class="input-group-text bg-soft-green border-end-0 text-success"><i class="fas fa-piggy-bank"></i></span>
                            <input type="number" id="cs-reserves" class="form-control border-start-0 ps-0 text-success fw-bold bg-soft-green" value="15000" step="500">
                        </div>
                    </div>

                    {{-- The Disaster Sandbox --}}
                    <div class="col-md-7 ps-md-4 mt-5 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-orange small"><i class="fas fa-radiation me-2"></i>The Disaster Sandbox (Next 12 Months)</h6>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label class="form-label-custom tooltip-label" title="Tenant leaves and it takes extremely long to find a new one.">Extended Vacancy (Months)</label>
                                <select id="cs-vac-months" class="form-select border-orange fw-bold">
                                    <option value="0">0 Months (Fully Occupied)</option>
                                    <option value="1">1 Month</option>
                                    <option value="3" selected>3 Months (Severe)</option>
                                    <option value="6">6 Months (Eviction/Squatter)</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label-custom tooltip-label" title="Local market crashes and you must lower rent to attract tenants.">Rent Price Drop (%)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-arrow-down"></i></span>
                                    <input type="number" id="cs-rent-drop" class="form-control border-start-0 ps-0 text-danger border-orange" value="10" step="5" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label class="form-label-custom tooltip-label" title="A new roof, busted HVAC, or major plumbing leak.">Unexpected Capex Bill ($)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-wrench"></i></span>
                                    <input type="number" id="cs-capex" class="form-control border-start-0 ps-0 text-danger border-orange fw-bold" value="8000" step="500">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label-custom">Property Tax/Insurance Hike (%)</label>
                                <div class="input-group">
                                    <input type="number" id="cs-opex-hike" class="form-control border-end-0 border-orange text-danger" value="15" step="5">
                                    <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-soft-orange border-orange mt-2 mb-0 p-3 small rounded-3">
                            <i class="fas fa-info-circle me-2"></i> This scenario forces these disasters to happen <strong>simultaneously</strong> across the next 12 months to see if your cash breaks.
                        </div>

                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-orange me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cs-quick" data-p="1">Eviction Nightmare (6 Mo + Damage)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cs-quick" data-p="2">Local Recession (Rent Drop + Hike)</button>
                    <div class="flex-grow-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#ea580c;--tool-bg:#fff7ed;">
            
            <div class="row mb-5 align-items-center">
                {{-- Survival Metric --}}
                <div class="col-md-7">
                    <span class="output-hero-label text-orange">RESERVE DEPLETION TIMELINE</span>
                    <h1 class="display-3 fw-black text-dark m-0 pb-1" id="out-survival">Safe</h1>
                    <p class="text-muted fw-bold pb-2" id="out-survival-sub">Your reserves will cover this disaster.</p>
                </div>
                {{-- DSCR Badge --}}
                <div class="col-md-5 d-flex justify-content-md-end justify-content-start">
                    <div class="payment-box" style="min-width:200px;">
                        <span class="stat-card-label" id="lbl-dscr">STRESSED DSCR</span>
                        <div class="fs-2 fw-black text-dark" id="out-dscr">0.0x</div>
                        <div class="small fw-bold mt-1 text-muted" id="out-dscr-desc">Safe (Above 1.2x)</div>
                    </div>
                </div>
            </div>

            {{-- Dual Cashflow Cards --}}
            <div class="row g-4">
                {{-- Baseline --}}
                <div class="col-md-6">
                    <div class="stat-card border-slate-left">
                        <span class="stat-card-label text-slate">BASELINE (NORMAL YR)</span>
                        <div class="fs-1 fw-black text-dark mt-2 mb-3" id="out-base-cf">$0</div>
                        
                        <div class="d-flex justify-content-between small text-muted mb-1 border-bottom pb-1">
                            <span>Annual Gross Rent (12 mo):</span> <span class="fw-bold" id="b-rent">$0</span>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mb-1 pb-1">
                            <span>- Annual OpEx:</span> <span class="fw-bold" id="b-opex">-$0</span>
                        </div>
                        <div class="d-flex justify-content-between small text-muted pb-1 border-bottom">
                            <span>- Annual Mortgage:</span> <span class="fw-bold" id="b-mort">-$0</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2 small text-muted fst-italic">
                            <span>End of Year Cashflow:</span> <span class="text-dark fw-bold" id="b-net">+$0</span>
                        </div>
                    </div>
                </div>

                {{-- Stressed --}}
                <div class="col-md-6">
                    <div class="stat-card border-orange-left bg-soft-orange">
                        <span class="stat-card-label text-orange"><i class="fas fa-fire me-1"></i> STRESSED (DISASTER YR)</span>
                        <div class="fs-1 fw-black text-danger mt-2 mb-3" id="out-stress-cf">-$0</div>
                        
                        <div class="d-flex justify-content-between small text-danger mb-1 border-bottom pb-1 border-danger-subtle">
                            <span>Stressed Rent (<span id="lbl-s-vac"></span> mo vac):</span> <span class="fw-bold" id="s-rent">$0</span>
                        </div>
                        <div class="d-flex justify-content-between small text-danger mb-1 pb-1">
                            <span>- Inflated OpEx:</span> <span class="fw-bold" id="s-opex">-$0</span>
                        </div>
                        <div class="d-flex justify-content-between small text-danger mb-1 pb-1 border-bottom border-danger-subtle">
                            <span>- Annual Mortgage:</span> <span class="fw-bold" id="s-mort">-$0</span>
                        </div>
                        <div class="d-flex justify-content-between small text-danger mb-1 pb-1 border-bottom border-danger-subtle bg-white px-2 py-1 rounded">
                            <span class="fw-bold text-dark">Surprise Capex Hit:</span> <span class="fw-bold" id="s-capex">-$0</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2 small text-danger fw-bold">
                            <span>End of Year Cash Bleed:</span> <span id="s-net">-$0</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Insight Bar --}}
            <div class="mt-4 print-hide">
                <div class="alert border d-flex align-items-start gap-3 mb-0" id="tip-container">
                    <i class="fas fa-shield-alt fs-4 mt-1" id="tip-icon"></i>
                    <div>
                        <h6 class="fw-bold mb-1" id="tip-title">Capital Analysis</h6>
                        <p class="mb-0 small" id="out-tip">Calculating insights...</p>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cs-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-warning"></i>Copy Stress Report
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="cs-reset" style="min-width: 280px; max-width: 100%;">Reset Scenarios</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Survival Plan
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
        rent: $('cs-rent'), opex: $('cs-opex'), mort: $('cs-mortgage'), reserves: $('cs-reserves'),
        vac: $('cs-vac-months'), rentDrop: $('cs-rent-drop'),
        capex: $('cs-capex'), opexHike: $('cs-opex-hike')
    };

    function calculate() {
        // Baseline
        const rent = parseFloat(els.rent.value) || 0;
        const opex = parseFloat(els.opex.value) || 0;
        const mort = parseFloat(els.mort.value) || 0;
        const reserves = parseFloat(els.reserves.value) || 0;

        const baseGross = rent * 12;
        const baseOpex = opex * 12;
        const baseMort = mort * 12;
        const baseNet = baseGross - baseOpex - baseMort;

        // Stressed
        const vacMos = parseFloat(els.vac.value) || 0;
        const rentDrop = parseFloat(els.rentDrop.value) || 0;
        const capex = parseFloat(els.capex.value) || 0;
        const opexHike = parseFloat(els.opexHike.value) || 0;

        const workingRent = rent * (1 - (rentDrop/100)); // The new lowered rent per month
        const stressGross = workingRent * (12 - vacMos); // Only collect rent on non-vacant months

        const stressOpex = baseOpex * (1 + (opexHike/100));
        
        // Stressed Cashflow over 12 months INCLUDES the capex hit
        const stressNet = stressGross - stressOpex - baseMort - capex;

        // DSCR (Debt Service Coverage Ratio)
        // NOI / Debt Service
        const baseNOI = baseGross - baseOpex;
        const baseDSCR = baseMort > 0 ? (baseNOI / baseMort) : 0;
        
        const stressNOI = stressGross - stressOpex; // Ignore capex for pure DSCR usually, but NOI shrinks
        const stressDSCR = baseMort > 0 ? (stressNOI / baseMort) : 0;

        // Output Baseline
        $('b-rent').textContent = fmtC(baseGross);
        $('b-opex').textContent = '-'+fmtC(baseOpex);
        $('b-mort').textContent = '-'+fmtC(baseMort);
        $('b-net').textContent = (baseNet > 0 ? '+' : '') + fmtC(baseNet);
        $('b-net').className = baseNet >= 0 ? "text-success fw-bold" : "text-danger fw-bold";
        $('out-base-cf').textContent = fmtC(baseNet) + '/yr';

        // Output Stressed
        $('lbl-s-vac').textContent = vacMos;
        $('s-rent').textContent = fmtC(stressGross);
        $('s-opex').textContent = '-'+fmtC(stressOpex);
        $('s-mort').textContent = '-'+fmtC(baseMort);
        $('s-capex').textContent = '-'+fmtC(capex);
        $('s-net').textContent = fmtC(stressNet);
        $('out-stress-cf').textContent = fmtC(stressNet) + '/yr';
        $('out-stress-cf').className = stressNet >= 0 ? "fs-1 fw-black text-success mt-2 mb-3" : "fs-1 fw-black text-danger mt-2 mb-3";

        // DSCR
        $('out-dscr').textContent = stressDSCR.toFixed(2) + 'x';
        if (stressDSCR < 1.0) {
            $('out-dscr').className = 'fs-2 fw-black text-danger';
            $('out-dscr-desc').textContent = 'Failing (Properties lose money)';
            $('lbl-dscr').className = 'stat-card-label text-danger';
        } else if (stressDSCR < 1.25) {
            $('out-dscr').className = 'fs-2 fw-black text-orange';
            $('out-dscr-desc').textContent = 'Risky (Razor thin margins)';
            $('lbl-dscr').className = 'stat-card-label text-orange';
        } else {
            $('out-dscr').className = 'fs-2 fw-black text-success';
            $('out-dscr-desc').textContent = 'Safe (Cashflow covers debt)';
            $('lbl-dscr').className = 'stat-card-label';
        }

        // Survival / Bleed Timeline
        let survivalHero = $('out-survival');
        let survivalSub = $('out-survival-sub');
        let tipCon = $('tip-container');
        let tipIcon = $('tip-icon');
        let tipTitle = $('tip-title');
        let tipText = $('out-tip');

        if (stressNet >= 0) {
            survivalHero.textContent = "SAFE";
            survivalHero.className = "display-3 fw-black text-success m-0 pb-1";
            survivalSub.textContent = "Property survives without tapping reserves.";
            
            tipCon.className = "alert alert-soft-success border-success d-flex align-items-start gap-3 mb-0";
            tipIcon.className = "fas fa-shield-check fs-4 mt-1 text-success";
            tipTitle.className = "fw-bold mb-1 text-success";
            tipText.innerHTML = `Your property is incredibly resilient. Even after applying terrible market conditions and a ${fmtC(capex)} capex bill, it still cashflows positively without needing emergency cash.`;
        } else {
            // It's bleeding money. How long until reserves $0?
            // The capex hit is immediate.
            const remainingReservesAfterCapex = reserves - capex;
            
            if (remainingReservesAfterCapex < 0) {
                // Instantly bankrupt
                survivalHero.textContent = "IMMEDIATE BANKRUPTCY";
                survivalHero.className = "display-5 fw-black text-danger m-0 pb-1 pt-2";
                survivalSub.textContent = "Reserves cannot even cover the Capex bill.";
                
                tipCon.className = "alert alert-soft-danger border-danger d-flex align-items-start gap-3 mb-0";
                tipIcon.className = "fas fa-skull-crossbones fs-4 mt-1 text-danger";
                tipTitle.className = "fw-bold mb-1 text-danger";
                tipText.innerHTML = `You are highly vulnerable. A ${fmtC(capex)} repair bill immediately wipes out your ${fmtC(reserves)} reserves, forcing you to use personal credit cards or sell at a loss at a time when rent is dropping. Calculate your Capex exposure and bolster reserves.`;
            } else {
                // It survives Capex, but bleeds monthly.
                const monthlyBleed = (stressGross - stressOpex - baseMort) / 12; 
                // Wait, if monthlyBleed is POSITIVE, it eventually heals, but over 1 year it was negative total.
                // Let's assume the bleed is consistent
                
                if (monthlyBleed >= 0) {
                     survivalHero.textContent = "Reserves Dented";
                     survivalHero.className = "display-3 fw-black text-orange m-0 pb-1";
                     survivalSub.textContent = "Capex hurts, but operations stay positive.";
                     
                     tipCon.className = "alert alert-soft-orange border-orange d-flex align-items-start gap-3 mb-0";
                     tipIcon.className = "fas fa-exclamation-triangle fs-4 mt-1 text-orange";
                     tipTitle.className = "fw-bold mb-1 text-orange";
                     tipText.innerHTML = `The repair bill wiped away a chunk of cash, but your monthly operations (DSCR ${stressDSCR.toFixed(2)}) remain strong enough to prevent a total death spiral.`;
                } else {
                    const monthsToDeath = remainingReservesAfterCapex / Math.abs(monthlyBleed);
                    survivalHero.textContent = monthsToDeath.toFixed(1) + " MONTHS";
                    survivalHero.className = "display-3 fw-black text-danger m-0 pb-1";
                    survivalSub.textContent = `Until ${fmtC(reserves)} cash hits exactly $0.`;
                    
                    tipCon.className = "alert alert-soft-danger border-danger d-flex align-items-start gap-3 mb-0";
                    tipIcon.className = "fas fa-hourglass-end fs-4 mt-1 text-danger";
                    tipTitle.className = "fw-bold mb-1 text-danger";
                    tipText.innerHTML = `This disaster setup destroys your cashflow. After paying the ${fmtC(capex)} capex hit, you will bleed ${fmtC(Math.abs(monthlyBleed))}/mo. You have exactly <strong>${monthsToDeath.toFixed(1)} months</strong> to fix the vacancy/rent before you face foreclosure or must inject external personal cash.`;
                }
            }
        }
    }

    // Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculate));
    
    document.querySelectorAll('.cs-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === '1') { // Eviction Nightmare
                els.vac.value = 6; els.rentDrop.value = 0; els.capex.value = 12000; els.opexHike.value = 0;
            } else if (p === '2') { // Recession
                els.vac.value = 2; els.rentDrop.value = 15; els.capex.value = 0; els.opexHike.value = 20;
            }
            calculate();
        });
    });
    
    $('cs-reset').addEventListener('click', () => {
        els.rent.value = 2500; els.opex.value = 650; els.mort.value = 1400; els.reserves.value = 15000;
        els.vac.value = 3; els.rentDrop.value = 10; els.capex.value = 8000; els.opexHike.value = 15;
        calculate();
    });

    $('cs-copy').addEventListener('click', function(){
        const text = `Cashflow Stress Test:\nReserves: ${fmtC(els.reserves.value)}\nBaseline Cashflow: ${$('out-base-cf').textContent}\nStressed Cashflow: ${$('out-stress-cf').textContent}\nTimeline to Bankrupt: ${$('out-survival').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.cashflow-stress-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(234,88,12,.05)}
.cashflow-stress-rebuilt .border-orange { border-top: 4px solid #ea580c !important; }
.cashflow-stress-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.cashflow-stress-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.cashflow-stress-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.cashflow-stress-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.cashflow-stress-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.text-orange { color: #ea580c !important; }
.bg-soft-orange { background-color: #fff7ed !important; }
.border-orange { border-color: #fdba74 !important; }

.text-slate { color: #475569 !important; }
.bg-soft-green { background-color: #f0fdf4 !important; }

.border-end-md { border-right: 1px dashed #e2e8f0; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}

.payment-box { background:#fff; border: 2px solid #e5e7eb; border-radius: 16px; padding: 1.5rem; text-align: left; }
.stat-card-label {font-size:.7rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:4px; display:block;}

.stat-card { background: #fff; border-radius: 16px; padding: 1.5rem; border: 1px solid #e2e8f0; height: 100%; box-shadow: 0 4px 12px rgba(0,0,0,.02); }
.border-slate-left { border-left: 6px solid #475569; }
.border-orange-left { border-left: 6px solid #ea580c; border: 1px solid #fed7aa; }

.alert-soft-orange { background-color: #fff7ed; color: #9a3412; }
.alert-soft-success { background-color: #f0fdf4; color: #166534; }
.alert-soft-danger { background-color: #fef2f2; color: #991b1b; }

@media (max-width: 768px) {
    .border-end-md { border-right: none; border-bottom: 1px dashed #e2e8f0; padding-bottom: 2rem; }
    .ps-md-4 { padding-left: 0 !important; }
    .pe-md-4 { padding-right: 0 !important; }
}
@media print {
    .print-hide { display: none !important; }
    .output-card-themed { border: 1px solid #000; box-shadow: none; background: #fff !important; }
}
</style>

