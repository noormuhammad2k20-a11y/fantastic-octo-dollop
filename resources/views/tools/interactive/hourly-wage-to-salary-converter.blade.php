<div class="row g-4 wage-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(20, 184, 166, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #14B8A6, #0D9488); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a; letter-spacing: -0.5px;">Wage to Salary Power-Converter</h4>
                    <p class="text-muted small mb-0">Translate your hourly efforts into a full annual wealth projection, including bonuses and overtime.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Column 1: Core Wage --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Standard Earnings</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Hourly Rate</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="wage-rate" class="form-control border-0 bg-white fw-bold" value="25.00" step="0.50">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Hours / Week</label>
                                    <input type="number" id="wage-hours" class="form-control border-0 bg-white rounded-3 fw-bold" value="40">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Weeks / Year</label>
                                    <input type="number" id="wage-weeks" class="form-control border-0 bg-white rounded-3 fw-bold" value="52">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Column 2: Extras --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Incentives & Time Off</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Monthly Bonus ($)</label>
                                    <input type="number" id="wage-bonus" class="form-control border-0 bg-light rounded-3 fw-bold" value="200">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Overtime (Hrs/Wk)</label>
                                    <input type="number" id="wage-ot" class="form-control border-0 bg-light rounded-3 fw-bold" value="0">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Paid Time Off (Days / Year)</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="range" class="form-range color-teal flex-grow-1" id="wage-pto" min="0" max="40" value="15">
                                        <span class="badge bg-teal-soft text-teal p-2" id="pto-val">15 Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-r="15" data-h="40">Minimum Wage</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-r="45" data-h="35">Skilled Trade</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-r="85" data-h="40">Professional</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 170; --tool-color: #14B8A6; --tool-bg: rgba(20, 184, 166, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL ANNUAL SALARY</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-salary">$0</div>
                <div class="badge bg-teal-soft text-teal px-4 py-2 rounded-pill fw-bold" id="out-hourly-info">$25.00 / hour equivalent</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Table --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">PAY PERIOD</th>
                                        <th class="text-muted small fw-bold py-3 text-end">EARNINGS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold text-muted uppercase small">Monthly</td>
                                        <td class="py-3 fw-bold text-end text-dark h5 mb-0" id="tbl-monthly">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold text-muted uppercase small">Bi-Weekly</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-biweekly">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold text-muted uppercase small">Weekly</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-weekly">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Daily (Workday)</td>
                                        <td class="py-3 fw-black text-end" id="tbl-daily">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Metrics & Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Earnings Composition</h6>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-bold">Base vs Incentives</span>
                                    <span class="small fw-bold" id="out-comp">100% Base</span>
                                </div>
                                <div class="progress rounded-pill overflow-hidden" style="height: 12px; background: #f1f5f9;">
                                    <div id="bar-base" class="progress-bar bg-teal" style="width: 100%"></div>
                                    <div id="bar-bonus" class="progress-bar bg-warning" style="width: 0%"></div>
                                </div>
                            </div>

                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-teal rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Income Summary
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset
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
    const rateE = $('wage-rate'), hoursE = $('wage-hours'), weeksE = $('wage-weeks'),
          bonusE = $('wage-bonus'), otE = $('wage-ot'), ptoE = $('wage-pto');

    function calculate(){
        let rate = parseFloat(rateE.value) || 0;
        let hours = parseFloat(hoursE.value) || 0;
        let weeks = parseFloat(weeksE.value) || 52;
        let bonusMonthly = parseFloat(bonusE.value) || 0;
        let otHours = parseFloat(otE.value) || 0;
        let ptoDays = parseInt(ptoE.value) || 0;

        $('pto-val').textContent = ptoDays + ' Days';

        // Math
        let weeklyBase = rate * hours;
        let weeklyOT = (rate * 1.5) * otHours;
        let totalWeekly = weeklyBase + weeklyOT;
        
        let annualBase = totalWeekly * weeks;
        let annualBonus = bonusMonthly * 12;
        let grandAnnual = annualBase + annualBonus;

        // Update UI
        $('out-salary').textContent = '$' + Math.round(grandAnnual).toLocaleString();
        $('out-hourly-info').textContent = '$' + rate.toFixed(2) + ' / hour base';
        
        $('tbl-monthly').textContent = '$' + Math.round(grandAnnual / 12).toLocaleString();
        $('tbl-biweekly').textContent = '$' + Math.round(grandAnnual / 26).toLocaleString();
        $('tbl-weekly').textContent = '$' + Math.round(totalWeekly + bonusMonthly/(52/12)).toLocaleString();
        $('tbl-daily').textContent = '$' + Math.round(totalWeekly / 5).toLocaleString();

        if(grandAnnual > 0) {
            let basePct = (annualBase / grandAnnual) * 100;
            let bonusPct = (annualBonus / grandAnnual) * 100;
            $('bar-base').style.width = basePct + '%';
            $('bar-bonus').style.width = bonusPct + '%';
            $('out-comp').textContent = `${Math.round(basePct)}% Base | ${Math.round(bonusPct)}% Extra`;
        }
    }

    [rateE, hoursE, weeksE, bonusE, otE, ptoE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            rateE.value = btn.dataset.r;
            hoursE.value = btn.dataset.h;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        rateE.value = 25; hoursE.value = 40; weeksE.value = 52;
        bonusE.value = 200; otE.value = 0; ptoE.value = 15;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Salary Projection\nAnnual: ${$('out-salary').textContent}\nMonthly: ${$('tbl-monthly').textContent}\nGenerated by ToolsHub Career Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.wage-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0f172a;opacity:.7;margin-bottom:8px;display:block}
.wage-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-teal { background: #14B8A6; color: #fff; transition: all .3s; }
.btn-teal:hover { background: #0D9488; color: #fff; transform: translateY(-2px); }
.text-teal { color: #14B8A6; }
.bg-teal-soft { background: #F0FDFA; }
.bg-teal { background-color: #14B8A6 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.color-teal::-webkit-slider-thumb { background: #14B8A6; }
.color-teal::-moz-range-thumb { background: #14B8A6; }
</style>

