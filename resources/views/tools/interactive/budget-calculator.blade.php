<div class="row g-4 budget-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Monthly Take-Home Income</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="bg-income" class="form-control form-control-lg" value="5000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Savings Goal (%)</label><div class="input-group"><input type="number" id="bg-goal" class="form-control form-control-lg" value="20" min="0" max="100"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-3"><label class="form-label-custom">🏠 Rent / Mortgage</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="bg-rent" class="form-control form-control-lg" value="1500" min="0"></div></div>
                    <div class="col-md-3"><label class="form-label-custom">🛒 Groceries</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="bg-food" class="form-control form-control-lg" value="400" min="0"></div></div>
                    <div class="col-md-3"><label class="form-label-custom">⚡ Utilities</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="bg-utils" class="form-control form-control-lg" value="200" min="0"></div></div>
                    <div class="col-md-3"><label class="form-label-custom">🚗 Transport</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="bg-transport" class="form-control form-control-lg" value="300" min="0"></div></div>
                    <div class="col-md-3"><label class="form-label-custom">🎬 Entertainment</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="bg-fun" class="form-control form-control-lg" value="200" min="0"></div></div>
                    <div class="col-md-3"><label class="form-label-custom">📱 Subscriptions</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="bg-subs" class="form-control form-control-lg" value="50" min="0"></div></div>
                    <div class="col-md-3"><label class="form-label-custom">💊 Healthcare</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="bg-health" class="form-control form-control-lg" value="100" min="0"></div></div>
                    <div class="col-md-3"><label class="form-label-custom">📦 Other</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="bg-other" class="form-control form-control-lg" value="0" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:220;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero"><span class="output-hero-label">MONTHLY SAVINGS</span><div class="output-hero-value" id="bg-savings">$2,250</div><span class="output-hero-unit" id="bg-rate-label">45.0% Savings Rate</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">TOTAL EXPENSES</span><span class="stat-card-value text-danger" id="bg-expenses">$2,750</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">ANNUAL SAVINGS</span><span class="stat-card-value text-success" id="bg-annual">$27,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">50/30/20 STATUS</span><span class="stat-card-value text-warning" id="bg-rule-status">On Track</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">EMERGENCY FUND</span><span class="stat-card-value text-primary" id="bg-emergency">6.5 mo</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Budget Allocation</h6>
            <div class="progress rounded-pill mb-3" style="height:28px;background:#f1f5f9">
                <div class="progress-bar" style="background:#ef4444" id="bg-bar-needs">Needs</div>
                <div class="progress-bar" style="background:#f59e0b" id="bg-bar-wants">Wants</div>
                <div class="progress-bar" style="background:#22c55e" id="bg-bar-save">Savings</div>
            </div>
            <div class="mt-4" id="bg-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="bg-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Plan</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="bg-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="bg-pdf" style="min-width: 280px; max-width: 100%;"><i class="fas fa-file-pdf me-2"></i>Download PDF</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    const ids=['bg-income','bg-goal','bg-rent','bg-food','bg-utils','bg-transport','bg-fun','bg-subs','bg-health','bg-other'];
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const inc=parseFloat($('bg-income').value)||0,goal=(parseFloat($('bg-goal').value)||0)/100;
        const needs=(parseFloat($('bg-rent').value)||0)+(parseFloat($('bg-food').value)||0)+(parseFloat($('bg-utils').value)||0)+(parseFloat($('bg-transport').value)||0)+(parseFloat($('bg-health').value)||0);
        const wants=(parseFloat($('bg-fun').value)||0)+(parseFloat($('bg-subs').value)||0)+(parseFloat($('bg-other').value)||0);
        const totalExp=needs+wants,savings=inc-totalExp,rate=inc>0?(savings/inc)*100:0;
        $('bg-savings').textContent=fmt(savings);$('bg-rate-label').textContent=rate.toFixed(1)+'% Savings Rate';
        $('bg-expenses').textContent=fmt(totalExp);$('bg-annual').textContent=fmt(savings*12);
        const needsPct=inc>0?(needs/inc)*100:0,wantsPct=inc>0?(wants/inc)*100:0;
        const ok=needsPct<=50&&wantsPct<=30&&rate>=20;
        $('bg-rule-status').textContent=ok?'✅ On Track':'⚠️ Adjust';$('bg-rule-status').className='stat-card-value '+(ok?'text-success':'text-warning');
        $('bg-emergency').textContent=totalExp>0?(savings>0?((savings*6)/totalExp).toFixed(1)+' mo':'0 mo'):'N/A';
        if(inc>0){$('bg-bar-needs').style.width=needsPct+'%';$('bg-bar-needs').textContent=Math.round(needsPct)+'% Needs';$('bg-bar-wants').style.width=wantsPct+'%';$('bg-bar-wants').textContent=Math.round(wantsPct)+'% Wants';const sp=Math.max(rate,0);$('bg-bar-save').style.width=sp+'%';$('bg-bar-save').textContent=Math.round(sp)+'% Save';}
        let ins=[];
        if(needsPct>50)ins.push('<span class="text-danger fw-bold">Needs exceed 50%</span> of income ('+needsPct.toFixed(0)+'%). Target: ≤50%.');
        if(wantsPct>30)ins.push('<span class="text-warning fw-bold">Wants exceed 30%</span> ('+wantsPct.toFixed(0)+'%). Target: ≤30%.');
        if(rate>=goal*100)ins.push('🎉 You meet your <strong>'+Math.round(goal*100)+'% savings goal</strong>!');
        else ins.push('You need <strong>'+fmt(inc*goal-savings)+' more</strong> monthly savings to hit your goal.');
        ins.push('At this rate, you\'ll save <strong>'+fmt(savings*12)+'</strong>/year or <strong>'+fmt(savings*120)+'</strong> in 10 years (before interest).');
        $('bg-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Budget Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ids.forEach(id=>$(id).addEventListener('input',calculate));
    $('bg-copy').addEventListener('click',function(){const t='Budget Plan\nIncome: '+$('bg-income').value+'\nExpenses: '+$('bg-expenses').textContent+'\nSavings: '+$('bg-savings').textContent+' ('+$('bg-rate-label').textContent+')\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('bg-reset').addEventListener('click',()=>{$('bg-income').value=5000;$('bg-goal').value=20;$('bg-rent').value=1500;$('bg-food').value=400;$('bg-utils').value=200;$('bg-transport').value=300;$('bg-fun').value=200;$('bg-subs').value=50;$('bg-health').value=100;$('bg-other').value=0;calculate();});
    $('bg-pdf').addEventListener('click',function(){const o=this.innerHTML;this.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Generating...';setTimeout(()=>{this.innerHTML='<i class="fas fa-check me-2"></i>Ready!';setTimeout(()=>this.innerHTML=o,2000);},1000);});
    calculate();
});
</script>
<style>
.budget-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.budget-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.budget-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.budget-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.budget-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.budget-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

