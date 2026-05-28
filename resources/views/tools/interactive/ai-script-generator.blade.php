<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-4">
        <div class="row g-3 align-items-end mb-4">
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Topic</label>
                <input type="text" id="topic" class="form-control border-2" placeholder="e.g. 5 productivity tips">
            </div>            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Format</label>
                <select id="format" class="form-select border-2">
                    <option value="youtube">YouTube Video</option>
                    <option value="podcast">Podcast Episode</option>
                    <option value="tiktok">TikTok/Short</option>
                    <option value="webinar">Webinar</option>
                    <option value="presentation">Presentation</option>
                    </select>
            </div>            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Duration</label>
                <select id="duration" class="form-select border-2">
                    <option value="short">1-3 min</option>
                    <option value="medium">5-10 min</option>
                    <option value="long">15-30 min</option>
                    </select>
            </div>
            <div class="col-md-3">
                <button id="gen-btn" class="btn btn-accent px-4 py-2 w-100 fw-bold rounded-3">
                    <i class="fas fa-scroll me-2"></i> Generate
                </button>
            </div>
        </div>
        <div id="gen-results" class="d-none">
            <h5 class="fw-bold mb-3"><i class="fas fa-scroll me-2 text-primary"></i>Generated Script</h5>
            <div id="gen-list" class="list-group gap-2"></div>
        </div>
        <div id="gen-placeholder" class="text-center py-5">
            <div class="opacity-25 mb-3"><i class="fas fa-scroll fa-4x"></i></div>
            <h5 class="text-muted">Enter your topic to generate a script</h5>
        </div>
    </div>
</div>
<style>
.btn-accent{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border:none;transition:.3s}
.btn-accent:hover{transform:translateY(-1px);opacity:.9;color:#fff}
.list-group-item-action{border-radius:12px!important;border:2px solid #f8f9fa!important;transition:.2s;cursor:pointer}
.list-group-item-action:hover{border-color:#667eea!important;background:#fafafa}
.copy-icon{opacity:0;transition:.2s}
.list-group-item-action:hover .copy-icon{opacity:1}
</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
const btn=document.getElementById('gen-btn'),topic=document.getElementById('topic'),format=document.getElementById('format'),duration=document.getElementById('duration'),results=document.getElementById('gen-results'),list=document.getElementById('gen-list'),ph=document.getElementById('gen-placeholder');
btn.addEventListener('click',function(){
    btn.disabled=true;btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
    fetch('{{ route("ai.generate",["type"=>"ai-script"]) }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},body:JSON.stringify({topic:topic.value,format:format.value,duration:duration.value})})
    .then(r=>r.json()).then(data=>{
        if(data.success){ph.classList.add('d-none');results.classList.remove('d-none');list.innerHTML='';
        data.results.forEach(item=>{const d=document.createElement('div');d.className='list-group-item list-group-item-action p-3 mb-2';
        d.innerHTML='<div class="d-flex justify-content-between align-items-start"><pre class="mb-0 flex-grow-1" style="white-space:pre-wrap;font-family:inherit">'+item+'</pre><i class="fas fa-copy text-primary copy-icon ms-3 mt-1"></i></div>';
        d.addEventListener('click',function(){navigator.clipboard.writeText(item).then(function(){const o=d.innerHTML;d.innerHTML='<span class="text-success fw-bold"><i class="fas fa-check me-2"></i>Copied!</span>';setTimeout(function(){d.innerHTML=o;},2e3);});});
        list.appendChild(d);});}
    }).finally(function(){btn.disabled=false;btn.innerHTML='<i class="fas fa-scroll me-2"></i>Generate';});
});
});
</script>