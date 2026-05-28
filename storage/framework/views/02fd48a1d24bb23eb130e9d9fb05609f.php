<div class="row g-4 str-vs-ltr-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-rose">
            

            <div class="calculator-body">
                <div class="row g-4">
                    
                    <div class="col-md-6 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-rose small"><i class="fas fa-suitcase-rolling me-2"></i>Short-Term (Airbnb/VRBO)</h6>
                        
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label-custom">Avg Nightly Rate</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                                    <input type="number" id="str-rate" class="form-control border-start-0 ps-0 fw-bold text-rose bg-soft-rose" value="180" step="10">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">Expected Occupancy</label>
                                <div class="input-group">
                                    <input type="number" id="str-occ" class="form-control border-end-0 fw-bold text-rose bg-soft-rose" value="65" step="5">
                                    <span class="input-group-text bg-soft-rose border-start-0 text-rose fw-bold">%</span>
                                </div>
                            </div>
                        </div>

                        <label class="form-label-custom">Platform & Mgmt Fees (%)</label>
                        <div class="input-group mb-3">
                            <input type="number" id="str-fees" class="form-control border-end-0" value="20" step="1">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>

                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label-custom tooltip-label" title="Unrecovered cleaning, soaps, supplies">Turnover Costs ($/mo)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-broom"></i></span>
                                    <input type="number" id="str-clean" class="form-control border-start-0 ps-0" value="300" step="50">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom tooltip-label" title="Wifi, Electricity, Streaming, Wear & Tear">Utilities & Wear ($/mo)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-bolt"></i></span>
                                    <input type="number" id="str-util" class="form-control border-start-0 ps-0" value="450" step="50">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6 ps-md-4 mt-5 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-home me-2"></i>Long-Term (12 Mo. Lease)</h6>
                        
                        <label class="form-label-custom">Standard Monthly Rent</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="ltr-rent" class="form-control form-control-lg border-start-0 ps-0 fw-bold" value="2100" step="50">
                        </div>

                        <label class="form-label-custom">Vacancy Rate (%)</label>
                        <div class="input-group mb-3">
                            <input type="number" id="ltr-vac" class="form-control border-end-0" value="5" step="1">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>

                        <label class="form-label-custom tooltip-label" title="Standard Property Management">Traditional Mgmt Fee (%)</label>
                        <div class="input-group mb-3">
                            <input type="number" id="ltr-mgmt" class="form-control border-end-0" value="8" step="1">
                            <span class="input-group-text bg-white border-start-0 text-muted">%</span>
                        </div>

                        <label class="form-label-custom tooltip-label" title="LL paid utilities, standard wear">LL Utilities & Maint ($/mo)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-tools"></i></span>
                            <input type="number" id="ltr-util" class="form-control border-start-0 ps-0" value="150" step="50">
                        </div>

                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-rose me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 str-quick" data-p="1">Tourist Hotspot</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 str-quick" data-p="2">Suburban Residential</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 str-quick" data-p="3">Self-Managed STR</button>
                    <div class="flex-grow-1"></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#e11d48;--tool-bg:#fff1f2;">
            
            
            <div class="row align-items-center mb-5">
                <div class="col-md-7 text-center text-md-start">
                    <span class="output-hero-label text-rose mb-1">THE "HASSLE" PREMIUM</span>
                    <h2 class="display-3 fw-black text-dark m-0 pb-1" id="out-premium">$0</h2>
                    <p class="text-muted fw-bold mb-0">Extra net operating profit generated per month by choosing STR instead of LTR.</p>
                </div>
                <div class="col-md-5 mt-4 mt-md-0 d-flex justify-content-center justify-content-md-end">
                    <div id="winner-badge" class="px-4 py-3 rounded-4 bg-white border shadow-sm text-center">
                        <span class="stat-card-label mb-1">OPTIMAL STRATEGY</span>
                        <div class="fs-4 fw-black text-rose" id="out-winner-dir">SHORT-TERM</div>
                    </div>
                </div>
            </div>

            
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="str-stat-card border-rose-top">
                        <div class="text-center mb-4">
                            <span class="fw-bold text-muted small letter-spacing-1 text-uppercase">Short-Term (STR)</span>
                            <div class="fs-1 fw-black text-rose mt-1" id="out-str-net">$0</div>
                            <div class="small fw-bold text-muted">Net Operating Income / mo</div>
                        </div>
                        
                        <div class="str-breakdown">
                            <div class="d-flex justify-content-between small mb-2"><span class="text-muted">Gross Monthly Rev:</span><span class="fw-bold text-dark" id="out-str-gross">$0</span></div>
                            <div class="d-flex justify-content-between small mb-2"><span class="text-muted">Platform/Mgmt Fees:</span><span class="fw-bold text-danger" id="out-str-fees">-$0</span></div>
                            <div class="d-flex justify-content-between small"><span class="text-muted">OpEx (Clean/Util):</span><span class="fw-bold text-danger" id="out-str-opex">-$0</span></div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="str-stat-card border-slate-top">
                        <div class="text-center mb-4">
                            <span class="fw-bold text-muted small letter-spacing-1 text-uppercase">Long-Term (LTR)</span>
                            <div class="fs-1 fw-black text-slate mt-1" id="out-ltr-net">$0</div>
                            <div class="small fw-bold text-muted">Net Operating Income / mo</div>
                        </div>
                        
                        <div class="str-breakdown">
                            <div class="d-flex justify-content-between small mb-2"><span class="text-muted">Gross Rent (After Vac):</span><span class="fw-bold text-dark" id="out-ltr-gross">$0</span></div>
                            <div class="d-flex justify-content-between small mb-2"><span class="text-muted">Mgmt Fees:</span><span class="fw-bold text-danger" id="out-ltr-fees">-$0</span></div>
                            <div class="d-flex justify-content-between small"><span class="text-muted">OpEx (Maint/Util):</span><span class="fw-bold text-danger" id="out-ltr-opex">-$0</span></div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 print-hide">
                <div class="alert border d-flex align-items-start gap-3 mb-0" id="tip-container">
                    <i class="fas fa-info-circle fs-4 mt-1" id="tip-icon"></i>
                    <div>
                        <h6 class="fw-bold mb-1" id="tip-title">Hassle Analysis</h6>
                        <p class="mb-0 small" id="out-tip">Calculating insights...</p>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="str-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-rose"></i>Copy Analysis
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="str-reset" style="min-width: 280px; max-width: 100%;">Reset Scenarios</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Strategy Sheet
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
        rate: $('str-rate'), occ: $('str-occ'), fees: $('str-fees'), clean: $('str-clean'), util: $('str-util'),
        rent: $('ltr-rent'), vac: $('ltr-vac'), mgmt: $('ltr-mgmt'), lutil: $('ltr-util')
    };

    function calculate() {
        // STR
        const rate = parseFloat(els.rate.value) || 0;
        const occ = parseFloat(els.occ.value) || 0;
        const fees = parseFloat(els.fees.value) || 0;
        const clean = parseFloat(els.clean.value) || 0;
        const util = parseFloat(els.util.value) || 0;

        const strNights = 30 * (occ / 100);
        const strGross = strNights * rate;
        const strFeeCost = strGross * (fees / 100);
        const strOpCost = clean + util;
        const strNet = strGross - strFeeCost - strOpCost;

        // LTR
        const rent = parseFloat(els.rent.value) || 0;
        const vac = parseFloat(els.vac.value) || 0;
        const mgmt = parseFloat(els.mgmt.value) || 0;
        const lutil = parseFloat(els.lutil.value) || 0;

        const ltrGross = rent * (1 - (vac / 100)); // Monthly
        const ltrFeeCost = ltrGross * (mgmt / 100);
        const ltrOpCost = lutil;
        const ltrNet = ltrGross - ltrFeeCost - ltrOpCost;

        // Comparison
        const premium = strNet - ltrNet;
        
        // Output STR
        $('out-str-gross').textContent = fmtC(strGross);
        $('out-str-fees').textContent = '-' + fmtC(strFeeCost);
        $('out-str-opex').textContent = '-' + fmtC(strOpCost);
        $('out-str-net').textContent = fmtC(strNet);

        // Output LTR
        $('out-ltr-gross').textContent = fmtC(ltrGross);
        $('out-ltr-fees').textContent = '-' + fmtC(ltrFeeCost);
        $('out-ltr-opex').textContent = '-' + fmtC(ltrOpCost);
        $('out-ltr-net').textContent = fmtC(ltrNet);

        // Premium
        $('out-premium').textContent = fmtC(Math.abs(premium)) + '/mo';
        
        let winnerDir = $('out-winner-dir');
        let tipCon = $('tip-container');
        let tipIcon = $('tip-icon');
        let tipTitle = $('tip-title');
        let tipText = $('out-tip');

        if (premium > 0) {
            $('out-premium').className = 'display-3 fw-black text-rose m-0 pb-1';
            winnerDir.textContent = "STR (AIRBNB)";
            winnerDir.className = "fs-4 fw-black text-rose";
            
            tipCon.className = "alert alert-soft-rose border-rose d-flex align-items-start gap-3 mb-0";
            tipIcon.className = "fas fa-check-circle fs-4 mt-1 text-rose";
            tipTitle.className = "fw-bold mb-1 text-rose";

            if (premium > 1000) {
                tipText.innerHTML = `You are earning an extreme premium <strong>(+${fmtC(premium)}/mo)</strong> by running this as an STR. This heavily justifies the extra furnishing, regulatory risk, and hospitality hustle associated with short-term rentals.`;
            } else if (premium > 300) {
                tipText.innerHTML = `The STR yields <strong>+${fmtC(premium)}/mo</strong> more than a standard lease. Determine if this extra cashflow is worth the time managing cleaners, guest messages, and platform updates.`;
            } else {
                tipText.innerHTML = `Warning: The STR only makes <strong>+${fmtC(premium)}/mo</strong> extra. This very low "hassle premium" means you are doing hotel-level work for barely any extra pay. Consider switching to Long-Term.`;
            }
        } else {
            $('out-premium').className = 'display-3 fw-black text-slate m-0 pb-1';
            winnerDir.textContent = "LTR (TRADITIONAL)";
            winnerDir.className = "fs-4 fw-black text-slate";
            
            tipCon.className = "alert alert-soft-slate border-slate d-flex align-items-start gap-3 mb-0";
            tipIcon.className = "fas fa-shield-alt fs-4 mt-1 text-slate";
            tipTitle.className = "fw-bold mb-1 text-slate";

            tipText.innerHTML = `Long-Term renting actually generates <strong>${fmtC(Math.abs(premium))}/mo MORE</strong> net income than short-term hosting. STR platform fees and turnover costs are destroying your margins. Stick to traditional 12-month leases.`;
        }
    }

    // Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculate));
    
    document.querySelectorAll('.str-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === '1') { // Tourist
                els.rate.value = 250; els.occ.value = 75; els.fees.value = 22; els.rent.value = 2400;
            } else if (p === '2') { // Suburban LTR lean
                els.rate.value = 110; els.occ.value = 45; els.fees.value = 20; els.rent.value = 1800;
            } else if (p === '3') { // Self managed STR
                els.rate.value = 160; els.occ.value = 70; els.fees.value = 3; els.clean.value = 100;
            }
            calculate();
        });
    });
    
    $('str-reset').addEventListener('click', () => {
        els.rate.value = 180; els.occ.value = 65; els.fees.value = 20; els.clean.value = 300; els.util.value = 450;
        els.rent.value = 2100; els.vac.value = 5; els.mgmt.value = 8; els.lutil.value = 150;
        calculate();
    });

    $('str-copy').addEventListener('click', function(){
        const winner = premium > 0 ? 'Short-Term Rental' : 'Long-Term Rental';
        const text = `Rental Strategy Comparison:\nWinner: ${$('out-winner-dir').textContent}\nHassle Premium: ${$('out-premium').textContent}\nSTR Net: ${$('out-str-net').textContent}/mo\nLTR Net: ${$('out-ltr-net').textContent}/mo\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.str-vs-ltr-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(225,29,72,.05)}
.str-vs-ltr-rebuilt .border-rose { border-top: 4px solid #e11d48; }
.str-vs-ltr-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.str-vs-ltr-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.str-vs-ltr-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.str-vs-ltr-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.str-vs-ltr-rebuilt .form-label-custom{font-size:.75rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:.75rem;display:block}

.text-rose { color: #e11d48 !important; }
.bg-rose-soft { background-color: #fff1f2 !important; }
.bg-soft-rose { background-color: #fff1f2 !important; }

.text-slate { color: #475569 !important; }

.border-end-md { border-right: 1px dashed #e2e8f0; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}

.str-stat-card { background: #fff; border-radius: 16px; padding: 2rem 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,.03); height: 100%; border: 1px solid #e2e8f0; }
.border-rose-top { border-top: 4px solid #e11d48; }
.border-slate-top { border-top: 4px solid #475569; }
.stat-card-label {font-size:.75rem;font-weight:900;text-transform:uppercase;letter-spacing:1px; color:#94a3b8; display:block;}

.alert-soft-rose { background-color: #fff1f2; color: #9f1239; }
.alert-soft-slate { background-color: #f8fafc; color: #334155; }
.border-rose { border-color: #fecdd3 !important; }
.border-slate { border-color: #cbd5e1 !important; }

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

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\short-term-vs-long-term-rental-calculator.blade.php ENDPATH**/ ?>