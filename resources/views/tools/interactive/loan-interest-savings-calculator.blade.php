<div class="row g-4 loan-savings-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(16, 185, 129, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #10B981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Loan Payoff Optimizer</h4>
                    <p class="text-muted small mb-0">Discover the massive impact of small extra payments. Model lump sums and aggressive payoff strategies.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Row 1: Core Details --}}
                    <div class="col-md-4">
                        <label class="form-label-custom">Current Balance</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="sav-balance" class="form-control border-0 bg-light fw-bold" value="250000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Interest Rate (%)</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <input type="number" id="sav-rate" class="form-control border-0 bg-light fw-bold" value="6.5" step="0.1">
                            <span class="input-group-text border-0 bg-light opacity-50">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Remaining Term (Years)</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <input type="number" id="sav-term" class="form-control border-0 bg-light fw-bold" value="30">
                            <span class="input-group-text border-0 bg-light opacity-50">Yrs</span>
                        </div>
                    </div>

                    {{-- Row 2: Strategy --}}
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-emerald-50 border border-emerald-100 shadow-sm">
                            <h6 class="fw-bold small mb-4 uppercase text-emerald-800 opacity-70">Acceleration Strategy</h6>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom text-emerald-900">Extra Monthly Payment</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="sav-extra" class="form-control border-0 bg-white fw-bold" value="200" step="50">
                                    </div>
                                    <div class="small text-emerald-700 mt-2">Applied to principal every month</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom text-emerald-900">Annual Lump Sum (One-time/Yr)</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="sav-lump" class="form-control border-0 bg-white fw-bold" value="0" step="500">
                                    </div>
                                    <div class="small text-emerald-700 mt-2">e.g. Tax refund or bonus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-e="100" data-l="0">Starter Boost</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-e="500" data-l="2000">Wealth Accelerator</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-e="1000" data-l="5000">Debt Destroyer</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 160; --tool-color: #10B981; --tool-bg: rgba(16, 185, 129, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL INTEREST SAVED</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-interest-saved">$0</div>
                <div class="badge bg-emerald-soft text-emerald px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-time-saved">Pay off 0 years early</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Charts/Breakdown --}}
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">PAYOFF COMPARISON</th>
                                        <th class="text-muted small fw-bold py-3 text-end">VALUES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold text-muted uppercase small">Standard Total Interest</td>
                                        <td class="py-3 fw-bold text-end text-danger" id="tbl-std-int">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold text-muted uppercase small">Optimized Total Interest</td>
                                        <td class="py-3 fw-bold text-end text-success" id="tbl-new-int">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Years Saved</td>
                                        <td class="py-3 fw-black text-end text-emerald h5 mb-0" id="tbl-years-saved">0.0 Yrs</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <h6 class="fw-bold small mb-2 uppercase opacity-50">Repayment Timeline Comparison</h6>
                            <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 30px; background: #f1f5f9;">
                                <div id="bar-new" class="progress-bar bg-emerald" style="width: 70%">Optimized</div>
                                <div id="bar-saved" class="progress-bar bg-emerald-200 text-emerald-800" style="width: 30%">Saved</div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <div class="p-3 rounded-4 bg-light border mb-4">
                                <h6 class="fw-bold small mb-2 uppercase opacity-50">New Monthly Commitment</h6>
                                <div class="h4 fw-bold text-dark mb-0" id="out-new-payment">$0</div>
                                <div class="small text-muted mt-1">Total combined payment</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-emerald rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Savings Report
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Optimizer
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
    const balanceE = $('sav-balance'), rateE = $('sav-rate'), termE = $('sav-term'),
          extraE = $('sav-extra'), lumpE = $('sav-lump');

    function calculate(){
        let balance = parseFloat(balanceE.value) || 0;
        let rate = (parseFloat(rateE.value) || 0) / 100;
        let termYrs = parseFloat(termE.value) || 30;
        let extra = parseFloat(extraE.value) || 0;
        let lump = parseFloat(lumpE.value) || 0;

        let monthlyRate = rate / 12;
        let totalMonths = termYrs * 12;

        // Standard Payment
        let stdPayment = 0;
        if(rate > 0) {
            stdPayment = (balance * monthlyRate) / (1 - Math.pow(1 + monthlyRate, -totalMonths));
        } else {
            stdPayment = balance / totalMonths;
        }
        let stdTotalInterest = (stdPayment * totalMonths) - balance;

        // Optimized Payoff
        let currentBalance = balance;
        let optimizedTotalInterest = 0;
        let months = 0;
        let newPayment = stdPayment + extra;

        while(currentBalance > 0 && months < 1200) {
            months++;
            let interest = currentBalance * monthlyRate;
            optimizedTotalInterest += interest;
            
            let principalPaid = newPayment - interest;
            
            // Apply annual lump sum at the end of every 12 months
            if(months % 12 === 0) {
                principalPaid += lump;
            }

            currentBalance -= principalPaid;
            if(currentBalance < 0) currentBalance = 0;
        }

        let interestSaved = Math.max(0, stdTotalInterest - optimizedTotalInterest);
        let monthsSaved = Math.max(0, totalMonths - months);
        let yearsSaved = monthsSaved / 12;

        // Update UI
        $('out-interest-saved').textContent = '$' + Math.round(interestSaved).toLocaleString();
        $('out-time-saved').textContent = `Pay off ${yearsSaved.toFixed(1)} years early`;
        $('out-new-payment').textContent = '$' + Math.round(newPayment).toLocaleString();
        
        $('tbl-std-int').textContent = '$' + Math.round(stdTotalInterest).toLocaleString();
        $('tbl-new-int').textContent = '$' + Math.round(optimizedTotalInterest).toLocaleString();
        $('tbl-years-saved').textContent = yearsSaved.toFixed(1) + ' Yrs';

        if(totalMonths > 0) {
            let optimizedPct = (months / totalMonths) * 100;
            let savedPct = (monthsSaved / totalMonths) * 100;
            $('bar-new').style.width = optimizedPct + '%';
            $('bar-saved').style.width = savedPct + '%';
            $('bar-new').textContent = Math.round(months) + ' mo';
            $('bar-saved').textContent = Math.round(monthsSaved) + ' saved';
        }
    }

    [balanceE, rateE, termE, extraE, lumpE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            extraE.value = btn.dataset.e;
            lumpE.value = btn.dataset.l;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        balanceE.value = 250000; rateE.value = 6.5; termE.value = 30;
        extraE.value = 200; lumpE.value = 0;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Loan Payoff Optimization\nInterest Saved: ${$('out-interest-saved').textContent}\nTime Saved: ${$('out-time-saved').textContent}\nNew Payoff Time: ${Math.round($('bar-new').style.width)} months\nGenerated by ToolsHub Wealth`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.loan-savings-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.loan-savings-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-emerald { background: #10B981; color: #fff; transition: all .3s; }
.btn-emerald:hover { background: #059669; color: #fff; transform: translateY(-2px); }
.text-emerald { color: #10B981; }
.bg-emerald-soft { background: #ECFDF5; }
.bg-emerald-50 { background-color: #f0fdf4; }
.bg-emerald { background-color: #10B981 !important; }
.bg-emerald-200 { background-color: #a7f3d0 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.bg-slate-400 { background-color: #94a3b8 !important; }
</style>

