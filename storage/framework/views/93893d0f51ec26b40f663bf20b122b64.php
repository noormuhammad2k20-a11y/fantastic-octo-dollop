<div class="row g-4 debt-to-equity-ratio-calculator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Total Liabilities ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dte-debt" class="form-control form-control-lg" value="300000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Shareholder Equity ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dte-eq" class="form-control form-control-lg" value="200000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Long-Term Debt ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dte-ltd" class="form-control form-control-lg" value="200000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Short-Term Debt ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dte-std" class="form-control form-control-lg" value="100000" min="0"></div></div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(0,0,0,.04);">
            <div class="output-hero"><span class="output-hero-label">Debt-to-Equity Ratio Calculator</span><div class="output-hero-value" id="debt-val">—</div><span class="output-hero-unit" id="debt-st">CALCULATING</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">D/E RATIO</span><span class="stat-card-value text-danger" id="dte-ratio">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">LT D/E RATIO</span><span class="stat-card-value text-primary" id="dte-lt">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">DEBT %</span><span class="stat-card-value " id="dte-pct">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">EQUITY %</span><span class="stat-card-value text-success" id="dte-eq-pct">—</span></div></div>
                
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
        const d=parseFloat($('dte-debt').value)||0,e=parseFloat($('dte-eq').value)||1,lt=parseFloat($('dte-ltd').value)||0,st=parseFloat($('dte-std').value)||0;
const ratio=d/e,ltRatio=lt/e,total=d+e,dPct=(d/total)*100,ePct=(e/total)*100;
$('debt-val').textContent=ratio.toFixed(2)+'x';$('dte-ratio').textContent=ratio.toFixed(2)+'x';$('dte-lt').textContent=ltRatio.toFixed(2)+'x';$('dte-pct').textContent=dPct.toFixed(1)+'%';$('dte-eq-pct').textContent=ePct.toFixed(1)+'%';
$('debt-st').textContent=ratio<=1?'CONSERVATIVE':ratio<=2?'MODERATE':'AGGRESSIVE';$('debt-st').style.color=ratio<=1?'#22c55e':ratio<=2?'#f59e0b':'#ef4444';
let i=[];i.push('D/E ratio of <strong>'+ratio.toFixed(2)+'x</strong> — for every \$1 equity, there is <strong>'+fmt(ratio)+'</strong> of debt.');
i.push('Long-term D/E is <strong>'+ltRatio.toFixed(2)+'x</strong>, which excludes short-term obligations.');
if(ratio>2)i.push('⚠️ High leverage ratio. Creditors fund more of the business than shareholders.');
        $('debt-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['dte-debt','dte-eq','dte-ltd','dte-std'].forEach(id=>$(id).addEventListener('input',calc));
    $('debt-cb').addEventListener('click',calc);
    $('debt-cp').addEventListener('click',function(){navigator.clipboard.writeText('Debt-to-Equity Ratio Calculator: '+$('debt-val').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('debt-rs').addEventListener('click',()=>{$('dte-debt').value=300000;$('dte-eq').value=200000;$('dte-ltd').value=200000;$('dte-std').value=100000;calc();});
    calc();
});
</script>
<style>
.debt-to-equity-ratio-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.debt-to-equity-ratio-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.debt-to-equity-ratio-calculator-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.debt-to-equity-ratio-calculator-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.debt-to-equity-ratio-calculator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.debt-to-equity-ratio-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\debt-to-equity-ratio-calculator.blade.php ENDPATH**/ ?>