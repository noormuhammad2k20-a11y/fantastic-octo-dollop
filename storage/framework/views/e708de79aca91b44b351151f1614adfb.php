<div class="row g-4 jsonesc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">Input String</label>
                        <textarea id="jse-input" class="form-control form-control-lg rounded-3 font-monospace" rows="6" placeholder="Paste your string here...">Hello "World"
Tab	here & newline
Path: C:\Users\test</textarea>
                    </div>
                </div>
                <div class="mt-3 d-flex flex-wrap gap-2">
                    <button class="btn btn-dark rounded-pill fw-bold px-4" id="jse-escape"><i class="fas fa-right-to-bracket me-2"></i>Escape</button>
                    <button class="btn btn-outline-dark rounded-pill fw-bold px-4" id="jse-unescape"><i class="fas fa-right-from-bracket me-2"></i>Unescape</button>
                    <button class="btn btn-outline-secondary rounded-pill px-4" id="jse-clear"><i class="fas fa-undo me-2"></i>Clear</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Result</span>
                <div class="output-hero-value" id="out-jse-mode" style="font-size:2rem">Escaped</div>
                <span class="output-hero-unit" id="out-jse-info">—</span>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-code me-2 text-primary"></i>Output</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-jse-result" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="jse-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Result</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
function escape(){
    const v=$('jse-input').value;
    const escaped=JSON.stringify(v);
    $('out-jse-result').textContent=escaped;
    $('out-jse-mode').textContent='Escaped';
    $('out-jse-info').textContent=v.length+' chars → '+escaped.length+' chars';
}
function unescape(){
    const v=$('jse-input').value.trim();
    try{
        let parsed;
        if(v.startsWith('"')&&v.endsWith('"'))parsed=JSON.parse(v);
        else parsed=JSON.parse('"'+v+'"');
        $('out-jse-result').textContent=parsed;
        $('out-jse-mode').textContent='Unescaped';
        $('out-jse-info').textContent=v.length+' chars → '+parsed.length+' chars';
    }catch(e){
        $('out-jse-result').textContent='Error: Invalid escaped string — '+e.message;
        $('out-jse-mode').textContent='Error';$('out-jse-mode').style.color='#ef4444';
    }
}
$('jse-escape').addEventListener('click',escape);
$('jse-unescape').addEventListener('click',unescape);
$('jse-clear').addEventListener('click',()=>{$('jse-input').value='';$('out-jse-result').textContent='';$('out-jse-mode').textContent='—';$('out-jse-info').textContent='—'});
$('jse-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-jse-result').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
escape();
});
</script>
<style>
.jsonesc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.jsonesc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.jsonesc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.jsonesc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.jsonesc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.jsonesc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\json-string-escape-unescape.blade.php ENDPATH**/ ?>