<div class="row g-4 roi-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Initial Investment Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roi-cost" class="form-control form-control-lg" value="10000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Final Value / Total Gain</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="roi-gain" class="form-control form-control-lg" value="12500" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:25;--tool-color:#f97316;--tool-bg:rgba(249,115,22,.04);">
            <div class="output-hero"><span class="output-hero-label">RETURN ON INVESTMENT</span><div class="output-hero-value" id="roi-val">25.0%</div><span class="output-hero-unit" id="roi-status">PROFITABLE INVESTMENT</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">NET PROFIT</span><span class="stat-card-value text-success" id="roi-profit">$2,500</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">INVESTMENT MULTIPLE</span><span class="stat-card-value text-primary" id="roi-mult">1.25x</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">COST RATIO</span><span class="stat-card-value" style="color:#a855f7" id="roi-ratio">80.0%</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>Investment Distribution</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#3b82f6" id="roi-bar-cost">Initial Cost</div>
                <div class="progress-bar" style="background:#22c55e" id="roi-bar-profit">Net Profit</div>
            </div>
            <div class="mt-4" id="roi-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="roi-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="roi-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const cost=parseFloat($('roi-cost').value)||0,gain=parseFloat($('roi-gain').value)||0;
        if(cost===0){$('roi-val').textContent='0%';return;}
        const profit=gain-cost,roi=(profit/cost)*100,mult=gain/cost;
        $('roi-val').textContent=roi.toFixed(1)+'%';$('roi-profit').textContent=fmt(profit);
        $('roi-mult').textContent=mult.toFixed(2)+'x';$('roi-ratio').textContent=((cost/gain)*100).toFixed(1)+'%';
        $('roi-status').textContent=roi>=0?'PROFITABLE INVESTMENT':'NEGATIVE ROI (LOSS)';
        $('roi-status').style.color=roi>=0?'#22c55e':'#ef4444';
        if(gain>0){
            const cp=(cost/gain)*100,pp=(Math.max(0,profit)/gain)*100;
            $('roi-bar-cost').style.width=cp+'%';$('roi-bar-cost').textContent=Math.round(cp)+'% Cost';
            $('roi-bar-profit').style.width=pp+'%';$('roi-bar-profit').textContent=Math.round(pp)+'% Profit';
            $('roi-bar-profit').className='progress-bar '+(roi>=0?'bg-success':'bg-danger');
        }
        let ins=[];ins.push('You earned <strong>'+fmt(profit)+'</strong> on top of your initial <strong>'+fmt(cost)+'</strong> investment.');
        ins.push('For every $1 invested, you got back <strong>'+fmt(mult)+'</strong>.');
        if(roi>50)ins.push('🚀 Exceptional ROI! This investment has performed significantly better than market averages.');
        $('roi-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>ROI Analysis</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['roi-cost','roi-gain'].forEach(id=>$(id).addEventListener('input',calculate));
    $('roi-copy').addEventListener('click',function(){const t='ROI Summary\nInvestment: '+$('roi-cost').value+'\nGain: '+$('roi-gain').value+'\nROI: '+$('roi-val').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('roi-reset').addEventListener('click',()=>{$('roi-cost').value=10000;$('roi-gain').value=12500;calculate();});
    calculate();
});
</script>
<style>
.roi-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.roi-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.roi-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.roi-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.roi-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.roi-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\roi-calculator.blade.php ENDPATH**/ ?>