<div class="row g-4 gaap-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Asset Cost</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ga-cost" class="form-control form-control-lg" value="50000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Salvage Value</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="ga-salvage" class="form-control form-control-lg" value="5000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Useful Life (Years)</label><input type="number" id="ga-life" class="form-control form-control-lg rounded-3" value="5" min="1" max="40"></div>
                    <div class="col-md-6"><label class="form-label-custom">Method</label><select class="form-select form-select-lg rounded-3" id="ga-method"><option value="sl" selected>Straight-Line</option><option value="ddb">Double-Declining Balance</option><option value="syd">Sum-of-Years' Digits</option></select></div>
                    <div class="col-md-6"><label class="form-label-custom">Tax Rate</label><div class="input-group"><input type="number" id="ga-tax" class="form-control form-control-lg" value="25" min="0" max="50"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero"><span class="output-hero-label">ANNUAL DEPRECIATION (YR 1)</span><div class="output-hero-value" id="ga-annual">$9,000</div><span class="output-hero-unit" id="ga-method-label">Straight-Line Method</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#6366f1;background:rgba(99,102,241,.02);"><span class="stat-card-label">DEPRECIABLE BASE</span><span class="stat-card-value" style="color:#6366f1" id="ga-base">$45,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">ANNUAL TAX SHIELD</span><span class="stat-card-value text-success" id="ga-shield">$2,250</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">BOOK VALUE (END YR 1)</span><span class="stat-card-value text-warning" id="ga-book">$41,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">TOTAL TAX BENEFIT</span><span class="stat-card-value text-danger" id="ga-total-shield">$11,250</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Depreciation Schedule</h6>
            <div class="table-responsive"><table class="table table-sm table-bordered" id="ga-table"><thead class="table-light"><tr><th>Year</th><th>Depreciation</th><th>Book Value</th><th>Tax Shield</th></tr></thead><tbody></tbody></table></div>
            <div class="mt-4" id="ga-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ga-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Schedule</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ga-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const cost=parseFloat($('ga-cost').value)||0,salv=parseFloat($('ga-salvage').value)||0;
        const life=parseInt($('ga-life').value)||1,method=$('ga-method').value;
        const tax=(parseFloat($('ga-tax').value)||0)/100;
        const base=cost-salv;
        let schedule=[],book=cost,totalShield=0;
        const methods={sl:'Straight-Line',ddb:'Double-Declining Balance',syd:"Sum-of-Years' Digits"};
        for(let y=1;y<=life;y++){
            let dep=0;
            if(method==='sl')dep=base/life;
            else if(method==='ddb'){dep=(2/life)*book;if(book-dep<salv)dep=book-salv;}
            else{const syd=life*(life+1)/2;dep=base*((life-y+1)/syd);}
            dep=Math.max(dep,0);book=Math.max(book-dep,salv);
            const shield=dep*tax;totalShield+=shield;
            schedule.push({y,dep,book,shield});
        }
        $('ga-annual').textContent=fmt(schedule[0]?.dep||0);
        $('ga-method-label').textContent=methods[method]+' Method';
        $('ga-base').textContent=fmt(base);
        $('ga-shield').textContent=fmt(schedule[0]?.shield||0);
        $('ga-book').textContent=fmt(schedule[0]?.book||0);
        $('ga-total-shield').textContent=fmt(totalShield);
        let tbody='';schedule.forEach(r=>{tbody+='<tr><td>'+r.y+'</td><td>'+fmt(r.dep)+'</td><td>'+fmt(r.book)+'</td><td class="text-success">'+fmt(r.shield)+'</td></tr>';});
        $('ga-table').querySelector('tbody').innerHTML=tbody;
        let ins=[];ins.push(methods[method]+': Year 1 expense = <strong>'+fmt(schedule[0]?.dep||0)+'</strong>');
        ins.push('Total tax benefit over '+life+' years: <strong>'+fmt(totalShield)+'</strong>');
        if(method==='ddb')ins.push('DDB front-loads deductions — ideal for assets losing value quickly.');
        $('ga-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Accounting Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['ga-cost','ga-salvage','ga-life','ga-method','ga-tax'].forEach(id=>$(id).addEventListener('input',calculate));
    $('ga-copy').addEventListener('click',function(){const rows=document.querySelectorAll('#ga-table tbody tr');let t='Depreciation Schedule\n';rows.forEach(r=>{const c=r.querySelectorAll('td');t+='Year '+c[0].textContent+': '+c[1].textContent+' | BV: '+c[2].textContent+'\n';});t+='— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('ga-reset').addEventListener('click',()=>{$('ga-cost').value=50000;$('ga-salvage').value=5000;$('ga-life').value=5;$('ga-method').value='sl';$('ga-tax').value=25;calculate();});
    calculate();
});
</script>
<style>
.gaap-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.gaap-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.gaap-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.gaap-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.gaap-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.gaap-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

