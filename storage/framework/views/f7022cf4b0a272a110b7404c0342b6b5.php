<div class="row g-4 uuid-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label-custom">Version</label>
                        <select id="uuid-ver" class="form-select form-select-lg rounded-3">
                            <option value="4" selected>v4 (Random)</option>
                            <option value="nil">NIL (All zeros)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="uuid-qty" class="form-control form-control-lg rounded-3 text-center" value="5" min="1" max="100">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Format</label>
                        <select id="uuid-fmt" class="form-select form-select-lg rounded-3">
                            <option value="lower">lowercase</option>
                            <option value="upper">UPPERCASE</option>
                            <option value="braces">{braces}</option>
                            <option value="urn">urn:uuid:</option>
                            <option value="bare">No dashes</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-dark btn-lg rounded-pill w-100 fw-bold" id="uuid-gen"><i class="fas fa-dice me-2"></i>Generate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04)">
            <div class="output-hero">
                <span class="output-hero-label">UUIDs Generated</span>
                <div class="output-hero-value" id="out-uuid-count" style="font-size:3rem">5</div>
                <span class="output-hero-unit" id="out-uuid-info">Version 4 • RFC 4122 compliant</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Version</span><span class="stat-card-value" id="out-uuid-ver">v4</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Entropy</span><span class="stat-card-value">122 bits</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Format</span><span class="stat-card-value" id="out-uuid-fmt">lowercase</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list me-2 text-primary"></i>Generated UUIDs</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-uuid-list" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="uuid-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy All UUIDs</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
function uuidv4(){
    if(typeof crypto.randomUUID==='function')return crypto.randomUUID();
    const bytes=new Uint8Array(16);crypto.getRandomValues(bytes);
    bytes[6]=(bytes[6]&0x0f)|0x40;bytes[8]=(bytes[8]&0x3f)|0x80;
    const hex=Array.from(bytes).map(b=>b.toString(16).padStart(2,'0')).join('');
    return hex.slice(0,8)+'-'+hex.slice(8,12)+'-'+hex.slice(12,16)+'-'+hex.slice(16,20)+'-'+hex.slice(20);
}
function generate(){
    const ver=$('uuid-ver').value,qty=Math.max(1,Math.min(100,parseInt($('uuid-qty').value)||5)),fmt=$('uuid-fmt').value;
    const uuids=[];
    for(let i=0;i<qty;i++){
        let u=ver==='nil'?'00000000-0000-0000-0000-000000000000':uuidv4();
        if(fmt==='upper')u=u.toUpperCase();
        else if(fmt==='braces')u='{'+u+'}';
        else if(fmt==='urn')u='urn:uuid:'+u;
        else if(fmt==='bare')u=u.replace(/-/g,'');
        uuids.push(u);
    }
    $('out-uuid-count').textContent=qty;
    $('out-uuid-ver').textContent=ver==='nil'?'NIL':'v4';
    $('out-uuid-fmt').textContent=fmt;
    $('out-uuid-info').textContent='Version '+(ver==='nil'?'NIL':'4')+' • RFC 4122 compliant';
    $('out-uuid-list').textContent=uuids.join('\n');
}
$('uuid-gen').addEventListener('click',generate);
$('uuid-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-uuid-list').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
generate();
});
</script>
<style>
.uuid-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.uuid-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.uuid-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.uuid-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.uuid-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.uuid-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\uuid-generator.blade.php ENDPATH**/ ?>