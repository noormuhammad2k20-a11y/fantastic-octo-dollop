<div class="row g-4 cash-flow-margin-calculator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Operating Cash Flow ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cfm-ocf" class="form-control form-control-lg" value="150000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Net Sales / Revenue ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cfm-rev" class="form-control form-control-lg" value="500000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Net Income ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cfm-ni" class="form-control form-control-lg" value="120000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Industry Avg Margin (%)</label><div class="input-group"><input type="number" id="cfm-ind" class="form-control form-control-lg" value="20" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#10b981;--tool-bg:rgba(160,160,160,.04);">
            <div class="output-hero"><span class="output-hero-label">Cash Flow Margin Calculator</span><div class="output-hero-value" id="cash-val">—</div><span class="output-hero-unit" id="cash-st">CALCULATING</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">CASH FLOW MARGIN</span><span class="stat-card-value text-success" id="cfm-margin">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">ACCRUAL GAP</span><span class="stat-card-value text-primary" id="cfm-gap">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">EARNINGS QUALITY</span><span class="stat-card-value " id="cfm-quality">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">VS INDUSTRY</span><span class="stat-card-value " id="cfm-vs">—</span></div></div>
                
            </div>
            <div class="mt-4" id="cash-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="cash-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="cash-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-primary py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="cash-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calc(){
        const ocf=parseFloat($('cfm-ocf').value)||0,rev=parseFloat($('cfm-rev').value)||1,ni=parseFloat($('cfm-ni').value)||0,ind=parseFloat($('cfm-ind').value)||0;
const margin=(ocf/rev)*100,gap=ocf-ni,quality=ni>0?(ocf/ni*100):0,vs=margin-ind;
$('cash-val').textContent=margin.toFixed(1)+'%';$('cfm-margin').textContent=margin.toFixed(1)+'%';$('cfm-gap').textContent=fmt(gap);$('cfm-quality').textContent=quality.toFixed(0)+'%';$('cfm-vs').textContent=(vs>=0?'+':'')+vs.toFixed(1)+'%';
$('cash-st').textContent=margin>=ind?'ABOVE INDUSTRY':'BELOW INDUSTRY';$('cash-st').style.color=margin>=ind?'#22c55e':'#ef4444';
let i=[];i.push('Cash flow margin of <strong>'+margin.toFixed(1)+'%</strong> — for every \$1 revenue, <strong>'+margin.toFixed(0)+'¢</strong> becomes cash.');
i.push('Accrual gap: <strong>'+fmt(Math.abs(gap))+'</strong> '+(gap>=0?'positive (cash exceeds accrual income)':'negative (earnings may be low quality)'));
        $('cash-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['cfm-ocf','cfm-rev','cfm-ni','cfm-ind'].forEach(id=>$(id).addEventListener('input',calc));
    $('cash-cb').addEventListener('click',calc);
    $('cash-cp').addEventListener('click',function(){navigator.clipboard.writeText('Cash Flow Margin Calculator: '+$('cash-val').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('cash-rs').addEventListener('click',()=>{$('cfm-ocf').value=150000;$('cfm-rev').value=500000;$('cfm-ni').value=120000;$('cfm-ind').value=20;calc();});
    calc();
});
</script>
<style>
.cash-flow-margin-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.cash-flow-margin-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.cash-flow-margin-calculator-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.cash-flow-margin-calculator-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.cash-flow-margin-calculator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.cash-flow-margin-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cash-flow-margin-calculator.blade.php ENDPATH**/ ?>