<div class="row g-4 debt-to-asset-ratio-calculator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Total Debt ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dta-debt" class="form-control form-control-lg" value="200000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Total Assets ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dta-assets" class="form-control form-control-lg" value="500000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Current Assets ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dta-ca" class="form-control form-control-lg" value="100000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Current Liabilities ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dta-cl" class="form-control form-control-lg" value="50000" min="0"></div></div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:350;--tool-color:#f43f5e;--tool-bg:rgba(350,350,350,.04);">
            <div class="output-hero"><span class="output-hero-label">Debt-to-Asset Ratio Calculator</span><div class="output-hero-value" id="debt-val">—</div><span class="output-hero-unit" id="debt-st">CALCULATING</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#f43f5e;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">DEBT/ASSET RATIO</span><span class="stat-card-value " id="dta-ratio">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">EQUITY RATIO</span><span class="stat-card-value text-success" id="dta-eq">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">CURRENT RATIO</span><span class="stat-card-value text-primary" id="dta-cr">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">WORKING CAPITAL</span><span class="stat-card-value " id="dta-wc">—</span></div></div>
                
            </div>
            <div class="mt-4" id="debt-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="debt-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="debt-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-primary py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="debt-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calc(){
        const d=parseFloat($('dta-debt').value)||0,a=parseFloat($('dta-assets').value)||1,ca=parseFloat($('dta-ca').value)||0,cl=parseFloat($('dta-cl').value)||0;
const ratio=(d/a)*100,eqRatio=((a-d)/a)*100,cr=cl>0?(ca/cl):0,wc=ca-cl;
$('debt-val').textContent=ratio.toFixed(1)+'%';$('dta-ratio').textContent=ratio.toFixed(1)+'%';$('dta-eq').textContent=eqRatio.toFixed(1)+'%';$('dta-cr').textContent=cr.toFixed(2)+'x';$('dta-wc').textContent=fmt(wc);
$('debt-st').textContent=ratio<=40?'LOW LEVERAGE':ratio<=60?'MODERATE':'HIGH LEVERAGE';$('debt-st').style.color=ratio<=40?'#22c55e':ratio<=60?'#f59e0b':'#ef4444';
let i=[];i.push('Debt-to-Asset ratio of <strong>'+ratio.toFixed(1)+'%</strong> — '+ratio.toFixed(0)+'% of assets are debt-financed.');
i.push('Equity ratio is <strong>'+eqRatio.toFixed(1)+'%</strong>. Current ratio: <strong>'+cr.toFixed(2)+'x</strong>.');
if(ratio>70)i.push('⚠️ Over 70% debt-funded — high insolvency risk.');
        $('debt-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['dta-debt','dta-assets','dta-ca','dta-cl'].forEach(id=>$(id).addEventListener('input',calc));
    $('debt-cb').addEventListener('click',calc);
    $('debt-cp').addEventListener('click',function(){navigator.clipboard.writeText('Debt-to-Asset Ratio Calculator: '+$('debt-val').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('debt-rs').addEventListener('click',()=>{$('dta-debt').value=200000;$('dta-assets').value=500000;$('dta-ca').value=100000;$('dta-cl').value=50000;calc();});
    calc();
});
</script>
<style>
.debt-to-asset-ratio-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.debt-to-asset-ratio-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.debt-to-asset-ratio-calculator-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.debt-to-asset-ratio-calculator-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.debt-to-asset-ratio-calculator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.debt-to-asset-ratio-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>