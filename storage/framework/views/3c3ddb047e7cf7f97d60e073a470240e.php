<div class="row g-4 loan-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0" style="border-radius: 30px; background: #fff;">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background:rgba(14,165,233,.1);color:#0ea5e9; width: 55px; height: 55px; border-radius: 20px;">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0c4a6e;">Loan Payment DNA Decoder</h4>
                    <p class="text-muted small mb-0">See exactly how your monthly payment is split between interest and principal equity.</p>
                </div>
            </div>
            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-5">
                        <label class="form-label-custom">Loan Amount</label>
                        <div class="input-group input-group-lg bg-light rounded-4 border-0">
                            <span class="input-group-text border-0 ps-3 bg-light opacity-50">$</span>
                            <input type="number" id="lb-amt" class="form-control border-0 bg-light fw-bold" value="250000">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Interest Rate (%)</label>
                        <input type="number" id="lb-rate" class="form-control form-control-lg border rounded-4 fw-bold" value="6.5" step="0.1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Term (Years)</label>
                        <input type="number" id="lb-term" class="form-control form-control-lg border rounded-4 fw-bold" value="30">
                    </div>
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 border-dashed">
                            <label class="form-label-custom mb-2">Extra Monthly Payment</label>
                            <input type="number" id="lb-extra" class="form-control form-control-lg border-0 bg-white fw-bold" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:200;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">TOTAL MONTHLY PAYMENT</span>
                <div class="output-hero-value" id="lb-total">$0</div>
                <span class="output-hero-unit" id="lb-split">Principal: $0 | Interest: $0</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">TOTAL INTEREST COST</span><span class="stat-card-value text-danger" id="lb-int-total">$0</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">TOTAL LOAN COST</span><span class="stat-card-value text-primary" id="lb-cost-total">$0</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">EQUITY BUILT (M1)</span><span class="stat-card-value text-success" id="lb-equity-pct">0%</span></div></div>
            </div>
            <div class="mt-4" id="lb-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="lb-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Analysis</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="lb-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        let amt = parseFloat($('lb-amt').value) || 0, rate = (parseFloat($('lb-rate').value) || 0) / 100;
        let yrs = parseInt($('lb-term').value) || 30, extra = parseFloat($('lb-extra').value) || 0;
        if(amt <= 0) return;
        const mRate = rate / 12, n = yrs * 12;
        const basePi = amt * (mRate * Math.pow(1 + mRate, n)) / (Math.pow(1 + mRate, n) - 1);
        const totalPi = basePi + extra, m1Int = amt * mRate, m1Pri = totalPi - m1Int;
        let bal = amt, tInt = 0, mos = 0;
        while(bal > 0 && mos < 600){ let i = bal * mRate; tInt += i; bal -= (totalPi - i); mos++; }
        $('lb-total').textContent = fmt(totalPi); $('lb-split').textContent = `Principal: ${fmt(m1Pri)} | Interest: ${fmt(m1Int)}`;
        $('lb-int-total').textContent = fmt(tInt); $('lb-cost-total').textContent = fmt(amt + tInt);
        $('lb-equity-pct').textContent = ((m1Pri/totalPi)*100).toFixed(1) + '%';
        let ins=[]; ins.push('In your first month, <strong>'+((m1Int/totalPi)*100).toFixed(1)+'%</strong> of your payment goes to interest.');
        if(extra>0)ins.push('Extra payments will save you <strong>'+fmt((basePi*n-amt)-tInt)+'</strong> in total interest.');
        ins.push('The "break-even" point where more principal is paid than interest happens eventually.');
        $('lb-insights').innerHTML = '<h6 class="fw-bold mb-2"><i class="fas fa-dna me-2 text-info"></i>Payment DNA</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['lb-amt','lb-rate','lb-term','lb-extra'].forEach(id=>$(id).addEventListener('input', calculate));
    $('lb-reset').addEventListener('click', ()=>{ $('lb-amt').value = 250000; $('lb-rate').value = 6.5; $('lb-term').value = 30; $('lb-extra').value = 0; calculate(); });
    $('lb-copy').addEventListener('click', function(){
        const txt = `Loan DNA Analysis\nTotal Payment: ${$('lb-total').textContent}\nTotal Interest: ${$('lb-int-total').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(txt).then(()=>{ const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000); });
    });
    calculate();
});
</script>
<style>
.loan-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.loan-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#0c4a6e;opacity:.7;margin-bottom:8px;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\loan-payment-breakdown-calculator.blade.php ENDPATH**/ ?>