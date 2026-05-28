<div class="row g-4 dpr-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Total Dividends Paid ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dpr-div" class="form-control form-control-lg" value="50000" min="0"></div></div>
                    <div class="col-md-6"><label class="form-label-custom">Net Income ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dpr-ni" class="form-control form-control-lg" value="150000" min="1"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Shares Outstanding</label><input type="number" id="dpr-shares" class="form-control form-control-lg" value="100000" min="1"></div>
                    <div class="col-md-4"><label class="form-label-custom">Dividend Per Share ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dpr-dps" class="form-control form-control-lg" value="0.50" min="0" step="0.01"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">EPS ($)</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="dpr-eps" class="form-control form-control-lg" value="1.50" min="0.01" step="0.01"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:50;--tool-color:#eab308;--tool-bg:rgba(234,179,8,.04);">
            <div class="output-hero"><span class="output-hero-label">DIVIDEND PAYOUT RATIO</span><div class="output-hero-value" id="dpr-val">33.3%</div><span class="output-hero-unit" id="dpr-st">SUSTAINABLE</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">RETENTION RATIO</span><span class="stat-card-value text-success" id="dpr-rr">66.7%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">DPS / EPS</span><span class="stat-card-value text-primary" id="dpr-pe">33.3%</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">RETAINED EARNINGS</span><span class="stat-card-value" style="color:#f59e0b" id="dpr-re">$100,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">COVERAGE</span><span class="stat-card-value" style="color:#a855f7" id="dpr-cov">3.0x</span></div></div>
            </div>
            <div class="mt-4" id="dpr-ins"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-4"><button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="dpr-cp"><i class="fas fa-copy me-2"></i>Copy Summary</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="dpr-rs"><i class="fas fa-rotate-left me-2"></i>Reset Fields</button></div>
                <div class="col-md-4"><button class="btn d-block mx-auto btn-outline-warning py-3 px-4 fw-bold rounded-pill shadow-sm w-100" id="dpr-cb"><i class="fas fa-calculator me-2"></i>Calculate</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calc(){
        const div=parseFloat($('dpr-div').value)||0,ni=parseFloat($('dpr-ni').value)||1,sh=parseFloat($('dpr-shares').value)||1,dps=parseFloat($('dpr-dps').value)||0,eps=parseFloat($('dpr-eps').value)||0.01;
        const payout=(div/ni)*100,retention=100-payout,retained=ni-div,coverage=ni/Math.max(div,1),perShare=(dps/eps)*100;
        $('dpr-val').textContent=payout.toFixed(1)+'%';$('dpr-rr').textContent=retention.toFixed(1)+'%';$('dpr-pe').textContent=perShare.toFixed(1)+'%';$('dpr-re').textContent=fmt(retained);$('dpr-cov').textContent=coverage.toFixed(1)+'x';
        $('dpr-st').textContent=payout<=50?'SUSTAINABLE':payout<=80?'MODERATE RISK':'HIGH RISK';$('dpr-st').style.color=payout<=50?'#22c55e':payout<=80?'#f59e0b':'#ef4444';
        let i=[];i.push('Payout ratio of <strong>'+payout.toFixed(1)+'%</strong> — the company retains <strong>'+retention.toFixed(1)+'%</strong> of earnings.');
        i.push('Dividend coverage is <strong>'+coverage.toFixed(1)+'x</strong>. Coverage >2x generally indicates safety.');
        if(payout>90)i.push('⚠️ Dangerously high payout ratio. The dividend may be cut if earnings decline.');
        $('dpr-ins').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Analysis</h6><ul class="list-unstyled mb-0 small">'+i.map(x=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+x+'</li>').join('')+'</ul>';
    }
    ['dpr-div','dpr-ni','dpr-shares','dpr-dps','dpr-eps'].forEach(id=>$(id).addEventListener('input',calc));
    $('dpr-cb').addEventListener('click',calc);
    $('dpr-cp').addEventListener('click',function(){navigator.clipboard.writeText('Payout: '+$('dpr-val').textContent+' | Retention: '+$('dpr-rr').textContent+' — ToolsHub').then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('dpr-rs').addEventListener('click',()=>{$('dpr-div').value=50000;$('dpr-ni').value=150000;$('dpr-shares').value=100000;$('dpr-dps').value=0.50;$('dpr-eps').value=1.50;calc();});
    calc();
});
</script>
<style>
.dpr-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.dpr-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.dpr-rebuilt .calculator-header h4{margin:0;font-weight:700;font-size:1.1rem;color:#1e293b}
.dpr-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}
.dpr-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.dpr-rebuilt .form-label-custom{font-size:.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.4rem;display:block}
</style>
