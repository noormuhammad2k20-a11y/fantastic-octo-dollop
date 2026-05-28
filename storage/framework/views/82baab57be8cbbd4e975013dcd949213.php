<div class="row g-4">
    
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">HTML Source Code</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="10" placeholder="Paste your HTML here... (e.g. <h1>Hello</h1>)"></textarea>
                </div>

                <div class="options-grid p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label-custom">Heading Style</label>
                            <select id="heading-style" class="form-select rounded-3">
                                <option value="atx" selected>ATX (# Heading)</option>
                                <option value="setext">Setext (Heading ===)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Bullet Style</label>
                            <select id="bullet-style" class="form-select rounded-3">
                                <option value="-" selected>- Dash</option>
                                <option value="*">* Asterisk</option>
                                <option value="+">+ Plus</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Code Block</label>
                            <select id="code-block-style" class="form-select rounded-3">
                                <option value="fenced" selected>Fenced (```)</option>
                                <option value="indented">Indented</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Link Style</label>
                            <select id="link-style-select" class="form-select rounded-3">
                                <option value="inlined" selected>Inlined</option>
                                <option value="referenced">Referenced</option>
                            </select>
                        </div>
                        <div class="col-12 mt-4 d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="gfm-enabled" checked>
                                    <label class="form-check-label small fw-bold" for="gfm-enabled">GFM (Tables/Tasks)</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="keep-tags">
                                    <label class="form-check-label small fw-bold" for="keep-tags">Keep Unknown Tags</label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-convert" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-exchange-alt me-2"></i> Convert to Markdown
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:240;--tool-color:#4f46e5;--tool-bg:rgba(79,70,229,0.04);">
            <div class="output-header d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <i class="fab fa-markdown fs-4 me-2" style="color:#4f46e5"></i>
                    <h6 class="fw-bold mb-0">Markdown Result</h6>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-light-custom" id="btn-undo" disabled>
                        <i class="fas fa-undo"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-primary" id="btn-download" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                    <button class="btn btn-primary btn-sm px-4" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy
                    </button>
                </div>
            </div>
            
            <textarea id="output-text" class="form-control tool-textarea bg-white" rows="12" readonly placeholder="Result will appear here..."></textarea>
            
            <div class="mt-3 p-3 bg-white rounded-3 border d-flex justify-content-between align-items-center small text-secondary">
                <div id="stats-text"><i class="fas fa-info-circle me-1"></i> Ready for conversion</div>
                <div class="badge bg-light text-primary border" id="mode-badge">Turndown Engine</div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border" id="preview-container" style="display: none;">
                <h6 class="fw-bold mb-3 border-bottom pb-2">Visual Preview</h6>
                <div id="markdown-preview" class="markdown-body"></div>
            </div>
        </div>
    </div>
</div>

<style>
.calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2rem; }
.calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2rem; }
.calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.02em; }
.calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; flex-shrink: 0; }
.form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Inter', sans-serif; font-size: 1rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.output-card-themed { background: var(--tool-bg); border: 1px solid rgba(79,70,229,0.1); border-radius: 24px; padding: 2rem; }
.markdown-body { font-size: 0.95rem; line-height: 1.6; color: #334155; }
</style>

<script src="https://unpkg.com/turndown/dist/turndown.js"></script>
<script src="https://unpkg.com/turndown-plugin-gfm/dist/turndown-plugin-gfm.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnConvert = document.getElementById('btn-convert');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    const statsText = document.getElementById('stats-text');

    let history = [];

    function process() {
        const html = input.value.trim();
        if (!html) return;

        if (output.value) {
            history.push(output.value);
            btnUndo.disabled = false;
        }

        btnConvert.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Converting...';
        btnConvert.disabled = true;

        setTimeout(() => {
            try {
                const turndownService = new TurndownService({
                    headingStyle: document.getElementById('heading-style').value,
                    bullet: document.getElementById('bullet-style').value,
                    codeBlockStyle: document.getElementById('code-block-style').value,
                    linkStyle: document.getElementById('link-style-select').value
                });

                if (document.getElementById('gfm-enabled').checked) {
                    turndownService.use(turndownPluginGfm.gfm);
                }

                if (document.getElementById('keep-tags').checked) {
                    turndownService.addRule('keep', {
                        filter: function (node) { return true; },
                        replacement: function (content, node) { return node.outerHTML; }
                    });
                }

                const result = turndownService.turndown(html);
                output.value = result;
                
                const wc = result.trim() ? result.trim().split(/\s+/).length : 0;
                const lc = result.trim() ? result.split('\n').length : 0;
                statsText.innerHTML = `<i class="fas fa-chart-line me-1 text-primary"></i> Words: <strong>${wc}</strong> | Lines: <strong>${lc}</strong> | Chars: <strong>${result.length}</strong>`;
            } catch (e) {
                console.error(e);
                output.value = "Error: Conversion failed. Please check your HTML structure.";
            }
            btnConvert.innerHTML = '<i class="fas fa-exchange-alt me-2"></i> Convert to Markdown';
            btnConvert.disabled = false;
        }, 300);
    }

    btnConvert.addEventListener('click', process);
    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Ready for conversion';
        history = [];
        btnUndo.disabled = true;
    });

    btnSample.addEventListener('click', () => {
        input.value = "<h1>Sample HTML</h1>\n<p>This is <b>bold</b> and <i>italic</i>.</p>\n<ul><li>Item A</li><li>Item B</li></ul>\n<table><tr><th>Col 1</th><th>Col 2</th></tr><tr><td>Val 1</td><td>Val 2</td></tr></table>";
        process();
    });

    btnUndo.addEventListener('click', () => {
        if (history.length > 0) {
            output.value = history.pop();
            if (history.length === 0) btnUndo.disabled = true;
        }
    });

    btnCopy.addEventListener('click', () => {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value);
        const btn = btnCopy;
        const old = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btn.classList.replace('btn-primary', 'btn-dark');
        setTimeout(() => {
            btn.innerHTML = old;
            btn.classList.replace('btn-dark', 'btn-primary');
        }, 2000);
    });

    btnDownload.addEventListener('click', () => {
        if (!output.value) return;
        const blob = new Blob([output.value], { type: 'text/markdown' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `converted-${Date.now()}.md`;
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>


<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\html-to-markdown.blade.php ENDPATH**/ ?>