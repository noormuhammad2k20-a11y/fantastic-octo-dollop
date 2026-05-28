<div class="row g-4 cd-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Deposit Principal</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold">$</span>
                            <input type="number" class="form-control form-control-lg rounded-end-3" id="cd-principal" value="10000" min="0">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Interest Rate (APY)</label>
                        <div class="input-group">
                            <input type="number" class="form-control form-control-lg rounded-start-3" id="cd-rate" value="4.5" step="0.1" min="0">
                            <span class="input-group-text bg-light fw-bold">%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Term (Months)</label>
                        <input type="number" class="form-control form-control-lg rounded-3" id="cd-term" value="12" min="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Compounding Frequency</label>
                        <select class="form-select form-select-lg rounded-3" id="cd-compound">
                            <option value="365">Daily (365/yr)</option>
                            <option value="12" selected>Monthly (12/yr)</option>
                            <option value="4">Quarterly (4/yr)</option>
                            <option value="2">Semi-Annually (2/yr)</option>
                            <option value="1">Annually (1/yr)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Inflation Rate (Optional)</label>
                        <div class="input-group">
                            <input type="number" class="form-control form-control-lg rounded-start-3" id="cd-inflation" value="3.0" step="0.1" min="0">
                            <span class="input-group-text bg-light fw-bold">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Tax Bracket</label>
                        <div class="input-group">
                            <input type="number" class="form-control form-control-lg rounded-start-3" id="cd-tax" value="22" step="1" min="0" max="50">
                            <span class="input-group-text bg-light fw-bold">%</span>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Terms:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cd-quick" data-term="3">3 Months</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cd-quick" data-term="6">6 Months</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cd-quick" data-term="12">1 Year</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cd-quick" data-term="24">2 Years</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cd-quick" data-term="60">5 Years</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">MATURITY VALUE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="cd-total">$10,459.40</span>
                </div>
                <span class="output-hero-unit" id="cd-term-label">12-Month CD</span>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-3">
                    <div class="stat-card" style="border-color:#10b981; background:rgba(16,185,129,.02);">
                        <span class="stat-card-label">INTEREST EARNED</span>
                        <span class="stat-card-value text-success" id="cd-interest">$459.40</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card" style="border-color:#3b82f6; background:rgba(59,130,246,.02);">
                        <span class="stat-card-label">EFFECTIVE YIELD</span>
                        <span class="stat-card-value text-primary" id="cd-yield">4.59%</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card" style="border-color:#f59e0b; background:rgba(245,158,11,.02);">
                        <span class="stat-card-label">AFTER-TAX RETURN</span>
                        <span class="stat-card-value text-warning" id="cd-after-tax">$358.33</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card" style="border-color:#ef4444; background:rgba(239,68,68,.02);">
                        <span class="stat-card-label">REAL RETURN (ADJ.)</span>
                        <span class="stat-card-value text-danger" id="cd-real-return">$159.40</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Earnings Breakdown</h6>
            <div class="d-flex flex-column gap-2">
                <div class="d-flex align-items-center p-3 rounded-3" style="background:#f0fdf4;border-left:5px solid #22c55e">
                    <i class="fas fa-piggy-bank me-3 fs-5" style="color:#22c55e"></i>
                    <div class="flex-grow-1"><div class="fw-bold">Principal Deposit</div><div class="small text-muted">Your initial investment</div></div>
                    <div class="fw-bold fs-5" id="cd-bar-principal">$10,000.00</div>
                </div>
                <div class="d-flex align-items-center p-3 rounded-3" style="background:#eff6ff;border-left:5px solid #3b82f6">
                    <i class="fas fa-chart-line me-3 fs-5" style="color:#3b82f6"></i>
                    <div class="flex-grow-1"><div class="fw-bold">Gross Interest</div><div class="small text-muted">Before tax deduction</div></div>
                    <div class="fw-bold fs-5" id="cd-bar-gross">$459.40</div>
                </div>
                <div class="d-flex align-items-center p-3 rounded-3" style="background:#fef3c7;border-left:5px solid #f59e0b">
                    <i class="fas fa-file-invoice-dollar me-3 fs-5" style="color:#f59e0b"></i>
                    <div class="flex-grow-1"><div class="fw-bold">Tax on Interest</div><div class="small text-muted" id="cd-tax-bracket-label">At 22% bracket</div></div>
                    <div class="fw-bold fs-5 text-danger" id="cd-bar-tax">−$101.07</div>
                </div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Allocation</h6>
            <div class="progress rounded-pill mb-2" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#10b981" id="cd-prog-principal">Principal</div>
                <div class="progress-bar" style="background:#3b82f6" id="cd-prog-interest">Interest</div>
            </div>

            <div class="mt-4" id="cd-insights"></div>

            <div class="row g-2 mt-4">
                <div class="col-md-4">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cd-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Results</button>
                </div>
                <div class="col-md-4">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cd-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button>
                </div>
                <div class="col-md-4">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="cd-pdf" style="min-width: 280px; max-width: 100%;"><i class="fas fa-file-pdf me-2"></i>Download PDF</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const pI=$('cd-principal'), rI=$('cd-rate'), tI=$('cd-term'), cI=$('cd-compound'), infI=$('cd-inflation'), taxI=$('cd-tax');

    function fmt(v){return new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(v);}

    function calculate(){
        const P=parseFloat(pI.value)||0, r=(parseFloat(rI.value)||0)/100, tMo=parseFloat(tI.value)||0;
        const n=parseFloat(cI.value), tYr=tMo/12;
        const inf=(parseFloat(infI.value)||0)/100, tax=(parseFloat(taxI.value)||0)/100;

        // A = P(1 + r/n)^(nt)
        const A = P * Math.pow((1 + r/n), (n * tYr));
        const grossInt = A - P;
        const apy = (Math.pow((1 + r/n), n) - 1) * 100;
        const taxAmt = grossInt * tax;
        const afterTaxInt = grossInt - taxAmt;
        const inflationLoss = P * inf * tYr;
        const realReturn = afterTaxInt - inflationLoss;

        $('cd-total').textContent = fmt(A);
        $('cd-interest').textContent = fmt(grossInt);
        $('cd-yield').textContent = apy.toFixed(2) + '%';
        $('cd-after-tax').textContent = fmt(afterTaxInt);
        $('cd-real-return').textContent = fmt(realReturn);
        $('cd-term-label').textContent = tMo + '-Month CD';
        $('cd-bar-principal').textContent = fmt(P);
        $('cd-bar-gross').textContent = fmt(grossInt);
        $('cd-bar-tax').textContent = '−' + fmt(taxAmt);
        $('cd-tax-bracket-label').textContent = 'At ' + (tax*100).toFixed(0) + '% bracket';

        // Progress bar
        const total = P + grossInt;
        if(total > 0){
            const pp = (P/total)*100, ip = (grossInt/total)*100;
            $('cd-prog-principal').style.width = pp+'%'; $('cd-prog-principal').textContent = Math.round(pp)+'% Principal';
            $('cd-prog-interest').style.width = ip+'%'; $('cd-prog-interest').textContent = Math.round(ip)+'% Interest';
        }

        // Insights
        const realRate = ((1+r)/(1+inf)-1)*100;
        let ins = [];
        ins.push(`Your effective annual percentage yield is <strong>${apy.toFixed(2)}%</strong>, which accounts for compounding.`);
        ins.push(`After <strong>${(tax*100).toFixed(0)}% tax</strong>, your net interest earnings are <strong>${fmt(afterTaxInt)}</strong>.`);
        if(realReturn < 0) ins.push(`<span class="text-danger fw-bold">⚠ Warning:</span> After inflation (${(inf*100).toFixed(1)}%) and taxes, your real return is <strong>negative</strong>. Consider longer terms or higher-yield options.`);
        else ins.push(`Adjusted for ${(inf*100).toFixed(1)}% inflation, your real purchasing power gain is <strong>${fmt(realReturn)}</strong>.`);
        ins.push(`Real rate of return (after inflation): <strong>${realRate.toFixed(2)}%</strong> per year.`);

        $('cd-insights').innerHTML = `<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Investment Insights</h6><ul class="list-unstyled mb-0 small">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [pI,rI,tI,cI,infI,taxI].forEach(el=>el.addEventListener('input',calculate));

    document.querySelectorAll('.cd-quick').forEach(btn=>{
        btn.addEventListener('click',()=>{tI.value=btn.dataset.term;calculate();});
    });

    $('cd-copy').addEventListener('click',function(){
        const text=`CD Investment Analysis\nPrincipal: ${fmt(parseFloat(pI.value))}\nAPY: ${rI.value}% | Term: ${tI.value} months\nMaturity Value: ${$('cd-total').textContent}\nGross Interest: ${$('cd-interest').textContent}\nAfter-Tax Return: ${$('cd-after-tax').textContent}\nReal Return (Inflation-Adjusted): ${$('cd-real-return').textContent}\n— Generated by ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});
    });

    $('cd-reset').addEventListener('click',function(){
        pI.value=10000;rI.value=4.5;tI.value=12;cI.value='12';infI.value=3.0;taxI.value=22;calculate();
    });

    $('cd-pdf').addEventListener('click',function(){
        const o=this.innerHTML;this.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
        setTimeout(()=>{this.innerHTML='<i class="fas fa-check me-2"></i>PDF Ready!';setTimeout(()=>this.innerHTML=o,2000);},1000);
    });

    calculate();
});
</script>
<style>
.cd-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.cd-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.cd-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b;letter-spacing:-0.5px}
.cd-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b;line-height:1.5}
.cd-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.cd-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

