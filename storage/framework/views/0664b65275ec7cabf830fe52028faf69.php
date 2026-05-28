<div class="row g-4 chmod-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Octal Notation</label>
                        <input type="text" id="chmod-octal" class="form-control form-control-lg rounded-3 font-monospace text-center" value="755" maxlength="4" placeholder="e.g. 755" style="font-size:2rem;letter-spacing:8px">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label-custom">Permission Matrix</label>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center mb-0" id="chmod-matrix">
                                <thead class="table-light"><tr><th></th><th>Read (4)</th><th>Write (2)</th><th>Execute (1)</th></tr></thead>
                                <tbody>
                                    <tr><td class="fw-bold">Owner</td><td><input type="checkbox" class="form-check-input chmod-cb" data-who="o" data-perm="r" checked></td><td><input type="checkbox" class="form-check-input chmod-cb" data-who="o" data-perm="w" checked></td><td><input type="checkbox" class="form-check-input chmod-cb" data-who="o" data-perm="x" checked></td></tr>
                                    <tr><td class="fw-bold">Group</td><td><input type="checkbox" class="form-check-input chmod-cb" data-who="g" data-perm="r" checked></td><td><input type="checkbox" class="form-check-input chmod-cb" data-who="g" data-perm="w"></td><td><input type="checkbox" class="form-check-input chmod-cb" data-who="g" data-perm="x" checked></td></tr>
                                    <tr><td class="fw-bold">Other</td><td><input type="checkbox" class="form-check-input chmod-cb" data-who="t" data-perm="r" checked></td><td><input type="checkbox" class="form-check-input chmod-cb" data-who="t" data-perm="w"></td><td><input type="checkbox" class="form-check-input chmod-cb" data-who="t" data-perm="x" checked></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 chmod-quick" data-val="777">777 (Full)</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 chmod-quick" data-val="755">755 (Dirs)</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 chmod-quick" data-val="644">644 (Files)</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 chmod-quick" data-val="600">600 (Private)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 chmod-quick" data-val="400">400 (Read-only)</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Symbolic Notation</span>
                <div class="output-hero-value font-monospace" id="out-chmod-sym" style="font-size:2.5rem;letter-spacing:2px">rwxr-xr-x</div>
                <span class="output-hero-unit" id="out-chmod-cmd">chmod 755 filename</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Owner</span><span class="stat-card-value" id="out-chmod-owner">rwx (7)</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Group</span><span class="stat-card-value" id="out-chmod-group">r-x (5)</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Other</span><span class="stat-card-value" id="out-chmod-other">r-x (5)</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Octal</span><span class="stat-card-value" id="out-chmod-oct">755</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Permission Details</h6>
            <div id="out-chmod-details" class="small text-secondary"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="chmod-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Permission Info</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
const octalEl=$('chmod-octal');
const cbs=document.querySelectorAll('.chmod-cb');

function digitToPerms(d){return{r:!!(d&4),w:!!(d&2),x:!!(d&1)};}
function permsToDigit(r,w,x){return(r?4:0)+(w?2:0)+(x?1:0);}
function permStr(r,w,x){return(r?'r':'-')+(w?'w':'-')+(x?'x':'-');}

function fromOctal(){
    let v=octalEl.value.replace(/[^0-7]/g,'');
    if(v.length>3)v=v.slice(-3);
    while(v.length<3)v='0'+v;
    const digits=[parseInt(v[0]),parseInt(v[1]),parseInt(v[2])];
    const p=[digitToPerms(digits[0]),digitToPerms(digits[1]),digitToPerms(digits[2])];
    const whos=['o','g','t'];
    cbs.forEach(cb=>{
        const wi=whos.indexOf(cb.dataset.who);
        const perm=cb.dataset.perm;
        cb.checked=p[wi][perm];
    });
    updateOutput(v,p);
}

function fromCheckboxes(){
    const whos=['o','g','t'];
    const p=whos.map(w=>{
        let r=false,wr=false,x=false;
        cbs.forEach(cb=>{if(cb.dataset.who===w){if(cb.dataset.perm==='r')r=cb.checked;if(cb.dataset.perm==='w')wr=cb.checked;if(cb.dataset.perm==='x')x=cb.checked}});
        return{r,w:wr,x};
    });
    const oct=p.map(pp=>permsToDigit(pp.r,pp.w,pp.x)).join('');
    octalEl.value=oct;
    updateOutput(oct,p);
}

function updateOutput(oct,p){
    const sym=p.map(pp=>permStr(pp.r,pp.w,pp.x)).join('');
    $('out-chmod-sym').textContent=sym;
    $('out-chmod-cmd').textContent='chmod '+oct+' filename';
    $('out-chmod-oct').textContent=oct;
    const labels=['Owner','Group','Other'];
    labels.forEach((l,i)=>{
        const s=permStr(p[i].r,p[i].w,p[i].x);
        const d=permsToDigit(p[i].r,p[i].w,p[i].x);
        $('out-chmod-'+l.toLowerCase()).textContent=s+' ('+d+')';
    });
    // Details
    const desc=[];
    const permWord=(r,w,x)=>{const a=[];if(r)a.push('read');if(w)a.push('write');if(x)a.push('execute');return a.length?a.join(', '):'no access';};
    desc.push(`<strong>Owner:</strong> ${permWord(p[0].r,p[0].w,p[0].x)}`);
    desc.push(`<strong>Group:</strong> ${permWord(p[1].r,p[1].w,p[1].x)}`);
    desc.push(`<strong>Others:</strong> ${permWord(p[2].r,p[2].w,p[2].x)}`);
    if(oct==='777')desc.push('⚠️ <span class="text-danger fw-bold">Full access to everyone — security risk!</span>');
    if(oct==='000')desc.push('🔒 No access to anyone.');
    $('out-chmod-details').innerHTML=desc.map(d=>'<p class="mb-1">'+d+'</p>').join('');
}

octalEl.addEventListener('input',fromOctal);
cbs.forEach(cb=>cb.addEventListener('change',fromCheckboxes));
document.querySelectorAll('.chmod-quick').forEach(b=>{b.addEventListener('click',()=>{octalEl.value=b.dataset.val;fromOctal()})});
$('chmod-copy').addEventListener('click',function(){
    const t=`Unix Permissions\nOctal: ${$('out-chmod-oct').textContent}\nSymbolic: ${$('out-chmod-sym').textContent}\nCommand: ${$('out-chmod-cmd').textContent}\n— ToolsHub`;
    navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
fromOctal();
});
</script>
<style>
.chmod-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.chmod-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.chmod-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.chmod-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.chmod-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.chmod-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.chmod-rebuilt .form-check-input{width:1.4em;height:1.4em;cursor:pointer}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\unix-permission-calculator.blade.php ENDPATH**/ ?>