<div class="row g-4 ny-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0" style="border-radius: 24px; background: #fff;">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background:#1e3a8a; color:#fff; width: 50px; height: 50px; border-radius: 12px;">
                    <i class="fas fa-city"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#0f172a;">NY Salary Tax Decoder</h4>
                    <p class="text-muted small mb-0">Decode your New York take-home pay including Federal, State, and NYC Local taxes.</p>
                </div>
            </div>
            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Gross Salary</label>
                        <div class="input-group input-group-lg bg-light rounded-3 overflow-hidden border">
                            <span class="input-group-text border-0 ps-3 bg-light opacity-50">$</span>
                            <input type="number" id="ny-sal" class="form-control border-0 bg-light fw-bold" value="125000">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Filing Status</label>
                        <select id="ny-status" class="form-select form-select-lg border rounded-3 fw-bold">
                            <option value="single" selected>Single</option>
                            <option value="married">Married</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">NYC Resident?</label>
                        <div class="p-2 border rounded-3 bg-light d-flex align-items-center justify-content-center h-50">
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" id="ny-city" checked>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-3 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-4 ny-quick" data-s="65000">Entry Level</button>
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-4 ny-quick" data-s="185000">Senior</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:230;--tool-color:#1e3a8a;--tool-bg:rgba(30,58,138,.04);">
            <div class="output-hero">
                <span class="output-hero-label">ANNUAL NET TAKE-HOME PAY</span>
                <div class="output-hero-value" id="ny-total">$0</div>
                <span class="output-hero-unit" id="ny-monthly">~ $0 / month</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">FEDERAL TAX</span><span class="stat-card-value text-danger" id="ny-fed">$0</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">STATE TAX</span><span class="stat-card-value text-primary" id="ny-state">$0</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">NYC LOCAL</span><span class="stat-card-value text-warning" id="ny-local">$0</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#6b7280;background:rgba(107,114,128,.02);"><span class="stat-card-label">FICA TAX</span><span class="stat-card-value text-muted" id="ny-fica">$0</span></div></div>
            </div>
            <div class="mt-4" id="ny-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ny-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Paycheck Analysis</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ny-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        let sal = parseFloat($('ny-sal').value) || 0, isNyc = $('ny-city').checked;
        let fed = sal > 200000 ? sal*0.24 : (sal > 100000 ? sal*0.18 : sal*0.12);
        let state = sal > 150000 ? sal*0.068 : (sal > 80000 ? sal*0.059 : sal*0.05);
        let local = isNyc ? sal*0.038 : 0, fica = Math.min(sal*0.0765, 12000);
        let net = sal - (fed + state + local + fica);
        $('ny-total').textContent = fmt(net); $('ny-monthly').textContent = `~ ${fmt(net/12)} / month`;
        $('ny-fed').textContent = '-'+fmt(fed); $('ny-state').textContent = '-'+fmt(state);
        $('ny-local').textContent = '-'+fmt(local); $('ny-fica').textContent = '-'+fmt(fica);
        let ins=[]; ins.push('Your total tax burden is <strong>'+(((sal-net)/sal)*100).toFixed(1)+'%</strong>');
        if(isNyc)ins.push('NYC local tax contributes about <strong>3.8%</strong> to your total tax bill.');
        ins.push('Estimated take-home after all NY specific deductions.');
        $('ny-insights').innerHTML = '<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Payroll Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['ny-sal','ny-status','ny-city'].forEach(id=>$(id).addEventListener('input', calculate));
    document.querySelectorAll('.ny-quick').forEach(btn => btn.addEventListener('click', ()=>{ $('ny-sal').value = btn.dataset.s; calculate(); }));
    $('ny-reset').addEventListener('click', ()=>{ $('ny-sal').value = 125000; $('ny-status').value = 'single'; $('ny-city').checked = true; calculate(); });
    $('ny-copy').addEventListener('click', function(){
        const txt = `NY Paycheck Analysis\nGross: $${$('ny-sal').value}\nNet Take-Home: ${$('ny-total').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(txt).then(()=>{ const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000); });
    });
    calculate();
});
</script>
<style>
.ny-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.ny-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\new-york-salary-tax-calculator.blade.php ENDPATH**/ ?>