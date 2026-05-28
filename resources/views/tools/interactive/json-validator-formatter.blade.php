<div class="row g-4 jsonval-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">JSON Input</label>
                        <textarea id="jv-input" class="form-control form-control-lg rounded-3 font-monospace" rows="8" placeholder='{"key": "value"}' style="font-size:.85rem">{"name":"John Doe","age":30,"skills":["JavaScript","Python","Go"],"address":{"city":"New York","zip":"10001"}}</textarea>
                    </div>
                </div>
                <div class="mt-3 d-flex flex-wrap gap-2">
                    <button class="btn btn-dark rounded-pill fw-bold px-4" id="jv-format"><i class="fas fa-align-left me-2"></i>Format</button>
                    <button class="btn btn-outline-dark rounded-pill fw-bold px-4" id="jv-minify"><i class="fas fa-compress me-2"></i>Minify</button>
                    <button class="btn btn-outline-success rounded-pill fw-bold px-4" id="jv-validate"><i class="fas fa-check me-2"></i>Validate</button>
                    <button class="btn btn-outline-secondary rounded-pill px-4" id="jv-clear"><i class="fas fa-undo me-2"></i>Clear</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="jv-output-card" style="--tool-color:#22c55e;--tool-bg:rgba(34,197,94,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Validation</span>
                <div class="output-hero-value" id="out-jv-status" style="font-size:2.5rem">✅ Valid JSON</div>
                <span class="output-hero-unit" id="out-jv-info">—</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Keys</span><span class="stat-card-value" id="out-jv-keys">0</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Depth</span><span class="stat-card-value" id="out-jv-depth">0</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Size</span><span class="stat-card-value" id="out-jv-size">0 B</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Type</span><span class="stat-card-value" id="out-jv-type">Object</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-code me-2 text-primary"></i>Output</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-jv-result" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="jv-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Result</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
function countKeys(obj){let c=0;if(typeof obj==='object'&&obj!==null){if(Array.isArray(obj)){obj.forEach(v=>c+=countKeys(v))}else{for(let k in obj){c++;c+=countKeys(obj[k])}}}return c}
function getDepth(obj){if(typeof obj!=='object'||obj===null)return 0;let max=0;if(Array.isArray(obj)){obj.forEach(v=>{max=Math.max(max,getDepth(v))})}else{for(let k in obj){max=Math.max(max,getDepth(obj[k]))}}return max+1}
function process(mode){
    const raw=$('jv-input').value.trim();
    if(!raw){$('out-jv-status').textContent='Empty Input';return}
    try{
        const parsed=JSON.parse(raw);
        const keys=countKeys(parsed),depth=getDepth(parsed);
        const formatted=JSON.stringify(parsed,null,2);
        const minified=JSON.stringify(parsed);
        $('out-jv-status').textContent='✅ Valid JSON';$('out-jv-status').style.color='#22c55e';
        $('jv-output-card').style.setProperty('--tool-color','#22c55e');
        $('out-jv-keys').textContent=keys;$('out-jv-depth').textContent=depth;
        $('out-jv-size').textContent=new Blob([raw]).size+' B';
        $('out-jv-type').textContent=Array.isArray(parsed)?'Array':'Object';
        $('out-jv-info').textContent=keys+' keys, depth '+depth+', '+minified.length+' chars minified';
        if(mode==='format'){$('out-jv-result').textContent=formatted;$('jv-input').value=formatted}
        else if(mode==='minify'){$('out-jv-result').textContent=minified;$('jv-input').value=minified}
        else{$('out-jv-result').textContent=formatted}
    }catch(e){
        $('out-jv-status').textContent='❌ Invalid JSON';$('out-jv-status').style.color='#ef4444';
        $('jv-output-card').style.setProperty('--tool-color','#ef4444');
        $('out-jv-result').textContent='Error: '+e.message;
        $('out-jv-info').textContent=e.message;
    }
}
$('jv-format').addEventListener('click',()=>process('format'));
$('jv-minify').addEventListener('click',()=>process('minify'));
$('jv-validate').addEventListener('click',()=>process('validate'));
$('jv-clear').addEventListener('click',()=>{$('jv-input').value='';$('out-jv-result').textContent='';$('out-jv-status').textContent='—'});
$('jv-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-jv-result').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
process('validate');
});
</script>
<style>
.jsonval-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.jsonval-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.jsonval-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.jsonval-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.jsonval-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.jsonval-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
