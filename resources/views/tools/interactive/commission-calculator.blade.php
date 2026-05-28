<div class="row g-4 commission-calculator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Total Sale Amount ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cm-sale" class="form-control form-control-lg" value="10000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Commission Rate (%)</label><div class="input-group"><input type="number" id="cm-rate" class="form-control form-control-lg" value="5" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Base Salary ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cm-base" class="form-control form-control-lg" value="2000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Bonus Threshold ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="cm-bonus" class="form-control form-control-lg" value="50000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Bonus Rate (%)</label><div class="input-group"><input type="number" id="cm-bonus-rate" class="form-control form-control-lg" value="2" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:25;--tool-color:#f97316;--tool-bg:rgba(25,25,25,.04);">
            <div class="output-hero"><span class="output-hero-label">Commission Calculator</span><div class="output-hero-value" id="commission-val">—</div><span class="output-hero-unit" id="commission-st">CALCULATING</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">COMMISSION</span><span class="stat-card-value text-success" id="cm-comm">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">TOTAL PAY</span><span class="stat-card-value text-primary" id="cm-total">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">EFFECTIVE RATE</span><span class="stat-card-value " id="cm-eff">—</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(0,0,0,.02,.02);"><span class="stat-card-label">NET PER SALE</span><span class="stat-card-value " id="cm-net">—</span></div></div>
                
            </div>
            <div class="mt-4" id="commission-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="commission-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="commission-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-primary py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="commission-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calc(){
        const s=parseFloat($('cm-sale').value)||0,r=(parseFloat($('cm-rate').value)||0)/100,b=parseFloat($('cm-base').value)||0,bt=parseFloat($('cm-bonus').value)||0,br=(parseFloat($('cm-bonus-rate').value)||0)/100;
const comm=s*r;const bonus=s>=bt?s*br:0;const total=b+comm+bonus;const eff=s>0?((comm+bonus)/s*100):0;
$('commission-val').textContent=fmt(comm);$('cm-comm').textContent=fmt(comm);$('cm-total').textContent=fmt(total);$('cm-eff').textContent=eff.toFixed(1)+'%';$('cm-net').textContent=fmt(comm+bonus);
$('commission-st').textContent=comm>0?'COMMISSION EARNED':'NO COMMISSION';$('commission-st').style.color=comm>0?'#22c55e':'#ef4444';
let i=[];i.push('Commission of <strong>'+fmt(comm)+'</strong> on sale of <strong>'+fmt(s)+'</strong> at '+r*100+'%.');
if(bonus>0)i.push('🎯 Bonus of <strong>'+fmt(bonus)+'</strong> triggered (sale exceeded '+fmt(bt)+' threshold).');
i.push('Total compensation: <strong>'+fmt(total)+'</strong> (base + commission + bonus).');
        $('commission-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['cm-sale','cm-rate','cm-base','cm-bonus','cm-bonus-rate'].forEach(id=>$(id).addEventListener('input',calc));
    $('commission-cb').addEventListener('click',calc);
    $('commission-cp').addEventListener('click',function(){navigator.clipboard.writeText('Commission Calculator: '+$('commission-val').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('commission-rs').addEventListener('click',()=>{$('cm-sale').value=10000;$('cm-rate').value=5;$('cm-base').value=2000;$('cm-bonus').value=50000;$('cm-bonus-rate').value=2;calc();});
    calc();
});
</script>
<style>
.commission-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.commission-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.commission-calculator-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.commission-calculator-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.commission-calculator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.commission-calculator-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>