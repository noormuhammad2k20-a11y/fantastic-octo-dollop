<div class="row g-4 ros-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Net Sales / Revenue ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ros-rev" class="form-control form-control-lg" value="1000000" min="1"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">EBIT / Operating Profit ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ros-ebit" class="form-control form-control-lg" value="150000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">COGS ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ros-cogs" class="form-control form-control-lg" value="600000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Operating Expenses ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ros-opex" class="form-control form-control-lg" value="250000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Tax Rate (%)</label><div class="input-group"><input type="number" id="ros-tr" class="form-control form-control-lg" value="21" min="0" max="50"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:40;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero"><span class="output-hero-label">RETURN ON SALES</span><div class="output-hero-value" id="ros-val">15.0%</div><span class="output-hero-unit" id="ros-st">HEALTHY MARGIN</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">GROSS MARGIN</span><span class="stat-card-value text-success" id="ros-gm">40.0%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">NET MARGIN</span><span class="stat-card-value text-primary" id="ros-nm">11.9%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">OPERATING PROFIT</span><span class="stat-card-value" style="color:#f59e0b" id="ros-op">$150,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">COST RATIO</span><span class="stat-card-value" style="color:#a855f7" id="ros-cr">85.0%</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Revenue Breakdown</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar bg-danger" id="ros-b1">COGS</div>
                <div class="progress-bar" style="background:#f59e0b" id="ros-b2">OpEx</div>
                <div class="progress-bar bg-success" id="ros-b3">Profit</div>
            </div>
            <div class="mt-4" id="ros-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="ros-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="ros-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-warning py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="ros-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calc(){
        const rev=parseFloat($('ros-rev').value)||1,ebit=parseFloat($('ros-ebit').value)||0,cogs=parseFloat($('ros-cogs').value)||0,opex=parseFloat($('ros-opex').value)||0,tr=(parseFloat($('ros-tr').value)||0)/100;
        const ros=(ebit/rev)*100,grossMargin=((rev-cogs)/rev)*100,netMargin=(ebit*(1-tr)/rev)*100,costRatio=((cogs+opex)/rev)*100;
        $('ros-val').textContent=ros.toFixed(2)+'%';$('ros-gm').textContent=grossMargin.toFixed(1)+'%';$('ros-nm').textContent=netMargin.toFixed(1)+'%';$('ros-op').textContent=fmt(ebit);$('ros-cr').textContent=costRatio.toFixed(1)+'%';
        $('ros-st').textContent=ros>=15?'HEALTHY MARGIN':ros>=5?'MODERATE':'LOW MARGIN';$('ros-st').style.color=ros>=15?'#22c55e':ros>=5?'#f59e0b':'#ef4444';
        if(rev>0){const cp=(cogs/rev)*100,op=(opex/rev)*100,pp=Math.max(0,(ebit/rev)*100);$('ros-b1').style.width=cp+'%';$('ros-b1').textContent=Math.round(cp)+'% COGS';$('ros-b2').style.width=op+'%';$('ros-b2').textContent=Math.round(op)+'% OpEx';$('ros-b3').style.width=pp+'%';$('ros-b3').textContent=Math.round(pp)+'% Profit';}
        let i=[];i.push('ROS of <strong>'+ros.toFixed(2)+'%</strong> — you keep '+ros.toFixed(0)+'¢ of every revenue dollar as operating profit.');
        i.push('Gross margin is <strong>'+grossMargin.toFixed(1)+'%</strong>, after-tax net margin is <strong>'+netMargin.toFixed(1)+'%</strong>.');
        if(costRatio>90)i.push('⚠️ Cost ratio of '+costRatio.toFixed(0)+'% leaves thin margins. Consider expense optimization.');
        $('ros-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['ros-rev','ros-ebit','ros-cogs','ros-opex','ros-tr'].forEach(id=>$(id).addEventListener('input',calc));
    $('ros-cb').addEventListener('click',calc);
    $('ros-cp').addEventListener('click',function(){navigator.clipboard.writeText('ROS: '+$('ros-val').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('ros-rs').addEventListener('click',()=>{$('ros-rev').value=1000000;$('ros-ebit').value=150000;$('ros-cogs').value=600000;$('ros-opex').value=250000;$('ros-tr').value=21;calc();});
    calc();
});
</script>
<style>
.ros-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.ros-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.ros-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.ros-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.ros-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.ros-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ros-calculator.blade.php ENDPATH**/ ?>