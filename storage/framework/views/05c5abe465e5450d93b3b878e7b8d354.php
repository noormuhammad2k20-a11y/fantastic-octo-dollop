<div class="row g-4 dti-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Gross Monthly Income</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dti-income" class="form-control form-control-lg" value="6000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Spouse/Partner Income</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dti-income2" class="form-control form-control-lg" value="0" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">🏠 Mortgage/Rent</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dti-mortgage" class="form-control form-control-lg" value="1200" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">🚗 Car Payment</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dti-car" class="form-control form-control-lg" value="400" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">🎓 Student Loans</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dti-student" class="form-control form-control-lg" value="300" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">💳 Credit Cards (Min)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dti-credit" class="form-control form-control-lg" value="150" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">👶 Child Support</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dti-child" class="form-control form-control-lg" value="0" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">📦 Other Debts</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dti-other" class="form-control form-control-lg" value="0" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="dti-card" style="--tool-hue:25;--tool-color:#ea580c;--tool-bg:rgba(234,88,12,.04);">
            <div class="output-hero"><span class="output-hero-label">DEBT-TO-INCOME RATIO</span><div class="d-flex justify-content-center align-items-baseline gap-2"><span class="output-hero-value" id="dti-ratio">34.2</span><span class="output-hero-unit">%</span></div><div class="mt-2"><span class="badge rounded-pill px-4 py-2 fw-bold" id="dti-status">ACCEPTABLE</span></div></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">TOTAL DEBT</span><span class="stat-card-value text-danger" id="dti-debt">$2,050</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">TOTAL INCOME</span><span class="stat-card-value text-success" id="dti-total-inc">$6,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">FRONT-END DTI</span><span class="stat-card-value text-primary" id="dti-front">20.0%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">FREE INCOME</span><span class="stat-card-value text-warning" id="dti-free">$3,950</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-bar me-2 text-primary"></i>DTI Gauge</h6>
            <div class="progress mb-2" style="height:24px;border-radius:12px;background:rgba(0,0,0,.05)"><div id="dti-prog" class="progress-bar" style="width:34%;background:linear-gradient(90deg,#10b981 0%,#f59e0b 50%,#ef4444 100%)"></div></div>
            <div class="d-flex justify-content-between small fw-bold text-muted px-1"><span>0% Excellent</span><span>36% Max Conv.</span><span>43% Max FHA</span><span>50%+</span></div>
            <div class="mt-4" id="dti-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="dti-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Report</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="dti-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    const ids=['dti-income','dti-income2','dti-mortgage','dti-car','dti-student','dti-credit','dti-child','dti-other'];
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const inc=(parseFloat($('dti-income').value)||0)+(parseFloat($('dti-income2').value)||0);
        const mort=parseFloat($('dti-mortgage').value)||0;
        const debt=mort+(parseFloat($('dti-car').value)||0)+(parseFloat($('dti-student').value)||0)+(parseFloat($('dti-credit').value)||0)+(parseFloat($('dti-child').value)||0)+(parseFloat($('dti-other').value)||0);
        const ratio=inc>0?(debt/inc)*100:0,front=inc>0?(mort/inc)*100:0,free=inc-debt;
        $('dti-ratio').textContent=ratio.toFixed(1);$('dti-debt').textContent=fmt(debt);$('dti-total-inc').textContent=fmt(inc);
        $('dti-front').textContent=front.toFixed(1)+'%';$('dti-free').textContent=fmt(free);
        $('dti-prog').style.width=Math.min(ratio,100)+'%';
        const st=$('dti-status'),cd=$('dti-card');
        if(ratio<=20){st.textContent='EXCELLENT';st.className='badge rounded-pill px-4 py-2 fw-bold bg-success';}
        else if(ratio<=36){st.textContent='GOOD — CONVENTIONAL OK';st.className='badge rounded-pill px-4 py-2 fw-bold bg-info';}
        else if(ratio<=43){st.textContent='FAIR — FHA ELIGIBLE';st.className='badge rounded-pill px-4 py-2 fw-bold bg-warning text-dark';}
        else if(ratio<=50){st.textContent='HIGH RISK';st.className='badge rounded-pill px-4 py-2 fw-bold bg-danger';}
        else{st.textContent='CRITICAL — OVER LIMIT';st.className='badge rounded-pill px-4 py-2 fw-bold bg-dark';}
        let ins=[];
        if(ratio<=36)ins.push('Your DTI qualifies for <strong>conventional mortgages</strong> (max 36%).');
        else ins.push('You need to reduce debt by <strong>'+fmt(debt-inc*0.36)+'/mo</strong> to qualify for conventional loans.');
        if(front<=28)ins.push('Front-end ratio ('+front.toFixed(1)+'%) is within the <strong>28% guideline</strong>.');
        else ins.push('<span class="text-danger">Front-end ratio exceeds 28%</span>. Lenders prefer housing costs below 28% of income.');
        ins.push('Monthly disposable income after debts: <strong>'+fmt(free)+'</strong>');
        ins.push('Annual debt service: <strong>'+fmt(debt*12)+'</strong> — that\'s '+Math.round(ratio)+'% of your gross earnings.');
        $('dti-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Lending Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ids.forEach(id=>$(id).addEventListener('input',calculate));
    $('dti-copy').addEventListener('click',function(){const t='DTI Report\nRatio: '+$('dti-ratio').textContent+'%\nStatus: '+$('dti-status').textContent+'\nDebt: '+$('dti-debt').textContent+'\nIncome: '+$('dti-total-inc').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('dti-reset').addEventListener('click',()=>{$('dti-income').value=6000;$('dti-income2').value=0;$('dti-mortgage').value=1200;$('dti-car').value=400;$('dti-student').value=300;$('dti-credit').value=150;$('dti-child').value=0;$('dti-other').value=0;calculate();});
    calculate();
});
</script>
<style>
.dti-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.dti-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.dti-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.dti-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.dti-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.dti-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\dti-calculator.blade.php ENDPATH**/ ?>