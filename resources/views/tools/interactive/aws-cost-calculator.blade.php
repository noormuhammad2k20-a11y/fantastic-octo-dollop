<div class="row g-4 aws-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">EC2 Instance Type</label><select class="form-select form-select-lg rounded-3" id="aw-type"><option value="0.0116" selected>t3.micro ($0.0116/hr)</option><option value="0.0464">t3.medium ($0.0464/hr)</option><option value="0.0928">t3.large ($0.0928/hr)</option><option value="0.1856">t3.xlarge ($0.1856/hr)</option><option value="0.3712">t3.2xlarge ($0.3712/hr)</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Number of Instances</label><input type="number" id="aw-count" class="form-control form-control-lg rounded-3" value="1" min="1"></div>
                    <div class="col-md-4"><label class="form-label-custom">Hours / Month</label><input type="number" id="aw-hours" class="form-control form-control-lg rounded-3" value="730" min="0" max="744"></div>
                    <div class="col-md-4"><label class="form-label-custom">S3 Storage (GB)</label><input type="number" id="aw-s3" class="form-control form-control-lg rounded-3" value="100" min="0"></div>
                    <div class="col-md-4"><label class="form-label-custom">Data Transfer Out (GB)</label><input type="number" id="aw-transfer" class="form-control form-control-lg rounded-3" value="50" min="0"></div>
                    <div class="col-md-4"><label class="form-label-custom">RDS Instance</label><select class="form-select form-select-lg rounded-3" id="aw-rds"><option value="0" selected>None</option><option value="0.017">db.t3.micro ($0.017/hr)</option><option value="0.068">db.t3.medium ($0.068/hr)</option><option value="0.136">db.t3.large ($0.136/hr)</option></select></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:40;--tool-color:#d97706;--tool-bg:rgba(245,158,11,.04);">
            <div class="output-hero"><span class="output-hero-label">ESTIMATED MONTHLY COST</span><div class="output-hero-value" id="aw-total">$16.97</div><span class="output-hero-unit">AWS Infrastructure</span></div>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card" style="border-color:#f59e0b;background:rgba(245,158,11,.02);"><span class="stat-card-label">EC2 COMPUTE</span><span class="stat-card-value text-warning" id="aw-ec2">$8.47</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#22c55e;background:rgba(34,197,94,.02);"><span class="stat-card-label">S3 STORAGE</span><span class="stat-card-value text-success" id="aw-s3cost">$2.30</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#3b82f6;background:rgba(59,130,246,.02);"><span class="stat-card-label">DATA TRANSFER</span><span class="stat-card-value text-primary" id="aw-dtcost">$4.50</span></div></div>
                <div class="col-md-3"><div class="stat-card" style="border-color:#a855f7;background:rgba(168,85,247,.02);"><span class="stat-card-label">ANNUAL ESTIMATE</span><span class="stat-card-value" style="color:#a855f7" id="aw-annual">$203.64</span></div></div>
            </div>
            <div class="mt-4" id="aw-insights"></div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="aw-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Estimate</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="aw-reset" style="min-width: 280px; max-width: 100%;"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function fmt(v){return'$'+v.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});}
    function calculate(){
        const rate=parseFloat($('aw-type').value),cnt=parseInt($('aw-count').value)||1;
        const hrs=parseInt($('aw-hours').value)||730,s3=parseInt($('aw-s3').value)||0;
        const dt=parseInt($('aw-transfer').value)||0,rds=parseFloat($('aw-rds').value);
        const ec2=rate*hrs*cnt,s3c=s3*0.023,dtc=Math.max(dt-1,0)*0.09;
        const rdsc=rds*hrs,total=ec2+s3c+dtc+rdsc;
        $('aw-total').textContent=fmt(total);$('aw-ec2').textContent=fmt(ec2+rdsc);
        $('aw-s3cost').textContent=fmt(s3c);$('aw-dtcost').textContent=fmt(dtc);$('aw-annual').textContent=fmt(total*12);
        let ins=[];ins.push('EC2 compute ('+(cnt>1?cnt+' instances':'1 instance')+'): <strong>'+fmt(ec2)+'/mo</strong>');
        if(rds>0)ins.push('RDS database adds <strong>'+fmt(rdsc)+'/mo</strong>');
        ins.push('Reserved instances (1yr) could save ~<strong>30-40%</strong> on EC2 costs.');
        ins.push('3-year total cost projection: <strong>'+fmt(total*36)+'</strong>');
        $('aw-insights').innerHTML='<h6 class="fw-bold mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i>Cost Insights</h6><ul class="list-unstyled mb-0 small">'+ins.map(i=>'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>').join('')+'</ul>';
    }
    ['aw-type','aw-count','aw-hours','aw-s3','aw-transfer','aw-rds'].forEach(id=>$(id).addEventListener('input',calculate));
    $('aw-copy').addEventListener('click',function(){const t='AWS Estimate\nTotal: '+$('aw-total').textContent+'/mo\nEC2: '+$('aw-ec2').textContent+'\nS3: '+$('aw-s3cost').textContent+'\nAnnual: '+$('aw-annual').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('aw-reset').addEventListener('click',()=>{$('aw-type').value='0.0116';$('aw-count').value=1;$('aw-hours').value=730;$('aw-s3').value=100;$('aw-transfer').value=50;$('aw-rds').value='0';calculate();});
    calculate();
});
</script>
<style>
.aws-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.aws-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}
.aws-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.aws-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.aws-rebuilt .tool-icon-circle{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.aws-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;margin-bottom:.5rem;display:block}
</style>

