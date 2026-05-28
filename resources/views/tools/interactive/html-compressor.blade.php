<div class="row g-4 html-compressor-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-end mb-2">
                        <label class="form-label-custom mb-0">Raw HTML Code</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="html-preserve-comments">
                            <label class="form-check-label small text-muted" for="html-preserve-comments">Preserve Comments</label>
                        </div>
                    </div>
                    <textarea id="html-input" class="form-control rounded-3 font-monospace small bg-light" rows="10" placeholder="<!DOCTYPE html>&#10;<html>&#10;  <head>&#10;    <title>Example</title>&#10;  </head>&#10;  <body>&#10;    <!-- Content -->&#10;  </body>&#10;</html>"></textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-compress" style="background-color: #ef4444; border-color: #ef4444;"><i class="fas fa-magic me-2"></i>Compress HTML</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:0;--tool-color:#ef4444;--tool-bg:rgba(239,68,68,.04); display: none;">
            
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card p-3 border rounded-3 bg-white text-center shadow-sm h-100">
                        <span class="d-block text-muted small fw-bold mb-1">Original Size</span>
                        <span class="d-block fw-bold fs-5 text-dark" id="out-orig">0 B</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 border rounded-3 bg-white text-center shadow-sm h-100">
                        <span class="d-block text-muted small fw-bold mb-1">Compressed Size</span>
                        <span class="d-block fw-bold fs-5" style="color: var(--tool-color);" id="out-comp">0 B</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3 border rounded-3 bg-white text-center shadow-sm h-100">
                        <span class="d-block text-muted small fw-bold mb-1">Savings</span>
                        <span class="d-block fw-bold fs-5 text-success" id="out-saved">0%</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-3"><i class="fas fa-code me-2" style="color: var(--tool-color);"></i>Minified HTML</h6>
            <div class="position-relative">
                <pre class="bg-dark text-light p-4 rounded-3 small mb-0 overflow-x-auto" style="word-break: break-all; white-space: pre-wrap;" id="out-code"></pre>
            </div>
            
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="action-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Compressed Code</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const inputEl = $('html-input');
    const keepCommentsEl = $('html-preserve-comments');
    
    const outContainer = $('output-container');
    const outCode = $('out-code');
    const outOrig = $('out-orig');
    const outComp = $('out-comp');
    const outSaved = $('out-saved');
    
    function formatBytes(bytes, decimals = 2) {
        if (!+bytes) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
    }

    $('action-compress').addEventListener('click', function() {
        let html = inputEl.value;
        if(!html.trim()) {
            alert('Please enter some HTML code to compress.');
            return;
        }
        
        const origSize = new Blob([html]).size;
        
        // Basic HTML Minification
        // Remove comments if not preserved
        if(!keepCommentsEl.checked) {
            html = html.replace(/<!--[\s\S]*?-->/g, '');
        }
        
        // Remove extra whitespaces
        html = html.replace(/\s+/g, ' ');
        // Remove whitespace around tags
        html = html.replace(/>\s+</g, '><');
        
        // Trim
        html = html.trim();
        
        const compSize = new Blob([html]).size;
        let savings = 0;
        if(origSize > 0) {
            savings = ((origSize - compSize) / origSize) * 100;
        }
        
        outCode.textContent = html;
        outOrig.textContent = formatBytes(origSize);
        outComp.textContent = formatBytes(compSize);
        outSaved.textContent = savings.toFixed(1) + '%';
        
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        inputEl.value = '';
        keepCommentsEl.checked = false;
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
