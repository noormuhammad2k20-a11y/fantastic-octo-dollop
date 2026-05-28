<div class="row g-4 django-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label-custom">Framework</label><select id="dk-fw" class="form-select form-select-lg rounded-3"><option value="django">Django (50 chars)</option><option value="laravel">Laravel (32 chars)</option><option value="flask">Flask (64 chars)</option><option value="rails">Rails (128 chars)</option><option value="custom">Custom Length</option></select></div>
                    <div class="col-md-3"><label class="form-label-custom">Key Length</label><input type="number" id="dk-len" class="form-control form-control-lg rounded-3 text-center" value="50" min="16" max="256"></div>
                    <div class="col-md-2"><label class="form-label-custom">Quantity</label><input type="number" id="dk-qty" class="form-control form-control-lg rounded-3 text-center" value="1" min="1" max="10"></div>
                    <div class="col-md-3 d-flex align-items-end"><button class="btn btn-dark btn-lg rounded-pill w-100 fw-bold" id="dk-gen"><i class="fas fa-wand-magic-sparkles me-2"></i>Generate</button></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Secret Key</span>
                <div class="output-hero-value" id="out-dk-count" style="font-size:3rem">1</div>
                <span class="output-hero-unit" id="out-dk-info">Django • 50 characters • 300 bits entropy</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Framework</span><span class="stat-card-value" id="out-dk-fw">Django</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Length</span><span class="stat-card-value" id="out-dk-len">50</span></div></div>
                <div class="col-6 col-md-4"><div class="stat-card"><span class="stat-card-label">Entropy</span><span class="stat-card-value" id="out-dk-ent">300 bits</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-terminal me-2 text-primary"></i>Generated Keys</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-dk-keys" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="dk-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Key(s)</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
const charsets={
    django:'abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*(-_=+)',
    laravel:'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
    flask:'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()',
    rails:'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
    custom:'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*(-_=+)'
};
const fwLens={django:50,laravel:32,flask:64,rails:128,custom:50};
$('dk-fw').addEventListener('change',()=>{const fw=$('dk-fw').value;$('dk-len').value=fwLens[fw]||50;generate()});

function generate(){
    const fw=$('dk-fw').value,len=Math.max(16,Math.min(256,parseInt($('dk-len').value)||50)),qty=Math.max(1,Math.min(10,parseInt($('dk-qty').value)||1));
    const chars=charsets[fw]||charsets.custom;
    const keys=[];
    for(let q=0;q<qty;q++){
        const arr=new Uint8Array(len);crypto.getRandomValues(arr);
        keys.push(Array.from(arr).map(b=>chars[b%chars.length]).join(''));
    }
    const entropy=Math.round(len*Math.log2(chars.length));
    $('out-dk-count').textContent=qty;
    $('out-dk-info').textContent=fw.charAt(0).toUpperCase()+fw.slice(1)+' • '+len+' chars • '+entropy+' bits entropy';
    $('out-dk-fw').textContent=fw.charAt(0).toUpperCase()+fw.slice(1);
    $('out-dk-len').textContent=len;
    $('out-dk-ent').textContent=entropy+' bits';
    $('out-dk-keys').textContent=keys.join('\n');
}
$('dk-gen').addEventListener('click',generate);
$('dk-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-dk-keys').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
generate();
});
</script>
<style>
.django-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.django-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.django-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.django-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.django-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.django-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\django-secret-key-generator.blade.php ENDPATH**/ ?>