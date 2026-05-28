<div class="row g-4 html-text-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="mb-4">
                    <label class="form-label-custom">Raw HTML Code</label>
                    <textarea id="html-input" class="form-control rounded-3 font-monospace small bg-light" rows="10" placeholder="<h1>Hello World</h1>&#10;<p>This is a <strong>test</strong>.</p>"></textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-convert" style="background-color: #ec4899; border-color: #ec4899;"><i class="fas fa-magic me-2"></i>Extract Text</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:330;--tool-color:#ec4899;--tool-bg:rgba(236,72,153,.04); display: none;">
            
            <h6 class="fw-bold mb-3"><i class="fas fa-align-left me-2" style="color: var(--tool-color);"></i>Extracted Text</h6>
            <div class="position-relative">
                <pre class="bg-white text-dark border p-4 rounded-3 mb-0 overflow-x-auto" style="word-break: break-word; white-space: pre-wrap; font-family: inherit;" id="out-text"></pre>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Text</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const inputEl = $('html-input');
    
    const outContainer = $('output-container');
    const outText = $('out-text');
    
    $('action-convert').addEventListener('click', function() {
        let html = inputEl.value;
        if(!html.trim()) {
            alert('Please enter some HTML code to convert.');
            return;
        }
        
        // Remove style and script tags entirely
        html = html.replace(/<style[^>]*>[\s\S]*?<\/style>/gi, '');
        html = html.replace(/<script[^>]*>[\s\S]*?<\/script>/gi, '');
        
        // Add newlines for block elements
        html = html.replace(/<\/(p|div|h[1-6]|ul|ol|li|table|tr|blockquote)>/gi, '\n');
        html = html.replace(/<br\s*\/?>/gi, '\n');
        
        // Strip tags
        let text = html.replace(/<[^>]+>/g, '');
        
        // Decode HTML entities (basic)
        const txt = document.createElement('textarea');
        txt.innerHTML = text;
        text = txt.value;
        
        // Cleanup multiple blank lines
        text = text.replace(/\n\s*\n/g, '\n\n').trim();
        
        outText.textContent = text;
        
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        inputEl.value = '';
        outContainer.style.display = 'none';
    });
    
    $('action-copy').addEventListener('click', function() {
        const text = outText.textContent;
        navigator.clipboard.writeText(text).then(()=>{
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
