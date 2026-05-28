<div class="row g-4 lgold-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Weight (grams)</label><input type="number" id="lg-weight" class="form-control form-control-lg rounded-3" value="10" step="0.1" min="0"></div>
                    <div class="col-md-4"><label class="form-label-custom">Gold Spot ($/troy oz)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="lg-spot" class="form-control form-control-lg" value="2350" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Purity</label><select class="form-select form-select-lg rounded-3" id="lg-purity"><option value="1" selected>24K (99.9%)</option><option value="0.916">22K</option><option value="0.75">18K</option><option value="0.583">14K</option></select></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:40;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero"><span class="output-hero-label">GOLD VALUE</span><div class="output-hero-value" id="lg-value">$755.58</div><span class="output-hero-unit">10g Fine Gold</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">PRICE PER GRAM</span><span class="stat-card-value text-warning" id="lg-pergram">$75.56</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">TROY OZ EQUIVALENT</span><span class="stat-card-value text-success" id="lg-troyoz">0.3215</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">PURE GOLD WEIGHT</span><span class="stat-card-value text-primary" id="lg-purewt">10.0g</span></div></div>
            </div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="lg-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Value</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="lg-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const wt=parseFloat($('lg-weight').value)||0,spot=parseFloat($('lg-spot').value)||0;
        const purity=parseFloat($('lg-purity').value)||1;
        const troyOz=wt/31.1035,value=troyOz*spot*purity,perGram=spot/31.1035*purity;
        $('lg-value').textContent=fmt(value);$('lg-pergram').textContent=fmt(perGram);
        $('lg-troyoz').textContent=(troyOz*purity).toFixed(4);$('lg-purewt').textContent=(wt*purity).toFixed(1)+'g';
    }
    ['lg-weight','lg-spot','lg-purity'].forEach(id=>$(id).addEventListener('input',calculate));
    $('lg-copy').addEventListener('click',function(){const t='Gold Value: '+$('lg-value').textContent+'\nWeight: '+$('lg-weight').value+'g | Per Gram: '+$('lg-pergram').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('lg-reset').addEventListener('click',()=>{$('lg-weight').value=10;$('lg-spot').value=2350;$('lg-purity').value='1';calculate();});
    calculate();
});
</script>
<style>
.lgold-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.lgold-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.lgold-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.lgold-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.lgold-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.lgold-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\legacy-gold-calculator.blade.php ENDPATH**/ ?>