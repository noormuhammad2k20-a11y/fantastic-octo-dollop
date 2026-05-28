<div class="row g-4 after-tax-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(0,0,0,.04);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #0891b2, #155e75); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#083344; letter-spacing: -0.5px;">Spendable Income Planner</h4>
                    <p class="text-muted small mb-0">Model your true net wealth by accounting for retirement, health costs, and tax credits.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Annual Gross Salary</label>
                        <div class="input-group input-group-lg bg-light rounded-3 border">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="gross-salary" class="form-control border-0 bg-light fw-bold" value="85000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Annual Bonus</label>
                        <div class="input-group input-group-lg bg-light rounded-3 border">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="bonus-salary" class="form-control border-0 bg-light fw-bold" value="5000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Other Annual Income</label>
                        <div class="input-group input-group-lg bg-light rounded-3 border">
                            <span class="input-group-text border-0 bg-light opacity-50">$</span>
                            <input type="number" id="other-income" class="form-control border-0 bg-light fw-bold" value="0">
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-light">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Tax & Savings Rates</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Combined Tax Rate (%)</label>
                                    <input type="number" id="tax-rate" class="form-control border-0 bg-white rounded-3 fw-bold" value="22">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Retirement Contribution (%)</label>
                                    <input type="number" id="retire-rate" class="form-control border-0 bg-white rounded-3 fw-bold" value="10">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-light">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Fixed Obligations & Credits</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Health Premiums (Yr)</label>
                                    <input type="number" id="health-cost" class="form-control border-0 bg-white rounded-3 fw-bold" value="2400">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Annual Tax Credits</label>
                                    <input type="number" id="tax-credits" class="form-control border-0 bg-white rounded-3 fw-bold" value="2000">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex gap-2">
                    <button class="btn btn-outline-info rounded-pill px-4 fw-bold btn-sm quick-load" data-g="60000" data-t="15" data-r="5">Balanced Entry</button>
                    <button class="btn btn-outline-info rounded-pill px-4 fw-bold btn-sm quick-load" data-g="120000" data-t="28" data-r="15">High Contributor</button>
                    <button class="btn btn-outline-danger rounded-pill px-4 fw-bold btn-sm quick-load" data-g="250000" data-t="37" data-r="0">Max Cash Flow</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 190; --tool-color: #0891b2; --tool-bg: rgba(8,145,178,.04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">NET DISPOSABLE INCOME</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-net">$0</div>
                <div class="d-flex justify-content-center gap-3">
                    <div class="text-center">
                        <div class="small fw-bold text-muted opacity-60">MONTHLY</div>
                        <div class="h5 fw-bold mb-0" id="out-monthly">$0</div>
                    </div>
                    <div class="vr mx-2 opacity-20"></div>
                    <div class="text-center">
                        <div class="small fw-bold text-muted opacity-60">DAILY</div>
                        <div class="h5 fw-bold mb-0" id="out-daily">$0</div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4 align-items-center">
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="stat-card p-3 rounded-4 border text-center">
                                    <div class="small fw-bold text-muted mb-1">TOTAL TAXES</div>
                                    <div class="h5 fw-bold mb-0 text-danger" id="out-total-tax">$0</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card p-3 rounded-4 border text-center">
                                    <div class="small fw-bold text-muted mb-1">RETIREMENT SAVED</div>
                                    <div class="h5 fw-bold mb-0 text-primary" id="out-total-saved">$0</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card p-3 rounded-4 border text-center">
                                    <div class="small fw-bold text-muted mb-1">KEEP PERCENTAGE</div>
                                    <div class="h5 fw-bold mb-0 text-success" id="out-keep-pct">0%</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 class="fw-bold small mb-2 text-muted uppercase">Spending Capacity Visualization</h6>
                            <div class="progress rounded-pill overflow-hidden shadow-sm" style="height: 30px; background: #f1f5f9;">
                                <div id="bar-net" class="progress-bar bg-cyan" style="width: 60%">Disposable</div>
                                <div id="bar-tax" class="progress-bar bg-danger" style="width: 25%">Taxes</div>
                                <div id="bar-saved" class="progress-bar bg-primary" style="width: 15%">Saved</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 border-start d-flex flex-column gap-2">
                        <button class="btn d-block mx-auto btn-dark rounded-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-analysis" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-copy me-2"></i>Copy Income Analysis
                        </button>
                        <button class="btn d-block mx-auto btn-outline-dark rounded-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="reset-planner" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-rotate-left me-2"></i>Reset Planner
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const grossE = $('gross-salary'), bonusE = $('bonus-salary'), otherE = $('other-income'),
          taxE = $('tax-rate'), retireE = $('retire-rate'), healthE = $('health-cost'), creditE = $('tax-credits');

    function calculate(){
        let gross = parseFloat(grossE.value) || 0;
        let bonus = parseFloat(bonusE.value) || 0;
        let other = parseFloat(otherE.value) || 0;
        let totalIncome = gross + bonus + other;

        let taxRate = (parseFloat(taxE.value) || 0) / 100;
        let retireRate = (parseFloat(retireE.value) || 0) / 100;
        let health = parseFloat(healthE.value) || 0;
        let credits = parseFloat(creditE.value) || 0;

        // Taxes are calculated on gross + bonus usually
        let taxablePortion = Math.max(0, gross + bonus);
        let taxBill = Math.max(0, (taxablePortion * taxRate) - credits);
        
        let retirementSaved = gross * retireRate;
        let net = totalIncome - taxBill - retirementSaved - health;

        // Update UI
        $('out-net').textContent = '$' + Math.round(net).toLocaleString();
        $('out-monthly').textContent = '$' + Math.round(net / 12).toLocaleString();
        $('out-daily').textContent = '$' + Math.round(net / 365).toLocaleString();
        
        $('out-total-tax').textContent = '$' + Math.round(taxBill).toLocaleString();
        $('out-total-saved').textContent = '$' + Math.round(retirementSaved).toLocaleString();
        
        let keepPct = totalIncome > 0 ? (net / totalIncome) * 100 : 0;
        $('out-keep-pct').textContent = Math.round(keepPct) + '%';

        // Update Bars
        if(totalIncome > 0) {
            let taxPct = (taxBill / totalIncome) * 100;
            let savePct = (retirementSaved / totalIncome) * 100;
            let netPct = (net / totalIncome) * 100;

            $('bar-net').style.width = netPct + '%';
            $('bar-tax').style.width = taxPct + '%';
            $('bar-saved').style.width = savePct + '%';
            
            $('bar-net').textContent = Math.round(netPct) + '%';
            $('bar-tax').textContent = Math.round(taxPct) + '%';
            $('bar-saved').textContent = Math.round(savePct) + '%';
        }
    }

    [grossE, bonusE, otherE, taxE, retireE, healthE, creditE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            grossE.value = btn.dataset.g;
            taxE.value = btn.dataset.t;
            retireE.value = btn.dataset.r;
            calculate();
        });
    });

    $('reset-planner').addEventListener('click', () => {
        grossE.value = 85000; bonusE.value = 5000; otherE.value = 0;
        taxE.value = 22; retireE.value = 10; healthE.value = 2400; creditE.value = 2000;
        calculate();
    });

    $('copy-analysis').addEventListener('click', function(){
        const txt = `Spendable Income Analysis\nNet Total: ${$('out-net').textContent}\nMonthly: ${$('out-monthly').textContent}\nRetirement Saved: ${$('out-total-saved').textContent}\nGenerated by ToolsHub Wealth`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Analysis Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.after-tax-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#083344;opacity:.7;margin-bottom:8px;display:block}
.output-card-themed { border-radius: 35px; overflow: hidden; border: 1px solid rgba(0,0,0,.04); }
.bg-cyan { background-color: #0891b2 !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.stat-card { background: #fff; transition: all 0.3s ease; }
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 4px 20px rgba(0,0,0,.04); }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\after-tax-income-calculator.blade.php ENDPATH**/ ?>