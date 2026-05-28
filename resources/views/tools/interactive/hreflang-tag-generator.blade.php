<div class="row g-4 hreflang-generator-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Default URL (x-default)</label>
                    <input type="url" id="x-default-url" class="form-control form-control-lg rounded-3 mb-2" placeholder="https://example.com/">
                    <div class="small text-muted">The fallback page for unmatched languages.</div>
                </div>

                <hr class="my-4" style="opacity: 0.1;">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label class="form-label-custom mb-0">Language Versions</label>
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3" id="add-lang-btn"><i class="fas fa-plus me-1"></i>Add Language</button>
                </div>

                <div id="lang-container">
                    <!-- Initial Row -->
                    <div class="row g-2 align-items-end mb-3 lang-row">
                        <div class="col-md-3">
                            <label class="form-label small text-muted">Language Code</label>
                            <input type="text" class="form-control lang-code" placeholder="en" value="en">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small text-muted">Country (Optional)</label>
                            <input type="text" class="form-control lang-region" placeholder="us" value="us">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small text-muted">URL</label>
                            <input type="url" class="form-control lang-url" placeholder="https://example.com/en-us/">
                        </div>
                        <div class="col-md-1 text-end">
                            <button class="btn btn-outline-danger w-100 remove-btn" disabled><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-generate" style="background-color: #f59e0b; border-color: #f59e0b;"><i class="fas fa-magic me-2"></i>Generate Tags</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:38;--tool-color:#f59e0b;--tool-bg:rgba(245,158,11,.04); display: none;">
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
    
    const container = $('lang-container');
    const addBtn = $('add-lang-btn');
    const outContainer = $('output-container');
    const outCode = $('out-code');
    
    function updateRemoveBtns() {
        const rows = container.querySelectorAll('.lang-row');
        rows.forEach((r, i) => {
            const btn = r.querySelector('.remove-btn');
            btn.disabled = rows.length === 1;
        });
    }

    addBtn.addEventListener('click', function() {
        const row = document.createElement('div');
        row.className = 'row g-2 align-items-end mb-3 lang-row';
        row.innerHTML = `
            <div class="col-md-3">
                <label class="form-label small text-muted d-md-none">Language Code</label>
                <input type="text" class="form-control lang-code" placeholder="es">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted d-md-none">Country (Optional)</label>
                <input type="text" class="form-control lang-region" placeholder="es">
            </div>
            <div class="col-md-5">
                <label class="form-label small text-muted d-md-none">URL</label>
                <input type="url" class="form-control lang-url" placeholder="https://example.com/es-es/">
            </div>
            <div class="col-md-1 text-end">
                <button class="btn btn-outline-danger w-100 remove-btn"><i class="fas fa-trash"></i></button>
            </div>
        `;
        container.appendChild(row);
        
        row.querySelector('.remove-btn').addEventListener('click', function() {
            row.remove();
            updateRemoveBtns();
        });
        updateRemoveBtns();
    });

    // Attach to initial remove btn
    container.querySelector('.remove-btn').addEventListener('click', function() {
        this.closest('.lang-row').remove();
        updateRemoveBtns();
    });

    $('action-generate').addEventListener('click', function() {
        const xDefault = $('x-default-url').value.trim();
        let tags = [];
        
        if(xDefault) {
            tags.push(`<link rel="alternate" href="${escapeHtml(xDefault)}" hreflang="x-default" />`);
        }

        const rows = container.querySelectorAll('.lang-row');
        rows.forEach(r => {
            const code = r.querySelector('.lang-code').value.trim().toLowerCase();
            const region = r.querySelector('.lang-region').value.trim().toUpperCase();
            const url = r.querySelector('.lang-url').value.trim();
            
            if(code && url) {
                const hreflang = region ? `${code}-${region}` : code;
                tags.push(`<link rel="alternate" href="${escapeHtml(url)}" hreflang="${escapeHtml(hreflang)}" />`);
            }
        });
        
        if (tags.length === 0) {
            alert('Please add at least one language URL or a default URL.');
            return;
        }

        outCode.textContent = tags.join('\n');
        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        $('x-default-url').value = '';
        container.innerHTML = '';
        addBtn.click(); // Adds one empty row
        const firstRow = container.querySelector('.lang-row');
        firstRow.querySelector('.lang-code').value = 'en';
        firstRow.querySelector('.lang-region').value = 'us';
        outContainer.style.display = 'none';
        updateRemoveBtns();
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
