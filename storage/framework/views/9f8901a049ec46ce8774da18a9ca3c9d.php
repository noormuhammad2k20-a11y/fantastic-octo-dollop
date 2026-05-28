<div class="row g-4 paycheck-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(0,0,0,.04);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #10b981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-money-check-dollar"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Precision Paycheck Estimator</h4>
                    <p class="text-muted small mb-0">Decode your earnings with detailed FICA, Federal, and State tax projections.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label-custom">Gross Income (Per Period)</label>
                            <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border">
                                <span class="input-group-text border-0 ps-3 bg-light opacity-50">$</span>
                                <input type="number" id="gross-pay" class="form-control border-0 bg-light fw-bold" value="3500" step="100">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-custom">Pay Frequency</label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="freq" id="f-weekly" value="52">
                                    <label class="btn btn-outline-emerald w-100 rounded-3 py-2" for="f-weekly">Weekly</label>
                                </div>
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="freq" id="f-biweekly" value="26" checked>
                                    <label class="btn btn-outline-emerald w-100 rounded-3 py-2" for="f-biweekly">Bi-Weekly</label>
                                </div>
                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="freq" id="f-monthly" value="12">
                                    <label class="btn btn-outline-emerald w-100 rounded-3 py-2" for="f-monthly">Monthly</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label-custom">Filing Status</label>
                                <select id="filing-status" class="form-select border-0 bg-light rounded-3 fw-bold">
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="head">HOH</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">FICA (SS+Med)</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="fica-toggle" checked>
                                    <label class="form-check-label small fw-bold text-muted">Auto (7.65%)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label-custom">Federal Tax (%)</label>
                                <input type="number" id="fed-rate" class="form-control border-0 bg-light rounded-3 fw-bold" value="12" step="0.5">
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">State Tax (%)</label>
                                <input type="number" id="state-rate" class="form-control border-0 bg-light rounded-3 fw-bold" value="4" step="0.5">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="form-label-custom">Pre-Tax Deductions (401k/HSA)</label>
                            <div class="input-group bg-light rounded-3 border">
                                <span class="input-group-text border-0 bg-light opacity-50">$</span>
                                <input type="number" id="pre-tax" class="form-control border-0 bg-light fw-bold" value="250">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="form-label-custom">Post-Tax Deductions (Insurance/Child Support)</label>
                            <div class="input-group bg-light rounded-3 border">
                                <span class="input-group-text border-0 bg-light opacity-50">$</span>
                                <input type="number" id="post-tax" class="form-control border-0 bg-light fw-bold" value="100">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-fill" data-g="2500" data-f="10" data-s="3" data-pr="150">Junior Role</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-fill" data-g="5500" data-f="18" data-s="5" data-pr="450">Senior Role</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-fill" data-g="8500" data-f="24" data-s="7" data-pr="800">Executive</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 150; --tool-color: #059669; --tool-bg: rgba(16,185,129,.04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">YOUR NET TAKE-HOME PAY</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-net">$0</div>
                <div class="d-flex justify-content-center gap-2">
                    <span class="badge bg-emerald-soft text-emerald px-3 py-2 rounded-pill fw-bold" id="out-freq-badge">Bi-Weekly Payday</span>
                    <span class="badge bg-emerald-soft text-emerald px-3 py-2 rounded-pill fw-bold" id="out-annual-badge">$0 / yr</span>
                </div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-bold py-3">DESCRIPTION</th>
                                        <th class="text-muted small fw-bold py-3 text-end">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 fw-bold">Gross Earnings</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-gross">$0</td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td class="py-3 fw-bold">Federal Income Tax</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-fed">-$0</td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td class="py-3 fw-bold">FICA (SS & Medicare)</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-fica">-$0</td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td class="py-3 fw-bold">State Tax</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-state">-$0</td>
                                    </tr>
                                    <tr class="text-primary">
                                        <td class="py-3 fw-bold">Pre-Tax Deductions</td>
                                        <td class="py-3 fw-bold text-end" id="tbl-pre">-$0</td>
                                    </tr>
                                    <tr class="text-secondary">
                                        <td class="py-3 fw-bold border-bottom">Post-Tax Deductions</td>
                                        <td class="py-3 fw-bold text-end border-bottom" id="tbl-post">-$0</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="py-3 fw-black h5 mb-0">TOTAL TAKE-HOME</td>
                                        <td class="py-3 fw-black text-end h5 mb-0" id="tbl-net">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 h-100" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <h6 class="fw-bold mb-4">Allocation Summary</h6>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="small fw-bold text-muted">Tax Efficiency</span>
                                    <span class="small fw-bold text-dark" id="out-efficiency">0%</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 10px;">
                                    <div id="bar-net" class="progress-bar bg-emerald" style="width: 70%"></div>
                                </div>
                                <div class="small text-muted mt-2">Percentage of gross pay remaining after taxes.</div>
                            </div>

                            <div class="mb-0 pt-3 border-top">
                                <div class="small fw-bold text-muted mb-2">QUICK ACTIONS</div>
                                <div class="vstack gap-2">
                                    <button class="btn btn-dark w-100 rounded-3 py-2 fw-bold" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                        <i class="fas fa-copy me-2"></i>Copy Breakdown
                                    </button>
                                    <button class="btn btn-outline-dark w-100 rounded-3 py-2 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const grossE = $('gross-pay'), preE = $('pre-tax'), postE = $('post-tax'), 
          fedE = $('fed-rate'), stateE = $('state-rate'), ficaE = $('fica-toggle');

    function calculate(){
        let gross = parseFloat(grossE.value) || 0;
        let pre = parseFloat(preE.value) || 0;
        let post = parseFloat(postE.value) || 0;
        let fedRate = (parseFloat(fedE.value) || 0) / 100;
        let stateRate = (parseFloat(stateE.value) || 0) / 100;
        let ppy = parseInt(document.querySelector('input[name="freq"]:checked').value);
        
        let ficaRate = ficaE.checked ? 0.0765 : 0;

        const taxable = Math.max(0, gross - pre);
        const fedTax = taxable * fedRate;
        const ficaTax = gross * ficaRate; // FICA is on gross
        const stateTax = taxable * stateRate;
        
        const totalDeductions = fedTax + ficaTax + stateTax + pre + post;
        const net = Math.max(0, gross - totalDeductions);
        const annualNet = net * ppy;
        const efficiency = gross > 0 ? (net / gross) * 100 : 0;

        // Update UI
        $('out-net').textContent = '$' + Math.round(net).toLocaleString();
        $('out-annual-badge').textContent = '$' + Math.round(annualNet).toLocaleString() + ' / yr';
        $('out-freq-badge').textContent = ppy === 52 ? 'Weekly Payday' : (ppy === 26 ? 'Bi-Weekly Payday' : 'Monthly Payday');
        
        $('tbl-gross').textContent = '$' + Math.round(gross).toLocaleString();
        $('tbl-fed').textContent = '-$' + Math.round(fedTax).toLocaleString();
        $('tbl-fica').textContent = '-$' + Math.round(ficaTax).toLocaleString();
        $('tbl-state').textContent = '-$' + Math.round(stateTax).toLocaleString();
        $('tbl-pre').textContent = '-$' + Math.round(pre).toLocaleString();
        $('tbl-post').textContent = '-$' + Math.round(post).toLocaleString();
        $('tbl-net').textContent = '$' + Math.round(net).toLocaleString();

        $('out-efficiency').textContent = Math.round(efficiency) + '%';
        $('bar-net').style.width = efficiency + '%';
    }

    [grossE, preE, postE, fedE, stateE, ficaE].forEach(e => e.addEventListener('input', calculate));
    document.querySelectorAll('input[name="freq"]').forEach(e => e.addEventListener('change', calculate));

    document.querySelectorAll('.quick-fill').forEach(btn => {
        btn.addEventListener('click', () => {
            grossE.value = btn.dataset.g;
            fedE.value = btn.dataset.f;
            stateE.value = btn.dataset.s;
            preE.value = btn.dataset.pr;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        grossE.value = 3500; preE.value = 250; postE.value = 100;
        fedE.value = 12; stateE.value = 4; ficaE.checked = true;
        document.getElementById('f-biweekly').checked = true;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Paycheck Estimate\nGross: ${$('tbl-gross').textContent}\nNet: ${$('out-net').textContent}\nEfficiency: ${$('out-efficiency').textContent}\nGenerated by ToolsHub Payroll`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.paycheck-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.paycheck-rebuilt .calculator-card { transition: all 0.3s ease; }
.paycheck-rebuilt .btn-outline-emerald { border: 2px solid #059669; color: #059669; font-weight: 700; font-size: 0.85rem; }
.paycheck-rebuilt .btn-check:checked + .btn-outline-emerald { background: #059669; color: #fff; }
.bg-emerald-soft { background: #ecfdf5; }
.text-emerald { color: #059669; }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.bg-light { background-color: #f8fafc !important; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\paycheck-tax-estimator.blade.php ENDPATH**/ ?>