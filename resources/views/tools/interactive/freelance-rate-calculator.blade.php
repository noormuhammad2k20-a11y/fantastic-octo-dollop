<div class="row g-4 freelance-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(79, 70, 229, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #6366F1, #4F46E5); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Freelance Pricing Strategy</h4>
                    <p class="text-muted small mb-0">Determine your professional hourly rate by calculating real costs, taxes, and desired profit margins.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Column 1: Financial Goals --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Financial Targets</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Desired Annual Net Income</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="fr-target" class="form-control border-0 bg-white fw-bold" value="85000">
                                </div>
                                <div class="small text-muted mt-1">(Amount you want to "take home")</div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Annual Expenses</label>
                                    <input type="number" id="fr-expenses" class="form-control border-0 bg-white rounded-3 fw-bold" value="6000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Tax Target (%)</label>
                                    <input type="number" id="fr-tax" class="form-control border-0 bg-white rounded-3 fw-bold" value="25">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Column 2: Capacity --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Work Capacity</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Billable Hours / Week</label>
                                <div class="input-group bg-light rounded-3 border">
                                    <input type="number" id="fr-hours" class="form-control border-0 bg-light fw-bold" value="25">
                                    <span class="input-group-text border-0 bg-light opacity-50">Hours</span>
                                </div>
                                <div class="small text-muted mt-1">(Exclude admin, marketing, sales)</div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Weeks Worked / Yr</label>
                                    <input type="number" id="fr-weeks" class="form-control border-0 bg-light rounded-3 fw-bold" value="48">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Safety Buffer (%)</label>
                                    <input type="number" id="fr-buffer" class="form-control border-0 bg-light rounded-3 fw-bold" value="15">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="50000" data-h="20">Part-Time Pro</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="120000" data-h="30">Agency Standard</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="200000" data-h="25">Elite Consultant</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 245; --tool-color: #4F46E5; --tool-bg: rgba(79, 70, 229, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">MINIMUM BILLABLE HOURLY RATE</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-rate">$0</div>
                <div class="badge bg-indigo-soft text-indigo px-4 py-2 rounded-pill fw-bold" id="out-annual-rev">Gross Revenue Needed: $0 / yr</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Detail --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">REVENUE COMPONENT</th>
                                        <th class="text-muted small fw-bold py-3 text-end">ANNUAL AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Desired Net Profit</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-net">$0</td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td class="py-3 fw-bold">Tax Provision (Self-Employment)</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-tax">+$0</td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td class="py-3 fw-bold">Business Overhead</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-expenses">+$0</td>
                                    </tr>
                                    <tr class="text-primary">
                                        <td class="py-3 fw-bold">Safety & Admin Buffer</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-buffer">+$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black h5 mb-0">GROSS REVENUE TARGET</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-gross">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Summary --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Productivity Profile</h6>
                            <div class="p-4 rounded-4 bg-light border">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="small fw-bold text-muted mb-1">Billable Hours / Yr</div>
                                        <div class="h4 fw-bold mb-0 text-dark" id="out-total-hours">0</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small fw-bold text-muted mb-1">Day Rate (8h)</div>
                                        <div class="h4 fw-bold mb-0 text-indigo" id="out-day-rate">$0</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2 mt-4">
                                <button class="btn d-block mx-auto btn-indigo rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Pricing Profile
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
    const targetE = $('fr-target'), expenseE = $('fr-expenses'), taxE = $('fr-tax'),
          hoursE = $('fr-hours'), weeksE = $('fr-weeks'), bufferE = $('fr-buffer');

    function calculate(){
        let target = parseFloat(targetE.value) || 0;
        let expenses = parseFloat(expenseE.value) || 0;
        let taxRate = (parseFloat(taxE.value) || 0) / 100;
        let hours = parseFloat(hoursE.value) || 0;
        let weeks = parseFloat(weeksE.value) || 0;
        let buffer = (parseFloat(bufferE.value) || 0) / 100;

        let totalBillable = hours * weeks;
        
        // Math: Gross = (Target / (1-Tax)) + Expenses
        let grossNeeded = (target / (1 - taxRate)) + expenses;
        // Apply buffer
        let finalGross = grossNeeded * (1 + buffer);
        let bufferAmt = finalGross - grossNeeded;
        let taxAmt = (target / (1 - taxRate)) - target;

        let rate = totalBillable > 0 ? (finalGross / totalBillable) : 0;

        // Update UI
        $('out-rate').textContent = '$' + rate.toFixed(2);
        $('out-annual-rev').textContent = 'Gross Revenue Needed: $' + Math.round(finalGross).toLocaleString() + ' / yr';
        
        $('tbl-net').textContent = '$' + Math.round(target).toLocaleString();
        $('tbl-tax').textContent = '+$' + Math.round(taxAmt).toLocaleString();
        $('tbl-expenses').textContent = '+$' + Math.round(expenses).toLocaleString();
        $('tbl-buffer').textContent = '+$' + Math.round(bufferAmt).toLocaleString();
        $('tbl-gross').textContent = '$' + Math.round(finalGross).toLocaleString();
        
        $('out-total-hours').textContent = totalBillable.toLocaleString();
        $('out-day-rate').textContent = '$' + Math.round(rate * 8).toLocaleString();
    }

    [targetE, expenseE, taxE, hoursE, weeksE, bufferE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            targetE.value = btn.dataset.t;
            hoursE.value = btn.dataset.h;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        targetE.value = 85000; expenseE.value = 6000; taxE.value = 25;
        hoursE.value = 25; weeksE.value = 48; bufferE.value = 15;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Freelance Rate Profile\nHourly Rate: ${$('out-rate').textContent}\nGross Annual Target: ${$('tbl-gross').textContent}\nBillable Hours: ${$('out-total-hours').textContent}\nGenerated by ToolsHub Freelance`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.freelance-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e1b4b;opacity:.7;margin-bottom:8px;display:block}
.freelance-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-indigo { background: #4F46E5; color: #fff; transition: all .3s; }
.btn-indigo:hover { background: #1e1b4b; color: #fff; transform: translateY(-2px); }
.text-indigo { color: #4F46E5; }
.bg-indigo-soft { background: #EEF2FF; }
.bg-indigo { background-color: #4F46E5 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

