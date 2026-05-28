<div class="row g-4 roa-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Net Income ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roa-net-income" class="form-control form-control-lg" value="500000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Total Assets ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roa-total-assets" class="form-control form-control-lg" value="2000000" min="1"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Interest Expense ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roa-interest" class="form-control form-control-lg" value="25000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Tax Rate (%)</label><div class="input-group"><input type="number" id="roa-tax-rate" class="form-control form-control-lg" value="21" min="0" max="50" step="1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Depreciation ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roa-depreciation" class="form-control form-control-lg" value="40000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Beginning Assets ($) <small class="text-muted">(for avg)</small></label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roa-begin-assets" class="form-control form-control-lg" value="1800000" min="0"></div></div>
                    <div class="col-md-6 d-flex align-items-end"><div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" id="roa-avg-toggle"><label class="form-check-label fw-bold small text-secondary" for="roa-avg-toggle">Use Average Assets</label></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:220;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero"><span class="output-hero-label">RETURN ON ASSETS (ROA)</span><div class="output-hero-value" id="roa-val">25.0%</div><span class="output-hero-unit" id="roa-status">EFFICIENT ASSET USAGE</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">NET INCOME</span><span class="stat-card-value text-success" id="roa-income-out">$500,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">TOTAL ASSETS</span><span class="stat-card-value text-primary" id="roa-assets-out">$2,000,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">ADJUSTED ROA</span><span class="stat-card-value" style="color:#f59e0b" id="roa-adj">26.0%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">ASSET TURNOVER</span><span class="stat-card-value" style="color:#a855f7" id="roa-turnover">0.50x</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Asset Utilization</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#3b82f6" id="roa-bar-assets">Assets</div>
                <div class="progress-bar bg-success" id="roa-bar-profit">Income</div>
            </div>
            <div class="mt-4" id="roa-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="roa-copy"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="roa-reset"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-primary py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="roa-calc-btn"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const ni=parseFloat($('roa-net-income').value)||0;
        const ta=parseFloat($('roa-total-assets').value)||1;
        const ie=parseFloat($('roa-interest').value)||0;
        const tr=(parseFloat($('roa-tax-rate').value)||0)/100;
        const dep=parseFloat($('roa-depreciation').value)||0;
        const ba=parseFloat($('roa-begin-assets').value)||0;
        const useAvg=$('roa-avg-toggle').checked;
        const assets=useAvg?((ba+ta)/2):ta;
        if(assets<=0){$('roa-val').textContent='N/A';return;}
        const roa=(ni/assets)*100;
        const adjustedROA=((ni+ie*(1-tr))/assets)*100;
        const turnover=ni>0?(ta/ni):0;
        $('roa-val').textContent=roa.toFixed(2)+'%';
        $('roa-income-out').textContent=fmt(ni);
        $('roa-assets-out').textContent=fmt(assets);
        $('roa-adj').textContent=adjustedROA.toFixed(2)+'%';
        $('roa-turnover').textContent=(ni/assets>0?(assets/ni).toFixed(2):'0.00')+'x';
        $('roa-status').textContent=roa>=10?'EFFICIENT ASSET USAGE':roa>=5?'MODERATE EFFICIENCY':'LOW ASSET EFFICIENCY';
        $('roa-status').style.color=roa>=10?'#22c55e':roa>=5?'#f59e0b':'#ef4444';
        const pct=Math.min((ni/assets)*100,100);
        $('roa-bar-assets').style.width=(100-pct)+'%';$('roa-bar-assets').textContent=Math.round(100-pct)+'% Assets';
        $('roa-bar-profit').style.width=pct+'%';$('roa-bar-profit').textContent=Math.round(pct)+'% Income';
        let ins=[];
        ins.push('Your ROA of <strong>'+roa.toFixed(2)+'%</strong> means for every $1 in assets, you generate <strong>'+fmt(ni/assets*100).replace('$','')+'¢</strong> of profit.');
        ins.push('After adjusting for interest expense (removing financing effects), the adjusted ROA is <strong>'+adjustedROA.toFixed(2)+'%</strong>.');
        if(dep>0)ins.push('Annual depreciation of <strong>'+fmt(dep)+'</strong> impacts asset base. Consider EBITDA-based adjustments for capital-intensive industries.');
        if(roa>=15)ins.push('🏆 Exceptional ROA! This level of asset efficiency is characteristic of best-in-class operators.');
        $('roa-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>ROA Analysis</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['roa-net-income','roa-total-assets','roa-interest','roa-tax-rate','roa-depreciation','roa-begin-assets'].forEach(id=>$(id).addEventListener('input',calculate));
    $('roa-avg-toggle').addEventListener('change',calculate);
    $('roa-calc-btn').addEventListener('click',calculate);
    $('roa-copy').addEventListener('click',function(){const t='ROA Summary\nNet Income: '+$('roa-net-income').value+'\nTotal Assets: '+$('roa-total-assets').value+'\nROA: '+$('roa-val').textContent+'\nAdjusted ROA: '+$('roa-adj').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('roa-reset').addEventListener('click',()=>{$('roa-net-income').value=500000;$('roa-total-assets').value=2000000;$('roa-interest').value=25000;$('roa-tax-rate').value=21;$('roa-depreciation').value=40000;$('roa-begin-assets').value=1800000;$('roa-avg-toggle').checked=false;calculate();});
    calculate();
});
</script>
<style>
.roa-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.roa-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.roa-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.roa-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.roa-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.roa-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\roa-calculator.blade.php ENDPATH**/ ?>