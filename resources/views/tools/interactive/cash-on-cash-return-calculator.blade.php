<div class="row g-4 coc-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(0,0,0,.04);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #eab308, #a16207); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-building-circle-check"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#422006; letter-spacing: -0.5px;">Cash-on-Cash Return Calculator</h4>
                    <p class="text-muted small mb-0">Deep-dive into your real estate profitability with comprehensive expense tracking.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Column 1: Investment & Income --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Acquisition & Income</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Total Out-of-Pocket Cash</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="coc-invested" class="form-control border-0 bg-white fw-bold" value="65000">
                                </div>
                                <div class="small text-muted mt-1">(Down payment + closing + rehab)</div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Monthly Rental Income</label>
                                <div class="input-group input-group-lg bg-white rounded-3 border">
                                    <span class="input-group-text border-0 bg-white opacity-40">$</span>
                                    <input type="number" id="coc-rent" class="form-control border-0 bg-white fw-bold" value="2500">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Column 2: Recurring Expenses --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Monthly Expenses</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label-custom">Mortgage (P&I)</label>
                                    <input type="number" id="coc-mortgage" class="form-control border-0 bg-light rounded-3 fw-bold" value="1200">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Management (%)</label>
                                    <input type="number" id="coc-mgmt" class="form-control border-0 bg-light rounded-3 fw-bold" value="10">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Property Tax (Yr)</label>
                                    <input type="number" id="coc-tax" class="form-control border-0 bg-light rounded-3 fw-bold" value="3000">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Insurance (Yr)</label>
                                    <input type="number" id="coc-ins" class="form-control border-0 bg-light rounded-3 fw-bold" value="1200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-preset" data-i="50000" data-r="1800" data-m="900">BRRRR Success</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-preset" data-i="150000" data-r="4500" data-m="2500">Turnkey Multi</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-preset" data-i="80000" data-r="1500" data-m="1100">C-Class Rental</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 45; --tool-color: #eab308; --tool-bg: rgba(254,252,232,.5);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">ANNUAL CASH-ON-CASH RETURN</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-coc">0%</div>
                <div class="badge bg-white text-dark rounded-pill px-4 py-2 fw-bold shadow-sm" id="out-verdict">MODERATE RETURN</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Pro-Forma Column --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4" style="background: #fffbeb; border: 1px solid #fef08a;">
                            <h6 class="fw-bold mb-3">Annual Pro-Forma</h6>
                            <div class="vstack gap-3">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small fw-bold uppercase">Gross Annual Income</span>
                                    <span class="fw-bold" id="out-gross-annual">$0</span>
                                </div>
                                <div class="d-flex justify-content-between text-danger">
                                    <span class="text-muted small fw-bold uppercase">Operating Expenses</span>
                                    <span class="fw-bold" id="out-opex">-$0</span>
                                </div>
                                <div class="d-flex justify-content-between text-danger">
                                    <span class="text-muted small fw-bold uppercase">Debt Service</span>
                                    <span class="fw-bold" id="out-debt">-$0</span>
                                </div>
                                <div class="d-flex justify-content-between pt-2 border-top border-warning">
                                    <span class="fw-black uppercase">NET CASH FLOW</span>
                                    <span class="fw-black h5 mb-0" id="out-net-annual">$0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Metrics & Actions --}}
                    <div class="col-md-6">
                        <div class="row g-3 h-100">
                            <div class="col-6">
                                <div class="stat-card p-3 rounded-4 border text-center h-100 d-flex flex-column justify-content-center">
                                    <div class="small fw-bold text-muted mb-1">CAP RATE (EST)</div>
                                    <div class="h4 fw-bold mb-0 text-dark" id="out-cap">0%</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-card p-3 rounded-4 border text-center h-100 d-flex flex-column justify-content-center">
                                    <div class="small fw-bold text-muted mb-1">MONTHLY FLOW</div>
                                    <div class="h4 fw-bold mb-0 text-success" id="out-net-monthly">$0</div>
                                </div>
                            </div>
                            <div class="col-12 mt-auto">
                                <button class="btn d-block mx-auto btn-gold-dark rounded-4 fw-bold text-white mb-2 shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-contract me-2"></i>Copy Investment Summary
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Calculator
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
    const investedE = $('coc-invested'), rentE = $('coc-rent'), mortgageE = $('coc-mortgage'),
          mgmtE = $('coc-mgmt'), taxE = $('coc-tax'), insE = $('coc-ins');

    function calculate(){
        let invested = parseFloat(investedE.value) || 0;
        let monthlyRent = parseFloat(rentE.value) || 0;
        let mortgage = parseFloat(mortgageE.value) || 0;
        let mgmtRate = (parseFloat(mgmtE.value) || 0) / 100;
        let annualTax = parseFloat(taxE.value) || 0;
        let annualIns = parseFloat(insE.value) || 0;

        let annualGross = monthlyRent * 12;
        let annualMgmt = annualGross * mgmtRate;
        let annualOpex = annualMgmt + annualTax + annualIns;
        let annualDebt = mortgage * 12;
        let netAnnual = annualGross - annualOpex - annualDebt;
        
        let coc = invested > 0 ? (netAnnual / invested) * 100 : 0;
        let capRate = invested > 0 ? ((annualGross - annualOpex) / invested) * 100 : 0;

        // Update UI
        $('out-coc').textContent = coc.toFixed(2) + '%';
        $('out-gross-annual').textContent = '$' + Math.round(annualGross).toLocaleString();
        $('out-opex').textContent = '-$' + Math.round(annualOpex).toLocaleString();
        $('out-debt').textContent = '-$' + Math.round(annualDebt).toLocaleString();
        $('out-net-annual').textContent = '$' + Math.round(netAnnual).toLocaleString();
        $('out-net-monthly').textContent = '$' + Math.round(netAnnual / 12).toLocaleString();
        $('out-cap').textContent = capRate.toFixed(2) + '%';

        const verdict = $('out-verdict');
        if(coc >= 12) {
            verdict.textContent = 'EXCELLENT RETURN';
            verdict.style.color = '#059669';
        } else if(coc >= 8) {
            verdict.textContent = 'STRONG RETURN';
            verdict.style.color = '#0284c7';
        } else if(coc >= 4) {
            verdict.textContent = 'MODERATE RETURN';
            verdict.style.color = '#d97706';
        } else {
            verdict.textContent = 'LOW PERFORMANCE';
            verdict.style.color = '#dc2626';
        }
    }

    [investedE, rentE, mortgageE, mgmtE, taxE, insE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-preset').forEach(btn => {
        btn.addEventListener('click', () => {
            investedE.value = btn.dataset.i;
            rentE.value = btn.dataset.r;
            mortgageE.value = btn.dataset.m;
            calculate();
        });
    });

    $('reset-calc').addEventListener('click', () => {
        investedE.value = 65000; rentE.value = 2500; mortgageE.value = 1200;
        mgmtE.value = 10; taxE.value = 3000; insE.value = 1200;
        calculate();
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `CoC Return Analysis\nReturn: ${$('out-coc').textContent}\nNet Annual: ${$('out-net-annual').textContent}\nCap Rate: ${$('out-cap').textContent}\nGenerated by ToolsHub Investor`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    calculate();
});
</script>

<style>
.coc-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#422006;opacity:.7;margin-bottom:8px;display:block}
.coc-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-gold-dark { background: #eab308; transition: all .3s; }
.btn-gold-dark:hover { background: #422006; transform: translateY(-2px); }
.fw-900 { font-weight: 900; }
.fw-black { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.stat-card { background: #fff; transition: all 0.3s ease; }
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 4px 20px rgba(0,0,0,.04); }
.uppercase { text-transform: uppercase; }
</style>

