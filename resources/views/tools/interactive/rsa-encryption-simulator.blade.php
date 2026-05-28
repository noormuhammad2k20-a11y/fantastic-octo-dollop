<div class="row g-4 rsa-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12"><label class="form-label-custom">Plaintext Message</label><textarea id="rsa-plaintext" class="form-control form-control-lg rounded-3" rows="3" placeholder="Enter message to encrypt...">Hello RSA!</textarea></div>
                    <div class="col-md-4"><label class="form-label-custom">Key Size</label><select id="rsa-keysize" class="form-select form-select-lg rounded-3"><option value="1024">1024-bit</option><option value="2048" selected>2048-bit</option><option value="4096">4096-bit</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Padding Scheme</label><select id="rsa-padding" class="form-select form-select-lg rounded-3"><option value="RSA-OAEP" selected>RSA-OAEP</option></select></div>
                    <div class="col-md-4"><label class="form-label-custom">Hash Function</label><select id="rsa-hash" class="form-select form-select-lg rounded-3"><option value="SHA-256" selected>SHA-256</option><option value="SHA-384">SHA-384</option><option value="SHA-512">SHA-512</option></select></div>
                    <div class="col-md-6"><label class="form-label-custom">Public Key (Auto-generated)</label><textarea id="rsa-pubkey" class="form-control rounded-3" rows="3" readonly style="font-size:.75rem;font-family:monospace"></textarea></div>
                    <div class="col-md-6"><label class="form-label-custom">Private Key (Auto-generated)</label><textarea id="rsa-privkey" class="form-control rounded-3" rows="3" readonly style="font-size:.75rem;font-family:monospace"></textarea></div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-dark btn-sm rounded-pill px-4 py-2 fw-bold" id="btn-genkeys"><i class="fas fa-key me-2"></i>Generate Keys</button>
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-4 py-2 fw-bold" id="btn-encrypt"><i class="fas fa-lock me-2"></i>Encrypt</button>
                    <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-4 py-2 fw-bold" id="btn-decrypt"><i class="fas fa-unlock me-2"></i>Decrypt</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-4 py-2" id="btn-clear"><i class="fas fa-eraser me-2"></i>Clear All</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#6366f1;--tool-bg:rgba(99,102,241,.04);">
            <div class="output-hero"><span class="output-hero-label">RSA OUTPUT</span><div class="output-hero-value" id="rsa-output" style="font-size:.9rem;font-family:'Courier New',monospace;word-break:break-all;overflow-wrap:break-word;max-width:100%;overflow-x:auto">Generate keys first, then encrypt.</div></div>
            <div id="rsa-steps" class="mt-3" style="display:none">
                <h6 class="fw-bold mb-2"><i class="fas fa-list-ol me-2 text-primary"></i>Step-by-Step Process</h6>
                <div id="rsa-steps-content" class="small text-secondary"></div>
            </div>
            <div class="row g-3 mt-3">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">KEY SIZE</span><span class="stat-card-value" id="stat-keysize">—</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">PADDING</span><span class="stat-card-value" style="font-size:.9rem" id="stat-padding">—</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">STATUS</span><span class="stat-card-value" id="stat-status">Idle</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">TIME</span><span class="stat-card-value" id="stat-time">—</span></div></div>
            </div>
            <div class="row g-2 mt-4">
                <div class="col-md-6"><button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm w-100" id="btn-copy"><i class="fas fa-copy me-2"></i>Copy Output</button></div>
                <div class="col-md-6"><button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm w-100" id="btn-reset"><i class="fas fa-rotate-left me-2"></i>Reset</button></div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const $=id=>document.getElementById(id);
    let keyPair=null,cipherBuf=null;
    const showSteps=false;
    async function genKeys(){
        const bits=parseInt($('rsa-keysize').value);const hash=$('rsa-hash').value;
        const t0=performance.now();$('stat-status').textContent='Generating...';
        try{
            keyPair=await crypto.subtle.generateKey({name:'RSA-OAEP',modulusLength:bits,publicExponent:new Uint8Array([1,0,1]),hash:hash},{extractable:true},['encrypt','decrypt']);
            const pub=await crypto.subtle.exportKey('spki',keyPair.publicKey);const priv=await crypto.subtle.exportKey('pkcs8',keyPair.privateKey);
            $('rsa-pubkey').value=btoa(String.fromCharCode(...new Uint8Array(pub)));
            $('rsa-privkey').value=btoa(String.fromCharCode(...new Uint8Array(priv)));
            const elapsed=Math.round(performance.now()-t0);
            $('stat-keysize').textContent=bits+'-bit';$('stat-padding').textContent='RSA-OAEP';$('stat-status').textContent='Keys Ready';$('stat-time').textContent=elapsed+'ms';
            $('rsa-output').textContent='Keys generated. Enter plaintext and click Encrypt.';
            if(showSteps){$('rsa-steps').style.display='block';$('rsa-steps-content').innerHTML='<ol class="mb-0"><li>Generated two large primes p and q ('+bits/2+'-bit each)</li><li>Computed n = p × q ('+bits+'-bit modulus)</li><li>Computed φ(n) = (p-1)(q-1)</li><li>Selected public exponent e = 65537</li><li>Computed private exponent d = e⁻¹ mod φ(n)</li><li>Public key = (n, e), Private key = (n, d)</li></ol>';}
        }catch(e){$('rsa-output').textContent='Error: '+e.message;$('stat-status').textContent='Error';}
    }
    async function encrypt(){
        if(!keyPair){alert('Generate keys first.');return;}
        const msg=$('rsa-plaintext').value;const t0=performance.now();
        try{
            cipherBuf=await crypto.subtle.encrypt({name:'RSA-OAEP'},keyPair.publicKey,new TextEncoder().encode(msg));
            const hex=Array.from(new Uint8Array(cipherBuf)).map(b=>b.toString(16).padStart(2,'0')).join('');
            const elapsed=Math.round(performance.now()-t0);
            $('rsa-output').textContent=hex;$('stat-status').textContent='Encrypted';$('stat-time').textContent=elapsed+'ms';
            if(showSteps){$('rsa-steps').style.display='block';$('rsa-steps-content').innerHTML='<ol class="mb-0"><li>Encoded plaintext "'+msg.substring(0,30)+'..." to bytes ('+new TextEncoder().encode(msg).length+' bytes)</li><li>Applied OAEP padding with '+$('rsa-hash').value+' hash</li><li>Computed ciphertext c = m^e mod n</li><li>Output: '+hex.length+' hex chars ('+cipherBuf.byteLength+' bytes)</li></ol>';}
        }catch(e){$('rsa-output').textContent='Error: '+e.message;$('stat-status').textContent='Error';}
    }
    async function decrypt(){
        if(!keyPair||!cipherBuf){alert('Encrypt a message first.');return;}
        const t0=performance.now();
        try{
            const plainBuf=await crypto.subtle.decrypt({name:'RSA-OAEP'},keyPair.privateKey,cipherBuf);
            const plaintext=new TextDecoder().decode(plainBuf);const elapsed=Math.round(performance.now()-t0);
            $('rsa-output').textContent='Decrypted: '+plaintext;$('stat-status').textContent='Decrypted';$('stat-time').textContent=elapsed+'ms';
            if(showSteps){$('rsa-steps-content').innerHTML='<ol class="mb-0"><li>Received ciphertext ('+cipherBuf.byteLength+' bytes)</li><li>Computed m = c^d mod n using private key</li><li>Removed OAEP padding</li><li>Decoded bytes to plaintext: "'+plaintext+'"</li></ol>';}
        }catch(e){$('rsa-output').textContent='Decryption failed: '+e.message;$('stat-status').textContent='Error';}
    }
    $('btn-genkeys').addEventListener('click',genKeys);$('btn-encrypt').addEventListener('click',encrypt);$('btn-decrypt').addEventListener('click',decrypt);
    $('btn-clear').addEventListener('click',()=>{$('rsa-plaintext').value='';$('rsa-pubkey').value='';$('rsa-privkey').value='';keyPair=null;cipherBuf=null;$('rsa-output').textContent='—';$('rsa-steps').style.display='none';});
    $('btn-copy').addEventListener('click',function(){navigator.clipboard.writeText($('rsa-output').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class=\"fas fa-check me-2\"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000);});});
    $('btn-reset').addEventListener('click',()=>{$('rsa-plaintext').value='Hello RSA!';keyPair=null;cipherBuf=null;$('rsa-output').textContent='Generate keys first, then encrypt.';$('rsa-steps').style.display='none';});
});
</script>
<style>.rsa-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}.rsa-rebuilt .calculator-header{display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem}.rsa-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b;font-size:1.25rem}.rsa-rebuilt .calculator-header p{margin:0;font-size:.85rem;color:#64748b}.rsa-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}.rsa-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}</style>