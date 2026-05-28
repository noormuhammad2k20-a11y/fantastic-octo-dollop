<div class="row g-4 ua-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">User-Agent String</label>
                        <textarea id="ua-input" class="form-control form-control-lg rounded-3 font-monospace" rows="3" style="font-size:.85rem;word-break:break-all"></textarea>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-dark btn-lg rounded-pill fw-bold px-5" id="ua-parse"><i class="fas fa-search me-2"></i>Parse</button>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 ua-quick" data-ua="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36">Chrome Win</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 ua-quick" data-ua="Mozilla/5.0 (Macintosh; Intel Mac OS X 14_5) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Safari/605.1.15">Safari Mac</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 ua-quick" data-ua="Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Mobile/15E148 Safari/604.1">iPhone</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 ua-quick" data-ua="Googlebot/2.1 (+http://www.google.com/bot.html)">Googlebot</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#ec4899;--tool-bg:rgba(236,72,153,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Detected Browser</span>
                <div class="output-hero-value" id="out-ua-browser" style="font-size:2rem">—</div>
                <span class="output-hero-unit" id="out-ua-os">—</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Browser</span><span class="stat-card-value" id="out-ua-bname">—</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">OS</span><span class="stat-card-value" id="out-ua-osname">—</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Device</span><span class="stat-card-value" id="out-ua-device">—</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Engine</span><span class="stat-card-value" id="out-ua-engine">—</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Full Analysis</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered small mb-0">
                    <tbody id="out-ua-table"></tbody>
                </table>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="ua-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy UA Report</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
const inp=$('ua-input');
inp.value=navigator.userAgent;

function parse(){
    const ua=inp.value.trim();if(!ua){$('out-ua-browser').textContent='Enter a UA string';return}
    let browser='Unknown',bver='',os='Unknown',osver='',device='Desktop',engine='Unknown',etype='';

    // Browser detection
    if(/Edg\/(\S+)/.test(ua)){browser='Edge';bver=RegExp.$1}
    else if(/OPR\/(\S+)/.test(ua)){browser='Opera';bver=RegExp.$1}
    else if(/Chrome\/(\S+)/.test(ua)){browser='Chrome';bver=RegExp.$1}
    else if(/Firefox\/(\S+)/.test(ua)){browser='Firefox';bver=RegExp.$1}
    else if(/Version\/(\S+).*Safari/.test(ua)){browser='Safari';bver=RegExp.$1}
    else if(/MSIE (\S+)/.test(ua)||/Trident.*rv:(\S+)/.test(ua)){browser='IE';bver=RegExp.$1}
    else if(/Googlebot\/(\S+)/.test(ua)){browser='Googlebot';bver=RegExp.$1;device='Bot'}
    else if(/bingbot\/(\S+)/.test(ua)){browser='Bingbot';bver=RegExp.$1;device='Bot'}
    else if(/bot|crawl|spider/i.test(ua)){browser='Bot';device='Bot'}

    // OS detection
    if(/Windows NT 10/.test(ua)){os='Windows';osver='10/11'}
    else if(/Windows NT 6\.3/.test(ua)){os='Windows';osver='8.1'}
    else if(/Windows NT 6\.1/.test(ua)){os='Windows';osver='7'}
    else if(/Mac OS X ([\d_]+)/.test(ua)){os='macOS';osver=RegExp.$1.replace(/_/g,'.')}
    else if(/Android ([\d.]+)/.test(ua)){os='Android';osver=RegExp.$1}
    else if(/iPhone OS ([\d_]+)/.test(ua)){os='iOS';osver=RegExp.$1.replace(/_/g,'.')}
    else if(/Linux/.test(ua)){os='Linux';osver=''}
    else if(/CrOS/.test(ua)){os='Chrome OS';osver=''}

    // Device
    if(/Mobile|Android/.test(ua)&&!/Tablet/.test(ua))device='Mobile';
    else if(/iPad|Tablet/.test(ua))device='Tablet';
    else if(/iPhone/.test(ua))device='Mobile (iPhone)';

    // Engine
    if(/AppleWebKit\/(\S+)/.test(ua)){engine='WebKit';etype=RegExp.$1}
    else if(/Gecko\/(\S+)/.test(ua)){engine='Gecko';etype=RegExp.$1}
    else if(/Trident\/(\S+)/.test(ua)){engine='Trident';etype=RegExp.$1}

    $('out-ua-browser').textContent=browser+(bver?' '+bver.split('.')[0]:'');
    $('out-ua-os').textContent=os+(osver?' '+osver:'');
    $('out-ua-bname').textContent=browser;
    $('out-ua-osname').textContent=os;
    $('out-ua-device').textContent=device;
    $('out-ua-engine').textContent=engine;

    $('out-ua-table').innerHTML=[
        ['Browser',browser],['Browser Version',bver||'—'],['Operating System',os],['OS Version',osver||'—'],
        ['Device Type',device],['Rendering Engine',engine],['Engine Version',etype||'—'],
        ['Mobile',/Mobile/.test(ua)?'Yes':'No'],['64-bit',/x64|x86_64|Win64|amd64/.test(ua)?'Yes':'Unknown'],
        ['Full UA String',ua]
    ].map(r=>`<tr><td class="fw-bold text-start" style="width:35%">${r[0]}</td><td class="text-start" style="word-break:break-all;overflow-wrap:break-word">${r[1]}</td></tr>`).join('');
}

inp.addEventListener('input',parse);$('ua-parse').addEventListener('click',parse);
document.querySelectorAll('.ua-quick').forEach(b=>{b.addEventListener('click',()=>{inp.value=b.dataset.ua;parse()})});
$('ua-copy').addEventListener('click',function(){
    const t=`UA Report\nBrowser: ${$('out-ua-bname').textContent}\nOS: ${$('out-ua-osname').textContent}\nDevice: ${$('out-ua-device').textContent}\nEngine: ${$('out-ua-engine').textContent}\n— ToolsHub`;
    navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
parse();
});
</script>
<style>
.ua-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.ua-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.ua-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.ua-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.ua-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.ua-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\user-agent-parser.blade.php ENDPATH**/ ?>