<div class="row g-4 roe-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Net Income ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roe-ni" class="form-control form-control-lg" value="250000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Shareholder Equity ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roe-eq" class="form-control form-control-lg" value="1000000" min="1"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Preferred Dividends ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roe-pd" class="form-control form-control-lg" value="0" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Beginning Equity ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roe-be" class="form-control form-control-lg" value="900000" min="1"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Equity Method</label><select id="roe-m" class="form-select form-select-lg"><option value="current">Current</option><option value="average" selected>Average</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Total Assets ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roe-ta" class="form-control form-control-lg" value="2500000" min="1"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Total Revenue ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roe-rv" class="form-control form-control-lg" value="3000000" min="1"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Tax Rate (%)</label><div class="input-group"><input type="number" id="roe-tx" class="form-control form-control-lg" value="21" min="0" max="50"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:140;--tool-color:#22c55e;--tool-bg:rgba(34,197,94,.04);">
            <div class="output-hero"><span class="output-hero-label">RETURN ON EQUITY</span><div class="output-hero-value" id="roe-val">25.0%</div><span class="output-hero-unit" id="roe-st">STRONG RETURNS</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">PROFIT MARGIN</span><span class="stat-card-value text-primary" id="roe-pm">8.3%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">ASSET TURNOVER</span><span class="stat-card-value" style="color:#f59e0b" id="roe-at">1.20x</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">EQUITY MULT</span><span class="stat-card-value" style="color:#a855f7" id="roe-em">2.50x</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">DUPONT ROE</span><span class="stat-card-value text-success" id="roe-dp">25.0%</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>DuPont Decomposition</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#3b82f6" id="roe-b1">Margin</div>
                <div class="progress-bar" style="background:#f59e0b" id="roe-b2">Turnover</div>
                <div class="progress-bar" style="background:#a855f7" id="roe-b3">Leverage</div>
            </div>
            <div class="mt-4" id="roe-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="roe-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="roe-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-success py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="roe-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calc(){
        const ni=parseFloat($('roe-ni').value)||0,eq=parseFloat($('roe-eq').value)||1,pd=parseFloat($('roe-pd').value)||0,be=parseFloat($('roe-be').value)||1,ta=parseFloat($('roe-ta').value)||1,rv=parseFloat($('roe-rv').value)||1;
        const eqUsed=$('roe-m').value==='average'?((eq+be)/2):eq;
        if(eqUsed<=0){$('roe-val').textContent='N/A';return;}
        const roe=((ni-pd)/eqUsed)*100,pm=(ni/rv)*100,at=rv/ta,em=ta/eqUsed,dp=pm*at*em/100;
        $('roe-val').textContent=roe.toFixed(2)+'%';$('roe-pm').textContent=pm.toFixed(1)+'%';$('roe-at').textContent=at.toFixed(2)+'x';$('roe-em').textContent=em.toFixed(2)+'x';$('roe-dp').textContent=dp.toFixed(2)+'%';
        $('roe-st').textContent=roe>=15?'STRONG RETURNS':roe>=8?'MODERATE':'WEAK';$('roe-st').style.color=roe>=15?'#22c55e':roe>=8?'#f59e0b':'#ef4444';
        const t=pm+at*10+em*10;$('roe-b1').style.width=(pm/t*100)+'%';$('roe-b2').style.width=(at*10/t*100)+'%';$('roe-b3').style.width=(em*10/t*100)+'%';
        let i=[];i.push('ROE of <strong>'+roe.toFixed(2)+'%</strong> — shareholders earn '+roe.toFixed(1)+'¢ per $1 equity.');
        i.push('DuPont: <strong>'+pm.toFixed(1)+'%</strong> margin × <strong>'+at.toFixed(2)+'x</strong> turnover × <strong>'+em.toFixed(2)+'x</strong> leverage.');
        if(em>3)i.push('⚠️ High leverage. ROE may be inflated by debt.');
        if(roe>=20)i.push('🏆 Exceptional ROE — top-tier value creation.');
        $('roe-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['roe-ni','roe-eq','roe-pd','roe-be','roe-ta','roe-rv','roe-tx'].forEach(id=>$(id).addEventListener('input',calc));
    $('roe-m').addEventListener('change',calc);$('roe-cb').addEventListener('click',calc);
    $('roe-cp').addEventListener('click',function(){navigator.clipboard.writeText('ROE: '+$('roe-val').textContent+' | DuPont: '+$('roe-dp').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('roe-rs').addEventListener('click',()=>{$('roe-ni').value=250000;$('roe-eq').value=1000000;$('roe-pd').value=0;$('roe-be').value=900000;$('roe-m').value='average';$('roe-ta').value=2500000;$('roe-rv').value=3000000;$('roe-tx').value=21;calc();});
    calc();
});
</script>
<style>
.roe-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.roe-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.roe-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.roe-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.roe-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.roe-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>
