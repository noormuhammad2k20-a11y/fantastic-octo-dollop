<div class="row g-4 htsec-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-custom">Your Domain</label><input type="text" id="hts-domain" class="form-control form-control-lg rounded-3 font-monospace" value="example.com" placeholder="yourdomain.com"></div>
                    <div class="col-md-6"><label class="form-label-custom">Protected Extensions</label><input type="text" id="hts-ext" class="form-control form-control-lg rounded-3 font-monospace" value="jpg|jpeg|png|gif|webp|svg" placeholder="jpg|png|gif"></div>
                    <div class="col-md-6"><label class="form-label-custom">Allow Search Engines?</label><select id="hts-se" class="form-select form-select-lg rounded-3"><option value="yes">Yes (Google, Bing)</option><option value="no">No</option></select></div>
                    <div class="col-md-6"><label class="form-label-custom">Action on Hotlink</label><select id="hts-action" class="form-select form-select-lg rounded-3"><option value="403">403 Forbidden</option><option value="replace">Show Replacement Image</option><option value="redirect">Redirect to Homepage</option></select></div>
                    <div class="col-md-12 d-none" id="hts-rep-wrap"><label class="form-label-custom">Replacement Image URL</label><input type="text" id="hts-rep" class="form-control form-control-lg rounded-3 font-monospace" value="https://example.com/hotlink-denied.jpg"></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 hts-pre" data-ext="jpg|jpeg|png|gif|webp|svg">Images Only</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 hts-pre" data-ext="jpg|jpeg|png|gif|webp|svg|mp4|mp3|avi|mov">All Media</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 hts-pre" data-ext="jpg|jpeg|png|gif|webp|svg|css|js|woff|woff2">Assets + Fonts</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Protection Status</span>
                <div class="output-hero-value" id="out-hts-status" style="font-size:2rem;color:#22c55e">🛡️ Active</div>
                <span class="output-hero-unit" id="out-hts-info">Protecting image assets on example.com</span>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-code me-2 text-primary"></i>.htaccess Output</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-hts-code" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="hts-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy .htaccess Code</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
function generate(){
    const domain=$('hts-domain').value.trim(),ext=$('hts-ext').value.trim(),se=$('hts-se').value,action=$('hts-action').value;
    $('hts-rep-wrap').classList.toggle('d-none',action!=='replace');
    let code='# Hotlink Protection for '+domain+'\nRewriteEngine On\n';
    code+='RewriteCond %{HTTP_REFERER} !^$\n';
    code+='RewriteCond %{HTTP_REFERER} !^https?://(www\\.)?'+domain.replace(/\./g,'\\.')+'/ [NC]\n';
    if(se==='yes'){
        code+='RewriteCond %{HTTP_REFERER} !^https?://(www\\.)?google\\. [NC]\n';
        code+='RewriteCond %{HTTP_REFERER} !^https?://(www\\.)?bing\\. [NC]\n';
    }
    code+='RewriteRule \\.(' +ext+ ')$ ';
    if(action==='403')code+='- [F,L]\n';
    else if(action==='replace')code+=($('hts-rep').value||'/hotlink-denied.jpg')+' [R,L]\n';
    else code+='/ [R=302,L]\n';
    $('out-hts-code').textContent=code;
    $('out-hts-info').textContent='Protecting '+ext.split('|').length+' file types on '+domain;
}
['hts-domain','hts-ext','hts-se','hts-action','hts-rep'].forEach(id=>{
    $(id).addEventListener('input',generate);$(id).addEventListener('change',generate);
});
document.querySelectorAll('.hts-pre').forEach(b=>{b.addEventListener('click',()=>{$('hts-ext').value=b.dataset.ext;generate()})});
$('hts-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-hts-code').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
generate();
});
</script>
<style>
.htsec-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.htsec-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.htsec-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.htsec-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.htsec-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.htsec-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\htaccess-secure-link-generator.blade.php ENDPATH**/ ?>