<div class="row g-4 xml-sitemap-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Modified Date</label>
                        <select id="sm-date" class="form-select form-select-lg rounded-3">
                            <option value="today">Today's Date</option>
                            <option value="custom">Custom Date</option>
                            <option value="none">Do Not Include</option>
                        </select>
                        <input type="date" id="sm-date-custom" class="form-control form-control-sm mt-2" style="display: none;">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Change Frequency</label>
                        <select id="sm-freq" class="form-select form-select-lg rounded-3">
                            <option value="none">Do Not Include</option>
                            <option value="always">Always</option>
                            <option value="hourly">Hourly</option>
                            <option value="daily" selected>Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                            <option value="never">Never</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Priority</label>
                        <select id="sm-priority" class="form-select form-select-lg rounded-3">
                            <option value="none">Do Not Include</option>
                            <option value="0.1">0.1</option>
                            <option value="0.2">0.2</option>
                            <option value="0.3">0.3</option>
                            <option value="0.4">0.4</option>
                            <option value="0.5">0.5</option>
                            <option value="0.6">0.6</option>
                            <option value="0.7">0.7</option>
                            <option value="0.8" selected>0.8</option>
                            <option value="0.9">0.9</option>
                            <option value="1.0">1.0</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">List of URLs</label>
                    <textarea id="sm-urls" class="form-control rounded-3" rows="6" placeholder="https://example.com/&#10;https://example.com/about&#10;https://example.com/contact"></textarea>
                    <div class="small text-muted mt-1">Enter one absolute URL per line (including http:// or https://). Maximum 500 URLs recommended for browser performance.</div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-generate" style="background-color: #ea580c; border-color: #ea580c;"><i class="fas fa-magic me-2"></i>Generate Sitemap</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:24;--tool-color:#ea580c;--tool-bg:rgba(234,88,12,.04); display: none;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-code me-2" style="color: var(--tool-color);"></i>sitemap.xml</h6>
                <span class="badge bg-secondary" id="out-count">0 URLs</span>
            </div>
            
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
    
    const dateSel = $('sm-date');
    const customDate = $('sm-date-custom');
    const freqSel = $('sm-freq');
    const prioSel = $('sm-priority');
    const urlsEl = $('sm-urls');
    
    const outContainer = $('output-container');
    const outCode = $('out-code');
    const outCount = $('out-count');
    
    dateSel.addEventListener('change', function() {
        if(this.value === 'custom') {
            customDate.style.display = 'block';
            if(!customDate.value) customDate.value = new Date().toISOString().split('T')[0];
        } else {
            customDate.style.display = 'none';
        }
    });
    
    $('action-generate').addEventListener('click', function() {
        const rawUrls = urlsEl.value.split('\n').map(u => u.trim()).filter(u => u && (u.startsWith('http://') || u.startsWith('https://')));
        
        if(rawUrls.length === 0) {
            alert('Please enter at least one valid URL starting with http:// or https://');
            return;
        }
        
        // Remove duplicates
        const uniqueUrls = [...new Set(rawUrls)];
        
        let out = [];
        out.push('<' + '?xml version="1.0" encoding="UTF-8"?' + '>');
        out.push('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
        
        let lastMod = '';
        if(dateSel.value === 'today') {
            lastMod = new Date().toISOString().split('T')[0];
        } else if(dateSel.value === 'custom' && customDate.value) {
            lastMod = customDate.value;
        }
        
        const freq = freqSel.value;
        const prio = prioSel.value;
        
        uniqueUrls.forEach(url => {
            out.push('  <url>');
            out.push(`    <loc>${escapeHtml(url)}</loc>`);
            if(lastMod) out.push(`    <lastmod>${lastMod}</lastmod>`);
            if(freq !== 'none') out.push(`    <changefreq>${freq}</changefreq>`);
            if(prio !== 'none') out.push(`    <priority>${prio}</priority>`);
            out.push('  </url>');
        });
        
        out.push('</urlset>');
        
        outCode.textContent = out.join('\n');
        outCount.textContent = `${uniqueUrls.length} URLs`;
        
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        dateSel.value = 'today';
        customDate.style.display = 'none';
        freqSel.value = 'daily';
        prioSel.value = '0.8';
        urlsEl.value = '';
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
    
    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
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
