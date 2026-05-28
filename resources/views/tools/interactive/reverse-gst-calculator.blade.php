<div class="row g-4 rgst-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Total Price (GST Inclusive)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="rg-total" class="form-control form-control-lg" value="1180" min="0" step="0.01"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Custom GST Rate (%)</label><div class="input-group"><input type="number" id="rg-rate" class="form-control form-control-lg" value="18" min="0" max="50" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick Rates:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 rg-quick" data-r="5">5% GST</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 rg-quick" data-r="7">7% GST</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 rg-quick" data-r="10">10% VAT</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 rg-quick" data-r="12">12% GST</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 rg-quick" data-r="18">18% GST</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 rg-quick" data-r="20">20% VAT</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 rg-quick" data-r="28">28% GST</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero"><span class="output-hero-label">ORIGINAL PRICE (BEFORE TAX)</span><div class="output-hero-value" id="rg-base">$1,000.00</div><span class="output-hero-unit" id="rg-formula">Base = $1,180.00 ÷ 1.18</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#ec4899;background:rgba(236,72,153,.02);"><span class="stat-card-label">TAX AMOUNT (GST)</span><span class="stat-card-value" style="color:#ec4899" id="rg-tax">$180.00</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">TAX AS % OF BASE</span><span class="stat-card-value text-primary" id="rg-pct">18.0%</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">TAX AS % OF TOTAL</span><span class="stat-card-value text-success" id="rg-pct-total">15.3%</span></div></div>
            </div>
            <div class="d-flex align-items-center p-3 rounded-3 mt-4" style="background:#fdf2f8;border-left:5px solid #ec4899">
                <i class="fas fa-calculator me-3 fs-5" style="color:#ec4899"></i>
                <div><div class="fw-bold">Reverse Formula</div><div class="small text-muted font-monospace">Base Price = Total ÷ (1 + Rate/100) = <span id="rg-formula2">1180 ÷ 1.18 = 1000.00</span></div></div>
            </div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="rg-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Breakdown</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="rg-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const total=parseFloat($('rg-total').value)||0,rate=(parseFloat($('rg-rate').value)||0);
        const divisor=1+(rate/100);
        const base=total/divisor,tax=total-base;
        const pctOfTotal=total>0?(tax/total)*100:0;
        $('rg-base').textContent=fmt(base);$('rg-tax').textContent=fmt(tax);
        $('rg-pct').textContent=rate.toFixed(1)+'%';$('rg-pct-total').textContent=pctOfTotal.toFixed(1)+'%';
        $('rg-formula').textContent='Base = '+fmt(total)+' ÷ '+divisor.toFixed(2);
        $('rg-formula2').textContent=total.toFixed(0)+' ÷ '+divisor.toFixed(2)+' = '+base.toFixed(2);
    }
    ['rg-total','rg-rate'].forEach(id=>$(id).addEventListener('input',calculate));
    document.querySelectorAll('.rg-quick').forEach(b=>b.addEventListener('click',()=>{$('rg-rate').value=b.dataset.r;calculate();}));
    $('rg-copy').addEventListener('click',function(){const t='Reverse GST\nTotal: '+fmt(parseFloat($('rg-total').value))+'\nBase: '+$('rg-base').textContent+'\nTax: '+$('rg-tax').textContent+'\nRate: '+$('rg-rate').value+'%\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('rg-reset').addEventListener('click',()=>{$('rg-total').value=1180;$('rg-rate').value=18;calculate();});
    calculate();
});
</script>
<style>
.rgst-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.rgst-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.rgst-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.rgst-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.rgst-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.rgst-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

