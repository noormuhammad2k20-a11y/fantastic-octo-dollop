<div class="row g-4 nzio-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0" style="border-radius: 30px; background: #fff;">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background:#4f46e5;color:#fff; width: 55px; height: 55px; border-radius: 15px;">
                    <i class="fas fa-landmark-flag"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b;">NZ Interest-Only Loan Planner</h4>
                    <p class="text-muted small mb-0">Model your mortgage strategy, focusing on the transition from interest-only to principal repayments.</p>
                </div>
            </div>
            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Loan Amount (NZD)</label>
                        <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0 shadow-sm">
                            <span class="input-group-text border-0 ps-3 bg-light opacity-50">$</span>
                            <input type="number" id="nz-amt" class="form-control border-0 bg-light fw-bold" value="750000">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Interest Rate (%)</label>
                        <input type="number" id="nz-rate" class="form-control form-control-lg border rounded-4 fw-bold" value="6.75" step="0.05">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Total Term (Years)</label>
                        <input type="number" id="nz-term" class="form-control form-control-lg border rounded-4 fw-bold" value="30">
                    </div>
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4">
                            <label class="form-label-custom mb-2">Interest-Only Period (Years)</label>
                            <input type="range" class="form-range color-indigo" id="nz-io" min="1" max="15" step="1" value="5">
                            <div class="text-center mt-2 fw-bold text-indigo"><span id="nz-io-val">5</span> Years</div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-indigo rounded-pill px-3 nz-quick" data-io="3">3yr Standard</button>
                    <button class="btn btn-sm btn-outline-indigo rounded-pill px-3 nz-quick" data-io="5">5yr Investment</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,.04);">
            <div class="output-hero">
                <span class="output-hero-label">INTEREST-ONLY PHASE PAYMENT</span>
                <div class="output-hero-value" id="nz-io-pay">$0</div>
                <span class="output-hero-unit" id="nz-io-info">Fixed for 5 years</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card" style="border-color:#4f46e5;background:rgba(79,70,229,.02);"><span class="stat-card-label">PRINCIPAL CLIFF (YR 6+)</span><span class="stat-card-value text-indigo" id="nz-full-pay">$0</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">MONTHLY JUMP</span><span class="stat-card-value text-danger" id="nz-jump">$0</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">TOTAL INTEREST</span><span class="stat-card-value text-success" id="nz-total-int">$0</span></div></div>
            </div>
            <div class="mt-4" id="nz-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="nz-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Strategy</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="nz-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        let amt = parseFloat($('nz-amt').value) || 0, rate = (parseFloat($('nz-rate').value) || 0) / 100;
        let yrs = parseInt($('nz-term').value) || 30, ioYrs = parseInt($('nz-io').value) || 5;
        $('nz-io-val').textContent = ioYrs; $('nz-io-info').textContent = 'Fixed for '+ioYrs+' years';
        if(amt <= 0) return;
        const mRate = rate / 12, ioMo = amt * mRate, remMo = (yrs - ioYrs) * 12;
        const fullMo = amt * (mRate * Math.pow(1 + mRate, remMo)) / (Math.pow(1 + mRate, remMo) - 1);
        const jump = fullMo - ioMo, totalInt = (ioMo * ioYrs * 12) + (fullMo * (yrs - ioYrs) * 12) - amt;
        $('nz-io-pay').textContent = fmt(ioMo); $('nz-full-pay').textContent = fmt(fullMo);
        $('nz-jump').textContent = '+'+fmt(jump); $('nz-total-int').textContent = fmt(totalInt);
        let ins=[]; ins.push('After the <strong>'+ioYrs+' year</strong> IO period, your payment will jump by <strong>'+fmt(jump)+'</strong>.');
        ins.push('The principal repayment term is reduced to <strong>'+(yrs-ioYrs)+' years</strong>.');
        ins.push('Interest-only loans are common for NZ property investors to maximize cashflow.');
        $('nz-insights').innerHTML = '<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Strategy Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['nz-amt','nz-rate','nz-term','nz-io'].forEach(id=>$(id).addEventListener('input', calculate));
    document.querySelectorAll('.nz-quick').forEach(btn => btn.addEventListener('click', ()=>{ $('nz-io').value = btn.dataset.io; calculate(); }));
    $('nz-reset').addEventListener('click', ()=>{ $('nz-amt').value = 750000; $('nz-rate').value = 6.75; $('nz-term').value = 30; $('nz-io').value = 5; calculate(); });
    $('nz-copy').addEventListener('click', function(){
        const txt = `NZ IO Loan Analysis\nIO Payment: ${$('nz-io-pay').textContent}\nFull Payment: ${$('nz-full-pay').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(txt).then(()=>{ const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000); });
    });
    calculate();
});
</script>
<style>
.nzio-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.nzio-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e1b4b;opacity:.7;margin-bottom:8px;display:block}
.color-indigo::-webkit-slider-thumb { background: #4f46e5; }
.color-indigo::-moz-range-thumb { background: #4f46e5; }
</style>

