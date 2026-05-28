<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-4">
        <div class="row g-3 align-items-end mb-4">
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Product/Service</label>
                <input type="text" id="product" class="form-control border-2" placeholder="e.g. AI-powered CRM software">
            </div>            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Target Audience</label>
                <input type="text" id="audience" class="form-control border-2" placeholder="e.g. Small business owners">
            </div>            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Pitch Type</label>
                <select id="pitchType" class="form-select border-2">
                    <option value="elevator">Elevator Pitch</option>
                    <option value="email">Cold Email</option>
                    <option value="presentation">Presentation Opening</option>
                    </select>
            </div>
            <div class="col-md-3">
                <button id="gen-btn" class="btn btn-accent px-4 py-2 w-100 fw-bold rounded-3">
                    <i class="fas fa-bullhorn me-2"></i> Generate
                </button>
            </div>
        </div>
        <div id="gen-results" class="d-none">
            <h5 class="fw-bold mb-3"><i class="fas fa-bullhorn me-2 text-danger"></i>Generated Pitches</h5>
            <div id="gen-list" class="list-group gap-2"></div>
        </div>
        <div id="gen-placeholder" class="text-center py-5">
            <div class="opacity-25 mb-3"><i class="fas fa-bullhorn fa-4x"></i></div>
            <h5 class="text-muted">Describe your product to generate sales pitches</h5>
        </div>
    </div>
</div>
<style>
.btn-accent{background:linear-gradient(135deg,#eb3349,#f45c43);color:#fff;border:none;transition:.3s}
.btn-accent:hover{transform:translateY(-1px);opacity:.9;color:#fff}
.list-group-item-action{border-radius:12px!important;border:2px solid #f8f9fa!important;transition:.2s;cursor:pointer}
.list-group-item-action:hover{border-color:#eb3349!important;background:#fafafa}
.copy-icon{opacity:0;transition:.2s}
.list-group-item-action:hover .copy-icon{opacity:1}
</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
const btn=document.getElementById('gen-btn'),product=document.getElementById('product'),audience=document.getElementById('audience'),pitchType=document.getElementById('pitchType'),results=document.getElementById('gen-results'),list=document.getElementById('gen-list'),ph=document.getElementById('gen-placeholder');
btn.addEventListener('click',function(){
    btn.disabled=true;btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
    fetch('<?php echo e(route("ai.generate",["type"=>"sales-pitch"])); ?>',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>'},body:JSON.stringify({product:product.value,audience:audience.value,pitchType:pitchType.value})})
    .then(r=>r.json()).then(data=>{
        if(data.success){ph.classList.add('d-none');results.classList.remove('d-none');list.innerHTML='';
        data.results.forEach(item=>{const d=document.createElement('div');d.className='list-group-item list-group-item-action p-3 mb-2';
        d.innerHTML='<div class="d-flex justify-content-between align-items-start"><pre class="mb-0 flex-grow-1" style="white-space:pre-wrap;font-family:inherit">'+item+'</pre><i class="fas fa-copy text-primary copy-icon ms-3 mt-1"></i></div>';
        d.addEventListener('click',function(){navigator.clipboard.writeText(item).then(function(){const o=d.innerHTML;d.innerHTML='<span class="text-success fw-bold"><i class="fas fa-check me-2"></i>Copied!</span>';setTimeout(function(){d.innerHTML=o;},2e3);});});
        list.appendChild(d);});}
    }).finally(function(){btn.disabled=false;btn.innerHTML='<i class="fas fa-bullhorn me-2"></i>Generate';});
});
});
</script><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\sales-pitch-generator.blade.php ENDPATH**/ ?>