<div class="row g-4 ot-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(244, 63, 94, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #F43F5E, #BE123C); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#4c0519; letter-spacing: -0.5px;">Advanced Overtime Estimator</h4>
                    <p class="text-muted small mb-0">Model complex shift structures including time-and-a-half, double-time, and shift differentials.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Row 1: Core Rates --}}
                    <div class="col-md-6">
                        <label class="form-label-custom">Base Hourly Rate</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="ot-rate" class="form-control border-0 bg-light fw-bold" value="20.00" step="0.50">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Shift Differential (Add-on)</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <span class="input-group-text border-0 bg-light opacity-50">+$</span>
                            <input type="number" id="ot-diff" class="form-control border-0 bg-light fw-bold" value="0.00" step="0.25">
                        </div>
                    </div>

                    {{-- Row 2: Hours Breakdown --}}
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light border shadow-sm">
                            <h6 class="fw-bold small mb-4 uppercase opacity-50">Hours Worked per Week</h6>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label class="form-label-custom">Regular Hours</label>
                                    <input type="number" id="ot-reg-hrs" class="form-control border-0 bg-white rounded-3 fw-bold" value="40">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom">Overtime (1.5x)</label>
                                    <input type="number" id="ot-15-hrs" class="form-control border-0 bg-white rounded-3 fw-bold" value="10">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom">Double Time (2.0x)</label>
                                    <input type="number" id="ot-20-hrs" class="form-control border-0 bg-white rounded-3 fw-bold" value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Row 3: Allowances --}}
                    <div class="col-md-12">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Weekly Meal/Travel Allowance</label>
                                <div class="input-group bg-light rounded-3 border">
                                    <span class="input-group-text border-0 bg-light opacity-50">$</span>
                                    <input type="number" id="ot-allowance" class="form-control border-0 bg-light fw-bold" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Tax Withholding Estimate (%)</label>
                                <div class="d-flex align-items-center gap-3">
                                    <input type="range" class="form-range color-rose flex-grow-1" id="ot-tax" min="0" max="40" value="15">
                                    <span class="badge bg-rose-soft text-rose p-2" id="tax-val">15%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 350; --tool-color: #F43F5E; --tool-bg: rgba(244, 63, 94, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL WEEKLY EARNINGS (GROSS)</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total">$0</div>
                <div class="d-flex justify-content-center gap-2">
                    <span class="badge bg-rose-soft text-rose px-3 py-2 rounded-pill fw-bold" id="out-net-label">Est. Net: $0</span>
                    <span class="badge bg-rose-soft text-rose px-3 py-2 rounded-pill fw-bold" id="out-avg-hourly">$0 / hour effective</span>
                </div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Detail Table --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">INCOME COMPONENT</th>
                                        <th class="text-muted small fw-bold py-3 text-end">WEEKLY TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Regular Pay (Base + Diff)</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-reg">$0</td>
                                    </tr>
                                    <tr class="text-rose">
                                        <td class="py-3 fw-bold">Overtime (1.5x)</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-15">+$0</td>
                                    </tr>
                                    <tr class="text-rose">
                                        <td class="py-3 fw-bold">Double Time (2.0x)</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-20">+$0</td>
                                    </tr>
                                    <tr class="text-primary">
                                        <td class="py-3 fw-bold">Allowances</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-allowance">+$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black h5 mb-0">TOTAL EARNINGS</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-total">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Summary & Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Pay Ratio</h6>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-bold">Regular vs Overtime</span>
                                    <span class="small fw-bold" id="out-ratio">100% Base</span>
                                </div>
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 15px; background: #f1f5f9;">
                                    <div id="bar-base" class="progress-bar bg-slate-400" style="width: 80%"></div>
                                    <div id="bar-ot" class="progress-bar bg-rose" style="width: 20%"></div>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-rose rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Pay Breakdown
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Estimator
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const rateE = $('ot-rate'), diffE = $('ot-diff'), regE = $('ot-reg-hrs'),
          ot15E = $('ot-15-hrs'), ot20E = $('ot-20-hrs'), allowE = $('ot-allowance'), taxE = $('ot-tax');

    function calculate(){
        let baseRate = parseFloat(rateE.value) || 0;
        let diff = parseFloat(diffE.value) || 0;
        let effectiveRate = baseRate + diff;
        
        let regHrs = parseFloat(regE.value) || 0;
        let ot15Hrs = parseFloat(ot15E.value) || 0;
        let ot20Hrs = parseFloat(ot20E.value) || 0;
        let allowance = parseFloat(allowE.value) || 0;
        let taxRate = (parseFloat(taxE.value) || 0) / 100;

        $('tax-val').textContent = (taxRate * 100) + '%';

        // Math
        let regPay = effectiveRate * regHrs;
        let ot15Pay = (effectiveRate * 1.5) * ot15Hrs;
        let ot20Pay = (effectiveRate * 2.0) * ot20Hrs;
        let totalOT = ot15Pay + ot20Pay;
        let totalGross = regPay + totalOT + allowance;
        let totalNet = totalGross * (1 - taxRate);
        
        let avgHourly = (regHrs + ot15Hrs + ot20Hrs) > 0 ? (totalGross / (regHrs + ot15Hrs + ot20Hrs)) : 0;

        // Update UI
        $('out-total').textContent = '$' + Math.round(totalGross).toLocaleString();
        $('out-net-label').textContent = 'Est. Net: $' + Math.round(totalNet).toLocaleString();
        $('out-avg-hourly').textContent = '$' + avgHourly.toFixed(2) + ' / hour effective';
        
        $('tbl-reg').textContent = '$' + Math.round(regPay).toLocaleString();
        $('tbl-15').textContent = '+$' + Math.round(ot15Pay).toLocaleString();
        $('tbl-20').textContent = '+$' + Math.round(ot20Pay).toLocaleString();
        $('tbl-allowance').textContent = '+$' + Math.round(allowance).toLocaleString();
        $('tbl-total').textContent = '$' + Math.round(totalGross).toLocaleString();

        if(totalGross > 0) {
            let basePct = (regPay / totalGross) * 100;
            let otPct = (totalOT / totalGross) * 100;
            $('bar-base').style.width = basePct + '%';
            $('bar-ot').style.width = otPct + '%';
            $('out-ratio').textContent = `${Math.round(basePct)}% Base | ${Math.round(otPct)}% OT`;
        }
    }

    [rateE, diffE, regE, ot15E, ot20E, allowE, taxE].forEach(e => e.addEventListener('input', calculate));

    $('reset-calc').addEventListener('click', () => {
        rateE.value = 20; diffE.value = 0; regE.value = 40;
        ot15E.value = 10; ot20E.value = 0; allowE.value = 0; taxE.value = 15;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Overtime Pay Breakdown\nGross Total: ${$('out-total').textContent}\nReg Pay: ${$('tbl-reg').textContent}\nOT Pay: $${Math.round((parseFloat(ot15E.value)*1.5 + parseFloat(ot20E.value)*2.0) * (parseFloat(rateE.value)+parseFloat(diffE.value))).toLocaleString()}\nGenerated by ToolsHub PaySuite`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.ot-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#4c0519;opacity:.7;margin-bottom:8px;display:block}
.ot-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-rose { background: #F43F5E; color: #fff; transition: all .3s; }
.btn-rose:hover { background: #BE123C; color: #fff; transform: translateY(-2px); }
.text-rose { color: #F43F5E; }
.bg-rose-soft { background: #FFF1F2; }
.bg-rose { background-color: #F43F5E !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.color-rose::-webkit-slider-thumb { background: #F43F5E; }
.color-rose::-moz-range-thumb { background: #F43F5E; }
</style>

