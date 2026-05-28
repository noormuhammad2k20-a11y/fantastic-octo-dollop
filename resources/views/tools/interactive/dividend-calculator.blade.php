<div class="row g-4 div-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Initial Investment</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dv-invest" class="form-control form-control-lg" value="10000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Share Price</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dv-price" class="form-control form-control-lg" value="50" step="0.01" min="0.01"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Annual Dividend / Share</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dv-div" class="form-control form-control-lg" value="2.00" step="0.01" min="0"></div></div>
                    <div class="col-md-3"><label class="form-label-custom">Dividend Growth Rate</label><div class="input-group"><input type="number" id="dv-growth" class="form-control form-control-lg" value="5" step="0.1"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-3"><label class="form-label-custom">Years to Hold</label><input type="number" id="dv-years" class="form-control form-control-lg rounded-3" value="10" min="1" max="40"></div>
                    <div class="col-md-3"><label class="form-label-custom">Tax on Dividends</label><div class="input-group"><input type="number" id="dv-tax" class="form-control form-control-lg" value="15" min="0" max="50"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-3"><label class="form-label-custom">DRIP Reinvestment</label><select class="form-select form-select-lg rounded-3" id="dv-drip"><option value="1" selected>Yes — Reinvest</option><option value="0">No — Cash Out</option></select></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero"><span class="output-hero-label">TOTAL PORTFOLIO VALUE</span><div class="output-hero-value" id="dv-total">$16,289</div><span class="output-hero-unit" id="dv-label">After 10 Years with DRIP</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#6366f1;background:rgba(99,102,241,.02);"><span class="stat-card-label">CURRENT YIELD</span><span class="stat-card-value" style="color:#6366f1" id="dv-yield">4.00%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">YIELD ON COST</span><span class="stat-card-value text-success" id="dv-yoc">6.52%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">ANNUAL INCOME (Yr 10)</span><span class="stat-card-value text-warning" id="dv-annual">$652</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">TOTAL DIVIDENDS</span><span class="stat-card-value text-danger" id="dv-total-div">$4,802</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Value Composition</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#6366f1" id="dv-bar-orig">Original</div>
                <div class="progress-bar" style="background:#22c55e" id="dv-bar-div">Dividends</div>
            </div>
            <div class="mt-4" id="dv-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="dv-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Report</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="dv-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const invest=parseFloat($('dv-invest').value)||0,price=parseFloat($('dv-price').value)||1;
        const divPerShare=parseFloat($('dv-div').value)||0,growth=(parseFloat($('dv-growth').value)||0)/100;
        const years=parseInt($('dv-years').value)||0,tax=(parseFloat($('dv-tax').value)||0)/100;
        const drip=parseInt($('dv-drip').value);
        let shares=invest/price,totalDivs=0,annualDiv=divPerShare;
        for(let y=0;y<years;y++){
            const yearDiv=shares*annualDiv;
            const afterTax=yearDiv*(1-tax);
            totalDivs+=afterTax;
            if(drip)shares+=afterTax/price;
            annualDiv*=(1+growth);
        }
        const portfolioValue=shares*price;
        const currentYield=price>0?(divPerShare/price)*100:0;
        const yoc=invest>0?((shares>0?annualDiv/(1+growth):0)*shares/invest*100*(1-tax)):0;
        const finalAnnual=annualDiv/(1+growth)*shares*(1-tax);
        $('dv-total').textContent=fmt(portfolioValue);$('dv-label').textContent='After '+years+' Years'+(drip?' with DRIP':' Cash');
        $('dv-yield').textContent=currentYield.toFixed(2)+'%';$('dv-yoc').textContent=yoc.toFixed(2)+'%';
        $('dv-annual').textContent=fmt(finalAnnual);$('dv-total-div').textContent=fmt(totalDivs);
        if(portfolioValue>0){const op=(invest/portfolioValue)*100;$('dv-bar-orig').style.width=op+'%';$('dv-bar-orig').textContent=Math.round(op)+'% Principal';$('dv-bar-div').style.width=(100-op)+'%';$('dv-bar-div').textContent=Math.round(100-op)+'% Growth';}
        let ins=[];ins.push('Starting yield: <strong>'+currentYield.toFixed(2)+'%</strong> → Yield on cost by year '+years+': <strong>'+yoc.toFixed(2)+'%</strong>');
        ins.push('Total after-tax dividends received: <strong>'+fmt(totalDivs)+'</strong>');
        if(drip)ins.push('DRIP grew shares from <strong>'+(invest/price).toFixed(1)+'</strong> to <strong>'+shares.toFixed(1)+'</strong> shares.');
        ins.push('Final year income: <strong>'+fmt(finalAnnual)+'</strong> ('+fmt(finalAnnual/12)+'/month)');
        $('dv-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Dividend Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['dv-invest','dv-price','dv-div','dv-growth','dv-years','dv-tax','dv-drip'].forEach(id=>$(id).addEventListener('input',calculate));
    $('dv-copy').addEventListener('click',function(){const t='Dividend Report\nPortfolio: '+$('dv-total').textContent+'\nYield: '+$('dv-yield').textContent+'\nYOC: '+$('dv-yoc').textContent+'\nTotal Dividends: '+$('dv-total-div').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('dv-reset').addEventListener('click',()=>{$('dv-invest').value=10000;$('dv-price').value=50;$('dv-div').value=2;$('dv-growth').value=5;$('dv-years').value=10;$('dv-tax').value=15;$('dv-drip').value=1;calculate();});
    calculate();
});
</script>
<style>
.div-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.div-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.div-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.div-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.div-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.div-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

