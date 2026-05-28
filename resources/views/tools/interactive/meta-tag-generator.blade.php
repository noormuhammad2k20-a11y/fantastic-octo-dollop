<div class="row g-4 meta-tags-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">Site Title</label>
                        <input type="text" id="site-title" class="form-control form-control-lg rounded-3" placeholder="Enter page title...">
                        <div class="small text-muted mt-1" id="title-count">0 / 60 characters</div>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label-custom">Site Description</label>
                        <textarea id="site-description" class="form-control rounded-3" rows="3" placeholder="Enter meta description..."></textarea>
                        <div class="small text-muted mt-1" id="desc-count">0 / 160 characters</div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Keywords (Comma separated)</label>
                        <input type="text" id="site-keywords" class="form-control form-control-lg rounded-3" placeholder="seo tools, webmaster tools...">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Robots Index</label>
                        <select id="robots-index" class="form-select form-select-lg rounded-3">
                            <option value="index, follow">Index, Follow</option>
                            <option value="index, nofollow">Index, No Follow</option>
                            <option value="noindex, follow">No Index, Follow</option>
                            <option value="noindex, nofollow">No Index, No Follow</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-generate" style="background-color: #10b981; border-color: #10b981;"><i class="fas fa-magic me-2"></i>Generate Tags</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:160;--tool-color:#10b981;--tool-bg:rgba(16,185,129,.04); display: none;">
            <h6 class="fw-bold mb-3"><i class="fas fa-code me-2" style="color: var(--tool-color);"></i>Generated HTML</h6>
            <div class="position-relative">
                <pre class="bg-dark text-light p-4 rounded-3 small mb-0 overflow-x-auto" style="word-break: break-all; white-space: pre-wrap;" id="out-code"></pre>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Tags</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const titleEl = $('site-title');
    const descEl = $('site-description');
    const keyEl = $('site-keywords');
    const robotsEl = $('robots-index');
    
    const titleCount = $('title-count');
    const descCount = $('desc-count');
    
    const outContainer = $('output-container');
    const outCode = $('out-code');
    
    function updateCounts() {
        const tLen = titleEl.value.length;
        const dLen = descEl.value.length;
        titleCount.textContent = `${tLen} / 60 characters`;
        titleCount.className = `small mt-1 ${tLen > 60 ? 'text-danger fw-bold' : 'text-muted'}`;
        descCount.textContent = `${dLen} / 160 characters`;
        descCount.className = `small mt-1 ${dLen > 160 ? 'text-danger fw-bold' : 'text-muted'}`;
    }
    
    titleEl.addEventListener('input', updateCounts);
    descEl.addEventListener('input', updateCounts);
    
    $('action-generate').addEventListener('click', function() {
        const title = titleEl.value.trim();
        const desc = descEl.value.trim();
        const keys = keyEl.value.trim();
        const robots = robotsEl.value;
        
        let tags = [];
        if(title) {
            tags.push(`<title>${escapeHtml(title)}</title>`);
            tags.push(`<meta name="title" content="${escapeHtml(title)}">`);
        }
        if(desc) tags.push(`<meta name="description" content="${escapeHtml(desc)}">`);
        if(keys) tags.push(`<meta name="keywords" content="${escapeHtml(keys)}">`);
        tags.push(`<meta name="robots" content="${robots}">`);
        tags.push(`<meta http-equiv="Content-Type" content="text/html; charset=utf-8">`);
        tags.push(`<meta name="language" content="English">`);
        
        outCode.textContent = tags.join('\n');
        outContainer.style.display = 'block';
        
        // Scroll to output
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        titleEl.value = '';
        descEl.value = '';
        keyEl.value = '';
        robotsEl.value = 'index, follow';
        outContainer.style.display = 'none';
        updateCounts();
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
