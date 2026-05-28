<div class="row g-4 equity-multiplier-calculator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Total Assets ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="em-ta" class="form-control form-control-lg" value="1000000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Shareholder Equity ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="em-eq" class="form-control form-control-lg" value="400000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Net Income ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="em-ni" class="form-control form-control-lg" value="80000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Target ROE (%)</label><div class="input-group"><input type="number" id="em-roe" class="form-control form-control-lg" value="15" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:260;--tool-color:#8b5cf6;--tool-bg:rgba(260,260,260,.04);">
            <div class="output-hero"><span class="output-hero-label">Equity Multiplier Calculator</span><div class="output-hero-value" id="equity-val">—</div><span class="output-hero-unit" id="equity-st">CALCULATING</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#8b5cf6;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">EQUITY MULTIPLIER</span><span class="stat-card-value " id="em-mult">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">DEBT RATIO</span><span class="stat-card-value text-danger" id="em-debt">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">IMPLIED ROA</span><span class="stat-card-value text-primary" id="em-roa">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">IMPLIED ROE</span><span class="stat-card-value text-success" id="em-roev">—</span></div></div>
                
            </div>
            <div class="mt-4" id="equity-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="equity-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="equity-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-primary py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="equity-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calc(){
        const ta=parseFloat($('em-ta').value)||1,eq=parseFloat($('em-eq').value)||1,ni=parseFloat($('em-ni').value)||0,target=parseFloat($('em-roe').value)||0;
const mult=ta/eq,debtRatio=((ta-eq)/ta)*100,roa=(ni/ta)*100,roe=roa*mult;
$('equity-val').textContent=mult.toFixed(2)+'x';$('em-mult').textContent=mult.toFixed(2)+'x';$('em-debt').textContent=debtRatio.toFixed(1)+'%';$('em-roa').textContent=roa.toFixed(2)+'%';$('em-roev').textContent=roe.toFixed(2)+'%';
$('equity-st').textContent=mult<=2?'CONSERVATIVE':mult<=3?'MODERATE':'HIGH LEVERAGE';$('equity-st').style.color=mult<=2?'#22c55e':mult<=3?'#f59e0b':'#ef4444';
let i=[];i.push('Equity multiplier of <strong>'+mult.toFixed(2)+'x</strong> — each \$1 of equity supports <strong>'+fmt(ta/eq)+'</strong> in assets.');
i.push('Implied ROE via DuPont: ROA('+roa.toFixed(1)+'%) × EM('+mult.toFixed(1)+'x) = <strong>'+roe.toFixed(1)+'%</strong>.');
if(mult>3)i.push('⚠️ Leverage exceeds 3x. High financial risk if revenues decline.');
        $('equity-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['em-ta','em-eq','em-ni','em-roe'].forEach(id=>$(id).addEventListener('input',calc));
    $('equity-cb').addEventListener('click',calc);
    $('equity-cp').addEventListener('click',function(){navigator.clipboard.writeText('Equity Multiplier Calculator: '+$('equity-val').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('equity-rs').addEventListener('click',()=>{$('em-ta').value=1000000;$('em-eq').value=400000;$('em-ni').value=80000;$('em-roe').value=15;calc();});
    calc();
});
</script>
<style>
.equity-multiplier-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.equity-multiplier-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.equity-multiplier-calculator-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.equity-multiplier-calculator-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.equity-multiplier-calculator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.equity-multiplier-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>