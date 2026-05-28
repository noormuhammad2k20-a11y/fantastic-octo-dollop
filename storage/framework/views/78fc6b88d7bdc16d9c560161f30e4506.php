<div class="row g-4 planner-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(16, 185, 129, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #10B981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-road"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Debt Freedom Roadmap Planner</h4>
                    <p class="text-muted small mb-0">Reverse-engineer your debt-free date. Calculate exact monthly payments required to eliminate credit card or loan balances within your target timeline.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Debt Payload</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Total Debt Balance ($)</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="p-bal" class="form-control border-0 bg-white fw-bold text-danger" value="10000">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Avg. Interest Rate (APR %)</label>
                                    <input type="number" id="p-apr" class="form-control border-0 bg-white rounded-3 fw-bold" value="22.5">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-green">
                            <h6 class="fw-bold small mb-3 uppercase text-green opacity-70">Target Horizon</h6>
                            <div class="mb-5 text-center">
                                <div class="display-5 fw-900 text-green mb-2" id="p-mo-display">24 Months</div>
                                <input type="range" id="p-mo" class="form-range color-green" min="1" max="120" value="24" step="1">
                                <div class="d-flex justify-content-between px-1 small text-muted">
                                    <span>Immediate</span>
                                    <span>10 Years</span>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">One-time Windfall (Tax Refund, etc)</label>
                                <div class="input-group bg-light rounded-3 border">
                                    <span class="input-group-text border-0 bg-light opacity-40">+$</span>
                                    <input type="number" id="p-windfall" class="form-control border-0 bg-light fw-bold" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-m="12">12 Month Sprint</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-m="36">3 Year Marathon</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-m="60">5 Year Recovery</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 145; --tool-color: #10B981; --tool-bg: rgba(16, 185, 129, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">REQUIRED MONTHLY PAYMENT</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-pmt">$0.00</div>
                <div class="badge bg-green-soft text-green px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">DOABLE PACE</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">REPAYMENT ANATOMY</th>
                                        <th class="text-muted small fw-bold py-3 text-end">TOTALS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Interest Burnt</td>
                                        <td class="py-3 text-end text-danger fw-bold" id="tbl-total-int">$0</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 fw-bold">Total Principal Repaid</td>
                                        <td class="py-3 text-end fw-bold" id="tbl-total-prin">$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black uppercase">Aggregate Cost of Debt</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-total-cost">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold mb-3 uppercase small opacity-50">Efficiency Index</h6>
                            <div class="mb-4">
                                <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 12px; background: #f1f5f9;">
                                    <div id="bar-prin" class="progress-bar bg-green" style="width: 80%"></div>
                                    <div id="bar-int" class="progress-bar bg-danger opacity-50" style="width: 20%"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-1 px-1 small fw-bold">
                                    <span class="text-green">Principal</span>
                                    <span class="text-danger">Interest</span>
                                </div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-green rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Copy Repayment Roadmap
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
    const balE = $('p-bal'), aprE = $('p-apr'), moE = $('p-mo'), windE = $('p-windfall');

    function calculate(){
        let bal = parseFloat(balE.value) || 0;
        let apr = (parseFloat(aprE.value) || 0) / 100 / 12;
        let months = parseInt(moE.value) || 1;
        let windfall = parseFloat(windE.value) || 0;

        $('p-mo-display').textContent = months + ' Months';

        let netBal = Math.max(0, bal - windfall);
        
        let pmt = 0;
        if(apr === 0) {
            pmt = netBal / months;
        } else {
            pmt = (netBal * apr) / (1 - Math.pow(1 + apr, -months));
        }

        let totalRepaid = pmt * months;
        let totalInt = totalRepaid - netBal;

        // Update UI
        $('out-pmt').textContent = '$' + pmt.toFixed(2);
        $('tbl-total-int').textContent = '$' + Math.round(totalInt).toLocaleString();
        $('tbl-total-prin').textContent = '$' + Math.round(netBal).toLocaleString();
        $('tbl-total-cost').textContent = '$' + Math.round(totalRepaid + windfall).toLocaleString();

        let prinPct = totalRepaid > 0 ? (netBal / totalRepaid) * 100 : 100;
        $('bar-prin').style.width = prinPct + '%';
        $('bar-int').style.width = (100 - prinPct) + '%';

        let status = 'DOABLE PACE'; let col = '#10b981';
        if(months <= 6) { status = 'AGGRESSIVE SPRINT'; col = '#ef4444'; }
        else if(months <= 12) { status = 'STEADY PUSH'; col = '#f59e0b'; }
        
        $('out-status').textContent = status;
        $('out-status').style.color = col;
    }

    [balE, aprE, moE, windE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            moE.value = btn.dataset.m;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        balE.value = 10000; aprE.value = 22.5; moE.value = 24; windE.value = 0;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Debt Repayment Roadmap\nTimeline: ${$('p-mo-display').textContent}\nMonthly Payment: ${$('out-pmt').textContent}\nTotal Interest: ${$('tbl-total-int').textContent}\nGenerated by ToolsHub Roadmap Pro`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Roadmap Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.planner-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.planner-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-green { background: #10B981; color: #fff; transition: all .3s; }
.btn-green:hover { background: #059669; color: #fff; transform: translateY(-2px); }
.text-green { color: #10B981; }
.text-green-900 { color: #064e3b; }
.bg-green-soft { background: #F0FDF4; }
.bg-green { background-color: #10B981 !important; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.color-green::-webkit-slider-thumb { background: #10B981; }
.color-green::-moz-range-thumb { background: #10B981; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\credit-payment-planner.blade.php ENDPATH**/ ?>