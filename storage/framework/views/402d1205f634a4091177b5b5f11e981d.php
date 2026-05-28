<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-4">
        <div class="row g-3 align-items-end mb-4">
            <div class="col-md-4">
                <label class="form-label fw-bold small text-uppercase text-muted">Topic / Task</label>
                <input type="text" id="gen-topic" class="form-control border-2" placeholder="e.g. Write a marketing email">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold small text-uppercase text-muted">AI Model</label>
                <select id="gen-model" class="form-select border-2">
                    <option value="chatgpt">ChatGPT</option>
                    <option value="gemini">Gemini</option>
                    <option value="claude">Claude</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Style</label>
                <select id="gen-style" class="form-select border-2">
                    <option value="professional">Professional</option>
                    <option value="creative">Creative</option>
                    <option value="technical">Technical</option>
                    <option value="casual">Casual</option>
                </select>
            </div>
            <div class="col-md-3">
                <button id="gen-btn" class="btn btn-accent px-4 py-2 w-100 fw-bold rounded-3">
                    <i class="fas fa-magic me-2"></i> Generate Prompts
                </button>
            </div>
        </div>
        <div id="gen-results" class="d-none">
            <h5 class="fw-bold mb-3"><i class="fas fa-robot me-2 text-primary"></i>Generated Prompts</h5>
            <div id="gen-list" class="list-group gap-2"></div>
        </div>
        <div id="gen-placeholder" class="text-center py-5">
            <div class="opacity-25 mb-3"><i class="fas fa-robot fa-4x"></i></div>
            <h5 class="text-muted">Enter a topic to generate AI prompts</h5>
        </div>
    </div>
</div>
<style>
.btn-accent{background:var(--theme-gradient,linear-gradient(135deg,#667eea,#764ba2));color:#fff;border:none;transition:.3s}.btn-accent:hover{transform:translateY(-1px);opacity:.9;color:#fff}.list-group-item-action{border-radius:12px!important;border:2px solid #f8f9fa!important;transition:.2s;cursor:pointer}.list-group-item-action:hover{border-color:#667eea!important;background:#f8f7ff}.copy-icon{opacity:0;transition:.2s}.list-group-item-action:hover .copy-icon{opacity:1}
</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
const btn=document.getElementById('gen-btn'),topic=document.getElementById('gen-topic'),model=document.getElementById('gen-model'),style=document.getElementById('gen-style'),results=document.getElementById('gen-results'),list=document.getElementById('gen-list'),ph=document.getElementById('gen-placeholder');
btn.addEventListener('click',function(){
    const t=topic.value.trim();if(!t)return alert('Please enter a topic');
    btn.disabled=true;btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
    fetch('<?php echo e(route("ai.generate",["type"=>"ai-prompt"])); ?>',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>'},body:JSON.stringify({topic:t,model:model.value,style:style.value})})
    .then(r=>r.json()).then(data=>{
        if(data.success){ph.classList.add('d-none');results.classList.remove('d-none');list.innerHTML='';
        data.results.forEach(item=>{const d=document.createElement('div');d.className='list-group-item list-group-item-action p-3 mb-2';
        d.innerHTML=`<div class="d-flex justify-content-between align-items-start"><pre class="mb-0 flex-grow-1" style="white-space:pre-wrap;font-family:inherit">${item}</pre><i class="fas fa-copy text-primary copy-icon ms-3 mt-1"></i></div>`;
        d.addEventListener('click',()=>copyText(item,d));list.appendChild(d);});}
    }).finally(()=>{btn.disabled=false;btn.innerHTML='<i class="fas fa-magic me-2"></i>Generate Prompts';});
});
function copyText(t,el){navigator.clipboard.writeText(t).then(()=>{const o=el.innerHTML;el.innerHTML='<span class="text-success fw-bold"><i class="fas fa-check me-2"></i>Copied!</span>';setTimeout(()=>el.innerHTML=o,2e3);});}
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ai-prompt-generator.blade.php ENDPATH**/ ?>