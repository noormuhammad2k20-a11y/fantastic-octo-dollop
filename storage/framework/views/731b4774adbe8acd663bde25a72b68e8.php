<div class="row g-4 pwd-tester-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-9">
                        <label class="form-label-custom">Enter Password</label>
                        <div class="input-group">
                            <input type="password" id="pwd-input" class="form-control form-control-lg rounded-start-3 font-monospace" value="P@ssw0rd123!" placeholder="Type a password..." autocomplete="off" style="letter-spacing:2px">
                            <button class="btn btn-outline-secondary rounded-end-3 px-3" type="button" id="pwd-toggle"><i class="fas fa-eye" id="pwd-toggle-icon"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-dark btn-lg rounded-pill w-100 fw-bold" id="pwd-test"><i class="fas fa-flask me-2"></i>Test</button>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 pwd-quick" data-pwd="password">🔴 password</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 pwd-quick" data-pwd="Hello2024">⚠️ Hello2024</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 pwd-quick" data-pwd="T#r0ng!P@55">💚 T#r0ng!P@55</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 pwd-quick" data-pwd="cX9$kL!mQ2@vR7#w">💎 16-char strong</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="pwd-output-card" style="--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Strength Rating</span>
                <div class="output-hero-value" id="out-pwd-rating" style="font-size:2.5rem">Strong</div>
                <span class="output-hero-unit" id="out-pwd-crack">Estimated crack time: ~centuries</span>
            </div>
            <div class="position-relative mt-3 mb-1">
                <div class="progress rounded-pill" style="height:14px;background:#f1f5f9"><div id="out-pwd-bar" class="progress-bar rounded-pill" style="width:75%;background:#10b981;transition:all .5s"></div></div>
            </div>
            <div class="d-flex justify-content-between small text-muted px-1"><span>Very Weak</span><span>Weak</span><span>Fair</span><span>Strong</span><span>Very Strong</span></div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Entropy</span><span class="stat-card-value" id="out-pwd-entropy">56 bits</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Pool Size</span><span class="stat-card-value" id="out-pwd-pool">95</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Length</span><span class="stat-card-value" id="out-pwd-length">12</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Score</span><span class="stat-card-value" id="out-pwd-score">4/5</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i>Character Composition</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered small mb-0">
                    <thead class="table-light"><tr><th>Category</th><th>Count</th><th>Present</th></tr></thead>
                    <tbody id="out-pwd-composition"></tbody>
                </table>
            </div>
            <div class="mt-4" id="out-pwd-tips"></div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="pwd-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Strength Report</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id),inp=$('pwd-input');
$('pwd-toggle').addEventListener('click',()=>{const p=inp.type==='password';inp.type=p?'text':'password';$('pwd-toggle-icon').className=p?'fas fa-eye-slash':'fas fa-eye'});
const common=['password','123456','qwerty','abc123','letmein','admin','welcome','monkey','dragon','master','login','passw0rd'];
function analyze(){
const pwd=inp.value,len=pwd.length;
if(!len){$('out-pwd-rating').textContent='Enter a Password';$('out-pwd-bar').style.width='0%';return}
const hL=/[a-z]/.test(pwd),hU=/[A-Z]/.test(pwd),hD=/[0-9]/.test(pwd),hS=/[^a-zA-Z0-9]/.test(pwd);
const cL=(pwd.match(/[a-z]/g)||[]).length,cU=(pwd.match(/[A-Z]/g)||[]).length,cD=(pwd.match(/[0-9]/g)||[]).length,cS=(pwd.match(/[^a-zA-Z0-9]/g)||[]).length;
let pool=0;if(hL)pool+=26;if(hU)pool+=26;if(hD)pool+=10;if(hS)pool+=33;
const entropy=pool>0?Math.round(len*Math.log2(pool)):0;
let score=0;if(len>=8)score++;if(len>=12)score++;if(hL&&hU)score++;if(hD)score++;if(hS)score++;
if(common.includes(pwd.toLowerCase()))score=0;
const gps=1e10,tot=Math.pow(pool,len),sec=tot/(2*gps);
let ct='instantly';if(sec>=1&&sec<60)ct=Math.round(sec)+'s';else if(sec>=60&&sec<3600)ct=Math.round(sec/60)+'min';else if(sec>=3600&&sec<86400)ct=Math.round(sec/3600)+'hrs';else if(sec>=86400&&sec<2592e3)ct=Math.round(sec/86400)+'days';else if(sec>=2592e3&&sec<31536e3)ct=Math.round(sec/2592e3)+'months';else if(sec>=31536e3&&sec<31536e5)ct=Math.round(sec/31536e3)+'years';else if(sec>=31536e5)ct='centuries+';
const r=[{l:'Very Weak',c:'#ef4444',b:10},{l:'Weak',c:'#f97316',b:25},{l:'Fair',c:'#eab308',b:45},{l:'Strong',c:'#22c55e',b:70},{l:'Very Strong',c:'#10b981',b:90},{l:'Excellent',c:'#059669',b:100}][Math.min(score,5)];
$('out-pwd-rating').textContent=r.l;$('out-pwd-rating').style.color=r.c;$('out-pwd-crack').textContent='Crack time: ~'+ct;
$('out-pwd-bar').style.width=r.b+'%';$('out-pwd-bar').style.background=r.c;$('pwd-output-card').style.setProperty('--tool-color',r.c);
$('out-pwd-entropy').textContent=entropy+' bits';$('out-pwd-pool').textContent=pool;$('out-pwd-length').textContent=len;$('out-pwd-score').textContent=score+'/5';
$('out-pwd-composition').innerHTML=[['Lowercase (a-z)',cL,hL],['Uppercase (A-Z)',cU,hU],['Digits (0-9)',cD,hD],['Symbols (!@#$)',cS,hS]].map(r=>`<tr><td class="text-start fw-bold">${r[0]}</td><td>${r[1]}</td><td>${r[2]?'✅':'❌'}</td></tr>`).join('');
let tips=[];if(len<8)tips.push('Use at least 8 characters');if(!hU)tips.push('Add uppercase letters');if(!hD)tips.push('Include numbers');if(!hS)tips.push('Add special characters');if(common.includes(pwd.toLowerCase()))tips.push('⚠️ Common password — avoid!');
$('out-pwd-tips').innerHTML=tips.length?`<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Tips</h6><ul class="list-unstyled mb-0 small text-secondary">${tips.map(t=>'<li class="mb-2">• '+t+'</li>').join('')}</ul>`:'';
}
inp.addEventListener('input',analyze);$('pwd-test').addEventListener('click',analyze);
document.querySelectorAll('.pwd-quick').forEach(b=>{b.addEventListener('click',()=>{inp.value=b.dataset.pwd;inp.type='text';$('pwd-toggle-icon').className='fas fa-eye-slash';analyze()})});
$('pwd-copy').addEventListener('click',function(){const t=`Password Report\nRating: ${$('out-pwd-rating').textContent}\nEntropy: ${$('out-pwd-entropy').textContent}\nCrack: ${$('out-pwd-crack').textContent}\n— ToolsHub`;navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)})});
analyze();
});
</script>
<style>
.pwd-tester-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.pwd-tester-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.pwd-tester-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.pwd-tester-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.pwd-tester-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.pwd-tester-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\password-strength-tester.blade.php ENDPATH**/ ?>