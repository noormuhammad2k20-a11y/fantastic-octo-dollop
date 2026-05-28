<div class="row g-4 apr-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0" style="border-radius: 24px; background: #fff;">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background:rgba(16,185,129,.1);color:#10b981; width: 50px; height: 50px; border-radius: 12px;">
                    <i class="fas fa-percent"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b;">True APR Transparency Tool</h4>
                    <p class="text-muted small mb-0">Unmask the real cost of your loan by calculating the Annual Percentage Rate including all fees.</p>
                </div>
            </div>
            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Loan Amount</label>
                        <div class="input-group input-group-lg bg-light rounded-3 border">
                            <span class="input-group-text border-0 ps-3 bg-light opacity-50">$</span>
                            <input type="number" id="apr-amt" class="form-control border-0 bg-light fw-bold" value="250000">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Stated Rate (%)</label>
                        <div class="input-group input-group-lg bg-light rounded-3 border">
                            <input type="number" id="apr-rate" class="form-control border-0 bg-light fw-bold" value="6.5" step="0.1">
                            <span class="input-group-text border-0 ps-0 bg-light opacity-50 pe-3">%</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Term (Years)</label>
                        <input type="number" id="apr-years" class="form-control form-control-lg border rounded-3 fw-bold" value="30">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Loan Fees ($)</label>
                        <div class="input-group input-group-lg bg-light rounded-3 border">
                            <span class="input-group-text border-0 ps-3 bg-light opacity-50">$</span>
                            <input type="number" id="apr-fees" class="form-control border-0 bg-light fw-bold" value="5000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Points Paid (%)</label>
                        <div class="input-group input-group-lg bg-light rounded-3 border">
                            <input type="number" id="apr-points" class="form-control border-0 bg-light fw-bold" value="1" step="0.1">
                            <span class="input-group-text border-0 ps-0 bg-light opacity-50 pe-3">%</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-3 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-success rounded-pill px-4 apr-quick" data-f="0" data-p="0">Zero Fee</button>
                    <button class="btn btn-sm btn-outline-success rounded-pill px-4 apr-quick" data-f="5000" data-p="1">Standard Fee</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">YOUR TRUE ANNUAL PERCENTAGE RATE (APR)</span>
                <div class="output-hero-value" id="out-apr">0%</div>
                <span class="output-hero-unit" id="out-status">HEALTHY LOAN PROFILE</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="stat-card" style="border-color:#10b981;background:rgba(16,185,129,.02);"><span class="stat-card-label">STATED RATE</span><span class="stat-card-value text-success" id="out-stated">0%</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">APR GAP (ADDITIONAL COST)</span><span class="stat-card-value text-danger" id="out-gap">+0%</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">MONTHLY P&I</span><span class="stat-card-value text-primary" id="out-pi">$0</span></div></div>
            </div>
            <div class="mt-4" id="apr-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="apr-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Loan Analysis</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="apr-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        let amt = parseFloat($('apr-amt').value) || 0, rate = (parseFloat($('apr-rate').value) || 0) / 100;
        let years = parseInt($('apr-years').value) || 30, fees = parseFloat($('apr-fees').value) || 0;
        let pts = (parseFloat($('apr-points').value) || 0) / 100 * amt, totalFees = fees + pts;
        if(amt <= 0) return;
        const n = years * 12, i = rate / 12, pi = amt * (i * Math.pow(1 + i, n)) / (Math.pow(1 + i, n) - 1);
        let low = 0, high = 1, netAmt = amt - totalFees;
        for(let k=0; k<25; k++){
            let mid = (low + high) / 2, mr = mid / 12;
            let pv = pi * (1 - Math.pow(1 + mr, -n)) / mr;
            if(pv > netAmt) low = mid; else high = mid;
        }
        const apr = high * 100, gap = apr - (rate * 100);
        $('out-apr').textContent = apr.toFixed(2) + '%'; $('out-stated').textContent = (rate * 100).toFixed(2) + '%';
        $('out-gap').textContent = '+' + gap.toFixed(2) + '%'; $('out-pi').textContent = fmt(pi);
        if(gap > 0.5){$('out-status').textContent = 'HIGH FEE LOAN'; $('out-status').style.color='#ef4444';}
        else if(gap > 0.2){$('out-status').textContent = 'MODERATE FEE LOAN'; $('out-status').style.color='#f59e0b';}
        else{$('out-status').textContent = 'HEALTHY LOAN PROFILE'; $('out-status').style.color='#10b981';}
        let ins=[]; ins.push('Total upfront fees: <strong>'+fmt(totalFees)+'</strong>');
        ins.push('True cost of borrowing is <strong>'+gap.toFixed(2)+'%</strong> higher than the stated rate.');
        ins.push('APR reflects the effective interest rate including all prepaid finance charges.');
        $('apr-insights').innerHTML = '<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Loan Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['apr-amt','apr-rate','apr-years','apr-fees','apr-points'].forEach(id=>$(id).addEventListener('input', calculate));
    document.querySelectorAll('.apr-quick').forEach(btn => btn.addEventListener('click', ()=>{ $('apr-fees').value = btn.dataset.f; $('apr-points').value = btn.dataset.p; calculate(); }));
    $('apr-reset').addEventListener('click', ()=>{ $('apr-amt').value = 250000; $('apr-rate').value = 6.5; $('apr-years').value = 30; $('apr-fees').value = 5000; $('apr-points').value = 1; calculate(); });
    $('apr-copy').addEventListener('click', function(){
        const txt = `APR Analysis\nTRUE APR: ${$('out-apr').textContent}\nStated Rate: ${$('out-stated').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(txt).then(()=>{ const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000); });
    });
    calculate();
});
</script>
<style>
.apr-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.apr-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\apr-calculator.blade.php ENDPATH**/ ?>