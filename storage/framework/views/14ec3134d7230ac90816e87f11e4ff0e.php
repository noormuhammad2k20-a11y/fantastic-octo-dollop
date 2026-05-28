<div class="row g-4 xmlj-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">XML Input</label>
                        <textarea id="xml-input" class="form-control form-control-lg rounded-3 font-monospace" rows="8" style="font-size:.85rem" placeholder="<root><item>value</item></root>">&lt;catalog&gt;
  &lt;book id="1"&gt;
    &lt;title&gt;JavaScript: The Good Parts&lt;/title&gt;
    &lt;author&gt;Douglas Crockford&lt;/author&gt;
    &lt;year&gt;2008&lt;/year&gt;
    &lt;price&gt;29.99&lt;/price&gt;
  &lt;/book&gt;
  &lt;book id="2"&gt;
    &lt;title&gt;Clean Code&lt;/title&gt;
    &lt;author&gt;Robert C. Martin&lt;/author&gt;
    &lt;year&gt;2008&lt;/year&gt;
    &lt;price&gt;37.99&lt;/price&gt;
  &lt;/book&gt;
&lt;/catalog&gt;</textarea>
                    </div>
                </div>
                <div class="mt-3 d-flex flex-wrap gap-2">
                    <button class="btn btn-dark rounded-pill fw-bold px-4" id="xml-convert"><i class="fas fa-exchange-alt me-2"></i>Convert</button>
                    <button class="btn btn-outline-secondary rounded-pill px-4" id="xml-clear"><i class="fas fa-undo me-2"></i>Clear</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="xml-output-card" style="--tool-color:#ea580c;--tool-bg:rgba(234,88,12,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Conversion Status</span>
                <div class="output-hero-value" id="out-xml-status" style="font-size:2rem">✅ Converted</div>
                <span class="output-hero-unit" id="out-xml-info">—</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Elements</span><span class="stat-card-value" id="out-xml-els">0</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Attributes</span><span class="stat-card-value" id="out-xml-attrs">0</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Max Depth</span><span class="stat-card-value" id="out-xml-depth">0</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-code me-2 text-primary"></i>JSON Output</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-xml-json" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="xml-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy JSON</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
let elCount=0,attrCount=0;
function xmlToJson(xml){
    let obj={};
    if(xml.nodeType===1){
        if(xml.attributes.length>0){
            obj['@attributes']={};
            for(let i=0;i<xml.attributes.length;i++){
                const a=xml.attributes.item(i);
                obj['@attributes'][a.nodeName]=a.nodeValue;
                attrCount++;
            }
        }
    }else if(xml.nodeType===3){return xml.nodeValue.trim()}
    if(xml.hasChildNodes()){
        for(let i=0;i<xml.childNodes.length;i++){
            const item=xml.childNodes.item(i);
            const nodeName=item.nodeName;
            if(nodeName==='#text'){
                const val=item.nodeValue.trim();
                if(val){
                    if(xml.childNodes.length===1)return val;
                    obj['#text']=val;
                }
                continue;
            }
            elCount++;
            const child=xmlToJson(item);
            if(typeof obj[nodeName]==='undefined'){obj[nodeName]=child}
            else{
                if(!Array.isArray(obj[nodeName]))obj[nodeName]=[obj[nodeName]];
                obj[nodeName].push(child);
            }
        }
    }
    return obj;
}
function getDepth(obj){
    if(typeof obj!=='object'||obj===null)return 0;
    let max=0;for(let k in obj){max=Math.max(max,getDepth(obj[k]))}return max+1;
}
function convert(){
    const raw=$('xml-input').value.trim();
    if(!raw){$('out-xml-status').textContent='Enter XML';return}
    try{
        const parser=new DOMParser();
        const xmlDoc=parser.parseFromString(raw,'text/xml');
        const err=xmlDoc.querySelector('parsererror');
        if(err){throw new Error(err.textContent.split('\n')[0])}
        elCount=0;attrCount=0;
        const json=xmlToJson(xmlDoc.documentElement);
        const result={[xmlDoc.documentElement.nodeName]:json};
        const formatted=JSON.stringify(result,null,2);
        $('out-xml-status').textContent='✅ Converted';$('out-xml-status').style.color='#22c55e';
        $('xml-output-card').style.setProperty('--tool-color','#22c55e');
        $('out-xml-json').textContent=formatted;
        $('out-xml-els').textContent=elCount;
        $('out-xml-attrs').textContent=attrCount;
        $('out-xml-depth').textContent=getDepth(result);
        $('out-xml-info').textContent=elCount+' elements, '+attrCount+' attributes converted';
    }catch(e){
        $('out-xml-status').textContent='❌ Invalid XML';$('out-xml-status').style.color='#ef4444';
        $('xml-output-card').style.setProperty('--tool-color','#ef4444');
        $('out-xml-json').textContent='Error: '+e.message;
        $('out-xml-info').textContent=e.message;
    }
}
$('xml-convert').addEventListener('click',convert);
$('xml-clear').addEventListener('click',()=>{$('xml-input').value='';$('out-xml-json').textContent='';$('out-xml-status').textContent='—'});
$('xml-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-xml-json').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
convert();
});
</script>
<style>
.xmlj-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.xmlj-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.xmlj-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.xmlj-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.xmlj-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.xmlj-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\xml-to-json-converter.blade.php ENDPATH**/ ?>