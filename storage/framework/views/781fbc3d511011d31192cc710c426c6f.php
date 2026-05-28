<div class="row g-4 penalty-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(239, 68, 68, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #EF4444, #B91C1C); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-hand-holding-dollar"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#450a0a; letter-spacing: -0.5px;">Loan Prepayment Penalty Estimator</h4>
                    <p class="text-muted small mb-0">Uncover the hidden costs of closing your loan early. Model tiered percentages or interest-based fees.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Current Principal Balance</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="pen-balance" class="form-control border-0 bg-light fw-bold" value="150000" step="1000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Interest Rate (%)</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border overflow-hidden">
                            <input type="number" id="pen-rate" class="form-control border-0 bg-light fw-bold" value="5.5" step="0.1">
                            <span class="input-group-text border-0 bg-light opacity-50">%</span>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-red-50 border border-red-100 shadow-sm">
                            <h6 class="fw-bold small mb-4 uppercase text-red-900 opacity-70">Penalty Calculation Logic</h6>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label class="form-label-custom text-red-900">Penalty Type</label>
                                    <select id="pen-type" class="form-select border-0 bg-white rounded-3 fw-bold">
                                        <option value="percent">Flat Percentage (%)</option>
                                        <option value="interest">Months of Interest</option>
                                        <option value="ird">Interest Rate Differential (IRD)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom text-red-900" id="pen-val-label">Penalty Percentage (%)</label>
                                    <input type="number" id="pen-val" class="form-control border-0 bg-white rounded-3 fw-bold" value="2">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom text-red-900">Minimum Fee ($)</label>
                                    <div class="input-group bg-white rounded-3 border">
                                        <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                        <input type="number" id="pen-min" class="form-control border-0 bg-white fw-bold" value="500">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="percent" data-v="2">Standard (2%)</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="interest" data-v="6">6 Mo. Interest</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="percent" data-v="5">High Exit (5%)</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 0; --tool-color: #EF4444; --tool-bg: rgba(239, 68, 68, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">TOTAL PAYOFF PENALTY</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-penalty">$0</div>
                <div class="badge bg-red-soft text-red px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-warn">Estimated Early Exit Cost</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">PAYOFF SETTLEMENT</th>
                                        <th class="text-muted small fw-bold py-3 text-end">TOTALS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Outstanding Principal</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-principal">$0</td>
                                    </tr>
                                    <tr class="text-red">
                                        <td class="py-3 fw-bold">Prepayment Penalty Fee</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-fee">+$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">TOTAL REQUIRED TO CLOSE</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-total">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <div class="p-3 rounded-4 bg-red-50 border border-red-100 mb-4">
                                <h6 class="fw-bold small mb-2 uppercase opacity-50">Impact Score</h6>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-bold">Fee vs Principal</span>
                                    <span class="small fw-bold" id="out-ratio">0%</span>
                                </div>
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 12px; background: #f1f5f9;">
                                    <div id="bar-penalty" class="progress-bar bg-red" style="width: 2%"></div>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-red rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Penalty Analysis
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
    const balanceE = $('pen-balance'), rateE = $('pen-rate'), typeE = $('pen-type'),
          valE = $('pen-val'), minE = $('pen-min');

    function calculate(){
        let bal = parseFloat(balanceE.value) || 0;
        let rate = (parseFloat(rateE.value) || 0) / 100;
        let type = typeE.value;
        let val = parseFloat(valE.value) || 0;
        let minFee = parseFloat(minE.value) || 0;

        let penalty = 0;
        if(type === 'percent') {
            $('pen-val-label').textContent = 'Penalty Percentage (%)';
            penalty = bal * (val / 100);
        } else if(type === 'interest') {
            $('pen-val-label').textContent = 'Months of Interest';
            penalty = (bal * (rate / 12)) * val;
        } else {
            // Simple IRD modeling: Assume a 2% spread if not specified
            $('pen-val-label').textContent = 'Spread / Months';
            penalty = (bal * (0.02 / 12)) * val; 
        }

        penalty = Math.max(penalty, minFee);
        let total = bal + penalty;

        // Update UI
        $('out-penalty').textContent = '$' + Math.round(penalty).toLocaleString();
        $('tbl-principal').textContent = '$' + Math.round(bal).toLocaleString();
        $('tbl-fee').textContent = '+$' + Math.round(penalty).toLocaleString();
        $('tbl-total').textContent = '$' + Math.round(total).toLocaleString();

        let ratio = bal > 0 ? (penalty / bal) * 100 : 0;
        $('out-ratio').textContent = ratio.toFixed(1) + '%';
        $('bar-penalty').style.width = Math.min(100, ratio * 5) + '%'; // Scaled for visibility
    }

    [balanceE, rateE, typeE, valE, minE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            typeE.value = btn.dataset.t;
            valE.value = btn.dataset.v;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        balanceE.value = 150000; rateE.value = 5.5; typeE.value = 'percent';
        valE.value = 2; minE.value = 500;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Loan Prepayment Penalty Estimate\nPenalty Fee: ${$('out-penalty').textContent}\nTotal to Close: ${$('tbl-total').textContent}\nGenerated by ToolsHub Finance`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.penalty-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#450a0a;opacity:.7;margin-bottom:8px;display:block}
.penalty-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-red { background: #EF4444; color: #fff; transition: all .3s; }
.btn-red:hover { background: #B91C1C; color: #fff; transform: translateY(-2px); }
.text-red { color: #EF4444; }
.text-red-900 { color: #450a0a; }
.bg-red-soft { background: #FEF2F2; }
.bg-red-50 { background-color: #fffaf5; }
.bg-red { background-color: #EF4444 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\loan-prepayment-penalty-calculator.blade.php ENDPATH**/ ?>