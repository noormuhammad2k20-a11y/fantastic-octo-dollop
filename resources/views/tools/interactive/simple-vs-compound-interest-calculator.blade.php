<div class="row g-4 growth-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0" style="border-radius: 30px; background: #fff;">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background:#d97706;color:#fff; width: 55px; height: 55px; border-radius: 18px;">
                    <i class="fas fa-arrow-up-right-dots"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#451a03;">Interest Growth Battle</h4>
                    <p class="text-muted small mb-0">Visualize the "Eighth Wonder of the World" by comparing Simple interest vs the power of Compounding.</p>
                </div>
            </div>
            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Initial Principal</label>
                        <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0 shadow-sm">
                            <span class="input-group-text border-0 ps-3 bg-light opacity-50">$</span>
                            <input type="number" id="gr-p" class="form-control border-0 bg-light fw-bold" value="10000">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Annual Rate (%)</label>
                        <input type="number" id="gr-r" class="form-control form-control-lg border rounded-4 fw-bold" value="8" step="0.5">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Years</label>
                        <input type="number" id="gr-t" class="form-control form-control-lg border rounded-4 fw-bold" value="20">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#d97706;--tool-bg:rgba(217,119,6,.04);">
            <div class="output-hero">
                <span class="output-hero-label">COMPOUND INTEREST ADVANTAGE</span>
                <div class="output-hero-value" id="gr-adv">$0</div>
                <span class="output-hero-unit" id="gr-adv-label">Extra wealth created</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#d97706;background:rgba(217,119,6,.02);">
                        <span class="stat-card-label">COMPOUND TOTAL</span>
                        <span class="stat-card-value text-warning" id="gr-c-total">$0</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-color:#64748b;background:rgba(100,116,139,.02);">
                        <span class="stat-card-label">SIMPLE TOTAL</span>
                        <span class="stat-card-value text-muted" id="gr-s-total">$0</span>
                    </div>
                </div>
            </div>
            <div class="mt-4" id="gr-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="gr-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Comparison</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="gr-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        let P = parseFloat($('gr-p').value) || 0, r = (parseFloat($('gr-r').value) || 0) / 100, t = parseInt($('gr-t').value) || 0;
        if(P < 0) return;
        const sTotal = P + (P * r * t), cTotal = P * Math.pow(1 + r, t), adv = cTotal - sTotal;
        $('gr-c-total').textContent = fmt(cTotal); $('gr-s-total').textContent = fmt(sTotal); $('gr-adv').textContent = fmt(adv);
        let ins=[]; ins.push('Compound interest earned you <strong>'+fmt(cTotal-P)+'</strong> in interest.');
        ins.push('Simple interest only earned <strong>'+fmt(sTotal-P)+'</strong>.');
        ins.push('The difference is <strong>'+fmt(adv)+'</strong> due to interest earning interest.');
        $('gr-insights').innerHTML = '<h6 class="fw-bold mb-2"><i class="fas fa-bolt me-2 text-warning"></i>Growth Analysis</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['gr-p','gr-r','gr-t'].forEach(id=>$(id).addEventListener('input', calculate));
    $('gr-reset').addEventListener('click', ()=>{ $('gr-p').value = 10000; $('gr-r').value = 8; $('gr-t').value = 20; calculate(); });
    $('gr-copy').addEventListener('click', function(){
        const txt = `Interest Growth Comparison\nCompound Total: ${$('gr-c-total').textContent}\nSimple Total: ${$('gr-s-total').textContent}\nAdvantage: ${$('gr-adv').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(txt).then(()=>{ const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000); });
    });
    calculate();
});
</script>
<style>
.growth-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.growth-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#451a03;opacity:.7;margin-bottom:8px;display:block}
</style>

