<div class="row g-4 crontab-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-2 align-items-end">
                    <div class="col"><label class="form-label-custom text-center">Min</label><input type="text" id="ct-min" class="form-control form-control-lg rounded-3 text-center font-monospace" value="*"></div>
                    <div class="col"><label class="form-label-custom text-center">Hour</label><input type="text" id="ct-hr" class="form-control form-control-lg rounded-3 text-center font-monospace" value="*"></div>
                    <div class="col"><label class="form-label-custom text-center">Day</label><input type="text" id="ct-dom" class="form-control form-control-lg rounded-3 text-center font-monospace" value="*"></div>
                    <div class="col"><label class="form-label-custom text-center">Month</label><input type="text" id="ct-mon" class="form-control form-control-lg rounded-3 text-center font-monospace" value="*"></div>
                    <div class="col"><label class="form-label-custom text-center">Wkday</label><input type="text" id="ct-dow" class="form-control form-control-lg rounded-3 text-center font-monospace" value="*"></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 ct-pre" data-expr="* * * * *">Every Min</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 ct-pre" data-expr="0 */6 * * *">Every 6h</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 ct-pre" data-expr="0 0 * * MON-FRI">Weekdays</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 ct-pre" data-expr="0 2 * * *">Daily 2AM</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 ct-pre" data-expr="0 0 1 * *">Monthly</button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 ct-pre" data-expr="*/5 * * * *">Every 5m</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#22c55e;--tool-bg:rgba(34,197,94,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Expression</span>
                <div class="output-hero-value font-monospace" id="out-ct-expr" style="font-size:2.5rem;letter-spacing:6px">* * * * *</div>
                <span class="output-hero-unit" id="out-ct-human">Runs every minute of every day</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-2"><div class="stat-card"><span class="stat-card-label">Minute</span><span class="stat-card-value" id="out-ct-m">*</span></div></div>
                <div class="col-6 col-md-2"><div class="stat-card"><span class="stat-card-label">Hour</span><span class="stat-card-value" id="out-ct-h">*</span></div></div>
                <div class="col-6 col-md-2"><div class="stat-card"><span class="stat-card-label">Day</span><span class="stat-card-value" id="out-ct-d">*</span></div></div>
                <div class="col-6 col-md-2"><div class="stat-card"><span class="stat-card-label">Month</span><span class="stat-card-value" id="out-ct-mo">*</span></div></div>
                <div class="col-6 col-md-2"><div class="stat-card"><span class="stat-card-label">Weekday</span><span class="stat-card-value" id="out-ct-w">*</span></div></div>
                <div class="col-6 col-md-2"><div class="stat-card"><span class="stat-card-label">Valid</span><span class="stat-card-value" id="out-ct-valid">✅</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-clock me-2 text-primary"></i>Next 5 Scheduled Runs</h6>
            <ul id="out-ct-next" class="list-unstyled small"></ul>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="ct-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Expression</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
const fields=['ct-min','ct-hr','ct-dom','ct-mon','ct-dow'];

function validate(f,min,max){
    if(f==='*')return true;if(/^\*\/\d+$/.test(f))return true;
    if(/^[\d,\-\/\*]+$/.test(f))return true;
    if(/^[A-Z]{3}(-[A-Z]{3})?$/i.test(f))return true;
    return false;
}
function humanize(){
    const m=$('ct-min').value,h=$('ct-hr').value,d=$('ct-dom').value,mo=$('ct-mon').value,w=$('ct-dow').value;
    let parts=[];
    if(m==='*'&&h==='*')return'Runs every minute';
    if(m.startsWith('*/'))parts.push('every '+m.slice(2)+' minutes');
    else if(m!=='*')parts.push('at minute '+m);
    if(h.startsWith('*/'))parts.push('every '+h.slice(2)+' hours');
    else if(h!=='*')parts.push('at '+h+':00');
    if(d!=='*')parts.push('on day '+d);
    if(mo!=='*')parts.push('in month '+mo);
    if(w!=='*')parts.push('on '+w);
    return parts.join(', ');
}
function matchF(f,v){
    if(f==='*')return true;
    if(f.startsWith('*/')){return v%parseInt(f.slice(2))===0}
    if(f.includes(',')){return f.split(',').map(Number).includes(v)}
    if(f.includes('-')){const p=f.split('-');const dayMap={SUN:0,MON:1,TUE:2,WED:3,THU:4,FRI:5,SAT:6};const a=dayMap[p[0].toUpperCase()]??parseInt(p[0]);const b=dayMap[p[1].toUpperCase()]??parseInt(p[1]);return v>=a&&v<=b}
    const dayMap={SUN:0,MON:1,TUE:2,WED:3,THU:4,FRI:5,SAT:6};
    return (dayMap[f.toUpperCase()]??parseInt(f))===v;
}
function nextRuns(){
    const m=$('ct-min').value,h=$('ct-hr').value,d=$('ct-dom').value,mo=$('ct-mon').value,w=$('ct-dow').value;
    const runs=[];const now=new Date();
    for(let i=1;i<1440*30&&runs.length<5;i++){
        const dt=new Date(now.getTime()+i*60000);
        if(!matchF(m,dt.getMinutes()))continue;if(!matchF(h,dt.getHours()))continue;
        if(!matchF(d,dt.getDate()))continue;if(!matchF(mo,dt.getMonth()+1))continue;if(!matchF(w,dt.getDay()))continue;
        runs.push(dt.toLocaleString());
    }
    return runs;
}
function update(){
    const vals=fields.map(f=>$(f).value.trim()||'*');
    const expr=vals.join(' ');
    $('out-ct-expr').textContent=expr;
    $('out-ct-human').textContent=humanize();
    $('out-ct-m').textContent=vals[0];$('out-ct-h').textContent=vals[1];$('out-ct-d').textContent=vals[2];
    $('out-ct-mo').textContent=vals[3];$('out-ct-w').textContent=vals[4];
    const isValid=vals.every((v,i)=>validate(v));
    $('out-ct-valid').textContent=isValid?'✅':'❌';
    const runs=nextRuns();
    $('out-ct-next').innerHTML=runs.map(r=>`<li class="mb-1"><i class="fas fa-chevron-right me-2 text-muted"></i>${r}</li>`).join('')||'<li class="text-muted">No upcoming runs found</li>';
}
fields.forEach(f=>$(f).addEventListener('input',update));
document.querySelectorAll('.ct-pre').forEach(b=>{b.addEventListener('click',()=>{
    const p=b.dataset.expr.split(' ');fields.forEach((f,i)=>$(f).value=p[i]||'*');update();
})});
$('ct-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-ct-expr').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
update();
});
</script>
<style>
.crontab-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.crontab-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.crontab-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.crontab-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.crontab-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.crontab-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\crontab-expression-generator.blade.php ENDPATH**/ ?>