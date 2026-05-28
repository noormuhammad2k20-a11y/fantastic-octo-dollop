<div class="row g-4 macgen-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label-custom">Format</label>
                        <select id="macg-fmt" class="form-select form-select-lg rounded-3">
                            <option value="colon">Colon (AA:BB:CC)</option>
                            <option value="dash">Dash (AA-BB-CC)</option>
                            <option value="dot">Dot (AABB.CCDD)</option>
                            <option value="bare">Bare (AABBCC)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Case</label>
                        <select id="macg-case" class="form-select form-select-lg rounded-3">
                            <option value="upper">UPPERCASE</option>
                            <option value="lower">lowercase</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="macg-qty" class="form-control form-control-lg rounded-3 text-center" value="5" min="1" max="50">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-dark btn-lg rounded-pill w-100 fw-bold" id="macg-gen"><i class="fas fa-dice me-2"></i>Generate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#06b6d4;--tool-bg:rgba(6,182,212,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Generated MACs</span>
                <div class="output-hero-value" id="out-macg-count" style="font-size:3rem">5</div>
                <span class="output-hero-unit">Random Unicast Addresses</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Format</span><span class="stat-card-value" id="out-macg-fmt">Colon</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Type</span><span class="stat-card-value">Unicast / Local</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Case</span><span class="stat-card-value" id="out-macg-case">UPPER</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-list me-2 text-primary"></i>Results</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-macg-list" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="macg-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy All MACs</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
function generate(){
    const fmt=$('macg-fmt').value,cs=$('macg-case').value,qty=Math.min(50,Math.max(1,parseInt($('macg-qty').value)||1));
    const macs=[];
    for(let i=0;i<qty;i++){
        const bytes=new Uint8Array(6);crypto.getRandomValues(bytes);
        bytes[0]=(bytes[0]&0xFE)|0x02; // unicast + local
        let hex=Array.from(bytes).map(b=>b.toString(16).padStart(2,'0'));
        let mac='';
        if(fmt==='colon')mac=hex.join(':');
        else if(fmt==='dash')mac=hex.join('-');
        else if(fmt==='dot')mac=hex[0]+hex[1]+'.'+hex[2]+hex[3]+'.'+hex[4]+hex[5];
        else mac=hex.join('');
        macs.push(cs==='upper'?mac.toUpperCase():mac.toLowerCase());
    }
    $('out-macg-count').textContent=qty;
    $('out-macg-fmt').textContent=fmt.charAt(0).toUpperCase()+fmt.slice(1);
    $('out-macg-case').textContent=cs==='upper'?'UPPER':'lower';
    $('out-macg-list').textContent=macs.join('\n');
}
$('macg-gen').addEventListener('click',generate);
$('macg-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-macg-list').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
generate();
});
</script>
<style>
.macgen-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.macgen-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.macgen-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.macgen-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.macgen-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.macgen-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
