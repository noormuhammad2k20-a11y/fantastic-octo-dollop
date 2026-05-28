<div class="row g-4 apr-expose-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(249, 115, 22, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #F97316, #EA580C); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#431407; letter-spacing: -0.5px;">True Rate Exposer (APR Converter)</h4>
                    <p class="text-muted small mb-0">Don't be fooled by "flat" rates. Reveal the real annual percentage rate by accounting for fees and interest compounding logic.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Loan Principal</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="apr-amount" class="form-control border-0 bg-light fw-bold" value="10000" step="500">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Quoted Flat Rate (%)</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <input type="number" id="apr-flat" class="form-control border-0 bg-light fw-bold" value="10.0" step="0.1">
                            <span class="input-group-text border-0 bg-light opacity-50">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Term (Months)</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <input type="number" id="apr-months" class="form-control border-0 bg-light fw-bold" value="36">
                            <span class="input-group-text border-0 bg-light opacity-50">Mo</span>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-orange-50 border border-orange-100 shadow-sm">
                            <h6 class="fw-bold small mb-3 uppercase text-orange-900 opacity-70">Hidden Costs</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom text-orange-900">Upfront Fees ($)</label>
                                    <input type="number" id="apr-upfront" class="form-control border-0 bg-white rounded-3 fw-bold" value="250">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom text-orange-900">Monthly Fees ($)</label>
                                    <input type="number" id="apr-monthly-fee" class="form-control border-0 bg-white rounded-3 fw-bold" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Interest Logic</h6>
                            <div class="mb-0">
                                <label class="form-label-custom">Calculation Basis</label>
                                <select id="apr-basis" class="form-select border-0 bg-light rounded-3 fw-bold">
                                    <option value="flat" selected>Flat Interest (Standard Hire Purchase)</option>
                                    <option value="78">Rule of 78s (Pre-computed)</option>
                                    <option value="diminishing">Diminishing Balance (Standard Bank Loan)</option>
                                </select>
                            </div>
                            <div class="small text-muted mt-2">Flat rate interest is calculated on the full original principal for the entire term.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 25; --tool-color: #F97316; --tool-bg: rgba(249, 115, 22, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TRUE EFFECTIVE APR</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-apr">0.00%</div>
                <div class="badge bg-orange-soft text-orange px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-warn">Warning: 1.8x Higher than quoted flat rate</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">LOAN COST ANALYSIS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">TOTALS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Monthly Commitment</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-monthly">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Interest Charge</td>
                                        <td class="py-3 fw-bold text-end text-danger" id="tbl-interest">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Fees Incurred</td>
                                        <td class="py-3 fw-bold text-end text-danger" id="tbl-fees">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Total Cost of Credit</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-total">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <div class="p-3 rounded-4 bg-orange-50 border border-orange-100 mb-4">
                                <h6 class="fw-bold small mb-2 uppercase opacity-50">Total Repayment Amount</h6>
                                <div class="h4 fw-bold text-orange-900 mb-0" id="out-total-repay">$0</div>
                                <div class="small text-muted mt-1">Principal + Interest + All Fees</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-orange rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-eye-slash me-2"></i>Copy True Rate Analysis
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
    const amountE = $('apr-amount'), flatE = $('apr-flat'), monthsE = $('apr-months'),
          upfrontE = $('apr-upfront'), monthlyFeeE = $('apr-monthly-fee'), basisE = $('apr-basis');

    function calculateAPR(netLoan, monthlyPayment, termMonths) {
        if (netLoan <= 0 || monthlyPayment <= 0 || termMonths <= 0) return 0;
        let minRate = 0, maxRate = 1, guessRate = 0.01, iter = 0;
        while (iter < 100) {
            let pv = 0;
            for (let i = 1; i <= termMonths; i++) pv += monthlyPayment / Math.pow(1 + guessRate, i);
            if (Math.abs(pv - netLoan) < 0.001) break;
            if (pv > netLoan) minRate = guessRate; else maxRate = guessRate;
            guessRate = (minRate + maxRate) / 2;
            iter++;
        }
        return guessRate * 12 * 100;
    }

    function calculate(){
        let p = parseFloat(amountE.value) || 0;
        let fR = (parseFloat(flatE.value) || 0) / 100;
        let m = parseInt(monthsE.value) || 1;
        let uF = parseFloat(upfrontE.value) || 0;
        let mF = parseFloat(monthlyFeeE.value) || 0;
        let basis = basisE.value;

        let totalInterest = 0;
        if(basis === 'flat') {
            totalInterest = p * fR * (m / 12);
        } else if(basis === '78') {
            totalInterest = p * fR * (m / 12); // Total interest same as flat, but loaded differently
        } else {
            // Standard diminishing (amortized)
            let mr = fR / 12;
            let stdPmt = (p * mr) / (1 - Math.pow(1 + mr, -m));
            totalInterest = (stdPmt * m) - p;
        }

        let totalFees = uF + (mF * m);
        let totalRepay = p + totalInterest + totalFees;
        let monthlyPmt = totalRepay / m;
        
        // Effective APR (Money actually received vs payments made)
        let netReceived = p - uF;
        let effectiveMonthlyPmt = monthlyPmt; // But technically it's pmt + monthly fees, which are already in monthlyPmt
        let trueApr = calculateAPR(netReceived, effectiveMonthlyPmt, m);

        // Update UI
        $('out-apr').textContent = trueApr.toFixed(2) + '%';
        $('out-total-repay').textContent = '$' + Math.round(totalRepay).toLocaleString();
        $('tbl-monthly').textContent = '$' + monthlyPmt.toFixed(2);
        $('tbl-interest').textContent = '$' + Math.round(totalInterest).toLocaleString();
        $('tbl-fees').textContent = '$' + Math.round(totalFees).toLocaleString();
        $('tbl-total').textContent = '$' + Math.round(totalInterest + totalFees).toLocaleString();

        let ratio = (parseFloat(flatE.value) > 0) ? (trueApr / parseFloat(flatE.value)) : 0;
        $('out-warn').textContent = ratio > 1 ? `Exposed: ${ratio.toFixed(1)}x Higher than quoted rate` : 'Competitive Rate Identified';
    }

    [amountE, flatE, monthsE, upfrontE, monthlyFeeE, basisE].forEach(e => e.addEventListener('input', calculate));

    $('reset-calc').addEventListener('click', () => {
        amountE.value = 10000; flatE.value = 10.0; monthsE.value = 36;
        upfrontE.value = 250; monthlyFeeE.value = 0; basisE.value = 'flat';
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `True Rate Analysis (APR)\nQuoted Flat: ${flatE.value}%\nActual APR: ${$('out-apr').textContent}\nTotal Repayment: ${$('out-total-repay').textContent}\nGenerated by ToolsHub Auditor`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Analysis Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.apr-expose-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#431407;opacity:.7;margin-bottom:8px;display:block}
.apr-expose-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-orange { background: #F97316; color: #fff; transition: all .3s; }
.btn-orange:hover { background: #EA580C; color: #fff; transform: translateY(-2px); }
.text-orange { color: #F97316; }
.text-orange-900 { color: #431407; }
.bg-orange-soft { background: #FFF7ED; }
.bg-orange-50 { background-color: #fffaf5; }
.bg-orange { background-color: #F97316 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\apr-vs-flat-interest-calculator.blade.php ENDPATH**/ ?>