<div class="row g-4 heloc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Credit Line Amount</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="he-line" class="form-control form-control-lg" value="50000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Amount Drawn</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="he-drawn" class="form-control form-control-lg" value="30000" min="0"></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Interest Rate (APR)</label><div class="input-group"><input type="number" id="he-rate" class="form-control form-control-lg" value="8.5" step="0.1" min="0"><span class="input-group-text bg-light fw-bold">%</span></div></div>
                    <div class="col-md-4"><label class="form-label-custom">Draw Period (Years)</label><input type="number" id="he-draw-yrs" class="form-control form-control-lg rounded-3" value="10" min="1"></div>
                    <div class="col-md-4"><label class="form-label-custom">Repayment Period (Years)</label><input type="number" id="he-repay-yrs" class="form-control form-control-lg rounded-3" value="20" min="1"></div>
                    <div class="col-md-4"><label class="form-label-custom">Home Value</label><div class="input-group"><span class="input-group-text bg-light fw-bold">$</span><input type="number" id="he-home" class="form-control form-control-lg" value="300000" min="0"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:160;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero"><span class="output-hero-label">MONTHLY PAYMENT (DRAW PERIOD)</span><div class="output-hero-value" id="he-draw-pmt">$212.50</div><span class="output-hero-unit">Interest-Only During Draw</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#ef4444;background:rgba(239,68,68,.02);"><span class="stat-card-label">REPAYMENT PAYMENT</span><span class="stat-card-value text-danger" id="he-repay-pmt">$260.41</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">TOTAL INTEREST</span><span class="stat-card-value text-warning" id="he-total-int">$37,498</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">AVAILABLE CREDIT</span><span class="stat-card-value text-primary" id="he-avail">$20,000</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">CLTV RATIO</span><span class="stat-card-value text-success" id="he-cltv">10.0%</span></div></div>
            </div>
            <div class="mt-4" id="he-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="he-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Analysis</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="he-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+Math.round(v).toLocaleString();}
    function calculate(){
        const line=parseFloat($('he-line').value)||0,drawn=parseFloat($('he-drawn').value)||0;
        const rate=(parseFloat($('he-rate').value)||0)/100,drawYrs=parseInt($('he-draw-yrs').value)||1;
        const repayYrs=parseInt($('he-repay-yrs').value)||1,home=parseFloat($('he-home').value)||1;
        const monthlyRate=rate/12;
        const drawPmt=drawn*monthlyRate; // interest-only
        const repayMonths=repayYrs*12;
        const repayPmt=monthlyRate>0?drawn*(monthlyRate*Math.pow(1+monthlyRate,repayMonths))/(Math.pow(1+monthlyRate,repayMonths)-1):drawn/repayMonths;
        const drawInt=drawPmt*drawYrs*12;
        const repayInt=(repayPmt*repayMonths)-drawn;
        const totalInt=drawInt+repayInt;
        const avail=line-drawn,cltv=home>0?(drawn/home)*100:0;
        $('he-draw-pmt').textContent=fmt(drawPmt);$('he-repay-pmt').textContent=fmt(repayPmt);
        $('he-total-int').textContent=fmt(totalInt);$('he-avail').textContent=fmt(avail);
        $('he-cltv').textContent=cltv.toFixed(1)+'%';
        let ins=[];
        ins.push('Draw period ('+drawYrs+'yr): <strong>'+fmt(drawPmt)+'/mo</strong> interest-only');
        ins.push('Repayment period ('+repayYrs+'yr): <strong>'+fmt(repayPmt)+'/mo</strong> P+I');
        ins.push('Payment increase at repayment: <strong>'+fmt(repayPmt-drawPmt)+'/mo more</strong> — plan ahead!');
        if(cltv>80)ins.push('<span class="text-danger fw-bold">⚠ CLTV exceeds 80%</span> — PMI may be required.');
        else ins.push('CLTV of '+cltv.toFixed(1)+'% is within safe lending limits.');
        $('he-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>HELOC Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['he-line','he-drawn','he-rate','he-draw-yrs','he-repay-yrs','he-home'].forEach(id=>$(id).addEventListener('input',calculate));
    $('he-copy').addEventListener('click',function(){const t='HELOC Analysis\nDraw Payment: '+$('he-draw-pmt').textContent+'/mo\nRepayment: '+$('he-repay-pmt').textContent+'/mo\nTotal Interest: '+$('he-total-int').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('he-reset').addEventListener('click',()=>{$('he-line').value=50000;$('he-drawn').value=30000;$('he-rate').value=8.5;$('he-draw-yrs').value=10;$('he-repay-yrs').value=20;$('he-home').value=300000;calculate();});
    calculate();
});
</script>
<style>
.heloc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.heloc-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.heloc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.heloc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.heloc-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.heloc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\heloc-calculator.blade.php ENDPATH**/ ?>