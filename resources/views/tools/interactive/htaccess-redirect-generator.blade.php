<div class="row g-4 htred-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-5"><label class="form-label-custom">Old URL / Path</label><input type="text" id="ht-old" class="form-control form-control-lg rounded-3 font-monospace" value="/old-page" placeholder="/old-page"></div>
                    <div class="col-md-5"><label class="form-label-custom">New URL / Path</label><input type="text" id="ht-new" class="form-control form-control-lg rounded-3 font-monospace" value="/new-page" placeholder="https://example.com/new-page"></div>
                    <div class="col-md-2"><label class="form-label-custom">Type</label><select id="ht-type" class="form-select form-select-lg rounded-3"><option value="301">301 Permanent</option><option value="302">302 Temporary</option><option value="307">307 Temp (POST)</option></select></div>
                </div>
                <div class="mt-3 d-flex flex-wrap gap-2">
                    <button class="btn btn-dark rounded-pill fw-bold px-4" id="ht-add"><i class="fas fa-plus me-2"></i>Add Rule</button>
                    <button class="btn btn-outline-secondary rounded-pill px-4" id="ht-reset"><i class="fas fa-undo me-2"></i>Reset</button>
                </div>
                <div class="mt-3" id="ht-rules-list"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Generated Rules</span>
                <div class="output-hero-value" id="out-ht-count" style="font-size:3rem">0</div>
                <span class="output-hero-unit">Redirect Rules</span>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-code me-2 text-primary"></i>.htaccess Output</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-ht-code" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all">RewriteEngine On&#10;&#10;# Add redirect rules above</pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="ht-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy .htaccess Code</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
let rules=[];
function render(){
    $('out-ht-count').textContent=rules.length;
    let code='RewriteEngine On\n';
    rules.forEach((r,i)=>{
        code+='\n# Rule '+(i+1)+': '+r.type+' redirect\n';
        code+='RewriteRule ^'+r.old.replace(/^\//,'')+'$ '+r.new+' [R='+r.type+',L]\n';
    });
    $('out-ht-code').textContent=code;
    $('ht-rules-list').innerHTML=rules.map((r,i)=>`<div class="d-flex align-items-center gap-2 mb-2 p-2 rounded-3" style="background:#f8fafc;border:1px solid #e2e8f0"><span class="badge bg-${r.type==='301'?'danger':'warning'} rounded-pill">${r.type}</span><code class="small flex-grow-1" style="word-break:break-all">${r.old} → ${r.new}</code><button class="btn btn-sm btn-outline-danger rounded-pill ht-del" data-i="${i}"><i class="fas fa-times"></i></button></div>`).join('');
    document.querySelectorAll('.ht-del').forEach(b=>{b.addEventListener('click',()=>{rules.splice(parseInt(b.dataset.i),1);render()})});
}
$('ht-add').addEventListener('click',()=>{
    const old=$('ht-old').value.trim(),nw=$('ht-new').value.trim(),type=$('ht-type').value;
    if(!old||!nw)return;
    rules.push({old,new:nw,type});render();$('ht-old').value='';$('ht-new').value='';
});
$('ht-reset').addEventListener('click',()=>{rules=[];render()});
$('ht-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-ht-code').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
render();
});
</script>
<style>
.htred-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.htred-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.htred-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.htred-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.htred-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.htred-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
