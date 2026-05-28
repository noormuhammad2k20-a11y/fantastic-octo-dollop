<div class="row g-4 curl-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">cURL Command</label>
                        <textarea id="curl-input" class="form-control form-control-lg rounded-3 font-monospace" rows="6" placeholder="curl -X POST https://api.example.com/data -H 'Content-Type: application/json' -d '{&quot;key&quot;:&quot;value&quot;}'" style="font-size:.85rem">curl -X POST https://api.example.com/users -H 'Content-Type: application/json' -H 'Authorization: Bearer token123' -d '{"name":"John","email":"john@example.com"}'</textarea>
                    </div>
                </div>
                <div class="mt-3 d-flex flex-wrap gap-2">
                    <button class="btn btn-dark rounded-pill fw-bold px-4" id="curl-parse"><i class="fas fa-wand-magic-sparkles me-2"></i>Parse</button>
                    <button class="btn btn-outline-secondary rounded-pill px-4" id="curl-clear"><i class="fas fa-undo me-2"></i>Clear</button>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Examples:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 curl-ex" data-cmd="curl https://api.github.com/users/octocat">GET GitHub</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 curl-ex" data-cmd="curl -X POST https://httpbin.org/post -H 'Content-Type: application/json' -d '{&quot;test&quot;:true}'">POST JSON</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 curl-ex" data-cmd="curl -X PUT https://api.example.com/item/1 -H 'Authorization: Bearer abc123' -H 'Accept: application/json' -d '{&quot;status&quot;:&quot;active&quot;}'">PUT Auth</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#a855f7;--tool-bg:rgba(168,85,247,.04)">
            <div class="output-hero">
                <span class="output-hero-label">HTTP Method</span>
                <div class="output-hero-value" id="out-curl-method" style="font-size:2.5rem">POST</div>
                <span class="output-hero-unit" id="out-curl-url" style="word-break:break-all">https://api.example.com/users</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Method</span><span class="stat-card-value" id="out-curl-m2">POST</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Headers</span><span class="stat-card-value" id="out-curl-hc">2</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Has Body</span><span class="stat-card-value" id="out-curl-body">Yes</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-code me-2 text-primary"></i>Parsed JSON</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-curl-json" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="curl-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy JSON</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
function parseCurl(){
    let raw=$('curl-input').value.trim();
    if(!raw){$('out-curl-method').textContent='Enter a cURL command';return}
    raw=raw.replace(/\\\n/g,' ').replace(/\s+/g,' ');
    let method='GET',url='',headers={},data=null,auth=null;
    // Tokenize
    const tokens=[];let i=0;
    while(i<raw.length){
        if(raw[i]===' '){i++;continue}
        if(raw[i]==="'"||raw[i]==='"'){
            const q=raw[i];let j=i+1;while(j<raw.length&&raw[j]!==q)j++;
            tokens.push(raw.substring(i+1,j));i=j+1;
        }else{
            let j=i;while(j<raw.length&&raw[j]!==' ')j++;
            tokens.push(raw.substring(i,j));i=j;
        }
    }
    for(let t=0;t<tokens.length;t++){
        const tk=tokens[t];
        if(tk==='curl')continue;
        if(tk==='-X'||tk==='--request'){method=(tokens[++t]||'GET').toUpperCase();continue}
        if(tk==='-H'||tk==='--header'){
            const h=tokens[++t]||'';const ci=h.indexOf(':');
            if(ci>0)headers[h.substring(0,ci).trim()]=h.substring(ci+1).trim();
            continue;
        }
        if(tk==='-d'||tk==='--data'||tk==='--data-raw'){data=tokens[++t]||'';if(method==='GET')method='POST';continue}
        if(tk==='-u'||tk==='--user'){auth=tokens[++t]||'';continue}
        if(tk.startsWith('http')||tk.startsWith('//')){url=tk;continue}
        if(!tk.startsWith('-')&&!url){url=tk}
    }
    const result={method,url,headers};
    if(data){try{result.body=JSON.parse(data)}catch(e){result.body=data}}
    if(auth)result.auth=auth;

    $('out-curl-method').textContent=method;
    $('out-curl-url').textContent=url;
    $('out-curl-m2').textContent=method;
    $('out-curl-hc').textContent=Object.keys(headers).length;
    $('out-curl-body').textContent=data?'Yes':'No';
    $('out-curl-json').textContent=JSON.stringify(result,null,2);
}
$('curl-parse').addEventListener('click',parseCurl);
$('curl-clear').addEventListener('click',()=>{$('curl-input').value='';$('out-curl-json').textContent='';$('out-curl-method').textContent='—'});
document.querySelectorAll('.curl-ex').forEach(b=>{b.addEventListener('click',()=>{$('curl-input').value=b.dataset.cmd;parseCurl()})});
$('curl-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-curl-json').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
parseCurl();
});
</script>
<style>
.curl-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.curl-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.curl-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.curl-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.curl-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.curl-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\curl-to-json.blade.php ENDPATH**/ ?>