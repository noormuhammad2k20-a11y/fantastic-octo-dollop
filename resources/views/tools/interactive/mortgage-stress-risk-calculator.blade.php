<div class="row g-4 mortgage-stress-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4">
                    {{-- Current Situation --}}
                    <div class="col-12 mb-1">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-home text-danger me-2"></i>Current Property Baseline</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Current Property Value</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="msr-value" class="form-control form-control-lg border-start-0 ps-0" value="450000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Remaining Loan Balance</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="msr-loan" class="form-control form-control-lg border-start-0 ps-0" value="380000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom" title="Principal, Interest, Taxes, Insurance">Total Monthly Payment</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="msr-payment" class="form-control form-control-lg border-start-0 ps-0" value="2800" step="100">
                        </div>
                    </div>

                    {{-- Financials --}}
                    <div class="col-md-6 mt-3">
                        <label class="form-label-custom">Current Mo. Take-Home Income</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="msr-income" class="form-control form-control-lg border-start-0 ps-0" value="9000" step="100">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="form-label-custom">Emergency Fund Savings</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="msr-savings" class="form-control form-control-lg border-start-0 ps-0" value="15000" step="1000">
                        </div>
                    </div>

                    {{-- Disaster Sandbox --}}
                    <div class="col-12 mb-1 mt-4">
                        <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 text-muted small"><i class="fas fa-bolt text-danger me-2"></i>Stress Simulation Adjusters</h6>
                        <hr class="mt-2 mb-0 opacity-10">
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom text-danger">Property Value Crash (%)</label>
                        <div class="input-group">
                            <input type="number" id="msr-drop-val" class="form-control form-control-lg border-end-0 bg-soft-red fw-bold text-danger" value="20" step="1" min="0" max="100">
                            <span class="input-group-text bg-soft-red border-start-0 text-danger">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-danger">Income Drop / Pay Cut (%)</label>
                        <div class="input-group">
                            <input type="number" id="msr-drop-inc" class="form-control form-control-lg border-end-0 bg-soft-red fw-bold text-danger" value="15" step="1" min="0" max="100">
                            <span class="input-group-text bg-soft-red border-start-0 text-danger">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom text-danger">Payment Spike (ARM Reset/Taxes)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-soft-red border-end-0 text-danger">+</span>
                            <input type="number" id="msr-spike-pay" class="form-control form-control-lg border-start-0 ps-0 bg-soft-red fw-bold text-danger" value="0" step="100">
                            <span class="input-group-text bg-soft-red border-start-0 text-danger">$/mo</span>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-biohazard text-danger me-1"></i>Scenarios:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 msr-quick" data-v="20" data-i="0" data-p="0">Housing Correction</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 msr-quick" data-v="10" data-i="100" data-p="0">Complete Job Loss</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 msr-quick" data-v="40" data-i="30" data-p="500">2008 Repeat (Severe)</button>
                    <div class="flex-grow-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#dc2626;--tool-bg:#fef2f2;">
            <div class="row align-items-center mb-4">
                <div class="col-md-7 text-center text-md-start">
                    <span class="output-hero-label text-danger">MORTGAGE RISK STATUS</span>
                    <h2 class="output-hero-value m-0" id="out-status-text">CALCULATING</h2>
                    <p class="text-muted small mt-2 fw-bold mb-0">Based on your simulated stress scenario parameters.</p>
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <div class="payment-box">
                        <span class="stat-card-label">EMERGENCY RUNWAY</span>
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <span class="fs-2 fw-black" id="out-runway-months" style="color: #dc2626">0</span><span class="text-muted fw-bold ms-2 pb-1">Months</span>
                        </div>
                        <div class="small text-secondary fw-bold mt-1" id="out-runway-desc">Time before savings hits $0</div>
                    </div>
                </div>
            </div>

            {{-- 2x2 Matrix --}}
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">SITUATION 1: HOUSING EQUITY</span>
                        <div class="d-flex flex-column mb-2">
                            <div class="d-flex justify-content-between text-muted small"><span class="fw-bold">Current:</span> <span id="out-eq-cur"></span></div>
                            <div class="d-flex justify-content-between text-muted small"><span class="fw-bold">Stressed:</span> <span id="out-eq-str" class="fw-bold"></span></div>
                        </div>
                        <div class="progress mt-2" style="height:12px; border-radius:6px; background:#f1f5f9;">
                            <div id="bar-equity" class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                        <div class="small fw-bold mt-2" id="msg-equity"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <span class="stat-card-label">SITUATION 2: PAYMENT RATIO</span>
                        <div class="d-flex flex-column mb-2">
                            <div class="d-flex justify-content-between text-muted small"><span class="fw-bold">Current:</span> <span id="out-pr-cur"></span></div>
                            <div class="d-flex justify-content-between text-muted small"><span class="fw-bold">Stressed:</span> <span id="out-pr-str" class="fw-bold"></span></div>
                        </div>
                        <div class="progress mt-2" style="height:12px; border-radius:6px; background:#f1f5f9;">
                            <div id="bar-payment" class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                        <div class="small fw-bold mt-2" id="msg-payment"></div>
                    </div>
                </div>
            </div>

            {{-- Pro Tip Alert --}}
            <div class="mt-4 print-hide">
                <div class="alert alert-soft-danger border-danger d-flex align-items-start gap-3 mb-0" id="tip-container">
                    <i id="tip-icon" class="fas fa-exclamation-triangle fs-4 mt-1 text-danger"></i>
                    <div>
                        <h6 class="fw-bold mb-1" id="tip-title">Risk Assessment</h6>
                        <p class="mb-0 small" id="out-tip">Calculating insights...</p>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="msr-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Stress Report
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="msr-reset" style="min-width: 280px; max-width: 100%;">Reset Scenario</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Export Assessment
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
        val: $('msr-value'), loan: $('msr-loan'), pay: $('msr-payment'),
        inc: $('msr-income'), sav: $('msr-savings'),
        dropV: $('msr-drop-val'), dropI: $('msr-drop-inc'), spikeP: $('msr-spike-pay')
    };

    function calculateRisk() {
        const val = parseFloat(els.val.value) || 0;
        const loan = parseFloat(els.loan.value) || 0;
        const pay = parseFloat(els.pay.value) || 0;
        const inc = parseFloat(els.inc.value) || 0;
        const sav = parseFloat(els.sav.value) || 0;
        
        const dvPercent = parseFloat(els.dropV.value) || 0;
        const diPercent = parseFloat(els.dropI.value) || 0;
        const pSpike = parseFloat(els.spikeP.value) || 0;

        // Current Posture
        const curEq = val - loan;
        const curRatio = inc > 0 ? (pay / inc) * 100 : 100;
        
        $('out-eq-cur').textContent = fmtC(curEq);
        $('out-pr-cur').textContent = curRatio.toFixed(1) + '% of Income';

        // Stressed Posture
        const strVal = val * (1 - (dvPercent / 100));
        const strEq = strVal - loan;
        const strEqPct = strVal > 0 ? (strEq / strVal) * 100 : 0;
        
        const strInc = inc * (1 - (diPercent / 100));
        const strPay = pay + pSpike;
        const strRatio = strInc > 0 ? (strPay / strInc) * 100 : 999;
        
        $('out-eq-str').textContent = fmtC(strEq);
        $('out-pr-str').textContent = strInc === 0 ? 'Infinite (No Income)' : (strRatio > 100 ? '>100%' : strRatio.toFixed(1) + '%');
        $('out-eq-str').className = strEq < 0 ? 'text-danger fw-bold' : 'text-success fw-bold';
        $('out-pr-str').className = strRatio > 43 ? 'text-danger fw-bold' : 'text-success fw-bold';

        // Equity progress bar (green if eq > 20%, yellow 0-20, red < 0)
        let isNegativeEq = strEq < 0;
        $('bar-equity').style.width = isNegativeEq ? '100%' : Math.min(100, Math.max(5, strEqPct)) + '%';
        $('bar-equity').className = isNegativeEq ? 'progress-bar bg-danger' : (strEqPct < 20 ? 'progress-bar bg-warning' : 'progress-bar bg-success');
        $('msg-equity').className = isNegativeEq ? 'small fw-bold mt-2 text-danger' : 'small fw-bold mt-2 text-success';
        $('msg-equity').innerHTML = isNegativeEq ? `<i class="fas fa-arrow-down me-1"></i> Underwater (-${fmtC(Math.abs(strEq))})` : `<i class="fas fa-check me-1"></i> Positive Equity`;

        // Payment ratio progress bar (green < 30, yellow 30-43, red > 43)
        let isHousePoor = strRatio > 43;
        $('bar-payment').style.width = strInc === 0 ? '100%' : Math.min(100, Math.max(5, strRatio)) + '%';
        $('bar-payment').className = strInc === 0 ? 'progress-bar bg-dark' : (isHousePoor ? 'progress-bar bg-danger' : (strRatio > 30 ? 'progress-bar bg-warning' : 'progress-bar bg-success'));
        $('msg-payment').className = isHousePoor ? 'small fw-bold mt-2 text-danger' : 'small fw-bold mt-2 text-success';
        $('msg-payment').innerHTML = strInc === 0 ? '<i class="fas fa-skull text-dark me-1"></i> No Income' : (isHousePoor ? `<i class="fas fa-exclamation-circle me-1"></i> Severe House Poor` : `<i class="fas fa-check me-1"></i> Affordable`);

        // Emergency Runway
        // If income covers housing, runway is basically infinite just for housing. 
        // But what about living costs? Assume living costs = max(inc - pay, 1500) if not provided.
        // Let's just track monthly deficit vs savings.
        let monthlyDeficit = 0;
        let basicLiving = Math.max(strInc - strPay, 1500); // very rough assumption
        totalNeeded = strPay + basicLiving; 
        
        let monthsRunway = 0;
        let runwayDesc = "Infinite (No Deficit)";
        
        if (strInc < strPay) {
            monthlyDeficit = strPay - strInc; // just for housing
            monthsRunway = (sav / monthlyDeficit);
            runwayDesc = `Time before missing mortgage payment`;
        } else {
            // They have enough for mortgage. 
            monthsRunway = sav > 0 ? 99 : 0; 
            runwayDesc = "Income covers mortgage";
        }

        $('out-runway-months').textContent = monthsRunway === 99 ? '99+' : monthsRunway.toFixed(1);
        $('out-runway-desc').textContent = runwayDesc;
        if(monthsRunway < 3 && monthsRunway !== 99) {
            $('out-runway-months').style.color = '#dc2626'; // red
        } else if (monthsRunway < 6 && monthsRunway !== 99) {
            $('out-runway-months').style.color = '#f59e0b'; // orange
        } else {
            $('out-runway-months').style.color = '#10b981'; // green
        }

        // Global Status
        let status = 'SECURE'; let colorClass = 'text-success';
        if (isNegativeEq || isHousePoor || monthsRunway < 6) { status = 'AT RISK'; colorClass = 'text-warning'; }
        if (isNegativeEq && isHousePoor) { status = 'DANGER'; colorClass = 'text-danger'; }
        if (monthsRunway < 3 && strInc < strPay) { status = 'CRITICAL'; colorClass = 'text-danger'; }

        $('out-status-text').textContent = status;
        $('out-status-text').className = `output-hero-value m-0 ${colorClass}`;

        // Dynamic Tip
        let tipContainer = $('tip-container');
        tipContainer.className = `alert border d-flex align-items-start gap-3 mb-0 `;
        tipContainer.classList.add(status === 'CRITICAL' || status === 'DANGER' ? 'alert-soft-danger' : (status === 'AT RISK' ? 'alert-soft-warning' : 'alert-soft-success'));
        tipContainer.classList.add(status === 'CRITICAL' || status === 'DANGER' ? 'border-danger' : (status === 'AT RISK' ? 'border-warning' : 'border-success'));
        
        let tipTitle = $('tip-title');
        let tipIcon = $('tip-icon');
        tipIcon.className = `fas mt-1 fs-4 `;
        tipIcon.classList.add(status === 'CRITICAL' || status === 'DANGER' ? 'fa-exclamation-triangle text-danger' : (status === 'AT RISK' ? 'fa-exclamation-circle text-warning' : 'fa-shield-alt text-success'));

        if (status === 'SECURE') {
            tipTitle.textContent = "Resilient Position";
            $('out-tip').innerHTML = `Your setup is highly resilient. Even with these stressors, you maintain positive equity and affordable payments. Keep your emergency fund topped up.`;
        } else if (status === 'AT RISK') {
            tipTitle.textContent = "Vulnerability Detected";
            if (isNegativeEq) $('out-tip').innerHTML = `A property value drop of ${dvPercent}% puts you underwater. This is only a problem if you need to sell or refinance during the crash.`;
            else $('out-tip').innerHTML = `Your payment ratio climbs uncomfortably high during this stress event, limiting your buffer. Consider increasing savings.`;
        } else {
            tipTitle.textContent = "High Default Risk";
             $('out-tip').innerHTML = `This scenario leads to severe distress. You will deplete savings in <strong>${monthsRunway.toFixed(1)} months</strong> and fall behind on payments unless you drastically reduce expenses or sell.`;
        }
    }

    // Event Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculateRisk));
    
    // Presets
    document.querySelectorAll('.msr-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            els.dropV.value = e.target.dataset.v;
            els.dropI.value = e.target.dataset.i;
            els.spikeP.value = e.target.dataset.p;
            calculateRisk();
        });
    });

    $('msr-reset').addEventListener('click', () => {
        els.dropV.value = 20; els.dropI.value = 15; els.spikeP.value = 0;
        calculateRisk();
    });

    $('msr-copy-btn').addEventListener('click', function(){
        const text = `Mortgage Stress Test Report:\nStatus: ${$('out-status-text').textContent}\nStressed Equity: ${$('out-eq-str').textContent}\nStressed Payment Ratio: ${$('out-pr-str').textContent}\nSurvival Runway: ${$('out-runway-months').textContent} months\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculateRisk();
});
</script>

<style>
.mortgage-stress-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(220,38,38,.05)}
.mortgage-stress-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.mortgage-stress-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.mortgage-stress-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.mortgage-stress-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.mortgage-stress-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.bg-soft-red { background-color: #fef2f2 !important; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}
.output-hero-value{font-size:3.5rem;font-weight:900;color:#0f172a;line-height:1;letter-spacing:-2.5px}

.alert-soft-danger { background-color: #fef2f2; color: #991b1b; }
.alert-soft-warning { background-color: #fffbeb; color: #b45309; }
.alert-soft-success { background-color: #f0fdf4; color: #166534; }

.payment-box { background:#fff; border: 2px solid #e5e7eb; border-radius: 16px; padding: 1.5rem; text-align: left; }
.stat-card-label {font-size:.7rem;font-weight:900;text-transform:uppercase;color:#94a3b8;letter-spacing:1.5px;margin-bottom:4px; display:block;}

.stat-card{background:#fff;border:2.5px solid #f1f5f9;border-radius:20px;padding:1.5rem 1.25rem;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%}
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }

@media (max-width: 768px) {
    .mortgage-stress-rebuilt .calculator-card { padding: 1.5rem; }
    .output-hero-value { font-size: 2.5rem; }
}
@media print {
    .print-hide { display: none !important; }
    .output-card-themed { border: 1px solid #000; box-shadow: none; background: #fff !important; }
}
</style>

