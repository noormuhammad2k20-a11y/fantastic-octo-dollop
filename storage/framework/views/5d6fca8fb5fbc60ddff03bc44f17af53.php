<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="toolbar-v2 d-flex gap-1 p-1 bg-light rounded-3 border">
                            <button class="btn btn-icon-pill" onclick="insertMD('**', '**')" title="Bold"><i class="fas fa-bold"></i></button>
                            <button class="btn btn-icon-pill" onclick="insertMD('_', '_')" title="Italic"><i class="fas fa-italic"></i></button>
                            <button class="btn btn-icon-pill" onclick="insertMD('### ', '')" title="Heading"><i class="fas fa-heading"></i></button>
                            <button class="btn btn-icon-pill" onclick="insertMD('> ', '')" title="Quote"><i class="fas fa-quote-left"></i></button>
                            <button class="btn btn-icon-pill" onclick="insertMD('[', '](url)')" title="Link"><i class="fas fa-link"></i></button>
                            <button class="btn btn-icon-pill" onclick="insertMD('- ', '')" title="List"><i class="fas fa-list-ul"></i></button>
                            <button class="btn btn-icon-pill" onclick="insertMD('`', '`')" title="Code"><i class="fas fa-code"></i></button>
                            <button class="btn btn-icon-pill" onclick="insertMD('```\n', '\n```')" title="Code Block"><i class="fas fa-file-code"></i></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="12" placeholder="# Start writing your markdown..."></textarea>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
            <div class="output-header d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-eye fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Live Rendered Preview</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download .md
                    </button>
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy-html" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-code me-1"></i> Copy HTML
                    </button>
                </div>
            </div>
            
            <div id="preview-output" class="markdown-preview p-4 rounded-4 border bg-white shadow-inner" style="min-height: 300px; overflow-y: auto;">
                <p class="text-muted">Your rendered content will appear here...</p>
            </div>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Ready to render</div>
                <div class="badge bg-light text-primary border" id="render-badge">GFM Mode</div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<style>
.calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2rem; }
.calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2rem; }
.calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.02em; }
.calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; flex-shrink: 0; }
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Fira Code', monospace; font-size: 0.95rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.btn-icon-pill { width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center; border: none; background: transparent; color: #64748b; border-radius: 8px; transition: all 0.2s; }
.btn-icon-pill:hover { background: #fff; color: #4f46e5; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

.markdown-preview { line-height: 1.7; font-size: 1.05rem; color: #1e293b; background: #fff; }
.markdown-preview h1 { font-size: 2.2rem; font-weight: 800; border-bottom: 2px solid #f1f5f9; padding-bottom: 0.5rem; margin-bottom: 1.5rem; }
.markdown-preview h2 { font-size: 1.8rem; font-weight: 700; margin-top: 2rem; border-bottom: 1px solid #f1f5f9; }
.markdown-preview blockquote { border-left: 4px solid #4f46e5; padding: 1rem 1.5rem; background: #f8fafc; border-radius: 0 12px 12px 0; margin: 1.5rem 0; font-style: italic; }
.markdown-preview code { background: #f1f5f9; padding: 0.2rem 0.4rem; border-radius: 6px; font-family: 'Fira Code', monospace; font-size: 0.9em; color: #e11d48; }
.markdown-preview pre { background: #0f172a; color: #f8fafc; padding: 1.5rem; border-radius: 12px; overflow-x: auto; margin: 1.5rem 0; }
.markdown-preview pre code { background: transparent; padding: 0; color: inherit; }
.markdown-preview img { max-width: 100%; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
</style>

<script>
window.insertMD = function(prefix, suffix) {
    const textarea = document.getElementById('input-text');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;
    const before = text.substring(0, start);
    const selected = text.substring(start, end);
    const after = text.substring(end);
    
    textarea.value = before + prefix + selected + suffix + after;
    textarea.focus();
    textarea.setSelectionRange(start + prefix.length, end + prefix.length);
    textarea.dispatchEvent(new Event('input'));
};

document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const preview = document.getElementById('preview-output');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopyHTML = document.getElementById('btn-copy-html');
    const btnDownload = document.getElementById('btn-download');
    const statsText = document.getElementById('stats-text');

    marked.setOptions({
        gfm: true,
        breaks: true,
        headerIds: true,
        mangle: false
    });

    function render() {
        const md = input.value;
        if (!md.trim()) {
            preview.innerHTML = '<p class="text-muted">Your rendered content will appear here...</p>';
            statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready to render';
            return;
        }
        
        preview.innerHTML = marked.parse(md);
        const words = md.trim() ? md.trim().split(/\s+/).length : 0;
        statsText.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> Words: <strong>${words}</strong> | Chars: <strong>${md.length}</strong>`;
    }

    input.addEventListener('input', render);

    btnClear.addEventListener('click', () => {
        input.value = '';
        render();
    });

    btnSample.addEventListener('click', () => {
        input.value = "# ToolsHub Markdown Editor\n\nThis is a **live preview** editor. \n\n### Features\n- Simple to use\n- Fast rendering with `marked.js`\n- Reliable GFM output\n\n> Start composing your premium content now!\n\n```javascript\nfunction hello() {\n  console.log('Welcome to ToolsHub!');\n}\n```\n\n![Image Example](https://picsum.photos/800/400)";
        render();
    });

    btnCopyHTML.addEventListener('click', () => {
        if (!input.value.trim()) return;
        navigator.clipboard.writeText(preview.innerHTML);
        const btn = btnCopyHTML;
        const old = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btn.classList.replace('btn-primary', 'btn-dark');
        setTimeout(() => {
            btn.innerHTML = old;
            btn.classList.replace('btn-dark', 'btn-primary');
        }, 2000);
    });

    btnDownload.addEventListener('click', () => {
        if (!input.value.trim()) return;
        const blob = new Blob([input.value], { type: 'text/markdown' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `content-${Date.now()}.md`;
        a.click();
        URL.revokeObjectURL(url);
    });
    
    // Initial content
    btnSample.click();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\markdown-editor.blade.php ENDPATH**/ ?>