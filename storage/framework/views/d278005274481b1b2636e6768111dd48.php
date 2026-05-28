<div class="row g-4 inf-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Original Amount</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="inf-amt" class="form-control form-control-lg" value="100" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">From Year</label><select id="inf-start" class="form-select form-select-lg rounded-3"></select></div>
                    <div class="col-md-4"><label class="form-label-custom">To Year</label><select id="inf-end" class="form-select form-select-lg rounded-3"></select></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero"><span class="output-hero-label" id="inf-hero-label">EQUIVALENT VALUE IN 2024</span><div class="output-hero-value" id="inf-total">$3,240</div><span class="output-hero-unit" id="inf-total-pct">+234% Total Inflation</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-4"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">PURCHASING POWER LOSS</span><span class="stat-card-value text-danger" id="inf-loss">-54.2%</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">AVG. ANNUAL RATE</span><span class="stat-card-value text-primary" id="inf-avg">3.12%</span></div></div>
                <div class="col-md-4"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">PRICE MULTIPLIER</span><span class="stat-card-value text-warning" id="inf-mult">32.4x</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-history me-2 text-primary"></i>Historical Benchmarks (CPI)</h6>
            <div id="inf-benchmarks" class="d-flex flex-wrap gap-2"></div>
            <div class="mt-4" id="inf-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="inf-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="inf-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    const cpi={1913:9.9,1920:20.0,1930:16.7,1940:14.0,1950:24.1,1960:29.6,1970:38.8,1980:82.4,1990:130.7,2000:172.2,2010:218.0,2020:258.8,2024:312.5};
    const years=Object.keys(cpi).map(Number);
    const sY=Math.min(...years),eY=Math.max(...years),fullCPI={};
    for(let y=sY;y<=eY;y++){if(cpi[y]){fullCPI[y]=cpi[y];}else{let pY=years.filter(v=>v<y).pop(),nY=years.filter(v=>v>y)[0];let r=(y-pY)/(nY-pY);fullCPI[y]=cpi[pY]+r*(cpi[nY]-cpi[pY]);}}
    for(let y=eY;y>=sY;y--){$('inf-start').options.add(new Option(y,y));$('inf-end').options.add(new Option(y,y));}
    $('inf-start').value=1990;$('inf-end').value=2024;
    function fmt(v){return'$'+v.toLocaleString(undefined,{maximumFractionDigits:v>1000?0:2});}
    function calculate(){
        const start=parseInt($('inf-start').value),end=parseInt($('inf-end').value),amt=parseFloat($('inf-amt').value)||0;
        const mult=fullCPI[end]/fullCPI[start],res=amt*mult,totalInf=(mult-1)*100,yrs=Math.abs(end-start)||1;
        const avg=(Math.pow(mult,1/yrs)-1)*100,loss=(1-(1/mult))*100;
        $('inf-hero-label').textContent='EQUIVALENT VALUE IN '+end;
        $('inf-total').textContent=fmt(res);$('inf-total-pct').textContent=(totalInf>=0?'+':'')+totalInf.toFixed(1)+'% Total Change';
        $('inf-loss').textContent=(totalInf>=0?'-':'+')+Math.abs(loss).toFixed(1)+'%';
        $('inf-avg').textContent=avg.toFixed(2)+'% / yr';$('inf-mult').textContent=mult.toFixed(2)+'x';
        let ins=[];ins.push('A basket of goods costing <strong>'+fmt(amt)+'</strong> in '+start+' would cost <strong>'+fmt(res)+'</strong> in '+end+'.');
        ins.push('Total inflation over this period: <strong>'+totalInf.toFixed(1)+'%</strong>');
        if(totalInf>100)ins.push('The value of your money has more than doubled due to inflation.');
        $('inf-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Inflation Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
        let bHtml='';[1913,1950,1980,2000,2024].forEach(y=>{bHtml+='<span class="badge bg-light text-dark border p-2">'+y+': '+fullCPI[y].toFixed(1)+'</span>';});
        $('inf-benchmarks').innerHTML=bHtml;
    }
    ['inf-amt','inf-start','inf-end'].forEach(id=>$(id).addEventListener('input',calculate));
    $('inf-copy').addEventListener('click',function(){const t='Inflation Comparison\n'+$('inf-start').value+': '+fmt(parseFloat($('inf-amt').value))+'\n'+$('inf-end').value+': '+$('inf-total').textContent+'\nChange: '+$('inf-total-pct').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('inf-reset').addEventListener('click',()=>{$('inf-amt').value=100;$('inf-start').value=1990;$('inf-end').value=2024;calculate();});
    calculate();
});
</script>
<style>
.inf-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.inf-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.inf-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.inf-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.inf-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.inf-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\inflation-calculator.blade.php ENDPATH**/ ?>