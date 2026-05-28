<div class="row g-4 texas-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0" style="border-radius: 30px; background: #fff;">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle" style="background:rgba(194,65,12,.1);color:#c2410c; width: 55px; height: 55px; border-radius: 20px;">
                    <i class="fas fa-map-location-dot"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#431407;">Texas Property Tax Estimator</h4>
                    <p class="text-muted small mb-0">Estimate your annual property tax liability based on the "No State Income Tax" model.</p>
                </div>
            </div>
            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-7">
                        <label class="form-label-custom">Appraised Market Value</label>
                        <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                            <span class="input-group-text border-0 ps-3 bg-light">$</span>
                            <input type="number" id="tx-market" class="form-control border-0 bg-light fw-bold" value="450000">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label-custom">Homestead Exemption</label>
                        <select id="tx-home" class="form-select form-select-lg bg-light border-0 rounded-4 fw-bold">
                            <option value="100000" selected>Standard ($100k)</option>
                            <option value="110000">Over 65 / Disabled</option>
                            <option value="0">None (Investment)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Combined Tax Rate (%)</label>
                        <div class="d-flex align-items-center gap-3 mt-2">
                            <input type="range" class="form-range flex-grow-1 color-orange" id="tx-rate" min="1.0" max="4.0" step="0.05" value="2.15">
                            <span class="badge bg-orange-soft text-orange p-2 rounded-3" style="min-width: 65px;" id="tx-rate-val">2.15%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Annual Assessment Growth (%)</label>
                        <div class="input-group bg-light rounded-4 overflow-hidden">
                            <input type="number" id="tx-growth" class="form-control border-0 bg-light fw-bold" value="3">
                            <span class="input-group-text border-0 bg-light pe-3">%</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3 tx-quick" data-r="1.85">Lowest Counties</button>
                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3 tx-quick" data-r="2.45">Metropolitan (Harris/Dallas)</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:20;--tool-color:#c2410c;--tool-bg:rgba(194,65,12,.04);">
            <div class="output-hero">
                <span class="output-hero-label">ESTIMATED ANNUAL PROPERTY TAX</span>
                <div class="output-hero-value" id="tx-total">$0</div>
                <span class="output-hero-unit" id="tx-monthly">~ $0 / month</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#c2410c;background:rgba(194,65,12,.02);">
                        <span class="stat-card-label">TAXABLE VALUE</span>
                        <span class="stat-card-value" id="tx-taxable">$0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);">
                        <span class="stat-card-label">MONTHLY ESCROW</span>
                        <span class="stat-card-value text-primary" id="tx-escrow">$0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);">
                        <span class="stat-card-label">EXEMPTION SAVINGS</span>
                        <span class="stat-card-value text-success" id="tx-savings">$0</span>
                    </div>
                </div>
            </div>
            <div class="mt-4" id="tx-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tx-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Assessment</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="tx-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        let market = parseFloat($('tx-market').value) || 0, exemption = parseFloat($('tx-home').value) || 0;
        let rate = (parseFloat($('tx-rate').value) || 0) / 100;
        $('tx-rate-val').textContent = $('tx-rate').value + '%';
        const taxable = Math.max(0, market - exemption), annualTax = taxable * rate, monthlyTax = annualTax / 12;
        $('tx-total').textContent = fmt(annualTax); $('tx-taxable').textContent = fmt(taxable);
        $('tx-monthly').textContent = `~ ${fmt(monthlyTax)} / month`;
        $('tx-escrow').textContent = fmt(monthlyTax); $('tx-savings').textContent = fmt(exemption * rate);
        let ins=[]; ins.push('Effective tax rate on market value: <strong>'+((annualTax/market)*100).toFixed(2)+'%</strong>');
        if(exemption>0)ins.push('Homestead exemption reduces your tax bill by <strong>'+fmt(exemption*rate)+'</strong> annually.');
        ins.push('Estimated allocation: 55% Schools, 25% County, 20% City.');
        $('tx-insights').innerHTML = '<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Tax Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['tx-market','tx-home','tx-rate','tx-growth'].forEach(id=>$(id).addEventListener('input', calculate));
    document.querySelectorAll('.tx-quick').forEach(btn => btn.addEventListener('click', ()=>{ $('tx-rate').value = btn.dataset.r; calculate(); }));
    $('tx-reset').addEventListener('click', ()=>{ $('tx-market').value = 450000; $('tx-home').value = 100000; $('tx-rate').value = 2.15; calculate(); });
    $('tx-copy').addEventListener('click', function(){
        const txt = `TX Property Tax Estimate\nAnnual: ${$('tx-total').textContent}\nTaxable: ${$('tx-taxable').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(txt).then(()=>{ const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!'; setTimeout(()=>this.innerHTML=o,2000); });
    });
    calculate();
});
</script>
<style>
.texas-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.texas-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#431407;opacity:.7;margin-bottom:8px;display:block}
.bg-orange-soft{background:rgba(194,65,12,.1)}
.text-orange{color:#c2410c}
.color-orange::-webkit-slider-thumb { background: #c2410c; }
.color-orange::-moz-range-thumb { background: #c2410c; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\texas-property-tax-calculator.blade.php ENDPATH**/ ?>