<div class="row g-4 sha512-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12"><label class="form-label-custom">Input Data</label><textarea id="hash-input" class="form-control form-control-lg rounded-3" rows="4" placeholder="Enter text to hash...">Hello World</textarea></div>
                    <div class="col-md-4"><label class="form-label-custom">Salt (Optional)</label><input type="text" id="hash-salt" class="form-control form-control-lg rounded-3" placeholder="e.g. my-salt"></div>
                    <div class="col-md-4"><label class="form-label-custom">Iterations</label><input type="number" id="hash-iterations" class="form-control form-control-lg rounded-3" value="1" min="1" max="10000"></div>
                    <div class="col-md-4"><label class="form-label-custom">Output Format</label><select id="hash-format" class="form-select form-select-lg rounded-3"><option value="hex" selected>Hexadecimal</option><option value="base64">Base64</option></select></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-dark btn-sm rounded-pill px-4 py-2 fw-bold" id="btn-generate"><i class="fas fa-bolt me-2"></i>Generate Hash</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-4 py-2" id="btn-clear"><i class="fas fa-eraser me-2"></i>Clear All</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04);">
            <div class="output-hero"><span class="output-hero-label">SHA-512 HASH DIGEST</span><div class="output-hero-value hash-output-box" id="hash-result" style="font-size:.95rem;font-family:'Courier New',monospace;word-break:break-all;overflow-wrap:break-word;">—</div></div>
            <div class="row g-3 mt-3">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">ALGORITHM</span><span class="stat-card-value" style="font-size:1rem">SHA-512</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">DIGEST LENGTH</span><span class="stat-card-value" id="stat-len">—</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">INPUT SIZE</span><span class="stat-card-value" id="stat-input">—</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">TIME</span><span class="stat-card-value" id="stat-time">—</span></div></div>
            </div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm w-100" id="btn-copy"><i class="fas fa-copy me-2"></i>Copy Hash</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm w-100" id="btn-reset"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    function bufToHex(buf){return Array.from(new Uint8Array(buf)).map(b=>b.toString(16).padStart(2,'0')).join('');}
    function bufToBase64(buf){return btoa(String.fromCharCode(...new Uint8Array(buf)));}
    async function generate(){
        const input=$('hash-input').value,salt=$('hash-salt').value,iterations=parseInt($('hash-iterations').value)||1,format=$('hash-format').value;
        const data=salt?input+salt:input;const t0=performance.now();let result,current=data;
        for(let i=0;i<iterations;i++){result=await crypto.subtle.digest('SHA-512',new TextEncoder().encode(current));current=bufToHex(result);}
        const elapsed=Math.round(performance.now()-t0);const output=format==='base64'?bufToBase64(result):bufToHex(result);
        $('hash-result').textContent=output;$('stat-len').textContent=output.length+' chars';$('stat-input').textContent=new TextEncoder().encode(input).length+' bytes';$('stat-time').textContent=elapsed<1?'<1 ms':elapsed+' ms';
    }
    $('btn-generate').addEventListener('click',generate);$('hash-input').addEventListener('input',generate);$('hash-salt').addEventListener('input',generate);$('hash-iterations').addEventListener('change',generate);$('hash-format').addEventListener('change',generate);
    $('btn-clear').addEventListener('click',()=>{$('hash-input').value='';$('hash-salt').value='';$('hash-iterations').value=1;$('hash-format').value='hex';$('hash-result').textContent='—';$('stat-len').textContent='—';$('stat-input').textContent='0 bytes';$('stat-time').textContent='—';});
    $('btn-copy').addEventListener('click',function(){navigator.clipboard.writeText($('hash-result').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('btn-reset').addEventListener('click',()=>{$('hash-input').value='Hello World';$('hash-salt').value='';$('hash-iterations').value=1;$('hash-format').value='hex';generate();});
    generate();
});
</script>
<style>.sha512-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}.sha512-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}.sha512-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b;font-size:1.25rem}.sha512-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}.sha512-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}.sha512-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}.hash-output-box{max-width:100%;overflow-x:auto;padding:.5rem 0}</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\sha512-hash-generator.blade.php ENDPATH**/ ?>