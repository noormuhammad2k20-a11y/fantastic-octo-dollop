<div class="row g-4 og-generator-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Title (og:title)</label>
                        <input type="text" id="og-title" class="form-control form-control-lg rounded-3" placeholder="Page Title...">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Type (og:type)</label>
                        <select id="og-type" class="form-select form-select-lg rounded-3">
                            <option value="website">Website</option>
                            <option value="article">Article</option>
                            <option value="profile">Profile</option>
                            <option value="book">Book</option>
                            <option value="music.song">Music Song</option>
                            <option value="video.movie">Video Movie</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">URL (og:url)</label>
                        <input type="url" id="og-url" class="form-control form-control-lg rounded-3" placeholder="https://example.com/page">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Image URL (og:image)</label>
                        <input type="url" id="og-image" class="form-control form-control-lg rounded-3" placeholder="https://example.com/image.jpg">
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label-custom">Description (og:description)</label>
                        <textarea id="og-description" class="form-control rounded-3" rows="3" placeholder="Brief summary of the content..."></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-generate" style="background-color: #3b82f6; border-color: #3b82f6;"><i class="fas fa-magic me-2"></i>Generate Markup</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:217;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04); display: none;">
            <h6 class="fw-bold mb-3"><i class="fas fa-code me-2" style="color: var(--tool-color);"></i>Generated HTML</h6>
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
    
    const titleEl = $('og-title');
    const typeEl = $('og-type');
    const urlEl = $('og-url');
    const imgEl = $('og-image');
    const descEl = $('og-description');
    
    const outContainer = $('output-container');
    const outCode = $('out-code');
    
    $('action-generate').addEventListener('click', function() {
        const title = titleEl.value.trim();
        const type = typeEl.value;
        const url = urlEl.value.trim();
        const img = imgEl.value.trim();
        const desc = descEl.value.trim();
        
        let tags = [];
        tags.push(`<!-- Open Graph Meta Tags -->`);
        if(title) tags.push(`<meta property="og:title" content="${escapeHtml(title)}">`);
        tags.push(`<meta property="og:type" content="${escapeHtml(type)}">`);
        if(url) tags.push(`<meta property="og:url" content="${escapeHtml(url)}">`);
        if(img) tags.push(`<meta property="og:image" content="${escapeHtml(img)}">`);
        if(desc) tags.push(`<meta property="og:description" content="${escapeHtml(desc)}">`);
        
        // Add twitter cards for good measure
        tags.push(`\n<!-- Twitter Card Meta Tags -->`);
        tags.push(`<meta name="twitter:card" content="summary_large_image">`);
        if(title) tags.push(`<meta name="twitter:title" content="${escapeHtml(title)}">`);
        if(desc) tags.push(`<meta name="twitter:description" content="${escapeHtml(desc)}">`);
        if(img) tags.push(`<meta name="twitter:image" content="${escapeHtml(img)}">`);
        
        outCode.textContent = tags.join('\n');
        outContainer.style.display = 'block';
        
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        titleEl.value = '';
        typeEl.value = 'website';
        urlEl.value = '';
        imgEl.value = '';
        descEl.value = '';
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
