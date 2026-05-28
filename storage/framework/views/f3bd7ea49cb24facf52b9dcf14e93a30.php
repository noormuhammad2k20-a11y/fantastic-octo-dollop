<div class="row g-4 cosign-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(5, 150, 105, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #059669, #047857); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Co-Signer Advantage Analyzer</h4>
                    <p class="text-muted small mb-0">Quantify the financial benefit of a higher credit score partner. Calculate interest savings, fee reductions, and approval lifts.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light border">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Desired Loan Amount</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="cs-amt" class="form-control border-0 bg-white fw-bold" value="30000">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Loan Term (Months)</label>
                                    <div class="input-group input-group-lg bg-white rounded-3 border">
                                        <input type="number" id="cs-term" class="form-control border-0 bg-white fw-bold" value="60">
                                        <span class="input-group-text border-0 bg-white opacity-40">Mo</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border-top border-4 border-slate h-100 shadow-sm" style="background: #f8fafc;">
                            <h6 class="fw-black text-slate text-uppercase small mb-4 tracking-wider">Scenario A: Solo Applicant</h6>
                            <div class="mb-3">
                                <label class="form-label-custom">Estimated Rate (%)</label>
                                <input type="number" id="cs-rate-solo" class="form-control border-0 bg-white rounded-3 fw-bold" value="14.5">
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Origination Fee ($)</label>
                                <input type="number" id="cs-fee-solo" class="form-control border-0 bg-white rounded-3 fw-bold" value="500">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border-top border-4 border-teal h-100 shadow-sm" style="background: #f0fdfa;">
                            <h6 class="fw-black text-teal text-uppercase small mb-4 tracking-wider">Scenario B: With Co-Signer</h6>
                            <div class="mb-3">
                                <label class="form-label-custom">Tier-1 Rate (%)</label>
                                <input type="number" id="cs-rate-co" class="form-control border-0 bg-white rounded-3 fw-bold" value="6.5">
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Origination Fee ($)</label>
                                <input type="number" id="cs-fee-co" class="form-control border-0 bg-white rounded-3 fw-bold" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 165; --tool-color: #059669; --tool-bg: rgba(5, 150, 105, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL LIFETIME SAVINGS</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-total-saved">$0</div>
                <div class="badge bg-teal-soft text-teal px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-monthly-saved">Save $0.00 / month</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">COMPARISON METRICS</th>
                                        <th class="text-muted small fw-bold py-3 text-end">SOLO</th>
                                        <th class="text-muted small fw-bold py-3 text-end">CO-SIGNED</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Monthly Payment</td>
                                        <td class="py-3 text-end text-danger" id="tbl-pmt-solo">$0</td>
                                        <td class="py-3 text-end text-success" id="tbl-pmt-co">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Interest</td>
                                        <td class="py-3 text-end" id="tbl-int-solo">$0</td>
                                        <td class="py-3 text-end" id="tbl-int-co">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Entry Costs</td>
                                        <td class="py-3 text-end" id="tbl-fee-solo">$0</td>
                                        <td class="py-3 text-end" id="tbl-fee-co">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Cost of Capital</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-total-solo">$0</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-total-co">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Financial Leverage</h6>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-bold">Interest Savings</span>
                                    <span class="small fw-bold" id="out-leverage">0% Reduc.</span>
                                </div>
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 15px; background: #f1f5f9;">
                                    <div id="bar-leverage" class="progress-bar bg-teal" style="width: 50%"></div>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-teal rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-share-nodes me-2"></i>Share Savings Report
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
    const amtE = $('cs-amt'), termE = $('cs-term'), 
          rSoloE = $('cs-rate-solo'), fSoloE = $('cs-fee-solo'),
          rCoE = $('cs-rate-co'), fCoE = $('cs-fee-co');

    function pmt(rate, nper, pv) {
        if(rate === 0) return pv / nper;
        return (pv * rate) / (1 - Math.pow(1 + rate, -nper));
    }

    function calculate(){
        let principal = parseFloat(amtE.value) || 0;
        let months = parseFloat(termE.value) || 1;
        let rs = (parseFloat(rSoloE.value) || 0) / 100 / 12;
        let fs = parseFloat(fSoloE.value) || 0;
        let rc = (parseFloat(rCoE.value) || 0) / 100 / 12;
        let fc = parseFloat(fCoE.value) || 0;

        let pSolo = pmt(rs, months, principal);
        let pCo = pmt(rc, months, principal);

        let intSolo = (pSolo * months) - principal;
        let intCo = (pCo * months) - principal;

        let totalSolo = intSolo + fs;
        let totalCo = intCo + fc;

        let monthlySaved = Math.max(0, pSolo - pCo);
        let totalSaved = Math.max(0, totalSolo - totalCo);

        // Update UI
        $('out-total-saved').textContent = '$' + Math.round(totalSaved).toLocaleString();
        $('out-monthly-saved').textContent = `Save $${monthlySaved.toFixed(2)} / month`;
        
        $('tbl-pmt-solo').textContent = '$' + pSolo.toFixed(2);
        $('tbl-pmt-co').textContent = '$' + pCo.toFixed(2);
        $('tbl-int-solo').textContent = '$' + Math.round(intSolo).toLocaleString();
        $('tbl-int-co').textContent = '$' + Math.round(intCo).toLocaleString();
        $('tbl-fee-solo').textContent = '$' + fs.toLocaleString();
        $('tbl-fee-co').textContent = '$' + fc.toLocaleString();
        $('tbl-total-solo').textContent = '$' + Math.round(totalSolo).toLocaleString();
        $('tbl-total-co').textContent = '$' + Math.round(totalCo).toLocaleString();

        if(intSolo > 0) {
            let reduction = ( (intSolo - intCo) / intSolo ) * 100;
            $('out-leverage').textContent = reduction.toFixed(0) + '% Reduction';
            $('bar-leverage').style.width = reduction + '%';
        }
    }

    [amtE, termE, rSoloE, fSoloE, rCoE, fCoE].forEach(e => e.addEventListener('input', calculate));

    $('reset-calc').addEventListener('click', () => {
        amtE.value = 30000; termE.value = 60;
        rSoloE.value = 14.5; fSoloE.value = 500;
        rCoE.value = 6.5; fCoE.value = 0;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Co-Signer Savings Report\nTotal Lifetime Savings: ${$('out-total-saved').textContent}\nMonthly Reduction: ${$('out-monthly-saved').textContent}\nGenerated by ToolsHub Partners`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.cosign-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.cosign-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-teal { background: #059669; color: #fff; transition: all .3s; }
.btn-teal:hover { background: #047857; color: #fff; transform: translateY(-2px); }
.text-teal { color: #059669; }
.bg-teal-soft { background: #F0FDFA; }
.bg-teal { background-color: #059669 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\co-signer-benefit-calculator.blade.php ENDPATH**/ ?>