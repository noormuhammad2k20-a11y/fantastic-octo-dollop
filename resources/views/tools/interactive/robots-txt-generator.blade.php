<div class="row g-4 robots-generator-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <h6 class="fw-bold mb-3">Global Settings</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Default Access</label>
                        <select id="rob-default" class="form-select form-select-lg rounded-3">
                            <option value="allow">Allow All Robots</option>
                            <option value="refuse">Refuse All Robots</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Crawl-Delay</label>
                        <select id="rob-delay" class="form-select form-select-lg rounded-3">
                            <option value="">Default (No Delay)</option>
                            <option value="5">5 Seconds</option>
                            <option value="10">10 Seconds</option>
                            <option value="20">20 Seconds</option>
                            <option value="60">60 Seconds</option>
                            <option value="120">120 Seconds</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Sitemap URL</label>
                        <input type="url" id="rob-sitemap" class="form-control form-control-lg rounded-3" placeholder="https://example.com/sitemap.xml">
                    </div>
                </div>

                <h6 class="fw-bold mb-3">Specific Search Robots</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-3 col-6">
                        <label class="form-label small text-muted mb-1">Googlebot</label>
                        <select class="form-select form-select-sm rob-bot" data-bot="Googlebot">
                            <option value="default">Default</option>
                            <option value="allow">Allow</option>
                            <option value="refuse">Refuse</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small text-muted mb-1">Googlebot-Image</label>
                        <select class="form-select form-select-sm rob-bot" data-bot="Googlebot-Image">
                            <option value="default">Default</option>
                            <option value="allow">Allow</option>
                            <option value="refuse">Refuse</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small text-muted mb-1">Bingbot</label>
                        <select class="form-select form-select-sm rob-bot" data-bot="bingbot">
                            <option value="default">Default</option>
                            <option value="allow">Allow</option>
                            <option value="refuse">Refuse</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small text-muted mb-1">Slurp (Yahoo)</label>
                        <select class="form-select form-select-sm rob-bot" data-bot="Slurp">
                            <option value="default">Default</option>
                            <option value="allow">Allow</option>
                            <option value="refuse">Refuse</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small text-muted mb-1">DuckDuckBot</label>
                        <select class="form-select form-select-sm rob-bot" data-bot="DuckDuckBot">
                            <option value="default">Default</option>
                            <option value="allow">Allow</option>
                            <option value="refuse">Refuse</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small text-muted mb-1">Baiduspider</label>
                        <select class="form-select form-select-sm rob-bot" data-bot="Baiduspider">
                            <option value="default">Default</option>
                            <option value="allow">Allow</option>
                            <option value="refuse">Refuse</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small text-muted mb-1">YandexBot</label>
                        <select class="form-select form-select-sm rob-bot" data-bot="YandexBot">
                            <option value="default">Default</option>
                            <option value="allow">Allow</option>
                            <option value="refuse">Refuse</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small text-muted mb-1">Facebot</label>
                        <select class="form-select form-select-sm rob-bot" data-bot="Facebot">
                            <option value="default">Default</option>
                            <option value="allow">Allow</option>
                            <option value="refuse">Refuse</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">Restricted Directories</label>
                    <textarea id="rob-dirs" class="form-control rounded-3" rows="3" placeholder="/cgi-bin/&#10;/admin/&#10;/tmp/"></textarea>
                    <div class="small text-muted mt-1">One directory per line. The path must begin with a forward slash "/".</div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-generate" style="background-color: #4b5563; border-color: #4b5563;"><i class="fas fa-magic me-2"></i>Generate File</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:210;--tool-color:#4b5563;--tool-bg:rgba(75,85,99,.04); display: none;">
            <h6 class="fw-bold mb-3"><i class="fas fa-file-alt me-2" style="color: var(--tool-color);"></i>robots.txt</h6>
            <div class="position-relative">
                <pre class="bg-dark text-light p-4 rounded-3 small mb-0 overflow-x-auto" style="word-break: break-all; white-space: pre-wrap;" id="out-code"></pre>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Result</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const defAccess = $('rob-default');
    const defDelay = $('rob-delay');
    const sitemap = $('rob-sitemap');
    const dirs = $('rob-dirs');
    const bots = document.querySelectorAll('.rob-bot');
    
    const outContainer = $('output-container');
    const outCode = $('out-code');
    
    $('action-generate').addEventListener('click', function() {
        let out = [];
        
        // Handle specific bots first
        bots.forEach(b => {
            const botName = b.getAttribute('data-bot');
            const val = b.value;
            if(val !== 'default') {
                out.push(`User-agent: ${botName}`);
                if(val === 'allow') {
                    out.push(`Allow: /`);
                } else if(val === 'refuse') {
                    out.push(`Disallow: /`);
                }
                out.push(''); // blank line
            }
        });
        
        // Handle default access
        out.push(`User-agent: *`);
        if(defAccess.value === 'refuse') {
            out.push(`Disallow: /`);
        } else {
            // It's allowed, but do we have restricted dirs?
            const dirLines = dirs.value.split('\n').map(d => d.trim()).filter(d => d);
            if(dirLines.length > 0) {
                dirLines.forEach(d => {
                    if(!d.startsWith('/')) d = '/' + d;
                    out.push(`Disallow: ${d}`);
                });
            } else {
                out.push(`Disallow:`); // empty disallow means allow all
            }
        }
        
        if(defDelay.value) {
            out.push(`Crawl-delay: ${defDelay.value}`);
        }
        
        if(sitemap.value.trim()) {
            out.push('');
            out.push(`Sitemap: ${sitemap.value.trim()}`);
        }
        
        outCode.textContent = out.join('\n');
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        defAccess.value = 'allow';
        defDelay.value = '';
        sitemap.value = '';
        dirs.value = '';
        bots.forEach(b => b.value = 'default');
        outContainer.style.display = 'none';
    });
    
    $('action-copy').addEventListener('click', function() {
        const code = outCode.textContent;
        navigator.clipboard.writeText(code).then(()=>{
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            this.classList.replace('btn-dark', 'btn-success');
            setTimeout(()=>{
                this.innerHTML = orig;
                this.classList.replace('btn-success', 'btn-dark');
            }, 2000);
        });
    });
});
</script>

<style>
.form-label-custom {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}
.calculator-card {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
    overflow: hidden;
}
.calculator-header {
    padding: 2rem 2rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 1.25rem;
}
.tool-icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}
.calculator-header h4 {
    margin: 0 0 0.25rem 0;
    font-weight: 700;
    color: #111827;
}
.calculator-header p {
    margin: 0;
    color: #6b7280;
    font-size: 0.95rem;
}
.calculator-body {
    padding: 2rem;
}
.output-card-themed {
    background: #fff;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid var(--tool-bg);
    border-top: 4px solid var(--tool-color);
}
</style>
