<div class="row g-4 jwt-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">JWT Token</label>
                        <textarea id="jwt-input" class="form-control form-control-lg rounded-3 font-monospace" rows="4" placeholder="Paste your JWT token here..." style="font-size:.8rem;word-break:break-all">eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c</textarea>
                    </div>
                    <div class="col-12 d-flex justify-content-end"><button class="btn btn-dark btn-lg rounded-pill fw-bold px-5" id="jwt-decode"><i class="fas fa-unlock me-2"></i>Decode</button></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#ec4899;--tool-bg:rgba(236,72,153,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Token Status</span>
                <div class="output-hero-value" id="out-jwt-status" style="font-size:2rem">Valid Structure</div>
                <span class="output-hero-unit" id="out-jwt-info">3 parts decoded successfully</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Algorithm</span><span class="stat-card-value" id="out-jwt-alg">HS256</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Type</span><span class="stat-card-value" id="out-jwt-type">JWT</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Issued At</span><span class="stat-card-value" id="out-jwt-iat">—</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Expires</span><span class="stat-card-value" id="out-jwt-exp">—</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3" style="color:#ef4444"><i class="fas fa-code me-2"></i>Header</h6>
            <div class="p-3 rounded-3 mb-3" style="background:#fef2f2;border:1px solid #fecaca;overflow-x:auto">
                <pre id="out-jwt-header" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <h6 class="fw-bold mb-3" style="color:#8b5cf6"><i class="fas fa-database me-2"></i>Payload</h6>
            <div class="p-3 rounded-3 mb-3" style="background:#f5f3ff;border:1px solid #e9d5ff;overflow-x:auto">
                <pre id="out-jwt-payload" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <h6 class="fw-bold mb-3" style="color:#06b6d4"><i class="fas fa-fingerprint me-2"></i>Signature</h6>
            <div class="p-3 rounded-3" style="background:#ecfeff;border:1px solid #a5f3fc;overflow-x:auto">
                <code id="out-jwt-sig" class="small font-monospace" style="word-break:break-all;overflow-wrap:break-word"></code>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="jwt-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Decoded Report</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
function b64decode(str){try{return JSON.parse(atob(str.replace(/-/g,'+').replace(/_/g,'/')))}catch(e){return null}}
function decode(){
    const token=$('jwt-input').value.trim();
    const parts=token.split('.');
    if(parts.length!==3){$('out-jwt-status').textContent='Invalid Token';$('out-jwt-status').style.color='#ef4444';$('out-jwt-info').textContent='JWT must have 3 parts separated by dots';return}
    const header=b64decode(parts[0]),payload=b64decode(parts[1]);
    if(!header){$('out-jwt-status').textContent='Invalid Header';$('out-jwt-status').style.color='#ef4444';return}
    $('out-jwt-status').textContent='Valid Structure';$('out-jwt-status').style.color='#22c55e';
    $('out-jwt-info').textContent='3 parts decoded successfully';
    $('out-jwt-alg').textContent=header.alg||'—';
    $('out-jwt-type').textContent=header.typ||'—';
    $('out-jwt-header').textContent=JSON.stringify(header,null,2);
    if(payload){
        $('out-jwt-payload').textContent=JSON.stringify(payload,null,2);
        if(payload.iat){const d=new Date(payload.iat*1000);$('out-jwt-iat').textContent=d.toLocaleDateString()}else{$('out-jwt-iat').textContent='—'}
        if(payload.exp){const d=new Date(payload.exp*1000);const now=new Date();$('out-jwt-exp').textContent=d<now?'Expired':'Valid';$('out-jwt-exp').style.color=d<now?'#ef4444':'#22c55e'}else{$('out-jwt-exp').textContent='None'}
    }else{$('out-jwt-payload').textContent='Could not decode payload'}
    $('out-jwt-sig').textContent=parts[2];
}
$('jwt-input').addEventListener('input',decode);$('jwt-decode').addEventListener('click',decode);
$('jwt-copy').addEventListener('click',function(){
    const t=`JWT Report\nHeader: ${$('out-jwt-header').textContent}\nPayload: ${$('out-jwt-payload').textContent}\nAlgorithm: ${$('out-jwt-alg').textContent}\n— ToolsHub`;
    navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
decode();
});
</script>
<style>
.jwt-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.jwt-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.jwt-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.jwt-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.jwt-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.jwt-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
