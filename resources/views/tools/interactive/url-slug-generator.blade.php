<div class="row g-4 url-slug-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="mb-4">
                    <label class="form-label-custom">Text to Convert</label>
                    <textarea id="slug-input" class="form-control rounded-3 form-control-lg" rows="3" placeholder="Enter your blog post title or text here..."></textarea>
                </div>
                
                <h6 class="fw-bold mb-3">Formatting Options</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input" type="checkbox" id="slug-lowercase" checked>
                            <label class="form-check-label pt-1 ms-2" for="slug-lowercase">Convert to lowercase</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input" type="checkbox" id="slug-separator" checked>
                            <label class="form-check-label pt-1 ms-2" for="slug-separator">Use dashes for spaces</label>
                            <div class="small text-muted ms-5 mt-1" style="font-size: 0.75rem;">If unchecked, underscores are used.</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input" type="checkbox" id="slug-remove-special" checked>
                            <label class="form-check-label pt-1 ms-2" for="slug-remove-special">Remove special chars</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-generate" style="background-color: #a855f7; border-color: #a855f7;"><i class="fas fa-magic me-2"></i>Generate Slug</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:273;--tool-color:#a855f7;--tool-bg:rgba(168,85,247,.04); display: none;">
            
            <h6 class="fw-bold mb-3"><i class="fas fa-check-circle me-2" style="color: var(--tool-color);"></i>SEO-Friendly URL Slug</h6>
            <div class="position-relative">
                <div class="p-4 bg-white border rounded-3 fs-5 font-monospace text-dark text-break shadow-sm" id="out-slug"></div>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Slug</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const inputEl = $('slug-input');
    const optLower = $('slug-lowercase');
    const optDash = $('slug-separator');
    const optSpecial = $('slug-remove-special');
    
    const outContainer = $('output-container');
    const outSlug = $('out-slug');
    
    $('action-generate').addEventListener('click', function() {
        let text = inputEl.value.trim();
        if(!text) {
            alert('Please enter some text to convert.');
            return;
        }
        
        // Remove accents
        if(optSpecial.checked) {
            text = text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            text = text.replace(/[^\w\s-]/g, '');
        }
        
        if(optLower.checked) {
            text = text.toLowerCase();
        }
        
        const separator = optDash.checked ? '-' : '_';
        
        // Replace spaces with separator
        text = text.replace(/\s+/g, separator);
        
        // Remove duplicate separators
        const regex = new RegExp(`[${separator}]{2,}`, 'g');
        text = text.replace(regex, separator);
        
        // Trim separators from ends
        if(text.startsWith(separator)) text = text.substring(1);
        if(text.endsWith(separator)) text = text.substring(0, text.length - 1);
        
        outSlug.textContent = text;
        
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        inputEl.value = '';
        optLower.checked = true;
        optDash.checked = true;
        optSpecial.checked = true;
        outContainer.style.display = 'none';
    });
    
    $('action-copy').addEventListener('click', function() {
        const text = outSlug.textContent;
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
