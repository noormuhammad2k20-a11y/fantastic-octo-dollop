<div class="row g-4 holding-cost-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-red">
            

            <div class="calculator-body">
                <div class="row g-4 mb-4">
                    {{-- Capital & Loan --}}
                    <div class="col-md-5 border-end-md pe-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-red small"><i class="fas fa-hammer me-2"></i>Capital & Renovation</h6>
                        
                        <label class="form-label-custom">Initial Purchase Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" id="hc-price" class="form-control form-control-lg border-start-0 ps-0 fw-bold" value="200000" step="1000">
                        </div>

                        <label class="form-label-custom">Estimated Reno Budget ($)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-tools"></i></span>
                            <input type="number" id="hc-reno" class="form-control border-start-0 ps-0 text-orange fw-bold" value="65000" step="1000">
                        </div>

                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label-custom tooltip-label" title="Usually 10-14% for short-term hard money.">Hard Money Rate (%)</label>
                                <div class="input-group">
                                    <input type="number" id="hc-rate" class="form-control border-end-0 fw-bold text-red bg-soft-red" value="12" step="0.5">
                                    <span class="input-group-text bg-soft-red border-start-0 text-red fw-bold">%</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom tooltip-label" title="Did you self-fund the reno, or roll it into the hot loan?">Loan Covers Reno?</label>
                                <select id="hc-loan-type" class="form-select border-red">
                                    <option value="yes" selected>Yes (100% Financed)</option>
                                    <option value="no">No (Self-Funded Reno)</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    {{-- Time & Carry --}}
                    <div class="col-md-7 ps-md-4 mt-5 mt-md-0">
                        <h6 class="fw-bold mb-3 text-uppercase letter-spacing-1 text-slate small"><i class="fas fa-clock me-2"></i>Time & Carry Costs</h6>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label class="form-label-custom tooltip-label" title="Best case scenario timeline from purchase to sale.">Target Hold Time (Months)</label>
                                <div class="input-group">
                                    <input type="number" id="hc-months" class="form-control form-control-lg border-end-0 fw-bold text-dark" value="4" step="1">
                                    <span class="input-group-text bg-light border-start-0 text-muted">Mos</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label-custom tooltip-label" title="Contractor delays, permitting issues, slow housing market.">Over-schedule Delay (Months)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-danger"><i class="fas fa-plus"></i></span>
                                    <input type="number" id="hc-delay" class="form-control border-start-0 ps-0 text-danger bg-soft-red fw-bold" value="3" step="1" min="1">
                                </div>
                            </div>
                        </div>
                        
                        <hr class="mt-4 mb-3 opacity-10">

                        <h6 class="form-label-custom text-muted mb-2">Monthly Holding Operations ($)</h6>
                        <div class="row g-2">
                            <div class="col-4">
                                <label class="small text-muted" style="font-size:0.65rem">Taxes (Monthly)</label>
                                <input type="number" id="hc-tax" class="form-control form-control-sm" value="300">
                            </div>
                            <div class="col-4">
                                <label class="small text-muted" style="font-size:0.65rem">Insurance (Vacant)</label>
                                <input type="number" id="hc-ins" class="form-control form-control-sm" value="150">
                            </div>
                            <div class="col-4">
                                <label class="small text-muted" style="font-size:0.65rem">Utilities / Dumpster</label>
                                <input type="number" id="hc-util" class="form-control form-control-sm" value="200">
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-bold small text-muted me-2"><i class="fas fa-bolt text-red me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 hc-quick" data-p="1">Cosmetic Flip (3 Mos)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 hc-quick" data-p="2">Gut Job Nightmare (12 Mos)</button>
                    <div class="flex-grow-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#ef4444;--tool-bg:#fef2f2;">
            
            <div class="row align-items-center mb-5">
                <div class="col-md-7 text-center text-md-start">
                    <span class="output-hero-label text-red mb-1">TOTAL PROFIT DESTROYED</span>
                    <h2 class="display-3 fw-black text-danger m-0 pb-1" id="out-total-bleed">$0</h2>
                    <p class="text-danger fw-bold mb-0">Total cost of holding <span class="fw-black">Target + Delayed</span> timeframe.</p>
                </div>
                <div class="col-md-5 mt-4 mt-md-0 d-flex justify-content-center justify-content-md-end">
                    <div class="payment-box bg-white text-center shadow-sm" style="min-width: 200px; border-left:4px solid #ef4444;">
                        <span class="stat-card-label text-slate">MONTHLY CASH BLEED</span>
                        <div class="fs-2 fw-black text-dark" id="out-mo-bleed">$0</div>
                        <div class="small fw-bold mt-1 text-muted">Interest + Carrying Costs</div>
                    </div>
                </div>
            </div>

            {{-- The Timeline Slicer --}}
            <div class="p-4 bg-white rounded-4 border shadow-sm mb-4">
                <h6 class="fw-bold mb-3 small text-uppercase text-slate letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-calendar-times text-danger me-2"></i>The Cost of Delay
                </h6>
                
                <div class="row g-4 mb-2">
                    <div class="col-md-5 position-relative z-1">
                        <div class="p-3 bg-slate-soft rounded-3 border">
                            <span class="d-block small fw-bold text-muted text-uppercase">Target Phase (<span id="lbl-t-mos">0</span> Mos)</span>
                            <div class="fs-3 fw-bold text-dark mt-1" id="out-target-cost">$0</div>
                            <div class="small text-muted mt-1">Expected holding budget.</div>
                        </div>
                    </div>
                    <div class="col-md-2 d-none d-md-flex align-items-center justify-content-center px-0 position-relative">
                        <div style="height: 2px; width: 100%; background: #cbd5e1; position: absolute; z-index: 0;"></div>
                        <i class="fas fa-plus-circle text-danger bg-white fs-4 z-1"></i>
                    </div>
                    <div class="col-md-5 position-relative z-1">
                        <div class="p-3 bg-red-soft rounded-3 border border-danger-subtle shake-hover">
                            <span class="d-block small fw-bold text-danger text-uppercase">Delayed Phase (<span id="lbl-d-mos">0</span> Mos)</span>
                            <div class="fs-3 fw-black text-danger mt-1" id="out-delay-cost">+$0</div>
                            <div class="small text-danger fw-bold mt-1" style="font-size:0.75rem;"><i class="fas fa-fire me-1"></i> Pure profit margins burned.</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Exact Itemized Breakdown --}}
            <div class="row g-4 print-hide">
                <div class="col-12">
                    <div class="bg-white p-4 rounded-4 border">
                        <div class="row align-items-center">
                            <div class="col-md-6 border-end-md pe-md-4">
                                <span class="stat-card-label">TOTAL ALLOCATED TO BANK (INTEREST)</span>
                                <div class="fs-4 fw-black text-dark" id="out-total-int">$0</div>
                                <p class="small text-muted mt-1 mb-0">Total cost of the hard-money leverage.</p>
                            </div>
                            <div class="col-md-6 ps-md-4 pt-3 pt-md-0">
                                <span class="stat-card-label">TOTAL ALLOCATED TO OPERATIONS</span>
                                <div class="fs-4 fw-black text-dark" id="out-total-op">$0</div>
                                <p class="small text-muted mt-1 mb-0">Total cost of utilities, taxes, and vacant insurance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-4 print-hide">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="hc-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-danger"></i>Copy Delay Warning
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="hc-reset" style="min-width: 280px; max-width: 100%;">Reset Scenarios</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Budget Sheet
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
        price: $('hc-price'), reno: $('hc-reno'), rate: $('hc-rate'), loanType: $('hc-loan-type'),
        tMos: $('hc-months'), dMos: $('hc-delay'),
        tax: $('hc-tax'), ins: $('hc-ins'), util: $('hc-util')
    };

    function calculate() {
        const price = parseFloat(els.price.value) || 0;
        const reno = parseFloat(els.reno.value) || 0;
        const rate = parseFloat(els.rate.value) || 0;
        const isRenoFinanced = els.loanType.value === 'yes';

        const tMos = parseInt(els.tMos.value) || 0;
        const dMos = parseInt(els.dMos.value) || 0;
        const totalMos = tMos + dMos;

        const tax = parseFloat(els.tax.value) || 0;
        const ins = parseFloat(els.ins.value) || 0;
        const util = parseFloat(els.util.value) || 0;

        // Base Loan
        const loanAmt = isRenoFinanced ? (price + reno) : price;
        
        // Simple Interest (Hard money is almost always interest only, non-amortizing during flip)
        const annualRate = rate / 100;
        const monthlyInterestPmt = (loanAmt * annualRate) / 12;

        const monthlyOpEx = tax + ins + util;
        const totalMonthlyBleed = monthlyInterestPmt + monthlyOpEx;

        // The Breakdown
        const targetCostTotal = totalMonthlyBleed * tMos;
        const delayCostTotal = totalMonthlyBleed * dMos;
        const totalProfitDestroyed = targetCostTotal + delayCostTotal;

        const lifetimeInterest = monthlyInterestPmt * totalMos;
        const lifetimeOpEx = monthlyOpEx * totalMos;

        // UIs
        $('out-total-bleed').textContent = fmtC(totalProfitDestroyed);
        $('out-mo-bleed').textContent = fmtC(totalMonthlyBleed);

        $('lbl-t-mos').textContent = tMos;
        $('out-target-cost').textContent = fmtC(targetCostTotal);

        $('lbl-d-mos').textContent = dMos;
        $('out-delay-cost').textContent = '+'+fmtC(delayCostTotal);

        $('out-total-int').textContent = fmtC(lifetimeInterest);
        $('out-total-op').textContent = fmtC(lifetimeOpEx);
    }

    // Listeners
    Object.values(els).forEach(el => el.addEventListener('input', calculate));
    
    document.querySelectorAll('.hc-quick').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const p = e.target.dataset.p;
            if(p === '1') { // Cosmetic Short
                els.price.value = 180000; els.reno.value = 25000; els.rate.value = 10; els.loanType.value = 'no';
                els.tMos.value = 2; els.dMos.value = 1; els.util.value = 150;
            } else if (p === '2') { // Gut job nightmare
                els.price.value = 350000; els.reno.value = 150000; els.rate.value = 13; els.loanType.value = 'yes';
                els.tMos.value = 6; els.dMos.value = 6; els.util.value = 400;
            }
            calculate();
        });
    });
    
    $('hc-reset').addEventListener('click', () => {
        els.price.value = 200000; els.reno.value = 65000; els.rate.value = 12; els.loanType.value = 'yes';
        els.tMos.value = 4; els.dMos.value = 3; 
        els.tax.value = 300; els.ins.value = 150; els.util.value = 200;
        calculate();
    });

    $('hc-copy').addEventListener('click', function(){
        const text = `Holding Cost Analysis:\nTarget Hold Cost (${els.tMos.value} mos): ${$('out-target-cost').textContent}\nCost of Delay (${els.dMos.value} mos): ${$('out-delay-cost').textContent}\n\nTotal Hit to Profit Margin: ${$('out-total-bleed').textContent}\nGenerated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.holding-cost-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(239,68,68,.05)}
.holding-cost-rebuilt .border-red { border-top: 4px solid #ef4444 !important; }
.holding-cost-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.holding-cost-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.holding-cost-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.holding-cost-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.holding-cost-rebuilt .form-label-custom{font-size:.7rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.text-red { color: #ef4444 !important; }
.bg-red-soft { background-color: #fef2f2 !important; }
.bg-soft-red { background-color: #fef2f2 !important; }

.text-orange { color: #f97316 !important; }

.text-slate { color: #475569 !important; }
.bg-slate-soft { background-color: #f8fafc !important; }
.border-end-md { border-right: 1px dashed #e2e8f0; }

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08)}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem}
.stat-card-label {font-size:.65rem;font-weight:900;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:4px; display:block;}

.payment-box { border-radius: 16px; padding: 1.5rem; }

.shake-hover:hover { animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both; transform: translate3d(0, 0, 0); backface-visibility: hidden; perspective: 1000px; cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg'  width='40' height='48' viewport='0 0 100 100' style='fill:black;font-size:24px;'><text y='50%'>🔥</text></svg>") 16 0,auto; }

@keyframes shake {
  10%, 90% { transform: translate3d(-1px, 0, 0); }
  20%, 80% { transform: translate3d(2px, 0, 0); }
  30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
  40%, 60% { transform: translate3d(4px, 0, 0); }
}

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

