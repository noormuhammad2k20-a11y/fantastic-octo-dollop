<div class="row g-4 cron-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4 col-6"><label class="form-label-custom">Minute</label><select id="cron-min" class="form-select form-select-lg rounded-3"><option value="*">Every (*)</option><option value="*/2">Every 2</option><option value="*/5">Every 5</option><option value="*/10">Every 10</option><option value="*/15">Every 15</option><option value="*/30">Every 30</option><option value="0">At :00</option><option value="30">At :30</option></select></div>
                    <div class="col-md-4 col-6"><label class="form-label-custom">Hour</label><select id="cron-hr" class="form-select form-select-lg rounded-3"><option value="*">Every (*)</option><option value="*/2">Every 2</option><option value="*/6">Every 6</option><option value="*/12">Every 12</option><option value="0">Midnight</option><option value="6">6 AM</option><option value="12">Noon</option><option value="18">6 PM</option></select></div>
                    <div class="col-md-4 col-6"><label class="form-label-custom">Day of Month</label><select id="cron-dom" class="form-select form-select-lg rounded-3"><option value="*">Every (*)</option><option value="1">1st</option><option value="15">15th</option><option value="1,15">1st & 15th</option></select></div>
                    <div class="col-md-4 col-6"><label class="form-label-custom">Month</label><select id="cron-mon" class="form-select form-select-lg rounded-3"><option value="*">Every (*)</option><option value="1">January</option><option value="3">March</option><option value="6">June</option><option value="12">December</option></select></div>
                    <div class="col-md-4 col-6"><label class="form-label-custom">Day of Week</label><select id="cron-dow" class="form-select form-select-lg rounded-3"><option value="*">Every (*)</option><option value="1-5">Mon-Fri</option><option value="0,6">Sat-Sun</option><option value="1">Monday</option><option value="5">Friday</option></select></div>
                    <div class="col-md-4 col-6"><label class="form-label-custom">Command</label><input type="text" id="cron-cmd" class="form-control form-control-lg rounded-3 font-monospace" value="/usr/bin/php /var/www/cron.php" placeholder="/path/to/script.sh"></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 cron-pre" data-m="*" data-h="*" data-dm="*" data-mo="*" data-dw="*">Every Minute</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 cron-pre" data-m="0" data-h="*" data-dm="*" data-mo="*" data-dw="*">Hourly</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 cron-pre" data-m="0" data-h="0" data-dm="*" data-mo="*" data-dw="*">Daily</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 cron-pre" data-m="0" data-h="0" data-dm="*" data-mo="*" data-dw="1">Weekly (Mon)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 cron-pre" data-m="0" data-h="0" data-dm="1" data-mo="*" data-dw="*">Monthly</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Cron Expression</span>
                <div class="output-hero-value font-monospace" id="out-cron-expr" style="font-size:2rem;letter-spacing:4px;word-break:break-all">* * * * *</div>
                <span class="output-hero-unit" id="out-cron-human">Runs every minute</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Minute</span><span class="stat-card-value" id="out-cron-m">*</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Hour</span><span class="stat-card-value" id="out-cron-h">*</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Day</span><span class="stat-card-value" id="out-cron-d">*</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Schedule</span><span class="stat-card-value" id="out-cron-freq">Continuous</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-terminal me-2 text-primary"></i>Full Crontab Line</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <code id="out-cron-line" class="small font-monospace" style="word-break:break-all;overflow-wrap:break-word"></code>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-clock me-2 text-primary"></i>Next 5 Runs</h6>
            <ul id="out-cron-next" class="list-unstyled small"></ul>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="cron-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Crontab Line</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
const els={m:$('cron-min'),h:$('cron-hr'),dm:$('cron-dom'),mo:$('cron-mon'),dw:$('cron-dow'),cmd:$('cron-cmd')};

function humanize(m,h,dm,mo,dw){
    let parts=[];
    if(m==='*'&&h==='*')return'Runs every minute';
    if(m.startsWith('*/'))parts.push('Every '+m.slice(2)+' minutes');
    else if(m!=='*')parts.push('At minute '+m);
    if(h.startsWith('*/'))parts.push('every '+h.slice(2)+' hours');
    else if(h!=='*')parts.push('at hour '+h);
    if(dm!=='*')parts.push('on day '+dm);
    if(mo!=='*')parts.push('in month '+mo);
    if(dw!=='*'){const days={'0':'Sun','1':'Mon','2':'Tue','3':'Wed','4':'Thu','5':'Fri','6':'Sat','1-5':'Mon-Fri','0,6':'Sat-Sun'};parts.push('on '+(days[dw]||dw))}
    return parts.length?'Runs '+parts.join(', '):'Runs every minute';
}

function nextRuns(m,h,dm,mo,dw){
    const runs=[];const now=new Date();
    let d=new Date(now);
    for(let i=0;i<1440*60&&runs.length<5;i++){
        d=new Date(now.getTime()+i*60000);
        const mm=d.getMinutes(),hh=d.getHours(),dd=d.getDate(),mon=d.getMonth()+1,dow=d.getDay();
        if(!matchField(m,mm))continue;if(!matchField(h,hh))continue;
        if(!matchField(dm,dd))continue;if(!matchField(mo,mon))continue;if(!matchField(dw,dow))continue;
        runs.push(d.toLocaleString());
    }
    return runs;
}
function matchField(f,v){
    if(f==='*')return true;
    if(f.startsWith('*/')){return v%parseInt(f.slice(2))===0}
    if(f.includes(',')){return f.split(',').map(Number).includes(v)}
    if(f.includes('-')){const[a,b]=f.split('-').map(Number);return v>=a&&v<=b}
    return parseInt(f)===v;
}

function update(){
    const m=els.m.value,h=els.h.value,dm=els.dm.value,mo=els.mo.value,dw=els.dw.value,cmd=els.cmd.value;
    const expr=m+' '+h+' '+dm+' '+mo+' '+dw;
    $('out-cron-expr').textContent=expr;
    $('out-cron-human').textContent=humanize(m,h,dm,mo,dw);
    $('out-cron-m').textContent=m;$('out-cron-h').textContent=h;$('out-cron-d').textContent=dm+'/'+mo;
    const freq=m==='*'&&h==='*'?'Per Minute':h==='*'?'Hourly':dm==='*'?'Daily':'Periodic';
    $('out-cron-freq').textContent=freq;
    $('out-cron-line').textContent=expr+' '+cmd;
    const runs=nextRuns(m,h,dm,mo,dw);
    $('out-cron-next').innerHTML=runs.map((r,i)=>`<li class="mb-1"><i class="fas fa-chevron-right me-2 text-muted"></i>${r}</li>`).join('')||'<li class="text-muted">Calculating...</li>';
}

Object.values(els).forEach(e=>e.addEventListener('input',update)||e.addEventListener('change',update));
document.querySelectorAll('.cron-pre').forEach(b=>{b.addEventListener('click',()=>{els.m.value=b.dataset.m;els.h.value=b.dataset.h;els.dm.value=b.dataset.dm;els.mo.value=b.dataset.mo;els.dw.value=b.dataset.dw;update()})});
$('cron-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-cron-line').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
update();
});
</script>
<style>
.cron-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.cron-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.cron-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.cron-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.cron-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.cron-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
